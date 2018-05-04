
var cpjs = {
    jishu:2,
    odds:0,
    
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
        if(new_val <=0) new_val = 1;
        target.val(new_val);
        cqsscjs.calc_tz_check($("#tz_check").attr("sufa"));
    },
    
    jia:function(id,num){
        var target=$("#"+id);
        var new_val = parseInt(target.val())+parseInt(num);
        target.val(new_val);
        cqsscjs.calc_tz_check($("#tz_check").attr("sufa"));
    }
    ,
    showmsg:function(msg){
        if($("#showmsglayer").length == 0){
            $("body").append(cpjs.showmsghtml);
        }
        var height = $(window).height();
        var width = $(window).width();
        
        var h_ = $("#showmsglayer .smlayer").height();
        $("#showmsglayer").css({width:width,height:height});
        var smtop = parseInt((height-h_)/2);
        var smleft = parseInt((width-300)/2);
        $("#showmsglayer .smlayer").css({left:smleft,top:smtop});
        $("#showmsglayer .smlayer .cont").html(msg);
        $("#showmsglayer").show(0);
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
    showmsghtml:'<div id="showmsglayer">\
        <div class="smlayer">\
            <div class="tit">提示</div>\
            <div class="sublayer">\
            <div class="cont">\
            </div>\
            <div class="closebtn" onclick="cpjs.closeshowmsg()">确定</div>\
            </div>\
        </div>\
    </div>'
//  playring:function(num) {
//  	
//  if($(".lottery_frame .hc_open .voice").hasClass("off")) return;
//  var ua = navigator.userAgent.toLowerCase();
//  if(num==1){
//      var ring = 'js/RING_01.wav';
//  }else if(num==5){
//      var ring = 'js/RING_05.wav';
//  }else{
//      return;
//  }
//  var c = $('#playringdiv');
//  if (ua.match(/msie ([\d.]+)/)) { //ie
//      c.html('<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95"><param name="AutoStart" value="1" /><param name="Src" value="' + ring + '" /></object>');
//  } else if (ua.match(/firefox\/([\d.]+)/)) {
//      c.html('<audio src=' + ring + ' type="audio/mp3" autoplay=”autoplay” hidden="true"></audio>');
//  } else if (ua.match(/chrome\/([\d.]+)/)) {
//      c.html('<audio src=' + ring + ' type="audio/mp3" autoplay=”autoplay” hidden="true"></audio>');
//  } else if (ua.match(/opera.([\d.]+)/)) {
//      c.html('<embed src=' + ring + ' hidden="true" loop="false"><noembed><bgsounds src=' + ring + '></noembed>');
//  } else if (ua.match(/version\/([\d.]+).*safari/)) {
//      c.html('<audio src=' + ring + ' type="audio/mp3" autoplay=”autoplay” hidden="true"></audio>');
//  } else {
//      c.html('<audio src=' + ring + ' type="audio/mp3" autoplay=”autoplay” hidden="true"></audio>');
//  }
//}
    
}

  
    //限制只能输入1-9纯数字 
    function digitOnly($this) {
        var n = $($this);
        
        if($.trim(n.val()) == ""){
            n.val("");
            return;
        }
        var r = /^\+?[1-9][0-9]*$/;
        if (!r.test(n.val())) {
            n.val(1);
        }
        cqsscjs.calc_tz_check($("#tz_check").attr("sufa"));
    }
    
function zt_history(){
    $.get('action/cp.info.php',{action:'bet'},function(res){
        var zt_history_html = '';
         $(res).each(function(k,v){
            
            var zt = '';
            if(v.js == 0) zt = "未开奖";
            if(v.js == 1 && v.win == 0) zt = "<span style='color:green'>未中奖</span>";
            else if(v.js == 1 && v.win > 0) zt = "<span style='color:red'>已派奖</span>";
            if(v.js == 2) zt = "<span style='color:blue'>已撤销</span>";
            
            var enabled = '';
            if(v.js != 0 ) enabled = ' disabled';
             
            zt_history_html+='<tr>\
                            <td>'+v.addtime.replace(" ","<br>")+'</td>\
                            <td>'+v.qishu+'</td>\
                            <td>'+v.type_str+'</td>\
                            <td>'+v.type_2+'['+v.type_3+']</td>\
                            <td><span class="span_tzc">详细号码<p>'+v.code+'<p></span></td>\
                            <td>'+v.money+'</td>\
                            <td>'+v.win+'</td>\
                            <td>'+v.opencode+'</td>\
                            <td>'+zt+'</td>\
                            <td><input type="button" '+enabled+' onclick="chedan(this,'+v.id+')" value="撤销" /></td>\
                        </tr>';
         });
         
        $("#tz_history_list").html(zt_history_html);
    },'json');
}

function zh_history(){
    $.get('action/cp.info.php',{action:'zhbet'},function(res){
        var zh_history_html = '';
         $(res).each(function(k,v){
            
            var zt = '';
            if(v.state == 1) zt = "进行中";
            if(v.state == 2) zt = "已撤销";
            if(v.state == 3) zt = "追号完成";
            if(v.state == 4) zt = "追号已停止";
            
            var zui = '';
            if(v.zui == 0) zui = "否";
            if(v.zui == 1) zui = "是";
            var enabled = '';
            if(v.state != 1 ) enabled = ' disabled';
            zh_history_html+='<tr>\
                            <td>'+v.addtime+'</td>\
                            <td>'+v.type+'</td>\
                            <td><a href="zh_detail.php?id='+v.id+'" target="_blank">查看</a></td>\
                            <td>'+v.zqishu+'</td>\
                            <td>'+v.cqishu+'</td>\
                            <td>'+v.zmoney+'</td>\
                            <td>'+v.cmoney+'</td>\
                            <td>'+zui+'</td>\
                            <td>'+zt+'</td>\
                            <td><input type="button" '+enabled+' onclick="zhchedan(this,'+v.id+')" value="撤销" /></td>\
                        </tr>';
         });
         
        $("#zh_history_list").html(zh_history_html);
    },'json');
}


function zxkj(){
    $.get('action/cp.info.php',{action:'zxkj'},function(res){
        if($.trim(res) != ''){
        $html = '<div class="zxkj"> \
       <div class="tit">开奖消息<span class="close" onclick="zxkj_close(this)">×</span></div>\
        <div class="cont">'+res+'</div>\
    </div>';
        
       $(".zxkjlist").append($html);
        }
        
    },'text');
}

function zxkj_close(obj){
    $(obj).parent().parent().remove();
}


function user_money(){
     $.get('action/cp.info.php',{action:'money'},function(res){
        $("#uinfo_money").html(res);
    },'json');
}

function user_money_zh(){
    $.get('action/cp.info.php',{action:'zhmoney'},function(res){
       $("#uinfo_money_zh").html(res);
   },'json');
}

function user_money_tz(){
    $.get('action/cp.info.php',{action:'tzmoney'},function(res){
       $("#uinfo_money_tz").html(res);
   },'json');
}

function chedan(obj,id){

    $.post('action/cp.info.php',{action:'chedan',id:id},function(res){
   
        showmsg(res.info);
        
    },'json');
}

function zhchedan(obj,id){

    $.post('action/cp.info.php',{action:'zhchedan',id:id},function(res){
   
        showmsg(res.info);
        
    },'json');
}



function showmsg(msg){
    cpjs.showmsg(msg);
}

var is_ordering = false;
 function submit_check(pageurl){
	 	//alert('就是不让你买');
		//return false;
	 
	 		if (!pageurl) {
				alert('请先选择彩票类型');
				return false;
			}
			
			if (is_ordering) {
				return false;
			}
			
			is_ordering = true;
			var is_weihu = 0;
			// order 之前， 先判断一下这个彩票是否在维护中
			$.ajax({
				type: "post",
				url: pageurl,
				cache: false,
				async: false,
				data:{'ajax':1},
				success:function(data) {
					is_ordering = false;
					if (data == 1) {
						is_weihu = 1;
					}
				},
				error:function() {
					is_ordering = false;
					is_weihu = 1;
				}
			});
			
			if (is_weihu == 1) {
				alert('服务器正在维护， 请稍后再试');
				return false;
			}
	 
	 
        
        if($("#tz_list tr").length == 0){
            showmsg("你还没有选择注单");
        }else if($("#count_down").html() == "封盘") {
            showmsg("还没有开盘");
        }else if($("#count_down").html() == "已截止"){
            showmsg("本期已经截止投注");
        }else{
            if($("#fqzh").is(":checked")){
                if(parseInt($("#zhzje").html()) > parseInt($("#uinfo_money").html())){
                    showmsg("余额不足");
                }else{
                    
                    var qcount = 0;
                    $("#zhlist_tb tr").each(function(){
    
                        if($(this).find("input[name='zhxzck']").is(":checked")){

                            qcount ++
                        }
                    })
                    if(qcount == 0){
                        showmsg("请选择追号期数"); return;
                    }
                 
                    var tznr = '';
                    
                    $("#tz_list tr").each(function(){
                        tznr += $($(this).find("td").get(0)).html()+"<br>";
                    });
        
       
                    
                    
                     var showmsghtml='<div id="showmsglayer">\
                        <div class="smlayer smlayer1">\
                            <div class="tit">提示</div>\
                            <div class="sublayer">\
                            <div class="tit1">确定要追号'+qcount+'期吗？</div>\
                            <div class="cont1">'+tznr+'</div>\
                            <div class="tit1">总金额:'+$("#zhzje").html()+'元</div>\
                            <div class="closebtn1" onclick="cpjs.closeshowmsg();submit_check_ok();">确定</div>\
                            <div class="closebtn2" onclick="cpjs.closeshowmsg();">取消</div>\
                            <div class="clear" ></div>\
                            </div>\
                        </div>\
                    </div>';
                        $("body").append(showmsghtml);
                        showmsg('');
                   
                    
                    
                }
            }else{
            
                if(parseInt($("#total_money").html()) > parseInt($("#uinfo_money").html())){
                    showmsg("余额不足");
                }else{
                    
                    var tznr = '';
                    
                    $("#tz_list tr").each(function(){
                        tznr += $($(this).find("td").get(0)).html()+"<br>"
                    });
        
       
                    var curqi = $("#current_issue").html();
                    
                     var showmsghtml='<div id="showmsglayer">\
                        <div class="smlayer smlayer1">\
                            <div class="tit">提示</div>\
                            <div class="sublayer">\
                            <div class="tit1">确认'+curqi+'投注？</div>\
                            <div class="cont1">'+tznr+'</div>\
                            <div class="tit1">总金额:'+$("#total_money").html()+'元</div>\
                            <div class="closebtn1" onclick="cpjs.closeshowmsg();submit_check_ok();">确定</div>\
                            <div class="closebtn2" onclick="cpjs.closeshowmsg();">取消</div>\
                            <div class="clear" ></div>\
                            </div>\
                        </div>\
                    </div>';
                     $("body").append(showmsghtml);
                        showmsg('');
                    
                }
            
            }
        }
    }

 function submit_check_ok(){
         
    $("#tz_list_form").submit();
    zhlist_init();
    if($("#fqzh").is(":checked")) $("#fqzh").click();
    $("#zd_num").html(0);
    $("#zd_nums").html(0);
    $("#total_money").html(0);
    $("#tz_list").html("");
}


function yjf_setting(obj){

    $(".yjf").removeClass("cur");
    $(obj).addClass("cur");
    
    $("#yjfinput").val($(".yjf.cur").html());
    
    if($(".yjf.cur").html() == "元"){
        cpjs.jishu = 2;
        $("#tz_sp").html(parseInt(100*cpjs.odds*cpjs.jishu/2)/100);
    } 
    if($(".yjf.cur").html() == "角"){
        cpjs.jishu = 0.2;
        $("#tz_sp").html(parseInt(100*cpjs.odds*cpjs.jishu/2)/100);
    } 
    if($(".yjf.cur").html() == "分"){
        cpjs.jishu = 0.02;
        $("#tz_sp").html(parseInt(100*cpjs.odds*cpjs.jishu/2)/100);
    } 
    
    cqsscjs.calc_tz_check($("#tz_check").attr("sufa"));
    
    
    
}



$(function(){
	
	$(".lottery_frame .hc_open .voice").click(function(){
		
		if($(this).hasClass('on')){
			
			$(this).removeClass("on").addClass("off");
		}else{
			
			$(this).removeClass("off").addClass("on");
		}
		
	})
})




window.onresize = function(){
    cpjs.resizeshowmsg();
}
