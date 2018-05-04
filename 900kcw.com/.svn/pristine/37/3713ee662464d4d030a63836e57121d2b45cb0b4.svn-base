var ajaxList = {},
	toolBoxs = {};
toolBoxs.isIE = function() {
	return !!(window.ActiveXObject || "ActiveXObject" in window)
}, ajaxList.qgc = function(e) {
	var t = e.url,
		s = e.id,
		a = e.lotCode,
		i = !1;
	$.ajax({
		url: t,
		type: "GET",
		data: {
			lotCode: a
		},
		beforeSend: function() {
			void 0 == animateID[s] && animateMethod.sscAnimate(s)
		},
		success: function(e) {
			try {
				creatDataHead(e, s), clearInterval(animateID[s]), delete animateID[s]
			} catch(e) {
				setTimeout(function() {
					ajaxRequst(s)
				}, "1000")
			}
		},
		error: function(e) {
			setTimeout(function() {
				ajaxRequst(s)
			}, "1000"), i = !0
		},
		complete: function(e, t) {
			(i = !1) || "timeout" == t && setTimeout(function() {
				ajaxRequst(s)
			}, "1000")
		}
	})
}, ajaxList.qgc2 = function(e) {
	var t = e.url,
		s = e.id,
		a = e.lotCode,
		i = !1;
	$.ajax({
		url: t,
		type: "GET",
		data: {
			lotCode: a
		},
		beforeSend: function() {
			void 0 == animateID[s] && animateMethod.sscAnimate(s)
		},
		success: function(e) {
			try {
				creatDataHead2(e, s), clearInterval(animateID[s]), delete animateID[s]
			} catch(e) {
				setTimeout(function() {
					ajaxRequst(s)
				}, "1000")
			}
		},
		error: function(e) {
			setTimeout(function() {
				ajaxRequst(s)
			}, "1000"), i = !0
		},
		complete: function(e, t) {
			(i = !1) || "timeout" == t && setTimeout(function() {
				ajaxRequst(s)
			}, "1000")
		}
	})
}, publicmethod.insertHeadQGC = function(e, t) {
	var s = tools.parseObj(e);
	if("100002" == s.result.businessCode) throw new Error("error");
	if(s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	s.totalCount;
	$(t).find(".preDrawIssue").text(s.preDrawIssue), $(t).find(".nextIssue").text(s.drawIssue), $(".lenresinli").removeClass("checked"), tools.countDown(s.drawTime, s.serverTime, t), animateMethod.sscAnimateEnd(s.preDrawCode, t), toolBoxs.resetRed(t), $("#waringbox").hide(300), setTimeout(function() {
		tools.ifCheckedOnToday() && loadotherData()
	}, 1e3)
}, publicmethod.insertHeadQGC2 = function(e, t) {
	var s = tools.parseObj(e);
	if("100002" == s.result.businessCode) throw new Error("error");
	if(s = s.result.data, tools.operatorTime("" == s.drawTime ? "0" : s.drawTime, s.serverTime) <= 0) throw new Error("error");
	s.totalCount;
	$(t).find(".preDrawIssue").text(s.preDrawIssue), $(t).find(".nextIssue").text(s.drawIssue), $(".lenresinli").removeClass("checked"), tools.countDown(s.drawTime, s.serverTime, t), animateMethod.sscAnimateEnd(s.preDrawCode, t), toolBoxs.resetRed(t), $("#waringbox").hide(300), setTimeout(function() {
		tools.ifCheckedOnToday() && loadotherData2()
	}, 1e3)
}, toolBoxs.resetRed = function(e) {
	var t = $(e).find(".kajianhao li").length;
	$(e).find(".kajianhao li").each(function(e) {
		"10039" == lotCode || "10042" == lotCode ? e != t - 1 ? $(this).addClass("numred") : $(this).removeClass("numred") : "10040" == lotCode ? e == t - 1 || e == t - 2 ? $(this).removeClass("numred") : $(this).addClass("numred") : "10041" == lotCode || "10043" == lotCode ? $(this).addClass("numred") : "10044" == lotCode && $(this).addClass("numred")
	})
}, toolBoxs.qgcTools = {
	bigOrSmall: function(e, t) {
		$("#jrsmhmtj .blueqiu li").each(function(s) {
			var a = $(this).text(),
				i = a % 2 == 0,
				o = a >= t;
			$(this).find("i").hide(), "xshm" == e ? (tools.ifselectedOpacity($(this)), $(this).addClass("numblue"), $(this).addClass("numred"), "10041" == lotCode || (s + 1) % 7 == 0 && ($(this).removeClass("numred"), $(this).prev().removeClass("numred")), $(this).find("i").show()) : "xsdx" == e ? (tools.ifselectedOpacity($(this)), o ? ($(this).addClass("bluebig"), (s + 1) % 10 == 0 && $(this).addClass("bluebig li_after")) : ($(this).addClass("bluesmall"), (s + 1) % 10 == 0 && $(this).addClass("bluesmall li_after"))) : "xsds" == e && (tools.ifselectedOpacity($(this)), i ? ($(this).addClass("blueeven"), (s + 1) % 10 == 0 && $(this).addClass("blueeven li_after")) : ($(this).addClass("bluesingular"), (s + 1) % 10 == 0 && $(this).addClass("bluesingular li_after")))
		})
	}
};