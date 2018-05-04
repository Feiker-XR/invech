/* Create a new XMLHttpRequest object to talk to the Web server */
var xmlHttp = false;
/*@cc_on @*/
/*@if (@_jscript_version >= 5)
try {
  	xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  	try {
    		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  	} catch (e2) {
    		xmlHttp = false;
  	}
}
@end @*/

if (!xmlHttp && typeof XMLHttpRequest != "undefined") {
  xmlHttp = new XMLHttpRequest();
}

var ret1 = false;
function userTest(){
	try{
		var nameval  = document.getElementById('U').value;
		var alertObj = document.getElementById('show1');
		var imgObj = document.getElementById('imgshow1');
		
		if(nameval == "") {
			ret1 = false;
			imgObj.innerHTML='<img src="images/reg0.png" />';
			alertObj.value="用户账号不能为空！";
		} else if(RegExp(/^[\u4e00-\u9fa5]+$/).test(nameval)) {
			ret1 = false;
			imgObj.innerHTML='<img src="images/reg0.png" />';
			alertObj.value="用户账号不能使用中文！";	
		} else if(!RegExp(/^[A-Za-z0-9_]*$/).test(nameval)) {
			ret1 = false;
			imgObj.innerHTML='<img src="images/reg0.png" />';
			alertObj.value="您输入的用户账号中含有非法字符！";		
			
		}else if(nameval.length<6 || nameval.length>16){
			ret1 = false;
			imgObj.innerHTML='<img src="images/reg0.png" />';
			alertObj.value="用户账号长度应该在6-16位！";
			
		} else {
/*			ret1 = true;
			imgObj.innerHTML='<img src="images/reg1.png" />';
			alertObj.value="";	*/
			var url = "check_username.php?username="+nameval;
			xmlHttp.open("GET", url, true);
			xmlHttp.onreadystatechange = usernameOk;
			xmlHttp.setRequestHeader("If-Modified-Since","0");
			xmlHttp.setRequestHeader("Cache-Control","no-cache");
			xmlHttp.send(null);	
		}	
		
	}catch(exception){}		
}

function usernameOk(){
		var alertObj = document.getElementById('show1');
		var imgObj = document.getElementById('imgshow1');
		if (xmlHttp.readyState == 4) {
			try{
				var response = xmlHttp.responseText;
				if(response != "y"){	
					ret1 = false;
					imgObj.innerHTML='<img src="images/reg0.png" />';
					alertObj.value="用户账号已经存在，请选择其他注册。	";
				}else{
					ret1 = true;
					imgObj.innerHTML='<img src="images/reg1.png" />';
					alertObj.value="";
				}
			}catch(exception){}
		}
	

}



var ret2 = false;
function pasTest(){
	var passwordval  = document.getElementById('Pas').value;
	var alertObj = document.getElementById('show2');
	var imgObj = document.getElementById('imgshow2');	
	if(passwordval == "") {
		ret2 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="登陆密码不能为空！";
		
	}else if(passwordval.length<6 || passwordval.length>20){
		ret2 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="登陆密码长度应该在6-20位！";
		
	}else if(!RegExp(/^[A-Za-z0-9~`!@#$%\^&\*()\=\+_\-\.]*$/).test(passwordval)){
		ret2 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="你输入的登陆密码中含有非法字符！";
		
	} else {
		ret2 = true;
		imgObj.innerHTML='<img src="images/reg1.png" />';
		alertObj.value="";
	}	
}

var ret3 = false;
function passTest(){
	var passwordval  = document.getElementById('Pas').value;
	var passwordsval  = document.getElementById('Pass').value;
	var alertObj = document.getElementById('show3');
	var imgObj = document.getElementById('imgshow3');	
	if(passwordsval == "") {
		ret3 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="确认密码不能为空！";
		
	}else if(passwordval!=passwordsval){
		ret3 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="两次输入密码不一致！";
		
	} else {
		ret3 = true;
		imgObj.innerHTML='<img src="images/reg1.png" />';
		alertObj.value="";
	}	
}


var ret4 = false;
function PhoneTest(){
	var Phoneval  = document.getElementById('Phone').value;
	var alertObj = document.getElementById('show4');
	var imgObj = document.getElementById('imgshow7');	
	if(Phoneval == "") {
		ret4 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="联系电话号码不能为空！";
	} else if(!RegExp(/^([0-9-]){7,20}$/).test(Phoneval)) {
		ret4 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="联系电话号码不正确！";
	} else {
		ret4 = true;
		imgObj.innerHTML='<img src="images/reg1.png" />';
		alertObj.value="";
	}	
}


var ret04 = false;
function mailTest(){
	var mailval  = document.getElementById('Email').value;
	var alertObj = document.getElementById('show5');
	var imgObj = document.getElementById('imgshow5');	
	if(mailval == "") {
		ret04 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="电子邮箱不能为空！";
	
	} else if(!RegExp(/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/).test(mailval)) {
		ret04 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="电子邮箱格式错误！";
	} else {
		ret04 = true;
		imgObj.innerHTML='<img src="images/reg1.png" />';
		alertObj.value="";
	}	
}

var ret5 = false;
function RealnameTest(){
	var Realnameval  = document.getElementById('Realname').value;
	var alertObj = document.getElementById('show6');
	var imgObj = document.getElementById('imgshow6');	
	if(Realnameval == "") {
		ret5 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="提款人姓名不能为空！";
	
	} else if(!RegExp(/^[\u4e00-\u9fa5]+$/).test(Realnameval)) {
		ret5 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="填写正确提款姓名！";
	} else {
		ret5 = true;
		imgObj.innerHTML='<img src="images/reg1.png" />';
		alertObj.value="";
	}	
}


var ret6 = false;
function tkpasTest(){
	var Realpas  = document.getElementById('Realpas').value;
	var alertObj = document.getElementById('show7');
	var imgObj = document.getElementById('imgshow8');		
	if(Realpas == "") {
		ret6 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="提款密码不能为空！";
		
	}else if(Realpas.length<6 || Realpas.length>26){
		ret6 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="提款密码长度应该在6-26位！";
		
	}else if(!RegExp(/^[A-Za-z0-9~`!@#$%\^&\*()\=\+_\-\.]*$/).test(Realpas)){
		ret6 = false;
		imgObj.innerHTML='<img src="images/reg0.png" />';
		alertObj.value="你输入的提款密码中含有非法字符！";
		
	} else {
		ret6 = true;
		imgObj.innerHTML='<img src="images/reg1.png" />';
		alertObj.value="";
	}	
}

var ret8 = false;
function numberTest(){
	try{
		var numberval = document.getElementById('number').value;
		var alertObj  = document.getElementById('show8');
		var imgObj = document.getElementById('imgshow9');	
		if(numberval == "" || numberval.length<4) {
			ret8 = false;
			imgObj.innerHTML='<img src="images/reg0.png" />';
			alertObj.value="验证码输入不正确！";	
		} else {
			
			var url = "/checkNumber.php?number=" +numberval;
			xmlHttp.open("GET", url, true);
			xmlHttp.onreadystatechange = numberOk;
			xmlHttp.setRequestHeader("If-Modified-Since","0");
			xmlHttp.setRequestHeader("Cache-Control","no-cache");
			xmlHttp.send(null);
		}	
		
	}catch(exception){}		
}



function numberOk(){
	var alertObj = document.getElementById('show9');	
	var imgObj = document.getElementById('imgshow9');	
	if (xmlHttp.readyState == 4) {
		
		try{
			var response = xmlHttp.responseText;
			if(response == "no"){	
				ret8 = false;
				imgObj.innerHTML='<img src="images/reg0.png" />';
				alertObj.value="验证码输入不正确！";
			}else{
				ret8 = true;
				imgObj.innerHTML='<img src="images/reg1.png" />';
				alertObj.value="";
			}
		}catch(exception){}
	}
}


var ret9 = false;
function answer(){
	var zcanswer = document.getElementById('zcanswer').value;
	var imgObj = document.getElementById('imgshow4');	
	if(zcanswer == "") {
		 ret9 = false;
		 imgObj.innerHTML='<img src="images/reg0.png" />';
		 document.getElementById('show9').value='密码答案不能为空！';
	}else{
		 ret9 = true;
		 imgObj.innerHTML='<img src="images/reg1.png" />';	
		 document.getElementById('show9').value='';
	}
}

 function reg(){
	 userTest();
	 if(ret1==false){
		var u=document.getElementById('show1').value;
		alert(u);
		document.getElementById('U').focus();
		return false; 
	 }
	 pasTest();
	 if(ret2==false){
		var p=document.getElementById('show2').value;
		alert(p);	
		document.getElementById('Pas').focus();
		return false; 
	 }
	 passTest();
	  if(ret3==false){
		var p1=document.getElementById('show3').value;
		alert(p1);	
		document.getElementById('Pass').focus();
		return false; 
	 }
	 answer();
	 if(ret9==false){ 	
		var da=document.getElementById('show9').value;
		alert(da)
		document.getElementById('zcanswer').focus();
		return false; 
	 }
	 mailTest();
	 if(ret04==false){
		var ma=document.getElementById('show5').value;
		alert(ma);	
		document.getElementById('Email').focus();
		return false; 
	 }
	RealnameTest(); 
	if(ret5==false){
		var n=document.getElementById('show6').value;
		alert(n);	
		document.getElementById('Realname').focus();
		return false; 
	 }
	 
	 PhoneTest();
	 if(ret4==false){
		var h=document.getElementById('show4').value;
		alert(h);	
		document.getElementById('Phone').focus();
		return false; 
	 }
	 tkpasTest();
	  if(ret6==false){
		var tp=document.getElementById('show7').value;
		alert(tp); 
		document.getElementById('Realpas').focus();
		return false; 
	 }
	  numberTest();
	  if(ret8==false){ 
		var mb=document.getElementById('show8').value;
		alert(mb)
		document.getElementById('number').focus()
		return false; 
	 }
	if(document.getElementById("reg100").checked!=true){
		alert('请同意万丰国际俱樂部条款条件规则！');
		return false; 		
	}
	

}

function rus0(st0){
	document.getElementById(st0).style.display = "block";
}

function rus1(st1){
	document.getElementById(st1).style.display = "none";
}