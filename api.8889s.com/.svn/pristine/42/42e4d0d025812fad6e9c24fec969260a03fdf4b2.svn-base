function open_new_888(url) {
    window.open(url,'newwindow','height=640,width=600,top=150,left='+(screen.width-640)/2+',toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
}
function goPay(){
	if($("#payUsername").val() == ''){
		alert("请登录后再进行冲值！");
		return false;
	}
	if( $("#payCoin").val() <= '50'){
		//alert("冲值金额不能小于50");
		//return false;
	}
	$("#payForm").submit();
}
//设为首页
function SetHome(url){
    if (document.all) {
           document.body.setHomePage(url);
    }else{
        alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
    }
}
 //加入收藏
function AddFavorite(sURL, sTitle) {
    sURL = encodeURI(sURL); 
    try{   
        window.external.addFavorite(sURL, sTitle);   
    }catch(e) {   
        try{   
            window.sidebar.addPanel(sTitle, sURL, "");   
        }catch (e) {   
            alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
        }   
    }
}
$(function(){
	//导航条
	$(document).on("click",".nav_right a",function(){
		$(this).addClass("nav_right_active").siblings("a").removeClass("nav_right_active")
	});
	//无缝左滚动
	$(".txtMarquee-left").slide({mainCell:".bd ul",autoPlay:true,effect:"leftMarquee",interTime:50,trigger:"click"});
	//无缝上滚动
	$(".txtMarquee-top").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:6,interTime:50,trigger:"click"});
	//点击切换滑动门
	$(document).on("click",".jscenter_slider a",function(){
		var sliderIndex = $(this).index();
		$(this).find("span").addClass("jscenter_slider_active").parent().siblings("a").find("span").removeClass("jscenter_slider_active")
		$(".jscenter_slider_list").children("div").eq(sliderIndex).show().siblings("div").hide();		
	});	
	//鼠标悬停显示进入游戏
	$(".jscenter_slider_game").on({
		mouseover : function(){
			$(this).find(".jscenter_slider_bg").stop(true).animate({
				"top" : 0,
				"opacity" : 0.9
			},200)			
		},
		mouseleave : function(){
			$(this).find(".jscenter_slider_bg").stop(true).animate({
				"top" : 85,
			},100)
		}
	});
	//顶部导航二级菜单
	$(".nav_right_div").mouseenter(function(){
		$(this).find("ul").show();
	}).mouseleave(function(){
		$(this).find("ul").hide();
	});	
	$(".sport_game_1").click(function(){
		var sportIndex = $(this).index();
		var sportThis = $(this);
		$(".game_list").children("div").eq(sportIndex).show().siblings("div").hide()
		sportThis.find(".sport_game_middle").addClass("sport_game_middle_active");
		sportThis.css("color","#F5A423")
		sportThis.siblings(".sport_game_1").find(".sport_game_middle").removeClass("sport_game_middle_active")
		sportThis.siblings(".sport_game_1").css("color","#D8D8D8")
	})	
	//点击体育竞技对应变色
	$(".game_list_1 span").click(function(){
		var gameThis = $(this);
		gameThis.find("i").addClass("game_bg_active");
		gameThis.find("a").css("color","#F5A423");
		gameThis.siblings("span").find("i").removeClass("game_bg_active");
		gameThis.siblings("span").find("a").css("color","#D8D8D8");
	})
	$(".game_list_2 span").click(function(){
		var gameThis = $(this);
		gameThis.find("i").addClass("game_bg_active");
		gameThis.find("a").css("color","#F5A423");
		gameThis.siblings("span").find("i").removeClass("game_bg_active");
		gameThis.siblings("span").find("a").css("color","#D8D8D8");
	})	
	$(".game_list_3 span").click(function(){
		var gameThis = $(this);
		gameThis.find("i").addClass("game_bg_active");
		gameThis.find("a").css("color","#F5A423");
		gameThis.siblings("span").find("i").removeClass("game_bg_active");
		gameThis.siblings("span").find("a").css("color","#D8D8D8");
	})	
		$(".focusBox").slide({ mainCell:".pic",effect:"left", autoPlay:true, delayTime:300});
	//电子游艺真人娱乐场悬停
	$(".game_l_login_show div").mouseenter(function(){		
		var gameLoginThis = $(this);
		gameLoginThis.find(".game_l_login_show_mask").stop(true).animate({
			top : 0
		},300);
		gameLoginThis.find(".game_l_login_show_span").stop(true).animate({
			bottom : 20
		},300);
		gameLoginThis.find(".game_l_login_show_1_h1 img").stop(true).animate({
			top : 10
		},300);
		gameLoginThis.find(".game_l_login_show_2_h1 img").stop(true).animate({
			top : 0
		},300);
		gameLoginThis.find(".game_l_login_show_3_h1 img").stop(true).animate({
			top : 0
		},300);
		gameLoginThis.find(".game_l_login_show_4_h1 img").stop(true).animate({
			top : 10
		},300);	
		gameLoginThis.find("a").stop(true).animate({
			top : 220
		},300);
	}).mouseleave(function(){		
		var gameLoginThis = $(this);
		gameLoginThis.find(".game_l_login_show_mask").stop(true).animate({
			top : 480
		},100);
		gameLoginThis.find(".game_l_login_show_span").stop(true).animate({
			bottom : 65
		},300);
		gameLoginThis.find(".game_l_login_show_1_h1 img").stop(true).animate({
			top : -50
		},300);
		gameLoginThis.find(".game_l_login_show_2_h1 img").stop(true).animate({
			top : -70
		},300);
		gameLoginThis.find(".game_l_login_show_3_h1 img").stop(true).animate({
			top : -80
		},300);
		gameLoginThis.find(".game_l_login_show_4_h1 img").stop(true).animate({
			top : -70
		},300);	
		gameLoginThis.find("a").stop(true).animate({
			top : 480
		},300);
	})	
	//彩票游戏栏目悬停
	$(".lottery_open_1").mouseenter(function(){
		$(this).find(".lottery_open_span_1").stop(true).fadeOut(300);
		$(this).find(".lottery_open_span_2").stop(true).fadeIn(300);
	}).mouseleave(function(){
		$(this).find(".lottery_open_span_2").stop(true).fadeOut(300);
		$(this).find(".lottery_open_span_1").stop(true).fadeIn(300);		
	})
	//体育赛事下滑动门
	$(".sport_l_open div").mouseenter(function(){
		$(this).find("ul").stop(true).animate({
			top : 0
		},300)
	}).mouseleave(function(){
		$(this).find("ul").stop(true).animate({
			top : -480
		},300)
	})
	//电子游艺点击游戏厅切换滑动门
	$(".electric_slider_nav_ul li").click(function(){
		var elecSliderThis = $(this);
		var sliderIndex = $(this).index();
		$(".electric_slider_bottom").children("ul").eq(sliderIndex).show().siblings("ul").hide();
		$(".electric_slider_pic").children("ul").eq(sliderIndex).show().siblings("ul").hide();
		elecSliderThis.addClass("electric_slider_nav_active").siblings("li").removeClass("electric_slider_nav_active");
	})
	//电子游艺悬停上下滑动特效
	$(".electric_slider_pic ul li").mouseenter(function(){
		var elecThis = $(this);
		elecThis.find(".electric_slider_div").stop(true).animate({
			top : 0
		},300);
		elecThis.find(".electric_slider_mask").stop(true).animate({
			top : 0
		},300);
	}).mouseleave(function(){
		var elecThis = $(this);
		elecThis.find(".electric_slider_div").stop(true).animate({
			top : -180
		},300);
		elecThis.find(".electric_slider_mask").stop(true).animate({
			top : 180
		},300);		
	})
	
	//欢迎登陆注册账号页面
	//点击左边导航变色
	$(".register_nav ul li").click(function(){
		$(this).find("a").css("color","#F5A423").find("i").addClass("register_nav_i_active");
		$(this).siblings("li").find("a").css("color","#999999").find("i").removeClass("register_nav_i_active");
	})
	
	
	//会员首页导航切换
	$(".vip_login_nav_li").click(function(){
		$(this).find("i").addClass("vip_login_i_active")
		$(this).siblings("li").find("i").removeClass("vip_login_i_active")
		$(this).css("color","#F5A423")
		$(this).siblings("li").css("color","#FFFFFF")
	});

	//取款表单页面滑动门
	$(".take_money_top ul li").click(function(){
		$(this).addClass("take_money_top_active").siblings("li").removeClass("take_money_top_active");
	});	
	
	//点击充值方式变色
	$(".third_pay_style li").click(function(){
		$(this).addClass("third_pay_style_active");
		$(this).find("img").css("right","0px");
		$(this).siblings("li").removeClass("third_pay_style_active");
		$(this).siblings("li").find("img").css("right","-20px");
	});	
	
	//首页会员登陆状态栏目切换
	$(".banner_login_had_list a").click(function(){
		$(this).addClass("banner_login_had_list_active").siblings("a").removeClass("banner_login_had_list_active")
	});	
	
	//活用详情点击
	$(".preferential_show_a").click(function(){
		$(this).next("img").toggle();
	});	
	
	//24小时电话
	$(".right_absolute_1_1").mouseenter(function(){
		$(this).hide();
		$(".right_absolute_1_2").show();
	});
	$(".right_absolute_1_2").mouseleave(function(){
		$(".right_absolute_1_1").show();
		$(this).hide();
	});
	//QQ客服
	$(".right_absolute_2").mouseenter(function(){
		$(this).addClass("right_absolute_2_active");
		$(".right_absolute_2_1,.right_absolute_2_2").show()
	}).mouseleave(function(){
		$(this).removeClass("right_absolute_2_active");
		$(".right_absolute_2_1,.right_absolute_2_2").hide()
	});
	//自助充值
	$(".right_absolute_3").mouseenter(function(){
		$(this).addClass("right_absolute_3_active");
		$(this).find("a").show();
	}).mouseleave(function(){
		$(this).removeClass("right_absolute_3_active");
		$(this).find("a").hide();
	});	
	//快捷充值
	$(".right_absolute_4").mouseenter(function(){
		$(this).addClass("right_absolute_4_active");
		$(this).find("input,a").show();
	}).mouseleave(function(){
		$(this).removeClass("right_absolute_4_active");
		$(this).find("input,a").hide();
	});	
})

