<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Lottery extends Command
{
    const  TYPE_BJKL8  = 24 ;  //北京快乐8 彩种类型标识
    const  TYPE_FC3D   = 9  ;  //福彩3D 彩种类型标识
    const  TYPE_PL3    = 10 ;  //排列3 彩种类型标识
    const  TYPE_GD11X5 = 6 ; //广东11选5 彩种类型标识
    const  TYPE_JX11X5 = 16 ; //江西11选5 彩种类型标识

    public $encrypt_key = 'cc40bfe6d972ce96fe3a47d0f7342cb0' ;

	public $output;
	public $played;

    /*整体思路已经待改进地方;
    1.runOne(不能命名为run) = buniness + 定时;
      buniness包括 采集+派奖+定时时间戳; 成功时根据预定时间再执行,异常时10秒后再执行;
    2.改进:计算下次运行时间: 
      根据采集的结果的期数 和 开奖时间表 定位到 开奖结果的下一期; 
      如果当期是10期,采集到第2期,下次采集时间是第3期,这个有问题;
      直接根据 本地时间 和 开奖时间表 可以直接定位 下一期开奖时间;
    3.采集器 不采集 以前的开奖结果;
    */

    protected function configure()
    {
        $this->setName('lottery')->setDescription('采集-开奖');
    }

    protected function init()
    {
	date_default_timezone_set('PRC') ;
	
        include_once ROOT_PATH . 'swoole' . DS . 'parse-calc-count.php';
        include_once ROOT_PATH . 'swoole' . DS . 'kqwf_algo.php';
        include_once ROOT_PATH . 'swoole' . DS . 'kj-calc-time.php';

        config('cache.type','File');
        $playeds = cache('gygy_playeds');
        if(!$playeds){
	        $playeds = db('played')->select();
	        foreach($playeds as $row){
	        	$playeds[$row['id']] = $row;	
	        }
        }
        $this->played = $playeds;
    }

    protected function execute(Input $input, Output $output)
    {
        $this->output = $output;
        $this->init();

	    $confs = require_once(__DIR__.'/config.php');

	    foreach($confs as $conf){            
            if($conf['enable']){
            	$this->runOne($conf);	
            }
	    }

    }

    //业务流程
    protected function runOne($conf){

	    $error_time = config('error_time')??10;//错误时延迟10秒重启
	    //$delay_time = config('delay_time')??10;
	    //官方开奖后延迟10秒取开奖结果, 延迟时间在时间计算中写死了

        try{
        	$this->output->writeln(date('Y-m-d H:i:s').':'.$conf['title'].'采集开奖结果!');
        	$rerun_time = $this->buniness($conf); 
        } catch (\Exception $e) {
            $this->output->writeln($e->getMessage());
            $rerun_time = $error_time;
        }

        $this->rerun($conf,$rerun_time);
    }

    public function rerun($conf,$sleepTime)
    {
        //swoole_timer_after一次性定时器取代swoole_timer_tick持续性定时器;
        //swoole_timer_after和swoole_timer_tick都返回定时器id;
        //swoole_timer_clear(timer_id)可以清除以上两种定时器;

        $sleepTime = $sleepTime*1000 ; //转换为毫秒为单位
        /*
		swoole_timer_tick($sleepTime,function() use($conf) {
            $this->runOne($conf) ;
        }) ;
        swoole_timer_after($sleepTime, [$this,'runOne'],$conf);//不能使用this
        */
		swoole_timer_after($sleepTime,function($conf) {
            $this->runOne($conf);
        },$conf) ;
	
    }

    protected function buniness($conf){

	    $data = file_get_contents($conf['url']);
	    $data = $this->format($data,$conf['type']);

	    //db()->startTrans();
        foreach ($data as $lottery) {
            
            //$this->addLog( '提交从'.$conf['source'].'采集的'.$conf['title'].'第'.$lottery['expect'].'数据：'.$lottery['opencode'] );
            
            $expect = db('data')->where('type',$conf['type'])
            			->where('number',$lottery['expect'])->find();
            if(!$expect){
                $gygy_data = [	'type'=>$conf['type'],
            					'time'=>$lottery['opentimestamp'],
            					'number'=>$lottery['expect'],
            					'data'=>$lottery['opencode'],
            				];
            	$ret = db('data')->insert($gygy_data);
                $this->runLottery($lottery,$conf['type']) ; //开奖
            }

            return $conf['name']($lottery) ;
			//只处理最近的一条开奖的数据
        }
	}    

	protected function format($data,$type){
		require_once(ROOT_PATH.'/swoole/FormatData.php');
		$obj = new \FormatData() ;
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
        return $data;
	}

    public function runLottery($lottery,$type)
    {               
        $bets = db('bets')->where('type',$type)->where('actionNo',$lottery['expect'])
        	->where('isDelete',0)->where('lotteryNo','')->select();

        foreach ($bets as $row) {
            //$func = $this->played[$row['playedId']]; //获取结果判定函数名
            $played = $this->played[$row['playedId']];
            $func = $played['ruleFun'];    

            $id         = $row['id'];
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

            if($weiShu){
                $zjcount    = $func($actionData,$kjData,$weiShu) ;    
            }else{
                $zjcount    = $func($actionData,$kjData) ;    
            }
            //$zjcount = (int)$zjcount;

            //混合玩法返回各相关玩法的中奖次数;
            if($is_mix){

                $mix_result = db('played')->where('id','in',$mix_ids)->select();

                if($fanDian == 0){

                    $fanDianMax = db('params')->where('name','fanDianMax')->value('value');

                    foreach($mix_result as $mix_row){
                        $prop = $mix_row['bonusProp'];
                        $base = $mix_row['bonusPropBase'];
                        $pl = (($prop-$base)/$fanDianMax*$fanDian + $base);
                        $mix_pls[] = round($pl,2);
                    }

                }else{//最低赔率;
                    foreach($mix_result as $mix_row){
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

            $zjcount = (int)$zjcount;

            //存储过程改为,如果$zjAmount为0,需要计算,否则不计算,使用传入的中奖金额;
            $sql = " call kanJiang($id, $zjcount, $zjAmount, '{$kjData}', 'ssc-{$this->encrypt_key}') " ;                             	
			db()->query($sql);            
        }
    }
}
