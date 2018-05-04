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
		//选择同位号码
	$("#showt").live("click", function() {
		$(this).removeClass("hoverli");
		if($(this).hasClass("checked")) {
			$(this).removeClass("checked");
			$("#table_weizhi").find(".code").css({
				"border": "",
				"color": "#999999"
			});
		} else {
			$(this).addClass("hoverli");
			$(this).addClass("checked");
			var num = $("#table_weizhi").find(".code").text()[0];
			$("#table_weizhi").find(".code").css({
				"border": "1px solid " + choseColor(num),
				"color": choseColor(num)
			});
		}
	});
	$("#showt").hover(function() {
		if($(this).hasClass("checked")) {
			$(this).addClass("hoverli");
		}
	}, function() {
		if($(this).hasClass("hoverli")) {
			$(this).removeClass("hoverli");
		}
	});
	//选择名次
	$(".xuanzhemc .sinli").live("click", function() {
			$(this).siblings().removeClass("selected");
			$(this).addClass("selected");
			//执行显示或者隐藏的方法
			showTables();
			$("#showt").removeClass("checked");
		})
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
	//当前行计算连续出现的次数
	$(".box .btnCheck").live("click", function() {
		tongjiCount($(this)); //调用统计方法
	});

	//大小单双分布  ---大小
	$("#daxiaodsfb").delegate("li", "click", function() {});
	//判断是否为大小 type：为当前点击按钮类型 ifmyself：表示当时按钮是否取消选中
	function excuteDx(type, ifmyself) {}
	$("#waringbox").delegate("i", "click", function() {
		$(this).parent().parent().hide("200");
	});
	//初始化时间控件
	$('#datebox').calendar({
		trigger: '.date',
		zIndex: 999,
		format: 'yyyy-mm-dd',
		onSelected: function(view, date, data) {
			var date = formatDate(date);
			showTables();
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
	//drawZzt();//绘制柱状图
	//getData();
	//showTables();
});

//**************************************************************
//选择颜色
function choseColor(num) {
	var color = ["rgb(230, 222, 0)", "rgb(0, 146, 221)", "rgb(75, 75, 75)", "rgb(255, 118, 0)", "rgb(23, 226, 230)", "rgb(82, 52, 255)", "rgb(191, 191, 191)", "rgb(255, 38, 0)", "rgb(120, 11, 0)", "rgb(7, 191, 0)"];
	switch(num * 1) {
		case 1:
			return color[0];
			break;
		case 2:
			return color[1];
			break;
		case 3:
			return color[2];
			break;
		case 4:
			return color[3];
			break;
		case 5:
			return color[4];
			break;
		case 6:
			return color[5];
			break;
		case 7:
			return color[6];
			break;
		case 8:
			return color[7];
			break;
		case 9:
			return color[8];
			break;
		case 10:
			return color[9];
			break;
	}
}
//绘制柱状图
function drawZzt(datacs) {
	//启动加载数据
	// 基于准备好的dom，初始化echarts实例
	var myChart = echarts.init(document.getElementById('qushit'));
	//底部数据
	var paimin = ['号码1', '号码2', '号码3', '号码4', '号码5', '号码6', '号码7', '号码8', '号码9', '号码10'];
	//var datacs = [8, 6, 4, 4, 5, 7, 8, 3, 4, 3];
	// 指定图表的配置项和数据
	var option = {
		tooltip: {
			trigger: 'axis',
			background: 'rgba(255,217,175,0.3)',
			axisPointer: { // 坐标轴指示器，坐标轴触发有效
				type: 'shadow', // 默认为直线，可选为：'line' | 'shadow'
				shadowStyle: {
					color: 'rgba(255,217,175,0.3)'
				}
			},
			formatter: function(params) {
				var value = params[0].name + "<br>" + params[0].seriesName + "" + params[0].value;
				var html = "<div style='font-size:10px;'>" + value + "</div>";
				return html;
			}
		},
		color: ['#fa8e19', '#e47700'],
		legend: {
			selectedMode: true,
			data: ['Acutal', 'Forecast']
		},
		calculable: false,
		xAxis: [{
			type: 'category',
			data: paimin,
		}],
		yAxis: [{
			type: 'value',
			boundaryGap: [0, 0.01],
			splitLine: {
				show: true,
				lineStyle: {
					color: '#d6d6d6',
					width: 1,
					type: 'dotted'
				}
			}
		}],
		series: [{
			name: '次数',
			type: 'bar',
			barWidth: 50,
			data: datacs //动态数据
		}]
	};
	// 使用刚指定的配置项和数据显示图表。
	myChart.setOption(option);
}
//显示或隐藏table
function showTables() {
	var code = $("#biaozxz li[class='sinli selected']").find("span").text();
	var periods = $(".listheadrl").find("span[class='checked']").attr("title");
	listData(periods, code); //画线
}
//遗漏分层
function yilouFc() {
	var table = $("#chartLinediv table");
	var tableid = "";
	$(table).each(function(index) {
		var iftable = $(this).css("display");
		if(iftable == "table") {
			tableid = $(this).attr("id");
		}
	})
	var tr = $("#" + tableid + " tbody tr[class='yiloutr']");
	var trLen = tr.length;
	var tdcount = tr.filter(":first").children("td").size();
	for(var i = 2; i < tdcount; i++) {
		for(var j = 0; j <= trLen; j++) {
			var $td = tr.eq(j).children("td").eq(i);
			if($td.attr("title") == '0') {
				break;
			}
			$td.addClass("yiloufc");
		}
	}
}
function ifChecked() {
	var id = $(".listheadrl").find("span[class='checked']").attr("id");
	var num = $("#biaozxz").find("li[class='sinli selected']").find("span").text();
	var issue = null;
	var time = null;
	if(id == "today") {
		time = getDateStr(0);
	} else if(id == "yesterday") {
		time = getDateStr(-1);
	} else if(id == "qianday") {
		time = getDateStr(-2);
	} else if(id == "thirty") {
		issue = "30";
	} else if(id == "sixty") {
		issue = "60";
	} else if(id == "ninety") {
		issue = "90";
	}
	return {
		num: num,
		issue: issue,
		time: time
	}
}
//遗漏分层
function fengeX() {
	var tr = $("#table_ganyah tbody tr");
	var trLen = tr.length;
	tr.each(function(i, tr) {
		var tdLen = $(this).find("td").length;
		if(i > 0 && (i + 1) % 5 == 0) {
			$(tr).after("<tr class='line_x' style='height:0px'><td class='botmline2' style='height:0px;background-color:#dbdbdb' colspan='" + tdLen + "'></td></tr>")
		}
	});
	drawLine();
}

function formatDate(date) {
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	m = m < 10 ? '0' + m : m;
	var d = date.getDate();
	d = d < 10 ? ('0' + d) : d;
	return y + '-' + m + '-' + d;
};
//统计路珠类型
function tongjiCount(obj) {
	var $obj = $(obj);
	//得到选择的次数
	var txtNum = $obj.parent().find(".txtNum").val();
	//得到路珠类型
	var sectype = $obj.parent().find(".secType").val();
	//得到路珠类型
	var ifds = $obj.parent().parent().find(".ifds").text();
	var str = "";
	if(ifds == "单双") {
		if(sectype == 1) {
			str = "单";
		} else {
			str = "双";
		}
	} else if(ifds == "大小") {
		if(sectype == 1) {
			str = "大";
		} else {
			str = "小";
		}
	} else if(ifds == "龙虎") {
		if(sectype == 1) {
			str = "龙";
		} else {
			str = "虎";
		}
	} else if(ifds == "前后") {
		if(sectype == 1) {
			str = "前";
		} else {
			str = "后";
		}
	}
	$obj.parent().parent().parent().parent().parent().find(".tablebox").html();
	var $tdlist = $obj.parent().parent().parent().parent().parent().find(".tablebox").children();
	var countnum = 0;
	$tdlist.each(function(index) {
		var count = $(this).find("p").length;
		$(this).css({
			"background-color": "",
			"color": "#666666"
		});
		if(count >= txtNum && str == $(this).children('p').html()) {
			$(this).css({
				"background-color": "rgb(253, 173, 86)",
				"color": "#fff"
			});
			countnum += 1;
		}
	});
	$obj.parent().parent().find(".sec_count").text(countnum);
}
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
	listData("30", "1");
	$(".listheadrl span").siblings().removeClass("checked");
	$("#thirty").addClass("checked");
	showTables();
}
//请求路珠list数据传入参数：time:时间；periods：期数
function listData(periods, code) {
	var code = $("#biaozxz li[class='sinli selected']").find("span").text();
	periods = periods == undefined ? "30" : periods; //如果请求数据periods为undefined处理为""
	code = code == undefined ? "1" : code; //如果请求数据periods为undefined处理为""
	var time = ifChecked().time == undefined ? "" : ifChecked().time;
	var num = ifChecked().num == undefined ? "" : ifChecked().num;
	var issue = ifChecked().issue == undefined ? "" : ifChecked().issue;
	
	$.ajax({
		url: "http://www.900kcw.com/?r=home/count/pk10_count_number&periods=" + issue + "&code=" +code+"&date="+time,
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
				loadotherData() //重新请求list数据
			},5000);
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

//初始加载动画
function excuteAnimate(arr, id) {
	var arr = arr;
	var id = id;
	var arrlength = arr.length;
	var time = 0;
	var jnumberid = $(id);
	$(jnumberid).html("");
	var timer = setInterval(function() {
		if(time < arrlength) {
			var lihtml = "<li class='nub" + arr[time] + "'><i style='font-size:10px'>" + arr[time] + "</i></li>";
			$(jnumberid).append(lihtml);
			time++;
		} else {
			clearInterval(timer);
		}
	}, 100);
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

//隐藏和显示//前面为名次，后面为路珠
function excuteZhmsSelect(mc, lz) {
	$(mc).each(function() {
		if(this == "1") { //遗漏
			$("#table_ganyah .yilou").find("span").hide();
		} else if(this == "2") { //拆线

		} else if(this == "3") { //遗漏分层

		} else if(this == "4") { //分隔线

		}
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
	} else if(type == "state") {
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
			case 4:
				return "前后";
				break;
		}
	} else if(type == "spj") {
		switch(num * 1) {
			case -1:
				return "降";
				break;
			case 0:
				return "平";
				break;
			case 1:
				return "升";
				break;
		}
	}
}
//格式化数据
function createHtmlList(jsondata) {
	var data = null;
	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	var dataarr = data.result.data;
	//drawLine("table_weizhi");
	forRank(dataarr);
}
//根据不同的排名去填值
function forRank(data) {
	/*	preIssue
		preIssue 开奖期数
		preDrawTime 开奖时间
		preDrawCode 开始号码
		code 参考号码,如.号码1
		codeIndex 参考号码的位置,从0开始
		displayCode 本期应该显示号码
		changeState 形态.-1.降;0.平;1.升
		singleState 单双形态.1.单;0双
		bigState 大小形态.1.大;0.小
		diagramList 数组，分别表示参考号码，对应的1-10号码在同位出现的次数*/
	//装载柱状图数据
	drawZzt(data.diagramList);
	var tdhtml = "";
	$("#table_weizhi tbody").empty();
	//迭代10名，为10个table加载数据
	//循环bodylist
	$(data.tableList).each(function() {
		var preIssue = '<td><span class="title">' + this.preIssue + '</span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#51627e">' + this.preDrawTime + '</span></td>'; //期号和时间
		var displayCode = this.displayCode;
		var missingtd = "";
		var predraw = this.preDrawCode;
		var code = this.code;
		$(predraw).each(function(index) {
			var title = "";
			var bgqiu = "";
			var value = "";
			var titlevalue = "";
			if(this == displayCode) {
				title = "title='0'";
				var num = Math.abs(this);
				var numimg = num < 10 ? "numss0" + num : "numss" + num;
				bgqiu = "class='" + numimg + "'";
				value = "";
				titlevalue = num;
			} else {
				value = Math.abs(this);
				title = "class='yilou'";
				if(code == this) {
					bgqiu = "class='code'";
				}
			}
			var stylebg = "";
			if(index < 10) {
				stylebg = "style='border:none;border-bottom:1px solid #e5e5e5;overflow:hidden;width:35px;font-size:16px'"
			}
			missingtd += "<td " + stylebg + " " + title + "><span " + bgqiu + " title='" + titlevalue + "'>" + value + "</span></td>";
		});
		var shestyle = "";
		var spj = typeOf(this.changeState, "spj");
		if(spj == "升") {
			shestyle = "style='color:#f1010a'";
		} else if(spj == "平") {
			shestyle = "style='color:#666666'";
		} else if(spj == "降") {
			shestyle = "style='color:#0092dd'";
		}
		var changeState = '<td ' + shestyle + '>' + spj + '</td>'; //升降平

		var dan = "";
		var suan = "";
		if(this.singleState == "1") {
			dan = "单";
		} else if(this.singleState == "0") {
			suan = "双";
		}
		var singleStatetd = '<td>' + dan + '</td><td style="color:#f1010a">' + suan + '</td>'; //单双
		var da = "";
		var xiao = "";
		if(this.bigState == "1") {
			da = "大";
		} else if(this.bigState == "0") {
			xiao = "小";
		}
		var bigState = '<td style="color:#f1010a">' + da + '</td><td>' + xiao + '</td>'; //大小
		var tr = "<tr class='yiloutr'>" + preIssue + "<td style='border:none;border-bottom:1px solid #e5e5e5;'>&nbsp;&nbsp;</td>" + missingtd + "<td style='border:none;border-bottom:1px solid #e5e5e5;'>&nbsp;&nbsp;</td>" + changeState + "" + singleStatetd + "" + bigState + "</tr>";
		$("#table_weizhi tbody").append(tr);
	});
	drawLine("table_weizhi");
}
//执行画线
function drawLine(table) {
	$("#chartLinediv canvas").remove();
	tablename = table;
	if(config.ifdebug) {
		console.log(tablename + "22222");
	}
	$("#" + tablename).find("tr").each(
		function() {
			$(this).find("td").each(
				function() {
					if($(this).attr("title") == "0") {
						var titval = $(this).find("span").attr("title");
						titval = titval < 10 ? "numss0" + titval : "numss" + titval;
						//						console.log(titval+"11111111111111111111");
						$(this).attr("class", "hot").find("span").attr("name", "hotSpan").text($(this).attr("name")).attr("class", "zoushinum " + titval);
						//						$(this).find("span").css("background", color[1]);
					}
				});
		}
	);
	$("#" + tablename + " tr").eq($("#" + tablename + " tr").length - 8).find("td").removeClass("tdbb").addClass("tdbbs");
	//画线
	chartOfBaseTrend.haomagltj();
}