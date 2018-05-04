var headMethod = {};
var boxId = "#headerData";
var lotCode = lotCode.xyft;
headMethod.loadHeadData = function(issue, boxId) {
	pubmethod.ajaxHead.pk10(issue, boxId);
}
headMethod.headData = function(jsondata, id) { 
	var data = tools.parseObj(jsondata);
	data = data.result.data;
	var timeResult = tools.operatorTime(data.drawTime==""?"0":data.drawTime, data.serverTime);//得到时间差
	tools.publicJsft(jsondata, id, data, timeResult);//提取出开奖视频公共部分
}