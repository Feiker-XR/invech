<?php
include_once("../common/login_check.php");
check_quanxian("zdgl");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="20">
<TITLE>单式注单审核</TITLE>
<script language="javascript">
function go(value)
{
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
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">注单管理：确认滚球注单（所有时间以美国东部标准为准）</span></font></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td><strong>编号</strong></td>
        <td><strong>联赛名</strong></td>
        <td><strong>主客 VS 客队</strong></td>
        <td><strong>投注详细信息</strong></td>
        <td><strong>下注</strong></td>
        <td><strong>赢后</strong></td>
        <td><strong>投注时间</strong></td>
        <td><strong>投注账号</strong></td>
        <td><strong>操作</strong></td>
      </tr>
<?php
include_once("../../include/mysqli.php");
$sql	=	"select k_bet.*,k_user.username from k_bet left join k_user on k_user.uid=k_bet.uid where lose_ok=0 order by  bid  desc ";
$query	=	$mysqli->query($sql);
while($rows = $query->fetch_array()) {
	$color	=	"#FFFFFF";
	$over	=	"#EBEBEB";
	$out	=	"#ffffff";
	
	if(($rows["balance"]*1)<0 || round($rows["assets"]-$rows["bet_money"],2) != round($rows["balance"],2)){
		$over = $out = $color = "#FBA09B";
	}elseif(double_format($rows["bet_money"]*($rows["ben_add"]+$rows["bet_point"])) !== double_format($rows["bet_win"])){
		$over = $out = $color = "#FBA09B";
	}
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
	          <td height="40" align="center"><?=$rows["bid"]?></td>
              <td ><?=$rows["match_name"]?><br /><span style="color:#999999"><?=$rows["www"]?></span></td>
<?php
if(strpos($rows["master_guest"],'VS.')){
?>
              <td><?=str_replace("VS.","<br/>",$rows["master_guest"])?></td>
<?php
}else{
?>
              <td><?=str_replace("VS","<br/>",$rows["master_guest"])?></td>
<?php
}
?>
              <td><?=$rows["match_time"]?>&nbsp;<font style="color:#FF0033"><?=str_replace("-","<br/>",$rows["bet_info"])?>
              </font></td>
              <td align="center"><?=$rows["bet_money"]?></td>
	          <td align="center"><?=$rows["bet_win"]?></td>
              <td><?=date("m-d H:i:s",strtotime($rows["bet_time"]))?></td>
              <td><span style="color:#999999;"><?=$rows["assets"]?></span><br /><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>"><?=$rows["username"]?></a><br /><span style="color:#999999;"><?=$rows["balance"]?></span></td>
	          <td align="center">
		<a href="set_lose.php?bid=<?=$rows["bid"]?>&amp;lose_ok=1">有效</a>
		<br/>
		<a href="set_lose.php?bid=<?=$rows["bid"]?>&amp;lose_ok=0&uid=<?=$rows["uid"]?>&amp;status=6">进球无效</a>
		  <br/>
	    <a href="set_lose.php?bid=<?=$rows["bid"]?>&amp;lose_ok=0&uid=<?=$rows["uid"]?>&amp;status=7">红卡无效</a>
	     <br/>
	    <a href="set_lose.php?bid=<?=$rows["bid"]?>&amp;lose_ok=0&uid=<?=$rows["uid"]?>&amp;status=3">无效</a> 	   
			  </td>
        </tr>            	
<?
}
?>
    </table></td>
  </tr>
</table>
</body>
</html>