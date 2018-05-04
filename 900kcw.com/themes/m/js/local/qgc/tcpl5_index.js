$(function() {
	//初始化数据及监听事件
	pubmethod.initAdata();
	//初始化数据
	method.indexLoad(boxId);
	ifishad = true; //判断是否是刷新页
	tools.loadDate(); //初始化时间控件
});
//判断是否是刷新页
var ifishad = false;
//加载其他数据
//入口加载数据
var method = {};
//加载其他数据
method.loadOther = function(date) {
		//处理所选日期不为当日时不加载列表数据
		if(date == "") {
			if(!tools.ifOnDay()) {
				return;
			}
		}
		method.listData(date); //重新请求list数据
	}
	//入口加载数据
method.indexLoad = function(id) {
	var nextIssue = $(id).find(".nextIssue").val();
	var id = "#" + $(id).attr("id");
	var data = {
		url:config.publicUrl+"QuanGuoCai/getLotteryInfo.php",
		id:boxId,
		lotCode:lotCode
	};
	if(config.ifdebug){
		console.log("indexLoad:"+JSON.stringify(data));
	}
	headMethod.loadHeadData(data); //页面启动时加载数据第一次加载不传参
	method.loadOther(""); //加载列表及其他数据
}
	//筛选号码大小单双
method.selectedBS = function(obj, ifload) {
		var id = $(obj).attr("id");
	$(obj).siblings().removeClass("spanchecked");
	if(!ifload) {
		$(obj).addClass("spanchecked");
	}
	if(id == "gjlh") {
		$("#numlist .haomali").removeClass("displayblock").addClass("displaynone");
		$("#numlist .longhuli").removeClass("displaynone").addClass("displayblock");
	} else {
		$("#numlist .haomali").removeClass("displaynone").addClass("displayblock");
		$("#numlist .longhuli").removeClass("displayblock").addClass("displaynone");
	}
	}
	//请求list数据
method.listData = function(date) {
		$.ajax({
			url: "http://m.900kcw.com/?r=home/history/tcpl5",
			type: "GET",
			// data: {
			// 	"lotCode": lotCode
			// },
			beforeSend: function() {
				if(!ifishad) {
					$("#numlist").html("<span class='loading'>努力加载中...</span>");
				}
			},
			success: function(data) {
				method.createHtmlList(data);
				//关闭加载动画
				animate.loadingList("body", false);
			},
			error: function(data) {
				if(config.ifdebug) {
					console.log("data error");
				}
			}
		});
	}
method.createHtmlList = function(jsondata) {
		var data = null;
		if(typeof jsondata != "object") {
			data = JSON.parse(jsondata);
		} else {
			data = JSON.stringify(jsondata);
			data = JSON.parse(data);
		}
		if(data.errorCode == 0) {
			if(data.result.businessCode == 0) {
				data = data.result.data;
				//1：为开奖号码TAB添加数据---start
				$("#numlist").empty();
				$("#haomafblist").empty();
				$(data).each(function() {
					var divhtml = "";
					divhtml += '<div class="listotherline bortop001 ssclist">';
					divhtml += '<div class="leftspan">';
					divhtml += '<span class="boxflex">';
					var drawTime = this.preDrawTime;
					drawTime = drawTime.substring((drawTime.length) - 8, (drawTime.length) - 3);
					divhtml += '<span class="graytime">' + drawTime + '</span>';
					divhtml += '<span class="graytime">' + tools.subStr(this.preDrawIssue) + '</span>';
					divhtml += '</span>';
					divhtml += '</div>';
					divhtml += '<div class="rightspan">';
					divhtml += '<div class="rightdiv" style="padding-left:0">';
					divhtml += '<div class="haomali"><ul id="" class="ssclilist listli">';
					var preDrawCode = this.preDrawCode.split(",");
					$(preDrawCode).each(function(index) {
						if(this == "") {
							return;
						}
						divhtml += '<li><span class="rednum"><i>' + this + '</i></span></li>';
					});
					divhtml += '</ul></div>';
					divhtml += '<div class="longhuli displaynone"><ul id="" class="ssclilistxt listli lhlist">';
					var stylestr = "style='color:";
					if(!(preDrawCode.length <= 1)) {
						var sumBigSamll = this.sumBigSmall == "0" ? "大" : "小";
						var sumSingleDouble = this.sumSingleDouble == "0" ? "单" : "双";
						var dragonTiger = "";
						if(this.dragonTiger == "0") {
							dragonTiger = "龙";
						} else if(this.dragonTiger == "1") {
							dragonTiger = "虎";
						} else if(this.dragonTiger == "2") {
							dragonTiger = "和";
						}
					}
					divhtml += "<li  style='color:#f12d35'>" + this.sumNum + "</li>";
					divhtml += "<li style='color:#666'>" + sumSingleDouble + "</li>";
					divhtml += '</ul>';
					divhtml += '</div>';
					divhtml += '</div>';
					divhtml += '</div>';
					divhtml += '</div>';
					$("#numlist").append(divhtml);
					$("#haomafblist").append(divhtml);
				});
				//1：为开奖号码TAB添加数据---start

				//1：为开奖号码TAB添加数据---end
			} else {
				console.log("数据请求失败！");
				$("#numlist").find(".loading").text(data.result.message);
			}
		}
	}
