<?php
include_once("../common/login_check.php");
check_quanxian("zdgl");

if($_GET["ok"]	==	1){
	$gid	=	$_GET["id"];
	include_once("../../include/mysqli.php");
	include_once("../../class/bet_cg.php");
	
	$msg	=	bet_cg::js($gid) ? '操作成功' : '操作失败';
	
	message($msg,$_SERVER['HTTP_REFERER']);
}

if($_GET["ok"]	==	2){
	$arr	=	$_POST["gid"];
	include_once("../../include/mysqli.php");
	include_once("../../class/bet_cg.php");
	
	$sum	=	$true	=	$false	=	0;
	foreach($arr as $k=>$gid){
		$sum++;
		bet_cg::js($gid) ? $true++ : $false++;
	}
	
	message("共结算：$sum 条串关注单；\\n成功有：$true 条；\\n失败有：$false 条。",$_SERVER['HTTP_REFERER']);
}
?>