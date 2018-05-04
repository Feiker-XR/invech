<?php exit;?>001549606074f4fbb3c9630637c81fa64aa7602a5caas:1935:"a:2:{s:8:"template";s:1871:"<script type="text/javascript">var publicUrl = "<?php echo $sys["site_statistics"];?>/";</script>

<div id="" class="indexContainer withHeader">
<header id="indexHeader">
	<div class="top_menu_bar">
		<div class="top_menu_left">
 <?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"kefu", "limit"=>10));  if(is_array($listList)) foreach($listList as $list){ ?>
			<a href="/"><img src="<?php echo $list["sjlogo"];?>" alt=""></a>
						<?php } ?>

		</div>
		<div class="top_menu_middle" id="caizhong_name">
			<span id="titlespan"><?php echo $categoryInfo["name"];?><i></i></span>
		</div>
		<div class="top_menu_more">
			<span class="more_btn">
			<span id="showtime">01月15日</span>
			<input type="hidden" id="yearmothnday" value="2018">
			<input type="text" id="beginTime" class="">
			</span>
		</div>
	</div>
</header>
<script>
	$(function() {
		$("#cZList").on("click","li",function(){
			tools.openAllCz(false); //关闭所有彩种列表
		});
		$("#indexHeader").on("touchstart", "#caizhong_name", function() {
			tools.openAllCz(true); //打开所有彩种列表
		});
		//所有彩种
		$("#cZList .backbtn").on("touchstart", "span", function() {
			tools.openAllCz(false); //关闭所有彩种列表
		});
		/*$("#indexHeader .top_menu_left").on("touchstart", "img", function() {
			window.location.href="../../index.html";
		});*/
	});
</script></header>
				<!--<header id="indexHeader">
					<div class="top_menu_bar">
						<div class="top_menu_more">
							<div class="list_shadow"></div>
							<span class="more_btn">
								<span id="showtime"></span>
							<input type="hidden" id="yearmothnday" />
							<input type="text" id="beginTime" class="" />
							</span>
						</div>
						<div id="top_menu" class="top_menu_list flexl">
						</div>
					</div>
				</header>-->
			</div>";s:12:"compile_time";i:1518070074;}";