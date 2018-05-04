<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Xyft extends Command
{
	static protected $lottery = '幸运飞艇';

    protected function configure()
    {
        $this->setName('xyft')->setDescription('结算'.self::$lottery);
    }

    protected function execute(Input $input, Output $output)
    {
        //$output->writeln("TestCommand:");
        include_once ROOT_PATH . 'caiji' . DS .'kaijiang' . DS . 'auto_class.php';
        include_once ROOT_PATH . 'caiji' . DS .'kaijiang' . DS . 'parse-calc-count.php';
        include_once ROOT_PATH . 'caiji' . DS .'kaijiang' . DS . 'xyft_suanfa.php';
	    
	    $perPage = config('command_per_page')??100;
	    	   
	    $rows = db('weijiesuan')->where('type',self::$lottery)->select();
	    foreach ($rows as $row) {

		    if (empty($row['qishu']))continue;

		    // 获取开奖号码
		    $rs = db('c_auto_9')->where('qishu',$row['qishu'])->order('id desc')->find();
		    if (! $rs) continue;
		    
		    // 根据期数读取未结算的注单
		    $where = ['type'=>self::$lottery,'js'=>0,'qishu'=>$row['qishu'],];
		    //$bets = db('c_bet')->where($where)->order('addtime')->select();
	        
	        $page = 1;	        
	        do{		    
	        	$bets = db('c_bet')->where($where)->order('addtime')->page($page,$perPage)->select();

	        	db()->startTrans();
			    foreach ($bets as $bet) {
			    	if($bet['gfwf']){
			    		$bet['ruleFun'] = db('gfwf_played')->where('id',$bet['playedId'])->value('ruleFun');
			    	}
			    	$ret = xyft_js($rs, $bet);
			    	if($ret){
			    		if($bet['gfwf']){//官方玩法中奖判定函数返回中奖次数;
			    			//输赢值计算:中奖次数*赔率*倍数*模式/2
			    			$win = $ret*$bet['odds']*$bet['beiShu']*$bet['mode']/2;
			    		}else{
							$win = $bet['win'];
			    		}

				        $user = db('k_user')->where('uid',$bet['uid'])->find();

		                $m_value = $win;
		                $m_order = 'XYFTPJ'.$bet['id'];
		                $uid = $bet['uid'];
		                $q_qian = $user['money'];
		                $h_qian = $user['money'] + $win;
		                $status = 1;
		                $m_make_time = date('Y-m-d H:i:s');
		                $about = self::$lottery.'派奖,订单号:'.$bet['did'].',金额:'.$win;
		                $type  = 400;

		                $data = [
		                	'm_order'=>$m_order,
		                	'uid'=>$uid,
		                	'm_value'=>$m_value,
		                	'q_qian'=>$q_qian,
		                	'h_qian'=>$h_qian,
		                	'status'=>$status,
		                	'm_make_time'=>$m_make_time,
		                	'about'=>$about,
		                	'type'=>$type
		                ];
		                db('k_money')->insert($data);

		                db('k_user')->where('uid',$bet['uid'])->inc('money',$win);

			    		db('c_bet')->where('id',$bet['id'])->update(['js'=>1,'win'=>$win,'zjCount'=>(int)$ret,]);
			    	}else{
			    		//$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			    		db('c_bet')->where('id',$bet['id'])->update(['win'=>0,'js'=>1]);
			    	}
			    }
			    db()->commit();

	            //$page++;
	            $count = count($bets);
	        }while($count==$perPage);

		    db('c_auto_9')->where('qishu',$row['qishu'])->update(['ok'=>1,]);
		    db('weijiesuan')->where('type',self::$lottery)->where('qishu',$row['qishu'])->delete();		        			    
	    }
    }
}
