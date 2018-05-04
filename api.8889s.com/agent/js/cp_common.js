
var cpjs = {
    
    //限制只能输入1-9纯数字 
    digitOnly:function($this) {
        var n = $($this);
        var r = /^\+?[1-9][0-9]*$/;
        if (!r.test(n.val())) {
            n.val(1);
        }
    },
    
    jian:function(id,num){
        var target=$("#"+id);
        var new_val = parseInt(target.val())-parseInt(num);
        if(new_val <0) new_val = 0;
        target.val(new_val);
        
    },
    
    jia:function(id,num){
        var target=$("#"+id);
        var new_val = parseInt(target.val())+parseInt(num);
        target.val(new_val);
    }
    ,
    showmsg:function(msg){
        if($("#showmsglayer").length == 0){
            $("body").append(cpjs.showmsghtml);
        }
        var height = $(window).height();
        var width = $(window).width();
        $("#showmsglayer").css({width:width,height:height});
        var smtop = parseInt((height-200)/2);
        var smleft = parseInt((width-300)/2);
        $("#showmsglayer .smlayer").css({left:smleft,top:smtop});
        $("#showmsglayer .smlayer .cont").html(msg);
        $("#showmsglayer").show(0);
    },
    showinput:function(type,id,obj){
    	
        if($("#showmsglayer").length == 0){
            $("body").append(cpjs.showinputhtml);
        }
        
        var height = $(window).height();
        var width = $(window).width();
        $("#showmsglayer").css({width:width,height:height});
        var smtop = parseInt((height-200)/2);
        var smleft = parseInt((width-300)/2);
        $("#showmsglayer .smlayer").css({left:smleft,top:smtop});
        $("#showmsglayer .smlayer .tit").html(type+'注单修改：'+id);
        $("#showmsglayer .smlayer .textarea").html($(obj).find("[name=detailnum]").html());
        $("#showmsglayer").show(0);
        $("#showmsglayer #gdbtn").attr('cbetid',id);
        cpjs.inputtd = obj;
    },
    closeshowmsg:function(){
        $("#showmsglayer").remove();
        //$("#showmsglayer").css({display:'none'});
    },
    resizeshowmsg:function(){
        if($("#showmsglayer").css('display') == 'none') return;
        var height = $(window).height();
        var width = $(window).width();
        $("#showmsglayer").css({width:width,height:height});
        var smtop = parseInt((height-200)/2);
        var smleft = parseInt((width-300)/2);
        $("#showmsglayer .smlayer").css({left:smleft,top:smtop});
        $("#showmsglayer").css({display:'block'});
    },
    inputtd:null
    ,
    showmsghtml:'<div id="showmsglayer">\
        <div class="smlayer">\
            <div class="tit">提示</div>\
            <div class="sublayer">\
            <div class="cont">\
            </div>\
            <div class="closebtn" onclick="cpjs.closeshowmsg()">确定</div>\
            </div>\
        </div>\
    </div>',
     showinputhtml:'<div id="showmsglayer">\
            <div class="smlayer">\
                <div class="tit">提示</div>\
                <div class="sublayer">\
                <textarea id="gdtext" class="textarea">\
                </textarea>\
                <div class="closebtn1" id="gdbtn" onclick="gaidan(this)">确定</div>\
                <div class="closebtn2" onclick="cpjs.closeshowmsg()">取消</div>\
                </div>\
            </div>\
        </div>',
    playring:function(num) {
    var ua = navigator.userAgent.toLowerCase();
    if(num==1){
        var ring = 'js/RING_01.wav';
    }else if(num==5){
        var ring = 'js/RING_05.wav';
    }else{
        return;
    }
    var c = $('#playringdiv');
    if (ua.match(/msie ([\d.]+)/)) { //ie
        c.html('<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95"><param name="AutoStart" value="1" /><param name="Src" value="' + ring + '" /></object>');
    } else if (ua.match(/firefox\/([\d.]+)/)) {
        c.html('<audio src=' + ring + ' type="audio/mp3" autoplay=”autoplay” hidden="true"></audio>');
    } else if (ua.match(/chrome\/([\d.]+)/)) {
        c.html('<audio src=' + ring + ' type="audio/mp3" autoplay=”autoplay” hidden="true"></audio>');
    } else if (ua.match(/opera.([\d.]+)/)) {
        c.html('<embed src=' + ring + ' hidden="true" loop="false"><noembed><bgsounds src=' + ring + '></noembed>');
    } else if (ua.match(/version\/([\d.]+).*safari/)) {
        c.html('<audio src=' + ring + ' type="audio/mp3" autoplay=”autoplay” hidden="true"></audio>');
    } else {
        c.html('<audio src=' + ring + ' type="audio/mp3" autoplay=”autoplay” hidden="true"></audio>');
    }
}
    
}


function gaidan(){
	var id = $("#gdbtn").attr("cbetid");
	var code = $("#gdtext").val();
	cpjs.closeshowmsg();
	$.post('cp.info.php',{action:'gaidan','code':code,id:id},function(res){
		   
    	if(res.code == 0){
    		$(cpjs.inputtd).find("[name=detailnum]").html(code);
    	}
        showmsg(res.info);
        
    },'json');
}


function chedan(obj,id){

    $.post('cp.info.php',{action:'chedan',id:id},function(res){
   
    	if(res.code == 0){
    		$(obj).html("已取消");
    	}
        showmsg(res.info);
        
    },'json');
}

function zhchedan(obj,id){

    $.post('cp.info.php',{action:'zhchedan',id:id},function(res){
   
    	if(res.code == 0){
    		$(obj).attr("disabled","disabled"); 
    	}
        showmsg(res.info);
        
    },'json');
}

function showmsg(msg){
    cpjs.showmsg(msg);
}


window.onresize = function(){
    cpjs.resizeshowmsg();
}
