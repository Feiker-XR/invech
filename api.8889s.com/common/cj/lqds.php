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
	$data=theif_data($webdb["datesite"],$webdb["cookie"],'BK','all',$langx,$pages);
	
	$pb=explode('t_page=',$data);
	$pb=explode(';',$pb[1]);
	$t_page=$pb[0]*1;
	
	if (sizeof(explode("gamount",$data))>1){
		$k=0;
		preg_match_all("/(Array\(.+\);)/i",$data,$matches);
		$cou=sizeof($matches[0]);
		for($i=0;$i<$cou;$i++){
			$messages		=	$matches[0][$i];
			$messages		=	str_replace("Array(","",$messages);
			$messages		=	str_replace(");","",$messages);
			$messages		=	str_replace("cha(9)","",$messages);
			$messages		=	str_replace("'","",$messages);
			$datainfo= explode(",",$messages);

			if($datainfo[0]+0!=0){
				$datainfo[12] =	str_replace('U','',$datainfo[12]);
				$datainfo[11] =	str_replace('O','',$datainfo[11]);
				$datainfo[6] =	str_replace('<font color=gray>','',$datainfo[6]);
				$datainfo[6] =	str_replace('</font>','',$datainfo[6]);
				$datainfo[5] =	str_replace('<font color=gray>','',$datainfo[5]);
				$datainfo[5] =	str_replace('</font>','',$datainfo[5]);
				if($datainfo[9] == ""){$datainfo[9]=0;}
				if($datainfo[10] == ""){$datainfo[10]=0;}
				if($datainfo[13] == ""){$datainfo[13]=0;}
				if($datainfo[14] == ""){$datainfo[14]=0;}
				if($datainfo[20] == ""){$datainfo[20]=0;}
				if($datainfo[21] == ""){$datainfo[21]=0;}
				if(empty($datainfo[18])){
					$datainfo[18]	=	0;
				}else{
					$datainfo[18]	-=	0.01;
				}
				if(empty($datainfo[17])){
					$datainfo[17]	=	0;
				}else{
					$datainfo[17]	-=	0.01;
				}
				if($datainfo[9]==0.01 || $datainfo[10]==0.01){ //皇冠测试水位，不显示
					$datainfo[8]	=	'';
					$datainfo[9]	=	0;
					$datainfo[10]	=	0;
				}
				if($datainfo[13]==0.01 || $datainfo[14]==0.01){ //皇冠测试水位，不显示
					$datainfo[11]	=	'';
					$datainfo[13]	=	0;
					$datainfo[14]	=	0;
				}
				
				$time =	explode('<br>',strtolower($datainfo[1]));
				$preg1 = "/(第[0-9]節)/";
				if(preg_match($preg1,$datainfo[5]) || strpos($datainfo[5],"(上半)")){
					$match_type=3;
				}elseif(date("m-d")==$time[0]){
					$match_type=1;
				}elseif(date("m-d")<$time[0]){
					$match_type=0;
				}
				$time			=	explode('<br>',strtolower($datainfo[1]));
				$isLose			=	isset($time[2]) ? '1' : '0';
				$CoverDate		=	date("Y").'-'.$time[0].' '.cdate($time[1]);
			
				$HgDate = $time[0].' '.$time[1];
				$sql = "select id from `Lq_Match` where Match_ID='".$datainfo[0]."'";
				$mysqlis->query($sql);
				if($mysqlis->affected_rows){ //有数据，更新
					if($match_type==1){
						$sql	=	"update lq_match set Match_Date='$time[0]',Match_Time='$time[1]',Match_IsLose=$isLose,Match_Type=$match_type,Match_ShowType='$datainfo[7]',Match_Ho='$datainfo[9]',Match_Ao='$datainfo[10]',Match_RGG='$datainfo[8]',Match_DxGG='$datainfo[11]',Match_DxDpl='$datainfo[14]',Match_DxXpl='$datainfo[13]',Match_DsDpl='$datainfo[20]',Match_DsSpl='$datainfo[21]',Match_CoverDate='$CoverDate',Match_MasterID='$datainfo[3]',Match_GuestID='$datainfo[4]',Match_LstTime=now(),iPage=".($pages+1).",iSn=".($i+1)." WHERE Match_ID=$datainfo[0]  AND Match_StopUpdateds=0;";
					}else{
						$sql	=	"update lq_match set Match_Date='$time[0]',Match_Time='$time[1]',Match_IsLose=$isLose,Match_Type=$match_type,Match_ShowType='$datainfo[7]',Match_Ho='$datainfo[9]',Match_Ao='$datainfo[10]',Match_RGG='$datainfo[8]',Match_DxGG='$datainfo[11]',Match_DxDpl='$datainfo[14]',Match_DxXpl='$datainfo[13]',Match_DsDpl='$datainfo[20]',Match_DsSpl='$datainfo[21]',Match_CoverDate='$CoverDate',Match_MasterID='$datainfo[3]',Match_GuestID='$datainfo[4]',Match_LstTime=now(),iPage=".($pages+1).",iSn=".($i+1)." WHERE Match_ID=$datainfo[0]  AND Match_StopUpdatezc=0;";
					}
				}else{ //没数据，插入
				    $datainfo[5] = strip_tags($datainfo[5]);
					$datainfo[6] = strip_tags($datainfo[6]);
					$sql	=	"insert into lq_match(Match_ID,Match_Date,Match_Time,Match_Name,Match_Master,Match_Guest,Match_IsLose,Match_Type,Match_ShowType,Match_Ho,Match_Ao,Match_RGG,Match_DxGG,Match_DxDpl,Match_DxXpl,Match_DsDpl,Match_DsSpl,Match_CoverDate,Match_MatchTime,Match_MasterID,Match_GuestID,Match_LstTime,iPage,iSn)values('$datainfo[0]','$time[0]','$time[1]','$datainfo[2]','$datainfo[5]','$datainfo[6]','$isLose','$match_type','$datainfo[7]','$datainfo[9]','$datainfo[10]','$datainfo[8]','$datainfo[11]','$datainfo[14]','$datainfo[13]','$datainfo[20]','$datainfo[21]','$CoverDate','$HgDate','$datainfo[3]','$datainfo[4]',now(),".($pages+1).",".($i+1).")";
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
    <?=$show_pages?>页<?=$show_msg?>条篮球数据！
        <span id="timeinfo"></span>
        </td>
  </tr>
</table>
</body>
</html>