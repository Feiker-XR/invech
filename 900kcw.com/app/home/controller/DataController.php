<?php
namespace app\home\controller;
use app\base\controller\BaseController;

/**
 *   开采网数据接口基类
 */
class DataController extends BaseController
{
    public $link = null;
    //Memcache配置
    public $config = [
        'host' => '127.0.0.1',
        'port' => 11211,
    ];

    //数据返回模式
    const RESPONSE_MODEL_ECHO   = 1001; //echo
    const RESPONSE_MODEL_RETURN = 1002 ; //return


    /**
     *  有新数据时清除缓存数据
     *  保证数据的时效性
     * @param bool $flag
     */
    protected function cleanCache($key_prefix = '')
    {
        if ($key_prefix) {
            $key = $key_prefix . '_history';
            $this->link->set($key, '', 0, -10);
        }
    }

    protected function create_link()
    {
        try {
            if (empty($link)) {
                $mem = new \Memcache();
                $mem->connect($this->config['host'], $this->config['port']);
                $this->link = $mem;
            }
            return $this->link;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    //计算快乐十分

    /**
     *  统计广东快乐十分总和大小
     *  大于84算大, 小于84算小,等于84算和
     *  1:小  0:大  2:和局
     * @param $amount
     */
    protected function countBigOrSmallByGdKlsf($amount)
    {
        $status = '';
        switch ($amount) {
            case $amount < 84 :
                $status = 1;
                break;
            case $amount > 84 :
                $status = 0;
                break;
            default :
                $status = 2;
                break;
        }
        return $status;
    }

    /**
     *  统计广东快乐十分总和单双
     *  0:单 1:双
     * @param $amount
     */
    protected function countSingleOrDoubleByGdKlsf($amount)
    {
        $status = ($amount % 2 == 0) ? 1 : 0;
        return $status;
    }

    /**
     *  统计广西快乐十分总和大小
     *  大于55算大, 小于55算小,等于55算和
     *  1:小  0:大  2:和局
     * @param $amount
     */
    protected function countBigOrSmallByGxKlsf($amount)
    {
        $status = '';
        switch ($amount) {
            case $amount < 55 :
                $status = 1;
                break;
            case $amount > 55 :
                $status = 0;
                break;
            default :
                $status = 2;
                break;
        }
        return $status;
    }

    /**
     *  计算尾大小
     *  规则 : 大于等于5尾大 ,反之尾小
     *  1 尾小  0 尾大
     * @param  int $amount 总和
     */
    protected function countLastBigOrSmall($amount = '')
    {
        $status = '';
        if (!empty($amount)) {
            $lastNum = intval($amount % 10); //得到个位
            $status = ($lastNum >= 5) ? 0 : 1;
        }
        return $status;
    }


    /**
     * 计算冠亚和
     */
    protected function calculateSum($frist, $second)
    {
        return bcadd($frist, $second,0);
    }

    /**
     *  统计冠亚和大小
     *  0表示大  1 表示小
     * @param $amount
     */
    protected function countBigOrSmallByGy($amount)
    {
        return ($amount > 11) ? 0 : 1;
    }

    /**
     *  统计冠亚和单双
     * 0 表示单 1 表示双
     * @param $amount
     */
    protected function countSingleOrDouble($amount)
    {
        return ($amount % 2 == 0) ? 1 : 0;
    }


    /**
     *  计算时时彩总和
     * @param $number_arr
     */
    protected function calculateAmountBySsc($number_arr)
    {
        return array_sum($number_arr);
    }

    /**
     *  统计时时彩,和值大小
     *  0表示小 1 表示大
     */
    protected function countBigOrSmallBySsc($amount)
    {
        return ($amount >= 23) ? 1 : 0;
    }

    /**
     *  统计时时彩,和值单双
     *  0 表示双 1 表示单
     */
    protected function countSingleOrDoubleBySsc($amount)
    {
        return ($amount % 2 == 0) ? 0 : 1;
    }

    /**
     *  统计时时彩,单个数的大小
     *  1 表示小 0 表示大
     */
    protected function countBigOrSmallBySscDan($amount)
    {
        return ($amount > 4) ? 0 : 1;
    }

    /**
     * 统计时时彩,单个数的单双
     *  0 单 1 双
     */
    protected function countSingleOrDoubleBySscDan($amount)
    {
        return ($amount % 2 == 0) ? 1 : 0;
    }


    //统计11选5

    /**
     *  统计11选5,单个数的大小
     *  1 表示小 0 表示大  2表示和
     */
    protected function countBigOrSmallBy11x5Dan($amount)
    {
        $status = 0;
        if ($amount == 11) {
            $status = 2;
        } else {
            $status = ($amount > 5) ? 0 : 1;
        }
        return $status;
    }

    /**
     *
     * 统计11选5,单个数的单双
     *  0 单 1 双
     */
    protected function countSingleOrDoubleBy11x5Dan($amount)
    {
        return ($amount % 2 == 0) ? 1 : 0;
    }

    /**
     * 统计大小 -- 11x5
     *  0表示大 , 1表示小 2表示和
     * @param $number
     */
    protected function countBigOrSmallBy11x5($total)
    {
        $status = '';
        if ($total == 30) {
            $status = 2;
        } else {
            $status = ($total > 30) ? 0 : 1;
        }
        return $status;
    }

    /**
     *  统计11x5,和值单双
     *  0 表示单 1 表示双
     */
    protected function countSingleOrDoubleBy11x5($amount)
    {
        return ($amount % 2 == 0) ? 1 : 0;
    }


    //快三统计
    /**
     * 统计快三大小
     *   <= 10  小   >10 大    0:大 1:小 2:通吃
     * @param $amount
     */
    protected function countBigOrSmallByK3($amount,$numbers=[])
    {
        $status = '';
        if ($amount && $numbers) {
            if ($numbers[0]==$numbers[1] && $numbers[1]==$numbers[2]){
                $status = 2 ;
            } else{
                $status = ($amount >10) ? 0 : 1 ;
            }
        }
        return $status ;
    }
    /**
     * 统计快三单双
     *  0:单 1:双
     * @param $amount
     */
    protected  function countSingleOrDoubleByK3($amount)
    {
        return ( $amount % 2 == 0 ) ? 1 : 0 ;
    }
    /**
     * 统计快三 海鲜
     * 1:鱼 2:虾 3:葫芦 4:金钱  5:蟹 6:鸡
     * @param $number
     */
    protected function countSeafoodByK3($number)
    {
        $seafood[1] = '鱼';
        $seafood[2] = '虾';
        $seafood[3] = '葫芦';
        $seafood[4] = '金钱';
        $seafood[5] = '蟹';
        $seafood[6] = '鸡';
        return ( isset($seafood[$number]) ) ? $seafood[$number] : '' ;
    }


    // 快乐8统计
    /**
     *  计算时时彩总和
     * @param $number_arr
     */
    protected function calculateAmountByKl8($number_arr)
    {
        if (isset($number_arr[20])) {
            unset($number_arr[20]) ;
        }
        return array_sum($number_arr);
    }
    /**
     * 统计快乐8总和大小
     *   1:大  -1:小  0:和
     * @param $amount
     */
    protected function countBigOrSmallByKl8($amount)
    {
        $status = '' ;
        if ($amount==810){
            $status = 0 ;
        } else {
            $status =  ($amount >810) ? 1 : -1 ;
        }
        return  $status ;
    }
    /**
     * 统计快乐8总和单双
     *  1:单 -1:双 0:和
     * @param $amount
     */
    protected  function countSingleOrDoubleByKl8($amount)
    {
        $status = '' ;
        if ($amount==810) {
            $status = 0 ;
        } else {
            $status = ( $amount % 2 == 0 ) ? -1 : 1 ;
        }
        return $status ;
    }
    //快乐8 总和组合 1:总大单 2:总大双  3:总小单  4:总小双  5:总和
    protected  function countGroupByKl8($amount)
    {
        $status ='' ;
        if ($amount==810) {
            $status = 5 ;//总和
        } else {

            if ($amount>810) {
                //总大
                $status =($amount%2 == 0) ? 2 : 1 ;
            } else {
                //总小
                $status =($amount%2== 0) ? 4 : 3 ;
            }
        }
        return $status;
    }
    // 统计快乐8 五行
    // 开出的20个号码的总和分在5个段，以金、木、水、火、土命名：
    // 金（210～695）、木（696～763）、水（764～855）、火（856～923）和土（924～1410）。
    // 1:金 2:木 3:水 4:火 5:土
    protected  function countFiveElementsByKl8($amount)
    {
        $status = '' ;
        if ( $amount>=210 && $amount<=695 ) {
            $status = 1 ;
        }elseif( $amount>=696 && $amount<=763 ){
            $status = 2 ;
        }elseif( $amount>=764 && $amount<=855 ){
            $status = 3 ;
        }elseif( $amount>=856 && $amount<=923 ){
            $status = 4 ;
        }elseif( $amount>=924 && $amount<=1410 ){
            $status = 5 ;
        }
        return $status ;
    }
    //统计快乐8 单双      -1:双多  1:单多  0 :单双和
    protected function countSingleByKl8($number)
    {
          unset($number[20]) ; //删掉飞盘号
          $status = '' ;
          $single = [] ;
          $double = [] ;
          //统计单双
          foreach ($number as $num) {
              if ($num % 2 == 0) {
                  $double[] = $num ;
              } else {
                  $single[] = $num ;
              }
          }
         $singleCount = count($single) ;
         $doubleCount = count($double) ;
         if ($singleCount == $doubleCount) {
             $status = 0 ;
         } else {
             $status =  ( $singleCount > $doubleCount ) ?  1 : -1 ;
         }
        return $status ;
    }
    // 统计快乐8前后  大于40的算后,小于等于40的算前
    // 1:前多 -1:后多  0:前后和
    protected function countFrontOrBehindByKl8($number)
    {
        unset($number[20]) ;
        $status = '' ;
        $front  = [];
        $behind = [] ;
        if (!empty($number)) {
            foreach ($number as $num) {
                if ($num <=40) {
                    $front[] = $num;
                } else {
                    $behind[] = $num ;
                }
            }
            $fronCount   = count($front) ;
            $behindCount = count($behind) ;

            if ($fronCount==$behindCount){
                $status = 0 ;
            } else {
                $status = ($fronCount>$behindCount) ? 1: -1 ;
            }
        }
        return $status ;
    }


    /**
     *  计算龙虎
     *  0 表示龙 1 表示虎
     */
    protected function countDragonOrTiger($num1,$num2)
    {
        $status = '' ;
        if ($num1 == $num2) {
            $status = 2 ;
        } else {
            $status = ($num1>$num2) ? 0 : 1 ;
        }
        return  $status;
    }

    /**
     * 格式化快乐8号码,方便后面处理
     * 格式化为 01,03,05,08,09,17,27,28,30,43,45,51,52,63,64,65,66,67,71,79+02
     * @param $number
     */
    protected  function formatNumByKl8($number)
    {
        $res = [] ;
        if (!empty($number)) {
            $arrNum = explode('+',$number) ; //分出特殊好和普通号
            $res    = explode(',',$arrNum[0]) ;
            $res[]  = $arrNum[1];
        }
       return $res ;
    }



    /**
     * 格式化超级大乐透,方便后面处理
     * 格式化为 01,03,05,08,09,17,27,28,30,43,45,51,52,63,64,65,66,67,71,79+02
     * @param $number
     */
    protected  function formatNumByCjdlt($number)
    {
        $res = [] ;

        if (!empty($number)) {
            $arrNum = explode('+',$number) ; //分出特殊好和普通号
            $res    = explode(',',$arrNum[0]) ;
            $sepcial = explode(',',$arrNum[1]) ;
            $res[]  = $sepcial[0];
            $res[]  = $sepcial[1];
        }
       return $res ;
    }

    //得到已经开奖多少期
    protected   function formatLotteryNumber($now,$start=7,$len=3)
    {
        $num = '' ;
        if (!empty($now)) {
            $num = substr($now,$start,$len) ;
            $num = intval($num) ;
        }
        return $num ;
    }

    /**
     *  统计前三 中三 后三 类型
     *  0 : 杂六
     *  1 : 半顺
     *  2 : 顺子
     *  3 : 对子
     *  4 : 豹子
     */
    protected  function countThreeNumberType($num1,$num2,$num3)
    {
        $status = '' ;
        $number = compact('num1','num2','num3') ;
        sort($number) ;

        if ( $this->isContinuous($number) ) {
            //判断是否为顺子
            $status =  2 ;
        } elseif ($this->isHalfContinuous($number) ) {
            //判断是否为半顺
            $status =  1 ;
        } elseif ($this->isLeopard($number) ) {
            //判断是否为豹子
            $status =  4 ;
        } elseif ($this->isPair($number) ) {
            //判断是否为对子
            $status =  3 ;
        } elseif ($this->isSundry($number) ) {
            //判断是否为杂六
            $status =  0 ;
        }
        return $status ;
    }
    /**
     *  是否为顺子
     * @param $number
     */
    protected  function  isContinuous($number)
    {
        $status = false ;
        if ( ($number[0]+1 == $number[1]) && ($number[1]+1==$number[2]) ) {
            $status = true ;
        }
        return $status ;
    }
    /**
     *  是否为半顺
     * @param $number
     */
    protected  function  isHalfContinuous($number)
    {
        if ( ($number[0]+1 == $number[1]) || ($number[1]+1==$number[2]) ) {
            $status = true ;
        }
        return $status ;
    }
    /**
     *  是否为杂六
     * @param $number
     */
    protected  function  isSundry($number)
    {
        $status = false ;
        if ( ($number[0]+1 != $number[1]) && ($number[1]+1!=$number[2]) ) {
            $status = true ;
        }
        return $status ;
    }
    /**
     *  是否为对子
     * @param $number
     */
    protected  function  isPair($number)
    {
        $status = false ;
        if ( ($number[0]==$number[1]) || ($number[1]==$number[2]) || ($number[0] == $number[2]) ) {
            $status = true ;
        }
        return $status ;
    }
    /**
     *  是否为豹子
     * @param $number
     */
    protected  function  isLeopard($number)
    {
        $status = false ;
        if ($number[0]==$number[1] && $number[1]==$number[2]) {
            $status = true ;
        }
        return $status ;
    }

    //体彩排列3计算
    //体彩排列3和值计算
    protected  function countSumByTcpl3($num1,$num2)
    {
        return bcadd($num1,$num2,0) ;
    }
    // 体彩排列3,大小  大于13大
    // 0:大 1:小
    protected  function countBigOrSmallByTcpl3($total)
    {
        return  ($total>13) ? 0 : 1 ;
    }
    // 体彩排列3单双   0:单 1:双
    protected function countSingleOrDoubleByTcpl3($total)
    {
        return ($total % 2 == 0) ? 1 : 0  ;
    }


    /**
     *  返回数据处理
     *   1001 : echo  1002 :return  (默认1001)
     * @param int $model
     */
    protected  function responseData($data,$model='')
    {
        if ($model == self::RESPONSE_MODEL_RETURN) {
            return $data ;
        } else {
            echo $data ; die;
        }
    }


    /**
     * @param string  $url
     * @param int     $is_self  默认:0  如果不是本网站的请求,需要加上host
     * @return mixed
     */
    protected function getData($url,$is_self=0){
//        $host = ($is_self) ? 'Host:www.900kcw.com' :  'Host:k.leqq.cc';
        $tmpInfo = '' ;
        $headers = [
//            'Origin:http://www.900kcw.com',
//            'Referer:http://www.900kcw.com',
            'User-Agent:Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36',
        ];

        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
//        curl_setopt($curl,CURLOPT_FRESH_CONNECT,true) ; //强制获取一个新的链接
        $tmpInfo = curl_exec($curl);     //返回api的json对象
        //关闭URL请求
        curl_close($curl);
        return $tmpInfo;    //返回json对象
    }

    /**
     *  POST提交方式
     * @param string $postUrl
     * @param array  $curlPost
     * @return mixed
     */
    protected  function getDataByPost($postUrl='',$curlPost=[])
    {
        $headers = [
//            'Origin:http://www.900kcw.com',
//            'Referer:http://www.900kcw.com',
            'User-Agent:Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36',
        ];
        $curl = curl_init();//初始化curl
        curl_setopt($curl, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($curl, CURLOPT_HEADER, 0);//设置header
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, 1);//post提交方式
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($curl);//运行curl
        curl_close($curl);

        return $data;
    }


    /**
     * 获取全部彩种资料
     */
    public  function getLotteryList()
    {
        $hot       = $this->getHotList() ;
        $frequency = $this->getFrequencylist() ;
        $abroad    = $this->getAbroadList() ;
        $offical   = $this->getOfficialList() ;
        $result    =  $hot + $frequency + $abroad + $offical ;
        return $result;
    }
    //热门彩数组
    public  function getHotList()
    {
        $result[10001] = ['name'=>'北京赛车PK10','code'=>10001 ,'api'=>'pk10'] ;
        $result[11001] = ['name'=>'900PK10',     'code'=>11001 ,'api'=>'pk10_900'] ;
        $result[10037] = ['name'=>'极速赛车',    'code'=>10037 ,'api'=>'jssc'] ;
        $result[10002] = ['name'=>'重庆时时彩',  'code'=>10002 ,'api'=>'cqssc'] ;
        $result[11002] = ['name'=>'900时时彩',   'code'=>11002 ,'api'=>'ssc_900'] ;
        $result[10036] = ['name'=>'极速时时彩',  'code'=>10036 ,'api'=>'jsssc'] ;
        $result[10003] = ['name'=>'天津时时彩',  'code'=>10003 ,'api'=>'tjssc'] ;
        $result[10004] = ['name'=>'新疆时时彩',  'code'=>10004 ,'api'=>'xjssc'] ;
        $result[10008] = ['name'=>'十一运夺金',  'code'=>10008 ,'api'=>'syydj'] ;
        $result[10005] = ['name'=>'广东快乐十分','code'=>10005 ,'api'=>'gdkl10f'];
        $result[10009] = ['name'=>'幸运农场',    'code'=>10009 ,'api'=>'xync'] ;
        $result[10038] = ['name'=>'广西快乐十分','code'=>10038 ,'api'=>'gxkl10f'] ;
        $result[10046] = ['name'=>'PC蛋蛋幸运28','code'=>10046 ,'api'=>'pcddxy28'] ;
        return $result ;
    }
    //高频彩种数组
    public  function getFrequencylist()
    {
        $result[10006] = ['name'=>'广东11选5','code'=>  10006 ,'api'=>'gd11x5'] ;
        $result[10018] = ['name'=>'上海11选5','code'=>  10018 ,'api'=>'sh11x5'] ;
        $result[10017] = ['name'=>'安徽11选5','code'=>  10017 ,'api'=>'ah11x5'] ;
        $result[10015] = ['name'=>'江西11选5','code'=>  10015 ,'api'=>'jx11x5'] ;
        $result[10023] = ['name'=>'吉林11选5','code'=>  10023 ,'api'=>'jl11x5'] ;
        $result[10022] = ['name'=>'广西11选5','code'=>  10022 ,'api'=>'gx11x5'] ;
        $result[10020] = ['name'=>'湖北11选5','code'=>  10020 ,'api'=>'hb11x5'] ;
        $result[10019] = ['name'=>'辽宁11选5','code'=>  10019 ,'api'=>'ln11x5'] ;
        $result[10016] = ['name'=>'江苏11选5','code'=>  10016 ,'api'=>'js11x5'] ;
        $result[10025] = ['name'=>'浙江11选5','code'=>  10025 ,'api'=>'zj11x5'] ;
        $result[10024] = ['name'=>'内蒙古11选5','code' =>10024 ,'api'=>'nmg11x5'];
        $result[10034] = ['name'=>'天津快乐十分','code'=>10034 ,'api'=>'tjkl10f'];
        $result[10007] = ['name'=>'江苏快3',   'code'=>  10007 ,'api'=>'jsk3'] ;
        $result[10027] = ['name'=>'吉林快3',   'code'=>  10027 ,'api'=>'jlk3'] ;
        $result[10028] = ['name'=>'河北快3',   'code'=>  10028 ,'api'=>'hbk3'] ;
        $result[10030] = ['name'=>'安徽快3',   'code'=>  10030 ,'api'=>'ahk3'] ;
        $result[10029] = ['name'=>'内蒙古快3', 'code'=>  10029 ,'api'=>'nmgk3'];
        $result[10031] = ['name'=>'福建快3',   'code'=>  10031 ,'api'=>'fjk3'] ;
        $result[10032] = ['name'=>'湖北快3',   'code'=>  10032 ,'api'=>'hubk3'];
        $result[10033] = ['name'=>'北京快3',   'code'=>  10033 ,'api'=>'bjk3'] ;
        $result[10026] = ['name'=>'广西快3',   'code'=>  10026 ,'api'=>'gxk3'] ;
        $result[10014] = ['name'=>'北京快8',   'code'=>  10014 ,'api'=>'bjkl8'];
        return $result ;
    }
    //境外彩数组
    public  function getAbroadList()
    {
        $result[10010] = ['name'=>'澳洲幸运5', 'code'=> 10010 ,'api'=>'azxy5']  ;
        $result[10011] = ['name'=>'澳洲幸运8', 'code'=> 10011 ,'api'=>'azxy8'] ;
        $result[10012] = ['name'=>'澳洲幸运10','code'=> 10012 ,'api'=>'azxy10'] ;
        $result[10013] = ['name'=>'澳洲幸运20','code'=> 10013 ,'api'=>'azxy20'];
        $result[10047] = ['name'=>'台湾宾果',  'code'=> 10047 ,'api'=>'twbg']  ;
        return $result ;
    }
    //全国彩数组
    public  function getOfficialList()
    {
        $result[10039] = ['name'=>'福彩双色球','code'=> 10039 ,'api'=>'fcssq'] ;
        $result[10041] = ['name'=>'福彩3D',    'code'=> 10041 ,'api'=>'fc3d' ] ;
        $result[10042] = ['name'=>'福彩七乐彩','code'=> 10042 ,'api'=>'fc7lc'] ;
        $result[10040] = ['name'=>'超级大乐透','code'=> 10040 ,'api'=>'cjdlt'] ;
        $result[10043] = ['name'=>'体彩排列3', 'code'=> 10043 ,'api'=>'tcpl3'] ;
        $result[10044] = ['name'=>'体彩排列5', 'code'=> 10044 ,'api'=>'tcpl5'] ;
        $result[10045] = ['name'=>'体彩七星彩','code'=> 10045 ,'api'=>'tcqxc'] ;
        return $result ;
    }



    /**
     * 临时格式化打印方法
     * @param $arr
     */
    public function dd($arr)
    {
        echo '<pre>';
        print_r($arr);
        die;
    }

}