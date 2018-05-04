<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
//error_reporting(ALL);



$url = "http://168kai.com/Open/CurrentOpen?code=1009";
ob_start();
$curl = curl_init();
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1");
curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);
curl_setopt($curl, CURLOPT_REFERER, "http://168kai.com");
curl_setopt($curl, CURLOPT_URL, $url);
$content = curl_exec($curl);
curl_close($curl);
$html_data = ob_get_contents();
ob_end_clean();

$data = json_decode($html_data,true);
$all = array();

foreach ($data['list'] as $k => $v) {
	$qishu = $v['c_t'];
	if(empty($v['c_r'])) continue; 
	$time = date("Y/").trim(substr(trim($v['c_d']),0,strrpos(trim($v['c_d']), '[')))." ".trim(substr(trim($v['c_d']),strrpos(trim($v['c_d']), ']')+1));
	$time = str_replace('/', '-', $time);
	$code = explode(',', $v['c_r']);
	$ball_1=$code[0];
	$ball_2=$code[1];
	$ball_3=$code[2];
	$ball_4=$code[3];
	$ball_5=$code[4];

	$one = array($qishu,$time,array($ball_1,$ball_2,$ball_3,$ball_4,$ball_5));
	$all[] = $one;
}

//最新一期数据
$qishu = $all[0][0];
$time = $all[0][1];
$ball_1=$all[0][2][0];
$ball_2=$all[0][2][1];
$ball_3=$all[0][2][2];
$ball_4=$all[0][2][3];
$ball_5=$all[0][2][4];

foreach ($all as $k => $v) {

	$sql="select id from c_auto_5 where qishu='".$v[0]."' ";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;

	if($tcou==0){
		$sql	=	"insert into c_auto_5(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('".$v[0]."','".$v[1]."','".$v[2][0]."','".$v[2][1]."','".$v[2][2]."','".$v[2][3]."','".$v[2][4]."')";
		//echo $sql;
		$mysqli->query($sql);
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
      广西快乐十分(<?=$qishu?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="../../Lottery/Auto/gxsf.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>