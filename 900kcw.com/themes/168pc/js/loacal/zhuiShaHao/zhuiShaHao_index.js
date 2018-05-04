var FunObj = {};
var rows = $("#select").val(); // 加载多少期数据
var fundate = "";
var publicUrl = config.publicUrl;
var timeOutInit = "";
var ranData = "";
var xaranData = "";
var lot_type = $(".lotteryType>ul>.check").attr("data-text");
//var publicUrl = "http://13.112.108.218/";
var oldLog = console.log; //重写 console.log
console.log = function() {
    if(config.ifDebugger) {
        oldLog.apply(console, arguments);
    } else {
        return
    }

}
$(function() {
    fundate = formatDate(new Date());
    //加载头部和尾部
    $("#headdivbox").load("../public/head.html?v=20171214145", function() {
        if(config.ifdebug) {
            console.log("request is over!");
        }
    });
    $("#fooderbox").load("../public/fooder.html?v=20171214145", function() {
        if(config.ifdebug) {
            console.log("request is over!");
        }
    });

    //回到顶部
    $("#gotop").click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        $(this).hide();
        return false;
    });
    $(document).scroll(function() {
        //console.log($(this).scrollTop())
        if($(this).scrollTop() > 10) {
            $("#gotop").show();
        } else {
            $("#gotop").hide();
        }
    });
    //定义统一透明样式兼容IE8
    function opacity(obj, num, filt) {
        obj.style.filter = "alpha(opacity:" + filt + ")";
        obj.style.opacity = num;
    }

    // 默认加载北京pk10 的追号计划
    $('.cqssc_ran').
    hide();
    FunObj.zhuiHao_pk10("pk10");
    FunObj.XaHao_pk10("pk10")

    //日期選擇
    $(".date").val(formatDate(new Date()));

    function formatDate(date) {
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        //      m = m < 10 ? '0' + m : m;
        var d = date.getDate();
        d = d < 10 ? ('0' + d) : d;
        return y + '-' + m + '-' + d;
    };
    //
    //// 11选5追号中，修改下面li里的字
    FunObj.LiText = function() {
        //      console.log($(".11check5_ran").css("display"));
        if($(".ran").css("display") == "block" && $(".11check5_ran").css("display") == "block") {
            var litext = $(".11check5_ran>.check_ran").text();
            //          if(litext.indexOf("一") == -1 && litext.indexOf("八") == -1) {
            //              $(".ZHao_1 .check_zhuOrXa").text(litext + "（复式）")
            //          } else {
            $(".ZHao_1  .check_zhuOrXa").text(litext);
            //          }
        } else {
            $(".ZHao_1 .check_zhuOrXa").text("个位追号");
        }
    }

    //初始化时间控件
    $('#datebox').calendar({
        trigger: '.date',
        zIndex: 999,
        format: 'yyyy-mm-dd',
        onSelected: function(view, date, data) {
            var date = formatDate(date);
            fundate = date;
            console.log("选择日期时触发" + date);
            if(date != formatDate(new Date())) {
                $("#select").hide()
                rows = 0;
            } else {
                $("#select").show();
                rows = $("#select").val();
            }
            FunObj.orzhuihao();
        },
        onClose: function(view, date, data) {
            if(config.ifdebug) {
                console.log("关闭是触发");
            }
        }
    });
});

//彩种，鼠标移进来改变边框颜色,click 添加class
$(".lotteryType>ul>li:not(.disabled)").on({
    mouseenter: function() {
        if($(this).hasClass("check")) {
            return
        }
        $(this).css("border-color", "#FA8E19");
    },
    mouseout: function() {
        if($(this).hasClass("check")) {
            return
        }
        $(this).css("border-color", "#E0E0E0");
    },
    click: function() {
        var showElem = $(this).attr("data-text");
        clearTimeout(timeOutInit);
        FunObj.isRan(showElem);
        $(this).addClass("check").css("border-color", "#FA8E19").siblings().removeClass("check");
        $(".lotteryType>ul>li:not(.check)").css("border-color", "#E0E0E0");
        lot_type = $(this).attr("data-text");
        FunObj.orzhuihao(lot_type);
        FunObj.introduction($(this).text());
        //      if(FunObj.Iskuai_3(showElem) && $(".check_a").hasClass("zhao_a")) {   // 原快三多一项 和值 切换页面
        //          $(".ZHao_1").hide().siblings(".ZHao_2").show()
        //      } else {
        //          $(".ZHao_2").hide().siblings(".ZHao_1").show()
        //      }
    }
})

$(".ran>ul>li:not(.disabled)").on({
    mouseenter: function() {
        if($(this).hasClass("check_ran")) {
            return
        }
        $(this).css("border-color", "#FA8E19");
    },
    mouseout: function() {
        if($(this).hasClass("check_ran")) {
            return
        }
        $(this).css("border-color", "#E0E0E0");
    },
    click: function() {
        $(this).addClass("check_ran").css("border-color", "#FA8E19").siblings().removeClass("check_ran");
        $(".ran>ul>li:not(.check_ran)").css("border-color", "#E0E0E0");

    }
})
$(".ch-left").on("click", "a", function(e) {
    e.preventDefault();
    if($(this).hasClass("zhao_a")) {
        $(".view_content").css("left", "0");
    } else {
        $(".view_content").css("left", "-1200px");
    }
    $(this).addClass("check_a").siblings().removeClass("check_a");

    var showElem = $(".lotteryType>ul>li.check").attr("data-text")
    FunObj.isRan(showElem);
    FunObj.orzhuihao();
    FunObj.introduction($(".check").text())
})
FunObj.isWidth = function(plan) {
    var wid = plan == "A" ? 177 : (plan == "B" ? 140 : 105)
    $(".listcontent .ZHao .zuHao_plan .xhuiHao_content li>.zhui_ul").css("cssText", "width:" + wid + "px !important"); // 140 105
}

// 追号请求函数 --北京pk10
FunObj.zhuiHao_pk10 = function(lot_type) {
    var data = {
        lotCode: lotCode[lot_type], //lotCode[lot_type]
        rows: rows,
        date: fundate
    }
    $.ajax({
        url: "http://www.900kcw.com/?r=home/count/lotteryPlan", //  PursueNum/getPksPursueNumList.php
        type: "GET",
        data: data,
        success: function(data) {
            //执行数据请求
            var checkNum = $(".11check5_ran>.check_ran").attr("data-text");
            FunObj.zhuiHao_pk10_analysis(data, checkNum);
            ranData = data;
        },
        error: function(data) {
            console.log("追号请求错误!");
        }
    });
}

//追号数据分析函数  --北京pk10
FunObj.zhuiHao_pk10_analysis = function(data, plan, Timeout) {
    $(".ZHao_1  .check_zhuOrXa").text($(".11check5_ran>.check_ran").text());
    if(typeof(data) == "string") {
        data = JSON.parse(data);
    }
    console.log(data);
    $(".ZHao_1 .xhuiHao_content").remove();
    $(".ZHao_1 .sum_ul").remove();
    if(data.result.data == "") {
        $(".check_issue").text(0);
        return;
    }
    //  var timer = data.result.data[0].countTime < 1  && data.result.data[0].countTime >-1000 ? 5000 : data.result.data[0].countTime * 1000;
    var timer = data.result.data[0].countTime < 1 && data.result.data[0].countTime > -1000 ? 5000 : (data.result.data[0].countTime < 1 && data.result.data[0].countTime < -1000 ? 1000000 : data.result.data[0].countTime * 1000);
    console.log(lot_type, timer / 1000);
    if(Timeout == undefined) {
        console.log("in")
        timeOutInit = setTimeout(function() {
            FunObj.zhuiHao_pk10(lot_type);
        }, timer);
    }
    if($("#select").css("display") == "none") {
        $(".check_issue").text(data.result.data.length);
    } else {
        $(".check_issue").text(data.result.data.length - 1);
    }
    var html = "",
        sum_html = "<ul class='sum_ul'>";
    $.each(data.result.data, function(i, p) {
        var preDrawCode = p.preDrawCode.split(",");
        var pursueNum = p["plan" + plan].split(",");
        var cla = "";
        if(p["profit" + plan].indexOf("-") == -1) {
            cla = "resultRed";
        } else {
            cla = "resultBlue";
        }
        if(preDrawCode.length == 1) {
            var html_text = "等待开奖"
        } else {
            var html_text = "<ul>" +
                "<li class='pk10_" + preDrawCode[0] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[1] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[2] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[3] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[4] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[5] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[6] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[7] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[8] * 1 + "'></li>" +
                "<li class='pk10_" + preDrawCode[9] * 1 + "'></li>" +
                "</ul>"
        }
        var num4 = pursueNum[2] != undefined ? "<li class='pk10_" + pursueNum[3] * 1 + "'></li>" : "";
        var num5 = pursueNum[2] != undefined ? "<li class='pk10_" + pursueNum[4] * 1 + "'></li>" : "";
        html += "<ul class='xhuiHao_content'>" +
            "<li>" + p.preDrawIssue + "期</li>" +
            "<li>" + html_text + "</li>" +
            "<li>" +
            "<ul class='zhui_ul'>" +
            "<li class='pk10_" + pursueNum[0] * 1 + "'></li>" +
            "<li class='pk10_" + pursueNum[1] * 1 + "'></li>" +
            "<li class='pk10_" + pursueNum[2] * 1 + "'></li>" + num4 + num5 +
            "</ul>" +
            "</li>" +
            "<li>" + p["lotteryCost" + plan] + "</li>" +
            "<li>" + p["lotteryCostAll" + plan] + "</li>" +
            "<li class='" + cla + "'>" + p["profit" + plan] + "</li>" +
            "</ul>"
    });
    //成绩统计表
    //  $.each(data.result.data.countResult, function(k, l) {
    //      var span_text = l.slice(l.indexOf("(") + 1, l.length - 1);
    //      var li_text = l.slice(0, l.indexOf("("));
    //      sum_html += "<li>" + li_text + "（<span>" + span_text + "</span>）" + "</li>"
    //  })
    //  sum_html += "</ul>"
    $('.ZHao_1  .zhuiHao_title').after(html);
    //  $(".ZHao_1  .result_sum>ul").after(sum_html);
    FunObj.isWidth(plan)
}
// 追号请求函数 --重庆时时彩
FunObj.zhuiHao_cqssc = function(lot_type) {

    var data = {
        lotCode: lotCode[lot_type],
        rows: rows,
        date: fundate
    }
    $.ajax({
        url: publicUrl + "LotteryPlan/getSscPlanList.php", //PursueNum/getSscPursueNumList.php
        type: "GET",
        data: data,
        success: function(data) {
            //执行数据请求
            var checkNum = $(".11check5_ran>.check_ran").attr("data-text");
            FunObj.zhuiHao_cqssc_analysis(data, checkNum);
            ranData = data;
        },
        error: function(data) {
            console.log("追号请求错误!");
        }
    });
}
//追号数据分析函数  --重庆时时彩
FunObj.zhuiHao_cqssc_analysis = function(data, plan, Timeout) {
    //  $(".check_zhuOrXa").text("个位追号")
    //  FunObj.LiText(); //修改下面li里的字
    if(typeof(data) == "string") {
        data = JSON.parse(data);
    }
    console.log(data);
    var timer = data.result.data[0].countTime < 1 && data.result.data[0].countTime > -1000 ? 5000 : (data.result.data[0].countTime < 1 && data.result.data[0].countTime < -1000 ? 1000000 : data.result.data[0].countTime * 1000);
    console.log(lot_type, timer / 1000);
    if(Timeout == undefined) {
        timeOutInit = setTimeout(function() {
            FunObj.zhuiHao_cqssc(lot_type);
        }, timer);
    }
    $(".ZHao_1 .xhuiHao_content").remove();
    //  $(".ZHao_1 .sum_ul").remove();
    if(data.result.data == "") {
        $(".check_issue").text(0);
        return;
    }
    if($("#select").css("display") == "none") {
        $(".check_issue").text(data.result.data.length);
    } else {
        $(".check_issue").text(data.result.data.length - 1);
    }
    var html = "",
        sum_html = "<ul class='sum_ul'>";
    $.each(data.result.data, function(i, p) {
        var preDrawCode = p.preDrawCode.split(",");
        var pursueNum = p["plan" + plan].split(",");
        var cla = "";
        if(p["profit" + plan].indexOf("-") == -1) {
            cla = "resultRed";
        } else {
            cla = "resultBlue";
        }
        if(preDrawCode.length == 1) {
            var html_text = "等待开奖"
        } else {
            var html_text = "<ul>" +
                "<li class='cqssc_'>" + preDrawCode[0] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[1] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[2] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[3] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[4] * 1 + "</li>" +
                "</ul>"
        }
        var num4 = pursueNum[2] != undefined ? "<li class='cqssc_'>" + pursueNum[3] * 1 + "</li>" : "";
        var num5 = pursueNum[2] != undefined ? "<li class='cqssc_'>" + pursueNum[4] * 1 + "</li>" : "";
        html += "<ul class='xhuiHao_content'>" +
            "<li>" + p.preDrawIssue + "期</li>" +
            "<li>" + html_text + "</li>" +
            "<li>" +
            "<ul class='zhui_ul'>" +
            "<li class='cqssc_'>" + pursueNum[0] * 1 + "</li>" +
            "<li class='cqssc_'>" + pursueNum[1] * 1 + "</li>" +
            "<li class='cqssc_'>" + pursueNum[2] * 1 + "</li>" + num4 + num5 +
            "</ul>" +
            "</li>" +
            "<li>" + p["lotteryCost" + plan] + "</li>" +
            "<li>" + p["lotteryCostAll" + plan] + "</li>" +
            "<li class='" + cla + "'>" + p["profit" + plan] + "</li>" +
            "</ul>"
    });
    //成绩统计表
    //  $.each(data.result.data.countResult, function(k, l) {
    //      var span_text = l.slice(l.indexOf("(") + 1, l.length - 1);
    //      var li_text = l.slice(0, l.indexOf("("));
    //      sum_html += "<li>" + li_text + "（<span>" + span_text + "</span>）" + "</li>"
    //  })
    //  sum_html += "</ul>"
    $('.ZHao_1 .zhuiHao_title').after(html);
    //  $(".ZHao_1 .result_sum>ul").after(sum_html);
    $(".ZHao_1 .xhuiHao_content li ul:first-child").css("width", "175px");
    FunObj.isWidth(plan);
}

// 杀号请求函数 --北京pk10
FunObj.XaHao_pk10 = function(lot_type) {
    var data = {
        lotCode: lotCode[lot_type],
        rows: rows,
        date: fundate
    }
    $.ajax({
        url: "http://www.900kcw.com/?r=home/count/killNum",
        type: "GET",
        data: data,
        success: function(data) {
            //执行数据请求
            var checkNum = $(".pk10_ran>.check_ran").attr("data-text");
            FunObj.XaHao_px10_analysis(data, checkNum);
            xaranData = data;
        },
        error: function(data) {
            console.log("杀号请求错误!");
        }
    });
}

// 杀号数据分析函数 --北京pk10
FunObj.XaHao_px10_analysis = function(data, checkNum) {
    $(".list-content").remove();
    $(".remover_foot").remove();
    if(typeof(data) == "string") {
        data = JSON.parse(data);
    }
    if(data.result.data == "") {
        return;
    }
    console.log(data)
    var contentHtml = "",
        resHtml = "";
    $.each(data.result.data.list, function(j, k) {
        var cla_col = [],
            xaArr = [],
            textArr = [],
            bgarr = [];
        var arr = k[checkNum + "Num"];
        for(var i = 0; i < arr.length; i++) {
            if((i + 1) % 2 == 0) {
                if(arr[i] == 0) {
                    cla_col.push("");
                    bgarr.push("");
                    textArr.push("-")
                } else if(arr[i] == 1) {
                    cla_col.push("col_red");
                    bgarr.push("bg_red")
                    textArr.push("杀对")
                } else {
                    cla_col.push("col_blue");
                    bgarr.push("col_blue")
                    textArr.push("杀错")
                }
            } else {
                xaArr.push(arr[i])
            }
        }
        //     console.log(cla_col,xaArr,textArr,bgarr)
        if(k.preDrawCode == "") {
            var fragmentHtml = "等待开奖";
        } else {
            var numCode = k.preDrawCode.split(",");
            //          console.log(numCode)
            var fragmentHtml = "<ul class='num_ul'>" +
                "<li class='pk10_" + numCode[0] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[1] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[2] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[3] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[4] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[5] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[6] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[7] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[8] * 1 + "'></li>" +
                "<li class='pk10_" + numCode[9] * 1 + "'></li>" +
                "</ul>"
        }
        contentHtml += "<ul class='list-content'>" +
            "<li>" + k.preDrawIssue + "期</li>" +
            "<li>" + fragmentHtml + "</li>" +
            "<li class='" + cla_col[0] + "'>杀:" + xaArr[0] + "</li>" +
            "<li class='" + bgarr[0] + "'>" + textArr[0] + "</li>" +
            "<li class='" + cla_col[1] + "'>杀:" + xaArr[1] + "</li>" +
            "<li class='" + bgarr[1] + "'>" + textArr[1] + "</li>" +
            "<li class='" + cla_col[2] + "'>杀:" + xaArr[2] + "</li>" +
            "<li class='" + bgarr[2] + "'>" + textArr[2] + "</li>" +
            "<li class='" + cla_col[3] + "'>杀:" + xaArr[3] + "</li>" +
            "<li class='" + bgarr[3] + "'>" + textArr[3] + "</li>" +
            "<li class='" + cla_col[4] + "'>杀:" + xaArr[4] + "</li>" +
            "<li class='" + bgarr[4] + "'>" + textArr[4] + "</li></ul>"
    });
    var resarr = data.result.data[checkNum + "KillRight"];
    var resarr2 = data.result.data[checkNum + "Percent"];
    resHtml = "<ul class='list_footer remover_foot'>" +
        "<li>杀对次数</li>" +
        "<li>" + resarr[0] + "</li>" +
        "<li>" + resarr[1] + "</li>" +
        "<li>" + resarr[2] + "</li>" +
        "<li>" + resarr[3] + "</li>" +
        "<li>" + resarr[4] + "</li></ul>" +
        "<ul class='list_footer remover_foot'>" +
        "<li>成功概率</li>" +
        "<li>" + resarr2[0] + "</li>" +
        "<li>" + resarr2[1] + "</li>" +
        "<li>" + resarr2[2] + "</li>" +
        "<li>" + resarr2[3] + "</li>" +
        "<li>" + resarr2[4] + "</li></ul>";
    $(".list_box>.list-title").after(contentHtml);
    $(".list_footerTil").after(resHtml);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////11选5
// 追号请求函数 --11选5
FunObj.zhuiHao_11check5 = function(lot_type) {
    var data = {
        lotCode: lotCode[lot_type],
        rows: rows,
        date: fundate
    }
    $.ajax({
        url: publicUrl + "PursueNum/getEfPursueNumList.php",
        type: "GET",
        data: data,
        success: function(data) {
            //执行数据请求
            var checkNum = $(".11check5_ran>.check_ran").attr("data-text");
            FunObj.zhuiHao_11check5_analysis(data, checkNum);
            //          $(".11check5_ran").on("click", "li", function() {
            //              var checkli = $(this).attr("data-text");
            //              FunObj.zhuiHao_11check5_analysis(data, checkli);
            //              FunObj.LiText(); //修改下面li里的字
            //          })
        },
        error: function(data) {
            console.log("11选5追号请求错误!");
        }
    });
}

//追号数据分析函数  --11选5
FunObj.zhuiHao_11check5_analysis = function(data, checkNum) {
    //  $(".check_zhuOrXa").text("个位追号")
    FunObj.LiText(); //修改下面li里的字
    if(typeof(data) == "string") {
        data = JSON.parse(data);
    }
    console.log(data);
    $(".xhuiHao_content").remove();
    $(".sum_ul").remove();
    if(data.result.data == "") {
        $(".check_issue").text(0);
        return;
    }
    if($("#select").css("display") == "none") {
        $(".check_issue").text(data.result.data.list.length);
    } else {
        $(".check_issue").text(data.result.data.list.length - 1);
    }
    var html = "",
        length = 0,
        sum_html = "<ul class='sum_ul'>";
    $.each(data.result.data.list, function(i, p) {
        var preDrawCode = p.preDrawCode.split(",");
        var pursueNum = p[checkNum + "Pursue"][0].split(",");
        var cla = "",
            colorNum = p[checkNum + "Pursue"][2] * 1,
            zongcuNum = p[checkNum + "Pursue"][1] * 1,
            zongcutext = "";
        length = pursueNum.length;
        if(zongcuNum == 0) {
            zongcutext = "继续追号"
        } else if(zongcuNum == -1) {
            zongcutext = "追号失败"
        } else if(zongcuNum == 1) {
            zongcutext = "当期追中"
        } else {
            zongcutext = zongcuNum + "期追中"
        }
        if(colorNum == -1) {
            cla = "Wrong";
        } else if(colorNum == 0) {
            cla = "";
        } else if(colorNum == 1) {
            cla = "this_Right";
        } else {
            cla = "Right";
        }
        if(preDrawCode.length == 1) {
            var html_text = "等待开奖"
        } else {
            var html_text = "<ul>" +
                "<li class='cqssc_'>" + preDrawCode[0] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[1] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[2] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[3] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[4] * 1 + "</li>" +
                "</ul>"
        }
        html += "<ul class='xhuiHao_content'>" +
            "<li>" + p.preDrawIssue + "期</li>" +
            "<li>" + html_text + "</li>" +
            "<li>" +
            "<ul class='zhui_ul'>";
        for(var i = 0; i < length; i++) {
            html += "<li class='cqssc_'>" + pursueNum[i] * 1 + "</li>"
        }
        //          "<li class='cqssc_'>" + pursueNum[0] * 1 + "</li>" +
        //          "<li class='cqssc_'>" + pursueNum[1] * 1 + "</li>" +
        //          "<li class='cqssc_'>" + pursueNum[2] * 1 + "</li>" +
        html += "</ul></li><li class='" + cla + "'>" + zongcutext + "</li></ul>";
    });
    //成绩统计表
    $.each(data.result.data[checkNum + "Result"], function(k, l) {
        var span_text = l.slice(l.indexOf("(") + 1, l.length - 1);
        var li_text = l.slice(0, l.indexOf("("));
        sum_html += "<li>" + li_text + "（<span>" + span_text + "</span>）" + "</li>"
    })
    sum_html += "</ul>"
    $('.ZHao_1 .zhuiHao_title').after(html);
    $(".ZHao_1 .result_sum>ul").after(sum_html);
    $(".ZHao_1 .xhuiHao_content li ul:first-child").css("width", "175px");
    $(".ZHao_1 .xhuiHao_content li ul.zhui_ul").css("cssText", "width:" + length * 35 + "px !important");

}

// 杀号请求函数 --重庆时时彩
FunObj.XaHao_cqssc = function(lot_type) {

    var data = {
        lotCode: lotCode[lot_type],
        rows: rows,
        date: fundate
    }
    $.ajax({
        url: publicUrl + "KillNum/getSscKillNumList.php",
        type: "GET",
        data: data,
        success: function(data) {
            //执行数据请求
            var checkNum = $(".cqssc_ran>.check_ran").attr("data-text");
            FunObj.XaHao_cqssc_analysis(data, checkNum);
            xaranData = data;
        },
        error: function(data) {
            console.log("杀号请求错误!");
        }
    });
}

// 杀号请求函数 --11选5
FunObj.XaHao_11check5 = function(lot_type) {
    var data = {
        lotCode: lotCode[lot_type],
        rows: rows,
        date: fundate
    }
    $.ajax({
        url: publicUrl + "KillNum/getEfKillNumList.php",
        type: "GET",
        data: data,
        success: function(data) {
            //执行数据请求
            var checkNum = $(".cqssc_ran>.check_ran").attr("data-text");
            FunObj.XaHao_cqssc_analysis(data, checkNum);
            xaranData = data;
        },
        error: function(data) {
            console.log("杀号请求错误!");
        }
    });
}

// 杀号数据分析函数 --重庆时时彩
FunObj.XaHao_cqssc_analysis = function(data, checkNum) {
    $(".list-content").remove();
    $(".remover_foot").remove();
    if(typeof(data) == "string") {
        data = JSON.parse(data);
    }
    if(data.result.data == "") {
        return;
    }
    console.log(data)
    var contentHtml = "",
        resHtml = "";
    $.each(data.result.data.list, function(j, k) {
        var cla_col = [],
            xaArr = [],
            textArr = [],
            bgarr = [];
        var arr = k[checkNum + "Num"];
        for(var i = 0; i < arr.length; i++) {
            if((i + 1) % 2 == 0) {
                if(arr[i] == 0) {
                    cla_col.push("");
                    bgarr.push("");
                    textArr.push("-")
                } else if(arr[i] == 1) {
                    cla_col.push("col_red");
                    bgarr.push("bg_red")
                    textArr.push("杀对")
                } else {
                    cla_col.push("col_blue");
                    bgarr.push("col_blue")
                    textArr.push("杀错")
                }
            } else {
                xaArr.push(arr[i])
            }
        }
        if(k.preDrawCode == "") {
            var fragmentHtml = "等待开奖";
        } else {
            var numCode = k.preDrawCode.split(",");
            var fragmentHtml = "<ul class='num_ul'>" +
                "<li class='cqssc_'>" + numCode[0] * 1 + "</li>" +
                "<li class='cqssc_'>" + numCode[1] * 1 + "</li>" +
                "<li class='cqssc_'>" + numCode[2] * 1 + "</li>" +
                "<li class='cqssc_'>" + numCode[3] * 1 + "</li>" +
                "<li class='cqssc_'>" + numCode[4] * 1 + "</li>" +
                "</ul>"
        }
        contentHtml += "<ul class='list-content'>" +
            "<li>" + k.preDrawIssue + "期</li>" +
            "<li>" + fragmentHtml + "</li>" +
            "<li class='" + cla_col[0] + "'>杀:" + xaArr[0] + "</li>" +
            "<li class='" + bgarr[0] + "'>" + textArr[0] + "</li>" +
            "<li class='" + cla_col[1] + "'>杀:" + xaArr[1] + "</li>" +
            "<li class='" + bgarr[1] + "'>" + textArr[1] + "</li>" +
            "<li class='" + cla_col[2] + "'>杀:" + xaArr[2] + "</li>" +
            "<li class='" + bgarr[2] + "'>" + textArr[2] + "</li>" +
            "<li class='" + cla_col[3] + "'>杀:" + xaArr[3] + "</li>" +
            "<li class='" + bgarr[3] + "'>" + textArr[3] + "</li>" +
            "<li class='" + cla_col[4] + "'>杀:" + xaArr[4] + "</li>" +
            "<li class='" + bgarr[4] + "'>" + textArr[4] + "</li></ul>"
    });
    var resarr = data.result.data[checkNum + "KillRight"];
    var resarr2 = data.result.data[checkNum + "Percent"];
    resHtml = "<ul class='list_footer remover_foot'>" +
        "<li>杀对次数</li>" +
        "<li>" + resarr[0] + "</li>" +
        "<li>" + resarr[1] + "</li>" +
        "<li>" + resarr[2] + "</li>" +
        "<li>" + resarr[3] + "</li>" +
        "<li>" + resarr[4] + "</li></ul>" +
        "<ul class='list_footer remover_foot'>" +
        "<li>成功概率</li>" +
        "<li>" + resarr2[0] + "</li>" +
        "<li>" + resarr2[1] + "</li>" +
        "<li>" + resarr2[2] + "</li>" +
        "<li>" + resarr2[3] + "</li>" +
        "<li>" + resarr2[4] + "</li></ul>";
    $(".list_box>.list-title").after(contentHtml);
    $(".list_footerTil").after(resHtml);
    $(".num_ul").css("width", "175px");
}

////////////////////////////////////////////////////////////////////////////////////////////快3 追号
// 追号请求函数 --快3
FunObj.zhuiHao_kuai_3 = function(lot_type) {
    var data = {
        lotCode: lotCode[lot_type],
        rows: rows,
        date: fundate
    }
    $.ajax({
        url: publicUrl + "PursueNum/getKsPursueNumList.php",
        type: "GET",
        data: data,
        success: function(data) {
            //          if(typeof(data) == "string") {
            //              data = JSON.parse(data);
            //          }
            //          console.log(data);
            //执行数据请求
            FunObj.zhuiHao_kuai_3_analysis(data);
        },
        error: function(data) {
            console.log("快3追号请求错误!");
        }
    });
}

//追号数据分析函数  --快3
FunObj.zhuiHao_kuai_3_analysis = function(data) {
    $(".ZHao_2 .check_zhuOrXa").text("和值追号")
    if(typeof(data) == "string") {
        data = JSON.parse(data);
    }
    console.log(data);
    $(".ZHao_2 .xhuiHao_content").remove();
    $(".ZHao_2 .sum_ul").remove();
    if(data.result.data == "") {
        $(".check_issue").text(0);
        return;
    }
    if($("#select").css("display") == "none") {
        $(".check_issue").text(data.result.data.list.length);
    } else {
        $(".check_issue").text(data.result.data.list.length - 1);
    }
    var html = "",
        sum_html = "<ul class='sum_ul'>";
    $.each(data.result.data.list, function(i, p) {
        var preDrawCode = p.preDrawCode.split(",");
        var pursueNum = p.pursueNum.split(",");
        var cla = "";
        if(p.count == -1) {
            cla = "Wrong";
        } else if(p.count == 0) {
            cla = "";
        } else if(p.count == 1) {
            cla = "this_Right";
        } else {
            cla = "Right";
        }
        if(preDrawCode.length == 1) {
            var html_text = "等待开奖"
        } else {
            var html_text = "<ul class='kaui3ul'>" +
                "<li class='cqssc_'>" + preDrawCode[0] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[1] * 1 + "</li>" +
                "<li class='cqssc_'>" + preDrawCode[2] * 1 + "</li>" +
                "</ul>"
        }
        if(p.sumNumber != "") {
            var sumhtml = "<ul class='sumul'><li class='sumliRed'>" + p.sumNumber + "</li></ul>"
        } else {
            var sumhtml = "";
        }
        html += "<ul class='xhuiHao_content'>" +
            "<li>" + p.preDrawIssue + "期</li>" +
            "<li>" + html_text + "</li>" +
            "<li>" + sumhtml + "</li>" +
            "<li>" +
            "<ul class=''>" +
            "<li class='sumli'>" + pursueNum[0] * 1 + "</li>" +
            "<li class='sumli'>" + pursueNum[1] * 1 + "</li>" +
            "<li class='sumli'>" + pursueNum[2] * 1 + "</li>" +
            "<li class='sumli'>" + pursueNum[3] * 1 + "</li>" +
            "<li class='sumli'>" + pursueNum[4] * 1 + "</li>" +
            "</ul>" +
            "</li>" +
            "<li class='" + cla + "'>" + p.pursueResult + "</li>" +
            "</ul>"
    });
    //成绩统计表
    $.each(data.result.data.countResult, function(k, l) {
        var span_text = l.slice(l.indexOf("(") + 1, l.length - 1);
        var li_text = l.slice(0, l.indexOf("("));
        sum_html += "<li>" + li_text + "（<span>" + span_text + "</span>）" + "</li>"
    })
    sum_html += "</ul>"
    $('.ZHao_2 .zhuiHao_title').after(html);
    $(".ZHao_2 .result_sum>ul").after(sum_html);
    $(".ZHao_2 .xhuiHao_content li ul:last-child").css("width", "175px");
}
//、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、快3 杀号 
FunObj.XaHao_kuai_3 = function(lot_type) {
    var data = {
        lotCode: lotCode[lot_type],
        rows: rows,
        date: fundate
    }
    $.ajax({
        url: publicUrl + "KillNum/getFtKillNumList.php",
        type: "GET",
        data: data,
        success: function(data) {
            //          if(typeof(data) == "string") {
            //              data = JSON.parse(data);
            //          }
            //          console.log(data)
            xaranData = data;
            //执行数据请求
            var checkNum = $(".kuai_3_ran>.check_ran").attr("data-text");
            FunObj.XaHao_kuai_3_analysis(data, checkNum);
        },
        error: function(data) {
            console.log("杀号请求错误!");
        }
    });
}

//.................................快3杀号的数据分析
FunObj.XaHao_kuai_3_analysis = function(data, checkNum) {
    console.log(checkNum);
    $(".list-content").remove();
    $(".remover_foot").remove();
    if(typeof(data) == "string") {
        data = JSON.parse(data);
    }
    if(data.result.data == "") {
        return;
    }
    console.log(data)
    var contentHtml = "",
        resHtml = "";
    $.each(data.result.data.list, function(j, k) {
        var cla_col = [],
            xaArr = [],
            textArr = [],
            bgarr = [];
        if(checkNum == "second") {
            var arr = k.killSumNum;
        } else {
            var arr = k.firstNum;
        }
        for(var i = 0; i < arr.length; i++) {
            if((i + 1) % 2 == 0) {
                if(arr[i] == 0) {
                    cla_col.push("");
                    bgarr.push("");
                    textArr.push("-");
                } else if(arr[i] == 1) {
                    cla_col.push("col_red");
                    bgarr.push("bg_red");
                    textArr.push("杀对");
                } else {
                    cla_col.push("col_blue");
                    bgarr.push("col_blue");
                    textArr.push("杀错");
                }
            } else {
                xaArr.push(arr[i])
            }
        }
        if(k.preDrawCode == "") {
            var fragmentHtml = "等待开奖";
        } else {
            var numCode = k.preDrawCode.split(",");
            var fragmentHtml = "<ul class='num_ul'>" +
                "<li class='cqssc_'>" + numCode[0] * 1 + "</li>" +
                "<li class='cqssc_'>" + numCode[1] * 1 + "</li>" +
                "<li class='cqssc_'>" + numCode[2] * 1 + "</li>" +
                "</ul>"
        }
        if(k.sumNumber == undefined) {
            var sumNumber = "";
        } else if(k.sumNumber == "") {
            var sumNumber = "-";
        } else {
            var sumNumber = k.sumNumber;
        }
        contentHtml += "<ul class='list-content'>" +
            "<li>" + k.preDrawIssue + "期</li>" +
            "<li class='sumlili'>" + fragmentHtml + "</li>" +
            "<li style='width:90px' class='sumli_2'>" + sumNumber + "</li>" +
            "<li class='" + cla_col[0] + "'>杀:" + xaArr[0] + "</li>" +
            "<li class='" + bgarr[0] + "'>" + textArr[0] + "</li>" +
            "<li class='" + cla_col[1] + "'>杀:" + xaArr[1] + "</li>" +
            "<li class='" + bgarr[1] + "'>" + textArr[1] + "</li>" +
            "<li class='" + cla_col[2] + "'>杀:" + xaArr[2] + "</li>" +
            "<li class='" + bgarr[2] + "'>" + textArr[2] + "</li>" +
            "<li class='" + cla_col[3] + "'>杀:" + xaArr[3] + "</li>" +
            "<li class='" + bgarr[3] + "'>" + textArr[3] + "</li>" +
            "<li class='" + cla_col[4] + "'>杀:" + xaArr[4] + "</li>" +
            "<li class='" + bgarr[4] + "'>" + textArr[4] + "</li></ul>"
    });
    var resarr = data.result.data[checkNum + "KillRight"];
    var resarr2 = data.result.data[checkNum + "Percent"];
    resHtml = "<ul class='list_footer remover_foot'>" +
        "<li>杀对次数</li>" +
        "<li>" + resarr[0] + "</li>" +
        "<li>" + resarr[1] + "</li>" +
        "<li>" + resarr[2] + "</li>" +
        "<li>" + resarr[3] + "</li>" +
        "<li>" + resarr[4] + "</li></ul>" +
        "<ul class='list_footer remover_foot'>" +
        "<li>成功概率</li>" +
        "<li>" + resarr2[0] + "</li>" +
        "<li>" + resarr2[1] + "</li>" +
        "<li>" + resarr2[2] + "</li>" +
        "<li>" + resarr2[3] + "</li>" +
        "<li>" + resarr2[4] + "</li></ul>";
    $(".list_box>.list-title").after(contentHtml);
    $(".list_footerTil").after(resHtml);
    $(".num_ul").css("width", "105px");
    if(checkNum == "second") {
        FunObj.sumLiShow('show');
    } else {
        FunObj.sumLiShow('!show');

    }
}
FunObj.sumLiShow = function(show) {
    if(show == "show") {
        $("#sumLi").show();
        $(".sumlili").css("cssText", "width:300px !important");
        $(".sumli_2").show();
    } else {
        $("#sumLi").hide();
        $(".sumlili").css("cssText", "width:390px !important");
        $(".sumli_2").hide();
    }
}

//期号改变发出请求函数
$("#select").change(function() {
    rows = $(this).val();
    //  $(".check_issue").text(rows);
    clearTimeout(timeOutInit);
    FunObj.orzhuihao();
})

FunObj.orzhuihao = function() {
    clearTimeout(timeOutInit);
    lot_type = $(".lotteryType>ul>li.check").attr("data-text");
    //  if($(".check_a").hasClass("zhao_a") && FunObj.Iskuai_3(lot_type)) { //追号 快3
    //      $(".ZHao_1").hide().siblings(".ZHao_2").show();
    //  } else {
    //      $(".ZHao_2").hide().siblings(".ZHao_1").show()
    //  }

    if(FunObj.zhuiOrXaHao()) {
        if(FunObj.IsPk10(lot_type) || FunObj.IsXanwu(lot_type)) {
            $("#fugaiView").hide();
        } else {
            $("#fugaiView").show();
        }
    } else {
        $("#fugaiView").hide();
    }

    if(FunObj.zhuiOrXaHao() && FunObj.IsPk10(lot_type)) { //如果是追号计划  --pk10
        FunObj.zhuiHao_pk10(lot_type);
    } else if(!FunObj.zhuiOrXaHao() && FunObj.IsPk10(lot_type)) { //如果是杀号计划  --pk10
        FunObj.XaHao_pk10(lot_type);
    } else if(FunObj.zhuiOrXaHao() && FunObj.IsXanwu(lot_type)) { //如果是追号计划  --重庆时时彩
        FunObj.zhuiHao_cqssc(lot_type);
    } else if(!FunObj.zhuiOrXaHao() && FunObj.IsXanwu(lot_type)) { //如果是杀号计划  --重庆时时彩
        FunObj.XaHao_cqssc(lot_type);
    } else if(FunObj.zhuiOrXaHao() && FunObj.IsXahao11check5(lot_type)) { // 如果是追号计划  --11选5 
        //      FunObj.zhuiHao_11check5(lot_type)
    } else if(!FunObj.zhuiOrXaHao() && FunObj.IsXahao11check5(lot_type)) { //如果是杀号计划  --11选5
        FunObj.XaHao_11check5(lot_type);
    } else if(FunObj.zhuiOrXaHao() && FunObj.Iskuai_3(lot_type)) { //如果是追号计划 --快3
        //      FunObj.zhuiHao_kuai_3(lot_type)
    } else if(!FunObj.zhuiOrXaHao() && FunObj.Iskuai_3(lot_type)) { //如果是杀号计划 --快3
        FunObj.XaHao_kuai_3(lot_type)
    }
    var checksecound = $(".kuai_3_ran>.check_ran").attr("date-text");
    if(!FunObj.zhuiOrXaHao() && FunObj.Iskuai_3(lot_type) && (checksecound == "second")) { //如果是杀号快3 的和值杀号 就将和值栏显示与调整li 宽度
        FunObj.sumLiShow("show")
    } else {
        FunObj.sumLiShow("!show")
    }
}

//判断是追号或杀号
FunObj.zhuiOrXaHao = function() {
    if($(".ch-left>a.check_a").hasClass("zhao_a")) {
        return true;
    } else {
        return false;
    }
};
//判断是否是pk10 类型的li
FunObj.IsPk10 = function(lot_type) {
    if(lot_type == "pk10" || lot_type == "aozxy10" || lot_type == "jisusc") {
        return true;
    }
};
//判断是否是ssc 类型的li
FunObj.IsXanwu = function(showElem) {
    if(showElem == "cqssc" || showElem == "tjssc" || showElem == "xjssc" || showElem == "aozxy5" || showElem == "jisussc") {
        return true;
    }
};
//判断是否是11选5 类型的li
FunObj.IsXahao11check5 = function(showElem) {
    if(showElem == "cqef" || showElem == "gdsyxw" || showElem == "sdsyydj" || showElem == "jxef" || showElem == "jsef" || showElem == "ahef" || showElem == "shef" || showElem == "lnef" || showElem == "hbef" || showElem == "gxef" || showElem == "jlef" || showElem == "nmgef" || showElem == "zjef") {
        return true;
    }
};
////判断是否是 快3  类型的li
FunObj.Iskuai_3 = function(showElem) {
    if(showElem == "jsksan" || showElem == "gxft" || showElem == "jlft" || showElem == "hebft" || showElem == "nmgft" || showElem == "ahft" || showElem == "fjft" || showElem == "hubft" || showElem == "bjft") {
        return true;
    }
}

//判断三个li选项的隐藏与显示
FunObj.isRan = function(showElem) {
    if($(".check_a").hasClass("zhao_a")) { //追号11选5  && FunObj.IsXahao11check5(showElem)
        $(".ran").show().find('.11check5_ran').show().siblings().hide();
        FunObj.LiText(); //修改下面li里的字
    } else if(!$(".check_a").hasClass("zhao_a") && FunObj.IsPk10(showElem)) { //杀号pk10
        $(".ran").show().find('.pk10_ran').show().siblings().hide();
    } else if(!$(".check_a").hasClass("zhao_a") && (FunObj.IsXahao11check5(showElem) || FunObj.IsXanwu(showElem))) { //杀号重庆时时彩与11选5
        $(".ran").show().find('.cqssc_ran').show().siblings().hide();
    } else if(!$(".check_a").hasClass("zhao_a") && FunObj.Iskuai_3(showElem)) { //杀号 快3
        $(".ran").show().find('.kuai_3_ran').show().siblings().hide();
    } else {
        $(".ran").hide();
    }
}
//功能介绍功能
FunObj.introduction = function(checkType_text) {
    if($(".check_a").hasClass("zhao_a")) { //追号
        $(".zhuihaoCla").show().siblings(".zshao_text").hide();
    } else { //杀号
        $(".sahaoCla").show().siblings(".zshao_text").hide();
    }
    var checkText = "";
    if($(".ran").css("display") != "none") {
        if($(".11check5_ran").css("display") == "block") {
            checkText = $(".11check5_ran>.check_ran").text();
        } else if($(".pk10_ran").css("display") == "block") {
            checkText = $(".pk10_ran>.check_ran").text();
        } else if($(".cqssc_ran").css("display") == "block") {
            checkText = $(".cqssc_ran>.check_ran").text();
        }
    }

    $(".cp_name").text(checkType_text);
    $(".cp_check").text(checkText);
}

$(".ran").on("click", "ul>li", function() {
    FunObj.introduction($(".check").text());
})

$(".11check5_ran").on("click", "li", function() { //购彩计划 pk10 ssc 分析fun 
    checkNum = $(this).attr("data-text");
    FunObj.LiText(); //修改下面li里的字    
    if(FunObj.IsPk10(lot_type)) {
        FunObj.zhuiHao_pk10_analysis(ranData, checkNum, true);
    } else if(FunObj.IsXanwu(lot_type)) {
        FunObj.zhuiHao_cqssc_analysis(ranData, checkNum, true);
    }
})

$(".pk10_ran").on("click", "li", function() { //杀号pk10 分析fun
    var checkli = $(this).attr("data-text");
    FunObj.XaHao_px10_analysis(xaranData, checkli);
});

$(".cqssc_ran").on("click", "li", function() { //杀号 ccs 11选5 分析fun
    var checkli = $(this).attr("data-text");
    FunObj.XaHao_cqssc_analysis(xaranData, checkli);
});
$(".kuai_3_ran").on("click", "li", function(e) {
    e.preventDefault();
    var checkNum = $(this).attr("data-text");
    FunObj.XaHao_kuai_3_analysis(xaranData, checkNum);
});