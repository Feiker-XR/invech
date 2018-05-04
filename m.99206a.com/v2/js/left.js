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
                //document.getElementById(en).className = "menulink_2";
            }else{
                document.getElementById(la).style.display = "none";
                //document.getElementById(en).className = "menulink_1";
            }
        }else{
            document.getElementById(la).style.display = "none";
            //document.getElementById(en).className = "menulink_1";
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
                //document.getElementById(en).className = "menulink_2";
            }else{
                document.getElementById(la).style.display = "none";
                //document.getElementById(en).className = "menulink_1";
            }
        }else{
            document.getElementById(la).style.display = "none";
            //document.getElementById(en).className = "menulink_1";
        }   
        f++;
    }   
}

function ShowHidden_a(i){
    var f = 1;
    for(var s=0; s<2; s++){
        var la = "Label"+s;
        var en = "en"+s;
        
        if(i == s){
            if(document.getElementById(la).style.display == "none")
            {
                $("#"+la).fadeIn();
                //document.getElementById(en).className = "left_2 b"+f;
            }else{
                document.getElementById(la).style.display = "none";
                //document.getElementById(en).className = "left_2 a"+f;
            }
        }else{
            document.getElementById(la).style.display = "none";
           // document.getElementById(en).className = "left_2 a"+f;
        }   
        f++;
    }   
}


function ShowHidden_d(i){
    var f = 1;
    for(var s=0; s<2; s++){
        var la = "Label"+s;
        var en = "en"+s;
        
        if(i == s){
                $("#"+la).fadeIn();

        }else{
            document.getElementById(la).style.display = "none";
           // document.getElementById(en).className = "left_2 a"+f;
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

function f5_left(){
					$("#s_zq").html("");
					$("#s_zq_ds").html("");
					$("#s_zq_gq").html("");
					$("#s_zq_sbc").html("");
					$("#s_zq_sbbd").html("");
					$("#s_zq_bd").html("");
					$("#s_zq_rqs").html("");
					$("#s_zq_bqc").html("");
					$("#s_zq_jg").html("");
					$("#s_zqzc").html("");
					$("#s_zqzc_ds").html("");
					$("#s_zqzc_sbc").html("");
					$("#s_zqzc_sbbd").html("");
					$("#s_zqzc_bd").html("");
					$("#s_zqzc_rqs").html("");
					$("#s_zqzc_bqc").html("");
					$("#s_lm").html("");
					$("#s_lm_ds").html("");
					$("#s_lm_dj").html("");
					$("#s_lm_gq").html("");
					$("#s_lm_jg").html("");
					$("#s_lmzc").html("");
					$("#s_lmzc_ds").html("");
					$("#s_lmzc_dj").html("");
					$("#s_wq").html("");
					$("#s_wq_ds").html("");
					$("#s_wq_bd").html("");
					$("#s_wq_jg").html("");
					$("#s_pq").html("");
					$("#s_pq_ds").html("");
					$("#s_pq_bd").html("");
					$("#s_pq_jg").html("");
					$("#s_bq").html("");
					$("#s_bq_ds").html("");
					$("#s_bq_zdf").html("");
					$("#s_bq_jg").html("");
					$("#s_jr").html("");
					$("#s_jr_jr").html("");
					$("#s_jr_jg").html("");
					$("#s_gj").html("");
					$("#s_gj_gj").html("");
					$("#s_gj_jg").html("");
					
					$("#user_money").html("");
					top.mem_index.$("#user_num").html("");
					$("#f5").css("display","");
					$("#cg_f").html("");
					$("#cg_f1").html("");
					$("#cg_f_0").html("");
					$("#cg_f_1").html("");
					$("#cg_f_2").html("");
					$("#cg_f_3").html("");
					$("#cg_f1_0").html("");
					$("#cg_f1_2").html("");	
					$("#cg_f1_2").html("");
					$("#cg_f1_3").html("");																

	
	getLeftJSON();
}


function bet_jsc(data){

	$("#submit_from_jsc").attr("disabled",false);
	$("#bet_money_jsc").val("");
	$("#istz_jsc").css("display","none");
	$("#bet_money_jsc").removeClass("read");
	$("#bet_money_jsc").addClass("edit");
	$("#bet_money_jsc").attr("readonly",false);
	$("#win_span_jsc").html("0.00");
	$("#win_span1_jsc").html("0.00");
	$("#bet_win_jsc").val("0.00");	

	$("#bet_moneydiv_jsc").show();
	$("#touzhudiv_jsc").hide();
	$("#touzhudiv_jsc").html(data).fadeIn();
	$("#xp_jsc").show();
	// $("#ds_01_bet").hide();
	 //$("#kefu").hide();
	 $("#left_ids").show();
	 $("#usersid").show();
	 $("#user_money_jsc").html($("#user_money").html());
	 
}
