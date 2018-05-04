<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

if(21==1){
$st_time=strtotime("2014-10-09 00:02:00");
echo $st_time."<br>";
$ppx="";
for($i=1;$i<=120;$i++){
	echo $i."===";
	$sqls="select * from c_opentime_2 where qishu='$i'";
	echo $sqls;
	$tquery=$mysqli->query($sqls);
	$rs = $tquery->fetch_array();
	if($rs['qishu']){
		if($i<=24 && $i<=97){
			$add_num=4;
			$add_num2=5;
		}else{
			$add_num=9;
			$add_num2=10;
		}
		$actiontime=date("H:i:s",$st_time);
		$fengpan=date("H:i:s", $st_time+$add_num*60);
		$kaijiang=date("H:i:s", $st_time+($add_num+1)*60);
		$strSqls="UPDATE `c_opentime_2` SET `kaipan`='$actiontime',`fengpan`='$fengpan',`kaijiang`='$kaijiang' WHERE (`qishu`='".$rs['qishu']."')";
		echo $strSqls."<br>";
		$ppx.='"'.date("H:i",$st_time).'",';
		$mysqli->query($strSqls);
		//mysql_query($strSqls) or die("写入时间错误！<br>");
		$st_time+=60*$add_num2;
	}
}}

$curl = &new Curl_HTTP_Client();
$curl->set_referrer("http://www.168kai.com/lottery/10011.html");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.168kai.com/Open/CurrentOpen?code=10011");
$a=array('(',')');
$b=array('[',']');

//$msg = str_replace($a,$b,$html_data);

	$arr= json_decode($html_data,true);
//echo $datetime;
$i=1;
if($arr['l_r']){

	$qishu		= $arr['l_t'];
	$qishunum 	= substr($qishu,-3);
	$tempNum=explode(",",$arr['l_r']);
	$num1		= $tempNum[0];
	$num2		= $tempNum[1];
	$num3		= $tempNum[2];
	$num4		= $tempNum[3];
	$num5		= $tempNum[4];
	//echo $qishu."<br>";
	if(strlen($qishu)>0){
		if($i==1){
			$ball_1=$num1;$ball_2=$num2;$ball_3=$num3;$ball_4=$num4;$ball_5=$num5;
		}
		$sql="select id from c_auto_2 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql 	= "select kaijiang from `c_opentime_2` where qishu='".intval($qishunum)."'";
			//echo $sql;
			$query 	= $mysqli->query($sql);
			$rs		= $query->fetch_array();
			$time   = date("Y-m-d H:i:s",time()+1*12*3600);
			$sql 	= "insert into c_auto_2(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('$qishu','$time','$num1','$num2','$num3','$num4','$num5')";
			
			$mysqli->query($sql);
			
		}
		$m=$m+1;
	}
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
<body>
<script>
window.parent.is_open = 1;
</script>
<script> 
<!-- 
<? $limit= rand(10,50);?>
var limit="<?=$limit?>" 
if (document.images){ 
	var parselimit=limit
} 
function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.reload() 
else{ 
	parselimit-=1 
	curmin=Math.floor(parselimit) 
	if (curmin!=0) 
		curtime=curmin+"秒后自动获取!" 
	else 
		curtime=cursec+"秒后自动获取!" 
		timeinfo.innerText=curtime 
		setTimeout("beginrefresh()",1000) 
	} 
} 
window.onload=beginrefresh
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()">
      重庆时时彩<br>采集到<?=$m?>期(<?=$qishu?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="../../Lottery/Auto/Csc.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>