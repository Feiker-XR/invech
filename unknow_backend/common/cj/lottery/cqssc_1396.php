<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");

$urlx = base64_encode("http://www.1396cp.com/shishicai/kaijiang/");

$html_data = file_get_contents("http://help.yyyg6666.com/urlx.php?urlx=$urlx");

//echo $html_data;

preg_match("#<table[^>]*id=[^>]*history[^>]*>(.*)</table>#is", $html_data,$m);

$data = array();
//print_r($m);
if($m){
	
	$preg = "#<tr[^>]*>.*?</tr>#is";
	preg_match_all($preg, $m[0],$m1);

	if($m1){
		
		foreach ($m1[0] as $v) {
			 
			$preg_qi = "#<p[^>]*class=\"p\"[^>]*>(.*?)</p>#is";
			
			$preg_t = "#<p[^>]*class=\"t\"[^>]*>(.*?)</p>#is";
			
			$preg_nums = "#<td[^>]*class=\"nums\"[^>]*>.*[^>]*<span[^>]*class=[\"\']no[0-9]+[\"\']>([0-9]+)</span>[^>]*<span[^>]*class=[\"\']no[0-9]+[\"\']>([0-9]+)</span>[^>]*<span[^>]*class=[\"\']no[0-9]+[\"\']>([0-9]+)</span>[^>]*<span[^>]*class=[\"\']no[0-9]+[\"\']>([0-9]+)</span>[^>]*<span[^>]*class=[\"\']no[0-9]+[\"\']>([0-9]+)</span>[^>]*</td>#";
			//<span class="no5">2</span>
			
			preg_match($preg_qi, $v,$m3);
			
			preg_match($preg_t, $v,$m4);
			
			preg_match($preg_nums, $v,$m5);
			
			if($m3 && $m4 && $m5){
				
				$data[] = array(
					'qi'=>trim(str_replace("-", '', $m3[1])),
					't'=>substr($m3[1],0, 4).'-'.substr($m3[1],4, 2).'-'.substr($m3[1],6, 2).' '.trim($m4[1]).":00",
					'ball1'=>trim($m5[1]),
					'ball2'=>trim($m5[2]),
					'ball3'=>trim($m5[3]),
					'ball4'=>trim($m5[4]),
					'ball5'=>trim($m5[5])
				);
			}
			
		}
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

//print_r($all);


$jiesuan = '';
	foreach ($all as $k => $v) {

		$sql="select id from c_auto_2 where qishu='".$v[0]."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;

		if($tcou==0){
			
			if($jiesuan) $jiesuan .= ",".$v[0]; else $jiesuan=$v[0];
			$sql	=	"insert into c_auto_2(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('".$v[0]."','".$v[1]."','".$v[2][0]."','".$v[2][1]."','".$v[2][2]."','".$v[2][3]."','".$v[2][4]."')";
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
      重庆时时彩(<?=$qishu?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="../../Lottery/Auto/Csc.php?qi=<?=$jiesuan?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>