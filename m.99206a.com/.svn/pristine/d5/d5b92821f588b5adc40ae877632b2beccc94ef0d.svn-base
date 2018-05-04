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
$curl = &new Curl_HTTP_Client();
$html_data = $curl->fetch_url("http://baidu.lecai.com/lottery/draw/view/557");
//$data=explode("</ul>",strtolower($html_data));
		preg_match_all("/latest_draw_result = \{(.+?)\}/is",$html_data,$t);
		$temp = (str_replace("latest_draw_result = ","",$t[0][0]));
		$v1=(substr($temp,9,2));
		$v2=(substr($temp,14,2));
		$v3=(substr($temp,19,2));
		$v4=(substr($temp,24,2));
		$v5=(substr($temp,29,2));
		$v6=(substr($temp,34,2));
		$v7=(substr($temp,39,2));
		$v8=(substr($temp,44,2));
		$v9=(substr($temp,49,2));
		$v10=(substr($temp,54,2));
		$array['num'] = json_decode($temp)->red;
		preg_match_all("/latest_draw_time = \'(.+?)\'/is",$html_data,$t);
		$array['time'] = $t[1][0];
		preg_match_all("/latest_draw_phase = \'(.+?)\'/is",$html_data,$t);
		$dd[$t[1][0]] = $array;
		preg_match_all("/phasedata = \{(.+?)\};/is",$html_data,$data);
		$temp= (str_replace("phaseData = ","",$data[0][0]));
		$a = (json_decode(substr($temp,0,strlen($temp)-1)));
		
		foreach ((array)$a as $val){
			foreach ($val as $k=>$vv){
				$dd[$k] = array('num'=>$vv->result->red,'time'=>$vv->open_time);
			}
			//print_r($k);
			//print_r($dd[$k]);
			print_r($v1);print_r($v2);print_r($v3);print_r($v4);
print_r($v5);print_r($v6);
print_r($v7);print_r($v8);print_r($v9);print_r($v10);
		}

foreach ($dd as $k=>$val){
	$v 			= $val['num'];
	$time 		= $val['time'];
	$qishu		= $k+1;
	//$year=((int)substr($k,0,5));
	//print_r($val);
	$ball_1		= $v1;
	$ball_2		= $v2;
	$ball_3		= $v3;
	$ball_4		= $v4;
	$ball_5		= $v5;
	$ball_6		= $v6;
	$ball_7		= $v7;
	$ball_8		= $v8;
	$ball_9		= $v9;
	$ball_10	= $v10;
	if(strlen($qishu)>0){
		$sql="select id from c_auto_3 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql	=	"insert into c_auto_3(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values ('$qishu','$time','$ball_1','$ball_2','$ball_3','$ball_4','$ball_5','$ball_6','$ball_7','$ball_8','$ball_9','$ball_10')";
			//echo $sql."<br>";
			$mysqli->query($sql);
			$m=$m+1;
		}else{
			//$usql="update c_auto_3 set ball_1=$ball_1,ball_2=$ball_2,ball_3=$ball_3,ball_4=$ball_4,ball_5=$ball_5,ball_6=$ball_6,ball_7=$ball_7,ball_8=$ball_8,ball_9=$ball_9,ball_10=$ball_10,datetime='".$time."' where qishu='".$qishu."'";
			//	echo $usql."<br>";
			//$mysqli->query($usql);
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
//window.onload=beginrefresh
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()">
      北京赛车PK拾<br>(<?=$qishu?>期:<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8,$ball_9,$ball_10"?>)<br><span id="timeinfo"></span>
	  </td>
      
  </tr>
</table>
<iframe src="../../Lottery/Auto/Pk10.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>