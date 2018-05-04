<?php exit;?>00155056755132a0f82163f3b9d57fa36e94b364cd1es:9138:"a:2:{s:8:"template";s:9074:"<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:esun="" class="has-js">

	<head>
		<meta charset="utf-8" /><meta name="format-detection" content="telephone=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
		<title>【<?php echo $parentCategoryInfo["name"];?><?php echo $categoryInfo["name"];?>】<?php echo $parentCategoryInfo["name"];?>号码 开奖结果查询 - <?php echo $sys["site_title"];?></title>
		<meta name="keywords" content="<?php echo $categoryInfo["keywords"];?>" />
		<meta name="distribution" content="<?php echo $categoryInfo["description"];?>" />
		<link rel="stylesheet" href="/themes/168pc/css/headorfood.css" />
		<link rel="stylesheet" href="/themes/168pc/css/pk10kai.css" />
		<link rel="stylesheet" href="/themes/168pc/css/calendar.css" />
		<link rel="shortcut icon" href="/themes/168pc/img/icon/168favicon.ico/v=2017981058.html">
		<link rel="stylesheet" href="/themes/168pc/css/user_adv.css" />
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/js/tests/vendor/jquery.min.js"></script>
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/dist/js/bootstrap.min.js"></script>
		
	</head>

	<body>
		<div class="bodybox pk10lzzhfxymbox daxiaodsbox zsbox pk10gyhzsbox">
					<?php $__Template->display("themes/168pc/head"); ?>

			<div class="haomabox">
				<div class="waring" id="waringbox">
					<div class="flash"><i></i></div>
					温馨提示：因网络问题，开奖结果会有延迟，所以您需要去喝杯咖啡等一会儿！
				</div>
			<div class="haomaqu" id="pk10">
					<div class="haomaqubox">
						<div class="haomaqul">
							<div class="haomaline">
								<div class="haomaimg">
									<a href="<?php echo $parentCategoryInfo["urlname"];?>.html"><img src="<?php echo $parentCategoryInfo["image"];?>" /></a>
								</div>
								<div class="numberqu">
									<div class="nuberqutit">
										<div class="divl">
											<a href="<?php echo $parentCategoryInfo["urlname"];?>.html"><span class="pk10tit">北京PK拾</span></a>第<span class="redfont preDrawIssue"></span>期&nbsp;开奖
										</div>
										<div class="divr">
											全天<span class="totalCount">...</span>期，当前<span class="drawCount">...</span>期,剩<span class="sdrawCount">...</span>期
										</div>
									</div>
									<div class="kajianhao">
										<ul id="jnumber" class="numberbox">
											<li class="nub02 "></li>
											<li class="nub01 "></li>
											<li class="nub10 "></li>
											<li class="nub04 "></li>
											<li class="nub03 "></li>
											<li class="nub06 "></li>
											<li class="nub07 "></li>
											<li class="nub08 "></li>
											<li class="nub05 "></li>
											<li class="nub09 li_after"></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="haomaqur">
							<div class="line linetime" id="timebox">
								<div class="opening opentyle">开奖中...</div>
								<div class="clock cuttime">
									距&nbsp;&nbsp;<span class="nextIssue"></span>&nbsp;&nbsp;期开奖仅有
									<span class="bgtime hour">0</span>
									<span class="hourtxt">时</span>
									<span class="bgtime minute">0</span>
									<span>分</span>
									<span class="bgtime second">0</span>
									<span>秒</span>
								</div>
							</div>
						</div>
					</div>
					<div class="hreflist">
						<ul>
							<li>
								<a href="/<?php echo $parentCategoryInfo["urlname"];?>.html">即时开奖</a>
							</li>
							<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>4, "limit"=>100));  if(is_array($listList)) foreach($listList as $list){ ?>
  <?php if ($list['class_id']==$categoryInfo['class_id']){ ?>
    <li class="checked"><a href="<?php echo $list["curl"];?>" title="<?php echo $list["name"];?>">
					<span class="n"><?php echo $list["name"];?></span></a></li>
  <?php }else{ ?>
  
    <li><a href="<?php echo $list["curl"];?>" title="<?php echo $list["name"];?>"><i class="icon_global icon_<?php echo $list["i"];?>"></i>
					<span class="n"><?php echo $list["name"];?></span></a></li>
  <?php } ?>
<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="zhlzbox margt20">
				<div class="listhead">
					<div class="pk10gyhzs_listheadl">
						<span class="lmms"><i>3</i>冠亚和走势</span>
					</div>
					<div class="pk10gyhzs_listheadr">
						<div class="pk10gyhzs_listheadrr">
							<div class="rightime">
								<div id="dateframe">
									<input type="text" class="date" placeholder="">
									<div id="datebox"></div>
									<i class="dropicond"></i>
								</div>
							</div>
							<div>选择日期&nbsp;</div>
						</div>
						<div class="listheadrl">
							<span id="today" class="checked">今天</span>
							<span id="yesterday">昨天</span>
							<span id="qianday">前天</span>
							<span id="thirty">最近30期</span>
							<span id="sixty">最近60期</span>
							<span id="ninety">最近90期</span>
						</div>
					</div>
				</div>
				<div class="listbox">
					<div class="checkbox">
						<div id="biaozxz" class="checkbtnzh checkbtnmc">
							<ul>
								<li class="title">标注选择：</li>
								<li class="sinli checked"><i>1</i>
									<a href="javascript:void(0)">遗漏</a>
								</li>
								<li class="sinli checked"><i>2</i>
									<a href="javascript:void(0)">拆线</a>
								</li>
								<li class="sinli"><i>3</i>
									<a href="javascript:void(0)">遗漏分成</a>
								</li>
								<li class="sinli"><i>4</i>
									<a href="javascript:void(0)">分隔线</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="listcontent">
						<div class="box">
							<div id="waitBox" class="bastren w1200">
								<div id="chartLinediv" style="position:relative;*position:static;">
									<table id="table_ganyah" width="100%" border="0" cellpadding="0" cellspacing="0">
										<thead>
											<tr>
												<th width="85"  height="38" class="left_border left_b left_strong_down">期号</th>
												<th width="100">开奖时间</th>
												<th width="215">开奖号码</th>
												<th width="58">冠亚和</th>
												<th width="40">3</th>
												<th width="40">4</th>
												<th width="40">5</th>
												<th width="40">6</th>
												<th width="40">7</th>
												<th width="40">8</th>
												<th width="40">9</th>
												<th width="40">10</th>
												<th width="40">11</th>
												<th width="40">12</th>
												<th width="40">13</th>
												<th width="40">14</th>
												<th width="40">15</th>
												<th width="40">16</th>
												<th width="40">17</th>
												<th width="40">18</th>
												<th width="40">19</th>
											</tr>
										</thead>
									
										<tbody>
											<tr>
												<td width="85">581435</td>
												<td width="100">10:25:43</td>
												<td width="215">6  2  3  4  8  7  1  5  9  10</td>
												<td width="58">8</td>
												<td width="40">3</td>
												<td width="40">4</td>
												<td width="40">5</td>
												<td width="40">6</td>
												<td width="40">7</td>
												<td width="40">8</td>
												<td width="40">9</td>
												<td width="40">10</td>
												<td width="40">11</td>
												<td width="40">12</td>
												<td width="40">13</td>
												<td width="40">14</td>
												<td width="40">15</td>
												<td width="40">16</td>
												<td width="40">17</td>
												<td width="40">18</td>
												<td width="40">19</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div id="chartbottom" style="display: none;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php $__Template->display("themes/168pc/foot"); ?>


	</body>
	<script type="text/javascript" src="/themes/168pc/js/lib/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/themes/168pc/js/lib/drawLines.js"></script>
	<script type="text/javascript" charset="utf-8" src="/themes/168pc/js/lib/jquery.async.js"></script>
	<script type="text/javascript" charset="utf-8" src="/themes/168pc/js/lib/pk10BaseTrend.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/calendar.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/config.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/animate/animate.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/GA.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/pk10/pk10_kai.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/pk10/pk10_guanyahezs.js"></script>
</html>";s:12:"compile_time";i:1519031551;}";