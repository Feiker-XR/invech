<?php
$date	=	date('Y-m-d',time());
if($_GET['ymd']) $date	=	$_GET['ymd'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>home</title>
	<link href="../skin/sports/right.css" rel="stylesheet" type="text/css" />
	<script language="javascript" src="/js/jquery.js"></script>
	<script language="javascript" src="/js/common.js"></script>
	<script language="javascript" src="guanjun_result.js"></script>
	<script language="javascript" src="/js/guanjun.js"></script>
	<script language="javascript" src="/js/times.js"></script>
	<script language="javascript" src="/js/mouse.js"></script>
</head>
<body onload="loaded('<?=$date?>',0);">
<div class="top" >
	<div class="result_title"><span>冠军结果</span>
		<?php
		for($i=0;$i<7;$i++){
			$d=date('Y-m-d',time()-$i*86400);
			if($d==$date){
				echo "<li class='i'>".substr($d,5,5)."</li>";
			}else{
				echo "<li><a href='?ymd=".$d."'>".substr($d,5,5)."</a></li>";
			}
		}
		?>
	</div>
</div>
<div id="datashow">
	<table border='0' cellspacing='1' cellpadding='0' bgcolor='#ACACAC' class='box'>
		<tr>
			<th width="100" align="center" bgcolor="#FFFFFF" style="line-height:25px;">比赛时间</th>
			<th align="center" bgcolor="#FFFFFF" style="line-height:25px;">联盟玩法</th>
			<th align="center" bgcolor="#FFFFFF" style="line-height:25px;">比赛队伍</th>
			<th align="center" bgcolor="#FFFFFF" style="line-height:25px;">胜出</th>
		</tr>
		<tr>
			<td height="100" colspan="4" align="center" bgcolor="#FFFFFF" style="line-height:25px;">
				<img src="../skin/sports/loading.gif" border="0" /><br />
				赛事数据正在加载中......
			</td>
		</tr>
	</table>
</div>
</body>
</html>