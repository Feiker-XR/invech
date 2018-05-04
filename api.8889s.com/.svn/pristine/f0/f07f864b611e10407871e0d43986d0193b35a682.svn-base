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
	$.get("/odds/6hc.txt?"+Date.parse(new Date()), function(data)
	{
		var oddslist = data.oddslist;
		if (oddslist == null || oddslist == "") {
		$(".bian_td_odds_15").html("-");
		return false;
		}
		for(var s = 1; s<9; s++){
			var odds = oddslist.ball[15][s];
			$("#ball_15_o"+s).html(odds);
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
$('input:radio[name="ball_15"]').click(function() {
	$("input[name='ball[]']").attr("checked", false);
	var oid = $('input:radio[name="ball_15"]:checked').val();
	num = nums(parseInt(oid));
	hm = hnum(parseInt(oid));
	$("#zuhe").html('尚未选满 '+ hm +' 个球号');
});
$('input[type=checkbox]').click(function() {
	var checked = [];
	if($('input:radio[name="ball_15"]:checked').val()==null){
		{layer.msg('请先选择分类，在选择号码！', 2, 3);return false;}
	}
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
			if(hm==5){
				for (a=0;a<checked.length-4;a++){
					for (b=a+1;b<checked.length-3;b++){
						for (c=b+1;c<checked.length-2;c++){
							for (d=c+1;d<checked.length-1;d++){
								for (e=d+1;e<checked.length;e++){
									qw++
									zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+'<br>';
								}
							}
						}
					}
				}
			}
			if(hm==6){
				for (a=0;a<checked.length-5;a++){
					for (b=a+1;b<checked.length-4;b++){
						for (c=b+1;c<checked.length-3;c++){
							for (d=c+1;d<checked.length-2;d++){
								for (e=d+1;e<checked.length-1;e++){
									for (f=e+1;f<checked.length;f++){
										qw++
										zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+'<br>';
									}
								}
							}
						}
					}
				}
			}
			if(hm==7){
				for (a=0;a<checked.length-6;a++){
					for (b=a+1;b<checked.length-5;b++){
						for (c=b+1;c<checked.length-4;c++){
							for (d=c+1;d<checked.length-3;d++){
								for (e=d+1;e<checked.length-2;e++){
									for (f=e+1;f<checked.length-1;f++){
										for (g=f+1;g<checked.length;g++){
											qw++
											zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+'<br>';
										}
									}
								}
							}
						}
					}
				}
			}
			if(hm==8){
				for (a=0;a<checked.length-7;a++){
					for (b=a+1;b<checked.length-6;b++){
						for (c=b+1;c<checked.length-5;c++){
							for (d=c+1;d<checked.length-4;d++){
								for (e=d+1;e<checked.length-3;e++){
									for (f=e+1;f<checked.length-2;f++){
										for (g=f+1;g<checked.length-1;g++){
											for (h=g+1;h<checked.length;h++){
												qw++
												zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+'<br>';
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if(hm==9){
				for (a=0;a<checked.length-8;a++){
					for (b=a+1;b<checked.length-7;b++){
						for (c=b+1;c<checked.length-6;c++){
							for (d=c+1;d<checked.length-5;d++){
								for (e=d+1;e<checked.length-4;e++){
									for (f=e+1;f<checked.length-3;f++){
										for (g=f+1;g<checked.length-2;g++){
											for (h=g+1;h<checked.length-1;h++){
												for (i=h+1;i<checked.length;i++){
													qw++
													zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+', '+buling(checked[i])+'<br>';
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if(hm==10){
				for (a=0;a<checked.length-9;a++){
					for (b=a+1;b<checked.length-8;b++){
						for (c=b+1;c<checked.length-7;c++){
							for (d=c+1;d<checked.length-6;d++){
								for (e=d+1;e<checked.length-5;e++){
									for (f=e+1;f<checked.length-4;f++){
										for (g=f+1;g<checked.length-3;g++){
											for (h=g+1;h<checked.length-2;h++){
												for (i=h+1;i<checked.length-1;i++){
													for (j=i+1;j<checked.length;j++){
														qw++
														zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+', '+buling(checked[i])+', '+buling(checked[j])+'<br>';
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if(hm==11){
				for (a=0;a<checked.length-10;a++){
					for (b=a+1;b<checked.length-9;b++){
						for (c=b+1;c<checked.length-8;c++){
							for (d=c+1;d<checked.length-7;d++){
								for (e=d+1;e<checked.length-6;e++){
									for (f=e+1;f<checked.length-5;f++){
										for (g=f+1;g<checked.length-4;g++){
											for (h=g+1;h<checked.length-3;h++){
												for (i=h+1;i<checked.length-2;i++){
													for (j=i+1;j<checked.length-1;j++){
														for (k=j+1;k<checked.length;k++){
															qw++
															zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+', '+buling(checked[i])+', '+buling(checked[j])+', '+buling(checked[k])+'<br>';
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if(hm==12){
				for (a=0;a<checked.length-11;a++){
					for (b=a+1;b<checked.length-10;b++){
						for (c=b+1;c<checked.length-9;c++){
							for (d=c+1;d<checked.length-8;d++){
								for (e=d+1;e<checked.length-7;e++){
									for (f=e+1;f<checked.length-6;f++){
										for (g=f+1;g<checked.length-5;g++){
											for (h=g+1;h<checked.length-4;h++){
												for (i=h+1;i<checked.length-3;i++){
													for (j=i+1;j<checked.length-2;j++){
														for (k=j+1;k<checked.length-1;k++){
															for (l=k+1;l<checked.length;l++){
																qw++
																zh += '<span>组合'+qw+'：</span>'+buling(checked[a])+', '+buling(checked[b])+', '+buling(checked[c])+', '+buling(checked[d])+', '+buling(checked[e])+', '+buling(checked[f])+', '+buling(checked[g])+', '+buling(checked[h])+', '+buling(checked[i])+', '+buling(checked[j])+', '+buling(checked[k])+', '+buling(checked[l])+'<br>';
															}
														}
													}
												}
											}
										}
									}
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
	if($('input:radio[name="ball_15"]:checked').val()==null){
		{layer.msg('请先选择分类，在选择号码！', 2, 3);return false;}
	}
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
	
	var bid = parseInt($('input:radio[name="ball_15"]:checked').val());
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
		case 1 : r = 5; break;
		case 2 : r = 6; break;
		case 3 : r = 7; break;
		case 4 : r = 8; break;
		case 5 : r = 9; break;
		case 6 : r = 10; break;
		case 7 : r = 11; break;
		case 8 : r = 12; break;
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
		case 4 : r = 11; break;
		case 5 : r = 12; break;
		case 6 : r = 13; break;
		case 7 : r = 13; break;
		case 8 : r = 14; break;
	}
	return r;
}
function wan (type)
{
	var r = '';
	switch (type)
	{
		case 1 : r = '五不中'; break;
		case 2 : r = '六不中'; break;
		case 3 : r = '七不中'; break;
		case 4 : r = '八不中'; break;
		case 5 : r = '九不中'; break;
		case 6 : r = '十不中'; break;
		case 7 : r = '十一不中'; break;
		case 8 : r = '十二不中'; break;
	}
	return r;
}