var publicUrl=config.publicUrl,imgUrl=config.imgUrl,indexObj=new Object,toolss= {};
$(function() {
	$("#headdivbox").load("../public/head.html", function() {
		config.ifdebug && console.log("request is over!")
	}), $("#fooderbox").load("../public/fooder.html", function() {
		config.ifdebug && console.log("request is over!")
	});
	var e = {},
		t = {
			category: 1,
			isContainsHot: 0
		},
		o = {
			category: 2,
			isContainsHot: 0
		},
		i = {
			category: 3,
			isContainsHot: 0
		};
	indexObj.ajaxInit(publicUrl + "lottery/getLotteryListByHot.php", 4, e), indexObj.ajaxInit(publicUrl + "lottery/getLotteryListByCategory.php", t.category, t), indexObj.ajaxInit(publicUrl + "lottery/getLotteryListByCategory.php", o.category, o), indexObj.ajaxInit(publicUrl + "lottery/getLotteryListByCategory.php", i.category, i), $("#gotop").click(function() {
		return $("body,html").animate({
			scrollTop: 0
		}, 500), $(this).hide(), !1
	}), $(document).scroll(function() {
		$(this).scrollTop() > 10 ? $("#gotop").show() : $("#gotop").hide()
	}), $("#gotop").click(function() {
		return $("body,html").animate({
			scrollTop: 0
		}, 500), $(this).hide(), !1
	}), $(document).scroll(function() {
		$(this).scrollTop() > 10 ? $("#gotop").show() : $("#gotop").hide()
	}), $(document).scroll(function(e) {
		e.preventDefault(), $(this).scrollTop() < 850 ? ($("#toRMC").find("li").removeClass("lisesected"), $(".atoRMC").parent().addClass("lisesected")) : $(this).scrollTop() > 860 && $(this).scrollTop() < 2800 ? ($("#toRMC").find("li").removeClass("lisesected"), $(".atoGPC").parent().addClass("lisesected")) : $(this).scrollTop() > 2800 && $(this).scrollTop() < 3300 ? ($("#toRMC").find("li").removeClass("lisesected"), $(".atoJWC").parent().addClass("lisesected")) : $(this).scrollTop() > 3300 && ($("#toRMC").find("li").removeClass("lisesected"), $(".atoQGC").parent().addClass("lisesected"))
	}), $(".bodybox .leftmenu").find("ul>li").click(function(e) {
		e.preventDefault();
		var t = $(this).find("a").attr("href");
		return $("html,body").animate({
			scrollTop: $(t).offset().top
		}, 500), !1
	}), $("#kaijiangjl").delegate("li", "click", function() {
		$(this).addClass("selected"), $(this).siblings().removeClass("selected")
	}), $(".deletebtn").hover(function() {
		$(this).stop().animate({
			opacity: "0"
		}, 300), $(this).stop().animate({
			opacity: "1"
		}, 300)
	}, function() {
		$(this).stop().animate({
			opacity: "0"
		}, 300), $(this).animate({
			opacity: "1"
		}, 300)
	}), $(".list").delegate(".deletebtn", "click", function() {
		$(this).parent().hide("200")
	}), $(".showallbtn").click(function() {
		$(".tablehead").find(".list");
		$(".tablehead").find(".list").show("fast")
	}), $(".tablehead>ul>li:even").css({
		background: "#f5f5f5"
	}), $(".head").css("background", "#e5e5e5")
}), indexObj.ajaxRequst = function(e, t, o) {
	var e = "..." == e ? "" : e,
		i = t.split("_")[1];
	toolss.hadCode(i, "pk10") ? indexObj.ajaxpk10(e, i, "#" + t, o) : toolss.hadCode(i, "kuai3") ? indexObj.ajaxKuai3(e, i, "#" + t, o) : toolss.hadCode(i, "cqnc") ? indexObj.ajaxCqnc(e, i, "#" + t, o) : toolss.hadCode(i, "ssc") ? indexObj.ajaxSsc(e, i, "#" + t, o) : toolss.hadCode(i, "shiyi5") ? indexObj.ajaxShiyix5(e, i, "#" + t, o) : toolss.hadCode(i, "klsf") ? indexObj.ajaxKlsf(e, i, "#" + t, o) : toolss.hadCode(i, "gxklsf") ? indexObj.ajaxGxKlsf(e, i, "#" + t, o) : toolss.hadCode(i, "egxy") ? indexObj.ajaxEgxy(e, i, "#" + t, o) : toolss.hadCode(i, "bjkl8") ? indexObj.ajaxBjkl8(e, i, "#" + t, o) : (toolss.hadCode(i, "qgc") || toolss.hadCode(i, "qgc1")) && indexObj.ajaxQGC(e, i, "#" + t, o)
}, indexObj.ajaxInit = function(e, t, o) {
	$.ajax({
		url: e,
		type: "GET",
		data: o,
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(t, !0)
		},
		success: function(e) {
			indexObj.loadotherData(e, t), toolss.progressA(t, !1)
		},
		error: function(i) {
			setTimeout(function() {
				indexObj.ajaxInit(e, t, o)
			}, 1e3)
		},
		complete: function(i, s) {
			"timeout" == s && setTimeout(function() {
				indexObj.ajaxInit(e, t, o)
			}, 1e3)
		}
	})
}, indexObj.loadotherData = function(e, t) {
	indexObj.createRMC(e, t)
}, indexObj.createRMC = function(e, t) {
	var o = toolss.ifObj(e);
	o = o.result.data, $(o).each(function(e) {
		var o = "#cz_" + this.lotCode;
		if ($(o).find(".lotName").text(this.lotName), toolss.hadCode(this.lotCode, "pk10")) animateMethod.pk10end(this.preDrawCode.split(","), o);
		else if (toolss.hadCode(this.lotCode, "kuai3")) animateMethod.kuai3AnimateEnd(this.preDrawCode, o);
		else if (toolss.hadCode(this.lotCode, "cqnc")) animateMethod.cqncAnimateEnd(this.preDrawCode, o);
		else if (toolss.hadCode(this.lotCode, "ssc")) animateMethod.sscAnimateEnd(this.preDrawCode, o);
		else if (toolss.hadCode(this.lotCode, "shiyi5")) animateMethod.sscAnimateEnd(this.preDrawCode, o);
		else if (toolss.hadCode(this.lotCode, "klsf")) animateMethod.sscAnimateEnd(this.preDrawCode, o), toolss.changeBackground(o);
		else if (toolss.hadCode(this.lotCode, "gxklsf")) {
			i = this.preDrawCode.split(",");
			animateMethod.sscAnimateEnd(this.preDrawCode, o), toolss.changeBackgroundGxklsf(i, o)
		} else if (toolss.hadCode(this.lotCode, "egxy")) {
			var i = this.preDrawCode + "," + this.sumNum;
			animateMethod.sscAnimateEnd(i, o), toolss.changeBackgroundEgxy(o)
		} else toolss.hadCode(this.lotCode, "bjkl8") ? (animateMethod.sscAnimateEnd(this.preDrawCode, o), toolss.changeBackgroundBjkl8(o)) : (toolss.hadCode(this.lotCode, "qgc") || toolss.hadCode(this.lotCode, "qgc1")) && (animateMethod.sscAnimateEnd(this.preDrawCode, o), toolss.resetRed(o, this.lotCode));
		$(o).find(".nextIssue").text(this.drawIssue), $(o).find(".preDrawIssue").text(this.preDrawIssue), $(o).find(".opentyle").hide(), $(o).find(".addF1").show(), $(o).find(".equalF").show(), indexObj.countDown(this.drawTime, this.serverTime, o, t)
	})
}, indexObj.ajaxpk10 = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1;
	$.ajax({
		url: publicUrl + "pks/getLotteryPksInfo.php?issue=" + e,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.pk10Data(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxpk10(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxpk10(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxpk10(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxSsc = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1;
	$.ajax({
		url: publicUrl + "CQShiCai/getBaseCQShiCai.php?issue=" + e,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.sscData(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxSsc(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxSsc(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxSsc(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxKlsf = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1;
	$.ajax({
		url: publicUrl + "klsf/getLotteryInfo.php?issue=" + e,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			$(o).find(".numred").removeClass("numred"), toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.klsfData(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxKlsf(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxKlsf(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxKlsf(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxGxKlsf = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1;
	$.ajax({
		url: publicUrl + "gxklsf/getLotteryInfo.php?issue=" + e,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			$(o).find(".numred").removeClass("numred"), $(o).find(".numgreen").removeClass("numgreen"), toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.GxklsfData(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxGxKlsf(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxGxKlsf(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxGxKlsf(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxCqnc = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1;
	$.ajax({
		url: publicUrl + "klsf/getLotteryInfo.php?issue=" + e,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.cqncData(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxCqnc(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxCqnc(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxCqnc(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxKuai3 = function(e, t, o, i) {
	e = void 0 == e ? "" : e;
	var s = !1;
	$.ajax({
		url: publicUrl + "lotteryJSFastThree/getBaseJSFastThree.php?issue=" + e,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.kuai3Data(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxKuai3(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxKuai3(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxKuai3(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxShiyix5 = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1;
	$.ajax({
		url: publicUrl + "ElevenFive/getElevenFiveInfo.php?issue=" + e,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.shiyix5Data(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxShiyix5(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxShiyix5(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxShiyix5(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxBjkl8 = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1;
	$.ajax({
		url: publicUrl + "LuckTwenty/getBaseLuckTewnty.php?issue=" + e,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.bjkl8Data(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxBjkl8(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxBjkl8(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxBjkl8(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxEgxy = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1;
	$.ajax({
		url: publicUrl + "LuckTwenty/getPcLucky28.php?issue=" + e,
		type: "GET",
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.EgxyData(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxEgxy(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxEgxy(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxEgxy(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.ajaxQGC = function(e, t, o, i) {
	var e = void 0 == e ? "" : e,
		s = !1,
		n = publicUrl;
	toolss.hadCode(t, "qgc") ? n += "QuanGuoCai/getLotteryInfo.php" : n += "QuanGuoCai/getLotteryInfo1.php", $.ajax({
		url: n,
		type: "GET",
		data: {
			lotCode: t
		},
		timeout: 6e4,
		beforeSend: function() {
			toolss.progressA(i, !0, o)
		},
		success: function(s) {
			try {
				indexObj.qgcData(s, t, o, i), toolss.progressA(i, !1, o)
			} catch (s) {
				setTimeout(function() {
					indexObj.ajaxQGC(e, t, o, i)
				}, 1e3)
			}
		},
		error: function(n) {
			setTimeout(function() {
				indexObj.ajaxQGC(e, t, o, i)
			}, 1e3), s = !0
		},
		complete: function(n, a) {
			s || "timeout" == a && setTimeout(function() {
				indexObj.ajaxQGC(e, t, o, i)
			}, 1e3)
		}
	})
}, indexObj.shiyix5Data = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.sscAnimateEnd(s.preDrawCode, o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i)
}, indexObj.kuai3Data = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.kuai3AnimateEnd(s.preDrawCode, o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i)
}, indexObj.pk10Data = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.pk10end(s.preDrawCode.split(","), o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i)
}, indexObj.sscData = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.sscAnimateEnd(s.preDrawCode, o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i)
}, indexObj.bjkl8Data = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.sscAnimateEnd(s.preDrawCode, o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i)
}, indexObj.EgxyData = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName);
	var n = s.preDrawCode + "," + s.sumNum;
	animateMethod.sscAnimateEnd(n, o), toolss.changeBackgroundEgxy(o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), $(o).find(".addF1").show(), $(o).find(".equalF").show(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i)
}, indexObj.qgcData = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.sscAnimateEnd(s.preDrawCode, o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), toolss.resetRed(o, t), indexObj.countDown(s.drawTime, s.serverTime, $(o), i)
}, indexObj.klsfData = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.sscAnimateEnd(s.preDrawCode, o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i), toolss.changeBackground(o)
}, indexObj.GxklsfData = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.sscAnimateEnd(s.preDrawCode, o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i);
	var n = s.preDrawCode.split(",");
	toolss.changeBackgroundGxklsf(n, o)
}, indexObj.cqncData = function(e, t, o, i) {
	var s = toolss.ifObj(e);
	if (s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	$(o).find(".lotName").text(s.lotName), animateMethod.cqncAnimateEnd(s.preDrawCode, o), $(o).find(".nextIssue").text(s.drawIssue), $(o).find(".preDrawIssue").text(s.preDrawIssue), $(o).find(".opentyle").hide(), indexObj.countDown(s.drawTime, s.serverTime, $(o), i)
}, indexObj.countDown = function(e, t, o, i) {
	var s = (e = "" == e ? "0" : e).replace("-", "/"),
		t = t.replace("-", "/");
	s = s.replace("-", "/"), t = t.replace("-", "/");
	var n = $(o).find(".hour"),
		a = $(o).find(".minute"),
		r = $(o).find(".second"),
		d = $(o).find(".opentyle"),
		l = $(o).find(".addF1"),
		u = $(o).find(".equalF"),
		c = ($(o).find("#timebox"), $(o).find(".cuttime")),
		f = (new Date(s) - new Date(t)) / 1e3,
		h = setInterval(function() {
			if (f > 1) {
				f -= 1;
				var e = Math.floor(f / 3600),
					t = Math.floor(f / 60 % 60),
					s = Math.floor(f % 60);
				$(n).text(e < 10 ? "0" + e : e), $(a).text(t < 10 ? "0" + t : t), $(r).text(s < 10 ? "0" + s : s), e <= 0 ? ($(o).find(".hourtxt").hide(), $(o).find(".hour").hide()) : ($(o).find(".hourtxt").show(), $(o).find(".hour").show())
			} else $(l).hide(), $(u).hide(), $(d).show(), $(c).hide(), clearInterval(h), indexObj.ajaxRequst($(o).find(".nextIssue").text(), $(o).attr("id"), i)
		}, 1e3)
}, toolss.progressA = function(e, t, o) {
	1 == e ? void 0 == o ? toolss.showOrHid("#toGPC", t) : toolss.showOrHid(o, t) : 2 == e ? void 0 == o ? toolss.showOrHid("#toQGC", t) : toolss.showOrHid(o, t) : 3 == e ? void 0 == o ? toolss.showOrHid("#toJWC", t) : toolss.showOrHid(o, t) : 4 == e && (void 0 == o ? toolss.showOrHid("#toRMC", t) : toolss.showOrHid(o, t))
}, toolss.showOrHid = function(e, t) {
	var o = "",
		i = "",
		s = "",
		n = "",
		a = "";
	n = $(e + " .egxy_kajianhao").find(".addF1"), a = $(e + " .egxy_kajianhao").find(".equalF"), o = $(e + " .kajianhao"), i = $(e + " .kajianhao").find(".numberbox"), s = $(e + " .kaijintime").find(".cuttime"), t ? ($(i).hide(), $(o).append('<div class="progress" style="display: block;"><img src="../../img/icon/piaog.gif"></div>'), $(s).hide(), $(n).hide(), $(a).hide()) : ($(i).show(), $(o).find(".progress").remove(), $(s).show(), $(n).show(), $(a).show())
}, toolss.ifObj = function(e) {
	var t = null;
	return "object" != typeof e ? t = JSON.parse(e) : (t = JSON.stringify(e), t = JSON.parse(t)), t
}, toolss.hadCode = function(e, t) {
	var o = ["10001", "10012", "10037"],
		i = ["10002", "10003", "10004", "10010", "10036"],
		s = ["10005", "10011", "10034"],
		n = ["10009"],
		a = ["10007", "10026", "10027", "10028", "10029", "10030", "10031", "10032", "10033"],
		r = ["10006", "10008", "10015", "10016", "10017", "10018", "10019", "10020", "10021", "10022", "10023", "10024", "10025"],
		d = ["10013", "10014", "10047"],
		l = ["10039", "10040", "10042", "10044", "10045"],
		u = ["10041", "10043"],
		c = ["10038"],
		f = ["10046"],
		h = !1;
	return "pk10" == t ? $(o).each(function(t) {
		e == this && (h = !0)
	}) : "ssc" == t ? $(i).each(function(t) {
		e == this && (h = !0)
	}) : "klsf" == t ? $(s).each(function(t) {
		e == this && (h = !0)
	}) : "cqnc" == t ? $(n).each(function(t) {
		e == this && (h = !0)
	}) : "kuai3" == t ? $(a).each(function(t) {
		e == this && (h = !0)
	}) : "shiyi5" == t ? $(r).each(function(t) {
		e == this && (h = !0)
	}) : "bjkl8" == t ? $(d).each(function(t) {
		e == this && (h = !0)
	}) : "qgc" == t ? $(l).each(function(t) {
		e == this && (h = !0)
	}) : "qgc1" == t ? $(u).each(function(t) {
		e == this && (h = !0)
	}) : "gxklsf" == t ? $(c).each(function(t) {
		e == this && (h = !0)
	}) : "egxy" == t && $(f).each(function(t) {
		e == this && (h = !0)
	}), h
}, toolss.changeBackground = function(e) {
	$(e).find(".numblue").each(function() {
		$(this).text() >= 19 && $(this).addClass("numred")
	})
}, toolss.changeBackgroundGxklsf = function(e, t) {
	$(t).find(".kajianhao").find("li").removeClass();
	for (var o = 0; o < e.length; o++) 1 == e[o] || 4 == e[o] || 7 == e[o] || 10 == e[o] || 13 == e[o] || 16 == e[o] || 19 == e[o] ? $(t).find(".kajianhao").find("li").eq(o).addClass("numred") : 3 == e[o] || 6 == e[o] || 9 == e[o] || 12 == e[o] || 15 == e[o] || 18 == e[o] || 21 == e[o] ? $(t).find(".kajianhao").find("li").eq(o).addClass("numgreen") : $(t).find(".kajianhao").find("li").eq(o).addClass("numblueHead")
}, toolss.changeBackgroundBjkl8 = function(e) {
	$(e).find(".numLightblue").each(function() {
		$(this).text() >= 41 ? $(this).addClass("numWeightblue") : $(this).addClass("numLightblue")
	}), $(e).find(".kajianhao").find("li:last-child").addClass("numOrange")
}, toolss.changeBackgroundEgxy = function(e) {
	$(e).find(".kajianhao").find("li:last-child").addClass("numred")
}, toolss.resetRed = function(e, t) {
	var o = $(e).find(".numberbox li"),
		i = o.length;
	$(o).each(function(e) {
		"10039" == t || "10042" == t ? e != i - 1 ? $(this).addClass("numred") : $(this).removeClass("numred") : "10040" == t ? e == i - 1 || e == i - 2 ? $(this).removeClass("numred") : $(this).addClass("numred") : "10041" == t || "10043" == t ? $(this).addClass("numred") : "10044" == t && $(this).addClass("numred")
	})
};