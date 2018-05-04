//if(self==top){
//	top.location='/';
//}

function go(url){
	location.href=url;
}

var time=61;  		//120秒自动刷新

$(document).ready(function(){
	Refresh(); //自动刷新
});


function Refresh(){
	time=time-1;
	if(time<1){
		time=61;
		$("#top_f5").val(document.documentElement.scrollTop);
		var league = document.getElementById('league').value
		var page = document.getElementById('aaaaa').innerHTML;
		loaded(league,page);
	}else{
		$("#sx_f5").val("刷新"+time);
	}
	setTimeout("Refresh()",1000);
}

function formatNumber(num,exponent){
	return parseFloat(num).toFixed(exponent);
}  

function shuaxin(league){
	time=61
	$("#top_f5").val(document.documentElement.scrollTop);
	var page = document.getElementById('aaaaa').innerHTML;
	loaded(league,page);
}

function NumPage(thispage){
	var league = document.getElementById('league').value;
	document.getElementById('aaaaa').innerHTML = thispage;
	loaded(league,thispage,'p');
}

function check_one(lsm){
	document.getElementById("league").value	=	lsm;
	loaded(lsm);
}

var li_top = 0;


var li_top = 0;
function gdt(){
	//document.getElementById("lantiao").style.position = "";
}

$(window).scroll(function(){
	gdt();
});



/* 登入表單效果
 * @param _o object {
 *     Opacity : 標題透明度
 *     MS      : 標題顯示速度
 *   }
 */
$.fn.InputLabels = function(_o) {
    var o = {
        'Opacity' : 0.5, 
        'MS'      : 300,
        'next'    : false
    };
    $.extend(o, _o);
     
    return this.each(function() {
        var label = $(this);
        var input = o.next ? $(this).next('input[name=' + $(this).attr('name') + ']') : $('input[name=' + $(this).attr('name') + ']');
        var show = true;
        
        // 預防瀏覽器記帳密機制
        setTimeout(function(){
        	if(input.val() == "") label.css('opacity' , 1.0);
        },100);
        
        label.click(function(){
            input.trigger('focus');
        });
        
        input.focus(function() { 
            if (input.val() == "") { 
            	setOpacity(o.Opacity);
            }
        }).blur(function() { 
            if (input.val() == "") { 
                if (!show) { 
                    label.css({ opacity: 0.0 }).show(); 
                }
                setOpacity(1.0); 
            } else { 
                setOpacity(0.0); 
            }
        }).keydown(function(e) { 
            if ((e.keyCode == 16) || (e.keyCode == 9) || (e.keyCode == 13)) return; 
            if (show) { 
                label.hide(); 
                show = false; 
            }
        });
     
        var setOpacity = function(opacity) { 
            label.stop().animate({'opacity' : opacity }, o.MS); 
            show = (opacity > 0.0); 
        }; 
    });
};

var frameCounter = 0;
var frameLastHeight = 0;
function setIframe(frameId){
	var iframe = document.getElementById(frameId);
	if(iframe == null){return;}
	var bHeight = iframe.contentWindow.document.body.scrollHeight;
	var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;
	var height = bHeight>dHeight?bHeight:dHeight;
	iframe.height = height
}

$(document).ready(function() {
    var iframe = document.getElementById('mainFrame');
	if(iframe!=null) {
		//setInterval("setIframe('mainFrame')",1000);
	}
});


$.fn.mtab = function(){
    var area = this;

    area.find('li[id^=#]').click(function(){
        var self = this;
        $.each(area.find('li[id^=#]'),function(i){
            if(self.id != this.id){
                area.find(this.id).hide('fast');
                $(this).removeClass('mtab');
            }else{
                area.find(this.id).show('fast');
                $(this).addClass('mtab');
            }
        });
    });
};
/**
*  無動畫切換
*/
$.fn.mtab2 = function(){
    var area = this;
    $.each(area.find('li[id^=#]'),function(i){
    	if(i!=0){
    		area.find(this.id)[0].style.display = 'none';
    	}
    });
    area.find('li[id^=#]').click(function(){
        var self = this;
        $.each(area.find('li[id^=#]'),function(i){
            if(self.id != this.id){
                area.find(this.id)[0].style.display = 'none';
                $(this)[0].style.backgroundPosition = 'top';
                $(this).removeClass('mtab');
            }else{
                area.find(this.id)[0].style.display = 'block';
                $(this)[0].style.backgroundPosition = 'bottom';
                $(this).addClass('mtab');
            }
        });
    });
};
/**
*  無動畫切換、底圖位置不動
*/
$.fn.mtab3 = function(){
    var area = this;

    area.find('li[id^=#]').click(function(){
        var self = this;
        $.each(area.find('li[id^=#]'),function(i){
            if(self.id != this.id){
                area.find(this.id)[0].style.display = 'none';
                $(this).removeClass('mtab');
            }else{
                area.find(this.id)[0].style.display = 'block';
                $(this).addClass('mtab');
            }
        });
    });
};

/**
 * mtab4
 * 
 * fix union hierarchy for fixed ancestor
 */
(function($) {
    $.fn.mtab4 = function() {
        //iterate the match elements
        return this.each(function() {
            var $this = $(this);
            //initialize, hide children div except first one
            var divs = $this.children('div');
            divs.not(':first').hide();
            
            //bind click to switch tabs
            var lis = $this.children('ul').children('li');
            lis.click(function(e){
            	var element = $(this),
            		position = $.inArray(element[0], lis);
            	
            	//add & remove class for tabs
            	lis.removeClass('mtab');
            	element.addClass('mtab');
            	
            	//hide & show for container
            	divs.not(':eq(' + position + ')').hide();
            	divs.eq(position).show();
            	
            });
        });
    };
})(jQuery); 


function killerrors() {
	return true;
}
window.onerror = killerrors; 

$(function(){
	$("#J_broadcast").click(function(){
//		window.open('../result/noticle.php','newwindow','menubar=no,status=yes,scrollbars=yes,top=150,left=408,toolbar=no,width=575,height=550')
		location.href='/index/noticle.html';
	});    	   
});
// 圖片 淡出效果
    $('#firstBTN a, #first-GameList a').hover(
        function(){
            $(this).stop().animate({'opacity': 0}, 500);
        }, function(){
            $(this).stop().animate({'opacity': 1}, 500);
        }
    );

$("#LoginForm label").InputLabels();

function Go_forget_pwd(){
    window.open("/get_pwd.php","Go_forget_pwd","width=350,height=250,status=no");
}

 function getKey(){

//                  $("#vPic").attr("src",'/yzm.php?'+Math.random());
                    $("#vPic").show();
                    $("input[name='vlcodes']").val("");
        }
//alert();
function mainOnclick(as){
	if(typeof(window.mainFrame)=='object'){
		mainFrame.location.href='/'+as;
	}else{
		top.mem_index.location.href="/Sports.php?action=/"+as;
	}
}

function topUserLogin(){
	
	var un	=	$("#username").val();
	if(un == "" || un == "帐户"){
		$("#username").focus();
		return false;
	}
	var pw	=	$("#password").val();
	
	if(pw == "" || pw == "******"){
		$("#password").focus();
		return false;
	}
	
	/*var vc	=	$("#vlcodes").val();
	if(vc == "" || vc == "验证码" || vc.length<4){
		$("#vlcodes").focus();
		return false;
	}*/
	
	$("#formsub").attr("disabled",true); //按钮失效
	$.post("/logincheck.php",{r:Math.random(),action:"login",username:un,password:pw},function(login_jg){
		if(login_jg.indexOf("1")>=0){ //验证码错误
			alert("验证码错误，请重新输入");
			$("#vlcodes").select();
		}else if(login_jg.indexOf("2")>=0){ //用户名称或密码
			alert("用户名或密码错误，请重新输入");
			$("#vlcodes").val(''); //清空验证码
			$("#password").val(''); //清空验证码
			$("#username_a").select();
		}else if(login_jg.indexOf("3")>=0){ //停用，或被删除，或其它信息
			alert("账户异常无法登陆，如有疑问请联系在线客服");
		}else if(login_jg.indexOf("4")>=0){ //登陆成功
			parent.window.location.reload();
			//parent.mainFrame.location.href='show/shouye.php';
			//parent.leftFrame.window.location.reload();
		}	
		//alert(login_jg);											 
		$("#formsub").attr("disabled",false); //按钮有效
	});
}
