var path = window.location.href,
    mainM = {},
    tools = {},
    interVal = {};
$(function () {
    mainM.init(path)
}), mainM.init = function (e) {
    if (void 0 != e.split("?")[1]) {
        var t = e.split("?")[1],
            a = e.split("?")[2].split(","),
            n = e.split("?")[3],
            i = e.split("?")[4];
        void 0 != n && ($("body").css({
            "background-color": "#" + n
        }), $("#bgcolor").val(n)), void 0 != a && mainM.slectDropList(t, "czlist", a), void 0 != i && ($(".czlist").text(), $("#sord").val(i), "s" == i ? $(".czlist").show() : $("#czlist").show())
    } else alert("外链代码有误，请重新获取代码！")
}, mainM.slectDropList = function (e, t, a) {
    var n = {
        name: "",
        lotCode: "",
        pageNo: "",
        pageSize: 100
    };
    $.ajax({
        url: config.publicUrl + "lottery/getList.php",
        type: "GET",
        data: n,
        async: !1,
        beforeSend: function () {
            tools.loadingIF(!0)
        },
        success: function (n) {
            mainM.createSelect(e, n, t, a)
        },
        error: function (e) {
            console.log("data error")
        }
    })
}, mainM.createSelect = function (e, t, a, n) {
    "0" == (t = JSON.parse(t)).errorCode ? ($("#" + a).empty(), t = t.result.data, $(t).each(function (e) {
        if (n.length >= 1) {
            for (var t = 0, i = n.length; t < i; t++)
                if (n[0] == this.lotCode && $(".czlist").text(this.name), n[t] == this.lotCode) {
                    l = "<option title='" + this.groupCode + "' value='" + this.lotCode + "'>" + this.name + "</option>";
                    $("#" + a).append(l)
                }
        } else {
            var l = "<option title='" + this.groupCode + "' value='" + this.lotCode + "'>" + this.name + "</option>";
            $("#" + a).append(l)
        }
    }), $("#" + a).val(n[0])) : $("#" + a).append("<optoin>获取数据失败，请刷新重试</option>"), $("#" + a).change(function () {
        tools.jump(this, a)
    }), "46" == e ? mainM.requestData(e, "10046") : mainM.requestData(e, n[0])
}, mainM.requestData = function (e, t) {
    var a = "https" == path.split(":")[0] ? "https" : "http",
        n = "10048" == t ? a + "://127.0.0.1/kj/" : config.publicUrl;
    $.ajax({
        url: n + "" + tools.getUrl(e),
        type: "GET",
        data: {
            lotCode: t
        },
        timeout: 6e4,
        beforeSend: function () {},
        success: function (a) {
            try {
                tools.html(a, "#codeNum", e, t)
            } catch (a) {
                setTimeout(function () {
                    mainM.requestData(e, t), console.log("请求success...")
                }, 1e3)
            }
        },
        error: function (a) {
            setTimeout(function () {
                mainM.requestData(e, t), console.log("请求error...")
            }, 2e3)
        },
        complete: function (a, n) {
            "timeout" == n && setTimeout(function () {
                mainM.requestData(e, t), console.log("请求complete...")
            }, 1e3)
        }
    })
}, tools.getUrl = function (e) {
    switch (1 * e) {
    case 1:
        return "pks/getLotteryPksInfo.php";
    case 2:
        return "CQShiCai/getBaseCQShiCai.php";
    case 3:
    case 4:
        return "klsf/getLotteryInfo.php";
    case 5:
        return "lotteryJSFastThree/getBaseJSFastThree.php";
    case 6:
        return "ElevenFive/getElevenFiveInfo.php";
    case 7:
        return "LuckTwenty/getBaseLuckTewnty.php";
    case 8:
        return "gxklsf/getLotteryInfo.php";
    case 39:
    case 40:
        return "QuanGuoCai/getLotteryInfo.php?";
    case 41:
        return "QuanGuoCai/getLotteryInfo1.php?";
    case 42:
        return "QuanGuoCai/getLotteryInfo.php?";
    case 43:
        return "QuanGuoCai/getLotteryInfo1.php?";
    case 44:
    case 45:
        return "QuanGuoCai/getLotteryInfo.php?";
    case 46:
        return "LuckTwenty/getPcLucky28.php?";
    case 48:
        return "smallSix/findSmallSixInfo.php";
    case 35:
        return "pks/getLotteryPksInfo.php"
    }
}, tools.pageView = function (e) {
    switch (1 * e) {
    case 1:
        return "themes/kj/view/pk10.php";
    case 2:
        return "themes/kj/view/ssc.php";
    case 3:
        return "themes/kj/view/klsf.php";
    case 4:
        return "themes/kj/view/cqnc.php";
    case 5:
        return "themes/kj/view/kuai3.php";
    case 6:
        return "themes/kj/view/shiyxw.php";
    case 7:
        return "themes/kj/view/bjkl8.php";
    case 8:
        return "themes/kj/view/gxklsf.php";
    case 39:
        return "themes/kj/view/fcSSQ.php";
    case 40:
        return "themes/kj/view/cjDLT.php";
    case 41:
        return "themes/kj/view/fc3d.php";
    case 42:
        return "themes/kj/view/fcQLC.php";
    case 43:
        return "themes/kj/view/tcPL3.php";
    case 44:
        return "themes/kj/view/tcPL5.php";
    case 45:
        return "themes/kj/view/tcQXC.php";
    case 46:
        return "themes/kj/view/pcege28.php";
    case 48:
        return "themes/kj/view/xgc.php";
    case 35:
        return "themes/kj/view/pk10.php"
    }
}, tools.checkAnimate = function (e, t, a, n) {
    switch (1 * e) {
    case 1:
        tools.animate.pk10AnimateEnd(e, t, a);
        break;
    case 2:
    case 3:
        tools.animate.sscAnimateEnd(e, t, a);
        break;
    case 4:
        tools.animate.cqncAnimateEnd(e, t, a);
        break;
    case 5:
        tools.animate.kuai3AnimateEnd(e, t, a);
        break;
    case 6:
    case 7:
    case 8:
    case 39:
    case 40:
    case 41:
    case 42:
    case 43:
    case 44:
    case 45:
        tools.animate.sscAnimateEnd(e, t, a);
        break;
    case 46:
        tools.animate.sscAnimateEnd(e, t, a, n);
        break;
    case 48:
        tools.animate.sscAnimateEnd(e, t, a);
        break;
    case 35:
        tools.animate.pk10AnimateEnd(e, t, a)
    }
}, tools.operatorTime = function (e, t) {
    var a = e.replace("-", "/"),
        t = t.replace("-", "/");
    return a = a.replace("-", "/"), t = t.replace("-", "/"), (new Date(a) - new Date(t)) / 1e3
}, tools.jump = function (e, t) {
    var a, n = $("#bgcolor").val(),
        i = $("#sord").val(),
        l = $(e).val(),
        s = l;
    $("#" + t).find("option").each(function (e) {
        $(this).val() == l ? a = $(this).attr("title") : s += "," + $(this).val()
    }), window.location.href = tools.pageView(a) + "?" + a + "?" + s + "?" + n + "?" + i
}, tools.html = function (e, t, a, n) {
    if ("100002" == (e = tools.ifObj(e)).result.businessCode) throw new Error("error");
    if (0 == e.errorCode && 0 == e.result.businessCode) {
        if (e = e.result.data, tools.operatorTime("" == e.drawTime ? "0" : e.drawTime, e.serverTime) <= 0) throw new Error("error");
        var i = e.preDrawCode.split(",");
        $("#preDrawIssue").find("em").text(e.preDrawIssue), $("#drawIssue").find("em").text(e.drawIssue), $(".historyL").attr("href", "javascript:getH(" + n + ")"), $(".hl").attr("onclick", "javascript:getH(" + n + ")"), $(".hl").css("cursor", "pointer"), $("#czlist").click(function () {
            return !1
        }), tools.cutTime(e.drawTime, e.serverTime, t, a, n), tools.checkAnimate(a, i, t, e), tools.loadingIF(!1)
    }
}, tools.loadingIF = function (e) {
    e ? ($(".loading").fadeIn("100"), $(".content").hide()) : ($(".loading").hide(), $(".content").fadeIn("100"))
}, tools.ifObj = function (e) {
    var t = null;
    return "object" != typeof e ? t = JSON.parse(e) : (t = JSON.stringify(e), t = JSON.parse(t)), t
}, tools.excutenum = function () {
    return Math.floor(10 * Math.random())
}, tools.cutTime = function (e, t, a, n, i) {
    var l = e.replace("-", "/"),
        t = t.replace("-", "/");
    l = l.replace("-", "/"), t = t.replace("-", "/");
    var s = (new Date(l) - new Date(t)) / 1e3,
        o = new Date,
        r = setInterval(function () {
            var e = Math.abs(new Date - o) / 1e3;
            if (o = new Date, (e = e.toString().split("."))[0] > 1 && (s -= e[0]), s >= 1) {
                s -= 1;
                var t = Math.floor(s / 3600),
                    a = Math.floor(s / 60 % 60),
                    l = Math.floor(s % 60),
                    c = "";
                c = (c = (t < 10 ? "0" + t : t) + ":") + "" + (a < 10 ? "0" + a : a) + ":" + (l < 10 ? "0" + l : l), $(".ntime").html("<em>" + c + "</em>")
            } else $(".ntime").html("<em>正在开奖...</em>"), clearInterval(r), mainM.requestData(n, i)
        }, 1e3)
}, tools.animate = {
    pk10OpenAnimate: function (e) {
        var t = 600;
        $(e).find("#pk10num li");
        $(e).find(".cuttime").hide(), $(e).find(".opentyle").show(), intervalPk10 = setInterval(function () {
            var a = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                n = [];
            t--;
            for (var i = 0; i < 10; i++) {
                var l = Math.floor(Math.random() * a.length);
                n[i] = a[l], a.splice(l, 1)
            }
            for (var s = "", o = 0; o < 10; o++) {
                var r = n[o] < 10 ? "nub0" + n[o] : "nub" + n[o];
                s += 9 == o ? "<li style='margin-right: 0px;' class='li_after " + r + "'></li>" : "<li class='" + r + "'></li>"
            }
            $(e).find("#pk10num").empty(), $(e).find("#pk10num").append(s)
        }, 100), animateID[e] = intervalPk10
    },
    pk10AnimateEnd: function (e, t, a) {
        var n = 0,
            i = t.length;
        $(a).empty();
        var l = setInterval(function () {
            var e = "";
            if (n < i) {
                n == i - 1 && (e = "li_after");
                var s = "<li class='numsm" + t[n] + " " + e + "'><i style='font-size:10px; display:none'>" + t[n] + "</i></li>";
                $(a).append(s), n += 1
            } else clearInterval(l)
        }, 100)
    },
    sscAnimate: function (e) {
        var t = 600;
        $(e).find(".opentyle").show(), $(e).find(".cuttime").hide(), intervalSsc = setInterval(function () {
            var a = $(e).find(".sscli li");
            $(e).find(".sscli li:last-child").css({
                "margin-right": "0"
            });
            var n = a.length;
            t--;
            for (var i = 0; i < n; i++) {
                $(e).find("li").eq(i).css({
                    paddingTop: "0"
                }), $(e).find("li").eq(i).css({
                    lineHeight: "0"
                }), $(e).find("li").eq(i).text(tools.excutenum());
                var l = 50 * tools.excutenum();
                $(e).find("li").eq(i).stop().animate({
                    paddingTop: "0.15rem"
                }, l), $(e).find("li").eq(i).stop().animate({
                    lineHeight: "0.45rem"
                }, 100)
            }
        }, 100), animateID[e] = intervalSsc, config.ifdebug && console.log("动画ID" + JSON.stringify(animateID[e]))
    },
    sscAnimateEnd: function (e, t, a, n) {
        var i = 0;
        if ("46" == e) var l = n.sumNum + "",
            s = t.push(l);
        else s = t.length;
        $(a).empty();
        var o = setInterval(function () {
            if (i < s) {
                i == s - 1 && "li_after", tools.createCodeBg(e, i, s, t, n);
                var l = tools.createCodeBg(e, i, s, t);
                $(a).append(l), i += 1
            } else clearInterval(o)
        }, 100)
    },
    kuai3Animate: function (e) {
        var t = 600;
        $(e).find(".opentyle").show(), $(e).find(".cuttime").hide(), intervalSsc = setInterval(function () {
            t--;
            for (var a = 0, n = $(e).find(".numul li").length; a < n; a++) {
                var i = tools.excutenum1_6();
                $(e).find(".numul li").eq(a).className = "num" + 1 * i + 1;
                var l = 1 * i,
                    s = tools.kuaicase(1 * tools.excutenum1_6() + 1);
                $(e).find(".numul li").eq(a).stop().animate({
                    backgroundPositionY: s
                }, l)
            }
            0 == t && (clearInterval(animateID[e]), method.indexLoad(e))
        }, 100), animateID[e] = intervalSsc
    },
    kuai3AnimateEnd: function (e, t, a) {
        var n = 0,
            i = t.length;
        $(a).empty();
        var l = setInterval(function () {
            var e = "";
            if (n < i) {
                n == i - 1 && (e = "li_after");
                var s = "<li class='num" + t[n] + " " + e + "'><i style='font-size:10px; display:none'>" + t[n] + "</i></li>";
                $(a).append(s), n += 1
            } else clearInterval(l)
        }, 100)
    },
    cqncAnimate: function (e) {
        var t = 600,
            a = $(e).find(".cqnclilist");
        $(".opening").show(), $(".clock").hide(), intervalSsc = setInterval(function () {
            var e = [1, 2, 3, 4, 5, 6, 7, 8],
                n = [];
            t--;
            for (var i = 0; i < 10; i++) {
                var l = Math.floor(Math.random() * e.length);
                n[i] = e[l], e.splice(l, 1)
            }
            for (var s = "", o = 0; o < 10; o++) s += "<li class='ncnum0" + n[o] + "'></li>";
            $(a).empty(), $(a).append(s), 100 == t && $("#waringbox").show(300)
        }, 100), animateID[e] = intervalSsc
    },
    cqncAnimateEnd: function (e, t, a) {
        var n = 0,
            i = t.length;
        $(a).empty();
        var l = setInterval(function () {
            var e = "";
            if (n < i) {
                n == i - 1 && (e = "li_after");
                var s = "<li class='ncnum" + t[n] + " " + e + "'><i style='font-size:10px; display:none'>" + t[n] + "</i></li>";
                $(a).append(s), n += 1
            } else clearInterval(l)
        }, 100)
    }
}, tools.createCodeBg = function (e, t, a, n, i) {
    if ("3" == e)
        if (n[t] >= 19) l = "<li class = 'numredHead'>" + n[t] + "</li>";
        else l = "<li class = 'numblueHead'>" + n[t] + "</li>";
    else if ("7" == e)
        if (t == a - 1) l = "<li style = 'color:#f9982e;font-size:14px;width:auto'>" + n[t] + "</li>";
        else l = "<li style = 'color:#000;font-size:14px;width:auto'>" + n[t] + ",</li>";
    else if ("8" == e) {
        if (1 == n[t] || 4 == n[t] || 7 == n[t] || 10 == n[t] || 13 == n[t] || 16 == n[t] || 19 == n[t]) l = "<li class='numredHead'>" + n[t] + "</li>";
        else if (2 == n[t] || 5 == n[t] || 8 == n[t] || 11 == n[t] || 14 == n[t] || 17 == n[t] || 20 == n[t]) l = "<li class='numblueHead'>" + n[t] + "</li>";
        else if (3 == n[t] || 6 == n[t] || 9 == n[t] || 12 == n[t] || 15 == n[t] || 18 == n[t] || 21 == n[t]) l = "<li class='numgreenHead'>" + n[t] + "</li>"
    } else if ("39" == e || "42" == e)
        if (t == a - 1) l = "<li class = 'numblueHead'>" + n[t] + "</li>";
        else l = "<li class = 'numredHead'>" + n[t] + "</li>";
    else if ("40" == e)
        if (t >= a - 2) l = "<li class = 'numblueHead'>" + n[t] + "</li>";
        else l = "<li class = 'numredHead'>" + n[t] + "</li>";
    else if ("41" == e || "43" == e || "44" == e) l = "<li class = 'numredHead'>" + n[t] + "</li>";
    else if ("45" == e)
        if (t >= a - 3) l = "<li class = 'numlightHead'>" + n[t] + "</li>";
        else l = "<li class = 'numheightHead'>" + n[t] + "</li>";
    else if ("46" == e)
        if (t == a - 1) l = "<li class = 'numredHead'>" + n[t] + "</li>";
        else l = "<li class = 'pcnumblueHead'>" + n[t] + "</li>";
    else if ("48" == e) {
        if (1 == n[t] || 2 == n[t] || 7 == n[t] || 8 == n[t] || 12 == n[t] || 13 == n[t] || 18 == n[t] || 19 == n[t] || 23 == n[t] || 24 == n[t] || 29 == n[t] || 30 == n[t] || 34 == n[t] || 35 == n[t] || 40 == n[t] || 45 == n[t] || 46 == n[t])
            if (t == a - 1) l = "<li class='xgcaddF1'></li><li class='numredHead'>" + n[t] + "</li>";
            else l = "<li class='numredHead'>" + n[t] + "</li>";
        else if (3 == n[t] || 4 == n[t] || 9 == n[t] || 10 == n[t] || 14 == n[t] || 15 == n[t] || 20 == n[t] || 25 == n[t] || 26 == n[t] || 31 == n[t] || 36 == n[t] || 37 == n[t] || 41 == n[t] || 42 == n[t] || 47 == n[t] || 48 == n[t])
            if (t == a - 1) l = "<li class='xgcaddF1'></li><li class='numblueHead'>" + n[t] + "</li>";
            else l = "<li class='numblueHead'>" + n[t] + "</li>";
        else if (5 == n[t] || 6 == n[t] || 11 == n[t] || 16 == n[t] || 17 == n[t] || 21 == n[t] || 22 == n[t] || 27 == n[t] || 28 == n[t] || 32 == n[t] || 33 == n[t] || 38 == n[t] || 39 == n[t] || 43 == n[t] || 44 == n[t] || 49 == n[t])
            if (t == a - 1) l = "<li class='xgcaddF1'></li><li class='numgreenHead'>" + n[t] + "</li>";
            else l = "<li class='numgreenHead'>" + n[t] + "</li>"
    } else var l = "<li class='numblueHead'>" + n[t] + "</li>";
    return l
};