<?php
ob_start('ob_output');
function ob_output($html) {
	// 一些用户喜欢使用windows笔记本编辑文件，因此在输出时需要检查是否包含BOM头
	if (ord(substr($html, 0, 1)) === 239 && ord(substr($html, 1, 2)) === 187 && ord(substr($html, 2, 1)) === 191) $html = substr($html, 3);
	// gzip输出
	if(
		!headers_sent() && // 如果页面头部信息还没有输出
		extension_loaded("zlib") && // 而且zlib扩展已经加载到PHP中
		array_key_exists('HTTP_ACCEPT_ENCODING', $_SERVER) &&
		stripos($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") !== false // 而且浏览器说它可以接受GZIP的页面 
	) {
		$html = gzencode($html, 3);
		header('Content-Encoding: gzip'); 
		header('Vary: Accept-Encoding');
	}
	header('Content-Length: '.strlen($html));
	return $html;
}
require('../xingcai_config.php');
$id=array('66','18');
$pgsid=array('30','50','80','100','120','200','300','');
include(dirname(__FILE__)."/inc/comfunc.php");
//此处设置彩种id
$typeid=intval($_GET['typeid']);
if(!in_array($typeid,$id)) die("typeid error");
if(!$typeid) $typeid=14;
//每页默认显示
$pgs=intval($_GET['pgs']);
if(!in_array($pgs,$pgsid)) die("pgs error");
if(!$pgs) $pgs=30;
//当前页面
$page=intval($_GET['page']);
if(!$page) $page=1;
//传参
$toUrl="?page=";
$params=http_build_query($_REQUEST, '', '&');
if(!$mydb) $mydb = new MYSQL($dbconf);
$gRs = $mydb->row($conf['db']['prename']."type","shortName","id=".$typeid);
if($gRs){
	$shortName=$gRs[0][0];
}

$fromTime=$_GET['fromTime'];
$toTime=$_GET['toTime'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" xmlns:esun>
<HEAD><TITLE>c38 - 号码走势</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<META http-equiv="Pragma" content="no-cache" />
<style>
font,div,td{font-size:12px;}
</style>

</HEAD>
<body>
<div class="zst_pagetop">
<div class="login_logo" style="padding-top:50px;"><h1>历史开奖</h1></div>
</div>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/line.css"  rel="stylesheet" type="text/css">
<link href="js/jqueryui/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css" />


<div class="gameClass_Navlist">
	<ul>
            <li id="lottery_div_1"><a href="/zst/index.php?typeid=1">重庆时时彩</a></li>
            <li id="lottery_div_6"><a href="/zst/index.php?typeid=12">新疆时时彩</a></li>
			<li id="lottery_div_6"><a href="/zst/index.php?typeid=35">天津时时彩</a></li>
			<li id="lottery_div_6"><a href="/zst/index.php?typeid=65">香港时时彩</a></li>
            
            <li id="lottery_div_15"><a href="/zst/index.php?typeid=14">河内5分彩</a></li>
            <li id="lottery_div_14"><a href="/zst/index.php?typeid=26">河内2分彩</a></li>
            <li id="lottery_div_16"><a href="/zst/index.php?typeid=5">河内1分彩</a></li>
            
            <li id="lottery_div_5"><a href="/zst/11x5.php?typeid=7">山东11选5</a></li>
            <li id="lottery_div_7"><a href="/zst/11x5.php?typeid=16">江西11选5</a></li>
            <li id="lottery_div_22"><a href="/zst/11x5.php?typeid=6">广东11选5</a></li>
			<li id="lottery_div_22"><a href="/zst/11x5.php?typeid=55">澳门11选5</a></li>
			
			<li id="lottery_div_21"><a href="/zst/k3.php?typeid=60">澳门快三</a></li>
            <li id="lottery_div_19"><a href="/zst/k3.php?typeid=25">江苏快三</a></li>
			
			<li id="lottery_div_17"><a href="/zst/3d.php?typeid=64">澳门3D</a></li>
            <li id="lottery_div_11"><a href="/zst/3d.php?typeid=9">3D福彩</a></li>
            <li id="lottery_div_12"><a href="/zst/3d.php?typeid=10">排列三</a></li>
			
			 <li id="lottery_div_12"><a href="/zst/klsf.php?typeid=18">重庆快乐十分</a></li>
			 <li id="lottery_div_12"><a href="/zst/klsf.php?typeid=66">澳门快乐十分</a></li>
	</ul>
</div>

<div class="search">
<b class="b5"></b>
<b class="b6"></b>
<b class="b7"></b>
<b class="b8"></b>
<table width="100%" id="titlemessage" border="0" cellpadding="0" cellspacing="0" style="background:#DDE0E5;">
	<tr>
	<td><b><span class="redtext"><?=$shortName?>基本走势</span></b></td>
		<td>
			<a href="?typeid=<?=$typeid?>&pgs=30" class="ml10<?php if($pgs==30) echo ' on'?>" target="_self">最近30期</a>
			<a href="?typeid=<?=$typeid?>&pgs=50" class="ml10<?php if($pgs==50) echo ' on'?>" target="_self">最近50期</a>
            <a href="?typeid=<?=$typeid?>&pgs=80" class="ml10<?php if($pgs==80) echo ' on'?>" target="_self">最近80期</a>
			<a href="?typeid=<?=$typeid?>&pgs=100" class="ml10<?php if($pgs==100) echo ' on'?>" target="_self">最近100期</a>
            <a href="?typeid=<?=$typeid?>&pgs=120" class="ml10<?php if($pgs==120) echo ' on'?>" target="_self">最近120期</a>
			<a href="?typeid=<?=$typeid?>&pgs=200" class="ml10<?php if($pgs==200) echo ' on'?>" target="_self">最近200期</a>
			<a href="?typeid=<?=$typeid?>&pgs=300" class="ml10<?php if($pgs==300) echo ' on'?>" target="_self">最近300期</a>
		</td>
		<td>
        <form action="" method="get">
        	<input type="hidden" name="typeid" value="<?=$typeid?>" />
            <input type="hidden" name="pgs" value="<?=$pgs?>" />
            <input type="text" value="<?=$fromTime?>" class="datetxt" name="fromTime" id="fromTime" style="width:80px;">
            <img src="images/date.png" style="vertical-align:middle;">
            至
            <input type="text" value="<?=$toTime?>" class="datetxt" name="toTime" id="toTime" style="width:80px;">
            <img src="images/date.png" style="vertical-align:middle;">
            <input type="submit" value="查询" id="showissue1">
        </form>
		</td>
	</tr>

</tbody></table>
<b class="b8"></b>
<b class="b7"></b>
<b class="b6"></b>
<b class="b5"></b>
</div>
<table height="5"><tbody><tr><td></td></tr></tbody></table>
<table align="center">
	 <tbody><tr>
        <td colspan="3" style="border:0px;">
			标注形式选择&nbsp;<input type="checkbox" name="checkbox2" value="checkbox" id="has_line">
            <span><b><label for="has_line">显示走势折线</label></b></span>&nbsp;
            <span>
            <label for="no_miss">
                <input type="checkbox" name="checkbox" value="checkbox" id="no_miss">不带遗漏
            </label>
            </span>
        </td>
      </tr>
</tbody></table>
<table height="8"><tbody><tr><td></td></tr></tbody></table>
<div style="position: relative; height: 756px;" id="container">
<table id="chartsTable" width="100%" cellpadding="0" cellspacing="0" border="0" style="position:absolute; top:0; left:0;">
      <tbody><tr id="title">
             <td rowspan="2"><strong>期号</strong></td>
             <td rowspan="2" colspan="8" class="redtext"><strong>开奖号码</strong></td>
                          <td colspan="20"><strong>第一位</strong></td>
                          <td colspan="20"><strong>第二位</strong></td>
      <td colspan="20"><strong>第三位</strong></td>
      <td colspan="20"><strong>第四位</strong></td>
      <td colspan="20"><strong>第五位</strong></td>
	  <td colspan="20"><strong>第六位</strong></td>
	  <td colspan="20"><strong>第七位</strong></td>
	  <td colspan="20"><strong>第八位</strong></td>
                 </tr>
                    <tr id="head">
                        
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						<td class="wdh" align="center"><strong>12</strong></td>
						<td class="wdh" align="center"><strong>13</strong></td>
						<td class="wdh" align="center"><strong>14</strong></td>
						<td class="wdh" align="center"><strong>15</strong></td>
						<td class="wdh" align="center"><strong>16</strong></td>
						<td class="wdh" align="center"><strong>17</strong></td>
						<td class="wdh" align="center"><strong>18</strong></td>
						<td class="wdh" align="center"><strong>19</strong></td>
						<td class="wdh" align="center"><strong>20</strong></td>
						
						
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						<td class="wdh" align="center"><strong>12</strong></td>
						<td class="wdh" align="center"><strong>13</strong></td>
						<td class="wdh" align="center"><strong>14</strong></td>
						<td class="wdh" align="center"><strong>15</strong></td>
						<td class="wdh" align="center"><strong>16</strong></td>
						<td class="wdh" align="center"><strong>17</strong></td>
						<td class="wdh" align="center"><strong>18</strong></td>
						<td class="wdh" align="center"><strong>19</strong></td>
						<td class="wdh" align="center"><strong>20</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						<td class="wdh" align="center"><strong>12</strong></td>
						<td class="wdh" align="center"><strong>13</strong></td>
						<td class="wdh" align="center"><strong>14</strong></td>
						<td class="wdh" align="center"><strong>15</strong></td>
						<td class="wdh" align="center"><strong>16</strong></td>
						<td class="wdh" align="center"><strong>17</strong></td>
						<td class="wdh" align="center"><strong>18</strong></td>
						<td class="wdh" align="center"><strong>19</strong></td>
						<td class="wdh" align="center"><strong>20</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						<td class="wdh" align="center"><strong>12</strong></td>
						<td class="wdh" align="center"><strong>13</strong></td>
						<td class="wdh" align="center"><strong>14</strong></td>
						<td class="wdh" align="center"><strong>15</strong></td>
						<td class="wdh" align="center"><strong>16</strong></td>
						<td class="wdh" align="center"><strong>17</strong></td>
						<td class="wdh" align="center"><strong>18</strong></td>
						<td class="wdh" align="center"><strong>19</strong></td>
						<td class="wdh" align="center"><strong>20</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						<td class="wdh" align="center"><strong>12</strong></td>
						<td class="wdh" align="center"><strong>13</strong></td>
						<td class="wdh" align="center"><strong>14</strong></td>
						<td class="wdh" align="center"><strong>15</strong></td>
						<td class="wdh" align="center"><strong>16</strong></td>
						<td class="wdh" align="center"><strong>17</strong></td>
						<td class="wdh" align="center"><strong>18</strong></td>
						<td class="wdh" align="center"><strong>19</strong></td>
						<td class="wdh" align="center"><strong>20</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						<td class="wdh" align="center"><strong>12</strong></td>
						<td class="wdh" align="center"><strong>13</strong></td>
						<td class="wdh" align="center"><strong>14</strong></td>
						<td class="wdh" align="center"><strong>15</strong></td>
						<td class="wdh" align="center"><strong>16</strong></td>
						<td class="wdh" align="center"><strong>17</strong></td>
						<td class="wdh" align="center"><strong>18</strong></td>
						<td class="wdh" align="center"><strong>19</strong></td>
						<td class="wdh" align="center"><strong>20</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						<td class="wdh" align="center"><strong>12</strong></td>
						<td class="wdh" align="center"><strong>13</strong></td>
						<td class="wdh" align="center"><strong>14</strong></td>
						<td class="wdh" align="center"><strong>15</strong></td>
						<td class="wdh" align="center"><strong>16</strong></td>
						<td class="wdh" align="center"><strong>17</strong></td>
						<td class="wdh" align="center"><strong>18</strong></td>
						<td class="wdh" align="center"><strong>19</strong></td>
						<td class="wdh" align="center"><strong>20</strong></td>
						
						<td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
						<td class="wdh" align="center"><strong>10</strong></td>
						<td class="wdh" align="center"><strong>11</strong></td>
						<td class="wdh" align="center"><strong>12</strong></td>
						<td class="wdh" align="center"><strong>13</strong></td>
						<td class="wdh" align="center"><strong>14</strong></td>
						<td class="wdh" align="center"><strong>15</strong></td>
						<td class="wdh" align="center"><strong>16</strong></td>
						<td class="wdh" align="center"><strong>17</strong></td>
						<td class="wdh" align="center"><strong>18</strong></td>
						<td class="wdh" align="center"><strong>19</strong></td>
						<td class="wdh" align="center"><strong>20</strong></td>
                    </tr>
          		<?php
				if($fromTime) $fromTime=strtotime($fromTime);
				if($toTime) $toTime=strtotime($toTime)+24*3600;
				
				$pg=trim($_REQUEST["page"]);
				if(!$pg){$pg=1;}
				if(!$pgs){$pgs=30;}
				$tableStr=$conf['db']['prename']."data";
				$tableStr2=$conf['db']['prename']."data a";
				$fieldsStr="time, number, data";
				
				$fieldsStr2="a.time, a.number, a.data";
				$whereStr=" type=$typeid ";
				$whereStr2=" a.type=$typeid ";
				if($fromTime && $toTime){
					$whereStr.=" and time between $fromTime and $toTime";
					$whereStr2.=" and a.time between $fromTime and $toTime";
				}elseif($fromTime){
					$whereStr.=' and time>='.$fromTime;
					$whereStr2.=' and a.time>='.$fromTime;
				}elseif($toTime){
					$whereStr.=' and time<'.$toTime;
					$whereStr2.=' and a.time<'.$toTime;
				}else{}
				$orderStr=" order by a.id asc";
	
				$totalNumber = $mydb->row_count($tableStr,$whereStr);

				if ($totalNumber>0){
			 
                $countcount=0;
				$perNumber=$pgs; //每页显示的记录数
				$page=$pg; //获得当前的页面值
				if (!isset($page)) $page=1;
				
				$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
				$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
				$data = $mydb->row($tableStr2,$fieldsStr2,$whereStr2.' '.$orderStr." limit $startCount,$perNumber");
				
				if($data) foreach($data as $var){
					
				$dArry=explode(",",$var[2]);
				$var['d1']=$dArry[0];
				$var['d2']=$dArry[1];
				$var['d3']=$dArry[2];
				$var['d4']=$dArry[3];
				$var['d5']=$dArry[4];
				$var['d6']=$dArry[5];
				$var['d7']=$dArry[6];
				$var['d8']=$dArry[7];
				
				echo '<tr>';
				echo '<td id="title">'.$var[1].'</td>';
				echo '<td class="wdh" align="center"><div class="ball11">'.$var['d1'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball11">'.$var['d2'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball11">'.$var['d3'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball11">'.$var['d4'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball11">'.$var['d5'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball11">'.$var['d6'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball11">'.$var['d7'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball11">'.$var['d8'].'</div></td>';
	
				for($i=1;$i<21;$i++) //第一位
				{
					if($i==intval($var['d1'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d1'].'</div></td>';
						$five['LW'.$i]=0;  //遗漏
						if($five['SW'.$i]){$five['SW'.$i]++;}else{$five['SW'.$i]=1;} //出现总次数
						if($five['LCW'.$i]){$five['LCW'.$i]++;}else{$five['LCW'.$i]=1;} //最大连出值
					}else{
						if($five['LW'.$i]){$five['LW'.$i]++;}else{$five['LW'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LW'.$i].'</div></td>';
						$five['LCW'.$i]=0;
					}
					//遗漏总计
					if($five['ZW'.$i]){$five['ZW'.$i]+=$five['LW'.$i];}else{$five['ZW'.$i]=$five['LW'.$i];}
					//最大遗漏值
					if($five['MW'.$i]<$five['LW'.$i]){$five['MW'.$i]=$five['LW'.$i];}
					//最大连出值
					if($five['MLCW'.$i]<$five['LCW'.$i]){$five['MLCW'.$i]=$five['LCW'.$i];}
					
				}
				
				for($i=1;$i<21;$i++) //第二位
				{
					if($i==intval($var['d2'])){
						echo '<td class="charball" align="center"><div class="ball02">'.$var['d2'].'</div></td>';
						$five['LQ'.$i]=0;
						if($five['SQ'.$i]){$five['SQ'.$i]++;}else{$five['SQ'.$i]=1;}
						if($five['LCQ'.$i]){$five['LCQ'.$i]++;}else{$five['LCQ'.$i]=1;}
					}else{
						if($five['LQ'.$i]){$five['LQ'.$i]++;}else{$five['LQ'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball04">'.$five['LQ'.$i].'</div></td>';
						$five['LCQ'.$i]=0;
					}
					if($five['ZQ'.$i]){$five['ZQ'.$i]+=$five['LQ'.$i];}else{$five['ZQ'.$i]=$five['LQ'.$i];}
					if($five['MQ'.$i]<$five['LQ'.$i]){$five['MQ'.$i]=$five['LQ'.$i];}
					if($five['MLCQ'.$i]<$five['LCQ'.$i]){$five['MLCQ'.$i]=$five['LCQ'.$i];}
		
				}
				for($i=1;$i<21;$i++) //第三位
				{
					if($i==intval($var['d3'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d3'].'</div></td>';
						$five['LB'.$i]=0;
						if($five['SB'.$i]){$five['SB'.$i]++;}else{$five['SB'.$i]=1;}
						if($five['LCB'.$i]){$five['LCB'.$i]++;}else{$five['LCB'.$i]=1;}
					}else{
						if($five['LB'.$i]){$five['LB'.$i]++;}else{$five['LB'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LB'.$i].'</div></td>';
						$five['LCB'.$i]=0;
					}
					if($five['ZB'.$i]){$five['ZB'.$i]+=$five['LB'.$i];}else{$five['ZB'.$i]=$five['LB'.$i];}
					if($five['MB'.$i]<$five['LB'.$i]){$five['MB'.$i]=$five['LB'.$i];}
					if($five['MLCB'.$i]<$five['LCB'.$i]){$five['MLCB'.$i]=$five['LCB'.$i];}
				
				}

				for($i=1;$i<21;$i++) //第四位
				{
					if($i==intval($var['d4'])){
						echo '<td class="charball" align="center"><div class="ball02">'.$var['d4'].'</div></td>';
						$five['LS'.$i]=0;
						if($five['SS'.$i]){$five['SS'.$i]++;}else{$five['SS'.$i]=1;}
						if($five['LCS'.$i]){$five['LCS'.$i]++;}else{$five['LCS'.$i]=1;}
					}else{
						if($five['LS'.$i]){$five['LS'.$i]++;}else{$five['LS'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball04">'.$five['LS'.$i].'</div></td>';
						$five['LCS'.$i]=0;
					}
					if($five['ZS'.$i]){$five['ZS'.$i]+=$five['LS'.$i];}else{$five['ZS'.$i]=$five['LS'.$i];}
					if($five['MS'.$i]<$five['LS'.$i]){$five['MS'.$i]=$five['LS'.$i];}
					if($five['MLCS'.$i]<$five['LCS'.$i]){$five['MLCS'.$i]=$five['LCS'.$i];}
			
				}
				
				for($i=1;$i<21;$i++)  //第五位
				{
					if($i==intval($var['d5'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d5'].'</div></td>';
						$five['LG'.$i]=0;
						if($five['SG'.$i]){$five['SG'.$i]++;}else{$five['SG'.$i]=1;}
						if($five['LCG'.$i]){$five['LCG'.$i]++;}else{$five['LCG'.$i]=1;}
					}else{
						if($five['LG'.$i]){$five['LG'.$i]++;}else{$five['LG'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LG'.$i].'</div></td>';
						$five['LCG'.$i]=0;
					}
					if($five['ZG'.$i]){$five['ZG'.$i]+=$five['LG'.$i];}else{$five['ZG'.$i]=$five['LG'.$i];}
					if($five['MG'.$i]<$five['LG'.$i]){$five['MG'.$i]=$five['LG'.$i];}
					if($five['MLCG'.$i]<$five['LCG'.$i]){$five['MLCG'.$i]=$five['LCG'.$i];}
				}
				
				for($i=1;$i<21;$i++) //第六位
				{
					if($i==intval($var['d6'])){
						echo '<td class="charball" align="center"><div class="ball02">'.$var['d6'].'</div></td>';
						$five['LS'.$i]=0;
						if($five['SS'.$i]){$five['SS'.$i]++;}else{$five['SS'.$i]=1;}
						if($five['LCS'.$i]){$five['LCS'.$i]++;}else{$five['LCS'.$i]=1;}
					}else{
						if($five['LS'.$i]){$five['LS'.$i]++;}else{$five['LS'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball04">'.$five['LS'.$i].'</div></td>';
						$five['LCS'.$i]=0;
					}
					if($five['ZS'.$i]){$five['ZS'.$i]+=$five['LS'.$i];}else{$five['ZS'.$i]=$five['LS'.$i];}
					if($five['MS'.$i]<$five['LS'.$i]){$five['MS'.$i]=$five['LS'.$i];}
					if($five['MLCS'.$i]<$five['LCS'.$i]){$five['MLCS'.$i]=$five['LCS'.$i];}
			
				}
				
				for($i=1;$i<21;$i++)  //第七位
				{
					if($i==intval($var['d7'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d7'].'</div></td>';
						$five['LG'.$i]=0;
						if($five['SG'.$i]){$five['SG'.$i]++;}else{$five['SG'.$i]=1;}
						if($five['LCG'.$i]){$five['LCG'.$i]++;}else{$five['LCG'.$i]=1;}
					}else{
						if($five['LG'.$i]){$five['LG'.$i]++;}else{$five['LG'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LG'.$i].'</div></td>';
						$five['LCG'.$i]=0;
					}
					if($five['ZG'.$i]){$five['ZG'.$i]+=$five['LG'.$i];}else{$five['ZG'.$i]=$five['LG'.$i];}
					if($five['MG'.$i]<$five['LG'.$i]){$five['MG'.$i]=$five['LG'.$i];}
					if($five['MLCG'.$i]<$five['LCG'.$i]){$five['MLCG'.$i]=$five['LCG'.$i];}
				}
				
				for($i=1;$i<21;$i++) //第八位
				{
					if($i==intval($var['d8'])){
						echo '<td class="charball" align="center"><div class="ball02">'.$var['d8'].'</div></td>';
						$five['LS'.$i]=0;
						if($five['SS'.$i]){$five['SS'.$i]++;}else{$five['SS'.$i]=1;}
						if($five['LCS'.$i]){$five['LCS'.$i]++;}else{$five['LCS'.$i]=1;}
					}else{
						if($five['LS'.$i]){$five['LS'.$i]++;}else{$five['LS'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball04">'.$five['LS'.$i].'</div></td>';
						$five['LCS'.$i]=0;
					}
					if($five['ZS'.$i]){$five['ZS'.$i]+=$five['LS'.$i];}else{$five['ZS'.$i]=$five['LS'.$i];}
					if($five['MS'.$i]<$five['LS'.$i]){$five['MS'.$i]=$five['LS'.$i];}
					if($five['MLCS'.$i]<$five['LCS'.$i]){$five['MLCS'.$i]=$five['LCS'.$i];}
			
				}
			
			echo '</tr>';	
			
            } 
			
				
			
		?>                          
    <tr>
    <td nowrap="">出现总次数</td>
    <td align="center" colspan="8">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G','W','W','W') as $var){
		for($i=1;$i<21;$i++)
		{
			if($five['S'.$var.$i]){
				$five['D'.$var.$i]=$five['S'.$var.$i];
			}else{
				$five['D'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['D'.$var.$i].'</td>';
		}
	}
	?>  
    </tr>
    <tr>
    <td nowrap="">平均遗漏值</td>
    <td align="center" colspan="8">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G','QW','BW','SW') as $var){
		for($i=1;$i<21;$i++)
		{
			$five['P'.$var.$i]=intval($pgs/($five['D'.$var.$i]+1));
			echo '<td align="center">'.$five['P'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr>
    <td nowrap>最大遗漏值</td>
    <td align="center" colspan="8">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G','QW','BW','SW') as $var){
		for($i=1;$i<21;$i++)
		{
			if($five['M'.$var.$i]){
				$five['Max'.$var.$i]=$five['M'.$var.$i];
			}else{
				$five['Max'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['Max'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr>
    <td nowrap>最大连出值</td>
    <td align="center" colspan="8">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G','QW','BW','SW') as $var){
		for($i=1;$i<21;$i++)
		{
			if($five['MLC'.$var.$i]){
				$five['MaxLC'.$var.$i]=$five['MLC'.$var.$i];
			}else{
				$five['MaxLC'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['MaxLC'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr id="head">
        <td rowspan="2" align="center"><strong>期号</strong></td>
        <td rowspan="2" align="center" colspan="8"><strong>开奖号码</strong></td>
       
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		<td align="center"><strong>14</strong></td>
		<td align="center"><strong>15</strong></td>
		<td align="center"><strong>16</strong></td>
		<td align="center"><strong>17</strong></td>
		<td align="center"><strong>18</strong></td>
		<td align="center"><strong>19</strong></td>
		<td align="center"><strong>20</strong></td>
		
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		<td align="center"><strong>14</strong></td>
		<td align="center"><strong>15</strong></td>
		<td align="center"><strong>16</strong></td>
		<td align="center"><strong>17</strong></td>
		<td align="center"><strong>18</strong></td>
		<td align="center"><strong>19</strong></td>
		<td align="center"><strong>20</strong></td>
		
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		<td align="center"><strong>14</strong></td>
		<td align="center"><strong>15</strong></td>
		<td align="center"><strong>16</strong></td>
		<td align="center"><strong>17</strong></td>
		<td align="center"><strong>18</strong></td>
		<td align="center"><strong>19</strong></td>
		<td align="center"><strong>20</strong></td>
		
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		<td align="center"><strong>14</strong></td>
		<td align="center"><strong>15</strong></td>
		<td align="center"><strong>16</strong></td>
		<td align="center"><strong>17</strong></td>
		<td align="center"><strong>18</strong></td>
		<td align="center"><strong>19</strong></td>
		<td align="center"><strong>20</strong></td>
		
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		<td align="center"><strong>14</strong></td>
		<td align="center"><strong>15</strong></td>
		<td align="center"><strong>16</strong></td>
		<td align="center"><strong>17</strong></td>
		<td align="center"><strong>18</strong></td>
		<td align="center"><strong>19</strong></td>
		<td align="center"><strong>20</strong></td>
		
		<td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		<td align="center"><strong>14</strong></td>
		<td align="center"><strong>15</strong></td>
		<td align="center"><strong>16</strong></td>
		<td align="center"><strong>17</strong></td>
		<td align="center"><strong>18</strong></td>
		<td align="center"><strong>19</strong></td>
		<td align="center"><strong>20</strong></td>
		
		<td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		<td align="center"><strong>14</strong></td>
		<td align="center"><strong>15</strong></td>
		<td align="center"><strong>16</strong></td>
		<td align="center"><strong>17</strong></td>
		<td align="center"><strong>18</strong></td>
		<td align="center"><strong>19</strong></td>
		<td align="center"><strong>20</strong></td>
		
		<td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
		<td align="center"><strong>10</strong></td>
		<td align="center"><strong>11</strong></td>
		<td align="center"><strong>12</strong></td>
		<td align="center"><strong>13</strong></td>
		<td align="center"><strong>14</strong></td>
		<td align="center"><strong>15</strong></td>
		<td align="center"><strong>16</strong></td>
		<td align="center"><strong>17</strong></td>
		<td align="center"><strong>18</strong></td>
		<td align="center"><strong>19</strong></td>
		<td align="center"><strong>20</strong></td>
    </tr>
    <tr id="title">
      <td colspan="20"><strong>第一位</strong></td>
      <td colspan="20"><strong>第二位</strong></td>
      <td colspan="20"><strong>第三位</strong></td>
      <td colspan="20"><strong>第四位</strong></td>
      <td colspan="20"><strong>第五位</strong></td>
	  <td colspan="20"><strong>第六位</strong></td>
	  <td colspan="20"><strong>第七位</strong></td>
	  <td colspan="20"><strong>第八位</strong></td>
    </tr>
    <?php	  
			  
		}
	?>
</tbody></table>
</div>

</div>
<!--<div id="footer">Copyright © 娱乐</div>-->
<script language="javascript" type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script language="javascript" type="text/javascript" src="js/line.js"></script>
<script language="javascript" type="text/javascript" src="js/jqueryui/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript">window.onerror=function(){return true;}</script>
<script language="javascript">
fw.onReady(function(){
	Chart.init();	
	DrawLine.bind("chartsTable","has_line");
	DrawLine.color('#499495');
	DrawLine.add((parseInt(0)*20+8+1),2,20,0);
	DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(1)*20+8+1),2,20,0);
	DrawLine.color('#499495');
	DrawLine.add((parseInt(2)*20+8+1),2,20,0);
	DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(3)*20+8+1),2,20,0);
	DrawLine.color('#499495');
	DrawLine.add((parseInt(4)*20+8+1),2,20,0);
	DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(5)*20+8+1),2,20,0);
	DrawLine.color('#499495');
	DrawLine.add((parseInt(6)*20+8+1),2,20,0);
	DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(7)*20+8+1),2,20,0);
	DrawLine.draw(Chart.ini.default_has_line);
	if($("#chartsTable").width()>$('body').width())
	{
	   $('body').width($("#chartsTable").width() + "px");
	}
	$("#container").height($("#chartsTable").height() + "px");
    resize();

	var nols = $(".ball04,.ball03");
	$("#no_miss").click(function(){
		
		var checked = $(this).attr("checked");
		$.each(nols,function(i,n){
			if(checked==true || checked=='checked'){
				n.style.display='none';
			}else{
				n.style.display='block';
			}
		});
	});
});
function resize(){
    window.onresize = func;
    function func(){
        window.location.href=window.location.href;
    }
}
$(function(){
	$(".datetxt").datepicker({ onSelect: function(dateText, inst) {$(this).val(dateText);} });	
})
</script>
</body>
</html>