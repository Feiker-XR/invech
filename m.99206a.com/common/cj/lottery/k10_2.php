<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");
function ob2ar($obj) {
    if(is_object($obj)) {
        $obj = (array)$obj;
        $obj = ob2ar($obj);
    } elseif(is_array($obj)) {
        foreach($obj as $key => $value) {
            $obj[$key] = ob2ar($value);
        }
    }
    return $obj;
}

if(21==1){
$st_time=strtotime("2014-10-09 09:02:00");
echo $st_time."<br>";
$ppx="";
for($i=1;$i<=179;$i++){
	echo $i."===";
	$sqls="select * from c_opentime_3 where qishu='$i'";
	echo $sqls;
	$tquery=$mysqli->query($sqls);
	$rs = $tquery->fetch_array();
	if($rs['qishu']){
		$actiontime=date("H:i:s",$st_time);
		$fengpan=date("H:i:s", $st_time+4*60);
		$kaijiang=date("H:i:s", $st_time+5*60);
		$strSqls="UPDATE `c_opentime_3` SET `kaipan`='$actiontime',`fengpan`='$fengpan',`kaijiang`='$kaijiang' WHERE (`qishu`='".$rs['qishu']."')";
		echo $strSqls."<br>";
		$ppx.='"'.date("H:i",$st_time).'",';
		$mysqli->query($strSqls);
		$st_time+=60*5;
	}
}}

$curl = &new Curl_HTTP_Client();
$curl->set_referrer("http://www.168kai.com/lottery/10016.html");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.168kai.com/Open/CurrentOpen?code=10016");
$a=array('(',')');
$b=array('[',']');
//$msg = str_replace($a,$b,$html_data);

	$arr= json_decode($html_data,true);
//echo $datetime;
$i=1;
$is_js=0;
if($arr['l_r']){
	$v=explode(",",$arr['l_r']);
	$time 		=  $arr['l_d'];
	$time =date('Y-m-d H:i:s',strtotime($time));
	$qishu		=$arr['l_t'];
	//$year=((int)substr($k,0,5));
	//print_r($val);
	$ball_1		= $v[0];
	$ball_2		= $v[1];
	$ball_3		= $v[2];
	$ball_4		= $v[3];
	$ball_5		= $v[4];
	$ball_6		= $v[5];
	$ball_7		= $v[6];
	$ball_8		= $v[7];
	$ball_9		= $v[8];
	$ball_10	= $v[9];
	if(strlen($qishu)>0){
		$is_js=1;
		$sql="select id from c_auto_3 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql	=	"insert into c_auto_3(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values ('$qishu','$time','$ball_1','$ball_2','$ball_3','$ball_4','$ball_5','$ball_6','$ball_7','$ball_8','$ball_9','$ball_10')";
			$mysqli->query($sql);
			$m=$m+1;
		}else{
			$usql="update c_auto_3 set ball_1=$ball_1,ball_2=$ball_2,ball_3=$ball_3,ball_4=$ball_4,ball_5=$ball_5,ball_6=$ball_6,ball_7=$ball_7,ball_8=$ball_8,ball_9=$ball_9,ball_10=$ball_10,datetime='".$time."' where qishu='".$qishu."'";
				//echo $usql."<br>";
			$mysqli->query($usql);
		}
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
<? $limit= rand(10,20);?>
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
      北京赛车PK拾<br>(<?=$qishu?>期:<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8,$ball_9,$ball_10"?>)<span id="timeinfo"></span>
	  </td>
      
  </tr>
</table>
<? if($is_js){?>
<iframe src="../../Lottery/Auto/Pk10.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
<? }?>
</body>
</html>