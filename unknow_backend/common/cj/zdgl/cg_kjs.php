<?php
include_once("../common/login_check.php");
check_quanxian("zdgl");
include_once("../../include/mysqli.php");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>串关注单列表</TITLE>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="javascript">
function go(value){
	location.href=value;
}

function windowopen(url){
	window.open(url,"wx","width=300,height=300,left=50,top=100,scrollbars=no"); 
}

function check(){
	if($("#tf_id").val().length > 3){
		$("#status").val("4,0,1,2,3");
	}
	return true;
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
.STYLE4 {
	color: #FF0000;
	font-size: 12px;
}
</STYLE>
<script language="javascript" src="../../js/jquery.js"></script>
<script language="javascript">
function check(){
    var len = document.form1.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form1.elements[i];
        if(e.checked && e.name=='gid[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = $("#s_action").val();
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else{
			return true;
		}
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}

function ckall(){
    for(var i=0;i<document.form1.elements.length;i++){
	    var e = document.form1.elements[i];
		if(e.name != 'checkall') e.checked = document.form1.checkall.checked;
	}
}
</script>
</HEAD>

<body>
<form id="form1" name="form1" method="post" action="set_cg.php?ok=2" onSubmit="return check();">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="27%" height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">注单管理：串关结算（所有时间以美国东部标准为准）</span></font></td>
    <td width="73%" align="right" nowrap background="../images/06.gif"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="1">结算</option>
      </select>
    <input type="submit" name="Submit2" value="执行"/></td>
  </tr>
  <tr>
    <td height="24" colspan="2" align="center" nowrap bgcolor="#FFFFFF">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td width="5%"><strong>编号</strong></td>
        <td width="5%"><strong>模式</strong></td>
        <td width="47%"><strong>结算详细信息</strong></td>
        <td width="10%"><strong>下注</strong></td>
        <td width="10%"><strong>已赢</strong></td>
        <td width="10%"><strong>可赢</strong></td>
        <td width="10%"><strong>投注时间</strong></td>
        <td width="3%" valign="middle"><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
      </tr>
<?php
$sql		=	"SELECT cg.*,u.username FROM k_bet_cg_group cg,k_user u where cg.uid=u.uid and cg.`status` in (0,2) and cg.cg_count=(select count(*) from k_bet_cg c where c.gid=cg.gid and c.`status` not in(0,3))";
$query		=	$mysqli->query($sql);
$win		=	$bet_money	=	0;
while($rows = $query->fetch_array()) {
	  $bet_money	+=	$rows["bet_money"];
	  $win			+=	$rows["win"];
	  
	  $color		=	"#FFFFFF";
	  $over			=	"#EBEBEB";
	  $out			=	"#ffffff";
	  
	  if(($rows["balance"]*1)<0 || round($rows["assets"]-$rows["bet_money"],2) != round($rows["balance"],2)){
			$over = $out = $color = "#FBA09B";
	  }
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
	          <td height="40" align="center" ><a href="check_zd.php?action=1&id=<?=$rows["gid"]?>"><?=$rows["gid"]?></a></td>
              <td align="center"><?=$rows["cg_count"]?>串1</td>
              <td><div><div style="float:left;">已结算：<?=$rows["cg_count"]?>&nbsp;[<a href="bet_cg.php?gid=<?=$rows["gid"]?>">详细</a>]</div><div style="float:right;"><span style="color:#999999;"><?=$rows["assets"]?></span>&nbsp;<?=$rows["username"]?>&nbsp;<span style="color:#999999;"><?=$rows["balance"]?></span></div><div style="float:left; padding-left:10px;"><a href="cg_result.php?www=<?=$rows['www']?>" style="color:#999999;"><?=$rows['www']?></a></div></div></td>
              <td align="center"><?=$rows["bet_money"]?></td>
	          <td align="center"><?=$rows["win"]>0 ? '<span style="color:#FF0000">'.$rows["win"].'</span>' : $rows["win"]?></td>
	          <td align="center"><?=$rows["bet_win"]?></td>
              <td align="center"><?=date("m-d H:i:s",strtotime($rows["bet_time"]))?></td>
              <td align="center" valign="middle"><input name="gid[]" type="checkbox" id="gid[]" value="<?=$rows["gid"]?>" /></td>
        </tr>	
<?php
}
?>
    </table></td>
  </tr>
      <tr>
      <td >
    该页统计:总注金:<?=$bet_money?>，结果:<?=$win?>，盈亏：<span style="color:<?=$bet_money-$win>0 ? '#FF0000' : '#009900'?>;"><?=$bet_money-$win?></span></td>
    </tr>
</table></td>
  </tr>
</table>
</form>
</body>
</html>