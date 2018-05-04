<?php exit;?>001548301911f6dae6a9c24d9f269898a0d2d5f1366bs:32196:"a:2:{s:8:"template";s:32131:"<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="format-detection" content="telephone=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
		<title><?php echo $sys["site_title"];?> - <?php echo $sys["site_subtitle"];?></title>
		<meta name="keywords" content="<?php echo $sys["site_keywords"];?>" />
		<meta name="distribution" content="<?php echo $sys["site_description"];?>" />
		<link rel="stylesheet" href="/themes/168pc/css/headorfood.css" />
		<link rel="stylesheet" href="/themes/168pc/css/home1.css" />
		<link rel="stylesheet" href="/themes/168pc/css/user_adv.css" />
		<link rel="stylesheet" href="/themes/168pc/css/idangerous.swiper.css" />
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/js/tests/vendor/jquery.min.js"></script>
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/dist/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="bodybox">
			<?php $__Template->display("themes/168pc/head"); ?>
			<div class="bgdiv">
			<div class="menubannbox">
					<div class="menubox">
						<div class="zhezao">
							<div class="zhezao_content">						
							<div class="kair">

                              <div class="announce_top">
									<div  class="home_littleimg">
<?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"lb", "limit"=>3, "order"=>"data_id asc"));  if(is_array($listList)) foreach($listList as $list){ ?>
			<a class="banner_img" href="<?php echo $list["ljdz"];?>" target="_blank"><img src="<?php echo $list["tu"];?>"/></a>
		<?php } ?>
								<div class="subscript">
											<span class="sub_i">1</span>
											<span class="sub_i">2</span>
											<span class="sub_i">3</span>
										</div>
									</div>

									<div class="announce_middle">
										<h1><span class="newAnn">新闻资讯</span><span class="more"><a href="caipiaozixun/index.html">更多</a></span></h1>
										<div class="margin_top">
                                      <?php $listList = service("duxcms","Label","contentList",array( "app"=>"DuxCms", "label"=>"contentList", "class_id"=>528, "sub"=>true, "limit"=>5));  if(is_array($listList)) foreach($listList as $list){ ?>

								<p><a href="<?php echo $list["aurl"];?>"><?php echo $list["title"];?></a><span><?php echo date('Y-m-d',$list["time"]); ?></span></p>
							           <?php } ?>
										</div>
									</div>
								</div>
								<ul class="announce_down">
               <?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>3, "limit"=>8));  if(is_array($listList)) foreach($listList as $list){ ?>
									<li class="first_li">
									<a target="_blank" href="<?php echo $list["curl"];?>"><img src="<?php echo $list["image"];?>" style="width:52px;height:52px;"  alt="" /></a><a target="_blank" href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>

									</li>
								<?php } ?>	
									
								</ul>
							</div>
							<div class="kair_right">
                         <?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"ybad", "limit"=>1, "order"=>"data_id asc"));  if(is_array($listList)) foreach($listList as $list){ ?>
							<a href="<?php echo $list["ljdz"];?>" target="_blank"><img src="<?php echo $list["tu"];?>" alt="" /></a>
                         <?php } ?>
							</div>
							</div>
							</div>
					</div>
				</div>
			</div>

			<div class="contentbox">
				<div class="contentc">
					
					<!--动画区-->
					<div class="contentcb">
						<div class="" style="overflow: hidden; height: auto;min-height: 1406px;">
							<div class="cztypel">
								<ul>
<?php $channelList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>3 , "limit"=>1));  if(is_array($channelList)) foreach($channelList as $channel){ ?>
									<li class="cztypell" id="pk10">
										<div class="cztypelt">
											<div class="rowbox1">
												<input type="hidden" id="ifindex" value="index" />
												<div class="imgheadl">
													<a href="<?php echo $channel["curl"];?>"><img src="/themes/168pc/img/beijinpk.png" /></a>
												</div>
												<div class="inforr">
													<h1><?php echo $channel["name"];?>第<span style="display: inline-block;"  class="preDrawIssue"></span>期开奖</h1>
													<p>每5分钟一期，全天179期</p>
													</br>
													<span class="nextIssue displaynone"></span>
													<p>当前<span class="drawCount"></span>期，剩余<span class="sdrawCountnext"></span>期</p>
													<p class="opentyle">开奖中...</p>
													<div class="line linetime cuttime indextime" id="timebox">
														<span class="bgtime hour">...</span>
														<span class="hourtxt">时</span>
														<span class="bgtime minute">...</span>
														<span>分</span>
														<span class="bgtime second">...</span>
														<span>秒</span>
													</div>
												</div>
											</div>
											<div class="rowbox2">
												<ul id="jnumber" class="numberbox">
													<li class="nub01"></li>
													<li class="nub02"></li>
													<li class="nub03"></li>
													<li class="nub04"></li>
													<li class="nub05"></li>
													<li class="nub06"></li>
													<li class="nub07"></li>
													<li class="nub08"></li>
													<li class="nub09"></li>
													<li class="nub10 li_after"></li>
												</ul>
											</div>
											<div class="rowbox3" id="rowbox3">
												<table border="0" cellpadding="1" cellspacing="1">
													<tr>
														<th colspan="5">1-5龙虎</th>
														<th colspan="3">冠亚和</th>
													</tr>
													<tr class="longhu">
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="sumFS">&nbsp;</td>
														<td class="sumBigSamll">&nbsp;</td>
														<td class="sumSingleDouble">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="cztypelb">
											<table border="0" cellpadding="1" cellspacing="1">
												<tr>
											  <?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$channel['class_id'], "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
													<td>
														<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
													</td>
													      <?php } ?>

												</tr>
											</table>
										</div>
									</li>
                                  <?php } ?>

                         <?php $cqList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>36 , "limit"=>1));  if(is_array($cqList)) foreach($cqList as $cq){ ?>
									<li class="cztypell" id="cqSsc">
										<div class="cztypelt">
											<div class="rowbox1">
												<div class="imgheadl">
													<a href="<?php echo $cq["curl"];?>"><img src="/themes/168pc/img/small_logo/chognqingssc.png" /></a>
												</div>
												<div class="inforr">
													<span class="nextIssue displaynone"></span>
													<h1><?php echo $cq["name"];?>第<span class="preDrawIssue"></span>期开奖</h1>
													<p>10:00-22:00，十分钟一期</p>
													<p>22:00-02:00，五分钟一期，全天120期</p>
													<p>当前<span class="drawCount"></span>期，剩余<span class="sdrawCountnext"></span>期</p>
													<p class="opentyle">开奖中...</p>
													<div class="line linetime cuttime indextime">
														<span class="bgtime hour">...</span>
														<span class="hourtxt">时</span>
														<span class="bgtime minute">...</span>
														<span>分</span>
														<span class="bgtime second">...</span>
														<span>秒</span>
													</div>
												</div>
											</div>
											<div class="rowbox2">
												<ul class="kajianhao">
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
												</ul>
											</div>
											<div class="rowbox3">
												<table border="0" cellpadding="1" cellspacing="1">
													<tr>
														<th width="40" colspan="3">总和</th>
														<th>龙虎</th>
														<th>前三</th>
														<th>中三</th>
														<th>后三</th>
													</tr>
													<tr class="longhu2">
														<td class="sumNum">&nbsp;&nbsp;</td>
														<td class="sumSingleDouble">&nbsp;&nbsp;</td>
														<td class="sumBigSmall">&nbsp;&nbsp;</td>
														<td class="dragonTiger">&nbsp;&nbsp;</td>
														<td class="behindThree">&nbsp;&nbsp;</td>
														<td class="betweenThree">&nbsp;&nbsp;</td>
														<td class="lastThree">&nbsp;&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="cztypelb">
											<table border="0" cellpadding="1" cellspacing="1">
												<tr>
												<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$cq['class_id'], "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
													<td>
														<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
													</td>
												 <?php } ?>													
												</tr>
											</table>
										</div>
									</li>
									<?php } ?>
									<!--
                                    	
                                    	时间：2016-11-28
                                    	描述：10003 天津时时彩
                                    -->
                        <?php $tjList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>69 , "limit"=>1));  if(is_array($tjList)) foreach($tjList as $tj){ ?>
									<li class="cztypell" id="tjSsc">
										<div class="cztypelt">
											<div class="rowbox1">
												<div class="imgheadl">
													<a href="<?php echo $tj["curl"];?>"><img src="/themes/168pc/img/small_logo/tianjinssc.png" /></a>
												</div>
												<div class="inforr">
													<span class="nextIssue displaynone"></span>
													<h1><?php echo $tj["name"];?>第<span class="preDrawIssue"></span>期开奖</h1>
													<p>十分钟一期</p>
													<p>全天84期</p><br />
													<p>当前<span class="drawCount"></span>期，剩余<span class="sdrawCountnext"></span>期</p>
													<p class="opentyle">开奖中...</p>
													<div class="line linetime cuttime indextime">
														<span class="bgtime hour">...</span>
														<span class="hourtxt">时</span>
														<span class="bgtime minute">...</span>
														<span>分</span>
														<span class="bgtime second">...</span>
														<span>秒</span>
													</div>
												</div>
											</div>
											<div class="rowbox2">
												<ul class="kajianhao">
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
												</ul>
											</div>
											<div class="rowbox3">
												<table border="0" cellpadding="1" cellspacing="1">
													<tr>
														<th width="40" colspan="3">总和</th>
														<th>龙虎</th>
														<th>前三</th>
														<th>中三</th>
														<th>后三</th>
													</tr>
													<tr class="longhu2">
														<td class="sumNum">&nbsp;&nbsp;</td>
														<td class="sumSingleDouble">&nbsp;&nbsp;</td>
														<td class="sumBigSmall">&nbsp;&nbsp;</td>
														<td class="dragonTiger">&nbsp;&nbsp;</td>
														<td class="behindThree">&nbsp;&nbsp;</td>
														<td class="betweenThree">&nbsp;&nbsp;</td>
														<td class="lastThree">&nbsp;&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="cztypelb">
											<table border="0" cellpadding="1" cellspacing="1">
												<tr>
													<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$tj['class_id'], "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
													<td>
														<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
													</td>
												 <?php } ?>	
												</tr>
											</table>
										</div>
									</li>
								<?php } ?>
                        <?php $xjList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>86 , "limit"=>1));  if(is_array($xjList)) foreach($xjList as $xj){ ?>
									<li class="cztypell" id="xjSsc">
										<div class="cztypelt">
											<div class="rowbox1">
												<div class="imgheadl">
													<a href="<?php echo $xj["curl"];?>"><img src="/themes/168pc/img/small_logo/xinjinagssc.png" /></a>
												</div>
												<div class="inforr">
													<span class="nextIssue displaynone"></span>
													<h1><?php echo $xj["name"];?>第<span class="preDrawIssue"></span>期开奖</h1>
													<p>十分钟一期</p>
													<p>全天96期</p><br />
													<p>当前<span class="drawCount"></span>期，剩余<span class="sdrawCountnext"></span>期</p>
													<p class="opentyle">开奖中...</p>
													<div class="line linetime cuttime indextime">
														<span class="bgtime hour">...</span>
														<span class="hourtxt">时</span>
														<span class="bgtime minute">...</span>
														<span>分</span>
														<span class="bgtime second">...</span>
														<span>秒</span>
													</div>
												</div>
											</div>
											<div class="rowbox2">
												<ul class="kajianhao">
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
												</ul>
											</div>
											<div class="rowbox3">
												<table border="0" cellpadding="1" cellspacing="1">
													<tr>
														<th width="40" colspan="3">总和</th>
														<th>龙虎</th>
														<th>前三</th>
														<th>中三</th>
														<th>后三</th>
													</tr>
													<tr class="longhu2">
														<td class="sumNum">&nbsp;</td>
														<td class="sumSingleDouble">&nbsp;</td>
														<td class="sumBigSmall">&nbsp;</td>
														<td class="dragonTiger">&nbsp;</td>
														<td class="behindThree">&nbsp;</td>
														<td class="betweenThree">&nbsp;</td>
														<td class="lastThree">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="cztypelb">
											<table border="0" cellpadding="1" cellspacing="1">
												<tr>
													<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$xj['class_id'], "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
													<td>
														<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
													</td>
												 <?php } ?>	
												</tr>
											</table>
										</div>
									</li>
									<?php } ?>
									<!--
                                    	
                                    	时间：2016-11-28
                                    	描述：广东快乐十分
                                    -->
                                    <?php $gdList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>117 , "limit"=>1));  if(is_array($gdList)) foreach($gdList as $gd){ ?>
									<li class="cztypell" id="gdklsf">
										<div class="cztypelt">
											<div class="rowbox1">
												<div class="imgheadl">
													<a href="<?php echo $gd["curl"];?>"><img src="/themes/168pc/img/small_logo/guangdongklsf.png" /></a>
												</div>
												<div class="inforr">
													<span class="nextIssue displaynone"></span>
													<h1><?php echo $gd["name"];?>第<span class="preDrawIssue"></span>期开奖</h1>
													<p>每10分钟一期,全天84期</p><br/>
													<p>当前<span class="drawCount"></span>期，剩余<span class="sdrawCountnext"></span>期</p>
													<p class="opentyle">开奖中...</p>
													<div class="line linetime cuttime indextime">
														<span class="bgtime hour">...</span>
														<span class="hourtxt">时</span>
														<span class="bgtime minute">...</span>
														<span>分</span>
														<span class="bgtime second">...</span>
														<span>秒</span>
													</div>
												</div>
											</div>
											<div class="rowbox2">
												<ul class="kajianhao">
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
												</ul>
											</div>
											<div class="rowbox3">
												<table border="0" cellpadding="1" cellspacing="1">
													<tr>
														<th width="40" colspan="4">总和</th>
														<th colspan="4">1-4龙虎</th>
													</tr>
													<tr class="longhu2">
														<td class="sumNum">&nbsp;</td>
														<td class="sumSingleDouble">&nbsp;</td>
														<td class="sumBigSmall">&nbsp;</td>
														<td class="lastBigSmall">&nbsp;</td>

														<td class="firstDragonTiger">&nbsp;</td>
														<td class="secondDragonTiger">&nbsp;</td>
														<td class="thirdDragonTiger">&nbsp;</td>
														<td class="fourthDragonTiger">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="cztypelb">
											<table border="0" cellpadding="1" cellspacing="1">
												<tr>
													<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$gd['class_id'], "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
													<td>
														<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
													</td>
												 <?php } ?>	
												</tr>
											</table>
										</div>
									</li>
                                     <?php } ?>
                                     <?php $syList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>103 , "limit"=>1));  if(is_array($syList)) foreach($syList as $sy){ ?>
									<li class="cztypell" id="shiyix5_sd">
										<div class="cztypelt">
											<div class="rowbox1">
												<div class="imgheadl">
												<a href="<?php echo $sy["curl"];?>"><img src="/themes/168pc/img/small_logo/shandong11x5.png" /></a>
												</div>
												<div class="inforr">
													<span class="nextIssue displaynone"></span>
													<h1><?php echo $sy["name"];?>第<span class="preDrawIssue"></span>期开奖</h1>
													<p>每10分钟一期,全天78期</p><br/>
													<p>当前<span class="drawCount"></span>期，剩余<span class="sdrawCountnext"></span>期</p>
													<p class="opentyle">开奖中...</p>
													<div class="line linetime cuttime indextime">
														<span class="bgtime hour">...</span>
														<span class="hourtxt">时</span>
														<span class="bgtime minute">...</span>
														<span>分</span>
														<span class="bgtime second">...</span>
														<span>秒</span>
													</div>
												</div>
											</div>
											<div class="rowbox2">
												<ul class="kajianhao">
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
												</ul>
											</div>
											<div class="rowbox3">
												<table border="0" cellpadding="1" cellspacing="1">
													<tr>
														<th width="40" colspan="3">总和</th>
														<th>前三</th>
														<th>中三</th>
														<th>后三</th>
													</tr>
													<tr class="longhu2">
														<td class="sumNum">&nbsp;</td>
														<td class="sumBigSmall">&nbsp;</td>
														<td class="sumSingleDouble">&nbsp;</td>
														<td class="behindThree">&nbsp;</td>
														<td class="betweenThree">&nbsp;</td>
														<td class="lastThree">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="cztypelb">
											<table border="0" cellpadding="1" cellspacing="1">
												<tr>
													<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$sy['class_id'], "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
													<td>
														<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
													</td>
												 <?php } ?>	
												</tr>
											</table>
										</div>
									</li>
									<?php } ?>
									  <?php $syxwList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>169 , "limit"=>1));  if(is_array($syxwList)) foreach($syxwList as $syxw){ ?>
									<li class="cztypell" id="shiyix5_gd">
										<div class="cztypelt">
											<div class="rowbox1">
												<div class="imgheadl">
													<a href="<?php echo $syxw["curl"];?>"><img src="/themes/168pc/img/small_logo/gaungdong11x5.png" /></a>
												</div>
												<div class="inforr">
													<span class="nextIssue displaynone"></span>
													<h1><?php echo $syxw["name"];?>第<span class="preDrawIssue"></span>期开奖</h1>
													<p>每10分钟一期,全天84期</p><br/>
													<p>当前<span class="drawCount"></span>期，剩余<span class="sdrawCountnext"></span>期</p>
													<p class="opentyle">开奖中...</p>
													<div class="line linetime cuttime indextime">
														<span class="bgtime hour">...</span>
														<span class="hourtxt">时</span>
														<span class="bgtime minute">...</span>
														<span>分</span>
														<span class="bgtime second">...</span>
														<span>秒</span>
													</div>
												</div>
											</div>
											<div class="rowbox2">
												<ul class="kajianhao">
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
													<li class="numblueHead"></li>
												</ul>
											</div>
											<div class="rowbox3">
												<table border="0" cellpadding="1" cellspacing="1">
													<tr>
														<th width="40" colspan="3">总和</th>
														<th>前三</th>
														<th>中三</th>
														<th>后三</th>
													</tr>
													<tr class="longhu2">
														<td class="sumNum">&nbsp;</td>
														<td class="sumBigSmall">&nbsp;</td>
														<td class="sumSingleDouble">&nbsp;</td>

														<td class="behindThree">&nbsp;</td>
														<td class="betweenThree">&nbsp;</td>
														<td class="lastThree">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="cztypelb">
											<table border="0" cellpadding="1" cellspacing="1">
												<tr>
												<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$syxw['class_id'], "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
													<td>
														<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
													</td>
												 <?php } ?>	
												</tr>
											</table>
										</div>
									</li>
									<?php } ?>
									<?php $ksList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>348 , "limit"=>1));  if(is_array($ksList)) foreach($ksList as $ks){ ?>
									<li class="cztypell" id="kuai3">
										<div class="cztypelt">
											<div class="rowbox1">
												<div class="imgheadl">
													<a href="<?php echo $ks["curl"];?>"><img src="/themes/168pc/img/small_logo/jskuai3.png" /></a>
												</div>
												<div class="inforr">
													<span class="nextIssue displaynone"></span>
													<h1><?php echo $ks["name"];?>第<span class="preDrawIssue"></span>期开奖</h1>
													<p>每10分钟一期，全天82期</p><br/>
													<p>当前<span class="drawCount"></span>期，剩余<span class="sdrawCount"></span>期</p>
													<p class="opentyle">开奖中...</p>
													<div class="line linetime cuttime indextime">
														<span class="bgtime hour">...</span>
														<span class="hourtxt">时</span>
														<span class="bgtime minute">...</span>
														<span>分</span>
														<span class="bgtime second">...</span>
														<span>秒</span>
													</div>
												</div>
											</div>
											<div class="rowbox2">
												<ul class="kajianhao">
													<li class="num1"></li>
													<li class="num2"></li>
													<li class="num4"></li>
												</ul>
											</div>
											<div class="rowbox3">
												<table border="0" cellpadding="1" cellspacing="1">
													<tr>
														<th colspan="3">总和</th>
														<th colspan="3">鱼虾蟹</th>
													</tr>
													<tr>
														<td class="sumNum">&nbsp;</td>
														<td class="sumSingleDouble">&nbsp;</td>
														<td class="sumBigSmall">&nbsp;</td>
														<td class="firstSeafood">&nbsp;</td>
														<td class="secondSeafood">&nbsp;</td>
														<td class="thirdSeafood">&nbsp;</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="cztypelb">
											<table border="0" cellpadding="1" cellspacing="1">
												<tr>
													<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$ks['class_id'], "limit"=>4));  if(is_array($listList)) foreach($listList as $list){ ?>
													<td>
														<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
													</td>
												 <?php } ?>	
												</tr>
											</table>
										</div>
									</li>
									<?php } ?>
								</ul>
							</div>

						<div class="otherr">					
								<div class="program">
									<dl>
										<dt>
										热点资讯
									</dt>
										<dd>
											<a href="/caipiaozixun/index.html">更多</a>
										</dd>
									</dl>
								</div>
								<div class="newslist">
									<ul>
									<?php $listList = service("duxcms","Label","contentList",array( "app"=>"DuxCms", "label"=>"contentList", "class_id"=>528 , "order"=>"views desc", "limit"=>10));  if(is_array($listList)) foreach($listList as $list){ ?>				         
										<li><a href="<?php echo $list["aurl"];?>"><?php echo $list["title"];?></a></li>
										 <?php } ?>
									</ul>
								</div>
								<div class="adviertisement">
                         <?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"ybadzj", "limit"=>1, "order"=>"data_id asc"));  if(is_array($listList)) foreach($listList as $list){ ?>
							<a href="<?php echo $list["ljdz"];?>" target="_blank"><img src="<?php echo $list["tu"];?>" alt="" /></a>
                         <?php } ?>
							</div>
								<div class="tools">
									<div class="toolhead">
										<dl>
											<dt>
											分析工具
										</dt>
										</dl>
									</div>
									<div class="toolsbox">
<?php $channelList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList" , "class_id"=>'4,36,69,166' , "limit"=>500));  if(is_array($channelList)) foreach($channelList as $channel){ ?>
										<div class="toolslist">
											<div class="listhead">
												<div class="toolsr1">
													<div class="tooll">
														<img src="<?php echo $channel["image"];?>" style="width:46px;height:46px;" />
													</div>
													<div class="toolr">
														<?php echo $channel["name"];?>
													</div>
												</div>
												<div class="toolsr2">
													<dl>
														<dt class="toolicon1"><i></i>走势</dt>
														<dd>
															<a href="<?php echo $channel["curl"];?>">更多</a>
														</dd>
													</dl>
												</div>
												<div class="toolsr3">
													<ul>
										<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$channel['class_id'], "limit"=>3));  if(is_array($listList)) foreach($listList as $list){ ?>
			                     <li><a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a></li>
                            	                   <?php } ?>
													</ul>
												</div>
												
											</div>
										</div>

                                <?php } ?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php $__Template->display("themes/168pc/foot"); ?>			
	</div>
	</body>
	<script type="text/javascript" src="/themes/168pc/js/lib/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/jquery.SuperSlide.2.1.1.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/config.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/GA.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/pk10/pk10_index.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/animate/animate.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/index.js"></script>
	<script src="/themes/168pc/js/lib/idangerous.swiper.min.js"></script>
	<script src="/themes/168pc/js/lb.js"></script>
	<script>
	</script>


</html>";s:12:"compile_time";i:1516765911;}";