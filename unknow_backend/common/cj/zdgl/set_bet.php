<?php
include_once("../common/login_check.php");
check_quanxian("sgjzd");
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
include_once("../../include/mysqli.php");
include_once("../../class/bet.php");
$status=intval($_GET["status"]);
$bid=intval($_GET["bid"]);
if(bet::set($bid,$status,$_GET["MB_Inball"],$_GET["TG_Inball"])){
	echo "<script>alert('操作成功'),refash();</script>";
}else{
	echo "<script>alert('操作失败'),location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
?>
</body>
</html>