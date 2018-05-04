//为当前采种添加公共类型
/*
bjkl8:10014,
aozxy20:10013
*/
var lotCode = lotCode.egxy28;
//主体方法类
var boxId = "#headerData";
var headMethod = {};
headMethod.loadHeadData = function(issue, boxId) { 
	pubmethod.ajaxHead.egxy28(issue, boxId);
}
headMethod.headData = function(jsondata, id) {
	pubmethod.creatHead.egxy28(jsondata, id);
	tools.setTimefun_pcEgg();
}