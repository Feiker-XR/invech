<?php
include_once("../common/login_check.php");
check_quanxian("zdgl");
include_once("../../include/mysqli.php");

$msg	=	'操作失败';

if($_GET['action']==1){
	$gid	=	$_GET['gid'];
	$sql	=	"update k_bet_cg_group set cg_count=cg_count-1 where gid='$gid' and cg_count>0";
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1	=	$mysqli->affected_rows;
		if($q1>0){
			$mysqli->commit(); //事务提交
			$msg	=	'操作成功';
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
}else{
	$msg	=	'参数错误';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>串关减一操作</title>
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
<script>alert('<?=$msg?>'),refash();</script>
</body>
</html>