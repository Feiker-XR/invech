function SetHome(e) {
	document.all ? (document.body.style.behavior = "url(#default#homepage)", document.body.setHomePage(e)) : alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!")
}
function addFavorite2() {
	var e = window.location,
		t = document.title,
		i = navigator.userAgent.toLowerCase();
	if (i.indexOf("360se") > -1) alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
	else if (i.indexOf("msie 8") > -1) window.external.AddToFavoritesBar(e, t);
	else if (document.all) try {
		window.external.addFavorite(e, t)
	} catch (e) {
		alert("您的浏览器不支持,请按 Ctrl+D 手动收藏!")
	} else window.sidebar ? window.sidebar.addPanel(t, e, "") : alert("您的浏览器不支持,请按 Ctrl+D 手动收藏!")
}
function currentDay(e) {
	var t = e.split("-");
	return parseInt(t[1]) + "/" + (e = parseInt(t[2]))
}
function getDate() {
	var e = new Date;
	return e.getFullYear() + "-" + (e.getMonth() + 1) + "-" + e.getDate() + " " + e.getHours() + ":" + e.getMinutes() + ":" + e.getSeconds()
}
function ifNumIsNull(e, t) {
	return "" == e ? (0 != $(t).find(".errorbox").length && $(t).find(".errorbox").remove(), $(t).find(".rowbox2").append("<span class='errorbox' style='font-size:11px;color:orangered;'>开奖号码未开出，请尝试刷新页面或稍后再试！</span>"), $(t).find(".kajianhao").hide(), !0) : ($(t).find(".errorbox").hide(), $(t).find(".kajianhao").show(), !1)
}
function setTextColor(e) {
	listColor = "#" + e, $("#jrsmhmtj table tr:odd").find("td").css("background", listColor)
}
var config = {
	publicUrl: publicUrl,
	listTime: 2e3,
	firstLoad: !1,
	ifdebug: !1,
	ifScalse: .782
},
	lotCode = {
		pk10: 10001,
		aozxy10: 10012,
		jisusc: 10037,
		cqssc: 10002,
		cqqxc: 10050,
		tjssc: 10003,
		xjssc: 10004,
		aozxy5: 10010,
		jisussc: 10036,
		gdklsf: 10005,
		aozxy8: 10011,
		tjklsf: 10034,
		cqxync: 10009,
		gxklsf: 10038,
		gdsyxw: 10006,
		jxef: 10015,
		jsef: 10016,
		ahef: 10017,
		shef: 10018,
		lnef: 10019,
		hbef: 10020,
		cqef: 10021,
		gxef: 10022,
		jlef: 10023,
		nmgef: 10024,
		zjef: 10025,
		sdsyydj: 10008,
		jsksan: 10007,
		gxft: 10026,
		jlft: 10027,
		hebft: 10028,
		nmgft: 10029,
		ahft: 10030,
		fjft: 10031,
		hubft: 10032,
		bjft: 10033,
		aozxy20: 10013,
		bjkl8: 10014,
		twbg: 10047,
		fcssq: 10039,
		cjdlt: 10040,
		fcsd: 10041,
		fcqlc: 10042,
		pailie3: 10043,
		pailie5: 10044,
		qxc: 10045,
		egxy28: 10046,
		xingyft: 10035
	};
$(function() {
	if ($("#littleimg").length >= 1 && "index" != $("#ifindex").val() && (tools.bannerImg(), $("#littleimg").find(".swiper-container").addClass("swiperother")), publicmethod.fixBox(), tools.noAPP(), $(".wxkefuicon").on("mouseover", function() {
		$(".wxewmicon").css("display", "inline-block")
	}), $(".wxkefuicon").on("mouseout", function() {
            $(".wxewmicon").css("display", "none")
	}), $("#localyears").text((new Date).getFullYear()), $(".fankuicon").live("click", function() {
		if ("" != localStorage.current_time && void 0 != localStorage.current_time) {
			var e = localStorage.current_time,
				t = getDate(),
				i = e.replace("-", "/"),
				n = t.replace("-", "/");
			i = new Date(i.replace("-", "/")).getTime(), ((n = new Date(n.replace("-", "/")).getTime()) - i) / 1e3 / 60 <= 10 ? ($("#info1").hide(), $("#info2").hide(), $("#info3").show()) : ($("#btn_submit").show(), $("#info3").hide(), $("#info2").hide(), $("#info1").show())
		} else $("#btn_submit").show(), $("#info3").hide(), $("#info2").hide(), $("#info1").show()
	}), $("#btn_submit").live("click", function() {
		var e = $("#nickName").val(),
			t = $("#linkType").val(),
			i = parseInt(t),
			n = $("#linkNumber").val(),
			o = $("#advice").val();
		yonghufankui.listData(e, i, n, o)
	}), "index" == $("#ifindex").val() || $("#user_adv").load("../public/user_adv.html", function() {}), $("#soundSet").on("click", ".soundbtn", function(e) {
		$(this).find(".soundpanel").show("200"), e.stopPropagation()
	}), $(".bodybox").on("click", function(e) {
		$(this).parent().parent().find(".soundpanel").hide("200")
	}), $("#soundSet").on("click", ".close", function(e) {
		$(this).parent().parent().find(".soundpanel").hide("200"), e.stopPropagation()
	}), $("#soundSet").on("click", "input", function() {
		"none" == $(this).val() ? $("#soundSet").find(".soundicon").addClass("stopsound") : ($("#soundSet").find(".soundicon").removeClass("stopsound"), $("#soundSet").find("audio").attr("src", "../../media/" + $(this).val() + ".wav"))
	}), "operator" == $("#operator").val() && $(window).on("scroll", function() {
		$(this).scrollTop() > 195 ? $(".haomabox").addClass("fixedHead") : $(".haomabox").removeClass("fixedHead")
	}), setTimeout(function() {
		try {
			tools.addSund()
		} catch (e) {}
	}, 1e3), "noLoad" == $("#ofNoLoad").val());
	else try {
		loadotherData()
	} catch (e) {}
	setTimeout(function() {
		config.firstLoad = !0
	}, 2e3), tools.initListen()
});
var publicUrl = config.publicUrl,
	yonghufankui = {},
	publicmethod = {},
	tools = {};
yonghufankui.listData = function(e, t, i, n) {
	var o = {
		nickName: e,
		linkType: t,
		linkNumber: i,
		fedBack: n,
		source: window.location.href
	};
	$.ajax({
		url: publicUrl + "fedBack/saveFedBack.do",
		type: "GET",
		data: o,
		success: function(e) {
			alert("dandu"), $("#btn_submit").hide(), $("#btn_submiting").show(), yonghufankui.createList(e)
		},
		error: function(e) {
			console.log("data error")
		}
	})
}, yonghufankui.createList = function(e) {
	if ($("#btn_submiting").hide(), "0" == (e = JSON.parse(e)).errorCode) {
		var t = getDate();
		localStorage.current_time = t, $("#info1").hide(), $("#info2").show()
	}
}, tools.addSund = function() {
	$("#soundSet").empty(), $("#soundSet").append('<div class="soundbtn"><i>铃声设置</i><div class="soundicon">\t<audio src="../../media/RING_01.wav"  controls="controls" id="audioid">\t\tYour browser does not support the audio tag.\t</audio></div><div class="soundpanel">\t<div class="close"></div>\t<div class="soundlist">\t\t<ul>\t\t\t<li><label><input type="radio" name="sound" value="none">&nbsp;不提示(默认)</label></li>\t\t\t<li><label><input type="radio" name="sound" value="RING_01"  checked="checked">&nbsp;声音一(闹钟铃)</label></li>\t\t\t<li><label><input type="radio" name="sound" value="RING_02">&nbsp;声音二(上课铃)</label></li>\t\t\t<li><label><input type="radio" name="sound" value="RING_03">&nbsp;声音三(打锣声)</label></li>\t\t\t<li><label><input type="radio" name="sound" value="RING_04">&nbsp;声音四(打鼓声)</label></li>\t\t\t<li><label><input type="radio" name="sound" value="RING_05">&nbsp;声音五(点滴声)</label></li>\t\t\t<li>\t\t\t\t提示时间：\t\t\t\t<select>\t\t\t\t\t<option value="5"  selected="selected">开奖前5秒</option>\t\t\t\t\t<option value="20">开奖前20秒</option>\t\t\t\t\t<option value="10">开奖前10秒</option>\t\t\t\t\t<option value="30">开奖前30秒</option>\t\t\t\t\t<option value="40">开奖前40秒</option>\t\t\t\t\t<option value="50">开奖前50秒</option>\t\t\t\t\t<option value="60">开奖前60秒</option>\t\t\t\t\t<option value="begin">开奖后</option>\t\t\t\t</select>\t\t\t</li>\t\t</ul>\t</div></div></div>')
}, publicmethod.fixBox = function() {
	var e = $(".fixedgoBack").find(".fix1200"),
		t = $(".fixedgoBack").find(".leftright");
	$(e).empty(), $(t).empty();

}, publicmethod.insertHeadPk10 = function(e, t) {
	var i = tools.parseObj(e);
	if ("100002" == i.result.businessCode) throw new Error("error");
	if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
	$(".nextIssue").text(i.drawIssue), $(".preDrawIssue").text(i.preDrawIssue);
	var n = i.preDrawCode.split(","),
		o = i.totalCount;
	$(".totalCount").text(o), $(".drawCount").text(i.drawCount), $(".sdrawCount").text(o - 1 * i.drawCount);
	for (var a = "", s = 0, r = $(".longhu").find("td").length; s < r; s++) switch (s) {
	case 0:
		a += "<td>" + ("0" == i.firstDT ? "龙" : "虎") + "</td>";
		break;
	case 1:
		a += "<td>" + ("0" == i.secondDT ? "龙" : "虎") + "</td>";
		break;
	case 2:
		a += "<td>" + ("0" == i.thirdDT ? "龙" : "虎") + "</td>";
		break;
	case 3:
		a += "<td>" + ("0" == i.fourthDT ? "龙" : "虎") + "</td>";
		break;
	case 4:
		a += "<td>" + ("0" == i.fifthDT ? "龙" : "虎") + "</td>"
	}
	return $(".longhu").html(""), $(".longhu").append(a), $(".sumFS").text(i.sumFS), $(".sumBigSamll").text("0" == i.sumBigSamll ? "大" : "小"), $(".sumSingleDouble").text("0" == i.sumSingleDouble ? "单" : "双"), tools.countDown(i.drawTime, i.serverTime, t), animateMethod.pk10end(n, t), $("#waringbox").hide(300), clearInterval(animateID[t]), delete animateID[t], setTimeout(function() {
		tools.ifCheckedOnToday() && loadotherData()
	}, config.listTime), i.preDrawCode
}, publicmethod.insertHeadSsC = function(e, t) {
	var i = tools.parseObj(e);
	if ("100002" == i.result.businessCode) throw new Error("error");
	if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
	var n = i.totalCount;
	if ($(t).find(".preDrawIssue").text(i.preDrawIssue), $(t).find(".nextIssue").text(i.drawIssue), void 0 !== $("#drawTime").val()) {
		$("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8)), $(t).find("#sumNum").val(i.sumNum), $(t).find("#sumSingleDouble").val(0 == i.sumSingleDouble ? "单" : "双"), $(t).find("#sumBigSmall").val(0 == i.sumBigSmall ? "大" : "小");
		var o = "";
		"0" == i.dragonTiger ? o = "龙" : "1" == i.dragonTiger ? o = "虎" : "2" == i.dragonTiger && (o = "和"), $(t).find("#dragonTiger").val(o)
	}
	$(t).find(".totalCount").text(n), $(t).find(".drawCount").text(i.drawCount), $(t).find(".sdrawCount").text(1 * n - 1 * i.drawCount), config.ifdebug && console.log("nextIssue:" + localStorage.nextIssue), $(".lenresinli").removeClass("checked"), tools.countDown(i.drawTime, i.serverTime, t), animateMethod.sscAnimateEnd(i.preDrawCode, t), $("#waringbox").hide(300), setTimeout(function() {
		tools.ifCheckedOnToday() && loadotherData()
	}, config.listTime)
}, publicmethod.insertHeadKlsf = function(e, t) {
	var i = tools.parseObj(e);
	if ("100002" == i.result.businessCode) throw new Error("error");
	if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
	var n = i.totalCount;
	$(t).find(".preDrawIssue").text(i.preDrawIssue), $(t).find(".nextIssue").text(i.drawIssue), $(t).find(".drawCount").text(i.drawCount), $(".totalCount").text(n), $(t).find(".sdrawCount").text(1 * n - 1 * i.drawCount), $(t).find(".sumNum").text(i.sumNum), $(t).find(".sumSingleDouble").text(0 == i.sumSingleDouble ? "单" : "双"), $(t).find(".sumBigSmall").text(0 == i.sumBigSmall ? "大" : "小"), $(t).find(".lastBigSmall").text(0 == i.lastBigSmall ? "尾大" : "尾小");
	"0" == i.dragonTiger || ("1" == i.dragonTiger || i.dragonTiger), $(t).find(".firstDragonTiger").text(0 == i.firstDragonTiger ? "龙" : "虎"), $(t).find(".secondDragonTiger").text(0 == i.secondDragonTiger ? "龙" : "虎"), $(t).find(".thirdDragonTiger").text(0 == i.thirdDragonTiger ? "龙" : "虎"), $(t).find(".fourthDragonTiger").text(0 == i.fourthDragonTiger ? "龙" : "虎"), void 0 !== $("#drawTime").val() && $("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8)), tools.countDown(i.drawTime, i.serverTime, t), animateMethod.sscAnimateEnd(i.preDrawCode, t);
	var o = i.preDrawCode.split(",");
	"#gxklsf" == t && tools.gxKaiBg(o, t), $("#waringbox").hide(300), setTimeout(function() {
		tools.ifCheckedOnToday() && loadotherData()
	}, config.listTime)
}, publicmethod.insertHead11xw = function(e, t) {
	var i = tools.parseObj(e);
	if ("100002" == i.result.businessCode) throw new Error("error");
	if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
	var n = i.totalCount;
	$(t).find(".preDrawIssue").text(i.preDrawIssue), $(t).find(".nextIssue").text(i.drawIssue), $(t).find(".drawCount").text(i.drawCount), $(".totalCount").text(n), $(t).find(".sdrawCount").text(1 * n - 1 * i.drawCount), $(t).find(".sumNum").text(i.sumNum), $(t).find(".sumSingleDouble").text(0 == i.sumSingleDouble ? "单" : "双"), $(t).find(".sumBigSmall").text(0 == i.sumBigSmall ? "大" : "小"), $(t).find(".lastBigSmall").text(0 == i.lastBigSmall ? "尾大" : "尾小");
	"0" == i.dragonTiger || ("1" == i.dragonTiger || i.dragonTiger), void 0 !== $("#drawTime").val() && ($("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8)), $(t).find("#sumNum").val(i.sumNum), $(t).find("#sumSingleDouble").val(typeOf("dsh", i.sumSingleDouble)), $(t).find("#sumBigSmall").val(typeOf("dxh", i.sumBigSmall))), $(t).find(".behindThree").text(typeOf("san", i.behindThree)), $(t).find(".betweenThree").text(typeOf("san", i.betweenThree)), $(t).find(".lastThree").text(typeOf("san", i.lastThree)), $(".lenresinli").removeClass("checked"), tools.countDown(i.drawTime, i.serverTime, t), animateMethod.sscAnimateEnd(i.preDrawCode, t), $("#waringbox").hide(300), setTimeout(function() {
		setTimeout(function() {
			tools.ifCheckedOnToday() && loadotherData()
		}, 1e3)
	}, config.listTime)
}, publicmethod.insertHeadJsk3 = function(e, t) {
	var i = tools.parseObj(e);
	if ("100002" == i.result.businessCode) throw new Error("error");
	if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
	var n = i.totalCount;
	$(t).find(".preDrawIssue").text(i.preDrawIssue), $(t).find(".nextIssue").text(i.drawIssue), $(t).find(".sumNum").text(i.sumNum), $(t).find(".sumSingleDouble").text(0 == i.sumSingleDouble ? "单" : "双"), $(t).find(".sumBigSmall").text(0 == i.sumBigSmall ? "大" : "小"), $(t).find(".totalCount").text(n), $(t).find(".drawCount").text(i.drawCount), $(t).find(".sdrawCount").text(1 * n - 1 * i.drawCount);
	var o = "";
	"0" == i.dragonTiger ? o = "龙" : "1" == i.dragonTiger ? o = "虎" : "2" == i.dragonTiger && (o = "和"), $(t).find(".dragonTiger").text(o), tools.countDown(i.drawTime, i.serverTime, t), animateMethod.kuai3AnimateEnd(i.preDrawCode, t), $("#waringbox").hide(300), setTimeout(function() {
		tools.ifCheckedOnToday() && loadotherData()
	}, config.listTime)
}, publicmethod.insertHeadCqnc = function(e, t) {
	var i = tools.parseObj(e);
	if ("100002" == i.result.businessCode) throw new Error("error");
	if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
	var n = i.totalCount;
	$(t).find(".preDrawIssue").text(i.preDrawIssue), $(t).find(".nextIssue").text(i.drawIssue), $(t).find(".drawCount").text(i.drawCount), $(t).find(".totalCount").text(n), $(t).find(".sdrawCount").text(1 * n - 1 * i.drawCount), $(t).find(".sumNum").text(i.sumNum), $(t).find(".sumSingleDouble").text(0 == i.sumSingleDouble ? "单" : "双"), $(t).find(".sumBigSmall").text(0 == i.sumBigSmall ? "大" : "小"), $(t).find(".lastBigSmall").text(0 == i.lastBigSmall ? "尾大" : "尾小");
	"0" == i.dragonTiger || ("1" == i.dragonTiger || i.dragonTiger), $(t).find(".firstDragonTiger").text(0 == i.firstDragonTiger ? "龙" : "虎"), $(t).find(".secondDragonTiger").text(0 == i.secondDragonTiger ? "龙" : "虎"), $(t).find(".thirdDragonTiger").text(0 == i.thirdDragonTiger ? "龙" : "虎"), $(t).find(".fourthDragonTiger").text(0 == i.fourthDragonTiger ? "龙" : "虎"), tools.countDown(i.drawTime, i.serverTime, t), animateMethod.cqncAnimateEnd(i.preDrawCode, t), $("#waringbox").hide(300), setTimeout(function() {
		tools.ifCheckedOnToday() && loadotherData()
	}, config.listTime)
}, publicmethod.insertHeadBjkl8 = function(e, t) {
	var i = tools.parseObj(e);
	if ("100002" == i.result.businessCode) throw new Error("error");
	if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
	var n = i.totalCount;
	$(t).find(".preDrawIssue").text(i.preDrawIssue), $(t).find(".nextIssue").text(i.drawIssue), $(t).find(".drawCount").text(i.drawCount), $(t).find(".totalCount").text(n), $(t).find(".sdrawCount").text(1 * n - 1 * i.drawCount), $(t).find(".sumNum").text(i.sumNum), $(t).find(".sumBigSmall").text(typeOf("dxh", i.sumBigSmall)), $(t).find(".sumSingleDouble").text(typeOf("dsh", i.sumSingleDouble)), $(t).find(".singleDoubleCount").text(typeOf("dsd", i.singleDoubleCount)), $(t).find(".frontBehindCount").text(typeOf("qhh", i.frontBehindCount)), $(t).find(".sumBsSd").text(typeOf("zhzh", i.sumBsSd)), $(t).find(".sumWuXing").text(typeOf("wuxing", i.sumWuXing)), void 0 !== $("#drawTime").val() && ($("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8)), $(t).find("#preDrawIssue").val(i.preDrawIssue)), tools.countDown(i.drawTime, i.serverTime, t);
	var o = i.preDrawCode + "," + i.sumNum;
	"#egxy" == t ? (animateMethod.sscAnimateEnd(o, t), tools.egxy28(t)) : (animateMethod.sscAnimateEnd(o, t), tools.bjkl8BagColor(o, t)), $("#waringbox").hide(300), setTimeout(function() {
		tools.ifCheckedOnToday() && loadotherData()
	}, config.listTime)
}, tools.ifselectedOpacity = function(e) {
	$(e).hasClass("selectedOpacity") ? ($(e).removeClass(), $(e).addClass("selectedOpacity")) : $(e).removeClass()
}, tools.bigOrSmall = function(e, t) {
	$("#jrsmhmtj .blueqiu li").each(function(i) {
		var n = $(this).text(),
			o = n % 2 == 0,
			a = n >= t;
		$(this).find("i").hide(), "xshm" == e ? (tools.ifselectedOpacity($(this)), $(this).addClass("gxnumblue"), (i + 1) % 10 == 0 && $(this).addClass("li_after"), "10038" == lotCode ? 1 == n || 4 == n || 7 == n || 10 == n || 13 == n || 16 == n || 19 == n ? $(this).addClass("gxnumred") : 3 != n && 6 != n && 9 != n && 12 != n && 15 != n && 18 != n && 21 != n || $(this).addClass("gxnumgreen") : "10011" == lotCode || "10005" == lotCode || "10034" == lotCode ? n >= 19 && $(this).addClass("numredkong") : $(this).addClass("sscnumblue"), $(this).find("i").show()) : "xsdx" == e ? (tools.ifselectedOpacity($(this)), a ? (21 == n ? $(this).addClass("bluetotle") : $(this).addClass("bluebig"), (i + 1) % 10 == 0 && $(this).addClass("bluebig li_after")) : ($(this).addClass("bluesmall"), (i + 1) % 10 == 0 && $(this).addClass("bluesmall li_after"))) : "xsds" == e && (tools.ifselectedOpacity($(this)), o ? ($(this).addClass("blueeven"), (i + 1) % 10 == 0 && $(this).addClass("blueeven li_after")) : (21 == n && $(this).addClass("bluetotle"), $(this).addClass("bluesingular"), (i + 1) % 10 == 0 && $(this).addClass("bluesingular li_after")))
	})
}, tools.bigOrSmallTot = function(e, t) {
	$("#jrsmhmtj .blueqiu li").each(function(i) {
		var n = $(this).text(),
			o = n % 2 == 0,
			a = n >= t;
		$(this).find("i").hide(), "xshm" == e ? (tools.ifselectedOpacity($(this)), $(this).addClass("sscnumblue"), (i + 1) % 10 == 0 && $(this).addClass("li_after"), 19 != n && 20 != n || $(this).addClass("numred"), $(this).find("i").show()) : "xsdx" == e ? (tools.ifselectedOpacity($(this)), a ? (11 == n ? $(this).addClass("bluetotle") : $(this).addClass("bluebig"), (i + 1) % 10 == 0 && $(this).addClass("bluebig li_after")) : ($(this).addClass("bluesmall"), (i + 1) % 10 == 0 && $(this).addClass("bluesmall li_after"))) : "xsds" == e && (tools.ifselectedOpacity($(this)), o ? ($(this).addClass("blueeven"), (i + 1) % 10 == 0 && $(this).addClass("blueeven li_after")) : (11 == n ? $(this).addClass("bluetotle") : $(this).addClass("bluesingular"), (i + 1) % 10 == 0 && $(this).addClass("bluesingular li_after")))
	})
}, tools.parseObj = function(e) {
	var t = null;
	return "object" != typeof e ? t = JSON.parse(e) : (t = JSON.stringify(e), t = JSON.parse(t)), t
}, tools.bigOrSmallXync = function(e, t) {
	$("#jrsmhmtj .blueqiu li").each(function(i) {
		var n = $(this).text(),
			o = n % 2 == 0,
			a = n > t;
		"xshm" == e ? (tools.ifselectedOpacity($(this)), $(this).addClass("ncnum" + n), (i + 1) % 10 == 0 && $(this).addClass("li_after")) : "xsdx" == e ? (tools.ifselectedOpacity($(this)), a ? ($(this).addClass("bluebig"), (i + 1) % 10 == 0 && $(this).addClass("bluebig li_after")) : ($(this).addClass("bluesmall"), (i + 1) % 10 == 0 && $(this).addClass("bluesmall li_after"))) : "xsds" == e && (tools.ifselectedOpacity($(this)), o ? ($(this).addClass("blueeven"), (i + 1) % 10 == 0 && $(this).addClass("blueeven li_after")) : ($(this).addClass("bluesingular"), (i + 1) % 10 == 0 && $(this).addClass("bluesingular li_after")))
	})
}, tools.playSound = function(e) {
	var t = $("#soundSet").find("input:[checked='checked']").val();
	if ("none" != t && void 0 != t) {
		var i = $("#audioid");
		"begin" == e && "begin" == $("#soundSet").find("select").val() ? i[0].play() : $("#soundSet").find("select").val() == e - 1 && i[0].play()
	}
}, tools.repeatAjaxt = {
	kuai3: function(e) {
		clearInterval(animateID[e]), setTimeout(function() {
			ajaxRequst($(e).find(".nextIssue").text(), $(e).attr("id"))
		}, 1e3)
	},
	qiu: function(e) {
		clearInterval(animateID[e]);
		var t = "";
		$(e).find(".kajianhao li").each(function() {
			t += $(this).text() + ","
		}), animateMethod.sscAnimateEnd(t, e), setTimeout(function() {
			ajaxRequst($(e).find(".nextIssue").text(), $(e).attr("id"))
		}, 1e3)
	},
	pk10: function(e) {
		clearInterval(animateID[e]), setTimeout(function() {
			ajaxRequst($(".nextIssue").text())
		}, 1e3)
	},
	cqnc: function(e) {
		clearInterval(animateID[e]), setTimeout(function() {
			ajaxRequst($(".nextIssue").text())
		}, 1e3)
	}
}, tools.repeatIndexAjax = {
	kuai3: function(e) {
		setTimeout(function() {
			ajaxRequst($(e).find(".nextIssue").text(), $(e).attr("id"))
		}, 1e3)
	},
	qiu: function(e) {
		var t = "";
		$(e).find(".kajianhao li").each(function() {
			t += $(this).text() + ","
		}), animateMethod.sscAnimateEnd(t, e), setTimeout(function() {
			ajaxRequst($(e).find(".nextIssue").text(), $(e).attr("id"))
		}, 1e3)
	},
	qiuam: function(e) {
		var t = "";
		$(e).find(".kajianhao li").each(function() {
			t += $(this).text() + ","
		}), animateMethod.sscAnimateEnd(t, e)
	},
	pk10: function(e) {
		setTimeout(function() {
			ajaxRequst($(e).find(".nextIssue").text(), $(e).attr("id"))
		}, 1e3)
	},
	cqnc: function(e) {
		clearInterval(animateID[e]), setTimeout(function() {
			ajaxRequst($(".nextIssue").text())
		}, 1e3)
	}
}, tools.bannerImg = function(e) {
	var t, i = e.length;
	"index" != $("#ifindex").val() && (t = "../../img/banner/img03.jpg");
	var n = "";
	"index" != $("#ifindex").val() ? n = '' : $(e).each(function(e) {
		n += '<div class="swiper-slide"><a href="' + this.link + '" target="_blank"><img src="' + config.imgUrl + this.image + '"></a></div>'
	});
	var o = '<div class="device"><div class="swiper-container"><div class="swiper-wrapper">' + n + '</div></div><div class="pagination"></div></div>';
	$("#littleimg").empty(), i <= 1 ? $("#littleimg").append(n) : $("#littleimg").append(o);
	var a = new Swiper(".swiper-container", {
		pagination: ".pagination",
		loop: !0,
		freeMode: !0,
		grabCursor: !0,
		paginationClickable: !0,
		autoplay: 4500,
		effect: "fade",
		fade: {
			crossFade: !0
		},
		autoplayDisableOnInteraction: !1,
		onSlideChangeStart: function(e) {
			$(".device").css("background-color", "#fff")
		}
	});
	$(".arrow-left").on("click", function(e) {
		e.preventDefault(), a.swipePrev()
	}), $(".arrow-right").on("click", function(e) {
		e.preventDefault(), a.swipeNext()
	})
}, tools.advertisImg = function(e) {
	if ($("#advertisebox").length > 0) {
		var t = function(e, t) {
				return '<div><a class="logobox guanggao1" target="_blank" href="' + e + '"><img src="' + t + '" alt="" /></a></div>'
			};
		$("#advertisebox").empty(), $(e).each(function() {
			$("#advertisebox").append(t(this.link, config.imgUrl + "" + this.image))
		})
	}
	try {
		"" != e[0].noticeContent && void 0 != e[0].noticeContent ? $("#noticeContent").text(e[0].noticeContent) : $("#hotbox").hide()
	} catch (e) {
		$("#hotbox").hide()
	}
},tools.countDown = function(e, t, i) {
	var n = e.replace("-", "/"),
		t = t.replace("-", "/");
	n = n.replace("-", "/"), t = t.replace("-", "/");
	var o = $(i).find(".hour"),
		a = $(i).find(".minute"),
		s = $(i).find(".second"),
		r = $(i).find(".opentyle"),
		l = $(i).find(".cuttime"),
		d = (new Date(n) - new Date(t)) / 1e3,
		u = !0,
		f = new Date,
		c = setInterval(function() {
			var e = Math.abs(new Date - f) / 1e3;
			if (f = new Date, (e = e.toString().split("."))[0] > 1 && (d -= e[0]), u ? (u = !1, tools.playSound("begin")) : tools.playSound(d), d > 1) {
				d -= 1;
				var t = Math.floor(d / 3600),
					n = Math.floor(d / 60 % 60),
					m = Math.floor(d % 60);
				$(o).text(t < 10 ? "0" + t : t), $(a).text(n < 10 ? "0" + n : n), $(s).text(m < 10 ? "0" + m : m), t <= 0 ? ($(i).find(".hourtxt").hide(), $(o).hide()) : ($(i).find(".hourtxt").show(), $(o).show()), $(r).hide(), $(l).css({
					display: "inline-block"
				})
			} else $(r).show(), $(l).hide(), clearInterval(c), setTimeout(function() {
				ajaxRequst($(i).find(".nextIssue").text(), i)
			}, 1e3)
		}, 1e3)
}, tools.ifCheckedOnToday = function() {
	var e = null;
	if (!$("#dateframe").length < 1) {
		var t = $(".listheadrl").find(".checked"),
			i = $("#dateframe").find(".date").val();
		e = "today" == $(t).attr("id") && i == tools.getDate()
	} else e = !0;
	return !(!e || !config.firstLoad)
}, tools.getDate = function() {
	var e = new Date,
		t = e.getFullYear(),
		i = e.getMonth() + 1,
		n = e.getDate();
	e.getHours(), e.getMinutes(), e.getSeconds();
	return t + "-" + i + "-" + n
},
tools.insertVideo = function() {
	var e = 3600 * $("#pk10 .cuttime").find(".hour").text() + 60 * $("#pk10 .cuttime").find(".minute").text() + 1 * $("#pk10 .cuttime").find(".second").text() - 1;
		console.log(e)

	"-1" == e && (e = 0), $("iframe")[0].contentWindow.startcountdown(e);
	var t = "",
		i = $("#pk10 #jnumber").find("li");
	$(i).each(function() {
		t += $(this).text() + ","
	});
	var n = null;
	n = t.length < 11 ? "5,6,3,4,8,7,9,10,2,1" : t.substring(0, t.length - 1), $("iframe")[0].contentWindow.showcurrentresult(n), $(".animate iframe").contents().find("#currentdrawid").text($("#pk10").find(".drawCount").text()), $(".animate iframe").contents().find("#nextdrawtime").text($("#pk10").find(".preDrawIssue").text()), $(".animate iframe").contents().find("#stat1_1").text($("#pk10").find(".sumFS").text()), $(".animate iframe").contents().find("#stat1_2").text($("#pk10").find(".sumBigSamll").text()), $(".animate iframe").contents().find("#stat1_3").text($("#pk10").find(".sumSingleDouble").text());
	var o = $("#pk10 .longhu").find("td");
	$(".animate iframe").contents().find("#stat2_1").text($(o).eq(0).text()), $(".animate iframe").contents().find("#stat2_2").text($(o).eq(1).text()), $(".animate iframe").contents().find("#stat2_3").text($(o).eq(2).text()), $(".animate iframe").contents().find("#stat2_4").text($(o).eq(3).text()), $(".animate iframe").contents().find("#stat2_5").text($(o).eq(4).text());

},
tools.testWWW = function() {
	if (-1 != window.location.href.indexOf("x.com")) {
		$(".advertisebox").hide();
		"index" != $("#ifindex").val() ? $("#littleimg").empty().append("<img src='../../img/banner/neiye.png'></img>") : $("#littleimg").empty().append("<img src='../../img/banner/shouye.png'></img>"), $(".lasli").find(".phoneicon").attr("href", "http://m.1680100.com"), $(".6hch").attr("href", "http://6hch001.com"), $(".zzwzdh").attr("href", "http://1680100.com/html/public/home.html")
	} else "index" == $("#ifindex").val() && indexObj.loadBanner(), $(".advertisebox").show()
}, tools.noAPP = function() {
	var e = tools.YM();
	"x" != e && "x" != e && "x" != e && "x" != e && "x" != e || ($(".kair_right").html("<img src='../../img/jusc.jpg'/>"), $(".fix1200").find(".backold").hide())
}, tools.clearHC = function() {
	config.version, $("link").attr("href");
	$("link").each(function() {
		var e = $(this).attr("href"),
			t = new Date;
		e = e + "?v=" + t.getFullYear() + t.getMonth() + 1 + t.getDate(), $(this).attr("href", e)
	})
}, tools.setPK10TB = function() {
	pk10jiuchuo = setInterval(function() {
		-1 != $("#videobox").css("z-index") && ("00:00" != $(".animate iframe").contents().find(".countdownnum").text() ? (tools.insertVideo(), config.ifdebug && console.log("纠错....")) : config.ifdebug && (console.log("开始开奖了...."), console.log("停止纠错....")))
	}, 5e3)
}, tools.operatorTime = function(e, t) {
	var i = e.replace("-", "/"),
		t = t.replace("-", "/");
	return i = i.replace("-", "/"), t = t.replace("-", "/"), (new Date(i).getTime() - new Date(t).getTime()) / 1e3
}, tools.gxKaiBg = function(e, t) {
	for (var i = 0; i < e.length; i++) 1 == e[i] || 4 == e[i] || 7 == e[i] || 10 == e[i] || 13 == e[i] || 16 == e[i] || 19 == e[i] ? $(t).find(".gx_kajianhao").find("li").eq(i).addClass("numred") : 3 != e[i] && 6 != e[i] && 9 != e[i] && 12 != e[i] && 15 != e[i] && 18 != e[i] && 21 != e[i] || $(t).find(".gx_kajianhao").find("li").eq(i).addClass("numgreen")
}, tools.egxy28 = function(e) {
	$(e).find(".kajianhao ul").find("li:last-child").addClass("numred")
}, tools.bjkl8BagColor = function(e, t) {
	var i = e.split(",");
	i.splice(i.length - 1, 1);
	for (var n = 0; n < i.length - 1; n++) i[n] >= 41 && $(t).find(".kajianhao ul").find("li").eq(n).addClass("numWeightblue");
	$(t).find(".kajianhao ul").find("li:last-child").addClass("numOrange")
}, tools.setTimefun_k3 = function() {
	setTimeout(function() {
		if (void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index")) {
			var e, t = "",
				i = "",
				n = ($("#cqSsc").find(".kajianhao li").length, 0),
				o = $("#cqSsc").find(".preDrawIssue").text(),
				a = parseInt(o),
				s = 0 + $(".drawCount").text(),
				r = 3600 * $("#timebox").find("hour").text() + 60 * $("#timebox").find(".minute").text() + 1 * $("#timebox").find(".second").text() - 2;
			"-1" == r && (r = 0), $("#cqSsc").find(".kajianhao").find("li").each(function(o) {
				t = $(this).attr("class"), e = t.substring(t.length - 1, t.length), o <= 2 && $("iframe").contents().find("#codetop").find("li").eq(o).text(e), i += e, n += parseInt(e)
			}), i = [].slice.call(i), $("iframe").contents().find(".nowDraw").text(s);
			var l = {
				preDrawCode: i,
				sumNum: n,
				sumBigSmall: sumBigSmall,
				drawIssue: a + 1,
				drawTime: drawTime,
				seconds: r
			};
			$("iframe")[0].contentWindow.k3v.stopVideo(l)
		}
	}, 2e3)
}, tools.setTimefun_ssc = function() {
	setTimeout(function() {
		if (void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index")) {
			var e = 3600 * $("#timebox").find(".hour").text() + 60 * $("#timebox").find(".minute").text() + 1 * $("#timebox").find(".second").text() - 1;
			"-1" == e && (e = 0);
			var t = $("#cqSsc").find(".kajianhao li").text(),
				i = {
					preDrawCode: [].slice.call(t),
					id: "#numBig",
					counttime: e,
					preDrawIssue: $(".preDrawIssue").text(),
					drawTime: $("#drawTime").val(),
					sumNum: $("#sumNum").val(),
					sumSingleDouble: $("#sumSingleDouble").val(),
					sumBigSmall: $("#sumBigSmall").val(),
					dragonTiger: $("#dragonTiger").val()
				};
			$("iframe")[0].contentWindow.sscAnimateEnd(i)
		}
	}, 1e3)
}, tools.setTimefun_cqnc = function() {
	setTimeout(function() {
		if (void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index")) {
			var e = 3600 * $("#timebox").find(".hour").text() + 60 * $("#timebox").find(".minute").text() + 1 * $("#timebox").find(".second").text() - 1;
			"-1" == e && (e = 0);
			var t = [];
			if ($("#klsf").find(".kajianhao li").each(function() {
				t.push(parseInt($(this).text()))
			}), console.log("开奖后：code数组1：" + t), t.length < 8 || NaN == t[0]) return void setTimeout(function() {
				tools.setTimefun_cqnc()
			}, 500);
			$(".preDrawIssue").text();
			var i = e;
			console.log("开奖后：code数组2：" + t), $("iframe")[0].contentWindow.stopanimate(t, i)
		}
	}, 1e3)
}, tools.setTimefun_shiyixw = function() {
	setTimeout(function() {
		void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index") && $("iframe")[0].contentWindow.k3v.stopVideo(tools.getSyxwData())
	}, 1500)
}, tools.getSyxwData = function() {
	var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
		t = [];
	return $("#shiyix5").find(".kajianhao li").each(function() {
		t.push(parseInt($(this).text()))
	}), {
		preDrawCode: t,
		sumNum: $("#sumNum").val(),
		sumBigSmall: $("#sumBigSmall").val(),
		sumSingleDouble: $("#sumSingleDouble").val(),
		drawIssue: $(".nextIssue").text(),
		drawTime: $("#drawTime").val(),
		preDrawTime: e
	}
}, tools.setTimefun_bjkl8 = function() {
	setTimeout(function() {
		if (void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index")) {
			var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
				t = [];
			$("#klsf").find(".kajianhao li").each(function() {
				t.push(parseInt($(this).text()))
			});
			var i = {
				preDrawCode: t,
				drawIssue: $("#preDrawIssue").val(),
				drawTime: $("#drawTime").val(),
				preDrawTime: e
			};
			$("iframe")[0].contentWindow.syxwV.stopVid(i)
		}
	}, 1500)
}, tools.setTimefun_pcEgg = function() {
	setTimeout(function() {
		if (void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index")) {
			var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
				t = [];
			$("#egxy").find(".kajianhao li").each(function(e) {
				e < 3 && t.push(parseInt($(this).text()))
			});
			var i = {
				numArr: t,
				nextIssue: $(".nextIssue").text(),
				drawTime: $("#drawTime").val(),
				preDrawTime: e
			};
			$("iframe")[0].contentWindow.pcEgg.stopVid(i)
		}
	}, 1500)
}, tools.setTimefun_gdklsf = function() {
	setTimeout(function() {
		if (void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index")) {
			var e = 3600 * $("#timebox").find("hour").text() + 60 * $("#timebox").find(".minute").text() + 1 * $("#timebox").find(".second").text() - 2,
				t = [];
			$("#klsf").find(".kajianhao li").each(function() {
				t.push(parseInt($(this).text()))
			});
			var i = {
				arr: t,
				thisIssue: $("#klsf").find(".preDrawIssue").text(),
				nextIssue: $("#klsf").find(".nextIssue").text(),
				nextTime: $("#klsf").find("#drawTime").val(),
				countdown: e
			};
			$("iframe")[0].contentWindow.fun.Trueresult(i.arr), $("iframe")[0].contentWindow.fun.fillHtml(i.thisIssue, i.nextIssue, i.nextTime, i.countdown)
		}
	}, 1500)
}, tools.setTimefun_gxklsf = function() {
	setTimeout(function() {
		if (void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index")) {
			var e = $("#timebox").find("hour").text(),
				t = $("#timebox").find(".minute").text(),
				i = $("#timebox").find(".second").text(),
				n = e + ":" + t + ":" + i,
				o = [];
			$("#gxklsf").find(".kajianhao li").each(function() {
				o.push(parseInt($(this).text()))
			});
			var a = {
				numArr: o,
				thisIssue: $("#gxklsf").find(".preDrawIssue").text(),
				nextIssue: $("#gxklsf").find(".nextIssue").text(),
				drawTime: $("#gxklsf").find("#drawTime").val(),
				cutdonwTime: n
			};
			$("iframe")[0].contentWindow.gxklsf.stopVid(a)
		}
	}, 1500)
}, tools.setTimefun_fc3D = function() {
	setTimeout(function() {
		if (void 0 != $("#drawTime").val() && -1 != $("#videobox").css("z-index")) {
			var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
				t = [];
			$("#cqSsc").find(".kajianhao li").each(function() {
				t.push(parseInt($(this).text()))
			});
			var i = {
				preDrawCode: t,
				drawIssue: $("#preDrawIssue").val(),
				drawTime: $("#drawTime").val(),
				preDrawTime: e
			};
			$("iframe")[0].contentWindow.fc3d.stopVid(i)
		}
	}, 1500)
};
var listColor = "";
tools.initListen = function() {
	$("#jrsmhmtj").find("table").css("background", "#d4d4d4"), $("#selectcolor").on("click", "span", function() {
		$(this).addClass("select").siblings().removeClass(), 1 != $(this).children().length && (listColor = $(this).css("background-color"), $("#jrsmhmtj table tr:odd").find("td").css("background", listColor))
	})
}, tools.resetListColor = function() {
	"" != listColor && $("#jrsmhmtj table tr:odd").find("td").css("background", listColor)
}, tools.Msit = function() {
	$("#advertisebox").width()
}, tools.YM = function() {
	var e = window.location.href;
	return "www" == (e = e.split("//")[1].split("/")[0].split("."))[0] ? e = e[1] : "www" != e[0] && (e = e[0]), e
}, tools.advertisement = function() {
	$.ajax({
		url: publicUrl + "focusPicture/findPicture.php",
		type: "GET",
		dataType: "json",
		data: {
			type: "0",
			position: "1",
			sourceUrl: tools.YM()
		},
		timeout: 6e4,
		beforeSend: function() {
			$("#advertisebox").html('<div class="progress" style="display: block;margin-top:30px;width:100%;text-align:center;"><img src="../../img/icon/piaog.gif"></div>')
		},
		success: function(e) {
			"object" == typeof(e = e) || (e = JSON.parse(e)), "0" == e.errorCode && ("0" == e.result.businessCode ? tools.advertisImg(e.result.data) : $("#advertisebox").empty().text("数据加载异常！"))
		},
		error: function(e) {
			setTimeout(tools.advertisement(), 1e3)
		},
		complete: function(e, t) {
			null
		}
	})
}, tools.WWWD = function() {
	"x" == tools.YM() && $("#tryplay").hide()
}, tools.noAPP();