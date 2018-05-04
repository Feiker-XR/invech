<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");
$curl = &new Curl_HTTP_Client();
$curl->set_referrer("http://www.cqcp.net/game/ssc/");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$login['idMode']="3002";
$login['iCount']="1";
$html_date=$curl->send_post_data("http://www.cqcp.net/ajaxhttp/game/getopennumber1111.aspx",$login,"",5);
//$html_data = $curl->fetch_url("http://www.cqcp.net/ajaxhttp/game/getopennumber1111.aspx?idMode=3002&iCount=1");
echo $html_data;
$a = array(
"if(self == top)",
"<script>",
"</script>",
" style='height:20px; line-height:20px;'",
" style='width:65px;'",
" style='width:40px;'",
" style='width:50px;'",
" style='width:80px;'",
" style='width:80px; border-right:0px;'",
" style='width:80px; line-height:18px;border-right:0px;'",
"<li>",
"<ul>",
"\n\n"
);
$b = array(
"",
"",
"",
"",
"",
"",
"",
"",
"",
"",
"",
"",
""
);
unset($matches);
unset($datainfo);
$m=0;
$msg = str_replace($a,$b,$html_data);
$data=explode("</ul>",strtolower($msg));
for($i=1;$i<count($data);$i++){
	$scoretemp=explode("</li>",$data[$i]);
	if (sizeof($scoretemp)==10){
		$score[0] 	= strip_tags($scoretemp[0]);
		$score[1] 	= strip_tags($scoretemp[1]);
		$Y 			= substr($score[0],0,2);
		$M 			= substr($score[0],2,2);
		$D 			= substr($score[0],4,2);
		$qishunum 	= substr($score[0],-3);
		$qishu		= "20".substr($score[0],0,6)."".sprintf("%03d",$qishunum);
		$tempNum	= explode("-",$score[1]);
		$num1		= $tempNum[0];
		$num2		= $tempNum[1];
		$num3		= $tempNum[2];
		$num4		= $tempNum[3];
		$num5		= $tempNum[4];
		//echo $qishu."<br>";
		if(strlen($qishu)>0){
			if($i==1){
				$ball_qishu=$qishu;
				$ball_1=$num1;$ball_2=$num2;$ball_3=$num3;$ball_4=$num4;$ball_5=$num5;
			}
			$sql="select id from c_auto_2 where qishu='".$qishu."' ";
			$tquery = $mysqli->query($sql);
			$tcou	= $mysqli->affected_rows;
			if($tcou==0){
				$sql 	= "select kaijiang from `c_opentime_2` where qishu='".intval($qishunum)."'";
				$query 	= $mysqli->query($sql);
				$rs		= $query->fetch_array();
				$time   = "20$Y-$M-$D ".$rs['kaijiang'];
				$sql 	= "insert into c_auto_2(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('$qishu','$time','$num1','$num2','$num3','$num4','$num5')";
				
				$mysqli->query($sql);
				
			}
			$m=$m+1;
		}
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
var limit="10" 
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
      重庆时时彩<br>采集到<?=$m?>期(<?=$ball_qishu?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="../../Lottery/Auto/Csc.php?qi=<?=$ball_qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>