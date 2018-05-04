(function($){
    var defaults = {
        height:"800"
    };
    //设置父级ifarme高度
    $.fn.setHeight=function(options){
        var settings = $.extend({},defaults,options||{});
        //判断是否最子级ifarme
        if($(this).length==0)
        {
            //由于多个地方调用，这里判断第几层找到最大ifarme
            /*var bigIfarme=$("#contentBox",parent.document).length==0?$("#contentBox",parent.parent.document):$("#contentBox",parent.document);
            //减去导航高度
            var conHt=bigIfarme.height()-155;
            var bodyHt=parseInt($("body").height());
            //如果页面高于内容则显示，如果不则最佳高度
            var _height=bodyHt>=conHt?bodyHt:conHt;
            $("#mainFrame",parent.document).height(_height);*/
            $("#mainFrame",parent.document).height(settings.height+"px");
        }
    }
    //获取URL方法
    $.getUrlParam=function(uName)
    {
        var reg = new RegExp("(^|&)"+ uName +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r!=null) return decodeURI(r[2]); return null; //返回参数值
    }
})(jQuery);
var $sideObj=$("#siderbar ul li");
var $obj=$(".secondary_tabs ul");
    $sideObj.find("a").on("click",function(){
        $(".topContent ul li a").html($(this).html());
    //移除其他Class
    $sideObj.removeClass("current");
    $(this).parent().addClass("current");
        var _ifrm=$("#mainFrame").contents();
        if(_ifrm.find("#JS_blockOverlay").length>0)
        {
            _ifrm.find("#JS_blockOverlay").remove();
            _ifrm.find("#JS_blockUI").remove();
            _ifrm.find("#JS_blockPage").remove();
        }
        $("#mainFrame").contents().find(".mask_list").show();
    if($obj.length>0)
    {
        var $ul=$obj.eq($(this).parent().index());
        var $li=$ul.find("li");
        $li.removeClass("curr");
        $li.eq(0).addClass("curr");
        $obj.hide();
        $ul.show();
        $("#mainFrame").attr("src",$li.eq(0).find("a").attr("href"));
    }
})
        $obj.find("li").on("click",function(){
           $obj.find("li").removeClass("curr");
            $(this).addClass("curr");
            var _ifrm=$("#mainFrame").contents();
            if(_ifrm.find("#JS_blockOverlay").length>0)
            {
                _ifrm.find("#JS_blockOverlay").remove();
                _ifrm.find("#JS_blockUI").remove();
                _ifrm.find("#JS_blockPage").remove();
            }
            $("#mainFrame").contents().find(".mask_list").show();
        })


