<?php
namespace app\logic;
use think\Db;

class bet{
    static function set($bid,$status,$mb_inball=NULL,$tg_inball=NULL){ //审核当前投注项1，2， 4，5 赢，输，赢一半，输一半
        $betinfo = Db::table('k_bet')->where('bid','eq',$bid)->find();
        $userinfo = Db::table('k_user')->where('uid','eq',$betinfo['uid'])->find();
        $bet_time = date("Y-m-d",strtotime($bet_time['bet_time']));
        $log = [];
        $log['m_order']   = 'PCS'.$bid;
        $log['uid']     = $userinfo['uid'];
        $log['q_qian']  = $userinfo['money'];
        $log['status']  = '1';
        $log['m_make_time'] = date('Y-m-d H:i:s');
        $log['type'] = '400';
		$sql	=	"";
		$msg	=	"";
    	switch ($status){
    		case "1": //赢
    			$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_win,k_bet.win=k_bet.bet_win,k_bet.status=1 ,k_bet.update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
                $msg	=	"审核了编号为".$bid."的注单,设为赢";
                $log['m_value'] = $betinfo['bet_win'];
                $log['h_qian'] = $log['q_qian'] + $log['m_value'];
                $log['about'] = '体育订单号:'.$bid.'全赢,派彩金额:'.$log['m_value'];
				break; 
   			case "2": //输
   				$sql	=	"update k_bet set status=2,update_time=now(),MB_Inball='$mb_inball',TG_Inball='$tg_inball' where bid=$bid and status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为输";
   				break;
   		    case "3": //无效或取消
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.status=3,k_bet.update_time=now(),k_bet.sys_about='批量无效',k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为取消";
   				$log['m_value'] = $betinfo['bet_money'];
   				$log['h_qian'] = $log['q_qian'] + $log['m_value'];
   				$log['about'] = '体育订单号:'.$bid.'取消,返回金额:'.$log['m_value'];
   				$log['type'] = 700;
   				break;
		    case "4": //赢一半
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money+((k_bet.bet_money/2)*k_bet.bet_point),k_bet.win=k_bet.bet_money+((k_bet.bet_money/2)*k_bet.bet_point),k_bet.status=4 ,k_bet.update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为赢一半";
   				$log['m_value'] = $betinfo['bet_money'] + ($betinfo['bet_money']/2)*$betinfo['bet_point'];
   				$log['h_qian'] = $log['q_qian'] + $log['m_value'];
   				$log['about'] = '体育订单号:'.$bid.'赢一半,派彩金额:'.$log['m_value'];
   				$log['type'] = 700;
   				break;
			case "5": //输一半
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+(k_bet.bet_money/2),k_bet.win=k_bet.bet_money/2,k_bet.status=5,k_bet.update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
				$msg	=	"审核了编号为".$bid."的注单,设为输一半";
				$log['m_value'] = $betinfo['bet_money']/2;
				$log['h_qian'] = $log['q_qian'] + $log['m_value'];
				$log['about'] = '体育订单号:'.$bid.'输一半,派彩金额:'.$log['m_value'];
				$log['type'] = 700;
   				break;
   		    case "8": //和局
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.status=8,k_bet.update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为和";
   				$msg	=	"审核了编号为".$bid."的注单,设为赢一半";
   				$log['m_value'] = $betinfo['bet_money'];
   				$log['h_qian'] = $log['q_qian'] + $log['m_value'];
   				$log['about'] = '体育订单号:'.$bid.'和局,返回金额:'.$log['m_value'];
   				$log['type'] = 700;
   				break;
   			
			default:break;
    	}

		Db::startTrans();//事务开始
		try{
			$q1	= Db::execute($sql);	
			if($status != 3 || $status != 8){
			    if($status != 2){
			        Db::table('k_money') -> insert($log);
			    }
			    $sql = "update k_user set liushui = liushui + {$betinfo['bet_money']} where uid = {$userinfo['uid']} ";
			    Db::query($sql);
			    $sql = "select * from web_report where platform = 'self' and gametype ='sport' and uid = '{$userinfo['uid']}' and `date` = '$bet_time'";
			    $query = Db::query($sql);
			    if($query){
			        $sql = "update web_report set bet = bet + {$betinfo['bet_money']},payout = payout + {$log['m_value']} ";
			        $sql .= "where uid ={$userinfo['uid']},platform='self',gametype='sport',`date` = '$bet_time'";
			    }else{
			        $sql = 'insert into web report (uid,platform,gametype,bet,payout,`date`) values (';
			        $sql .= "'{$userinfo['uid']}','self','sport',{$betinfo['bet_money']},{$log['m_value']},'$bet_time')";
			    }
			}
			
			if($q1 !== false){
				Db::commit();   //事务提交
				sys_log_remote_addr(session('adminid'),$msg);		
				return  true;
			}else{
				Db::rollback(); //数据回滚
				return  false;
			}
		}catch(Exception $e){
			Db::rollback(); //数据回滚
			return  false;
		}
    }
	
	static function set_cg($bid,$status,$mb_inball=NULL,$tg_inball=NULL){ //设置串关


		//$sql		=	"select gid,ben_add,bet_point from k_bet_cg where bid=".$bid;
		$rows = Db::table('k_bet_cg')->where('bid',$bid)->field('gid,ben_add,bet_point')->find();
		$ben_add	=	$rows["ben_add"];
		$bet_point	=	$rows["bet_point"]; //获得赔率计算
		$gid		=	$rows["gid"];
		$q1			=	$q2	=	false;

		
		Db::startTrans(); //事务开始
		try{
			switch($status){
			
				case 1: //注单设为赢
					$sql			=	"update k_bet_cg set status=1,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$q1	= Db::execute($sql);					
					if($q1 !== false){
						$log_msg	=	"把串关单式注单编号为".$bid."设为赢";
						$show_msg	=	"单式编号".$bid."审核完成";
					}else {
						$show_msg	=	"串关单式编号".$bid."审核出错";
						break;
					}
					
					//$sql			=	"select win,bet_money from k_bet_cg_group where gid=$gid and `status`=0";
					$rows = Db::table('k_bet_cg_group')->where('gid',$gid)->where('status',0)->field('win,bet_money')->find();
					$win			=	$rows["win"];
					$bet_money		=	$rows["bet_money"];
					$point			=	$ben_add+$bet_point;
					if($win			==	0){ //如果该组第一次结算
						$win		=	$bet_money*$point;	
					}else{ //第二次结算
						$win		=	$win*$point;
					}
			  
					$sql			=	"update k_bet_cg_group set win=$win where gid=$gid"; //金额设置
					$q2	= Db::execute($sql);
					if($q2 === false){
						$show_msg  .=	"串关组中加钱出现错误";
					}
					break;
					
				case 2://输
			  
					$sql			=	"update k_bet_cg set status=2,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$q1	= Db::execute($sql);					
					if($q1 !== false){
						$log_msg	=	"把串关单式注单编号为".$bid."设为输";
						$show_msg	=	"单式编号".$bid."审核完成";
					}else {
						$msg		=	"串关单式编号".$bid."审核出错";
						break;
					}
			  
					$sql			=	"update k_bet_cg_group set win=0,status=2 where gid=$gid";
					$q2	= Db::execute($sql);	
					break;					
				case 3: //无效
			  
					$sql			=	"update k_bet_cg set status=3,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$q1	= Db::execute($sql);					
					if($q1 !== false){
						$log_msg	=	"把注单编号为".$bid."的串关单式设为无效";
						$show_msg	=	"设为无效操作完成";
					}else{
						$show_msg	=	"串关单式编号".$bid."审核出错";
						break;
					}
					
					$sql			=	"update k_bet_cg_group set cg_count=cg_count-1 where gid=$gid";
					$q2	= Db::execute($sql);
					if($q2 === false){
						$show_msg  .=	"减1过程中出现错误";
					}
					break;
			  
				case 4://赢一半
			  
					$sql			=	"update k_bet_cg set status=4,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$q1	= Db::execute($sql);					
					if($q1 !== false){
						$log_msg	=	"把注单编号为".$bid."的串关单式设为赢一半";
						$show_msg	=	"设为赢一半操作完成";
					}else{
						$show_msg	=	"串关单式编号".$bid."审核出错";
						break;
					}
					//$sql			=	"select win,bet_money from k_bet_cg_group where gid=$gid and `status`=0";
					$rows = Db::table('k_bet_cg_group')->where('gid',$gid)->where('status',0)->field('win,bet_money')->find();
					$win			=	$rows["win"];
					$bet_money		=	$rows["bet_money"];
					$point			=	1+$bet_point/2;
					if($win			==	0){ //如果该组第一次结算
						$win		=	$bet_money*$point;	
					}else{ //第二次结算
						$win		=	$win*$point;
					}
			  
					$sql			=	"update k_bet_cg_group set win=$win where gid=$gid and `status`=0";
					$q2	= Db::execute($sql);
					if($q2 === false){
						$show_msg  .=	"加钱过程中出现错误，该组串关已结算";
					}
					break;
			  
				case 5://输一半
			  
					$sql			=	"update k_bet_cg set status=5,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$q1	= Db::execute($sql);
					if($q1 !== false){
						$log_msg	=	"把注单编号为".$bid."的串关单式设为输一半";
						$show_msg	=	"设为输一半操作完成";
					}else{
						$msg		=	"串关单式编号".$bid."审核出错";
						break;
					}
					//$sql			=	"select win,bet_money from k_bet_cg_group where gid=$gid and `status`=0";
					$rows = Db::table('k_bet_cg_group')->where('gid',$gid)->where('status',0)->field('win,bet_money')->find();
					$win			=	$rows["win"];
					$bet_money		=	$rows["bet_money"];
					$point			=	0.5;
					if($win			==	0){ //如果该组第一次结算
						$win		=	$bet_money*$point;	
					}else{ //第二次结算
						$win		=	$win*$point;
					}
			  
					$sql			=	"update k_bet_cg_group set win=$win where gid=$gid and `status`=0";
					$q2	= Db::execute($sql);
					if($q2 === false){
						$show_msg  .=	"加钱过程中出现错误，该组串关已结算";
					}
					break; 
			  
				case 8: //平手
			  
					$sql			=	"update k_bet_cg set status=8,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$q1	= Db::execute($sql);
					if($q1 !== false){
						$log_msg	=	"把注单编号为".$bid."的串关单式设为平手";
						$show_msg	=	"设为平手操作完成";
					}else{
						$show_msg	=	"串关单式编号".$bid."审核出错";
						break;
					}
					$q2 = true;
					break; 
				
					
				default:break;
			}
		 	
			//if($q1 && $q2){
				Db::commit();   //事务提交				
				if(isset($log_msg)){
					sys_log_remote_addr(session('adminid'),$log_msg);
				}
				return  true;
			//}else{
				//Db::rollback(); //数据回滚
				//return  false;
			//}
		}catch(Exception $e){
			Db::rollback(); //数据回滚
			return  false;
		}
	}
	
	/**
	 * 单式重新结算
	 * @param string $bid
	 * @param integer $status
	 * @return boolean
	 */
	static function qx_bet($bid,$status){ //
	    $betinfo = Db::table('k_bet')->where('bid','eq',$bid)->find();
	    $userinfo = Db::table('k_user')->where('uid','eq',$betinfo['uid'])->find();
	    $bet_time = date("Y-m-d");
		$money		=	0;
		if($status==1 || $status==2 || $status==4 || $status==5){ //有退水
			//$sql	=	"select bet_money from k_bet where bid=$bid";
			$row = Db::table('k_bet')->where('bid',$bid)->field('bet_money')->find();
		}
		
		Db::startTrans();//事务开始
		try{
		    //$sql = "select win from k_bet where bid = $bid";
			$row = Db::table('k_bet')->where('bid',$bid)->field('win')->find();
		    $winNum = ($row['win']);
		    if($winNum != 0){
		        $sql		=	"update k_bet,k_user set k_user.money=k_user.money-k_bet.win where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status>0";
				$q1	= Db::execute($sql);
				$sql ="update web_report set bet=bet - {$betinfo['money']}, payout = payout - {$betinfo['win']}";
				$sql .= " where uid = {$userinfo['uid']},platform ='self',gametype='sport',`date`='$bet_time'";
				Db::query($sql);
				$sql = "update k_user set liushui = liushui - {$betinfo['money']} where uid = {$userinfo['uid']}";
				Db::query($sql);
		    }else{
		        $q1 = 1;
		    }
			
			
			$sql		=	"update k_bet set status=0,win=0,update_time=null,fs=0 where k_bet.bid=$bid and k_bet.status>0";
			$q2	= Db::execute($sql);
			
			if($q1==1 && $q2==1){
				Db::commit();   //事务提交			
				return true;
			}else{
				Db::rollback(); //数据回滚
				return false;
			}
		}catch(\Exception $e){
				Db::rollback(); //数据回滚
			return false;
		}
	}
	
	/**
	 * 串关重新结算
	 * @param unknown $bid
	 * @return boolean
	 */
	static function qx_cgbet($bid){ 
		
		//$sql		=	"select cg.status,cgg.gid,cgg.status as status_cgg,cg.bet_point,cg.match_id,cg.ben_add,cgg.win,cgg.uid,cgg.bet_money,cgg.fs from k_bet_cg cg,k_bet_cg_group cgg where cg.status>0 and cg.gid=cgg.gid and cg.bid=$bid";
		
		$t = Db::table('k_bet_cg')
        ->alias('cg')
        ->join('k_bet_cg_group cgg','cg.gid=cgg.gid')
		->where('cg.status','>',0)
		->where('cg.bid',$bid)
		->field('cg.status,cgg.gid,cgg.status as status_cgg,cg.bet_point,cg.match_id,cg.ben_add,cgg.win,cgg.uid,cgg.bet_money,cgg.fs')->find();

		//$rows = Db::query($sql);
		//$t = $rows[0];

		$status_cgg	=	$t["status_cgg"];
		$status		=	$t["status"];
		$gid		=	$t["gid"];
		$win		=	$t["win"];
		$uid		=	$t["uid"];
		$ben_add	=	$t["ben_add"];
		$bet_point	=	$t["bet_point"];
		$ts_money	=	$t["fs"];
		$mid		=	$t["match_id"];
		
		$b1	=	$b3	=	$b4	=	$b6	=	false;
			
		Db::startTrans();//事务开始
		try{
			if($status_cgg == 1){ //已结算，扣相应的钱，并设为未结算
				$b1		=	true;
				$sql	=	"select count(gid) as s from k_bet_cg where gid=$gid and status=2 and bid!=$bid";

				$rows = Db::query($sql);
				$t = $rows[0];
				
				if($t["s"] > 0){  ///判断子项中是否有输的
					$sql=	"update k_user,k_bet_cg_group set k_user.money=k_user.money-k_bet_cg_group.win,k_bet_cg_group.status=2 where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid";
				}else{
					$sql=	"update k_user,k_bet_cg_group set k_user.money=k_user.money-k_bet_cg_group.win,k_bet_cg_group.status=0 where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid";
				}		
				$q1 = Db::execute($sql);				
			}elseif($status_cgg	== 3){     ////如果状态等于3,说明该串关全是平手或无效,则把状态设为0,且扣去相应的钱..
				$b1		=	true;
				$sql	=	"update k_user,k_bet_cg_group set k_user.money=k_user.money-k_bet_cg_group.win,k_bet_cg_group.status=0,k_bet_cg_group.win=0 where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid";
				$win	=	0;
				$q1 = Db::execute($sql);
			}
			
			$sql		=	"update k_bet_cg set status=0 where bid=$bid";
			$q3 = Db::execute($sql);

			$sql		=	"update k_bet_cg_group set update_time=null,fs=0 where gid=$gid"; //更新时间设为空
			Db::execute($sql);
			
			if($status == 2){
				$sql	=	"update k_bet_cg_group g set g.status=0 where g.cg_count=(select count(b.gid) from k_bet_cg b where b.gid=g.gid and b.status!=2) and g.gid=$gid";
				Db::execute($sql);
				$sql 	=	"select status,gid,ben_add,bet_point from k_bet_cg where gid=$gid and status not in(0,3,6,7,8) and  bid!=$bid";
				//$query	=	$mysqli->query($sql);				
				//while($infos	=	$query->fetch_array()){
				$rows = Db::query($sql);
				foreach ($rows as $infos) {
					$benadd		=	$infos["ben_add"];
					$betpoint	=	$infos["bet_point"]; //获得赔率计算
					$gid		=	$infos["gid"];
					
					//$sql		=	"select win,bet_money from k_bet_cg_group where gid=$gid and status=0";
					$tx = Db::table('k_bet_cg_group')
					->where('status',0)
					->where('gid',$gid)
					->field('win,bet_money')->find();

					$txwin		=	$tx["win"];
					$betmoney	=	$tx["bet_money"];
					$points		=	$benadd+$betpoint;
					
					if($infos["status"] == 1){
						if($txwin==0){ 				//如果该组第一次结算
							$txwin=$betmoney*$points;
						}else{						//第二次结算
							$txwin=$txwin*$points;
						}
						
						$sql="update k_bet_cg_group set win=$txwin where gid=$gid and status=0"; //金额设置
						Db::execute($sql);
					}		
						
					if($infos["status"] == 2){
						$sql="update k_bet_cg_group set win=0,status=2 where gid=$gid";
						Db::execute($sql);
					}			
						
					if($infos["status"] == 4){
						$points=1+$betpoint/2;
						
						if($txwin==0){ 				//如果该组第一次结算
							$txwin=$betmoney*$points;
						}else{						//第二次结算
							$txwin=$txwin*$points;
						}
						
						$sql="update k_bet_cg_group set win=$txwin where gid=$gid and status=0";
						Db::execute($sql);
					}			
						
					if($infos["status"] == 5){
						$points=0.5;
						
						if($txwin==0){ 				//如果该组第一次结算
							$txwin=$betmoney*$points;
						}else{						//第二次结算
							$txwin=$txwin*$points;
						}
						
						$sql="update k_bet_cg_group set win=$txwin where gid=$gid and status=0";
						Db::execute($sql);
					}
				}
			}else{
				if($status==1){  //赢
					$win	=	$win/($ben_add+$bet_point);
				}
				if($status==3){
					$b4		=	true;
					$win	=	$win;
					$sql	=	"update k_bet_cg_group set cg_count=cg_count+1 where gid=$gid";
					$q4		=	Db::execute($sql);
				}
				if($status==4){ //赢一半
					$win	=	$win*2/(1+$ben_add+$bet_point);
				}
				if($status==5){ //输一半
					$win	=	2*$win;
				}
				if($status==6){
					$b6		=	true;
					$sql	=	"update k_bet_cg set status=0 where bid=$bid";
					$q6_1	=	Db::execute($sql);
					$sql	=	"update k_bet_cg_group set status=0 where gid=$gid";
					$q6_2	=	Db::execute($sql);
					$win	=	0;
				}
				$sql		=	"update k_bet_cg_group set win=$win where gid=$gid";
				Db::execute($sql);
				$sql		=	"update k_bet_cg_group set win=0 where gid=$gid and (select count(bid) from k_bet_cg where gid=$gid and status>0)=0";
				Db::execute($sql);
				$sql		=	"update k_bet_cg_group set win=0 where gid=$gid and (select count(bid) from k_bet_cg where gid=$gid and bid!=$bid and status in(0,3,8))=(k_bet_cg_group.cg_count-1)";
				Db::execute($sql);
			}
			
			if($q3>0){
				while(1){
					if($b1){
						if($q1>0) $b3 = true;
						else{
							$b3		= false;
							break;
						}
					}
					if($b4){
						if($q4>0) $b3 = true;
						else{
							$b3		= false;
							break;
						}
					}
					if($b6){
						if($q6_1>0 && $q6_2>0) $b3 = true;
						else{
							$b3		= false;
							break;
						}
					}
					$b3 = true;
					break;
				}
			}
			
			if($b3){
				Db::commit(); //事务提交
				return true;
			}else{
				Db::rollback(); //数据回滚
				return false;
			}
		}catch(Exception $e){
			Db::rollback(); //数据回滚
			return false;
		}
	}
}
?>