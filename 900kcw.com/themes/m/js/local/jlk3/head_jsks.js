var lotCode = lotCode.jsksan;
//主体方法类
var boxId = "#headerData";
var headMethod = {};
headMethod.loadHeadData = function(issue, id) {
	pubmethod.ajaxHead.jsk3(issue, id);
}
headMethod.headData = function(jsondata, id) { 
	pubmethod.creatHead.jsk3(jsondata, id);
	setTimeout(function() {
		if(!$("#videobox").length < 1) {
			if($("iframe")[0].contentWindow.ifopen) {
				$("iframe")[0].contentWindow.k3v.stopVideo(createData());
			}
		}
	}, 1000)
}