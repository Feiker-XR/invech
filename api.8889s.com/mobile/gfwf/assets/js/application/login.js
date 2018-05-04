requirejs(["jquery","layer"],function($,layer){
	$("#reveal-left2").on("click", function(e) {
			location.href='/';
  //       if(/member/g.test(document.referrer)) {
		// } else {
		// 	history.go(-1);
		// }
    });
	
	 $('#login_btn').on("click",function (event) {
        console.log(1);
        var uid = $('#login_uid').val().trim();
        var pwd = $('#login_pwd').val().trim();
        if (uid == '') {
        	layer.open({content:"请输入用户名！",btn:"确定"});
            return;
        }
        if (pwd == '') {
        	layer.open({content:"请输入密码！",btn:"确定"});
            return;
        }
        var index=layer.open({type: 2,shadeClose:false});
        $.ajax({
           url:"/index.php/user/logined",
            type: 'POST',
            dataType: 'json',
            data: {
                'username': uid,
                'password': pwd
            },
            timeout: 30000,
            success: function (results) {
            	layer.close(index);
                if(results=="200"){
                	var url_ref = $('[name="ref_url"]').val().trim();
                	url_ref=url_ref || "/index.php";//引号为默认跳转
                	location.href=url_ref;
                }else{
                	layer.open({content:results,btn:"确定"});
                }
                
            }
        });
    });
    //注册
    $('button#register').on("click",function (event) {
        location.href = '/index/reg';
    });

    //试玩登录
    $('button#login_demo').on("click",function (event) {
        location.href = 'common/register?type=2';
    });
});