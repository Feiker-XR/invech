<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
//auto_5
//广西快乐十分
//$html_data = file_get_contents("http://c.apiplus.net/newly.do?token=8c72e19ff2174223&code=gxklsf&format=json");
$html_data = file_get_contents("http://47.90.17.50/caiji/gxklsf.php");
$data = json_decode($html_data,true);
$all = array();

foreach ($data['data'] as $k => $v) {
	$qishu = $v['expect'];
	if(empty($v['expect'])) continue;
	$time = $v['opentime'];
	$code = explode(',', $v['opencode']);if($code[0]=='**')$code[0]='01';
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
$lottery_type = "广西快乐十分";
foreach ($all as $k => $v) {

	$sql="select id from c_auto_5 where qishu='".$v[0]."' ";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;

	if($tcou==0){
	   if(!preg_match('/[a-zA-Z]+/',$v[0])){
	        $addsql = "insert into weijiesuan (`type`,`qishu`) values ";
	        $addsql .= " ('$lottery_type','{$v[0]}');";
	        $mysqli -> query($addsql);
	    }
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
	var limit="28"
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
			广西快乐十分<br>
			<?=$qishu?>期:<br>
			<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?><br>
			<span id="timeinfo"></span>
		</td>
	</tr>
</table>
</body>
</html>