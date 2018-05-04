$(function() {
	//设置当前时间
	var current_time = getDateStr(0);
	$("#date").val(current_time);
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
	var ifxgdxlm = ""; //记录选项卡为综合模式
	$(".listheadl").find("span").live("click", function() {
			$(this).siblings().removeClass("xxselected")
			$(this).addClass("xxselected");
			var type = $(this).find("i").text();
			if(type == "1") { //选项卡为综合模式
				ifxgdxlm = "1";
				$("#dxms,#lmms").hide(200);
				$("#zhms").show(200);
				excuteZhmsSelect(zhmssxmc, zhmssxlz);
			} else if(type == "2") { //选项卡为单选模式
				ifxgdxlm = "1";
				$("#zhms,#lmms").hide(200);
				$("#dxms").show(200);
				excuteZhmsSelect(dxmssxmc, dxmssxlz);
			} else if(type == "3") { //选项卡为两面模式
				ifxgdxlm = "3";
				$("#dxms,#zhms").hide(200);
				$("#lmms").show(200);
				excuteZhmsSelect(lmmssxmc, lmmssxlz);
			}
		})
		//今天，昨天，明天选择操作
	$(".listheadrl span").live("click", function() {
			$(this).siblings().removeClass("checked");
			$(this).addClass("checked");
			//createHtmlGetData(null);
			var id = $(this).attr("id");
			if(id == "today") {
				$(".now_l").css("display", "none");
				$(".jinri").css("display", "inline-block");
				$(".jinri").text("今天");
				listData(getDateStr(0));
			} else if(id == "yesterday") {
				$(".now_l").css("display", "none");
				$(".jinri").css("display", "inline-block");
				$(".jinri").text("昨天");
				listData(getDateStr(-1));
			} else if(id == "qianday") {
				$(".now_l").css("display", "none");
				$(".jinri").css("display", "inline-block");
				$(".jinri").text("前天");
				listData(getDateStr(-2));
			}
		})
		//综合
		//兼听点击li
	$(".zhclear").live("click", function() {
		zhmsMcMethod("zhclear", this);
	});
	$(".zhcheckall").live("click", function() {
		zhmsMcMethod("all", this);
	});

	$("#zhms li").hover(function() {
		if($(this).hasClass("checked")) {
			$(this).addClass("hoverli");
		}
	}, function() {
		if($(this).hasClass("hoverli")) {
			$(this).removeClass("hoverli");
		}
	});
	$("#zhms .sinli").live("click", function() {
		zhmsMcMethod("zhchecksing", this);
	});
	$("#zhms .zhmslz .lztype").live("click", function() {
		zhmsLzMethod("zhchecksing", this);
	});
	//单选
	$("#dxms li").hover(function() {
		if($(this).hasClass("checked")) {
			$(this).addClass("hoverli");
		}
	}, function() {
		if($(this).hasClass("hoverli")) {
			$(this).removeClass("hoverli");
		}
	});
	$("#dxms .lztype").live("click", function() {
		dxmsLzMethod("", this);
	});
	$("#dxms .sinli").live("click", function() {
		dxmsMcMethod("", this);
	});
	//两面
	$("#lmms .zhclear").live("click", function() {
		lmmsMcMethod("zhclear", this);
	});
	$("#lmms .zhcheckall").live("click", function() {
		lmmsMcMethod("all", this);
	});
	$("#lmms li").hover(function() {
		if($(this).hasClass("checked")) {
			$(this).addClass("hoverli");
		}
	}, function() {
		if($(this).hasClass("hoverli")) {
			$(this).removeClass("hoverli");
		}
	});
	$("#lmms .sinli").live("click", function() {

		lmmsMcMethod("zhchecksing", this);
	});
	$("#lmms .lztype").live("click", function() {
		lmmsLzMethod("zhchecksing", this);
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
	$("#chakanchfb").delegate("li", "click", function() {});
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
		trigger: '#date',
		zIndex: 999,
		format: 'yyyy-mm-dd',
		onSelected: function(view, date, data) {
			var date = formatDate(date);
			listData(date);
			if(config.ifdebug) {
				console.log("选择日期时触发" + date);
			}
			var date1 = date.split("-");
			var month = parseInt(date1[1]);
			var day = parseInt(date1[2]);
			var current_date = month + "/" + day;
			$(".jinri").css("display", "none");
			$(".now_l").css("display", 'inline-block').text(current_date);
		},
		onClose: function(view, date, data) {
			if(config.ifdebug) {
				console.log("关闭是触发");
			}
		}
	});
	//启动加载数据
	//getData();
	//初始化单选模式
	dxmsMcMethod("all", null);
	dxmsLzMethod("all", null);
	//初始化两面模式
	lmmsMcMethod("all", null);
	lmmsLzMethod("all", null);
	//初始化综合模式
	zhmsMcMethod("all", null);
	zhmsLzMethod("all", null);
	//listData(); //初始页面请求路珠list数据
});

//**************************************************************
function formatDate(date) {
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	m = m < 10 ? '0' + m : m;
	var d = date.getDate();
	d = d < 10 ? ('0' + d) : d;
	return y + '-' + m + '-' + d;
};

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
		} else if(sectype == 0) {
			str = "双";
		} else if(sectype == 2) {
			str = "和";
		}
	} else if(ifds == "大小") {
		if(sectype == 1) {
			str = "大";
		} else if(sectype == 0) {
			str = "小";
		} else if(sectype == 2) {
			str = "和";
		}
	} else if(ifds == "龙虎") {
		if(sectype == 1) {
			str = "龙";
		} else {
			str = "虎";
		}
	} else if(ifds == "尾大尾小") {
		if(sectype == 1) {
			str = "大";
		} else {
			str = "小";
		}
	} else if(ifds == "合单合双") {
		if(sectype == 1) {
			str = "单";
		} else {
			str = "双";
		}
	} else if(ifds == "中发白") {
		if(sectype == 2) {
			str = "中";
		} else if(sectype == 3) {
			str = "发";
		} else if(sectype == 4) {
			str = "白";
		}
	} else if(ifds == "东南西北") {
		if(sectype == 5) {
			str = "东";
		} else if(sectype == 6) {
			str = "南";
		} else if(sectype == 7) {
			str = "西";
		} else if(sectype == 8) {
			str = "北";
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
//公共URL前缀
//请求路珠list数据
function listData(date) {
	var date = (date == undefined ? "" : date);
	$.ajax({
		url: urlbublic + "ElevenFive/queryComprehensiveRoadBead.php?date=" + date,
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
	//	return {
	//		today: year + "-" + mon + "-" + da,
	//		yesterday
	//	}
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
				newselected.push(mc[i] + "" + lz[j]);
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
	if(dataarr.length <= 1) {
		$(".listcontent").find(".box").hide();
	} else {
		$(".listcontent").find(".box").show();
		$(dataarr).each(function(index) {
			forRank(dataarr[index].rank, dataarr[index])
		});
	}
}
//构建路珠开奖记录异步数据
function createHtmlGetData(jsondata) {
	if(config.ifdebug) {
		console.log("路珠异步请求结果：" + JSON.stringify(jsondata));
	}
	var data = null;
	if(typeof jsondata != "object") {
		data = JSON.parse(jsondata);
	} else {
		data = JSON.stringify(jsondata);
		data = JSON.parse(data);
	}
	var dataarr = data.result.data;
	$(dataarr).each(function(index) {
		forRankYibu(dataarr[index].rank, dataarr[index])
	})
}
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
function forRank(rank, data) {
	/*
	date日期
	businessCode
	String 业务状态码。100002:查询结果集为空，详情见错误列表
	date 路珠统计的日期
	rank 名次,1-5对应1-5号球，6对应总合7 龙虎 8 尾大小
	state 形态:如1.单双;2.大小;3.龙虎
	totals 长度为3的数组,数组第一个元素表示单、大、龙;第二个元素表示双、小、虎;第三个表示和
	roadBeads rank不等于7的时候：1代表大 双 ；0代表和 -1代表小 单rank等于7的时候为龙虎1代表龙 0代表虎
	*/
	var $boxnumb = $("#box" + boxList(rank, data));
	if(data.state == "6") {
		$boxnumb.find(".z_count").text(data.totals[0]);
		$boxnumb.find(".f_count").text(data.totals[1]);
		$boxnumb.find(".b_count").text(data.totals[2]);
	} else if(data.state == "7") {
		$boxnumb.find(".d_count").text(data.totals[0]);
		$boxnumb.find(".n_count").text(data.totals[1]);
		$boxnumb.find(".x_count").text(data.totals[2]);
		$boxnumb.find(".b_count").text(data.totals[3]);
	} else if(data.state == "3"){
		$boxnumb.find(".right_count").text(data.totals[2]);
		$boxnumb.find(".left_count").text(data.totals[0]);
		$boxnumb.find(".h_count").text(data.totals[1]);
	} else if(data.state == "2"){
		$boxnumb.find(".left_count").text(data.totals[0]);
		$boxnumb.find(".right_count").text(data.totals[1]);
		$boxnumb.find(".h_count").text(data.totals[2]);
	} else{
		$boxnumb.find(".left_count").text(data.totals[1]);
		$boxnumb.find(".right_count").text(data.totals[0]);
		$boxnumb.find(".h_count").text(data.totals[2]);
	}
	var rankpm = typeOf("qiu1", data.rank);
	if(data.rank == "6") {
		rankpm = "总和";
	} else if(data.rank == "7") {
		rankpm = "和尾";
	}
	$boxnumb.find(".ifgj").text(rankpm);
	$boxnumb.find(".ifds").text(typeOf("state", data.state));
	var tdhtml = "";
	$boxnumb.find(".tablebox").empty();
	//迭代list
	$(data.roadBeads).each(function(index) {
		var stylestr = "";
		//得到上一行中最后一个号码判断是否换行追加
		var lastp = $boxnumb.find(".tablebox td:nth-child(1) p:last-child").text();
		$boxnumb.find(".tablebox td:nth-child(1) p:last-child").css({
			"font-weight": "normal"
		});
		var state = data.state;
		var newroadbeads = "";
		if(state == "1") {
			var indexval = data.roadBeads[index];
			if(indexval == 1) {
				newroadbeads = "双";
			} else if(indexval == 0) {
				newroadbeads = "和";
			} else if(indexval == -1) {
				newroadbeads = "单";
			}
		} else if(state == "2") {
			var indexval = data.roadBeads[index];
			if(indexval == 1) {
				newroadbeads = "大";
			} else if(indexval == 0) {
				newroadbeads = "和";
			} else if(indexval == -1) {
				newroadbeads = "小";
			}
		} else if(state == "3") {
			newroadbeads = (data.roadBeads[index] == 1) ? "龙" : "虎";
		}

		if(newroadbeads == "双" || newroadbeads == "龙" || newroadbeads == "大") {
			stylestr = "style='color:#f1020b'";
		} else if(newroadbeads == "和") {
			stylestr = "style='color:#0092dd'";
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

		};
	});
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
	} else if(rank == 1 && data.state == 4) {
		box = "" + rank + "" + data.state;
	} else if(rank == 1 && data.state == 5) {
		box = "" + rank + "" + data.state;
	} else if(rank == 1 && data.state == 6) {
		box = "" + rank + "" + data.state;
	} else if(rank == 1 && data.state == 7) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 3) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 4) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 5) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 6) {
		box = "" + rank + "" + data.state;
	} else if(rank == 2 && data.state == 7) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 3) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 4) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 5) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 6) {
		box = "" + rank + "" + data.state;
	} else if(rank == 3 && data.state == 7) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 3) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 4) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 5) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 6) {
		box = "" + rank + "" + data.state;
	} else if(rank == 4 && data.state == 7) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 4) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 5) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 6) {
		box = "" + rank + "" + data.state;
	} else if(rank == 5 && data.state == 7) {
		box = "" + rank + "" + data.state;
	} else if(rank == 6 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 6 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 6 && data.state == 4) {
		box = "" + rank + "" + data.state;
	} else if(rank == 6 && data.state == 5) {
		box = "" + rank + "" + data.state;
	} else if(rank == 6 && data.state == 6) {
		box = "" + rank + "" + data.state;
	} else if(rank == 6 && data.state == 7) {
		box = "" + rank + "" + data.state;
	} else if(rank == 7 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 7 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 7 && data.state == 4) {
		box = "" + rank + "" + data.state;
	} else if(rank == 7 && data.state == 5) {
		box = "" + rank + "" + data.state;
	} else if(rank == 7 && data.state == 6) {
		box = "" + rank + "" + data.state;
	} else if(rank == 7 && data.state == 7) {
		box = "" + rank + "" + data.state;
	} else if(rank == 8 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 8 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 8 && data.state == 4) {
		box = "" + rank + "" + data.state;
	} else if(rank == 8 && data.state == 5) {
		box = "" + rank + "" + data.state;
	} else if(rank == 8 && data.state == 6) {
		box = "" + rank + "" + data.state;
	} else if(rank == 8 && data.state == 7) {
		box = "" + rank + "" + data.state;
	} else if(rank == 9 && data.state == 1) {
		box = "" + rank + "" + data.state;
	} else if(rank == 9 && data.state == 2) {
		box = "" + rank + "" + data.state;
	} else if(rank == 9 && data.state == 4) {
		box = "" + rank + "" + data.state;
	}
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

function loadotherData() {
	listData(getDateStr(0));
	$(".listheadrl span").siblings().removeClass("checked");
	$("#today").addClass("checked");
	$(".jinri").text("今天");
}