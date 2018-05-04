<?php
error_reporting(E_ERROR);
set_time_limit(0);
//ini_set("display_errors","yes");
include_once("db.php");
include_once("pub_library.php");
include_once("curl_http.php");
//include_once('mysqlio.php');
include_once("function.php");
header("Content-type: text/html; charset=utf-8");


include("../include/mysqli.php");
$sql = "select * from wangzhi_manage where id=1";
$query = $mysqli->query($sql);
$temprow = $query->fetch_array();
$webdb['datesite']		=	$temprow['wangzhi']; //读取为新表wangzhi30
$webdb['user']			=	$temprow['zhanghao']; //读取为新表zhanghao
$webdb['pawd']			=	$temprow['mima']; //读取为新表mima


$curl = &new Curl_HTTP_Client();
$curl->store_cookies(dirname(__FILE__) . "/cache/cookies.txt"); 
$curl->set_user_agent("Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
//$v1='http://180.94.228.140/';
//$v2 = 'http://hg0088.com/';
//$curl->set_proxy_username_password('shanshan','shanshan');
//$curl->set_proxy('119.28.54.165');
//$curl->set_proxy_port('808');

$v1 = $webdb['datesite']; //对应到新表的wangzhi
$v2 = $webdb['datesite']; //对应到新表的wangzhi
$v = 'v'.rand(1,2);
$v = $$v;
$login=array();
$login['username']=$webdb["user"];
$login['password']=$webdb["pawd"];
$login['langx']="zh-tw";
$curl->set_referrer("".$v."");
$html_date=$curl->fetch_url("".$v."/app/member/","",5);
//$html_date=$curl->fetch_url('http://hg7088.com/');
//echo($html_date);
$html_date=$curl->send_post_data("".$v."/app/member/login.php",$login,"",5);
//iconv('gb2312','utf8',$html_date);
//var_dump(htmlspecialchars($html_date));
//echo htmlentities($html_date);
//exit;
preg_match("/(uid=[\w]+)&/",$html_date,$uid);
$uid = str_replace(array("uid=","&"),array("",""),$uid[0]);

/*preg_match("/location.href = '([^']+)/si",$html_date,$turl);
$curl->set_referrer("".$v."/app/member/login.php");
$tdate=$curl->fetch_url($turl[1]);
preg_match("/action='([^']+)/si",$tdate,$wurl);
$v=$wurl[1];

if(!$v)$v=$webdb["datesite"];*/
//$v='http://hg3088.com';
if(strlen($uid)>20  ){
	$cache	= "<?php\r\n";
	$cache .= "\$webdb['cookie']		=	'".$uid."';\r\n";
	$cache .= "\$webdb['datesite']		=	'".$v."';\r\n";
	$cache .= "\$webdb['user']			=	'".$webdb['user']."';\r\n";
	$cache .= "\$webdb['pawd']			=	'".$webdb['pawd']."';\r\n";
	$cache .= "\$webdb['uid']			=	'1';\r\n?>";
	if(!write_file("db.php",$cache)){ //写入缓存失败
		$meg	=	"缓存文件写入失败！请先设db.php文件权限为：0777";
	}
	
		write_file("../../../wap/zxcv567890/cj/db.php",$cache);
}
	if($uid){
		echo '成功獲取繁體的uid: '.$uid.'<br>';
	}else{
		echo "繁體登陸錯誤!\\請檢查繁體用戶名和密碼!!<br><br>";	
	}
	echo $webdb['user'].'<br />'.$v;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UID接收</title>
<?php
if(!$uid[1] ||(strlen($uid)<20&&strlen($uid)>12)){
?>
<meta http-equiv="refresh" content="5"> 
<?php
 } 
?>
<style type="text/css">
<!--
* {
	margin:0;
}
-->
</style>
</head>
<script> 
<!-- 
var limit="240" 
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
		curtime=curmin+"秒后自动获取UID!" 
	else 
		curtime=cursec+"秒后自动获取UID!"
		timeinfo.innerHTML=curtime
		setTimeout("beginrefresh()",1000) 
	} 
} 

window.onload=beginrefresh 
-->
</script>
<body>
<table width="150" height="100" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="150" height="100" align="center">
      <span id="timeinfo"></span><br>
      <input type=button name=button value="重新登陆" onClick="window.location.reload()"></td>
  </tr>
</table>
</body>
</html>
