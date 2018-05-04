var bool = auto_new = false;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh ='';
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
	$.get("/lottery/odds/gid/gsf/", function(data)
		{
			if(data.opentime>0 && data.endtime > 0){
				$("#open_qihao").html(data.number+"期");
				ball_odds = data.oddslist;
				loadodds(data.oddslist);
				endtime(data.opentime,data.endtime);
				auto(1);
			}else if(data.endtime <= 0 && data.opentime>0){
				$("#open_qihao").html(data.number+"期");
				ball_odds = data.oddslist;
				$(".bian_td_odds").html("-");
				$(".bian_td_inp").html("封盘");
				endtime(data.opentime,data.endtime);
				auto(1);
			}else{
				$(".bian_td_odds").html("-");
				$(".bian_td_inp").html("封盘");
				$("#autoinfo").html("已经封盘，请稍后进行投注！");
				alert('当前彩票已经封盘，请稍后再进行下注！<br><br>广东快乐十分开盘时间为：09:00 - 23:00');
				//$.jBox.alert('广东快乐十分暂停销售！<br><br>尊敬的会员，由于广东快乐十分官方进行升级，暂时停止销售！<br><br>具体恢复时间请关注广东福利彩票中心！', '提示');
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
	for(var i = 1; i<10; i++){
		if(i==9){
			for(var s = 1; s<9; s++){
				odds = oddslist.ball[i][s];
				$("#ball_"+i+"_h"+s).html(odds);
				loadinput(i, s);
			}
		}else if(i>=1 && i<9){
			for(var s = 1; s<36; s++){
				odds = oddslist.ball[i][s];
				$("#ball_1_h"+s).html(odds);
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
	for(var s = 1; s<36; s++){

		//alert("#ball_1_h"+s);
		odds = ball_odds.ball[ball][s];
		$("#ball_1_h"+s).html(odds);

		loadinput(ball , s);
	} 
	for( var i = 0; i < 8; i++){
		if(i == ball-1){
		//$('#menu_hm > a').eq(i).addClass("cur");
		}else{
		//$('#menu_hm > a').eq(i).removeClass("cur");
		}
	}
	
}

function hm_odds_new(type,obj,ball){
	if(type == 1){
		$("#touzhutables").html(odds_tabs_1);
	}else if(type == 2){
		$("#touzhutables").html(odds_tabs_2);
		
	}

	$('#menu_hm > a').removeClass("cur");
	$(obj).addClass("cur");

	if(ball>0){
		//alert(ball);
		hm_odds(ball);
	}else{

		loadinfo();
	}
	//

	init_tables_touzhu_click();
	$(".sp-btn span.cur").click();
}

//更新投注框
function loadinput(ball , s){
	b = "ball_"+ball+"_"+s;
	n = "<input name=\""+b+"\" id=\""+b+"\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"5\"/>"
	if(ball<9){
		$("#ball_"+ball+"_t"+s).html(n);
		if($("#ball_"+ball+"_t"+s).length == 0){
			$("#ball_1_t"+s).html(n);
		}
	}else if(ball==9){
		$("#ball_"+ball+"_t"+s).html(n);
	}
}
//封盘时间
function endtime(iTime,endtime)
{
	var iHour,iMinute,iSecond;
    var sHour,sMinute="",sSecond="",sTime="";
	fengpansTime = endtime == 'undefined' || endtime == null ?  iTime - 60 : endtime;
	iHour = parseInt(iTime/3600);
	if (iHour == 0){
		sHour = "00";
	}
	if (iHour > 0 && iHour < 10){
		sHour = "0" + iHour;
	}
	if (iHour > 10){
		sHour = iHour;
	}
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
    sTime= sMinute.toString() + sSecond.toString();
    if(iTime==0){
    	
		$("#look").html('<embed width="0" height="0" src="js/2.swf" type="application/x-shockwave-flash" hidden="true" />');
		var xnumbers = parseInt($("#numbers").html());
		//var numinfo= xnumbers+1+'正在开奖...';
		var numinfo= '<span>正在开奖...</span>';
		$("#autoinfo").html(numinfo);
		var i=0;
		$('.kick b').each(function(){
			//var e=$(this).children('img');
			//e.prop('src','images/open_2/x.gif');
			$(this).html('?');
			i++;
		});
    }
	if(fengpansTime==0){
//		playRing(5);
		$(".bian_td_odds").html("-");
		$(".bian_td_inp").html("封盘");
		$("#look").html('<embed width="0" height="0" src="js/1.swf" type="application/x-shockwave-flash" hidden="true" />');
    }
	if(iTime<0){
		clearTimeout(fp);
		loadinfo();
    }else
    {
		
		var t = 'time';
		if((fengpansTime <= 0 && (fengpansTime !== 'undefined' || fengpansTime !== null))|| ((fengpansTime == 'undefined' || fengpansTime == null) && iTime<60)){
			t = 'times';
			$("#fengpan").html('已封盘');
		}else{
			var fpminute = parseInt(fengpansTime/60)+'';
			if(fpminute.length == 1) fpminute='0'+fpminute;

			var fptime = (fengpansTime%60)+'';
			if(fptime.length == 1) fptime='0'+fptime;

			$("#fengpan").html(fpminute+':'+fptime);
		}
		iTime--;
		fengpansTime --;
		$("#sss").html(iTime);
		$("#kaijian").html(sTime.substr(0,1)+sTime.substr(1,1)+':'+sTime.substr(2,1)+sTime.substr(3,1));
		fp = setTimeout("endtime("+iTime+","+fengpansTime+")",1000);
    }
}
//更新开奖号码
function auto(ball){
	$.get("/lottery/auto/gid/gsf", {ball : ball}, function(data)
		{
			$("#numbers").html(data.numbers);
			var openqihao = $("#open_qihao").html().replace("期","");
			if(auto_new == false || openqihao - data.numbers == 1){
//              playRing(1);
				var numinfo='';
				numinfo = numinfo+'总和：<font>'+data.hms[0]+'</font> | <font>'+data.hms[1]+'</font> | <font>'+data.hms[2]+'</font> | <font>'+data.hms[3]+'</font> | 龙虎:<font>'+data.hms[4]+'</font>';
				$("#autoinfo").html(numinfo);
				var i=0;
				var fun=8;
				$('.kick b').each(function(){
					var this_=$(this);
					var nu=data.hm[i];
					setTimeout(function(){
						this_.html(nu);
					},fun*600);
					i++;
					fun--;
				});
				auto_new = true;
				if(openqihao - data.numbers != 1){xhm = setTimeout("auto(1)",3000);}
			}else{
				xhm = setTimeout("auto(1)",3000);
			}
			var auto_top = '<table width="100%" border="0" cellspacing="1" cellpadding="0" class="clbian"><tr class="clbian_tr_title"><td colspan="2"><a href="/openlist/gdklsf" target="_blank">更多开奖结果</a></td></tr>';
			var $auto_top=new Array(),$i=0;
			for (var key in data.hmlist){$auto_top[$i]=[key,data.hmlist[key]];$i++;}
			//for(var i=$auto_top.length-1;i>=0;i--){
$auto_top.sort(function(a,b){return b[0] - a[0];});
			$auto_top.sort(function(a,b){return b[0] - a[0];});
			for(var i=0; i<$auto_top.length;i++){
				if(i==5) break;
				//alert(key);
				auto_top = auto_top+'<tr class="clbian_tr_txt" style="'+( i%2==1 ? 'background:#efefef;' : '' )+'"><td class="qihao" colspan="2">'+$auto_top[i][0]+'期<br><font color="#c33">'+$auto_top[i][1]+'</font></td></tr>'
			}
			auto_top = auto_top+'</table>'
			$("#auto_list").html(auto_top);
		}, "json");
		$.post("/lottery/changlong.html",{code:'广东快乐十分'},function(data){
		if(data == false){
			$("#cl_list").html("<tr><td></td></tr>");
		}else{
			$html = '<table width="100%" border="0" cellspacing="1" cellpadding="0" class="clbian">';
			for (var i=0;i<data.length;i++){
				$html += "<tr>";
				$html+= "<td colspan='2'>"+data[i].title + ':<font color="red">'+ data[i].num+"</font>期</td>";
				$html +="</tr>";
			}
			$html +="</table>";
			
		}
		$("#cl_list").html($html);
	},"json");
}
//投注提交
var is_ordering = false;
function order(pageurl){

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

	if($(".sp-btn span[name=kuaijie]").hasClass("cur")){

		var touzhu_je = $(".inputje").val();
		$(".bian_td_inp.checked").find("input").val(touzhu_je);
		if($(".bian_td_inp.checked").find("input").length == 0){
			alert("请选择注单!!!");return false;
		}
	}
	var tt = $("input.inp1");
	var mix = 10; cou = m = 0, txt = '', c=true;
	for (var i = 1; i < 10; i++){
		if(i==9){
			for(var s = 1; s < 9; s++){
				if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
					//判断最小下注金额
					if (parseInt($("#ball_" + i + "_" + s).val()) < mix) {
						c = false;
					}
					m = m + parseInt($("#ball_" + i + "_" + s).val());
					//获取投注项，赔率
					var odds = $("#ball_"+i+"_h" + s).html();
					var q = did(i);
					var w = wan9(s);
					txt = txt + q + '[' + w +'] @ ' + odds + ' x ￥' + parseInt($("#ball_" + i + "_" + s).val()) + '\n';
					cou++;
				}
			}
		}else{
			for(var s = 1; s < 36; s++){
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
	//if (!c) {$.jBox.tip("最低下注金额："+mix+"￥");return false;}
	//if (cou <= 0) {$.jBox.tip("请输入下注金额!!!");return false;}

	if (!c) {alert("最低下注金额："+mix+"￥");return false;}
	if (cou <= 0) {alert("请输入下注金额!!!");return false;}
	var t = "共 ￥"+m+" / "+cou+" 笔，确定下注吗？\n\n下注明细如下：\n\n";
	txt = t + txt;
	var ok = confirm(txt);
	if (ok)
	document.orders.submit()
	document.orders.reset()
	$("table[name=touzhu_table] td").removeClass("checked");
	var count=$("table[name=touzhu_table] td.bian_td_inp.checked").length;
    $(".spanxuanzhong").find("font").html(count);
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
		case 6 : r = '第六球'; break;
		case 7 : r = '第七球'; break;
		case 8 : r = '第八球'; break;
		case 9 : r = '总和、龙虎'; break;
	}
	return r;
}
//读取玩法
function wan (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '01'; break;
		case 2 : r = '02'; break;
		case 3 : r = '03'; break;
		case 4 : r = '04'; break;
		case 5 : r = '05'; break;
		case 6 : r = '06'; break;
		case 7 : r = '07'; break;
		case 8 : r = '08'; break;
		case 9 : r = '09'; break;
		case 10 : r = '10'; break;
		case 11 : r = '11'; break;
		case 12 : r = '12'; break;
		case 13 : r = '13'; break;
		case 14 : r = '14'; break;
		case 15 : r = '15'; break;
		case 16 : r = '16'; break;
		case 17 : r = '17'; break;
		case 18 : r = '18'; break;
		case 19 : r = '19'; break;
		case 20 : r = '20'; break;
		case 21 : r = '大'; break;
		case 22 : r = '小'; break;
		case 23 : r = '单'; break;
		case 24 : r = '双'; break;
		case 25 : r = '尾大'; break;
		case 26 : r = '尾小'; break;
		case 27 : r = '合数单'; break;
		case 28 : r = '合数双'; break;
		case 29 : r = '东'; break;
		case 30 : r = '南'; break;
		case 31 : r = '西'; break;
		case 32 : r = '北'; break;
		case 33 : r = '中'; break;
		case 34 : r = '发'; break;
		case 35 : r = '白'; break;
	}
	return r;
}
//读取玩法
function wan9 (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '总和大'; break;
		case 2 : r = '总和小'; break;
		case 3 : r = '总和单'; break;
		case 4 : r = '总和双'; break;
		case 5 : r = '总和尾大'; break;
		case 6 : r = '总和尾小'; break;
		case 7 : r = '龙'; break;
		case 8 : r = '虎'; break;
	}
	return r;
}

//function playRing(num) {
//  var ua = navigator.userAgent.toLowerCase();
//  if(num==1){
//      var ring = '/lottery/js/RING_01.wav';
//  }else if(num==5){
//      var ring = '/lottery/js/RING_05.wav';
//  }else{
//      return;
//  }
//	var c = $('#playringdiv');
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