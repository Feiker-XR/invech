$(function(){
//导航栏目隐藏收缩
$(".nav span").mouseenter(function(){
	$(this).find(".nav_show").show();
});
$(".nav span").mouseleave(function(){
	$(this).find(".nav_show").hide();
})
//导航栏目点击变色
$(".nav_a").click(function(){
	$(this).addClass("nav_active").parent().siblings("span").find(".nav_a").removeClass("nav_active");
})

$(".tempWrap").css("width","1080px")

//同步左右两侧一样高度
var lineHeight = $(".line_contain").height();
$(".line_right").height(lineHeight - 130);	
//底部点击切换滑动门
$(".tab_game_1").mouseenter(function(){
	var tabIndex = $(this).index(),
		tabThis = $(this);
	tabThis.addClass("tab_click_on").siblings("span").removeClass("tab_click_on");
	$(".tab_arrow").children("span").eq(tabIndex).find("img").show().parent().siblings("span").find("img").hide();	
	$(".tab_game").children(".tab_game_1").eq(tabIndex).find("span").addClass("tab_game_1_on").parents(".tab_game_1").siblings(".tab_game_1").find("span").removeClass("tab_game_1_on");
});
$(".tab_game").mouseleave(function(){
	tabThis = $(this);
	tabThis.find(".tab_game_1").removeClass("tab_click_on");
	$(".tab_arrow").children("span").find("img").hide();
	$(".tab_game").children(".tab_game_1").find("span").removeClass("tab_game_1_on");
});	
	


})


function Login(){
	var un = $('#username').val();
	var pw = $('#password').val();
	var dlyzm = $('#dlyzm').val();
	if(un == "" || un == "账号"){
		alert("登录账号不能为空！");
		$("#username").focus();
		return false;
	}
	if(pw == "" || pw == "密码"){
		alert("登录密码不能为空！");
		$("#password").focus();
		return false;
	}
	$.ajax({
		type: "post",
		url: "/index/login",
		data:{'username':un,'password':pw,'dlyzm':dlyzm},
		dataType:'json',
		async:'false',
		success:function(data) {
			if(data.status == 'y'){
				alert(data.info);
				window.location.href = document.URL;
			}else if(data.status == 'ns'){
				alert(data.info);
				window.location.href = document.URL;
			}else{
				alert(data.info);
			}
		}
	});
}