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
	$data=theif_data($webdb["datesite"],$webdb["cookie"],'FS','fi',$langx,$pages);
	$pb=explode('t_page=',$data);
	$pb=explode(';',$pb[1]);
	$t_page=$pb[0]*1;
	
	if (sizeof(explode("gamount",$data))>1){
		$k=0;
		preg_match_all("/g\((.+?)\);/is",$data,$matches);
		$cou=sizeof($matches[0]);
		
		for($i=0;$i<$cou;$i++){
			$messages		=	$matches[0][$i];
			$messages		=	str_replace("g(","",$messages);
			$messages		=	str_replace(");","",$messages);
			$messages		=	str_replace("cha(9)","",$messages);
			$messages		=	str_replace("'","\"",$messages);
			$datainfo= json_decode($messages,true);
            
			if($datainfo[0]+0!=0){
				$datainfo[2]	=	str_replace("金融-",'',$datainfo[2]);
				$datainfo[2]	=	str_replace(" ",'',$datainfo[2]);
				$date			=	date("m-d",strtotime($datainfo[1]));
				$time			=	datetoap(date("H:i:s",strtotime($datainfo[1])));
				$xid			=	0;
				$sql			=	"select x_id from t_guanjun where match_id='".$datainfo[0]."' and match_type=2";
				$query			=	$mysqlis->query($sql);
				if($row			=	$query->fetch_array()){ //有数据，更新
					$xid		=	$row["x_id"];
					$sql		=	"update t_guanjun set match_name='$datainfo[3]',x_title='$datainfo[2]',match_date='$date',match_time='$time',match_coverdate='$datainfo[1]',add_time=now() WHERE Match_ID='$datainfo[0]' and match_type=2";
					$mysqlis->query($sql);
				}else{ //没数据，添加
					$sql		=	"insert into t_guanjun(match_name,x_title,match_date,match_time,match_coverdate,add_time,match_id,match_type) values('$datainfo[3]','$datainfo[2]','$date','$time','$datainfo[1]',now(),'$datainfo[0]',2)";
					$mysqlis->query($sql);
					$xid		=	$mysqlis->insert_id;
				}
				
				for($xb=8;$xb<=($datainfo[5]+1)*4;$xb+=4){
					$sql			=	"select tid from t_guanjun_team where match_id='".$datainfo[$xb-1]."' and xid='$xid' and match_type=2";
					$mysqlis->query($sql);
					if($mysqlis->affected_rows){ //有数据，更新
						$sql		=	"update t_guanjun_team set team_name='".$datainfo[$xb]."',point='".$datainfo[$xb+1]."' WHERE Match_ID='".$datainfo[$xb-1]."' and xid='$xid' and match_type=2";
					}else{ //没数据，添加
						$sql		=	"insert into t_guanjun_team(team_name,point,match_id,xid,match_type) values ('".$datainfo[$xb]."','".$datainfo[$xb+1]."','".$datainfo[$xb-1]."','$xid',2)";
					}
					$mysqlis->query($sql);
				}
				$msg++;
			}
		}
	}
	$show_msg	=	$msg;
	$pages++;
}else{
	$show_pages--;
	$scend	=	600;
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
    <?=$show_pages?>页<?=$show_msg?>条金融数据！
        <span id="timeinfo"></span>
        </td>
  </tr>
</table>
</body>
</html>