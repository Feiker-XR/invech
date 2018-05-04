var bool = auto_new = false;
var sound_off=0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh ='';
$(function(){
	$('#cqc_sound').bind('click',function(){//绑定声音按钮
        var e=$(this);
        if(e.attr('off')=='1'){//声音开启
            e.attr('off','0');
            e.children('img').attr('src','images/ssc_on.png');
            sound_off=0;
        }else{//关闭
            e.attr('off','1');
            e.children('img').attr('src','images/ssc_off.png');
            sound_off=1;
        }
    });
});


//限制只能输入1-9纯数字 
function digitOnly ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}
//盘口信息
function loadinfo(){
	$.post("class/odds_9.php", function(data)
		{
			if(data.opentime>0 && data.endtime >0){
				$("#open_qihao").html(data.number);
				ball_odds = data.oddslist;
				loadodds(data.oddslist);
				endtime(data.opentime,data.endtime);
				auto(1);
			}else if(data.opentime >0 && data.endtime <= 0){
				$("#open_qihao").html(data.number);
				$(".bian_td_odds").html("-");
				$(".bian_td_inp").html("封盘");
				endtime(data.opentime,data.endtime);
				auto(1);
			}else{
				$(".bian_td_odds").html("-");
				$(".bian_td_inp").html("封盘");
				$("#autoinfo").html("已经封盘，请稍后进行投注！");
				$.jBox.alert('当前彩票已经封盘，请稍后再进行下注！<br><br>北京PK拾开盘时间为：09:00 - 23:55', '提示');
				return false;
	
			}
		}, "json");
}
//更新赔率
function loadodds(oddslist){
	/*
    if (oddslist == null || oddslist == "") {
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("封盘");
            return false;
    }
    for(var i = 1; i<18; i++){
        if(i==1){
            for(var s = 1; s<22; s++){
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html(odds);
                loadinput(i, s);
            }
        }else if(i>=2 && i<=11){
            for(var s = 1; s<15; s++){
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html(odds);
                loadinput(i , s);
            }
        }else if(i>=12 && i<=16){
            for(var s = 1; s<3; s++){
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html(odds);
                loadinput(i , s);
            }
		}else if(i==17){
            for(var s = 1; s<27; s++){
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html(odds);
                loadinput(i, s);
            }
        }
    } */
	if (oddslist == null || oddslist == "") {
			$(".bian_td_odds").html("-");
			$(".bian_td_inp").html("封盘");
			return false;
	}
	for(var i = 1; i<12; i++){
		if(i==11){
			for(var s = 1; s<22; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i, s);
			}
		}else if(i>=1 && i<11){
			for(var s = 1; s<17; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i , s);
			}
		}else if(i<6){
			for(var s = 15; s<17; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinputs(i , s);
			}
		}
	} 
    
}
//号码赔率
function hm_odds(ball){
	/*
    if (ball_odds == null || ball_odds == "") {
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("封盘");
            return false;
    }
    for(var s = 1; s<15; s++){
        odds = ball_odds.ball[ball][s];
        $("#ball_2_h"+s).html(odds);
        loadinput(ball , s);
    } 
    for( var i = 0; i < 10; i++){
        if(i == ball-2){
        $('#menu_hm > li').eq(i).removeClass("current_n").addClass("current");
        }else{
        $('#menu_hm > li').eq(i).removeClass("current").addClass("current_n");
        }
    }*/
	if (ball_odds == null || ball_odds == "") {
			$(".bian_td_odds").html("-");
			$(".bian_td_inp").html("封盘");
			return false;
	}
	for(var s = 1; s<15; s++){
		odds = ball_odds.ball[ball][s];
		$("#ball_1_h"+s).html(odds);
		loadinput(ball , s);
	} 
	for( var i = 0; i < 10; i++){
		if(i == ball-1){
		$('#menu_hm > a').eq(i).addClass("cur");
		}else{
		$('#menu_hm > a').eq(i).removeClass("cur");
		}
	}
    
}
//更新投注框
function loadinput(ball , s){
    b = "ball_"+ball+"_"+s;
    n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"loadSet(this)\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>"
    if (ball==1){
        $("#ball_1_t"+s).html(n);
    }else if(ball>= 2&& ball<=11){
        $("#ball_"+ball+"_t"+s).html(n);
    }else if(ball>=12&&ball<=16){
        $("#ball_"+ball+"_t"+s).html(n);
	}else if (ball==17){
        $("#ball_17_t"+s).html(n);
    }
}
function loadinputs(ball , s){
	b = "ball_"+ball+"_"+s;
	n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"5\"/>"
	$("#ball_"+ball+"_t"+s).html(n);
}

function getIS(s){
    var i=Math.floor(s/60);
    if(i < 10) i = '0'+i;
    var ss	=	s%60;
    if(ss < 10) ss = '0'+ss;
    return i+":"+ss;
}

//封盘时间
function endtime(iTime)
{
	var cqc_color=$('#cqc_time').css('color');
	var iMinute,iSecond;
    var sMinute="",sSecond="",sTime="";
    iMinute = parseInt((iTime/60)%60);
	if (iMinute == 0){
		sMinute = "00";
    }
    if (iMinute > 0 && iMinute < 10){
    	sMinute = "0" + iMinute;
    }
	if (iMinute > 10){
    	sMinute = iMinute;
    }
    iSecond = parseInt(iTime%60);
    if (iSecond >= 0 && iSecond < 10 ){
    	sSecond = "0" + iSecond;
    }
	if (iSecond >= 10 ){
    	sSecond =iSecond;
    }
    sTime= sMinute + sSecond;
    if(iTime==0){
		$("#look").html('<embed width="0" height="0" src="js/2.swf" type="application/x-shockwave-flash" hidden="true" />');
		var xnumbers = parseInt($("#numbers").html());
		//var numinfo= xnumbers+1+'正在开奖...';
		var numinfo= '<span>正在开奖...</span>';
		$("#autoinfo").html(numinfo);
		var i=0;
		$('.open_number > img ').each(function(){
			var e=$(this);
			e.prop('src','images/Open_pk10/x.gif');
			i++;
		});
    }
	if((fengpansTime <= 0 && (fengpansTime !== 'undefined' || fengpansTime !== null))|| ((fengpansTime == 'undefined' || fengpansTime == null) && iTime<60)){
		$(".bian_td_odds").html("-");
		$(".bian_td_inp").html("封盘");
		$("#look").html('<embed width="0" height="0" src="js/1.swf" type="application/x-shockwave-flash" hidden="true" />');
    }
	if(iTime<0){
		clearTimeout(fp);
		loadinfo();
    }else
    {
		iTime--;
		fengpansTime -- ;
		var t = 'time';

		if(fengpansTime>0){
			$('#cqc_time').html(getIS(iTime-60));
			if(cqc_color!='white'){
				$('#cqc_time').css('color','black');
			}

			if(iTime == 66){//离开赛还有66秒，播放声音
				if(!sound_off){
					getSwfId('swfcontent').Pten();
				}
			}
		}

		if( (fengpansTime <= 0 && (fengpansTime !== 'undefined' || fengpansTime !== null))|| ((fengpansTime == 'undefined' || fengpansTime == null) && iTime<60)){
		     $('#cqc_time').html(getIS(iTime));
			if(cqc_color!='blue'){
				$('#cqc_time').css('color','red');
			}
		}

		if((fengpansTime <= 0 && (fengpansTime !== 'undefined' || fengpansTime !== null))|| ((fengpansTime == 'undefined' || fengpansTime == null) && iTime<60)){
		$(".bian_td_odds").html("-");
		$(".bian_td_inp").html("封盘");
			t = 'times';
		}
		$("#sss").html(iTime);

		//$('.colon > img').attr('src','images/'+t+'/10.png');
		//$('.minute > span > img').eq(0).attr('src','images/'+t+'/'+sTime.substr(0,1)+'.png');
		//$('.minute > span > img').eq(1).attr('src','images/'+t+'/'+sTime.substr(1,1)+'.png');
		//$('.second > span > img').eq(0).attr('src','images/'+t+'/'+sTime.substr(2,1)+'.png');
		//$('.second > span > img').eq(1).attr('src','images/'+t+'/'+sTime.substr(3,1)+'.png');
		fp = setTimeout("endtime("+iTime+","+fengpansTime+")",1000);
    }
}
//更新开奖号码
function auto(ball){
	$.post("class/auto_9.php", {ball : ball}, function(data)
		{
			$("#numbers").html(data.numbers);
			var openqihao = $("#open_qihao").html();
			if(auto_new == false || openqihao - data.numbers == 1){
				var numinfo='';
				numinfo = numinfo+'冠亚和：<span><font>'+data.hms[0]+'</font></span>&nbsp;<span><font>'+data.hms[1]+'</font></span>&nbsp;<span><font>'+data.hms[2]+'</font></span>&nbsp;1V10：<span><font>'+data.hms[3]+'</font></span>&nbsp;2V9：<span><font>'+data.hms[4]+'</font></span>&nbsp;3V8：<span><font>'+data.hms[5]+'</font></span>&nbsp;4V7：<span><font>'+data.hms[6]+'</font></span>&nbsp;5V6：<span><font>'+data.hms[7]+'</font></span>';
				$("#autoinfo").html(numinfo);
				var i=0;
				var fun=10;
				$('.open_number > img ').each(function(){
					var e=$(this);
					var nu=data.hm[i]<10 ? '0'+data.hm[i] : data.hm[i];
					setTimeout(function(){e.prop('src','images/Open_pk10/'+nu+'.gif');},fun*600);
					i++;
					fun--;
				});
				auto_new = true;
				if(openqihao - data.numbers != 1){xhm = setTimeout("auto(1)",3000);}
			}else{
				xhm = setTimeout("auto(1)",3000);
			}
			var auto_top = '<div class="cp_list_table"><table width="100%" border="0" cellspacing="0" cellpadding="0">';
				for (var key in data.hmlist){
					auto_top = auto_top+'<tr class="line_list"><td><font color="#fcf9f9">第 </font><font color="#e7df0f">'+key+'</font><font color="#fcf9f9"> 期</font></td><td><font color="#611b0b"> </font><font color="#54e732">'+data.hmlist[key]+'</font></td></tr></tr>';
					break;
				}
			auto_top = auto_top+'</table></div>'
			$("#auto_list").html(auto_top);
			//$(parent.leftFrame.document).find("#auto_list").html(auto_top);
		}, "json");
}
//投注提交
function order(){
   // if(!islg){$.jBox.tip("您尚未登录或登录已超时，请重新登录");return false;}

	$.post("Include/Lottery_PK.php", function(data) {
		var tt = $("input.inp1");
		var mix = 10; cou = m = 0, txt = '', c=true;
		mix = data.cp_zd;
		var max = 1000000, d=true;
		max = data.cp_zg;
		var e=true; etxt='';
		var qishu=$("#open_qihao").html();
		
		for (var i = 1; i < 18; i++){
			if(i==11){
				for(var s = 1; s < 22; s++){
					if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
						//判断最小下注金额
						if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
							c = false;
							$.jBox.tip("最低下注金额："+mix+"￥");return false;
						}
						if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
							d = false;
							$.jBox.tip("最高下注金额："+max+"￥");return false;
						}
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
						var odds = $("#ball_"+i+"_h" + s).html();
						var q = did(i);
						var w = wan(s);
						txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
						cou++;
					}
				}
			}else if(i>=1&&i<=10){
				for(var s = 1; s < 17; s++){
					if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
						//判断最小下注金额
						if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
							c = false;
							$.jBox.tip("最低下注金额："+mix+"￥");return false;
						}
						if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
							d = false;
							$.jBox.tip("最高下注金额："+max+"￥");return false;
						}
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
						var odds = $("#ball_2_h" + s).html();
						var q = did(i);
						var w = wan2(s);
						txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
						cou++;
					}
				}
			}else if(i==17){
				for(var s = 1; s < 27; s++){
					if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
						//判断最小下注金额
						if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
							c = false;
							$.jBox.tip("最低下注金额："+mix+"￥");return false;
						}
						if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
							d = false;
							$.jBox.tip("最高下注金额："+max+"￥");return false;
						}
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
						var odds = $("#ball_"+i+"_h" + s).html();
						var q = did(i);
						var w = wan17(s);
						txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
						cou++;
					}
				}
			}else{
				for(var s = 1; s < 3; s++){
					if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
						//判断最小下注金额
						if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
							c = false;
							$.jBox.tip("最低下注金额："+mix+"￥");return false;
						}
						if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
							d = false;
							$.jBox.tip("最高下注金额："+max+"￥");return false;
						}
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
						var odds = $("#ball_12_h" + s).html();
						var q = did(i);
						var w = wan12(s);
						txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
						cou++;
					}
				}
			}
		}
		if (!c) {$.jBox.tip("最低下注金额："+mix+"￥");return false;}
		if (!d) {$.jBox.tip("最高下注金额："+max+"￥");return false;}
		//if (!e) {$.jBox.tip(etxt);return false;}
		if (cou <= 0) {$.jBox.tip("请输入下注金额!!!");return false;}
		var t = "共 ￥"+m+" / "+cou+" 笔，确定下注吗？\n\n下注明细如下：\n\n";
		txt = t + txt;
		var ok = confirm(txt);
		if (ok)
		document.orders.submit()
		document.orders.reset()
	}, "json");
}
//读取第几球
function did (type)
{
    var r = '';
    switch (type)
    {
        case 11 : r = '冠、亚军和'; break;
        case 1 : r = '冠军'; break;
        case 2 : r = '亚军'; break;
        case 3 : r = '第三名'; break;
        case 4 : r = '第四名'; break;
        case 5 : r = '第五名'; break;
        case 6 : r = '第六名'; break;
        case 7 : r = '第七名'; break;
        case 8 : r = '第八名'; break;
        case 9 : r = '第九名'; break;
        case 10 : r = '第十名'; break;
        case 12 : r = '1V10 龙虎'; break;
        case 13 : r = '2V9 龙虎'; break;
        case 14 : r = '3V8 龙虎'; break;
        case 15 : r = '4V7 龙虎'; break;
        case 16 : r = '5V6 龙虎'; break;
		case 17 : r = '冠亚季军和'; break;
    }
    return r;
}
//读取玩法
function wan (type)
{
    var r = '';
    switch (type)
    {
        case 1 : r = '3'; break;
        case 2 : r = '4'; break;
        case 3 : r = '5'; break;
        case 4 : r = '6'; break;
        case 5 : r = '7'; break;
        case 6 : r = '8'; break;
        case 7 : r = '9'; break;
        case 8 : r = '10'; break;
        case 9 : r = '11'; break;
        case 10 : r = '12'; break;
        case 11 : r = '13'; break;
        case 12 : r = '14'; break;
        case 13 : r = '15'; break;
        case 14 : r = '16'; break;
        case 15 : r = '17'; break;
        case 16 : r = '18'; break;
        case 17 : r = '19'; break;
        case 18 : r = '冠亚大'; break;
        case 19 : r = '冠亚小'; break;
        case 20 : r = '冠亚单'; break;
        case 21 : r = '冠亚双'; break;
    }
    return r;
}
//读取玩法
function wan2 (type)
{
    var r = '';
    switch (type)
    {
        case 1 : r = '1'; break;
        case 2 : r = '2'; break;
        case 3 : r = '3'; break;
        case 4 : r = '4'; break;
        case 5 : r = '5'; break;
        case 6 : r = '6'; break;
        case 7 : r = '7'; break;
        case 8 : r = '8'; break;
        case 9 : r = '9'; break;
        case 10 : r = '10'; break;
        case 11 : r = '大'; break;
        case 12 : r = '小'; break;
        case 13 : r = '单'; break;
        case 14 : r = '双'; break;
        case 15 : r = '龙';break;
        case 16 : r = '虎';break;
    }
    return r;
}
//读取玩法
function wan12 (type)
{
    var r = '';
    switch (type)
    {
        case 1 : r = '龙'; break;
        case 2 : r = '虎'; break;
    }
    return r;
}
//读取玩法
function wan17 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '6'; break;
		case 2 : r = '7'; break;
		case 3 : r = '8'; break;
		case 4 : r = '9'; break;
		case 5 : r = '10'; break;
		case 6 : r = '11'; break;
		case 7 : r = '12'; break;
		case 8 : r = '13'; break;
		case 9 : r = '14'; break;
		case 10 : r = '15'; break;
		case 11 : r = '16'; break;
		case 12 : r = '17'; break;
		case 13 : r = '18'; break;
		case 14 : r = '19'; break;
		case 15 : r = '20'; break;
		case 16 : r = '21'; break;
		case 17 : r = '22'; break;
		case 18 : r = '23'; break;
		case 19 : r = '24'; break;
		case 20 : r = '25'; break;
		case 21 : r = '26'; break;
		case 22 : r = '27'; break;
		case 23 : r = '冠亚季大'; break;
		case 24 : r = '冠亚季小'; break;
		case 25 : r = '冠亚季单'; break;
		case 26 : r = '冠亚季双'; break;
	}
	return r;
}
function getSwfId(id) { //与as3交互 跨浏览器
    if (navigator.appName.indexOf("Microsoft") != -1) { 
        return window[id]; 
    } else { 
        return document[id]; 
    } 
} 