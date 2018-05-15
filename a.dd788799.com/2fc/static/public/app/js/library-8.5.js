/*
fade(banner,cirl,timer,click_left,click_right)//淡入淡出轮播  1.切换的对像	2.小圆点控制的对像	 3.时间值[必选]  4.左点击  5.右点击 6.文字部分切换
two_scroll(number,cli_left,cli_right,click_cirl,textp,ovalue,ots){//滚动轮播 1.元素的个数[必选]	2.左点击对象[可选]	3.右点击对象[可选]	4.小圆点对击对象[可选]	5.文字变化[可选]	6.滚动的距离[不用] 7.滚动的个数[不用] 8.最外层高度[可选]
tabs_cg(Oobj,Otabch,event,ClassName,Find,level){//选项卡切换  1.点击的对象  2.切换的的对象  3.事件   4.类名  5.查找下一级   6.如果Find实参存在,缺少值是为 1
Countdown(obj,classname,num)//倒计时  1.点击的对象  2.类  3.数值
newRoll(obj){//新闻垂直滚动
myScroll()//返回顶部
enlarge(click_,cg_obj) //小图换成大图
call_resize(obj){ //调用事件
scroll_addclass(obj_addclass){ //滚动条到一定的时候加上类名
shoutext(Oclick,Ofind){//点击展开
slide_nav(obj,class_name,iname)//slide展开
slideDown(obj,show_obj){ //单击展开
numadd(obj,click_left,click_right){//数量加减
click_addname(obj,className,allt)//给对象添加类  1.点击的对象  2.类名  3.是否清除所有-非零[可选]
down_drop(a,b,c,d,e){//下拉列表	1.点击获取文本内容  2.点击对像显示下拉  3.下拉这个Div对像 4.事件 5.是否是文字标签
replaimg(obj)//HOVER变颜色的图标 1.移上去的对象


showFile(put_obj,show_img,show_name){ //上传显示图片 1. input控件对象 2.显示的img对象 3.显示的名称对象
IsPC(url) { //页面跳转
click_cgimg(obj,index,imgname)//切换图片  1.对象  2.索引值  3.图片名称
slideshow(click_show,obj_open,class_name)//三级菜单展开  1.点击的对象  2.展开的对象  3.添加类名旋转图标
suspension(click_obj,move_obj,distance,className)//悬浮  1.点击的对象  2.移动的对象  3.距离右边的数值 4.类名 5.负值
full_screen(number,click_left,click_right,click_cirl)    //全屏左右滚动轮播 1.数量  2.左点击  2.右点击  3.小圆点点击
autobox(obj,oble,value,pase)//居中 1.对象  2. 0-[左边] 1-[右边]  3.宽度  4.偏移量
Cutimg(obj)//裁图后 垂直水平居中  1.图片对象
eject(hover_obj,hide_obj)//弹出菜单  1.移上去的对象  2.隐藏的对象
scrollTop(obj_fixed,ClassName,value)//当元素滚动到一定时就固定定位  1.定位的对象  2.加入一个类  3.默认值不可更改
cli_cgimg(obj)//点击图标状态切换  1.点击的对象
checkbox(obj,findbel){//复选框下的显示
cli_cgpic(obj)//按下图标切换
addInput(obj){//复选框选择
getFileUrl(sourceId)//获取File上传图片
copy(click_obj)//复制命令
alertbox(click_show,click_hide,obj){//弹窗-显示和隐藏
upimg(obj,append) //加载结构
CountDownTime(element,divtype)//目标活动倒计时
dropmove(down,move,direction,obj_hei)//拖动进度条
auto_subMenu(obj,find_obj)//子菜单自适应大小
radio_pic(obj)//单选
zoom()//整体缩小
input_bd(obj_input,classN){//焦点加类
roll_picture(oLi)	//图片列表向左滚动
levelwith(obj_fr,obj_fl)//左右等高
hover_down_menu(oli_obj,showDiv)//下拉菜单效果
typing(textp)	//打字效果
paint_cirl(obj_default_class,obj_change_class,start_color,end_color,main_class)//画圆
table(left_obj,right_obj){//表格js
three_menu(obj_li,one,two,three){ //三级菜单下拉
bann3d(li_list,click_left,click_right){ //3D多图滚动 1. li列表 2.左点击 3.右点击
min_auto(obj,wid) { //手机自动宽
operation(main_div,event_name){ //手机滑屏事件
*/

$("button.halo").click(function(event) { //光晕效果
	var x=event.pageX-$(this).offset().left;
	var y=event.pageY-$(this).offset().top;
	$(this).append('<div class="effect" style="left:'+x+'px;top:'+y+'px;-webkit-animation:buthalo 1s;"></div>')
});

function paint_cirl(obj_default_class,obj_change_class,start_color,end_color,main_class){	//画圆
	var ite=0;
	var te=setInterval(function(){
			ite++;
			if(ite>=112 ||  ite>=111/$(main_class+" .sp1").text()*$(main_class+" .sp0").text()){clearInterval(te);}
		draw23(obj_change_class,ite,end_color)
		},10)
	draw23(obj_default_class,111,start_color);
	function draw23(id,ss,color) {
	 var canvas = document.getElementById(id);
	if (canvas == null) {
	 return false;
	 }
	var ctx = canvas.getContext("2d");
	ctx.lineWidth=20;
	ctx.strokeStyle=color
	ctx.beginPath();
	ctx.arc($("#"+id).width()/2,$("#"+id).width()/2,($("#"+id).width()-40)/4,0,ss/20);
	ctx.stroke();
	}
}

function typing(textp){	//打字效果
	var num=0;
	$(textp).each(function(index, element) {
		var text=$(this).text();
		$(this).attr("data",text).text("");
		otime=$(textp).eq(index).attr("data").length*58; // 58 是速度值
		num=num+otime;//累加值
    	setTimeout(function(){
			abc($(textp).eq(index));
			},num-otime+1050);
    });
	function abc(obj){
		var strText=$(obj).attr("data");
		var i=0;
		var text="";
		var time=setInterval(function(){
				text=text+strText.substr(i,1)
				i++
				$(obj).html(text)
				if(i>=strText.length){
						clearInterval(time);
					}
			},58)
	}
}

function hover_down_menu(oli_obj,showDiv){	//下拉菜单效果
	 $(oli_obj).hover(function(){
			var ind=null;
			var j=10;
			var olen=$(this).find(showDiv).show().find("a").length;
			var ind=$(this).index();
			for(var i=0;i<olen;i++){
			setTimeout(function(){
				$(oli_obj).eq(ind).find(showDiv+" a").eq(j-10).css({"transform":"translate(0,0px) rotate(0deg)","opacity":"1"});
				j=j+1;
				},50*i+50)
			}
		},function(){
				Flip(this);
			})
	$(oli_obj).each(function(index, element) {
       Flip(this);
    });
	function Flip(e){
			var ind=null;
			var j=10;
			var olen=$(e).find(showDiv).find("a").length;
			var ind=$(e).index();
			for(var i=0;i<olen;i++){
			setTimeout(function(){
				$(oli_obj).eq(ind).find(showDiv+" a").eq(j-10).css({"transform":"translate(0,-"+j+"px)  rotate("+-(80+j+5+j*5)+"deg)","opacity":"1"});
				j=j+1;
				},50*i+50)
				if(i==olen-1){
					setTimeout(function(){
						$(e).find(showDiv).hide();
						},50*i+140)
				}
			}
		}
	}

function levelwith(obj_fr,obj_fl){ //左右等高
		var var_hei=$(obj_fr).height()+parseInt($(obj_fr).css("padding-bottom"));
		$(obj_fl).height(var_hei);
	}

function roll_picture(oLi){ //图片列表向左滚动
	$(oLi).parent().parent().css({"position":"relative"})
	var oLi_len=$(oLi).length; //个数
	var oLi_wid=$(oLi).width(); //宽度
	var oLi_marl=parseInt($(oLi).eq(1).css("marginLeft"));//第2个左边距
	$(oLi).parent().css({"position":"absolute","left":"0","width":oLi_len*(oLi_wid+oLi_marl)+"px"});
	var timer=setInterval(OnLeft,10);
	var te=0;//移到的距离
	var num=0;//个数
	function OnLeft(){
			if(te==oLi_wid+oLi_marl+1){
				var oHtml=$(oLi).eq(num).html();
				$(oLi).parent().append('<li>'+oHtml+'</li>');
				$(oLi).eq(num).remove();
				//clearInterval(timer);
				te=-1;
				$(oLi).parent().css({"left":te+"px"});
				}
			te++;
			$(oLi).parent().css({"left":-te+"px"});
		}
}

function input_bd(obj_input,classN){//焦点加类
	$(obj_input).focus(function(){
		$(this).addClass(classN);
	})
	$(obj_input).blur(function(){
			$(this).removeClass(classN);
		})
	}

function zoom(){//整体缩小
	$(window).resize(function(){
			abtee();
		})
	abtee()
	function abtee(){
	var wid=$(window).width();
	if(wid<1366){
			$("html").css("zoom","0.8");
		}else{
				$("html").removeAttr("style");
			}
	}
}
function radio_pic(obj){//单选
	$(obj).click(function(){
		$(this).parent().find("i").removeClass("acti");
		$(this).find("i").addClass("acti");
	})
}

function  auto_subMenu(obj,find_obj){//子菜单自适应大小
	$(obj).each(function(index, element) {
		var sum=0;
		var otvel=0;
		var wit=parseInt($(this).find("a").css("paddingLeft"))*2;
		$(this).find("a").each(function(index, element) {
			var suw=$(this).width()
			sum=sum+suw
			otvel=index+1
		});
		$(this).width(sum+otvel*wit);
	});
}

function dropmove(down,move,direction,obj_hei){ //拖动进度条
	$(move).mouseup(function(e){
			 if(direction==1){
				var X=e.pageX-$(this).offset().left;
				$(this).find(".box").width(X);
				}else{
						var Y=e.pageY-$(this).offset().top;
						$(this).find(".box").height(obj_hei-Y);
					}
		})
	$(down).mousedown(function(){

		$(move).mousemove(function(e){
				var t=$(this).offset().top;
				var lf=$(this).offset().left;
				 if(direction==1){
						 //console.log("横向");
						 if(e.pageX-lf<=$(move).width() && e.pageX-lf>0){
							$(this).find(".box").css("width",e.pageX-lf+"px");
						 }
				 }else{
					  //console.log("纵向");
						if(e.pageY-t<=$(move).height() && e.pageY-t>0){
						$(this).find(".box").css("height",obj_hei-(e.pageY-t)+"px");
					}
				$(move).unbind("hover");
				}
			})
	})
	$(move).mouseup(function(){
			$(move).unbind("mousemove");
		})
		$(down).mouseup(function(){
			$(move).unbind("mousemove");
		})
	$(move).hover(function(){

		},function(){
				$(move).unbind("mousemove");
			})

}

function enlarge(click_obj,cg_obj){ //小图换成大图
	$(click_obj).click(function(){
			var src=$(this).find("img").attr("src");
			$(cg_obj).attr("src",src);
		});
	}

function CountDownTime(element,divtype){	//目标活动倒计时
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
			if(day1<10) day1="0"+day1;
			if(hour<10) hour="0"+hour;
			if(minute<10) minute="0"+minute;
			if(second<10) second="0"+second;
			//var countDown = "倒计时 : "+day1+"天"+hour+"小时"+minute+"分"+second+"秒"
			//console.log(countDown);

			$(divtype+".t span.sp1").text(day1.substring(0, 1));
			$(divtype+".t span.sp2").text(day1.substring(2, 1));

			$(divtype+".s span.sp1").text(hour.substring(0, 1));
			$(divtype+".s span.sp2").text(hour.substring(2, 1));

			$(divtype+".f span.sp1").text(minute.substring(0, 1));
			$(divtype+".f span.sp2").text(minute.substring(2, 1));

			$(divtype+".m span.sp1").text(second.substring(0, 1));
			$(divtype+".m span.sp2").text(second.substring(2, 1));
		}
		else{
				clearInterval(tid);
				$(divtype+" span").text('0');
			}

	}

}

function slide_nav(obj,class_name,iname){//slide展开
	$(obj).click(function(){
		if($(this).attr('opent')==="1"){
			$(this).parents('li').find(class_name).slideUp();
			$(this).find('i').removeClass(iname);
			$(this).attr('opent',"0");

		}else{
			$(obj).find("i").removeClass(iname);
			$(obj).parent().find(class_name).slideUp();
			$(this).parents('li').find(class_name).slideDown();
			$(this).find('i').addClass(iname);
			$(obj).attr('opent',"0");
			$(this).attr('opent',"1");
			}
	});
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
	$(click_left).click(function(){
			i=parseInt($(obj).val());
			if(i>1){
					i--;
					$(this).parent().find("input").val(i);
				}
			if(i==1){
					$(this).addClass("noadd");
				}

		})
	$(click_right).click(function(){
			i=parseInt($(obj).val());
			i++;
			$(click_left).removeClass("noadd");
			$(this).parent().find("input").val(i);
		})
}

function upimg(obj,append){//图片上传后显示
	$(obj).change(function(){
			$(append).append('<li><div class="pict"><i><img src="'+getFileUrl("upp")+'" alt=""></i></div></li>');
		})
	}

function alertbox(click_show,click_hide,obj){//弹窗-显示和隐藏
	$(click_hide).click(function(){
			$(obj).fadeOut();
		})
	$(click_show).click(function(){
			$(obj).fadeIn();
		})
}

function copy(click_obj){//复制命令
$(click_obj).click(function(){
		$(this).parents("li").find("textarea").select();
		document.execCommand("Copy");
	})
}

function newRoll(obj){	//新闻垂直滚动
		$(obj).css({"position":"absolute"});
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

function myScroll() { //返回顶部
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

function getFileName(o){  //获取文件名
    var pos=o.lastIndexOf("\\");
    return o.substring(pos+1);
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
}

function checkbox(obj,findbel){//复选框下的显示
		$(obj).click(function(){
			if($(this).find("input[type='checkbox']").is(':checked')==true){
					$(this).find(findbel).show();
				}else{
						$(this).find(findbel).hide();
					}
		})	;
		}

function cli_cgpic(obj){//两色图标切换
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

function Countdown(obj,classname,num){//倒计时  1.点击的对象  2.类  3.数值
	$(obj).attr("value","1");
	var jte=num;
	var timer=null;
	function miuete(){
			jte--;
			if(jte<=0) {
			$(obj).removeClass(classname).text('获取验证码');
				jte=num;
				clearInterval(timer);
				$(obj).attr("value","1");
			}
			$(obj+'.'+classname).text(jte+'s');
		}
	$(obj).click(function(){
		if($(this).attr("value")=="1"){
			$(this).attr("value","0");
				$(this).addClass(classname);
				miuete();
				timer=setInterval(miuete,1000);
		}

	})
}


function cli_cgimg(obj){//点击图标状态切换  1.点击的对象
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

function suspension(click_obj,move_obj,distance,className,negative){//悬浮  1.点击的对象  2.移动的对象  3.距离右边的数值 4.类名 5.负值
	$(click_obj).click(function(){

		if($(this).attr('opene')=='1'){
				$(move_obj).animate({'right':-$(move_obj).width()-negative+"px"},600,'swing');
				$(this).attr('opene','0');
				$(this).removeClass(className);
			}else{
					$(this).addClass(className);
					$(move_obj).animate({'right':distance+"px"},600,'swing');
					$(this).attr('opene','1');
				}
	})
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

function scrollTop(obj_fixed,ClassName,value,ohei_value){//当元素滚动到一定时就固定定位  1.定位的对象  2.加入一个类  3.默认值不可更改
	value=$(obj_fixed).offset().top;
	$(window).scroll(function(){
			var valt=$(window).scrollTop();
			var top=$(obj_fixed).offset().top;
			if(value==1){
					value=top;
				}
			if(valt>value+ohei_value){
				$(obj_fixed).addClass(ClassName);
				}else{
				$(obj_fixed).removeClass(ClassName);
				}
		})
	}

function tabs_cg(Oobj,Otabch,event,ClassName,Find,level){//选项卡切换  1.点击的对象  2.切换的的对象  3.事件   4.类名  5.查找下一级   6.如果Find实参存在,缺少值是为 1  
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
					$(this).addClass(ClassName).siblings().removeClass(ClassName);
					$(Otabch).hide()
					$(Otabch).eq($(this).index()).show();
				})
			}

}

function two_scroll(number,cli_left,cli_right,click_cirl,textp,ovalue,ots,ohei){//滚动轮播 1.元素的个数	2.左点击对象	3.右点击对象	4.小圆点对击对象[可选项] 5.文字变化 6.滚动的距离[必选项] 7.滚动的个数[必选项] 8.最外层高度
	var olit=$(number).length;
	$(click_cirl).each(function(index, el) {
		$(this).attr("Index",index);
	});
	ots=parseInt($(number).parent().parent().width()/$(number).width());
	ovalue=parseInt($(number).width())+parseInt($(number).css("margin-left"));
	if(ohei){
		$(number).parent().css({"width":ovalue*olit+"px","position":"absolute"}).parent().css({"position":"relative","overflow":"hidden","height":ohei});/*计算宽度*/

	}else{
		$(number).parent().css({"width":ovalue*olit+"px","position":"absolute"}).parent().css({"position":"relative","overflow":"hidden","height":$(number).height()});/*计算宽度*/
	}
	var objscr=$(number).parent()//滚动的对像
	var j=0;//统计
	var setotimer=null;//时间变量
	setotimer=setInterval(orcroauto,3000);
	$(number+','+cli_left+','+cli_right+','+click_cirl).hover(function() {
		clearInterval(setotimer);
	}, function() {
		setotimer=setInterval(orcroauto,3000);
	});
    $(cli_left).click(function(){
			j--;
			if(j<0) j=olit-1;
			var typeobj=$(number).last().html();
			$(click_cirl).eq(j).addClass('acti').siblings().removeClass('acti');
			$(objscr).prepend('<li style="width:'+$(number).width()+'px;">'+typeobj+'</li>');
			$(objscr).css({"left":-ovalue+"px"});
			$(objscr).stop().animate({"left":0},600,"swing",function(){
				$(number).last().remove();
			});
			$(textp).animate({"top":-j*$(textp).parent().height()+"px"});
		})
	$(cli_right).click(function(){
			orcroauto();
	})
	$(click_cirl).click(function(){
			j=$(this).attr("Index");
			$(objscr).stop().animate({"left":-$(number).width()*j+"px"},600);
			$(click_cirl).eq(j).addClass('acti').siblings().removeClass('acti');
			$(textp).animate({"top":-j*$(textp).parent().height()+"px"});

		})
	function orcroauto(){
		j++;
		if(j>olit-1) j=0;
		var typeobj=$(number).first().html();
		$(objscr).append('<li style="width: '+$(number).width()+'px;">'+typeobj+'</li>');
		$(objscr).stop().animate({"left":-ovalue+"px"},600,"swing",function(){
			$(number).first().remove();
			$(objscr).css({"left":"0"});
		});
		$(click_cirl).eq(j).addClass('acti').siblings().removeClass('acti');
		$(textp).animate({"top":-j*$(textp).parent().height()+"px"});
		}
}

function down_drop(a,b,c,d,e){//下拉列表	1.点击获取文本内容  2.点击对像显示下拉  3.下拉这个Div对像 4.事件 5.是否是文字标签
	$(a).click(function(){
				var text=$(this).text();
				if(e==1) {
					$(this).parent().parent().find('i').text(text);
				}else{
					$(this).parent().parent().find('input').val(text);
				}
				$(this).parent().hide();
			})
		$(b)[d](function(){
				$(this).parent().find(c).show();
			})

		$(a).parent().parent().hover(function(){

			},function(){
					$(this).find(c).hide();
				})
}


function fade(banner,cirl,timer,click_left,click_right,cg_text){//淡入淡出轮播  1.切换的对像	2.小圆点控制的对像	 3.时间值[必选]  4.左点击  5.右点击 6.文字部分切换
	var i=0;
	var Otimer=null;
	var olen=$(banner).length;
	$(banner).css("opacity","0");
	$(banner).eq(i).css("zIndex","1").animate({"opacity":"1"},600,'swing');
	$(cirl).click(function(){
			$(this).addClass('acti').siblings().removeClass('acti');
			i=$(this).index();
			$(cg_text).eq(i).addClass("acti").siblings().removeClass("acti");
			$(banner).eq(i).addClass('acti').siblings().removeClass('acti');
			$(banner).eq(i).css("zIndex","1").animate({"opacity":"1"},600,'swing').siblings().css("zIndex","0").animate({"opacity":"0"},600,'swing');
		})
	Otimer=setInterval(bann_auto,timer);
	function bann_auto(){
			i++;
			if(i>olen-1) i=0;
			$(cg_text).eq(i).addClass("acti").siblings().removeClass("acti");
			$(banner).eq(i).addClass('acti').siblings().removeClass('acti');
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
			$(banner).eq(i).addClass('acti').siblings().removeClass('acti');
			$(cg_text).eq(i).addClass("acti").siblings().removeClass("acti");
			$(banner).eq(i).css("zIndex","1").animate({"opacity":"1"},600,'swing').siblings().css("zIndex","0").animate({"opacity":"0"},600,'swing');
		})

	$(click_right).click(function(){
			bann_auto();
		})

}

function slideDown(obj,show_obj){ //单击展开
	$(obj).click(function(event) {
		if($(this).attr("eee")=="1"){
			$(this).attr("eee","0")
			$(this).removeClass('sp1').find('i').removeClass('acti');
			$(this).parent().parent().find(show_obj).slideUp();
		}else{
			$(this).attr("eee","1")
			$(this).addClass('sp1').find('i').addClass('acti');
			$(this).parent().parent().find(show_obj).slideDown();

		}

	});
}

function scroll_addclass(obj_addclass){ //滚动条到一定的时候加上类名
	$(window).scroll(function(event) {
		var vlte=$(window).scrollTop();
		if(vlte>500){
			$(obj_addclass).css({"background":"#fff"});
		}
		else{
			$(obj_addclass).css({"background":"none"});
		}
	});
}

function call_resize(obj){ //调用事件
	eval(obj);
    $(window).resize(function(event) {
	    eval(obj);
    });
}

function min_auto(obj,wid) { //手机自动宽
		var scr_wid=$(window).width();
		if(scr_wid<=wid){
			$(obj).width(scr_wid);
		}else{
			$(obj).removeAttr('style');
		}
	}
function table(left_obj,right_obj){ //表格js
	var Objwid=$(right_obj).width();
	$(left_obj).removeAttr('style');
	$(right_obj).removeAttr('style');
	$(left_obj).each(function(index, el) {
		var leftHei=$(this).height();
		var rightHeight=$(right_obj).eq(index).height();
		if(leftHei>rightHeight){
			$(right_obj).eq(index).height(leftHei);
			$(right_obj).eq(index).find('p').height(leftHei);
		}else{
			$(this).height(rightHeight);
			$(this).find('p').height(rightHeight);
		}
	});
	$(right_obj).find('p').width(Objwid);
}

function three_menu(obj_li,one,two,three){ //三级菜单下拉
	$(obj_li).hover(function() {
		$(this).stop().find(one).slideDown(200);
	}, function() {
		$(this).stop().find(one).slideUp(200);
	});
	console.log(obj_li+" "+one+" "+two);
	$(obj_li+" "+one+" "+two).hover(function() {
		$(this).stop().find(three).slideDown(200);
	}, function() {
		$(this).stop().find(three).slideUp(200);
	});
}

function IsPC(url) { //页面跳转
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone","SymbianOS", "Windows Phone","iPad", "iPod"];
    var flag = false;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = true;
            break;
        }
    }
	if (flag){
			console.info("Current phone mode");
			//window.location.href=url;
		}else{
			console.info("Current computer model");
			}
}

function showFile(put_obj,show_img,show_name){ //上传显示图片 1. input控件对象 2.显示的img对象 3.显示的名称对象
	$(put_obj).change(function(event) {
		var e=getFileUrl("main-pic");
		$(show_img).attr("src",e);
		$(show_name).val(getFileName($(this).val()));
	});
}
function bann3d(li_list,click_left,click_right){
	var timer=null;
	var li_size=$(li_list).size();
	timer=setInterval(next,3000);
	console.info();
	$(li_list).parent().parent().hover(function() {
		clearInterval(timer);
	}, function() {
		timer=setInterval(next,3000);
	});
	$(li_list).each(function(index, el) {
		$(this).attr("index",index);
	});
	$(li_list).hover(function() {
		var inde=$(this).attr("index");
		if(inde<li_size/2){
			//console.log('左');
			$(this).parent().parent().addClass('onLeft');
		}else{
			//console.log('右');
			$(this).parent().parent().removeClass('onLeft');
		}
	});
	$(click_right).click(function(event) {
		next();
	});
	function next(){
		var mycars=new Array(li_size);
		var mycars1=new Array(li_size);
		$(li_list).each(function(index, el) {
			var class1=$(this).attr("class");
			var index1=$(this).attr("index");
			mycars[index]=class1;
			mycars1[index]=index1;
			if(index!=0){
				$(li_list).eq(index-1).attr("class",class1);
				$(li_list).eq(index-1).attr("index",index1);
			}
		});
		$(li_list+":last").attr('class',mycars[0]);
		$(li_list+":last").attr('index',mycars1[0]);
	}
	function prev(){
		var mycars=new Array(li_size);
		var mycars1=new Array(li_size);
		$(li_list).each(function(index, el) {
			var class1=$(this).attr("class");
			var index1=$(this).attr("index");
			mycars[index]=class1;
			mycars1[index]=index1;
			if(index==0){
				$(li_list+":first").attr('class',$(li_list+":last").attr("class"));
				$(li_list+":first").attr('index',$(li_list+":last").attr("index"));
			}else{
				$(li_list).eq(index).attr("class",mycars[index-1]);
				$(li_list).eq(index).attr("index",mycars1[index-1]);
			}
		});
	}
	$(click_left).click(function(event) {
		prev();
	});
	$(li_list).click(function(event) {
		var inde=$(this).attr("index");
		if(inde>3){
			for(var i=0;i<li_size-inde;i++){
				next();
			}
		}else{
			for(var i=0;i<li_size-inde;i++){
				next();
			}
		}
	});
}

function operation(main_div,event_name){ //手机滑屏事件
	var start_pointX=0;
	var end_pointX=0;
	var start_pointY=0;
	var end_pointY=0;
	var pagejishu=0;
	this.calculation=function(){
		this.start_point=start_pointX;
		this.end_point=end_pointX;
		this.num_Index=pagejishu;
	}
	$(main_div).on('touchstart', function(event) {
		event.stopPropagation();
		var _touch=event.originalEvent.targetTouches[0];
		start_pointX=_touch.pageX;
		start_pointY=_touch.pageY;
		// console.log("L起点："+start_pointX);
		// console.log("T起点："+start_pointY);
	});
	$(main_div).on('touchmove', function(event) {
		event.preventDefault();
	});
	$(main_div).on('touchend', function(event) {
		event.stopPropagation();
		var _touch=event.originalEvent.changedTouches[0];
		end_pointX=_touch.pageX;
		end_pointY=_touch.pageY;
		// console.log("T终点："+end_pointX);
		// console.log("L终点："+end_pointY);
		if(event_name.direction){
			isLeft();
		}else{
			isTop();
		}
		_Event.calculation();
	});
	function isLeft(){
		//console.log("左右移动的数值是："+(end_pointX - start_pointX));
		if(end_pointX-start_pointX>100){
			console.info('向右');
			eval(event_name.prevBut+'()');
			pagejishu++;
		}else if(end_pointX-start_pointX<-100){
			console.info('向左');
			eval(event_name.nextBut+'()');
			pagejishu--;
		}
	}//isLeft()
	function isTop(){
		//console.log("上下移动的数值是："+(end_pointY - start_pointY));
		if(end_pointY-start_pointY>100){
			console.info('向下');
			pagejishu++;
		}else if(end_pointY-start_pointY<-100){
			console.info('向上');
			pagejishu--;
		}
	} //isTop()
}