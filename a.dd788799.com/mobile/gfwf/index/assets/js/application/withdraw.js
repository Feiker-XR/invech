requirejs(["jquery","layer","common"], function($,layer) {
	 $('#money').keyup(function() {
        this.value = this.value.replace(/[^\d]/g,'').replace(/^0+/g,'');
    	
    	var feeAmount=$.trim($('#fee_amount').val());
    	var feeRate=$.trim($('#fee_rate').val());
    	if(feeRate != null && parseFloat(feeRate) > 0) {
    		$("#fee").text((parseFloat(feeAmount) + this.value*feeRate/100));
    	}
    });
    $('#bankNum').keyup(function() {
        if (!/^[0-9]*$/g.test($(this).val())) {
            $(this).val('');
        }
    });

    $('#charge-btn').on("click",function() {
        withdraw();
    });
    function withdraw() {
        
        var money = $('#money').val();
        if (money == '' || money == 0) {
        	layer.open({content:"请正确填写提款金额！",btn:"确定"});
            return;
        }
        if ($('#min_amount').val() != '' && money < parseInt($('#min_amount').val())) {
        	layer.open({content:"提款金额需大于最小提款金额！",btn:"确定"});
            return;
        }
        if ($('#max_amount').val() != '' && parseInt($('#max_amount').val()) > 0 && money > parseInt($('#max_amount').val())) {
        	layer.open({content:"提款金额不能大于最大提款金额！",btn:"确定"});
            return;
        }
        var pwd = $('#password').val();//+$('#pwd2').val()+$('#pwd3').val()+$('#pwd4').val();
        if (pwd == null || pwd.length < 4 || !/^[0-9]{4}$/g.test(pwd)) {
        	layer.open({content:"请正确填写提款密码！",btn:"确定"});
            return;
        }
        var index=layer.open({type: 2,shadeClose:false});
        $.ajax({
            url: '/index.php/cash/ajaxToCash',
            type: 'Post',
            dataType: 'json',
            data: {
                'coinpwd' : pwd,
                'amount' : money
            },
            timeout: 30000,
            success: function (results) {
            	layer.close(index);
            	if(results=="200"){
            		var balance = $('#balance').val();
                    balance = balance.substr(1);
                    balance = parseFloat(balance) - parseFloat(money);
                    $('#balance').val('￥'+parseFloat(balance.toFixed(3)));
                    location.href = '/index.php/safe/Personal';
            	}else{
            		layer.open({content:results,btn:"确定"});
            	}
                
                return false;
            }
        });
    }
});