
$(function(){
	//回到顶部
	try{
		gotop('pro-view-0');
	}catch(e)
	{
		
	}
	
	//加入购物车	
    $("#addToCart,#quickBuy,.w-button-addToCart").click(function(event) {
		var self = this;
		if(self.id=='addToCart'){
			var offset = $("#moreBtn").offset(); 
			var offset2 = $("#addToCart").offset(); 
			var imgs = document.getElementsByTagName("img");
			var img = $(imgs[0]).attr('src'); //获取当前点击图片链接 
			var flyer = $('<img class="flyer-img" id="fly" src="' + img + '">'); //抛物体对象 
			flyer.fly({ 
				start: { 
					left: event.screenX-50,//抛物体起点横坐标 
					top: event.screenY-100, //抛物体起点纵坐标 
				}, 
				end: { 
					left: offset.left,//抛物体终点横坐标 
					top: 0, //抛物体终点纵坐标 
				}, 
				onEnd: function() { 				
					this.destory(); //销毁抛物体 
				} 
			});		
		}
		
		if(self.id==''){
			var offset = $("#pro-view-1").offset(); 
			var offset2 = $(self).offset(); 
			var imgs = document.getElementsByTagName("img");
			var img = $(imgs[0]).attr('src'); //获取当前点击图片链接 
			var flyer = $('<img class="flyer-img" id="fly" src="' + img + '">'); //抛物体对象 
			flyer.fly({ 
				start: { 
					left: event.screenX-50,//抛物体起点横坐标 
					top: event.screenY-50, //抛物体起点纵坐标 
				}, 
				end: { 
					left: 0,//抛物体终点横坐标 
					top: 400, //抛物体终点纵坐标 
				}, 
				onEnd: function() { 				
					this.destory(); //销毁抛物体 
				} 
			});		
		}
		
		var url = $(this).attr('action');
		var data=[];
		if(self.id=='') window.type= $(self).attr('data-id');
		$.post(url,{goodid:window.type},function(re){
			var status = re.status;
			if(status==1)
			{
				if(re.info.indexOf('已经在购物车中')==-1){
					if(self.id!=''){
						$('.ico-dot').css({display:'block'});
						var vcount = document.getElementById('w-miniCart-count');
						vcount.innerText = parseInt(vcount.innerText) + 1;
						vcount.style.display = 'block';
					}
					else{
						
						var vcount = document.getElementById('w-miniCart-count');
						vcount.innerText = parseInt(vcount.innerText) + 1;
						vcount.style.display = 'block';
					}
				}
				if(self.id=='quickBuy'){
					window.location.href = re.url;
				}
			}
			else
			{
				//alert('加入购物车失败');
			}
		});	
    });
	
	//购物车内商品删除
	$("a[data-pro='del']").click(function(event){
		var self = this;
		var url = $(this).attr('action');
		var data=[];
		var id = $(this).attr('data-id');
		$.post(url,{goodid:id},function(re){
			var status = re.status;
			if(status==1)
			{
				$(self.parentNode.parentNode).remove();
				var $item = $('.item');
				if($item.length==0)
					$('#pro-view-null').css({display:'block'});
			}
			else
			{
				showDialog('删除失败');
			}
		});
		return false;
	});
	
	//查看购买号码
	$("a[data-pro='mycode']").live('click',function(){
		var data = $(this).attr('data-data');
		wait();
		$.get($(this).attr('url'),function(html){
			destroyWait();
			$(html).dialog({
				title:'投注详情',
				width:250,
				height:400,
				modal:true,
				resizable: false,
			});
		});
		//showDialog('<textarea class="c-textarea">' + data + '</textarea>');
	});
	
	//撤单
	$("#cancelproject").live('click',function () {
		var v_id=$(this).attr('data-id');
		if (true) {
			$.ajax({
				type: "POST",
				 url: "/launch.php?s=/game/deleteCode",
				data: { id: v_id },
				dataType: "json",
				global: false,
				success: function (data) {
					try {
						if (data.code == 0) {
							$('a[role=button]').click();//关闭dialog
							winjinAlert(data.msg,'error');
						} else {
							$('a[role=button]').click();//关闭dialog
							winjinAlert('撤单成功','ok');
						}
					} catch (e) {
						$('a[role=button]').click();//关闭dialog
						winjinAlert('撤单失败，请梢后重试','error');
					}
				},
				error: null,
				cache: false
			})
		}
	});

    //万金提示
    function winjinAlert(tips,style,minH){

        $( "#wanjinDialog" ).html('<span class="ui-wjicon-'+style+'"></span><b>'+tips+'</b>').dialog({
            title:'温馨提示',
            modal: true,
            resizable: false,
            width:250,
            minHeight:(minH?minH:180),
            buttons: {
                "确定": function() {$( this ).dialog( "close" );}
            }
        });	//dialog end
    }


	
	$("input[data-pro='search']").click(function(event){
		var url = $(this).attr('data-action');
		var childs = $('.winmain').find('input');
		var childs2 = $('.winmain').find('select');
		
		var i=0;
		var data=[];
		for(i=0;i<childs.length;i++)
		{
			data.push({name:childs[i].name,value:childs[i].value});
		}
		for(i=0;i<childs2.length;i++)
		{
			data.push({name:childs2[i].name,value:childs2[i].value});
		}
		
		$('#queryMask').css('display', 'none');
		wait();
		$.get(url,data,function(re){
			destroyWait();
			$('#record-span').html(re);		
		},'html');
		return false;
	});
	
	$("input[data-pro='add']").click(function(event){
		var url = $(this).attr('data-action');
		var childs = $('.winmain').find('input');
		var childs2 = $('.winmain').find('select');
		
		var i=0;
		var data=[];
		for(i=0;i<childs.length;i++)
		{
			data.push({name:childs[i].name,value:childs[i].value});
		}
		for(i=0;i<childs2.length;i++)
		{
			data.push({name:childs2[i].name,value:childs2[i].value});
		}
		
		$('#queryMask').css('display', 'none');
		wait();
		$.post(url,data,function(re){
			destroyWait();
			if(re.code){
				if(re.url) {
                    showDialog(re.msg);
                    var t1 = window.setTimeout(function(){ window.location.href=re.url;},re.wait);
                    window.clearTimeout(t1) ;//去掉定时器
				}
			}
			else{
				showDialog(re.msg);
			}
		},'json');
		return false;
	});
	
	//解决分页问题
	$('.page a').live('click', function(){
		if(this.tagName == 'A'){
			var parent = this.parentNode.parentNode;
			var value = $(parent).attr('target');
			if(value=='_blank')	
				return true;
			var url = $(this).attr('href');
			wait();
			$('#record-span').load(url,function(){
				destroyWait();
			});
			return false;
		}
	});
});

/** 
 * 获取滚动条距离顶端的距离 
 * @return {}支持IE6 
 */  
function getScrollTop() {  
        var scrollPos;  
        if (window.pageYOffset) {  
        scrollPos = window.pageYOffset; }  
        else if (document.compatMode && document.compatMode != 'BackCompat')  
        { scrollPos = document.documentElement.scrollTop; }  
        else if (document.body) { scrollPos = document.body.scrollTop; }   
        return scrollPos;   
} 
function gotop(goTopId) {
	var toTopEle = document.getElementById(goTopId);
	if(!toTopEle) return;
	window.addEventListener('scroll', function() {
		var top = getScrollTop();
		if (top > 50) {
			toTopEle.style.display = 'block';
		} else {
			toTopEle.style.display = 'none';
		}
	});
	toTopEle.addEventListener('click', function() {
		window.scrollTo(0, 0);
	}, false);
}

function scrollUpdate(url,type,currentNo,container)
{
	var $container = $(container);
	$(window).scroll(function(){
		if($("div[data-pro=disable]")[0].style.display=="block") return;
		if($("div[data-pro=loading]")[0].style.display=="block") return;
		if($(document).scrollTop() > $(document).height()-$(window).height()-$('#pro-view-15').height()){
			var lastid = window.lid;
			$("div[data-pro=link]")[0].style.display="none";
			$("div[data-pro=loading]")[0].style.display="block";
			
			$.get(url,{type:type,last_id:lastid,currentNo:currentNo},function(data){
				if(data)
				{
					$("div[data-pro=link]")[0].style.display="block";
					$("div[data-pro=loading]")[0].style.display="none";
					$(data).appendTo($container);
				}
				else
				{
					$("div[data-pro=disable]")[0].style.display="block";
					$("div[data-pro=loading]")[0].style.display="none";
				}
			
			});
		}
	});
}


function showDialog2(content)
{
	var self=this,
	$self=$(self),
	title=$self.attr('title')||'',
	width=$self.attr('width')||'90%',
	heigth=$self.attr('heigth')||'400px',
	method=$self.attr('method')||'get';
	
	var html =	'<div id="dialog-background" class="pro-mask"></div>' + '<div style="margin-left: 14px; top: 23.5px;" id="dialog-content" class="w-msgbox m-login-msg"><div class="w-msgbox-bd"><h3 class="w-msgbox-title"></h3>' + content + '</div><div data-pro="footer" class="w-msgbox-ft w-msgbox-ft-1"><button  onclick="destoryDialog()" id="pro-view-38" class="pro-btn" type="button"><span>确定</span></button></div></div>';
	
	$(html).appendTo($('body'));
}
function showDialog(content)
{
	var self=this,
	$self=$(self),
	title=$self.attr('title')||'',
	width=$self.attr('width')||'90%',
	heigth=$self.attr('heigth')||'400px',
	method=$self.attr('method')||'get';
	
	var html =	'<div id="dialog-background" class="pro-mask"></div>' + '<div style="margin-left: 14px; top: 23.5px;" id="dialog-content" class="w-msgbox m-login-msg"><div class="w-msgbox-bd"><h3 class="w-msgbox-title"></h3>' + content + '</div><div data-pro="footer" class="w-msgbox-ft w-msgbox-ft-1"><button  onclick="destoryDialog()" id="pro-view-38" class="pro-btn" type="button"><span>确定</span></button></div></div>';
	
	$(html).appendTo($('body'));
	// $(html).dialog({
		// title:false,
		// width:width,
		// height:heigth,
		// modal:true,
		// resizable:false
	// });
}
function destoryDialog()
{
	document.getElementById('dialog-background').remove();
	document.getElementById('dialog-content').remove();
}


function postdata(self)
{
    var username = $("#username").val();
    var password = $("#password").val();
    var url = $(self).attr('data-action');
	//var parent = document.getElementById('pro-view-4');
	var childs = $('.m-login').find('input');

	var i=0;
	var data=[];
	for(i=0;i<childs.length;i++)
	{
		data.push({name:childs[i].name,value:childs[i].value});
	}

	$.post(url,data,function(res){
		if(res.code==1)
		{
			alert(res.msg)
            ZCMlogin(username,password);
		}else{
			$("#captcha").trigger('click')
			showDialog(res.msg);
		}
	},'json');
	return false;
}
function ZCMlogin(zcusername,zcpassword) {
    var url      = $('#login_url').val() ;
    var data = {username: zcusername,password: zcpassword,auth:1,code:0};
    $.post(url,data,function(json){
        if(json.code==1){
            location.href = json.url;
        }else{
            alert(json.msg);
        }
    },'json');
}

function postCart(self){
	
	var msg = "确定提交后将无法撤单，请确认？"; 
	if (confirm(msg)==true)
	{ 
	
	}
	else
	{ 
		return false; 
	}

	var url = $(self).attr('url');
	
	var checks = $("a[data-pro='del']");
	var goodcounts = $('.w-number-input');
	var i=0;
	var data=[];
	for(i=0;i<checks.length;i++)
	{
		data.push({goodid:$(checks[i]).attr('data-id'),goodcount:goodcounts[i].value})		
	}
	
	$.post(url,{codes:data},function(re){
		var status = re.status;
		if(status==1)
		{
			showDialog(re.info);
			
			setTimeout(function(){
				if(re.url)
					window.location.href=re.url;
			},1500);
			
		}
		else
		{
			showDialog(re.info);
		}
	},'json');
	return false;
}
function minCount(self){
	var child = self.parentNode.children[0];
	var type = $(child).attr('data-type');
	if(child.value>type)
	{
		child.value = parseInt(child.value) - parseInt(type);
	}
	else return;
	var value = $('.txt-red').text();
	$('.txt-red').text((parseInt($('.txt-red').text()) -parseInt(type)) + '夺宝币'); 
}

function maxCount(self){
	var child = self.parentNode.children[0];
	var type = $(child).attr('data-type');
	child.value = parseInt(child.value) + parseInt(type);
	var value = $('.txt-red').text();
	$('.txt-red').text((parseInt($('.txt-red').text()) + parseInt(type)) + '夺宝币'); 
}


function wait(){
	var html = '<img src="' + '/images/game/wait.gif" />';
	
	$(html).modal({
		modal:true,
		escClose:false,
		overlayCss:{
			background:'#000'
		},
		dataCss:{
			padding:'0px',
			margin:'0px'
		}
	});
}

function destroyWait(){
	$.modal.close();
}

/* **************  */

