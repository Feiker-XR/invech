$(function() {
	//开启加载动画
	animateMethod.loadingList("#jrsmhmtj", true);
	//更多
	$("#morelist").mouseover(function() {
		$(".sub_morelist").show();
		$(".more").css("border-color", "#fa8e19").css('border-bottom-color', '#ffffff').css("color", "#fa8e19");
		$(".graypre").css("display", "none");
		$(".yellowpre").css("display", "inline-block");
	}).mouseout(function() {
		$(".sub_morelist").hide();
		$(".more").css('border-color', '#ffffff').css("color", "#333333");
		$(".graypre").css("display", "inline-block");
		$(".yellowpre").css("display", "none");
	});
	//回到顶部
	$("#gotop").click(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		$(this).hide();
		return false;
	});
	$(document).scroll(function() {
		//console.log($(this).scrollTop())
		if($(this).scrollTop() > 10) {
			$("#gotop").show();
		} else {
			$("#gotop").hide();
		}
	});

	//开奖记录js tab切换
	$("#kaijiangjl").delegate("li", "click", function() {
		var id = $(this).attr("id");
		if($(this).hasClass("selected")) {
			$(this).removeClass("selected");
			if(id == "jrsmtj") {
				$("." + id).hide("200");
			} else if(id == "cltx") {
				$("." + id).hide("200");
			} else if(id == "hmfb") {
				$("." + id).hide("100");
				$("." + id).animate({
					opacity: "0"
				}, 200);
			}
		} else {
			if($(this).hasClass("kaijiltit")) {
				return;
			} else {
				$(this).addClass("selected");
				if(id == "jrsmtj") {
					$("." + id).show("200");
				} else if(id == "cltx") {
					$("." + id).show("200");
				} else if(id == "hmfb") {
					$("." + id).show("100");
					$("." + id).animate({
						opacity: "1"
					}, 200);
				}
			}

		}
	});
	//查看车号分布 选项卡
	var tabarr = []; //存放已经选中的选项卡
	$("#chakanchfb").delegate("li", "click", function() {

		//重置大小单双分布
		$("#daxiaodsfb").find("li").removeClass("selected");
		if($(this).hasClass("selected")) {
			$(this).removeClass("selected");
			//执行选中的方法
			ckchfb($(this).attr("class"));
			//当取消最后一个号码是重置
			if(tabarr.length + 1 == 1) {
				tabarr = [];
				//传变量是为了检查是不是重置功能
				$("#jrsmhmtj").find(".blueqiu li").removeClass("selectedOpacity");
			}
		} else {
			if($(this).hasClass("kaijiltit")) {
				return;
			} else {
				//判断是否为重置按钮操作
				if($(this).hasClass("reset")) {
					tabarr = [];
					//传变量是为了检查是不是重置功能
					$("#jrsmhmtj").find(".blueqiu li").removeClass("selectedOpacity");
				} else {
					//执行选中的方法
					ckchfb($(this).attr("class"));
					$(this).addClass("selected");
				}
			}

		}
	});
	//查看车号分布：选中执行方法
	function ckchfb(num) {

		if(tabarr.length) {
			var flag = false;
			for(var i = 0; i < tabarr.length; i++) {
				if(num == tabarr[i]) {
					tabarr.splice(i, 1); //定义为取消
					flag = true;
				}
			}
			if(!flag) {
				tabarr.push(num);
			}
		} else {
			tabarr.push(num);
		}
		//执行循环
		excuteCkchfb(false);
	}
	//查看号码分布
	function excuteCkchfb(flag) {
		var li = $("#jrsmhmtj").find(".blueqiu li").addClass("selectedOpacity");
		//遍历选项卡
		for(var i = 0, len1 = tabarr.length; i < len1; i++) {
			//当选择号码一
			//得到一个当前遍历的li中的号码
			$("#jrsmhmtj .blueqiu li").each(function() {
				if($(this).text() == tabarr[i]) {
					$(this).removeClass("selectedOpacity");
				}
			});

		}
	}
	/**
	 * 在小单双分布
	 * 
	 * 
	 */
	//	判断是否同时选中
	var ifarrDxDs = [];
	//向数组中添加已选中的对象
	function ifArrHas(num) {
		if(ifarrDxDs.length <= 0) {
			ifarrDxDs.push(num);
		} else {
			for(var i = 0, len = ifarrDxDs.length; i < len; i++) {
				if(ifarrDxDs[i] == num) {
					return;
				}
			}
			ifarrDxDs.push(num);
		}
	}
	//大小单双分布  ---大小
	$("#daxiaodsfb").delegate("li", "click", function() {
		//重置查看车号分布
		$("#chakanchfb").find("li").removeClass("selected");
		tabarr = []; //清空多选数据
		var id = $(this).attr("id");
		var hasclass = $(this).hasClass("selected");
		if(id == "dannum") {
			if(hasclass) {
				$(this).removeClass("selected");
			} else {
				$(this).addClass("selected");
				$("#shuangnum").removeClass("selected");
			}
		} else if(id == "shuangnum") {
			if(hasclass) {
				$(this).removeClass("selected");
			} else {
				$(this).addClass("selected");
				$("#dannum").removeClass("selected");
			}
		} else if(id == "danum") {
			if(hasclass) {
				$(this).removeClass("selected");
			} else {
				$(this).addClass("selected");
				$("#xiaonum").removeClass("selected");
			}
		} else if(id == "xiaonum") {
			if(hasclass) {
				$(this).removeClass("selected");
			} else {
				$(this).addClass("selected");
				$("#danum").removeClass("selected");
			}
		}

		if($(this).hasClass("kaijiltit")) {
			return;
		} else {
			//重置按钮操作
			if($(this).hasClass("reset")) {
				$(this).siblings().removeClass("selected");
				//传变量是为了检查是不是重置功能
				$("#jrsmhmtj").find(".blueqiu li").removeClass("selectedOpacity");
			} else {
				if(id == "danum") {
					$("#duizinum").removeClass("selected");
					ifArrHas(2); //添加选中状态
					excuteDx(3, hasclass); //执行大数筛选
				} else if(id == "xiaonum") {
					$("#duizinum").removeClass("selected");
					ifArrHas(2); //添加选中状态
					excuteDx(4, hasclass); //执行小数筛选
				} else if(id == "dannum") {
					$("#duizinum").removeClass("selected");
					ifArrHas(1); //添加选中状态
					excuteDx(1, hasclass); //执行单数筛选
				} else if(id == "shuangnum") {
					$("#duizinum").removeClass("selected");
					ifArrHas(1); //添加选中状态
					excuteDx(2, hasclass); //执行双数筛选
				} else if(id == "duizinum") {
					shodouble(hasclass); //执行双数筛选
				}
			}
		}

	});
	//定义统一透明样式兼容IE8
	function opacity(obj, num, filt) {
		obj.style.filter = "alpha(opacity:" + filt + ")";
		obj.style.opacity = num;
	}
	//判断是否为大小 type：为当前点击按钮类型 ifmyself：表示当时按钮是否取消选中
	function excuteDx(type, ifmyself) {
		//type 类型1：单数 2：双数  3：大 4：小
		var li = $("#jrsmhmtj").find(".blueqiu li");
		//判断是否为选中
		var dannum = $("#dannum").hasClass("selected"); //单号选中
		var shuangnum = $("#shuangnum").hasClass("selected"); //双号选中
		var danum = $("#danum").hasClass("selected"); //大号选中
		var xiaonum = $("#xiaonum").hasClass("selected"); //小号选中

		$("#jrsmhmtj .blueqiu li").each(function() {
			var number = $(this).text();
			//是否为单双
			var ifds = number % 2 == 0 ? true : false;
			//是否为大小
			var ifdx = number > 5 ? true : false;
			//如果为真，说明是双数，如果为假说明是单数
			//判断是否同时选中，如果同时选中， 那么有一个为真就要显示
			//双重条件执行
			if(type == "1") { //当前按钮为单
				if(ifmyself) {
					if(danum) { //大号被选中，否则小号被选中
						if(ifdx) { //显示大号和单数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else if(xiaonum) { //小号被选中
						if(!ifdx) { //显示小号和单数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else {
						$(this).removeClass("selectedOpacity");
					}
				} else {
					if(danum) { //大号被选中，否则小号被选中
						if(ifdx && !ifds) { //显示大号和单数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}

					} else if(xiaonum) { //小号被选中
						if(!ifdx && !ifds) { //显示小号和单数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else {
						if(!ifds) {
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}

					}
				}
			} else if(type == "2") { //当前按钮为双
				if(ifmyself) {
					if(danum) { //大号被选中，否则小号被选中
						if(ifdx) { //显示大号和双数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}

					} else if(xiaonum) { //小号被选中
						if(!ifdx) { //显示小号和双数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else {
						$(this).removeClass("selectedOpacity");
					}
				} else {
					if(danum) { //大号被选中，否则小号被选中
						if(ifdx && ifds) { //显示大号和双数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}

					} else if(xiaonum) { //小号被选中
						if(!ifdx && ifds) { //显示小号和双数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else {
						if(ifds) { //显示小号和双数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					}
				}
			} else if(type == "3") { //当前按钮为大
				if(ifmyself) {
					if(dannum) { //单号被选中，否则双号被选中
						if(!ifds) { //显示大号和单数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}

					} else if(shuangnum) { //双号被选中
						if(ifds) { //显示大号和双数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else {
						$(this).removeClass("selectedOpacity");
					}
				} else {
					if(dannum) { //单号被选中，否则双号被选中
						if(ifdx && !ifds) { //显示大号和单数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}

					} else if(shuangnum) { //双号被选中
						if(ifdx && ifds) { //显示大号和双数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else {
						if(ifdx) { //显示大号和双数
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					}
				}
			} else if(type == "4") { //当前按钮为小
				if(ifmyself) {
					if(dannum) { //单号被选中，否则双号被选中
						if(!ifds) { //显示小号和单号
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else if(shuangnum) { //双号被选中
						if(ifds) { //显示小号和双号
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else {
						$(this).removeClass("selectedOpacity");
					}
				} else {
					if(dannum) { //单号被选中，否则双号被选中
						if(!ifdx && !ifds) { //显示小号和单号
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}

					} else if(shuangnum) { //双号被选中
						if(!ifdx && ifds) { //显示小号和双号
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					} else {
						if(!ifdx) { //显示小号
							$(this).removeClass("selectedOpacity");
						} else {
							$(this).addClass("selectedOpacity");
						}
					}
				}
			}
		});
		//当选择号码一
		//得到一个当前遍历的li中的号码
		$("#jrsmhmtj .blueqiu li").each(function(index) {
			if($(this).text() == tabarr[index]) {
				$(this).removeClass("selectedOpacity");
			}
		});
	}
	//显示对子号
	function shodouble(ifmyself) {
		var li = $("#jrsmhmtj").find(".blueqiu li");
		var tr = $("#jrsmhmtj>table>tbody").children();
		$("#daxiaodsfb").find("li").removeClass("selected");
		if(ifmyself) {
			$("#duizinum").removeClass("selected");
			$("#jrsmhmtj .blueqiu li").removeClass("selectedOpacity");
			return;
		} else {
			$("#duizinum").addClass("selected");
		}
		$("#jrsmhmtj .blueqiu li").addClass("selectedOpacity");
		var temp = [];
		var datas = $("#jrsmhmtj tr");
		var length = datas.length;
		if(length <= 1) {
			return;
		}
		var list = $(datas[0]).find("li");
		for(var i = 0; i < 10; i++) {
			temp.push($(list[i]).text());
		}
		for(var i = 1; i < length; i++) {
			var c_list = $(datas[i]).find("li");
			for(var j = 0; j < 10; j++) {
				var t = $(c_list[j]).text();
				if(t == temp[j]) {
					$(c_list[j]).removeClass("selectedOpacity");
					$($(datas[i - 1]).find('li')[j]).removeClass("selectedOpacity");
				}
				temp[j] = t;
			}
		}

	}
	//显示号码、显示大小 、显示单双
	$(".numberbtn span").live("click", function() {
		var id = $(this).attr("id");
		$(this).siblings().removeClass("spanselect");
		//重置查看车号分布按钮样式
		//重置大小单双分布
		if($(this).hasClass("spanselect")) {
			$(this).removeClass();
		} else {
			$(this).addClass("spanselect");
		}
		tools.bigOrSmallTot($(this).attr("id"), 6);
	});
	$("#waringbox").delegate("i", "click", function() {
		$(this).parent().parent().hide("200");
	});
	//启动加载数据
	//getData();
	//listData(); //重新请求list数据

	$("#startVideo").on("click", function() {
		if($("#timebox").find(".opening").css("display") != "block") { //判断index界面是否完成数据填充，否则不能打开开奖视频
			//弹出播放视频
			if($("iframe")[0].contentWindow.ifopen) {
				return;
			}
			$("#videobox").animate({
				"z-index": "19999"
			}, 200, function() {
				$(".content").animate({
					"bottom": "50%",
					"right": "50%",
					"width": "880px",
					"height": "630px",
					"margin-bottom": "-298px"
				}, 500, function() {
					$(".big").hide();
					$(".small").show();
					$(".animate").height("575");
					if($(".small").css("display") == "block") {
						$("#iframe").contents().find(".content").css("transform", "scale(0.782)");
					}
					//视频区
					var hour = $("#timebox").find(".hour").text();
					var minute = $("#timebox").find(".minute").text();
					var second = $("#timebox").find(".second").text();
					var cutTime = hour + ":" + minute + ":" + second;
					var numarr = [];
					$("#shiyix5").find(".kajianhao li").each(function() {
						numarr.push(parseInt($(this).text()));
					});
					var dataStr = {
						preDrawCode: numarr,
						sumNum: $("#sumNum").val(),
						sumBigSmall: $("#sumBigSmall").val(),
						sumSingleDouble: $("#sumSingleDouble").val(),
						drawIssue: $(".nextIssue").text(),
						drawTime: $("#drawTime").val(),
						preDrawTime: cutTime
					};
					$("iframe")[0].contentWindow.k3v.startVideo(dataStr);
				});
			});
			$("iframe")[0].contentWindow.ifopen = true;
		} else {
			return;
		}
	});

	//关闭视频
	$("#videobox .closevideo").on("click", function() {
		$(".content").animate({
			"width": "0",
			"margin-right": "0"
		}, 200, function() {
			$("#videobox").css({
				"z-index": "-1",
				"position": "fixed"
			});
			$("#videobox .content").css({
				"width": "880px",
				"margin-right": "-440px",
				"bottom": "-50%"
			});
			$(".animate #iframe").contents().find("#qishu,#nexttime,#cuttime,#btnbox").show();
			var bluefont = $(".animate #iframe").contents().find(".bluefont").text();
			$(".animate #iframe").contents().find(".bluefont").css({
				"font-size": "25px",
				"left": "36%",
				"top": "0"
			});
			$(".animate #iframe").contents().find(".bckj").css({
				"margin-top": "0"
			});
			$(".animate #iframe").contents().find(".ml").css({
				"font-size": "50%"
			});
		});
		$("iframe")[0].contentWindow.k3v.sound.stop("audioidB");
		$("iframe")[0].contentWindow.k3v.sound.stop("audioidR");
		$("iframe")[0].contentWindow.ifopen = false;
		$("iframe")[0].contentWindow.k3v.clearTime();
	});

	//最少化视频
	$("#videobox .small").on("click", function() {
		$(".content").animate({
			"right": "0",
			"width": "340px",
			"height": "290px",
			"margin-right": "10px",
			"bottom": "0",
			"margin-bottom": "0"
		}, 200, function() {
			$("#videobox").css({
				"position": "static"
			});
			$(".big").show();
			$(".small").hide();
			$(".content").width("347px");
			$("#iframe").contents().find(".content").css("transform", "scale(0.31)");
			$(".animate #iframe").contents().find("#qishu,#nexttime,#cuttime,#btnbox").hide();
			var bluefont = $(".animate #iframe").contents().find(".bluefont").text();
			var size, left, top;
			if(bluefont.length > 5) {
				size = "14px";
				left = "0";
			} else {
				size = "20px";
				left = "3px";
			}
			$(".animate #iframe").contents().find(".bluefont").css({
				"font-size": size,
				"left": left,
				"top": "7px"
			});
			$(".animate #iframe").contents().find(".bckj").css({
				"margin-top": "7px"
			});
			$(".animate #iframe").contents().find(".ml").css({
				"font-size": "20px"
			});
		});
	});
	//还原视频
	$("#videobox .big").on("click", function() {
		$("#videobox").animate({
			"z-index": "19999"
		}, 200, function() {
			$(".content").animate({
				"bottom": "50%",
				"right": "50%",
				"height": "630px",
				"margin-right": "-440px",
				"width": "880px",
				"margin-bottom": "-298px"
			}, 300, function() {
				$("#videobox").css({
					"position": "fixed"
				});
				$(".big").hide();
				$(".small").show();
				$(".animate").height("575");
				$("#iframe").contents().find(".content").css("transform", "scale(0.782)");
				$(".animate #iframe").contents().find("#qishu,#nexttime,#cuttime,#btnbox").show();
				var bluefont = $(".animate #iframe").contents().find(".bluefont").text();
				$(".animate #iframe").contents().find(".bluefont").css({
					"font-size": "25px",
					"left": "36%",
					"top": "0"
				});
				$(".animate #iframe").contents().find(".bckj").css({
					"margin-top": "25%"
				});
				$(".animate #iframe").contents().find(".ml").css({
					"font-size": "50%"
				});

				//				iframe(); //加载动画界面
			});
		});
	});
});

//公用随机数
//得到随机数
function excutenum() {
	var j = Math.floor(Math.random() * 10); //得到0到9的随机数
	//var j = Math.ceil(Math.random()*10);//得到0到10的随机数
	return j;
}

function excutenum1_6() {
	var j = Math.floor(Math.random() * 6); //得到1到6的随机数
	return j;
}
//PK拾动画******************start
var jnumber = $("#jnumber>li");
var res = [];
var lilength = 0;
var time = 0;
//启动终极动画
function sendj(arr) {
	var timeidc = setTimeout("sendj()", 100);
	var lastli = "";
	if(lilength == arr.length - 1) {
		lastli = "li_after";
		clearTimeout(timeidc);
		lilength = 0;
	}
	//终极真实数据显示
	$("#jnumber").append("<li class='nub" + arr[lilength] + " " + lastli + "'></li>");
	lilength++;
}
//执行动画的方法
function excutek() {
	var arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
	for(var i = 0, len = arr.length; i < len; i++) {
		var j = Math.floor(Math.random() * arr.length);
		res[i] = arr[j];
		arr.splice(j, 1);
	}
	for(var a = 0, len = jnumber.length; a < len; a++) {
		jnumber[a].className = "nub" + res[a];
		if(a == len - 1) {
			jnumber[a].style.marginRight = "0";
		}
	}
	time++;
	var timeId = setTimeout("excutek()", 200);
	if(time >= 25) {
		clearTimeout(timeId);
		$("#jnumber").html("");
		var lilengh = 0;
		sendj();
	}
}
//excutek(); //启动动画
//PK拾动画******************end
//主页moserhover
$(".bothover").hover(function() {
	$(this).find(".toright").css("background-color", "#FFFFFF");
	$(".botline").css("border", "none");
	$(this).find(".childmenu").show();
}, function() {
	$(this).find(".toright").css("background-color", "");
	$(".botline").css("border", "");
	$(this).find(".childmenu").hide();
});
//加载数据
function loadotherData() {
	setTimeout(function() {
		listData();
	}, 3000);
	todayData();
	longData();
}
//请求list数据
function listData() {
	var code = "&lottery=1";
	if ($("#shiyix5 .cuttime").find(".minute").text() == 0 && $("#shiyix5 .cuttime").find(".second").text() == 0) {
		code = "";
	}
	
	$.ajax({
		url: "http://www.900kcw.com/?r=home/history/ah11x5&=" + code,
		type: "GET",
		// data: {
		// 	"lotCode": lotCode
		// },
		success: function(data) {
			createHtmlList(data);
			//关闭加载动画
			animateMethod.loadingList("#jrsmhmtj", false);
		},
		error: function(data) {
			setTimeout(function() {
				loadotherData();
			}, 1000);
			if(config.ifdebug) {
				console.log("data error");
			}
			//createHtml(data);	
		}
	});
}
//今日双面/号码统计
function todayData() {
	$.ajax({
		url: "http://www.900kcw.com/?r=home/lottery/syx5_double_count",
		type: "GET",
		data: {
			"lotCode": 10017
		},
		success: function(data) {
			loadTodayData(data);
		},
		error: function(data) {
			if(config.ifdebug) {
				console.log("todayData data error");
			}
			//createHtml(data);	
		}
	});
}
//长龙提醒
function longData() {
	$.ajax({
		url: "http://www.900kcw.com/?r=home/lottery/syx5_long_dragon&date=",
		type: "GET",
		data: {
			"lotCode": 10017
		},
		success: function(data) {
			loadLongData(data);
		},
		error: function(data) {
			if(config.ifdebug) {
				console.log("data error");
			}
		}
	});
}

function parseTonum(str) {
	return str.charAt(0) * 1 <= 0 ? str.charAt(1) : str;
}
//今日双面数据
function loadTodayData(jsondata) {

	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	data = data.result.data;
	var td = $("#shuanmiandata");
	$(td).find(".cs1").text(data.numOne);
	$(td).find(".cs2").text(data.numTwo);
	$(td).find(".cs3").text(data.numThree);
	$(td).find(".cs4").text(data.numFour);
	$(td).find(".cs5").text(data.numFive);
	$(td).find(".cs6").text(data.numSix);
	$(td).find(".cs7").text(data.numSeven);
	$(td).find(".cs8").text(data.numEight);
	$(td).find(".cs9").text(data.numNine);
	$(td).find(".cs10").text(data.numTen);
	$(td).find(".cs11").text(data.numEleven);
	//球次
	var tdc = $("#gylhcs");
	$(tdc).find(".tt1").text(data.sumSingle);
	$(tdc).find(".tt2").text(data.sumDouble);
	$(tdc).find(".tt3").text(data.sumBig);
	$(tdc).find(".tt4").text(data.sumSmall);
	$(tdc).find(".one1").text(data.firstSingle);
	$(tdc).find(".one2").text(data.firstDouble);
	$(tdc).find(".one3").text(data.firstBig);
	$(tdc).find(".one4").text(data.firstSmall);
	$(tdc).find(".two1").text(data.secondSingle);
	$(tdc).find(".two2").text(data.secondDouble);
	$(tdc).find(".two3").text(data.secondBig);
	$(tdc).find(".two4").text(data.secondSmall);
	$(tdc).find(".three1").text(data.thirdSingle);
	$(tdc).find(".three2").text(data.thirdDouble);
	$(tdc).find(".three3").text(data.thirdBig);
	$(tdc).find(".three4").text(data.thirdSmall);
	$(tdc).find(".four1").text(data.fourthSingle);
	$(tdc).find(".four2").text(data.fourthDouble);
	$(tdc).find(".four3").text(data.fourthBig);
	$(tdc).find(".four4").text(data.fourthSmall);
	$(tdc).find(".five1").text(data.fifthSingle);
	$(tdc).find(".five2").text(data.fifthDouble);
	$(tdc).find(".five3").text(data.fifthBig);
	$(tdc).find(".five4").text(data.fifthSmall);

}

function minci(num, type) {
	if(type == "rank") {
		//名次,1-10分别为第一——第十名,11为冠亚和
		switch(num * 1) {
			case 1:
				return "冠军";
				break;
			case 2:
				return "亚军";
				break;
			case 3:
				return "三";
				break;
			case 4:
				return "四";
				break;
			case 5:
				return "五";
				break;
			case 6:
				return "六";
				break;
			case 7:
				return "七";
				break;
			case 8:
				return "八";
				break;
			case 9:
				return "九";
				break;
			case 10:
				return "十";
				break;
			case 11:
				return "冠亚和";
				break;
		}
	} else if(type == "state") {
		//形态:如1.单2.双,3.大4.小,5.龙6.虎
		switch(num * 1) {
			case 1:
				return "单";
				break;
			case 2:
				return "双";
				break;
			case 3:
				return "大";
				break;
			case 4:
				return "小";
				break;
			case 5:
				return "龙";
				break;
			case 6:
				return "虎";
				break;
		}
	}

}
//长龙连开提醒
function loadLongData(jsondata) {
	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	data = data.result.data;
	if(config.ifdebug) {
		console.log("长龙连开提醒长度:" + data.length + "结果数据：" + JSON.stringify(data));
	}
	$("#cltxul").empty("");

	for(var i = 0, len = data.length; i < len; i++) {
		var rank = typeOf("qiu2", data[i].rank);
		var state = typeOf("state1", data[i].state);
		var counthtml = data[i].count >= 5 ? "<span style='color:#f11821'>" + data[i].count + "&nbsp;&nbsp;</span>" : "<span>" + data[i].count + "&nbsp;&nbsp;</span>";
		var dataState = data[i].state;

		if(data[i].rank < 6) {
			var html = "<li>第<span>" + rank + "</span>球：&nbsp;&nbsp;<span>" + state + "</span>&nbsp;&nbsp;" + counthtml + "期</li>";
		} else if(data[i].rank == 6) {
			var html = "<li>和值 :&nbsp;&nbsp;<span>" + state + "</span>&nbsp;&nbsp;" + counthtml + "期</li>";
		} else if(data[i].rank == 7) {
			var html = "<li>尾数 :&nbsp;&nbsp;<span>" + state + "</span>&nbsp;&nbsp;" + counthtml + "期</li>";
		}
		if(data[i].rank == 11) {
			html = "<li><span>" + rank + "</span>：&nbsp;&nbsp;<span>" + state + "</span>&nbsp;&nbsp;" + counthtml + "期</li>";
		}
		$("#cltxul").append(html);
	}

}

//获得当前日的日期
function getSystime() {
	var date = new Date();
	var year = date.getFullYear(); //获取当前年份
	var mon = date.getMonth() + 1; //获取当前月份
	var da = date.getDate(); //获取当前日
	var day = date.getDay(); //获取当前星期几
	var h = date.getHours(); //获取小时
	var m = date.getMinutes(); //获取分钟
	var s = date.getSeconds(); //获取秒
	var d = document.getElementById('Date');
	return year + "-" + mon + "-" + da;
}
//当出现故障时5秒请求一次
var reloadotherData = null;

function clearinterval(interval) {
	clearInterval(intervalPk10);
}

var listdata = {};
//构建开奖记录数据
function createHtmlList(jsondata) {
	//jsondata = listdata;
	var data = null;
	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	data = data.result.data;
	var drawCode = "";
	$("#jrsmhmtj>table").empty();
	$("#jrsmhmtj>table").html('<tr><th width=150>时间</th><th width=80>期数</th><th id="numberbtn" class="numberbtn" width=286><span id="xshm" class="spanselect">显示号码</span><span id="xsdx">显示大小</span><span id="xsds">显示单双</span></th><th colspan="3">总和</th><th>龙虎</th><th>前三</th><th>中三</th><th>后三</th></tr>');
	$(data).each(function(index) {
		var tddate = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>";
		var tdli = "";
		var preDrawCode = (this.preDrawCode).split(",");
		$(preDrawCode).each(function() {
			tdli += "<li class='sscnumblue' style='color:#012537'><i>" + this + "</i></li>";
		});
		var stylestr = "style='color:";
		var　 tsumNum = "<td>" + this.sumNum + "</td>";
		if(!(preDrawCode.length <= 1)) {
			var tdnumber = "<td class='blueqiu'><ul style='width:242px'>" + tdli + "</ul></td>";
			var sumBigSmall = typeOf("dxh", this.sumBigSmall);
			var sumSingleDouble = "";
			if(this.sumSingleDouble == "0") {
				sumSingleDouble = "单";
			} else if(this.sumSingleDouble == "1") {
				sumSingleDouble = "双";
			} else if(this.sumSingleDouble == "2") {
				sumSingleDouble = "和";
			}
			var style1 = (sumBigSmall == "大") ? stylestr + "#f12d35'" : "'";
			var style2 = (sumSingleDouble == "双") ? stylestr + "#f12d35'" : "''";
			var dragonTiger = (this.dragonTiger == "0" ? "龙" : "虎");
			var style3 = (dragonTiger == "龙") ? stylestr + "#f12d35'" : "'";
			var behindThree = typeOf("san", this.behindThree);
			var style4 = (behindThree == "顺子") ? stylestr + "#f12d35'" : "'";
			var betweenThree = typeOf("san", this.betweenThree);
			var style5 = (betweenThree == "顺子") ? stylestr + "#f12d35'" : "'";
			var lastThree = typeOf("san", this.lastThree);
			var style6 = (lastThree == "顺子") ? stylestr + "#f12d35'" : "'";
		} else {
			var tdnumber = "<td class='blueqiu'></td>";
		}
		var last = "<td " + style1 + ">" + sumBigSmall + "</td><td " + style2 + ">" + sumSingleDouble + "</td><td " + style3 + ">" + dragonTiger + "</td><td " + style4 + ">" + behindThree + "</td><td " + style5 + ">" + betweenThree + "</td><td " + style6 + ">" + lastThree + "</td>";
		var tr = "<tr>" + tddate + "" + tdnumber + "" + tsumNum + "" + last + "</tr>";
		$("#jrsmhmtj>table").append(tr);
	});
	$("table").find("td").each(function() {
		if($(this).text() == "undefined") {
			$(this).text("");
		}
	});
}