$(function() {
	//开启加载动画
	animateMethod.loadingList("#jrsmhmtj", true);
	//设置当前时间
	var current_time = getDateStr(0);
	$(".date").val(current_time);
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
				$("#jrsmhmtj").find(".imgnumber").children().removeClass("selectedOpacity");
			}
		} else {
			if($(this).hasClass("kaijiltit")) {
				return;
			} else {
				//判断是否为重置按钮操作
				if($(this).hasClass("reset")) {
					tabarr = [];
					//传变量是为了检查是不是重置功能
					$("#jrsmhmtj").find(".imgnumber").children().removeClass("selectedOpacity");
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
		var li = $("#jrsmhmtj").find(".imgnumber").children().addClass("selectedOpacity");
		//遍历选项卡
		for(var i = 0, len1 = tabarr.length; i < len1; i++) {
			//当选择号码一
			//得到一个当前遍历的li中的号码
			$("#jrsmhmtj .imgnumber li").each(function() {
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
				tabarr = [];
				$(this).siblings().removeClass("selected");
				//传变量是为了检查是不是重置功能
				$("#jrsmhmtj").find(".imgnumber").children().removeClass("selectedOpacity");
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
		var li = $("#jrsmhmtj").find(".imgnumber").children();
		//判断是否为选中
		var dannum = $("#dannum").hasClass("selected"); //单号选中
		var shuangnum = $("#shuangnum").hasClass("selected"); //双号选中
		var danum = $("#danum").hasClass("selected"); //大号选中
		var xiaonum = $("#xiaonum").hasClass("selected"); //小号选中

		$("#jrsmhmtj .imgnumber li").each(function() {
			var number = $(this).text();
			//是否为单双
			var ifds = number % 2 == 0 ? true : false;
			//是否为大小
			var ifdx = number >= 6 ? true : false;
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
		$("#jrsmhmtj .imgnumber li").each(function(i) {
			if($(this).text() == tabarr[i]) {
				$(this).removeClass("selectedOpacity");
			}
		});
	}
	//显示对子号
	function shodouble(ifmyself) {
		var li = $("#jrsmhmtj").find(".imgnumber").children();
		var tr = $("#jrsmhmtj>table>tbody").children();
		$("#daxiaodsfb").find("li").removeClass("selected");
		if(ifmyself) {
			$("#duizinum").removeClass("selected");
			$("#jrsmhmtj .imgnumber li").removeClass("selectedOpacity");
			return;
		} else {
			$("#duizinum").addClass("selected");
		}
		$("#jrsmhmtj .imgnumber li").addClass("selectedOpacity");
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

		$("#jrsmhmtj .imgnumber li").each(function(index) {
			var number = $(this).text();
			//是否为单双
			var ifds = number % 2 == 0 ? true : false;
			//是否为大小
			var ifdx = number >= 6 ? true : false;
			if(id == "xshm") {
				ifselectedOpacity($(this));
				//样式名为numsm+01到10
				switch(number) {
					case "01":
						$(this).addClass("numsm01");
						break;
					case "02":
						$(this).addClass("numsm02");
						break;
					case "03":
						$(this).addClass("numsm03");
						break;
					case "04":
						$(this).addClass("numsm04");
						break;
					case "05":
						$(this).addClass("numsm05");
						break;
					case "06":
						$(this).addClass("numsm06");
						break;
					case "07":
						$(this).addClass("numsm07");
						break;
					case "08":
						$(this).addClass("numsm08");
						break;
					case "09":
						$(this).addClass("numsm09");
						break;
					case "10":
						$(this).addClass("numsm10");
						break;
				};
				if((index + 1) % 10 == 0) {
					$(this).addClass("numsm" + number + " li_after");
				}
			} else if(id == "xsdx") {
				ifselectedOpacity($(this));
				if(ifdx) {
					$(this).addClass("bignum");
					if((index + 1) % 10 == 0) {
						$(this).addClass("bignum li_after");
					}
				} else {
					$(this).addClass("smallnum");
					if((index + 1) % 10 == 0) {
						$(this).addClass("smallnum li_after");
					}
				}
			} else if(id == "xsds") {
				ifselectedOpacity($(this));
				if(ifds) {
					$(this).addClass("evennum");
					if((index + 1) % 10 == 0) {
						$(this).addClass("evennum li_after");
					}
				} else {
					$(this).addClass("singularnum");
					if((index + 1) % 10 == 0) {
						$(this).addClass("singularnum li_after");
					}
				}
			}

		})

	});
	$("#waringbox").delegate("i", "click", function() {
		$(this).parent().parent().hide("200");
	});
	//启动加载数据
	//getData();
});

function ifselectedOpacity(obj) {
	var selectedOpacity = $(obj).hasClass("selectedOpacity");
	if(selectedOpacity) {
		$(obj).removeClass();
		$(obj).addClass("selectedOpacity");
	} else {
		$(obj).removeClass();
	}
}

function getDateStr(AddDayCount) {
	var dd = new Date();
	dd.setDate(dd.getDate() + AddDayCount); //获取AddDayCount天后的日期
	var y = dd.getFullYear();
	var m = dd.getMonth() + 1; //获取当前月份的日期
	var d = dd.getDate();
	return y + "-" + m + "-" + d;
	/* document.write("前天："+GetDateStr(-2));
	document.write("<br />昨天："+GetDateStr(-1));
	document.write("<br />今天："+GetDateStr(0));
	document.write("<br />明天："+GetDateStr(1));
	document.write("<br />后天："+GetDateStr(2));
	document.write("<br />大后天："+GetDateStr(3));*/
}
//初始化时间控件
$('#datebox').calendar({
	trigger: '.date',
	zIndex: 999,
	format: 'yyyy-mm-dd',
	onSelected: function(view, date, data) {
		var date = formatDate(date);
		listData(date);
		tabarr = [];
		$("#chakanchfb,#daxiaodsfb").find("li").removeClass("selected");
		if(config.ifdebug) {
			console.log("选择日期时触发" + date);
		}
	},
	onClose: function(view, date, data) {
		if(config.ifdebug) {
			console.log("关闭是触发");
		}
	}
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
//加载当前页面数据
function loadotherData() {
	listData(); //重新请求list数据
	todayData(); //加载今日双面/号码统计
	t = setTimeout(function() {
		longData(); //长龙提醒//这里写你的AJAX请求                
	}, 1000);
}
//请求list数据
function listData(date) {
	date = date == undefined ? "" : date;
	$.ajax({
		// url: urlbublic + "/pks/getPksHistoryList.php?date=" + date,
		url: "http://www.900kcw.com/?r=home/history/jssc",
		type: "GET",
		// data: {
		// 	"lotCode": lotCode
		// },
		success: function(data) {
			createHtmlList(data);
			animateMethod.loadingList("#jrsmhmtj", false);
		},
		error: function(data) {
			setTimeout(function() {
				loadotherData() //重新请求list数据
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
		url: urlbublic + "pks/getPksDoubleCount.php?date=",
		type: "GET",
		data: {
			"lotCode": lotCode
		},
		success: function(data) {
			loadTodayData(data);
		},
		error: function(data) {
			//createHtmlList(localllistdata);
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
		url: urlbublic + "pks/getPksLongDragonCount.php?date=",
		type: "GET",
		data: {
			"lotCode": lotCode
		},
		success: function(data) {
			loadLongData(data);
		},
		error: function(data) {
			//createHtmlList(localllistdata);
			if(config.ifdebug) {
				console.log("data error");
			}
			//createHtml(data);	
		}
	});
}

function parseTonum(str) {
	return str.charAt(0) * 1 <= 0 ? str.charAt(1) : str;
}
var localllistdata = {};
var localheaddata = {};
//今日双面数据
function loadTodayData(jsondata) {
	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	data = data.result.data;
	$("#shuanmiandata").html("<td>出现次数</td>");
	var todydata = [data.firstSingleCount, data.firstDoubleCount, data.firstBigCount, data.firstSmallCount, data.secondSingleCount, data.secondDoubleCount, data.secondBigCount, data.secondSmallCount, data.thirdSingleCount, data.thirdDoubleCount, data.thirdBigCount, data.thirdSmallCount, data.fourthSingleCount, data.fourthDoubleCount, data.fourthBigCount, data.fourthSmallCount, data.fifthSingleCount, data.fifthDoubleCount, data.fifthBigCount, data.fifthSmallCount, data.sixthSingleCount, data.sixthDoubleCount, data.sixthBigCount, data.sixthSmallCount, data.seventhSingleCount, data.seventhDoubleCount, data.seventhBigCount, data.seventhSmallCount, data.eighthSingleCount, data.eighthDoubleCount, data.eighthBigCount, data.eighthSmallCount, data.ninthSingleCount, data.ninthDoubleCount, data.ninthBigCount, data.ninthSmallCount, data.tenthSingleCount, data.tenthDoubleCount, data.tenthBigCount, data.tenthSmallCount];
	for(var i = 0, len = todydata.length; i < len; i++) {
		var td = "<td>" + todydata[i] + "</td>";
		$("#shuanmiandata").append(td);
	}
	if(config.ifdebug) {
		console.log("todydata" + todydata.length)
	}
	var gylh = [data.sumSingleCount, data.sumDoubleCount, data.sumBigCount, data.sumSmallCount, data.firstDragonCount, data.firstTigerCount, data.secondDragonCount, data.secondTigerCount, data.thirdDragonCount, data.thirdTigerCount, data.fourthDragonCount, data.fourthTigerCount, data.fifthDragonCount, data.fifthTigerCount];
	$("#gylhcs").html("<td>出现次数</td>");
	for(var i = 0, len = gylh.length; i < len; i++) {
		var td = "<td>" + gylh[i] + "</td>";
		$("#gylhcs").append(td);
	}
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
	//
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
		var rank = minci(data[i].rank, "rank");
		var state = minci(data[i].state, "state");
		var counthtml = data[i].count >= 5 ? "<span style='color:#f11821'>" + data[i].count + "</span>" : "<span>" + data[i].count + "</span>";
		var html = "<li>第<span>" + rank + "</span>名：&nbsp;&nbsp;<span>" + state + "</span>&nbsp;&nbsp;" + counthtml + "期</li>";
		if(data[i].rank == 11 || data[i].rank == 1 || data[i].rank == 2) {
			html = "<li><span>" + rank + "</span>：&nbsp;&nbsp;<span>" + state + "</span>&nbsp;&nbsp;" + counthtml + "期</li>";
		}
		$("#cltxul").append(html);
	}

}
//开奖动画
var intervalPk10 = null;
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
var listdata = {};
//构建开奖记录数据
function createHtmlList(jsondata) {
	var data = tools.parseObj(jsondata);
	data = data.result.data;
	var drawCode = "";
	$("#jrsmhmtj>table").html('<tr><th>时间</th><th>期数</th><th id="numberbtn" class="numberbtn"><span id="xshm" class="spanselect">显示号码</span><span id="xsdx">显示大小</span><span id="xsds">显示单双</span></th><th colspan="3">冠亚和</th><th colspan="5">1-5龙虎</th></tr>');
	for(var i = 0, len = data.length; i < len; i++) {
		drawCode = data[i].preDrawCode.split(",");
		var lilist = "";
		for(var j = 0, lenli = drawCode.length; j < lenli; j++) {
			var lastclass = "";
			if(j == lenli - 1) {
				lastclass = "li_after";
			}
			lilist += "<li class='numsm" + drawCode[j] + " " + lastclass + "'><i>" + drawCode[j] + "</i></li>";
		}
		var stylestr = "style='color:";
		if(!(drawCode.length <= 1)) {
			var sumBigSamll = data[i].sumBigSamll == "0" ? "大" : "小";
			var style1 = (sumBigSamll == "大") ? stylestr + "#f12d35'" : "'";
			var sumSingleDouble = data[i].sumSingleDouble == "0" ? "单" : "双";
			var style2 = (sumSingleDouble == "双") ? stylestr + "#f12d35'" : "'";
			var firstDT = data[i].firstDT == "0" ? "龙" : "虎";
			var style3 = (firstDT == "龙") ? stylestr + "#f12d35'" : "'";
			var secondDT = data[i].secondDT == "0" ? "龙" : "虎";
			var style4 = (secondDT == "龙") ? stylestr + "#f12d35'" : "'";
			var thirdDT = data[i].thirdDT == "0" ? "龙" : "虎";
			var style5 = (thirdDT == "龙") ? stylestr + "#f12d35'" : "'";
			var fourthDT = data[i].fourthDT == "0" ? "龙" : "虎";
			var style6 = (fourthDT == "龙") ? stylestr + "#f12d35'" : "'";
			var fifthDT = data[i].fifthDT == "0" ? "龙" : "虎";
			var style7 = (fifthDT == "龙") ? stylestr + "#f12d35'" : "'";
		}
		var colortd = "<td " + style1 + ">" + sumBigSamll + "</td><td " + style2 + ">" + sumSingleDouble + "</td><td " + style3 + ">" + firstDT + "</td><td " + style4 + ">" + secondDT + "</td><td " + style5 + ">" + thirdDT + "</td><td " + style6 + ">" + fourthDT + "</td><td " + style7 + ">" + fifthDT + "</td>";
		var td = "<td>" + data[i].preDrawTime + "</td><td>" + data[i].preDrawIssue + "</td><td><ul class='imgnumber'>" + lilist + "</ul></td><td>" + data[i].sumFS + "</td>" + colortd;
		var tr = "<tr>" + td + "</tr>";
		$("#jrsmhmtj>table").append(tr);
	}
	$("table").find("td").each(function() {
		if($(this).text() == "undefined") {
			$(this).text("");
		}
	});
}