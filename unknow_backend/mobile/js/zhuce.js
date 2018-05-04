// JavaScript Document
function inputFocus(self,e){
	
	self.style.background = "#DDFFDE";
	if(document.getElementById("zhuce_top")){
		var d = document.getElementById("zhuce_top").getElementsByTagName("span");
	}else{
		var d = document.getElementById("zhuce_top1").getElementsByTagName("span");
	}
	d[e].className = "zhuce_06"
	switch(e){
		case 0 :
		d[e].innerHTML = "<font class='fontcolor'>您在网站的登录帐户，5-12个英文或数字组成</font>";
		break;
		
		case 1 :
		d[e].innerHTML = "<font class='fontcolor'>请牢记您的密码</font>"
		break;
		
		case 2 :
		d[e].innerHTML = "<font class='fontcolor'>请重复密码,必须和上面输入的密码一致!</font>"
		break;
		 
		case 3 :
		d[e].innerHTML = "<font class='fontcolor'>名字必须与您用于提款及存款的银行户口所用名字相同!</font>"
		break;
		
		case 4 :
		//d[e].innerHTML = "<font class='fontcolor'>请填写您正确的电话号码!</font>"
		break;
		
		case 11 :
		d[e].innerHTML = "<font class='fontcolor'>请填写您正确的电子邮箱!</font>"
		break;
		
		case 6 :
		d[e].innerHTML = "<font class='fontcolor'>请选择您的密保问题!</font>"
		break;
		
		case 7 :
		d[e].innerHTML = "<font class='fontcolor'>请填写您的密保问题答案!</font>"
		break;
		
		case 8 :
		d[e].innerHTML = "<font class='fontcolor'>请输入您的取款密码,此密码将在您提款时使用!</font>"
		break;
		
		case 9 :
		d[e].innerHTML = "<font class='fontcolor'>请重复上面的取款密码!</font>";
		break;
		
		case 10 :
		d[e].innerHTML = "<font class='fontcolor'>请输入右图中的验证码!</font>";
		break;
		
	}
	
}

function inputBlur(self,e){
	self.style.background = "#ffffff";
	if(document.getElementById("zhuce_top")){
		var d = document.getElementById("zhuce_top").getElementsByTagName("span");
	}else{
		var d = document.getElementById("zhuce_top1").getElementsByTagName("span");
	}
	
	if(self.value == ""){
		//d[e].className = "zhuce_03";
		switch(e){
			case 0 :
			d[e].innerHTML = "<font class='zhuce_03'>请输入用户名!</font>";
			self.pd = "no";
			break;
			
			case 1 :
			d[e].innerHTML = "<font class='zhuce_03'>请输入密码!</font>";
			self.pd = "no";
			break;
			
			case 2 :
			d[e].innerHTML = "<font class='zhuce_03'>请重复密码!</font>";
			self.pd = "no";
			break;
			
			case 3 :
			d[e].innerHTML = "<font class='zhuce_03'>请输入真实的姓名!</font>";
			self.pd = "no";
			break;
			
			case 4 :
			d[e].innerHTML = "<font class='zhuce_03'>请填写电话!</font>";
			self.pd = "no";
			break;
			
			case 11 :
			d[e].innerHTML = "<font class='zhuce_03'>请填写邮箱!</font>";
			self.pd = "no";
			break;
			
			case 6 :
			d[e].innerHTML = "<font class='zhuce_03'>密保问题不能为空!</font>";
			self.pd = "no";
			break;
			
			case 7 :
			d[e].innerHTML = "<font class='zhuce_03'>密保答案不能为空!</font>";
			self.pd = "no";
			break;
			
			case 8 :
			d[e].innerHTML = "<font class='zhuce_03'>取款密码不能为空!</font>";
			self.pd = "no";
			break;
			
			case 9 :
			d[e].innerHTML = "<font class='zhuce_03'>请重复取款密码!</font>";
			self.pd = "no";
			break;
			
			case 10 :
			d[e].innerHTML = "<font class='zhuce_03'>验证码不能为空!</font>";
			self.pd = "no";
			break;
			
		}
	}else{
		switch(e){
			case 0 : 
			var zz = /^[0-9a-zA-Z]{5,16}$/;
			if(!zz.test(self.value)){
				d[e].innerHTML = "<font class='zhuce_03'>您在网站的登录帐户，5-12个英文或数字组!</font>";
				self.pd = "no";
			}else{
				var url = "check_username.php?username="+self.value;
				xhr(url);
			}
			break;
			
			case 1 : 
			var zz = /^.{6,16}$/;
			if(!zz.test(self.value)){
				d[e].innerHTML = "<font class='zhuce_03'>请输入密码，6-12位间任意字符组成!</font>";
				self.pd = "no";
			}else{
				d[e].className = "zhuce_04";
				d[e].innerHTML = "<font color='green'>填写正确!</font>";
				self.pd = "yes";
			}
			break;
			
			
			case 2 : 
			var xx = /^.{6,12}$/;
			if(self.value != document.getElementById("pwd1").value || !xx.test(self.value)){
				d[e].innerHTML = "<font class='zhuce_03'>密码格式有误或和上面输入的密码不一致,请检查!</font>";
				self.pd = "no";
			}else{
				d[e].className = "zhuce_04";
				d[e].innerHTML = "<font color='green'>填写正确!</font>";
				self.pd = "yes";
			}
			break;
			
			case 3 : 
			if(self.value.length > 20 ){
				d[e].innerHTML = "<font class='zhuce_03'>用户名长度不应超过20个字符!</font>";
				self.pd = "no";
			}else{
				if(isNoChinese(self.value)){
					d[e].className = "zhuce_04";
					d[e].innerHTML = "<font color='green'>填写正确!</font>";
					self.pd = "yes";
				}else{
					d[e].innerHTML = "<font class='zhuce_03'>用户名只能为中文!</font>";
					self.pd = "no";
				}
			}
			break;
			
			case 4 : 
			if(self.value.length > 50 ){
				d[e].innerHTML = "<font>电话长度不应超过50个字符!</font>";
				self.pd = "no";
			}else{
				d[e].className = "zhuce_04";
				d[e].innerHTML = "<font color='green'>填写正确!</font>";
				self.pd = "yes";
			}
			break;
			
			case 11 : 
			var em = /[0-9a-zA-Z_]+@[0-9a-zA-Z_]+\.[0-9a-zA-Z_]+/
			if(!em.test(self.value)){
				d[e].innerHTML = "<font>邮箱格式不正确,如：test@163.com</font>";
				self.pd = "no";
			}else{
				d[e].className = "zhuce_04";
				d[e].innerHTML = "<font color='green'>填写正确!</font>";
				self.pd = "yes";
			}
			break;
			
			case 6 : 
			d[e].className = "zhuce_04";
			d[e].innerHTML = "<font color='green'>操作正确!</font>";
			self.pd = "yes";
			break;
			
			case 7 : 
			d[e].className = "zhuce_04";
			d[e].innerHTML = "<font color='green'>操作正确!</font>";
			self.pd = "yes";
			break;
			
			case 8 : 
			var zz = /^.{6,12}$/;
			if(!zz.test(self.value)){
				d[e].innerHTML = "<font class='zhuce_03'>请输入取款密码，6-12位间任意字符组成!</font>";
				self.pd = "no";
			}else{
				d[e].className = "zhuce_04";
				d[e].innerHTML = "<font color='green'>填写正确!</font>";
				self.pd = "yes";
			}
			break;
			
			case 9 : 
			var xx = /^.{6,12}$/;
			if(self.value != document.getElementById("qkpwd1").value || !xx.test(self.value)){
				d[e].innerHTML = "<font class='zhuce_03'>密码格式有误或和上面输入的密码不一致,请检查!</font>";
				self.pd = "no";
			}else{
				d[e].className = "zhuce_04";
				d[e].innerHTML = "<font color='green'>填写正确!</font>";
				self.pd = "yes";
			}
			break;
			
			case 10 : 
			d[e].className = "zhuce_04";
			d[e].innerHTML = "<font color='green'>操作正确!</font>";
			self.pd = "yes";
			break;
		}
	}
	
}

function formsubmit(obja){

	if(document.getElementById("zhuce_top")){
		var d = document.getElementById("zhuce_top").getElementsByTagName("span");
	}else{
		var d = document.getElementById("zhuce_top1").getElementsByTagName("span");
	}
		
	var bool = true;

	for(i=0; i<obja.length; i++){
		if(obja.elements[i].value == "" && obja.elements[i].name != "jsr"  && obja.elements[i].name != "zcemail"){
			obja.elements[i].style.background = "#DDFFDE";
			//d[i].className = "zhuce_03";
			d[i].innerHTML = "<font class='zhuce_03'>此项不能为空</font>";
			bool = false;
			
		}
	}

//return false;
	if(!bool) return false;
	for(i=0; i<obja.length; i++){
		if(obja.elements[i].pd == "no"){
			obja.elements[i].style.background = "#DDFFDE";
			d[i].className = "zhuce_03";
			bool = false;
			////return false;
		}
	}
	if(!bool) return false;

	//return false;
	if(obja.zccheck.checked == false){
		alert("如果您已满十八岁而且同意本站[条款及规则],请在该项打勾");
		return false;
	}
	
	
	
}

function change_zc_yzm(id){
	document.getElementById(id).src = "yzm.php?"+Math.random();
	return false;
	
}

function getreturn(){
	if (xmlhttp.readyState == 4) {//如果已经获取到完整数据
		if (xmlhttp.status == 200) {
			var text = xmlhttp.responseText;
			
			if(text == "y"){
				document.getElementById("nameid").className = "zhuce_04";
				document.getElementById("nameid").innerHTML = "<font color='green'>恭喜您,用户名可用!</font>";
				document.getElementById("zcusername").pd = "yes";
			}else{
				document.getElementById("nameid").className = "zhuce_03";
				document.getElementById("nameid").innerHTML = "<font'>抱歉,用户名已经被占用!</font>";
				document.getElementById("zcusername").pd = "no";
			}
			
		} else {
			alert('系统错误提示：'+xmlhttp.status);
			document.getElementById("nameid").innerHTML = "操作失败!";
			document.getElementById("zcusername").pd = "no";
		}
	}
}

function isNoChinese(v){
	var reg=/[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/gi;
	if (reg.test(v)) return true;
	else return false;
}

//CharMode函数 
//测试某个字符是属于哪一类
function CharMode(iN) {
	if (iN>=48 && iN <=57) //数字
		return 1;
	if (iN>=65 && iN <=90) //大写字母
		return 2;
	if (iN>=97 && iN <=122) //小写
		return 4;
	else
		return 8; //特殊字符
}

//bitTotal函数
//计算出当前密码当中一共有多少种模式
function bitTotal(num) {
	var modes=0;
	for (i=0;i<4;i++) {
		if (num & 1) modes++;
		num>>>=1;
	}
	return modes;
}

//checkStrong函数
//返回密码的强度级别
function checkStrong(sPW) {
    if (sPW.length<=6) return 0; //密码太短
	var Modes=0;
	for (i=0;i<sPW.length;i++) {      //测试每一个字符的类别并统计一共有多少种模式
		Modes|=CharMode(sPW.charCodeAt(i));
	}
	return bitTotal(Modes);
}

//pwStrength函数
//当用户放开键盘或密码输入框失去焦点时,根据不同的级别显示不同的颜色
function pwStrength(pwd,num) {
	var O_color="btn-default";
	var L_color="btn-danger";
	var M_color="btn-warning";
	var H_color="btn-success";
	if (pwd==null||pwd==''){
		Lcolor=Mcolor=Hcolor=O_color;
	}else{
		S_level=checkStrong(pwd);
		switch(S_level) {
			case 0://最强
				Lcolor=Mcolor=Hcolor=O_color;
			case 1://最弱
				Lcolor=L_color;
				Mcolor=Hcolor=O_color;
				break;
			case 2://中等
				Lcolor=Mcolor=M_color;
				Hcolor=O_color;
				break;
			default://默认
				Lcolor=Mcolor=Hcolor=H_color;
		}
	}
	$('#strength_L'+num).attr('class','btn '+Lcolor);
	$('#strength_M'+num).attr('class','btn '+Mcolor);
	$('#strength_H'+num).attr('class','btn '+Hcolor);
	// document.getElementById("strength_L"+num).style.background=Lcolor;
	// document.getElementById("strength_M"+num).style.background=Mcolor;
	// document.getElementById("strength_H"+num).style.background=Hcolor;
	return;
}

$(document).ready(function(){  

	$('#register').click(function() {
		
		if($.trim($('#zcusername').val()).length<5) {
			alert("会员账号必须大于5位");
			$('#zcusername').focus();
			return false;
		}
		var usern = /^[a-zA-Z0-9]{5,}$/;
		if(!$('#zcusername').val().match(usern)){
			alert("账户名只允许字母和数字组合");
			$('#zcusername').focus();
			return false;
		}
		
		if($('#zcpwd1').val() == "") {
			alert("会员密码不能为空");
			$('#zcpwd1').focus();
			return false;
		}
		
		if($('#zcpwd1').val() != $('#zcpwd2').val()) {
			alert("会员密码不一致，请检查");
			$('#zcpwd1').focus();
			return false;
		}
		
		if($.trim($('#zcturename').val()) == "") {
			alert("会员账号不能为空");
			$('#zcturename').focus();
			return false;
		}
		
		if($.trim($('#zctel').val()) == "") {
			//alert("QQ不能为空");
			//$('#zctel').focus();
			//return false;
		}
		
		if($.trim($('#zcanswer').val()) == "") {
			alert("密码问题答案不能为空");
			$('#zcanswer').focus();
			return false;
		}
		
		if($('#qkpwd1').val() == "") {
			alert("取款密码不能为空");
			$('#qkpwd1').focus();
			return false;
		}
		
		if($('#qkpwd1').val() != $('#qkpwd2').val()) {
			alert("取款密码不一致，请检查");
			$('#qkpwd1').focus();
			return false;
		}
		
		if($('#zcyzm').val() == "") {
			alert("验证码不能为空");
			$('#zcyzm').focus();
			return false;
		}
		
		var isChecked = $('#zccheck').prop('checked'); 
		if (!isChecked){
			alert("您必须同意开户条约才能注册");
			$('#zccheck').focus();
			return false;
		}
		
		$.ajax({
			type: "POST",
			url:"/index/create.html",
			data:$('#register_form').serialize(),// 你的formid
			error: function(request) {
				alert("发生错误，请稍后再试");
			},
			success: function(data) {
				/*
				if(data == "OK") {
					alert("注册成功，欢迎您的加入金莎娱乐城");
					parent.window.location.reload();
				} else {
					alert(data);
				}
				*/
				if(data.status == 1) {
					alert("注册成功，欢迎您的加入皇冠娱乐城");
					parent.window.location.reload();
				} else {
					alert(data.msg);
				}				
			}
		});
		
		return false;
	});
	
	$('#cancel_register').click(function() {
		$(':input','#register_form')  
		 .not(':button, :submit, :reset, :hidden')  
		 .val('')  
		 .removeAttr('checked')  
		 .removeAttr('selected');  
		return false;
	});
	
	$('#AGREEMENT').click(function() {
		window.open("/agreement.php?uid=guest", '开户协议', 'width=600,height=450,left=400'); 
		return false;
	});
  
});  