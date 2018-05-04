<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
//auto_6
//江苏快三
//$html_data = file_get_contents("http://c.apiplus.net/newly.do?token=8c72e19ff2174223&code=jsk3&format=json");
$html_data = file_get_contents("http://www.ddos9123.com/caiji/jsk3.php");
$datajson = json_decode($html_data,true);

$data = array();
if($datajson && isset($datajson['data'])){

	foreach ($datajson['data'] as $val) {
		$tmp = explode(',',$val['opencode']);if($tmp[0]=='*')$tmp[0]='1';
		$data[] = array(
			'qi'=>substr($val['expect'],2),
			't'=>$val['opentime'],
			'ball1'=>$tmp[0],
			'ball2'=>$tmp[1],
			'ball3'=>$tmp[2],
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

	$one = array($qishu,$time,array($ball_1,$ball_2,$ball_3));
	$all[] = $one;
}

//最新一期数据
$qishu = $all[0][0];
$time = $all[0][1];
$ball_1=$all[0][2][0];
$ball_2=$all[0][2][1];
$ball_3=$all[0][2][2];

//print_r($all);

$lottery_type="江苏快3";
$jiesuan = '';
foreach ($all as $k => $v) {

	$sql="select id from c_auto_6 where qishu='".$v[0]."' ";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;

	if($tcou==0){

    	if(!preg_match('/[a-zA-Z]+/',$v[0])){
    	    $addsql = "insert into weijiesuan (`type`,`qishu`) values ";
	        $addsql .= " ('$lottery_type','{$v[0]}');";
	        $mysqli -> query($addsql);
	    }
		if($jiesuan) $jiesuan .= ",".$v[0]; else $jiesuan=$v[0];
		$sql	=	"insert into c_auto_6(qishu,datetime,ball_1,ball_2,ball_3) values ('".$v[0]."','".$v[1]."','".$v[2][0]."','".$v[2][1]."','".$v[2][2]."')";
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
			江苏快3<br>
			<?=$qishu?>期:<br>
			<?="$ball_1,$ball_2,$ball_3"?><br>
			<span id="timeinfo"></span>
		</td>
	</tr>
</table>
</body>
</html>