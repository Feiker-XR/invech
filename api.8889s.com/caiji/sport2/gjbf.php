<?php
include_once("include.php");
include_once($db_path."mysqlis.php");

header("Content-type: text/html; charset=utf-8");

session_start();
if(intval(date('H'))<6)
{
	if($_SESSION["gjbf"]=="0")
	{
		$list_date=date('Y-m-d',time());
		$bdate=date('m-d',time());
		$_SESSION["gjbf"]="-1";
	}
	else
	{
		$list_date=date('Y-m-d',time()-24*3600);
		$bdate=date('m-d',time()-24*3600);
		$_SESSION["gjbf"]="0";
	}
}
else
{
	$list_date=date('Y-m-d',time());
	$bdate=date('m-d',time());
}

$base_url	=	$webdb["datesite"]."app/member/FT_index.php?uid=".$webdb["cookie"]."&langx=zh-tw&mtype=3";
$thisHttp	=	new cHTTP();
$thisHttp->setReferer($base_url);
$filename	=	$webdb["datesite"]."app/member/result/result_fs.php?game_type=FT&list_date=$list_date&uid=".$webdb["cookie"]."&langx=zh-tw";

$thisHttp->getPage($filename);
$msg = $thisHttp->getContent();

$a = array(
"<script>",
"</script>",
'class="time"',
"<BR>");
$b = array(
"",
"",
"",
"<br>"
);
$msg = str_replace($a,$b,$msg);
$m=0;

$data=explode('<tr class="b_cen" >',$msg);

for($i=1;$i<sizeof($data);$i++){
	$abcde=explode("</td>",$data[$i]);
	$abcde[0]=str_replace(array(' ','<td>',"\n"),array('','',''),$abcde[0]);
	$datetime=explode('<br>',$abcde[0]);
	$time=explode(':',$datetime[1]);
	$abcd=explode('<br>',$abcde[1]);

	$data1=explode('<font color="#CC0000">',$abcde[3]);
	$win=trim(str_replace("<br></font>","",$data1[1]));
	
	$match_time	=	checktime($datetime[1]);

	if($win){
		$sql	=	"update t_guanjun set x_result='$win' where match_name='".trim($abcd[2])."' and match_date='".$datetime[0]."' and match_time='".$match_time."' and match_type=1";
		$mysqlis->query($sql);
		$m++;
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
<script>
<!--
var limit="100"
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
    <?=$m?> 条冠军比分！
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
</body>
</html>