<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");


$html_data = file_get_contents("http://www.cp686.cc/shishicai/getHistoryData.do?count=12");

$data = json_decode($html_data,true);

//print_r($html_data);

$all = array();

foreach ($data['rows'] as $k => $v) {
	 
	$qishu = str_replace('-', '', $v['termNum']);

	$time = $v['lotteryTime']; 
if(empty($v['lotteryNum'])) continue;
	$one = array($qishu,$time,array($v['n1'],$v['n2'],$v['n3'],$v['n4'],$v['n5']));
	$all[] = $one;
}

//最新一期数据
$qishu = $all[0][0];
$time = $all[0][1];
$num1 = $all[0][2][0];
$num2 = $all[0][2][1];
$num3 = $all[0][2][2];
$num4 = $all[0][2][3];
$num5 = $all[0][2][4];

//print_r($all);



$jiesuan ='';
foreach ($all as $k => $v) {
	$sql="select id from c_auto_2 where qishu='".$v[0]."' ";
	$tquery = $mysqli->query($sql);
	$tcou = $mysqli->affected_rows;
	if($tcou==0)
	{
		if($jiesuan) $jiesuan .= ",".$v[0]; else $jiesuan=$v[0];
		$sql = "insert into c_auto_2(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('".$v[0]."','".$v[1]."','".$v[2][0]."','".$v[2][1]."','".$v[2][2]."','".$v[2][3]."','".$v[2][4]."')";
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
      重庆时时彩(<?=$qishu?>期<?="$num1,$num2,$num3,$num4,$num5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="../../Lottery/Auto/Csc.php?qi=<?=$jiesuan?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>