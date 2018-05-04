//为当前采种添加公共类型
/*
广东快乐十分为10005； 重庆幸运农场为10009
*/
var lotCode = lotCode.cqxync;
//主体方法类
var boxId = "#headerData";
var headMethod = {};
headMethod.loadHeadData = function(issue, id) {
	pubmethod.ajaxHead.cqnc(issue, id);
}
headMethod.headData = function(jsondata, id) { 
	pubmethod.creatHead.cqnc(jsondata, id);
	tools.setTimefun_cqnc();
}