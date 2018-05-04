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

/**
 * 文字閃爍
 * @param id   jquery selecor
 * @param arr  ['#FFFFFF','#FF0000']
 * @param s    milliseconds
 */
function toggleColor(id, arr, s) {
    var self = this;
    self._i = 0;
    self._timer = null;

    self.run = function() {
        if(arr[self._i]) {
            id.css('color', arr[self._i]);
            if(id.text() == '个人QQ转账'){
                console.log(arr[self._i]);
            }
        }

        self._i == 0 ? self._i++ : self._i = 0;
        self._timer = setTimeout(function() {
            self.run(id, arr, s);
        }, s);
        console.log(id.text());
    }
    self.run();
}

//讀取文案連結  data-color
$(function() {
    var arr = [];
    $('a.js-article-color').each(function(i) {
        var color_arr = $(this).data('color');

        if ('undefined' ==  typeof color_arr) return;

        color_arr = color_arr.split('|');

        // 確認顏色數量  2=>閃爍   1=>單一色  0=>跳過
        if(color_arr.length == 2) {
            console.log($(this).text());
            arr[i] = new toggleColor($(this), [color_arr[0], color_arr[1]], 500 );
        }else if(color_arr.length == 1 && color_arr[0] != ''){
            $(this).css('color', color_arr[0]);
        }
    });
});


//监听导航滚动
$(window).scroll(function(){
    var scrollTop = $(document).scrollTop(),
        easyName = '<div class="head_easy fr">易记域名：<span class="color_red">www.dd788799.com</span></div>',
        scrollDiv = '<div class="scrollDiv"></div>'

    if(scrollTop > 153){
        if($('.scrollDiv').length == 0){
            $('.header_contain').before(scrollDiv)
        }
        $('.nav_all').addClass('fixed_2');
        $('.header_all').addClass('fixed');
    }else{
        $('.nav_all').removeClass('fixed_2')
        $('.header_all').removeClass('fixed')
        $('.scrollDiv').remove()
    }

})

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

$(document).ready(function(){
    //24小时电话
//	$(".right_absolute_1_1").mouseenter(function(){
//		$(this).hide();
//		$(".right_absolute_1_2").show();
//	});
//	$(".right_absolute_1_2").mouseleave(function(){
//		$(".right_absolute_1_1").show();
//		$(this).hide();
//	});
    //QQ客服
//	$(".right_absolute_2").mouseenter(function(){
//		/*原
//		$(this).addClass("right_absolute_2_active");
//		$(".right_absolute_2_1,.right_absolute_2_2").show()
//		*/
//		$(".right_absolute_2_1").hide();
//		$(".right_absolute_2_2").show();		
//	}).mouseleave(function(){
//		/*原
//		//$(this).removeClass("right_absolute_2_active");
//		//$(".right_absolute_2_1,.right_absolute_2_2").hide()
//		*/
//		$(".right_absolute_2_1").show();
//		$(".right_absolute_2_2").hide();		
//	});
    //自助充值
//	$(".right_absolute_3").mouseenter(function(){
//		/*原
//		$(this).addClass("right_absolute_3_active");
//		$(this).find("a").show();
//		*/
//		$(".right_absolute_3_1").hide();
//		$(".right_absolute_3_2").show();		
//	}).mouseleave(function(){
//		/*原
//		$(this).removeClass("right_absolute_3_active");
//		$(this).find("a").hide();
//		*/
//		$(".right_absolute_3_1").show();
//		$(".right_absolute_3_2").hide();		
//	});	

    /*
    //快捷充值
    $(".right_absolute_4").mouseenter(function(){
        $(this).addClass("right_absolute_4_active");
        $(this).find("input,a").show();
    }).mouseleave(function(){
        $(this).removeClass("right_absolute_4_active");
        $(this).find("input,a").hide();
    });
    */
//	$(".right_absolute_4").click(function(){
//		$('.right_absolute').hide();
//	});

    $('#qian_dao').click(function(){
        //window.open('qian_dao.php','qian_dao','menubar=no,status=yes,scrollbars=yes,top=150,left=400,toolbar=no,width=805,height=520');
        $.ajax({
            type: "post",
            url: '/activity/qiandao.html',
            data:{'ajax':1},
            success:function(data) {
                alert(data);
            }
        });
    });

    $(".left_absolute_4").click(function(){
        $('.left_absolute').hide();
    });
    $(".right_absolute_4").click(function(){
        $('.right_absolute').hide();
    });
})	