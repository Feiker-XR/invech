requirejs(["jquery","layer"],function($,layer){
	 $('#register_btn').on("click",function(event) {
		var qq = '';
        var email = '';
        var phone = '';
	        
        var uid = $('#uid').val();
        var pwd = $('#pwd').val();
        var repwd = pwd;//$('#repwd').val();
        if (uid == '') {
        	layer.open({content:"请输入用户名！",btn:"确定"});
            return;
        }
        if (!/^[A-Za-z0-9]{4,16}$/g.test(uid)) {
        	layer.open({content:"请输入正确格式的用户名!",btn:"确定"});
            return;
        }
        if (pwd == '') {
        	layer.open({content:"请输入密码！",btn:"确定"});
            return;
        }
        if (!/^[A-Za-z0-9]{6,12}$/g.test(pwd) || /^[A-Za-z]{1,12}$/g.test(pwd) || /^[0-9]{1,12}$/g.test(pwd)) {
        	layer.open({content:"密码需6-12个字符，且为英数字符组合!",btn:"确定"});
            $('img#captcha_img1').trigger("click");
            return;
        }
        if (pwd != '' && pwd != repwd) {
        	layer.open({content:"两次密码不一致！",btn:"确定"});
            return;
        }
        if($("#phone").length != 0) {
        	phone = $.trim($('#phone').val());
        	if($('#phone_need').val() == 2 && phone == "") {
        		layer.open({content:"手机号码不能为空！",btn:"确定"});
                return;
        	}
        	if(phone != "" && !/^(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/.test(phone)) {
        		layer.open({content:"手机号码格式有误！",btn:"确定"});
                return;
        	}
        }
        if($("#email").length != 0) {
        	email = $.trim($('#email').val());
        	if($('#email_need').val() == 2 && email == "") {
        		layer.open({content:"邮箱不能为空！",btn:"确定"});
                return;
        	}
        	if(email != "" && !/^([.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test(email)) {
        		layer.open({content:"邮箱格式有误！",btn:"确定"});
                return;
        	}
        }
        if($("#qq").length != 0) {
        	qq = $.trim($('#qq').val());
        	if($('#qq_need').val() == 2 && qq == "") {
        		layer.open({content:"QQ不能为空！",btn:"确定"});
                return;
        	}
        	if(qq != "" && !/^[1-9][0-9]{5,11}$/.test(qq)) {
        		layer.open({content:"QQ格式有误！",btn:"确定"});
                return;
        	}
        }
        var captcha = $('#captcha1').val();
        if (captcha == '') {
        	layer.open({content:"请输入验证码！",btn:"确定"});
            return;
        }
        var index=layer.open({type: 2,shadeClose:false});
        $.ajax({
            url: '/index.php/user/reg',
            type: 'POST',
            dataType: 'json',
            data: {
                'username' : uid,
                'password' : pwd,
                'confirmPassword':repwd,
                'vcode' : captcha,
                'qq': qq,
                'email': email,
                'phone': phone,
                'tj': $('#tj').val()
            },
            timeout: 30000,
            success: function (results) {
                layer.close(index);
	           	if(results=="200"){
	           		location.href="/user/login";
	           	}else{
	           		index = layer.open({content:results.description,btn:"确定",yes:function(){
	           			$('img#captcha_img1').trigger("click");
	           			layer.close(index);
	           		}});
	           	}
            }
        });
    });

    $('#register_btn_tj').on("click",function(event) {
        var qq = '';
        var email = '';
        var phone = '';

        var uid = $('#uid').val();
        var pwd = $('#pwd').val();
        var repwd = pwd;//$('#repwd').val();
        if (uid == '') {
            layer.open({content:"请输入用户名！",btn:"确定"});
            return;
        }
        if (!/^[A-Za-z0-9]{4,16}$/g.test(uid)) {
            layer.open({content:"请输入正确格式的用户名!",btn:"确定"});
            return;
        }
        if (pwd == '') {
            layer.open({content:"请输入密码！",btn:"确定"});
            return;
        }
        if (!/^[A-Za-z0-9]{6,12}$/g.test(pwd) || /^[A-Za-z]{1,12}$/g.test(pwd) || /^[0-9]{1,12}$/g.test(pwd)) {
            layer.open({content:"密码需6-12个字符，且为英数字符组合!",btn:"确定"});
            $('img#captcha_img1').trigger("click");
            return;
        }
        if (pwd != '' && pwd != repwd) {
            layer.open({content:"两次密码不一致！",btn:"确定"});
            return;
        }
        if($("#phone").length != 0) {
            phone = $.trim($('#phone').val());
            if($('#phone_need').val() == 2 && phone == "") {
                layer.open({content:"手机号码不能为空！",btn:"确定"});
                return;
            }
            if(phone != "" && !/^(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/.test(phone)) {
                layer.open({content:"手机号码格式有误！",btn:"确定"});
                return;
            }
        }
        if($("#email").length != 0) {
            email = $.trim($('#email').val());
            if($('#email_need').val() == 2 && email == "") {
                layer.open({content:"邮箱不能为空！",btn:"确定"});
                return;
            }
            if(email != "" && !/^([.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test(email)) {
                layer.open({content:"邮箱格式有误！",btn:"确定"});
                return;
            }
        }
        if($("#qq").length != 0) {
            qq = $.trim($('#qq').val());
            if($('#qq_need').val() == 2 && qq == "") {
                layer.open({content:"QQ不能为空！",btn:"确定"});
                return;
            }
            if(qq != "" && !/^[1-9][0-9]{5,11}$/.test(qq)) {
                layer.open({content:"QQ格式有误！",btn:"确定"});
                return;
            }
        }
        var captcha = $('#captcha1').val();
        if (captcha == '') {
            layer.open({content:"请输入验证码！",btn:"确定"});
            return;
        }
        var index=layer.open({type: 2,shadeClose:false});
        $.ajax({
            url: '/index.php/user/memberReg',
            type: 'POST',
            dataType: 'json',
            data: {
                'username' : uid,
                'password' : pwd,
                'confirmPassword':repwd,
                'vcode' : captcha,
                'qq': qq,
                'email': email,
                'phone': phone,
                'tj': $('#tj').val()
            },
            timeout: 30000,
            success: function (results) {
                layer.close(index);
                if(results=="200"){
                    location.href="/";
                }else{
                    index = layer.open({content:results.description,btn:"确定",yes:function(){
                        $('img#captcha_img1').trigger("click");
                        layer.close(index);
                    }});
                }
            }
        });
    });
    //是否已阅读法律声明
    $('#is_read').change(function() {
        if ($('#is_read:checked').val() == 'on') {//选中
            $('#register_btn').removeAttr('disabled');
            $('#register_btn').removeClass('gray');
        } else {
            $('#register_btn').attr('disabled', 'disabled');
            $('#register_btn').addClass('gray');
        }
    });
    
    $('#login_btn').on('click', function() {
    	location.href = '/user/login';
    });

    $('#reveal-left').on('click', function() {
        location.href = '/';
    });
    //换验证码
    $('img#captcha_img1').on("click",function() {
        $(this).attr('src','common/public/verifycode/'+Math.random());
    });
});