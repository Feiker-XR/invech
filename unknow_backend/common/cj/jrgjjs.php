<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0

header("Content-type: text/html; charset=utf-8");
include_once("mysqlis.php");

$m			=	0;
$match_id	=	"";
$arr		=	array();

session_start();
if(intval(date('H'))<6)
{
	if($_SESSION["jrgjjs"]=="0")
	{
		$bdate=date('m-d',time());
		$_SESSION["jrgjjs"]="-1";
	}
	else
	{
		$bdate=date('m-d',time()-24*3600);
		$_SESSION["jrgjjs"]="0";
	}
}
else
{
	$bdate=date('m-d',time());
}

$sql		=	"select x_result,match_id from t_guanjun where match_date='$bdate' and x_result is not null"; //取出已经结算比分的赛事
$query		=	$mysqlis->query($sql);
while($row	=	$query->fetch_array()){
	$arr[$row["match_id"]]['jg']	=	$row["x_result"];
	$match_id	.=	$row["match_id"].',';
}

if($match_id){ //有比分结果赛事数据
	include_once("mysqli.php");
	include_once("function.php");
	$match_id	=	rtrim($match_id,',');
	$sql		=	"select bid,bet_info,match_id from k_bet where match_id in($match_id) and `status`=0"; //取出这些赛事未结算的注单
	$query		=	$mysqli->query($sql);
	while($row	=	$query->fetch_array()){
		$sql	=	"";
		$bool	=	0;
		$jg		=	trim(explode("<br>",$arr[$row["match_id"]]['jg']));
		for($i=0;$i<count($jg);$i++){
			if(strrpos($row["bet_info"],$jg[$i])===0){
				$bool	=	1;
				break;
			}
		}
		if($bool){ //赢
			//$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_win+k_bet.bet_money/100,k_bet.win=k_bet.bet_win,k_bet.status=1,k_bet.update_time=now() where k_user.uid=k_bet.uid and k_bet.bid=".$row["bid"];
			$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_win,k_bet.win=k_bet.bet_win,k_bet.status=1,k_bet.update_time=now() where k_user.uid=k_bet.uid and k_bet.bid=".$row["bid"];
            $msg	=	"审核了编号为".$row["bid"]."的注单,设为赢";
		}else{ //输
			//$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money/100,status=2,update_time=now() where k_user.uid=k_bet.uid and k_bet.bid=".$row["bid"];
			$sql	=	"update k_user,k_bet set k_user.money=k_user.money,status=2,update_time=now() where k_user.uid=k_bet.uid and k_bet.bid=".$row["bid"];
   			$msg	=	"审核了编号为".$row["bid"]."的注单,设为输";
		}
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			if($mysqli->affected_rows){
				$mysqli->commit(); //事务提交
				$mysqli->query("insert into sys_log(uid,log_info,log_ip) values('1','$msg','".$_SERVER['REMOTE_ADDR']."')");
				$m++;
			}else{
				$mysqli->rollback(); //数据回滚
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
		}
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
   <style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
-->
</style></head>
<script>
<!--
var limit="400"
if (document.images){
	var parselimit=limit
}
function beginrefresh(){
if (!document.images)
	return
if (parselimit==1)
	self.location.reload()
else{
	parselimit-=1
	curmin=Math.floor(parselimit)
	if (curmin!=0)
		curtime=curmin+"秒后获取数据！"
	else
		curtime=cursec+"秒后获取数据！"
		timeinfo.innerText=curtime
		setTimeout("beginrefresh()",1000)
	}
}

window.onload=beginrefresh

</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left">
    <input type=button name=button value="刷新" onClick="window.location.reload()">
    <?=$m?> 条金融冠军注单！
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
</body>
</html>