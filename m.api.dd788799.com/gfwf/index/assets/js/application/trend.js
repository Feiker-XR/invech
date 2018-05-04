requirejs(["jquery","common"], function($) {
//对象转数组
    function obj2arr(obj) {
        var arr = [];
        for(var item in obj){
            arr.push(obj[item]);
        }
        return arr;
    }
    function drawLine() {
        var cvList = $('div#chartsDiv canvas');
        for (var i = 0; i < cvList.length; i++) {
            var tmpCv = cvList[i];
            var width = $(tmpCv).width();
            var height = $(tmpCv).height();
            var direc = $(tmpCv).data('direc');
            width = (width == undefined) ? 0 : parseInt(width);
            height = (height == undefined) ? 0 : parseInt(height);
            var context=tmpCv.getContext('2d');
            context.beginPath();
            if (direc == 1) {
                context.moveTo(0, 0);
                context.lineTo(width, height);
            } else {
                context.moveTo(0, height);
                context.lineTo(width, 0);
            }
            context.strokeStyle = '#FF0000';
            context.stroke();
        }
    }
    var trendPos = 1;
    var trendCount = 20;
    var noStr = '0|1|2|3|4|5|6|7|8|9';

    $("#reveal-left2").on("click", function(e) {
		if(/common\/hall/g.test(document.referrer)) {
			history.go(-1);
		} else {
			location.href='index';
		}
    });
    
    $('.trend-icon').on("click",function(){
        $('.trend-tips').show();
        $('.tips-bg').show();
    });
	$('.tips-bg').on("click",function(){
        $('.trend-tips').hide();
        $('.tips-bg').hide();
    });
    $('div.trend-tips li').on("click",function(){
        $('div.trend-tips li').removeClass('trend-on');
        $(this).addClass('trend-on');
        $('.trend-tips').hide();
        $('.tips-bg').hide();
        trendGid = $(this).data('gid');
        showPosTitle();
        $('div.trend-tit span').bind('touchend', function () {
            event.preventDefault();
            $('div.trend-tit span').removeClass('on');
            $(this).addClass('on');
            trendPos = $(this).data('pos');
            getTrendData();
        });
        //需要切换菜单，位置信息选项
        getTrendData();
    });
    function showPosTitle() {
        var gameName = {34:'幸运飞艇|9',1:'福彩3D|1', 2:'排列三|1', 3:'上海时时乐|1', 4:'天津时时彩|4', 5:'重庆时时彩|4', 6:'江西时时彩|4', 7:'新疆时时彩|4', 9:'北京PK拾|9', 10:'江苏快三|10', 11:'安徽快三|10', 12:'山东11选5|12', 13:'上海11选5|12', 14:'江西11选5|12', 15:'广东11选5|12', 16:'吉林快三|10', 17:'广西快三|10',51:'三分时时彩|4', 52:'三分PK拾|9'};
        //显示游戏名
        var gNameArr = gameName[trendGid].split('|');
        $('span#game_name').text(gNameArr[0]);
        if (gNameArr[1] == undefined) {
            return;
        }
        var gamePosArr = new Array();
        gamePosArr[1] = {0:'0|1|2|3|4|5|6|7|8|9',1:'百',2:'十',3:'个'};
        gamePosArr[4] = {0:'0|1|2|3|4|5|6|7|8|9',1:'万',2:'千',3:'百',4:'十',5:'个'};
        gamePosArr[9] = {0:'01|02|03|04|05|06|07|08|09|10',1:'一位',2:'二位',3:'三位',4:'四位',5:'五位',6:'六位',7:'七位',8:'八位',9:'九位',10:'十位'};
        gamePosArr[10] = {0:'1|2|3|4|5|6',1:'百',2:'十',3:'个'};
        gamePosArr[12] = {0:'01|02|03|04|05|06|07|08|09|10|11',1:'第一位',2:'第二位',3:'第三位',4:'第四位',5:'第五位'};
        //alert('位置');
        var posArr = obj2arr(gamePosArr[gNameArr[1]]);
        noStr = posArr[0];
        //alert('位置信息:'+posArr.join('&'));
        var posHtml = '';
        for (var i = 1; i < posArr.length; i++) {
            var tmpOn = (i == 1) ? 'class="on"' : '';
            posHtml += '<span data-pos="'+i+'" '+ tmpOn +'>'+posArr[i]+'</span>';
        }
        //alert('位置选项:'+posHtml);
        trendPos = 1;//默认1
        $('div#trend_pos').html(posHtml);
    }

     gameOpArr = {1:'fcsd',2:'tcps',3:'ssl',4:'tjssc',5:'cqssc',6:'jxssc',7:'xjssc',9:'pk10'
        ,10:'jsks',11:'ahks',12:'elevensd',13:'elevensh',14:'elevenjx',15:'elevengd'
        ,16:'jlks',17:'gxks'};
   $('button.trend-add').on("click",function() {
        if ($('li.game_li_'+trendGid).data('enable') == 1) {
            alert('该彩种正在维护！');
            return;
        }
        location.href = '/index/hall?gid='+trendGid;//跳转投注
    });
        $(function() {
        $('li.game_li_'+trendGid).trigger('click');
    });

    function getTrendData() {
        if (trendGid == null || trendGid == undefined || trendGid == '') {
            trendGid = 1;
        }
        $.ajax({
            url: '/zst/?typeid=86/getList',
            type: 'POST',
            dataType: 'json',
            data: {
                'gid' : trendGid,
                'count' : trendCount,
                'pos' : trendPos
            },
            timeout: 30000,
            success: function (results) {
            	$('div#chartsDiv canvas').remove();
        		$('#trend_table').html(null);
                if(results.status!="200"){
                	location.href="#";
                	return;
                }
                if(results.status=="200"){
                	var data=results.data;
                	if(data == null || data.itemCount == null || data.itemCount <= 0) {
                		$('div#chartsDiv canvas').remove();
                		$('#trend_table').html(null);
                		return;
                	}
                	
	                var headHtml = '';
	                var tbHtml = '';
	                var noArr = noStr.split('|');
	                var noLen = noArr.length;
	                headHtml = '<tr class="trend-titbg">' + '<th style="width: 8%">期数</th>';
	                for (var i = 0; i < noLen; i++) {
	                    headHtml += '<th>'+ noArr[i] +'</th>';
	                }
	                headHtml += '</tr>';
	                for (var i = 0; i < data.itemCount; i++) {
	                    var tmpOpenNum = data.items[i].openNum;
	                    var clsBg = (i % 2 == 1) ? 'class="trend-bg"' : '';
	                    tbHtml += '<tr ' + clsBg + '>';
	                    tbHtml += '<td>'+data.items[i].period+'</td>';
	                    if (data.items[i].num0 != undefined) {
	                        tbHtml += '<td>'+((tmpOpenNum == 0) ? '<span class="cur">':'')+data.items[i].num0+((tmpOpenNum == 0) ? '</span>':'')+'</td>';
	                    }
	                    tbHtml += '<td>'+((tmpOpenNum == 1) ? '<span class="cur">1':data.items[i].num1)+((tmpOpenNum == 1) ? '</span>':'')+'</td>';
	                    tbHtml += '<td>'+((tmpOpenNum == 2) ? '<span class="cur">2':data.items[i].num2)+((tmpOpenNum == 2) ? '</span>':'')+'</td>';
	                    tbHtml += '<td>'+((tmpOpenNum == 3) ? '<span class="cur">3':data.items[i].num3)+((tmpOpenNum == 3) ? '</span>':'')+'</td>';
	                    tbHtml += '<td>'+((tmpOpenNum == 4) ? '<span class="cur">4':data.items[i].num4)+((tmpOpenNum == 4) ? '</span>':'')+'</td>';
	                    tbHtml += '<td>'+((tmpOpenNum == 5) ? '<span class="cur">5':data.items[i].num5)+((tmpOpenNum == 5) ? '</span>':'')+'</td>';
	                    tbHtml += '<td>'+((tmpOpenNum == 6) ? '<span class="cur">6':data.items[i].num6)+((tmpOpenNum == 6) ? '</span>':'')+'</td>';
	                    if (data.items[i].num7 != undefined) {
	                        tbHtml += '<td>'+((tmpOpenNum == 7) ? '<span class="cur">7':data.items[i].num7)+((tmpOpenNum == 7) ? '</span>':'')+'</td>';
	                    }
	                    if (data.items[i].num8 != undefined) {
	                        tbHtml += '<td>'+((tmpOpenNum == 8) ? '<span class="cur">8':data.items[i].num8)+((tmpOpenNum == 8) ? '</span>':'')+'</td>';
	                    }
	                    if (data.items[i].num9 != undefined) {
	                        tbHtml += '<td>'+((tmpOpenNum == 9) ? '<span class="cur">9':data.items[i].num9)+((tmpOpenNum == 9) ? '</span>':'')+'</td>';
	                    }
	                    if (data.items[i].num10 != undefined) {
	                        tbHtml += '<td>'+((tmpOpenNum == 10) ? '<span class="cur">10':data.items[i].num10)+((tmpOpenNum == 10) ? '</span>':'')+'</td>';
	                    }
	                    if (data.items[i].num11 != undefined) {
	                        tbHtml += '<td>'+((tmpOpenNum == 11) ? '<span class="cur">11':data.items[i].num11)+((tmpOpenNum == 11) ? '</span>':'')+'</td>';
	                    }
	                    tbHtml += '</tr>';
	                }
	                //平均、最大遗漏
	                var ylHtml = '<tr class="trend-bg-average">'
	                    + '<td>平均遗漏</td>';
	                if (data.numAvg0 != undefined) {
	                    ylHtml += '<td>'+data.numAvg0+'</td>';
	                }
	                if (data.numAvg1 != undefined) {
	                    ylHtml += '<td>'+data.numAvg1+'</td>';
	                }
	                ylHtml += '<td>'+data.numAvg2+'</td>';
	                ylHtml += '<td>'+data.numAvg3+'</td>';
	                ylHtml += '<td>'+data.numAvg4+'</td>';
	                ylHtml += '<td>'+data.numAvg5+'</td>';
	                ylHtml += '<td>'+data.numAvg6+'</td>';
	                if (data.numAvg7 != undefined) {
	                    ylHtml += '<td>'+data.numAvg7+'</td>';
	                }
	                if (data.numAvg8 != undefined) {
	                    ylHtml += '<td>'+data.numAvg8+'</td>';
	                }
	                if (data.numAvg9 != undefined) {
	                    ylHtml += '<td>'+data.numAvg9+'</td>';
	                }
	                if (data.numAvg10 != undefined) {
	                    ylHtml += '<td>'+data.numAvg10+'</td>';
	                }
	                if (data.numAvg11 != undefined) {
	                    ylHtml += '<td>'+data.numAvg11+'</td>';
	                }
	                ylHtml += '</tr>';
	                ylHtml += '<tr>';
	                ylHtml += '<td>最大遗漏</td>';
	                if (data.numMax0 != undefined) {
	                    ylHtml += '<td>'+data.numMax0+'</td>';
	                }
	                if (data.numMax1 != undefined) {
	                    ylHtml += '<td>'+data.numMax1+'</td>';
	                }
	                ylHtml += '<td>'+data.numMax2+'</td>';
	                ylHtml += '<td>'+data.numMax3+'</td>';
	                ylHtml += '<td>'+data.numMax4+'</td>';
	                ylHtml += '<td>'+data.numMax5+'</td>';
	                ylHtml += '<td>'+data.numMax6+'</td>';
	                if (data.numMax7 != undefined) {
	                    ylHtml += '<td>'+data.numMax7+'</td>';
	                }
	                if (data.numMax8 != undefined) {
	                    ylHtml += '<td>'+data.numMax8+'</td>';
	                }
	                if (data.numMax9 != undefined) {
	                    ylHtml += '<td>'+data.numMax9+'</td>';
	                }
	                if (data.numMax10 != undefined) {
	                    ylHtml += '<td>'+data.numMax10+'</td>';
	                }
	                if (data.numMax11 != undefined) {
	                    ylHtml += '<td>'+data.numMax11+'</td>';
	                }
	                ylHtml += '</tr>';
	                //清楚划线
	                $('div#chartsDiv canvas').remove();
	                $('#trend_table').html(headHtml + tbHtml + ylHtml);
	                //先获取所有开奖号码对象，然后把每两个对象组成一个canvas
	                var cvList = $('td span.cur');
	                var cvHtml = '';
	                for (var i = 0; i < cvList.length; i++) {
	                    if (i == 0) {
	                        continue;
	                    }
	                    var tmpBallHalf = parseInt($(cvList[i]).width()/2);
	                    var tmpHeight = $(cvList[i]).position().top - $(cvList[i-1]).position().top;
	                    tmpHeight = Math.abs(parseInt(tmpHeight));
	                    var tmpWidth = $(cvList[i]).position().left - $(cvList[i-1]).position().left;
	                    var direc = (tmpWidth < 0) ? -1 : 1;
	                    tmpWidth = Math.abs(parseInt(tmpWidth));
	                    tmpWidth = (tmpWidth == 0) ? 1 : tmpWidth;
	                    //left,top
	                    var tmpTop = Math.min($(cvList[i]).position().top, $(cvList[i-1]).position().top);
	                    var tmpLeft = Math.min($(cvList[i]).position().left, $(cvList[i-1]).position().left);
	                    tmpTop = Math.abs(parseInt(tmpTop)) + parseInt(tmpBallHalf) + 10;
	                    tmpLeft = Math.abs(parseInt(tmpLeft)) + parseInt(tmpBallHalf) - 1;
	                    cvHtml += '<canvas class="trend-canvas" style="position:absolute; z-index:2;visibility: visible; '
	                        + 'border:0px solid;left:'+tmpLeft+'px;top:'+tmpTop+'px;" data-half="'+tmpBallHalf+'" data-direc="'+direc+'" width="'+tmpWidth+'" height="'+tmpHeight+'"></canvas>';
	                }
	                $('div#chartsDiv').append(cvHtml);
	                drawLine();
                }
            }
        });
    }
});