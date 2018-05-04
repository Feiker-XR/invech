var path = window.location.href,
    mainM = {},
    tools = {},
    pubData = {},
    toolss = {};
interVal = {}, $(function () {
    $("#czname").on("mousemove", "li", function () {
        $(this).addClass("checked").siblings().removeAttr("class");
        var t = $(this).attr("title");
        $(".tab_" + t).show().siblings().hide()
    }), mainM.slectDropList(), mainM.init()
}), mainM.init = function () {
    if (void 0 != path.split("?")[1]) {
        var t = path.split("?")[1].split(","),
            e = path.split("?")[2];
        e = e = e;
        for (var s = 0, a = t.length; s < a; s++) $("#cz_" + t[s]).show();
        var n = function (t, e) {
            void 0 != $(t).attr("style") && $("#czname").find("#t" + e).css("display", "inline-block")
        };
        $(".tab_1 tbody").find("tr").each(function (t) {
            n(this, 1)
        }), $(".tab_2 tbody").find("tr").each(function (t) {
            n(this, 2)
        }), $(".tab_3 tbody").find("tr").each(function (t) {
            n(this, 3)
        }), $(".tab_4 tbody").find("tr").each(function (t) {
            n(this, 4)
        }), $("#czname").find("#t" + e).addClass("checked").siblings().removeClass(), $("#tablebox").find(".tab_" + e).show().siblings().hide(), $(".refBtn").click(function () {
            window.location.reload()
        })
    } else alert("外链代码有误，请重新获取代码！")
}, mainM.slectDropList = function (t, e, s) {
    var a = {
        name: "",
        lotCode: "",
        pageNo: "",
        pageSize: 100
    };
    $.ajax({
        url: config.publicUrl + "lottery/getLotteryListByCategory.php?category=1&isContainsHot=0&isUse=1",
        type: "GET",
        data: a,
        async: !1,
        beforeSend: function () {
            tools.loadingIF(!0)
        },
        success: function (a) {
            mainM.createSelect(t, a, e, s), tools.loadingIF(!1)
        },
        error: function (t) {
            console.log("data error")
        }
    })
}, mainM.createSelect = function (t, e, s, a) {
    "0" == (e = JSON.parse(e)).errorCode ? (e = e.result.data, $(e).each(function (t) {
        var e = "#cz_" + this.lotCode;
        if ($(e).find(".lotName").text(this.lotName), $(e).find(".preDrawIssue").text(this.preDrawIssue), $(e).find(".preDrawTime").text(this.preDrawTime), $(e).find(".frequency").text(this.frequency), $(e).find("ul").attr("onclick", "getK(" + this.lotCode + ")"), $(e).find("ul").css({
                cursor: "pointer"
            }), "1" == this.groupCode || "35" == this.groupCode) animateMethod.pk10end(this.preDrawCode.split(","), e);
        else if ("5" == this.groupCode) animateMethod.kuai3AnimateEnd(this.preDrawCode, e);
        else if ("4" == this.groupCode) animateMethod.cqncAnimateEnd(this.preDrawCode, e);
        else if ("2" == this.groupCode) animateMethod.sscAnimateEnd(this.preDrawCode, e);
        else if ("6" == this.groupCode) animateMethod.sscAnimateEnd(this.preDrawCode, e);
        else if ("3" == this.groupCode) animateMethod.sscAnimateEnd(this.preDrawCode, e), toolss.changeBackground(e);
        else if ("8" == this.groupCode) {
            s = this.preDrawCode.split(",");
            animateMethod.sscAnimateEnd(this.preDrawCode, e), toolss.changeBackgroundGxklsf(s, e)
        } else if ("46" == this.groupCode) {
            var s = this.preDrawCode.split(","),
                a = $(e).find(".numberbox").children();
            $(a).eq(0).text(s[0]), $(a).eq(2).text(s[1]), $(a).eq(4).text(s[2]), $(a).eq(6).text(this.sumNum)
        } else "7" == this.groupCode ? animateMethod.sscAnimateEnd(this.preDrawCode, e) : (animateMethod.sscAnimateEnd(this.preDrawCode, e), toolss.resetRed(e, this.lotCode))
    })) : $("#tablebox").append("<optoin>获取数据失败，请刷新重试</option>")
}, mainM.requestData = function (t, e, s) {
    $.ajax({
        url: config.publicUrl + "" + tools.getUrl(t),
        type: "GET",
        data: {
            lotCode: e,
            date: s
        },
        timeout: 6e4,
        beforeSend: function () {},
        success: function (a) {
            try {
                tools.html(a, "#codeNum", t, e)
            } catch (a) {
                setTimeout(function () {
                    mainM.requestData(t, e, s)
                }, 1e3)
            }
        },
        error: function (a) {
            setTimeout(function () {
                mainM.requestData(t, e, s)
            }, 1e3)
        },
        complete: function (a, n) {
            "timeout" == n && setTimeout(function () {
                mainM.requestData(t, e, s)
            }, 1e3)
        }
    })
}, tools.formatDate = function (t) {
    var e = t.getFullYear(),
        s = t.getMonth() + 1;
    s = s < 10 ? "0" + s : s;
    var a = t.getDate();
    return a = a < 10 ? "0" + a : a, e + "-" + s + "-" + a
}, tools.getUrl = function (t) {
    switch (1 * t) {
    case 1:
        return "pks/getPksHistoryList.php";
    case 2:
        return "CQShiCai/getBaseCQShiCaiList.php";
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
        return "gxklsf/getLotteryInfo.php"
    }
}, tools.pageView = function (t) {
    switch (1 * t) {
    case 1:
        return "pk10_list.php";
    case 2:
        return "ssc_list.php";
    case 3:
    case 4:
    case 5:
    case 6:
    case 7:
    case 8:
        return "ssc.php"
    }
}, tools.createH = function (t, e, s, a) {
    switch (1 * s) {
    case 1:
        tools.cH.pk10(t);
        break;
    case 2:
        tools.cH.ssc(t);
        break;
    case 3:
    case 4:
    case 5:
    case 6:
    case 7:
    case 8:
        return "ssc.php"
    }
}, tools.operatorTime = function (t, e) {
    var s = t.replace("-", "/"),
        e = e.replace("-", "/");
    return s = s.replace("-", "/"), e = e.replace("-", "/"), (new Date(s) - new Date(e)) / 1e3
}, tools.jump = function (t, e) {
    var s, a = $("#sord").val(),
        n = $(t).val(),
        i = n;
    $("#" + e).find("option").each(function (t) {
        $(this).val() == n ? s = $(this).attr("title") : i += "," + $(this).val()
    }), window.location.href = tools.pageView(s) + "?" + s + "?" + i + "?" + a
}, tools.html = function (t, e, s, a) {
    if ("100002" == (t = tools.ifObj(t)).result.businessCode) throw new Error("error");
    0 == t.errorCode && 0 == t.result.businessCode && (t = t.result.data, tools.createH(t, e, s, a), tools.loadingIF(!1))
}, tools.loadingIF = function (t) {
    t ? ($(".loading").fadeIn("100"), $(".content").hide()) : ($(".loading").hide(), $(".content").fadeIn("100"))
}, tools.ifObj = function (t) {
    var e = null;
    return "object" != typeof t ? e = JSON.parse(t) : (e = JSON.stringify(t), e = JSON.parse(e)), e
}, tools.getDate = function (t) {
    var e = new Date;
    return e.setDate(e.getDate() + t), e.getFullYear() + "-" + (e.getMonth() + 1) + "-" + e.getDate()
}, tools.cH = {
    pk10: function (t) {
        $("#jrsmhmtj>table").html('<tr><th>时间</th><th>期数</th><th id="numberbtn" class="numberbtn"><span id="xshm" class="spanselect">号码</span></th><th colspan="3">冠亚和</th><th colspan="5">1-5龙虎</th></tr>');
        for (var e = 0, s = t.length; e < s; e++) {
            drawCode = t[e].preDrawCode.split(",");
            for (var a = "", n = 0, i = drawCode.length; n < i; n++) {
                var o = "";
                n == i - 1 && (o = "li_after"), a += "<li class='numsm" + drawCode[n] + " " + o + "'><i>" + drawCode[n] + "</i></li>"
            }
            var r = "style='color:";
            if (!(drawCode.length <= 1)) var d = "0" == t[e].sumBigSamll ? "大" : "小",
                l = "大" == d ? r + "#f12d35'" : "'",
                c = "0" == t[e].sumSingleDouble ? "单" : "双",
                u = "双" == c ? r + "#f12d35'" : "'",
                h = "0" == t[e].firstDT ? "龙" : "虎",
                f = "龙" == h ? r + "#f12d35'" : "'",
                m = "0" == t[e].secondDT ? "龙" : "虎",
                p = "龙" == m ? r + "#f12d35'" : "'",
                g = "0" == t[e].thirdDT ? "龙" : "虎",
                b = "龙" == g ? r + "#f12d35'" : "'",
                C = "0" == t[e].fourthDT ? "龙" : "虎",
                w = "龙" == C ? r + "#f12d35'" : "'",
                D = "0" == t[e].fifthDT ? "龙" : "虎",
                v = "龙" == D ? r + "#f12d35'" : "'";
            var y = "<td " + l + ">" + d + "</td><td " + u + ">" + c + "</td><td " + f + ">" + h + "</td><td " + p + ">" + m + "</td><td " + b + ">" + g + "</td><td " + w + ">" + C + "</td><td " + v + ">" + D + "</td>",
                x = "<tr>" + ("<td>" + t[e].preDrawTime + "</td><td>" + t[e].preDrawIssue + "</td><td><ul class='imgnumber'>" + a + "</ul></td><td>" + t[e].sumFS + "</td>" + y) + "</tr>";
            $("#jrsmhmtj>table").append(x)
        }
        $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    ssc: function (t) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width="150">时间</th><th width="130">期数</th><th id="numberbtn" class="numberbtn"><span id="xshm" class="spanselect">号码</span></th><th colspan="3">总和</th><th colspan="5">1-5龙虎</th></tr>'), $(t).each(function (t) {
            var e = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                s = "",
                a = this.preDrawCode.split(",");
            if ($(a).each(function () {
                    s += "<li class='sscnumblue' style='color:#012537'><i>" + this + "</i></li>"
                }), a.length <= 1) n = "<td class='blueqiu'></td>";
            else var n = "<td class='blueqiu'><ul style='width:240px'>" + s + "</ul></td>",
                i = "0" == this.sumSingleDouble ? "单" : "双",
                o = "双" == i ? "style='color:#f12d35'" : "'",
                r = "0" == this.sumBigSmall ? "大" : "小",
                d = "大" == r ? "style='color:#f12d35'" : "'",
                l = tools.typeOf("lhh", this.dragonTiger),
                c = "龙" == l ? "style='color:#f12d35'" : "'";
            var u = "<tr>" + e + n + ("<td>" + this.sumNum + "</td><td " + o + ">" + i + "</td><td " + d + ">" + r + "</td><td " + c + ">" + l + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(u)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    }
}, tools.typeOf = function (t, e) {
    if ("rank" == t) switch (1 * e) {
    case 1:
        return "冠军";
    case 2:
        return "亚军";
    case 3:
        return "第三名";
    case 4:
        return "第四名";
    case 5:
        return "第五名";
    case 6:
        return "第六名";
    case 7:
        return "第七名";
    case 8:
        return "第八名";
    case 9:
        return "第九名";
    case 10:
        return "第十名";
    case 11:
        return "冠亚和"
    } else if ("state" == t) switch (1 * e) {
    case 1:
        return "单双";
    case 2:
        return "大小";
    case 3:
        return "龙虎"
    } else if ("san" == t) switch (1 * e) {
    case 0:
        return "杂六";
    case 1:
        return "半顺";
    case 2:
        return "顺子";
    case 3:
        return "对子";
    case 4:
        return "豹子"
    } else if ("lhh" == t) switch (1 * e) {
    case 0:
        return "龙";
    case 1:
        return "虎";
    case 2:
        return "和"
    }
}, toolss.changeBackground = function (t) {
    $(t).find(".numblueHead").each(function () {
        $(this).text() >= 19 && $(this).addClass("numredHead")
    })
}, toolss.changeBackgroundGxklsf = function (t, e) {
    $(e).find(".numberbox").find("li").removeClass();
    for (var s = 0; s < t.length; s++) 1 == t[s] || 4 == t[s] || 7 == t[s] || 10 == t[s] || 13 == t[s] || 16 == t[s] || 19 == t[s] ? $(e).find(".numberbox").find("li").eq(s).addClass("numredHead") : 3 == t[s] || 6 == t[s] || 9 == t[s] || 12 == t[s] || 15 == t[s] || 18 == t[s] || 21 == t[s] ? $(e).find(".numberbox").find("li").eq(s).addClass("numgreenHead") : $(e).find(".numberbox").find("li").eq(s).addClass("numblueHead")
}, toolss.changeBackgroundEgxy = function (t) {
    $(t).find(".numberbox").find("li:last-child").addClass("numredHead")
}, toolss.changeBackgroundBjkl8 = function (t) {
    $(t).find(".numlightHead").each(function () {
        $(this).text() >= 41 ? $(this).addClass("numblueHead") : $(this).addClass("numlightHead")
    }), $(t).find(".numberbox").find("li:last-child").addClass("numorangeHead")
}, toolss.resetRed = function (t, e) {
    var s = $(t).find(".numberbox li"),
        a = s.length;
    $(s).each(function (t) {
        "10039" == e || "10042" == e ? t != a - 1 ? $(this).addClass("numredHead") : $(this).removeClass("numredHead") : "10040" == e ? t == a - 1 || t == a - 2 ? $(this).removeClass("numredHead") : $(this).addClass("numredHead") : "10041" == e || "10043" == e ? $(this).addClass("numredHead") : "10044" == e && $(this).addClass("numredHead")
    })
};