window.onload = function() {
	$(".loading").hide();
}
var cqncVideo = {};
var cqncinterval;
var ifsound = true,
	ifopen = false,
	bgsound, kaisound, opacityinterval;
var kaijiarr = [];
//生成单个随机数
cqncVideo.createNum = function(min, max) {
	var r = Math.random() * (max - min);
	var re = Math.round(r + min);
	re = Math.max(Math.min(re, max), min);
	return re;
}
cqncVideo.opacityinterval = function() {
	clearInterval(opacityinterval);
	var result = []
	for(var i = 0; i < 20; i++) {
		result[i] = $(".numCircle>ul>li:eq(" + i + ")")
	}
	var i = 0
	opacityinterval = setInterval(function() {
		if(i == 20) {
			i = 0
		}
		if(result[i] == undefined) {
			return false;
		}
		if(result[i].attr("class").indexOf("rollActive_") == -1) {
			result[i].addClass("rollActive_" + (i + 1)).css("opacity", "0.5")
			setTimeout(function() {
				if(result[i].attr("class").indexOf("rollActive_" + (i + 1)) != -1) {
					result[i].removeClass("rollActive_" + (i + 1)).css("opacity", "1")
				}
				i++
			}, 350)
		} else {
			result[i].animate({
				opacity: '0.5'
			}, "50");
			setTimeout(function() {
				result[i].animate({
					opacity: '1'
				}, "50");
				i++
			}, 350);
		}
	}, 400)
}
//得到去重后的随机数据（数组）
cqncVideo.createArr = function() {
	var arr = [];
	for(var i = 0; i < 8; i++) {
		var a = cqncVideo.createNum(1, 20);
		if(i != 0) {
			for(var c = 0, b = arr.length - 1; c < arr.length; c++) {
				if(a == arr[c]) {
					i--;
					break;
				}
				if(c == b) {
					arr.push(a);
					break;
				}
			}
		} else {
			arr.push(a)
		}
	}
	return arr;
}
cqncVideo.sum = function(arr, change) { //取数组的总和
	var orgsum = $(".sum>span").text(),
		orgdanxu = $(".danxu").text(),
		orgdaxiao = $(".daxiao").text(),
		orgweixiao = $(".weixiao").text(),
		orgliText = $(".numlist").html();

	cqncVideo.statusFun(undefined, arr, undefined, false)
	if(change == undefined) {
		var texttime = setTimeout(function() {
			$(".numlist").html(orgliText);
			$(".sum>span").text(orgsum), $(".danxu").text(orgdanxu), $(".daxiao").text(orgdaxiao), $(".weixiao").text(orgweixiao);
			cqncinterval = undefined
		}, 8000)
	}

}
cqncVideo.go = function(arr, coundown) { // 开始跑动画，传入数组为空默认为试试手气
	window.clearInterval(opacityinterval)
	$.each(kaijiarr, function(i, p) {
		$(".numCircle>ul>li:eq(" + (kaijiarr[i] - 1) + ")").removeClass("rollActive_" + kaijiarr[i])
	});
	cqncVideo.changesound(true);
	if(arr == undefined) {
		var result = false;
		var arr = cqncVideo.createArr();
	} else {
		var result = true;
	}
	$.each(arr, function(i, p) {
		$(".numCircle>ul>li:eq(" + (arr[i] - 1) + ")").addClass("rollActive_" + arr[i])
	});
	if(result) {
		if(coundown != undefined) {
			kaijiarr = arr;
			cqncVideo.sethistoryNum(arr);
			cqncVideo.cutTime(coundown);
			var udne = true
		} else {
			var udne = undefined
		}
		cqncVideo.sum(arr, udne);
		var cqnctimeout = setTimeout(function() {
			clearTimeout(cqnctimeout);
			/*$.each(arr, function(i, p) {
			    $(".numCircle>ul>li:eq(" + (arr[i] - 1) + ")").removeClass("rollActive_" + arr[i])
			});*/
			for(var k = 0; k <= 19; k++) {
				$(".numCircle>ul>li:eq(" + k + ")").removeClass("rollActive_" + (k + 1))
			}
			setTimeout(function() {
				$.each(kaijiarr, function(i, p) {
					$(".numCircle>ul>li:eq(" + (kaijiarr[i] - 1) + ")").addClass("rollActive_" + kaijiarr[i])
				});
				cqncinterval = undefined;
				cqncVideo.opacityinterval()
			}, 500);
		}, 8000)
		return;
	}
	var cqnctimeout = setTimeout(function() {
		clearTimeout(cqnctimeout);
		$.each(arr, function(i, p) {
			$(".numCircle>ul>li:eq(" + (arr[i] - 1) + ")").removeClass("rollActive_" + arr[i])
		});
	}, 200)
}

cqncVideo.sethistoryNum = function(arr) { // 修改顶部开奖结果
	console.log(arr);
	kaijiarr = arr;
	$(".codeNow").text($(".nowIssue>span").text());
	var li = $(".kaiNum>ul>li");
	li.removeClass();
	console.log("修改头部：" + li);
	console.log("修改头部：" + arr);
	for(var i = 0; i < arr.length; i++) {
		li[i].setAttribute("class", "history_" + arr[i])
	}
}
//
cqncVideo.eachrun = function(ifadd) {
	if(ifadd != undefined) {
		$(".nowIssue>span").text($(".nowIssue>span").text() * 1 + 1);
		$(".numlist").html("");
		$(".sum>span").text("");
		$(".longhu>span").text("")
	}
	cqncinterval = setInterval(function() { // 点击开始跑动画 ，
		cqncVideo.go()
	}, 210);
}
cqncVideo.soundstatus = function() { //手机端始化声音
	document.getElementById("bgsound").play();
	document.getElementById("kaisound").play();
	document.getElementById("bgsound").pause();
	document.getElementById("kaisound").pause();
}

$(function() {
	//  cqncVideo.statusFun(20112233, [2, 6, 7, 9, 5, 3, 12, 1], 50, true)
	//  cqncVideo.opacityinterval();
	//  $("#btn").click(function() {
	//      stopanimate([12, 6, 17, 9, 13, 3, 15, 19], 60)
	//  })
	bgsound = document.getElementById("bgsound");
	kaisound = document.getElementById("emptsound");
	if(ifopen && ifsound) {
		bgsound.play();
		kaisound.play();
	}

	$(".soundsIcon").click(function(e) { // 音声开关
		e.preventDefault();
		if($(this).hasClass("on")) {
			$(this).removeClass("on").addClass("off");
			ifsound = false;
			kaisound.pause();
			bgsound.pause()
		} else {
			$(this).removeClass("off").addClass("on");
			ifsound = true;
			ifopen = true;
			bgsound.play();
			kaisound.play();
		}
	})
	$(".startBtn").click(function(e) { //  点击试试手气
		if(cqncinterval != undefined) {
			console.log("return");
			if(cqncinterval == 555) {
				$("#mnkai_text").text("即将开奖，禁止模拟").show();
			} else {
				$("#mnkai_text").text("开奖中，禁止模拟").show();
			}
			setTimeout(function() {
				$("#mnkai_text").hide()
			}, 1000)
			return;
		}
		e.preventDefault();
		cqncVideo.eachrun();
		setTimeout(function() { // 试试手气跑动画 10秒后 停止动画
			clearInterval(cqncinterval);
			stopanimate(cqncVideo.createArr())
		}, 6000)
	})

})

function stopanimate(arr, coundown) {
	if(arr == undefined) {
		cqncinterval = undefined;
		ifopen = false;
		kaisound.pause();
		bgsound.pause();
		return;
	}
	clearInterval(cqncinterval);
	setTimeout(function() {
		cqncVideo.go(arr, coundown);
		cqncVideo.changesound(false)
	}, 400)
}
//倒计时
var timerr;
cqncVideo.cutTime = function(sys_second) {
	clearInterval(timerr);
	if(timerr != null) {
		clearInterval(timerr);
	}
	var sys_second = sys_second;
	timerr = setInterval(function() {
		if(sys_second >= 1) {
			sys_second -= 1;
			//var day = Math.floor((sys_second / 3600) / 24);
			var hour = Math.floor(sys_second / (60 * 60));
			var minute = Math.floor((sys_second / (60)) % 60);
			var second = Math.floor((sys_second) % 60);
			var html = "";
			//如果时间小于0则删除时间显示
			html = (hour < 10 ? ("0" + hour) : hour) + ":";
			html = html + "" + (minute < 10 ? ("0" + minute) : minute) + ":" + (second < 10 ? ("0" + second) : second);
			$(".timeing").text(html);
			//计算小时
			/* if(sys_second < 10) {
			     var lilist = $(".linelist").find("li");
			     $(lilist).eq(sys_second).addClass("redli");
			 }*/
			if(sys_second < 20) {
				cqncinterval = 555;
			}
		} else {
			cqncVideo.changesound(true);
			cqncinterval = undefined;
			clearInterval(timerr); //清除当前定时器
			cqncVideo.eachrun(1);
		}
	}, 1000);
}
cqncVideo.changesound = function(kaiIn) {
	if(kaiIn) {
		bgsound.pause();
		kaisound = document.getElementById("kaisound");
		bgsound = document.getElementById("emptsound");
		if(ifopen && ifsound) {
			kaisound.play()
		}
	} else {
		kaisound.pause();
		kaisound = document.getElementById("emptsound");
		bgsound = document.getElementById("bgsound");
		setTimeout(function() {
			if(ifopen && ifsound) {
				bgsound.play();
			}
		}, 8000)
	}
}

cqncVideo.statusFun = function(issue, arr, time, changeTop) {
	clearInterval(opacityinterval);
	if(ifopen && ifsound) {
		bgsound.play();
		kaisound.play();
	}
	if(issue != undefined) {
		$(".nowIssue>span").text(issue);
		kaijiarr = arr;
		for(var k = 0; k <= 19; k++) {
			$(".numCircle>ul>li:eq(" + k + ")").removeClass("rollActive_" + (k + 1))
		}
		for(var i = 0; i < arr.length; i++) {
			console.log(arr[i]);
			$(".numCircle>ul>li:eq(" + (arr[i] - 1) + ")").addClass("rollActive_" + arr[i])
		}
	}
	if(changeTop) {
		cqncVideo.sethistoryNum(arr);
		$(".codeNow").text(issue);
		setTimeout(function() {
			cqncVideo.opacityinterval();
		}, 1000);
	}
	var arrsum = 0,
		daxiao = "",
		danxu = "",
		strsum = "",
		orgstr = "";
	weixia = "",
		html = "";
	for(var i = 0; i < arr.length; i++) { //开奖号码展示 
		arrsum += (arr[i] * 1);
		var arrc = "";
		if(arr[i] <= 9) {
			arrc = "0" + arr[i]
		} else {
			arrc = arr[i]
		}
		html += "<li>" + arrc + "</li>"
	}
	var orgstr = arrsum.toString();
	strsum = orgstr[orgstr.length - 1] * 1;
	if(strsum % 2 == 0) {
		danxu = "双"
	} else {
		danxu = "单"
	}
	if(strsum <= 4) {
		daxiao = "小", weixiao = "尾小"
	} else {
		weixiao = "尾大"
	}
	if(orgstr > 84) {
		daxiao = "大"
	} else if(orgstr == 84) {
		daxiao = "和"
	} else {
		daxiao = "小"
	}
	$(".numlist").html(html);
	$(".sum>span").text(arrsum),
		$(".danxu").text(danxu),
		$(".daxiao").text(daxiao),
		$(".weixiao").text(weixiao);
	if(time != undefined) {
		cqncVideo.cutTime(time); // 传入时间 秒 开始倒计时
	}
}