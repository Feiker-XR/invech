<?php
include_once 'include.php';
include_once($db_path."mysqlis.php");

function cancelBet($status,$bid,$uid,$msg_title,$msg_info,$why=''){ //注单状态值，注单编号
    
    global $mysqli;
    $sql	=	"update k_bet,k_user set k_bet.lose_ok=1,k_bet.status=$status,k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.update_time='".date('Y-m-d H:i:s')."',k_bet.match_endtime='".date('Y-m-d H:i:s')."',k_bet.sys_about='$why' where k_user.uid=k_bet.uid and k_bet.bid=$bid and k_bet.status=0";
    $mysqli->autocommit(FALSE);
    $mysqli->query("BEGIN"); //事务开始
    try{
        $mysqli->query($sql);
        $q1		=	$mysqli->affected_rows;
        if($q1 == 2){
            $mysqli->commit(); //事务提交
            
            $sql	=	"insert into k_user_msg(uid,msg_from,msg_title,msg_info) values ($uid,'结算中心','$msg_title','$msg_info')";
            $mysqli->autocommit(FALSE);
            $mysqli->query("BEGIN"); //事务开始
            try{
                $mysqli->query($sql);
                $q1		=	$mysqli->affected_rows;
                if($q1 == 1){
                    $mysqli->commit(); //事务提交
                }else{
                    $mysqli->rollback(); //数据回滚
                }
            }catch(Exception $e){
                $mysqli->rollback(); //数据回滚
            }
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

function setOK($bid){ //审核通过
    
    global $mysqli;
    $sql 	= "update k_bet set lose_ok=1,match_endtime='".date('Y-m-d H:i:s')."' where bid=$bid and lose_ok=0";
    $mysqli->autocommit(FALSE);
    $mysqli->query("BEGIN"); //事务开始
    try{
        $mysqli->query($sql);
        $q1		=	$mysqli->affected_rows;
        if($q1 == 1){
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

$sql	= "select match_nowscore,match_id,bid,uid,master_guest,bet_info,Match_GRedCard,Match_HRedCard,bet_money from k_bet where lose_ok=0 and bet_time<=DATE_SUB('".date('Y-m-d H:i:s')."',INTERVAL 90 SECOND) and bet_time>=DATE_SUB('".date('Y-m-d H:i:s')."',INTERVAL 150 SECOND)  order by bid  desc ";
echo $sql,"\r\n";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
$msg 	=	date("Y-m-d H:i:s")."<p />"; //本次处理信息结果
if(!$rows){
    $msg.=	"本次无滚球注单判断";
}else{
    include_once(dirname(__FILE__)."/../../runtime/cache/zqgq.php"); //加载足球滚球缓存文件
    
    $bet		=	array();
    $arr		=	array();
    $match_id	=	"";
    $num		=	0;
    do{
        $bet[$rows["bid"]]["uid"] 				=	$rows["uid"];
        $bet[$rows["bid"]]["match_id"] 			=	$rows["match_id"];
        $bet[$rows["bid"]]["bet_info"] 			=	$rows["bet_info"];
        $bet[$rows["bid"]]["master_guest"] 		=	$rows["master_guest"];
        $bet[$rows["bid"]]["Match_HRedCard"] 	=	$rows["Match_HRedCard"];
        $bet[$rows["bid"]]["Match_GRedCard"] 	=	$rows["Match_GRedCard"];
        $bet[$rows["bid"]]["match_nowscore"] 	=	$rows["match_nowscore"];
        $bet[$rows["bid"]]["bet_money"] 	    =	$rows["bet_money"];
        
        $bool = true; //默认赛事已结束
        for($i=0; $i<$count; $i++){
            if($zqgq[$i]['Match_ID'] == $rows["match_id"]){
                $arr[$num]['i']		= $i; //zqgq 数组的 i 下标
                $arr[$num]['bid']	= $rows["bid"]; //bet 数组的 bid 下标
                $bool				= false; //赛事未结束
                $num++;
                break;
            }
        }
        if($bool) $match_id .= $rows["match_id"].",";
        
    }while($rows = $query->fetch_array());
    
    for($i=0; $i<$num; $i++){ //判断缓存文件的赛事
        $bool = $msg_t	=	'';
        if($bet[$arr[$i]['bid']]["match_nowscore"] == $zqgq[$arr[$i]['i']]['Match_NowScore']){ //比分未改变
            if($bet[$arr[$i]['bid']]["Match_HRedCard"]!=$zqgq[$arr[$i]['i']]['Match_HRedCard'] || $bet[$arr[$i]['bid']]["Match_GRedCard"]!=$zqgq[$arr[$i]['i']]['Match_GRedCard']){ //主队或客队红牌，红牌无效
                $msg_t 	=	'滚球注单红卡无效';
                $bool  	=	cancelBet(7,$arr[$i]['bid'],$bet[$arr[$i]['bid']]["uid"],$bet[$arr[$i]['bid']]["master_guest"]."_注单已取消",$bet[$arr[$i]['bid']]["master_guest"].'<br/>'.$bet[$arr[$i]['bid']]["bet_info"].'<br /><font style="color:#F00"/>因红卡无效，该注单取消,已返还本金。</font>','红卡无效');
            }else{ //注单有效
                $msg_t 	=	'滚球注单有效';
                $bool	=	setOK($arr[$i]['bid']);
            }
        }else{ //比分已改变，进球无效
            $msg_t		=	'滚球注单进球无效';
            $bool 		=	cancelBet(6,$arr[$i]['bid'],$bet[$arr[$i]['bid']]["uid"],$bet[$arr[$i]['bid']]["master_guest"]."_注单已取消",$bet[$arr[$i]['bid']]["master_guest"].'<br/>'.$bet[$arr[$i]['bid']]["bet_info"].'<br /><font style="color:#F00"/>因进球无效，该注单取消,已返还本金。</font>','进球无效');
        }
        
        if($bool){
            /*写入日志文件*/
            $d 			=	date('Y-m-d');
            $filename 	=	dirname(__FILE__).'/../../runtime/cache/'.$d.'.txt';
            $somecontent=	"[".date('Y-m-d H:i:s')."]   管理员".$_SESSION["login_name"]."审核了编号为".$arr[$i]['bid']."的".$msg_t."  投注金额[".$bet[$arr[$i]['bid']]["bet_money"]."]\r\n";
            $handle = fopen($filename, 'a');
            if (fwrite($handle, $somecontent) === FALSE) {
                exit;
            }
            fclose($handle);
            
            $msg .= "<font color='#0000FF'>审核了编号为".$arr[$i]['bid']."的".$msg_t."</font><br />";;
        }
    }
    
    
    if($match_id){ //有赛事已结束，需要从数据库中读取
        $match_id 	=	rtrim($match_id,",");
        $sql		=	"select Match_HRedCard,Match_GRedCard,Match_NowScore,Match_ID,Match_LstTime from bet_match where Match_Type=2 and Match_ID in($match_id)";
        $query		=	$mysqlis->query($sql);
        while($rows =	$query->fetch_array()){
            foreach($bet as $k=>$v){
                $money = $v["bet_money"];
                if($v["match_id"] == $rows["Match_ID"]){ //有注单用户下了这场赛事
                    
                    $bool = $msg_t	=	'';
                    if($v["match_nowscore"] == $rows["Match_NowScore"]){ //比分未改变
                        if($rows["Match_HRedCard"]!=$v["Match_HRedCard"] || $rows["Match_GRedCard"]!=$v["Match_GRedCard"]){ //主队或客队红牌，红牌无效
                            $msg_t 	=	'滚球注单红卡无效';
                            $bool  	=	cancelBet(7,$k,$v["uid"],$v["master_guest"]."_注单已取消",$v["master_guest"].'<br/>'.$v["bet_info"].'<br /><font style="color:#F00"/>因红卡无效，该注单取消,已返还本金。</font>','红卡无效');
                        }else{ //注单有效
                            $msg_t 	=	'滚球注单有效';
                            $bool	=	setOK($k);
                        }
                    }else{ //比分已改变，进球无效
                        $msg_t		=	'滚球注单进球无效';
                        $bool		=	cancelBet(6,$k,$v["uid"],$v["master_guest"]."_注单已取消",$v["master_guest"].'<br/>'.$v["bet_info"].'<br /><font style="color:#F00"/>因进球无效，该注单取消,已返还本金。</font>','进球无效');
                    }
                    
                    if($bool){
                        /*写入日志文件*/
                        $d			=	date('Y-m-d');
                        $filename	=	dirname(__FILE__).'/../../runtime/cache/'.$d.'.txt';
                        $somecontent=	"[".date('Y-m-d H:i:s')."]   管理员".$_SESSION["login_name"]."审核了编号为".$k."的".$msg_t."  投注金额[".$money."]\r\n";
                        $handle = fopen($filename, 'a');
                        if (fwrite($handle, $somecontent) === FALSE) {
                            exit;
                        }
                        fclose($handle);
                        
                        $msg .= "<font color='#0000FF'>审核了编号为".$k."的".$msg_t."</font><br />";
                        unset($bet[$k]);
                    }
                }
            }
        }
    }
}
echo $msg;
?>