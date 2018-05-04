$(function() {
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

	//单选项卡切换功能
	$("#tabdsdxcl").find("span").live("click", function() {
		$(this).siblings().removeClass("xxselected")
		$(this).addClass("xxselected");
		var type = $(this).find("i").attr("title");
		if(type == "0") { //选项卡为综合模式
			$("#dxdsmc").show(200);
			$("#lhmc").hide(200);
			//excuteZhmsSelect(zhmssxmc, zhmssxlz);
		} else if(type == "1") { //选项卡为单选模式
			$("#dxdsmc").hide(200);
			$("#lhmc").show(200);
			//excuteZhmsSelect(dxmssxmc, dxmssxlz);
		}
		listData(); //切换时请求后台
	});
	//选择名次
	$("#lhmc").find(".sinli").live("click", function() {
		$(this).siblings().removeClass("checked");
		$(this).addClass("checked");
		listData(); //切换时请求后台
	});
	$("#dxdsmc").find(".sinli").live("click", function() {
		$(this).siblings().removeClass("checked");
		$(this).addClass("checked");
		listData(); //切换时请求后台
	});
	//今天，昨天，明天选择操作
	$(".listheadrl span").live("click", function() {
			$(this).siblings().removeClass("checked");
			$(this).addClass("checked");
			//createHtmlGetData(null);
			var id = $(this).attr("id");
			if(id == "today") {
				listData(getDateStr(0));
			} else if(id == "yesterday") {
				listData(getDateStr(-1));
			} else if(id == "qianday") {
				listData(getDateStr(-2));
			}
		})
		//大小单双分布  ---大小
	$("#daxiaodsfb").delegate("li", "click", function() {});
	//判断是否为大小 type：为当前点击按钮类型 ifmyself：表示当时按钮是否取消选中
	function excuteDx(type, ifmyself) {}
	$("#waringbox").delegate("i", "click", function() {
		$(this).parent().parent().hide("200");
	});

	//初始化时间控件
	$('#datebox').calendar({
		trigger: '#date',
		zIndex: 999,
		format: 'yyyy-mm-dd',
		onSelected: function(view, date, data) {
			var date = formatDate(date);
			listData(date);
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
	//启动加载数据
	//getData();
	//listData(); //初始页面请求路珠list数据
	$("#btn1").live("click", function() {
		if(!$(this).hasClass("sa2")) {
			$("#sid2").show("200");
			$(this).addClass("sa2");
		} else {
			$("#sid2").hide("200");
			$("#sid3").hide("200");
			$(this).removeClass("sa2");
		}
	});
	$("#btn2").live("click", function() {
		if(!$(this).hasClass("sa2")) {
			$("#sid3").show("200");
			$(this).addClass("sa2");
		} else {
			$("#sid3").hide("200");
			$(this).removeClass("sa2");
		}
	});
	$("#changedata").live("click", function() {
		choseNum();
	});
	$("#colorSet").find(".spanAdd2").live("click", function() {
		choseNum();
	});
});

//**************************************************************
//参数设置 确认按钮
function choseNum() {
	yzHaomaduan();
	var param = $("#colorSet").find(".param");
	var selectstr = "";
	$(param).each(function() {
		if(!$(this).is(":hidden")) {
			var star1 = $(this).find(".input1").val();
			var end1 = $(this).find(".input2").val();
			var td = $("#table_cltj td span");
			if($(this).attr("id") == "sid1") {
				$(td).each(function() {
					var txt = $(this).text();
					var star11 = (txt * 1 >= star1 * 1);
					var end11 = (txt * 1 <= end1 * 1);
					if(star11 && end11) {
						if(config.ifdebug) {
							console.log("color:" + $(this).css("color"));
						}
						if($(this).css("color") == "rgb(153, 153, 153)") {
							$(this).css({
								"color": "#f1010a"
							});
						}
					} else {
						if($(this).css("color") == "rgb(241, 1, 10)") {
							$(this).css({
								"color": "#999999"
							});
						}
					}
				})
			} else if($(this).attr("id") == "sid2") {
				$(td).each(function() {
					var txt = $(this).text();
					var star11 = (txt * 1 >= star1 * 1);
					var end11 = (txt * 1 <= end1 * 1);
					if(star11 && end11) {
						if(config.ifdebug) {
							console.log("color:" + $(this).css("color"));
						}
						if($(this).css("color") != undefined) {
							$(this).css({
								"color": "#0092dd"
							});
						}
					} else {
						if($(this).css("color") == "rgb(0, 146, 221)") {
							$(this).css({
								"color": "#999999"
							});
						}
					}
				})
			} else if($(this).attr("id") == "sid3") {
				$(td).each(function() {
					var txt = $(this).text();
					var star11 = (txt * 1 >= star1 * 1);
					var end11 = (txt * 1 <= end1 * 1);
					if(star11 && end11) {
						if(config.ifdebug) {
							console.log("color:" + $(this).css("color"));
						}
						if($(this).css("color") != undefined) {
							$(this).css({
								"color": "#07bf00"
							});
						}
					} else {
						if($(this).css("color") == "rgb(7, 191, 0)") {
							$(this).css({
								"color": "#999999"
							});
						}
					}
				})
			}
		}
	})

}

function yzHaomaduan() {
	//校验段号
	var num1 = [15, 30];
	var num2 = [31, 40];
	var num3 = [41, 50];
	var id = $(this).attr("id");
	var star1 = $("#star1").val();
	var end1 = $("#end1").val();
	var star2 = $("#star2").val();
	var end2 = $("#end2").val();
	var star3 = $("#star3").val();
	var end3 = $("#end3").val();
	if(star1 * 1 < num1[0]) {
		$("#star1").val(num1[0]);
	} else if(star1 * 1 >= num1[1]) {
		$("#star1").val(num1[0]);
	}
	if(end1 * 1 < num1[0]) {
		$("#end1").val(num1[1]);
	} else if(end1 * 1 >= num1[1]) {
		$("#end1").val(num1[1]);
	}
	if(star2 * 1 < num2[0]) {
		$("#star2").val(num2[0]);
	} else if(star2 * 1 >= num2[1]) {
		$("#star2").val(num2[0]);
	}
	if(end2 * 1 < num2[0]) {
		$("#end2").val(num2[1]);
	} else if(end2 * 1 >= num2[1]) {
		$("#end2").val(num2[1]);
	}
	if(star3 * 1 < num3[0]) {
		$("#star3").val(num3[0]);
	} else if(star3 * 1 >= num3[1]) {
		$("#star3").val(num3[0]);
	}
	if(end3 * 1 < num3[0]) {
		$("#end3").val(num3[1]);
	} else if(end3 * 1 >= num3[1]) {
		$("#end3").val(num3[1]);
	}

}

function formatDate(date) {
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	m = m < 10 ? '0' + m : m;
	var d = date.getDate();
	d = d < 10 ? ('0' + d) : d;
	return y + '-' + m + '-' + d;
};
/* 今日统计\统计连续出现次数  */
function doCheck(mol, id) {
	var txtNum = $("." + mol + "  .item_" + id + " .lz_table_head td .txtNum").val(); //输入连续出现次数
	var inputStr = $("." + mol + "  .item_" + id + " .lz_table_head td .secType").val(); //选择查询类型
	var inputNum = Number("0" + txtNum);
	var n = 0;
	$("." + mol + "  .item_" + id + " .lz_table_con td").each(function() { //搜：结果
		$(this).removeClass("shaw");
		if($(this).children('p').html() == inputStr && $(this).children('p').length >= inputNum) {
			$(this).removeAttr("style");
			$(this).addClass("shaw");
			n++;
		}
	});
	$("." + mol + "  .item_" + id + " .lz_table_head td .sec_count").html(n);

	$("." + mol + "  .item_" + id + "  .lz_table_head td .count").each(function() { //今日统计
		var str = $(this).attr("data");
		var m = 0;
		$("." + mol + "  .item_" + id + " .lz_table_con td p").each(function() {
			if($(this).html() == str) {
				m++;
			}
		});
		$(this).html(m);
	});
	/*当前开出期字体加粗  附加闪烁效果*/
	var i = 0;
	var result = $("." + mol + "  .item_" + id + " .lz_table_con td:first-child p:last ");
	result.css("font-weight", "bold");
	var timeOutId = setTimeout(function() {
		result.fadeOut(100).fadeIn(100);
		i++;
		if(i == 1) {
			timeOutId = setInterval(arguments.callee, 600);
		}
		if(i == 30) {
			window.clearInterval(timeOutId);
			//result.css("font-weight", "normal");
		}
	}, 1000);
}

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
////执行动画的方法
//function excutek() {
//	var arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
//	for(var i = 0, len = arr.length; i < len; i++) {
//		var j = Math.floor(Math.random() * arr.length);
//		res[i] = arr[j];
//		arr.splice(j, 1);
//	}
//	for(var a = 0, len = jnumber.length; a < len; a++) {
//		jnumber[a].className = "nub" + res[a];
//		if(a == len - 1) {
//			jnumber[a].style.marginRight = "0";
//		}
//	}
//	time++;
//	var timeId = setTimeout("excutek()", 200);
//	if(time >= 25) {
//		clearTimeout(timeId);
//		$("#jnumber").html("");
//		var lilengh = 0;
//		sendj();
//	}
//}
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
//请求路珠list数据
/**
 * days 天数，默认为30天 
 * type 类型 1.单长龙;2.双长龙;3.大长龙;4.小长龙;5.龙长龙;6.虎长龙
 * rank 名次,1-10名，11为冠亚和
 **/
function listData() {
	//默认30天
	var days = "30"; //如果请求数据time为undefined处理为""
	//得到TAB筛选条件类型 1.单长龙;2.双长龙;3.大长龙;4.小长龙;5.龙长龙;6.虎长龙
	$("#tabdsdxcl").find("span[class*='xxselected']").find("i").text();
	//判断是单双大小0，还是龙虎1
	var typeshow = $("#tabdsdxcl").find("span[class*='xxselected']").find("i").attr("title");
	//获取类名
	var type = $("#tabdsdxcl").find("span[class*='xxselected']").find("i").text();
	var rank = "";
	//获取选择的排名或者龙虎
	if(typeshow == 0) { //当为大双大小时
		rank = $("#dxdsmc").find("li[class*='checked']").find("span").text();
	} else { //当为龙虎时
		rank = $("#lhmc").find("li[class*='checked']").find("span").text();
	}
	$.ajax({
		url: urlbublic + "ElevenFive/queryNumberCount.php",
		type: "GET",
		data: {
			"lotCode":lotCode
		},
		success: function(data) {
			//执行数据请求
			createHtmlList(data);
		},
		error: function(data) {
			setTimeout(function(){
				loadotherData();
			},1000);
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
	$("#cltxul").html("");
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

function clearinterval(interval) {
	clearInterval(intervalPk10);
}
//综合路珠页面的功能操作************************start***************
var zhmssxmc = []; //筛选名次
var zhmssxlz = []; //筛选路珠
var dxmssxlz = []; //筛选路珠
var dxmssxmc = []; //筛选名次
var lmmssxmc = []; //筛选名次
var lmmssxlz = []; //选择路珠
//综合模式方法--筛选名次
function zhmsMcMethod(type, obj) {
	var $obj = $(obj);
	//全选
	if(type == "all") {
		zhmssxmc = []; //清空数组
		if(!(zhmssxmc.length >= 10)) {
			$($("#zhms").find(".sinli")).each(function(index) {
				if($(this).hasClass("title") || $(this).hasClass("zhcheckall") || $(this).hasClass("zhclear")) {
					return;
				} else {
					zhmssxmc.push($(this).find("i").text());
					$(this).addClass("checked");
				}
			});
		}
		//清空
	} else if(type == "zhclear") {
		$($("#zhms").find(".sinli")).each(function(index) {
			if($(this).hasClass("checked")) {
				$(this).removeClass("checked");
				zhmssxmc = []; //清空数组
			}
		});
		//单选
	} else if(type == "zhchecksing") {
		//清除当前样式
		var clicktxt = $obj.find("i").text();
		if(config.ifdebug) {
			console.log("clicktxt:" + clicktxt + "hasclass:" + $obj.hasClass("checked"));
		}

		$obj.removeClass("hoverli");
		if($obj.hasClass("checked")) {
			$obj.removeClass("checked");
			for(var i = 0, len = zhmssxmc.length; i < len; i++) {
				//
				if((zhmssxmc[i]) == clicktxt) {
					//清除当前被选择的索引
					zhmssxmc.splice(i, 1);
				}
			}
		} else {
			$obj.addClass("hoverli");
			$obj.addClass("checked");
			if(zhmssxmc.length <= 0) {
				zhmssxmc.push(clicktxt);
			} else {
				for(var i = 0, len = zhmssxmc.length; i < len; i++) {
					if((zhmssxmc[i]) == clicktxt) {
						break;
					}
				}
				zhmssxmc.push(clicktxt);
			}
		}
		if(config.ifdebug) {
			console.log("zhmssxmc" + JSON.stringify(zhmssxmc));
		}
	}
	if(config.ifdebug) {
		console.log("最后数组中有几个：" + zhmssxmc.length);
	}
	//传入名次和路珠
	excuteZhmsSelect(zhmssxmc, zhmssxlz);
}
//综合模式方法--筛选路珠
function zhmsLzMethod(type, obj) {
	if(type == "all") {
		zhmssxlz = []; //清空数组
		if(!(zhmssxlz.length >= 10)) {
			$($("#zhms .zhmslz").find(".lztype")).each(function(index) {
				zhmssxlz.push($(this).find("i").text());
				$(this).addClass("checked");
			});
		}
	} else {
		var $obj = $(obj);
		//清除当前样式
		var clicktxt = $obj.find("i").text();
		$obj.removeClass("hoverli");
		if($obj.hasClass("checked")) {
			$obj.removeClass("checked");
			for(var i = 0, len = zhmssxlz.length; i < len; i++) {
				//
				if((zhmssxlz[i]) == clicktxt) {
					//清除当前被选择的索引
					zhmssxlz.splice(i, 1);
				}
			}
		} else {
			$obj.addClass("hoverli");
			$obj.addClass("checked");
			if(zhmssxlz.length <= 0) {
				zhmssxlz.push(clicktxt);
			} else {
				for(var i = 0, len = zhmssxlz.length; i < len; i++) {
					if((zhmssxlz[i]) == clicktxt) {
						break;
					}
				}
				zhmssxlz.push(clicktxt);
			}
		}
		if(config.ifdebug) {
			console.log(zhmssxlz);
		}
	}
	//传入名次和路珠
	excuteZhmsSelect(zhmssxmc, zhmssxlz);
}

//***************单选模式***start*********************
//筛选路珠
function dxmsLzMethod(type, obj) {
	if(type == "all") {
		var $dxms = $("#dxms .lztype");
		$dxms.each(function(index) {
			dxmssxlz.push($(this).find("i").text());
			$(this).addClass("checked")
		});
		return;
	}
	//
	var $obj = $(obj);
	var clicktxt = $obj.find("i").text();
	if(config.ifdebug) {
		console.log("clicktxt:" + clicktxt + "hasclass:" + $obj.hasClass("checked"));
	}
	$obj.removeClass("hoverli");
	if($obj.hasClass("checked")) {
		$obj.removeClass("checked");
		for(var i = 0, len = dxmssxlz.length; i < len; i++) {
			//
			if((dxmssxlz[i]) == clicktxt) {
				//清除当前被选择的索引
				dxmssxlz.splice(i, 1);
			}
		}
	} else {
		$obj.addClass("hoverli");
		$obj.addClass("checked");
		if(dxmssxlz.length <= 0) {
			dxmssxlz.push(clicktxt);
		} else {
			for(var i = 0, len = dxmssxlz.length; i < len; i++) {
				if((dxmssxlz[i]) == clicktxt) {
					break;
				}
			}
			dxmssxlz.push(clicktxt);
		}
	}
	if(config.ifdebug) {
		console.log("dxmssxlz" + JSON.stringify(dxmssxlz));
	}
	excuteZhmsSelect(dxmssxmc, dxmssxlz);

}
//名次筛选
function dxmsMcMethod(type, obj) {
	dxmssxmc = [];
	if(type == "all") {
		var $txt = $("#dxms .xuanzhemc li:nth-child(2) span");
		dxmssxmc.push($txt.text());
		$txt.parent().addClass("selected");
		excuteZhmsSelect(dxmssxmc, dxmssxlz);
		return;
	}
	var $obj = $(obj);
	var clicktxt = $obj.find("span").text();
	if(config.ifdebug) {
		console.log("clicktxt:" + clicktxt + "hasclass:" + $obj.hasClass("checked"));
	}
	$obj.siblings().removeClass("selected");
	$obj.removeClass("hoverli");
	$obj.addClass("selected");
	dxmssxmc.push(clicktxt);
	if(config.ifdebug) {
		console.log("dxmssxlz" + JSON.stringify(dxmssxmc));
	}
	excuteZhmsSelect(dxmssxmc, dxmssxlz);

}

//***************单选模式*****end*********************
//***************两面模式*****start*********************
//两面模式方法--筛选名次
function lmmsMcMethod(type, obj) {
	var $obj = $(obj);
	$obj.removeClass("hoverli");
	//全选
	if(type == "all") {
		lmmssxmc = []; //清空数组
		if(!(lmmssxmc.length >= 10)) {
			$($("#lmms").find(".sinli")).each(function(index) {
				if($(this).hasClass("title") || $(this).hasClass("zhcheckall") || $(this).hasClass("zhclear")) {
					return;
				} else {
					lmmssxmc.push($(this).find("i").text());
					$(this).addClass("checked");
				}
			});
		}
		if(config.ifdebug) {
			console.log("全选" + JSON.stringify(lmmssxmc));
		}
		//清空
	} else if(type == "zhclear") {
		$($("#lmms").find(".sinli")).each(function(index) {
			if($(this).hasClass("checked")) {
				$(this).removeClass("checked");
				lmmssxmc = []; //清空数组
			}
		});
		//单选
	} else if(type == "zhchecksing") {
		//清除当前样式
		var clicktxt = $obj.find("i").text();
		if($obj.hasClass("checked")) {
			$obj.removeClass("checked");
			for(var i = 0, len = lmmssxmc.length; i < len; i++) {
				//
				if((lmmssxmc[i]) == clicktxt) {
					//清除当前被选择的索引
					lmmssxmc.splice(i, 1);
				}
			}
		} else {
			$obj.addClass("hoverli");
			$obj.addClass("checked");
			if(lmmssxmc.length <= 0) {
				lmmssxmc.push(clicktxt);
			} else {
				for(var i = 0, len = lmmssxmc.length; i < len; i++) {
					if((lmmssxmc[i]) == clicktxt) {
						break;
					}
				}
				lmmssxmc.push(clicktxt);
			}
		}
	}
	if(config.ifdebug) {
		console.log("最后数组中有几个：" + lmmssxmc.length);
	}
	//传入名次和路珠
	excuteZhmsSelect(lmmssxmc, lmmssxlz);
}
//两面模式方法--筛选路珠
function lmmsLzMethod(type, obj) {
	if(type == "all") {
		var $lmms = $("#lmms>.xuanzhemc .lztype:nth-child(2)");
		var html = $lmms.html();
		lmmssxlz.push($lmms.find("span").text());
		$lmms.addClass("selected")
		excuteZhmsSelect(lmmssxmc, lmmssxlz);
		return;
	}
	var $obj = $(obj);
	$obj.removeClass("hoverli");
	var clicktxt = $obj.find("span").text();
	if(config.ifdebug) {
		console.log("clicktxt:" + clicktxt + "hasclass:" + $obj.hasClass("checked"));
	}
	$obj.siblings().removeClass("selected");
	$obj.addClass("selected");
	lmmssxlz = [];
	lmmssxlz.push(clicktxt);
	if(config.ifdebug) {
		console.log("dxmssxlz" + JSON.stringify(lmmssxlz));
	}
	excuteZhmsSelect(lmmssxmc, lmmssxlz);
}
//***************两面模式*****end*********************

//隐藏和显示//前面为名次，后面为路珠
function excuteZhmsSelect(mc, lz) {
	var newselected = [];
	for(var i = 0, len1 = mc.length; i < len1; i++) {
		for(var j = 0, len2 = lz.length; j < len2; j++) {
			if(mc[i] >= 6) {
				if(lz[j] > 2) {
					continue;
				} else {
					newselected.push(mc[i] + "" + lz[j]);
				}
			} else {
				newselected.push(mc[i] + "" + lz[j]);
			}
		}
	}
	if(config.ifdebug) {
		console.log("所显示的divbox：" + newselected + "    newselectedlength:" + newselected.length);
	}
	$(".box .item").hide();
	$(newselected).each(function(index) {
		$("#box" + newselected[index]).show();
	})
}
//单选模式方法
function dxmsMethod() {
	$($("#zhms").find("li")).each(function(index) {
		if(config.ifdebug) {
			console.log($(this).html());
		}
	})
}
//两面模式方法
function lmmsMethod() {
	$($("#zhms").find("li")).each(function(index) {
		if(config.ifdebug) {
			console.log($(this).html());
		}
	})
}
//综合路珠页面的功能操作************************end*****************

//开奖数据格式转换
function typeOf(num, type) {
	if(type == "rank") {
		switch(num * 1) {
			case 1:
				return "冠军";
				break;
			case 2:
				return "亚军";
				break;
			case 3:
				return "第三名";
				break;
			case 4:
				return "第四名";
				break;
			case 5:
				return "第五名";
				break;
			case 6:
				return "第六名";
				break;
			case 7:
				return "第七名";
				break;
			case 8:
				return "第八名";
				break;
			case 9:
				return "第九名";
				break;
			case 10:
				return "第十名";
				break;
			case 11:
				return "冠亚和";
				break;
		}
	} else if("state") {
		switch(num * 1) {
			case 1:
				return "单双";
				break;
			case 2:
				return "大小";
				break;
			case 3:
				return "龙虎";
				break;
		}
	}
}
//构建路珠开奖记录数据
function createHtmlList(jsondata) {

	var data = null;
	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	var dataarr = data.result.data;
	forRank(dataarr);
}
//根据不同的排名去填值
function forRank(data) {
	$("#table_cltj>tbody").empty();
	$(data).each(function(index) {
		var trhtml = "";
		var numimg = this.code < 10 ? "numsm0" + this.code : "numsm" + this.code;
		trhtml += "<td>" + (index + 1) + "</td>";
		var listrank = this.array;
		$(listrank).each(function(index) {
			trhtml += "<td><span>" + Math.abs(this) + "</span></td>";
		});
		$("#table_cltj>tbody").append("<tr>" + trhtml + "</tr>");
	});
}

function boxList(rank, data) {
	//rank:名次,1-10分别为第一——第十名,11为冠亚和
	//state形态:如1.单双;2.大小;3.龙虎
	//totals：长度为2的数组,数组第一个元素表示单、大、龙;第二个元素表示双、小、虎
	//roadBeads:数组,数组的元素值为0或1,1表示单、大、龙;0表示双、小、虎
	//向不同的box中填值1到5有大小单双龙虎三种类型  6-11到有2个类型，没有龙虎
	var box = "";
	if(rank == 1 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 1 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 1 && data.state == 3) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 3) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 3) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 3) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 3) {
		box = "" + rank + "" + data.state;
	}
	//	else if(rank == 6 && data.state == 1) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 6 && data.state == 2) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 7 && data.state == 1) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 7 && data.state == 2) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 8 && data.state == 1) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 8 && data.state == 2) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 9 && data.state == 1) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 9 && data.state == 2) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 10 && data.state == 1) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 10 && data.state == 2) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 11 && data.state == 1) {
	//		box = "" + rank + "" + data.state;
	//	} else if(rank == 11 && data.state == 2) {
	//		box = "" + rank + "" + data.state;
	//	}
	return box;
}
//根据不同的排名去填值
function forRankYibu(rank, data) {
	var $boxnumb = $("#box" + boxList(rank, data));
	var tdhtml = "";
	//迭代list
	var stylestr = "";
	//得到上一行中最后一个号码判断是否换行追加
	var lastp = $boxnumb.find(".tablebox td:nth-child(1) p:last-child").text();
	$boxnumb.find(".tablebox td:nth-child(1) p:last-child").css({
		"font-weight": "normal"
	});
	var state = data.state;
	var newroadbeads = "";
	if(state == "1") {
		newroadbeads = (data.value == 1) ? "单" : "双";
	} else if(state == "2") {
		newroadbeads = (data.value == 1) ? "大" : "小";
	} else if(state == "3") {
		newroadbeads = (data.value == 1) ? "龙" : "虎";
	}
	if(newroadbeads == "双" || newroadbeads == "龙" || newroadbeads == "大") {
		stylestr = "style='color:#f1020b'";
	}
	var $left_count = $boxnumb.find(".left_count");
	var $right_count = $boxnumb.find(".right_count");
	var leftxt = $left_count.text() * 1 + 1;
	var rigtxt = $right_count.text() * 1 + 1;
	if(newroadbeads == "单") {
		$left_count.text(leftxt);
	} else if(newroadbeads == "双") {
		$right_count.text(rigtxt);
	} else if(newroadbeads == "大") {
		$left_count.text(leftxt);
	} else if(newroadbeads == "小") {
		$right_count.text(rigtxt);
	} else if(newroadbeads == "龙") {
		$left_count.text(leftxt);
	} else if(newroadbeads == "虎") {
		$right_count.text(rigtxt);
	}
	if(lastp == newroadbeads) { //如果与上一次的号码相同则在同一列中追加反之增加新列
		tdhtml = "<p  " + stylestr + ">" + lastp + "</p>"
		$boxnumb.find(".tablebox td:nth-child(1)").append(tdhtml);
	} else {
		var bgcolor = "";
		var hasclas = $boxnumb.find(".tablebox td:nth-child(1)").hasClass("bgcolor");
		if(!hasclas) { //如果为单就加背景
			bgcolor = "bgcolor";
		}
		tdhtml = "<td class='" + bgcolor + "'><p " + stylestr + ">" + newroadbeads + "</p></td>"
		if(lastp == "") { //第一次加载数据时
			$boxnumb.find(".tablebox").append(tdhtml);
		} else { //已经有数据
			$boxnumb.find(".tablebox td:nth-child(1)").before(tdhtml);
		}
	}
	//校正背景
	bgPostionX($boxnumb);
	/*当前开出期字体加粗  附加闪烁效果*/
	var i = 0;
	var result = $boxnumb.find(".tablebox td:nth-child(1) p:last-child");
	result.css({
		"font-weight": "bold"
	});
	var timeOutId = setTimeout(function() {
		result.fadeOut(100).fadeIn(100);
		i++;
		if(i == 1) {
			timeOutId = setInterval(arguments.callee, 600);
		}
		if(i == 30) {
			window.clearInterval(timeOutId);
			//result.css("font-weight", "normal");
		}
	}, 1000);
}

function loadotherData(date) {
	listData(date);
}