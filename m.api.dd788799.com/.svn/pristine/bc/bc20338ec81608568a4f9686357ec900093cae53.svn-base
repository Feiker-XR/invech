var bool = auto_new = false;
var sound_off=0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh ='';

$(function(){
	$('#cqc_sound').bind('click',function(){//绑定声音按钮
        var e=$(this);
        if(e.attr('off')=='1'){//声音开启
            e.attr('off','0');
            e.children('img').attr('src','images/on.png');
            sound_off=0;
        }else{//关闭
            e.attr('off','1');
            e.children('img').attr('src','images/off.png');
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
	$.post("class/odds_7.php", function(data)
		{
			if(data.opentime>0){
				$("#open_qihao").html(data.number);
				ball_odds = data.oddslist;
				loadodds(data.oddslist);
				endtime(data.opentime);
				auto(1);
			}else{
				$(".bian_td_odds").html("-");
				$(".bian_td_inp").html("封盘");
				$("#autoinfo").html("已经封盘，请稍后进行投注！");
				$.jBox.alert('当前彩票已经封盘，请稍后再进行下注！<br><br>江西时时彩开盘时间为：每日09:00 - 23:10', '提示');
				return false;
	
			}
		}, "json");
}
//更新赔率
function loadodds(oddslist){
	if (oddslist == null || oddslist == "") {
			$(".bian_td_odds").html("-");
			$(".bian_td_inp").html("封盘");
			return false;
	}
	for(var i = 1; i<12; i++){
		if(i==6){
			for(var s = 1; s<8; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i, s);
			}
		}else if(i==7){
			for(var s = 1; s<10; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i, s);
			}
		}else if(i==8){
			for(var s = 1; s<10; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i, s);
			}
		}else if(i==9){
			for(var s = 1; s<10; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i, s);
			}
		}else if(i==1){
			for(var s = 1; s<15; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i , s);
			}
		}else if(i==2){
			for(var s = 1; s<15; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i , s);
			}
		}else if(i==3){
			for(var s = 1; s<15; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i , s);
			}	
		}else if(i==4){
			for(var s = 1; s<15; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i , s);
			}	
		}else if(i==5){
			for(var s = 1; s<15; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i , s);
			}	
		}/*else if(i==10){
			for(var s = 1; s<16; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i , s);
			}
		
		}else if(i==11){
			for(var s = 1; s<9; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i , s);
			}
		}*/
	} 
	
}


//更新投注框
function loadinput(ball , s){
	b = "ball_"+ball+"_"+s;
	n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"5\"/>"
	if(ball==1){
		$("#ball_"+ball+"_t"+s).html(n);
	}else if(ball==2){
		$("#ball_"+ball+"_t"+s).html(n);
	}else if(ball==3){
		$("#ball_"+ball+"_t"+s).html(n);
	}else if(ball==4){
		$("#ball_"+ball+"_t"+s).html(n);
	}else if(ball==5){
		$("#ball_"+ball+"_t"+s).html(n);
	}else if(ball==6){
		$("#ball_"+ball+"_t"+s).html(n);	
	}else if(ball==7){
		$("#ball_"+ball+"_t"+s).html(n);
	}else if(ball==8){
		$("#ball_"+ball+"_t"+s).html(n);
	}else if(ball==9){
		$("#ball_"+ball+"_t"+s).html(n);	
	}else if(ball==10){
		$("#ball_"+ball+"_t"+s).html(n);
	}else if(ball==11){
		$("#ball_"+ball+"_t"+s).html(n);

	}
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
			e.prop('src','images/bule/x.gif');
			i++;
		});


    }
	if(iTime==60){
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
		var t = 'time';

		if(iTime>60){
			$('#cqc_time').html(getIS(iTime-60));
			if(cqc_color!='white'){
				$('#cqc_time').css('color','black');
			}

			//if(iTime == 66){//离开赛还有66秒，播放声音
				//if(!sound_off){
					//getSwfId('swfcontent').Pten();
				//}
			//}
		}

		if( iTime<=60 && iTime>0){
		     $('#cqc_time').html(getIS(iTime));
			if(cqc_color!='blue'){
				$('#cqc_time').css('color','red');
			}
		}

		if(iTime<60){
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
		fp = setTimeout("endtime("+iTime+")",1000);
    }
}
//更新开奖号码
function auto(ball){
	$.post("class/auto_7.php", {ball : ball}, function(data)
		{
			$("#numbers").html(data.numbers);
			var openqihao = $("#open_qihao").html();
			if(auto_new == false || openqihao - data.numbers == 1){
				var numinfo='';
				numinfo = numinfo+'<span><font>'+data.hms[0]+'</font></span>&nbsp;<span><font>'+data.hms[1]+'</font></span>&nbsp;<span><font>'+data.hms[2]+'</font></span>&nbsp;&nbsp;斗牛：<span><font>'+data.hms[7]+'</font></span>&nbsp;&nbsp;梭哈：<span><font>'+data.hms[8]+'</font></span>&nbsp;&nbsp;龙虎：<span><font>'+data.hms[3]+'</font></span>&nbsp;&nbsp;组合：<span><font>'+data.hms[4]+'</font></span>&nbsp;<span><font>'+data.hms[5]+'</font></span>&nbsp;<span><font>'+data.hms[6]+'</font></span>';
				$("#autoinfo").html(numinfo);
				var i=0;
				var fun=5;
				$('.open_number > img ').each(function(){
					var e=$(this);
					var nu=data.hm[i];
					setTimeout(function(){e.prop('src','images/bule/'+nu+'.png');},fun*600);
					i++;
					fun--;
				});
				auto_new = true;
				if(openqihao - data.numbers != 1){xhm = setTimeout("auto(1)",3000);}
			}else{
				xhm = setTimeout("auto(1)",3000);
			}
			var auto_top = '<table width="100%" border="0" cellspacing="1" cellpadding="0" class="clbian"><tr class="clbian_tr_title"><td colspan="2">开奖结果</td></tr><tr class="clbian_tr_title"><td>开奖期数</td><td>开奖号码</td></tr>';
				for (var key in data.hmlist){
					auto_top = auto_top+'<tr class="clbian_tr_txt"><td class="qihao">'+key+'</td><td class="haoma">'+data.hmlist[key]+'</td></tr>'
				}
			auto_top = auto_top+'</table>'
			//$("#auto_list").html(auto_top);
			//$(parent.leftFrame.document).find("#auto_list").html(auto_top);
		}, "json");
}
//投注提交
function order(){
	var tt = $("input.inp1");
	var mix = 10; cou = m = 0, txt = '', c=true;
	for (var i = 1; i < 12; i++){
		if(i==6){
			for(var s = 1; s < 8; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).html();
					var q = did(i);
					var w = wan6(s);
					txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		}else if(i==7 || i==8 || i==9){
			for(var s = 1; s < 6; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_7_h" + s).html();
					var q = did(i);
					var w = wan789(s);
					txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		}else if(i==10){
			for(var s = 1; s < 16; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_10_h" + s).html();
					var q = did(i);
					var w = wan10(s);
					txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		}else if(i==11){
			for(var s = 1; s < 9; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_11_h" + s).html();
					var q = did(i);
					var w = wan11(s);
					txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		}else{
			for(var s = 1; s < 15; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_1_h" + s).html();
					var q = did(i);
					var w = wan(s);
					txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		}
	}
	if (!c) {$.jBox.tip("最低下注金额："+mix+"￥");return false;}
	if (cou <= 0) {$.jBox.tip("请输入下注金额!!!");return false;}
	var t = "共 ￥"+m+" / "+cou+" 笔，确定下注吗？\n\n下注明细如下：\n\n";
	txt = t + txt;
	var ok = confirm(txt);
	if (ok)
	document.orders.submit()
	document.orders.reset()
}
//读取第几球
function did (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '第一球'; break;
		case 2 : r = '第二球'; break;
		case 3 : r = '第三球'; break;
		case 4 : r = '第四球'; break;
		case 5 : r = '第五球'; break;
		case 6 : r = '总和、龙虎和'; break;
		case 7 : r = '前三'; break;
		case 8 : r = '中三'; break;
		case 9 : r = '后三'; break;
		case 10 : r = '斗牛'; break;
		case 11 : r = '梭哈'; break;
	}
	return r;
}
//读取玩法
function wan (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '0'; break;
		case 2 : r = '1'; break;
		case 3 : r = '2'; break;
		case 4 : r = '3'; break;
		case 5 : r = '4'; break;
		case 6 : r = '5'; break;
		case 7 : r = '6'; break;
		case 8 : r = '7'; break;
		case 9 : r = '8'; break;
		case 10 : r = '9'; break;
		case 11 : r = '大'; break;
		case 12 : r = '小'; break;
		case 13 : r = '单'; break;
		case 14 : r = '双'; break;
	}
	return r;
}
//读取玩法
function wan6 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '总和大'; break;
		case 2 : r = '总和小'; break;
		case 3 : r = '总和单'; break;
		case 4 : r = '总和双'; break;
		case 5 : r = '龙'; break;
		case 6 : r = '虎'; break;
		case 7 : r = '和'; break;
	}
	return r;
}
//读取玩法
function wan789 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '豹子'; break;
		case 2 : r = '顺子'; break;
		case 3 : r = '对子'; break;

		case 4 : r = '半顺'; break;
		case 5 : r = '杂六'; break;
		case 6 : r = '大'; break;
		case 7 : r = '小'; break;
		case 8 : r = '单'; break;
		case 9 : r = '双'; break;
	}
	return r;
}
//读取玩法
function wan10 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '没牛'; break;
		case 2 : r = '牛1'; break;
		case 3 : r = '牛2'; break;

		case 4 : r = '牛3'; break;
		case 5 : r = '牛4'; break;
		case 6 : r = '牛5'; break;
		
		case 7 : r = '牛6'; break;
		case 8 : r = '牛7'; break;
		case 9 : r = '牛8'; break;
		
		case 10 : r = '牛9'; break;
		case 11 : r = '牛牛'; break;
		case 12 : r = '牛大'; break;
		
		case 13 : r = '牛小'; break;
		case 14 : r = '牛单'; break;
		case 15 : r = '牛双'; break;
	}
	return r;
}
//读取玩法
function wan11 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '五条'; break;
		case 2 : r = '四条'; break;
		case 3 : r = '葫芦'; break;

		case 4 : r = '顺子'; break;
		case 5 : r = '三条'; break;
		case 6 : r = '两对'; break;
		
		case 7 : r = '一对'; break;
		case 8 : r = '散号'; break;
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