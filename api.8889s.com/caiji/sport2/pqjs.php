<?php
//暂时没用到
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
header("Content-type: text/html; charset=utf-8");
include_once(dirname(__FILE__)."/../db/mysqlis.php");

$m			=	0;
$match_id	=	"";
$arr		=	array();
$bdate		=	date('m-d',time()); //昨天日期
$sql		=	"select mb_inball,tg_inball,match_id from Volleyball_Match where match_date='$bdate' and mb_inball is not null and tg_inball is not null and match_js=0"; //取出已经结算比分的赛事
$query		=	$mysqlis->query($sql);
while($row	=	$query->fetch_array()){
	$arr[$row["match_id"]]['mb']	=	$row["mb_inball"];
	$arr[$row["match_id"]]['tg']	=	$row["tg_inball"];
	$match_id	.=	$row["match_id"].',';
}
if($match_id){ //有比分结果赛事数据
	include_once("mysqli.php");
	include_once("function.php");
	$match_id	=	rtrim($match_id,',');
	$sql		=	"select bid,match_id,match_type,match_showtype,match_rgg,match_dxgg,match_nowscore,point_column from k_bet where match_id in($match_id) and `status`=0"; //取出这些赛事未结算的注单
	$query		=	$mysqli->query($sql);
	while($row	=	$query->fetch_array()){
		$t		=	make_point($row["point_column"],$arr[$row["match_id"]]['mb'],$arr[$row["match_id"]]['tg'],0,0,$row["match_type"],$row["match_showtype"],$row["match_rgg"],$row["match_dxgg"],$row["match_nowscore"]);
		set($row["bid"],$t["status"],$arr[$row["match_id"]]['mb'],$arr[$row["match_id"]]['tg']); //结算
		$m++;
	}
	$sql	=	"update Volleyball_Match set match_js='1' where match_id in($match_id)";
	$mysqlis->query($sql);
}
