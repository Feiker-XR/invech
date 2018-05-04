var lhc_ball_color = {
	'01':'color_red', '02':'color_red', '07':'color_red', '08':'color_red', '12':'color_red', '13':'color_red',
	'18':'color_red', '19':'color_red', '23':'color_red', '24':'color_red', '29':'color_red', '30':'color_red',
	'34':'color_red', '35':'color_red', '40':'color_red', '45':'color_red', '46':'color_red',
	
	'03':'color_blue', '04':'color_blue', '09':'color_blue', '10':'color_blue', '14':'color_blue', '15':'color_blue',
	'20':'color_blue', '25':'color_blue', '26':'color_blue', '31':'color_blue', '36':'color_blue', '37':'color_blue',
	'41':'color_blue', '42':'color_blue', '47':'color_blue', '48':'color_blue',
	
	'05':'color_green', '06':'color_green', '11':'color_green', '16':'color_green', '17':'color_green', '21':'color_green',
	'22':'color_green', '27':'color_green', '28':'color_green', '32':'color_green', '33':'color_green', '38':'color_green',
	'39':'color_green', '43':'color_green', '44':'color_green', '49':'color_green'
};

var pcdd_ball_color = {
	'0':'color_grey', '1':'color_green', '2':'color_blue', '3':'color_red', '4':'color_green', '5':'color_blue', '6':'color_red', '7':'color_green', '8':'color_blue',
	'9':'color_red', '10':'color_green', '11':'color_blue', '12':'color_red', '13':'color_grey', '14':'color_grey', '15':'color_red', '16':'color_green', '17':'color_blue',
	'18':'color_red', '19':'color_green', '20':'color_blue', '21':'color_red', '22':'color_green', '23':'color_blue', '24':'color_red', '25':'color_green', '26':'color_blue', '27':'color_grey'
};

function leftPad(num, n, m) {  
	return Array(n>num?(m-(''+num).length+1):0).join(0)+num;  
};

function unixToDate(unixTime, isFull, timeZone) {
	 if(typeof (timeZone) == 'number') {
		 unixTime = parseInt(unixTime) + parseInt(timeZone) * 60 * 60;
	 }
	 var time = new Date(unixTime);
	 var ymdhis = "";
	 ymdhis += time.getUTCFullYear() + "-";
	 ymdhis += leftPad((time.getUTCMonth()+1), 10, 2) + "-";
	 ymdhis += leftPad(time.getUTCDate(), 10, 2);
	 if(isFull === true) {
		 ymdhis += " " + leftPad(time.getHours(),10,2) + ":";
		 ymdhis += leftPad(time.getMinutes(),10,2) + ":";
		 ymdhis += leftPad(time.getSeconds(),10,2);
	 }
	 return ymdhis;
}

$(function() {
        //头部左边返回
        $("#reveal-left").on("click", function(e) {
            e.preventDefault();
            history.go(-1);
        });
        $(".bett-head").on("click", function() {
            $(".beet-rig").toggle();
            $('.beet-tips').hide();
        });
         $('.bett-top-box').on("click",function(){
	        $('.beet-tips').toggle();
			$('.beet-rig').hide();
		});
         window.isLogin=false;
         checkLogin();
         //检测登陆
		 function checkLogin() {
		    $.ajax({
		        url: 'common/checkLogin',//检测是否登录
		        type: 'GET',
		        dataType: 'json',
		        success: function (results) {
		            if(results.status=="200"){
		            	isLogin=true;
		            }
		        }
		    });
		}
});