/*
	JavaScript封装:
	
	1. Countdown(obj,classname,num)    //倒计时  1.点击的对象  2.类  3.数值
	
	2. autotop(obj,ops,valt)    //垂直翻滚 1.li集合  2.距离  3.个数
	
	3. click_cgimg(obj,index,imgname)    //切换图片  1.对象  2.索引值  3.图片名称
	
	4. click_addname(obj,className,allt)    //给对象添加类  1.点击的对象  2.类名  3.是否清除所有-非零[可选]
	
	5. slideshow(click_show,obj_open,class_name)    //三级菜单展开  1.点击的对象  2.展开的对象  3.添加类名旋转图标
	
	6. suspension(click_obj,move_obj,distance,className)    //悬浮  1.点击的对象  2.移动的对象  3.距离右边的数值 4.类名
	
	7. full_screen(number,click_left,click_right,click_cirl)    //全屏左右滚动轮播 1.数量  2.左点击  2.右点击  3.小圆点点击
	
	8. autobox(obj,oble,value,pase)    //居中 1.对象  2. 0-[左边] 1-[右边]  3.宽度  4.偏移量
	
	9. Cutimg(obj)    //裁图后 垂直水平居中  1.图片对象
	
	10. eject(hover_obj,hide_obj)    //弹出菜单  1.移上去的对象  2.隐藏的对象
	
	11. replaimg(obj)    //HOVER变颜色的图标 1.移上去的对象
	
	12. scrollTop(obj_fixed,ClassName,value)    //当元素滚动到一定时就固定定位  1.定位的对象  2.加入一个类  3.默认值不可更改
	
	13. tabs_cg(Oobj,Otabch,event,ClassName,Find,level){//选项卡切换  1.点击的对象  2.切换的的对象  3.事件   4.类名  5.查找下一级   6.如果Find实参存在,缺少值是为 1
	
	14. two_scroll(number,cli_left,cli_right,click_cirl,textp,ovalue,ots){//滚动轮播 1.元素的个数	2.左点击对象	3.右点击对象	4.小圆点对击对象[可选项] 5.文字变化 6.滚动的距离[必选项] 7.滚动的个数[必选项]
	
	15. down_drop(a,b,c)    //下拉列表	1.点击获取文本内容  2.点击对像显示下拉  3.下拉这个Div对像
	
	16. fade(banner,cirl,timer,click_left,click_right)    //淡入淡出轮播  1.切换的对像	2.小圆点控制的对像	 3.时间值[必选]  4.左点击  5.右点击
	
	17. cli_cgimg(obj) //点击图标状态切换  1.点击的对象
	
	18. checkbox(obj,findbel){ //复选框
	
	19.cli_cgpic(obj)  //按下图标切换
	
	20. getFileUrl(sourceId) { //获取File上传图片
	
	21. seamless(obj,next,prev,title){ //无缝滚动轮播
	
	22. myScroll()	//返回顶部
	
	23. newRoll	//新闻滚动
	
	24. copy	//复制textarea里面的内容
	
	25. alertbox	//弹窗js
	
	26. upimg//加载结构

	27. numadd //数量加减
	
	28. shoutext //点击展开
	匹配正则:
	
	一、letter(str_par)	[密码必须由6-15位数字加字母组成]
	二、number(str_par)	[账号由6-15位字符串组成]
	三、CheckMail(mail)	[邮箱正则]
	四、checkPhone()		[手机号正则] #phone
	
*/

$(".menu_left .list_menu ul li a.Refresh").click(function(){
		window.location.reload();
	})
$('.type_top .left .left_div .log,.type_top .left .left_div .alert_log').hover(function(){
	$('.type_top .left .left_div .alert_log').show();
	$('.type_top .left .left_div .alert_par').hide();
	})
$('.type_top').hover(function(){
	
	},function(){
		$('.type_top .left .left_div .alert_log').hide();
		$('.type_top .left .left_div .alert_par').hide();
		})
$('.type_top .right ul li.l').hover(function(){
	$(this).addClass('sli');
	$(this).find('div').show();
	})
$('.type_top .right ul li').hover(function(){
	
	},function(){
		$(this).removeClass('sli');
	$(this).find('div').hide();
		})
$('.type_top .left .left_div a.par').hover(function(){
	$('.type_top .left .left_div .alert_par').show();
	$('.type_top .left .left_div .alert_log').hide();
	})
	var eedd=0,ert=0;
// $(".main_layout .right_layotu .left_wrap .Bettingbag .num_bett .val_add p.fr").find("a:eq(0)").click(function(){
// 		oen=$(this).parents(".num_bett").find(".box_n span").length;
// 		eedd=$(this).parents(".num_bett").index()-1;
//
// 		$(this).parents(".num_bett").find(".box_n span").each(function(index) {
//
//
//             index=setInterval(function(){
// 				$(".main_layout .right_layotu .left_wrap .Bettingbag .num_bett:eq("+eedd+") .box_n span").text(parseInt(99*Math.random()))
// 				setTimeout(function(){
// 						clearInterval(index);
// 						$(".main_layout .right_layotu .left_wrap .Bettingbag .num_bett:eq("+eedd+") .box_n span").parents(".num_bett").find(".box_n span").each(function(index) {
// 						$(this).text(parseInt(99*Math.random()));
// 						});
// 					},300)
// 				},10)
//
//             // var className = 's'+Math.round(2*Math.random());
//             // $(this).removeClass().addClass(className);
//         });
//
//
// 	})
	
function CountDown(element,divtype){//活动倒计时
	ShowCountDown();
	var tid=0;
	tid=setInterval(ShowCountDown,1000);
 	function ShowCountDown()
    {
        var cc = $(element);
        var elem = $(element).find(".state");
		
        var arr = cc.attr("end-timer").split(":");
        var now = new Date();
		
        var endDate = new Date(arr[0], arr[1]-1, arr[2], arr[3],arr[4],arr[5]);
	    var leftTime=endDate.getTime()-now.getTime();
		if (leftTime>0){			
			var leftsecond = parseInt(leftTime/1000);
			var day1=Math.floor(leftsecond/(60*60*24));
			var hour=Math.floor((leftsecond-day1*24*60*60)/3600).toString();
			var minute=Math.floor((leftsecond-day1*24*60*60-hour*3600)/60).toString();
			var second=Math.floor(leftsecond-day1*24*60*60-hour*3600-minute*60).toString();
			var hour=Math.floor((leftsecond-day1*24*60*60)/3600+24*day1).toString();
			if(hour<10) hour="0"+hour;
			if(minute<10) minute="0"+minute;
			if(second<10) second="0"+second;
			var countDown = "倒计时 : "+day1+"天"+hour+"小时"+minute+"分"+second+"秒"
			//console.log(countDown);
			$(divtype+" .s span.sp1").text(hour.substring(0, 1));
			$(divtype+" .s span.sp2").text(hour.substring(2, 1));
			
			$(divtype+".f span.sp1").text(minute.substring(0, 1));
			$(divtype+".f span.sp2").text(minute.substring(2, 1));
			
			$(divtype+" .m span.sp1").text(second.substring(0, 1));
			$(divtype+" .m span.sp2").text(second.substring(2, 1));
		} else{
				
				clearInterval(tid);
				$(divtype+" span").text('0');
			}
	}
}

function shoutext(Oclick,Ofind){//点击展开
	$(Oclick).click(function(){
		if($(this).attr("opent")=="1"){
				$(this).parent().find(Ofind).slideUp();
				$(Oclick).removeAttr("opent");
			}else{
			$(Oclick).removeAttr("opent");
			$(Oclick).parent().find(Ofind).slideUp();
			$(this).attr("opent","1").parent().find(Ofind).slideDown();
			}
		});
}

function numadd(obj,click_left,click_right){//数量加减
	var i=1;
	$(click_left).click(function(){
			if(i>1){
					i--;
					$(this).parent().find("input").val(i);
				}
			if(i==1){
					$(this).addClass("noadd");
				}
			
		})
	$(click_right).click(function(){
			i++;
			$(obj).removeClass("noadd");
			$(this).parent().find("input").val(i);
		});
	}


function upimg(obj,append){//upimg
	$(obj).change(function(){
			$(append).append('<li><div class="pict"><i><img src="'+getFileUrl("upp")+'" alt=""></i></div></li>');
		})
	}
	
function alertbox(click_show,click_hide,obj){//弹窗js
	$(click_hide).click(function(){
			$(obj).fadeOut();
		})
	$(click_show).click(function(){
			$(obj).fadeIn();
		})
}

function copy(click_obj){	//新闻滚动
$(click_obj).click(function(){
		$(this).parents("li").find("textarea").select();
		document.execCommand("Copy"); // 执行浏览器复制命令
	})
}
function newRoll(obj){	//新闻滚动
		var olent=$(obj).length;
		var j=0;
		var timter;
		for(var i=0;i<olent;i++)
		$(obj).eq(i).css({"top":i*$(obj).height()+"px"});
		timter=setInterval(stol,3000);
		$(obj).hover(function(){
				clearInterval(timter);
			},function(){
				timter=setInterval(stol,3000);
				})
		function stol(){
			j++;
			if(j>olent-1) j=0;
			$(obj).each(function(index, element) {
				var tp=parseInt($(this).css("top"));
                $(this).animate({"top":tp-$(obj).height()+"px"},500,function(){
						$(obj).eq(j-1).css("top",(olent-1)*$(obj).height()+"px")
					});
            });
			
			}		
}

function myScroll() { 
var x=document.body.scrollTop||document.documentElement.scrollTop; 
var timer=setInterval(function(){ 
x=x-15; 
if(x<100) 
{ 
x=0; 
window.scrollTo(x,x); 
clearInterval(timer); 
} 
window.scrollTo(x,x); 
},"1"); 
} 

function seamless(obj,next,prev,title){//无缝滚动轮播
	var olent=$(obj).length;
	$(obj).each(function(index, element) {
        $(this).animate({"left":index*$(this).width()+"px"})
    });
	var poi=0;
	$(next).click(function(){//下一张
		poi++;
		if(poi>=olent) poi=0;
		$(title).eq(poi).addClass("acti").siblings().removeClass("acti");
			$(obj).each(function(index, element) {
				var left=parseInt($(this).css("left"))-$(this).width();
				$(this).stop().animate({"left":left+"px"},500,function(){
						$(obj).eq(poi-1).css("left",(olent-1)*$(this).width()+"px")
						
					});
				});
		})
		$(prev).click(function(){
			poi--;
			if(poi<0) poi=olent-1;
			$(obj).eq(poi).css("left",-$(obj).width()+"px");
			$(title).eq(poi).addClass("acti").siblings().removeClass("acti");
				$(obj).each(function(index, element) {
					var left=parseInt($(this).css("left"))+$(this).width();
					$(this).stop().animate({"left":left+"px"},500,function(){
							
							
						});
					});
			
				
			})
}

function getFileUrl(sourceId) { //获取File上传图片
var url; 
if (navigator.userAgent.indexOf("MSIE")>=1) { // IE 
url = document.getElementById(sourceId).value; 
} else if(navigator.userAgent.indexOf("Firefox")>0) { // Firefox 
url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0)); 
} else if(navigator.userAgent.indexOf("Chrome")>0) { // Chrome 
url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0)); 
} 
return url; 
}

function addInput(obj){//复选框选择
	$(obj).click(function(){
		if($(this).find("input[type='checkbox']").is(':checked')==true){
					$(this).find("input").addClass("check");
				}else{
						$(this).find("input").removeClass("check");
					}
	});
};
function checkbox(obj,findbel){//复选框
		$(obj).click(function(){
			if($(this).find("input[type='checkbox']").is(':checked')==true){
					$(this).find(findbel).show();
				}else{
						$(this).find(findbel).hide();
					}
		})	;
		}
		
function cli_cgpic(obj){//两色图标切换   cli_cgpic(".list ul li h2");
$(obj).click(function(){
		if($(this).attr("ter")=="1"){
            var path_img=$(this).find('img').attr('src');
			var new_path=path_img.replace("-1.",".");
			$(this).find('img').attr('src',new_path);
			$(this).attr("ter","0");
		}else{
		var path_img=$(this).find('img').attr('src');
		var new_path=path_img.replace(".","-1.");
		$(this).find('img').attr('src',new_path);
		$(this).attr("ter","1");
		}
	})
}

function checkPhone(){ 
    var phone = document.getElementById('phone').value;
    if(!(/^1[3|4|5|7|8]\d{9}$/.test(phone))){ 
        alert("手机号码有误，请重填");  
        return false; 
    }
}
function Countdown(obj,classname,num){//倒计时  1.点击的对象  2.类  3.数值
	var jte=num;
	var tee=null;
	$(obj).click(function(){
			$(this).addClass(classname);
			 tee=setInterval(function(){
				jte--;
			if(jte<=0) {$(obj).removeClass(classname).text('获取短信验证码');jte=60;}
			$(obj+'.'+classname).text('重新发送('+jte+')');
		},1000);
		})
}

function  autotop(obj,ops,valt){//垂直翻滚 1.li集合  2.距离  3.个数 autotop('.main_push .center_con ul',106,3)
	var eft=0;
	setInterval(ett,3000);
	$(obj).css({"position":"absolute"})
	var oelnt=$(obj).find('li').length;

	function ett(){
		eft++
		if(eft>oelnt-valt) eft=0;
		$(obj).animate({"top":-eft*ops+"px"},600);		
	}
}
cli_cgimg(".top .list_ico ul li");
function cli_cgimg(obj){
$(obj).click(function(){
		$(obj).each(function(index, element) {
            var path_img=$(this).find('img').attr('src');
			var new_path=path_img.replace("-1.",".");
			$(this).find('img').attr('src',new_path);
        });
		var path_img=$(this).find('img').attr('src');
		var new_path=path_img.replace(".","-1.");
		$(this).find('img').attr('src',new_path);
		
	})
}
function click_cgimg(obj,index,imgname){//切换图片  1.对象  2.索引值  3.图片名称
	$(obj).eq(index).click(function(){
	if($(this).attr('adimg')=="1"){
			$(this).attr('adimg','0');
			$(this).find('img').attr("src","img/"+imgname+".png");
		}else{
				$(this).find('img').attr("src","img/"+imgname+"-1.png");
				$(this).attr('adimg','1');
			}
	})
}
	

function click_addname(obj,className,allt){//给对象添加类  1.点击的对象  2.类名  3.是否清除所有-非零[可选] 
		if(allt>0){
		$(obj).click(function(){
				$(obj).removeClass(className);
				$(this).addClass(className);
			})
			}else{
					$(obj).click(function(){
					$(this).addClass(className).siblings().removeClass(className);				
			})
				}
	}

function slideshow(click_show,obj_open,class_name){//三级菜单展开  1.点击的对象  2.展开的对象  3.添加类名旋转图标
$(click_show).click(function(){
		if($(this).attr('true')=="1"){
			$(this).parent().find(obj_open).slideUp();
			$(this).removeClass(class_name);
			$(this).attr('true',"0");
		}else{
				$(this).parent().find(obj_open).slideDown();
				$(this).addClass(class_name);
				$(this).attr('true',"1");
			}
	})
}

function suspension(click_obj,move_obj,distance,className){//悬浮  1.点击的对象  2.移动的对象  3.距离右边的数值 4.类名 
$(click_obj).click(function(){
		
		if($(this).attr('open')=='1'){
				$(move_obj).animate({'right':-$(move_obj).width()-2+"px"},600,'swing');
				$(this).attr('open','0');
				$(this).removeClass(className);
			}else{
					$(this).addClass(className);
					$(move_obj).animate({'right':distance+"px"},600,'swing');
					$(this).attr('open','1');
				}
	})
}


function letter(str_par){//密码必须由6-15位数字加字母组成
		var reg=/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/
		if(reg.test($(str_par).val())){
			//alert("密码PASS通过");
		}else{
			$(str_par).parent().find('b').slideDown();
			$(str_par).focus(function(){
			 	$(this).parent().find('b').slideUp();
			 })
			
			}
	}
	function number(str_par){//账号由6-15位字符串组成
		var reg=/^[a-zA-Z0-9]{6,15}$/
		if(reg.test($(str_par).val())){
			//alert("账号PASS通过");
		}else{
			$(str_par).parent().find('b').slideDown();
			$(str_par).focus(function(){
			 	$(this).parent().find('b').slideUp();
			 })
			}
	}
	function CheckMail(mail) {//邮箱正则
		 var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		 if (filter.test($(mail).val())) return true;
		 else {
		 //alert('您的电子邮件格式不正确');
		 $(mail).parent().find('b').slideDown();
		 $(mail).focus(function(){
			 	$(this).parent().find('b').slideUp();
			 })
		 return false;}
	}

		
function full_screen(number,click_left,click_right,click_cirl){//全屏左右滚动轮播 1.数量  2.左点击  2.右点击  3.小圆点点击
var olen1=$(number).length;
var timer=0;
var bowidth1=$('body').width();
$(number).parent().width(bowidth1*olen1+"px");
var thinde1=0;

$(number).css("width",bowidth1+"px");

for(var j=0;j<olen1;j++){
		$(number).eq(j).css("left",j*bowidth1+"px");
	}
$(click_right).click(function(){
		thinde1++;
		if(thinde1<olen1){
		$(number).parent().animate({"left":-thinde1*bowidth1+"px"},600,"swing");}
	})
$(click_left).click(function(){
		if(thinde1>0){
			thinde1--;
		$(number).parent().animate({"left":-thinde1*bowidth1+"px"},600,"swing");
		}
	})
	
$(click_cirl).click(function(){
		thinde1=$(this).index();
		$(this).addClass('acti').siblings().removeClass('acti');
		$(number).parent().animate({"left":-thinde1*bowidth1+"px"},600,"swing");	
	})
timer=setInterval(autocroll,3000);
function autocroll(){
		thinde1++;
		if(thinde1>olen1-1) thinde1=0;
		
		$(click_cirl).eq(thinde1).addClass('acti').siblings().removeClass('acti');
		$(number).parent().animate({"left":-thinde1*bowidth1+"px"},600,"swing");		
	}
$(click_cirl).hover(function(){
		clearInterval(timer);
	},function(){
			timer=setInterval(autocroll,3000);
		})

}


function autobox(obj,oble,value,pase){//居中 1.对象  2. 0-[左边] 1-[右边]  3.宽度  4.偏移量
lrauto();
$(window).resize(function(){
		 lrauto();
	})
function lrauto(){
		var bwidt=$("body").width();
		if(oble==0){
				$(obj).css({left:(bwidt-value)/2+pase+"px"});
		}else{
			if(oble==1){
				$(obj).css({right:(bwidt-value)/2+pase+"px"})
				}
				else{
						alert('第二个传值出错！0是左 1是右');
					}
			}
	}
}

function Cutimg(obj){//裁图后 垂直水平居中  1.图片对象
autoimg()
$(window).resize(function(){
		 autoimg()
	})
function autoimg(){
		var widt=$(obj).parent().width();
		var heit=$(obj).parent().height();
		var img_wid=$(obj).width();
		var img_hei=$(obj).height();
		$(obj).css({"left":(widt-img_wid)/2+"px","top":(heit-img_hei)/2+"px","position":"absolute"});
		$(obj).parent().css({"position":"relative","overflow":"hidden"});
	}
}
function eject(hover_obj,hide_obj){//弹出菜单  1.移上去的对象  2.隐藏的对象
	$(hide_obj).hide();
	$(hover_obj).hover(function(){
		$(hide_obj).hide();
		$(hide_obj).eq($(this).index()).show();
	})
$(hide_obj).parent().hover(function(){
	
	},function(){
			$(hide_obj).fadeOut();
		})
}

function replaimg(obj){//HOVER变颜色的图标 1.移上去的对象
	$(obj).hover(function(){
			var path_img=$(this).find('img').attr('src');
			var new_path=path_img.replace(".","-1.");
			$(this).find('img').attr('src',new_path);			
		},function(){
			var path_img=$(this).find('img').attr('src');
			var new_path=path_img.replace("-1.",".");
			$(this).find('img').attr('src',new_path);
			})
	}

function scrollTop(obj_fixed,ClassName,value){//当元素滚动到一定时就固定定位  1.定位的对象  2.加入一个类  3.默认值不可更改
	$(window).scroll(function(){
			var valt=$(window).scrollTop();
			var top=$(obj_fixed).offset().top;
			if(value==1){
					value=top;
				}
			if(valt>value){
				$(obj_fixed).addClass(ClassName);
				}else{
				$(obj_fixed).removeClass(ClassName);
				}
		})
	}
	

function tabs_cg(Oobj,Otabch,event,ClassName,Find,level,ef){//选项卡切换  1.点击的对象  2.切换的的对象  3.事件   4.类名  5.查找下一级   6.如果Find实参存在,缺少值是为 1  

	
	if(level==1){
			$(Oobj)[event](function(){
				var t=$(this).index();
				$(this).addClass(ClassName).siblings().removeClass(ClassName);
				$(this).parents(Otabch).find(Find).eq(t).show().siblings().hide();
			});
		}else{
				
				$(Otabch).hide();
				$(Otabch).first().show();
				$(Oobj)[event](function(){
					if (ef==1){
					if($(this).index()!=0){
							$(".process .layout .monty").animate({"left":"-29px"},300);
						}else{
								$(".process .layout .monty").animate({"left":"-40px"},300);
							}
					}
					$(this).addClass(ClassName).siblings().removeClass(ClassName);
					$(Otabch).hide()
					$(Otabch).eq($(this).index()).show();
				})
			}
	
}

function two_scroll(number,cli_left,cli_right,click_cirl,textp,height){//滚动轮播 1.元素的个数	2.左点击对象	3.右点击对象	4.小圆点对击对象[可选项] 5.文字变化 6.滚动的距离[必选项] 7.滚动的个数[必选项]
	var olit=$(number).length;//元素的数量
	ots=parseInt($(number).parent().parent().width()/$(number).width());
	ovalue=$(number).width()+parseInt($(number).css("margin-left"));
	$(number).parent().css({"width":ovalue*olit+"px","position":"absolute"}).parent().css({"position":"relative","overflow":"hidden","height":height});/*计算宽度*/
	var objscr=$(number).parent()//滚动的对像
	var j=0;//统计 
	var setotimer=null;//时间变量	
	setotimer=setInterval(orcroauto,3000);
	
	$(cli_left).hover(function(){
			clearInterval(setotimer);
		},function(){
			setotimer=setInterval(orcroauto,3000);
			})
	$(cli_right).hover(function(){
			clearInterval(setotimer);
		},function(){
			setotimer=setInterval(orcroauto,3000);
			})
	$(click_cirl).hover(function(){
			clearInterval(setotimer);
		},function(){
			setotimer=setInterval(orcroauto,3000);
			})
			
    $(cli_left).click(function(){
			j--;
			if(j<0){j=olit-ots}
			$(objscr).stop().animate({"left":-j*ovalue+"px"},600,"swing");
			$(click_cirl).eq(j).addClass('acti').siblings().removeClass('acti');
			$(textp).animate({"top":-j*$(textp).parent().height()+"px"});
		})
		
	$(cli_right).click(function(){
			orcroauto()
	})
	$(click_cirl).click(function(){
			j=$(this).index();
			$(objscr).stop().animate({"left":-j*ovalue+"px"},600,"swing");
			$(this).addClass('acti').siblings().removeClass('acti');
			$(textp).animate({"top":-j*$(textp).parent().height()+"px"});
			
		})
	function orcroauto(){
		j++;
		if(j>olit-ots){j=0}
		$(objscr).stop().animate({"left":-j*ovalue+"px"},600,"swing");
		$(click_cirl).eq(j).addClass('acti').siblings().removeClass('acti');
		$(textp).animate({"top":-j*$(textp).parent().height()+"px"});
		}
}

function down_drop(a,b,c){//下拉列表	1.点击获取文本内容  2.点击对像显示下拉  3.下拉这个Div对像
	$(a).click(function(){
				var text=$(this).text();
				$(this).parent().parent().find('input').val(text);
				$(this).parent().hide();
			})
		$(b).click(function(){
				$(this).parent().find(c).show();
			})

		$(a).parent().parent().hover(function(){

			},function(){
					$(this).find(c).hide();
				})
}

function fade(banner,cirl,timer,click_left,click_right){//淡入淡出轮播  1.切换的对像	2.小圆点控制的对像	 3.时间值[必选]  4.左点击  5.右点击
	var i=0;
	var Otimer=null;
	var olen=$(banner).length;
	$(banner).css("opacity","0");
	$(banner).eq(i).css("zIndex","1").animate({"opacity":"1"},600,'swing');
	$(cirl).click(function(){
			$(this).addClass('acti').siblings().removeClass('acti');
			i=$(this).index();
			$(banner).eq(i).css("zIndex","1").animate({"opacity":"1"},600,'swing').siblings().css("zIndex","0").animate({"opacity":"0"},600,'swing');
		})
	Otimer=setInterval(bann_auto,timer);
	function bann_auto(){
			i++;
			if(i>olen-1) i=0;
			$(cirl).eq(i).addClass('acti').siblings().removeClass('acti');
			$(banner).eq(i).css("zIndex","1").animate({"opacity":"1"},600,'swing').siblings().css("zIndex","0").animate({"opacity":"0"},600,'swing');
		}
	$(cirl).hover(function(){
			clearInterval(Otimer);	
		},function(){
			Otimer=setInterval(bann_auto,timer);
			})
	$(click_left).hover(function(){
			clearInterval(Otimer);	
		},function(){
			Otimer=setInterval(bann_auto,timer);
			})
	$(click_right).hover(function(){
			clearInterval(Otimer);	
		},function(){
			Otimer=setInterval(bann_auto,timer);
			})
	$(click_left).click(function(){
			i--;
			if(i<0) i=olen-1;
			$(cirl).eq(i).addClass('acti').siblings().removeClass('acti');
			$(banner).eq(i).css("zIndex","1").animate({"opacity":"1"},600,'swing').siblings().css("zIndex","0").animate({"opacity":"0"},600,'swing');
		})
		
	$(click_right).click(function(){
			bann_auto();
		})
	
}
function czstop(){
    layer.msg('彩种即将开放,敬请期待', {time: 2000, icon:2});
}