var time = hm = zw = 0;
var num  = 1;
var odds = '';
var zuheinfo = '';
//限制只能输入1-9纯数字 
function digitOnly ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
}
function endFun() {
	layer.msg('香港六合彩已经封盘，请留意本公司开盘公告！', 36000, 3);
}
function loadInfo(){
	$.post("/six/time?"+Date.parse(new Date()), function(data)
	{
		if(data.close>0){
			$("#open_qihao").html(data.number);
			timer(data.close);
			upDateNumber(data.k_number,data.k_hm);
		}else{
			$(".bian_td_odds").html("-");
			$(".bian_td_gg").html("封盘");
			endFun();
			return false;
		}
	}, "json");
}
function oddsInfo(i){
	$.get("/odds/6hc.txt?"+Date.parse(new Date()), function(data)
	{
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
		$(".bian_td_odds").html("-");
		return false;
		}
		for(var s = 1; s<13; s++){
			var odds = oddslist.ball[13][s+i];
			$("#ball_13_o"+s).html(odds);
		}
		loadInput();
	}, "json");
}
function loadInput(){
	var b = "money";
	var n = "下注金额：<input name=\""+b+"\" id=\""+b+"\" class=\"inp1s\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1ms'\" onblur=\"this.className='inp1s';\" type=\"text\" maxLength=\"6\"/>"
	if($("#moneys").html()=='&nbsp;'){
		$("#moneys").html(n);
	}
}
function upDateNumber(k_number,k_hm){
	$("#openNumber").html('<table width="0" border="0" cellspacing="1" cellpadding="0"><tr><td align="center">第&nbsp;'+k_number+'&nbsp;期开奖号码：</td><td align="center" id="open_'+k_hm[0]+'">'+k_hm[0]+'</td><td align="center" id="open_'+k_hm[1]+'">'+k_hm[1]+'</td><td align="center" id="open_'+k_hm[2]+'">'+k_hm[2]+'</td><td align="center" id="open_'+k_hm[3]+'">'+k_hm[3]+'</td><td align="center" id="open_'+k_hm[4]+'">'+k_hm[4]+'</td><td align="center" id="open_'+k_hm[5]+'">'+k_hm[5]+'</td><td align="center">+</td><td align="center" id="open_'+k_hm[6]+'">'+k_hm[6]+'</td></tr></table>')
}
$('input:radio[name="ball_13"]').click(function() {
	$("input[name='ball[]']").attr("checked", false);
	var oid = $('input:radio[name="ball_13"]:checked').val();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
	odds = o(parseInt(oid));
	oddsInfo(odds);
	$("#zuhe").html('尚未选满 '+ hm +' 个生肖');
});
$('input[type=checkbox]').click(function() {
	var checked = [];
	if($('input:radio[name="ball_13"]:checked').val()==null){
		{layer.msg('请先选择分类，在选择生肖！', 2, 3);return false;}
	}
	$("input[name='ball[]']").attr('disabled', true);
	if ($("input[name='ball[]']:checked").length > num) {
		$("input[name='ball[]']:checked").attr('disabled', false);
		{layer.msg('您最多可以选择'+ num +'个生肖！', 2, 3);return false;}
	} else {
		$("input[name='ball[]']").attr('disabled', false);
		if ($("input[name='ball[]']:checked").length >= hm){
			$("input[name='ball[]']:checked").each(function() {
				checked.push($(this).val());
			});
			var zh = v = ''; qw = 0;
			if(hm==2){
				for (a=0;a<checked.length-1;a++){
					for (b=a+1;b<checked.length;b++){
						qw++
						zh += '<span>组合'+qw+'：</span>'+name(checked[a])+', '+name(checked[b])+'<br>';
					}
				}
			}
			if(hm==3){
				for (a=0;a<checked.length-2;a++){
					for (b=a+1;b<checked.length-1;b++){
						for (c=b+1;c<checked.length;c++){
							qw++
							zh += '<span>组合'+qw+'：</span>'+name(checked[a])+', '+name(checked[b])+', '+name(checked[c])+'<br>';
						}
					}
				}
			}
			if(hm==4){
				for (a=0;a<checked.length-3;a++){
					for (b=a+1;b<checked.length-2;b++){
						for (c=b+1;c<checked.length-1;c++){
							for (d=c+1;d<checked.length;d++){
								qw++
								zh += '<span>组合'+qw+'：</span>'+name(checked[a])+', '+name(checked[b])+', '+name(checked[c])+', '+name(checked[d])+'<br>';
							}
						}
					}
				}
			}
			if(hm==5){
				for (a=0;a<checked.length-4;a++){
					for (b=a+1;b<checked.length-3;b++){
						for (c=b+1;c<checked.length-2;c++){
							for (d=c+1;d<checked.length-1;d++){
								for (e=d+1;e<checked.length;e++){
									qw++
									zh += '<span>组合'+qw+'：</span>'+name(checked[a])+', '+name(checked[b])+', '+name(checked[c])+', '+name(checked[c])+', '+name(checked[e])+'<br>';
								}
							}
						}
					}
				}
			}
			v = '组合共 <strong>'+ qw +'</strong> 组<br>';
			$("#zuhe").html(v+zh);		
		}
	}
});
//投注提交
function order(){
	var cou = m = 0, txt = balls = '', arr = new Array(); c=true;
	if ($("#money").val() != "" && $("#money").val() != null) {
		m = parseInt($("#money").val());
	}
	if (m <= 0) {layer.msg('请输入下注金额！', 2, 3);return false;}
	if($('input:radio[name="ball_13"]:checked').val()==null){
		{layer.msg('请先选择分类，在选择生肖！', 2, 3);return false;}
	}
	if ($("input[name='ball[]']:checked").length < hm){
		{layer.msg('请至少选择 '+ hm +' 个生肖！', 2, 3);return false;}
	}
	var checked = [];
	$("input[name='ball[]']:checked").each(function() {
		checked.push($(this).val());
	});
	for ( i = 0 ; i < checked.length ; i++ ){  
		txt = txt + name(checked[i]) + ',';  
    }
	txt = txt.substring(0,txt.lastIndexOf(','));
	
	var bid = parseInt($('input:radio[name="ball_13"]:checked').val());
	balls = wan(bid);
	var t = balls + " 确定下注吗？\n\n下注明细如下：\n\n";
	var e = "\n\n单组注金 ￥"+m+"，组合共 "+ qw +" 组，总注金 ￥"+m*qw;
	txt = t + txt + e;
	var ok = confirm(txt);
	if (ok)
	document.orders.submit()
	document.orders.reset()
}
function timer(intDiff){
	var day=0,
		hour=0,
		minute=0,
		second=0;//时间默认值		
	if(intDiff > 0){
		day = Math.floor(intDiff / (60 * 60 * 24));
		hour = Math.floor(intDiff / 3600);
		minute = Math.floor(intDiff / 60) - (hour * 60);
		second = Math.floor(intDiff) - (hour * 60 * 60) - (minute * 60);
	}else{
		clearTimeout(odds);
		$(".bian_td_odds").html("-");
		$(".bian_td_inp").html("封盘");
		clearTimeout(closeTime);
		endFun();
	}
	if (hour <= 9) hour = '0' + hour;
	if (minute <= 9) minute = '0' + minute;
	if (second <= 9) second = '0' + second;
	$('#hour_show').html(hour+'&nbsp;时');
	$('#minute_show').html(minute+'&nbsp;分');
	$('#second_show').html(second+'&nbsp;秒');
	intDiff--;
	var closeTime = setTimeout("timer("+intDiff+")",1000);
} 
function hnum (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = 2; break;
		case 2 : r = 3; break;
		case 3 : r = 4; break;
		case 4 : r = 5; break;
	}
	return r;
}
function nums (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = 6; break;
		case 2 : r = 6; break;
		case 3 : r = 6; break;
		case 4 : r = 6; break;
	}
	return r;
}
function o (type)
{
	var r = 0;
	switch (type)
	{
		case 1 : r = 0; break;
		case 2 : r = 12; break;
		case 3 : r = 24; break;
		case 4 : r = 36; break;
	}
	return r;
}
function wan (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '二肖连中'; break;
		case 2 : r = '三肖连中'; break;
		case 3 : r = '四肖连中'; break;
		case 4 : r = '五肖连中'; break;
	}
	return r;
}
function name (type)
{
	var r = '';
	switch (type)
	{
		case '1' : r = '鼠'; break;
		case '2' : r = '牛'; break;
		case '3' : r = '虎'; break;
		case '4' : r = '兔'; break;
		case '5' : r = '龙'; break;
		case '6' : r = '蛇'; break;
		case '7' : r = '马'; break;
		case '8' : r = '羊'; break;
		case '9' : r = '猴'; break;
		case '10' : r = '鸡'; break;
		case '11' : r = '狗'; break;
		case '12' : r = '猪'; break;
	}
	return r;
}