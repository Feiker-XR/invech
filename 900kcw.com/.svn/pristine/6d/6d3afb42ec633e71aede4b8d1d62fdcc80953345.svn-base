//为当前采种添加公共类型
/*
cqssc:10002,
tjssc:10003,
xjssc:10004
*/
var lotCode = lotCode.aozxy5;
//主体方法类
//主体方法类
var boxId = "#headerData";
var headMethod = {};
headMethod.loadHeadData = function(issue, boxId) { 
	pubmethod.ajaxHead.ssc(issue, boxId);
}
headMethod.headData = function(jsondata, id) {
	pubmethod.creatHead.ssc(jsondata, id);
	setTimeout(function() {
		if(!$("#videobox").length < 1) {
			if(!($("#videobox").css("z-index") == -1)) {
				$("iframe")[0].contentWindow.sscAnimateEnd(createData());
			}
		}
	}, 1000)
}