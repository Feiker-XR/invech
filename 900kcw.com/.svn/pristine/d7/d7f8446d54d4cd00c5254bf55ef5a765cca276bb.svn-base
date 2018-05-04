$(function() {
	$("#headdivbox").load("../public/head.html?v=2017981058", function() {
		if(config.ifdebug) {
			console.log("request is over!");
		}
	});
	$("#fooderbox").load("../public/fooder.html?v=2017981058", function() {
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
var boxid = "#shiyix5";
//公共URL前缀
var urlbublic = config.publicUrl;
////初始加载动画
var lotCode = lotCode.hbef;
//初始化界面定时器得到请求采种类别
var indexObj = new Object(); //创建对象 
function ajaxRequst(issue, id) {
	indexObj.ajaxSsc(issue, id);
}
indexObj.ajaxSsc = function(issue, id) {
	issue = issue == undefined ? "" : issue;
	var iferror = false;
	$.ajax({
		url: urlbublic + "ElevenFive/getElevenFiveInfo.php?issue=" + issue,
		type: "GET",
		data: {
			"lotCode":lotCode
		},
		beforeSend: function() {
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
				return "尾大尾小";
				break;
			case 5:
				return "合单合双";
				break;
			case 6:
				return "中发白";
				break;
			case 7:
				return "东南西北";
				break;
		}
	} else if(type == "san") {
		//0杂六、1半顺、2顺子、3对子、4豹子
		switch(num * 1) {
			case 0:
				return "杂六";
				break;
			case 1:
				return "半顺";
				break;
			case 2:
				return "顺子";
				break;
			case 3:
				return "对子";
				break;
			case 4:
				return "豹子";
				break;
		}
	} else if(type == "lhh") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 0:
				return "龙";
				break;
			case 1:
				return "虎";
				break;
			case 2:
				return "和";
				break;
		}
	} else if(type == "dxh") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 0:
				return "大";
				break;
			case 1:
				return "小";
				break;
			case 2:
				return "和";
				break;
		}
	} else if(type == "dsh") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 0:
				return "单";
				break;
			case 1:
				return "双";
				break;
			case 2:
				return "和";
				break;
		}
	} else if(type == "qiu") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 1:
				return "第1名";
				break;
			case 2:
				return "第2名";
				break;
			case 3:
				return "第3名";
				break;
			case 4:
				return "第4名";
				break;
			case 5:
				return "第5名";
				break;

			case 6:
				return "总和";
				break;
			case 12:
				return "龙虎";
				break;
		}
	} else if(type == "qiu1") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 1:
				return "第一球";
				break;
			case 2:
				return "第二球";
				break;
			case 3:
				return "第三球";
				break;
			case 4:
				return "第四球";
				break;
			case 5:
				return "第五球";
				break;
			case 6:
				return "第六球";
				break;
			case 7:
				return "第七球";
				break;
			case 8:
				return "第八球";
				break;
			case 9:
				return "总和";
				break;

		}
	} else if(type == "qiu2") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 1:
				return "一";
				break;
			case 2:
				return "二";
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
			case 11:
				return "总合";
				break;
		}
	} else if(type == "qiuonebig") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 1:
				return "第一名";
				break;
			case 2:
				return "第二名";
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
			case 11:
				return "总和";
				break;
			case 12:
				return "龙虎";
				break;
		}
	} else if(type == "lai") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 1:
				return "总来";
				break;
			case 0:
				return "没来";
				break;
		}
	} else if(type == "qiuqiu") {
		//0龙、1虎、2和
		switch(num * 1) {
			case 1:
				return "一";
				break;
			case 2:
				return "二";
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
				return "总和";
				break;

		}
	} else if(type == "stated") {
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
			case 7:
				return "和";
				break;
		}
	} else if(type == "state1") {
		//形态:1.单长龙;2.双长龙;3.大长龙;4.小长龙;5.龙长龙;6.虎长龙;7尾大长龙;8.尾小长龙;9.合数单长龙;10.合数双长龙;11.总和为和
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
				return "和";
				break;
			case 6:
				return "龙";
				break;
			case 7:
				return "虎";
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
}
//向开奖区填数据
function creatDataHead(jsondata,id) { 
	publicmethod.insertHead11xw(jsondata,id);
	tools.setTimefun_shiyixw();	
}