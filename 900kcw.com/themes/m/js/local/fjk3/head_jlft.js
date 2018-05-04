var lotCode = lotCode.jlft;
//主体方法类
var boxId = "#headerData";
var headMethod = {};
headMethod.loadHeadData = function(issue, id) {
	pubmethod.ajaxHead.jlk3(issue, id);
}
headMethod.headData = function(jsondata, id) { 
	pubmethod.creatHead.jsk3(jsondata, id);
	tools.setTimefun();
}