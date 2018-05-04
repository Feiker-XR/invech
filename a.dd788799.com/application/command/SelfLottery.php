<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Debug;

use app\common\model\Type;
use app\common\model\Played;
use app\common\model\Config;
use app\common\model\Data;

use app\events\LotteryEvent;

class SelfLottery extends Command
{
	
	//1.随机一个开奖结果;
	//2.结算统计

    private $lottery;//Type模型对象,彩种
	private $kjData;
    private $playeds;//玩法缓存

    private $betCount;//总注数
    private $zjCount;//总中奖注数
	private $betAmount;
	private $zjAmount;
	
    protected function configure()
    {
        $this->setName('self-lottery')->setDescription('自行开奖')
        ->addArgument('lottery')->addArgument('qishu');
    }

    protected function execute(Input $input, Output $output)
    {
        include_once ROOT_PATH . 'swoole' . DS . 'parse-calc-count.php';

        $this->playeds = Played::getAll();

	    $args = $input->getArguments();

	    if(!($lottery_name = $args['lottery'])){	    	
	    	$lottery_name = 'ssc-cq';
	    	$this->lottery = Type::findByIdOrName($lottery_name);
	    	if(!$this->lottery){
	    		$output->writeln("彩种不存在!");exit();
	    	}
	    }

	    if(!($qishu = $args['qishu'])){
	    	$lastNo = $this->lottery->getLastGamePhase();
	    	$qishu = $lastNo['actionNo'];
	    }

    	$query = Bet::where('type',$this->lottery->id)
    			->where('actionNo',$qishu)
				->where('lotteryNo','');

    	$count = $query->count();
    	if(!$count){
    		$output->writeln("本期无注单!");exit();
    	}

    	$perPage = config('command_per_page')??100;

        $hit = 0;$try = 0;
        while((!$hit)){

        	$try++;

		    $this->betCount = 0;//总注数
		    $this->zjCount = 0;//总中奖注数
			$this->betAmount = 0;
			$this->zjAmount = 0;

        	debug('start');

        	$this->$kjData = $this->lottery->random();

        	$query->chunk($perPage, [$this,'runPageLottery']);

        	debug('end');
		    $rumtime = debug('start','end');
		    $output->writeln("第".$try."次尝试结算使用".$rumtime."秒!");

		    $winRate = Config::getByName('winRate');
		    $profitRate = Config::getByName('profitRate');
	        $win_rate = floatval($this->zjCount)/$this->betCount*100;

	        if($win_rate > $winRate){	        	
	        	continue;
	        }

	        if($this->betAmount < $this->zjAmount){
	        	continue;
	        }
	        
	        $profit_rate = ($this->betAmount-$this->zjAmount)/$this->betAmount*100;
	        if($profit_rate < $profitRate){
	        	continue;
	        }

			$hit = 1;
        }


        $gygy_data = [	'type'=>$this->lottery->id,
    					'time'=>time(),
    					'number'=>$qishu,
    					'data'=>$this->$kjData,
    				];
        $expect = Data::create($gygy_data);
        event(new LotteryEvent($expect));

	    $rumtime = Debug::getUseTime();
	    $output->writeln(self::$lottery.$qishu."期，共尝试".$try."次,共使用".$rumtime."秒,开奖结果为".implode(",",$kjData));
	    $output->writeln('预期中奖率小于'.$lottery['win_rate'].'%,预期利润率大于'.$lottery['profit_rate'].'%');
	    $output->writeln('本期中奖率为'.number_format($win_rate,2).'%,本期利润率为'.number_format($profit_rate,2).'%');
	    $output->writeln('本期总利润为'.number_format($betAmount-$zjAmount,2));	     	
    }

    public function runPageLottery($bets){

        foreach ($bets as $row) {

            $played = $this->playeds[$row['playedId']];
            $func = $played['ruleFun'];    

            $id         = $row['id'];
            $actionData = $row['actionData'] ;   //投注号码
            $kjData     = $this->kjData; 	//开奖号码
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

            if($is_kqwf){
                //目前 混合玩法 的 各子玩法 不支持 和局处理;
                if(-1 == $zjcount){//快钱玩法 存在 和局, 退还本金
                    $actionNum = $row['actionNum'] ;
                    $zjAmount = $actionNum*$money;
                    $zjcount = 0;
                }

                if($zjcount>0){
                    $zjAmount = $zjcount*$odd*$money;
                }                              
            }else{
                //混合玩法返回各相关玩法的中奖次数;
                if($is_mix){
                    $mix_result = Played::where('id','in',$mix_ids)->select();

                    $fanDianMax = $this->fanDianMax;
                    foreach($mix_result as $mix_row){
                        $prop = $mix_row['bonusProp'];
                        $base = $mix_row['bonusPropBase'];
                        $convertBlMoney = ($prop - $base) / $fanDianMax;
                        $pl = ($prop - $fanDian * $convertBlMoney);
                        $mix_pls[] = round($pl,2);
                    }

                    $count_sum = 0;//总中奖次数
                    foreach ($mix_pls as $key => $pl) {
                        $count = $zjcount[$key];
                        $zjAmount += $count*$pl*$money/2;
                        $count_sum += $count;
                    }
                    
                    $zjcount = $count_sum;
                }else{
                    //普通玩法
                    $zjAmount = $zjcount*$odd*$money/2;
                }
            }

            $zjcount = (int)$zjcount;
            $zjAmount = round($zjAmount,2);

        	$this->betCount += $row['actionNum'];           
        	$this->betAmount += $row->bet_money;
		    $this->zjCount += $zjcount;
			$this->zjAmount += $zjAmount;        	       
        }
    }    
}
