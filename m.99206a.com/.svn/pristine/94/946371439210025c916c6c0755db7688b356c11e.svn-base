<?php
class bet{
    static function set($bid,$status,$mb_inball=NULL,$tg_inball=NULL){ //审核当前投注项1，2， 4，5 赢，输，赢一半，输一半
        global $mysqli;
        global $mysqlio;
		$sql	=	"";
		$msg	=	"";
		$match_sql = "select * from k_bet where bid = '$bid'";
		$match_query = $mysqli->query($match_sql);
		$match_info = $match_query->fetch_array();
		$uid = $match_info['uid'];
		$bet_time = date('Y-m-d',strtotime($match_info['bet_time']));
		$bet_money = $match_info['bet_money'];
		$win = 0 ;
		
    	switch ($status){
    		case "1": //赢
    			$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_win,k_bet.win=k_bet.bet_win,k_bet.status=1 ,k_bet.update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
                $msg	=	"审核了编号为".$bid."的注单,设为赢";
                $win = $match_info['bet_win'];
				break; 
   			case "2": //输
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money,status=2,update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为输";
   				break;
   		    case "3": //无效或取消
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.status=3,k_bet.update_time=now(),k_bet.sys_about='批量无效',k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为取消";
   				break;
		    case "4": //赢一半
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money+((k_bet.bet_money/2)*k_bet.bet_point),k_bet.win=k_bet.bet_money+((k_bet.bet_money/2)*k_bet.bet_point),k_bet.status=4 ,k_bet.update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为赢一半";
   				$win = $match_info['bet_money'] + ($match_info['bet_money']/2)*$match_info['bet_point'];
   				break;
			case "5": //输一半
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+(k_bet.bet_money/2),k_bet.win=k_bet.bet_money/2,k_bet.status=5,k_bet.update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
				$msg	=	"审核了编号为".$bid."的注单,设为输一半";
				$win = $match_info['bet_money']/2; 
   				break;
   		    case "8": //和局
   				$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.status=8,k_bet.update_time=now(),k_bet.MB_Inball='$mb_inball',k_bet.TG_Inball='$tg_inball' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
   				$msg	=	"审核了编号为".$bid."的注单,设为和";
   				break;
   			
			default:break;
    	}
		
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1	=	$mysqli->affected_rows;
			if($status != 3 || $status != 8){
			    if($status != 2){
			        $user_query =$mysqli->query( "select * from k_user where uid = $uid");
			        $user_info = $user_query->fetch_array();
			        $m_order = 'PCS'.$bid;
			        $q_qian = $user_info['money'];
			        $m_make_time = date('Y-m-d H:i:s');
			        $h_qian = $q_qian +$win;
			        $about = '体育订单号:'.$bid.'全赢,派彩金额:'.$win;
			        $sql = "insert into k_money set (m_order,uid,q_qian,h_qian,m_value,status,m_make_time,type) values (";
			        $sql .= "'$m_order',$uid,$q_qian,$h_qian,$win,1,'$m_make_time',400)";
			        $mysqli->query($sql);
			    }
			    $sql = "update k_user set liushui = liushui + $bet_money where uid = $uid ";
			    $mysqli->query($sql);
			    
			    $reprot_query = $mysqli->query("select * from web_report where platform = 'self' and gametype ='sport' and uid = '$uid' and `date` = '$bet_time'");
			    if($reprot_query && $reprot_query->num_rows){
			        $sql = "update web_report set bet = bet + $bet_money,payout = payout + $win ";
			        $sql .= "where uid =$uid,platform='self',gametype='sport',`date` = '$bet_time'";
			    }else{
			        $sql = 'insert into web report (uid,platform,gametype,bet,payout,`date`) values (';
			        $sql .= "'$uid','self','sport',$bet_money,$win,'$bet_time')";
			    }
			    $mysqli -> query($sql);
			}
    	    
	
			if($q1 >= 0){
				$mysqli->commit(); //事务提交
				$mysqlio->query("insert into sys_log(uid,log_info,log_ip) values('".$_SESSION["adminid"]."','$msg','".$_SERVER['REMOTE_ADDR']."')");
				return  true;
			}else{
				$mysqli->rollback(); //数据回滚
				return  false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return  false;
		}
    }
	
	static function set_cg($bid,$status,$mb_inball=NULL,$tg_inball=NULL){ //设置串关
    	
		global $mysqli;
		global $mysqlio;
		$sql		=	"select gid,ben_add,bet_point from k_bet_cg where bid=".$bid;
		$query		=	$mysqli->query($sql);
		$rows 		=	$query->fetch_array();
		$ben_add	=	$rows["ben_add"];
		$bet_point	=	$rows["bet_point"]; //获得赔率计算
		$gid		=	$rows["gid"];
		$q1			=	$q2	=	true;
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			switch($status){
			
				case 1: //注单设为赢
					$sql			=	"update k_bet_cg set status=1,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$mysqli->query($sql);
					$q1				=	$mysqli->affected_rows;
					if($q1 == 1){
						$log_msg	=	"把串关单式注单编号为".$bid."设为赢";
						$show_msg	=	"单式编号".$bid."审核完成";
					}else {
						$show_msg	=	"串关单式编号".$bid."审核出错";
						break;
					}
					
					$sql			=	"select win,bet_money from k_bet_cg_group where gid=$gid and `status`=0";
					$query			=	$mysqli->query($sql);
					$rows 			=	$query->fetch_array();
					$win			=	$rows["win"];
					$bet_money		=	$rows["bet_money"];
					$point			=	$ben_add+$bet_point;
					if($win			==	0){ //如果该组第一次结算
						$win		=	$bet_money*$point;	
					}else{ //第二次结算
						$win		=	$win*$point;
					}
			  
					$sql			=	"update k_bet_cg_group set win=$win where gid=$gid"; //金额设置
					$mysqli->query($sql);
					$q2				=	$mysqli->affected_rows;
					if($q2 != 1){
						$show_msg  .=	"串关组中加钱出现错误";
					}
					break;
					
				case 2://输
			  
					$sql			=	"update k_bet_cg set status=2,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$mysqli->query($sql);
					$q1				=	$mysqli->affected_rows;
					if($q1 == 1){
						$log_msg	=	"把串关单式注单编号为".$bid."设为输";
						$show_msg	=	"单式编号".$bid."审核完成";
					}else {
						$msg		=	"串关单式编号".$bid."审核出错";
						break;
					}
			  
					$sql			=	"update k_bet_cg_group set win=0,status=2 where gid=$gid";
					$mysqli->query($sql);
					$q2				=	$mysqli->affected_rows;
					break;
					
				case 3: //无效
			  
					$sql			=	"update k_bet_cg set status=3,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$mysqli->query($sql);
					$q1				=	$mysqli->affected_rows;
					if($q1 == 1){
						$log_msg	=	"把注单编号为".$bid."的串关单式设为无效";
						$show_msg	=	"设为无效操作完成";
					}else{
						$show_msg	=	"串关单式编号".$bid."审核出错";
						break;
					}
					
					$sql			=	"update k_bet_cg_group set cg_count=cg_count-1 where gid=$gid";
					$mysqli->query($sql);
					$q2				=	$mysqli->affected_rows;
					if($q2 != 1){
						$show_msg  .=	"减1过程中出现错误";
					}
					break;
			  
				case 4://赢一半
			  
					$sql			=	"update k_bet_cg set status=4,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$mysqli->query($sql);
					$q1				=	$mysqli->affected_rows;
					if($q1 == 1){
						$log_msg	=	"把注单编号为".$bid."的串关单式设为赢一半";
						$show_msg	=	"设为赢一半操作完成";
					}else{
						$show_msg	=	"串关单式编号".$bid."审核出错";
						break;
					}
					$sql			=	"select win,bet_money from k_bet_cg_group where gid=$gid and `status`=0";
					$query			=	$mysqli->query($sql);
					$rows 			=	$query->fetch_array();
					$win			=	$rows["win"];
					$bet_money		=	$rows["bet_money"];
					$point			=	1+$bet_point/2;
					if($win			==	0){ //如果该组第一次结算
						$win		=	$bet_money*$point;	
					}else{ //第二次结算
						$win		=	$win*$point;
					}
			  
					$sql			=	"update k_bet_cg_group set win=$win where gid=$gid and `status`=0";
					$mysqli->query($sql);
					$q2				=	$mysqli->affected_rows;
					if($q2 != 1){
						$show_msg  .=	"加钱过程中出现错误，该组串关已结算";
					}
					break;
			  
				case 5://输一半
			  
					$sql			=	"update k_bet_cg set status=5,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$mysqli->query($sql);
					$q1				=	$mysqli->affected_rows;
					if($q1 == 1){
						$log_msg	=	"把注单编号为".$bid."的串关单式设为输一半";
						$show_msg	=	"设为输一半操作完成";
					}else{
						$msg		=	"串关单式编号".$bid."审核出错";
						break;
					}
					$sql			=	"select win,bet_money from k_bet_cg_group where gid=$gid and `status`=0";
					$query			=	$mysqli->query($sql);
					$rows 			=	$query->fetch_array();
					$win			=	$rows["win"];
					$bet_money		=	$rows["bet_money"];
					$point			=	0.5;
					if($win			==	0){ //如果该组第一次结算
						$win		=	$bet_money*$point;	
					}else{ //第二次结算
						$win		=	$win*$point;
					}
			  
					$sql			=	"update k_bet_cg_group set win=$win where gid=$gid and `status`=0";
					$mysqli->query($sql);
					$q2				=	$mysqli->affected_rows;
					if($q2 != 1){
						$show_msg  .=	"加钱过程中出现错误，该组串关已结算";
					}
					break; 
			  
				case 8: //平手
			  
					$sql			=	"update k_bet_cg set status=8,mb_inball=".$mb_inball.",tg_inball=".$tg_inball." where bid=$bid and status=0";
					$mysqli->query($sql);
					$q1				=	$mysqli->affected_rows;
					if($q1 == 1){
						$log_msg	=	"把注单编号为".$bid."的串关单式设为平手";
						$show_msg	=	"设为平手操作完成";
					}else{
						$show_msg	=	"串关单式编号".$bid."审核出错";
						break;
					}
					break; 
				
					
				default:break;
			}
		 	
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				if(isset($log_msg)){
					$mysqlio->query("insert into sys_log(uid,log_info,log_ip) values ('".$_SESSION["adminid"]."','".$log_msg."','".$_SERVER['REMOTE_ADDR']."')");
				}
				return  true;
			}else{
				$mysqli->rollback(); //数据回滚
				return  false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return  false;
		}
	}
	
	static function qx_bet($bid,$status){ //单式重新结算
    	
		global $mysqli;
		$money		=	0;
		if($status==1 || $status==2 || $status==4 || $status==5){ //有退水
			$sql	=	"select bet_money from k_bet where bid=$bid";
			$query	=	$mysqli->query($sql);
			$row 	=	$query->fetch_array();
			if($status	==1 || $status	==2){ //输赢
				$money	=	$row['bet_money']*0.01;
			}
			if($status	==4 || $status	==5){
				$money	=	$row['bet_money']*0.005;
			}
		}
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$sql		=	"update k_bet,k_user set k_user.money=k_user.money-k_bet.win-$money where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status>0";
			$mysqli->query($sql);
			$q1			=	$mysqli->affected_rows;
			$sql		=	"update k_bet set status=0,win=0,update_time=null,fs=0 where k_bet.bid=$bid and k_bet.status>0";
			$mysqli->query($sql);
			$q2			=	$mysqli->affected_rows;
			if($q1==1 && $q2==1){
				$mysqli->commit(); //事务提交
				return true;
			}else{
				$mysqli->rollback(); //数据回滚
				return false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return false;
		}
	}
	
	static function qx_cgbet($bid){ //串关重新结算
		
		global $mysqli;
		$sql		=	"select cg.status,cgg.gid,cgg.status as status_cgg,cg.bet_point,cg.match_id,cg.ben_add,cgg.win,cgg.uid,cgg.bet_money,cgg.fs from k_bet_cg cg,k_bet_cg_group cgg where cg.status>0 and cg.gid=cgg.gid and cg.bid=$bid";
		$query		=	$mysqli->query($sql);
		$t 			=	$query->fetch_array();
		
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
			
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			if($status_cgg == 1){ //已结算，扣相应的钱，并设为未结算
				$b1		=	true;
				$sql	=	"select count(gid) as s from k_bet_cg where gid=$gid and status=2 and bid!=$bid";
				$query	=	$mysqli->query($sql);
				$t 		=	$query->fetch_array();
				
				if($t["s"] > 0){  ///判断子项中是否有输的
					$sql=	"update k_user,k_bet_cg_group set k_user.money=k_user.money-k_bet_cg_group.win-$ts_money,k_bet_cg_group.status=2 where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid";
				}else{
					$sql=	"update k_user,k_bet_cg_group set k_user.money=k_user.money-k_bet_cg_group.win-$ts_money,k_bet_cg_group.status=0 where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid";
				}
				$mysqli->query($sql);
				$q1		=	$mysqli->affected_rows;
				
			}elseif($status_cgg	== 3){     ////如果状态等于3,说明该串关全是平手或无效,则把状态设为0,且扣去相应的钱..
				$b1		=	true;
				$sql	=	"update k_user,k_bet_cg_group set k_user.money=k_user.money-k_bet_cg_group.win,k_bet_cg_group.status=0,k_bet_cg_group.win=0 where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid";
				$win	=	0;
				$mysqli->query($sql);
				$q1		=	$mysqli->affected_rows;
			}
			
			$sql		=	"update k_bet_cg set status=0 where bid=$bid";
			$mysqli->query($sql);
			$q3			=	$mysqli->affected_rows;
			
			$sql		=	"update k_bet_cg_group set update_time=null,fs=0 where gid=$gid"; //更新时间设为空
			$mysqli->query($sql);
			
			if($status == 2){
				$sql	=	"update k_bet_cg_group g set g.status=0 where g.cg_count=(select count(b.gid) from k_bet_cg b where b.gid=g.gid and b.status!=2) and g.gid=$gid";
				$mysqli->query($sql);
				$sql 	=	"select status,gid,ben_add,bet_point from k_bet_cg where gid=$gid and status not in(0,3,6,7,8) and  bid!=$bid";
				$query	=	$mysqli->query($sql);
				
				while($infos	=	$query->fetch_array()){
					$benadd		=	$infos["ben_add"];
					$betpoint	=	$infos["bet_point"]; //获得赔率计算
					$gid		=	$infos["gid"];
					
					$sql		=	"select win,bet_money from k_bet_cg_group where gid=$gid and status=0";
					$query1		=	$mysqli->query($sql);
					$tx			=	$query1->fetch_array();
					
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
						$mysqli->query($sql);
					}		
						
					if($infos["status"] == 2){
						$sql="update k_bet_cg_group set win=0,status=2 where gid=$gid";
						$mysqli->query($sql);
					}			
						
					if($infos["status"] == 4){
						$points=1+$betpoint/2;
						
						if($txwin==0){ 				//如果该组第一次结算
							$txwin=$betmoney*$points;
						}else{						//第二次结算
							$txwin=$txwin*$points;
						}
						
						$sql="update k_bet_cg_group set win=$txwin where gid=$gid and status=0";
						$mysqli->query($sql);
					}			
						
					if($infos["status"] == 5){
						$points=0.5;
						
						if($txwin==0){ 				//如果该组第一次结算
							$txwin=$betmoney*$points;
						}else{						//第二次结算
							$txwin=$txwin*$points;
						}
						
						$sql="update k_bet_cg_group set win=$txwin where gid=$gid and status=0";
						$mysqli->query($sql);
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
					$mysqli->query($sql);
					$q4		=	$mysqli->affected_rows;
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
					$mysqli->query($sql);
					$q6_1	=	$mysqli->affected_rows;
					$sql	=	"update k_bet_cg_group set status=0 where gid=$gid";
					$mysqli->query($sql);
					$q6_2	=	$mysqli->affected_rows;
					$win	=	0;
				}
				$sql		=	"update k_bet_cg_group set win=$win where gid=$gid";
				$mysqli->query($sql);
				$sql		=	"update k_bet_cg_group set win=0 where gid=$gid and (select count(bid) from k_bet_cg where gid=$gid and status>0)=0";
				$mysqli->query($sql);
				$sql		=	"update k_bet_cg_group set win=0 where gid=$gid and (select count(bid) from k_bet_cg where gid=$gid and bid!=$bid and status in(0,3,8))=(k_bet_cg_group.cg_count-1)";
				$mysqli->query($sql);
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
				$mysqli->commit(); //事务提交
				return true;
			}else{
				$mysqli->rollback(); //数据回滚
				return false;
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			return false;
		}
	}
}
?>