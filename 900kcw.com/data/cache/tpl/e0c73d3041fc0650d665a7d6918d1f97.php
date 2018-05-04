<?php exit;?>0015483019117803858b4ade9d28cf770bde1f8ac1e6s:3687:"a:2:{s:8:"template";s:3623:"<div class="footer1">
	<ul>
		<li class="lileft">
 <?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"kefu", "limit"=>10));  if(is_array($listList)) foreach($listList as $list){ ?>
			<img src="<?php echo $list["logo"];?>" />
			<?php } ?>
			<p>最专业的彩票开奖网站</p>
			<p>数据分析最全面的开奖数据平台 </p>
		</li>
		<li class="about_li">
			<div><span class="about"></span><span class="">关于我们</span></div>
			<p class="p1"></p>
		<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>534, "limit"=>20));  if(is_array($listList)) foreach($listList as $list){ ?>
			<p>
				<a href="<?php echo $list["curl"];?>"><?php echo $list["name"];?></a>
			</p>
			<?php } ?>
		</li>
		<li class="about_li">
			<div><span class="rewards"></span><span class="">中奖神器</span></div>
			<p class="p1">
				<a href="/beijingsaichePK10.html">开奖号码</a>
			</p>
			<p>
				<a href="/zoushitubiao.html">走势图表</a>
			</p>
			<p>
				<a href="/wanfaguize.html">玩法规则</a>
			</p>
		</li>
		<li class="about_li">
			<div><span class="call"></span><span class="">免费调用</span></div>
			<p class="p1">
				<a href="/" target="_blank">自助网址导航</a>
			</p>
			<p>
				<a href="/" target="_blank">开奖调用</a>
			</p>
		</li>
		<li>			
		</li>
	</ul>
</div>
<div class="footer3">
	<div class="footer3c">
		Copyright <span id="localyears"></span>All rights reserved  <?php echo $sys["site_subtitle"];?> 版权所有 <?php echo $sys["site_copyright"];?>
		<script type="text/javascript">
			$("#localyears").text(new Date().getFullYear());
		</script>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="/themes/168pc/css/densigner_contest.css">
<div class="c_meau">
  <div class="fl">
 <?php $listList = service("duxcms","Label","formList",array( "app"=>"DuxCms", "label"=>"formList", "table"=>"kefu", "limit"=>10));  if(is_array($listList)) foreach($listList as $list){ ?>
    <h4>关注&amp;咨询<br>
     <?php echo $list["mc"];?></h4>
    <div class="fl_o">
      <dl class="fl_o_o">
        <dt> <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $list["qq"];?>&site=qq&menu=yes" target="_blank"> <img src="/themes/168pc/images/c_meau_1.png"></a></dt>
        <dd>QQ咨询</dd>
      </dl>
      <dl class="fl_o_o">
        <dt><img src="<?php echo $list["ewm"];?>" style="width:92px;height:92px;" ></dt>
        <dd>扫一扫有惊喜</dd>
      </dl>
      <dl class="fl_o_o">
        <dt><a href="<?php echo $list["dz"];?>" target="_blank"><img src="/themes/168pc/images/c_meau_7.gif"></a></dt>
        <dd>试玩投注</dd>
      </dl>
    </div>
    <img src="/themes/168pc/images/c_meau_7.png"> </div>
  <div class="fr">
    <div class="fr_o"><img src="/themes/168pc/images/c_meau_5.png"></div>
    <div class="fr_t"><img src="/themes/168pc/images/c_meau_6.png"></div>
  </div>
   <?php } ?>
  <div class="clear"></div>
</div>
<script type="text/javascript">
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $(".c_meau").stop().show().animate({ bottom: '100px' }, 300);
        }
        else {
            $(".c_meau").stop().animate({ bottom: '-430px' }, 300);
        }
    });
    $('.c_meau .fr_t').click(function () {
        $('body,html').animate({ scrollTop: 0 }, 500);
        $(".c_meau").animate({ bottom: '-380px', opacity: '0' }, 500);
        return false;
    });
</script>
";s:12:"compile_time";i:1516765911;}";