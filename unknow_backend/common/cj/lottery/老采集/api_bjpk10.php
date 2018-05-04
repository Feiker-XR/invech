<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
//auto_3
//北京pk拾
$html_data = file_get_contents("http://www.ddos9123.com/caiji/bjpk10.php");
$data = json_decode($html_data,true);
$all = array();
foreach ($data['data'] as $k => $v) {
	$qishu = $v['expect'];
	$time = $v['opentime'];
	if(empty($v['opentime'])) continue;
	$tmp = explode(',',$v['opencode']);if($tmp[0]=='**')$tmp[0]='01';
	$one = array($qishu,$time,$tmp);
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
$jiesuan ='';
foreach ($all as $k => $v) {
	$sql="select id from c_auto_3 where qishu='".$v[0]."' ";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;
	if($tcou==0){
		if($jiesuan) $jiesuan .= ",".$v[0]; else $jiesuan=$v[0];
		$sql	=	"insert into c_auto_3(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values ('".$v[0]."','".$v[1]."','".$v[2][0]."','".$v[2][1]."','".$v[2][2]."','".$v[2][3]."','".$v[2][4]."','".$v[2][5]."','".$v[2][6]."','".$v[2][7]."','".$v[2][8]."','".$v[2][9]."')";
		$mysqli->query($sql);
	}
}

file_get_contents('../../Lottery/Auto/Pk10.php?qi='.$jiesuan);

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
			北京赛车PK拾<br>
			<?=$qishu?>期:<br>
			<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8,$ball_9,$ball_10"?><br>
			<span id="timeinfo"></span>
		</td>
	</tr>
</table>
<!--
<iframe src="../../Lottery/Auto/Pk10.php?qi=<?=$jiesuan?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
-->
</body>
</html>