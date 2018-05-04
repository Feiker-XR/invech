<?php
ini_set("display_errors","yes");
include_once("db.php");
include_once("pub_library.php");
include_once("http.class.php");
include_once("mysqlis.php");
include_once("function.php");
header("Content-type: text/html; charset=utf-8");

$m=0;
$tt=$_GET['tt'];
if($tt){
	$time=strtotime($tt.' 00:00:00');
}else{
	$time=time();
}
$list_date=date('Y-m-d',$time-2*60*60);
$bdate=date('m-d',$time-2*60*60);
/*
$list_date='2016-01-20';
$bdate='01-20';*/

$base_url = $webdb["datesite"]."/app/member/FT_index.php?uid=".$webdb["cookie"]."&langx=zh-tw&mtype=3";
$thisHttp = new cHTTP();
$thisHttp->setReferer($base_url);
$filename = $webdb["datesite"]."/app/member/result/result.php?game_type=FT&list_date=$list_date&uid=".$webdb["cookie"]."&langx=zh-tw";
//echo $filename;exit;
$thisHttp->getPage($filename);
$msg = $thisHttp->getContent();
$msg = strtolower($msg);

//echo $msg;exit;
preg_match_all("|<tr class=\"b_cen\" id=\"tr_(.+?)\"([\s\S]+?)<td width=\"12\">\&nbsp;<\/td>[\s\S]+?<\/tr>|", $msg, $team_arr);
//print_r($team_arr);exit;
for ($i=0;$i<count($team_arr[0]);$i++){
	preg_match_all("|<td class=\"team_c_ft\">([\s\S]+?)</td>[\s\S]+?<td class=\"team_h_ft\">([\s\S]+?)</td>|", $team_arr[0][$i], $team_name_arr);
	//print_r($team_name_arr);
	$Match_Master=trim(str_replace("&nbsp;","",strip_tags($team_name_arr[1][0])));
	$Match_Guest=trim(str_replace("&nbsp;","",strip_tags($team_name_arr[2][0])));
	//echo $Match_Master.'=='.$Match_Guest.'+++'.$team_arr[1][$i];
	if($Match_Master){
		preg_match_all("|<tr id=\"tr_1_".$team_arr[1][$i]."\" style=\"display: \" class=\"hr\">[\s\S]+?<td class=\"hr_main_ft \">([\s\S]+?)</td>[\s\S]+?<td class=\"hr_main_ft \">([\s\S]+?)</td>[\s\S]+?<td class=\"full_main_ft \">([\s\S]+?)</td>[\s\S]+?<td class=\"full_main_ft \">([\s\S]+?)</td>|", $msg, $team_bcbf_arr);
		$bf_hr_m=str_replace("&nbsp;","",str_replace(" ","",strip_tags($team_bcbf_arr[1][0])));
		$bf_hr_g=str_replace("&nbsp;","",str_replace(" ","",strip_tags($team_bcbf_arr[2][0])));
		$bf_qc_m=str_replace("&nbsp;","",str_replace(" ","",strip_tags($team_bcbf_arr[3][0])));
		$bf_qc_g=str_replace("&nbsp;","",str_replace(" ","",strip_tags($team_bcbf_arr[4][0])));
		
		$bf_hr_m=(is_numeric($bf_hr_m))?$bf_hr_m:"-1";
		$bf_hr_g=(is_numeric($bf_hr_g))?$bf_hr_g:"-1";
		$bf_qc_m=(is_numeric($bf_qc_m))?$bf_qc_m:"-1";
		$bf_qc_g=(is_numeric($bf_qc_g))?$bf_qc_g:"-1";
		//print_r($team_bcbf_arr);
		//echo $bf_qc_m.'=='.$bf_qc_g.'<br>';
		$sql="update bet_match set mb_inball='$bf_qc_m',tg_inball='$bf_qc_g',tg_inball_hr='$bf_hr_g',mb_inball_hr='$bf_hr_m' where match_master not like '%上半%' and Match_Date='$bdate' and match_master = '".$Match_Master."' and Match_Guest = '".$Match_Guest."'";
		$mysqlis->query($sql);
		//echo $sql."<br>";
		$sql="update bet_match set mb_inball='$bf_hr_m',tg_inball='$bf_hr_g',tg_inball_hr='$bf_hr_g',mb_inball_hr='$bf_hr_m' where Match_Date='$bdate' and match_master = '".$Match_Master." - (上半)' and Match_Guest = '".$Match_Guest." - (上半)'";
		//echo $sql."<br>=====<br>";
		$mysqlis->query($sql);	
		$m++;
	}
	
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<style type="text/css">
<!--
body {
	background-color: #CCCCCC;
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style>
</head>
<script>
<!--
var limit="200"
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
<body bgcolor="#999999">
<table width="100%" height="100" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="100" align="center"><p><?=$list_date.'&nbsp;&nbsp;<font color="red">'.$m.'</font>'?> 条足球比分！</p>
      <span id="timeinfo"></span><br>
      <input type=button name=button value="刷新" onClick="window.location.reload()"></td>
  </tr>
</table>
</body>
</html>