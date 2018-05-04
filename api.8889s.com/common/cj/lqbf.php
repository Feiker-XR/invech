<?php
include_once("db.php");
include_once("pub_library.php");
include_once("http.class.php");
include_once("mysqlis.php");
include_once("function.php");
header("Content-type: text/html; charset=utf-8");

session_start();
if(intval(date('H'))<5)
{
	if($_SESSION["lqbf"]=="0")
	{
		$list_date=date('Y-m-d',time());
		$bdate=date('m-d',time());
		$_SESSION["lqbf"]="-1";
	}
	else
	{
		$list_date=date('Y-m-d',time()-24*3600);
		$bdate=date('m-d',time()-24*3600);
		$_SESSION["lqbf"]="0";
	}
}
else
{
	$list_date=date('Y-m-d',time());
	$bdate=date('m-d',time());
}

//$list_date='2015-02-11';
//$bdate='02-11';
//echo $list_date = '2016-07-31';

$base_url = $webdb["datesite"]."app/member/FT_index.php?uid=".$webdb["cookie"]."&langx=en-us&mtype=3";
$thisHttp = new cHTTP();
$thisHttp->setReferer($base_url);
$filename = $webdb["datesite"]."app/member/result/result.php?game_type=BK&list_date=$list_date&uid=".$webdb["cookie"]."&langx=zh-tw";

$thisHttp->getPage($filename);
$msg = $thisHttp->getContent();
$msg=preg_replace("#<!--([\s\S]*?)-->#","",$msg);
$msg=preg_replace("#<script>([\s\S]*?)</script>#","",$msg);
//print @htmlspecialchars($msg);exit;
preg_match_all("/<tr id=\"TR_8_(.*?)_(.*?)\" style=\"display: \" class=\"full\">([\s\S]*?)<\/tr>/s",$msg,$matches);
$m=0;
for ($i=0;$i<sizeof($matches[1]);$i++){
	$id=trim($matches[1][$i]);
	$match_id=trim($matches[2][$i]);
	
	preg_match_all("/<td class=\"full_main \">(.*?)<\/td>/s",$matches[3][$i],$h8_score);
	$MB_Inball=trim($h8_score[1][0]);
	$TG_Inball=trim($h8_score[1][1]);
	
	preg_match("/<tr class=\"b_cen\" id=\"TR_1_".$id."_".$match_id."\" style=\"display: \">([\s\S]*?)<\/tr>/s",$msg,$h1);
	preg_match_all("/<td><strong>(.*?)<\/strong><\/td>/s",$h1[1],$h1_score);
	$MB_Inball_1st=trim($h1_score[1][0]);
	$TG_Inball_1st=trim($h1_score[1][1]);
	
	preg_match("/<tr class=\"b_cen\" id=\"TR_2_".$id."_".$match_id."\" style=\"display: \">([\s\S]*?)<\/tr>/s",$msg,$h2);
	preg_match_all("/<td><strong>(.*?)<\/strong><\/td>/s",$h2[1],$h2_score);
	$MB_Inball_2st=trim($h2_score[1][0]);
	$TG_Inball_2st=trim($h2_score[1][1]);
	
	preg_match("/<tr class=\"b_cen\" id=\"TR_3_".$id."_".$match_id."\" style=\"display: \">([\s\S]*?)<\/tr>/s",$msg,$h3);
	preg_match_all("/<td><strong>(.*?)<\/strong><\/td>/s",$h3[1],$h3_score);
	$MB_Inball_3st=trim($h3_score[1][0]);
	$TG_Inball_3st=trim($h3_score[1][1]);
	
	preg_match("/<tr class=\"b_cen\" id=\"TR_4_".$id."_".$match_id."\" style=\"display: \">([\s\S]*?)<\/tr>/s",$msg,$h4);
	preg_match_all("/<td><strong>(.*?)<\/strong><\/td>/s",$h4[1],$h4_score);
	$MB_Inball_4st=trim($h4_score[1][0]);
	$TG_Inball_4st=trim($h4_score[1][1]);
	
	preg_match("/<tr id=\"TR_5_".$id."_".$match_id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$h5);
	preg_match_all("/<td class=\"hr_main \">(.*?)<\/td>/s",$h5[1],$h5_score);
	$MB_Inball_HR=trim($h5_score[1][0]);
	$TG_Inball_HR=trim($h5_score[1][1]);
	
	preg_match("/<tr id=\"TR_6_".$id."_".$match_id."\" style=\"display: \" class=\"hr\">([\s\S]*?)<\/tr>/s",$msg,$h6);
	preg_match_all("/<td class=\"hr_main \">(.*?)<\/td>/s",$h6[1],$h6_score);
	$MB_Inball_ER=trim($h6_score[1][0]);
	$TG_Inball_ER=trim($h6_score[1][1]);
	
	preg_match("/<tr class=\"b_cen\" id=\"TR_7_".$id."_".$match_id."\" style=\"display: \">([\s\S]*?)<\/tr>/s",$msg,$h7);
	preg_match_all("/<td><strong>(.*?)<\/strong><\/td>/s",$h7[1],$h7_score);
	$MB_Inball_Add=intval(trim($h7_score[1][0]));
	$TG_Inball_Add=intval(trim($h7_score[1][1]));
	
	//获取对阵双方
	preg_match("/<tr class=\"b_cen\" id=\"TR_".$id."_".$match_id."\" style=\"display: \" >([\s\S]*?)<\/tr>/s",$msg,$team);
	preg_match_all("/<td class=\"team_(.*?)\">(.*?)<\/td>/s",$team[1],$team_name);
	$c_team=trim(trim($team_name[2][0],"&nbsp;"));
	$h_team=trim(trim($team_name[2][1],"&nbsp;"));
	$c1_team=$c_team." - (第1节)";
	$h1_team=$h_team." - (第1节)";
	$c2_team=$c_team." - (第2节)";
	$h2_team=$h_team." - (第2节)";
	$c3_team=$c_team." - (第3节)";
	$h3_team=$h_team." - (第3节)";
	$c4_team=$c_team." - (第4节)";
	$h4_team=$h_team." - (第4节)";
	$cr1_team=$c_team." - (上半)";
	$hr1_team=$h_team." - (上半)";
	$cr2_team=$c_team." - (下半)";
	$hr2_team=$h_team." - (下半)";
	$ca_team=$c_team." - (加时)";
	$ha_team=$h_team." - (加时)";
	
	preg_match("/<span onClick=\"showLEG\('".$id."'\);\" class=\"leg_bar\">(.*?)<\/span>/s",$msg,$match_name_main);
	$match_name_main=trim($match_name_main[1]);
	/*
	echo "<br>".$match_name_main."<br>"
		.$c_team." ".$MB_Inball.":".$TG_Inball." ".$h_team."<br>"
		.$c1_team." ".$MB_Inball_1st.":".$TG_Inball_1st." ".$h1_team."<br>"
		.$c2_team." ".$MB_Inball_2st.":".$TG_Inball_2st." ".$h2_team."<br>"
		.$c3_team." ".$MB_Inball_3st.":".$TG_Inball_3st." ".$h3_team."<br>"
		.$c4_team." ".$MB_Inball_4st.":".$TG_Inball_4st." ".$h4_team."<br>"
		.$cr1_team." ".$MB_Inball_HR.":".$TG_Inball_HR." ".$hr1_team."<br>"
		.$cr2_team." ".$MB_Inball_ER.":".$TG_Inball_ER." ".$hr2_team."<br>"
		.$ca_team." ".$MB_Inball_Add.":".$TG_Inball_Add." ".$ha_team."<br>";
	*/
	if(is_numeric($TG_Inball) && is_numeric($MB_Inball)){
		$sql='update lq_match set MB_Inball_Add='.$MB_Inball_Add.',MB_Inball_ER='.$MB_Inball_ER.',MB_Inball_HR='.$MB_Inball_HR.',MB_Inball_1st='.$MB_Inball_1st.',MB_Inball_2st='.$MB_Inball_2st.',MB_Inball_3st='.$MB_Inball_3st.',MB_Inball_4st='.$MB_Inball_4st.',MB_Inball='.$MB_Inball.',MB_Inball_OK='.$MB_Inball.',TG_Inball_1st='.$TG_Inball_1st.',TG_Inball_2st='.$TG_Inball_2st.',TG_Inball_3st='.$TG_Inball_3st.',TG_Inball_4st='.$TG_Inball_4st.',TG_Inball='.$TG_Inball.',TG_Inball_Add='.$TG_Inball_Add.',TG_Inball_HR='.$TG_Inball_HR.',TG_Inball_ER='.$TG_Inball_ER.',TG_Inball_OK='.$TG_Inball." where match_master='$c_team' and match_guest='$h_team' and match_name='$match_name_main'  and Match_Date='$bdate'";
		$mysqlis->query($sql);
	
		/*
		$sql='update lq_match set MB_Inball_Add='.$MB_Inball_Add.',MB_Inball_ER='.$MB_Inball_ER.',MB_Inball_HR='.$MB_Inball_HR.',MB_Inball_1st='.$MB_Inball_1st.',MB_Inball_2st='.$MB_Inball_2st.',MB_Inball_3st='.$MB_Inball_3st.',MB_Inball_4st='.$MB_Inball_4st.',MB_Inball='.$MB_Inball.',MB_Inball_OK='.$MB_Inball.',TG_Inball_1st='.$TG_Inball_1st.',TG_Inball_2st='.$TG_Inball_2st.',TG_Inball_3st='.$TG_Inball_3st.',TG_Inball_4st='.$TG_Inball_4st.',TG_Inball='.$TG_Inball.',TG_Inball_Add='.$TG_Inball_Add.',TG_Inball_HR='.$TG_Inball_HR.',TG_Inball_ER='.$TG_Inball_ER.',TG_Inball_OK='.$TG_Inball.' where match_id='.$match_id."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		*/
	}
			
	if(is_numeric($MB_Inball_1st) && is_numeric($TG_Inball_1st)){
		//1st	
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_1st.',MB_Inball_OK='.$MB_Inball_1st.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_1st.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_1st." where match_master='$c1_team' and match_guest='$h1_team' and match_name='$match_name_main'  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		
		/*
		$match_id3=$match_id+3;
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_1st.',MB_Inball_OK='.$MB_Inball_1st.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_1st.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_1st.' where match_id='.$match_id3."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		*/
	}
			
	if(is_numeric($MB_Inball_2st) && is_numeric($TG_Inball_2st)){
		//2st				
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_2st.',MB_Inball_OK='.$MB_Inball_2st.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_2st.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_2st." where match_master='$c2_team' and match_guest='$h2_team' and match_name='$match_name_main'  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		
		/*
		$match_id4=$match_id+4;
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_2st.',MB_Inball_OK='.$MB_Inball_2st.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_2st.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_2st.' where match_id='.$match_id4."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		*/
	}
	
	if(is_numeric($MB_Inball_3st) && is_numeric($TG_Inball_3st)){
		//3st				
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_3st.',MB_Inball_OK='.$MB_Inball_3st.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_3st.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_3st." where match_master='$c3_team' and match_guest='$h3_team' and match_name='$match_name_main'  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		
		/*
		$match_id5=$match_id+5;
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_3st.',MB_Inball_OK='.$MB_Inball_3st.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_3st.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_3st.' where match_id='.$match_id5."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		*/
	}
	
	if(is_numeric($MB_Inball_4st) && is_numeric($TG_Inball_4st)){
		//4st				
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_4st.',MB_Inball_OK='.$MB_Inball_4st.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_4st.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_4st." where match_master='$c4_team' and match_guest='$h4_team' and match_name='$match_name_main'  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		
		/*
		$match_id6=$match_id+6;
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_4st.',MB_Inball_OK='.$MB_Inball_4st.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_4st.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_4st.' where match_id='.$match_id6."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		*/
	}
	
	if(is_numeric($MB_Inball_HR) && is_numeric($TG_Inball_HR)){
		//上半
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_HR.',MB_Inball_OK='.$MB_Inball_HR.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_HR.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_HR." where match_master='$cr1_team' and match_guest='$hr1_team' and match_name='$match_name_main'  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		
		/*
		$match_id1=$match_id+1;
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_HR.',MB_Inball_OK='.$MB_Inball_HR.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_HR.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_HR.' where match_id='.$match_id1."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		*/
	}
	
	if(is_numeric($MB_Inball_ER) && is_numeric($TG_Inball_ER)){
		//下半
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_ER.',MB_Inball_OK='.$MB_Inball_ER.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_ER.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_ER." where match_master='$cr2_team' and match_guest='$hr2_team' and match_name='$match_name_main'  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		
		/*
		$match_id2=$match_id+2;
		$sql='update lq_match set MB_Inball_Add=0,MB_Inball_ER=0,MB_Inball_HR=0,MB_Inball_1st=0,MB_Inball_2st=0,MB_Inball_3st=0,MB_Inball_4st=0,MB_Inball='.$MB_Inball_ER.',MB_Inball_OK='.$MB_Inball_ER.',TG_Inball_1st=0,TG_Inball_2st=0,TG_Inball_3st=0,TG_Inball_4st=0,TG_Inball='.$TG_Inball_ER.',TG_Inball_Add=0,TG_Inball_HR=0,TG_Inball_ER=0,TG_Inball_OK='.$TG_Inball_ER.' where match_id='.$match_id2."  and Match_Date='$bdate'";
		$mysqlis->query($sql);
		*/
	}

	$m++;
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
var limit="80"
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
    <?=$m?> 条篮球比分！
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
</body>
</html>