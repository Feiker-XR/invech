function autofitframe(fid){
	var hb=$('body').height();
	$(fid,parent.document).height(hb);
}
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]); return null; //返回参数值
}

function changeFrameHeight(){
    bodyClientH = document.body.clientHeight;
   	bodyClientW = document.body.clientWidth;
	var iframeId = $(window.parent.document).find("#J_SportsIFrame")
	var iframeId2 = $(window.top.document).find("#iframeid");
	iframeId.css("height",6000)
	iframeId2.css("height",6000)
	
	var trendHeightS = window.screen.availHeight - 93;
	$(".wap_500_style").css({
		"top" : trendHeightS
	});
	$(".wap_500_middle").css({
		"top" : trendHeightS - 300
	});
}	


$(document).ready(function($) {	
	// var tztype = getUrlParam('touzhutype');
	// if(tztype==1){
	// 	tztype = 1;
	// }else{
	// 	tztype = 0;
	// }
	// top.mem_index.s_betiframe.touzhutype=tztype;
	// $('#touzhutype',parent.document).val(tztype);
	$('#datashow').scroll(function() {
	    var sleft = $(this).scrollLeft();
	    $('.liansai a',this).css('marginLeft', sleft);
	});
	autofitframe('#J_SportsIFrame');
	setInterval(function(){
		autofitframe('#J_SportsIFrame');
	},1000);
	$(parent.document).scrollTop(0);	
});