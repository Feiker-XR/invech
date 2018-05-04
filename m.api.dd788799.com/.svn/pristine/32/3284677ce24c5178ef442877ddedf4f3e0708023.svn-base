var bool = auto_new = false;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh ='';
var sound_off=0;


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
    $.post("class/odds_4.php", function(data)
        {
            if(data.opentime>0){
                $("#open_qihao").html(data.number);
				$("#orders").attr("action","order/order4.php?type=4&class=1&qishu="+data.number);
                ball_odds = data.oddslist;
                loadodds(data.oddslist);
                endtime(data.opentime);
                auto(1);
            }else{
                //$(".qh").html("第 "+data.number+" 期");
				$(".bian_td_odds").html("-");
				$(".bian_td_inp").html("封盘");
				$("#autoinfo").html("已经封盘，请稍后进行投注！");
				parent.$.jBox.alert('北京赛车PK拾已经封盘，请稍后再进行下注！', '提示');
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
    for(var i = 1; i<17; i++){
        if(i==1){
            for(var s = 1; s<22; s++){
                odds = oddslist.ball[i][s];
                $("#ball_"+i+"_h"+s).html(odds);
                loadinput(i, s);
            }
        }else if(i==2){
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
        }
    } 
    
}
//号码赔率
function hm_odds(ball){
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
    }
    
}
//更新投注框
function loadinput(ball , s){
    b = "ball_"+ball+"_"+s;
    n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"loadSet(this)\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"7\"/>"
    if (ball==1){
        $("#ball_1_t"+s).html(n);
    }else if(ball>=2&&ball<=11){
        $("#ball_2_t"+s).html(n);
    }else if(ball>=12&&ball<=16){
        $("#ball_"+ball+"_t"+s).html(n);
    }
}
//2015-1-2 增加自动下注
function loadSet(item){
item.className="inp1m";
$(item).attr('value',$('#autoInput').attr('value'));
}
//封盘时间
function endtime(iTime)
{
    var iMinute,iSecond,iHour;
    var sMinute="",sSecond="",sTime="",sHour="",sBigTime="";
    iHour = parseInt(iTime/3600);
    if (iHour == 0){
        sHour = "00";
    }
    if (iHour > 0 && iHour < 10){
        sHour = "0" + iHour;
    }
    if (iHour >= 10){
        sHour = iHour;
    }
    iMinute = parseInt((iTime/60)%60);
    if (iMinute == 0){
        sMinute = "00";
    }
    if (iMinute > 0 && iMinute < 10){
        sMinute = "0" + iMinute;
    }
    if (iMinute >= 10){
        sMinute = iMinute;
    }
    iSecond = parseInt(iTime%60);
    if (iSecond >= 0 && iSecond < 10 ){
        sSecond = "0" + iSecond;
    }
    if (iSecond >= 10 ){
        sSecond =iSecond;
    }
    sTime = sMinute.toString() + sSecond.toString();
    sBigTime = sHour.toString() + ":" + sMinute.toString() + ":" + sSecond.toString();
    /*if(iTime==65){
            if(!sound_off){
                //getSwfId('swfcontent').Pten();
            }
    } */

    if(iTime==0){
        var xnumbers = parseInt($("#numbers").html());
        //var numinfo= xnumbers+1+'正在开奖...';
        var numinfo= '<span>正在开奖...</span>';
        $("#autoinfo").html(numinfo);
        var i=0;
        $('.kick').each(function(){
            var e=$(this).children('img');
            e.prop('src','images/Ball_5/x.png');
            i++;
        });
    }
	//if(iTime<=60 && iTime>0)
    if(iTime<=40 && iTime>0){
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
        //$("#look").html("<embed width=\"0\" height=\"0\" src=\"js/1.swf\" type=\"application/x-shockwave-flash\" hidden=\"true\" />");
    }
    if(iTime<0){
        clearTimeout(fp);
        loadinfo();
    }else
    {
        iTime--;
        var t = 'time';
        if(iTime<60){
            t = 'times';
        }
        $("#sss").html(iTime);
        $('.colon > img').attr('src','images/'+t+'/10.png');
        $('.minute > span > img').eq(0).attr('src','images/'+t+'/'+sTime.substr(0,1)+'.png');
        $('.minute > span > img').eq(1).attr('src','images/'+t+'/'+sTime.substr(1,1)+'.png');
        $('.second > span > img').eq(0).attr('src','images/'+t+'/'+sTime.substr(2,1)+'.png');
        $('.second > span > img').eq(1).attr('src','images/'+t+'/'+sTime.substr(3,1)+'.png');
        $("#downtime").html(sBigTime);
        fp = setTimeout("endtime("+iTime+")",1000);
    }
}
/*
数字补0函数，当数字小于10的时候在前面自动补0
*/
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'+$num;
	}
	return $num;
}
//更新开奖号码
function auto(ball){
    $.post("class/auto_4.php", {ball : ball}, function(data)
        {
            $("#numbers").html(data.numbers);
            var openqihao = $("#open_qihao").html();
            if(auto_new == false || openqihao - data.numbers == 1){
                var numinfo='';
                numinfo = numinfo+'冠亚军和：<span>'+data.hms[0]+'</span><span>'+data.hms[1]+'</span><span>'+data.hms[2]+'</span>1V10龙虎：<span>'+data.hms[3]+'</span>2V9龙虎：<span>'+data.hms[4]+'</span>3V8龙虎：<span>'+data.hms[5]+'</span>4V7龙虎：<span>'+data.hms[6]+'</span>';
                $("#autoinfo").html(numinfo);
                var i=0;
                var fun=5;
                $('.kick').each(function(){
                    var e=$(this).children('img');
                    var nu=data.hm[i];
                    setTimeout(function(){e.prop('src','images/Ball_5/'+nu+'.png');},fun*600);
                    i++;
                    fun--;
                });
                auto_new = true;
                if(openqihao - data.numbers != 1){
                    xhm = setTimeout("auto(1)",3000);
                } else{
                    /*if(!sound_off){
                        //getSwfId('swfcontent').Pling();
                    }*/
                }
            }else{
                xhm = setTimeout("auto(1)",3000);
            }
        }, "json");
}
//投注提交
function order(){
    if($(parent.leftFrame.document).find("#userinfo").length == 0){ //没有登录
		alert("登录后才能进行此操作");
		return ;
	}

	$.post("Include/Lottery_PK.php", function(data) {
		var tt = $("input.inp1");
		var mix = 10; cou = m = 0, txt = '', c=true;
		mix = data.cp_zd;
		var max = 1000000, d=true;
		max = data.cp_zg;
		var e=true; etxt='';
		var qishu=$("#open_qihao").html();
		
		for (var i = 1; i < 17; i++){
			if(i==1){
				for(var s = 1; s < 22; s++){
					if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
						//判断最小下注金额
						if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
							c = false;
							parent.$.jBox.tip("最低下注金额："+mix+"￥");return false;
						}
						if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
							d = false;
							parent.$.jBox.tip("最高下注金额："+max+"￥");return false;
						}
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
						var odds = $("#ball_"+i+"_h" + s).html();
						var q = did(i);
						var w = wan(s);
						//做限注判断 2015-08-04
							/*$.ajax({
								type:"post",
								url:"Include/Lottery_ZE.php",
								data:{t:qishu,q:q,w:w,flag:1,type:'pk'},
								async:false,
								success:function(data2){
									data2 = eval("(" + data2 + ")")
									aDataSet = data2;
									if (parseInt($("#ball_" + i + "_" + s).val()) > aDataSet.cp_ze) {
										e = false;
										etxt = q+"@"+w+"还可以下注￥"+data2.cp_ze;
										parent.$.jBox.tip(q+"@"+w+"还可以下注￥"+data2.cp_ze);return false;
									}
								}
							});*/
						//=========================
						txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
						cou++;
					}
				}
			}else if(i>=2&&i<=11){
				for(var s = 1; s < 15; s++){
					if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
						//判断最小下注金额
						if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
							c = false;
							parent.$.jBox.tip("最低下注金额："+mix+"￥");return false;
						}
						if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
							d = false;
							parent.$.jBox.tip("最高下注金额："+max+"￥");return false;
						}
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
						var odds = $("#ball_2_h" + s).html();
						var q = did(i);
						var w = wan2(s);
						//做限注判断 2015-08-04
						/*if(!isNaN(w)){
							//q：项目 w：内容
							$.ajax({
								type:"post",
								url:"Include/Lottery_ZE.php",
								data:{t:qishu,q:q,w:w,flag:0,type:'pk'},
								async:false,
								success:function(data2){
									data2 = eval("(" + data2 + ")")
									aDataSet = data2;
									if (parseInt($("#ball_" + i + "_" + s).val()) > aDataSet.cp_ze) {
										e = false;
										etxt = q+"@"+w+"还可以下注￥"+data2.cp_ze;
										parent.$.jBox.tip(q+"@"+w+"还可以下注￥"+data2.cp_ze);return false;
									}
								}
							});
						}
						else{
							$.ajax({
								type:"post",
								url:"Include/Lottery_ZE.php",
								data:{t:qishu,q:q,w:w,flag:1,type:'pk'},
								async:false,
								success:function(data2){
									data2 = eval("(" + data2 + ")")
									aDataSet = data2;
									if (parseInt($("#ball_" + i + "_" + s).val()) > aDataSet.cp_ze) {
										e = false;
										etxt = q+"@"+w+"还可以下注￥"+data2.cp_ze;
										parent.$.jBox.tip(q+"@"+w+"还可以下注￥"+data2.cp_ze);return false;
									}
								}
							});
						}*/
						//=========================
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
							parent.$.jBox.tip("最低下注金额："+mix+"￥");return false;
						}
						if (parseInt($("#ball_" + i + "_" + s).val()) > max) {
							d = false;
							parent.$.jBox.tip("最高下注金额："+max+"￥");return false;
						}
						m = m + parseInt($("#ball_" + i + "_" + s).val());
						//获取投注项，赔率
						var odds = $("#ball_12_h" + s).html();
						var q = did(i);
						var w = wan12(s);
						//做限注判断 2015-08-04
							/*$.ajax({
								type:"post",
								url:"Include/Lottery_ZE.php",
								data:{t:qishu,q:q,w:w,flag:1,type:'pk'},
								async:false,
								success:function(data2){
									data2 = eval("(" + data2 + ")")
									aDataSet = data2;
									if (parseInt($("#ball_" + i + "_" + s).val()) > aDataSet.cp_ze) {
										e = false;
										etxt = q+"@"+w+"还可以下注￥"+data2.cp_ze;
										parent.$.jBox.tip(q+"@"+w+"还可以下注￥"+data2.cp_ze);return false;
									}
								}
							});*/
						//=========================
						txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
						cou++;
					}
				}
			}
		}
		if (!c) {parent.$.jBox.tip("最低下注金额："+mix+"￥");return false;}
		if (!d) {parent.$.jBox.tip("最高下注金额："+max+"￥");return false;}
		//if (!e) {parent.$.jBox.tip(etxt);return false;}
		if (cou <= 0) {parent.$.jBox.tip("请输入下注金额!!!");return false;}
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
        case 1 : r = '冠亚军和'; break;
        case 2 : r = '冠军'; break;
        case 3 : r = '亚军'; break;
        case 4 : r = '第三名'; break;
        case 5 : r = '第四名'; break;
        case 6 : r = '第五名'; break;
        case 7 : r = '第六名'; break;
        case 8 : r = '第七名'; break;
        case 9 : r = '第八名'; break;
        case 10 : r = '第九名'; break;
        case 11 : r = '第十名'; break;
        case 12 : r = '1V10 龙虎'; break;
        case 13 : r = '2V9 龙虎'; break;
        case 14 : r = '3V8 龙虎'; break;
        case 15 : r = '4V7 龙虎'; break;
        case 16 : r = '5V6 龙虎'; break;
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

function getSwfId(id) { //与as3交互 跨浏览器
    if (navigator.appName.indexOf("Microsoft") != -1) { 
        return window[id]; 
    } else { 
        return document[id]; 
    } 
} 