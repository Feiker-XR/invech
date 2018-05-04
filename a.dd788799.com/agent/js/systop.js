// JavaScript Document
$(window).load(function() {
	action();
});

$(document).ready(function(){
  $("#hk_mp3").jPlayer({
   ready: function () {
    $(this).jPlayer("setMedia", {
     mp3: "/mp3/dd.mp3",
    });
   },
   swfPath: "/js",
   supplied: "mp3"
  });
 });

function stopplay(){
	$("#hk_mp3").jPlayer("stop");
}

function action(){
	// 您有   几条提款【查看】     几条汇款【查看】    信息未处理
    $.getJSON("/main/systopdao.html?callback=?",function(json){
		if(json.logout > 0){
			alert("您的账号有其他人登录，您被强制退出！");
			parent.location.href='/index/logout';
		}
			var sum = json.sum;
			var html = "";
			html += "<a href='/Money/TiKuan' target='mainFrame' onclick=\"stopplay();\">提款（"+json.tknum+"）条</a>";
			html += "<a href='/Money/HuiKuan' target='mainFrame' onclick=\"stopplay();\">汇款（"+json.hknum+"）条</a>";
			html += "<a href='/Agent/reg' target='mainFrame' >代理（"+json.dlsqnum+"）条</a>";
			html += "<a href='/chuanjs/index' target='mainFrame' >串关（"+json.cgnum+"）条</a>";
			$("#m_xx").html(html);
			if(sum>0){
				if(json.tknum > 0){
					$("#hk_mp3").jPlayer("setMedia", { mp3: "/mp3/dd.mp3",}).jPlayer("play"); 
					
				}
				if(json.hknum > 0){
					$("#hk_mp3").jPlayer("setMedia", { mp3: "/mp3/88.mp3",}).jPlayer("play"); 
				}
			}
			/*
			if(sum > 0){
				var html = "";
				
				if(json.tknum > 0){
					html += json.tknum+" 条 提款 <a style='font-weight:bold;' href='/Money/TiKuan.php' target='mainFrame' onclick=\"$('#hk_mp3').remove();\">【查看】</a>";
					$("#hk_mp3").html(""); //先清空，再添加提示声音
					//$("#hk_mp3").html(" <bgsound src='Mp3/00.mp3' loop='1'>"); //汇款提示声音
					document.getElementById('hk_mp3').innerHTML= "<embed src='/Mp3/dd.mp3' width='0' height='0'></embed>";
				}
				if(json.hknum > 0){
					html += json.hknum+" 条 汇款 <a style='font-weight:bold;' href='/Money/HuiKuan.php' target='mainFrame' onclick=\"$('#hk_mp3').remove();\">【查看】</a>";
					$("#hk_mp3").html(""); //先清空，再添加提示声音
					//$("#hk_mp3").html(" <bgsound src='Mp3/88.mp3' loop='1'>"); //汇款提示声音
					document.getElementById('hk_mp3').innerHTML= "<embed src='/Mp3/88.mp3' width='0' height='0'></embed>";
				}
				if(json.dlsqnum > 0){
					html += json.dlsqnum+" 条 代理申请 ";
				}
				if(json.cgnum > 0){
					html += json.cgnum+" 条 串关可结算 <a style='font-weight:bold;' href='/Sports/Chuan_Js.php' target='mainFrame'  onclick=\"$('#hk_mp3').remove();\">【查看】</a>";
				}						
				html += "信息未处理！";
				$("#m_xx").html(html);
			}else{
				$("#m_xx").html("暂无任何需要处理的事物！");
			}*/
		}
	);
	setTimeout("action()",10000); //30秒检测一次
}