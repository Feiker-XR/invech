
<?
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

function simplest_xml_to_array($xmlstring) {
    return json_decode(json_encode((array) simplexml_load_string($xmlstring)), true);
}
$curl = &new Curl_HTTP_Client();
$data = simplest_xml_to_array($curl->fetch_url("http://cp.swlc.sh.cn/cams/xml/award_02.xml"));
$allcount=0;

foreach ($data['p'] as $vv){
	$v 			= $vv['@attributes'];
	$qihao 		= str_replace("-",'',$v['id']);
	$addtime 	= $v['t'];
	$result 	= explode(",",$v['c']);
	$hm1		= $result['0'];
	$hm2		= $result['1'];
	$hm3		= $result['2'];
	$sql = "select * from lottery_k_ssl where qihao='$qihao'";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;
	if($tcou==0){
		$mysql="insert into lottery_k_ssl set qihao='$qihao',hm1='$hm1',hm2='$hm2',hm3='$hm3',addtime='$addtime'";
		$mysqli->query($mysql);
		$m=$m+1;
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
      上海时时乐(<?=$qihao?>期:<?="$hm1,$hm2,$hm3"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="ssl_auto.php?qi=<?=$qihao?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>  
</body>
</html>