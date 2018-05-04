<?php exit;?>0015493674409ee0c84042399b3b9d4b20eae0fddefds:6816:"a:2:{s:8:"template";s:6752:"<script type="text/javascript">var publicUrl = "<?php echo $sys["site_statistics"];?>/";</script>
<div class="headboxf">
	<div class="headboxh">

<div class="headboxh">
		<div class="headboxhc">
			<div class="headboxhr">
				<ul>
					<li class="logonli">
						<a href="#" onclick="SetHome(window.location)">设为首页</a>
					</li>
					
					<li class="logonli liline">|</li>
					<li class="logonli">
						<a href="#" onclick="javascript:addFavorite2()">收藏本站</a>
					</li>
				</ul>
			</div>
			<div class="headboxhl" >
				<div class="hoticon">
					最新公告：
				</div>
				<div class="hotcontent">
					<marquee direction="left" behavior="scroll" scrollamount="6" >
					<span class="textspace" >
					<?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"gg", "limit"=>1, "order"=>"data_id asc"));  if(is_array($listList)) foreach($listList as $list){ ?>
				<?php echo $list["gg"];?>
			 <?php } ?>
					
					</span>
					</marquee>
				</div>
			
			</div>
		</div>
	</div>

		<!-- <div class="headboxhc">
			<div class="headboxhl">
				<ul>
					<li class="logonli">
						<a href="#" onclick="SetHome(window.location)">设为首页</a>
					</li>
					
					<li class="logonli liline">|</li>
					<li class="logonli">
						<a href="#" onclick="javascript:addFavorite2()">收藏本站</a>
					</li>				
				</ul>
			</div>
			<div class="headboxhr">
				<ul>
					<li class="logonli">
						<a href="/" target="_blank">文字待定</a>
					</li>
					<li class="logonli liline"><img src="/img/back.png" alt="" /></li>
					<li class="logonli">
						<a href="">文字待定</a>
					</li>
				</ul>
			</div>
		</div> -->
		<div class="headbox">
			<div>
			 <?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"kefu", "limit"=>10));  if(is_array($listList)) foreach($listList as $list){ ?>
			<a  href="/"><img src="<?php echo $list["logo"];?>" /></a>
			<?php } ?>
			</div>

			<div class="advertisebox">
           <?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"sy", "limit"=>1, "order"=>"data_id asc"));  if(is_array($listList)) foreach($listList as $list){ ?>
			<a href="<?php echo $list["ljdz"];?>"><img src="<?php echo $list["tu"];?>" ></a>
           <?php } ?>
			<div>
					<a class="logobox guanggao1" target="_blank" href="javascript:void(0)">						
					</a>
				</div>
				
			</div>
			<div class="loginbox">
				<ul>
				<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "class_id"=>533 , "limit"=>1));  if(is_array($listList)) foreach($listList as $list){ ?>                      
					<li class="logonli jianyue">
                <a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
					</li>
					 <?php } ?>	

				</ul>
			</div>
		</div>
	</div>

</div>
<div class="menubannbox heightauto orangeBG">
	<div class="menubox">
		<div class="menuboxr">
			<ul>
				<li class="li_checked nav_li">
					<a href="/">首页</a>
				</li>
				<li class="cphost nav_li">
					<a href="javascript:void(0)">彩票大厅
						<img class="cphost_pic1" src="/themes/168pc/imgaes/cpdt_white.png" alt="" />
						<img class="cphost_pic2" src="/themes/168pc/imgaes/cpdt_red.png" alt="" />
					</a>
					<div class="cphost_content">
						<div class="content_middle">
							<div class="RMC">
								<div class="LineOne">
									<span class="RMC_span"><span>热门彩</span></span>
									<ul class="RMC_List">
										<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>3 , "limit"=>200));  if(is_array($listList)) foreach($listList as $list){ ?>
									<li><a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a></li>
									<?php } ?>
									
									</ul>
								</div>

							</div>
							<div class="GPC">
								<div class="LineOne">
									<span class="GPC_span"><span>高频彩</span></span>
									<ul>
										<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>168 , "limit"=>200));  if(is_array($listList)) foreach($listList as $list){ ?>
									<li><a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a></li>
									<?php } ?>
									
									</ul>
								</div>
							</div>
							<div class="JWC">
								<div class="LineOne">
									<span class="JWC_span"><span>境外彩</span></span>
									<ul>
										<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>450 , "limit"=>200));  if(is_array($listList)) foreach($listList as $list){ ?>
									<li><a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a></li>
									<?php } ?>
									</ul>
								</div>
							</div>
							<div class="QGC">
								<div class="LineOne">
									<span class="QGC_span"><span>全国彩</span></span>
									<ul>
										<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>512 , "limit"=>200));  if(is_array($listList)) foreach($listList as $list){ ?>
									<li><a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a></li>
									<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</li>
				 <?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "limit"=>15, "class_id"=>'528,529,530,531'));  if(is_array($listList)) foreach($listList as $list){ ?>
           <li> <a href="<?php echo $list["curl"];?>" <?php if ($list['class_id']==$topCategoryInfo['class_id']){ ?> class="li_checked nav_li" <?php } ?>  ><?php echo $list["name"];?></a></li>
        <?php } ?>
       <!--  <li><a href="/xgc">香港彩</a></li> -->
			</ul>

		</div>
	</div>
</div>

<script>
	$(function() {
		
		//彩票大厅
		$(".cphost").on("mouseover", function() {
			$(".cphost_pic1").hide();
			$(".cphost_pic2").show();
			$(".cphost_content").show();
		});
		$(".cphost").on("mouseout", function() {
			$(".cphost_pic1").show();
			$(".cphost_pic2").hide();
			$(".cphost_content").hide();
		});
		$(".menuboxr").find(".nav_li").on("click", function() {
			$(this).addClass("li_checked").siblings().removeClass("li_checked");
		})
		if($("#ifindex").val() == "index") {
			$(".mobiledetailnew").remove();
		};
	});
	
</script>";s:12:"compile_time";i:1517831440;}";