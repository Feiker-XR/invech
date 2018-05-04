function GoTo(type,url,mulu){
	// class = 0 弹出新窗口
	// class = 1 根目录跳转
	// class = 2 直接跳转目录
	// class = 3 根据指定目录跳转
	if(type=='0'){
		window.open('/'+url+'.php',"newFramedd");
	}
	if(type=='1'){
		window.location.href='/index/'+url+'/';
	}
	if(type=='2'){
		window.location.href='/'+url+'/';
	}
	if(type=='3'){
		window.location.href='/'+mulu+'/index/type/'+url+'/';
	}
	if(type == '4'){
		self.location.href='/'+mulu+'/'+url+'/';
	}
	if(type == '5'){
		self.location.href='/'+mulu+'/'+url;
	}	
}

function OnlineService(){
	window.open("http://f88.live800.com/live800/chatClient/chatbox.jsp?companyID=684504&configID=137026&jid=4939537941","newFramekf");
}

function AboutUs(id){
	window.location.href='/AboutUs.php?type='+id;
}

function Login(){
	var un = $('#username').val();
	var pw = $('#password').val();
	if(un == "" || un == "账号"){
		alert("登录账号不能为空！");
		$("#username").focus();
		return false;
	}
	if(pw == "" || pw == "密码"){
		alert("登录密码不能为空！");
		$("#password").focus();
		return false;
	}
	$.ajax({
		type: "post",
		url: "/index/login",
		data:{'username':un,'password':pw},
		dataType:'json',
		async:'false',
		success:function(data) {
			if(data.status == 'y'){
				alert(data.info);
				window.reload()
			}else if(data.status == 'ns'){
				alert(data.info);
				window.location.href = document.URL;
			}else{
				alert(data.info);
			}
		}
	});
}

function keyLogin(){
  if (event.keyCode==13)
     $("#logkey").click();
}

function LoadUserInfo(){
	$.post("/top_money_data.php",function (data){ 
		var strs = new Array(); 
		var strs = data.split("|");
		$("#user_money").html(strs[0]);
		$("#live_money").html(strs[2]);
		if(parseInt(strs[1])>0){
			$("#user_sms").html('<embed src="/member/images/sms.wav" type="video/x-ms-asf-plugin" width="1" height="1" autostart="true" loop="true" />');
		}else{
			$("#user_sms").html('');
		}
	});
	setTimeout("LoadUserInfo()",5000);
}
function GoToMember(Args1,Args2){
	//window.open('/Member/?Args1='+Args1+'&Args2='+Args2,"newFrameinfo");
	window.location.href='/user/index?Args1='+Args1+'&Args2='+Args2;
}

function Go_forget_pwd(){
	alert("账户密码遗失请联系在线客服！");
}

$(function(){
	$('#openwindow').click(function(){
		var mysrc = 'http://777.apibox.info/cl/?module=MACenterView&other=memberData';
		window.open(mysrc,'newwindow','height=667,width=1024,top=30,left=100,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no'); 
	});	
	
});
