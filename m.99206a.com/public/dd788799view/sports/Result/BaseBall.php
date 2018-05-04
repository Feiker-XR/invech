<?php
session_start();
include_once("../../include/mysqlis.php");
include_once("../../include/config.php");
$date	=	date('Y-m-d',time());
if($_GET['ymd']) $date	=	$_GET['ymd'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link href="../css/sports_right.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="top" style="height:25px; border:1px #ACACAC solid; margin-bottom:5px; background-color:#838383; line-height:25px;">
<div class="result_title"><span>棒球结果 >></span><?php for($i=0;$i<7;$i++){ $d	=	date('Y-m-d',time()-$i*86400);$dd	=	date('m-d',time()-$i*86400);?><li<?= $d==$date ? ' class="i"' : ''?>><?= $d==$date ? ' ' : '<a href="?ymd='.$d.'">'?><?=$dd?><?= $d==$date ? '' : '</a>'?></li><?php }?></div>
</div>
<table border="0" cellspacing="1" cellpadding="0" class="box" bgcolor='#ACACAC'>
  <tr>
    <th width="100">开赛时间</th>
    <th>主场/客场</th>
    <th width="80">上半比分</th>
    <th width="80">全场比分</th>
  </tr>
<?php
$sql	=	"select Match_Date,Match_Time,match_name,match_master,match_guest,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR from baseball_match where MB_Inball is not null and  match_Date='".date('m-d',strtotime($date))."' and match_js=1";//
$query	=	$mysqlis->query($sql);  		
$rows	=	$query->fetch_array();
if(!$rows){
	echo "<tr><td height='100' colspan='4' align='center' bgcolor='#FFFFFF'>暂无任何赛果</td></tr>";
}else{
	do{
		if($temp_match_name!=$rows["match_name"]){
			$temp_match_name=$rows["match_name"]; 
?>
  <tr>
    <td colspan="4" align="center" class='liansai'><strong><?=$rows["match_name"]?></strong></td>
  </tr>
<?php
		}
?>
  <tr>
    <td class='zhong line'><?=$rows["Match_Date"]?> <?=$rows["Match_Time"]?></td>
    <td class='line'><?=$rows["match_master"]?><br /><font color="#990000"><?=$rows["match_guest"]?></font></td>
    <td class='zhong line red'><?php if($rows["MB_Inball"]<0) {?>赛事无效<?php }else{ ?><?=$rows["MB_Inball_HR"]?><?php } ?><br /><?php if($rows["TG_Inball"]<0) { ?>赛事无效<?php }else{?><?=$rows["TG_Inball_HR"] ?><?php } ?></td>
    <td class='zhong line red'><?php if($rows["MB_Inball"]<0) {?>赛事无效<?php }else{ ?><?=$rows["MB_Inball"]?><?php } ?><br /><?php if($rows["TG_Inball"]<0) { ?>赛事无效<?php }else{?><?=$rows["TG_Inball"] ?><?php } ?></td>
  </tr>
<?php
	}while($rows = $query->fetch_array());
}
?>
</table>
</body>
</html>