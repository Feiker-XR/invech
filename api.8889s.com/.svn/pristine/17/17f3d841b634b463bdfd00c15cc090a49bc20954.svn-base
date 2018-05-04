var game_data;
var $t,fp;
$(function(){
	loadinfo();
});

function loadinfo(){
	clearTimeout($t);
	$.post("class/ajax_time.php", function(data)
	{
		game_data=data;
		autotime();
	}, "json");
	$t = setTimeout("loadinfo()",10000);
}

function autotime(){
	clearTimeout(fp);
	for($i=0;$i<game_data.length;$i++){
		if(game_data[$i].opentime>0){
			if($i==0) endtime_six(game_data[$i].opentime,game_data[$i].game,$i);
			else endtime(game_data[$i].opentime,game_data[$i].game,$i);
		}else{
			$('#'+game_data[$i].game+'_t').addClass('f_right2').html("封盘");
		}
	}
	fp = setTimeout("autotime()",1000);
}
function getIS(s){
    var i=Math.floor(s/60);
    if(i < 10) i = '0'+i;
    var ss	=	s%60;
    if(ss < 10) ss = '0'+ss;
    return i+":"+ss;
}

function endtime_six(intDiff,game,game_index)
{
	//alert(game);
	var day=0,
		hour=0,
		minute=0,
		second=0;//时间默认值		
	if(intDiff > 0){
		day = Math.floor(intDiff / (60 * 60 * 24));
		hour = Math.floor(intDiff / 3600);
		minute = Math.floor(intDiff / 60) - (hour * 60);
		second = Math.floor(intDiff) - (hour * 60 * 60) - (minute * 60);
	}else{
		clearTimeout(fp);
		clearTimeout($t);
		loadinfo();
	}
	if (hour <= 9) hour = '0' + hour;
	if (minute <= 9) minute = '0' + minute;
	if (second <= 9) second = '0' + second;
	$('#'+game_data[game_index].game+'_t').html(hour+":"+minute+":"+second);
	intDiff--;
	game_data[game_index].opentime=intDiff;
}

function endtime(iTime,game,game_index)
{
	//alert(game);
	var iMinute,iSecond;
    var sMinute="",sSecond="",sTime="";
    iMinute = parseInt((iTime/60)%60);
	if (iMinute == 0){
		sMinute = "00";
    }
    if (iMinute > 0 && iMinute < 10){
    	sMinute = "0" + iMinute;
    }
	if (iMinute > 10){
    	sMinute = iMinute;
    }
    iSecond = parseInt(iTime%60);
    if (iSecond >= 0 && iSecond < 10 ){
    	sSecond = "0" + iSecond;
    }
	if (iSecond >= 10 ){
    	sSecond =iSecond;
    }
    sTime= sMinute + sSecond;
	if(iTime<0){
		clearTimeout(fp);
		clearTimeout($t);
		loadinfo();
    }else{
		iTime--;
		if(iTime>60){
			$('#'+game_data[game_index].game+'_t').html(getIS(iTime-60));
			if($('#'+game_data[game_index].game+'_t').hasClass('f_right2')){
				$('#'+game_data[game_index].game+'_t').removeClass('f_right2');
			}
		}

		if( iTime<=60 && iTime>0){
		     $('#'+game_data[game_index].game+'_t').html(getIS(iTime));
			 if(!$('#'+game_data[game_index].game+'_t').hasClass('f_right2')){
				$('#'+game_data[game_index].game+'_t').addClass('f_right2');
			}
		}
		game_data[game_index].opentime=iTime;
    }
}