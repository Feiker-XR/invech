<?php
include_once("../common/login_check.php");
check_quanxian("sgjzd");
header("Content-type: text/html; charset=utf-8");
include_once("../../include/mysqli.php");
include_once("../../include/mysqlis.php");

$x_ic		=	$result	=	'';
$str		=	"结算失败";
$sql		=	"select x_result,x_id from t_guanjun where match_id='".$_GET["match_id"]."'"; //取出要经结算的赛事
$query		=	$mysqlis->query($sql);
while($row	=	$query->fetch_array()){
	$x_id	=	$row["x_id"];
	$result	=	$row["x_result"];
}

if($result){ //有比分结果赛事数据
	$sql		=	"select bid,bet_info from k_bet where bid='".$_GET["bid"]."' and `status`=0"; //取出的注单
	$query		=	$mysqli->query($sql);
	while($row	=	$query->fetch_array()){
		$sql	=	"";
		$bool	=	0;
		$jg		=	explode("<br>",$result);
		for($i=0;$i<count($jg);$i++){
			if(strrpos($row["bet_info"],$jg[$i])===0){
				$bool	=	1;
				break;
			}
		}
		if($bool){ //赢
			$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_win+k_bet.bet_money/100,k_bet.win=k_bet.bet_win,k_bet.status=1,k_bet.update_time=now() where k_user.uid=k_bet.uid and k_bet.bid=".$row["bid"];
            $msg	=	"审核了编号为".$row["bid"]."的注单,设为赢";
		}else{ //输
			$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money/100,status=2,update_time=now() where k_user.uid=k_bet.uid and k_bet.bid=".$row["bid"];
   			$msg	=	"审核了编号为".$row["bid"]."的注单,设为输";
		}
		
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			if($mysqli->affected_rows){
				$mysqli->commit(); //事务提交
				
				$mysqlio->query("insert into sys_log(uid,log_info,log_ip) values('".$_SESSION["adminid"]."','$msg','".$_SERVER['REMOTE_ADDR']."')");
				$str	=	"结算成功！";
			}else{
				$mysqli->rollback(); //数据回滚
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
		}
	}
}else{
	$str	=	"赛事未设置结果，不能结算！\\n请设置完赛事结果，再来结算本注单！";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置结算比分</title>
<script language="javascript">
function refash()
{
var win = top.window;
 try{// 刷新.
  	if(win.opener)  win.opener.location.reload();
 }catch(ex){
  // 防止opener被关闭时代码异常。
 }
  window.close();
}
</script>
</head>
<body>
<?php
echo "<script>alert('".$str."'),refash();</script>";
?>
</body>
</html>