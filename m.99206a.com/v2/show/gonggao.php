<?php
@session_start();
include_once("../include/mysqli.php");
include_once("../class/la.php");
include ("../include/config.php");

$msg	=	"";
$sql	=	"select msg from k_notice where end_time>'".date('Y-m-d H:i:s')."' and is_show=1 order by `sort` desc,nid desc limit 0,5";
$query	=	$mysqli->query($sql); 
while($rs = $query->fetch_array()){
	$msg	.=	$rs['msg']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
include_once("../include/mysqlio.php");
la::ip_la(); //添加IP记录
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公告</title>
<meta http-equiv="Cache-Control" content="max-age=864000" />
<link href="/css/right.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="/js/jquery.js"></script>
<script language="javascript">
$(function(){
	$("#heid").click(function(){
		window.open('/index/noticle.html?t=1','newwindow')
	});    	   
});
</script>
</head>
<body style="margin:0px;">
<table width="787" height="22" border="0" cellspacing="0" id="heid" style="cursor:pointer;">
	<tr>
	  <td width="9" bgcolor="#FFFFFF" id="newmsg_swf"></td>
	  <td width="80"><img src="/images/ico.gif" alt="最新消息" width="80" height="22" /></td>
	  <td width="659" bgcolor="#FFFFFF" style="border:1px #A7A7A7 solid;"><marquee scrolldelay="5" scrollamount="2" style="color:#000; padding:0;"><?=$msg?></marquee></td>
	  <td width="79"><img src="/images/record.jpg" alt="历史讯息" width="80" height="22" /></td>
	</tr>
</table>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>