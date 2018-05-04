var bgSelect = setInterval(function(){
	$(".zixun_nav").addClass("li_checked").siblings().removeClass("li_checked");
	if($(".zixun_nav").length != 0){
		clearInterval();
	}
},200)

//设为首页
function SetHome(url) {
	if(document.all) {
		document.body.style.behavior = 'url(#default#homepage)';
		document.body.setHomePage(url);
	} else {
		alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
	}
}

//收藏本站
function addFavorite2() {
	var url = window.location;
	var title = document.title;
	var ua = navigator.userAgent.toLowerCase();
	if(ua.indexOf("360se") > -1) {
		alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
	} else if(ua.indexOf("msie 8") > -1) {
		window.external.AddToFavoritesBar(url, title); //IE8
	} else if(document.all) {
		try {
			window.external.addFavorite(url, title);
		} catch(e) {
			alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
		}
	} else if(window.sidebar) {
		window.sidebar.addPanel(title, url, "");
	} else {
		alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
	}
}


$(function(){
	//回到顶部
	$("#gotop").click(function() {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		$(this).hide();
		return false;
	});
	$(document).scroll(function() {
		//console.log($(this).scrollTop())
		if($(this).scrollTop() > 10) {
			$("#gotop").show();
		} else {
			$("#gotop").hide();
		}
	});
	
	
	$("#headdivbox").load("../public/head.html?v=2017981058",function(){
		console.log("request is over!");
	});
	$("#fooderbox").load("../public/fooder.html?v=2017981058",function(){
		console.log("request is over!");
	});
});

 