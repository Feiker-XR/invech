<?php exit;?>0015504119501227a4abdb509dcc53537bd00023c4f2s:3301:"a:2:{s:8:"template";s:3237:"
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" /><meta name="format-detection" content="telephone=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
		<title><?php echo $categoryInfo["name"];?>-<?php echo $sys["site_title"];?></title>
	    <meta name="keywords" content="<?php echo $categoryInfo["keywords"];?>" />
	    <meta name="distribution" content="<?php echo $categoryInfo["description"];?>" />
		<link rel="stylesheet" href="/themes/168pc/css/style.css" />
		<link rel="stylesheet" href="/themes/168pc/css/headorfood.css" />
		<link rel="stylesheet" href="/themes/168pc/css/guizejianjie.css" />
		<link rel="stylesheet" href="/themes/168pc/css/user_adv.css" />
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/js/tests/vendor/jquery.min.js"></script>
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/themes/168pc/js/lib/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/themes/168pc/js/lib/config.js"></script>
		<script type="text/javascript" src="/themes/168pc/js/lib/GA.js"></script>
		<script type="text/javascript" src="/themes/168pc/js/loacal/wanfaguize/wfgz_hf.js"></script>
	</head>

	<body>
		<div class="bodybox">
			<?php $__Template->display("themes/168pc/head"); ?>
			<!--商务合作-->
			<div class="guize">
				<div class="guize_intro"><?php echo $sys["site_subtitle"];?>&gt;
                <?php foreach ($crumb as $vo) { ?>
				 &gt;<?php echo $vo["name"];?>
				<?php } ?>
				</div>
				<div class="guize_menu about_usmenu">
					<ul>
						<li class="guize_head">
							<strong>关于我们</strong>
						</li>
					<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>534, "limit"=>20));  if(is_array($listList)) foreach($listList as $list){ ?>
					<?php if ($list['class_id']==$categoryInfo['class_id']){ ?>
					<li class="active"><a href="<?php echo $list["curl"];?>" title="<?php echo $list["name"];?>"><?php echo $list["name"];?></a></li>
					<?php }else{ ?>
					<li  class="hover" ><a href="<?php echo $list["curl"];?>" title="<?php echo $list["name"];?>"><?php echo $list["name"];?></a></li>
					<?php } ?>
					<?php } ?>

					</ul>
				</div>
				<!--规则详情-->
				<div class="guize_detail">
					<div class="container">
						<h1 style="margin-top:10px;margin-right:10px;margin-bottom:10px;margin-left:10px;text-indent:0;padding:0 0 0 0 ;text-align:center;line-height:35px;background:rgb(255,255,255)">
					    <strong><span style="letter-spacing: 0px; font-size: 18px;font-family: 微软雅黑;"></span></strong>
						</h1>
						<p style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;text-indent:0;padding:0 0 0 0 ;text-align:center;line-height:30px;background:rgb(255,255,255)">
							<strong><span style="letter-spacing: 0px; font-size: 18px;font-weight: 900;  font-family: 微软雅黑;"><?php echo $categoryInfo["name"];?></span></strong>
						</p>
						<?php echo $categoryInfo["content"];?>
					</div>
				</div>
			</div>
		<?php $__Template->display("themes/168pc/foot"); ?>
	</body>
</html>";s:12:"compile_time";i:1518875950;}";