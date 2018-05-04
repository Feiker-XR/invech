<?php
@session_start();
if(@$_SESSION["uid"]){
  header("location:ft_danshi.html");
  exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>home</title>
<meta http-equiv="Cache-Control" content="max-age=864000" />
<link href="../css/tikuan.css" rel="stylesheet" type="text/css">

</head>
<script language="javascript">
if(self==top){
	top.location='/';
}
</script>
<body style="overflow-x:hidden;">
<div id="flash_sy">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="780" height="486">
  <param name="movie" value="../flash/zhuye2.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent" />
  <embed src="../flash/zhuye2.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="780" height="486"></embed>
</object>
</div>
</body>
</html>
<?php
if($_GET['Type']==''){
	include_once("../include/mysqli.php");
	include_once("../common/logintu.php");
	$ip = getip();	
	banIP($ip);
	indexSession($ip,'show/shouye.php');
}
?>