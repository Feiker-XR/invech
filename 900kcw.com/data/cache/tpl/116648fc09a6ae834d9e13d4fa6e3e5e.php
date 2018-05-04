<?php exit;?>0015485068126b9001b31c91d054dd0f7d4c004c2454s:2956:"a:2:{s:8:"template";s:2892:"
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" /><meta name="format-detection" content="telephone=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
		<title><?php echo $categoryInfo["name"];?>-<?php echo $sys["site_title"];?></title>
        <link rel="stylesheet" href="/themes/168pc/css/style.css" />
        <link rel="stylesheet" href="/themes/168pc/css/headorfood.css" />
		<link rel="stylesheet" href="/themes/168pc/css/headorfood.css" />
		<link rel="stylesheet" href="/themes/168pc/css/zoushitb.css" />
		<link rel="stylesheet" href="/themes/168pc/css/user_adv.css" />
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/js/tests/vendor/jquery.min.js"></script>
		<script src="/themes/168pc/js/lib/bootstrap-3.3.0/dist/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/themes/168pc/js/lib/jquery-1.7.2.min.js"></script>
	</head>
	<body>
		<div class="bodybox">
<?php $__Template->display("themes/168pc/head"); ?>
			<div class="kaijiangjl margt20">
				
				<div class="listcontent">



<?php $channelList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList" , "class_id"=>'4,25,36,54,69,86,103,117,138,158,169,183,197,212,227,241,256,270,284,298,313,328,348,359,370,381,391,402,413,424,435,446,452,469,488,506' , "limit"=>500));  if(is_array($channelList)) foreach($channelList as $channel){ ?>
				<?php if ($channel['i']%2==0){ ?>
					<div class="row">
				<?php } ?>
						<div class="col-lg-6 col-md-6 col-sm-6 <?php if ($channel['i']%2){ ?>rowr<?php }else{ ?>rowl<?php } ?>">

							<div class="divl"><a href="<?php echo $channel["curl"];?>"><img src="<?php echo $channel["image"];?>" alt="" /></a></div>
							<div class="divr">
								<ul>
								<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$channel['class_id'], "limit"=>10));  if(is_array($listList)) foreach($listList as $list){ ?>
			                     <li><a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a></li>
                            	<?php } ?>									
							   </ul>
							</div>
						</div>
					<?php if ($channel['i']%2){ ?>
					</div>
					<?php } ?>
                  <?php } ?>
				</div>
			</div>



			<?php $__Template->display("themes/168pc/foot"); ?>

		<script>
			var bgSelect = setInterval(function(){
				$(".zstb_nav").addClass("li_checked").siblings().removeClass("li_checked");
				if($(".zstb_nav").length != 0){
					clearInterval(bgSelect);
				}
			},200)
		</script>
	</body>
	<script type="text/javascript" src="/themes/168pc/js/lib/config.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/lib/GA.js"></script>
	<script type="text/javascript" src="/themes/168pc/js/loacal/animate/animate.js"></script>
	
</html>";s:12:"compile_time";i:1516970812;}";