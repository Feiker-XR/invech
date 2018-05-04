<?php exit;?>001550395920371962d05f220d4c408f4fd11ca51a4cs:6326:"a:2:{s:8:"template";s:6262:"<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,minimal-ui">
		<title>【<?php echo $categoryInfo["name"];?>开奖结果】<?php echo $categoryInfo["name"];?>开奖查询_<?php echo $categoryInfo["name"];?>开奖号码-<?php echo $sys["site_title"];?></title>
		<meta name="keywords" content="<?php echo $categoryInfo["keywords"];?>" />
		<meta name="distribution" content="<?php echo $categoryInfo["description"];?>" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" href="/themes/m/css/pk10.css" />
		<link rel="stylesheet" href="/themes/m/css/common.css" />
		<link rel="stylesheet" href="/themes/m/css/public.css" />
		<script type="text/javascript" src="/themes/m/js/lib/jquery-1.9.1.js"></script>
	</head>

	<body class="wxgzh iphone withHeader article utms-wxgzh utmm-None utmc-None list-page">
		<div class="pagediv">
								<?php $__Template->display("themes/m/head"); ?>

			<!--
            	时间：2017-01-07
            	描述：头部开奖
            -->
			<div class="headNum" id="headerData">
				<div class="divline issuel">
					<span class="issue"><span class="preDrawIssue">588258</span>期开奖</span>
					<span class="drawCount">已开<span class="drawCountnum">...</span>期，剩余<span class="sdrawCountnext">...</span>期</span>
				</div>
				<div class="divline drawCodel">
					<ul id="pk10num" class="sscli">
						<li>03</li>
						<li>01</li>
						<li>05</li>
						<li>06</li>
						<li>04</li>
					</ul>
				</div>
				<div class="divline drawCodel tiger">
					<ul class="pk10li longhu">
						<li>虎</li>
						<li>虎</li>
						<li class="li_after">虎</li>
						<li class="verline li_after">|</li>
						<li class="guanyahe li_after">总和：</li>
						<li class="guanyaheli li_after">10</li>
						<li class="guanyaheli li_after">单</li>
						<li class="guanyaheli li_after">大</li>
					</ul>
				</div>
				<div class="divline drawTimebox cuttime">
					<div class="flexl margtp78">距下期开奖仅有</div>
					<input type="hidden" class="nextIssue" />
					<div class="flexc margtp78">
						<div class="graypro"></div>
						<div class="redpro"></div>
						<input type="hidden" id="nextIssue" />
						<input type="hidden" class="drawTime" />
						<input type="hidden" id="sumNum" />
						<input type="hidden" id="sumSingleDouble" />
						<input type="hidden" id="sumBigSmall" />

					</div>
					<div class="flexr margtp78" id="timebox">
						<span class="hourid"><span class="bgtime hour"></span>:</span><span class="bgtime minute"></span>:<span class="bgtime second"></span>
					</div>
					<div class="flexr">
						<span class="openVideo" id="startVideo">
							视频
						</span>
					</div>
				</div>
				<div class="divline drawTimebox opentyle displaynone">
					<div class="flexl">开奖中...</div>
				</div>
			</div>
			<!--
            	时间：2017-01-07
            	描述：数据列表头部
            -->
			<div class="ListHead">
				<div class="headTitle">
					<div id="kaijianghm" class="checkedbl"><span>开奖号码<i></i></span></div>
					<div id="shuangmiantj"><span>双面统计<i></i></span></div>
					<div id="changlongtj"><span>长龙统计<i></i></span></div>
					<div id="haomafb"><span>号码分布<i></i></span></div>
				</div>
				<!--
                	时间：2017-01-10
                	描述：开奖号码
                -->
				<div class="drawCodebox kaijianghm">
					<div class="linebox">
						<div class="leftspan">
							<span class="leftspan">时间</span>
							<span class="rightspan padleft1">期数</span>
						</div>
						<div class="rightspan">
							<div class="rightdiv" id="rightdiv">
								<span id="xshm" class="spanchecked">号码</span>
								<span id="xsdx">大小</span>
								<span id="xsds">单双</span>
								<span id="gjlh">总和/形态</span>
							</div>
						</div>
					</div>
					<div class="contentlist bortop002" id="numlist">
					</div>
				</div>
				<div class="drawCodebox shuangmiantj displaynone">
					<div class="line2box" id="liangmianbox">
					</div>
				</div>
				<div class="drawCodebox changlongtj displaynone">
					<div class="line2box">
						<ul id="longDrag">
						</ul>
					</div>
				</div>
				<div class="drawCodebox haomafb displaynone">
					<div id="numberbtn">
						<div class="linebox">
							<div class="numbtn">
								<ul>
									<li>01</li>
									<li>02</li>
									<li>03</li>
									<li>04</li>
									<li>05</li>
									<li>06</li>
									<li>07</li>
									<li>08</li>
									<li>09</li>
									<li>10</li>
									<li>11</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="linebox">
						<div class="dansdxbtn">
							<ul>
								<li>单</li>
								<li>双</li>
								<li>大</li>
								<li>小</li>
							</ul>
						</div>
					</div>
					<div class="contentlist bortop002" id="haomafblist">
					</div>
				</div>
			</div>
			<!--
            	时间：2017-01-07
            	描述：数据列表
            -->
					<?php $__Template->display("themes/m/foot"); ?>

		</div>
		<div id="videobox">
			<div class="content">
				<div class="head">
					江西11选5开奖视频
					<div class="btn">
						<ul>
							<li class="closevideo"><i class="iconfont">关闭</i></li>
						</ul>
					</div>
				</div>
				<div class="animate" style="margin: 0 auto;">
					<iframe style="height:100%;width:100%;border: none;" src="/themes/m/js/lib/video/11x5_video/jxef_index.html"></iframe>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="/themes/m/js/lib/date.js"></script>
		<script type="text/javascript" src="/themes/m/js/lib/iscroll.js"></script>
		<script type="text/javascript" src="/themes/m/js/lib/config.js"></script>
		<script type="text/javascript" src="/themes/m/js/local/tools/tools.js"></script>
		<script type="text/javascript" src="/themes/m/js/local/gdsyxw/head_jxef.js"></script>
		<script type="text/javascript" src="/themes/m/js/local/gdsyxw/index_gdsyxw.js"></script>
		<script type="text/javascript" src="/themes/m/js/lib/GA.js"></script>
		<div id="datePlugin"></div>
	</body>

</html>
";s:12:"compile_time";i:1518859920;}";