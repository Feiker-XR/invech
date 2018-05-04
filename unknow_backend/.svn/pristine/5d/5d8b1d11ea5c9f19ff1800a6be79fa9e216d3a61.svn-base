<?
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

	$curl = &new Curl_HTTP_Client();
	$url = "http://www.bwlc.gov.cn/bulletin/prevpk3.html";
	$html_data 	= strtolower($curl->fetch_url($url));
	preg_match_all("/\<table class=\"tb\" width=\"100%\">(.+?)\<\/table>/is",$html_data,$matches);
	$data=explode("</tr>",strtolower($matches[1][0]));
	//print_r($data);exit;
for($i=0;$i<count($data);$i++){
	$score=explode("</td>",$data[$i]);

	if (sizeof($score)==7){
		$qihao=substr($score[0],-7);
		$time = strtotime('2015-05-17  20:25:00');
		$tsc  = $qihao-2015130;
		$date = date('Y-m-d',$time+$tsc*24*3600);
		$temp = explode('<td>',$score[1]);
		$hm1  = $temp[1];
		$temp = explode('<td>',$score[2]);
		$hm2  = $temp[1];
		$temp = explode('<td>',$score[3]);
		$hm3=$temp[1];
		$fengpan 	= $date.' 20:25:00';
		$kaipan 	= date('Y-m-d H:i:s',strtotime($fengpan)-85829);
		$sql = "select * from lottery_k_3d where qihao='$qihao'";
		$result = $mysqli->query($sql) or die ("操作失败!!!".$sql);
		$cou = $mysqli->affected_rows;
		$ros = $result->fetch_array();
		if($i==1){
			$ball_qishu=$qihao;
			$ball_1=$hm1;$ball_2=$hm2;$ball_3=$hm3;
		}
		if($cou==1){
			if($ros["ok"]==0){
				$mysql = "update lottery_k_3d set hm1='$hm1',hm2='$hm2',hm3='$hm3' where qihao='$qihao'";
				$mysqli->query($mysql) or die ("操作失败!!!".$sql);
			}
		}else{
			$mysql = "insert into lottery_k_3d set qihao='$qihao',kaipan='$kaipan',fengpan='$fengpan',hm1='$hm1',hm2='$hm2',hm3='$hm3'";
			echo $mysql;
			$mysqli->query($mysql) or die ("操作失败!!!".$sql);
		}
	
		$newqihao = $qihao+1;
		$sql = "select * from lottery_k_3d where qihao='$newqihao'";
		//echo $sql;
		$result = $mysqli->query($sql) or die ("操作失败!!!".$sql);
		$cou = $mysqli->affected_rows;
		if($cou==0){
			$newkaipan = date("Y-m-d H:i:s",strtotime($kaipan)+1*24*3600);
			$newfengpan = date("Y-m-d H:i:s",strtotime($fengpan)+1*24*3600);
			$mysql="insert into lottery_k_3d set qihao='$newqihao',kaipan='$newkaipan',fengpan='$newfengpan',hm1=0,hm2=0,hm3=0";
			//exit($mysql);
			$mysqli->query($mysql) or die ("操作失败!!!");
		}
	}
}
	
	$url = "http://www.lottery.gov.cn/lottery/pls/History.aspx";
	$html_data 	= strtolower($curl->fetch_url($url));
	if($html_data){
		$array		= explode('<tr align="center" bgcolor="#ffffff">',$html_data);
		$v 			= explode('</td>',$array[1]);
		$pl3_qihao 	= trim(strip_tags($v[0]));
		$jg			= explode("&nbsp;&nbsp;&nbsp;&nbsp;",strip_tags($v[1]));
		$pl3_hm1 	= intval($jg[0]);
		$pl3_hm2 	= intval($jg[1]);
		$pl3_hm3 	= intval($jg[2]);
		$t	 	 	= explode('<td>',$v[9]);
		$date	 	= trim($t[1]);
		//print_r($v);
		//echo $date;exit;
		$fengpan 	= $date.' 20:25:00';
		$kaipan 	= date('Y-m-d H:i:s',strtotime($fengpan)-85800);
	
		$sql = "select * from lottery_k_pl3 where qihao='$pl3_qihao'";
		$result = $mysqli->query($sql) or die ("操作失败!!!".$sql);
		$cou = $mysqli->affected_rows;
		if($cou==1){
			$ros = $result->fetch_array();
			if($ros["ok"]==0){
				$mysql = "update lottery_k_pl3 set hm1='$pl3_hm1',hm2='$pl3_hm2',hm3='$pl3_hm3' where qihao='$pl3_qihao'";
				$mysqli->query($mysql) or die ("操作失败!!!".$sql);
			}
		}else{
			$mysql = "insert into lottery_k_pl3 set qihao='$pl3_qihao',kaipan='$kaipan',fengpan='$fengpan',hm1='$pl3_hm1',hm2='$pl3_hm2',hm3='$pl3_hm3'";
			$mysqli->query($mysql) or die ("操作失败!!!".$sql);
		}
	
		$pl3_newqihao = $pl3_qihao+1;
		$sql = "select * from lottery_k_pl3 where qihao='$pl3_newqihao'";
		$result = $mysqli->query($sql) or die ("操作失败!!!".$sql);
		$cou = $mysqli->affected_rows;
		if($cou==0){
			$newkaipan = date("Y-m-d H:i:s",strtotime($kaipan)+1*24*3600);
			$newfengpan = date("Y-m-d H:i:s",strtotime($fengpan)+1*24*3600);
			$mysql="insert into lottery_k_pl3 set qihao='$pl3_newqihao',kaipan='$newkaipan',fengpan='$newfengpan',hm1=0,hm2=0,hm3=0";
			$mysqli->query($mysql) or die ("操作失败!!!") or die ("操作失败!!!".$sql);
		}
	}
//排列三
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
var limit="300" 
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
<table width="100%"border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()">
      福彩3D(<?=$ball_qishu?>期:<?=$ball_1?>,<?=$ball_2?>,<?=$ball_3?>,新增<?=$newqihao?>期):
      排列三(<?=$pl3_qihao?>期:<?=$pl3_hm1?>,<?=$pl3_hm2?>,<?=$pl3_hm3?>,新增<?=$pl3_newqihao?>期)
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="3d_auto.php?qihao=<?=$ball_qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
<iframe src="pl3_auto.php?qihao=<?=$pl3_qihao?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>