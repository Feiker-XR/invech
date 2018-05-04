function setbet(match_id,tid){
	if($(parent.topFrame.document).find("#username").length){ //没有登录
	   alert("登录后才能进行此操作");
	   return ;
	}
	 
	//$.post("/ajaxleft/jinrong.php",{match_id:match_id,tid:tid,rand:Math.random()},function (data){  parent.leftFrame.bet(data); });   

	$.ajax({
		url : '/ajaxleft/islogin.html',
		dataType : 'json',
		success : function(data) {
			if (data.islogin == 1) {
				$.post("/ajaxleft/jinrong.html",{match_id:match_id,tid:tid,rand:Math.random()},function (data){
					parent.leftFrame.bet(data);
				});
			} else {
				alert('请登陆后操作！');
			}
		}
	})		
}
