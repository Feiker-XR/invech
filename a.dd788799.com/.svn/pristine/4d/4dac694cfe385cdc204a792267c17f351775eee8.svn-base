$(function(){
	eveb_promo_slide('.eveb_index_promo_btn a','.eveb_index_promo_banner li');
	eveb_radio_list('#bank_1,#bank_2,#bank_3,#bank_4,#bank_5,#bank_6');
	eveb_bank_list('.eveb_bank_list label');
	eveb_bank_account('#bank_account');
	eveb_withdraw_list('.eveb_withdraw_list li');
	eveb_letter_list();
	eveb_tab();
	eveb_transfer_select('#tansfer_1','#tansfer_2');
	eveb_transfer_select('#tansfer_2','#tansfer_1');
	eveb_transfer_money();
	eveb_transfer_2();
	eveb_select_all();
	eveb_alert();
	eveb_resize();
	eveb_nav_on('.account_list');
	eveb_notice_slide('.eveb_header_notice_control i','.eveb_header_notice_list li');
	showHide();
})
function eveb_resize(){
    $(window).resize(function(){
        scrollHeight = $(document).height();
        $('.eveb_popup_wrap').height(scrollHeight);
    })
}
function timeaddzero(obj){
	return obj<10? '0'+obj : obj;
}

//导航选中
function eveb_nav_on(_source){
	nav_on = $(_source).attr('data-on');
	$(nav_on).addClass('eveb_nav_hover');
}
//头部 公告切换
function eveb_notice_slide(_source,_target){
	var num = 1;
	var notice_speed = 5000;//轮播速度
	var notice_auto  = setInterval(function(){
		$('.icon_header_notice_r').click();
	},notice_speed)
	var promo_length = $(_target).length;
	$(_target).eq(0).show().siblings().hide();
	$(_source).click(function(){
		if($(this).hasClass('icon_header_notice_l')){
			num <= promo_length && num > 1 ? num-- : num = promo_length;
		}else{
			num < promo_length ? num++ : num = 1;
		}
		$(_target).eq(num-1).slideDown().siblings().hide();
	})
}
//首页 可优惠
function eveb_promo_slide(_source,_target){
	var num = 1;
	var promo_length = $(_target).length;
	$('.eveb_index_promo_num em').text(promo_length);
	$(_source).click(function(){
		if($(this).hasClass('icon_promo_l')){
			num <= promo_length && num > 1 ? num-- : num = promo_length;
		}else{
			num < promo_length ? num++ : num = 1;
		}
		$(_target).eq(num-1).fadeIn().siblings().hide();
		$('.eveb_index_promo_num span').text(num + '/');
	})
}
//存款 银行帐号
function eveb_bank_account(_source){
	$(_source).change(function(){
		var bank_account = $(_source).children('option:selected');
		var bank_account_name = bank_account.attr('data-bank-account-name');
		var bank_account_no = bank_account.attr('data-bank-account-no');
		if(isNaN(bank_account_no)){
		//	$('#bank_2').hide();
		//	$('#bank_3').hide();
			$('#bank_1').click();
		}else{
		//	$('#bank_2').show();
		//	$('#bank_3').show();
			$('#bank_1').click();
		}
		if(bank_account.val() != ''){
			$('.eveb_copy a').fadeIn('slow');
		}else{
			$('.eveb_copy a').fadeOut();
		}
	});
	$('.eveb_copy a').hide();
}
function copy(text) {
    try {
        var clipboard = new Clipboard('#cp_mg');
        var success = document.execCommand('copy');
        if (success) {
            $btncopy.trigger('copied', ['已复制']);
        } else {
            alert("浏览器粘贴板不支持复制，请手动复制。")
        }
    } catch (err) {
        $btncopy.trigger('copied', ['点击复制']);
    }
}
//存款 更多银行
function eveb_bank_more(_state){
	if(_state == 0){
		$('.eveb_bank_list').animate({height:'180px'});
		$('#eveb_bank_open').hide();
		$('#eveb_bank_close').show();
	}else{
		$('.eveb_bank_list').animate({height:'90px'});
		$('#eveb_bank_open').show();
		$('#eveb_bank_close').hide();
	}
}
//存款 切换
function eveb_radio_list(_srouce){
	$(_srouce).click(function(){
		var _sub = $(this).attr('data-sub');
		if(_sub != null){
			$(_srouce).removeClass();
			$(this).addClass('on');
			$('.eveb_radio_list_sub').hide();
			$(_sub).show();
		}else{
			$(_srouce).parent().children('label').removeClass();
			$('.eveb_radio_list_sub').hide();
		}
	})
}
//存款 银行列表点击效果
function eveb_bank_list(_source){
	$(_source).click(function(){
		$(_source).removeClass();
		$(this).children('input:radio').attr('checked', 'true');
		$(this).addClass('on');
	})
}
//提款 银行卡选中
function eveb_withdraw_list(_source){
	$(_source).click(function(){
		$(_source).children('div').removeClass('on');
		$(this).children('div').addClass('eveb_withdraow_box on');
		var withdraw_name = $(this).find('.withdraw_name').text();
		var withdraw_bank = $(this).find('.withdraw_bank').text();
		$('#withdraw_name').val(withdraw_name);
		$('#withdraw_bank').val(withdraw_bank);
	})
}
//转账 选择判断
function eveb_transfer_select(_source_1,_source_2){
	$(_source_1).change(function(){
		$("input[name='money']").val('');
		var tansfer_1 = $(_source_1).get(0).selectedIndex + 1;
		var tansfer_2 = $(_source_2).get(0).selectedIndex + 1;
		if(tansfer_1 == tansfer_2){
			$(_source_2).val(0);
		}
		eveb_transfer_money();
	})
}
//转账 获得转出金额
var transfer_money;
function eveb_transfer_money(){
	transfer_money = $("#tansfer_1").children('option:selected').attr('data-money');
	transfer_money = parseInt($(transfer_money).text());
}
//转账 金额验证
function eveb_transfer_money_check(_money){
	if(_money.value > transfer_money){
		jAlert('转出金额不能大于所拥有的金额，请重新输入','温馨提示',function(r){_money.focus();});
		_money.value = '';
	}
}
//转账 样式2
function eveb_transfer_2(){
	$('.eveb_transfer_2_list li').mouseenter(function(){
		$('.eveb_transfer_2_list li').removeClass();
		$(this).addClass('on');
	})
}
//转账 交换按钮
function eveb_transfer_control(){
	var tansfer_1 = $('#tansfer_1').html();
	var tansfer_1_s = $('#tansfer_1').get(0).selectedIndex;
	var tansfer_2 = $('#tansfer_2').html();
	var tansfer_2_s = $('#tansfer_2').get(0).selectedIndex;
	$('#tansfer_1').html(tansfer_2);
	$('#tansfer_2').html(tansfer_1);
	$('#tansfer_1').val(tansfer_2_s);
	$('#tansfer_2').val(tansfer_1_s);
	eveb_transfer_money();
	$("input[name='money']").val('');
	$("input[name='money']").focus();
}
//站内信
function eveb_letter_list(){
	$('.eveb_letter_list li .eveb_letter_title').click(function(){
		$(this).parent('li').css('background','#F5F5F5').siblings().css('background','#FFF');
		if(!$(this).siblings('.detail').is(':visible')){
			$(this).siblings('.detail').slideDown().parent('li').siblings().children('.detail').slideUp();
		}else{
			$(this).siblings('.detail').slideUp();
			$(this).parent('li').css('background','#FFF');
		}
	});
	$('.eveb_letter_list li:last').css('border-bottom',0);
}
//标签 切换
function eveb_tab(){
	$('.eveb_tab ul li').click(function(){
		$(this).addClass('on').siblings().removeClass('on').parents('.eveb_tab').siblings('.eveb_market_list').children().eq($(this).index()).show().siblings().hide();
	});
	$('.eveb_market_list table:first').show();
}
//复制剪贴板
function copyToClipboard(_maintext){
	if (window.clipboardData){
		window.clipboardData.setData('Text', _maintext);
	}else if (window.netscape){
		try{
			netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
		}catch(e){
			alert('浏览器不支持复制，请手动复制文本');
		}

		var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
		if (!clip) return;
		var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
		if (!trans) return;
		trans.addDataFlavor('text/unicode');
		var str = new Object();
		var len = new Object();
		var str = Components.classes['@mozilla.org/supports-string;1'].createInstance(Components.interfaces.nsISupportsString);
		var copytext=_maintext;
		str.data=copytext;
		trans.setTransferData('text/unicode',str,copytext.length*2);
		var clipid=Components.interfaces.nsIClipboard;
		if (!clip) return false;
		clip.setData(trans,null,clipid.kGlobalClipboard);
	}
	alert('已复制 ' + _maintext);
}
//时间搜索
function searchday(id){
	if(id){
		var De = new Date(),ymd,endymd,tmpEnd;
		ymd = De.getFullYear()+"-"+GetFullDate(De.getMonth()+1)+"-"+GetFullDate(De.getDate()) + " 00:00";
		De.setDate(De.getDate()+1);
		tmpEnd = De.getFullYear()+"-"+GetFullDate(De.getMonth()+1)+"-"+GetFullDate(De.getDate()) + " 00:00";
		if(id==1){
			endymd = tmpEnd;
		}else if(id==3){
			De.setDate(De.getDate()-3);
			endymd = tmpEnd;
			ymd = De.getFullYear()+"-"+GetFullDate(De.getMonth()+1)+"-"+GetFullDate(De.getDate()) + " 00:00";
		}else if(id==7){
			De.setDate(De.getDate()-7);
			endymd = tmpEnd;
			ymd = De.getFullYear()+"-"+GetFullDate(De.getMonth()+1)+"-"+GetFullDate(De.getDate()) + " 00:00";
		}
		$("#starttime").val(ymd);
		$("#endtime").val(endymd);
	}else return !1
}
//时间返回
function GetFullDate(v)
{
	var v;
	if (v > 9) {
		return v.toString();
    }
	return "0"+v;
}
//全选
function eveb_select_all(){
	$("#eveb_select_all").click(function(){
		if(this.checked){
			$(".eveb_letter_list :checkbox").attr("checked", true);
		}else{
			$(".eveb_letter_list :checkbox").attr("checked", false);
		}
	});
}
//操作提示
function eveb_alert(){
	$(".delete_confirm").click( function() {
		jConfirm('您确定要删除所选内容？', '系统提示', function(r) {
			if(r){
				alert(1);
			}
		});
	});
	$(".readed_confirm").click( function() {
		jConfirm('您确定要设为已读？', '系统提示', function(r) {
			if(r){
				alert(1);
			}
		});
	});
}

function showHide(){
	$('.tipIcon').hover(function(){
		$(this).parent().siblings(".tipBox").show();
	},function(){
		$(this).parent().siblings(".tipBox").hide();
	});
}
