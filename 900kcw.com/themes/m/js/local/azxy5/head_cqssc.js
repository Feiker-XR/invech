//为当前采种添加公共类型
/*
cqssc:10002,
tjssc:10003,
xjssc:10004
*/
var lotCode = lotCode.cqssc;
//主体方法类
var boxId = "#headerData";
var headMethod = {};
var isfirthload = true;
headMethod.loadHeadData = function(issue, boxId) {
	pubmethod.ajaxHead.ssc(issue, boxId);
}
headMethod.headData = function(jsondata, id) {
	pubmethod.creatHead.ssc(jsondata, id);
	setTimeout(function() {
		if(!$("#videobox").length < 1) {
			if(!($("#videobox").css("z-index") == -1)) {
				$("iframe")[0].contentWindow.sscAnimateEnd(createData());
			}
		}
	}, 1000)
}
/*$(function() {
	//弹出播放视频
	$("#startVideo").on("click", function() {
		startVideo();
		$("iframe")[0].contentWindow.ifopen = true;
		$("iframe")[0].contentWindow.sscAnimateEnd(createData());
	});
	//关闭视频
	$("#videobox .closevideo").on("click", function() {
		$(".content").animate({
			"top": "-150%"
		}, 200, function() {
			$("#videobox").css({
				"z-index": "-1",
				"position": "fixed"
			});
		});
		$("iframe")[0].contentWindow.videoTools.sounds.soundsT.stop("bgsound");
		$("iframe")[0].contentWindow.videoTools.clearInterval();
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

function startVideo() {
	//启动动画
	$("#videobox").animate({
		"z-index": "19999"
	}, 10, function() {
		$(".content").animate({
			"top": "0"
		}, 300, function() {
			var H = $("iframe").contents().find(".bodybg").height();
			isfirthload = false;
			$(".content").animate({
				"height": H + 35
			}, 100);
		});
	});
}

function createData() {
	//视频区
	var hour = $("#headerData").find(".hour").text();
	var minute = $("#headerData").find(".minute").text();
	var second = $("#headerData").find(".second").text();
	var sedonds = hour * 3600 + minute * 60 + second * 1 - 1;
	if(sedonds == "-1") {
		sedonds = 0;
	}
	var numarr = $("#pk10num").find("li").text();
	var data = {
		preDrawCode: [].slice.call(numarr),
		id: "#numBig",
		counttime: sedonds,
		preDrawIssue: $(".preDrawIssue").text(),
		drawTime: "",
		sumNum: $("#headerData").find(".longhu li:nth-child(4)").text(),
		sumSingleDouble: $("#headerData").find(".longhu li:nth-child(5)").text(),
		sumBigSmall: $("#headerData").find(".longhu li:nth-child(6)").text(),
		dragonTiger: $("#headerData").find(".longhu li:nth-child(1)").text()
	}
	return data;
}*/