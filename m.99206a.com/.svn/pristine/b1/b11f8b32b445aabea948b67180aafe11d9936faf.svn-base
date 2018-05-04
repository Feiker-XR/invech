$(document).ready(function($) {
	var hb=$('body').height();
	$('#J_UserIFrame',parent.document).height(hb);
	var wb=$(parent.window).width();
	if(wb<720){
		$('.panel').width(wb-14);
	}	
	
	/*$("#xjssc_consider").click(function(){
		order_btn()
	})	*/
});

//子页面传递高度给顶层iframe  
function changeFrameHeight(){
    bodyClientH = document.body.clientHeight;
    bodyClientW = document.body.clientWidth;
    var iframeId = $(window.parent.document).find("#iframeid")
    iframeId.css("height",bodyClientH + 300)
}   
changeFrameHeight()

function disableRightClick(e){
	if(!document.rightClickDisabled){ // initialize
		if(document.layers){
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = disableRightClick;
		}else{
			document.oncontextmenu = disableRightClick;
		}
		return document.rightClickDisabled = true;
	}
	
	if(document.layers || (document.getElementById && !document.all)){
		if (e.which==2||e.which==3) return false;
	}else{
		return false;
	}
}
//disableRightClick();


//添加到收藏夹  
function AddToFavorite()  {   
	if (document.all){  
		window.external.addFavorite("http://ez114.com","万丰国际-欢迎您！");  
	}else if (window.sidebar){  
		window.sidebar.addPanel("万丰国际-欢迎您！", "http://ez114.com", "");  
	} 
}

//解决IE6不缓存背景图片问题
try{
	document.execCommand("BackgroundImageCache", false, true);
}catch(e){}

//** 导航切换; ***/
$('.panel-heading.f_lottery_open_top div').click(function () {
    var _url = $(this).attr('data-url');
    console.log(_url);
    if(_url == 'current'){  // 当前玩法
        $('.nav_list_bg').toggle();
        $('.fa.fa-angle-up').toggleClass('fa-angle-down');
    }else if(typeof _url == 'undefined'){
        return;
    }else{
        location.href = _url;
    }
})