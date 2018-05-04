var i = 31;
var aa; 
function check(){
	i = i -1;	
	if(i < 1){
		i=1;
		var varue = document.getElementById('league').value;
		loaded(varue,0);
	}
	$("#location").html("对不起,您点击页面太快,请在"+i+"秒后进行操作");
	aa = setTimeout("check()",1000);
}

function check22(){
	i = 31;
	clearTimeout(aa);
	check()
}


// 赛事选择
function Ok(){
    var lsm='';
    var checkboxs=document.getElementsByName("liangsai");
    for(var i=0;i<checkboxs.length;i++) {
        if(checkboxs[i].checked){
            lsm += checkboxs[i].value+"$";
        }
    }
    if(lsm == '') return false;

    document.getElementById("league").value	=	lsm;
    loaded(lsm);
    _close();
}

function fx(){ //反选
    var checkboxs=document.getElementsByName("liangsai");
    for(var i=0;i<checkboxs.length;i++) {
        checkboxs[i].checked = !checkboxs[i].checked;
    }
}

function cx(){ //重选
    var checkboxs=document.getElementsByName("liangsai");
    for(var i=0;i<checkboxs.length;i++) {
        checkboxs[i].checked = false;
    }
}
function _close(){
    $('#showTable table input:checked').removeAttr('checked');
    $('.curtions').hide();
}