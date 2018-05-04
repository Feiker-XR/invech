//公共URL前缀
var publicUrl = config.publicUrl;
//后台URL前缀
var backUrl = config.backUrl;
////初始加载动画
//初始化界面定时器得到请求采种类别
var indexObj = {}; //创建方法对象 
var hometools = {}; //创建工具类对象
var ajaxIntervalTime1 = 1000;
var ajaxIntervalTime2 = 2000;
var ajaxIntervalTime3 = 3000;
var ajaxIntervalTime4 = 4000;

//初始货数据入口
$(function() {
	indexObj.ajaxBanner(); //加载banner
	setTimeout(function() {
		$(".main_image ul li").find("img").width($(".main_image").width());
		$(".main_image").height($(".main_image ul li").find("img").height());
	}, 1);
	setInterval(function() {
		$(".main_image ul li").find("img").width($(".main_image").width());
		$(".main_image").height($(".main_image ul li").find("img").height());
	}, 500);
	window.onresize = function() {
		$(".main_image ul li").find("img").width($(".main_image").width());
		$(".main_image").height($(".main_image ul li").find("img").height());
	}
	var licount = $(".main_image").find("li");
	$(licount).each(function(index) {
		$(".flicking_con").append("<a href='javascript:;' class='" + (index == 0 ? 'on' : '') + "'>" + (index + 1) + "</a>");
	})
	$dragBln = false;
	if($(".main_image ul li").find("img").length > 1) {
		$(".main_image").touchSlider({
			flexible: true,
			speed: 200,
			btn_prev: $("#btn_prev"),
			btn_next: $("#btn_next"),
			paging: $(".flicking_con a"),
			counter: function(e) {
				$(".flicking_con a").removeClass("on").eq(e.current - 1).addClass("on");
			}
		});
	} else {
		$(".main_image ul li").find("img").width($(".main_image").width());
	}
	$(".main_image ul li").find("img").width($(".main_image").width());
	$(".main_image").bind("mousedown", function() {
		$dragBln = false;
	});

	$(".main_image").bind("dragstart", function() {
		$dragBln = true;
	});

	$(".main_image a").click(function() {
		if($dragBln) {
			return false;
		}
	});

	timer = setInterval(function() {
		$("#btn_next").click();
	}, 5000);

	$(".main_visual").hover(function() {
		clearInterval(timer);
	}, function() {
		timer = setInterval(function() {
			$("#btn_next").click();
		}, 5000);
	});

	$(".main_image").bind("touchstart", function() {
		clearInterval(timer);
	}).bind("touchend", function() {
		timer = setInterval(function() {
			$("#btn_next").click();
		}, 5000);
	});
	//兼听横屏竖屏
	window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function() {
		$(".main_image ul li").find("img").width($(".main_image").width());
		$(".main_image").height($(".main_image ul li").find("img").height());
	}, false);
	//轮播图end---------------------------------
	//主程序加载入口------------------------------
	var data1 = {};
	var data2 = {
		"category": 1, //所属类别,如:1.高频彩;2.全国彩;3.境外彩
		"isContainsHot": 0 //0.不包括热门彩种;1.包括热门彩种,默认为0
	};
	var data3 = {
		"category": 3, //所属类别,如:1.高频彩;2.全国彩;3.境外彩
		"isContainsHot": 0 //0.不包括热门彩种;1.包括热门彩种,默认为0
	};
	indexObj.ajaxInit("http://m.900kcw.com/?r=home/lottery/get_lottery_list", 4, data1); //加载热门彩
	// indexObj.ajaxNotice(); //加载公告
	/*indexObj.ajaxInit(publicUrl + "lottery/getLotteryListByCategory.php", data2.category, data2); //加载高频彩
	indexObj.ajaxInit(publicUrl + "lottery/getLotteryListByCategory.php", data3.category, data3); //加载境外彩*/
	//启动加载数据
	//回到顶部
	$("#gotop").click(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		$(this).hide();
		return false;
	});
	$(document).scroll(function() {
		if($(this).scrollTop() > 10) {
			$("#gotop").show();
		} else {
			$("#gotop").hide();
		}
	});
	//所有彩种
	$("#menubtn").on("touchstart", "#btnimg", function() {
		tools.openAllCz(true); //打开所有彩种列表
	});
	//所有彩种
	$("#cZList .backbtn").on("touchstart", "span", function() {
		tools.openAllCz(false); //关闭所有彩种列表
	});
	$("#toRMC").on("click", ".lilist", function() {
		var id = $(this).attr("id");
		if(id == "cz_10001") {
			window.location.href = cZ.toRMC[0].href;
		} else if(id == "cz_10037") {
			window.location.href = cZ.toRMC[3].href;
		} else if(id == "cz_10002") {
			window.location.href = cZ.toRMC[5].href;
		} else if(id == "cz_10036") {
			window.location.href = cZ.toRMC[4].href;
		} else if(id == "cz_10003") {
			window.location.href = cZ.toRMC[7].href;
		} else if(id == "cz_10004") {
			window.location.href = cZ.toRMC[6].href;
		} else if(id == "cz_10007") {
			window.location.href = cZ.toRMC[8].href;
		} else if(id == "cz_10008") {
			window.location.href = cZ.toRMC[10].href;
		} else if(id == "cz_10005") {
			window.location.href = cZ.toRMC[9].href;
		} else if(id == "cz_10006") {
			window.location.href = cZ.toRMC[11].href;
		} else if(id == "cz_10009") {
			window.location.href = cZ.toRMC[12].href;
		}
	})
});
//===================主页方法========================
indexObj.ajaxRequst = function(issue, id, category) {
	if(id == undefined) {
		return;
	}
	var issue = issue == "..." ? "" : issue;
	//将ID转成lotCode
	var lotCodeid = id.split("_")[1];
	if(hometools.hadCode(lotCodeid, "pk10")) {
		//pk拾系列
		indexObj.ajaxpk10(issue, lotCodeid, "#" + id, category);
	} else if(hometools.hadCode(lotCodeid, "kuai3")) {
		//快三系列
		indexObj.ajaxKuai3(issue, lotCodeid, "#" + id, category);
	} else if(hometools.hadCode(lotCodeid, "cqnc")) {
		//重庆农场系列
		indexObj.ajaxCqnc(issue, lotCodeid, "#" + id, category);
	} else if(hometools.hadCode(lotCodeid, "ssc")) {
		//时时彩系列qssc: 10002, //重庆时时彩tjssc: 10003, //天津时时彩xjssc: 10004, //新疆时时彩//10010澳洲幸运5 时时彩
		indexObj.ajaxSsc(issue, lotCodeid, "#" + id, category);
	} else if(hometools.hadCode(lotCodeid, "shiyi5")) {
		//十一选5
		indexObj.ajaxShiyix5(issue, lotCodeid, "#" + id, category);
	} else if(hometools.hadCode(lotCodeid, "klsf")) {
		//快乐十分
		indexObj.ajaxKlsf(issue, lotCodeid, "#" + id, category);
	}

}
indexObj.YM = function(){
	//返回域名
	var yM = window.location.href;
	yM = yM.split("//")[1].split("/")[0].split(".");
	var myM = yM;
	if(myM[0]=="www"){
		yM = myM[1];
		if(yM == "m"){
			yM = myM[2];
		}
	}else if(myM[0]!="www"){
		yM = myM[0]
		if(yM == "m"){
			yM = myM[1];
		}
	}
	return yM;
}

indexObj.loadBanner = function(e) {
	// console.log(e)
}

//请求数据
indexObj.ajaxBanner = function() {
	//url：请求action;category：采种类别；rqdata:请求参数
	var iferror = false;
	$.ajax({
		// url: publicUrl + "focusPicture/findPicture.php",
		url: "http://m.900kcw.com/?r=home/lottery/find_picture",
		type: "GET",
		dataType: 'json',
		data: {
			type:"1",
			position:"0",//轮播
			sourceUrl:indexObj.YM()
		},
		timeout: 60000,
		async: false,
		success: function(data) {
			try {
				indexObj.loadBanner(data);
			} catch(e) {
				console.log(e);

				setTimeout(function() {
					indexObj.ajaxBanner();
				}, ajaxIntervalTime4);
			}
		},
		error: function(e) {
			setTimeout(function() {
				indexObj.ajaxBanner();
			}, ajaxIntervalTime1);
			iferror = true;
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxBanner();
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}
//请求数据
indexObj.ajaxNotice = function() {
	//url：请求action;category：采种类别；rqdata:请求参数
	var iferror = false;
	$.ajax({
		url: publicUrl + "notice/getLastNotice.php?type=1",
		type: "GET",
		timeout: 60000,
		async: false,
		success: function(data) {
			try {
				indexObj.loadNotice(data);
			} catch(e) {
				setTimeout(function() {
					indexObj.ajaxNotice();
				}, ajaxIntervalTime4);
			}
		},
		error: function(e) {
			setTimeout(function() {
				indexObj.ajaxNotice();
			}, ajaxIntervalTime1);
			iferror = true;
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxNotice();
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}

//请求数据
indexObj.ajaxInit = function(url, category, rqdata) {
	//url：请求action;category：采种类别；rqdata:请求参数
	var iferror = false;
	$.ajax({
		url: url,
		type: "GET",
		data: rqdata,
		timeout: 60000,
		beforeSend: function() {
			hometools.progressA(category, true); //启动动画
			$("#toRMC").find(".li3").hide();
		},
		success: function(data) {
			try {
				indexObj.loadData(data, category);
				hometools.progressA(category, false); //关闭动画
				$("#toRMC").find(".li3").show("200");
			} catch(e) {
				// console.log(e)

				setTimeout(function() {
					indexObj.ajaxInit(url, category, rqdata);
				}, ajaxIntervalTime4);
			}
		},
		error: function(e) {
			setTimeout(function() {
				indexObj.ajaxInit(url, category, rqdata);
			}, ajaxIntervalTime1);
			iferror = true;
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxInit(url, category, rqdata);
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}
indexObj.loadData = function(data, category) {
	//category所属类别,如:1.高频彩;2.全国彩;3.境外彩4.热门彩
	indexObj.createRMC(data, category);
}
indexObj.createRMC = function(jsondata, category) {
	var data = hometools.ifObj(jsondata); //格式转换
	data = data.result.data;
	$(data).each(function(index) {
		//添加采种名称
		var boxid = "#cz_" + this.lotCode;
		$(boxid).find(".lotName").text(this.lotName);
		if(hometools.hadCode(this.lotCode, "pk10")) { //pk10系列
			indexObj.pk10Data(this, this.lotCode, boxid, category);
		} else if(hometools.hadCode(this.lotCode, "kuai3")) { //快三系列
			indexObj.kuai3Data(this, this.lotCode, boxid, category);
		} else if(hometools.hadCode(this.lotCode, "cqnc")) { //重庆农场
			indexObj.cqncData(this, this.lotCode, boxid, category);
		} else if(hometools.hadCode(this.lotCode, "ssc")) { //时时彩系列
			indexObj.sscData(this, this.lotCode, boxid, category); //向头部填充数据1
		} else if(hometools.hadCode(this.lotCode, "shiyi5")) { //十一选5系统
			indexObj.shiyix5Data(this, this.lotCode, boxid, category);
		} else if(hometools.hadCode(this.lotCode, "klsf")) { //快乐十分系列
			indexObj.klsfData(this, this.lotCode, boxid, category); //向头部填充数据1
		}
		//添加下期开奖期号
		$(boxid).find(".preIssue").text(this.drawIssue);
		//添加当前期开奖期号
		$(boxid).find(".preDrawIssue").text(this.preDrawIssue);
		$(boxid).find(".opentyle").hide();
	});
}
indexObj.ajaxpk10 = function(issue, lotCode, id, category) {
	var issue = issue == undefined ? "" : issue;
	var iferror = false;
	$.ajax({
		// url: publicUrl + "pks/getLotteryPksInfo.php?issue=" + issue,
		url: "http://m.900kcw.com/?r=home/lottery/lottery_pk10&num=" + issue,
		type: "GET",
		async: "false",
		data: {
			"lotCode": lotCode
		},
		timeout: 60000,
		beforeSend: function() {
			hometools.progressA(category, true, id); //启动动画
		},
		success: function(jsondata) {
			try {
				var data = hometools.ifObj(jsondata); //格式转换
				data = data.result.data;
				var timeResult = tools.operatorTime(data.drawTime==""?"0":data.drawTime, data.serverTime); //得到时间差
				if(timeResult <= 0) {
					throw new Error("error");
				} else {
					indexObj.pk10Data(data, lotCode, id, category); //向头部填充数据1
					hometools.progressA(category, false, id); //关闭动画
				}
			} catch(e) {
				setTimeout(function() {
					indexObj.ajaxpk10(issue, lotCode, id, category);
				}, ajaxIntervalTime4);
			}
		},
		error: function(data) {
			setTimeout(function() {
				indexObj.ajaxpk10(issue, lotCode, id, category);
			}, ajaxIntervalTime1);
			iferror = true;
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxpk10(issue, lotCode, id, category);
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}
indexObj.ajaxSsc = function(issue, lotCode, id, category) {
	var issue = issue == undefined ? "" : issue;
	var iferror = false;
	$.ajax({
		// url: publicUrl + "CQShiCai/getBaseCQShiCai.php?issue=" + issue,
		url: "http://m.900kcw.com/?r=home/lottery/lottery_ssc&num=" + issue,
		type: "GET",
		data: {
			"lotCode": lotCode
		},
		timeout: 60000,
		beforeSend: function() {
			hometools.progressA(category, true, id); //启动动画
		},
		success: function(jsondata) {
			try {
				var data = hometools.ifObj(jsondata); //格式转换
				data = data.result.data;
				var timeResult = tools.operatorTime(data.drawTime==""?"0":data.drawTime, data.serverTime); //得到时间差
				if(timeResult <= 0) {
					throw new Error("error");
				} else {
					indexObj.sscData(data, lotCode, id, category); //向头部填充数据1
					hometools.progressA(category, false, id); //启动动画
				}
			} catch(e) {
				setTimeout(function() {
					indexObj.ajaxSsc(issue, lotCode, id, category);
				}, ajaxIntervalTime4);
			}
		},
		error: function(data) {
			setTimeout(function() {
				indexObj.ajaxSsc(issue, lotCode, id, category);
			}, ajaxIntervalTime1);
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxSsc(issue, lotCode, id, category);
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}
indexObj.ajaxKlsf = function(issue, lotCode, id, category) {
	var issue = issue == undefined ? "" : issue;
	var iferror = false;
	$.ajax({
		// url: publicUrl + "klsf/getLotteryInfo.php?issue=" + issue,
		url: "http://m.900kcw.com/?r=home/lottery/lottery_klsf&num=" + issue,
		type: "GET",
		data: {
			"lotCode": lotCode
		},
		timeout: 60000,
		beforeSend: function() {
			$(id).find(".numred").removeClass("numred");
			hometools.progressA(category, true, id); //启动动画
		},
		success: function(jsondata) {
			try {
				var data = hometools.ifObj(jsondata); //格式转换
				data = data.result.data;
				var timeResult = tools.operatorTime(data.drawTime==""?"0":data.drawTime, data.serverTime); //得到时间差
				if(timeResult <= 0) {
					throw new Error("error");
				} else {
					indexObj.klsfData(data, lotCode, id, category); //向头部填充数据1
					hometools.progressA(category, false, id); //启动动画
				}
			} catch(e) {
				setTimeout(function() {
					indexObj.ajaxKlsf(issue, lotCode, id, category);
				}, ajaxIntervalTime4);
			}

		},
		error: function(data) {
			setTimeout(function() {
				indexObj.ajaxKlsf(issue, lotCode, id, category);
			}, ajaxIntervalTime1);
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxKlsf(issue, lotCode, id, category);
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}
indexObj.ajaxCqnc = function(issue, lotCode, id, category) {
	var issue = issue == undefined ? "" : issue;
	var iferror = false;
	$.ajax({
		// url: publicUrl + "klsf/getLotteryInfo.php?issue=" + issue,
		url: "http://m.900kcw.com/?r=home/lottery/lottery_klsf&num=" + issue,
		type: "GET",
		async: "false",
		data: {
			"lotCode": lotCode
		},
		timeout: 60000,
		beforeSend: function() {
			hometools.progressA(category, true, id); //启动动画
		},
		success: function(jsondata) {
			try {
				var data = hometools.ifObj(jsondata); //格式转换
				data = data.result.data;
				var timeResult = tools.operatorTime(data.drawTime==""?"0":data.drawTime, data.serverTime); //得到时间差
				if(timeResult <= 0) {
					throw new Error("error");
				} else {
					indexObj.cqncData(data, lotCode, id, category); //向头部填充数据1
					hometools.progressA(category, false, id); //启动动画
				}
			} catch(e) {
				setTimeout(function() {
					indexObj.ajaxCqnc(issue, lotCode, id, category);
				}, ajaxIntervalTime4);
			}
		},
		error: function(data) {
			setTimeout(function() {
				indexObj.ajaxCqnc(issue, lotCode, id, category);
			}, ajaxIntervalTime1);
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxCqnc(issue, lotCode, id, category);
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}
indexObj.ajaxKuai3 = function(issue, lotCode, id, category) {
	var issue = issue == undefined ? "" : issue;
	var iferror = false;
	$.ajax({
		// url: publicUrl + "lotteryJSFastThree/getBaseJSFastThree.php?issue=" + issue,
		url: "http://m.900kcw.com/?r=home/lottery/lottery_jsk3&num=" + issue,
		type: "GET",
		data: {
			"lotCode": lotCode
		},
		timeout: 60000,
		beforeSend: function() {
			hometools.progressA(category, true, id); //启动动画
		},
		success: function(jsondata) {
			try {
				var data = hometools.ifObj(jsondata); //格式转换
				data = data.result.data;
				var timeResult = tools.operatorTime(data.drawTime==""?"0":data.drawTime, data.serverTime); //得到时间差
				if(timeResult <= 0) {
					throw new Error("error");
				} else {
					indexObj.kuai3Data(data, lotCode, id, category); //向头部填充数据1
					hometools.progressA(category, false, id); //启动动画
				}
			} catch(e) {
				setTimeout(function() {
					indexObj.ajaxKuai3(issue, lotCode, id, category);
				}, ajaxIntervalTime4);
			}
		},
		error: function(data) {
			setTimeout(function() {
				indexObj.ajaxKuai3(issue, lotCode, id, category);
			}, ajaxIntervalTime1);
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxKuai3(issue, lotCode, id, category);
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}
indexObj.ajaxShiyix5 = function(issue, lotCode, id, category) {
	var issue = issue == undefined ? "" : issue;
	var iferror = false;
	$.ajax({
		// url: publicUrl + "ElevenFive/getElevenFiveInfo.php?issue=" + issue,
		url: "http://m.900kcw.com/?r=home/lottery/lottery_11x5&num=" + issue,		
		type: "GET",
		data: {
			"lotCode": lotCode
		},
		timeout: 60000,
		beforeSend: function() {
			hometools.progressA(category, true, id); //启动动画
		},
		success: function(jsondata) {
			try {
				var data = hometools.ifObj(jsondata); //格式转换
				data = data.result.data;
				var timeResult = tools.operatorTime(data.drawTime==""?"0":data.drawTime, data.serverTime); //得到时间差
				if(timeResult <= 0) {
					throw new Error("error");
				} else {
					indexObj.shiyix5Data(data, lotCode, id, category); //向头部填充数据1
					hometools.progressA(category, false, id); //启动动画
				}
			} catch(e) {
				setTimeout(function() {
					indexObj.ajaxShiyix5(issue, lotCode, id, category);
				}, ajaxIntervalTime4);
			}
		},
		error: function(data) {
			setTimeout(function() {
				indexObj.ajaxShiyix5(issue, lotCode, id, category);
			}, ajaxIntervalTime1);
		},
		complete: function(xmlobj, state) {
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						indexObj.ajaxShiyix5(issue, lotCode, id, category);
					}, ajaxIntervalTime1);
				}
			}
		}
	});
}
indexObj.shiyix5Data = function(data, lotCode, id, category) {
	$(id).find(".lotName").text(data.lotName);
	animate.sscAnimateEnd((data.preDrawCode).split(","), id);
	//添加下期开奖期号
	$(id).find(".nextIssue").text(data.drawIssue);
	//添加当前期开奖期号
	$(id).find(".preDrawIssue").text(data.preDrawIssue);
	$(id).find(".opentyle").hide();
	//总合大小 ：0大1小2和
	//总合单双：0双 1单
	//龙虎：0龙1虎
	$(id).find(".dragonTiger").text(data.dragonTiger == "0" ? "龙" : "虎");
	$(id).find(".sumNum").text(data.sumNum);
	$(id).find(".sumBigSmall").text(tools.typeOf("zhdx", data.sumBigSmall));
	$(id).find(".sumSingleDouble").text(data.sumSingleDouble == "0" ? "单" : "双");
	//添加倒计时
	indexObj.countDown(data.drawTime, data.serverTime, id, category);
}
indexObj.kuai3Data = function(data, lotCode, id, category) {
	$(id).find(".lotName").text(data.lotName);
	animate.kuai3AnimateEnd((data.preDrawCode).split(","), id);
	//添加下期开奖期号
	$(id).find(".nextIssue").text(data.drawIssue);
	//添加当前期开奖期号
	$(id).find(".preDrawIssue").text(data.preDrawIssue);
	$(id).find(".sumNum").text(data.sumNum);
	$(id).find(".sumBigSmall").text(data.sumBigSmall == "0" ? "大" : "小"); //总和大小：0为大 1为小
	$(id).find(".sumSingleDouble").text(data.sumSingleDouble == "0" ? "单" : "双"); //总和单双：0为单 1为双
	$(id).find(".opentyle").hide();
	//添加倒计时
	indexObj.countDown(data.drawTime, data.serverTime, id, category);
}
indexObj.pk10Data = function(data, lotCode, id, category) {
	$(id).find(".lotName").text(data.lotName);
	animate.pk10AnimateEnd((data.preDrawCode).split(","), id);
	//添加下期开奖期号
	$(id).find(".nextIssue").text(data.drawIssue);
	//添加当前期开奖期号
	$(id).find(".preIssue").text(data.preDrawIssue);
	$(id).find(".opentyle").hide();
	$(id).find(".firstDT").text(data.firstDT == "0" ? "龙" : "虎"); //0为龙 1为虎
	$(id).find(".secondDT").text(data.secondDT == "0" ? "龙" : "虎"); //0为龙 1为虎
	$(id).find(".thirdDT").text(data.thirdDT == "0" ? "龙" : "虎"); //0为龙 1为虎
	$(id).find(".fourthDT").text(data.fourthDT == "0" ? "龙" : "虎"); //0为龙 1为虎
	$(id).find(".fifthDT").text(data.fifthDT == "0" ? "龙" : "虎"); //0为龙 1为虎
	$(id).find(".sumFS").text(data.sumFS); //0为龙 1为虎
	$(id).find(".sumBigSamll").text(data.sumBigSamll == "0" ? "大" : "小"); //0为大 1为小
	$(id).find(".sumSingleDouble").text(data.sumSingleDouble == "0" ? "单" : "双"); //0为单1为双
	//添加倒计时
	indexObj.countDown(data.drawTime, data.serverTime, id, category);
}
indexObj.sscData = function(data, lotCode, id, category) {
	$(id).find(".lotName").text(data.lotName);
	animate.sscAnimateEnd((data.preDrawCode).split(","), id);
	//添加下期开奖期号
	$(id).find(".nextIssue").text(data.drawIssue);
	//添加当前期开奖期号
	$(id).find(".preDrawIssue").text(data.preDrawIssue);
	//龙虎：0龙、1虎、2和
	var dragonTiger = "";
	if(data.dragonTiger == "0") {
		dragonTiger = "龙";
	} else if(data.dragonTiger == "1") {
		dragonTiger = "虎";
	} else if(data.dragonTiger == "2") {
		dragonTiger = "和";
	}
	$(id).find(".dragonTiger").text(dragonTiger);
	$(id).find(".sumNum").text(data.sumNum);
	$(id).find(".sumBigSmall").text(data.sumBigSmall == "0" ? "大" : "小"); //总合大小:0大、1小
	$(id).find(".sumSingleDouble").text(data.sumSingleDouble == "0" ? "单" : "双"); //总合单双:0单、1双
	$(id).find(".opentyle").hide();
	//添加倒计时
	indexObj.countDown(data.drawTime, data.serverTime, id, category);
}
indexObj.klsfData = function(data, lotCode, id, category) {
	$(id).find(".lotName").text(data.lotName);
	animate.sscAnimateEnd((data.preDrawCode).split(","), id);
	//添加下期开奖期号
	$(id).find(".nextIssue").text(data.drawIssue);
	//添加当前期开奖期号
	$(id).find(".preDrawIssue").text(data.preDrawIssue);
	//firstDragonTiger 第一名龙虎   0.龙、单、大；1.虎、双、小
	//secondDragonTiger 第二名龙虎，0.龙、单、大；1.虎、双、小
	//thirdDragonTiger 第三名龙虎牙0.龙、单、大；1.虎、双、小
	//fourthDragonTiger 第四名龙虎   0.龙、单、大；1.虎、双、小
	//和 sumNum
	//sumBigSmall 总和大小.0.大；1.小
	//sumSingleDouble 总和单双.0.单；1.双
	//	debugger
	$(id).find(".firstDragonTiger").text(data.firstDragonTiger == "0" ? "龙" : "虎");
	$(id).find(".secondDragonTiger").text(data.secondDragonTiger == "0" ? "龙" : "虎");
	$(id).find(".thirdDragonTiger").text(data.thirdDragonTiger == "0" ? "龙" : "虎");
	$(id).find(".fourthDragonTiger").text(data.fourthDragonTiger == "0" ? "龙" : "虎");
	$(id).find(".sumNum").text(data.sumNum);
	$(id).find(".sumBigSmall").text(tools.typeOf("zhdx", data.sumBigSmall));
	$(id).find(".sumSingleDouble").text(data.sumSingleDouble == "0" ? "单" : "双");
	$(id).find(".opentyle").hide();
	indexObj.countDown(data.drawTime, data.serverTime, id, category);
	//给特殊号码添加红色背景
	hometools.changeBackground(id);
}
indexObj.cqncData = function(data, lotCode, id, category) {
	$(id).find(".lotName").text(data.lotName);
	animate.cqncAnimateEnd((data.preDrawCode).split(","), id);
	//添加下期开奖期号
	$(id).find(".nextIssue").text(data.drawIssue);
	//添加当前期开奖期号
	$(id).find(".preDrawIssue").text(data.preDrawIssue);
	$(id).find(".opentyle").hide();
	$(id).find(".firstDragonTiger").text(data.firstDragonTiger == "0" ? "龙" : "虎");
	$(id).find(".secondDragonTiger").text(data.secondDragonTiger == "0" ? "龙" : "虎");
	$(id).find(".thirdDragonTiger").text(data.thirdDragonTiger == "0" ? "龙" : "虎");
	$(id).find(".fourthDragonTiger").text(data.fourthDragonTiger == "0" ? "龙" : "虎");
	$(id).find(".sumNum").text(data.sumNum);
	$(id).find(".sumBigSmall").text(tools.typeOf("zhdx", data.sumBigSmall));
	$(id).find(".sumSingleDouble").text(data.sumSingleDouble == "0" ? "单" : "双");
	$(id).find(".lastBigSmall").text(data.lastBigSmall == "0" ? "尾大" : "尾小");
	//添加倒计时
	indexObj.countDown(data.drawTime, data.serverTime, id, category);
}
indexObj.countDown = function(timestr, serverTime, id, category) {
	//timestr：下期开奖时间
	//serverTime：服务器时间
	//id：倒计时显示区域
	//category：彩种类别
	var time = timestr.replace("-", "/");
	var serverTime = serverTime.replace("-", "/");
	time = time.replace("-", "/");
	serverTime = serverTime.replace("-", "/");
	//var day_elem = $(id).find('.day');
	var hour_elem = $(id).find('.hour');
	var minute_elem = $(id).find('.minute');
	var second_elem = $(id).find('.second');
	var opentyle = $(id).find('.opentyle');
	var cuttime = $(id).find('.cuttime');
	var end_time = new Date(time).getTime(); //月份是实际月份-1
	var sys_second = (end_time - new Date(serverTime).getTime()) / 1000;
	//sys_second = sys_second - 1000;
	var timer = setInterval(function() {
		if(sys_second > 1) {
			sys_second -= 1;
			//var day = Math.floor((sys_second / 3600) / 24);
			var hour = Math.floor((sys_second / 3600) % 24);
			var minute = Math.floor((sys_second / 60) % 60);
			var second = Math.floor(sys_second % 60);
			//day_elem && $(day_elem).text(day); //计算天
			$(hour_elem).text(hour < 10 ? "0" + hour : hour); //计算小时
			$(minute_elem).text(minute < 10 ? "0" + minute : minute); //计算分钟
			$(second_elem).text(second < 10 ? "0" + second : second); //计算秒杀
			//如果时间小于0则删除时间显示
			if(hour <= 0) {
				$(id).find(".hourtxt").hide();
				$(id).find(".hour").hide();
			} else {
				$(id).find(".hourtxt").show();
				$(id).find(".hour").show();
			}
		} else {
			$(opentyle).show(); //倒计时区域显示开奖中...
			$(cuttime).hide(); //倒计时区域隐藏...
			clearInterval(timer); //清除当前定时器
			indexObj.ajaxRequst($(id).find(".nextIssue").text(), $(id).attr("id"), category); //请求后台加载数据传入一下期期数
		}
	}, 1000);
}
//类型转换
hometools.progressA = function(category, flag, id) {
	//所属类别,如:1.高频彩;2.全国彩;3.境外彩4.热门彩
	if(category == 1) {
		if(id == undefined) {
			hometools.showOrHid("#toGPC", flag);
		} else {
			hometools.showOrHid(id, flag);
		}
	} else if(category == 2) {
		if(id == undefined) {
			hometools.showOrHid("#", flag);
		} else {
			hometools.showOrHid(id, flag);
		}
	} else if(category == 3) {
		if(id == undefined) {
			hometools.showOrHid("#toJWC", flag);
		} else {
			hometools.showOrHid(id, flag);
		}
	} else if(category == 4) {
		if(id == undefined) {
			hometools.showOrHid("#toRMC", flag);
		} else {
			hometools.showOrHid(id, flag);
		}
	}
}
hometools.showOrHid = function(toRMC, flag) {
	var progHtml = '<div class="progress" style="display: block;height:0.24rem"><img src="themes/m/img/piaog.gif"></div>';
	var progress = "";
	var numberbox = "";
	var timebox = "";
	progress = $(toRMC + " .kajianhao");
	numberbox = $(toRMC + " .kajianhao").find(".numberbox");
	timebox = $(toRMC + " .boxline").find(".cuttime");
	if(flag) {
		$(progress).find(".progress").remove();
		$(numberbox).hide();
		$(progress).append(progHtml);
		$(timebox).hide(); //隐藏时间
	} else {
		$(numberbox).show();
		$(progress).find(".progress").remove();
		$(timebox).show(); //显示时间
	}
}
hometools.ifObj = function(jsondata) {
	var data = null;
	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	return data;
}
hometools.hadCode = function(lotCode, type) {
	var pk10 = ["10001", "10012", "10037"];
	var ssc = ["10002", "10003", "10004", "10010", "10036"];
	var klsf = ["10005", "10011"];
	var cqnc = ["10009"];
	var kuai3 = ["10007", "10026", "10027", "10028", "10029", "10030", "10031", "10032", "10033"];
	var shiyi5 = ["10006", "10008", "10015", "10016", "10017", "10018", "10019", "10020", "10021", "10022", "10023", "10024", "10025"];
	var flag = false;
	if(type == "pk10") {
		$(pk10).each(function(index) {
			if(lotCode == this) {
				flag = true;
			}
		});
	} else if(type == "ssc") {
		$(ssc).each(function(index) {
			if(lotCode == this) {
				flag = true;
			}
		});
	} else if(type == "klsf") {
		$(klsf).each(function(index) {
			if(lotCode == this) {
				flag = true;
			}
		});
	} else if(type == "cqnc") {
		$(cqnc).each(function(index) {
			if(lotCode == this) {
				flag = true;
			}
		});
	} else if(type == "kuai3") {
		$(kuai3).each(function(index) {
			if(lotCode == this) {
				flag = true;
			}
		});
	} else if(type == "shiyi5") {
		$(shiyi5).each(function(index) {
			if(lotCode == this) {
				flag = true;
			}
		});
	}
	return flag;
}

//添加特殊号码红色背景（广东快了十分、澳洲幸运8）
hometools.changeBackground = function(id) {
	$(id).find(".numblue").each(function() {
		if($(this).text() >= 19) {
			$(this).addClass("numred");
		};
	});
}