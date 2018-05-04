<?php
include_once("../common/login_check.php");
check_quanxian("zdgl");
$type=$_GET['type'];
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>单式注单列表</TITLE>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="javascript">
function go(value){
	if(value != "") location.href=value;
	else return false;
}

function check(){
	if($("#tf_id").val().length > 5){
		$("#status").val("8,0,1,2,3,4,5,6,7");
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
<script language="JavaScript" src="../../js/calendar.js"></script>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">注单管理：查看所有注单情况（所有时间以美国东部标准为准）</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
	  <table width="100%">
      <form name="form1" method="get" action="<?=$_SERVER["REQUEST_URI"]?>" onSubmit="return check();">
      <tr align="center">
        <td width="124" align="center"><select onChange="javascript:go(this.value)">
         <option value="">选择分类</option>
        <option value="<?=$_SERVER["REQUEST_URI"]?>&type=足球" <?= $type=='足球' ? 'selected="selected"' : ''?>>足球</option>
         <option value="<?=$_SERVER["REQUEST_URI"]?>&type=篮球" <?= $type=='篮球' ? 'selected="selected"' : ''?>>篮球</option>
         <option value="<?=$_SERVER["REQUEST_URI"]?>&type=网球" <?= $type=='网球' ? 'selected="selected"' : ''?>>网球</option>
         <option value="<?=$_SERVER["REQUEST_URI"]?>&type=排球" <?= $type=='排球' ? 'selected="selected"' : ''?>>排球</option>
         <option value="<?=$_SERVER["REQUEST_URI"]?>&type=棒球" <?= $type=='棒球' ? 'selected="selected"' : ''?>>棒球</option>
         <option value="<?=$_SERVER["REQUEST_URI"]?>&type=冠军" <?= $type=='冠军' ? 'selected="selected"' : ''?>>冠军</option>
         <option value="<?=$_SERVER["REQUEST_URI"]?>&type=金融" <?= $type=='金融' ? 'selected="selected"' : ''?>>金融</option>
         <option value="<?=$_SERVER["REQUEST_URI"]?>&type=重庆时时彩" <?= $type=='重庆时时彩' ? 'selected="selected"' : ''?>>重庆时时彩</option>
		 <option value="<?=$_SERVER["REQUEST_URI"]?>&type=广东快乐十分" <?= $type=='广东快乐十分' ? 'selected="selected"' : ''?>>广东快乐十分</option>
         <option value="<?=$_SERVER["REQUEST_URI"]?>&type=北京PK10" <?= $type=='北京PK10' ? 'selected="selected"' : ''?>>北京PK10</option>
		 
        </select></td>
        <td width="124" align="center">
          <select name="status" id="status">
            <option value="0" style="color:#FF9900;" <?=$_GET['status']=='0' ? 'selected' : ''?>>未结算注单</option>
            <option value="1,4,5" style="color:#FF0000;" <?=$_GET['status']=='1,4,5' ? 'selected' : ''?>>已赢注单</option>
            <option value="2" style="color:#009900;" <?=$_GET['status']=='2' ? 'selected' : ''?>>已输注单</option>
            <option value="3,6,7,8" style="color:#0000FF;" <?=$_GET['status']=='3,6,7,8' ? 'selected' : ''?>>和局或取消</option>
            <option value="8,0,1,2,3,4,5,6,7" <?=$_GET['status']=='8,0,1,2,3,4,5,6,7' ? 'selected' : ''?>>全部注单</option>
          </select></td>
        <td width="124" align="center"><label>
          <select name="order" id="order">
            <option value="bid" <?=$_GET['order']=='bid' ? 'selected' : ''?>>默认排序</option>
            <option value="bet_money" <?=$_GET['order']=='bet_money' ? 'selected' : ''?>>交易金额</option>
            <option value="win" <?=$_GET['order']=='win' ? 'selected' : ''?>>已赢金额</option>
          </select>
        </label></td>
        <td width="729" align="left">
          会员：
            <input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="15">
            &nbsp;&nbsp;日期：
            <input name="bet_time" type="text" id="bet_time" value="<?=$_GET['bet_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />            &nbsp;&nbsp;&nbsp;注单号：
            <input name="tf_id" type="text" id="tf_id" value="<?=@$_GET['tf_id']?>" size="22">
            &nbsp;
            <input type="submit" name="Submit" value="搜索"></td>
        </tr>
      </form>
    </table>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td width="56"><strong>编号</strong></td>
        <td width="136"><strong>联赛名</strong></td>
        <td width="176"><strong>编号/主客队</strong></td>
        <td width="246"><strong>投注详细信息</strong></td>
        <td width="56"><strong>下注</strong></td>
        <td width="56"><strong>结果</strong></td>
        <td width="56"><strong>可赢</strong></td>
        <td width="106"><strong>投注/开赛时间</strong></td>
        <td width="96"><strong>投注账号</strong></td>
        <td><strong>状态</strong></td>
      </tr>
<?php
      include_once("../../include/mysqli.php");
      include_once("../../include/newPage.php");
	  
	  $uid	=	'';
	  if($_GET['username']){
	      $sql		=	"select uid from k_user where username='".$_GET['username']."' limit 1";
		  $query	=	$mysqli->query($sql);
		  if($rows	=	$query->fetch_array()){
		  		$uid=	$rows['uid'];
		  }
	  }
 
      $sql	=	"select bid from k_bet where lose_ok=1 ";
	  if($type) $sql.=" and ball_sort like('$type%')";
	  if($_GET["uid"]) $uid = $_GET["uid"];
	  if($uid != '') $sql.=" and uid=".$uid;
	  if(isset($_GET["match_id"])) $sql.=" and match_id=".$_GET["match_id"];
	  if(isset($_GET["match_name"])) $sql.=" and match_name='".urldecode($_GET["match_name"])."'";
	  if(isset($_GET["ball_sort"])) $sql.=" and ball_sort='".urldecode($_GET["ball_sort"])."'";
	  if(isset($_GET["point_column"])) $sql.=" and point_column='".strtolower($_GET["point_column"])."'";
	  if(isset($_GET["column_like"])) $sql.=" and point_column like'%".strtolower($_GET["column_like"])."%'";
	  if(isset($_GET["match_type"])) $sql.=" and match_type=".intval($_GET["match_type"]);
	  if(isset($_GET["www"])) $sql.=" and www='".$_GET["www"]."'";
	  if(isset($_GET["s_time"])) $sql.=" and bet_time>='".$_GET["s_time"]."'";
	  if(isset($_GET["e_time"])) $sql.=" and bet_time<='".$_GET["e_time"]."'";
      if(isset($_GET["status"]))  $sql.=" and `status` in (".$_GET["status"].")";
	  if($_GET['tf_id']) $sql.=" and number='".$_GET['tf_id']."'";
	  if($_GET['bet_time']) $sql.=" and bet_time like('".$_GET['bet_time']."%')";
	  $order = 'bid';
	  if($_GET['order']) $order = $_GET['order'];
	  $sql.=" order by $order desc ";
	  
	  $query	=	$mysqli->query($sql);
	  $sum		=	$mysqli->affected_rows; //总页数
	  $thisPage	=	1;
	  if($_GET['page']){
	  	  $thisPage	=	$_GET['page'];
	  }
      $page		=	new newPage();
	  $thisPage	=	$page->check_Page($thisPage,$sum,20,40);
	  
	  $bid		=	'';
	  $i		=	1; //记录 bid 数
	  $start	=	($thisPage-1)*20+1;
	  $end		=	$thisPage*20;
	  while($row = $query->fetch_array()){
	  	  if($i >= $start && $i <= $end){
	  	  	$bid .=	$row['bid'].',';
		  }
		  if($i > $end) break;
		  $i++;
	  }
	  if($bid){
	  	$bid	=	rtrim($bid,',');
	  	$sql	=	"select b.*,u.username from k_bet b,k_user u where b.uid=u.uid and bid in($bid) order by $order desc";
	  	$query	=	$mysqli->query($sql);
	  
	 	$bet_money=$win=0;
      	while ($rows = $query->fetch_array()) {
	      $bet_money+=$rows["bet_money"];
	      $win+=$rows["win"];
		  
		  $color = "#FFFFFF";
		  $over	 = "#EBEBEB";
		  $out	 = "#ffffff";
		  
		  if(($rows["balance"]*1)<0 || round($rows["assets"]-$rows["bet_money"],2) != round($rows["balance"],2)){ //投注后用户余额不能为负数，投注后金额要=投注前金额-投注金额
		  		$over = $out = $color = "#FBA09B";
		  }elseif($rows["match_type"]==1 && strtotime($rows["bet_time"])>=strtotime($rows["match_endtime"])){ //不是滚球，抽注时间不能>=开赛时间
		  		$over = $out = $color = "#FBA09B";
		  }elseif(double_format($rows["bet_money"]*($rows["ben_add"]+$rows["bet_point"])) !== double_format($rows["bet_win"])){
		  		$over = $out = $color = "#FBA09B";
		  }
      	?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
	          <td  align="center" ><?=$rows["bid"]?></td>
              <td><a href="list.php?match_name=<?=urlencode($rows["match_name"])?>"><?=$rows["match_name"]?></a><br /><a href="list.php?www=<?=$rows['www']?>" style="color:#999999;"><?=$rows['www']?></a>
			  <?php
			  if($rows["status"] == 3){
			  	echo '<br/><span style="color:#999999;">'.$rows["sys_about"].'</span>';
			  }
			  ?></td>
              <td>
              <a href="check_zd.php?action=1&id=<?=$rows["number"]?>"><?=$rows["number"]?></a><br/>
              <a href="list.php?match_id=<?=$rows["match_id"]?>"><?=$rows["match_id"]?></a>
			  <br/>
<?php
if(strpos($rows["master_guest"],'VS.')) echo str_replace("VS.","<br/>",$rows["master_guest"]);
else  echo str_replace("VS","<br/>",$rows["master_guest"]);
?></td>
              <td> <a href="list.php?ball_sort=<?=urlencode($rows["ball_sort"])?>"><font color="<? if ($rows["ball_sort"]=="足球滚球"){echo "#0066FF";}else{echo "#336600";}?>"><b><?=$rows["ball_sort"]?></b></font></a><br/><?=$rows["match_time"]?>
			 <font style="color:#FF0033">
			  <?php if($rows["point_column"]==="match_jr" || $rows["point_column"]==="match_gj") echo $rows["bet_info"];
			  		else echo str_replace("-","<br>",$rows["bet_info"]);?>
			  </font>
			  <? if($rows["status"]!=0 && $rows["status"]!=3)
			if($rows["MB_Inball"]!=''){?>
			[<?=$rows["MB_Inball"]?>:<?=$rows["TG_Inball"]?>]
			<? } ?>			 </td>
              <td><?=$rows["bet_money"]?></td>
	          <td><?=$rows["win"]?></td>
              <td><?=$rows["bet_win"]?></td>
              <td><?=date("m-d H:i:s",strtotime($rows["bet_time"]))?><br/><?=date("m-d H:i:s",strtotime($rows["match_endtime"]))?></td>
              <td><span style="color:#999999;"><?=$rows["assets"]?></span><br /><a href="list.php?uid=<?=$rows["uid"]?>"><?=$rows["username"]?></a><br /><span style="color:#999999;"><?=$rows["balance"]?></span></td>
	          <td align="center" class="make"><?php
			  	if($rows["status"]==0){
			  		echo '未结算';
			  	}elseif($rows["status"]==1){
					echo '<span style="color:#FF0000;">赢</span>';
				}elseif($rows["status"]==2){
					echo '<span style="color:#00CC00;">输</span>';
				}elseif($rows["status"]==8){
					echo '和局';
				}elseif($rows["status"]==3){
              		echo '注单无效';
			  	}elseif($rows["status"]==4){
					echo '<span style="color:#FF0000;">赢一半</span>';
			  	}elseif($rows["status"]==5){
					echo '<span style="color:#00CC00;">输一半</span>';
			  	}elseif($rows["status"]==6){
					echo '进球无效';
			 	}elseif($rows["status"]==7){
					echo '红卡取消';
				}
				?></td>
        </tr> 	
      	<?
      }
	}
      ?>
    </table>
    </td>
  </tr>
    <tr>
      <td >
    该页统计:总注金:<?=$bet_money?>，结果:<?=$win?>，盈亏：<span style="color:<?=$bet_money-$win>0 ? '#FF0000' : '#009900'?>;"><?=$bet_money-$win?></span>
  </td>
    </tr>
  <tr><td >
 <?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?>
  </td></tr>
  
</table>

</body>
</html>