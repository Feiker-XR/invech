<?php
@session_start();
header("Content-type: text/html; charset=utf-8");
include_once("../../include/mysqli.php");
include_once("../../include/mysqlis.php");
include_once("../../class/lq_match.php");
include_once("../../common/function.php");
include_once("../../common/logintu.php");
//这里要进行时间判断
$uid = $_SESSION["uid"];
sessionBet($uid); //这里要进行时间判断
islogin_match($uid); //未登陆，退出登陆状态
 
$rows=lq_match::getmatch_info(intval($_POST["match_id"]),$_POST["point_column"],$_POST["ball_sort"]);
$touzhuxiang	=	$_POST["touzhuxiang"];
$temp_array		=	explode("-",$touzhuxiang);
if($temp_array[0]=="让球"){
	$touzhuxiang = ereg_replace("[0-9\.\/]{1,}-",$rows["match_rgg"]."-",$touzhuxiang);
}
if($temp_array[0]=="大小"){
	$touzhuxiang = ereg_replace("[0-9.]{1,}",$rows["match_dxgg"],$touzhuxiang);
}
?>
<div class="match_msg"> 
<input type="hidden" name="ball_sort[]" value="<?=$_POST["ball_sort"]?>" />
<input type="hidden" name="point_column[]" value="<?=$_POST["point_column"]?>" />
<input type="hidden" name="match_id[]" value="<?=$_POST["match_id"]?>" />
<input type="hidden" name="match_name[]" value="<?=$rows["match_name"]?>"  />
<input type="hidden" name="match_showtype[]" value="<?=$rows["match_showtype"]?>"  />
<input type="hidden" name="match_rgg[]" value="<?=$rows["match_rgg"]?>"  />
<input type="hidden" name="match_dxgg[]" value="<?=$rows["match_dxgg"]?>"  />
<input type="hidden" name="match_nowscore[]" value="<?=$rows["Match_NowScore"]?>"  />
<input type="hidden" name="match_type[]" value="<?=$rows["match_type"]?>"  />
<input type="hidden" name="touzhuxiang[]" value="<?=$temp_array[0]?>"  />
<input type="hidden" name="master_guest[]"  value="<?=$rows["match_master"]?>VS.<?=$rows["match_guest"]?>"/>
<input type="hidden" name="bet_info[]"  value="<?=$touzhuxiang?>@<?=$rows[$_POST["point_column"]]?>"/> 
<input type="hidden" name="bet_point[]" value="<?=double_format($rows[$_POST["point_column"]])?>" />
<input type="hidden" name="match_time[]"  value="<?=$rows["match_time"]?>"/>
<input type="hidden" name="ben_add[]"  value="<?=$_POST["ben_add"]?>"/>
<input type="hidden" name="match_endtime[]"  value="<?=$rows["Match_CoverDate"]?>"/>
<div class="match_sort"><?=$_POST["ball_sort"]?></div>
<?
 if(intval($_POST['touzhutype'])==0){
?>
<div class="match_name"><?=$rows["match_name"]?>&nbsp;<?=$rows["match_type"]>0 ? $rows["match_time"] : $rows["match_date"]?></div>
<?
 }
?>
<div class="match_master"><?=$rows["match_master"]?><span class="match_vs"> VS. </span><span class="match_guest"><?=$rows["match_guest"]?></span></div>
<?php
if($temp_array[0]=="让球"){ //让球
?>
<div class="match_info">
	盘口：<?=$rows["match_showtype"]=="H" ? '主让' : '客让'?>(<?=$rows["match_rgg"]?>)
</div>   
<?php
}
?>
<div class="match_info">
	<span class="match_master1"><?=$_POST["xx"]?></span>&nbsp;@&nbsp;
	<span style="color:#D90000;"><?=double_format($rows[$_POST["point_column"]])?></span>&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/x.gif" alt="取消赛事" width="8" height="8" border="0" onclick="javascript:del_bet(this)" style="cursor:pointer;" />
	</div>
</div>
<?php
include_once("../cache/group_".@$_SESSION["gid"].".php"); //加载权限组权限
?>
<script>
if($("#touzhutype").val() == 0){
<?php
$dz=$dz_db[$_POST["ball_sort"]][$temp_array[0]];
$dc=$dc_db[$_POST["ball_sort"]][$temp_array[0]];
if(!$dz || $dz=="") $dz=$dz_db['未定义'];
if(!$dc || $dc=="") $dc=$dc_db['未定义'];
?>
	$("#max_ds_point_span").html('<?=$dz ? $dz : '0'?>');
	$("#max_cg_point_span").html('<?=$dc ? $dc : '0'?>');
}else{
	$("#max_ds_point_span").html('<?=$dz_db['串关'] ? $dz_db['串关'] : '0'?>');
	$("#max_cg_point_span").html('<?=$dc_db['串关'] ? $dc_db['串关'] : '0'?>');
}
window.clearTimeout(time_id);
waite();
</script>