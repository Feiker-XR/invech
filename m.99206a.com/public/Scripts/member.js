document.oncontextmenu=new Function("event.returnValue=false;"); 
function digitOnly ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
	}
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
function isChinese(str){
	return /[\u4E00-\u9FA0]/.test(str);
}
function Go(url){
	window.location.href=url;
}

//表格各行换色
function bianse(o,a,b,c,d){ 
var t=document.getElementById(o).getElementsByTagName("tr"); 
for(var i=1;i<t.length-1;i++){ 
t[i].style.backgroundColor=(t[i].sectionRowIndex%2==0)?a:b; 
t[i].onclick=function(){ 
if(this.x!="1"){ 
this.x="1";//本来打算直接用背景色判断，FF获取到的背景是RGB值，不好判断 
this.style.backgroundColor=d; 
}else{ 
this.x="0"; 
this.style.backgroundColor=(this.sectionRowIndex%2==0)?a:b; 
} 
} 
t[i].onmouseover=function(){ 
if(this.x!="1")this.style.backgroundColor=c; 
} 
t[i].onmouseout=function(){ 
if(this.x!="1")this.style.backgroundColor=(this.sectionRowIndex%2==0)?a:b; 
} 
} 
} 
//二级联动
var strArea = new Array(); 
strArea[0] = ['总账户','0','A','ALL'];
strArea[1] = ['AG旗舰厅','1','A','AG']; 
strArea[2] = ['BB娱乐场','2','A','BB']; 
strArea[3] = ['VIP国际厅','3','A','VIP']; 
strArea[4] = ['新天地旗舰厅','4','A','XTD']; 
strArea[5] = ['MG娱乐场','5','A','MG']; 
strArea[6] = ['AG旗舰厅','6','0','AG']; 
strArea[7] = ['BB娱乐场','7','0','BB']; 
strArea[8] = ['VIP国际厅','8','0','VIP']; 
strArea[9] = ['新天地旗舰厅','9','0','XTD']; 
strArea[10] = ['MG娱乐场','10','0','MG']; 
strArea[11] = ['总账户','11','1','ALL']; 
strArea[12] = ['总账户','12','2','ALL']; 
strArea[13] = ['总账户','13','3','ALL']; 
strArea[14] = ['总账户','14','4','ALL']; 
strArea[15] = ['总账户','15','5','ALL']; 
function ddl_Clear(ddl_name){ 
    var obj = document.getElementById(ddl_name); 
    for(var i = obj.options.length - 1;i >= 0;i--){ 
        obj.options[i] = null; 
    } 
} 
function ddl_selected(ddl_name,match_val,isValue){ 
    var obj = document.getElementById(ddl_name); 
    for( var i = 0; i < obj.options.length; i++ ){ 
        var matchobj = obj.options[i].value; 
        if(!isValue){ 
            matchobj = obj.options[i].Text; 
        } 
        if(match_val == matchobj){ 
            obj.options[i].selected = "selected"; 
        } 
    } 
} 
function delspace(findstr){ 
    var myfind = findstr;  
    for(var i = 0; i < findstr.length; i++){ 
        var myfind = myfind.replace(" ",""); 
    } 
    return myfind; 
} 
function ddl_Bind(ddl_name,bindData,keyword){  
    var obj = document.getElementById(ddl_name); 
    for( var i = 0;i < bindData.length; i++ ){ 
        if(bindData[i][2] == keyword){ 
              if(i == 0){ 
                  if(bindData[i][0] != ""){ 
                      obj.add(new Option(bindData[i][0],bindData[i][1])); 
                  } 
              } 
              else{ 
                  obj.add(new Option(bindData[i][0],bindData[i][1])); 
              } 
        }     
    } 
    var num = 0; 
    var subValue = obj.options[num].value; 
    ddl_selected(ddl_name, num, true) 
    ddl_changed('To', subValue, strArea); 
}  
function ddl_changed(ddl_name,keywords,ddl_data){     
    var obj = document.getElementById(ddl_name);  
    var m = 0; 
     
    ddl_Clear(ddl_name);  
    for( var i = 0; i < ddl_data.length; i++ ){         
        if( ddl_data[i][2] == keywords ){ 
            obj.options[m] = ( new Option( ddl_data[i][0],ddl_data[i][3] ) ); 
            m = m + 1; 
        }         
    }   
    obj.fireEvent("onchange"); 
} 
function GoToMoney(){
	var Money = $("#GoToMoney").val();
	var Go	= $("#Go").val();
	var To	= $("#To").val();
	var Key	= $("#Key").val();
	var GoToType = $("#GoToType").val();
	if(Money==''){
		alert("请输入要转换的金额！");
		return false;
	}
	$("#loading").show();
	$("#button").attr("disabled","true");
	$.post("GoTo_Money.php", {T:Math.random() ,Go:Go ,To:To , Money:Money ,Key:Key ,GoToType:GoToType}, function(data)
	{
		alert(data.txt);
		$("#loading").hide();
		location.reload();
	}, "json");
}
function TakeMoney(){
	var Money = $("#Money").val();
	var MoneyPass	= $("#MoneyPass").val();
	var Key	= $("#Key").val();
	var Num	= $("#Num").val();
	if(Money==''){
		alert("请输入提款金额！");
		return false;
	}
	$("#loading").show();
	if(Num>50000){
		if(confirm('您今日的提款已经超过【5次】！\n\n每笔提款我们将收取50元手续费作为行政费用！\n\n您确定还要继续提款吗？')){
			$("#button").attr("disabled","true");
			$.post("Take_Money.php", {T:Math.random() ,Money:Money ,MoneyPass:MoneyPass ,Key:Key , Num:Num}, function(data)
			{
				if(data.ok>0){
					$("#loading").hide();
					alert('提款申请成功！\n\n财务部门将在审核过后，将您的提款金额存入您的提款账号中！\n\n您也可以到会员中心【提现记录】里查询您的提款状态！');
					Go('TakeList.php');
					return false;
				}
				if(data.ok==0){
					$("#loading").hide();
					alert(data.txt);
					location.reload();
					return false;
				}
			}, "json");
		}else{
			return false;
		}
	}else{
		$("#button").attr("disabled","true");
		$.post("Take_Money.php", {T:Math.random() ,Money:Money ,MoneyPass:MoneyPass ,Key:Key , Num:Num}, function(data)
		{
			if(data.ok>0){
				$("#loading").hide();
				alert('提款申请成功！\n\n财务部门将在审核过后，将您的提款金额存入您的提款账号中！\n\n您也可以到会员中心【提现记录】里查询您的提款状态！');
				Go('TakeList.php');
				return false;
			}
			if(data.ok==0){
				$("#loading").hide();
				alert(data.txt);
				location.reload();
				return false;
			}
		}, "json");
	}
	
}
function LoadMoney(){
	$.post("../Money/Load_Money.php", {type:1 ,t:Math.random()}, function(data)
	{
		$("#Ag_Money").html(data.money);
	}, "json");
	/*
	$.post("../Money/Load_Money.php", {type:0 ,t:Math.random()}, function(data)
	{
		$("#All_Money").html(data.money);
	}, "json");
	$.post("../Money/Load_Money.php", {type:3 ,t:Math.random()}, function(data)
	{
		$("#Vip_Money").html(data.money);
	}, "json");
	$.post("../Money/Load_Money.php", {type:2 ,t:Math.random()}, function(data)
	{
		$("#Bb_Money").html(data.money);
	}, "json");
	$.post("../Money/Load_Money.php", {type:4 ,t:Math.random()}, function(data)
	{
		$("#Xtd_Money").html(data.money);
	}, "json");
	$.post("../Money/Load_Money.php", {type:5 ,t:Math.random()}, function(data)
	{
		$("#Mg_Money").html(data.money);
	}, "json");
	*/
}
function SubInfo(){
	var Money = $('#v_amount').val();
	var IntoBank = $('#IntoBank').val();
	var cn_date = $('#cn_date').val();
	var InType = $('#InType').val();
	var v_Name = $('#v_Name').val();
	var v_site = $('#v_site').val();
	if(Money=='' || IntoBank=='' || cn_date=='' || InType=='' || v_Name=='' || v_site==''){
		alert('请填写完整表单！');
		return false;
	}
	if(Money<100){
		alert('公司入款最低100元！');
		return false;
	}
	$('#form1').submit(); 
}