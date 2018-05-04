//表单验证
$(function(){//存款
	$("form[name='eveb_bank']").validate({
		rules:{
			 money:{required:true}
			,name:{required:true}
			,account:{required:true}
			,way:{required:true}
			,bank:{required:true}
			,userName:{required:true}
			,bankAccount:{required:true}
			,userWeixinName:{required:true}
			,userAlipayName:{required:true}
			,userTenpayName:{required:true}
		}
		,messages:{
			money:{required:" * 请输入金额"}
			,name:{required:" * 请输入存款人姓名"}
			,account:{required:" * 请选择收款帐号"}
			,way:{required:" * 请选择存款方式"}
			,bank:{required:" * 请选择银行"}
			,userName:{required:" * 请输入存款姓名"}
			,bankAccount:{required:" * 请输入银行帐号"}
			,userWeixinName:{required:" * 请输入微信昵称"}
			,userAlipayName:{required:" * 请输入支付宝昵称"}
			,userTenpayName:{required:" * 请输入财付通昵称"}
		}
		,submitHandler:function(form){eveb_popup_show("#eveb_popup_bank_ok");}
	})
	//提款
	$("form[name='eveb_withdraw']").bind('input propertychange',function(){
		if($(this).valid()==true){
			$('#withdraw_submit').removeClass('button_disabled');
		}else{
			$('#withdraw_submit').addClass('button_disabled');
		}
	})
	$("form[name='eveb_withdraw_1']").validate({
		rules:{
			password:{required:true}
		}
		,messages:{
			password:{required:" * 请输入取款密码"}
		}
	})
	$("form[name='eveb_withdraw']").validate({
		rules:{
			name:{required:true}
			,bank:{required:true}
			,money:{required:true}
			,password:{required:true}
		}
		,messages:{
			name:{required:" * 请输入开户名"}
			,bank:{required:" * 请输入银行卡号"}
			,money:{required:" * 请输入取款金额"}
			,password:{required:" * 请输入取款密码"}
		}
		,submitHandler:function(form){eveb_popup_show("#eveb_popup_bank_ok");}
	})
	//添加银行卡
	$("form[name='eveb_bank_bind']").validate({
		rules:{
			bank:{required:true}
			,name:{required:true}
			,bank_p_2:{required:true}
			,bank_name:{required:true}
			,bank_no:{required:true}
		}
		,messages:{
			bank:{required:" * 请选择所属银行"}
			,name:{required:" * 请输入开户人"}
			,bank_p_2:{required:" * 请选择开户地"}
			,bank_name:{required:" * 请输入开户支行"}
			,bank_no:{required:" * 请输入银行卡号"}
		}
		,submitHandler:function(form){eveb_popup_show("#eveb_popup_bank_bind_ok");}
	})
	//转账
	$("form[name='eveb_transfer']").validate({
		rules:{
			tansfer_1:{required:true}
			,tansfer_2:{required:true}
			,money:{required:true}
		}
		,messages:{
			tansfer_1:{required:" * "}
			,tansfer_2:{required:" * "}
			,money:{required:" * 请输入金额"}
		}
		,submitHandler:function(form){eveb_popup_show("#eveb_popup_transefer_ok");}
	})
	//留言
	$("form[name='eveb_message']").validate({
		rules:{
			type:{required:true}
			,title:{required:true}
		}
		,messages:{
			type:{required:" * 请选择留言类型"}
			,title:{required:" * 请输入留言标题"}
		}
		,submitHandler:function(form){eveb_popup_show("#eveb_popup_message_ok");}
	})
	//密码修改
	$("form[name='eveb_password']").validate({
		rules: {
			oldpassword: {
				required: true,
				minlength: 6,
				maxlength: 12
			},
			newpassword: {
				required: true,
				minlength: 6,
				maxlength: 12
			},
			confirmnewpassword: {
				required: true,
				minlength: 5,
				maxlength: 12,
				equalTo: "#newpassword"
			}
		},
		messages: {
			oldpassword: {
				required: "* 6-12位小写字母(a-z)或数字(0-9)组成",
				minlength: "* 确认密码不能小于{0}个字符",
				maxlength: "* 原密码不能大于{0}个字符"
			},
			newpassword: {
				required: "* 6-12位小写字母(a-z)或数字(0-9)组成",
				minlength: "* 新密码不能小于{0}个字符",
				maxlength: "* 新密码不能大于{0}个字符"
			},
			confirmnewpassword: {
				required: "* 6-12位小写字母(a-z)或数字(0-9)组成",
				minlength: "* 确认密码不能小于{0}个字符",
				maxlength: "* 确认密码不能大于{0}个字符",
				equalTo: "* 两次输入密码不一致"
			}
		},
		submitHandler: function(form){eveb_popup_show("#eveb_popup_password_ok");}
	})
	//通信验证1
	$("form[name='validation_1']").validate({
		rules:{
			way:{required:true}
		}
		,messages:{
			way:{required:" * 请选择验证类型"}
		}
	})
	//通信验证2
	$("form[name='validation_2']").validate({
		rules:{
			code:{required:true}
		}
		,messages:{
			code:{required:" * 请输入短信验证码"}
		}
	})
})