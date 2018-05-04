<?php
// +----------------------------------------------------------------------
// | describe=>  自动派奖类
// +----------------------------------------------------------------------
// | CreateDate=> 2017年11月22日
// +----------------------------------------------------------------------
// | Author=> Root
// +----------------------------------------------------------------------

class AutoLottery {

    public $config   = [] ; //配置文件
    public $cpConfig = [] ; //数据采集配置
    public $played   = [] ;//玩法数据属性
    public $timers   = [] ;
    static public  $mysqli   = null ;//数据库连接
    public $encrypt_key = 'cc40bfe6d972ce96fe3a47d0f7342cb0' ;

    const  TYPE_BJKL8  = 24 ;  //北京快乐8 彩种类型标识
    const  TYPE_FC3D   = 9  ;  //福彩3D 彩种类型标识
    const  TYPE_PL3    = 10 ;  //排列3 彩种类型标识
    const  TYPE_GD11X5 = 6 ; //广东11选5 彩种类型标识
    const  TYPE_JX11X5 = 16 ; //江西11选5 彩种类型标识


    /**
     * AutoLottery  采集初始化
     */
    public function __construct()
    {
        try {
            //加载相关文件
            $this->loadParseCalc() ;  // 加载中奖结果判定文件
            $this->loadConfig()    ;  //加载配置文件
            $this->loadCalcTime()  ;  //加载开奖时间相关文件
            $this->loadFormatLottery(); //加载开奖数据处理文件
            $this->loadLog()       ;  //加载日志类
            $this->createMysqlClient($this->config['dbinfo']) ; //创建数据库对象
            $this->getPlayed() ; //获取玩法数据

        } catch (\Exception $e) {
            echo '相关文件加载失败::'.$e->getMessage();
        }
    }

    /**
     *  运行任务
     */
    public function runTask()
    {
        if ( count($this->cpConfig) ) {
            foreach ( $this->cpConfig as $conf) {
                // 1.处理采集配置
                $this->timers[$conf['name']] = [] ;
                $this->timers[$conf['name']][$conf['timer']] = ['timer'=>null,'option'=>$conf] ;

                // 2.采集执行
                try {
                    if ($conf['enable']) { $this->run($conf) ; }
                } catch (\Exception $e) {
                    $this->addLog('运行出错:'.$e->getMessage(),"休眠{$this->config['errorSleepTime']}") ;
                    $this->restartTask($conf, $this->config['errorSleepTime']) ;   //如果出现错误,重新执行任务
                    echo '运行出错:'.$e->getMessage(),"休眠{$this->config['errorSleepTime']} \n" ;
                }
            }
        }
        //$this->closeMysqli() ;
    }

    /**
     *
     * 重新执行任务
     * @param array $conf
     * @param string $sleepTime
     * @param $flag   true:数据为数组
     */
    public function restartTask($conf=[],$sleepTime='',$flag=true)
    {
        echo "重新执行任务\n" ;
        $sleepTime = ($sleepTime<0) ? $this->config['errorSleepTime'] : $sleepTime ;
        $sleepTime = $sleepTime*1000 ; //转换为毫秒为单位
        $option    = [] ; //临时存储配置中的option配置

        if (!$this->timers[$conf['name']]) $this->timers[$conf['name']] = [] ;
        if (!$this->timers[$conf['name']][$conf['timer']]) $this->timers[$conf['name']][$conf['timer']] = ['timer'=>null,'option'=>$conf] ;

        if ($flag) {
            foreach ($this->timers[$conf['name']] as $item) {
                $option = $item['option'] ;
                if ($item['timer']) swoole_timer_clear($item['timer']) ; //清除定时器

                $this->timers[$option['name']][$option['timer']]['timer'] = swoole_timer_tick($sleepTime,function() use($option) {
                    $this->run($option) ;
                }) ;
                $this->addLog($conf['title']."类型{$conf['type']} 休眠".($sleepTime/1000).'秒后从'.$conf['source'].'采集'.$conf['title'].'数据true...') ;
                echo $conf['title']."类型{$conf['type']} 休眠".($sleepTime/1000).'秒后从'.$conf['source'].'采集'.$conf['title'].'数据true...'."\n" ;
            }
        } else {
            //清除定时器
            if ($this->timers[$conf['name']][$conf['timer']]['timer']) {
                swoole_timer_clear($this->timers[$conf['name']][$conf['timer']]['timer']);
            }
            $this->timers[$conf['name']][$conf['timer']]['timer'] = swoole_timer_tick($sleepTime,function() use($conf) {
                $this->run($conf) ;
            }) ;

            $this->addLog( $conf['title']."类型{$conf['type']} 休眠".($sleepTime/1000).'秒后从'.$conf['source'].'采集'.$conf['title'].'数据...') ;
            echo $conf['title']."类型{$conf['type']} 休眠".($sleepTime/1000).'秒后从'.$conf['source'].'采集'.$conf['title'].'数据...'."\n" ;
        }
    }

    /**
     *  采集任务
     *  @param array $conf
     */
    public function run( $conf=[] )
    {
        try {
            //判断是否需要清除定时器
            if ($this->timers[$conf['name']][$conf['timer']]['timer'])  {
                swoole_timer_clear($this->timers[$conf['name']][$conf['timer']]['timer']) ;
                $this->addLog($conf['timer'].'定时器已清除') ;
            }
            $this->addLog('开始从'.$conf['source'].'采集'.$conf['title'].'数据') ;
            $data = $this->getLotteryData($conf) ; //获取开奖数据
            $this->submitData($data,$conf) ; //数据入库

            if ( !$this->timers[$conf['name']][$conf['timer']]['timer'] ) {
                $this->restartTask($conf, $this->config['errorSleepTime']) ;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     *  数据入库并完成开奖派奖
     *  @param $data
     *  @param $conf
     */
    public function submitData($data,&$conf)
    {
        try {
            if (!empty($data) && !empty($conf)) {
                foreach ($data as $lottery) {
                    $lottery['type'] = $conf['type'] ;  // 将彩票类型注入开奖数据数组中
                    $this->addLog( '提交从'.$conf['source'].'采集的'.$conf['title'].'第'.$lottery['expect'].'数据：'.$lottery['opencode'] );
                    $this->intoDataBase($lottery,$conf) ; //数据入库
                    $this->runLottery($lottery,$conf) ; //开奖
                    break ; //只处理最近的一条开奖的数据
                }
            } else {
                $this->restartTask($conf, $this->config['errorSleepTime']) ; //如果数据有异常,重新执行任务
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     *  数据入库
     * @param $data
     * @param $conf
     */
    public function intoDataBase($data,$conf)
    {
        try {
            $time   = time() ;
            $sql    = "insert into gygy_data(type, time, number, data) values({$conf['type']},{$data['opentimestamp']},'{$data['expect']}','{$data['opencode']}') ;" ;
            $result = self::$mysqli->query($sql) ;

            //执行预处理语句
            if (!$result) {
                //数据入库有异常时
                try {
                    $sleep = $conf['name']($data) ;
                    $sleep =  ($sleep<0) ? ($this->config['errorSleepTime']) : $sleep ;
                } catch (\Exception $e) {
                    $this->addLog( $conf['title'].'第'.$data['expect'].'期,计算休眠时间时出现错误') ;
                    $this->restartTask($conf, $this->config['errorSleepTime']) ;
                    return ;
                }
                $this->addLog( $conf['title'].'第'.$data['expect'].'期数据已经存在数据true') ;
                echo $conf['title'].'第'.$data['expect'].'期数据已经存在数据true'."\n" ;
                $this->restartTask($conf, $sleep, true) ;

            } else {
                //数据入库成功时
                try {
                    $sleep = $conf['name']($data) ; //这个时间返回的是毫秒为单位的所以不用*1000
                    echo $sleep."\n" ;
                } catch (\Exception $e) {
                    $this->addLog('解析下期数据出错：'.$e->getMessage()) ;
                    $this->restartTask($conf, $this->config['errorSleepTime']) ;
                    return;
                }
                $this->addLog('写入'.$conf['title'].'第'.$data['expect'].'期数据成功') ;
                echo '写入'.$conf['title'].'第'.$data['expect'].'期数据成功'."\n" ;
                $this->restartTask($conf, $sleep, true) ;
            }
        } catch (\Exception $e) {
            $this->addLog('运行出错：'.$e->getMessage()) ;
            $this->restartTask($conf, $this->config['errorSleepTime']) ;
        }
    }

    /**
     *  开 奖
     * @param $lottery 彩种开奖数据
     * @param $conf    彩种配置
     */
    public function runLottery($lottery,$conf)
    {       
        try {
            //查询投注记录
            $sql = "select * from gygy_bets where type={$conf['type']}  and actionNo='{$lottery['expect']}'  and isDelete=0  and lotteryNo='' " ;

            $lotterySqls = [] ; //调用开奖处理存储过程
            $result = self::$mysqli->query($sql) ;

            while ($result && $row = $result->fetch_assoc()) {

                //获取结果判定处理函数
                try {
                    //$func = $this->played[$row['playedId']]; //获取结果判定函数名
                    $played = $this->played[$row['playedId']];
                    $func = $played['ruleFun'];

                    if (!function_exists($func)) {
                        throw new \Exception('算法不是可用的函数') ;
                    }
                } catch (\Exception $e) {
                    echo "计算玩法{$row['playedId']}中奖号码算法不可用：".$e->getMessage() ;
                    $this->addLog("计算玩法{$row['playedId']}中奖号码算法不可用：".$e->getMessage()) ;
                    return ;
                }

                $id         = $row['id'] ;
                $actionData = $row['actionData'] ;   //投注号码
                $kjData     = $lottery['opencode'] ; //开奖号码
                $weiShu     = $row['weiShu'] ;       //位数


                $fanDian    = $row['fanDian'] ;     //根据返点和计算 赔率;
                $beiShu     = $row['beiShu'] ;
                $mode       = $row['mode'] ;

                

                $is_mix     = $played['is_mix'] ; 
                $mix_ids    = $played['mix_ids'] ; 
                $mix_pls    = [];//混合玩法的赔率表
                
                $is_kqwf    = $played['is_kqwf'];
                //$money      = $row['money'];//快钱玩法的投注金额
                $money      = $beiShu*$mode;    //每注本金
                $odd        = $row['bonusProp'];//快钱赔率

                $zjAmount = 0;

                //组合开奖结果
                try {
                    if($weiShu){
                        $zjcount    = $func($actionData,$kjData,$weiShu) ;    
                    }else{
                        $zjcount    = $func($actionData,$kjData) ;    
                    }
                    $zjcount = (int)$zjcount;

                    //混合玩法返回各相关玩法的中奖次数;
                    if($is_mix){
                        $mix_sql = "select * from gygy_played where id in (" . $mix_ids . ") " ;                        
                        $mix_result = self::$mysqli->query($mix_sql) ;

                        if($fanDian == 0){
                            $params_sql = "select value from gygy_params where name = 'fanDianMax' " ;  
                            $params_result = self::$mysqli->query($params_sql) ;
                            $params_row = $params_result->fetch_assoc();                      
                            $fanDianMax = $params_row['fanDianMax'];

                            while ($mix_row = $mix_result->fetch_assoc()) {
                                $prop = $mix_row['bonusProp'];
                                $base = $mix_row['bonusPropBase'];
                                $pl = (($prop-$base)/$fanDianMax*$fanDian + $base);
                                $mix_pls[] = round($pl,2);
                            }                            
                        }else{//最低赔率;
                            while ($mix_row = $mix_result->fetch_assoc()) {
                                $mix_pls[] = $mix_row['bonusPropBase'];
                            }      
                        }
                        
                        $count_sum = 0;//总中奖次数
                        foreach ($mix_pls as $key => $pl) {
                            $count = $zjcount[$key];
                            $zjAmount += $count*$pl*$beiShu*$mode/2;
                            $count_sum += $count;
                        }
                        $zjAmount = round($zjAmount,2);
                        $zjcount = $count_sum;
                    }


                    if($is_kqwf){
                        //目前 混合玩法 的 各子玩法 不支持 和局处理;
                        if(-1 == $zjcount){//快钱玩法 存在 和局, 退还本金
                            $actionNum = $row['actionNum'] ;
                            $zjAmount = $actionNum*$money;
                            //$zjAmount = $actionNum*$beiShu*$mode;                     
                        }

                        if($zjcount>0){
                            $zjAmount = $zjcount*$odd*$money;
                        }                              
                    }


                } catch (\Exception $e) {
                    echo "{$func}计算中奖号码时出错：".$e->getMessage() ;
                    $this->addLog("{$func}计算中奖号码时出错：".$e->getMessage()) ;
                    return ;
                }
                               
                //存储过程改为,如果$zjAmount为0,需要计算,否则不计算,使用传入的中奖金额;
                $lotterySqls[] = " call kanJiang($id, $zjcount, $zjAmount, '{$kjData}', 'ssc-{$this->encrypt_key}') " ;
            }

            //进行派奖
            try{
                $this->dispatchLottery($lotterySqls,$lottery) ;
            } catch (\Exception $e) {
                //输出派奖错误信息,并打印日志
                echo $e->getMessage() ;
                $this->addLog($e->getMessage()) ;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }     
    }

    /***
     *  派 奖
     * @param  $lotterySqls  调用开奖存储过程SQL
     * @param  $lottery      开奖数据
     * @throws Exception
     */
    public function dispatchLottery($lotterySqls,$lottery)
    {
        try {
            if (count($lotterySqls) <1) throw new \Exception("彩种{$lottery['type']}第{$lottery['expect']}期没有投注") ;

            if (!self::$mysqli)  {
                throw new \Exception('数据库连接中断休眠'.$this->config['errorSleepTime'].'秒后继续...') ;
            } else {
                foreach ($lotterySqls  as $sql) {
                    if (!self::$mysqli->query($sql)) {
                        $this->addLog('派奖失败.错误信息:'.$sql);
                        throw new \Exception('派奖失败.错误信息:'. mysqli_error(self::$mysqli)."\t :".$sql) ;
                    } else {
//                        echo "派奖成功\n" ;
                    }
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     *  获取开奖数据
     * @param string $conf  配置
     * @param string $type  彩种类型
     */
    public function  getLotteryData($conf=[])
    {
        try {
            $data = $this->getDataByCURL($conf['option']['host'],$conf['option']['headers']) ; //暂时使用curl获取数据
            if (!empty($data)) {
                $this->addLog('开奖数据抓取成功...') ;
            }
            $data = $this->formatLotteryData($data,$conf['type']) ; //格式化数据
            if (!empty($data)) {
                $this->addLog('开奖数据格式化成功...') ;
            }
            return $data ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     *  格式化开奖数据
     *  由于接口有的是请求内部的接口,有的是第三方的接口
     *  返回的数据格式有出入, 所以在这里做了一个适配器
     *  将不同格式的数据,格式化为一致的数据格式 ,方便后续统一处理
     * @param array $data  数据
     * @param string $type 彩种类型
     * @return array
     */
    private function  formatLotteryData($data=[],$type='')
    {
        try {
            if ( !empty($data) ) {
                $obj = new FormatData() ;
                if ( $type == self::TYPE_BJKL8 ) {
                    $data = $obj->formatBjkl8($data) ; //北京快乐8处理
                } elseif ( $type == self::TYPE_FC3D ) {
                    $data = $obj->formatOpencai($data) ; //福彩3D处理
                } elseif ( $type == self::TYPE_PL3 ) {
                    $data = $obj->formatOpencai($data) ; //排列3处理
                } elseif ( $type == self::TYPE_GD11X5 ) {
                    $data = $obj->gd11x5($data) ; //广东11选5
                } elseif ( $type == self::TYPE_JX11X5 ) {
                    $data = $obj->jx11x5($data) ; //江西11选5
                } else {
                    $data = $obj->normally($data) ;//普通处理
                }
            }

            return $data ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     * CURL 获取数据
     * @param $url
     * @param array $param
     * @return array|mixed
     */
    public function getDataByCURL($url,$header='',$param=[])
    {
        try {
            $result = [] ;
            if ($url) {
                $curl = curl_init();
                if (!empty($header['User-Agent'])) curl_setopt($curl, CURLOPT_USERAGENT, $header['User-Agent']); // 模拟用户使用的浏览器
                //设置提交的url
                curl_setopt($curl, CURLOPT_URL, $url);
                //设置头文件的信息作为数据流输出
                curl_setopt($curl, CURLOPT_HEADER, 0);
                //设置获取的信息以文件流的形式返回，而不是直接输出。
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                //设置post方式提交
                curl_setopt($curl, CURLOPT_POST, 1);
                //设置post数据
                $post_data = $param;
                curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
                //执行命令
                $data = curl_exec($curl);
                //关闭URL请求
                curl_close($curl);
                //获得数据并返回
                $result = ($data) ;
            }
            return $result ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     *  获取玩法数据
     */
    public function getPlayed()
    {
        try {
            //$sql    = ' select id, ruleFun from gygy_played ' ;
            $sql    = ' select * from gygy_played ' ;
            $result = self::$mysqli->query($sql) ;
            if (!$result) throw new \Exception('没有查询到数据') ;

            while ($row = $result->fetch_assoc()) {
                //$this->played[$row['id']] = $row['ruleFun'] ;
                $this->played[$row['id']] = $row;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     *  创建mysql客户端
     */
    public function createMysqlClient($dbinfo)
    {
        try{
            if (self::$mysqli == null) {
                //用mysqli来连接数据库（服务器，用户名，密码，数据库名字）
                $mysqli = new mysqli($dbinfo['host'],$dbinfo['user'],$dbinfo['password'],$dbinfo['database']) ;
                if ( mysqli_connect_errno() ) {
                    echo "连接数据库失败：".mysqli_connect_error() ;
                    $this->addLog("连接数据库失败：".mysqli_connect_error()) ;
                    self::$mysqli = null ;
                } else {
                    self::$mysqli = $mysqli ;
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     * 加载配置文件
     */
    private  function loadConfig($path = './config.php')
    {
        $this->config = require_once ($path) ;
        $this->cpConfig = $this->config['cp'] ;
    }

    /**
     *  加载开奖时间处理文件
     */
    private  function loadCalcTime($path = './kj-calc-time.php')
    {
        require_once($path) ;
    }

    /**
     *  加载算法文件
     */
    private  function loadParseCalc($path = './parse-calc-count.php')
    {
        require_once($path) ;
        require_once('./kqwf_algo.php') ;
    }

    /**
     *  加载开奖数据处理类
     * @param string $path
     */
    private function loadFormatLottery($path='./FormatData.php')
    {
        require_once($path) ;
    }

    /**
     *  加载日志类
     */
    private  function loadLog($path = './Log.php')
    {
        require_once ($path) ;
    }

    /**
     * 关闭数据库连接
     */
    public function closeMysqli()
    {
        mysqli_close(self::$mysqli) ;
        self::$mysqli=null ;
    }

    /**
     * 写日志
     * @param string $content
     */
    public function addLog($content='')
    {
        $log = new Log();
        $log->add($content);
    }

}