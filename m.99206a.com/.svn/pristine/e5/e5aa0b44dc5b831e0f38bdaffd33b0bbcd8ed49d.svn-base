<?php
include_once("../common/login_check.php");
check_quanxian("sgjzd");
include_once("../../include/mysqli.php");
include_once("../../class/bet.php");

$bid		=	intval($_GET["bid"]);
$status		=	intval($_GET["status"]);
$mb_inball	=	$_GET['MB_Inball'];
$tg_inball	=	$_GET['TG_Inball'];
$bool		=	bet::set_cg($bid,$status,$mb_inball,$tg_inball);
$show_msg	=	'';
if($bool){
	$show_msg	=	'操作成功';
}else{
	$show_msg	=	'操作失败';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>串关单场比赛结算</title>

<script language="javascript">

function refash()
{

var win = top.window;
 try{
       // 刷新.
  if(win.opener)  win.opener.location.reload();
 }catch(ex){
  // 防止opener被关闭时代码异常。
 }
  window.close();
}

<?php
echo "alert('$show_msg');";
if($status!=3&&$status!=6) echo "refash();";
else echo "location.href='".$_SERVER['HTTP_REFERER']."';";
?>
</script>

</head>

<body>
</body>
</html>