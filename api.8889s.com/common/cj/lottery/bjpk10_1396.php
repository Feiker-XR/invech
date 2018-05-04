<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");


$urlx = base64_encode("http://www.1396cp.com/pk10/kaijiang/");

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
			
			/*
			 * <td>
                <p class="p">20151122-034
                </p>
                <p class="t">15:54</p>
            </td>
            <td class="nums">
                    <i class='lot-no6'></i>                
                    <i class='lot-no10'></i>                
                    <i class='lot-no4'></i>                
                    <i class='lot-no2'></i>                
                    <i class='lot-no3'></i>                
                    <i class='lot-no9'></i>                
                    <i class='lot-no8'></i>                
                    <i class='lot-no7'></i>                
                    <i class='lot-no5'></i>                
                    <i class='lot-no1'></i>                
            </td><p class="t">23:29</p>
			 * */
			
			$preg_qi = "#<p[^>]*class=\"p\"[^>]*>(.*?)</p>#is";
			
			$preg_t = "#<p[^>]*class=\"t\"[^>]*>(.*?)</p>#is";
			
			$preg_nums = "#<td[^>]*class=\"nums\"[^>]*>.*[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*<i[^>]*class='pk-no([0-9]+)'></i>[^>]*.*</td>#";
			
			preg_match($preg_qi, $v,$m3);
			
			preg_match($preg_t, $v,$m4);
			
			preg_match($preg_nums, $v,$m5);
			
			if($m3 && $m4 && $m5){
				
				$data[] = array(
					'qi'=>trim(str_replace("-", '', $m3[1])),
					't'=>date("Y").'-'.trim($m4[1]).":00",
					'ball1'=>trim($m5[1]),
					'ball2'=>trim($m5[2]),
					'ball3'=>trim($m5[3]),
					'ball4'=>trim($m5[4]),
					'ball5'=>trim($m5[5]),
					'ball6'=>trim($m5[6]),
					'ball7'=>trim($m5[7]),
					'ball8'=>trim($m5[8]),
					'ball9'=>trim($m5[9]),
					'ball10'=>trim($m5[10])
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
	$ball_6=$v['ball6'];
	$ball_7=$v['ball7'];
	$ball_8=$v['ball8'];
	$ball_9=$v['ball9'];
	$ball_10=$v['ball10'];

	$one = array($qishu,$time,array($ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8,$ball_9,$ball_10));
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


$jiesuan = '';
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