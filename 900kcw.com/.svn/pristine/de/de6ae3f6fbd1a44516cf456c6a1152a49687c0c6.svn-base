$(function() {
	$("#headdivbox").load("../public/head.html?v=201712271451", function() {
		if(config.ifdebug) {
			console.log("request is over!");
		}
	});
	$("#fooderbox").load("../public/fooder.html?v=201712271451", function() {
		if(config.ifdebug) {
			console.log("request is over!");
		}
	});
	//启动加载数据
	ajaxRequst("", boxid);
});
//公共URL前缀
var urlbublic = config.publicUrl;
//采种类型
var lotCode = lotCode.fcsd;
var boxid = "#cqSsc";
//初始化界面定时器得到请求采种类别
var indexObj = new Object(); //创建对象 
function ajaxRequst(issue, id) {
	var data = {
		url:config.publicUrl+"QuanGuoCai/getLotteryInfo1.php?issue=",
		id:id,
		lotCode:lotCode
	};	
	//调用公共的ajax
	ajaxList.qgc(data);
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
	} else if(type == "qiu") {
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
				return "总和";
				break;
			case 12:
				return "龙虎";
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
			case 11:
				return "总和";
				break;

		}
	} else if(type == "qiuqiu1") {
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
			case 11:
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
//向开奖区填数据
function creatDataHead(jsondata,id) { 
	publicmethod.insertHeadQGC(jsondata,id);
	tools.setTimefun_fc3D();
}