<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>home</title>
<link href="../css/right.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="/js/jquery.js"></script>
<script language="javascript" src="/js/common.js"></script>
<script language="javascript" src="jinrong_result.js"></script>
<script language="javascript" src="/js/guanjun.js"></script>
<script type="text/javascript">
function shuaxin(league){
	time=121;
	var page = document.getElementById('aaaaa').innerHTML;
	loaded(league,page);
}
function Wleague(league){
	loaded(league);
}
function NumPage(thispage){
	var league = document.getElementById('league').value;
	document.getElementById('aaaaa').innerHTML = thispage;
	loaded(league,thispage);
}
</script>
<style>
html{overflow-x:no;}
</style>
 <script language="javascript" src="/js/times.js"></script>
</head>
<body onload="loaded(document.getElementById('league').value,0);" class="right_body">
<div id="right_1">
<div id="shuaxin">
    <div id="r_t_2">金融结果</div>
    <div id="ladong_1"><span id="tday"><a href="javascript:void(0)" onclick="return Wleague('<?=date("Y-m-d",time()-86400)?>')">昨日</a></span>&nbsp;&nbsp;<select name="league" id="league">
<?php
$date	=	$_GET['league'];
for($i=0;$i<7;$i++){
	$d	=	date('Y-m-d',time()-$i*86400);
?>
	    <option value="<?=$d?>" <?= $d==$date ? 'selected="selected"' : ''?>><?=$d?></option>
<?php
}
?>
	    </select>&nbsp;&nbsp;<input type="button" class="anniu_000" onclick="return Wleague(document.getElementById('league').value)" value="查询" />&nbsp;</div>
	</div>
</div>
<div id="right_2">
  <div id="lantiao">
    <div class="bai_x zu_11">时间</div>
	<div class="bai_x lan_danshi_2">项目</div>
	<div class="bai_x gzu_4">队伍(球员)</div>
	<div class="bai_z gzu_5">胜出</div>
  </div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
		<td id="datashow" colspan="4" height="30" align="center">数据读取中...</td>
  </tr>
</table>
</div>
</body>
<script language="javascript" src="/js/mouse.js"></script>
</html>