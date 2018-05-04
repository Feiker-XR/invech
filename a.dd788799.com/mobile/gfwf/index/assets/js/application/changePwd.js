 requirejs(["jquery","layer","common"],function($,layer){
       $("#login-btn").on("click",function(e){
        e.preventDefault();
         var pwd = $('#pwd').val();
        var newpwd = $('#newpwd').val();
        var repwd = $('#repwd').val();
        if (pwd == '') {
            layer.open({content:"请输入旧密码！",btn:"确定"});
            return;
        }
        if (newpwd == '') {
            layer.open({content:"请输入新密码！",btn:"确定"});
            return;
        }
        if (!/[A-Za-z0-9]{6,12}/g.test(newpwd) || !/[A-Za-z]{1,12}/g.test(newpwd) || !/[0-9]{1,12}/g.test(newpwd)) {
            layer.open({content:"密码需6-12个字符，且为英数字符组合!",btn:"确定"});
            return;
        }
        if (repwd == '') {
            layer.open({content:"请输入确认密码！",btn:"确定"});
            return;
        }
        if (newpwd != repwd) {
            layer.open({content:"两次密码不一致！",btn:"确定"});
            return;
        }
        if (pwd == newpwd) {
            layer.open({content:"新旧登录密码不能相同！",btn:"确定"});
            return;
        }
        var index=layer.open({type: 2,shadeClose:false});
        $.ajax({
            url: '/index.php/safe/setPasswd',
            type: 'POST',
            dataType: 'json',
            data: {
                'oldpassword' : pwd,
                'newpassword' : newpwd
            },
            timeout: 30000,
            success: function (results) {
                 layer.close(index);
                 if(results=="200"){
                    layer.open({
                        content: '登录密码修改成功',
                        btn:"确定",
                        yes:function(){
                        	location.href='/index.php/safe/more';
                        }
                      });
                 }else{
                    layer.open({content:results,btn:"确定"});
                 }
             }
        });
       });
    });