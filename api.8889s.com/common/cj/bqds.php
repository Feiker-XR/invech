<?php
include_once("db.php");
include_once("pub_library.php");
include_once("http.class.php");

include_once("mysqlis.php");
include_once("function.php");
header("Content-type: text/html; charset=utf-8");

$langx	=	'zh-tw';
$scend	=	3;
$msg	=	$_GET['msg'] ? $_GET['msg']*1 : 0;
$t_page	=	$_GET['t_page'] ? $_GET['t_page']*1 : 1;
$pages	=	$_GET['pages'] ? $_GET['pages']*1 : 0;
$show_pages	=	$pages+1;
$show_msg	=	$msg;
if($pages<$t_page){
//for($pages=0;$pages<$t_page;$pages++){
	$data=theif_data($webdb["datesite"],$webdb["cookie"],'BS','r',$langx,$pages);
	$pb=explode('t_page=',$data);
	$pb=explode(';',$pb[1]);
	$t_page=$pb[0]*1;
	
	if (sizeof(explode("gamount",$data))>1){
		$k=0;
		preg_match_all("/(Array\(.+\);)/i",$data,$matches);
		$cou=sizeof($matches[0]);
		
		$sql	=	"update Baseball_Match set Match_Type=0 WHERE match_coverdate>'".date("Y-m-d H:i:s")."'"; //默认所有赛事都关盘
		$mysqlis->query($sql);
		
		for($i=0;$i<$cou;$i++){
			$messages=$matches[0][$i];
			$messages=str_replace(");",")",$messages);
			$messages=str_replace("cha(9)","",$messages);
			$messages=str_replace("<font color=#FF0000>","",$messages);
			$messages=str_replace("</font>","",$messages);
			$datainfo=eval("return $messages;");
			if($datainfo[0]+0!=0){
				
				$datainfo[11]	=	substr($datainfo[11],1,strlen($datainfo[11])-1); //去UO
				$datainfo[12]	=	substr($datainfo[27],1,strlen($datainfo[27])-1); //去UO

				if( !$datainfo[9])	$datainfo[9]	 =	0;
				if( !$datainfo[10])	$datainfo[10]	 =	0;
				if( !$datainfo[13])	$datainfo[13]	 =	0;
				if( !$datainfo[14])	$datainfo[14]	 =	0;
				if(empty($datainfo[20])){
					$datainfo[20]	=	0;
				}else{
					$datainfo[20]	-=	0.01;
				}
				if(empty($datainfo[21])){
					$datainfo[21]	=	0;
				}else{
					$datainfo[21]	-=	0.01;
				}
				if( !$datainfo[25])	$datainfo[25]	 =	0;
				if( !$datainfo[26])	$datainfo[26]	 =	0;
				if( !$datainfo[29])	$datainfo[29]	 =	0;
				if( !$datainfo[30])	$datainfo[30]	 =	0;
				if( !$datainfo[34])	$datainfo[34]	 =	0;
				if( !$datainfo[15])	$datainfo[15]	 =	0;
				if( !$datainfo[16])	$datainfo[16]	 =	0;
				if( !$datainfo[17])	$datainfo[17]	 =	0;
				if( !$datainfo[31])	$datainfo[31]	 =	0;
				if( !$datainfo[32])	$datainfo[32]	 =	0;
				if( !$datainfo[33])	$datainfo[33]	 =	0;
				
				$time			=	explode('<br>',strtolower($datainfo[1]));
				$isLose			=	isset($time[2]) ? '1' : '0';
				$CoverDate		=	date("Y").'-'.$time[0].' '.cdate($time[1]);

				$sql	=	"select id from `baseball_match` where Match_ID='".$datainfo[0]."'";
				$mysqlis->query($sql);
				if($mysqlis->affected_rows){ //有数据，更新
					$sql = "update Baseball_Match set Match_Date='$time[0]',Match_Time='$time[1]',Match_Name='$datainfo[2]',Match_Master='$datainfo[5]',Match_Guest='$datainfo[6]',Match_MasterID='$datainfo[3]',Match_GuestID='$datainfo[4]',Match_IsLose='$isLose',Match_Type='1',Match_Ho='$datainfo[9]',Match_Ao='$datainfo[10]',Match_RGG='$datainfo[8]',Match_BzM='$datainfo[15]',Match_BzG='$datainfo[16]',Match_DxGG='$datainfo[11]',Match_DxDpl='$datainfo[14]',Match_DxXpl='$datainfo[13]',Match_DsDpl='$datainfo[20]',Match_DsSpl='$datainfo[21]',Match_ShowType='$datainfo[7]',Match_CoverDate='$CoverDate' WHERE Match_ID='$datainfo[0]' AND Match_StopUpdate=0";
				}else{ //没数据，插入
				    $datainfo[5] = strip_tags($datainfo[5]);
					$datainfo[6] = strip_tags($datainfo[6]);
					$sql = "insert into    Baseball_Match(Match_ID,Match_Date,Match_Time,Match_Name,Match_Master,Match_Guest,Match_MasterID,Match_GuestID,Match_IsLose,Match_Type,Match_Ho,Match_Ao,Match_RGG,Match_DxGG,Match_BzM,Match_BzG,Match_DxDpl,Match_DxXpl,Match_DsDpl,Match_DsSpl,Match_ShowType,Match_CoverDate,Match_MatchTime) values('$datainfo[0]','$time[0]','$time[1]','$datainfo[2]','$datainfo[5]','$datainfo[6]','$datainfo[3]','$datainfo[4]','$isLose','1','$datainfo[9]','$datainfo[10]','$datainfo[8]','$datainfo[11]','$datainfo[15]','$datainfo[16]','$datainfo[14]','$datainfo[13]','$datainfo[20]','$datainfo[21]','$datainfo[7]','$CoverDate','$time[0]')";
				}
				$mysqlis->query($sql);
				$msg++;
			}
			
		}
	}
	$show_msg	=	$msg;
	$pages++;
}else{
	$show_pages--;
	$scend	=	60;
	$t_page	=	0;
	$pages	=	0;
	$msg	=	0;
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
<!-- 
var limit="<?=$scend?>";
if (document.images){ 
	var parselimit=limit
} 

function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.href="?t_page=<?=$t_page?>&msg=<?=$msg?>&pages=<?=$pages?>";
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
    <input type=button name=button value="刷新" onClick="window.location.href='?';">
    <?=$show_pages?>页<?=$show_msg?>条棒球单式！
        <span id="timeinfo"></span>
        </td>
  </tr>
</table>
</body>
</html>