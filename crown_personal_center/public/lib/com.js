$(function(){
	
	/**
	 * 	left nav
	 */
	$(".com-left-nav-list li").eq(0).find($('.nav-bg-i')).show();
	$(".com-left-nav-list li").eq(0).find($('.nav-i')).hide();
	$(".com-left-nav-list li").eq(0).find('span').show();
	$(".com-left-nav-list li").click(function(){
		$(this).addClass("nav-bg").siblings().removeClass("nav-bg");
		$(this).find('span').show().parent().siblings().find('span').hide();
		$(this).find('a').addClass('nav-cr').parent().siblings().find('a').removeClass('nav-cr');
		$(this).find($(".nav-bg-i")).show().prev().hide().parent().siblings().find($(".nav-i")).show().next().hide();
	})
	
	/**
	 * 	余额刷新
	 */
	$('.Refresh').click(function(){
//		$.ajax({
//			type:"post",
//          data : "",
//          dataType:"json",
//          traditional: true,
//          url:"/vip_check",
//          success:function(data){
            	var data={
            		status:1,
            		balance:66.66,
            	}
            	if(data.status){
            		$(".balance").text(data.balance)
            	}
//          },
//          error:function(){
//          	console.log('刷新请求失败，请重新请求页面')
//          }
//		})
	})
	
})
