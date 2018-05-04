<?php
$base = dirname(__FILE__);
include_once($base.'/include.php');
include_once $db_path.'mysqlis.php';
header("Content-type: text/html; charset=utf-8");

session_start();
if(intval(date('H'))<4)
{
	if($_SESSION["pqbf"]=="0")
	{
		$list_date=date('Y-m-d',time());
		$bdate=date('m-d',time());
		$_SESSION["pqbf"]="-1";
	}
	else
	{
		$list_date=date('Y-m-d',time()-24*3600);
		$bdate=date('m-d',time()-24*3600);
		$_SESSION["pqbf"]="0";
	}
}
else
{
	$list_date=date('Y-m-d',time());
	$bdate=date('m-d',time());
}

$base_url = $webdb["datesite"]."app/member/VB_index.php?uid=".$webdb["cookie"]."&langx=en-us&mtype=3";
$thisHttp = new cHTTP();
$thisHttp->setReferer($base_url);
$filename=$webdb["datesite"]."app/member/result/result_vb.php?game_type=VB&list_date=$list_date&uid=".$webdb["cookie"]."&langx=zh-tw";

$thisHttp->getPage($filename);
$msg = $thisHttp->getContent();
$msg = strtolower($msg);
preg_match_all("/<tr id=\"tr_1_(.*?)\" style=\"display: \" class=\"full\">([\s\S]*?)<\/tr>/s",$msg,$matches);
$m=0;
for ($i=0;$i<sizeof($matches[1]);$i++){
	$id=trim($matches[1][$i]);
	$match_id=substr($id,6,strlen($id)-1);
	
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$matches[2][$i],$full_score);
	$mb_inball=trim($full_score[1][0]);
	$tg_inball=trim($full_score[1][1]);
	
	preg_match("/<tr id=\"tr_2_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr1);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr1[1],$hr1_score);
	$mb_inball1=trim($hr1_score[1][0]);
	$tg_inball1=trim($hr1_score[1][1]);
	
	preg_match("/<tr id=\"tr_3_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr2);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr2[1],$hr2_score);
	$mb_inball2=trim($hr2_score[1][0]);
	$tg_inball2=trim($hr2_score[1][1]);
	
	preg_match("/<tr id=\"tr_4_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr3);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr3[1],$hr3_score);
	$mb_inball3=trim($hr3_score[1][0]);
	$tg_inball3=trim($hr3_score[1][1]);
	
	preg_match("/<tr id=\"tr_5_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr4);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr4[1],$hr4_score);
	$mb_inball4=trim($hr4_score[1][0]);
	$tg_inball4=trim($hr4_score[1][1]);
	
	preg_match("/<tr id=\"tr_6_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr5);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr5[1],$hr5_score);
	$mb_inball5=trim($hr5_score[1][0]);
	$tg_inball5=trim($hr5_score[1][1]);
	
	preg_match("/<tr id=\"tr_7_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr6);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr6[1],$hr6_score);
	$mb_inball6=trim($hr6_score[1][0]);
	$tg_inball6=trim($hr6_score[1][1]);
	
	preg_match("/<tr id=\"tr_8_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr7);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr7[1],$hr7_score);
	$mb_inball7=trim($hr7_score[1][0]);
	$tg_inball7=trim($hr7_score[1][1]);
	
	preg_match("/<tr id=\"tr_9_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr8);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr8[1],$hr8_score);
	$mb_inball8=trim($hr8_score[1][0]);
	$tg_inball8=trim($hr8_score[1][1]);
	
	preg_match("/<tr id=\"tr_10_".$id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$hr9);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$hr9[1],$hr9_score);
	$mb_inball9=trim($hr9_score[1][0]);
	$tg_inball9=trim($hr9_score[1][1]);
	
	$mb_inball=(is_numeric($mb_inball))?$mb_inball:"-1";
	$tg_inball=(is_numeric($tg_inball))?$tg_inball:"-1";
	$mb_inball1=(is_numeric($mb_inball1))?$mb_inball1:"-1";
	$tg_inball1=(is_numeric($tg_inball1))?$tg_inball1:"-1";
	$mb_inball2=(is_numeric($mb_inball2))?$mb_inball2:"-1";
	$tg_inball2=(is_numeric($tg_inball2))?$tg_inball2:"-1";
	$mb_inball3=(is_numeric($mb_inball3))?$mb_inball3:"-1";
	$tg_inball3=(is_numeric($tg_inball3))?$tg_inball3:"-1";
	$mb_inball4=(is_numeric($mb_inball4))?$mb_inball4:"-1";
	$tg_inball4=(is_numeric($tg_inball4))?$tg_inball4:"-1";
	$mb_inball5=(is_numeric($mb_inball5))?$mb_inball5:"-1";
	$tg_inball5=(is_numeric($tg_inball5))?$tg_inball5:"-1";
	$mb_inball6=(is_numeric($mb_inball6))?$mb_inball6:"-1";
	$tg_inball6=(is_numeric($tg_inball6))?$tg_inball6:"-1";
	$mb_inball7=(is_numeric($mb_inball7))?$mb_inball7:"-1";
	$tg_inball7=(is_numeric($tg_inball7))?$tg_inball7:"-1";
	$mb_inball8=(is_numeric($mb_inball8))?$mb_inball8:"-1";
	$tg_inball8=(is_numeric($tg_inball8))?$tg_inball8:"-1";
	$mb_inball9=(is_numeric($mb_inball9))?$mb_inball9:"-1";
	$tg_inball9=(is_numeric($tg_inball9))?$tg_inball9:"-1";
	
	if(is_numeric($mb_inball) && is_numeric($tg_inball)){
		$sql='update volleyball_match set mb_inball='.$mb_inball.',tg_inball='.$tg_inball.' where match_id='.$match_id."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball1) && is_numeric($tg_inball1)){
		$match_id1=$match_id+1;
		//1st				
		$sql='update volleyball_match set mb_inball='.$mb_inball1.',tg_inball='.$tg_inball1.' where match_id='.$match_id1."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball2) && is_numeric($tg_inball2)){
		$match_id2=$match_id+2;
		//2st				
		$sql='update volleyball_match set mb_inball='.$mb_inball2.',tg_inball='.$tg_inball2.' where match_id='.$match_id2."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball3) && is_numeric($tg_inball3)){
		$match_id3=$match_id+3;
		//3st				
		$sql='update volleyball_match set mb_inball='.$mb_inball3.',tg_inball='.$tg_inball3.' where match_id='.$match_id3."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball4) && is_numeric($tg_inball4)){
		$match_id4=$match_id+4;
		//4st				
		$sql='update volleyball_match set mb_inball='.$mb_inball4.',tg_inball='.$tg_inball4.' where match_id='.$match_id4."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball5) && is_numeric($tg_inball5)){
		$match_id5=$match_id+5;
		//5st				
		$sql='update volleyball_match set mb_inball='.$mb_inball5.',tg_inball='.$tg_inball5.' where match_id='.$match_id5."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball6) && is_numeric($tg_inball6)){
		$match_id6=$match_id+6;
		//6st				
		$sql='update volleyball_match set mb_inball='.$mb_inball6.',tg_inball='.$tg_inball6.' where match_id='.$match_id6."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball7) && is_numeric($tg_inball7)){
		$match_id7=$match_id+7;
		//7st				
		$sql='update volleyball_match set mb_inball='.$mb_inball7.',tg_inball='.$tg_inball7.' where match_id='.$match_id7."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball8) && is_numeric($tg_inball8)){
		$match_id8=$match_id+8;
		//8st				
		$sql='update volleyball_match set mb_inball='.$mb_inball8.',tg_inball='.$tg_inball8.' where match_id='.$match_id8."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball9) && is_numeric($tg_inball9)){
		$match_id9=$match_id+9;
		//9st				
		$sql='update volleyball_match set mb_inball='.$mb_inball9.',tg_inball='.$tg_inball9.' where match_id='.$match_id9."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}
	
	$m++;
}
