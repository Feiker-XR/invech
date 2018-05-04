<?php exit;?>001549367740d5299c427704ff012418cd1566417e97s:653:"a:2:{s:8:"template";s:590:"<div class="news-r">
     <div class="ninfo">

<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>3));  if(is_array($listList)) foreach($listList as $list){ ?>

<div class="nlist">
     <div class="npic"><a href="<?php echo $list["curl"];?>" target="_blank"><img src="<?php echo $list["image"];?>" width="100" height="101" border="0"></a></div>
	 <div class="ntitle"><a href="<?php echo $list["curl"];?>" class="link1" target="_blank"><?php echo $list["name"];?></a></div>
</div>

<?php } ?>

	 </div>
</div>";s:12:"compile_time";i:1517831740;}";