<?php
include(dirname(__FILE__)."/inc/comfunc.php");
$typeid = intval($_REQUEST['typeid']);
$g = intval($_REQUEST['g']);
if(!$mydb) $mydb = new MYSQL($dbconf);
$sql_caizhong = 'SELECT t.`id`,t.`codeList`,t.`title` FROM blast_type t WHERE t.`enable` = 1 ORDER BY t.`id`';
$list = $mydb->row_query($sql_caizhong);


$info = $mydb->row_query('SELECT t.`id`,t.`codeList`,t.`title` FROM blast_type t WHERE t.`id`='.$typeid);

$ssc = array(1,86,60,12,7,15,16,6,5,14);//5
$pk10 = array(20,85);//10
$ssl = array(87,79,82,81,80,83,9,10);//3
if(in_array($typeid,$ssc)){
    $w3 = array('万','千','百','十','个');
    $dw = 1;
}elseif(in_array($typeid,$pk10)){
    $w3 = array('一位','二位','三位','四位','五位','六位','七位','八位','九位','十位');
    $dw = 2;
}elseif(in_array($typeid,$ssl)){
    $w3 = array('百','十','个');
    $dw = 1;
}

$is_zero = array(1,3,9,10,12,14,26,5,60,61,62,69,70,73,74,75,76,78,79,80,81,82,83,86,87);

if(in_array($typeid,$is_zero)){
    $is_zero_n = true;
}

$list_data = $mydb->row_query('SELECT t.`number`,t.`data` FROM blast_data t WHERE t.`type` = '.$typeid.' ORDER BY t.`number` DESC limit 30');
?>
<!DOCTYPE html>
<!-- saved from url=(0035)https://cy16cp.com/trend/index.html -->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="format-detection" content="telphone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="new/global.css?ver=5.0_10" type="text/css">
    <script src="new/jquery.min.js?ver=5.0_10"></script>
    <script src="new/iscro-lot.js?ver=5.0_10"></script>
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

    </script>
    <title><?=$info[0][2]?>-走势图</title>
    <script>
        function drawLine() {
            var cvList = $('div#a canvas');
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
<body>
<div class="header" style="height: 44px;">
    <div class="headerTop">
        <div class="ui-toolbar-left">
            <button id="reveal-left">reveal</button>
        </div>
        <h1 class="ui-betting-title">
            <div class="bett-top-box">
                <div class="bett-play">玩法</div>
                <div class="bett-tit"><span id="msg_type">基本走势</span><!--<i class="bett-attr"></i>--></div>
            </div>
        </h1>
        <div class="ui-bett-right trend-icon">
            <a class="bett-heads" href="javascript:;"></a>
        </div>
    </div>
</div>

<div id="wrapper_1" class="scorllmain-content scorllmain-Beet nobottom_bar">
    <div class="sub_ScorllCont">
        <div id="trend_pos" class="trend-tit" style="height:50px;">
            <?php
            foreach ($w3 as $kg => $val) {
                if(($kg+1) == $g){
                    echo '<span data-pos="3" class="on"><a href="/zst/zst.php?typeid='.$typeid.'&g='.($kg+1).'">'.$val.'</a></span>';
                }else{
                    echo '<span data-pos="3"><a href="/zst/zst.php?typeid='.$typeid.'&g='.($kg+1).'">'.$val.'</a></span>';
                }
            }
            ?>
        </div>
        <div id="chartsDiv" class="trend-content">
            <table id="trend_table" cellpadding="0" cellspacing="0">
                <tbody>
                <tr class="trend-titbg">
                    <th>期数</th>
                    <?php
                    $number = explode(',',$info[0][1]);
                    foreach ($number as $k=>$v) {
                        echo '<th>'.$v.'</th>';
                    }
                    ?>
                </tr>
                <?php
                $yl = array();
                $zd = array();
                foreach ($list_data as $kdata => $val_data) {
                    if($kdata%2 != 0){
                        $css = 'trend-bg';
                    }
                    $num = explode(',',$val_data[1]);
                    $dqnum = $num[$g-1];
                    echo '<tr class="'.$css.'">';
                    echo '<td>'.$val_data[0].'</td>';

                    foreach ($number as $knum => $vnum) {
                        if ($dqnum == $vnum) {
                            if($yl[$vnum] > $zd[$vnum]){
                                $zd[$vnum] = $yl[$vnum];
                            }

                            $yl[$vnum] = 0;
                            echo '<td id="'.$val_data[0].'_'.$vnum.'"><span class="cur">'.$vnum.'</span></td>';
                        }else{
                            $yl[$vnum] = $yl[$vnum]+1;
                            echo '<td>'.$yl[$vnum].'</td>';
                        }
                    }
                    echo '</tr>';
                }
                ?>
                <tr class="trend-bg-average">
                    <td>平均遗漏</td>
                    <?php
                    foreach ($number as $knum1 => $vnum1) {
                        echo '<td>'.ceil($yl[$vnum1]/2).'</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <td>最大遗漏</td>
                    <?php
                    foreach ($number as $knum2 => $vnum2) {
                        echo '<td>'.$zd[$vnum2].'</td>';
                    }
                    ?>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="a">
<script>
    var left = $('.trend-titbg th').width();
    var top1 = $('.trend-tit').height()*'<?=$dw?>';
    var top2 = $('.header').height();
    var top3 = $('.trend-titbg th').height();
    var is_zero = '<?=$is_zero_n?>';

    //var width = $('.trend-titbg th').eq(1).width();
    var width = parseInt($('.trend-bg td').eq(1).width());
    var height = parseInt($('.trend-bg td').eq(1).height());

    var top5 = parseInt(top1 + top2 + top3 + height/3);

    var width1 = 0;
    var top_hou = 0;
    var left_hou = 0;
    var a_hou = 0;
    var list = JSON.parse('<?=json_encode(array('data'=>$list_data))?>');
    var las = list.data;
    $.each(list.data,function(v,n){
        try{
            var qi = n[0];
            var num = n[1].split(',');
            var next = las[v+1][1].split(',');
            var next_qi = las[v+1][0];
            var nextNum =  parseInt(next['<?=$g-1?>']);
            var dqnum =  parseInt(num['<?=$g-1?>']);

            /*var ida = qi+'_'+dqnum;
             var idb = next_qi+'_'+nextNum;

             var x = document.getElementById(ida).offsetLeft;
             var y = document.getElementById(ida).offsetTop;
             console.log(y);
             var xx = document.getElementById(idb).offsetLeft;
             var yy = document.getElementById(idb).offsetTop;

             var cha = dqnum - nextNum;
             if(cha >= 0){
             a_hou = -1;
             }else{
             a_hou = 1;
             }
             var w = Math.abs(x - xx);
             var h = Math.abs(y - yy);
             var l = xx;
             var t = y;*/

            //window.document.write('<canvas class="trend-canvas" style="position:absolute; z-index:2;visibility: visible; border:0px solid;left:'+l+'px;top:'+t+'px;" data-half="10" data-direc="'+a_hou+'" width="'+w+'" height="'+h+'"></canvas>');
            //return;
            if(is_zero){
                nextNum = parseInt(nextNum)+1;
                dqnum = parseInt(dqnum)+1;
            }
            top_hou =  top5 + (height*v);
            if(dqnum == nextNum){
                width1 = 2;
                left_hou = left + (width*nextNum);
                a_hou = -1;
            }else{
                if((dqnum - nextNum) > 0){
                    width1 = Math.abs(dqnum - nextNum)*width;
                    left_hou = left + (width*nextNum);
                    a_hou = -1;
                }else{
                    width1 = Math.abs(dqnum - nextNum)*width;
                    left_hou = left + (width*dqnum);
                    a_hou = 1;
                }
            }
            window.document.write('<canvas class="trend-canvas" style="position:absolute; z-index:2;visibility: visible; border:0px solid;left:'+left_hou+'px;top:'+top_hou+'px;" data-half="10" data-direc="'+a_hou+'" width="'+width1+'" height="'+height+'"></canvas>');
        }catch(e) {
            console.log(e);
        }


    })
    drawLine();
</script>
</div>
<div class="trend-foot">
    <div class="trend-foot-txt">
        <span id="game_name" style="align: center; color:#999;"><?=$info[0][2]?></span>
        <!--<span class="red"></span>-->
    </div>
    <button class="trend-add" onclick="jump()">去投一注</button>
</div>
<!-- 直选tips -->
<div class="beet-tips" hidden="" style="display: none;">
    <!--<div class="beet-tips-tit"><span>普通玩法</span></div>-->
    <div class="clear"></div>
    <ul>
        <li><a class="beet-active" href="javascript:;">走势图</a></li>
    </ul>
</div>
<!-- 走势图彩种tips -->
<div class="trend-tips" hidden="" style="display: none;">
    <div class="trtip-tit"><i class="tr-icon"></i>选择彩种</div>
    <ul>
        <?php
        foreach ($list as $key => $value) {
            if($value[0] == 34){
                echo '<li class="game_li_'.$value[0].'" data-gid="'.$value[0].'" data-enable="0"><a href="/zst/lhc.php?typeid='.$value[0].'&g=1">'.$value[2].'</a></li>';
            }else{
                if($typeid == $value[0]){
                    echo '<li class="game_li_'.$value[0].' trend-on" data-gid="'.$value[0].'" data-enable="0"><a href="/zst/zst.php?typeid='.$value[0].'&g=1">'.$value[2].'</a></li>';
                }else{
                    echo '<li class="game_li_'.$value[0].'" data-gid="'.$value[0].'" data-enable="0"><a href="/zst/zst.php?typeid='.$value[0].'&g=1">'.$value[2].'</a></li>';
                }

            }
        }
        ?>
    </ul>
</div>
<div id="tip_bg" class="tips-bg" style="display: none;"></div>
<script>
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
    function jump() {
        window.location.href='/index.php/index/game/<?=$typeid?>';
    }
</script>
</body>
</html>