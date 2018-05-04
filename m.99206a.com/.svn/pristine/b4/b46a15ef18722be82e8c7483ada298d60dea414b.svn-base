function check_submit(){
	if($("#qk_pwd").val()==""){
		alert("请输入您注册时设置的取款密码");
		$("#qk_pwd").focus();
		return false;
	}
	if(isnum($("#pay_value").val())){
    	alert("提款金额必须为正整数");
		$("#pay_value").focus();
		return false;
	}
	var num = $("#pay_value").val();
	if(num < 100){
		alert("提款金额最低为100元");
		$("#pay_value").select();
		return false;
	}
	var money = $("#hyye").html()*1;
	if(num > money){
		alert("对不起，您的余额不足");
		return false;
	}
	var yzm = $("#vlcodes").val();
	if( yzm.length < 4){
		alert("请您输入验证码");
		$("#vlcodes").select();
		return false;
	}
}

function check_submit_dl(){
	if($("#dl_pwd").val()==""){
		alert("请输入代理取款密码");
		$("#dl_pwd").focus();
		return false;
	}
	if(isnum($("#dl_value").val())){
    	alert("代理提款金额必须为正整数");
		$("#dl_value").focus();
		return false;
	}
	var num = $("#dl_value").val();
	if(num < 100){
		alert("代理提款金额最低为100元");
		$("#dl_value").select();
		return false;
	}
	var money = $("#ksqdled").html()*1;
	if(num > money){
		alert("对不起，您的代理额度不足");
		return false;
	}
	var yzm = $("#dl_vlcodes").val();
	if( yzm.length < 4){
		alert("请您输入验证码");
		$("#dl_vlcodes").select();
		return false;
	}
}
 
function isnum(v){
	if(v == (parseInt(v)*1)){
		 var num = v.indexOf(".");
		 if(num == -1) return false;
		 else{
			return true;
		 }
		 return false;
	}else{
		return true;
	}
}

function next_checkNum_img(){
	document.getElementById("checkNum_img").src = "../yzm.php?"+Math.random();
	return false;
}

function next_checkNum_img_dl(){
	document.getElementById("checkNum_img_dl").src = "../yzm.php?"+Math.random();
	return false;
}

function get_dled(){
	$.getJSON("../getDLED.php?callback=?",function(json){
		$("#dled").html(json.dled);
		if(json.dled > 0){
			$("#dled").css("color","#FF0000");
		}else{
			$("#dled").css("color","#000000");
		}
		
		$("#ksqdled").html(json.ksqdled);
		if(json.ksqdled > 0){
			$("#ksqdled").css("color","#FF0000");
		}else{
			$("#ksqdled").css("color","#000000");
		}
	});
}