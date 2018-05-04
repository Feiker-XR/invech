<?php
include_once("db.php");
include_once("pub_library.php");
include_once("http.class.php");
include_once("mysqlis.php");
include_once("function.php");
header("Content-type: text/html; charset=utf-8");

$list_date=date('Y-m-d',time()-2*60*60);
$bdate=date('m-d',time()-2*60*60);

$base_url = $webdb["datesite"]."/app/member/FT_index.php?uid=".$webdb["cookie"]."&langx=zh-tw&mtype=3";
$thisHttp = new cHTTP();
$thisHttp->setReferer($base_url);
$filename = $webdb["datesite"]."/app/member/result/result.php?game_type=FI&list_date=$list_date&uid=".$webdb["cookie"]."&langx=zh-tw";

$thisHttp->getPage($filename);
$msg = $thisHttp->getContent();
$msg = strtolower($msg);

$a = array(
"<script>",
" ",
"</script>");
$b = array(
"",
"",
""
);
$msg = str_replace($a,$b,$msg);
$m=0;

$data=explode('<trclass="b_cen">',$msg);

for($i=1;$i<sizeof($data);$i++){
	
	$abcde=explode("</td>",$data[$i]);
	$abcde[0]=str_replace('<td>','',$abcde[0]);
	$abcde[0]=str_replace("\n",'',$abcde[0]);
	$datetime=explode('<br>',$abcde[0]);
	$time=explode(':',$datetime[1]);
	if($time[0]*1 < 10) $datetime[1]='0'.($time[0]*1).':'.$time[1];
	$abcd=explode('<br>',$abcde[1]);
	$league=$abcd[1];
	
	$league=rtrim($league,"-");
	$league=str_replace('金融-','',$league);
	$league=strtolower($league);
	$league=str_replace('vs',' vs ',$league);

	$data1=explode('<fontcolor="#cc0000">',$abcde[3]);
	$win=trim(str_replace("<br></font>","",$data1[1]));

	if($win){
		$sql="update t_guanjun set x_result='$win' where x_title='$league' and match_name='$abcd[2]' and match_date='".$datetime[0]."' and match_time='".$datetime[1]."' and match_type=2";
		$mysqlis->query($sql);
		$m++;
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>jrbf</title>
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
	self.location.reload()
else{
	parselimit-=1
	curmin=Math.floor(parselimit)
	if (curmin!=0)
		curtime=curmin+"秒后获取数据！"
	else
		curtime=cursec+"秒后获取数据！"
		timeinfo.innerText=curtime
		setTimeout("beginrefresh()",1000)
	}
}

window.onload=beginrefresh

</script>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left">
    <input type=button name=button value="刷新" onClick="window.location.reload()">
    <?=$m?> 条金融比分！
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
</body>
</html>