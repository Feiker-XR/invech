 requirejs(["jquery","layer","common"],function($,layer){
 	 $('#bankNum').keyup(function() {
        if (!/^[0-9]*$/g.test($(this).val())) {
            $(this).val('');
        }
    });
 	$('#bank').change(function() {
        if ($(this).val() == 'other') {//其他银行
            $('#bank_other').show();
            $('#li_bank_name').css('height', '70px');
        } else {
            $('#bank_other').hide();
            $('#li_bank_name').css('height', '40px');
        }
    });
 	
 	if($('#bank').val() == 'other') {
 		$('#li_bank_name').css('height', '70px');
 	}
 	
    $("#charge-btn").on("click",function(e){
 	  	e.preventDefault();
 	  	var bankId = $('#bank').val();
        if (bankId == '') {
        	layer.open({content:"请选择银行！",btn:"确定"});
            return;
        } else if (bankId == 'other' && $('#bank_other').val() == '') {
        	layer.open({content:"请输入其他银行！",btn:"确定"});
            return;
        }
        var remark = '';
        var bankName = $('#bank option:selected').text();//银行名称
        if (bankId == 'other') {//其他银行
        	remark = 'other';
            bankName = $('#bank_other').val();
        }
        var bankNum = $('#bankNum').val();
        if ($('#bankNum').val() == '') {
        	layer.open({content:"请填写银行卡号！",btn:"确定"});
            return;
        }
        if($('#bankNum').val().indexOf('***') != -1) {
        } else if (!/^[0-9]{10,20}$/g.test($('#bankNum').val())) {
        	layer.open({content:"请填写正确的银行卡号！",btn:"确定"});
            return;
        }
        var name = $('#name').val();
        if ($('#name').val() == '') {
        	layer.open({content:"请填写开户人姓名！",btn:"确定"});
            return;
        }
        var pwd = null;
        if($('#password') != null && $('#password').length > 0) {
        	pwd = $('#password').val();
        } else {
        	pwd = $('#pwd1').val()+$('#pwd2').val()+$('#pwd3').val()+$('#pwd4').val();
        }
        if(pwd == null || pwd.length < 4 || !/^[0-9]{4}$/g.test(pwd)) {
        	layer.open({content:"请选输入正确的提款密码！",btn:"确定"});
            return;
        }
        
        var answer = '';
        /*if($('#answer') != null && $('#answer').length > 0) {
        	answer = $('#answer').val().trim();
        	if(answer != null && answer == '') {
        		layer.open({content:"请填写密保答案！",btn:"确定"});
                return;
        	}
        }*/


        var index=layer.open({type: 2,shadeClose:false});
        $.ajax({
            url: '/index.php/safe/setCBAccount',
            type: 'POST',
            dataType: 'json',
            data: {
                'bankId' : bankId,
                'account' : bankNum,
                'username' : name,
                'countname' : $('#province').val(),
                'coinPassword' : pwd
            },
            timeout: 30000,
            success: function (results) {
            	layer.close(index);
            	if(results=="200"){
            		layer.open({content:"银行绑定成功！",btn:"确定",yes:function(){
            			location.href = '/safe/more';
            		}});
	           	}else{
	           		layer.open({content:results,btn:"确定"});
	           	}
            }
        });
 	  });
    
    if($('#set_quesion').val() == 1) {
    	/*layer.open({content:"请先设置密保！",btn:"确定",yes:function(){
			location.href = 'member/question';
		}});*/
    }
 });