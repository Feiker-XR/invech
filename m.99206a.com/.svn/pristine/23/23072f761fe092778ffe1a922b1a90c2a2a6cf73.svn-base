<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
$url = "http://www.802066.com/Guandong_11_5/HistoryData/%E9%87%8D%E5%BA%86%E5%BF%AB%E4%B9%90%E5%8D%81%E5%88%86?jsonPost=1";


$data = array('ModelJson'=>'{}','t'=>time());

ob_start();
$curl = curl_init();
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1");
//curl_setopt($curl, CURLOPT_FOLLOWLOCATION,false);
curl_setopt($curl, CURLOPT_POST,1);
curl_setopt($curl, CURLOPT_REFERER, "http://www.802066.com");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, $url);
$content = curl_exec($curl);
curl_close($curl);
$html_data = ob_get_contents();
ob_end_clean();
 
$datajson = json_decode($html_data,true);
 //print_r($datajson);
// exit;
$data = array();
if($datajson && isset($datajson['Data'])){
	
	foreach ($datajson['Data'] as $val) {
		$data[] = array(
				'qi'=>substr($val['butchNo'], 0,8).substr($val['butchNo'], 9,2),
				't'=>$val['publishDate'],
				'ball1'=>$val['point1'],
				'ball2'=>$val['point2'],
				'ball3'=>$val['point3'],
				'ball4'=>$val['point4'],
				'ball5'=>$val['point5'],
				'ball6'=>$val['point6'],
				'ball7'=>$val['point7'],
				'ball8'=>$val['point8']
			);
	}
	
}
//print_r($data);
//exit;
 

$all = array();


foreach ($data as $k => $v) {
	 
	$qishu = $v['qi'];

	$time = $v['t'];
	$ball_1=$v['ball1'];
	$ball_2=$v['ball2'];
	$ball_3=$v['ball3'];
	$ball_4=$v['ball4'];
	$ball_5=$v['ball5'];
	$ball_6=$v['ball6'];
	$ball_7=$v['ball7'];
	$ball_8=$v['ball8'];

	$one = array($qishu,$time,array($ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8));
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

//print_r($all);

	foreach ($all as $k => $v) {

		$sql="select id from c_auto_4 where qishu='".$v[0]."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;

		if($tcou==0){
			
			$sql	=	"insert into c_auto_4(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8) values ('".$v[0]."','".$v[1]."','".$v[2][0]."','".$v[2][1]."','".$v[2][2]."','".$v[2][3]."','".$v[2][4]."','".$v[2][5]."','".$v[2][6]."','".$v[2][7]."')";
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
<? $limit= rand(5,15);?>
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
      重庆快乐10分<br>(<?=$qishu?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="../../Lottery/Auto/Csf.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>