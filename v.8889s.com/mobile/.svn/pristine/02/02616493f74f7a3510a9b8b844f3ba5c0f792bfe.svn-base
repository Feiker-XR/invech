$(function(){
$('.pay_style_choose').find(".pay_style_choose_1,.pay_style_choose_2").click(function(){
	$(this).addClass('on').siblings('div').removeClass('on');
	$("#paytype").val($(this).attr('data'));
	$("#payform").attr("action",$(this).attr('data-url'));
	if($(this).attr('data-target') != ''){
		$("#payform").attr("target",$(this).attr('data-target'));
	}else{
		$("#payform").removeAttr("target");
	}
})	

$('.pay_firstpart_btn').click(function(){
	$('.pay_firstpart').hide();
	$('.pay_name').show();
	
})
})

function next_checkNum_img(){
	document.getElementById("checkNum_img").src = "/index.php/captcha.html?d="+Math.random();
	return false;
}
//数字验证 过滤非法字符
function clearNoNum(obj){
    //先把非数字的都替换掉，除了数字和.
    obj.value = obj.value.replace(/[^\d.]/g,"");
    //必须保证第一个为数字而不是.
    obj.value = obj.value.replace(/^\./g,"");
    //保证只有出现一个.而没有多个.
    obj.value = obj.value.replace(/\.{2,}/g,".");
    //保证.只出现一次，而不能出现两次以上
    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
    if(obj.value != ''){
    var re=/^\d+\.{0,1}\d{0,2}$/;
          if(!re.test(obj.value))   
          {   
	          obj.value = obj.value.substring(0,obj.value.length-1);
	          return false;
          } 
    }
}	

function showTypeTxt(t){
    if(t==1){
        $('#v_type').hide();
    }else{
        $('#v_type').show();
    }
}

function showType(){
    if($('#InType').val()=='0'){
        $('#v_type').show();
        $('#tr_v').hide();
    }else if($('#InType').val()=='网银转账' || $('#InType').val()=='支付宝转账'){
        $('#tr_v').show();
        $('#v_Name').val('请输入持卡人姓名');
        $('#v_type').hide();
        $('#IntoType').val($('#InType').val());
    }else{
        $('#v_type').hide();
        $('#IntoType').val($('InType').val());
        $('#tr_v').hide();
    }
}

function showType1(){
    if($('#IntoBank').val()=='支付宝'){
		 $('#InType').val('支付宝转账');
			showType();
        }
    }
	
 function SubInfo(){
		var hk	=	$('#v_amount').val();
    if(hk==''){
        alert('请输入转账金额');
        $('#v_amount').focus();
        return false;
    }else{
			hk = hk*1;
			if(hk<100){
				alert('转账金额最底为：100元');
				$('#v_amount').select();
				return false;
			}
		}
    if($('#IntoBank').val()==''){
        alert('为了更快确认您的转账,请选择转入银行');
        $('#IntoBank').focus();
        return false;
    }
    if($('#cn_date').val()==''){
        alert('请选择汇款日期');
                return false;
            }
  
            if($('#InType').val()==''){
        alert('为了更快确认您的转账,请选择汇款方式');
        $('#InType').focus();
         return false;
    }
    if($('#InType').val()=='0'){
        if($('#v_type').val()!= '' && $('#v_type').val()!='请输入其它汇款方式'){
            $('#IntoType').val($('#v_type').val());
        }else{
            alert('请输入其它汇款方式');
            $('#v_type').focus();
            return false;
        }
    }
    if($('#InType').val()=='网银转账'){
        if($('#v_Name').val()!=''&& $('#v_Name').val()!='请输入持卡人姓名' && $('#v_Name').val().length>1 && $('#v_Name').val().length<20){
            var tName =$('#v_Name').val();
            var yy = tName.length;
            for(var xx=0;xx<yy; xx++){
                var zz = tName.substring(xx,xx+1);
                if(zz!='·'){
                    if(!isChinese(zz)){
                        alert('请输入中文持卡人姓名,如有其他疑问,请联系在线客服');
                        $('#v_Name').focus();
                        return false;
                    }
                }
            }
        }else{
            alert('为了更快确认您的转账,网银转账请输入持卡人姓名');
            $('#v_Name').focus();
            return false;
        }
    }
    if($('#v_site').val()==''){
        alert('请填写汇款地点');
        $('#v_site').focus();
        return false;
    }
    if($('#v_site').val().length>49){
        alert('汇款地点不要超过50个中文字符');
        $('#v_site').focus();
        return false;
    }
    if($('#vlcodes').val()==''){
        alert('请输入验证码');
        $('#vlcodes').focus();
        return false;
    }
    return true;
    //$('#form1').submit(); 
}

function alertMsg(i){
    if(i==1){
        alert('阁下,您好:\n您已经成功提交一笔 汇款信息 未处理,请等待处理后再提交新的汇款信息! ');
        LoadValImg();
    }
    if(i==2){
        alert('汇款信息提交成功，请等待处理');
        window.location.href='ScanTrans.aspx';
    }
}
//是否是中文
function isChinese(str){
    return /[\u4E00-\u9FA0]/.test(str);
}

function url(u){
	window.location.href=u;
}