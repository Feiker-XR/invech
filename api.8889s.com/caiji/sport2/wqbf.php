<?php
$base = dirname(__FILE__);
include $base.'/include.php';
include $db_path.'mysqlis';
session_start();
if(intval(date('H'))<6)
{
	if($_SESSION["wqbf"]=="0")
	{
		$list_date=date('Y-m-d',time());
		$bdate=date('m-d',time());
		$_SESSION["wqbf"]="-1";
	}
	else
	{
		$list_date=date('Y-m-d',time()-24*3600);
		$bdate=date('m-d',time()-24*3600);
		$_SESSION["wqbf"]="0";
	}
}
else
{
	//http://hg0088.com/app/member/result/result_tn.php?game_type=TN&list_date=2016-06-10&uid=vgc7bjx0om15069906l3689437&langx=zh-tw 
	$list_date=date('Y-m-d',time());
	$bdate=date('m-d',time());
}

$base_url = $webdb["datesite"]."app/member/TN_index.php?uid=".$webdb["cookie"]."&langx=en-us&mtype=3";
$thisHttp = new cHTTP();
$thisHttp->setReferer($base_url);
$filename=$webdb["datesite"]."app/member/result/result_tn.php?game_type=TN&list_date=$list_date&uid=".$webdb["cookie"]."&langx=zh-tw";
//echo $filename;
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

	if(is_numeric($mb_inball) && is_numeric($tg_inball)){
		$sql='update tennis_match set mb_inball='.$mb_inball.',tg_inball='.$tg_inball.' where match_id='.$match_id."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}
	
	if(is_numeric($mb_inball1) && is_numeric($tg_inball1)){
		$match_id1=$match_id+1;
		//1st
		$sql='update tennis_match set mb_inball='.$mb_inball1.',tg_inball='.$tg_inball1.' where match_id='.$match_id1."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball2) && is_numeric($tg_inball2)){
		$match_id2=$match_id+2;
		//2st				
		$sql='update tennis_match set mb_inball='.$mb_inball2.',tg_inball='.$tg_inball2.' where match_id='.$match_id2."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}
	
	if(is_numeric($mb_inball3) && is_numeric($tg_inball3)){
		$match_id3=$match_id+3;
		//3st				
		$sql='update tennis_match set mb_inball='.$mb_inball3.',tg_inball='.$tg_inball3.' where match_id='.$match_id3."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}			
	
	if(is_numeric($mb_inball4) && is_numeric($tg_inball4)){
		$match_id4=$match_id+4;
		//4st				
		$sql='update tennis_match set mb_inball='.$mb_inball4.',tg_inball='.$tg_inball4.' where match_id='.$match_id4."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}			

	if(is_numeric($mb_inball5) && is_numeric($tg_inball5)){
		$match_id5=$match_id+5;
		//5st				
		$sql='update tennis_match set mb_inball='.$mb_inball5.',tg_inball='.$tg_inball5.' where match_id='.$match_id5."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}

	if(is_numeric($mb_inball6) && is_numeric($tg_inball6)){
		$match_id6=$match_id+6;
		//6st				
		$sql='update tennis_match set mb_inball='.$mb_inball6.',tg_inball='.$tg_inball6.' where match_id='.$match_id6."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	}
		
	$m++;
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
-->
</style></head>
<script>
<!--
var limit="500"
if (document.images){
	var parselimit=limit
}
function beginrefresh(){
if (!document.images)
	return
if (parselimit==1)
	self.location.reload()
else{
	parselimit-=1
	curmin=Math.floor(parselimit)
	if (curmin!=0)
		curtime=curmin+"秒后获取数据！"
	else
		curtime=cursec+"秒后获取数据！"
		timeinfo.innerText=curtime
		setTimeout("beginrefresh()",1000)
	}
}

window.onload=beginrefresh

</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left">
    <input type=button name=button value="刷新" onClick="window.location.reload()">
    <?=$m?> 条网球比分！
      <span id="timeinfo"></span>
     </td>
  </tr>
</table>
</body>
</html>