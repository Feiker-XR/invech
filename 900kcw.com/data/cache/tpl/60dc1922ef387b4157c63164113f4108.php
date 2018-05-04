<?php exit;?>0015487383767b5e14281721cf0cbb00362401a8f4das:5248:"a:2:{s:8:"template";s:5184:"
<!DOCTYPE html>
<html>
<script type="text/javascript">var publicUrl = "<?php echo $sys["site_statistics"];?>/";</script>

	<head>
		<meta charset="utf-8" />
		<meta name="format-detection" content="telephone=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
		<title><?php echo $categoryInfo["name"];?><?php echo $sys["site_title"];?> - <?php echo $sys["site_subtitle"];?></title>
		<meta name="keywords" content="<?php echo $sys["site_keywords"];?>" />
		<meta name="distribution" content="<?php echo $sys["site_description"];?>" />
		<link rel="stylesheet" href="/themes/168pc/css/style.css" />
		<link rel="stylesheet" href="/themes/168pc/css/headorfood.css" />
		<link rel="stylesheet" href="/themes/168pc/css/changltx_index.css" />
		<script type="text/javascript" src="/themes/168pc/js/lib/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="/themes/168pc/js/lib/config.js"></script>
		<script type="text/javascript" src="/themes/168pc/js/lib/GA.js"></script>
		<script type="text/javascript" src="/themes/168pc/js/loacal/changltx/index.js"></script>
		
	</head>

	<body>
		<div class="bodybox">
<?php $__Template->display("themes/168pc/head"); ?>

			<!--关于我们-->
			<div class="changltx">
				<div class="contain">
					<div class="contain_top">
						<div class="head">
							<span>长龙提醒</span>
						</div>
						<div class="footerDiv">
							<div class="right">
								<div>
									<span class="select">选择彩种</span>
									<span id="checkAll" class="all">全选</span>
									<span id="cancelAll" class="cancel">取消</span>
								</div>
								<ul id="czList">
									<li id="10001" class="czListBg">北京PK10</li>
									<li id="10002" class="czListBg">重庆时时彩</li>
									<li id="10005">广东快乐十分</li>
									<li id="10009">重庆幸运农场</li>
									<li id="10004">新疆时时彩</li>
									<li id="10003">天津时时彩</li>
									<li id="10014">北京快乐8</li>
									<li id="10041">福彩3D</li>
									<li id="10043">排列3D</li>
									<li id="10026">广西快3</li>
									<li id="10038">广西快乐十分</li>
									<li id="10008">十一运夺金</li>
									<li id="10006">广东十一选五</li>
									<li id="10014">北京快乐八</li>
									<li id="10041">福彩3D</li>
									<li id="10043">体彩排列3</li>
									<li id="10026">广西快三</li>
								</ul>
							</div>
							<div class="left">
								<div class="left_head">
									<ul id="display">
										<li id="kaiLi" class="liactiveBG">连续开出</li>
										<li id="nokaiLi">连续未开</li>
									</ul>
									<div class="l_left">
										只显示
										<select id="selectNum">
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
										</select>
										期及以上的长龙
										<span id="soundsCtrl"><i></i>声音报警</span>
									</div>
								</div>
								<div id="kaiDetial">
									<table id="kaiYes" width="100%" border="0" cellspacing="1" cellpadding="1">
										<thead>
											<tr>
												<th height="50px" width="222px">彩种</th>
												<th height="50px">位置</th>
												<th height="50px"  width='120px'>连续开出期数</th>
												<th height="50px" width='50px'>路珠</th>
												<th height="50px" width='100px'>长龙统计</th>
											</tr>											
										</thead>
										<tbody>
										</tbody>
									</table>
									<table id="kaiYes6" width="100%" border="0" cellspacing="1" cellpadding="1">
										<tbody>
										</tbody>
									</table>
									<table id="kaiNo" width="100%" border="0" cellspacing="1" cellpadding="1" style="display:none">
										<thead>
											<tr>
												<th height="50px" width="222px">彩种</th>
												<th height="50px">位置</th>
												<th height="50px"  width='120px'>连续未开出期数</th>
												<th height="50px" width='50px'>路珠</th>
												<th height="50px" width='100px'>长龙统计</th>
											</tr>											
										</thead>
										<tbody>
												
										</tbody>
									</table>
									<table id="kaiNo6" width="100%" border="0" cellspacing="1" cellpadding="1">
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<audio src="media/warn.wav" id="duSound" style="display: none;"></audio>
				
				</div>
			</div>
			<?php $__Template->display("themes/168pc/foot"); ?>

		</div>
	</body>
</html>";s:12:"compile_time";i:1517202376;}";