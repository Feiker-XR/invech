<?php
ob_start('ob_output');
function ob_output($html) {
	// 一些用户喜欢使用windows笔记本编辑文件，因此在输出时需要检查是否包含BOM头
	if (ord(substr($html, 0, 1)) === 239 && ord(substr($html, 1, 2)) === 187 && ord(substr($html, 2, 1)) === 191) $html = substr($html, 3);
	// gzip输出
	if(
		!headers_sent() && // 如果页面头部信息还没有输出
		extension_loaded("zlib") && // 而且zlib扩展已经加载到PHP中
		array_key_exists('HTTP_ACCEPT_ENCODING', $_SERVER) &&
		stripos($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") !== false // 而且浏览器说它可以接受GZIP的页面 
	) {
		$html = gzencode($html, 3);
		header('Content-Encoding: gzip'); 
		header('Vary: Accept-Encoding');
	}
	header('Content-Length: '.strlen($html));
	return $html;
}
require('../xingcai_config.php');
$id=array('79','63','64','81','82');
$pgsid=array('30','50','80','100','120','200','300','');
include(dirname(__FILE__)."/inc/comfunc.php");
//此处设置彩种id
$typeid=intval($_GET['typeid']);
if(!in_array($typeid,$id)) die("typeid error");
if(!$typeid) $typeid=14;
//每页默认显示
$pgs=intval($_GET['pgs']);
if(!in_array($pgs,$pgsid)) die("pgs error");
if(!$pgs) $pgs=30;
//当前页面
$page=intval($_GET['page']);
if(!$page) $page=1;
//传参
$toUrl="?page=";
$params=http_build_query($_REQUEST, '', '&');
if(!$mydb) $mydb = new MYSQL($dbconf);
$gRs = $mydb->row($conf['db']['prename']."type","shortName","id=".$typeid);
if($gRs){
	$shortName=$gRs[0][0];
}

$fromTime=$_GET['fromTime'];
$toTime=$_GET['toTime'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:esun="" style="font-size: 15.525px;"><head>
<title>彩38-官方网站</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,user-scalable=no,maximum-scale=1.0">
<meta http-equiv="Pragma" content="no-cache">
<link rel="stylesheet" href="/css/nsc_m/list.css?v=1.17.2.1">
<link rel="stylesheet" href="css/line.css" type="text/css">
<link rel="stylesheet" href="/css/nsc_m/res.css?v=1.17.2.1">
<link href="/css/nsc_m/m-lottery.css?v=1.17.2.1" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.17.2.1"></script>
<script language="javascript" type="text/javascript" src="js/line.js"></script>


<script type="text/javascript" src="/js/nsc_m/layer.js?v=1.17.2.1"></script><link href="/js/nsc_m/need/layer.css?2.0" type="text/css" rel="styleSheet" id="layermcss">
 <script type="text/javascript" src="/js/nsc/common.js?v=1.17.2.1"></script>
<link rel="stylesheet" href="/js/common/calendar/css/calendar-blue.css?v=1.17.2.1" type="text/css">
<style type="text/css">

html {overflow:-moz-scrollbars-vertical; overflow-y:scroll;}
</style>

<script type="text/javascript"> 
  $(function(){
    //切换漏号分析
      $('.lhfx_tit').click(function(e){
      $('.lhfx_lotterylist').toggle();
      $(document).on('click',function(){
        $('.lhfx_lotterylist').hide();
      });
      e.stopPropagation();

  });
  $('.lhfx_lotterylist').on('click',function(e){
    e.stopPropagation();
  });
})
  </script>

</head>
<body>
<div id="body">
<header class="header">
  <a class="m-return" href="javascript:window.history.back(-1);">返回</a>
  <div class="lhfx_tit"><span class="showAll"><?=$shortName?>--历史开奖</span></div>
  <span class="btn-slide-bar"></span>
  <!-- <h1 class="page-title">header</h1> -->
</header>
<!--侧导航 -->
    <section class="slide-bar">
      <ul class="tree">
        <li class="tree_list"><h3 class="one_nav_list home"><a href="/?index.php">首页</a></h3>
          <div class="m_nav_line"></div>
        </li>
		<li class="tree_list">
	                <h3 class="one_nav_list uc_icon_r"><a href="/index.php/safe/Personal">用户中心</a></h3>
	                <div class="m_nav_line"></div>
				</li>
        <li class="tree_box tree_list">
          <h3 class="one_nav_list  game_icon tree_box">彩票游戏<i class="lnstruction-top"></i></h3>
          <ul class="tree_one" style="display:block">
            <li class="lotter_list_game">
            <div class="m_nav_line"></div>
              <dl>
                <dt>高频彩</dt>
                <dd>
                  <ul class="lot_list">
										<li><a href="/index.php/index/game/1/2/12">重庆时时彩<i>H</i></a> </li>
										<li><a href="/index.php/index/game/12/2/12">新疆时时彩</a> </li>
										<li><a href="/index.php/index/game/60/2/12">天津时时彩</a> </li>
										<li><a href="/index.php/index/game/61/59/193">澳门时时彩<i>H</i></a> </li>
										<li><a href="/index.php/index/game/62/59/193">台湾时时彩<i>H</i></a> </li>
										<li><a href="/index.php/index/game/5/59/193">河内1分彩<i>H</i></a> </li>
										<li><a href="/index.php/index/game/26/59/193">河内2分彩<i>H</i></a> </li>
										<li><a href="/index.php/index/game/14/59/193">河内5分彩<i>H</i></a></li>
										<li><a href="/index.php/index/game/76/59/193">巴西1.5分彩<i>H</i></a></li>
										<li><a href="/index.php/index/game/75/59/193">巴西快乐彩<i>H</i></a></li>
										
										<!-- comingsoon();  如果需要禁用用这个函数即可--> 
									</ul>
                </dd>
              </dl>
              <dl>
							<dt>PK拾</dt>
								<dd>
									<ul class="lot_list">
										<li><a href="/index.php/index/game/20">北京PK拾<i class="m-yellow">N</i></a> </li>
										<li><a href="/index.php/index/game/65">澳门PK拾<i class="m-yellow">N</i></a> </li>
										<li><a href="/index.php/index/game/66">台湾PK拾<i class="m-yellow">N</i></a> </li>
									</ul>
								</dd>
							</dl>
              <dl>
							<dt>快3</dt>
								<dd>
									<ul class="lot_list">
										<li><a href="/index.php/index/game/79">江苏快三<i>H</i></a></li>
										<li><a href="/index.php/index/game/63">澳门快三</a></li>
										<li><a href="/index.php/index/game/64">台湾快三</a></li>
									</ul>
								</dd>
							</dl>
							<dl>
							<dt>11选5</dt>
								<dd>
									<ul class="lot_list">
										<li><a href="/index.php/index/game/6">广东11选5<i>H</i></a></li>
										<li><a href="/index.php/index/game/16">江西11选5</a></li>
										<li><a href="/index.php/index/game/7">山东11选5</a></li>
										<li><a href="/index.php/index/game/15">上海11选5</a></li>
										<li><a href="/index.php/index/game/67">澳门11选5<i>H</i></a></li>
										<li><a href="/index.php/index/game/68">台湾11选5</a></li>
									</ul>
								</dd>
							</dl>
							<dl>
							<dt>快乐8</dt>
								<dd>
									<ul class="lot_list">
										<li><a href="/index.php/index/game/78">北京快乐8<i>H</i></a></li>
										<li><a href="/index.php/index/game/74">韩国快乐8<i>H</i></a></li>
										<li><a href="/index.php/index/game/73">澳门快乐8</a></li>
									</ul>
								</dd>
							</dl>
							<dl>
								<dt>3D-排列3</dt>
								<dd>
									<ul class="lot_list">
										<li><a href="/index.php/index/game/9">福彩3D<i>H</i></a></li>
										<li><a href="/index.php/index/game/69">澳门3D</a></li>
										<li><a href="/index.php/index/game/70">台湾3D</a></li>
										<li><a href="/index.php/index/game/10">排列3</a></li>
									</ul>
								</dd>
							</dl>
						</li> 
					</ul>
					<div class="m_nav_line"></div>
        </li>
        <li class="tree_box tree_list">
					<h3 class="one_nav_list account_icon">账户管理<i class="lnstruction-top"></i></h3>
					<ul class="tree_one">
						<li class="lotter_list_game">
							<div class="m_nav_line"></div>
								<dl class="lnstruction">
									<dd>
										<ul class="lot_list">
											<li class="tree_list"> <a href="/index.php/record/search">投注记录</a></li>
											<li class="tree_list"> <a href="/index.php/report/coin">帐变记录</a></li>
											<li class="tree_list"> <a href="/index.php/report/count">盈亏报表</a></li>
											<li class="tree_list"><a href="/index.php/safe/info">绑定卡号 </a></li>
											<li class="tree_list"><a href="/index.php/safe/loginpasswd">登入密码</a></li>
											<li class="tree_list"><a href="/index.php/safe/passwd">提款密码</a></li>
										</ul>
									</dd>
								</dl>
						</li>
					</ul>
					<div class="m_nav_line"></div>
				</li>
				<li class="tree_box tree_list">
					<h3 class="one_nav_list account_icon">充值提现<i class="lnstruction-top"></i></h3>
					<ul class="tree_one">
						<li class="lotter_list_game">
							<div class="m_nav_line"></div>
								<dl class="lnstruction">
									<dd>
										<ul class="lot_list">
											<li class="tree_list"> <a href="/index.php/cash/recharge">充值</a></li>
											<li class="tree_list"> <a href="/index.php/cash/toCash">提现</a></li>
											<li class="tree_list"> <a href="/index.php/cash/rechargeLog">充值记录</a></li>
											<li class="tree_list"><a href="/index.php/cash/toCashLog">提现记录 </a></li>
										</ul>
									</dd>
								</dl>
						</li>
					</ul>
					<div class="m_nav_line"></div>
				</li>
				<li class="tree_box tree_list">
					<h3 class="one_nav_list activity_icon">优惠活动<i class="lnstruction-top"></i></h3>
					<ul class="tree_one">
						<li class="lotter_list_game">
							<div class="m_nav_line"></div>
								<dl class="lnstruction">
									<dd>
										<ul class="lot_list">
											<li class="tree_list"><a href="/index.php/score/lucky">幸运抽奖</a></li>
											<li class="tree_list"><a href="/index.php/cash/card">卡密充值</a></li>
											<li class="tree_list"><a href="/index.php/lottery/hemai">合买中心</a></li>
											<li class="tree_list"><a class="notice" href="/index.php/notice/info">系统公告</a></li>
										</ul>
									</dd>
								</dl>
						</li>
					</ul>
					<div class="m_nav_line"></div>
				</li>			
			</ul>
		</section>
    <div class="home_b">
      <div class="m_nav_line"></div>
        <a class="one_nav_list conpt_icon" href="/?v=2">电脑版</a>
        <a class="one_nav_list retreat_icon" href="javascript:m_loginout()">安全退出</a>
    </div>
    <div class="shady"></div>
    <section class="wraper-page">
<div id="right_01">
<div class="right_01_01"></div>
</div>
<script language="javascript">
fw.onReady(function(){
	Chart.init();	
	DrawLine.bind("chartsTable","has_line");

		DrawLine.color('#499495');
	DrawLine.add((parseInt(0)*6+3+1),2,6,0);
		DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(1)*6+3+1),2,6,0);
		DrawLine.color('#499495');
	DrawLine.add((parseInt(2)*6+3+1),2,6,0);
		DrawLine.draw(Chart.ini.default_has_line);
	// if($("#chartsTable").width()>$('body').width())
	{
	   // $('body').width($("#chartsTable").width() + "px");
	}
	// $("#container").height($("#chartsTable").height() + "px");
	// $("#missedTable").width($("#chartsTable").width() + "px");
    resize();
	

	
	//最近多少期高亮
	var _num = "",_href;
	_href = window.location.href;
	_num = _href.match(/issuecount=(\d+)/);


});
function resize(){
    window.onresize = func;
    function func(){
        window.location.href=window.location.href;
    }
}
function daysBetween(start, end){
   var startY = start.substring(0, start.indexOf('-'));
   var startM = start.substring(start.indexOf('-')+1, start.lastIndexOf('-'));
   var startD = start.substring(start.lastIndexOf('-')+1, start.length);
  
   var endY = end.substring(0, end.indexOf('-'));
   var endM = end.substring(end.indexOf('-')+1, end.lastIndexOf('-'));
   var endD = end.substring(end.lastIndexOf('-')+1, end.length);
  
   var val = (Date.parse(endY+'/'+endM+'/'+endD)-Date.parse(startY+'/'+startM+'/'+startD))/86400000;
   return Math.abs(val);
}
function toggleMiss(){
    $('#missedTable').toggle();
}
</script>
<style>
	esun\:*{behavior:url(#default#VML)}
</style>

<div id="searchBox" style="background: #f8f8f8; padding:10px 0;">

    <div class="secondary_tabs">
        <ul>
            <li data="num_30" class="hover"><a href="?typeid=<?=$typeid?>&pgs=30" class="ml10<?php if($pgs==30) echo ' on'?>" target="_self">最近30期</a></li>
            <li data="num_50"><a href="?typeid=<?=$typeid?>&pgs=50" class="ml10<?php if($pgs==50) echo ' on'?>" target="_self">最近50期</a></li>
            <li data="num_100"><a href="?typeid=<?=$typeid?>&pgs=100" class="ml10<?php if($pgs==100) echo ' on'?>" target="_self">最近100期</a></li>
        </ul>
    </div>
    	<!-- <div class="lhfx_search_time">
		<form method="POST">
		<input type="hidden" name="controller" value="game">
		<input type="hidden" name="action" value="bonuscode">时间范围：<input type="text" value="" name="starttime" id="starttime" class="time_input"><span class="image"></span><label>至</label><input type="text" value="" name="endtime" id="endtime" class="time_input">
		<span class="image"></span><input type="submit" value="查询" id="showissue1" class="time_btn">
		</form>
	</div> -->
	<div class="clearfix"></div>
</div>

<div class="wo_choose" style="display:none"><span>标注形式选择</span><input type="checkbox" name="checkbox2" value="checkbox" id="has_line" class="no_bk-bg"><label for="has_line">显示走势折线</label>
    <!--<input type="checkbox" name="checkbox" value="checkbox" id="no_miss" onclick="toggleMiss();" /><span><b><label for="no_miss">不带遗漏数据</label></b></span>--></div>

<div style=" min-height:430px;" id="container">
	<table id="chartsTable" width="100%" cellpadding="0" cellspacing="0" border="0" style="display: table;">
    
       	       		<tbody>
		<tr id="title">
             <td style="width:38%;"><strong>期号</strong></td>
             <td colspan="3" class="redtext"><strong>开奖号码</strong></td>
    	</tr>
		
		<?php
				if($fromTime) $fromTime=strtotime($fromTime);
				if($toTime) $toTime=strtotime($toTime)+24*3600;
				
				$pg=trim($_REQUEST["page"]);
				if(!$pg){$pg=1;}
				if(!$pgs){$pgs=30;}
				$tableStr=$conf['db']['prename']."data";
				$tableStr2=$conf['db']['prename']."data a";
				$fieldsStr="time, number, data";
				
				$fieldsStr2="a.time, a.number, a.data";
				$whereStr=" type=$typeid ";
				$whereStr2=" a.type=$typeid ";
				if($fromTime && $toTime){
					$whereStr.=" and time between $fromTime and $toTime";
					$whereStr2.=" and a.time between $fromTime and $toTime";
				}elseif($fromTime){
					$whereStr.=' and time>='.$fromTime;
					$whereStr2.=' and a.time>='.$fromTime;
				}elseif($toTime){
					$whereStr.=' and time<'.$toTime;
					$whereStr2.=' and a.time<'.$toTime;
				}else{}
				$orderStr=" order by a.id desc";
	
				$totalNumber = $mydb->row_count($tableStr,$whereStr);

				if ($totalNumber>0){
			 
                $countcount=0;
				$perNumber=$pgs; //每页显示的记录数
				$page=$pg; //获得当前的页面值
				if (!isset($page)) $page=1;
				
				$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
				$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
				$data = $mydb->row($tableStr2,$fieldsStr2,$whereStr2.' '.$orderStr." limit $startCount,$perNumber");
				
				if($data) foreach($data as $var){
					
				$dArry=explode(",",$var[2]);
				$var['d1']=$dArry[0];
				$var['d2']=$dArry[1];
				$var['d3']=$dArry[2];
				
				echo '<tr>';
				echo '<td id="title">'.$var[1].'</td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d1'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d2'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d3'].'</div></td>';
				echo '</tr>';	
				} ?>   
       	
      <?php } ?>
	</tbody></table>
</div>
<!-- <div id="quickbuy"><a href="">购买重庆时时彩</a></div> //-->
<div class="lhfx_lotterylist_bg"></div>
<div class="lhfx_lotterylist" style="display: none;">
  	<dl>
		<dt>高频彩</dt>
		
		<dd><a href="/zst/index.php?typeid=1">重庆时时彩<i></i></a></dd>
		<dd><a href="/zst/index.php?typeid=86">三分时时彩</a></dd>
		<dd><a href="/zst/index.php?typeid=60">天津时时彩</a></dd>
		<dd><a href="/zst/index.php?typeid=12">新疆时时彩</a></dd>
		<dd><a href="/zst/index.php?typeid=87">上海时时乐</a></dd>
		<dd><a href="/zst/index.php?typeid=83">北京28<i></i></a></dd>
		<dd><a href="/zst/index.php?typeid=80">幸运28<i></i></a></dd>
  	</dl>
	<dl>
		<dt>PK拾</dt>
		<dd><a href="/zst/pk10.php?typeid=20">北京PK拾</a></dd>
		<dd><a href="/zst/pk10.php?typeid=85">三分PK拾</a></dd>
	</dl>
	<dl>
		<dt>江苏快3</dt>
		<dd><a href="/zst/k3.php?typeid=79">江苏快三</a></dd>
		<dd><a href="/zst/k3.php?typeid=82">广西快三</a></dd>
		<dd><a href="/zst/k3.php?typeid=81">安徽快三</a></dd>
	</dl>
	<dl>
		<dt>11选5</dt>
		<dd><a href="/zst/11x5.php?typeid=6">广东11选5</a></dd>
		<dd><a href="/zst/11x5.php?typeid=16">江西11选5</a></dd>
		<dd><a href="/zst/11x5.php?typeid=7">山东11选5</a></dd>
		<dd><a href="/zst/11x5.php?typeid=15">上海11选5</a></dd>
	</dl>
	<!-- <dl>
		<dt>快乐8</dt>
      	<dd><a href="/zst/kl8.php?typeid=78">北京快乐8</a></dd>
      	<dd><a href="/zst/kl8.php?typeid=74">韩国快乐8</a></dd>
		<dd><a href="/zst/kl8.php?typeid=73">澳门快乐8</a></dd>
	</dl> -->
	<dl class="nopb">
		<dt>其他</dt>
		<dd><a href="/zst/3dp3.php?typeid=9">福彩3D</a></dd>
		<dd><a href="/zst/3dp3.php?typeid=10">排列3</a></dd>
      	<dd><a href="/zst/3dp3.php?typeid=34">澳门六合彩</a></dd>
	</dl>
</div>

<div class="m_footer_annotation">
                        未满18周岁禁止购买<br>
                Copyright © SinCai  彩38 版权所有
                <!-- <a href="#" class="m_f_top"></a> -->
</div>

</section>
</div>
<script type="text/javascript" src="/js/nsc_m/res.js?v=1.17.2.1"></script>
<script type="text/javascript">
$(function(){
    var riable=0;
    $(".nfdprize_text").click(function(){
        if(riable==0){
            riable=1;
            $(".m-lott-methodBox .nfdprize_text b").addClass('cur')
        }else{
            riable =0;
            $(".m-lott-methodBox .nfdprize_text b").removeClass('cur')
        }
        $(".m-lott-methodBox-list").toggle();
    });
}())
    
</script>

</body>
</html>