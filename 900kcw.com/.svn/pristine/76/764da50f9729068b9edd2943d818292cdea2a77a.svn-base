$(function() {
	//开启加载动画
	animateMethod.loadingList("#jrsmhmtj",true);
	//更多
	$("#morelist").mouseover(function(){
		$(".sub_morelist").show();
		$(".more").css("border-color","#fa8e19").css('border-bottom-color','#ffffff').css("color","#fa8e19");
		$(".graypre").css("display","none");
		$(".yellowpre").css("display","inline-block");
	}).mouseout(function(){
		$(".sub_morelist").hide();
		$(".more").css('border-color','#ffffff').css("color","#333333");
		$(".graypre").css("display","inline-block");
		$(".yellowpre").css("display","none");
	});
//	//头部完成请求后加载list数据
//	loadotherData();
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


	//定义统一透明样式兼容IE8
	function opacity(obj, num, filt) {
		obj.style.filter = "alpha(opacity:" + filt + ")";
		obj.style.opacity = num;
	}

	$("#waringbox").delegate("i", "click", function() {
		$(this).parent().parent().hide("200");
	});
//	listData(); //重新请求list数据

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
					$("#klsf").find(".kajianhao li").each(function() {
						numarr.push(parseInt($(this).text()));
					});
					var dataStr = {
						preDrawCode: numarr,
						drawIssue: $("#preDrawIssue").val(),
						drawTime: $("#drawTime").val(),
						preDrawTime: cutTime
					};
					$("iframe")[0].contentWindow.syxwV.startVid(dataStr);
				});
			});
			$("iframe")[0].contentWindow.ifopen = true;
		} else {
			return;
		}
	});

	//关闭视频
	$("#videobox .closevideo").on("click", function() {
		config.ifScalse = 0.782;
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
		$("iframe")[0].contentWindow.syxwV.sound.stop("audioidBg");
		$("iframe")[0].contentWindow.syxwV.sound.stop("audioidKai");
		$("iframe")[0].contentWindow.syxwV.clearTime();
		$("iframe")[0].contentWindow.ifopen = false;
	});

	//最少化视频
	$("#videobox .small").on("click", function() {
		config.ifScalse = 0.31;
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
		config.ifScalse = 0.782;
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

//加载数据
function loadotherData() {
	listData();
}

//加载数据
function loadotherData2() {
    var e = "&lottery=1";
    listData(e);
}

//请求list数据
function listData(code) {
	$.ajax({
		url: "http://www.900kcw.com/?r=home/history/azxy20&=" + code,
		type: "GET",
		// data: {
		// 	"lotCode":lotCode
		// },
		success: function(data) {
			createHtmlList(data);
			//关闭加载动画
			animateMethod.loadingList("#jrsmhmtj",false);
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
	if(config.ifdebug) {
		console.log("长龙连开提醒长度:" + data.length + "结果数据：" + JSON.stringify(data));
	}
	$("#cltxul").empty("");

	for(var i = 0, len = data.length; i < len; i++) {
		var rank = typeOf("qiuqiu", data[i].rank);
		var state = typeOf("state1", data[i].state);
		var counthtml = data[i].count >= 5 ? "<span style='color:#f11821'>" + data[i].count + "&nbsp;&nbsp;</span>" : "<span>" + data[i].count + "&nbsp;&nbsp;</span>";
		var html = "<li>第<span>" + rank + "</span>球：&nbsp;&nbsp;<span>" + state + "</span>&nbsp;&nbsp;" + counthtml + "期</li>";
		if(data[i].rank == 9) {
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
var reloaddata = null;

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
	$("#jrsmhmtj>table").html('<tr><th width=136>时间</th><th>期数</th><th id="numberbtn" class="numberbtn" width=530><span id="kjhm">开奖号码</span></th><th colspan="3">总和</th><th>单双</th><th>前后</th><th>总和组合</th><th>五行</th></tr>');
	$(data).each(function(index) {
		var tddate = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>";
		var tdli = "";
		var preDrawCode = (this.preDrawCode).split(",");
		//给特殊球号添加特殊背景球
		$(preDrawCode).each(function(index) {
			if( index != preDrawCode.length-1 ){
				if(index == 9){//背景球换行
					if(this > 40) {
						tdli += "<li class='numWeightblueKong tabLine' style='color:#012537'><i>" + this + "</i></li>";
					} else {
						tdli += "<li class='numLightblueKong tabLine' style='color:#0b84ad'><i>" + this + "</i></li>";//浅蓝色
					}									
				} else{
					if(this > 40) {
						tdli += "<li class='numWeightblueKong' style='color:#012537'><i>" + this + "</i></li>";
					} else {
						tdli += "<li class='numLightblueKong' style='color:#0b84ad'><i>" + this + "</i></li>";//浅蓝色
					}		
				}
			} else{
				tdli += "<li class='numOrangeKong' style='color:#f9982e'><i>" + this + "</i></li>";//橘黄色
			}
		});
		var stylestr = "style='color:";
		var sumNum = "<td>" + this.sumNum + "</td>";
		if(!(preDrawCode.length <= 1)) {
			var tdnumber = "<td class='blueqiu'><ul>" + tdli + "</ul></td>";
			var sumBigSmall = typeOf("dxh",this.sumBigSmall);
			var style1 = (sumBigSmall == "大") ? stylestr + "#f12d35'" : "'";
			var sumSingleDouble = typeOf("dsh", this.sumSingleDouble);
			var style2 = (sumSingleDouble == "双") ? stylestr + "#f13d35'" : "'";
			var singleDoubleCount = typeOf("dsd",this.singleDoubleCount);
			if(singleDoubleCount == "双多"){
				var style3 = stylestr + "#f12d35'";
			} else if(singleDoubleCount == "单双和"){
				var style3 = stylestr + "#2EADDC'";
			} else{
				var style3 = stylestr + "'";
			}
			var frontBehindCount = typeOf("qhh",this.frontBehindCount);
			if(frontBehindCount == "后多"){
				var style4 = stylestr + "#f12d35'";
			} else if(frontBehindCount == "前后和"){
				var style4 = stylestr + "#2EADDC'";
			} else{
				var style4 = stylestr + "'";
			}
			var style4 = (frontBehindCount == "后多") ? stylestr + "#f12d35'" : "'";
			var sumBsSd = typeOf("zhzh",this.sumBsSd);
			var style5 = stylestr + "'";
			var sumWuXing = typeOf("wuxing",this.sumWuXing);
			var style6 = stylestr +  "'";
		} else {
			var tdnumber = "<td class='blueqiu'></td>";
		}
		var last = "<td " + style1 + ">" + sumBigSmall + "</td><td " + style2 + ">" + sumSingleDouble + 　"</td><td " + style3 + ">" + singleDoubleCount + "</td><td " + style4 + ">" + frontBehindCount + "</td><td " + style5 + ">" + sumBsSd + "</td><td " + style6 + ">" + sumWuXing + "</td>";
		var tr = "<tr>" + tddate + "" + tdnumber + "" + sumNum + "" + last + "</tr>";
		$("#jrsmhmtj>table").append(tr);
	});
	$("table").find("td").each(function() {
		if($(this).text() == "undefined") {
			$(this).text("");
		}
	});
}