var if_name;
function setbet(ball_sort,touzhuxiang,point_column,numbers,bet_point){
	if($(parent.topFrame.document).find("#username").length<=0){ //没有登录
		alert("登录后才能进行此操作");
		return;
	}
	
	if(startOdds == 2) return false; //封盘不下注
	
	issue = issue?issue:'';
	$.post(
	    "/ajaxleft/bet_match_jsc.php",
		{issue:issue,ball_sort:ball_sort,touzhuxiang:touzhuxiang,point_column:point_column,numbers:numbers,bet_point:bet_point},
		function(data){
			parent.leftFrame.bet_jsc(data);
		}
	);
}

function setbet_odd(){
	//offsetHeight和 scrollHeight
	if($(parent.topFrame.document).find("#username").length<=0){ //没有登录
		alert("登录后才能进行此操作");
		return;
	}
	
	if(startOdds == 2){alert('已封盘，请稍后投注下一期。'); return false; }//封盘不下注
	issue = issue?issue:'';
	var ball_sort=$('#bet_odd input[name="ball_sort"]').val();
	
	var inputV = $('#bet_odd input[type="text"]');
	var noV;
	
	$.each(inputV, function(i,v){
		if($(this).val() != ''){
			noV = 1;
			return true;
		}
	});
	if(noV != 1){ //没有输入任何数据
		alert("请在盘口金额框输入投注金额后，\n再来点击投注按钮进行投注操作。\n\n温馨提示：\n点击盘口赔率也可以进行投注操作");
		return false;
	}
	
	issue=issue.replace('-','');
	
	$('#bet_odd input[name="issue"]').val(issue);
	
	if_name = randomString(8);
	
	JqueryDialog.jd_iframe = if_name;
	JqueryDialog.cSubmitText = '提交';
	JqueryDialog.Open2(ball_sort+' - 第 '+issue+' 期', '', 300, 100);
	
	$("#jd_submit").attr("disabled",true);
	
	$("#"+if_name).attr('src','/ajaxleft/bet_odd.html');
	$('#jd_dialog_m_h').css('cursor','default');
	
	$('#'+if_name).load(function(){
		$.post(
		    "/ajaxleft/bet_match_jsc_odd.php",
			$("#bet_odd").serialize(),
			function(datas){
				$('#'+if_name).contents().find("#bet_data").html(datas);
				$('#'+if_name).contents().find("#bet_mes").hide();
				$("#jd_submit").attr("disabled",false);
				ch_WH();
			}
		);
	});		
}

function ch_WH(){
	$('#'+if_name).height($('#'+if_name).contents().find("body").height());
	$('#jd_dialog_m_b').height($('#'+if_name).contents().find("body").height());
}

function clos_Fc(){
	$('#jd_shadow').remove();
	$('#jd_dialog').remove();
}

function randomString(length){
	var chars = '123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');
	if(!length){
		length = Math.floor(Math.random() * chars.length);
	}
	var str = '';
	for(var i = 0; i < length; i++){
		str += chars[Math.floor(Math.random() * chars.length)];
	}
	return str;
}

function repeat(){
	$('#bet_odd input[type="text"]').val('');
	$('#bet_odd input[type="text"]').attr('class','fk');
}