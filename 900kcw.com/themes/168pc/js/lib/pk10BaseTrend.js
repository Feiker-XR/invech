var chartOfBaseTrend = {
	brokenLine : function(playType){
		chart.draw([[ 2,2, 10, 0 ]],color[0]);
		chart.draw([[ 12,2, 10, 0 ]],color[1]);
		chart.draw([[ 22,2, 10, 0 ]],color[2]);
		chart.draw([[ 32,2, 10, 0 ]],color[3]);
		chart.draw([[ 42,2, 10, 0 ]],color[4]);
		chart.draw([[ 52,2, 10, 0 ]],color[5]);
		chart.draw([[ 62,2, 10, 0 ]],color[6]);
		chart.draw([[ 72,2, 10, 0 ]],color[7]);
		chart.draw([[ 82,2, 10, 0 ]],color[8]);
		chart.draw([[ 92,2, 10, 0 ]],color[9]);
	},
	//冠亚和走势
	guanyaheLine : function(playType){
		chart.draw([[ 2,1, 20, 0 ]],color[1]);
	},
	//位置走势
	weizhiLine : function(playType){
		chart.draw([[ 2,1, 10, 0 ]],color[1]);
	},
	//号码规律统计
	haomagltj : function(playType){
		chart.draw([[ 0,2, 0, 0 ]],color[1]);
	},
	//时时彩号码形态
	ccshaomaxt : function(playType){
		chart.draw([[ 2,2, 10, 0 ]],color[0]);
		chart.draw([[ 12,2, 10, 0 ]],color[1]);
		chart.draw([[ 22,2, 10, 0 ]],color[2]);
	},
	//时时彩龙虎形态[起始列，起始行，宽度，高]
	ccslonghxt : function(playType){
		chart.draw([[ 2,2, 10, 0 ]],color[0]);
		chart.draw([[ 12,2, 10, 0 ]],color[1]);
	},
	//快3和值走势[起始列，起始行，宽度，高]
	kuai3hzzs : function(playType){
		chart.draw([[ 3,1, 16, 0 ]],color[1]);
	},
	//快3定位走势1[起始列，起始行，宽度，高]
	kuai3dwzs1 : function(playType){
		chart.draw([[ 2,1, 6, 0 ]],color[1]);
	},
	//快3定位走势2[起始列，起始行，宽度，高]
	kuai3dwzs2 : function(playType){
		chart.draw([[ 12,1, 6, 0 ]],color[1]);
	},
	//快3定位走势3[起始列，起始行，宽度，高]
	kuai3dwzs3 : function(playType){
		chart.draw([[22,1, 6, 0 ]],color[1]);
	},
	//快3定位走势4[起始列，起始行，宽度，高]
	kuai3dwzs4 : function(playType){
		chart.draw([[18,1, 4, 0 ]],color[1]);
	},
	//快3定位走势5[起始列，起始行，宽度，高]
	kuai3dwzs5 : function(playType){
		chart.draw([[22,2, 4, 0 ]],color[1]);
	},
	//快3定位走势6[起始列，起始行，宽度，高]
	kuai3dwzs6 : function(playType){
		chart.draw([[11,2, 16, 0 ]],color[1]);
	},
	//单双走势
	klsfdans : function(playType){
		chart.draw([[2,1, 2, 0 ]],color[0]);
		chart.draw([[4,1, 2, 0 ]],color[1]);
		chart.draw([[6,1, 2, 0 ]],color[2]);
		chart.draw([[8,1, 2, 0 ]],color[3]);
		chart.draw([[10,1, 2, 0 ]],color[4]);
		chart.draw([[12,1, 2, 0 ]],color[5]);
		chart.draw([[14,1, 2, 0 ]],color[6]);
		chart.draw([[16,1, 2, 0 ]],color[7]);
		chart.draw([[18,2, 10, 0]],color[9]);
	},
	//十一选5
	shiyix5 : function(playType){
		chart.draw([[ 2,2, 11, 0 ]],color[0]);
		chart.draw([[ 13,2, 11, 0 ]],color[1]);
		chart.draw([[ 24,2, 11, 0 ]],color[2]);
		chart.draw([[ 35,2, 11, 0 ]],color[3]);
		chart.draw([[ 46,2, 11, 0 ]],color[4]);
	},
	//十一选5
	shiyix5hez : function(playType){
		chart.draw([[ 2,2, 32, 0 ]],color[1]);
	},
	//十一选5
	shiyix5dinw : function(playType){
		chart.draw([[ 2,1, 11, 0 ]],color[1]);
	},
	//十一选5龙虎走势
	shiyix5lh : function(playType){
		chart.draw([[ 2,2, 11, 0 ]],color[0]);
		chart.draw([[ 13,2, 11, 0 ]],color[1]);
	}
}
//初始默认颜色
var color = ["#fba75e","#1fa6e8","#08bf02","#8585fb","#46bd95","#e26bab","#f2b653","#628ef3","#5ec642","#f66d6d"];
var tablename = "trend_table2";
var chart = {
	/**
	*@param left_top 坐标[起始列，起始行，宽度，高]
	*@param lineColor 线条颜色
	*/
	draw: function(_left_top,lineColor){
			ajaxSync.asyncInvoke(function() {
				 oZXZ._on = true;
				 var $object = oZXZ.bind(tablename).color(lineColor);
				 for ( var i = 0; i < _left_top.length; i++) {
					 $object.add(_left_top[i][0], _left_top[i][1], _left_top[i][2], 0);
				 }
				 oZXZ.draw(ESUNChart.ini.default_has_line);
				
			}); 
	}
}


$(function () {/*
	
	//渲染 title为0的 样式变高亮
	//控制命中的数字的样式 title==0的 class 为HOT
	$("#"+tablename).find("tr").each(
		function(){
			$(this).find("td").each(
				function(){ 
					if($(this).attr("title") == "0"){
						if($(this).index()>=2 && $(this).index() <= 11){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu bBK");
						}else if($(this).index() >=12 && $(this).index() <= 21 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu gB");
						}else if($(this).index() >=22 && $(this).index() <= 31 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu oB");
						}else if($(this).index() >=32 && $(this).index() <= 41 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu gqB");
						}else if($(this).index() >=42 && $(this).index() <= 51 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu grB");
						}else if($(this).index() >=52 && $(this).index() <= 61 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu bBK");
						}else if($(this).index() >=62 && $(this).index() <= 71 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu gB");
						}else if($(this).index() >=72 && $(this).index() <= 81 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu oB");
						}else if($(this).index() >=82 && $(this).index() <= 91 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu gqB");
						}else if($(this).index() >=92 && $(this).index() <= 101 ){
							$(this).attr("class","hot "+$(this).removeClass("grey").attr("class")).find("span").attr("name","hotSpan").text($(this).attr("name")).attr("class","zoushiqiu grB");
						}
					}
			});    
		}
	);
	$("#"+tablename+" tr").eq($("#"+tablename+" tr").length - 8).find("td").removeClass("tdbb").addClass("tdbbs");
	//画线
	chartOfBaseTrend.brokenLine();
	//initView();
	//initEvent();*/
});

function initView(){
	//控制颜色
	$("a[id^='staticNumber']").removeAttr("style");
	
	if($("#searchFlag").val()!= "search"){
		if($("#staticNumber").val()==30){
			$("#staticNumber30").attr("style","color: red;");
		}else if($("#staticNumber").val()==50){
			$("#staticNumber50").attr("style","color: red;");
		}else if($("#staticNumber").val()==100){
			$("#staticNumber100").attr("style","color: red;");
		}else if($("#staticNumber").val()==0){
			$("#staticNumber0").attr("style","color: red;");
		}	
	}
}

function initEvent(){
	var issueTable=$("#"+tablename);
	
    var issueTable_allTr=$("#"+tablename).find("tr");
	var lottery = $('#lottery').val();
	var ftype = $('#ftype').val();
	/**
	$("a[id^='staticNumber']").click(function(){
		window.location.href=$(this).attr("hrefLink");
	});
	*/
	//不带遗漏值绑定
	$("#hideMiss_line").bind("click", function(event){
		if($(this).is(':checked'))
   			$("#"+tablename).find("td span[name='miss']").hide();
   		else
   			$("#"+tablename).find("td span[name='miss']").show();
	});
	//不带折线
   	$("#has_line").click(function(){
		 if($(this).is(':checked')){
			$("#chartLinediv canvas").hide();
			$("#chartLinediv line").hide();
		}else {
			$("#chartLinediv canvas").show();
			$("#chartLinediv line").show();
		}
	});
   	$("#missLayer").click(function(){
        var trLen=issueTable_allTr.length-6;
   		var order = $("#order").attr("type");
   		var maxIssueTr= issueTable_allTr.eq(2);
   		var td_count = maxIssueTr.children("td").size();
		if($(this).is(':checked')){
			if(order == 'desc'){
		   		for (var i = 2; i < td_count; i++) {
		   			for ( var j = 0; j <= trLen; j++) {
		   				var $td = issueTable_allTr.eq(j).children("td").eq(i);
		   				if ($td.attr("title")== '0' || $td.attr("class")=="line_y") {
		   					break;
		   				}
		   				$td.addClass("miss_bg");
		   			}
		   		}
			}else{
				for (var i = 2; i < td_count; i++) {
		   			for ( var j = trLen - 1; j >= 0; j--) {
		   				var $td = issueTable_allTr.eq(j).children("td").eq(i);
		   				if ($td.attr("title")== '0' || $td.attr("class")=="line_y") {
		   					break;
		   				}
		   				$td.addClass("miss_bg");
		   			}
		   		}
			}
		}else {
			$("#"+tablename).find(".miss_bg").removeClass("miss_bg");
		}
	});
   	//分割线
	$("#fenge").click(function (){
		if($(this).is(':checked')){
		 	$("#"+tablename+" td.botmline2").show();
		}
		else {
			$("#"+tablename+" td.botmline2").hide();
		}
		
		if($("#has_line").is(':checked'))
			return;
		
		//IE
		if ($.browser.msie) {
		 	$("#chartLinediv line").remove();  
		}else{
		 	$("#chartLinediv canvas").remove();  
		}
		chartOfBaseTrend.brokenLine();
	});
	//搜索
	$("#search").click(function(){
		var startIssue = $('#startIssue').val();
		var endIssue = $('#endIssue').val();
		var day = $('#currentDay').val();
		var startIssueLength = $('#startIssue').attr("maxlength");
		var endIssueLength = $('#endIssue').attr("maxlength");
		var ftype = $('#ftype').val();
		var param = "query.startIssue=" + startIssue +"&query.endIssue=" + endIssue;
		if(!startIssue || !isValidInt(startIssue) || startIssue.length != startIssueLength
			||!endIssue || !isValidInt(endIssue) || endIssue.length != endIssueLength
			|| parseInt(endIssue) < parseInt(startIssue)) {
			param = "pk10_BaseTrend_30.html";
		}else{
			param = "pk10_BaseTrend_"+startIssue+"_"+endIssue+"_search.html";
		}
		window.location.href = $('#basePath').val() + param + getChidParam();
	});
	//选中变色
	$("#"+tablename+" tr").slice(1).click(function(){
		if($(this).attr("click") == 1){
   		$(this).children("td").css("background-color", "");
   		$(this).children("td").children("span[name='miss']").parent("td").addClass("grey");
   		$(this).removeAttr("click");
   	}else{
			$(this).children("td").css("background-color", "#ECC0AF");
			$(this).children("td").children("span[name='miss']").parent("td").removeClass("grey");
			$(this).attr("click", 1);
		}
	});
	$("#order").click(function(){
   		location.href = $("base").attr("href") + getQueryParam() + getChidParam();
   	});
}
function getQueryParam(){
	var param = "";
	var lottery = $('#lottery').val();
	var pageSize = $("#staticNumber").val();
	var searchFlag = $("#searchFlag").val();
	var startIssue = $('#startIssue').val();
	var endIssue = $('#endIssue').val();
	
	var type = $("#order").attr("type");
	type = type == 'desc' ? "asc" : "desc";
	if(searchFlag == "search"){
		param = "pk10_BaseTrend_"+startIssue+"_"+endIssue+"_s"+type+".html";
	}else{
		param = "pk10_BaseTrend_"+pageSize+"_s"+type+".html";
	}
	return param;
}