$(function() {
	//初始化数据及监听事件
	pubmethod.initAdata();
	//初始化数据
	method.indexLoad(boxId);
	ifishad = true; //判断是否是刷新页
	tools.loadDate(); //初始化时间控件
	//弹出播放视频
	$("#startVideo").on("touchstart", function() {
		$("iframe")[0].contentWindow.fc3d.startVid(tools.fc3dDataStr());
		startVideo();
		$("iframe")[0].contentWindow.ifopen = true;
	});
	document.addEventListener('click', function() {
		if($("iframe")[0].contentWindow.ifopen) {
			$("iframe")[0].contentWindow.fc3d.sound.play("audioidKai");
			$("iframe")[0].contentWindow.fc3d.sound.play("audioidBg");
			$("iframe")[0].contentWindow.fc3d.sound.stop("audioidKai");
		}
	}, false);
	//关闭视频
	$("#videobox .closevideo").on("click", function() {
		$(".content").animate({
			"top": "-200%"
		}, 200, function() {
			$("#videobox").css({
				"z-index": "-1",
				"position": "fixed"
			});
		});
		$("iframe")[0].contentWindow.fc3d.sound.stop("audioidBg");
		$("iframe")[0].contentWindow.fc3d.sound.stop("audioidKai");
		$("iframe")[0].contentWindow.fc3d.clearTime();
		$("iframe")[0].contentWindow.ifopen = false;
	});
});

(function() {
	var supportOrientation = (typeof window.orientation === 'number' &&
		typeof window.onorientationchange === 'object');
	var init = function() {
		var htmlNode = document.body.parentNode,
			orientation;
		var updateOrientation = function() {
			if(supportOrientation) {
				orientation = window.orientation; //得到屏幕旋转参数
				if(($("#videobox").find(".content").css("top") == "0px")) {
					startVideo();
				}
			}
		};
		if(supportOrientation) {
			window.addEventListener('orientationchange', updateOrientation, false);
		} else {
			//监听resize事件
			window.addEventListener('resize', updateOrientation, false);
		}
		updateOrientation();
	};
	window.addEventListener('DOMContentLoaded', init, false);
})();

function iframe() {
	var W = $(".animate").width();
	var H = W * 780 / 1125;
	var zoomW = (W / 1125);
	setTimeout(function() {
		$('.animate iframe').contents().find("html").css("zoom", zoomW) // 父级宽/1310*100  取0.0000
		var contnetH = $('.animate iframe').contents().find(".container").height();
		$(".animate").animate({
			"height": H + 50
		}, 600);
		$('.animate iframe').animate({
			"height": H + 50
		}, 600);
		$(".content").animate({
			"height": H + 25
		}, 600);
	}, 1);
	setTimeout(function() {
		$('.animate iframe').contents().find(".container").fadeIn('slow');
		$('.animate iframe').contents().find("#preloader").fadeOut('slow');
	}, 1000);
}

function startVideo() {
	//启动动画
	$("#videobox").animate({
		"z-index": "19999"
	}, 10, function() {
		var W = $(".animate").width();
		var H = W * 780 / 1125;
		$(".content").css({
			"height": H + 35
		});
		$(".content").animate({
			"top": "0"
		}, 500, function() {
			iframe(); //加载动画界面
		});
	});
}

//判断是否是刷新页
var ifishad = false;
//加载其他数据
//入口加载数据
var method = {};
//加载其他数据
method.loadOther = function(date) {
	//处理所选日期不为当日时不加载列表数据
	if(date == "") {
		if(!tools.ifOnDay()) {
			return;
		}
	}
	method.listData(date); //重新请求list数据
}
//入口加载数据
method.indexLoad = function(id) {
	var nextIssue = $(id).find(".nextIssue").val();
	var id = "#" + $(id).attr("id");
	var data = {
		url: config.publicUrl + "QuanGuoCai/getLotteryInfo1.php",
		id: boxId,
		lotCode: lotCode
	};
	if(config.ifdebug) {
		console.log("indexLoad:" + JSON.stringify(data));
	}
	headMethod.loadHeadData(data); //页面启动时加载数据第一次加载不传参
	method.loadOther(""); //加载列表及其他数据
}
//筛选号码大小单双
method.selectedBS = function(obj, ifload) {
	var id = $(obj).attr("id");
	$(obj).siblings().removeClass("spanchecked");
	if(!ifload) {
		$(obj).addClass("spanchecked");
	}
	if(id == "gjlh") {
		$("#numlist .haomali").removeClass("displayblock").addClass("displaynone");
		$("#numlist .longhuli").removeClass("displaynone").addClass("displayblock");
	} else {
		$("#numlist .haomali").removeClass("displaynone").addClass("displayblock");
		$("#numlist .longhuli").removeClass("displayblock").addClass("displaynone");
	}
}
//请求list数据
method.listData = function(date) {
	$.ajax({
		url: "http://m.900kcw.com/?r=home/history/fc3d",
		type: "GET",
		// data: {
		// 	"lotCode": lotCode
		// },
		beforeSend: function() {
			if(!ifishad) {
				$("#numlist").html("<span class='loading'>努力加载中...</span>");
			}
		},
		success: function(data) {
			method.createHtmlList(data);
			//关闭加载动画
			animate.loadingList("body", false);
		},
		error: function(data) {
			if(config.ifdebug) {
				console.log("data error");
			}
		}
	});
}
method.createHtmlList = function(jsondata) {
	var data = null;
	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	if(data.errorCode == 0) {
		if(data.result.businessCode == 0) {
			data = data.result.data;
			//1：为开奖号码TAB添加数据---start
			$("#numlist").empty();
			$("#haomafblist").empty();
			$(data).each(function() {
				var divhtml = "";
				divhtml += '<div class="listotherline bortop001 ssclist">';
				divhtml += '<div class="leftspan">';
				divhtml += '<span class="boxflex">';
				var drawTime = this.preDrawTime;
				drawTime = drawTime.substring((drawTime.length) - 8, (drawTime.length) - 3);
				divhtml += '<span class="graytime">' + drawTime + '</span>';
				divhtml += '<span class="graytime">' + tools.subStr(this.preDrawIssue) + '</span>';
				divhtml += '</span>';
				divhtml += '</div>';
				divhtml += '<div class="rightspan">';
				divhtml += '<div class="rightdiv" style="padding-left:0">';

				if(lotCode == "10041") {
					var sjh = "";
					sjh = "<span style='color:#f12d35'>" + this.sjh + "</span>";
					divhtml += '<div class="haomali"><div class="leftdivsjh">'+sjh+'</div><div  class="leftdivsjh"><ul id="" class="ssclilist listli">';
					var preDrawCode = this.preDrawCode.split(",");
					$(preDrawCode).each(function(index) {
						divhtml += '<li><span class="rednum"><i>' + this + '</i></span></li>';
					});
					divhtml += '</ul></div></div>';
				} else {
					divhtml += '<div class="haomali"><ul id="" class="ssclilist listli">';
					var preDrawCode = this.preDrawCode.split(",");
					$(preDrawCode).each(function(index) {
						divhtml += '<li><span class="rednum"><i>' + this + '</i></span></li>';
					});
					divhtml += '</ul></div>';
				}

				divhtml += '<div class="longhuli displaynone"><ul id="" class="ssclilistxt listli lhlist">';
				var stylestr = "style='color:";
				if(!(preDrawCode.length <= 1)) {
					var sumBigSamll = this.sumBigSmall == "0" ? "大" : "小";
					var sumSingleDouble = this.sumSingleDouble == "0" ? "单" : "双";
					var dragonTiger = "";
					if(this.dragonTiger == "0") {
						dragonTiger = "龙";
					} else if(this.dragonTiger == "1") {
						dragonTiger = "虎";
					} else if(this.dragonTiger == "2") {
						dragonTiger = "和";
					}
				}
				if(lotCode == "10041"){
						divhtml += "<li  style='color:#f12d35'>" + this.sjh + "</li>";
				}
				divhtml += "<li  style='color:#f12d35'>" + this.sumNum + "</li>";
				divhtml += "<li style='color:#666'>" + sumBigSamll + "</li>";
				divhtml += "<li style='color:#666'>" + sumSingleDouble + "</li>";
				divhtml += '</ul>';
				divhtml += '</div>';
				divhtml += '</div>';
				divhtml += '</div>';
				divhtml += '</div>';
				$("#numlist").append(divhtml);
				$("#haomafblist").append(divhtml);
			});
			//1：为开奖号码TAB添加数据---start

			//1：为开奖号码TAB添加数据---end
		} else {
			console.log("数据请求失败！");
			$("#numlist").find(".loading").text(data.result.message);
		}
	}
}