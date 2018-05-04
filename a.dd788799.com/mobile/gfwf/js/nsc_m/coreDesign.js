$(function(){
	//导航高亮
	//sidebar_hover
	function sideBarHighlight(){
		var nodes = $('.sidebar_allgames a'),len = 0,_href;
		if(sidebar_hover !== ""){
			$.each(nodes,function(index,node){
				_href = $(node).attr('href');
				if(_href.indexOf(sidebar_hover) != -1 && len == 0){
					$(node).parent('dd').addClass('hover');
					len = 1;
				}	
			});
		}
	}
	sideBarHighlight();
	setTimeout(function(){
		filterHeight();
	},0);


	/*用于处理奖球的初始化*/
	function fillBall(){

		var _node = $("#num"),_nodesHtml = _node.html(),_key,_data,_html = '',i = 0;
		var lottery_data = {
			'cq_11x5' 	: { 'len' : 5, 'num' : '--', 'width' : 50 },//重庆11选5
			'jx_11x5' 	: { 'len' : 5, 'num' : '--', 'width' : 50 },//江西11选5
			'sd_11x5' 	: { 'len' : 5, 'num' : '--', 'width' : 50 },//山东11选5
			'gd_11x5' 	: { 'len' : 5, 'num' : '--', 'width' : 50 },//广东11选5
			'cq_ssc' 	: { 'len' : 5, 'num' : '-', 'width' : 50 },//重庆时时彩
			'xc_mmc' 	: { 'len' : 5, 'num' : '-', 'width' : 50 },//秒秒时时彩
			'jx_ssc' 	: { 'len' : 5, 'num' : '-', 'width' : 50 },//江西时时彩
			'tj_ssc' 	: { 'len' : 5, 'num' : '-', 'width' : 50 },//天津时时彩
			'xj_ssc' 	: { 'len' : 5, 'num' : '-', 'width' : 50 },//新疆时时彩
			'cq_ffc' 	: { 'len' : 5, 'num' : '-', 'width' : 50 },//河内1分彩
			'pk10' 		: { 'len' : 10, 'num' : '', 'width' : 50 ,'classUl' : 'pk10_ul','classLi' : 'car00' },//pk10
			'xglhc' 	: { 'len' : 8, 'num' : '--' , 'classUl' : 'lhc', 'classLi' : 'empty', 'width' : 33,'andClass' : 'and','andIndex' : 6 },//香港六合彩
			'pl3' 		: { 'len' : 3, 'num' : '-', 'width' : 50 },//排列三
			'hnquick5' 	: { 'len' : 5, 'num' : '-', 'width' : 50 },//河内5分彩
			'3dfc' 		: { 'len' : 3, 'num' : '-', 'width' : 50 },//3d福彩
			'bjkl8' 	: { 'len' : 20, 'num' : '--' , 'classUl' : 'k8', 'width' : 20 },//北京快乐吧
			'jsk3' 		: { 'len' : 3, 'num' : '' , 'classUl' : 'k3', 'width' : 51,'classSpan' : 'empty'}//江苏快三
		};
		if(_nodesHtml === ''){
			_key = sidebar_hover;
			_data = lottery_data[_key];
			if(typeof _data['classUl'] !== 'undefined'){//如果父容器有节点
				_node.addClass(_data['classUl']);	
			}

			for(i; i < _data['len'] ; i+=1){
				if(typeof _data['classLi'] !== 'undefined'){//如果li有class
					if(_key === 'xglhc'){//如果是六合彩
						if(i === _data['andIndex']){
							_html += '<li class="' + _data['andClass'] + '"><span></span></li>';
						}else{
							_html += '<li class="' + _data['classLi'] + '"><span>' + _data['num'] + '</span></li>';	
						}
						
					}else{
						_html += '<li class="' + _data['classLi'] + '"><span>' + _data['num'] + '</span></li>';
					}
				}else{
					if(typeof _data['classSpan'] !== 'undefined'){
						_html += '<li><span class="' + _data['classSpan'] + '">' + _data['num'] + '</span></li>';
					}else{
						_html += '<li><span>' + _data['num'] + '</span></li>';	
					}
					
				}
			}

			if(_key == 'bjkl8' || _key == 'pk10'){//单独处理北京快乐8和pk10
				_node.html(_html)
				// .css({'width': _data['width']*_data['len']/2 + "px"});
			}else{
				_node.html(_html)
				// .css({'width': _data['width']*_data['len'] + "px"});
			}
			
		}
	}
	fillBall();
	//初始化方法
	$.funList = {
		'initTag' : true,
		'tzjlfn' : function(){//获取投注记录
			var v = Math.random();
	        $.getJSON('./index.php?controller=gameinfo&action=gamelistbyself&v=' + v, function(res) {
	            $('#close_bet-record_tc').html(res);
	        })
		},
		'fastBettingOpen' : true,//是否开启分辨率相关处理
		'fastBetting' : function(){//立即投注 根据屏幕分辨率变更投注方式
			var _width,_height,_html,isNull,_offsetTop,that = $.funList,pk10Height;
			_width = $(window).width();
			_height = $(window).height();

			pk10Height = $(".an-container").height();
			_offsetTop = that._offsetTop;
			that.fastBettingOpen = (pk10Height === 0 || pk10Height === null) ? true : false;//如果动画窗口隐藏,那么就开启分辨率处理

			if(!that.fastBettingOpen){//动画窗口存在情况下的处理
				isNull = $(".orderNow").children().html();
				if(isNull !== null){
					_html = $(".orderNow").children().clone(true);
					if(lottery_key !== "L-23")
			            $(".addOrderLeft").addClass("addOrderLeft625");
					//console.log(_html);
			        $(".addOrderRight").html(_html).addClass("addOrderRight625");
			        $(".orderNow").empty().hide();
				}
			}

			if(that.fastBettingOpen){//进行分辨率处理
				if(_height <= _offsetTop){
					isNull = $(".orderNow").children().html();
					if(isNull !== null){
						_html = $(".orderNow").children().clone(true);
						if(lottery_key !== "L-23")
				            $(".addOrderLeft").addClass("addOrderLeft625");
						//console.log(_html);
				        $(".addOrderRight").html(_html).addClass("addOrderRight625");
				        $(".orderNow").empty().hide();
					}
				}else{
					isNull = $(".addOrderRight").children().html();
					if(isNull !== null){
						_html = $(".addOrderRight").children().clone(true);
				        $(".addOrderLeft").removeClass("addOrderLeft625");
				        $(".addOrderRight").html("").removeClass("addOrderRight625");
				        $(".orderNow").html(_html).show();
					}
				}
			}
		},
		'sidebarNavMove' : function(){//侧栏移动
			var _node = $('.sidebarNav'),
				_sWidth = _node.width(),//侧栏宽度
				_measureWidth = ($(window).width() - $('.warp').width())/2,//屏幕左侧宽度
				_offset = 6,that = $.funList;
			_sWidth = _sWidth + _offset;
			if(!that.isHide){
				if(_measureWidth > _sWidth){//如果距离足够
					_node.stop().animate({'left' : _measureWidth - _sWidth + 'px'});
				}else{
					//_node.stop().animate({'left' : _offset + 'px'});
					$('.sidebar_hide').trigger('click');
				}
			}
		},
		'sidebarHide' : function(){//侧栏隐藏
			var _node = $('.sidebarNav'),
				_sWidth = _node.width(),//侧栏宽度
				_nodeshow = $('.sidebar_show'),
				_nodeshowWidth = _nodeshow.width(),//显示按钮宽度
				that = $.funList;
			$('.sidebar_hide').unbind().click(function(){
				that.isHide = true;
				_node.stop().animate({'left' : -_sWidth + 'px'},function(){
					_nodeshow.css({'left' : -_nodeshowWidth + 'px'}).show().stop().animate({'left' : 0 + 'px'});
				});
			});
		},
		'sidebarShow' : function(){//侧栏显示
			var _node = $('.sidebarNav'),
				_nodeshow = $('.sidebar_show'),
				that = $.funList;
			$('.sidebar_show').unbind().click(function(){
				var _sWidth = _node.width(),//侧栏宽度
				_measureWidth = ($(window).width() - $('.warp').width())/2,
				_nodeshowWidth = _nodeshow.width(),//显示按钮宽度
				_offset = 6,
				_sWidth = _sWidth + _offset;
				that.isHide = false;
				_nodeshow.stop().animate({'left' : -_nodeshowWidth + 'px'},function(){
					if(_measureWidth > _sWidth){//如果距离足够
						_node.css({'left' : -_sWidth + 'px'}).show().stop().animate({'left' : _measureWidth - _sWidth + 'px'});
					}else{
						_node.css({'left' : -_sWidth + 'px'}).show().stop().animate({'left' : _offset + 'px'});
					}
				});
			});
		},
		'showLotterys' : function(){
			$('.sidebar_lotteries a').toggle(function(){
				var node = $(this);
				$('.sidebar_allgames').stop().animate({'height' : '0px'},function(){
					node.addClass('hover');
				});
			},function(){
				var node = $(this);
				$('.sidebar_allgames').stop().animate({'height' : '376px'},function(){
					node.removeClass('hover');
				});
			});
		},
		'resize' : function(){//浏览器改变大小
			var that = $.funList;
			var timer_resize,timer_scroll;
			$(window).resize(function(){
				//window.clearTimeout(timer_resize);
				//timer_resize = setTimeout(function(){
					that.fastBetting();
					that.JS_blockPage();
					that.sidebarNavMove();
					that.hideTop();
					filterHeight();
				//}, 200);
			});

			$(window).scroll(function(){
				window.clearTimeout(timer_scroll);
				timer_scroll = setTimeout(function(){
					that.fastBetting();
					that.JS_blockPage();
				}, 200);
				//that.sidebarNavMove();
			});
		},
		'hideTop' : function(){//高度少于535隐藏头部
			var _height = $(window).height();
			var _top = $('.top').height();
			if(_height <= 570){
				$(document).scrollTop(_top);
			}else{

			}
		},
		'hideLotteries' : function(){//隐藏左侧彩种集合
			var _height = $(window).height();
			if(_height <= 625 && $.funList.initTag){
				$('.sidebar_lotteries a').trigger('click');		
			}
		},
		'JS_blockPage' : function(){//如果有弹窗让他永远在屏幕的中间
			var _node = $("#JS_blockPage"),
			_height = $(window).height(),
			_blockPageHeight = _node.height(),
			_scrollTop = $(document).scrollTop(),
			_top = (_height - _blockPageHeight)/2 + _scrollTop;
			if(_node.length > 0){
				_node.css({'z-index': '2000', 'left': '50%', 'top': _top + 'px'});
			}
		},
		'init' : function(){
			var that = $.funList;
			that.isHide = false;
			if($('#lt_sendok').length == 1){
				// that._offsetTop = $('#lt_sendok').offset().top + $('#lt_sendok').height();
			}

			if($(".an-container").length === 1){
				that._offsetTop -= $(".an-container").height();
			}

			that.sidebarHide();
			$.each(this,function(index,fun){
				if(index !== 'init' && typeof fun === 'function'){
					fun();
				}
			})

			that.initTag = false;
		}
	};
	$.funList.init();//初始化相关功能

	$.globelData = {
		"bigJson" : { 
		/*"lottery_12" : {"lotteryid":12,"uType":"ssc","runTime":"1160","issue":"20140928-018","lotteryName":"12天天时时彩","code":"80652","totalTime":"300"},
		"lottery_23" : {"lotteryid":23,"uType":"ssc","runTime":"862","issue":"20140928-018","lotteryName":"23天天时时彩","code":"80652","totalTime":"300"}*/
		},
		//是否已经渲染过页面
		"reviewStatus" : false,
		//获取大json的方法
		"getBigJson" : function(_type){
			var _this = this;
			var v = Math.random();
			if(pushServiceObj.pushStatus == "1"){//如果开启了推送
				if(_type == "init"){//初始化
					$.ajax({
						type:'GET',
						url:'./?controller=default&action=getalllotteryjson&v=' + v,
						dataType:'json',
						success:function(json){
							if(typeof json.data.lottery_list == "object"){
								//赋值数据给大json
								$.globelData.bigJson = json.data.lottery_list;
								//彩种头部初始化
								$.lotteryView.init();
								return false;
							}

							alert("bigJson异常");
						}
					})
				}
				if(_type == "update"){
					//赋值数据给大json
					//$.globelData.bigJson = json.data.lottery_list;
					//console.log(json.data.lottery_list);
					//定时器重置
					//$.globelTimer.reSet();
					return false;
				}
			}else{//轮训过程
				$.ajax({
					type:'GET',
					url:'./?controller=default&action=getalllotteryjson&v=' + v,
					dataType:'json',
					success:function(json){
						if(json.errno == "0"){//没有出错
							if(json.data.push_enabled == "1" && (pushServiceObj.pushServerStatus == "good" || pushServiceObj.pushServerStatus == "warning")){//如果再次开启推送,并且推送服务器是正常工作的情况下
								pushServiceObj.pushStatus = "1";
								if(json.data.push_server_host != pushServiceObj.pushServerHost){
									pushServiceObj.pushServerHost = json.data.push_server_host;
									pushInit(pushServiceObj.pushServerHost);
								}else{
									if(typeof pushstream === 'object'){
										pushstream.connect();
									}
								}

							}else{
								if(typeof json.data.lottery_list == "object"){
									if(_type == "init"){//初始化
										//赋值数据给大json
										$.globelData.bigJson = json.data.lottery_list;
										//彩种头部初始化
										$.lotteryView.init();
									}
									if(_type == "update"){//初始化
										//赋值数据给大json
										$.globelData.bigJson = json.data.lottery_list;
										//定时器重置
										$.globelTimer.reSet();
									}
								}else{
									//alert("bigJson异常");
								}
							}
						}else{//出错 打印出错信息
							//alert(json.error);
						}
						
					}
				})
			}
		},
		init : function(){
			var _this = this;
			_this.getBigJson("init");
		}
	}

	//初始化ajax请求
	$.globelData.init();

	$.lotteryView = {
		"lottery_arr" : [],
		"timeold" : "000000",
		"issueold" : "",
		"init" : function(){
			//lottery_key = "L-{$iLotteryId},L-{$iLotteryId}"
			var _lottery_key = lottery_key,
				_lottery_list_arr,//彩种序列
				_lotteryid,
				_data,_this;
			_this = this;
			_lottery_list_arr = _lottery_key.split(',');
			if(_lottery_list_arr.length === 0){//页面中有传递一个lottery_key,如果没有初始化失败
				//$.alert('彩种数据获取失败');
			}else{
				this.lottery_arr = _lottery_list_arr;
			}

			$.each(_lottery_list_arr,function(index,value){
				_lotteryid = value.split('-')[1];
				if(_lotteryid === ""){
					_this.lottery_arr = [];
					//$.alert('彩种数据获取失败');
				}
			});

			$.each(_this.lottery_arr,function(index,value){
				var _id,_name = "lottery_";
				_id = value.split('-')[1];
				_name += _id;
				_data = $.globelData.bigJson[_name];
				if(typeof _data !== 'object'){
					_this.lottery_arr = [];
					//$.alert("获取数据失败");
				}	
			})

			$.globelTimer.init();
			$.globelData.reviewStatus = true;
		},
		"drawLotteryTime" : function(){//时间动画
			var _this = this,
				_time,//存放时间00:00:00
				_timenew,//时间字符串000000
				_obj,//需要用于处理的obj
				_num,
				_num_next,
				_timeBox,
				_num_class,
				_second;
			_timeBox = $('.timeBox');
			$.each(_this.lottery_arr,function(index,value){
				_time = $.globelTimer.getLotteryTime(value);//获取时间00:00:00
				_timenew = _time.split($.globelFun.spCode).join('');
				_obj = _this.getChangeObj(_this.timeold,_timenew);
				$.each(_obj,function(index,value){
					if(value['index']%2 === 1){
						_num_class = ".num_right";
					}else{
						_num_class = ".num_left";
					}

					(function(_index,_class,_value){
						_timeBox.eq(_index).find(_class + ' .num_next_t div').html(_value['new']);
						_timeBox.eq(_index).find(_class + ' .num_next_b div').html(_value['new']);
						_timeBox.eq(_index).find(_class + ' .num_t div').html(_value['old']);
						_timeBox.eq(_index).find(_class + ' .num_b div').html(_value['old']);
						_timeBox.eq(_index).find(_class).addClass('num_next');
						window.setTimeout(function(){
						_timeBox.eq(_index).find(_class + ' .num_t div').html(_value['new']);
						_timeBox.eq(_index).find(_class + ' .num_b div').html(_value['new']);
						_timeBox.eq(_index).find(_class).removeClass('num_next');
						},700)
					})(~~(value['index']/2),_num_class,value);
				});

			});
			//pk10动画相关
			if(sidebar_hover === "pk10"){
				var _time10 = _time.split($.globelFun.spCode),
					_seconds = ~~_time10[2] + _time10[1]*60,
					_newseconds;
					$(".countdown span").text(_seconds);
					if(_seconds > 270){
						if(runData.isBegin)runData.isBegin = false;
						if(runData.isGroundStopped)runData.isGroundStopped = false;
						if(runData.stop)runData.stop = false;
						_newseconds = _seconds - 270;
						$(".countdown").show();
						$(".countdown span").text(_newseconds);
						if(_seconds < 276){
							$(".countdown span").velocity({"font-size":"82px"},400,function(){
									$(".countdown span").velocity({"font-size":"62px"},400);
							});
						}
					}else if(_seconds <= 270 && _seconds >= 210){
						$(".countdown").hide();
						//if(!runData.isBegin && !runData.isFirst){
						if(!runData.isBegin){
							$.race().fnAllMove(_seconds);
						}
					}else if(_seconds < 210 && _seconds > 175){
						$(".countdown").hide();
						if(_seconds < 180 ){
							if(!runData.hasPushed){
								runData.hasPushed = true;
								runData.spurt = true;
								runData.completed = true;
								runData.finished = true;
								runData.isGroundStopped = true;
								runData.isInitialize = false;
								$(".an-body .error-tip").fadeIn();
								$(".cars-area .wheel").hide();
							}
						}
					}else if(_seconds <= 175){
						if(!runData.isInitialize){
							$.race().fnParamsInitial();
						}
						_newseconds = _seconds + 30;
						$(".countdown").show();
						$(".countdown span").text(_newseconds);
					}
			}
			if(_this.lottery_arr.length === 1){
				this.timeold = _timenew;
				_second = $.globelTimer.getLotterySecond(_this.lottery_arr[0]);
				if(_second <= 10){
					//声音调用
					// _sound._mPlay();
				}
				if(_second == 0){
					$.globelData.getBigJson("update");
				}
			}else{
				//$.alert('时间保存失败');
				return false;
			}
			return false;
			//num_t num_b 1
			//num_next_t num_next_b 0
		},
		"getChangeObj" : function(_old,_new){
			var obj = [],_newnum;
			if(typeof _old === "string" && typeof _new === "string" && _old.length === _new.length){
				$.each(_old,function(index,value){
					_newnum = _new.slice(index,index+1);
					if(value !== _newnum){
						obj.push({'index' : index , 'new' : _newnum , 'old' : value});
					}
				})
				return obj;
			}
			//$.alert('请检查时间');
			return false;
		},
		"changeNumFun" : function(){
			var _this = this,
				_id = lottery_key.split("-")[1],
				_name = "lottery_",
				_obj,_issue,_code;
			_name += _id;
			_obj = $.globelData.bigJson[_name];
			_issue = _obj['issue'];
			_code = _obj['code'];
			//console.log('runTime:' + _obj['runTime'] + '-----' + 'totalTime:' + _obj['totalTime']);
			if(_this.issueold === ""){
				_this.issueold = _issue;	
			}
			if(_this.issueold !== _issue){
				processCode(_issue,_code,2);
				_this.issueold = _issue;
			}
		}
	}

	$.caipiaoGame = {
		'sideBarFun' : function(){
			var _sideBar = ['1','14','19','24'];
			/*sideBar处理*/
			$.each(_sideBar,function(index,value){
				if(typeof $.globelData.bigJson['lottery_' + value] === 'object'){
					var timeLeft = $.globelTimer.getLotteryTime('L-' + value);
					var timeArr = timeLeft.split(":"),seconds = timeArr[1]*60 + ~~timeArr[2];
					if(seconds <= 30){
						$("#lottery_L-" + value + " .ltime").addClass("bet-tip");
					}else{
						$("#lottery_L-" + value + " .ltime").removeClass("bet-tip");
					}
					$("#lottery_L-" + value + " .ltime").html(timeLeft);
				};
			});
		}
	}

	//定时器
	$.globelTimer = {
		runSecond : 0,
		cycle : 60,//n秒为一个周期
		lotteryName : "",//记录当前选择的彩种
		reSet : function(){
			var _this = this;
			$.globelTimer.runSecond = 0;
			_this.init();
		},
		setLotteryName : function(name){
			if(name.indexOf("L") != -1){
				this.lotteryName = name;
			}else{
				this.lotteryName = "";
			}
		},
		timer : null,
		//定时器发送数据控制
		postDataFun : function(){
			var _this = this;
			$.globelTimer.runSecond++;
			$.globelTimer.timeDoFun($.globelTimer.cycle,$.globelData.getBigJson,"update");
			//写入倒计时
			$.lotteryView.drawLotteryTime();//时间动画
			//$.lotteryView.changeNumFun();//开奖号动画 推送二期之后该方式禁用
			$.caipiaoGame.sideBarFun();//彩票游戏倒计时
		},
		getLotteryTime : function(str){
			var ID = str.split("-")[1];
			var tag = "lottery_" + ID;
			var runTime = parseInt($.globelData.bigJson[tag].runTime);
			var totalTime = parseInt($.globelData.bigJson[tag].totalTime);
			var second = 0;
			second = runTime - $.globelTimer.runSecond;
			//console.log(totalTime);
			if( second < 0){
				second = (runTime + totalTime - ($.globelTimer.runSecond%totalTime))%totalTime;
			}
			//console.log(second);
			return $.globelFun.showTime(second);
		},
		getLotterySecond : function(str){
			var ID = str.split("-")[1];
			var tag = "lottery_" + ID;
			var runTime = parseInt($.globelData.bigJson[tag].runTime);
			var totalTime = parseInt($.globelData.bigJson[tag].totalTime);
			var second = 0;
			second = runTime - $.globelTimer.runSecond;
			//console.log(totalTime);
			if( second < 0){
				second = (runTime + totalTime - ($.globelTimer.runSecond%totalTime))%totalTime;
			}
			//console.log(second);
			return second;
		},
		timeDoFun : function(second,fun,arguments){
			//在指定的时间内做相关操作
			if(typeof fun != "function" || second < 0){
				alert("参数非法");
				return false;
			}
			//alert(typeof fun);
			if($.globelTimer.runSecond % second == 0){
				if(typeof arguments == "string"){
					fun(arguments);
				}else{
					fun();
				}
			}
		},
		init : function(){
		    window.clearInterval($.globelTimer.timer);
		    $.globelTimer.timer = window.setInterval($.globelTimer.postDataFun,1000);
		    //pk10动画相关
			var _this = this,currentTime = _this.getLotteryTime("L-24"),thisUrl = location.href,timer;
			if(thisUrl.indexOf("pk10") !== -1){
				//$.race({currentTime:currentTime});
				//gamePlay.init(currentTime);
				document.addEventListener("visibilitychange",function(e){
					if(document.hidden || document.webkitHidden || document.msHidden){
						timer = $.now();
						runData.stop = false;
					}else{
						var _time10 = _this.getLotteryTime("L-24").split(":"),
							_seconds = ~~_time10[2] + _time10[1]*60;
						var secs = ($.now() - timer)/1000;
						if(secs > 60){
							
							if(_seconds > 270){
								$.race().fnTabChangeInitial();
							}else if(_seconds <= 270 && _seconds >= 210){
								if(runData.stop)runData.stop = false;
								if(runData.isGroundStopped)runData.isGroundStopped = false;
								$(".countdown").hide();
								$.race().fnAllMove(_seconds);
							}else if(_seconds < 210 && _seconds > 175){
								if(_seconds < 180 ){
									if(!runData.hasPushed){
										runData.hasPushed = true;
										runData.spurt = true;
										runData.completed = true;
										runData.finished = true;
										runData.isGroundStopped = true;
										runData.isInitialize = false;
										$(".an-body .error-tip").fadeIn();
										$(".cars-area .wheel").hide();
									}
								}
								$(".countdown").hide();
								$.race().fnTabChangeInitial();
							}else if(_seconds <= 175){
								$.race().fnTabChangeInitial();
							}
							/*$(".an-reload").fadeIn(1000,function(){
								setTimeout(function(){
									$(".an-reload").fadeOut();
								},500);
							});	*/
						}
					}
				});
			}		
		}
	};


	//页面全局方法管理---------------------------------------------------------------------------------------
	$.globelFun = {
		spCode : ":",
		//倒计时时间返回
		showTime : function(second){
			var second = parseInt(second);
			var day,hour,minute,sec;
			//day = parseInt(second/(3600*24));
			//hour = parseInt(second%(3600*24)/(3600));
			hour = parseInt(second/(3600));
			minute = parseInt(second%(3600*24)%3600/60);
			sec = parseInt(second%(3600*24*3600*60)%60);
			//day = (day == 0) ? "" : day;
			//day = (day > 0 && day < 10 && day != "") ? day + "天" : day;
			hour = (hour == 0) ? "" : hour;
			//if(day != ""){
				//hour = (hour > 0 && hour < 10) ? "0" + hour + ":" : hour + ":"	
			//}else{
				if(hour != ""){
					hour = (hour > 0 && hour < 10) ? "0" + hour + this.spCode : hour + this.spCode	
				}else{
					hour = "00" + this.spCode;
				}
			//}
			minute = (minute == 0) ? "00" : minute;
			minute = (minute > 0 && minute < 10 && minute != "00") ? "0" + minute + this.spCode : minute + this.spCode;
			sec = (sec == 0) ? "00" : sec;
			sec = (sec > 0 && sec < 10 && sec != "00") ? "0" + sec : sec;
			//return day + hour + minute + sec;
			if(!isNaN(second)){
				return hour + minute + sec;
			}else{
				return "-- : -- : --";
			}		
		},
		//获取cookie
		getCookie : function(name){
			var re = "(?:; )?" + encodeURIComponent(name) + "=([^;]*);?";
			re = new RegExp(re);
			if (re.test(document.cookie)) {
				return decodeURIComponent(RegExp.$1);
			}
			return '';
		},
		//设置cookie
		setCookie : function(name,value,expire,path){
			var curdate=new Date();
			var cookie=name+"="+encodeURIComponent(value)+"; ";
			if(expire!=undefined||expire==0){
				if(expire==-1){
					expire=366*86400*1000;//保存一年
				}else{
					expire=parseInt(expire);
				}
				curdate.setTime(curdate.getTime()+expire);
				cookie+="expires="+curdate.toUTCString()+"; ";
			}
			path = path || "/";
			cookie += "path=" + path;
			document.cookie=cookie;
		},
		//获取当前时间
		nowTime : function(){
			if(arguments.length > 1){
				alert("传值失败");
			}
			if(arguments.length == 0){
				var d = new Date();
			}
			if(arguments.length == 1){
				var d = new Date(arguments[0]);
			}
			var year,month,day,hour,minute,second,time;
			year = d.getFullYear();
			month = d.getMonth() + 1;
			day = d.getDate();
			hour = d.getHours();
			minute = d.getMinutes();
			second = d.getSeconds();
			year = (year < 10) ? "0" + year : year;
			month = (month < 10) ? "0" + month : month;
			day = (day < 10) ? "0" + day : day;
			hour = (hour < 10) ? "0" + hour : hour;
			minute = (minute < 10) ? "0" + minute : minute;
			second = (second < 10) ? "0" + second : second;
			time = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
			return time;
		},
		//获取秒数
		getSecond : function(date){
			var time = date;
			var d = new Date(time);
			var second = d.getTime();
			if(isNaN(second)){//ie8兼容
				if(typeof time == "undefined"){
					second = 0;
				}else{
					time = time.replace(/-/g,"\/");
					d = new Date(time);
					second = d.getTime();
				}
			}
			second = isNaN(second) ? 0 : second;
			return second;
		}
	};
});

//用于计算近期开奖和活动公告的高度
function filterHeight(){
	$('.lotteryLeft').css({"min-height" : "auto"});
	var lotteryBodyHeight = $('.lotteryLeft').height();
	var url = window.location.href;
	lotteryBodyHeight = (lotteryBodyHeight <= 338) ? 338 : lotteryBodyHeight;
	if(lotteryBodyHeight <= 338){
		// $('.lotteryLeft').css({"min-height" : lotteryBodyHeight + "px"});
	}else{
		// $('.lotteryLeft').css({"min-height" : "auto"});
	}
	var avgHeight = (lotteryBodyHeight-10)/2;
	var _timeout;
	//console.log(lotteryBodyHeight);
	//设置近期开奖活动公告高度
	

	var next_height = $(".recentBox .next").height();
	next_height = (typeof next_height === 'object') ? 0 : next_height;
	// $('.recentCon').height(avgHeight-51-next_height);
	// $('.recentConGG ul').height(avgHeight-80);

	$('.recentBox .next').unbind().hover(function(){
		$('.recentCon').css({"overflow" : "inherit"});
		$('.recentCon ul').css({"border-bottom" : "1px solid #d3d2d2"});
		$('.recentCon').unbind().hover(function(){
			clearTimeout(_timeout);
		},function(){
			_timeout = window.setTimeout(function(){
				$('.recentCon').css({"overflow" : "hidden"});
				$('.recentCon ul').css({"border-bottom" : "none"});
			},200);
		});
	},function(){

	});

	//江苏快三公告处理
	if(url.indexOf("jsk3") !== -1){
		//console.log(url);
		$('.recentConGG ul').height(avgHeight-70);
		$('.recentConGG').siblings(".more").css({"margin-top":0,"height":"19px","line-height":"25px"});
	}

}
