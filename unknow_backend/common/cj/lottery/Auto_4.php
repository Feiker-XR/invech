<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");


$html_data = file_get_contents("http://www.cp686.cc/pk10/getHistoryData.do?count=16");


$data = json_decode($html_data,true);

//print_r($data); 
//exit;

$all = array();


foreach ($data['rows'] as $k => $v) {
	 
	$qishu = $v['termNum'];

	$time = $v['lotteryTime']; 
if(empty($v['lotteryNum'])) continue;
	$one = array($qishu,$time,array($v['n1'],$v['n2'],$v['n3'],$v['n4'],$v['n5'],$v['n6'],$v['n7'],$v['n8'],$v['n9'],$v['n10']));
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
$ball_6=$all[0][2][5];
$ball_7=$all[0][2][6];
$ball_8=$all[0][2][7];
$ball_9=$all[0][2][8];
$ball_10=$all[0][2][9];


//print_r($all);


$jiesuan ='';

	foreach ($all as $k => $v) {

		$sql="select id from c_auto_3 where qishu='".$v[0]."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;

		if($tcou==0){
			if($jiesuan) $jiesuan .= ",".$v[0]; else $jiesuan=$v[0];
			
			$sql	=	"insert into c_auto_3(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values ('".$v[0]."','".$v[1]."','".$v[2][0]."','".$v[2][1]."','".$v[2][2]."','".$v[2][3]."','".$v[2][4]."','".$v[2][5]."','".$v[2][6]."','".$v[2][7]."','".$v[2][8]."','".$v[2][9]."')";
			//echo $sql."<br>";
			$mysqli->query($sql);
			//$m=$m+1;
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
      北京赛车PK拾<br>(<?=$qishu?>期:<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8,$ball_9,$ball_10"?>)<br><span id="timeinfo"></span>
	  </td>
      
  </tr>
</table>
<iframe src="../../Lottery/Auto/Pk10.php?qi=<?=$jiesuan?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>