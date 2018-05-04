requirejs(["jquery", "layer"], function($) {
    $(function() {
        // $('#win_list').on("click",function() {
        //     location.href = 'common/win/list'; //获奖列表链接
        // });

       /* $('div.header-banner').on("click",function() {
            location.href = '/notice/info'; //banner链接
        });*/
        //滚动
        (function pmCarousel(){
         var length = 120 ;
            $("#win_list>div").css("height",length+"px");
            if( $("#win_list ul").height() < length )
            {
                //数据小于5行的时候不用循环轮播
                return;
            }
            var iCount = 0 ;
            function goPaly()
            {
                iCount++;
                if( iCount%6 > 0 )
                {
                    $("#win_list ul").css("top",0 - (iCount%6)*4);
                }
                else
                {
                    var newTr = $("#win_list ul li:eq(0)");
                    $("#win_list ul").append("<li>"+newTr.html()+"</li>");
                    $("#win_list ul").css("top",0);
                    $("#win_list ul  li:eq(0)").remove();
                    iCount = 0;
                }
            }
            var __sItl_1 = setInterval(goPaly,200);
            $("#prizeUser").bind("click",function(){
                clearInterval(__sItl_1);
            });
            $("#prizeUser").bind("touchmove",function(){
                clearInterval(__sItl_1);
                event.stopPropagation();
            });
            $("#prizeUser").bind("touchend",function(){
                __sItl_1 = setInterval(goPaly,200);
            });
            $("#prizeUser").bind("touchcancle",function(){
                __sItl_1 = setInterval(goPaly,200);
            });
    })();
    
    bannerObjs = $('img.banner');
    bannerIndex = 1;
    setBannerTimer();
    //popNotice();
    getNotice();
    });
    
    function popNotice() {
    	$.ajax({
            type: 'GET',
            url: 'index.php/notice/getList',
            data: '',
            dataType: 'json',
            timeout: '30000',
            success: function(results) {
                if(results.status == "200" && results.data != null) {
                	var html = '<div id="pop_notice" class="notice-index" style="max-height:350px;overflow-y:scroll;"><dl>'
			        			+'<dt id="pop_title">'+results.data.title+'</dt>'
			        			+'<dd id="pop_time" class="time">'+results.data.expand.time+'</dd>'
			        			+'<dd id="pop_content" class="cont">'+results.data.content+'</dd>'
			        		  +'</dl></div>';
                	layer.open({
    				    content: html,
    				    btn: ['关闭'],
    				    success: function(elem){
    	                    $(".layui-m-layercont").css({"padding":"0px"});
    	                },
    		            yes: function(index) {
    		            	layer.close(index);
    		            }
    				});
                }
            }
        });
    }

    function getNotice() {
        $.ajax({
            type: 'GET',
            url: 'index.php/notice/getList',
            data: '',
            dataType: 'json',
            timeout: '8000',
            success: function(results) {
                var a = results.data,html = '';
                if(results.status == "200" && results.data != null) {
                    for(var i = 0;i < a.length;i++){
                        html+='<li>';
                        html+='<div class="notice-tit"><p>'+a[i].addTime+'</p><p>'+a[i].title+'</p></div>';
                        html+='<div class="notice-content">'+a[i].content+'</div>';
                        html+='</li>';
                    }
                    $('._notice-list').html(html);

                }
            }
        });
    }

    function setBannerTimer() {
        timerBanner = window.setInterval(function () {
            for (var i = 0; i < bannerObjs.length; i++) {
                if (bannerIndex == i) {
                    $('img.banner').hide();
                    $(bannerObjs[i]).show();
                }
            }
            bannerIndex = (bannerIndex == bannerObjs.length-1) ?  0: bannerIndex+1;
        }, 3000);//2000毫秒
    }
});
