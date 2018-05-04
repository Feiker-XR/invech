<?php
include_once("../common/login_check.php"); 
check_quanxian("zdgl");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>核查注单</title>
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
</head>

<body>
<table width="100%" border="0">
<form id="form1" name="form1" method="post" action="?action=1">
  <tr>
    <td width="16%" align="right">请输入注单编号：</td>
    <td width="84%"><label>
      <textarea name="id" cols="80" rows="3" id="id"><?=@$_REQUEST['id']?></textarea>
    多条注意请用 , 隔开</label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="核查" /></td>
  </tr>
</form>
</table>
<br/>
<?php
if($_REQUEST['id'] && $_REQUEST['action']){
	include_once("../../include/mysqli.php");
	$arr_id	=	array();
	$arr_id	=	explode(',',$_REQUEST['id']);
	foreach($arr_id as $k=>$id){
		if(strlen($id)>8){
			$sql	=	"select k_bet.*,k_user.username from k_bet left join k_user on k_bet.uid=k_user.uid where `number`='$id' limit 1"; //本地
			$query	=	$mysqli->query($sql);
			$rows	=	$query->fetch_array();
?>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td width="15%"><strong>联赛名</strong></td>
        <td width="15%"><strong>编号/主客队</strong></td>
        <td width="26%"><strong>投注详细信息</strong></td>
        <td width="8%"><strong>下注</strong></td>
        <td width="8%"><strong>结果</strong></td>
        <td width="8%"><strong>可赢</strong></td>
        <td width="10%"><strong>投注/开赛时间</strong></td>
        <td width="10%"><strong>投注账号</strong></td>
      </tr>
<?php
		  if(@$rows){
			  $color = "#FFFFFF";
			  $over	 = "#FFFFFF";
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
              <td><a href="list.php?match_name=<?=urlencode($rows["match_name"])?>"><?=$rows["match_name"]?></a><br/><span style="color:#999999;"><?=$rows["www"]?></span></td>
              <td>
              <?=$rows["number"]?><br/>
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
        </tr>	
	        <tr>
	          <td colspan="8" align="left"><img src="http://<?=$rows["www"]?>/other/<?=substr($rows["number"],0,8)?>/<?=$rows["number"]?>.jpg" /></td>
      </tr>	
    </table>
<br/>
<?php
  		}
	}else{
		$arr_z	=	$arr_b	=	array();
		$sql	=	"SELECT k.cg_count,k.uid,k.bet_money,k.win,k.bet_win,k.bet_time,k.status,k.balance,k.assets,k.www,u.username FROM k_bet_cg_group k,k_user u where k.uid=u.uid and k.gid='$id'";
		$query	=	$mysqli->query($sql);
		$rows	=	$query->fetch_array();
		
		$sql	=	"select * from k_bet_cg where gid='$id'";
		$query	=	$mysqli->query($sql);
		$sum	=	0;
		while($myrows	=	$query->fetch_array()){
			$arr_z[$sum++]	=	$myrows;
		}
?>
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" >
      <tr  class="t-title" align="center" >
        <td width="10%"><strong>编号</strong></td>
        <td width="10%"><strong>模式</strong></td>
        <td width="40%"><strong>投注详细信息</strong></td>
        <td width="10%"><strong>交易金额</strong></td>
        <td width="10%"><strong>可赢金额</strong></td>
        <td width="10%"><strong>投注时间</strong></td>
        <td width="10%"><strong>投注账号</strong></td>
      </tr>
<?php
	if($rows){
?>
	        <tr align="center">
	          <td  align="center" ><?=$id?></td>
              <td><?=$rows["cg_count"]?>串一<br/><span style="color:#999999;"><?=$rows["www"]?></span></td>
              <td><?
					foreach($arr_z as $k=>$myrows){
                            $m=explode('-',$myrows["bet_info"]);
						    echo $m[0];
							//print_r($m);
						   if(mb_strpos($myrows["bet_info"]," - ")){
						     //篮球上半之内的,这里换成正则表达替换
							  $m[2]=$m[2].preg_replace('[\[(.*)\]]', '',$m[3]);
							 //  $m[2]=$m[2].str_replace('[上半]','',$m[3]);
						   } 
						    $m[2]=@preg_replace('[\[(.*)\]]','',$m[2].$m[3]);
						    unset($m[3]);
							//如果是波胆
							if(mb_strpos($m[0],"胆")){
							 $bodan_score=explode("@",$m[1],2);
							 $score=$bodan_score[0];
							 $m[1]="波胆@".$bodan_score[1];
							}
							?>
						 <?=$myrows["match_name"]?><br />
                         <?
						    //正则匹配
                         	$m_count=count($m);
							preg_match('[\((.*)\)]', $m[$m_count-1], $matches);
							if(strpos($myrows["master_guest"],'VS.')) $team=explode('VS.',$myrows["master_guest"]);
							else $team=explode('VS',$myrows["master_guest"]);
						 ?>
                         <? if(count($matches)>0) echo @$myrows['match_time'].$matches[0]."<br/>";?>
						
                         <? if(mb_strpos($m[1],"让")>0) { //让球?>
                         <? if(mb_strpos($m[1],"主")===false) { //客让?>
                <?=$team[1]?> <?=str_replace(array("主让","客让"),array("",""),$m[1])?> <?=$team[0]?>(主)     <? }else{ //主让?>
                 <?=$team[0]?> <?=str_replace(array("主让","客让"),array("",""),$m[1])?> <?=$team[1]?>
                          <? }?>
                         <?
						 $m[1]="";
						  }else{ ?>
            <?=$team[0]?> <? if(isset($score)) { ?> <?=$score?> <? }else{?>VS.<? }?> <?=$team[1]?>
                         <? } ?>
                         
                         <br />
						<font style="color:#FF0033">
					      <?
                             if($m_count==3)                             
						       echo  $m[1];
						  ?>
                          <?
                          	//半全场替换显示
							$arraynew=array($team[0]," / ",$team[1],"和局");
                            $arrayold=array("主","/","客","和");
						  
						  ?>
                  <?=str_replace($arrayold,$arraynew,preg_replace('[\((.*)\)]', '',$m[$m_count-1]))?><br/>
					    </font>
					    <? if($myrows["status"]==3){?>
					    [取消]
					    <? }else if($myrows["MB_Inball"] != "" && $myrows["MB_Inball"] != "null"){?>
					    [<?=$myrows["MB_Inball"]?>:<?=$myrows["TG_Inball"]?>]
						<? }
							if($k<count($arr_z)-1){
						?>
                        <hr style="height:1px; color:#96B698" />
						<?
							}
						}
						?></td>
              <td><?=$rows["bet_money"]?></td>
	   <td><?php
	   if($rows["status"]==0) echo $rows["bet_win"];
	   elseif($rows["status"]==2) echo $rows["bet_money"];
	   else echo $rows["win"];
	   ?></td>
              <td><?=date("m-d H:i:s",strtotime($rows["bet_time"]))?></td>
              <td><span style="color:#999999;"><?=$rows["assets"]?></span><br /><a href="cg_result.php?uid=<?=$rows["uid"]?>"><?=$rows["username"]?></a><br /><span style="color:#999999;"><?=$rows["balance"]?></span></td>
        </tr> 
	        <tr>
	          <td colspan="7"  align="left" ><img src="http://<?=$rows["www"]?>/other/<?=date('Ymd',strtotime($rows["bet_time"]))?>/<?=$id?>.jpg" /></td>
      </tr>
    </table>   
<br/>	
<?php
			}
		}
	}
?>
上面是动态数据，下面是静态数据，以静态为准！
<?php
}
?>
</body>
</html>