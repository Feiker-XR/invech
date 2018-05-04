var url = {
	config140_2: "//127.0.0.1/168/66/",
	index_adurl: "//www.1680218.com/html/shishicai_jisu/ssc_index.html",
	news_adurl: "//www.1680218.com/html/jisusaiche/pk10kai.html",
	index_adurl_none: "//www.1680100.com/html/shishicai_jisu/ssc_index.html",
	news_adurl_none: "//www.1680100.com/html/jisusaiche/pk10kai.html",
	zoo_Aimg: "../img/AA.jpg",
	zoo_Bimg: "../img/BB.jpg"
};
url.config140 = url.config140_2 + "smallSix/";
url.photoUrl = "//images.6hch.com/";
url.photoUrl_2 = "//images.6hch.com/";
var tools = {};
var config = {
	publicUrl: url.photoUrl_2,
	pageSizenum: 300,
	ifDebugger: false
};
var oldLog = console.log;
console.log = function() {
	if (config.ifDebugger) {
		oldLog.apply(console, arguments)
	} else {
		return
	}
};

function sleep(b) {
	var a = new Date();
	var c = a.getTime() + b;
	while (true) {
		a = new Date();
		if (a.getTime() > c) {
			return
		}
	}
}
var publictools = {};
publictools.getToken = function() {
	return window.localStorage.token
};
publictools.testWWW = function() {
	var a = window.location.href;
	var b = "6hch001.com";
	if (a.indexOf(b) != -1) {
		$(".brann_img").hide();
		$(".header>ul>li:nth-child(6)>a").attr("href", "http://www.1680100.com");
		$(".header>ul>li:nth-child(7)>a").attr("href", "http://m.6hch001.com");
		$("#index_ad").attr("href", url.index_adurl_none);
		$(".news_ad").attr("href", url.news_adurl_none)
	} else {
		$(".brann_img").show();
		$("#index_ad").attr("href", url.index_adurl);
		$(".news_ad").attr("href", url.news_adurl)
	}
};
publictools.testWWW();
$(function() {
	$("#headdivbox").load("public/head.html", function() {
		publictools.testWWW();
		console.log("request is over!")
	});
	$("#fooderbox").load("public/fooder.html", function() {
		console.log("request is over!")
	})
});
var proto = {
	issuc: "2017019",
	Zoo: ["", "鼠", "牛", "虎", "兔", "龙", "蛇", "马", "羊", "猴", "鸡", "狗", "猪"],
	fiveLineArr: ["", "金", "木", "水", "火", "土"],
	colorArr: ["", "#F8253E", "#1FC26B", "#0093E8"],
	colorEng: ["", "red", "green", "blue"],
	colorCh: ["", "红", "蓝", "绿"],
	jiaqzs: ["", "家", "野"],
	boy_girl: ["", "男", "女"],
	top_bottom: ["", "天", "地"],
	four_season: ["", "春", "夏", "秋", "冬"],
	cqsh: ["", "琴", "棋", "书", "画"]
};
$("#fooderbox,.footer").on("click", "#gotop", function() {
	$("body,html").animate({
		scrollTop: 0
	}, 500);
	$(this).hide();
	return false
});
$(document).scroll(function() {
	if ($(this).scrollTop() > 10) {
		$("#gotop").show()
	} else {
		$("#gotop").hide()
	}
});
$("#fooderbox,.footer").on("mousemove", ".fankuicon", function() {
	$(this).html("用户</br>反馈")
});
$("#fooderbox,.footer").on("mouseout", ".fankuicon", function() {
	$(this).html("")
});
$("#fooderbox,.footer").on("click", ".bar_remove", function() {
	$("#modal").hide()
});
$("#fooderbox,.footer").on("click", ".fankuicon", function() {
	$("#modal").show()
});
$("#fooderbox").on("click", "#btn_upload", function() {
	var a = {
		linkType: $("#fooderbox #select_op option:selected").val(),
		nickName: $("#fooderbox #first_input").val(),
		linkNumber: $("#fooderbox #fanku_text").val(),
		fedBack: $("#fooderbox #advice").val()
	};
	console.log(a);
	fankuFun(a)
});
$(".footer").on("click", "#btn_upload", function() {
	var a = {
		linkType: $(".footer #select_op option:selected").val(),
		nickName: $(".footer #first_input").val(),
		linkNumber: $(".footer #fanku_text").val(),
		fedBack: $(".footer #advice").val()
	};
	console.log(a);
	fankuFun(a)
});

function fankuFun(a) {
	$.ajax({
		type: "get",
		url: url.config140_2 + "fedBack/saveFedBack.php",
		async: true,
		data: a,
		dataType: "json",
		success: function(b) {
			console.log(b);
			alert(b.result.message);
			if (b.errorCode == 0) {
				$("#modal").hide()
			}
		},
		error: function(b) {
			console.log(b)
		}
	})
}
tools.browserRedirect = function() {
	var d = navigator.userAgent.toLowerCase();
	var i = d.match(/ipad/i) == "ipad";
	var j = d.match(/iphone os/i) == "iphone os";
	var h = d.match(/midp/i) == "midp";
	var e = d.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
	var g = d.match(/ucweb/i) == "ucweb";
	var a = d.match(/android/i) == "android";
	if (d.indexOf("android") > 0) {
		a = true
	}
	var b = d.match(/windows ce/i) == "windows ce";
	var k = d.match(/windows mobile/i) == "windows mobile";
	if (i || j || h || e || g || a || b || k) {
		var f = window.location.href;
		var c = "6hch001.com";
		if (f.indexOf(c) != -1) {
			window.location.href = "http://m.6hch001.com"
		} else {
			window.location.href = "http://m.6hch.com"
		}
	} else {
		window.location.href = "index.html"
	}
};