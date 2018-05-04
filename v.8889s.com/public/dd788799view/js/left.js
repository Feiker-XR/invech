function $_(_sId){ //取得指定id对象
	return document.getElementById(_sId);
}

function div_display(i){
	for(var s=0; s<10; s++){
		var div1 = "divdis"+s;
		var div2 = "zhf"+s;
		if(i == s){
			if($_(div1).style.display == "none"){
				$_(div1).style.display = "block";
				$_(div2).innerHTML = "－";
			}else{
				$_(div1).style.display = "none";
				$_(div2).innerHTML = "＋";
			}
		}else{
			$_(div1).style.display = "none";
			$_(div2).innerHTML = "＋";
		}
	}
}



function ShowHidden(i){
    var f = 1;
    for(var s=0; s<8; s++){
        var la = "Label"+s;
        var en = "en"+s;
        
        if(i == s){
            if(document.getElementById(la).style.display == "none")
            {
                $("#"+la).fadeIn();
                document.getElementById(en).className = "menulink_2";
            }else{
                document.getElementById(la).style.display = "none";
                document.getElementById(en).className = "menulink_1";
            }
        }else{
            document.getElementById(la).style.display = "none";
            document.getElementById(en).className = "menulink_1";
        }   
        f++;
    }   
}


function ShowHidden_c(i){
    var f = 1;
    for(var s=0; s<2; s++){
        var la = "Label_"+s;
        var en = "en_"+s;
        
        if(i == s){
            if(document.getElementById(la).style.display == "none")
            {
                $("#"+la).fadeIn();
                document.getElementById(en).className = "menulink_2";
            }else{
                document.getElementById(la).style.display = "none";
                document.getElementById(en).className = "menulink_1";
            }
        }else{
            document.getElementById(la).style.display = "none";
            document.getElementById(en).className = "menulink_1";
        }   
        f++;
    }   
}
function aLeftForm1Sub(obg){
	if(obg.username.value == "用户名" || obg.username.value == ""){
		//alert("请输入用户名!");
		obg.username.select();
		return false;
	}
	
	if(obg.password.value == "******" || obg.password.value == ""){
		//alert("请输入密码!");
		obg.password.select();
		return false;
	}
	
	if(obg.vlcodes.value == "验证码" || obg.vlcodes.value == ""){
		//alert("请输入验证码!");
		obg.vlcodes.select();
		return false;
	}
}

function next_checkNum_img(){
	document.getElementById("checkNum_img").src = "yzm.php?"+Math.random();
	return false;
}