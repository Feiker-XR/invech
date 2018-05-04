<link href="/css/nsc/plugin/dialogUI/dialogUI.css" media="all" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/js/nsc/dialogUI/jquery.dialogUI.js"></script>
<script src="/assets/js/plugins/layer/layer.js"></script>
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
    }

    ul, li {
        list-style: none;
        color: #A9A9A9;
        font-size: 16px;
    }

    body {
        background-color: #F5F5F5;
    }

    .check-list {
        padding: 0.357143rem .5rem;
    }

    .check-list li {
        width: 100%;
    }

    .check-list li .code-wrapper {
        width: 100%;
    }

    .code-wrapper li {
        float: left;
        width: 20%;
        margin-bottom: 10px;
    }

    .code {
        width: 33px;
        height: 33px;
        box-sizing: border-box;
        border-radius: 50%;
        border: 1px solid #BDBDBD;
        color: #CA1A1A;
        text-align: center;
        line-height: 33px;
        margin: 0 auto;
    }

    .pl {
        width: 100%;
        font-size: 14px;
        line-height: 2em;
        color: #a9a9;
        text-align: center;
    }

    .input {
        height: 30px;
        padding: 0 10px;
    }

    .input input {
        height: 30px;
        font-size: 12px;
        padding: 9px 5px;
        max-width: 100%;
        box-sizing: border-box;
        text-align: center;
        border: none;
        border: 1px solid #FFA07A;
        color: #333;

    }

    .sign-wrapper {
        width: 100%;
        height: 50px;
        line-height: 50px;
        text-align: center;
        border-bottom: 1px solid #BDBDBD;
        vertical-align: middle;
    }

    .sign-wrapper span {
        display: inline-block;
        margin: 0 5px;
        vertical-align: middle;
    }

    .pl-sign {
        color: #A9A9A9;
        font-size: 14px;
    }

    .input-sign {
        height: 33px;
        margin-top: -3px;
    }

    .input-sign {
        height: 30px;
        font-size: 12px;
        padding: 9px 5px;
        max-width: 100%;
        box-sizing: border-box;
        text-align: center;
        border: none;
        border: 1px solid #FFA07A;
        width: 50px;
        display: inline-block;
        background-color: #fff;

    }

    .clearfix:after {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden
    }
    .code.large{
    	width: 50px;
    	border-radius: 5px;
    }
    .input.block{
    	width: 100%;
    }
    li.block{
    	width: 100%;
    }
    li.block .code{
    	margin: 0 0 0 0;
    }
    li.block .pl{
    	width: 50px;
    }
    li.block .code.large{
    	width: 60px;
    }
    li.block select{
    	width: 23%;
    	margin-right:2%;
    	border: none;
    	border: 1px solid #F13131;
    	height: 30px;
    	border-radius: 4px;
    	color: #333;
    }
    li.block input{
    	width: 23%;
    	border-color: #F13131;
    	border-radius: 4px;
    }
    
    li.block .input{
    	padding: 0;
    }
    
   /* .tzbtn{
    	width: 70%;
    	height: 40px;
    	background-color: #F13031;
    	border: none;
    	font-size: 16px;
    	color: #fff;
    	letter-spacing: 5px;
    	font-weight: 300;
    	margin: 0 auto;
    	border-radius: 5px;
    	display: block;
    }*/
    .code.active{
    	background-color: #F13131;
    	border-color: #F13131;
    	color: #fff;
    	transform: none;
    	-webkit-transform: none;
    	-ms-transform: none;
    }
    .tz-wrapper{
    	position: fixed;
    	bottom: 0;
    	left: 0;
    	width: 100%;
    	height: 50px;
    	background-color: #242425;
    	z-index: 500;
    }
     .tz-wrapper button{
     	height: 40px;
     	padding:0 8px;
     	background-color: #ffb400;
     	color: #242625;
     	font-size: 1.142857rem;
     	border: none;
     	box-sizing: content-box;
     	float: right;
     	margin: 5px 5px 0 0;
     	border-radius: 5px;
     	font-weight: 400;
     }
     .tz-statics{
     	float: left;
     	height: 40px;
     	margin: 5px 0 0 10px;
     }
      .tz-statics p{
      	display: inline-block;
      	line-height: 40px;
      	font-size: 1.285714rem;
      	color: #fff;
      }
      .tz-amount{
      	color: #F13131;
      }
      
</style>
<ul class="check-list">
    <li>
        <div class="code-wrapper">
            <ul class="clearfix" id="list-code-1">
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="code-wrapper">
            <ul class="clearfix" id="list-code-2">
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="code-wrapper">
            <ul class="clearfix" id="list-code-6">
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="code-wrapper">
            <ul class="clearfix" id="list-code-3">
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="code-wrapper">
            <ul class="clearfix" id="list-code-7">
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="code-wrapper">
            <ul class="clearfix" id="list-code-4">
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
            </ul>
        </div>
    </li>
    <li>
        <div class="code-wrapper">
            <ul class="clearfix" id="list-code-5">
                <li>
                    <div class="code">1</div>
                    <div class="pl">16.22</div>
                    <div class="input"><input/></div>
                </li>
            </ul>
        </div>
    </li>
</ul>
<div class="tz-wrapper">
	<div class="tz-statics">
		<p><span class="tz-count">0</span> 注</p>
		<p><span class="tz-amount">0</span> 元</p>
	</div>
	<button type="button" title="下注" onclick="order();" class="ml10 tzbtn">下注</button>
</div>


<?php
$this->getCurPlayeds();
?>
<script type="text/javascript">
    var culs = '<?php echo !!$_SESSION[$this->memberSessionName] ?>';

    //更新赔率
    function loadodds(oddslist) {
        var ref = arguments[1] ? arguments[1] : false;
        var odds = '';
        if (oddslist == null || oddslist == "") {
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("封盘");
            return false;
        }

        for (var i = 1; i < 8; i++) {
            if (i == 1) {
                var html1 = '';
                for (var s = 1; s <= 28; s++) {
                    odds = oddslist.ball[i][s];
                    var id_name1 = "ball_" + i + "_" + s;
                    html1+= '<li class="play-item"><div class="code">'+(s-1)+'</div><div class="pl">'+odds+'</div><div class="input"><input id="'+id_name1+'"/></div></li>';
                }
                $('#list-code-1').html(html1);
            } else if (i == 2) {
                var html2 = '';
                for (var s = 1; s <= 4; s++) {
                    odds = oddslist.ball[i][s];
                    var id_name2 = "ball_" + i + "_" + s;
                    html2+= '<li class="play-item"><div class="code">'+odds.name+'</div><div class="pl">'+odds.value+'</div><div class="input"><input id="'+id_name2+'"></div></li>';
                }
                $('#list-code-2').html(html2);
            } else if (i == 3) {
                var html3 = '';
                for (var s = 1; s <= 3; s++) {
                    odds = oddslist.ball[i][s];
                    var id_name3 = "ball_" + i + "_" + s;
                    html3+= '<li class="play-item"><div class="code large">'+odds.name+'</div><div class="pl">'+odds.value+'</div><div class="input"><input id="'+id_name3+'"/></div></li>';
                }
                $('#list-code-3').html(html3);
            } else if (i == 4) {
                var html4 = '';
                for (var s = 1; s <= 1; s++) {
                    odds = oddslist.ball[i][s];
                    var id_name4 = "ball_" + i + "_" + s;
                    html4+= '<li class="play-item"><div class="code large">'+odds.name+'</div><div class="pl">'+odds.value+'</div><div class="input"><input id='+id_name4+'/></div></li>';
                }
                $('#list-code-4').html(html4);
            } else if (i == 5) {
                var html5 = '';
                var select1 = '<select id="tm3y1_1">';
                var select2 = '<select id="tm3y1_2">';
                var select3 = '<select id="tm3y1_3">';
                for (var j = 0;j< 28;j++) {
                
            		select1+='<option value="'+j+'">'+j+'</option>';
                    select2+='<option value="'+j+'">'+j+'</option>';
                    select3+='<option value="'+j+'">'+j+'</option>';
                	
                   
                }
                select1+='<select>';
                select2+='<select>';
                select3+='<select>';

                for (var s = 1; s <= 1; s++) {
                    odds = oddslist.ball[i][s];
                    var id_name5 = "ball_" + i + "_" + s;
                    html5+= '<li class="block play-item"><div class="code large">'+odds.name+'</div><div class="pl">'+odds.value+'</div><div class="input block">'+select1+select2+select3+'<input id="'+id_name5+'"/></div></li>';
                }
                $('#list-code-5').html(html5);
            } else if (i == 6) {
                var html6 = '';
                for (var s = 1; s <= 4; s++) {
                    odds = oddslist.ball[i][s];
                    var id_name6 = "ball_" + i + "_" + s;
                    html6+= '<li class="play-item"><div class="code large">'+odds.name+'</div><div class="pl">'+odds.value+'</div><div class="input" ><input id="'+id_name6+'"/></div></li>';
                }
                $('#list-code-6').html(html6);
            } else if (i == 7) {
                var html7 = '';
                for (var s = 1; s <= 2; s++) {
                    odds = oddslist.ball[i][s];
                    var id_name7 = "ball_" + i + "_" + s;
                    html7+= '<li class="play-item"><div class="code large">'+odds.name+'</div><div class="pl">'+odds.value+'</div><div class="input"><input id="'+id_name7+'"/></div></li>';
                }
                $('#list-code-7').html(html7);
            }
        }
        ;

    }

    var _data = {
        "number": 829339,
        "endtime": 139,
        "opentime": 199,
        "oddslist": {
            "ball": {
                "1": {
                    "1": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "2": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "3": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "4": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "5": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "6": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "7": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "8": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "9": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "10": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "11": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "12": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "13": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "14": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "15": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "16": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "17": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "18": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "19": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "20": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "21": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "22": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "23": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "24": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "25": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "26": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "27": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>",
                    "28": "<?php echo $this->curPlayeds["339"]["bonusProp"]?>"
                },
                "2": {
                    "1": {name:"大",value:"<?php echo $this->curPlayeds["340"]["bonusProp"]?>"},
                    "2": {name:"小",value:"<?php echo $this->curPlayeds["340"]["bonusProp"]?>"},
                    "3": {name:"单",value:"<?php echo $this->curPlayeds["340"]["bonusProp"]?>"},
                    "4": {name:"双",value:"<?php echo $this->curPlayeds["340"]["bonusProp"]?>"}
                },
                "3": {
                    "1": {name:"红波",value:"<?php echo $this->curPlayeds["343"]["bonusProp"]?>"},
                    "2": {name:"绿波",value:"<?php echo $this->curPlayeds["343"]["bonusProp"]?>"},
                    "3": {name:"蓝波",value:"<?php echo $this->curPlayeds["343"]["bonusProp"]?>"}
                },
                "4": {"1": {name:"豹子",value:"<?php echo $this->curPlayeds["344"]["bonusProp"]?>"}},
                "5": {"1": {name:"三压一",value:"<?php echo $this->curPlayeds["345"]["bonusProp"]?>"}},
                "6": {
                    "1": {name:"大单",value:"<?php echo $this->curPlayeds["341"]["bonusProp"]?>"},
                    "2": {name:"大双",value:"<?php echo $this->curPlayeds["341"]["bonusProp"]?>"},
                    "3": {name:"小单",value:"<?php echo $this->curPlayeds["341"]["bonusProp"]?>"},
                    "4": {name:"小双",value:"<?php echo $this->curPlayeds["341"]["bonusProp"]?>"}
                },
                "7": {
                    "1": {name:"极大",value:"<?php echo $this->curPlayeds["342"]["bonusProp"]?>"},
                    "2": {name:"极小",value:"<?php echo $this->curPlayeds["342"]["bonusProp"]?>"}
                }
            }
        }
    };

    loadodds(_data.oddslist);

    //清空投注
    function formReset() {
        $("#pcddtouzhu :input").each(function () {
            $(this).val("");
        });
    }

    function checkLogin() {
        $.ajax({
            url: 'common/checkLogin',//检测是否登录
            type: 'GET',
            dataType: 'json',
            success: function (results) {
                if (results.status == "200") {
                    isLogin = true;
                }
            }
        });
    }

    //投注提交
    function order() {

        if (!culs) {
            //hintLogin();
            checkLogin();
            alert("请登录后操作");
            return;
        }

        var cou = 0, txt = '', ball = '';
        var mix = 5;
        var m = 0;
        var c = true;
        var idx = 0;
        var oMyForm = '';
        for (var i = 1; i <= 7; i++) {
            if (i == 1) {
                for (var s = 1; s <= 28; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        //var odds = $("#ball_" + i + "_h" + s).children("a").html(); //赔率
                        var odds = ball.parent('div').siblings().eq(1).html();
                        console.log(odds);
                        var q = did(i); //玩法
                        var w = wan(s); //号码

                        oMyForm += "code[" + idx + "][fanDian]=" + 0 + "&";
                        oMyForm += "code[" + idx + "][bonusProp]=" + odds + "&";
                        oMyForm += "code[" + idx + "][mode]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][beiShu]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][actionNum]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][actionData]=" + w + "&";
                        oMyForm += "code[" + idx + "][actionAmount]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][orderId]=" + ((new Date()) - Math.floor(Math.random() * 10000)) + "&";
                        oMyForm += "code[" + idx + "][playedId]=" + 339 + "&";

                        // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                        idx++;
                        cou++;
                    }
                }
            } else if (i == 2) {
                for (var s = 1; s <= 4; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        //获取投注项，赔率
                        //var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var odds = ball.parent('div').siblings().eq(1).html();
                        var q = did(i);
                        var w = wan2(s);

                        oMyForm += "code[" + idx + "][fanDian]=" + 0 + "&";
                        oMyForm += "code[" + idx + "][bonusProp]=" + odds + "&";
                        oMyForm += "code[" + idx + "][mode]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][beiShu]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][actionNum]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][actionData]=" + w + "&";
                        oMyForm += "code[" + idx + "][actionAmount]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][orderId]=" + ((new Date()) - Math.floor(Math.random() * 10000)) + "&";
                        oMyForm += "code[" + idx + "][playedId]=" + 340 + "&";

                        // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                        idx++;
                        cou++;
                    }
                }
            } else if (i == 3) {
                for (var s = 1; s <= 3; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        //获取投注项，赔率
                        //var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var odds = ball.parent('div').siblings().eq(1).html();
                        var q = did(i);
                        var w = wan3(s);

                        oMyForm += "code[" + idx + "][fanDian]=" + 0 + "&";
                        oMyForm += "code[" + idx + "][bonusProp]=" + odds + "&";
                        oMyForm += "code[" + idx + "][mode]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][beiShu]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][actionNum]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][actionData]=" + w + "&";
                        oMyForm += "code[" + idx + "][actionAmount]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][orderId]=" + ((new Date()) - Math.floor(Math.random() * 10000)) + "&";
                        oMyForm += "code[" + idx + "][playedId]=" + 343 + "&";

                        // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                        idx++;
                        cou++;
                    }
                }
            } else if (i == 4) {
                for (var s = 1; s <= 1; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        //获取投注项，赔率
                        //var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var odds = ball.parent('div').siblings().eq(1).html();
                        var q = did(i);
                        var w = wan4(s);

                        oMyForm += "code[" + idx + "][fanDian]=" + 0 + "&";
                        oMyForm += "code[" + idx + "][bonusProp]=" + odds + "&";
                        oMyForm += "code[" + idx + "][mode]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][beiShu]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][actionNum]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][actionData]=" + w + "&";
                        oMyForm += "code[" + idx + "][actionAmount]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][orderId]=" + ((new Date()) - Math.floor(Math.random() * 10000)) + "&";
                        oMyForm += "code[" + idx + "][playedId]=" + 344 + "&";

                        // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                        idx++;
                        cou++;
                    }
                }
            } else if (i == 5) {
                for (var s = 1; s <= 1; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        //获取投注项，赔率
                        //var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var odds = ball.parent('div').siblings().eq(1).html();
                        var q = did(i);
                        var w = wan5(s);

                        oMyForm += "code[" + idx + "][fanDian]=" + 0 + "&";
                        oMyForm += "code[" + idx + "][bonusProp]=" + odds + "&";
                        oMyForm += "code[" + idx + "][mode]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][beiShu]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][actionNum]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][actionData]=" + w + "&";
                        oMyForm += "code[" + idx + "][actionAmount]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][orderId]=" + ((new Date()) - Math.floor(Math.random() * 10000)) + "&";
                        oMyForm += "code[" + idx + "][playedId]=" + 345 + "&";

                        // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                        idx++;
                        cou++;
                    }
                }
            } else if (i == 6) {
                for (var s = 1; s <= 4; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        //获取投注项，赔率
                        //var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var odds = ball.parent('div').siblings().eq(1).html();
                        var q = did(i);
                        var w = wan6(s);

                        oMyForm += "code[" + idx + "][fanDian]=" + 0 + "&";
                        oMyForm += "code[" + idx + "][bonusProp]=" + odds + "&";
                        oMyForm += "code[" + idx + "][mode=]" + 1 + "&";
                        oMyForm += "code[" + idx + "][beiShu=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][actionNum=" + 1 + "&";
                        oMyForm += "code[" + idx + "][actionData=" + w + "&";
                        oMyForm += "code[" + idx + "][actionAmount=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][orderId=" + ((new Date()) - Math.floor(Math.random() * 10000)) + "&";
                        oMyForm += "code[" + idx + "][playedId=" + 341 + "&";

                        // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                        idx++;
                        cou++;
                    }
                }
            } else if (i == 7) {
                for (var s = 1; s <= 2; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        //获取投注项，赔率
                        //var odds = $("#ball_" + i + "_h" + s).children("a").html();
                        var odds = ball.parent('div').siblings().eq(1).html();
                        var q = did(i);
                        var w = wan7(s);

                        oMyForm += "code[" + idx + "][fanDian]=" + 0 + "&";
                        oMyForm += "code[" + idx + "][bonusProp]=" + odds + "&";
                        oMyForm += "code[" + idx + "][mode]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][beiShu]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][actionNum]=" + 1 + "&";
                        oMyForm += "code[" + idx + "][actionData]=" + w + "&";
                        oMyForm += "code[" + idx + "][actionAmount]=" + parseInt(ball.val()) + "&";
                        oMyForm += "code[" + idx + "][orderId]=" + ((new Date()) - Math.floor(Math.random() * 10000)) + "&";
                        oMyForm += "code[" + idx + "][playedId]=" + 342 + "&";

                        // txt = txt + q + ' [' + w +'] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                        idx++;
                        cou++;
                    }
                }
            } else {
                ball = $("#ball_" + i + "_1");
                if (ball.val() != "" && ball.val() != null) {
                    //判断最小下注金额
                    if (parseInt(ball.val()) < mix) {
                        c = false;
                    }
                    m = m + parseInt(ball.val());
                    //获取投注项，赔率
                    //var odds = $("#ball_" + i + "_h1").children("a").html();
                    var odds = ball.parent('div').siblings().eq(1).html();
                    var q = did(i);
                    var w = wan4(1);
                    txt = txt + q + ' [' + w + '] @ ' + odds + ' x ￥' + parseInt(ball.val()) + '\n';
                    idx++;
                    cou++;
                }
            }
        }
        if (!c) {
            $.alert("最低下注金额：" + mix + "元！");
            return false;
        }
        if (cou <= 0) {
            $.alert("请输入下注金额！！");
            return false;
        }
        var t = "共 ￥" + m + " / " + cou + " 笔，确定下注吗？\n\n下注明细如下：\n\n";
        txt = t + txt;
        var codes = "";
        codes = oMyForm;
        var actionNo = $.parseJSON($.ajax('/index.php/game/getNo/' + game.type, {async: false}).responseText);
        codes += "para[type]=" + game.type + "&";
        codes += "para[actionNo]=" + actionNo.actionNo + "&";
        codes += "para[kjTime]=" + actionNo.actionTime;

        var tipString = '<div class="title">你确定加入 ' + actionNo['actionNo'] + ' 期？</div><div class="floatarea">';
        for (var pair in oMyForm.entrys) {
            if (pair[0].indexOf("actionData") !== -1) {
                tipString += "<p><span>元</span><b>" + pair[1] + "</b></p>";
            }
        }
        tipString += '</div>';
        tipString += '<div class="totleNum"><span class="numlabel">总金额:</span> <span>' + m + ' 元</span></div>';

        $.confirm(tipString, function () {
            wait();
            $.ajax({
                type: "POST",
                url: "/index.php/game/post28ddData",
                data: codes,
                dataType: "json",
                success: function (data) {
                    destroyWait();
                    if (data) $.alert(data);
                    formReset();
                },
                complete: function (xhr, textStatus) {
                    var errorMessage = xhr.getResponseHeader('X-Error-Message');
                    if (errorMessage) gamePostedCode(decodeURIComponent(errorMessage));
                }, error: function (xhr, textStatus, errorThrown) {
                    gamePostedCode(errorThrown || textStatus);
                }
            });
        });

    }

    function total() {
        var cou = 0, ball = '';
        var mix = 5;
        var m = 0;
        var c = true;
        for (var i = 1; i <= 7; i++) {
            if (i == 1) {
                for (var s = 1; s <= 28; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        cou++;
                    }
                }
            } else if (i == 2) {
                for (var s = 1; s <= 4; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        cou++;
                    }
                }
            } else if (i == 3) {
                for (var s = 1; s <= 3; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        cou++;
                    }
                }
            } else if (i == 4) {
                for (var s = 1; s <= 1; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());

                    }
                }
            } else if (i == 5) {
                for (var s = 1; s <= 1; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        cou++;
                    }
                }
            } else if (i == 6) {
                for (var s = 1; s <= 4; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        cou++;
                    }
                }
            } else if (i == 7) {
                for (var s = 1; s <= 2; s++) {
                    ball = $("#ball_" + i + "_" + s);
                    if (ball.val() != "" && ball.val() != null) {
                        //判断最小下注金额
                        if (parseInt(ball.val()) < mix) {
                            c = false;
                        }
                        m = m + parseInt(ball.val());
                        cou++;
                    }
                }
            } else {
                ball = $("#ball_" + i + "_1");
                if (ball.val() != "" && ball.val() != null) {
                    //判断最小下注金额
                    if (parseInt(ball.val()) < mix) {
                        c = false;
                    }
                    m = m + parseInt(ball.val());
                    cou++;
                }
            }
        }
        $('.tz-count').html(cou);
        $('.tz-amount').html(m);
    }
    /**
     * 投注后置函数
     */
    function gamePostedCode(err, data) {
        if (err) {
            if ('您的可用资金不足，是否充值？' == err) {
                if (window.confirm(err)) window.location, href = '/index.php/cash/recharge';
            } else {
                $.alert(err);
            }
        } else {
            //resetTotal();
        }
    }

    //读取第几球
    function did(type) {
        var r = '';
        switch (type) {
            case 1:
                r = '特码';
                break;
            case 2:
                r = '大小单双';
                break;
            case 3:
                r = '波色';
                break;
            case 4:
                r = '豹子';
                break;
            case 5:
                r = '特码三压一';
                break;
            case 6:
                r = '大&小&单&双';
                break;
            case 7:
                r = '极大极小';
                break;
        }
        return r;
    }

    //读取玩法
    function wan(type) {
        var r = '';
        switch (type) {
            case 1 :
                r = '0';
                break;
            case 2 :
                r = '1';
                break;
            case 3 :
                r = '2';
                break;
            case 4 :
                r = '3';
                break;
            case 5 :
                r = '4';
                break;
            case 6 :
                r = '5';
                break;
            case 7 :
                r = '6';
                break;
            case 8 :
                r = '7';
                break;
            case 9 :
                r = '8';
                break;
            case 10 :
                r = '9';
                break;
            case 11 :
                r = '10';
                break;
            case 12 :
                r = '11';
                break;
            case 13 :
                r = '12';
                break;
            case 14 :
                r = '13';
                break;
            case 15 :
                r = '14';
                break;
            case 16 :
                r = '15';
                break;
            case 17 :
                r = '16';
                break;
            case 18 :
                r = '17';
                break;
            case 19 :
                r = '18';
                break;
            case 20 :
                r = '19';
                break;
            case 21 :
                r = '20';
                break;
            case 22 :
                r = '21';
                break;
            case 23 :
                r = '22';
                break;
            case 24 :
                r = '23';
                break;
            case 25 :
                r = '24';
                break;
            case 26 :
                r = '25';
                break;
            case 27 :
                r = '26';
                break;
            case 28 :
                r = '27';
                break;
        }
        return r;
    }

    //读取玩法
    function wan2(type) {
        var r = '';
        switch (type) {
            case 1 :
                r = '大';
                break;
            case 2 :
                r = '小';
                break;
            case 3 :
                r = '单';
                break;
            case 4 :
                r = '双';
                break;
        }
        return r;
    }

    //读取玩法
    function wan3(type) {
        var r = '';
        switch (type) {
            case 1 :
                r = '红波';
                break;
            case 2 :
                r = '绿波';
                break;
            case 3 :
                r = '蓝波';
                break;
        }
        return r;
    }

    //读取玩法
    function wan4(type) {
        var r = '';
        switch (type) {
            case 1 :
                r = '豹子';
                break;
        }
        return r;
    }

    //读取玩法
    function wan5(type) {
        var r = '';
        r = $("#tm3y1_1").val() + "," + $("#tm3y1_2").val() + "," + $("#tm3y1_3").val();
        return r;
    }

    //读取玩法
    function wan6(type) {
        var r = '';
        switch (type) {
            case 1 :
                r = '大双';
                break;
            case 2 :
                r = '大单';
                break;
            case 3 :
                r = '小双';
                break;
            case 4 :
                r = '小单';
                break;
        }
        return r;
    }

    //读取玩法
    function wan7(type) {
        var r = '';
        switch (type) {
            case 9 :
                r = '极大';
                break;
            case 10 :
                r = '极小';
                break;
        }
        return r;
    }

    function digitOnly($this) {
        var n = $($this);
        var r = /^\+?[1-9][0-9]*$/;
        if (!r.test(n.val())) {
            n.val("");
        }
    }
    
    
    $(".code").click(function(){
    	if($(this).is(".active")){
    		$(this).removeClass('active');
    		$(this).parent().find("input").val('');
    		$(this).parent().find('select').val(0);
    	}else{
    		$(this).addClass("active");
    		$(this).parent().find("input").val(5);
    		$(this).parent().find('select').val(5);
    	}
    	total();
    });
    
    $(".code-wrapper input").blur(function(){
    	clearCheck($(this));
    });
    
    $(".code-wrapper select").change(function(){
    	var that = $(this);
    	var lis = that.parents("li.play-item");
    	var selects = lis.find("select");
    	var flag = true;
    	for(var i =0;i<selects.length;i++){
    		if($(selects[i]).val() == 0){
    			flag = false;
    		}
    	};
    	flag?lis.find(".code").addClass("active"):lis.find(".code").removeClass("active");
    });
    
    
    function clearCheck(that){
    	var val = that.val();
    	var lis = that.parents("li.play-item");
    	console.log(val)
    	 if(isNaN(val) && typeof val != 'number' ){
    	 	 that.val("");
    	 };
    	 if(that.val() <= 0){
    	 		that.val("");
    	 };
    	 if(that.val() == ''){
    	 	lis.find(".code").removeClass("active");
    	 }else{
    	 	  if(!lis.find(".code").is(".active")){
    	 	  	 lis.find(".code").addClass("active");
    	 	  }
    	 }
    }
    
    
    
</script>