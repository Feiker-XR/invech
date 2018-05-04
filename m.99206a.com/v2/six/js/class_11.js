var time = num = hm = zw = 0;
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
			oddsInfo();
			upDateNumber(data.k_number,data.k_hm);
		}else{
			$(".bian_td_odds").html("-");
			$(".bian_td_inp").html("封盘");
			endFun();
			return false;
		}
	}, "json");
}
function oddsInfo(){
	$.post("odds/6hc.txt?"+Date.parse(new Date()), function(data)
	{
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
		$(".bian_td_odds_15").html("-");
		return false;
		}
		for(var s = 1; s<9; s++){
			var odds = oddslist.ball[11][s];
			$("#ball_11_o"+s).html(odds);
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
	$("#openNumber").html('<table width="0" border="0" cellspacing="1" cellpadding="0"><tr><td align="center">第&nbsp;'+k_number+'&nbsp;期：</td><td align="center" id="open_'+k_hm[0]+'">'+k_hm[0]+'</td><td align="center" id="open_'+k_hm[1]+'">'+k_hm[1]+'</td><td align="center" id="open_'+k_hm[2]+'">'+k_hm[2]+'</td><td align="center" id="open_'+k_hm[3]+'">'+k_hm[3]+'</td><td align="center" id="open_'+k_hm[4]+'">'+k_hm[4]+'</td><td align="center" id="open_'+k_hm[5]+'">'+k_hm[5]+'</td><td align="center">+</td><td align="center" id="open_'+k_hm[6]+'">'+k_hm[6]+'</td></tr></table>')
}
$('input:radio[name="ball_11"]').click(function() {
	$("input[name='ball[]']").attr("checked", false);
	$("input[name='ball_sx']").attr("checked", false);
	$("input[name='ball_ws']").attr("checked", false);
	$("input[name='ball_sx[]']").attr("checked", false);
	$("input[name='ball_ws[]']").attr("checked", false);
	$("input[name='ball_dm[]']").attr("checked", false);
	$("input[name='ball_tm[]']").attr("checked", false);
	$("#money").val('');
	$("input[name='type']:first").attr("checked", true);
	var oid = $('input:radio[name="ball_11"]:checked').val();
	var sid = $('input:radio[name="type"]:checked').val();
	if(oid<4){
		$("#type_2").hide();
		$("#type_3").hide();
	}else{
		$("#type_2").show();
		$("#type_3").show();
	}
	for( i=1; i<6; i++ ){
		$("#ball_"+i).hide();
	}
	$("#ball_"+sid).show();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
	$("#zuhe").html('尚未选满 '+ hm +' 个球号');
});
$('input:radio[name="type"]').click(function() {
	if($('input:radio[name="ball_11"]:checked').val()==null){
		{layer.msg('请先选择分类，在选择玩法！', 2, 3);return false;}
	}
	$("input[name='ball[]']").attr("checked", false);
	$("input[name='ball_sx']").attr("checked", false);
	$("input[name='ball_ws']").attr("checked", false);
	$("input[name='ball_sx[]']").attr("checked", false);
	$("input[name='ball_ws[]']").attr("checked", false);
	$("input[name='ball_dm[]']").attr("checked", false);
	$("input[name='ball_tm[]']").attr("checked", false);
	$("#money").val('');
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	if(typein==1){$("#zuhe").html('尚未选满 '+ hm +' 个球号');}
	if(typein>1){$("#zuhe").html(type(typein));}
	var sid = $('input:radio[name="type"]:checked').val();
	for( i=1; i<6; i++ ){
		$("#ball_"+i).hide();
	}
	$("#ball_"+sid).show();
});
$('input[type=checkbox]').click(function() {
	var checked = [];
	if($('input:radio[name="ball_11"]:checked').val()==null){
		{layer.msg('请先选择分类，在选择号码！', 2, 3);return false;}
	}
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	if(typein=='1'){
		$("input[name='ball[]']").attr('disabled', true);
		if ($("input[name='ball[]']:checked").length > num) {
			$("input[name='ball[]']:checked").attr('disabled', false);
			{layer.msg('您最多可以选择'+ num +'个号码！', 2, 3);return false;}
		} else {
			$("input[name='ball[]']").attr('disabled', false);
			if ($("input[name='ball[]']:checked").length >= hm){
				$("input[name='ball[]']:checked").each(function() {
					checked.push($(this).val());
				});
				var zh = v = ''; qw = 0;
				if(hm==4){
					for (a=0;a<checked.length-3;a++){
						for (b=a+1;b<checked.length-2;b++){
							for (c=b+1;c<checked.length-1;c++){
								for (d=c+1;d<checked.length;d++){
									qw++
									zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+'<br>';
								}
							}
						}
					}
				}
				if(hm==3){
					for (a=0;a<checked.length-2;a++){
						for (b=a+1;b<checked.length-1;b++){
							for (c=b+1;c<checked.length;c++){
								qw++
								zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+'<br>';
							}
						}
					}
				}
				if(hm==2){
					for (a=0;a<checked.length-1;a++){
						for (b=a+1;b<checked.length;b++){
							qw++
							zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+'<br>';
						}
					}
				}
				v = '组合共 <strong>'+ qw +'</strong> 组<br>';
				$("#zuhe").html(v+zh);		
			}
		}
	}
	if(typein=='2'){
		if ($("input[name='ball_sx[]']:checked").length > 2) {
			$("input[name='ball_sx[]']:checked").attr('disabled', false);
			{layer.msg('您最多可以选2组生肖！', 2, 3);return false;}
		} else {
			if ($("input[name='ball_sx[]']:checked").length == 2){
				$("input[name='ball_sx[]']:checked").each(function() {
					checked.push($(this).val());
				});
				var zh = v = ''; qw = 0;
				var sx_1=checked[0].split(",");
				var sx_2=checked[1].split(",");
				for(i=0;i<sx_1.length;i++){
					for (a=0;a<sx_2.length;a++){
						qw++
						zh += '<span>组合'+qw+'：</span>'+buling(sx_1[i])+', '+buling(sx_2[a])+'<br>';
					}
				}
				v = '组合共 <strong>'+ qw +'</strong> 组<br>';
				$("#zuhe").html(v+zh);
			}
		}
	}
	if(typein=='3'){
		if ($("input[name='ball_ws[]']:checked").length > 2) {
			$("input[name='ball_ws[]']:checked").attr('disabled', false);
			{layer.msg('您最多可以选2组尾数！', 2, 3);return false;}
		} else {
			if ($("input[name='ball_ws[]']:checked").length == 2){
				$("input[name='ball_ws[]']:checked").each(function() {
					checked.push($(this).val());
				});
				var zh = v = ''; qw = 0;
				var ws_1=checked[0].split(",");
				var ws_2=checked[1].split(",");
				for(i=0;i<ws_1.length;i++){
					for (a=0;a<ws_2.length;a++){
						qw++
						zh += '<span>组合'+qw+'：</span>'+buling(ws_1[i])+', '+buling(ws_2[a])+'<br>';
					}
				}
				v = '组合共 <strong>'+ qw +'</strong> 组<br>';
				$("#zuhe").html(v+zh);
			}
		}
	}
	if(typein=='5'){
		var zh = v = ''; qw = 0;
		var cf;
		var dmarr = [];
		var tmarr = [];
		if(hm==4){
			if ($("input[name='ball_dm[]']:checked").length > 3) {
				$("input[name='ball_dm[]']:checked").attr('disabled', false);
				{layer.msg('您最多可以选3个胆码！', 2, 3);return false;}
			} else {
				$("input[name='ball_dm[]']:checked").each(function() {
					dmarr.push($(this).val());
				});
				$("input[name='ball_tm[]']:checked").each(function() {
					tmarr.push($(this).val());
				});
				cf = arrdb(dmarr,tmarr);
				if(cf==false){
					{layer.msg('拖码不能与胆码重复！', 2, 3);return false;}
				}
				if ($("input[name='ball_dm[]']:checked").length+$("input[name='ball_tm[]']:checked").length>=hm){
					tmarr=arrdels(dmarr,tmarr);
					if(dmarr.length==3){
						for(i=0;i<tmarr.length;i++){
							for (a=0;a<dmarr.length-2;a++){
								for (b=a+1;b<dmarr.length-1;b++){
									for (c=b+1;c<dmarr.length;c++){
										qw++
										zh += '<span>组合'+qw+'：</span>'+buling(tmarr[i])+', '+buling(dmarr[a])+', '+buling(dmarr[b])+', '+buling(dmarr[c])+'<br>';
									}
								}
							}
						}
					}
					if(dmarr.length==2){
						for (a=0;a<tmarr.length-1;a++){
							for (b=a+1;b<tmarr.length;b++){
								qw++
								zh += '<span>组合'+qw+'：</span>'+buling(tmarr[a])+', '+buling(tmarr[b])+', '+buling(dmarr[0])+', '+buling(dmarr[1])+'<br>';
							}
						}
					}
					if(dmarr.length==1){
						for (a=0;a<tmarr.length-2;a++){
							for (b=a+1;b<tmarr.length-1;b++){
								for (c=b+1;c<tmarr.length;c++){
									qw++
									zh += '<span>组合'+qw+'：</span>'+buling(tmarr[a])+', '+buling(tmarr[b])+', '+buling(tmarr[c])+', '+buling(dmarr[0])+'<br>';
								}
							}
						}
					}
				}
			}
		}
		if(hm==3){
			if ($("input[name='ball_dm[]']:checked").length > 2) {
				$("input[name='ball_dm[]']:checked").attr('disabled', false);
				{layer.msg('您最多可以选2个胆码！', 2, 3);return false;}
			} else {
				$("input[name='ball_dm[]']:checked").each(function() {
					dmarr.push($(this).val());
				});
				$("input[name='ball_tm[]']:checked").each(function() {
					tmarr.push($(this).val());
				});
				cf = arrdb(dmarr,tmarr);
				if(cf==false){
					{layer.msg('拖码不能与胆码重复！', 2, 3);return false;}
				}
				if ($("input[name='ball_dm[]']:checked").length+$("input[name='ball_tm[]']:checked").length>=hm){
					tmarr=arrdels(dmarr,tmarr);
					if(dmarr.length==2){
						for(i=0;i<tmarr.length;i++){
							for (a=0;a<dmarr.length-1;a++){
								for (b=a+1;b<dmarr.length;b++){
									qw++
									zh += '<span>组合'+qw+'：</span>'+buling(tmarr[i])+', '+buling(dmarr[a])+', '+buling(dmarr[b])+'<br>';
								}
							}
						}
					}
					if(dmarr.length==1){
						for (a=0;a<tmarr.length-1;a++){
							for (b=a+1;b<tmarr.length;b++){
								qw++
								zh += '<span>组合'+qw+'：</span>'+buling(tmarr[a])+', '+buling(tmarr[b])+', '+buling(dmarr[0])+'<br>';
							}
						}
					}
				}
			}
		}
		if(hm==2){
			if ($("input[name='ball_dm[]']:checked").length > 3) {
				$("input[name='ball_dm[]']:checked").attr('disabled', false);
				{layer.msg('您最多可以选3个胆码！', 2, 3);return false;}
			} else {
				$("input[name='ball_dm[]']:checked").each(function() {
					dmarr.push($(this).val());
				});
				$("input[name='ball_tm[]']:checked").each(function() {
					tmarr.push($(this).val());
				});
				cf = arrdb(dmarr,tmarr);
				if(cf==false){
					{layer.msg('拖码不能与胆码重复！', 2, 3);return false;}
				}
				if ($("input[name='ball_dm[]']:checked").length+$("input[name='ball_tm[]']:checked").length>=hm){
					tmarr=arrdels(dmarr,tmarr);
					for (a=0;a<dmarr.length;a++){
						for (b=0;b<tmarr.length;b++){
							qw++
							zh += '<span>组合'+qw+'：</span>'+buling(tmarr[b])+', '+buling(dmarr[a])+'<br>';
						}
					}
				}
			}
		}
		if(qw>286){
			{layer.msg('最多选择286组！', 2, 3);return false;}
		}
		v = '组合共 <strong>'+ qw +'</strong> 组<br>';
		$("#zuhe").html(v+zh);
	}
});
$('input[type=radio]').click(function() {
	if($('input:radio[name="ball_11"]:checked').val()==null){
		{layer.msg('请先选择分类，在选择号码！', 2, 3);return false;}
	}
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	var sx = ws = '';
	if($('input:radio[name="ball_sx"]:checked').val()!=null){
		sx = $('input:radio[name="ball_sx"]:checked').val();
	}
	if($('input:radio[name="ball_ws"]:checked').val()!=null){
		ws = $('input:radio[name="ball_ws"]:checked').val();
	}
	if(sx!='' && ws!=''){
		if(typein=='4'){
			var zh = v = ''; qw = 0;
			var ws = arrdel(sx,ws);
			sx=sx.split(",");
			if(hm==4){
				for(i=0;i<sx.length;i++){
					for (a=0;a<ws.length-2;a++){
						for (b=a+1;b<ws.length-1;b++){
							for (c=b+1;c<ws.length;c++){
								qw++
								zh += '<span>组合'+qw+'：</span>'+buling(ws[a])+', '+buling(ws[b])+', '+buling(ws[c])+', '+buling(sx[i])+'<br>';
							}
						}
					}
				}
			}
			if(hm==3){
				for(i=0;i<sx.length;i++){
					for (a=0;a<ws.length-1;a++){
						for (b=a+1;b<ws.length;b++){
							qw++
							zh += '<span>组合'+qw+'：</span>'+buling(ws[a])+', '+buling(ws[b])+', '+buling(sx[i])+'<br>';
						}
					}
				}
			}
			if(hm==2){
				for(i=0;i<sx.length;i++){
					for (a=0;a<ws.length;a++){
						qw++
						zh += '<span>组合'+qw+'：</span>'+buling(ws[a])+', '+buling(sx[i])+'<br>';
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
	if($('input:radio[name="ball_11"]:checked').val()==null){
		{layer.msg('请先选择分类，在选择号码！', 2, 3);return false;}
	}
	if($('input:radio[name="type"]:checked').val()==null){
		{layer.msg('请先选择玩法，在选择号码！', 2, 3);return false;}
	}
	var typein = parseInt($('input:radio[name="type"]:checked').val());
	if(typein=='1'){
		if ($("input[name='ball[]']:checked").length < hm){
		{layer.msg('请至少选择 '+ hm +' 个号码！', 2, 3);return false;}
		}
		var checked = [];
		$("input[name='ball[]']:checked").each(function() {
			checked.push($(this).val());
		});
		for ( i = 0 ; i < checked.length ; i++ ){  
			txt = txt + checked[i] + ',';  
		}
		txt = txt.substring(0,txt.lastIndexOf(','));
	}
	if(typein=='2'){
		if ($("input[name='ball_sx[]']:checked").length < 2){
		{layer.msg('请至少选择 2 组生肖！', 2, 3);return false;}
		}
		var checked = [];
		$("input[name='ball_sx[]']:checked").each(function() {
			checked.push($(this).val());
		});
		txt = txt + checked[0] + ' X ' + checked[1];  
	}
	if(typein=='3'){
		if ($("input[name='ball_ws[]']:checked").length < 2){
		{layer.msg('请至少选择 2 组尾数！', 2, 3);return false;}
		}
		var checked = [];
		$("input[name='ball_ws[]']:checked").each(function() {
			checked.push($(this).val());
		});
		txt = txt + checked[0] + ' X ' + checked[1];  
	}
	if(typein=='4'){
		if ($("input[name='ball_sx']:checked").length < 1){
		{layer.msg('请至少选择 1 组生肖！', 2, 3);return false;}
		}
		if ($("input[name='ball_ws']:checked").length < 1){
		{layer.msg('请至少选择 1 组尾数！', 2, 3);return false;}
		}
		var sx = $("input[name='ball_sx']:checked").val();
		var ws = $("input[name='ball_ws']:checked").val();
		ws = arrdel(sx,ws);
		txt = txt + sx + ' X ' + ws;
	}
	if(typein=='5'){
		if ($("input[name='ball_dm[]']:checked").length < 1){
		{layer.msg('请至少选择 1 个胆码！', 2, 3);return false;}
		}
		if( hm > 2 ){
			if ($("input[name='ball_dm[]']:checked").length+$("input[name='ball_tm[]']:checked").length < hm){
				{layer.msg('胆码+拖码至少选择'+hm+'个号码！', 2, 3);return false;}
			}
		}else{
			if ($("input[name='ball_tm[]']:checked").length < 1){
				{layer.msg('请至少选择 1 个拖码！', 2, 3);return false;}
			}
		}
		var dm = [];
		var tm = [];
		var dms = tms = '';
		$("input[name='ball_dm[]']:checked").each(function() {
			dm.push($(this).val());
		});
		$("input[name='ball_tm[]']:checked").each(function() {
			tm.push($(this).val());
		});
		for ( i = 0 ; i < dm.length ; i++ ){  
			dms = dms + dm[i] + ',';  
		}
		for ( i = 0 ; i < tm.length ; i++ ){  
			tms = tms + tm[i] + ',';  
		}
		dms = dms.substring(0,dms.lastIndexOf(','));
		tms = tms.substring(0,tms.lastIndexOf(','));
		txt = txt + dms + ' X ' + tms; 
	}
	var bid = parseInt($('input:radio[name="ball_11"]:checked').val());
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
	$('#time_show').html(hour+'&nbsp;时'+minute+'&nbsp;分');
	intDiff--;
	var closeTime = setTimeout("timer("+intDiff+")",1000);
} 
function buling (num){
	if(parseInt(num)<10){
		return 0+num;
	}else{
		return num;
	}
}
function hnum (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = 4; break;
		case 2 : r = 3; break;
		case 3 : r = 3; break;
		case 4 : r = 2; break;
		case 5 : r = 2; break;
		case 6 : r = 2; break;
	}
	return r;
}
function nums (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = 10; break;
		case 2 : r = 10; break;
		case 3 : r = 10; break;
		case 4 : r = 10; break;
		case 5 : r = 10; break;
		case 6 : r = 10; break;
	}
	return r;
}
function wan (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '四全中'; break;
		case 2 : r = '三全中'; break;
		case 3 : r = '三中二'; break;
		case 4 : r = '二全中'; break;
		case 5 : r = '二中特'; break;
		case 6 : r = '特串'; break;
	}
	return r;
}
function type (type)
{
	var r = '';
	switch (type)
	{
		case 2 : r = '请选择 2组 生肖'; break;
		case 3 : r = '请选择 2组 尾数'; break;
		case 4 : r = '请选择 主肖 与 拖尾'; break;
		case 5 : r = '请选择 胆码 与 拖码'; break;
	}
	return r;
}
function arrdel (sx,ws){
	var arr1=sx.split(",");
	var arr2=ws.split(",");
	var cccc='';
	var arr3=[];
	for(var s in arr1){
		for(var x in arr2){
			if(arr1[s]==arr2[x]){
				cccc=arr1[s];
			}
		}
	}
	for(var t in arr2){
		if(cccc!=arr2[t]){
			arr3.push(arr2[t]);
		}
	}
	return arr3;
}
function arrdels (arr1,arr2){
	var cccc='';
	var arr3=[];
	for(var s in arr1){
		for(var x in arr2){
			if(arr1[s]==arr2[x]){
				cccc=arr1[s];
			}
		}
	}
	for(var t in arr2){
		if(cccc!=arr2[t]){
			arr3.push(arr2[t]);
		}
	}
	return arr3;
}
function arrdb (arr1,arr2){
	var cccc = true ;
	for(var s in arr1){
		for(var x in arr2){
			if(arr1[s]==arr2[x]){
				cccc = false;
			}
		}
	}
	return cccc;
}