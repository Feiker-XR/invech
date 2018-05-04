$(function(){
	$(".com-right-nav-list li").find('a').click(function(){
		$(this).addClass('currentBg').parent().siblings().find('a').removeClass('currentBg');
	})
})
