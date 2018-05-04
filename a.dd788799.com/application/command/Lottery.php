<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

use app\common\model\Played;
use app\common\model\Data;
use app\common\model\LotteryData;
use app\events\LotteryEvent;

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
    private $logger;

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
        $this->setName('lottery')->setDescription('采集');
    }

    protected function init()
    {
	   date_default_timezone_set('PRC') ;
	
        //include_once ROOT_PATH . 'swoole' . DS . 'parse-calc-count.php';
        //include_once ROOT_PATH . 'swoole' . DS . 'kqwf_algo.php';
        include_once ROOT_PATH . 'swoole' . DS . 'kj-calc-time.php';

        //config('cache.type','File');

        $this->played = Played::getAll();
        
        $this->logger = container('logger');
        $this->logger->useFiles(RUNTIME_PATH.'log/lottery.log');
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
            $this->output->writeln(date('Y-m-d H:i:s').':'.$conf['title'].'在'.$rerun_time.'秒后再次采集!');
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
/*
        foreach ($data as &$lottery) {
        //新的接口数据 {"type":"bjpk10","period":"677974","number":"09,03,01,10,02,04,06,07,05,08","dateline":"2018-04-22 20:17:40"},  
        //测试接口旧数据格式 {"rows":5,"code":"fc3d","info":"试用接口剩19238451秒，实时接口请访问www.opencai.net查询、购买或续费","data":[{"expect":"2018105","opencode":"8,4,7","opentime":"2018-04-22 21:24:33","opentimestamp":1524403473},{"expect":"2018104","opencode":"7,1,7","opentime":"2018-04-21 21:23:59","opentimestamp":1524317039},{"expect":"2018103","opencode":"2,2,2","opentime":"2018-04-20 21:26:22","opentimestamp":1524230782},{"expect":"2018102","opencode":"5,7,3","opentime":"2018-04-19 21:25:41","opentimestamp":1524144341},{"expect":"2018101","opencode":"3,4,5","opentime":"2018-04-18 21:24:34","opentimestamp":1524057874}]}

            $lottery = [
                'type'    => $lottery['type']??$conf['name'],
                'expect'  => $lottery['period']??$lottery['expect'],
                'opencode'=> $lottery['number']??$lottery['opencode'],
            ];

            $expect = Data::where('type',$conf['type'])
            			->where('number',$lottery['expect'])->find();
            if(!$expect){
                $gygy_data = [	'type'=>$conf['type'],
            					//'time'=>$lottery['opentimestamp'],
            					'number'=>$lottery['expect'],
            					'data'=>$lottery['opencode'],
            				];
                $expect = Data::create($gygy_data);
                event(new LotteryEvent($expect));                
            }
        }
*/
        foreach ($data as &$lottery) {
            //$expect = Data::where('type',$conf['type'])->where('number',$lottery['expect'])->find();
            $lottery_data = LotteryData::getByCodeAndPeriod($lottery['type'],$lottery['period']);
            if(!$lottery_data){
                $lottery_data = LotteryData::addApiData($lottery);
                event(new LotteryEvent($lottery_data));                
            }       
        }
        //如果漏了10期,接口返回最近10期;
        $last_lottery = end($data);
        $rerun_time = $conf['name']($last_lottery) ;
        return $rerun_time;
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
        /*
    	} elseif ( $type == self::TYPE_GD11X5 ) {
                $data = $obj->gd11x5($data) ; //广东11选5
            } elseif ( $type == self::TYPE_JX11X5 ) {
                $data = $obj->jx11x5($data) ; //江西11选5
    	*/
        } else {
            $data = $obj->normally($data) ;//普通处理
        }
        return $data;
	}

}
