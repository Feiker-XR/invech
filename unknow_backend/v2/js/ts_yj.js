function check(){
	if($("#tf_title").val().length < 1){
		$("#tf_title").focus();
		return false;
	}else if($("#tf_title").val().length > 50){
		$("#tf_title").select();
		return false;
	}
	if($("#ta_msg").val().length < 1){
		$("#ta_msg").focus();
		return false;
	}else if($("#ta_msg").val().length > 300){
		$("#ta_msg").select();
		return false;
	}
	if($("#tf_yzm").val().length != 4){
		$("#tf_yzm").select();
		return false;
	}
}

function next_checkNum_img(){
	document.getElementById("checkNum_img").src = "yzm.php?"+Math.random();
	return false;
}