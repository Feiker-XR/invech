<?php
$typeid = intval($_REQUEST['typeid']);
?>
<!DOCTYPE html>
<!-- saved from url=(0035)https://cy16cp.com/trend/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        body,#wrapper_1{-webkit-overflow-scrolling:touch;overflow-scrolling:touch;}/*解决苹果滚动条卡顿的问题*/
        #wrapper_1{overflow-y:visible!important;}
    </style>
    <style>
        span.cur{position: relative; z-index: 3;}
    </style>


    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="format-detection" content="telphone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="new/global.css" type="text/css">
    <script src="new/jquery.min.js"></script>
    <script src="new/iscro-lot.js"></script>
    <script>
        try{
            isLogin = false;
        }catch(e){console.log(e);}
    </script>
    <script>
        $(function(){
            var _padding = function()
            {
                try{
                    var l = $("body>.header").height();
                    if($("body>.lott-menu").length>0)
                    {
                        l += $("body>.lott-menu").height();
                    }
                    $("#wrapper_1").css("paddingTop",l+"px");
                }catch(e){}
                try{
                    if($("body>.menu").length>0)
                    {
                        var l = $("body>.menu").height();
                    }
                    $("#wrapper_1").css("paddingBottom",l+"px");
                }catch(e){}
            };
            (function(){
                _padding();
            })();
            $(window).bind("load",_padding);

        });

    </script>    <script>
        function loaded(){}//空实现
        //document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false); //uc浏览器滑动
    </script>
    <title>走势图</title>
    <script>
        //对象转数组
        function obj2arr(obj) {
            var arr = [];
            for(var item in obj){
                arr.push(obj[item]);
            }
            return arr;
        }
    </script>
    <script>
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
    </script>
</head>
<body class="login-bg" onload="loaded()" waid71fa0d88-5390-4b5b-a2f4-e45fa93d85e2="SA password protect entry checker" style="">
<div class="header">
    <div class="headerTop">
        <div class="ui-toolbar-left">
            <button id="reveal-left">reveal</button>
        </div>
        <h1 class="ui-betting-title">
            <div class="bett-top-box">
                <!--<div class="bett-play">玩法</div>-->
                <div class="bett-tit"><span id="msg_type">基本走势</span><!--<i class="bett-attr"></i>--></div>
            </div>
        </h1>
        <div class="ui-bett-right trend-icon">
            <a class="bett-heads" href="javascript:;"></a>
        </div>
    </div>
</div>

<div id="wrapper_1" class="scorllmain-content scorllmain-Beet nobottom_bar" style="padding-top: 44px; padding-bottom: 44px;">
    <div class="sub_ScorllCont">
        <div id="trend_pos" class="trend-tit">
            <span data-pos="1" class="on">百</span>
            <span data-pos="2">十</span>
            <span data-pos="3">个</span>
        </div>
        <div id="chartsDiv" class="trend-content">
            <table id="trend_table" cellpadding="0" cellspacing="0">
                <tbody>

                </tbody>
            </table>
    </div>
</div>
<div class="trend-foot">
    <div class="trend-foot-txt">
        <span id="game_name" style="align: center; color:#999;">福彩3D</span>
        <!--<span class="red"></span>-->
    </div>
    <button class="trend-add">去投一注</button>
</div>
<!-- 直选tips -->
<div class="beet-tips" hidden="">
    <!--<div class="beet-tips-tit"><span>普通玩法</span></div>-->
    <div class="clear"></div>
    <ul id="play_list">
        <li><a class="beet-active" href="javascript:;">走势图</a></li>
    </ul>
</div>
<!-- 走势图彩种tips -->
<div class="trend-tips" hidden="" style="display: none;">
    <div class="trtip-tit"><i class="tr-icon"></i>选择彩种</div>
    <ul>
        <li class="game_li_86 <?php if($typeid == 86){echo 'trend-on';}?>" data-gid="86" data-enable="0">三分时时彩</li>
        <li class="game_li_1 <?php if($typeid == 1){echo 'trend-on';}?>" data-gid="1" data-enable="0">重庆时时彩</li>
        <li class="game_li_12 <?php if($typeid == 12){echo 'trend-on';}?>" data-gid="12" data-enable="0">新疆时时彩</li>
        <li class="game_li_60 <?php if($typeid == 60){echo 'trend-on';}?>" data-gid="60" data-enable="0">天津时时彩</li>
        <li class="game_li_87 <?php if($typeid == 87){echo 'trend-on';}?>" data-gid="87" data-enable="0">上海时时乐</li>
        <!--<li class="game_li_83 <?php if($typeid == 83){echo 'trend-on';}?>" data-gid="83" data-enable="0">北京28</li>-->
        <li class="game_li_80 <?php if($typeid == 80){echo 'trend-on';}?>" data-gid="80" data-enable="0">幸运28</li>

        <li class="game_li_20 <?php if($typeid == 20){echo 'trend-on';}?>" data-gid="20" data-enable="0">北京PK拾</li>
        <li class="game_li_85 <?php if($typeid == 85){echo 'trend-on';}?>" data-gid="85" data-enable="0">三分PK拾</li>

        <li class="game_li_6 <?php if($typeid == 6){echo 'trend-on';}?>" data-gid="6" data-enable="0">广东11选5</li>
        <li class="game_li_7 <?php if($typeid == 7){echo 'trend-on';}?>" data-gid="7" data-enable="0">山东11选5</li>
        <li class="game_li_15 <?php if($typeid == 15){echo 'trend-on';}?>" data-gid="15" data-enable="0">上海11选5</li>
        <li class="game_li_16 <?php if($typeid == 16){echo 'trend-on';}?>" data-gid="16" data-enable="0">江西11选5</li>

        <li class="game_li_81 <?php if($typeid == 81){echo 'trend-on';}?>" data-gid="81" data-enable="0">安徽快三</li>
        <li class="game_li_82 <?php if($typeid == 82){echo 'trend-on';}?>" data-gid="82" data-enable="0">广西快三</li>
        <li class="game_li_79 <?php if($typeid == 79){echo 'trend-on';}?>" data-gid="79" data-enable="0">江苏快三</li>

        <li class="game_li_9 <?php if($typeid == 9){echo 'trend-on';}?>" data-gid="9" data-enable="0">福彩3D</li>
        <li class="game_li_10 <?php if($typeid == 10){echo 'trend-on';}?>" data-gid="10" data-enable="0">排列三</li>
        <li class="game_li_34 <?php if($typeid == 34){echo 'trend-on';}?>" data-gid="34" data-enable="0">澳门六合彩</li>
    </ul>
</div>
<!--<div class="tips-bg" hidden=""></div>-->

<style>
    .center {text-align: center}
</style>

<div class="beet-odds-tips round" id="tip_pop" style="display: none; height:130px;">
    <div class="beet-odds-info f100">
        <div class="beet-money" id="tip_pop_content" style="font-size: 120%; margin-top: 15px; color:#666;">
            号码选择有误
        </div>
    </div>
    <div class="beet-odds-info text-center">
        <button class="btn-que" style="width: 100%;" onclick="tipOk()"><span>确定</span></button>
    </div>
</div>

<div id="tip_bg" class="tips-bg" style="display: none;"></div>
<input id="play" value="1" type="hidden">
<script>
    var func;
    function tipOk() {
        $('#tip_pop').hide();
        $('#tip_bg').hide();
        if (/系统维护/g.test($('div#tip_pop_content').html())) {
            location.href = '/index/index.html';
            return;
        }
        if (typeof(func) == "function"){
            func();
            func = "";
        }else{
            if (typeof(doTipOk) == "function") {
                doTipOk();
            }
        }
    }
    function msgAlert (msg,funcParm) {
        $('div#tip_pop_content').html(msg);
        $('div#tip_pop').show();
        $('div#tip_bg').show();
        func = (funcParm == ""||typeof(funcParm) != "function")?'':funcParm;
    }
</script>

<script>
    /*$('.ui-betting-title').click(function(){
     $('.beet-tips').toggle();
     });*/
    $('.bett-top').click(function(event){
        event.stopPropagation();
    });
    $('.trend-icon').click(function(){
        $('.trend-tips').show();
        $('.tips-bg').show();
    });

    $('.tips-bg').click(function(){
        $('.trend-tips').hide();
        $('.tips-bg').hide();
    })
    $('div.trend-tips li').click(function(){
        $('div.trend-tips li').removeClass('trend-on');
        $(this).addClass('trend-on');
        $('.trend-tips').hide();
        $('.tips-bg').hide();
        trendGid = $(this).data('gid');

        if(trendGid == 34){
            html = '<li><a class="beet-active" href="javascript:void(0)" onclick="setplay(1)">特码</a></li>';
            html += '<li><a class="beet-active" href="javascript:void(0)" onclick="setplay(2)">生肖</a></li>';
            html += '<li><a class="beet-active" href="javascript:void(0)" onclick="setplay(3)">波色</a></li>';
            //$('#play_list').load().html(html);
        }

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

    //$(document).on('click', 'div.trend-tit span', function() {
    /*$('div.trend-tit span').bind('touchend', function () {
     event.preventDefault();
     $('div.trend-tit span').removeClass('on');
     $(this).addClass('on');
     trendPos = $(this).data('pos');
     getTrendData();
     });*/

    function showPosTitle() {
        //显示游戏名
        var gNameArr = $('li.game_li_'+trendGid).html();
        $('span#game_name').text(gNameArr);
        var play = $('#play').val();
        var gamePosArr = new Array();
        gamePosArr[1] = {0:'0|1|2|3|4|5|6|7|8|9',1:'万',2:'千',3:'百',4:'十',5:'个'};
        gamePosArr[86] = {0:'0|1|2|3|4|5|6|7|8|9',1:'万',2:'千',3:'百',4:'十',5:'个'};
        gamePosArr[60] = {0:'0|1|2|3|4|5|6|7|8|9',1:'万',2:'千',3:'百',4:'十',5:'个'};
        gamePosArr[12] = {0:'0|1|2|3|4|5|6|7|8|9',1:'万',2:'千',3:'百',4:'十',5:'个'};

        gamePosArr[87] = {0:'0|1|2|3|4|5|6|7|8|9',1:'百',2:'十',3:'个'};
        gamePosArr[83] = {0:'0|1|2|3|4|5|6|7|8|9',1:'百',2:'十',3:'个'};
        gamePosArr[79] = {0:'0|1|2|3|4|5|6|7|8|9',1:'百',2:'十',3:'个'};
        gamePosArr[82] = {0:'0|1|2|3|4|5|6|7|8|9',1:'百',2:'十',3:'个'};
        gamePosArr[81] = {0:'0|1|2|3|4|5|6|7|8|9',1:'百',2:'十',3:'个'};

        gamePosArr[9] = {0:'0|1|2|3|4|5|6|7|8|9',1:'百',2:'十',3:'个'};
        gamePosArr[10] = {0:'0|1|2|3|4|5|6|7|8|9',1:'百',2:'十',3:'个'};

        gamePosArr[80] = {0:'0|1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27',1:'百',2:'十',3:'个'};

        gamePosArr[20] = {0:'01|02|03|04|05|06|07|08|09|10',1:'一位',2:'二位',3:'三位',4:'四位',5:'五位',6:'六位',7:'七位',8:'八位',9:'九位',10:'十位'};
        gamePosArr[85] = {0:'01|02|03|04|05|06|07|08|09|10',1:'一位',2:'二位',3:'三位',4:'四位',5:'五位',6:'六位',7:'七位',8:'八位',9:'九位',10:'十位'};

        gamePosArr[6] = {0:'01|02|03|04|05|06|07|08|09|10|11',1:'第一位',2:'第二位',3:'第三位',4:'第四位',5:'第五位'};
        gamePosArr[16] = {0:'01|02|03|04|05|06|07|08|09|10|11',1:'第一位',2:'第二位',3:'第三位',4:'第四位',5:'第五位'};
        gamePosArr[7] = {0:'01|02|03|04|05|06|07|08|09|10|11',1:'第一位',2:'第二位',3:'第三位',4:'第四位',5:'第五位'};
        gamePosArr[15] = {0:'01|02|03|04|05|06|07|08|09|10|11',1:'第一位',2:'第二位',3:'第三位',4:'第四位',5:'第五位'};

        gamePosArr[34] = {0:'01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31|32|33|34|35|36|37|38|39|40|41|42|43|44|45|46|47',1:'正码一',2:'正码二',3:'正码三',4:'正码四',5:'正码五',6:'正码六',7:'特码'};
        if(trendGid == 34 && play == 2){
            gamePosArr[34] = {0:'鼠|牛|虎|兔|龙|蛇|马|羊|猴|鸡|狗|猪',1:'一位',2:'二位',3:'三位',4:'四位',5:'五位',6:'六位',7:'七位'};
        }else if(trendGid == 34 && play == 3){
            gamePosArr[34] = {0:'红波|绿波|蓝波|平',1:'波色'};
        }

        //alert('位置');
        var posArr = obj2arr(gamePosArr[trendGid]);
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
</script>


<script>
    gameOpArr = {1:'fcsd',2:'tcps',3:'ssl',4:'tjssc',5:'cqssc',6:'jxssc',7:'xjssc',9:'pk10'
        ,10:'jsks',11:'ahks',12:'elevensd',13:'elevensh',14:'elevenjx',15:'elevengd'
        ,16:'jlks',17:'gxks',51:'sfc',52:'twpk10'};
    $('button.trend-add').click(function() {
        if ($('li.game_li_'+trendGid).data('enable') == 1) {
            msgAlert('该彩种正在维护！');
            return;
        }
        location.href = '/index.php/index/game/'+trendGid;
    });
</script>

<script>
    $(function() {
        $('li.game_li_'+trendGid).click();
        //getTrendData();
    });
</script>

<script>
    trendGid = '<?=$typeid?>';
    trendCount = 20;
    trendPos = 1;
    noStr = '0|1|2|3|4|5|6|7|8|9';

    function getTrendData() {
        if (trendGid == null || trendGid == undefined || trendGid == '') {
            trendGid = 1;
        }
        $.ajax({
            url: '/index.php/zst/ajaxList',
            type: 'POST',
            dataType: 'json',
            data: {
                'gid' : trendGid,
                'count' : trendCount,
                'pos' : trendPos
            },
            timeout: 30000,
            success: function (data) {
                if (data.Result == false) {
                    msgAlert(data.Desc);
                    reLogin(data.Desc);
                    return false;
                }
                //福体彩
                var headHtml = '';
                var tbHtml = '';
                var noArr = noStr.split('|');
                var noLen = noArr.length;
                headHtml = '<tr class="trend-titbg">'
                    + '<th style="width: 8%">期数</th>';
                for (var i = 0; i < noLen; i++) {
                    headHtml += '<th>'+ noArr[i] +'</th>';
                }
                headHtml += '</tr>';
                for (var i = 0; i < data.RecordCount; i++) {
                    var tmpOpenNum = data.Records[i].iOpenNum;
                    var clsBg = (i % 2 == 1) ? 'class="trend-bg"' : '';
                    tbHtml += '<tr ' + clsBg + '>';
                    tbHtml += '<td>'+data.Records[i].sGamePeriod+'</td>';
                    if (data.Records[i].iYL0 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 0) ? '<span class="cur">':'')+data.Records[i].iYL0+((tmpOpenNum == 0) ? '</span>':'')+'</td>';
                    }
                    tbHtml += '<td>'+((tmpOpenNum == 1) ? '<span class="cur">1':data.Records[i].iYL1)+((tmpOpenNum == 1) ? '</span>':'')+'</td>';
                    tbHtml += '<td>'+((tmpOpenNum == 2) ? '<span class="cur">2':data.Records[i].iYL2)+((tmpOpenNum == 2) ? '</span>':'')+'</td>';
                    tbHtml += '<td>'+((tmpOpenNum == 3) ? '<span class="cur">3':data.Records[i].iYL3)+((tmpOpenNum == 3) ? '</span>':'')+'</td>';
                    tbHtml += '<td>'+((tmpOpenNum == 4) ? '<span class="cur">4':data.Records[i].iYL4)+((tmpOpenNum == 4) ? '</span>':'')+'</td>';
                    tbHtml += '<td>'+((tmpOpenNum == 5) ? '<span class="cur">5':data.Records[i].iYL5)+((tmpOpenNum == 5) ? '</span>':'')+'</td>';
                    tbHtml += '<td>'+((tmpOpenNum == 6) ? '<span class="cur">6':data.Records[i].iYL6)+((tmpOpenNum == 6) ? '</span>':'')+'</td>';
                    if (data.Records[i].iYL7 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 7) ? '<span class="cur">7':data.Records[i].iYL7)+((tmpOpenNum == 7) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL8 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 8) ? '<span class="cur">8':data.Records[i].iYL8)+((tmpOpenNum == 8) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL9 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 9) ? '<span class="cur">9':data.Records[i].iYL9)+((tmpOpenNum == 9) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL10 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 10) ? '<span class="cur">10':data.Records[i].iYL10)+((tmpOpenNum == 10) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL11 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 11) ? '<span class="cur">11':data.Records[i].iYL11)+((tmpOpenNum == 11) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL12 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 12) ? '<span class="cur">12':data.Records[i].iYL12)+((tmpOpenNum == 12) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL13 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 13) ? '<span class="cur">13':data.Records[i].iYL13)+((tmpOpenNum == 13) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL14 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 14) ? '<span class="cur">14':data.Records[i].iYL14)+((tmpOpenNum == 14) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL15 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 15) ? '<span class="cur">15':data.Records[i].iYL15)+((tmpOpenNum == 15) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL16 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 16) ? '<span class="cur">16':data.Records[i].iYL16)+((tmpOpenNum == 16) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL17 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 17) ? '<span class="cur">17':data.Records[i].iYL17)+((tmpOpenNum == 17) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL18 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 18) ? '<span class="cur">18':data.Records[i].iYL18)+((tmpOpenNum == 18) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL19 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 19) ? '<span class="cur">19':data.Records[i].iYL19)+((tmpOpenNum == 19) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL20 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 20) ? '<span class="cur">20':data.Records[i].iYL20)+((tmpOpenNum == 20) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL21 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 21) ? '<span class="cur">21':data.Records[i].iYL21)+((tmpOpenNum == 21) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL22 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 22) ? '<span class="cur">22':data.Records[i].iYL22)+((tmpOpenNum == 22) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL23 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 23) ? '<span class="cur">23':data.Records[i].iYL23)+((tmpOpenNum == 23) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL24 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 24) ? '<span class="cur">24':data.Records[i].iYL24)+((tmpOpenNum == 24) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL25 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 25) ? '<span class="cur">25':data.Records[i].iYL25)+((tmpOpenNum == 25) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL26 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 26) ? '<span class="cur">26':data.Records[i].iYL26)+((tmpOpenNum == 26) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL27 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 27) ? '<span class="cur">27':data.Records[i].iYL27)+((tmpOpenNum == 27) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL28 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 28) ? '<span class="cur">28':data.Records[i].iYL28)+((tmpOpenNum == 28) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL29 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 29) ? '<span class="cur">29':data.Records[i].iYL29)+((tmpOpenNum == 29) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL30 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 30) ? '<span class="cur">30':data.Records[i].iYL30)+((tmpOpenNum == 30) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL31 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 31) ? '<span class="cur">31':data.Records[i].iYL31)+((tmpOpenNum == 31) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL32 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 32) ? '<span class="cur">32':data.Records[i].iYL32)+((tmpOpenNum == 32) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL33 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 33) ? '<span class="cur">33':data.Records[i].iYL33)+((tmpOpenNum == 33) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL34 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 34) ? '<span class="cur">34':data.Records[i].iYL34)+((tmpOpenNum == 34) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL35 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 35) ? '<span class="cur">35':data.Records[i].iYL35)+((tmpOpenNum == 35) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL36 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 36) ? '<span class="cur">36':data.Records[i].iYL36)+((tmpOpenNum == 36) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL37 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 37) ? '<span class="cur">37':data.Records[i].iYL37)+((tmpOpenNum == 37) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL38 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 38) ? '<span class="cur">38':data.Records[i].iYL38)+((tmpOpenNum == 38) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL39 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 39) ? '<span class="cur">39':data.Records[i].iYL39)+((tmpOpenNum == 39) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL40 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 40) ? '<span class="cur">40':data.Records[i].iYL40)+((tmpOpenNum == 40) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL41 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 41) ? '<span class="cur">41':data.Records[i].iYL41)+((tmpOpenNum == 41) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL42 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 42) ? '<span class="cur">42':data.Records[i].iYL42)+((tmpOpenNum == 42) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL43 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 43) ? '<span class="cur">43':data.Records[i].iYL43)+((tmpOpenNum == 43) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL44 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 44) ? '<span class="cur">44':data.Records[i].iYL44)+((tmpOpenNum == 44) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL45 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 45) ? '<span class="cur">45':data.Records[i].iYL45)+((tmpOpenNum == 45) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL46 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 46) ? '<span class="cur">27':data.Records[i].iYL46)+((tmpOpenNum == 46) ? '</span>':'')+'</td>';
                    }
                    if (data.Records[i].iYL47 != undefined) {
                        tbHtml += '<td>'+((tmpOpenNum == 47) ? '<span class="cur">47':data.Records[i].iYL47)+((tmpOpenNum == 47) ? '</span>':'')+'</td>';
                    }
                    tbHtml += '</tr>';
                }
                //平均、最大遗漏
                var ylHtml = '<tr class="trend-bg-average">'
                    + '<td>平均遗漏</td>';
                if (data.iYLAvg0 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg0+'</td>';
                }
                if (data.iYLAvg1 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg1+'</td>';
                }
                ylHtml += '<td>'+data.iYLAvg2+'</td>';
                ylHtml += '<td>'+data.iYLAvg3+'</td>';
                ylHtml += '<td>'+data.iYLAvg4+'</td>';
                ylHtml += '<td>'+data.iYLAvg5+'</td>';
                ylHtml += '<td>'+data.iYLAvg6+'</td>';
                if (data.iYLAvg7 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg7+'</td>';
                }
                if (data.iYLAvg8 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg8+'</td>';
                }
                if (data.iYLAvg9 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg9+'</td>';
                }
                if (data.iYLAvg10 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg10+'</td>';
                }
                if (data.iYLAvg11 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg11+'</td>';
                }
                if (data.iYLAvg12 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg12+'</td>';
                }
                if (data.iYLAvg13 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg13+'</td>';
                }
                if (data.iYLAvg14 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg14+'</td>';
                }
                if (data.iYLAvg15 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg15+'</td>';
                }
                if (data.iYLAvg16 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg16+'</td>';
                }
                if (data.iYLAvg17 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg17+'</td>';
                }
                if (data.iYLAvg18 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg18+'</td>';
                }
                if (data.iYLAvg19 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg19+'</td>';
                }
                if (data.iYLAvg20 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg20+'</td>';
                }
                if (data.iYLAvg21 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg21+'</td>';
                }
                if (data.iYLAvg22 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg22+'</td>';
                }
                if (data.iYLAvg23 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg23+'</td>';
                }
                if (data.iYLAvg24 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg24+'</td>';
                }
                if (data.iYLAvg25 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg25+'</td>';
                }
                if (data.iYLAvg26 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg26+'</td>';
                }
                if (data.iYLAvg27 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg27+'</td>';
                }
                if (data.iYLAvg28 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg28+'</td>';
                }
                if (data.iYLAvg29 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg29+'</td>';
                }
                if (data.iYLAvg30 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg30+'</td>';
                }
                if (data.iYLAvg31 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg31+'</td>';
                }
                if (data.iYLAvg32 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg32+'</td>';
                }
                if (data.iYLAvg33 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg33+'</td>';
                }
                if (data.iYLAvg34 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg34+'</td>';
                }
                if (data.iYLAvg35 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg35+'</td>';
                }
                if (data.iYLAvg36 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg36+'</td>';
                }
                if (data.iYLAvg37 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg37+'</td>';
                }
                if (data.iYLAvg38 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg38+'</td>';
                }
                if (data.iYLAvg39 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg39+'</td>';
                }
                if (data.iYLAvg40 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg40+'</td>';
                }
                if (data.iYLAvg41 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg41+'</td>';
                }
                if (data.iYLAvg42 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg42+'</td>';
                }
                if (data.iYLAvg43 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg43+'</td>';
                }
                if (data.iYLAvg44 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg44+'</td>';
                }
                if (data.iYLAvg45 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg45+'</td>';
                }
                if (data.iYLAvg46 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg46+'</td>';
                }
                if (data.iYLAvg47 != undefined) {
                    ylHtml += '<td>'+data.iYLAvg47+'</td>';
                }
                ylHtml += '</tr>';
                ylHtml += '<tr>';
                ylHtml += '<td>最大遗漏</td>';
                if (data.iYLMax0 != undefined) {
                    ylHtml += '<td>'+data.iYLMax0+'</td>';
                }
                if (data.iYLMax1 != undefined) {
                    ylHtml += '<td>'+data.iYLMax1+'</td>';
                }
                ylHtml += '<td>'+data.iYLMax2+'</td>';
                ylHtml += '<td>'+data.iYLMax3+'</td>';
                ylHtml += '<td>'+data.iYLMax4+'</td>';
                ylHtml += '<td>'+data.iYLMax5+'</td>';
                ylHtml += '<td>'+data.iYLMax6+'</td>';
                if (data.iYLMax7 != undefined) {
                    ylHtml += '<td>'+data.iYLMax7+'</td>';
                }
                if (data.iYLMax8 != undefined) {
                    ylHtml += '<td>'+data.iYLMax8+'</td>';
                }
                if (data.iYLMax9 != undefined) {
                    ylHtml += '<td>'+data.iYLMax9+'</td>';
                }
                if (data.iYLMax10 != undefined) {
                    ylHtml += '<td>'+data.iYLMax10+'</td>';
                }
                if (data.iYLMax11 != undefined) {
                    ylHtml += '<td>'+data.iYLMax11+'</td>';
                }
                if (data.iYLMax12 != undefined) {
                    ylHtml += '<td>'+data.iYLMax12+'</td>';
                }
                if (data.iYLMax13 != undefined) {
                    ylHtml += '<td>'+data.iYLMax13+'</td>';
                }
                if (data.iYLMax14 != undefined) {
                    ylHtml += '<td>'+data.iYLMax14+'</td>';
                }
                if (data.iYLMax15 != undefined) {
                    ylHtml += '<td>'+data.iYLMax15+'</td>';
                }
                if (data.iYLMax16 != undefined) {
                    ylHtml += '<td>'+data.iYLMax16+'</td>';
                }
                if (data.iYLMax17 != undefined) {
                    ylHtml += '<td>'+data.iYLMax17+'</td>';
                }
                if (data.iYLMax18 != undefined) {
                    ylHtml += '<td>'+data.iYLMax18+'</td>';
                }
                if (data.iYLMax19 != undefined) {
                    ylHtml += '<td>'+data.iYLMax19+'</td>';
                }
                if (data.iYLMax20 != undefined) {
                    ylHtml += '<td>'+data.iYLMax20+'</td>';
                }
                if (data.iYLMax21 != undefined) {
                    ylHtml += '<td>'+data.iYLMax21+'</td>';
                }
                if (data.iYLMax22 != undefined) {
                    ylHtml += '<td>'+data.iYLMax22+'</td>';
                }
                if (data.iYLMax23 != undefined) {
                    ylHtml += '<td>'+data.iYLMax23+'</td>';
                }
                if (data.iYLMax24 != undefined) {
                    ylHtml += '<td>'+data.iYLMax24+'</td>';
                }
                if (data.iYLMax25 != undefined) {
                    ylHtml += '<td>'+data.iYLMax25+'</td>';
                }
                if (data.iYLMax26 != undefined) {
                    ylHtml += '<td>'+data.iYLMax26+'</td>';
                }
                if (data.iYLMax27 != undefined) {
                    ylHtml += '<td>'+data.iYLMax27+'</td>';
                }
                if (data.iYLMax28 != undefined) {
                    ylHtml += '<td>'+data.iYLMax28+'</td>';
                }
                if (data.iYLMax29 != undefined) {
                    ylHtml += '<td>'+data.iYLMax29+'</td>';
                }
                if (data.iYLMax30 != undefined) {
                    ylHtml += '<td>'+data.iYLMax30+'</td>';
                }
                if (data.iYLMax31 != undefined) {
                    ylHtml += '<td>'+data.iYLMax31+'</td>';
                }
                if (data.iYLMax32 != undefined) {
                    ylHtml += '<td>'+data.iYLMax32+'</td>';
                }
                if (data.iYLMax33 != undefined) {
                    ylHtml += '<td>'+data.iYLMax33+'</td>';
                }
                if (data.iYLMax34 != undefined) {
                    ylHtml += '<td>'+data.iYLMax34+'</td>';
                }
                if (data.iYLMax35 != undefined) {
                    ylHtml += '<td>'+data.iYLMax35+'</td>';
                }
                if (data.iYLMax36 != undefined) {
                    ylHtml += '<td>'+data.iYLMax36+'</td>';
                }
                if (data.iYLMax37 != undefined) {
                    ylHtml += '<td>'+data.iYLMax37+'</td>';
                }
                if (data.iYLMax38 != undefined) {
                    ylHtml += '<td>'+data.iYLMax38+'</td>';
                }
                if (data.iYLMax39 != undefined) {
                    ylHtml += '<td>'+data.iYLMax39+'</td>';
                }
                if (data.iYLMax40 != undefined) {
                    ylHtml += '<td>'+data.iYLMax40+'</td>';
                }
                if (data.iYLMax41 != undefined) {
                    ylHtml += '<td>'+data.iYLMax41+'</td>';
                }
                if (data.iYLMax42 != undefined) {
                    ylHtml += '<td>'+data.iYLMax42+'</td>';
                }
                if (data.iYLMax43 != undefined) {
                    ylHtml += '<td>'+data.iYLMax43+'</td>';
                }
                if (data.iYLMax44 != undefined) {
                    ylHtml += '<td>'+data.iYLMax44+'</td>';
                }
                if (data.iYLMax45 != undefined) {
                    ylHtml += '<td>'+data.iYLMax45+'</td>';
                }
                if (data.iYLMax46 != undefined) {
                    ylHtml += '<td>'+data.iYLMax46+'</td>';
                }
                if (data.iYLMax47 != undefined) {
                    ylHtml += '<td>'+data.iYLMax47+'</td>';
                }
                ylHtml += '</tr>';
                //清楚划线
                $('div#chartsDiv canvas').remove();
                $('#trend_table').html(headHtml + tbHtml + ylHtml);
                //return;
                //先获取所有开奖号码对象，然后把每两个对象组成一个canvas
                var cvList = $('td span.cur');
                var cvHtml = '';
                for (var i = 0; i < cvList.length; i++) {
                    //alert('v:'+$(cvList[i]).width()+':'+$(cvList[i]).height());
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
                loaded();
            }
        });
    }
    function setplay(val) {
        alert('1111')
        $('#play').val(val);
        showPosTitle();
    }
</script>
</body>
</html>