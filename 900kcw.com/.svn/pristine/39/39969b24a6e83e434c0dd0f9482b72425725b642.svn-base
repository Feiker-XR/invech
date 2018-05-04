$(function() {
	//加载轮播图片
	method.loadBanner();
	var sliderShow = $("#Box1"), //获取最外层焦点
		ul = sliderShow.find("ul"),
		showNumber = sliderShow.find(".spanner1 span"),
		oneWidth = sliderShow.find("#ul li").eq(0).width();
	var time = null;
	var iNow = 0;
	showNumber.on("click", function() { //为每个按钮绑定事件
		//		alert("0000000000");
		$(this).addClass("active").siblings().removeClass("active");
		var index = $(this).index();
		iNow = index;
		ul.animate({
			"left": -oneWidth * iNow,
		})
	});
	time = setInterval(function() { //开启定时器
		iNow++;
		if(iNow > showNumber.legnth - 1) {
			iNow = 0;
		}
		showNumber.eq(iNow).trigger("click"); //模拟触发数字按钮的click事件
	}, 2000);
	//	TAB选项卡
	$(".left_down_nav").find("li").live("click", function() {
		$(this).addClass("active2").siblings().removeClass();
		var programaId = $(this).attr("id");
		pageNo = 1;
		method.loadList(programaId, pageNo, pageSize);
	});
	$("#loadmorebtn").click(function() {
			var programaId = $("#titlelist").find(".active2").attr("id");
			method.loadList(programaId, pageNo += 1, pageSize);

		})
		//初始化数据
	method.loadList(method.loadTitle(""), pageNo, pageSize);
	method.loadHotnews();//加载热门
	method.loadLabels();//加载标签
})

var publicurl = config.publicUrl;
var publicBkurl = config.imgUrl; //后台服务器
//创建一个method对象
var method = {};
var pageNo = 1;
var pageSize = 7;//一页显示数量
//加载最热
method.loadBanner = function() {
		//console.log("request:" + JSON.stringify(data));
		$.ajax({
			url: publicurl + "0.php?id=news/findNewestCarousel.do",
			type: "GET",
			data: {},
			async: false,
			success: function(data) {
				//执行数据请求
				method.creatHtmlBanner(data);
			},
			error: function(data) {
				console.log("data error");
			}
		});
	}
	//向html加载数据
method.creatHtmlBanner = function(data) {
		var data = JSON.parse(data);
		if(data.errorCode == "0") {
			$("#Box1").find("#ul").empty();
			$("#Box1").find("#spanner1").empty();
			if(data.result.businessCode == "0") {
				data = data.result.data;
				$(data).each(function(index) {
					var html = "<li><img src='" + publicBkurl + "" + this.image + "' onerror='method.defaultViewigm(this)'/></li>";
					var span = "";
					if(index == 0) {
						span = "<span class='active'></span>";
					} else {
						span = "<span></span>";
					}
					$("#Box1").find("#ul").append(html);
					$("#Box1").find("#spanner1").append(span);
				});

			} else {
				alert("数据错误，请稍后重新操作！");
			}
		}
	}
	//加载最热
method.loadHotnews = function() {
		//console.log("request:" + JSON.stringify(data));
		$.ajax({
			url: publicurl + "0.php?id=news/findNewestHeadline.do",
			type: "GET",
			data: {},
			async: false,
			success: function(data) {
				//执行数据请求
				method.creatHtmlHotnews(data);
			},
			error: function(data) {
				console.log("data error");
			}
		});
	}
	//向html加载数据
method.creatHtmlHotnews = function(data) {
		var data = JSON.parse(data);
		if(data.errorCode == "0") {
			if(data.result.businessCode == "0") {
				data = data.result.data;
				$(data).each(function(index) {
					var html = "";
					if(index == 0) {
						$("#hottitle").html("<a href='zx_detail.html?" + this.newsId + "'>" + this.title + "</a>");
						$("#hotdescription").text(this.description.length > 120 ? this.description.substr(0, 120) + "..." : this.description);
					} else {
						html = '<li><img src="../../img/zixun/dot.png?v=201712221618"/><a href="zx_detail.html?' + this.newsId + '">' + (this.title.length > 27 ? this.title.substr(0, 27) + "..." : this.title) + '</a></li>';
					}
					$("#hotnewsul").append(html);
				});

			} else {
				alert("数据错误，请稍后重新操作！");
			}
		}
	}
	//加载最热
method.loadHot = function() {
		//console.log("request:" + JSON.stringify(data));
		$.ajax({
			url: publicurl + "0.php?id=programa/findNewestHPNews.do",
			type: "GET",
			data: {},
			async: false,
			success: function(data) {
				//执行数据请求
				method.creatHtmlHot(data);
			},
			error: function(data) {
				console.log("data error");
			}
		});
		return programaId;
	}
	//向html加载数据
method.creatHtmlHot = function(data) {
		var programaId = "";
		var data = JSON.parse(data);
		if(data.errorCode == "0") {
			$("#titlelist").empty();
			if(data.result.businessCode == "0") {
				data = data.result.data;
				$(data).each(function(index) {
					var html = "";
					if(index == 0) {
						programaId = this.id;
						html = "<li class='active2' id='" + this.id + "'><a href='javascript:void(0)' class='active1'>" + this.name + "</a></li>";
					} else {
						html = "<li id='" + this.id + "'><a href='javascript:void(0)' class='active1'>" + this.name + "</a></li>";
					}
					$("#titlelist").append(html);
				});

			} else {
				alert("数据错误，请稍后重新操作！");
			}
		}
		return programaId;
	}
	//加载默认资讯数据
method.loadTitle = function() {
		var programaId = "";
		//console.log("request:" + JSON.stringify(data));
		$.ajax({
			url: publicurl + "0.php?id=programa/findDisplay.do",
			type: "GET",
			data: {},
			async: false,
			success: function(data) {
				//执行数据请求
				programaId = method.creatHtmlTitle(data);
			},
			error: function(data) {
				console.log("data error");
			}
		});
		return programaId;
	}
	//向html加载数据
method.creatHtmlTitle = function(data) {
		var programaId = "";
		var data = JSON.parse(data);
		if(data.errorCode == "0") {
			$("#titlelist").empty();
			if(data.result.businessCode == "0") {
				data = data.result.data;
				$(data).each(function(index) {
					var html = "";
					if(index == 0) {
						programaId = this.id;
						html = "<li class='active2' id='" + this.id + "'><a href='javascript:void(0)' class='active1'>" + this.name + "</a></li>";
					} else {
						html = "<li id='" + this.id + "'><a href='javascript:void(0)' class='active1'>" + this.name + "</a></li>";
					}
					$("#titlelist").append(html);
				});

			} else {
				alert("数据错误，请稍后重新操作！");
			}
		}
		return programaId;
	}
	//加载默认资讯数据
method.loadList = function(programaId, pageNo, pageSize) {
		pageNo = pageNo;
		var data = {
			programaId: programaId, //栏目ID
			pageNo: pageNo, //第几页
			pageSize: pageSize //一页多少条
		};
		console.log("request:" + JSON.stringify(data));
		$.ajax({
			url: publicurl + "0.php?id=news/findNewsByPIdForPage.do",
			type: "GET",
			data: data,
			beforeSend: function() {
				$("#loadmorebtn").text("努力加载中...");
			},
			success: function(data) {
				//执行数据请求
				method.creatHtmlList(data, programaId);
			},
			error: function(data) {
				console.log("data error");
			}
		});
	}
	//向html加载数据
var lanmuId = "";
method.creatHtmlList = function(data, programaId) {
	if(lanmuId != programaId) {
		$("#listcontent").empty();
	}
	lanmuId = programaId;
	var data = JSON.parse(data);
	//验证是否会话超时
	//publictools.skipIndex(data.result.businessCode);
	if(data.errorCode == "0") {
		if(data.result.businessCode == "0") {

			data = data.result.data;
			if(data == "") {
				$("#loadmorebtn").text("咦，没更多了");
			} else {
				$("#loadmorebtn").text("加载更多");
			}
			$(data.list).each(function() {
				var description = this.description;
				if(description.length > 120) {
					description = description.substr(0, 120) + "...";
				}
				var html = "<div class='div_list'>" +
					"<div class='div_inline'>" +
					"<div class='div_l'>" +
					"<a target='_blank' href='zx_detail.html?" + this.newsId + "'><img src='" + publicBkurl + "" + this.image + "' onerror='method.defaultViewigm(this)'/></a></div>" +
					"<div class='div_r'><h3><a target='_blank' href='zx_detail.html?" + this.newsId + "'>" + this.title + "</a></h3>" +
					"<p>" + description + "</p>" +
					"<div><span class='span_l'><img src='../../img/zixun/small_pic.png?v=201712221618' alt='' /><span class='sum'>" + this.pageView + "</span></span>" +
					"<span class='span_r'><span>" + this.releaseDate + "</span></span></div></div></div></div>";
				$("#listcontent").append(html);
			});
		} else {
			alert("数据错误，请稍后重新操作！");
		}
	}
}
method.defaultViewigm = function(obj) {
		$(obj).attr("src", "../../img/icon/view.png?v=201712221618");
	}
	//加载标签
method.loadLabels = function() {
	var programaId = "";
	//console.log("request:" + JSON.stringify(data));
	$.ajax({
		url: publicurl + "0.php?id=label/findLabelListTwenty.do",
		type: "GET",
		data: {},
		async: false,
		beforeSend: function() {
			$("#hotLabel").text("正在加载...");
		},
		success: function(data) {
			
			var data = data;
			if(typeof data == 'object') {} else {
				data = JSON.parse(data);
			}
			if(data.errorCode == "0") {
				if(data.result.businessCode == "0") {
					$("#hotLabel").empty();
					var html = "";
					$(data.result.data).each(function() {
						html += "<li><a target='_blank' href='zx_list.html?hotlabel?" + this.id + "'>" + this.name + "</a></li>";
					});
					$("#hotLabel").append(html);
				} else {
					$("#hotLabel").empty().text("数据加载异常！");
				}
			}
		},
		error: function(data) {
			console.log("data error");
		}
	});
}