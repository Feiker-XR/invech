<?php
include_once("../common/login_check.php");
check_quanxian("sgjzd");
include_once("../../include/mysqli.php");
$bid			=	trim($_GET["bid"]);
if($_GET["action"]=="edit"){
	$bid		=	trim($_POST["bid"]);
	$num		=	trim($_POST["num"]);
	$match_id	=	trim($_POST["match_id"]);
 
	$sql		=	"update k_bet set match_id='$match_id' where bid=$bid";
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		if($q1 == 1){
			$mysqli->commit(); //事务提交
			
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"]," 更新了注单:$num,正网编号:$match_id");
			
			message('更新成功','sgjds.php?tf_id='.$num);
		}else{
			$mysqli->rollback(); //数据回滚
			message('更新失败');
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message('更新失败');
	}
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>修改编号</TITLE>
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
a{

	color:#F37605;
	text-decoration: none;

}
.t-title{background:url(/super/images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
.inputguanjun { width:300px;}
</STYLE>
<script>
function check(){
	var match_id = document.getElementById("match_id").value;
	if(match_id.length < 1){
		alert("请您输入要更新的正网编号");
		document.getElementById("match_id").focus();
		return false;
	}
}
</script>
</HEAD>

<body>
<?php
$sql	=	"SELECT match_id,ball_sort,master_guest,match_name,bet_info,bet_money,www,`number` FROM k_bet where bid=$bid";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">注单管理：修改编号</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><br />
<form action="edit.php?action=edit" method="post" name="form1" onSubmit="return check();">
<table width="90%" align="center" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;">
  <tr>
    <td bgcolor="#F0FFFF">注单类型</td>
    <td><?=$rows['ball_sort']?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">联赛名称</td>
    <td><?=$rows['match_name']?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">队伍名称</td>
    <td><?=$rows['master_guest']?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">交易明细</td>
    <td><?=$rows['bet_info']?></td>
  </tr>
  <tr>
    <td width="159" bgcolor="#F0FFFF">交易金额</td>
    <td width="844"><?=$rows['bet_money']?></td>
  </tr>
  <tr>
    <td bgcolor="#F0FFFF">正网编号</td>
    <td><input name="match_id" type="text" id="match_id" value="<?=$rows['match_id']?>" size="15"></td>
  </tr>
    <tr>
    <td colspan="2"><img src="http://<?=$rows["www"]?>/other/<?=substr($rows["number"],0,8)?>/<?=$rows["number"]?>.jpg" /></td>
    </tr>
    <tr>
    <td bgcolor="#F0FFFF">操作</td>
    <td><input type="submit" value="更新"/>
      <input name="bid" type="hidden" id="bid" value="<?=$bid?>">
      <input name="num" type="hidden" id="num" value="<?=$rows['number']?>"></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
</body>
</html>