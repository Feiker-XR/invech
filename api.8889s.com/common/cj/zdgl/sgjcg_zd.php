<?php
include_once("../common/login_check.php");
check_quanxian("sgjzd");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>单式注单审核</TITLE>
<script language="javascript">
function winopen(bid,status){
	window.open("set_score_cg.php?bid="+bid+"&status="+status,"list","width=440,height=165,left=50,top=100,scrollbars=no"); 
}

function go(value){
	location.href=value;
}
</script>
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE1 {font-size: 10px}
.STYLE2 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{
	color:#F37605;
	text-decoration: none;
}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;串关<span class="STYLE2">注单管理：查看所有注单情况（所有时间以美国东部标准为准）</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td ><strong>编号</strong></td>
        <td><strong>联赛名</strong></td>
        <td ><strong>编号/主客队</strong></td>
        <td ><strong>投注详细信息</strong></td>
        <td ><strong>投注/开赛时间</strong></td>
        <td><strong>投注账号</strong></td>
        <td ><strong>操作</strong></td>
      </tr>

<?php
      include_once("../../include/mysqli.php");
 
      $sql	=	"select k_bet_cg.*,k_user.username from k_bet_cg left join k_user on k_bet_cg.uid=k_user.uid where 1";
	  if(isset($_GET["gid"])){
	 	 $sql.=" and k_bet_cg.gid=".$_GET["gid"];
	  }
	  if(isset($_GET["uid"])){
	 	 $sql.=" and k_bet_cg.uid=".$_GET["uid"];
	  }
	  if(isset($_GET["match_id"])){
	  	 $sql.=" and k_bet_cg.match_id=".$_GET["match_id"];
	  }
	  if(isset($_GET["match_name"])){
	  	 $sql.=" and k_bet_cg.match_name='".urldecode($_GET["match_name"])."'";
	  }
	  
    if(isset($_GET["status"]))
	  if($_GET["status"]>0)
      $sql.=" and k_bet_cg.status>0";
	  else if($_GET["status"]==0)
	  {
	   $sql.=" and k_bet_cg.status=0";
      }
	 
	    $sql.=" order by  k_bet_cg.bid  desc ";
  
	$query	=	$mysqli->query($sql);
     while ($rows = $query->fetch_array()) {
        if(@$temp_gid!=$rows["gid"])
		{
      echo "<tr style=\"background:#FFFFFF\"><td colspan=\"10\" height=\"24\" align=\"left\"><a href=".$_SERVER['PHP_SELF']."?gid=".$rows["gid"]."><font style=\"color:0000FF\">串关编号".$rows["gid"]."</font></a></td></tr>";
		$temp_gid=$rows["gid"];
		} 
		
		$color	=	"#FFFFFF";
		$over	=	"#EBEBEB";
		$out	=	"#ffffff";
		if(strtotime($rows["bet_time"])>=strtotime($rows["match_endtime"])){ //不是滚球，抽注时间不能>=开赛时间
			$over = $out = $color = "#FBA09B";
		}
	  	?>  <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
	          <td ><?=$rows["bid"]?></td>
              <td><a href="<?=$_SERVER['PHP_SELF']?>?match_name=<?=urlencode($rows["match_name"])?>" ><?=$rows["match_name"]?></a></td>
              <td ><a href="<?=$_SERVER['PHP_SELF']?>?match_id=<?=$rows["match_id"]?>" ><?=$rows["match_id"]?></a>
			  <br/>
<?php
if(strpos($rows["master_guest"],'VS.')) echo str_replace("VS.","<br/>",$rows["master_guest"]);
else  echo str_replace("VS","<br/>",$rows["master_guest"]);
?></td>
              <td> <?=$rows["ball_sort"]?>
			 <br/><font style="color:#FF0033">
			  <?=str_replace("-","<br/>",$rows["bet_info"])?>
			  </font>
			 <? if($rows["status"]!=0&&$rows["status"]!=3)
			if($rows["MB_Inball"]!=''){?>
			<br>[<?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>]
			<? } ?>
            <?php
            if($rows['status'] == 3){
				echo "<br>[取消]";
			}
			?>	
			 </td>
              <td><?=date("m-d H:i:s",strtotime($rows["bet_time"]))?>
                <br/>
              <?=date("m-d H:i:s",strtotime($rows["match_endtime"]))?></td>
              <td><a href="cg_result.php?uid=<?=$rows["uid"]?>">
                <?=$rows["username"]?>
              </a></td>
	          <td align="center">
			  <?if ($rows["status"]==0 || $rows["status"]==6){?>
			  <!--<a onClick="return confirm('该注单设为输后，同组串关其他注单都不需要审核')" href="set_cg_bet.php?bid=<?=$rows["bid"]?>&amp;status=2">输</a>-->
			   <a href="javascript:winopen(<?=$rows["bid"]?>,2)">输</a> <a href="javascript:winopen(<?=$rows["bid"]?>,1)">赢</a><!-- <a href="set_cg_bet.php?bid=<?=$rows["bid"]?>&amp;status=1">赢</a> -->
			 <br/>
			  <a href="javascript:winopen(<?=$rows["bid"]?>,8)">平手</a>
			  
			  
			  <? if($rows["ben_add"]==1) {?>

               
			  <br/>
<!--			   <a href="set_cg_bet.php?bid=<?=$rows["bid"]?>&amp;status=5">输一半</a> -->
 <a href="javascript:winopen(<?=$rows["bid"]?>,5)">输一半</a>
		       <br/>
			 <!-- <a href="set_cg_bet.php?bid=<?=$rows["bid"]?>&amp;status=4">赢一半</a>-->
			  <a href="javascript:winopen(<?=$rows["bid"]?>,4)">赢一半</a> 
			<?}?>
			  <br/>
			  <a href="set_cg_bet.php?bid=<?=$rows["bid"]?>&status=3&MB_Inball=null&TG_Inball=null">无效</A>
			  <?}else if($rows["status"]==3){?>
              无效	
			   <?}else if($rows["status"]==4){?>
              赢一半
			   <?}else if($rows["status"]==5){?>
             输一半
			  <?}else if($rows["status"]==1){?>
			  赢
			  <?}else if($rows["status"]==2){?>
			  输
              <?}else if($rows["status"]==6){?>
			  未审核
			   <?}else if($rows["status"]==8){?>
			 平手
			  <?}?>	
			  <?if($rows["status"]!=0){?>
			  <br/>
			  <a onClick="return confirm('确定重新审核该注单？\n<? if($rows["status"]==2||$rows["status"]==6) echo "同组其他注单也要重新审核!"; ?>')" href="qx_cgbet.php?bid=<?=$rows["bid"]?>&status=<?=$rows["status"]?>&gid=<?=$rows["gid"]?>">重新审核</a>
			  <? }?>
			    </td>
        </tr>    	
      	<?
      }
      ?>
    </table></td>
  </tr>
</table>
    </td>
  </tr>
</table>
</body>
</html>