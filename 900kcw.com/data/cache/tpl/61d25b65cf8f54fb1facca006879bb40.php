<?php exit;?>00155038887701d7182de22f2ddef5a2b7d23efccfcas:2894:"a:2:{s:8:"template";s:2830:"	<div class="haomabox">
				<div class="waring" id="waringbox">
					<div class="flash"><i></i></div>
					温馨提示：因网络问题，开奖结果会有延迟，所以您需要去喝杯咖啡等一会儿！
				</div>
				<div class="haomaqu">
					<div class="haomaqubox" id="<?php echo $parentCategoryInfo["cpid"];?>">
						<div class="haomaqul">
							<div class="haomaline">
								<div class="haomaimg">
									<a href="<?php echo $parentCategoryInfo["urlname"];?>.html"><img src="<?php echo $parentCategoryInfo["image"];?>" /></a>
								</div>
								<div class="numberqu">
									<div class="nuberqutit">
										<div class="divl">
											<a href="<?php echo $parentCategoryInfo["urlname"];?>.html"><span class="pk10tit"><?php echo $parentCategoryInfo["name"];?></span></a>第<span class="redfont preDrawIssue"></span>期&nbsp;开奖
										</div>
										<div class="divr">
											全天<span class="totalCount">...</span>期，当前<span class="drawCount">...</span>期,剩<span class="sdrawCount">...</span>期
										</div>
									</div>
									<div class="kajianhao">
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
<?php $listList = service("duxcms","Label","categoryList",array( "app"=>"DuxCms", "label"=>"categoryList", "parent_id"=>$parentCategoryInfo['class_id'], "limit"=>20));  if(is_array($listList)) foreach($listList as $list){ ?>
  <?php if ($list['class_id']==$categoryInfo['class_id']){ ?>
    <li class="checked"><a href="<?php echo $list["curl"];?>" title="<?php echo $list["name"];?>"><?php echo $list["name"];?></a></li>
  <?php }else{ ?>
  
    <li><a href="<?php echo $list["curl"];?>" title="<?php echo $list["name"];?>">
					<span class="n"><?php echo $list["name"];?></span></a></li>
  <?php } ?>
<?php } ?>
						</ul>
					</div>
				</div>
			</div>";s:12:"compile_time";i:1518852877;}";