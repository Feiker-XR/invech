$(function() {
	var url = window.location.href;
	var id = url.split("?")[1];
	caizhonmethod.loadotherData(id);
	caizhonmethod.loadLabels();//加载标签
});
//得到公共url
var publicurl = config.publicUrl;
//请求后台数据
var caizhonmethod = {};
	//编辑
caizhonmethod.loadotherData = function(id) {
		var data = {
			id: id 
		};
		console.log("request:" + JSON.stringify(data));
		$.ajax({
			url: publicurl + "news/findNewsParticularById.php",
			type: "GET",
			data: data,
			success: function(data) {
				//执行数据请求
				caizhonmethod.createEdite(data);
			},
			error: function(data) {
				console.log("data error");
				//createHtml(data);	
			}
		});
	}
 
	//编辑
caizhonmethod.createEdite = function(data) {
		var data = JSON.parse(data);
		if(data.errorCode == "0") {
			/*字段
			title 标题
			data 发布时间
			labels 标签
			content 内容
			*/
			data = data.result.data;
			var lebelarr = [];
			var str = "";
			$(data.labels.split(",")).each(function(){
				str+=this+"&nbsp;";
			});
			var divobj = $("#dhguanli_bianji");
		 	$("#title").text(data.title);
		 	$("#date").text(data.data);
		 	$("#pageView").text(data.pageView);
		 	$("#labels").html(str);
		 	$("#content").html(data.content);
		} else {
			alert("数据错误，请稍后重新操作！");
		}

	}
	//判断是否被选中
//加载标签
caizhonmethod.loadLabels = function() {
	var programaId = "";
	//console.log("request:" + JSON.stringify(data));
	$.ajax({
		url: publicurl + "label/findLabelListTwenty.php",
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