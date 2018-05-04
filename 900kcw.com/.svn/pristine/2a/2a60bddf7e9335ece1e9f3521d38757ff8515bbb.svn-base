<?php exit;?>00155040748089401ee0956caa295c9d82974b8435des:12479:"a:2:{s:8:"template";s:12414:"<html><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="format-detection" content="telephone=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
		<title>【<?php echo $categoryInfo["name"];?>开奖结果】<?php echo $categoryInfo["name"];?>开奖查询_<?php echo $categoryInfo["name"];?>开奖号码-<?php echo $sys["site_title"];?></title>
		<meta name="keywords" content="<?php echo $categoryInfo["keywords"];?>" />
		<meta name="distribution" content="<?php echo $categoryInfo["description"];?>" />
		<link rel="stylesheet" href="/themes/168pc/css/headorfood.css" />
		<link rel="stylesheet" href="/themes/168pc/css/klsf.css" />
		<link rel="shortcut icon" href="/themes/168pc/img/icon/168favicon.ico/v=2017981058.html">
		<link rel="stylesheet" href="/themes/168pc/css/user_adv.css" />
		<link rel="stylesheet" href="/themes/168pc/css/idangerous.swiper.css" />
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/js/tests/vendor/jquery.min.js"></script>
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/dist/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="/themes/168pc/js/lib/jquery-1.7.2.min.js"></script>
	</head>

	<body>
		<div class="bodybox">
<?php $__Template->display("themes/168pc/head"); ?>
			<div class="haomabox">
				<div class="waring" id="waringbox">
					<div class="flash"><i></i></div>
					温馨提示：因网络问题，开奖结果会有延迟，所以您需要去喝杯咖啡等一会儿！
				</div>
				<div class="haomaqu" id="shiyix5">
					<div class="haomaqul">
						<div class="haomaline">
							<div class="haomaimg">
								<img src="<?php echo $categoryInfo["image"];?>" />
							</div>
							<div class="numberqu">
								<div class="nuberqutit">
									<span class="klsf"><?php echo $categoryInfo["name"];?></span>第
									<span class="preDrawIssue"></span> 期开奖号码
									<input type="hidden" id="drawTime">
									<input type="hidden" id="sumNum" />
									<input type="hidden" id="sumSingleDouble" />
									<input type="hidden" id="sumBigSmall" />
								</div>
								<div class="kajianhao" id="jnumber">
									<ul>
										<li class="numblueHead">1</li>
										<li class="numblueHead">3</li>
										<li class="numblueHead">2</li>
										<li class="numblueHead">4</li>
										<li class="numblueHead">6</li>
									</ul>
								</div>

							</div>
						</div>
						<div class="haomaline homaline2">
							<div class="haomaimg">
								<p class="kaijianname"><?php echo $categoryInfo["name"];?></p>
							</div>
							<div class="margt30">
								<ul class="zoushimap">
									<li class="list lihead no_left">走势图表：</li>
								<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>103 , "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
									<li class="list">
										<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
									</li>
                                 <?php } ?>
									<li class="list morelist" id="morelist">
										<a href="javascript:void(0)" class="more">更多<img class="graypre" src="/themes/168pc/img/graypre.png" alt="" /><img class="yellowpre" src="/themes/168pc/img/yellowpre.png" alt="" /></a>
										<div class="sub_morelist" style="display: none;">
											<ul class="leftUl">
												<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>103, "class_id"=>'108,109,110,111,112,113,114,115,116'));  if(is_array($listList)) foreach($listList as $list){ ?>
												<li class="list">
													<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
												</li>
                                              <?php } ?>
											</ul>
										</div>
									</li>
								</ul>
							</div>
							<div class="newtuijian">
								<ul class="zoushimap">
									<li class="list lihead no_left">新手推荐：</li>
									<li class="list no_left">
										<a href="/11xuan5.html">玩法规则</a>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<div class="haomaqur">
						<div class="haomaqur_l">
							<div class="line linetit">距<span class="nextIssue"></span>期开奖仅有</div>
							<div class="line linetime" id="timebox">
								<div class="opening opentyle">开奖中...</div>
								<span class="bgtime hour">...</span>
								<span class="hourtxt">时</span>
								<span class="bgtime minute">...</span>
								<span>分</span>
								<span class="bgtime second">...</span>
								<span>秒</span>
							</div>
							<div class="line linetit height40">已开<span class="drawCount"></span>期，还有<span class="sdrawCount"></span>期</div>
							<div class="line soundId">
								<div class="soundline soundSet" id="soundSet">
								</div>
							</div>
						</div>
						<div class="line margt20 guangimg" id="startVideo">
							<img src="/themes/168pc/img/11x5_Img/11x5_syydj.jpg"/>
						</div>
					</div>
				</div>
			</div>
			<div class="kaijiangjl margt20">
				<div class="head">
					<ul class="zoushimap klsfindex_kjls" id="kaijiangjl">
						<li class="kaijiltit">开奖记录</li>
						<li id="jrsmtj">
							<a href="javascript:">今日双面/号码统计</a>
							<i></i>
						</li>
						<li id="cltx">
							<a href="javascript:"> 长龙提醒</a>
							<i></i>
						</li>
						<li id="hmfb">
							<a href="javascript:">号码分析</a>
							<i></i>
						</li>
						
					</ul>
					<div id="kjls">
						<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>116 , "limit"=>1));  if(is_array($listList)) foreach($listList as $list){ ?>
						<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
                        <?php } ?>
					</div>
				</div>
				<div class="listcontent">
					<div class="jrsmtj">
						<div class="headtxt">
							今日双面统计
						</div>
						<table cellpadding="1" cellspacing="1" border="0">
							<tr>
								<th width="176">号码</th>
								<th>1</th>
								<th>2</th>
								<th>3</th>
								<th>4</th>
								<th>5</th>
								<th>6</th>
								<th>7</th>
								<th>8</th>
								<th>9</th>
								<th>10</th>
								<th>11</th>
							</tr>
							<tr id="shuanmiandata">
								<td>出现次数</td>
								<td class="cs1">0</td>
								<td class="cs2">0</td>
								<td class="cs3">0</td>
								<td class="cs4">0</td>
								<td class="cs5">0</td>
								<td class="cs6">0</td>
								<td class="cs7">0</td>
								<td class="cs8">0</td>
								<td class="cs9">0</td>
								<td class="cs10">0</td>
								<td class="cs11">0</td>
							</tr>
						</table>
						<table class="secondtb" cellpadding="1" cellspacing="1" border="0">
							<tr>
								<th rowspan="2" width="176">球次</th>
								<th colspan="4">总和</th>
								<th colspan="4">第一球</th>
								<th colspan="4">第二球</th>
								<th colspan="4">第三球</th>
								<th colspan="4">第四球</th>
								<th colspan="4">第五球</th>
							</tr>
							<tr class="th_nostyle sub_tr">
								<th>单</th>
								<th>双</th>
								<th>大</th>
								<th>小</th>
								<th>单</th>
								<th>双</th>
								<th>大</th>
								<th>小</th>
								<th>单</th>
								<th>双</th>
								<th>大</th>
								<th>小</th>
								<th>单</th>
								<th>双</th>
								<th>大</th>
								<th>小</th>
								<th>单</th>
								<th>双</th>
								<th>大</th>
								<th>小</th>
								<th>单</th>
								<th>双</th>
								<th>大</th>
								<th>小</th>
							</tr>
							<tr id="gylhcs">
								<td>出现次数</td>
								<td class="tt1">0</td>
								<td class="tt2">0</td>
								<td class="tt3">0</td>
								<td class="tt4">0</td>
								<td class="one1">0</td>
								<td class="one2">0</td>
								<td class="one3">0</td>
								<td class="one4">0</td>
								<td class="two1">0</td>
								<td class="two2">0</td>
								<td class="two3">0</td>
								<td class="two4">0</td>
								<td class="three1">0</td>
								<td class="three2">0</td>
								<td class="three3">0</td>
								<td class="three4">0</td>
								<td class="four1">0</td>
								<td class="four2">0</td>
								<td class="four3">0</td>
								<td class="four4">0</td>
								<td class="five1">0</td>
								<td class="five2">0</td>
								<td class="five3">0</td>
								<td class="five4">0</td>
							</tr>
						</table>
					</div>
					<div class="cltx">
						<div class="headtxt">
							长龙连开提醒
						</div>
						<div class="cltxul">
							<ul id="cltxul">
							</ul>
						</div>
					</div>
					<div class="hmfb">
						<div class="head">
							<ul class="zoushimap" id="chakanchfb">
								<li class="kaijiltit">查看球号分布：</li>
								<li class="01">
									<a href="javascript:">号码1</a>
									<i></i>
								</li>
								<li class="02">
									<a href="javascript:">号码2</a>
									<i></i>
								</li>
								<li class="03">
									<a href="javascript:">号码3</a>
									<i></i>
								</li>
								<li class="04">
									<a href="javascript:">号码4</a>
									<i></i>
								</li>
								<li class="05">
									<a href="javascript:">号码5</a>
									<i></i>
								</li>
								<li class="06">
									<a href="javascript:">号码6</a>
									<i></i>
								</li>
								<li class="07">
									<a href="javascript:">号码7</a>
									<i></i>
								</li>
								<li class="08">
									<a href="javascript:">号码8</a>
									<i></i>
								</li>
								<li class="09">
									<a href="javascript:">号码9</a>
									<i></i>
								</li>
								<li class="10">
									<a href="javascript:">号码10</a>
									<i></i>
								</li>
								<li class="11">
									<a href="javascript:">号码11</a>
									<i></i>
								</li>
							</ul>
						</div>
						<div class="head head2">
							<ul class="zoushimap" id="daxiaodsfb">
								<li class="kaijiltit">大小单双分布：</li>
								<li id="dannum">
									<a href="javascript:">单</a>
									<i></i>
								</li>
								<li id="shuangnum">
									<a href="javascript:">双</a>
									<i></i>
								</li>
								<li id="danum">
									<a href="javascript:">大</a>
									<i></i>
								</li>
								<li id="xiaonum">
									<a href="javascript:">小</a>
									<i></i>
								</li>
								<li id="duizinum">
									<a href="javascript:">对子号</a>
									<i></i>
								</li>
								<li class="reset">
									还原
								</li>
							</ul>
						</div>
					</div>
					<div class="jrsmhmtj" id="jrsmhmtj">
						<table  id="jrsmhmtjTab" cellpadding="1" cellspacing="1" border="0">
						</table>

					</div>
				</div>
			</div>
<?php $__Template->display("themes/168pc/foot"); ?>


	</body>
	<script type="text/javascript" src="/themes/168pc/js/lib/config.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/GA.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/shiyix5_sd/index.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/shiyix5_sd/kaijiang.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/animate/animate.js"></script>
	<script src="/themes/168pc/js/lib/idangerous.swiper.min.js"></script>
	<div id="videobox">
		<div class="content">
			<div class="head">
				山东11选5开奖视频
				<div class="btn">
					<ul>
						<li class="closevideo"><i class="iconfont"></i></li>
						<li class="small">小屏</li>
						<li class="big">中屏</li>
					</ul>
				</div>
			</div>
			<div class="animate">
				<iframe style="height:100%;width:100%;border: none;" scrolling="no" src="/themes/168pc/js/lib/video/11x5_video/syydj_index.html"></iframe>
			</div>
		</div>
	</div>
</html>";s:12:"compile_time";i:1518871480;}";