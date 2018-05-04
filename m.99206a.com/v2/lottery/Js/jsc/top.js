function _getYear(d){
	var yr=d.getYear();
	if(yr<1000) yr+=1900;
	return yr;
}
var deng={};
deng.gourl=function(a,b){
	var l='/';
	if(a!='') l+=a+'/';
	l+=b+'.'+'php';
	window.open(l,"index");
	}
function tick(){
	function initArray(){
		for(i=0;i<initArray.arguments.length;i++) this[i]=initArray.arguments[i];
	}
	var isnDays=new initArray("星期日","星期一","星期二","星期三","星期四","星期五","星期六","星期日");
	var today=new Date();
	var hrs=today.getHours();
	var _min=today.getMinutes();
	var sec=today.getSeconds();
	var clckh=""+((hrs>12)?hrs-12:hrs);
	var clckm=((_min<10)?"0":"")+_min;clcks=((sec<10)?"0":"")+sec;
	var clck=(hrs>=12)?"下午":"上午";
	
	//document.getElementById("t_2_1").innerHTML = _getYear(today)+"/"+(today.getMonth()+1)+"/"+today.getDate()+"&nbsp;"+clckh+":"+clckm+":"+clcks+"&nbsp;"+clck+"&nbsp;"+isnDays[today.getDay()];
	document.getElementById("t_2_1").innerHTML = _getYear(today)+"/"+(today.getMonth()+1)+"/"+today.getDate()+"&nbsp;"+clckh+":"+clckm+":"+clcks;
	
	window.setTimeout("tick()", 100); 
}

var disnum=0;
function urlOnclick(url,i){
	if(window.parent.document.getElementById("new_left")){
		window.parent.document.getElementById("new_left").style.display="block";
	}else{
		document.getElementById("new_left").style.display="block";	
	}

if(window.parent.document.getElementById("new_right")){
		window.parent.document.getElementById("new_right").style.width="820px";
	}else{
		document.getElementById("new_right").style.width="820px";	
	}
			if(window.parent.document.body){
				window.parent.document.body.style.background="url(/images/bg_game.jpg) repeat-x scroll center top #1B110D";
			}else{
				document.body.style.background="url(/images/bg_game.jpg) repeat-x scroll center top #1B110D";
			}
    window.parent.document.getElementById("showselect").style.display="block";
	window.open(url,"mainFrame");  
	if(i >= 0){
		disnum = i;
		var as = document.getElementById("menu").getElementsByTagName("a");
		for(var s=0; s<as.length; s++){
			if(s == i){
				as[s].className = "homemenu";
			}else{
				as[s].className = "alink";
			}
		}
	}
}


function turl(i){
	if(window.parent.document.getElementById("new_left")){
		window.parent.document.getElementById("new_left").style.display="block";
	}else{
		document.getElementById("new_left").style.display="block";	
	}

	if(window.parent.document.getElementById("new_right")){
		window.parent.document.getElementById("new_right").style.width="820px";
	}else{
		document.getElementById("new_right").style.width="820px";	
	}
	
			if(window.parent.document.body){
				window.parent.document.body.style.background="url(/images/bg_game.jpg) repeat-x scroll center top #1B110D";
			}else{
				document.body.style.background="url(/images/bg_game.jpg) repeat-x scroll center top #1B110D";
			}
	window.parent.document.getElementById("showselect").style.display="block";
	if(i==0){		//体育
		window.open("/show/FT_1_1.html","mainFrame");  
		window.open("/left.php","leftFrame");  	
	}else if(i==1){			//乐透
		window.open("/lotto/?action=k_tm","mainFrame");  
		window.open("/lotto/left.php","leftFrame");  
	}else if(i==2){			//乐透

		if(window.parent.document.getElementById("new_left")){
			window.parent.document.getElementById("new_left").style.display="none";
		}else{
			document.getElementById("new_left").style.display="none";	
		}
	
		if(window.parent.document.getElementById("new_right")){
			window.parent.document.getElementById("new_right").style.width="1000px";
		}else{
			document.getElementById("new_right").style.width="1000px";	
		}

		window.open("/lottery.php","mainFrame");  
	}else{			//乐透
		window.open("/lottery.php","mainFrame");  
		window.open("/lottery/left.php","leftFrame");  	  
	}	
	
}

function Lottery_Go(url){
	if(url=='Jxssc' || url=='Xjssc' || url=='Kl8'){
		alert("即将推出，尽情期待！");
	}else{
		if(window.parent.document.getElementById("new_left")){
		window.parent.document.getElementById("new_left").style.display="block";
	}else{
		document.getElementById("new_left").style.display="block";	
	}

	if(window.parent.document.getElementById("new_right")){
		window.parent.document.getElementById("new_right").style.width="820px";
	}else{
		document.getElementById("new_right").style.width="820px";	
	}
		//window.location.href='/lottery/'+url+'.php';
		window.open('/lottery/'+url+'.php',"mainFrame");  
		window.open('/lottery/left.php',"leftFrame");  
	}
}

function urlparent(url){
	window.open(url,"newFrame");
}

function topMouseEvent(mi,ty,i){
	if(ty == "o" && i != disnum){
		mi.className = "homemenua";
	}else if(ty == "t" && i != disnum){
		mi.className = "alink";
	}
}

$(document).ready(function(){
	$("#vlcodes").focus(function(){
		document.getElementById("checkNum_img").src = 'yzm.php?'+Math.random(); //更换验证码
	});
});


function aLeftForm1Sub(){
	var un	=	$("#username").val();
	if(un == "" || un == "帐户"){
		$("#username").focus();
		return false;
	}
	var pw	=	$("#password").val();
	if(pw == "" || pw == "******"){
		$("#password").focus();
		return false;
	}
	$("#formsub").attr("disabled",true); //按钮失效
	$.post("/logincheck.php",{r:Math.random(),action:"login",username:un,password:pw},function(login_jg){
		//alert(login_jg);
		if(login_jg.indexOf("1")>=0){ //验证码错误
			alert("验证码错误，请重新输入");
			$("#vlcodes").select();
		}else if(login_jg.indexOf("2")>=0){ //用户名称或密码
			alert("用户名或密码错误，请重新输入");
			$("#vlcodes").val(''); //清空验证码
			$("#password").val(''); //清空验证码
			$("#username").select();
		}else if(login_jg.indexOf("3")>=0){ //停用，或被删除，或其它信息
			alert("账户异常无法登陆，如有疑问请联系在线客服");
		}else if(login_jg.indexOf("4")>=0){ //登陆成功
	if(window.parent.document.getElementById("new_left")){
		window.parent.document.getElementById("new_left").style.display="block";
	}else{
		document.getElementById("new_left").style.display="block";	
	}
			//window.parent.document.getElementById("showselect").style.display="block";

if(window.parent.document.getElementById("new_right")){
		window.parent.document.getElementById("new_right").style.width="820px";
	}else{
		document.getElementById("new_right").style.width="820px";	
	}
			if(window.parent.document.body){
				window.parent.document.body.style.background="url(/images/bg_game.jpg) repeat-x scroll center top #1B110D";
			}else{
				document.body.style.background="url(/images/bg_game.jpg) repeat-x scroll center top #1B110D";
			}

			window.location.href='top.php';
			parent.mainFrame.location.href='show/shouye.php';
			parent.leftFrame.location.href='left.php';
		}	
		//alert(login_jg);											 
		$("#formsub").attr("disabled",false); //按钮有效
	});
}

function get_dled(){
	$.getJSON("getDLED.php?callback=?",function(json){
		$("#dled").html("("+json.dled+")");
	});
}