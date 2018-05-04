requirejs(["jquery","layer","common","qrcode"], function($,layer) {
	$('#step_prev_third').on("click", function() {
		$('#wrapper_2').hide();
        $('#wrapper_1').show();
    });

    $('#step_next_third').on("click", function() {
        location.href = 'member/recharge/list';
    });
    
    $('#btn_clear').on('click', function() {
    	$('#money').val('');
    });
    $('#btn_100').on('click', function() {
    	var result = 0;
    	var money = $('#money').val();
    	if(money != '') {result = parseInt(money);}
    	
    	$('#money').val(result+100);
    });
    $('#btn_500').on('click', function() {
    	var result = 0;
    	var money = $('#money').val();
    	if(money != '') {result = parseInt(money);}
    	
    	$('#money').val(result+500);
    });
    $('#btn_1000').on('click', function() {
    	var result = 0;
    	var money = $('#money').val();
    	if(money != '') {result = parseInt(money);}
    	
    	$('#money').val(result+1000);
    });
    $('#btn_5000').on('click', function() {
    	var result = 0;
    	var money = $('#money').val();
    	if(money != '') {result = parseInt(money);}
    	
    	$('#money').val(result+5000);
    });
    $('#btn_10000').on('click', function() {
    	var result = 0;
    	var money = $('#money').val();
    	if(money != '') {result = parseInt(money);}
    	
    	$('#money').val(result+10000);
    });
    $('#btn_50000').on('click', function() {
    	var result = 0;
    	var money = $('#money').val();
    	if(money != '') {result = parseInt(money);}
    	
    	$('#money').val(result+50000);
    });
    
    //正确输入金额
    $('#money').keyup(function() {
        var arr = /^([0-9]{0,}\.?[0-9]{0,2})[0-9]{0,}$/g.exec($(this).val());
        var tmp = '';
        if (/^[0-9][0-9]{0,}\.?[0-9]{0,}$/g.test($(this).val())) {
            tmp = (arr[1] != null && arr[1] != undefined) ? arr[1] : '';
        }
        var arr1 = /^[0]([0-9][0-9\.]*)$/g.exec(tmp);
        if (/^[0][0-9][0-9\.]*$/g.test(tmp)) { //处理前面的数字0
            tmp = arr1[1];
        }
        $(this).val(tmp);
    });
    //切换充值方式   
    $('div.rech-title a').on("click",function() {
        $('div.rech-title a').removeClass('on');
        $(this).addClass('on');
        payType = $(this).data('type');
        $('div.rech_cont').hide();
        $('div.rech_' + payType).show();
       // getPayList(payType);
    });
    $('div.rech-title a:eq(0)').trigger("click");
    //下一步
    var payid, payMin, payMax, payCode, payReturnType, payUrl, isBank;
    $('button.charge-btn').on("click", function() {
        if ($('#money').val() == '' || $('#money').val() == 0) {
        	layer.open({content:"充值金额不能为空！",btn:'确定'});
        	return;
        }
        var rechType = $('div.rech-title a.on').data('type');
        if (rechType == 'bank') { //公司入款
        	if(parseFloat(payMin) > parseFloat($('#money').val())) {
            	layer.open({content:"充值金额不能小于"+payMin,btn:'确定'});
            	return;
            }
            if(parseFloat(payMax) < parseFloat($('#money').val())) {
            	layer.open({content:"充值金额不能大于"+payMax,btn:'确定'});
            	return;
            }
            
            location.href = 'member/recharge/bankConfirm?money=' + $('#money').val() + '&key='+payid;
        } else if (rechType == 'wechat') {
            getPayMoney();
        } else if (rechType == 'alipay') {
            getPayMoney();
        } else if (rechType == 'qqpay') {
            getPayMoney();
        } else if (rechType == 'online') {
        	var amount = $.trim($('#money').val());
            var minAmount = $.trim($("#online_minamount").val());
            if(parseFloat(minAmount) > parseFloat(amount)) {
            	layer.open({content:"充值金额不能小于"+minAmount,btn:'确定'});
            	return;
            }
            var maxAmount = $.trim($("#online_maxamount").val());
            if(parseFloat(maxAmount) < parseFloat(amount)) {
            	layer.open({content:"充值金额不能大于"+maxAmount,btn:'确定'});
            	return;
            }
            
            var type = $('#online_type').val();
            var bank = $('#online_bank_'+type);
            if(bank != null && bank.length > 0 && (bank.val() == null || bank.val() == '')) {
            	layer.open({content:"请先选择银行！",btn:'确定'});
            	return;
            }
            
        	if($('#is_app_access').val() != '1') {
        		$('#online_bank').val(bank.val());
                $('#online_base_url').val(document.getElementById("base_path").href);
                
                $("#online_money").val(amount);
            	$("#online_form").attr("action", payUrl+'/common/recharge/third');
            	$('#online_form').submit();
            	
	        	layer.open({
	                type: 1,
	                skin: 'layui-layer-rim',
	                area: ['430px', '300px'],
	                content: $('#dialog').html()
	            });
        	} else {
        		var memberId = $('#online_member_id').val();
        		var type = 4;
        		var payId = $('#online_payid').val();
        		var bankName = bank.val() == undefined ? "" : bank.val();
        		var url = '?isH5=1&memberId='+memberId+'&type='+type+'&payId='+payId+'&bankName='+encodeURIComponent(bankName);
        		url += '&amount='+amount+'&userName=&baseUrl='+encodeURIComponent(document.getElementById("base_path").href);
        		location.href = payUrl+'/common/recharge/third'+url;
        	}
        	
        	return;
        }
    });
    //判断金额是否超出范围。微信、支付宝
    function getPayMoney() {
    	var amount = $('#money').val();
    	if(amount < payMin || amount > payMax) {
    		layer.open({content:"充值金额错误，有效充值金额范围为" + payMin + " ~ " + payMax, btn:'确定'});
    		return;
    	}
    	
    	var payType = $('div.rech-title a.on').data('type');
    	//第三方微信、支付宝(页面)
        if("#scan#" == payCode && payReturnType == 2) {
        	if($('#is_app_access').val() != '1') {
        		$("#third_type").val(payType=='wechat' ? 1 : (payType=='alipay' ? 2 : 7));
            	$("#third_payid").val(payid);
            	$("#third_recharge_amount").val(amount);
            	$("#third_bank_name").val(payType=='wechat' ? '微信' : (payType=='alipay' ? '支付宝' : 'QQ钱包'));
            	$('#third_base_url').val(document.getElementById("base_path").href);
            	
            	$("#third_form").attr("action", payUrl+'/common/recharge/third');
            	$('#third_form').submit();
            	
	        	layer.open({
	                type: 1,
	                skin: 'layui-layer-rim',
	                area: ['430px', '300px'],
	                content: $('#dialog').html()
	            });
        	} else {
        		var memberId = $('#third_member_id').val();
        		var type = payType=='wechat' ? 1 : (payType=='alipay' ? 2 : 7);
        		var payId = payid;
        		var bankName = payType=='wechat' ? '微信' : (payType=='alipay' ? '支付宝' : 'QQ钱包');
        		var url = '?isH5=1&memberId='+memberId+'&type='+type+'&payId='+payId+'&bankName='+encodeURIComponent(bankName);
        		url += '&amount='+amount+'&userName=&baseUrl='+encodeURIComponent(document.getElementById("base_path").href);
        		location.href = payUrl+'/common/recharge/third'+url;
        	}
        	
        	return;
        //第三方微信、支付宝(二维码)
        } else if("#scan#" == payCode && payReturnType == 1) {
        	var index = layer.open({type: 2, content: '加载中'});
        	$.ajax({
                url: 'member/recharge/third' + (payType=='wechat' ? 'Wechat' : (payType=='alipay' ? 'Alipay' : 'Qqpay')),
                type: 'POST',
                dataType: 'json',
                data: {
                    'payid': payid,
                    'amount': amount,
                    'baseUrl': document.getElementById("base_path").href
                },
                timeout: 30000,
                success: function(results) {
                	layer.close(index);
                	if(results.status == '200') {
    	                $('#wrapper_1').hide();
    	                $('#wrapper_2').show();
    	                
    	                var data = results.data;
    	                $('#third_orderno').text(data.orderNo);
    	                $('#third_amount').text(data.amount);
    	                if(data.needDown == '1'){
                            $("#pay_code_img").attr("src", data.payUrl);
                        } else {
                        	$("#third_charge_two").empty().qrcode({
                    			render : "canvas",
                    			text : data.payUrl,
                    			width : "180",
                    			height : "180",
                    			background : "#ffffff",
                    			foreground : "#000000",
                    			src: ""
                    		});	
                        }
    	                
    	                if(payType=='wechat') {
    	                	$('#third_alipay').hide();
    	                	$('#third_qqpay').hide();
    	                	$('#third_wechat').show();
    	                } else if(payType=='alipay'){
    	                	$('#third_alipay').show();
    	                	$('#third_qqpay').hide();
    	                	$('#third_wechat').hide();
    	                } else {
    	                	$('#third_qqpay').show();
    	                	$('#third_alipay').hide();
    	                	$('#third_wechat').hide();
    	                }
                	} else {
                		layer.open({content:results.description,btn:'确定'});
                	}
                }
            });
        	return;
        }
        
        $.ajax({
            url: 'member/recharge/getPayMoney',
            type: 'POST',
            dataType: 'json',
            data: {
                'payType': payType,
                'money': amount,
                'payid': payid,
                'isBank': isBank
            },
            timeout: 30000,
            success: function(results) {
            	if(results.status == '200') {
	                var data=results.data;
	                var param = 'payId=' + data.payId + '&amount='+data.amount;
	                if(payType == 'wechat') {
	                    location.href = 'member/recharge/wechat?' + param;
	                } else if (payType == 'alipay') {
                		location.href = 'member/recharge/alipay?' + param + '&isBank='+isBank;
	                }
            	} else {
            		layer.open({content:results.description,btn:'确定'});
            	}
            }
        });
    }
    //获得支付列表
    function getPayList(payType) {
        $('div.rech_cont ul').show();
        $('div.rech_cont select').show();
        $('button.charge-btn').removeAttr('disabled');
        $.ajax({
            url: 'member/recharge/getByType',
            type: 'POST',
            dataType: 'json',
            data: {
                'payType': payType
            },
            timeout: 30000,
            success: function(results) {
            	var txtHtml = '';
            	var jq = 'ul.wechat-box';
                if (payType == 'alipay') {
                    jq = 'ul.wechat-box';
                }
                $(jq).html(txtHtml);
                
            	var data = results.data;
            	$('div.rech_online').hide();
            	if(data == null || data.length <= 0) {
            		$('select#online').parent().hide();
                	$('div#pay_list_stop').show();
                	$('button#charge-btn').hide();
                	return;
            	}
            	
            	$('div#pay_list_stop').hide();
            	$('button#charge-btn').show();
            	$('button#charge-btn').text('下一步');
                if (payType == 'wechat' || payType == 'alipay' || payType == 'qqpay') {
                    var txtSelDisplay = 'block';
                    var txtNotSelDisplay = 'none';
                    var txtChk = '';
                    var idx = 0;
                    for(var i = 0; i < data.length; i++) {
                        var tmpTip = (data[i].payDesc == '') ? '<br>' : '<p>' + data[i].payDesc + '</p>';
                        if(data[i].payType == 3) {
                        	txtHtml += '<li style="text-align:center;"><div style="color:#E84E05">'
                        		+ data[i].payDesc + '<br>添加时请备注您的会员账号'
                        		+ '</div><div style="font-weight:bold;margin-bottom:5px;font-size:14px;margin-top:5px;">'
                        		+ (data[i].type == 1 ? '微信号：' : '支付宝账号：') + data[i].code
                        		+ (data[i].type == 1 ? ' 微信昵称：' : ' 支付宝名称：') + data[i].name
                        		+ '</div><div><img src="'
                        		+ data[i].payImg
                        		+ '"></div><div style="font-size:12px;text-align:left;">※1.请勿存入整数金额(如100.32元),以免延误财务查收</div><div style="font-size:12px;text-align:left;">※2.转帐完成后请保留单据作为核对证明</div></li>';
                        } else {
                        	txtHtml += '<li data-payid="' + data[i].id + '" data-payurl="' + data[i].payImg + '" data-min="' + data[i].payMin + '" data-max="' + data[i].payMax + '" data-code="' + data[i].code + '" data-paytype="' + data[i].payType + '" data-type="' + data[i].type + '">' + '<a class="fr" href="javascript:;"><img class="imgsel" style="display: ' + txtSelDisplay + ';" src="' + _prefixURL.statics + '/cz_02.png"><img class="imgnotsel" style="display: ' + txtNotSelDisplay + ';" src="' + _prefixURL.statics + '/cz_01.png"></a>' + '<div class="rech-list-t">' + data[i].payName + '</div>' + '<p>' + tmpTip + '</p>' + '</li>';
                        }
                        if(idx == 0 && data[i].payType != 3) { //设置默认值
                            payid = data[i].id;
                            payCode = data[i].code;
                            payMin = data[i].payMin;
                            payMax = data[i].payMax;
                            payUrl = data[i].payImg;
                            payReturnType = data[i].type;
                            isBank = data[i].payType == 5 ? 1 : 0;
                            
                            txtSelDisplay = 'none';
                            txtNotSelDisplay = 'block';
                            
                            idx = 1;
                        }
                    }
                    
                    if(idx == 0) $('button#charge-btn').hide();
                    
                    $(jq).html(txtHtml);
                    bindPayList();
                } else if (payType == 'online') {
            		payUrl = data.payUrl;
                 	$("#online_payid").val(data.id);
                 	$("#online_type").val(data.type);
                 	$("#online_minamount").val(data.minAmount);
                	$("#online_maxamount").val(data.maxAmount);
                	
                	var bank = $('#online_bank_'+data.type);
                    if(bank != null && bank.length > 0) {
                    	$('div.rech_online').show();
                		$('.online_bank_class').hide();
                		$('#online_bank_'+data.type).show();
                    }
                    $('select#online').parent().show();
                    $('button#charge-btn').text('立即充值');
                } else if (payType == 'bank') {
                    txtHtml = '';
                    var txtSelDisplay = 'block';
                    var txtNotSelDisplay = 'none';
                    for (var j = 0; j < data.length; j++) {
                    	if(j<data.length-1) {
                    		txtHtml += '<ul class="bank-box" style="border-bottom: 1px solid #ddd;" data-payid=' + data[j].id + ' data-paymin=' + data[j].payMin + 'data-paymax=' + data[j].payMax + '>';
                    	} else {
                    		txtHtml += '<ul class="bank-box" data-payid=' + data[j].id + '>';
                    	}
                    	txtHtml += '<a class="fr" href="javascript:;"><img class="imgsel" style="display: '
                    	    + txtSelDisplay + ';" src="' + _prefixURL.statics + '/cz_02.png"><img class="imgnotsel" style="display: '
                    	    + txtNotSelDisplay + ';" src="' + _prefixURL.statics + '/cz_01.png"></a>';
                    	if (j == 0) {
                    		payid = data[j].id;
                    		payMin = data[j].payMin;
                    		payMax = data[j].payMax;
                            txtSelDisplay = 'none';
                            txtNotSelDisplay = 'block';
                        }
                    	
                    	txtHtml += '<li><span class="left">银行</span><span class="rec_bank">' + data[j].bankName;
                    	txtHtml += '</span></li><li><span class="left">收款人</span><span class="rec_name">' + data[j].accountName;
                    	txtHtml += '</span></li><li><span class="left">汇款资讯</span><span class="rec_addr">' + data[j].bankAddr;
                    	txtHtml += '&nbsp;&nbsp;</span><span class="rec_account">' + data[j].accountCode;
                    	txtHtml += '</span></li></ul>';
                    }
                    
                    $('div.bank-box').parent().show();
                    $('div.bank-box').html(txtHtml);
                    
                    bindBankPayList();
                }
            }
        })
    }
    //选择check
    function bindPayList() {
        $('ul.wechat-box li').bind('click', function() {
            event.preventDefault();
            $('ul.wechat-box li img.imgsel').hide();
            $('ul.wechat-box li img.imgnotsel').show();
            $(this).find('img.imgnotsel').hide();
            $(this).find('img.imgsel').show();
            
            payid = $(this).data('payid');
            payMin = $(this).data('min');
            payMax = $(this).data('max');
            payCode = $(this).data('code');
            payUrl = $(this).data('payurl');
            payReturnType = $(this).data('type');
            isBank = $(this).data('paytype') == 5 ? 1 : 0;
        });
    }
    
    function bindBankPayList() {
        $('div.bank-box ul').bind('click', function() {
            event.preventDefault();
            $('div.bank-box ul img.imgsel').hide();
            $('div.bank-box ul img.imgnotsel').show();
            $(this).find('img.imgnotsel').hide();
            $(this).find('img.imgsel').show();
            
            payid = $(this).data('payid');
        });
    }
    
    //累计投注总额，最近出款总额
    $('a.fr').on("click", function() {
    //	getBalance();
    })
    function getBalance() {
        $.ajax({
            url: 'member/getLatelyWithdraw',
            type: 'GET',
            dataType: 'json',
            timeout: 30000,
            success: function(results) {
                var data = results.data;
                if (results.status == "200") {
                    $('span#balance').text(data.amount);
                }
            }
        });
    }
    $(function() {
      //  getBalance();
      //bindPayList();
    });
});
