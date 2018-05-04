<?php
include_once("../common/login_check.php");
check_quanxian("sgjzd");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>设置注单为无效</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
<script language="javascript" src="../Script/Admin.js"></script>
<script language="javascript">
function refash()
{
var win = top.window;
 try{// 刷新.
  	if(win.opener)  win.opener.location.reload();
 }catch(ex){
  // 防止opener被关闭时代码异常。
 }
  window.close();
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
body {	margin: 0px;}
td{font:13px/120% "宋体";padding:3px;}
a{color:#FFA93E;}
.t-title{background:url(/super/images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>
<?php
include_once("../../include/mysqli.php");

if($_GET["action"]=="save"){
	$bid		=	intval($_GET["bid"]);
	$uid		=	intval($_GET["uid"]);
	$why		=	trim($_POST["sys_about"]);
	$num		=	0;
	if($_POST["back_bet_money"]=="1"){
		$num	=	2;
    	$sql	=	"update k_user,k_bet set k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.status=3,k_bet.sys_about='".($why ? $why : '手工无效')."',k_bet.update_time=now() where status=0 and k_user.uid=k_bet.uid and k_bet.bid=$bid";
	}else{
		$num	=	1;
		$sql	=	"update k_bet set status=3,sys_about='$why',update_time=now() where status=0 and k_bet.bid=$bid";
	}
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1	=	$mysqli->affected_rows;
		if($q1 == $num){
			$mysqli->commit(); //事务提交
			
			include_once("../../class/admin.php");
     		admin::insert_log($_SESSION["adminid"],"审核了编号为".$bid."的注单,设为无效，退还了投注金额"); 
			
			include_once("../../class/user.php");
	 		user::msg_add($uid,'名爵娱乐城',$_POST["master_guest"]."_注单已取消",$_POST["master_guest"].'<br/>'.$_POST["bet_info"].'<br/>'.$why);
			
			echo "<script>alert('操作成功');\r\n";
			if(@$_GET['new']) echo "refash();</script>";
			else echo "location.href='".$_SERVER['HTTP_REFERER']."';</script>";
		}else{
			$mysqli->rollback(); //数据回滚
			message('操作失败',$_SERVER['HTTP_REFERER']);
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message('操作失败',$_SERVER['HTTP_REFERER']);
	}	
}
?>
<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">注单管理：该注单设为无效（所有时间以美国东部标准为准）</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"></td>
  </tr>
</table>
<br>
<?php
$sql	=	"select match_name,master_guest,bet_info,bet_point,bet_money,bet_win,match_id,ball_sort,bet_time,bid,uid from k_bet where bid=".intval($_GET["bid"])." limit 1";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
?>
<form action="<?=$_SERVER['PHP_SELF']?>?action=save&bid=<?=$rows["bid"]?>&uid=<?=$rows["uid"]?>&new=<?=$_GET['new']?>" method="post" enctype="multipart/form-data" name="form1">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;">
  <tr>
    <td bgcolor="#F0FFFF">联赛名称</td>
    <td><?=$rows["match_name"]?></td>
  </tr>
  <tr>
    <td width="172" bgcolor="#F0FFFF">主客队</td>
    <td width="473"><?=$rows["master_guest"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">投注详细信息</td>
    <td><?=$rows["bet_info"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">盘口赔率</td>
    <td><?=$rows["bet_point"]?></td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">投注金额</td>
    <td><?=$rows["bet_money"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">最高可赢</td>
    <td><?=$rows["bet_win"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">联赛编号</td>
    <td><?=$rows["match_id"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">联赛类别</td>
    <td><?=$rows["ball_sort"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">下注时间</td>
    <td><?=$rows["bet_time"]?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">退还投注金额</td>
    <td><select name="back_bet_money">
    <option value="1">退还投注金额</option>
      <option value="0">不退还投注金额</option>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">无效原因</td>
    <td><label><input name="bet_info" type="hidden" value="<?=$rows["bet_info"]?>">
	<input name="master_guest" type="hidden" value="<?=$rows["master_guest"]?>">
      <textarea name="sys_about" id="textarea" cols="45" rows="5"></textarea>
    </label></td>
  </tr>
    <tr>
    <td bgcolor="#F0FFFF">操作</td>
    <td><input type="submit" value="提交"/></td>
  </tr>
</table>
</form>
</body>
</html>