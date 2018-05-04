$(function() {
	$("#headdivbox").load("../public/head.html?v=20171214145", function() {
		if(config.ifdebug) {
			console.log("request is over!");
		}
	});
	$("#fooderbox").load("../public/fooder.html?v=20171214145", function() {
		if(config.ifdebug) {
			console.log("request is over!");
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
		tabarr = [];
		$("#chakanchfb,#daxiaodsfb").find("li").removeClass("selected");
		//传变量是为了检查是不是重置功能
		if(id == "today") {
			listData(getDateStr(0), "");
			$(".jinri").text("今天");
			$("#dateframe").find("input").val(getDateStr(0));
		} else if(id == "yesterday") {
			listData(getDateStr(-1), "");
			$(".jinri").text(currentDay(getDateStr(-1)));
			$("#dateframe").find("input").val(getDateStr(-1));
		} else if(id == "qianday") {
			listData(getDateStr(-2), "");
			$(".jinri").text(currentDay(getDateStr(-2)));
			$("#dateframe").find("input").val(getDateStr(-2));
		} else if(id == "thirty") {
			listData("", "30");
		} else if(id == "sixty") {
			listData("", "60");
		} else if(id == "ninety") {
			listData("", "90");
		}
	});
	//启动加载数据
	ajaxRequst("",boxid);
});
var boxid = "#klsf";
//公共URL前缀
var urlbublic = config.publicUrl;
////初始加载动画
var lotCode = lotCode.aozxy20;
//初始化界面定时器得到请求采种类别
var indexObj = new Object(); //创建对象 
function ajaxRequst(issue, id) {
	indexObj.ajaxSsc(issue,id);
}
indexObj.ajaxSsc = function(issue, id) {
	var issue = issue == undefined ? "" : issue;
	var iferror = false;
	var code = "";
	if ($("#pk10 #timebox").find(".minute").text() == 0 && $("#pk10 #timebox").find(".second").text() == 0) {
		code = "&lottery=2";
	}
	
	$.ajax({
		// url: urlbublic + "LuckTwenty/getBaseLuckTewnty.php?issue=" + issue,
		url: "http://www.900kcw.com/?r=home/lottery/azxy20" + code,
		type: "GET",
		// data: {
		// 	"lotCode":lotCode
		// },
		beforeSend: function() {
				//清除红色背景球，添加蓝色背景
				$(id).find(".kajianhao li").each(function() {
					$(this).removeClass("numWeightblue");
					$(this).removeClass("numOrange");
				})

			if(animateID[id] == undefined) {
				animateMethod.sscAnimate(id); //请求执行开奖动画
			}
		},
		success: function(data) {
			try {
				creatDataHead(data,id); //向头部填充数据
				clearInterval(animateID[id]);//清除动画
				delete animateID[id]; 
			} catch(e) {
				setTimeout(function() {
					ajaxRequst(issue, id);
				}, "1000");
				if(config.ifdebug){
					console.log("tryerror:"+e.message);
				}
			}
		},
		error: function(data) {
			setTimeout(function() {
				ajaxRequst(issue, id);
			}, "1000");
			iferror = true;
			if(config.ifdebug){
				console.log("error:"+e.message);
			}
		},
		complete: function(xmlobj, state) {
			iferror = false;
			xmlobj = null;
			if(!iferror) {
				if(state == "timeout") {
					setTimeout(function() {
						ajaxRequst(issue, id);
					}, "1000");
				}
			}
		}
	});
}

	//类型转换
function typeOf(type, num) {
	 if(type == "state") {
		switch(num * 1) {
			case 0:
				return "总和大小";
				break;
			case 1:
				return "总和单双";
				break;
			case 2:
				return "总和大小单双";
				break;
			case 3:
				return "前后和";
				break;
			case 4:
				return "单双和";
				break;
			case 5:
				return "五行";
				break;
		}
	} else if(type == "dxh") {
		//-1小、0和、1大
		switch(num * 1) {
			case -1:
				return "小";
				break;
			case 0:
				return "和";
				break;
			case 1:
				return "大";
				break;
		}
	} else if(type == "dsh") {
		//-1小、0和、1大
		switch(num * 1) {
			case -1:
				return "双";
				break;
			case 0:
				return "和";
				break;
			case 1:
				return "单";
				break;
		}
	} else if(type == "qhh"){
		//-1后多、0前后和、1前多
		switch(num *1){
			case -1:
				return "后多";
				break;
			case 0:
				return "前后和";
				break;
			case 1:
				return "前多";
				break;
		}
	} else if(type == "dsd"){
		// -1双多、0单双和、1单多
		switch(num *1){
			case -1:
				return "双多";
				break;
			case 0:
				return "单双和";
				break;
			case 1:
				return "单多";
				break;
		}
	} else if(type == "zhzh"){
		// 1:总大单，2:总大双，3:总小单，4:总小双 5:总和
		switch(num *1){
			case 1:
				return "总大单";
				break;
			case 2:
				return "总大双";
				break;
			case 3:
				return "总小单";
				break;
			case 4:
				return "总小双";
				break;
			case 5:
				return "总和";
				break;
		}
	} else if(type == "wuxing"){
		// 1-5对应金木水火土
		switch(num *1){
			case 1:
				return "金";
				break;
			case 2:
				return "木";
				break;
			case 3:
				return "水";
				break;
			case 4:
				return "火";
				break;
			case 5:
				return "土";
				break;
		}
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

//想开奖区填数据
function creatDataHead(jsondata,id) {
	publicmethod.insertHeadBjkl8(jsondata,id);
	tools.setTimefun_bjkl8();
}
