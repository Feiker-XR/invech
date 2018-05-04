<?php
include_once("../common/login_check.php");
check_quanxian("zdgl");
include_once("../../include/mysqli.php");
include_once("../../class/bet.php");

$bid		=	intval($_GET["bid"]);
$msg		=	bet::qx_cgbet($bid) ? '操作成功' : '操作失败';
message($msg,$_SERVER["HTTP_REFERER"]);
?>