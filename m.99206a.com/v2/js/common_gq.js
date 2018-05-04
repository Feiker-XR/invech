//if(self==top){
//	top.location='/';
//}

function go(url){
	location.href=url;
}

var time=11;  		//120秒自动刷新

$(document).ready(function(){
	Refresh(); //自动刷新
});

function Refresh(){
	time=time-1;
	if(time<1){
		time=60;
		$("#top_f5").val(document.documentElement.scrollTop);
		var league = document.getElementById('league').value
		var page = document.getElementById('aaaaa').innerHTML;
		loaded(league,page);
	}else{
		$("#sx_f5").val("刷新"+time);
	}
	setTimeout("Refresh()",1000);
}

function formatNumber(num,exponent){
	return parseFloat(num).toFixed(exponent);
}  

function shuaxin(league){
	time=11
	$("#top_f5").val(document.documentElement.scrollTop);
	var page = document.getElementById('aaaaa').innerHTML;
	loaded(league,page);
}

function NumPage(thispage){
	var league = document.getElementById('league').value;
	document.getElementById('aaaaa').innerHTML = thispage;
	loaded(league,thispage,'p');
}

function check_one(lsm){
	document.getElementById("league").value	=	lsm;
	loaded(lsm);
}

var li_top = 0;
function gdt(){
	li_top=document.documentElement.scrollTop;
	li_h=$("#top").height();
	if(li_h>1) li_h=(li_h/18-1)*15;
	if(li_top>38){
		li_top = (li_top-34-li_h)+"px";
		document.getElementById("lantiao").style.position = "relative";
		document.getElementById("lantiao").style.top = li_top;
	}else{
		document.getElementById("lantiao").style.top = "38px";
		document.getElementById("lantiao").style.position = "";
	}
}

$(window).scroll(function(){
	gdt();
});

function killerrors() {
	return true;
}
window.onerror = killerrors; 