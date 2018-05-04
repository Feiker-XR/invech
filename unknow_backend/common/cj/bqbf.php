<?php
include_once("db.php");
include_once("pub_library.php");
include_once("http.class.php");
include_once("mysqlis.php");
include_once("function.php");
header("Content-type: text/html; charset=utf-8");

session_start();
if(intval(date('H'))<6)
{
	if($_SESSION["bqbf"]=="0")
	{
		$list_date=date('Y-m-d',time());
		$bdate=date('m-d',time());
		$_SESSION["bqbf"]="-1";
	}
	else
	{
		$list_date=date('Y-m-d',time()-24*3600);
		$bdate=date('m-d',time()-24*3600);
		$_SESSION["bqbf"]="0";
	}
}
else
{
	$list_date=date('Y-m-d',time());
	$bdate=date('m-d',time());
}

$base_url = $webdb["datesite"]."app/member/BS_index.php?uid=".$webdb["cookie"]."&langx=en-us&mtype=3";
$thisHttp = new cHTTP();
$thisHttp->setReferer($base_url);
$filename = $webdb["datesite"]."app/member/result/result.php?game_type=BS&list_date=$list_date&uid=".$webdb["cookie"]."&langx=zh-tw";

$thisHttp->getPage($filename);
$msg = $thisHttp->getContent();
$msg = strtolower($msg);
preg_match_all("/<tr id=\"tr_1_(.*?)_(.*?)\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$matches);
$m=0;
for ($i=0;$i<sizeof($matches[1]);$i++){
	$id=trim($matches[1][$i]);
	$match_id=trim($matches[2][$i]);
	
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$matches[3][$i],$hr_score);
	$t0=trim($hr_score[1][0]);
	$m0=trim($hr_score[1][1]);
	
	preg_match("/<tr id=\"tr_2_".$id."_".$match_id."\" style=\"display: \" class=\"full\">([\s\S]*?)<\/tr>/s",$msg,$full);
	preg_match_all("/<span style=\"overflow:hidden;\">(.*?)<\/span>/s",$full[1],$full_score);
	$t1=trim($full_score[1][0]);
	$m1=trim($full_score[1][1]);
	
	$t0=(is_numeric($t0))?$t0:"-1";
	$m0=(is_numeric($m0))?$m0:"-1";
	$t1=(is_numeric($t1))?$t1:"-1";
	$m1=(is_numeric($m1))?$m1:"-1";
	
	if(strlen($t1)<5 && strlen($t0)<5 && strlen($m1)<5 && strlen($m0)<5){
		$sql="update baseball_match set mb_inball='$t1',tg_inball='$m1',tg_inball_hr='$m0',mb_inball_hr='$t0' where match_id=$match_id  and Match_Date='$bdate'";
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
    <?=$m?> 条棒球比分！
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
</body>
</html>