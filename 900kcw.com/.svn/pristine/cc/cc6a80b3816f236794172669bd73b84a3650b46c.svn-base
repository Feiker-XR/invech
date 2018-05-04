function ajaxRequst(e, t) {
	"#pk10" == t ? indexObj.ajaxpk10(e, lotCode.pk10, t) : "#cqSsc" == t ? indexObj.ajaxSsc(e, lotCode.cqssc, t) : "#tjSsc" == t ? indexObj.ajaxSsc_tj(e, lotCode.tjssc, t) : "#xjSsc" == t ? indexObj.ajaxSsc_xj(e, lotCode.xjssc, t) : "#gdklsf" == t ? indexObj.ajaxKlsf(e, lotCode.gdklsf, t) : "#kuai3" == t ? indexObj.ajaxKuai3(e, lotCode.jsksan, t) : "#shiyix5_sd" == t ? indexObj.shiyix5(e, lotCode.sdsyydj, t) : "#shiyix5_gd" == t && indexObj.shiyix5_gd(e, lotCode.gdsyxw, t)
}
function typeOf(e, t) {
	if ("rank" == e) switch (1 * t) {
	case 1:
		return "冠军";
	case 2:
		return "亚军";
	case 3:
		return "第三名";
	case 4:
		return "第四名";
	case 5:
		return "第五名";
	case 6:
		return "第六名";
	case 7:
		return "第七名";
	case 8:
		return "第八名";
	case 9:
		return "第九名";
	case 10:
		return "第十名";
	case 11:
		return "冠亚和"
	} else if ("state" == e) switch (1 * t) {
	case 1:
		return "单双";
	case 2:
		return "大小";
	case 3:
		return "龙虎"
	} else if ("san" == e) switch (1 * t) {
	case 0:
		return "杂六";
	case 1:
		return "半顺";
	case 2:
		return "顺子";
	case 3:
		return "对子";
	case 4:
		return "豹子"
	} else if ("seafood" == e) switch (1 * t) {
	case 1:
		return "鱼";
	case 2:
		return "虾";
	case 3:
		return "葫芦";
	case 4:
		return "金钱";
	case 5:
		return "蟹";
	case 6:
		return "鸡"
	} else if ("Indxh" == e) switch (1 * t) {
	case 0:
		return "大";
	case 1:
		return "小";
	case 2:
		return "和"
	}
}
$(function() {
	// $("#user_adv").load("../themes/168pc/user_adv.html", function() {
	// 	console.log("shshshshs")
	// 	// config.ifdebug && console.log("request is over!")
	// }), 
	"index" == $("#ifindex").val() && ($("#headdivbox").load("head.html", function() {
		config.ifdebug && console.log("request is over!"), $(".lfetmenuhid").stop().animate({
			top: "50px",
			height: "470px"
		}, "200"), setTimeout(function() {
			$("#lfetmenu1").addClass("lfetmenu1shadow")
		}, 500)
	}), $("#fooderbox").load("fooder.html", function() {
		config.ifdebug && console.log("request is over!")
	})), ajaxRequst("", "#pk10"), ajaxRequst("", "#cqSsc"), ajaxRequst("", "#tjSsc"), ajaxRequst("", "#xjSsc"), ajaxRequst("", "#gdklsf"), ajaxRequst("", "#shiyix5_sd"), ajaxRequst("", "#shiyix5_gd"), ajaxRequst("", "#kuai3"), 
		// indexObj.loadBannerNews(), indexObj.loadFangAanNews(), 
		$("#gotop").click(function() {
		return $("body,html").animate({
			scrollTop: 0
		}, 500), $(this).hide(), !1
	}), $(document).scroll(function() {
		$(this).scrollTop() > 10 ? $("#gotop").show() : $("#gotop").hide()
	})
});
var publicUrl = config.publicUrl,
	imgUrl = config.imgUrl,
	indexObj = new Object,
	indextools = {};
indexObj.ajaxpk10 = function(e, t, n) {
	var e = void 0 == e ? "" : e,
		a = !1;
	$.ajax({
		// url: publicUrl + "pks/getLotteryPksInfo.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/pk10",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.pk10OpenAnimate(n)
		},
		success: function(a) {
			try {
				indexObj.pk10Data(a, t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), a = !0
		},
		complete: function(t, r) {
			(a = !1) || "timeout" == r && setTimeout(function() {
				ajaxRequst(e, n)
			}, "1000")
		}
	})
}, indexObj.ajaxSsc = function(e, t, n) {
	var e = void 0 == e ? "" : e,
		a = !1;
	$.ajax({
		// url: publicUrl + "CQShiCai/getBaseCQShiCai.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/cqssc",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.sscAnimate(n)
		},
		success: function(a) {
			try {
				indexObj.sscData(a, t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), a = !0
		},
		complete: function(t, r) {
			(a = !1) || "timeout" == r && setTimeout(function() {
				ajaxRequst(e, n)
			}, "1000")
		}
	})
}, indexObj.ajaxSsc_tj = function(e, t, n) {
	var e = void 0 == e ? "" : e,
		a = !1;
	$.ajax({
		// url: publicUrl + "CQShiCai/getBaseCQShiCai.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/tjssc",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.sscAnimate(n)
		},
		success: function(a) {
			try {
				indexObj.sscData(a, t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), a = !0
		},
		complete: function(t, r) {
			(a = !1) || "timeout" == r && setTimeout(function() {
				ajaxRequst(e, n)
			}, "1000")
		}
	})
}, indexObj.ajaxSsc_xj = function(e, t, n) {
	var e = void 0 == e ? "" : e,
		a = !1;
	$.ajax({
		// url: publicUrl + "CQShiCai/getBaseCQShiCai.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/xjssc",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.sscAnimate(n)
		},
		success: function(a) {
			try {
				indexObj.sscData(a, t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), a = !0
		},
		complete: function(t, r) {
			(a = !1) || "timeout" == r && setTimeout(function() {
				ajaxRequst(e, n)
			}, "1000")
		}
	})
}, indexObj.ajaxKlsf = function(e, t, n) {
	var e = void 0 == e ? "" : e,
		a = !1;
	$.ajax({
		// url: publicUrl + "klsf/getLotteryInfo.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/gdkl10f",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.sscAnimate(n)
		},
		success: function(a) {
			try {
				indexObj.klsfData(a, t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), a = !0
		},
		complete: function(t, r) {
			(a = !1) || "timeout" == r && indextools.repeatAjax(e, n)
		}
	})
}, indexObj.ajaxCqnc = function(e, t, n) {
	var e = void 0 == e ? "" : e,
		a = !1;
	$.ajax({
		// url: publicUrl + "klsf/getLotteryInfo.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/gdkl10f",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.cqncAnimate(n)
		},
		success: function(t) {
			try {
				indexObj.cqncData(t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), a = !0
		},
		complete: function(t, r) {
			(a = !1) || "timeout" == r && indextools.repeatAjax(e, n)
		}
	})
}, indexObj.ajaxKuai3 = function(e, t, n) {
	e = void 0 == e ? "" : e, $.ajax({
		// url: publicUrl + "lotteryJSFastThree/getBaseJSFastThree.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/jsk3",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.kuai3Animate(n)
		},
		success: function(a) {
			try {
				indexObj.kuai3Data(a, t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), iferror = !0
		},
		complete: function(t, a) {
			iferror = !1, iferror || "timeout" == a && indextools.repeatAjax(e, n)
		}
	})
}, indexObj.shiyix5 = function(e, t, n) {
	var e = void 0 == e ? "" : e,
		a = !1;
	$.ajax({
		// url: publicUrl + "ElevenFive/getElevenFiveInfo.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/syydj",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.sscAnimate(n)
		},
		success: function(a) {
			try {
				indexObj.shiyix5Data(a, t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), a = !0
		},
		complete: function(t, r) {
			(a = !1) || "timeout" == r && indextools.repeatAjax(e, n)
		}
	})
}, indexObj.shiyix5_gd = function(e, t, n) {
	var e = void 0 == e ? "" : e,
		a = !1;
	$.ajax({
		// url: publicUrl + "ElevenFive/getElevenFiveInfo.php?issue=" + e,
		url: "http://www.900kcw.com/?r=home/lottery/gd11x5",
		type: "GET",
		// data: {
		// 	lotCode: t
		// },
		timeout: 6e4,
		beforeSend: function() {
			void 0 == animateID[n] && animateMethod.sscAnimate(n)
		},
		success: function(a) {
			try {
				indexObj.shiyix5Data(a, t, n), clearInterval(animateID[n]), delete animateID[n]
			} catch (t) {
				indextools.repeatAjax(e, n)
			}
		},
		error: function(t) {
			indextools.repeatAjax(e, n), a = !0
		},
		complete: function(t, r) {
			(a = !1) || "timeout" == r && indextools.repeatAjax(e, n)
		}
	})
}, indexObj.pk10Data = function(e, t, n) {
	var a = tools.parseObj(e);
	if ("100002" == a.result.businessCode) throw new Error("error");
	if (a = a.result.data, tools.operatorTime("" == a.drawTime ? "0" : a.drawTime, a.serverTime) <= 0) throw new Error("error");
	$(n).find(".opentyle").hide(), $(n).find(".cuttime").css({
		display: "inline-block"
	});
	var r = a.totalCount;
	$(n).find(".drawCount").text(a.drawCount), $(n).find(".sdrawCountnext").text(r - 1 * a.drawCount);
	$(n).find(".nextIssue").text();
	$(n).find(".nextIssue").text(a.drawIssue), $(n).find(".preDrawIssue").text(a.preDrawIssue), $("#drawCount1").text(a.drawCount), $("#sdrawCount1").text(r - 1 * a.drawCount);
	for (var o = "", i = 0, s = $(".longhu").find("td").length; i < s; i++) switch (i) {
	case 0:
		o += "<td>" + ("0" == a.firstDT ? "龙" : "虎") + "</td>";
		break;
	case 1:
		o += "<td>" + ("0" == a.secondDT ? "龙" : "虎") + "</td>";
		break;
	case 2:
		o += "<td>" + ("0" == a.thirdDT ? "龙" : "虎") + "</td>";
		break;
	case 3:
		o += "<td>" + ("0" == a.fourthDT ? "龙" : "虎") + "</td>";
		break;
	case 4:
		o += "<td>" + ("0" == a.fifthDT ? "龙" : "虎") + "</td>";
		break;
	case 5:
		o += "<td>" + a.sumFS + "</td>";
		break;
	case 6:
		o += "<td>" + ("0" == a.sumBigSamll ? "大" : "小") + "</td>";
		break;
	case 7:
		o += "<td>" + ("0" == a.sumSingleDouble ? "单" : "双") + "</td>"
	}
	$(".longhu").html(""), $(".longhu").append(o);
	var d = a.preDrawCode.split(",");
	tools.countDown(a.drawTime, a.serverTime, n), animateMethod.pk10end(d, n)
}, indexObj.sscData = function(e, t, n) {
	var a = tools.parseObj(e);
	if ("100002" == a.result.businessCode) throw new Error("error");
	if (a = a.result.data, tools.operatorTime("" == a.drawTime ? "0" : a.drawTime, a.serverTime) <= 0) throw new Error("error");
	var r = a.totalCount;
	$(n).find(".preDrawIssue").text(a.preDrawIssue), $(n).find(".nextIssue").text(a.drawIssue), $(n).find(".drawCount").text(a.drawCount), $(n).find(".sdrawCountnext").text(1 * r - 1 * a.drawCount), $(n).find(".sumNum").text(a.sumNum), $(n).find(".sumSingleDouble").text(0 == a.sumSingleDouble ? "单" : "双"), $(n).find(".sumBigSmall").text(0 == a.sumBigSmall ? "大" : "小");
	var o = "";
	"0" == a.dragonTiger ? o = "龙" : "1" == a.dragonTiger ? o = "虎" : "2" == a.dragonTiger && (o = "和"), $(n).find(".dragonTiger").text(o), $(n).find(".behindThree").text(typeOf("san", a.behindThree)), $(n).find(".betweenThree").text(typeOf("san", a.betweenThree)), $(n).find(".lastThree").text(typeOf("san", a.lastThree)), animateMethod.sscAnimateEnd(a.preDrawCode, n), tools.countDown(a.drawTime, a.serverTime, n)
}, indexObj.shiyix5Data = function(e, t, n) {
	var a = tools.parseObj(e);
	if ("100002" == a.result.businessCode) throw new Error("error");
	if (a = a.result.data, tools.operatorTime("" == a.drawTime ? "0" : a.drawTime, a.serverTime) <= 0) throw new Error("error");
	var r = a.totalCount;
	$(n).find(".preDrawIssue").text(a.preDrawIssue), $(n).find(".nextIssue").text(a.drawIssue), $(n).find(".drawCount").text(a.drawCount), $(n).find(".sdrawCountnext").text(1 * r - 1 * a.drawCount), $(n).find(".sumNum").text(a.sumNum), $(n).find(".sumSingleDouble").text(0 == a.sumSingleDouble ? "单" : "双"), $(n).find(".sumBigSmall").text(typeOf("Indxh", a.sumBigSmall));
	"0" == a.dragonTiger || ("1" == a.dragonTiger || a.dragonTiger), $(n).find(".behindThree").text(typeOf("san", a.behindThree)), $(n).find(".betweenThree").text(typeOf("san", a.betweenThree)), $(n).find(".lastThree").text(typeOf("san", a.lastThree));
	$(n).find(".nextIssue").text();
	animateMethod.sscAnimateEnd(a.preDrawCode, n), tools.countDown(a.drawTime, a.serverTime, n)
}, indexObj.kuai3Data = function(e, t, n) {
	var a = tools.parseObj(e);
	if ("100002" == a.result.businessCode) throw new Error("error");
	if (a = a.result.data, tools.operatorTime("" == a.drawTime ? "0" : a.drawTime, a.serverTime) <= 0) throw new Error("error");
	var r = a.totalCount;
	$(n).find(".preDrawIssue").text(a.preDrawIssue), $(n).find(".nextIssue").text(a.drawIssue), $(n).find(".sumNum").text(a.sumNum), $(n).find(".sumSingleDouble").text(0 == a.sumSingleDouble ? "单" : "双"), $(n).find(".sumBigSmall").text(0 == a.sumBigSmall ? "大" : "小"), $(n).find(".firstSeafood").text(typeOf("seafood", a.firstSeafood)), $(n).find(".secondSeafood").text(typeOf("seafood", a.secondSeafood)), $(n).find(".thirdSeafood").text(typeOf("seafood", a.thirdSeafood)), $(n).find(".drawCount").text(a.drawCount), $(n).find(".sdrawCount").text(r - 1 * a.drawCount);
	$(n).find(".dragonTiger").text(""), animateMethod.kuai3AnimateEnd(a.preDrawCode, n), tools.countDown(a.drawTime, a.serverTime, n)
}, indexObj.klsfData = function(e, t, n) {
	var a = tools.parseObj(e);
	if ("100002" == a.result.businessCode) throw new Error("error");
	if (a = a.result.data, tools.operatorTime("" == a.drawTime ? "0" : a.drawTime, a.serverTime) <= 0) throw new Error("error");
	var r = a.totalCount;
	$(n).find(".preDrawIssue").text(a.preDrawIssue), $(n).find(".nextIssue").text(a.drawIssue), $(n).find(".drawCount").text(a.drawCount), $(n).find(".sdrawCountnext").text(1 * r - 1 * a.drawCount), $(n).find(".sumNum").text(a.sumNum), $(n).find(".sumSingleDouble").text(0 == a.sumSingleDouble ? "单" : "双"), $(n).find(".sumBigSmall").text(typeOf("Indxh", a.sumBigSmall)), $(n).find(".lastBigSmall").text(0 == a.lastBigSmall ? "尾大" : "尾小");
	"0" == a.dragonTiger || ("1" == a.dragonTiger || a.dragonTiger), $(n).find(".firstDragonTiger").text(0 == a.firstDragonTiger ? "龙" : "虎"), $(n).find(".secondDragonTiger").text(0 == a.secondDragonTiger ? "龙" : "虎"), $(n).find(".thirdDragonTiger").text(0 == a.thirdDragonTiger ? "龙" : "虎"), $(n).find(".fourthDragonTiger").text(0 == a.fourthDragonTiger ? "龙" : "虎"), $(n).find(".numblue").each(function() {
		$(this).text() >= 19 && $(this).addClass("numred")
	}), animateMethod.sscAnimateEnd(a.preDrawCode, n), tools.countDown(a.drawTime, a.serverTime, n)
}, indexObj.cqncData = function(e, t) {
	var n = tools.parseObj(e);
	if ("100002" == n.result.businessCode) throw new Error("error");
	if (n = n.result.data, tools.operatorTime("" == n.drawTime ? "0" : n.drawTime, n.serverTime) <= 0) throw new Error("error");
	$(t).find(".preDrawIssue").text(n.preDrawIssue), $(t).find(".nextIssue").text(n.drawIssue), $(t).find(".drawCount").text(n.drawCount), $(t).find(".sdrawCountnext").text(84 - 1 * n.drawCount), $(t).find(".sumNum").text(n.sumNum), $(t).find(".sumSingleDouble").text(0 == n.sumSingleDouble ? "单" : "双"), $(t).find(".sumBigSmall").text(0 == n.sumBigSmall ? "大" : "小"), $(t).find(".lastBigSmall").text(0 == n.lastBigSmall ? "尾大" : "尾小");
	"0" == n.dragonTiger || ("1" == n.dragonTiger || n.dragonTiger), $(t).find(".firstDragonTiger").text(0 == n.firstDragonTiger ? "龙" : "虎"), $(t).find(".secondDragonTiger").text(0 == n.secondDragonTiger ? "龙" : "虎"), $(t).find(".thirdDragonTiger").text(0 == n.thirdDragonTiger ? "龙" : "虎"), $(t).find(".fourthDragonTiger").text(0 == n.fourthDragonTiger ? "龙" : "虎"), clearInterval(animateID[t]), animateMethod.cqncAnimateEnd(n.preDrawCode, t), tools.countDown(n.drawTime, n.serverTime, $(t)), $(t).find(".opentyle").hide(), $(t).find(".cuttime").css({
		display: "inline-block"
	})
},indexObj.loadBanner = function() {
	$.ajax({
		url: publicUrl + "focusPicture/findPicture.php",
		type: "GET",
		dataType: "json",
		data: {
			type: "0",
			position: "0",
			sourceUrl: tools.YM()
		},
		timeout: 6e4,
		beforeSend: function() {
			$("#bannerContent").text("努力加载中...")
		},
		success: function(e) {
			"object" == typeof(e = e) || (e = JSON.parse(e)), "0" == e.errorCode && ("0" == e.result.businessCode ? tools.bannerImg(e.result.data) : $("#bannerContent").empty().text("数据加载异常！"))
		},
		error: function(e) {
			$("#bannerContent").empty().text("正在加载..."), setTimeout(indexObj.loadBanner(), 1e3)
		},
		complete: function(e, t) {
			null
		}
	})
}, indexObj.defaultViewigm = function(e) {
	$(e).attr("src", "../../img/banner/banner01.jpg"), $(e).parent().css({
		"background-color": "#d70042"
	})
}, indextools.repeatAjax = function(e, t) {
	setTimeout(function() {
		ajaxRequst(e, t)
	}, "1000")
};