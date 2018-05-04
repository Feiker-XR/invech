<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
//auto_4
//重庆快乐十分
//$html_data = file_get_contents("http://c.apiplus.net/newly.do?token=8c72e19ff2174223&code=cqklsf&format=json");
$html_data = file_get_contents("http://www.ddos9123.com/caiji/cqklsf.php");
$datajson = json_decode($html_data,true);
$data = array();
if($datajson && isset($datajson['data'])){
	foreach ($datajson['data'] as $val) {
		$tmp = explode(',',$val['opencode']);if($tmp[0]=='**')$tmp[0]='01';
		$data[] = array(
			'qi'=>substr($val['expect'], 0,8).substr($val['expect'], 9,2),
			't'=>$val['opentime'],
			'ball1'=>$tmp[0],
			'ball2'=>$tmp[1],
			'ball3'=>$tmp[2],
			'ball4'=>$tmp[3],
			'ball5'=>$tmp[4],
			'ball6'=>$tmp[5],
			'ball7'=>$tmp[6],
			'ball8'=>$tmp[7]
		);
	}
}
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
$lottery_type = "重庆快乐十分";
foreach ($all as $k => $v) {
	$sql="select id from c_auto_4 where qishu='".$v[0]."' ";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;
	if($tcou==0){
    	if(!preg_match('/[a-zA-Z]+/',$v[0])){
	        $addsql = "insert into weijiesuan (`type`,`qishu`) values ";
	        $addsql .= " ('$lottery_type','{$v[0]}');";
	        $mysqli -> query($addsql);
	    }
		$sql	=	"insert into c_auto_4(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8) values ('".$v[0]."','".$v[1]."','".$v[2][0]."','".$v[2][1]."','".$v[2][2]."','".$v[2][3]."','".$v[2][4]."','".$v[2][5]."','".$v[2][6]."','".$v[2][7]."')";
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
		* {
			font-size: 12px;
			margin:0;
		}
		-->
	</style>
</head>
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
			timeinfo.innerHTML=curtime
			setTimeout("beginrefresh()",1000)
		}
	}
	window.onload=beginrefresh
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left">
			<input type=button name=button value="刷新" onClick="window.location.reload()">
			重庆快乐10分<br>
			<?=$qishu?>期:<br>
			<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8"?><br>
			<span id="timeinfo"></span>
		</td>
	</tr>
</table>
</body>
</html>