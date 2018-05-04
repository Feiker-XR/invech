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

	//今天，昨天，前天选择操作
	$(".listheadrl span").live("click", function() {
			$(this).siblings().removeClass("checked");
			$(this).addClass("checked");
			//createHtmlGetData(null);
			var id = $(this).attr("id");
			var $sinli4 = $("#biaozxz .sinli:nth-child(4)");
			var $sinli5 = $("#biaozxz .sinli:nth-child(5)");
			if($sinli4.hasClass("checked")) {
				$sinli4.removeClass("checked");
			}
			if($sinli5.hasClass("checked")) {
				$sinli5.removeClass("checked");
			}
			listData();

		})
		//综合
		//两面
	$("#biaozxz .zhclear").live("click", function() {
		zoushiMethod("zhclear", this);
	});
	$("#biaozxz .zhcheckall").live("click", function() {
		zoushiMethod("all", this);
	});
	$("#biaozxz li").hover(function() {
		if($(this).hasClass("checked")) {
			$(this).addClass("hoverli");
		}
	}, function() {
		if($(this).hasClass("hoverli")) {
			$(this).removeClass("hoverli");
		}
	});
	//点击选择菜单
	$("#biaozxz .sinli").live("click", function() {

		$(this).removeClass("hoverli");
		var index = $(this).find("i").text();
		if(index == "1") { //隐藏遗漏
			if($(this).hasClass("checked")) {
				$(this).removeClass("checked")
				$(".yilou span").css("display", "none");
			} else {
				$(this).addClass("hoverli");
				$(this).addClass("checked")
				$(".yilou span").css("display", "block");
			}
		} else if(index == "2") { //隐藏折线
			if($(this).hasClass("checked")) {
				$(this).removeClass("checked")
				$("#chartLinediv canvas").css("display", "none");
			} else {
				$(this).addClass("hoverli");
				$(this).addClass("checked")
				$("#chartLinediv canvas").css("display", "block");
			}
		} else if(index == "3") { //遗漏分层
			if($(this).hasClass("checked")) {
				$(this).removeClass("checked")
				$("#chartLinediv .yilou").removeClass("yiloufc");
			} else {
				yilouFc(); //执行分层操作
				$(this).addClass("hoverli");
				$(this).addClass("checked")
			}
		} else if(index == "4") { //分隔线
			if($(this).hasClass("checked")) {
				$(this).removeClass("checked")
//				$("#table_weizhi .yilou").removeClass("yiloufc");
				$("#table_weizhi").find("tr[class='line_x']").remove();
//				fengeX(); //分割线
				drawLine("table_weizhi"); //画线
			} else {
				fengeX(); //分割线
				$(this).addClass("hoverli");
				$(this).addClass("checked")

			}
		}
	});

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
});

//**************************************************************
//显示或隐藏table
function showTables(index) {
	$("#table_weizhi").show();
	drawLine("table_weizhi"); //画线
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
//遗漏分层
function fengeX() {
	var tr = $("#table_weizhi tbody tr");
	var trLen = tr.length;
	tr.each(function(i, tr) {
		var tdLen = $(this).find("td").length;
		if(i > 0 && (i + 1) % 5 == 0) {
			$(tr).after("<tr class='line_x' style='height:0px'><td class='botmline2' style='height:0px;background-color:#dbdbdb' colspan='" + tdLen + "'></td></tr>")
		}
	});
	drawLine("table_weizhi"); //画线
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
//头部开奖数据请求
//请求路珠list数据传入参数：time:时间；periods：期数
function listData() {
	var time = ifChecked().time == undefined ? "" : ifChecked().time;
	var issue = ifChecked().issue == undefined ? "" : ifChecked().issue;
	$.ajax({
		url: urlbublic + "CQShiCai/queryCQShiCaiTrendByDT.php?issue=" + issue + "&date=" + time,
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
		issue = "50";
	} else if(id == "ninety") {
		issue = "100";
	}
	return {
		num: num,
		issue: issue,
		time: time
	}
}

function parseTonum(str) {
	return str.charAt(0) * 1 <= 0 ? str.charAt(1) : str;
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
//动画方法
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
//综合路珠页面的功能操作************************start***************
var lmmssxmc = []; //筛选名次
var lmmssxlz = []; //选择路珠
//***************两面模式*****start*********************
//两面模式方法--筛选名次
function zoushiMethod(type, obj) {
	var $obj = $(obj);
	$obj.removeClass("hoverli");
	//全选
	if(type == "all") {
		lmmssxmc = []; //清空数组
		if(!(lmmssxmc.length >= 10)) {
			$($("#biaozxz").find(".sinli")).each(function(index) {
				if($(this).hasClass("title") || $(this).hasClass("zhcheckall") || $(this).hasClass("zhclear")) {
					return;
				} else {
					lmmssxmc.push($(this).find("i").text());
					$(this).addClass("checked");
				}
			});
		}
		console.log("全选" + JSON.stringify(lmmssxmc));
		//清空
	} else if(type == "zhclear") {
		$($("#biaozxz").find(".sinli")).each(function(index) {
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
	$(lmmssxmc).each(function(index) {
		$("#box" + $(this) + "4").show();
	})
	excuteZhmsSelect(lmmssxmc, ["4"]);
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
//构建路珠开奖记录异步数据
//校正背景偏移
function bgPostionX($boxnumb) {
	var tdlenth = $boxnumb.find(".tablebox td").length;
	if(tdlenth % 2 != 0) {
		$boxnumb.find(".item_con").css({
			"background-positionX": "0"
		});
	} else {
		$boxnumb.find(".item_con").css({
			"background-positionX": "-29px"
		});
	}
}
//根据不同的排名去填值
function forRank(data) {
	/*preIssue 开奖期数
	drawCode 数组，开始号码
	rank 名次,1-10名
	array  遗漏值，数组中小于零的值表示当前遗漏值，大于零表示当前名次在该号码上连接出现的次数
	appearCount 出现次数,数组长度为22
	averageMissingValues 平均遗漏值,数组长度为22
	maxMissingValues 最大遗漏值,数组长度为22
	maxAppearValues 最大连续出现值,数组长度为22
	currentMissingValues 当前遗漏值,数组长度为22*/
	var num = ifChecked().num;
	var tdhtml = "";
	$("#table_weizhi tbody").empty();
	//迭代10名，为10个table加载数据
	$(data).each(function(index) {
		//清空table数据
		//循环bodylist
		$(this.bodyList).each(function() {
			var preIssue = '<td class="leftth">' + this.issue + '</td>';
			var code = this.code;
			code = code.split(",");
			var tdspanl = "<td>";
			var tdspanr = "</td>";
			var preDrawCode = "";
			$(code).each(function() {
				preDrawCode += '<span class="kaijnum">' + this + '</span>';
			})
			preDrawCode = tdspanl + "" + preDrawCode + "" + tdspanr;
			var rank1 = "",
				rank2 = "",
				rank3 = "",
				rank4 = "",
				rank5 = "";

			var subBodyList = this.array;
			$(subBodyList).each(function(index) {
				var title = "";
				if(this * 1 >= 0) {
					title = "title='0'";
				} else {
					title = "class='rank1 yilou'";
				}
				rank1 += "<td " + title + "><span>" + Math.abs(this) + "" + tdspanr;
			});
			var tr = "<tr class='yiloutr' height='32'>" + preIssue + "" + preDrawCode + "" + rank1 + "</tr>";
			$("#table_weizhi tbody").append(tr);
		});
		//组装第二个表头
		var tbodyhead = '<tr class="firthtd"><th rowspan="2" colspan="2" width="85" height="38" class="left_border left_b left_strong_down">数据统计</th><th colspan="10"width="40"id="qiuhao">第<span class="title1">一</span>球号码走势</th><th colspan="10"width="40"id="qiuhao">第<span class="title2">五</span>球号码走势</th><th colspan="3"width="40"id="qiuhao"><span class="title3">龙虎</span></th></tr><tr  class="secondtd"><th width="40">0</th><th width="40">1</th><th width="40">2</th><th width="40">3</th><th width="40">4</th><th width="40">5</th><th width="40">6</th><th width="40">7</th><th width="40">8</th><th width="40">9</th><th width="40">0</th><th width="40">1</th><th width="40">2</th><th width="40">3</th><th width="40">4</th><th width="40">5</th><th width="40">6</th><th width="40">7</th><th width="40">8</th><th width="40">9</th><th width="40">龙</th><th width="40">虎</th><th width="40">和</th></tr>';

		$("#table_weizhi tbody").append(tbodyhead);
		var tdline = "";
		var tr1 = "<td class='font14' colspan='2'>出现次数</td>";
		var tr2 = "<td class='font14' colspan='2'>平均遗漏</td>";
		var tr3 = "<td class='font14' colspan='2'>最大遗漏</td>";
		var tr4 = "<td class='font14' colspan='2'>最大连出</td>";
		//循环最大连出
		$(this.missList).each(function(index) {
			//不同的索引添加不同的表头
			if(index == 0) {
				$(this.array).each(function() {
					tr1 += "<td class='font14'>" + this + "</td>";
				})
			} else if(index == 1) {
				$(this.array).each(function() {
					tr2 += "<td class='font14'>" + this + "</td>";
				})
			} else if(index == 2) {
				$(this.array).each(function() {
					tr3 += "<td class='font14'>" + Math.abs(this) + "</td>";
				})
			} else if(index == 3) {
				$(this.array).each(function() {
					tr4 += "<td class='font14'>" + this + "</td>";
				})
			}
		})
		$("#table_weizhi tbody").append("<tr>" + tr1 + "</tr><tr>" + tr2 + "</tr><tr>" + tr3 + "</tr><tr>" + tr4 + "</tr>");
		var table = "table_weizhi" + (index + 1);
	});
	//初始化第一个冠军
	showTables("1");
}
//执行画线
function drawLine(table) {
	$("#chartLinediv canvas").remove();
	tablename = table;
	$("#" + tablename).find("tr").each(
		function() {
			$(this).find("td").each(
				function(index) {
					if($(this).hasClass("yilou") || $(this).attr("title") == 0) {
						if(index >= 2 && index <= 11) {
							$(this).css({
								"background": "#fcf8f3"
							});
						} else if(index >= 12 && index <= 21) {
							$(this).css({
								"background": "#f0f9fc"
							});
						} else if(index >= 22 && index <= 31) {
							$(this).css({
								"background": "#f0fcf0"
							});
						}
					}
					if($(this).attr("title") == "0") {
						if($(this).index() >= 2 && $(this).index() <= 11) {
							$(this).attr("class", "hot " + $(this).removeClass("grey").attr("class")).find("span").attr("name", "hotSpan").text($(this).attr("name")).attr("class", "zoushiqiu bBK");
							$(this).find("span").css("background", color[0]);
						} else if($(this).index() >= 12 && $(this).index() <= 21) {
							$(this).attr("class", "hot " + $(this).removeClass("grey").attr("class")).find("span").attr("name", "hotSpan").text($(this).attr("name")).attr("class", "zoushiqiu gB");
							$(this).find("span").css("background", color[1]);
						} else if($(this).index() >= 22 && $(this).index() <= 31) {
							$(this).attr("class", "hot " + $(this).removeClass("grey").attr("class")).find("span").attr("name", "hotSpan").text($(this).attr("name")).attr("class", "zoushiqiuf oB");
							$(this).find("span").css("background", color[3]);
							if($(this).index() == 22) {
								$(this).find("span").text("龙");
							} else if($(this).index() == 23) {
								$(this).find("span").text("虎");
							} else if($(this).index() == 24) {
								$(this).find("span").text("和");
							}
						}
					}
				});
		}
	);
	$("#" + tablename + " tr").eq($("#" + tablename + " tr").length - 8).find("td").removeClass("tdbb").addClass("tdbbs");
	//画线
	chartOfBaseTrend.ccslonghxt();
}

//将数据拼成字符串
function diyString(strarr) {
	var str = "";
	$(strarr).each(function() {
		str += "&nbsp;" + this;
	})
	return str;
}
//头部完成请求后加载list数据
function loadotherData() {
	//	listData();
	$(".listheadrl span").siblings().removeClass("checked");
	$("#thirty").addClass("checked");
	listData("", "30"); //ifChecked方法重新加载数据，先获取".checked"(必须放移除类只后之)
}