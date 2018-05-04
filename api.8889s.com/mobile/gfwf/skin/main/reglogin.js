function userBeforeLogin(){
	var u=this.username.value;
	if(!u || u=='帐号'){ xingcai("请输入用户名");}
	else{return true;}
	return false;
}
function userLogin(err, data){
	if(err){
		xingcai(err);
		$("#vcode").trigger("click");
	}else{
		location='/';
	}
}
function xingcai(tips,style,minH){
  layer.open({
  icon: 9,
  content: (tips) ,
  btn:"确定"
});
}