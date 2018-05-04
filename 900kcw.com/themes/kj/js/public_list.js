var path = window.location.href,
    mainM = {},
    tools = {},
    pubData = {},
    interVal = {};
$(function () {
    mainM.init(path), $("#datebox").calendar({
        trigger: ".date",
        zIndex: 999,
        format: "yyyy-mm-dd",
        onSelected: function (t, e, s) {
            var e = tools.formatDate(e),
                i = $("#czlist").val();
            mainM.requestData(pubData.g, i, e)
        },
        onClose: function (t, e, s) {
            config.ifdebug && console.log("关闭是触发")
        }
    })
}), mainM.init = function (t) {
    if (void 0 != t.split("?")[1]) {
        $(".date").val(tools.getDate(0)), $(".czlist").show();
        var e = t.split("?")[1],
            s = t.split("?")[2].split(","),
            i = t.split("?")[3];
        void 0 != s && mainM.slectDropList(e, "czlist", s), void 0 != e && (pubData.g = e), void 0 != i && ($("#sord").val(i), "d" == i ? $("#czlist,.selectbtn").show() : $("#czlist,.selectbtn").hide())
    } else alert("外链代码有误，请重新获取代码！")
}, mainM.slectDropList = function (t, e, s) {
    var i = {
        name: "",
        lotCode: "",
        pageNo: "",
        pageSize: 100
    };
    $.ajax({
        url: config.publicUrl + "lottery/getList.php",
        type: "GET",
        data: i,
        async: !1,
        beforeSend: function () {
            tools.loadingIF(!0)
        },
        success: function (i) {
            mainM.createSelect(t, i, e, s)
        },
        error: function (t) {
            console.log("data error")
        }
    })
}, mainM.createSelect = function (t, e, s, i) {
    "0" == (e = JSON.parse(e)).errorCode ? ($("#" + s).empty(), e = e.result.data, $(e).each(function (t) {
        if (i.length >= 1) {
            for (var e = 0, r = i.length; e < r; e++)
                if (i[0] == this.lotCode && $(".czlist").text(this.name), i[e] == this.lotCode) {
                    l = "<option title='" + this.groupCode + "' value='" + this.lotCode + "'>" + this.name + "</option>";
                    $("#" + s).append(l)
                }
        } else {
            var l = "<option title='" + this.groupCode + "' value='" + this.lotCode + "'>" + this.name + "</option>";
            $("#" + s).append(l)
        }
    }), $("#" + s).val(i[0])) : $("#" + s).append("<optoin>获取数据失败，请刷新重试</option>"), $("#" + s).change(function () {
        tools.jump(this, s)
    }), "46" == t ? mainM.requestData(t, "10046") : mainM.requestData(t, i[0])
}, mainM.requestData = function (t, e, s) {
    var i = "",
        r = {
            type: 1,
            year: i = void 0 == s ? 2017 : s.split("-")[0]
        },
        l = {
            lotCode: e,
            date: s
        },
        a = "https" == window.location.href.split(":")[0] ? "https" : "http",
        n = "10048" == e ? a + "://127.0.0.1/kj/" : config.publicUrl,
        h = "10048" == e ? r : l;
    $.ajax({
        url: n + "" + tools.getUrl(t),
        type: "GET",
        data: h,
        timeout: 6e4,
        beforeSend: function () {},
        success: function (i) {
            try {
                tools.html(i, "#codeNum", t, e)
            } catch (i) {
                setTimeout(function () {
                    mainM.requestData(t, e, s)
                }, 1e3)
            }
        },
        error: function (i) {
            setTimeout(function () {
                mainM.requestData(t, e, s)
            }, 1e3)
        },
        complete: function (i, r) {
            "timeout" == r && setTimeout(function () {
                mainM.requestData(t, e, s)
            }, 1e3)
        }
    })
}, tools.formatDate = function (t) {
    var e = t.getFullYear(),
        s = t.getMonth() + 1;
    s = s < 10 ? "0" + s : s;
    var i = t.getDate();
    return i = i < 10 ? "0" + i : i, e + "-" + s + "-" + i
}, tools.getUrl = function (t) {
    switch (1 * t) {
    case 1:
        return "pks/getPksHistoryList.php";
    case 2:
        return "CQShiCai/getBaseCQShiCaiList.php";
    case 3:
    case 4:
        return "klsf/getHistoryLotteryInfo.php?";
    case 5:
        return "lotteryJSFastThree/getJSFastThreeList.php?";
    case 6:
        return "ElevenFive/getElevenFiveList.php?";
    case 7:
        return "LuckTwenty/getBaseLuckTwentyList.php?";
    case 8:
        return "gxklsf/getHistoryLotteryInfo.php?";
    case 39:
    case 40:
        return "QuanGuoCai/getHistoryLotteryInfo.php?";
    case 41:
        return "QuanGuoCai/getLotteryInfoList.php?";
    case 42:
        return "QuanGuoCai/getHistoryLotteryInfo.php?";
    case 43:
        return "QuanGuoCai/getLotteryInfoList.php?";
    case 44:
    case 45:
        return "QuanGuoCai/getHistoryLotteryInfo.php?";
    case 46:
        return "LuckTwenty/getPcLucky28List.php?";
    case 48:
        return "smallSix/findSmallSixHistory.php";
    case 35:
        return "pks/getPksHistoryList.php"
    }
}, tools.pageView = function (t) {
    switch (1 * t) {
    case 1:
        return "themes/kj/view/pk10_list.php";
    case 2:
        return "themes/kj/view/ssc_list.php";
    case 3:
        return "themes/kj/view/klsf_list.php";
    case 4:
        return "themes/kj/view/cqnc_list.php";
    case 5:
        return "themes/kj/view/kuai3_list.php";
    case 6:
        return "themes/kj/view/shiyxw_list.php";
    case 7:
        return "themes/kj/view/bjkl8_list.php";
    case 8:
        return "themes/kj/view/gxklsf_list.php";
    case 39:
        return "themes/kj/view/fcSSQ_list.php";
    case 40:
        return "themes/kj/view/cjDLT_list.php";
    case 41:
        return "themes/kj/view/fc3d_list.php";
    case 42:
        return "themes/kj/view/fcQLC_list.php";
    case 43:
        return "themes/kj/view/tcPL3_list.php";
    case 44:
        return "themes/kj/view/tcPL5_list.php";
    case 45:
        return "themes/kj/view/tcQXC_list.php";
    case 46:
        return "themes/kj/view/pcege28_list.php";
    case 48:
        return "themes/kj/view/xgc_list.php";
    case 35:
        return "themes/kj/view/pk10_list.php"
    }
}, tools.createH = function (t, e, s, i) {
    switch (1 * s) {
    case 1:
        tools.cH.pk10(t, i);
        break;
    case 2:
        tools.cH.ssc(t, i);
        break;
    case 3:
        tools.cH.klsf(t, i);
        break;
    case 4:
        tools.cH.cqnc(t, i);
        break;
    case 5:
        tools.cH.kuai3(t, i);
        break;
    case 6:
        tools.cH.shiyxw(t, i);
        break;
    case 7:
        tools.cH.bjkl8(t, i);
        break;
    case 8:
        tools.cH.gxklsf(t, i);
        break;
    case 39:
        tools.cH.fcSSQ(t, i);
        break;
    case 40:
        tools.cH.cjDLT(t, i);
        break;
    case 41:
        tools.cH.fc3d(t, i);
        break;
    case 42:
        tools.cH.fcSSQ(t, i);
        break;
    case 43:
        tools.cH.fc3d(t, i);
        break;
    case 44:
        tools.cH.tcPL5(t, i);
        break;
    case 45:
        tools.cH.tcQXC(t, i);
        break;
    case 46:
        tools.cH.pcege28(t, i);
        break;
    case 48:
        tools.cH.xgc(t, i);
        break;
    case 35:
        tools.cH.pk10(t, i)
    }
}, tools.operatorTime = function (t, e) {
    var s = t.replace("-", "/"),
        e = e.replace("-", "/");
    return s = s.replace("-", "/"), e = e.replace("-", "/"), (new Date(s) - new Date(e)) / 1e3
}, tools.jump = function (t, e) {
    var s, i = $("#sord").val(),
        r = $(t).val(),
        l = r;
    $("#" + e).find("option").each(function (t) {
        $(this).val() == r ? s = $(this).attr("title") : l += "," + $(this).val()
    }), window.location.href = tools.pageView(s) + "?" + s + "?" + l + "?" + i
}, tools.html = function (t, e, s, i) {
    if ("100002" == (t = tools.ifObj(t)).result.businessCode) throw new Error("error");
    0 == t.errorCode && 0 == t.result.businessCode && (t = t.result.data, tools.createH(t, e, s, i), tools.loadingIF(!1))
}, tools.loadingIF = function (t) {
    t ? ($(".loading").fadeIn("100"), $(".content").hide()) : ($(".loading").hide(), $(".content").fadeIn("100"))
}, tools.ifObj = function (t) {
    var e = null;
    return "object" != typeof t ? e = JSON.parse(t) : (e = JSON.stringify(t), e = JSON.parse(e)), e
}, tools.getDate = function (t) {
    var e = new Date;
    return e.setDate(e.getDate() + t), e.getFullYear() + "-" + (e.getMonth() + 1) + "-" + e.getDate()
}, tools.cH = {
    pk10: function (t, e) {
        $("#jrsmhmtj>table").html('<tr><th>时间</th><th>期数</th><th id="numberbtn" class="numberbtn"><span id="xshm" class="spanselect">号码</span></th><th colspan="3">冠亚和</th><th colspan="5">1-5龙虎</th></tr>');
        for (var s = 0, i = t.length; s < i; s++) {
            drawCode = t[s].preDrawCode.split(",");
            for (var r = "", l = 0, a = drawCode.length; l < a; l++) {
                var n = "";
                l == a - 1 && (n = "li_after"), r += "<li class='numsm" + drawCode[l] + " " + n + "'><i>" + drawCode[l] + "</i></li>"
            }
            var h = "style='color:";
            if (!(drawCode.length <= 1)) var d = "0" == t[s].sumBigSamll ? "大" : "小",
                o = "大" == d ? h + "#f12d35'" : "'",
                c = "0" == t[s].sumSingleDouble ? "单" : "双",
                u = "双" == c ? h + "#f12d35'" : "'",
                f = "0" == t[s].firstDT ? "龙" : "虎",
                m = "龙" == f ? h + "#f12d35'" : "'",
                p = "0" == t[s].secondDT ? "龙" : "虎",
                b = "龙" == p ? h + "#f12d35'" : "'",
                g = "0" == t[s].thirdDT ? "龙" : "虎",
                w = "龙" == g ? h + "#f12d35'" : "'",
                y = "0" == t[s].fourthDT ? "龙" : "虎",
                D = "龙" == y ? h + "#f12d35'" : "'",
                x = "0" == t[s].fifthDT ? "龙" : "虎",
                v = "龙" == x ? h + "#f12d35'" : "'";
            var j = "<td " + o + ">" + d + "</td><td " + u + ">" + c + "</td><td " + m + ">" + f + "</td><td " + b + ">" + p + "</td><td " + w + ">" + g + "</td><td " + D + ">" + y + "</td><td " + v + ">" + x + "</td>",
                k = "<tr>" + ("<td>" + t[s].preDrawTime + "</td><td>" + t[s].preDrawIssue + "</td><td><ul onclick='getH(" + e + ")' style='cursor:pointer'  class='imgnumber'>" + r + "</ul></td><td>" + t[s].sumFS + "</td>" + j) + "</tr>";
            $("#jrsmhmtj>table").append(k)
        }
        $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    ssc: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width="150">时间</th><th width="130">期数</th><th id="numberbtn" class="numberbtn"><span id="xshm" class="spanselect">号码</span></th><th colspan="3">总和</th><th colspan="5">1-5龙虎</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "",
                r = this.preDrawCode.split(",");
            if ($(r).each(function () {
                    i += "<li class='sscnumblue' style='color:#012537'><i>" + this + "</i></li>"
                }), r.length <= 1) l = "<td class='blueqiu'></td>";
            else var l = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='width:240px;cursor:pointer'>" + i + "</ul></td>",
                a = "0" == this.sumSingleDouble ? "单" : "双",
                n = "双" == a ? "style='color:#f12d35'" : "'",
                h = "0" == this.sumBigSmall ? "大" : "小",
                d = "大" == h ? "style='color:#f12d35'" : "'",
                o = tools.typeOf("lhh", this.dragonTiger),
                c = "龙" == o ? "style='color:#f12d35'" : "'";
            var u = "<tr>" + s + l + ("<td>" + this.sumNum + "</td><td " + n + ">" + a + "</td><td " + d + ">" + h + "</td><td " + c + ">" + o + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(u)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    bjkl8: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th>时间</th><th>期数</th><th id="numberbtn" class="numberbtn"><span id="kjhm">开奖号码</span></th><th colspan="3">总和</th><th>单双</th><th>前后</th><th>总和组合</th><th>五行</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td width=100>" + this.preDrawIssue + "</td>",
                i = "",
                r = this.preDrawCode.split(",");
            $(r).each(function (t) {
                t != r.length - 1 ? i += 9 == t ? this > 40 ? "<li class='numWeightblueKong tabLine' style='color:#012537'><i>" + this + "</i></li>" : "<li class='numLightblueKong tabLine' style='color:#0b84ad'><i>" + this + "</i></li>" : this > 40 ? "<li class='numWeightblueKong' style='color:#012537'><i>" + this + "</i></li>" : "<li class='numLightblueKong' style='color:#0b84ad'><i>" + this + "</i></li>" : i += "<li class='numOrangeKong' style='color:#f9982e'><i>" + this + "</i></li>"
            });
            var l = "style='color:",
                a = "<td>" + this.sumNum + "</td>";
            if (r.length <= 1) n = "<td class='blueqiu'></td>";
            else {
                var n = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='max-width:480px;cursor:pointer'>" + i + "</ul></td>",
                    h = tools.typeOf("dxh", this.sumBigSmall),
                    d = "大" == h ? l + "#f12d35'" : "'",
                    o = tools.typeOf("dsh", this.sumSingleDouble),
                    c = "双" == o ? l + "#f13d35'" : "'",
                    u = tools.typeOf("dsd", this.singleDoubleCount);
                if ("双多" == u) f = l + "#f12d35'";
                else if ("单双和" == u) f = l + "#2EADDC'";
                else var f = l + "'";
                var m = tools.typeOf("qhh", this.frontBehindCount);
                if ("后多" == m) p = l + "#f12d35'";
                else if ("前后和" == m) p = l + "#2EADDC'";
                else p = l + "'";
                var p = "后多" == m ? l + "#f12d35'" : "'",
                    b = tools.typeOf("zhzh", this.sumBsSd),
                    g = l + "'",
                    w = tools.typeOf("wuxing", this.sumWuXing),
                    y = l + "'"
            }
            var D = "<tr>" + s + n + a + ("<td " + d + ">" + h + "</td><td " + c + ">" + o + "</td><td " + f + ">" + u + "</td><td " + p + ">" + m + "</td><td " + g + ">" + b + "</td><td " + y + ">" + w + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(D)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    klsf: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width=150>时间</th><th width=80>期数</th><th id="numberbtn" class="numberbtn" width=386><span id="xshm" class="spanselect">显示号码</span></th><th colspan="3">总和</th><th>尾大小</th><th colspan="4">龙虎</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "",
                r = this.preDrawCode.split(",");
            $(r).each(function () {
                i += this >= 19 ? "<li class='numredkong' style='color:#012537'><i>" + this + "</i></li>" : "<li class='numblue' style='color:#012537'><i>" + this + "</i></li>"
            });
            var l = "style='color:",
                a = "<td>" + this.sumNum + "</td>";
            if (r.length <= 1) n = "<td class='blueqiu'></td>";
            else var n = "<td class='blueqiu'><ul onclick='getH(" + e + ")' class='klsful' style='cursor:pointer'>" + i + "</ul></td>",
                h = "0" == this.sumSingleDouble ? "单" : "双",
                d = "双" == h ? l + "#f12d35'" : "'",
                o = tools.typeOf("klsfdxh", this.sumBigSmall),
                c = "大" == o ? l + "#f13d35'" : "'",
                u = "0" == this.lastBigSmall ? "尾大" : "尾小",
                f = "尾大" == u ? l + "#f12d35'" : "'",
                m = "0" == this.firstDragonTiger ? "龙" : "虎",
                p = "龙" == m ? l + "#f12d35'" : "'",
                b = "0" == this.secondDragonTiger ? "龙" : "虎",
                g = "龙" == b ? l + "#f12d35'" : "'",
                w = "0" == this.thirdDragonTiger ? "龙" : "虎",
                y = "龙" == w ? l + "#f12d35'" : "'",
                D = "0" == this.fourthDragonTiger ? "龙" : "虎",
                x = "龙" == D ? l + "#f12d35'" : "'";
            var v = "<tr>" + s + n + a + ("<td " + d + ">" + h + "</td><td " + c + ">" + o + "</td><td " + f + ">" + u + "</td><td " + p + ">" + m + "</td><td " + g + ">" + b + "</td><td " + y + ">" + w + "</td><td " + x + ">" + D + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(v)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    cqnc: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width=150>时间</th><th width=80>期数</th><th id="numberbtn" class="numberbtn" width=386><span id="xshm" class="spanselect">显示号码</span></th><th colspan="3">总和</th><th>尾大小</th><th colspan="4">龙虎</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "",
                r = this.preDrawCode.split(",");
            $(r).each(function (t) {
                t >= r.length - 1 ? i += "<li class='ncnum" + this + "' style='color:#ffffff;border:none;margin-right:0;margin-left:0;margin-top:5px'><i style='font-size:10px;display:none;'>" + this + "</i></li>" : i += "<li class='ncnum" + this + "' style='color:#ffffff;border:none;margin-right:13px;margin-left:0;margin-top:5px'><i style='font-size:10px;display:none;'>" + this + "</i></li>"
            });
            var l = "style='color:",
                a = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='cursor:pointer' class='cqncul'>" + i + "</ul></td>",
                n = "<td>" + this.sumNum + "</td>";
            if (!(r.length <= 1)) var h = "0" == this.sumSingleDouble ? "单" : "双",
                d = "双" == h ? l + "#f12d35'" : "'",
                o = tools.typeOf("klsfdxh", this.sumBigSmall),
                c = "大" == o ? l + "#f13d35'" : "'",
                u = "0" == this.lastBigSmall ? "尾大" : "尾小",
                f = "尾大" == u ? l + "#f12d35'" : "'",
                m = "0" == this.firstDragonTiger ? "龙" : "虎",
                p = "龙" == m ? l + "#f12d35'" : "'",
                b = "0" == this.secondDragonTiger ? "龙" : "虎",
                g = "龙" == b ? l + "#f12d35'" : "'",
                w = "0" == this.thirdDragonTiger ? "龙" : "虎",
                y = "龙" == w ? l + "#f12d35'" : "'",
                D = "0" == this.fourthDragonTiger ? "龙" : "虎",
                x = "龙" == D ? l + "#f12d35'" : "'";
            var v = "<tr>" + s + a + n + ("<td " + d + ">" + h + "</td><td " + c + ">" + o + "</td><td " + f + ">" + u + "</td><td " + p + ">" + m + "</td><td " + g + ">" + b + "</td><td " + y + ">" + w + "</td><td " + x + ">" + D + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(v)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    kuai3: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th>时间</th><th>期数</th><th id="numberbtn" class="numberbtn">显示号码</th><th colspan="3">总和</th><th colspan="5">鱼虾蟹</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "",
                r = this.preDrawCode.split(",");
            $(r).each(function () {
                i += "<li class='num" + this + "'></li>"
            });
            var l = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='cursor:pointer' class='kuai3ul'>" + i + "</ul></td>",
                a = "style='color:",
                n = "<td>" + this.sumNum + "</td>";
            if (config.ifdebug && console.log("preDrawCode.length:" + r.length), !(r.length <= 1)) {
                var h = tools.typeOf("dxtc", this.sumBigSmall),
                    d = "0" == this.sumSingleDouble ? "单" : "双",
                    o = tools.typeOf("seafood", this.firstSeafood),
                    c = tools.typeOf("seafood", this.secondSeafood),
                    u = tools.typeOf("seafood", this.thirdSeafood),
                    f = "大" == h ? a + "#f12d35'" : "'",
                    m = "双" == d ? a + "#f12d35'" : "'",
                    p = "",
                    b = "",
                    g = "";
                "1" == o ? o = "鱼" : "2" == o ? o = "虾" : "3" == o ? o = "葫芦" : "4" == o ? o = "金钱" : "5" == o ? o = "蟹" : "6" == o && (o = "鸡"), "1" == c ? c = "鱼" : "2" == c ? c = "虾" : "3" == c ? c = "葫芦" : "4" == c ? c = "金钱" : "5" == c ? c = "蟹" : "6" == c && (c = "鸡"), "1" == u ? u = "鱼" : "2" == u ? u = "虾" : "3" == u ? u = "葫芦" : "4" == u ? u = "金钱" : "5" == u ? u = "蟹" : "6" == u && (u = "鸡"), "鱼" == o || "鸡" == o ? p = "鱼" == o || "鸡" == o ? a + "#f12d35'" : "'" : "虾" == o || "蟹" == o ? p = "虾" == o || "蟹" == o ? a + "#008000'" : "'" : "葫芦" != o && "金钱" != o || (p = "葫芦" == o || "金钱" == o ? a + "#0000FF'" : "'"), "鱼" == c || "鸡" == c ? b = "鱼" == c || "鸡" == c ? a + "#f12d35'" : "'" : "虾" == c || "蟹" == c ? b = "虾" == c || "蟹" == c ? a + "#008000'" : "'" : "葫芦" != c && "金钱" != c || (b = "葫芦" == c || "金钱" == c ? a + "#0000FF'" : "'"), "鱼" == u || "鸡" == u ? g = "鱼" == u || "鸡" == u ? a + "#f12d35'" : "'" : "虾" == u || "蟹" == u ? g = "虾" == u || "蟹" == u ? a + "#008000'" : "'" : "葫芦" != u && "金钱" != u || (g = "葫芦" == u || "金钱" == u ? a + "#0000FF'" : "'")
            }
            var w = "<tr>" + s + l + n + ("<td " + f + ">" + h + "</td><td " + m + ">" + d + "</td><td " + p + ">" + o + "</td><td " + b + ">" + c + "</td><td " + g + ">" + u + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(w)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    shiyxw: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width=150>时间</th><th width=80>期数</th><th id="numberbtn" class="numberbtn" width=286><span id="xshm" class="spanselect">显示号码</span></th><th colspan="3">总和</th><th>龙虎</th><th>前三</th><th>中三</th><th>后三</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "",
                r = this.preDrawCode.split(",");
            $(r).each(function () {
                i += "<li class='sscnumblue' style='color:#012537'><i>" + this + "</i></li>"
            });
            var l = "style='color:",
                a = "<td>" + this.sumNum + "</td>";
            if (r.length <= 1) n = "<td class='blueqiu'></td>";
            else {
                var n = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='width:242px;cursor:pointer'>" + i + "</ul></td>",
                    h = tools.typeOf("klsfdxh", this.sumBigSmall),
                    d = "";
                "0" == this.sumSingleDouble ? d = "单" : "1" == this.sumSingleDouble ? d = "双" : "2" == this.sumSingleDouble && (d = "和");
                var o = "大" == h ? l + "#f12d35'" : "'",
                    c = "双" == d ? l + "#f12d35'" : "''",
                    u = "0" == this.dragonTiger ? "龙" : "虎",
                    f = "龙" == u ? l + "#f12d35'" : "'",
                    m = tools.typeOf("san", this.behindThree),
                    p = "顺子" == m ? l + "#f12d35'" : "'",
                    b = tools.typeOf("san", this.betweenThree),
                    g = "顺子" == b ? l + "#f12d35'" : "'",
                    w = tools.typeOf("san", this.lastThree),
                    y = "顺子" == w ? l + "#f12d35'" : "'"
            }
            var D = "<tr>" + s + n + a + ("<td " + o + ">" + h + "</td><td " + c + ">" + d + "</td><td " + f + ">" + u + "</td><td " + p + ">" + m + "</td><td " + g + ">" + b + "</td><td " + y + ">" + w + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(D)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    gxklsf: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width=150>时间</th><th width=80>期数</th><th id="numberbtn" class="numberbtn" width=386><span id="xshm" class="spanselect">显示号码</span></th><th colspan="3">总和</th><th>尾大小</th><th>龙虎</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "",
                r = this.preDrawCode.split(",");
            $(r).each(function () {
                1 == this || 4 == this || 7 == this || 10 == this || 13 == this || 16 == this || 19 == this ? i += "<li class='gxnumred' style='color:#292c2e;font-size:20px'><i>" + this + "</i></li>" : 2 == this || 5 == this || 8 == this || 11 == this || 14 == this || 17 == this || 20 == this ? i += "<li class='gxnumblue' style='color:#292c2e;font-size:20px'><i>" + this + "</i></li>" : 3 != this && 6 != this && 9 != this && 12 != this && 15 != this && 18 != this && 21 != this || (i += "<li class ='gxnumgreen' style='color:#292c2e;font-size:20px'><i>" + this + "</i></li>")
            });
            var l = "style='color:",
                a = "<td>" + this.sumNum + "</td>";
            if (r.length <= 1) n = "<td class='blueqiu'></td>";
            else {
                var n = "<td class='blueqiu'><ul onclick='getH(" + e + ")' class='gx_kaihmul' style='cursor:pointer'>" + i + "</ul></td>",
                    h = "";
                "0" == this.sumSingleDouble ? h = "单" : "1" == this.sumSingleDouble ? h = "双" : "2" == this.sumSingleDouble && (h = "和");
                var d = "双" == h ? l + "#f12d35'" : "'",
                    o = tools.typeOf("klsfdxh", this.sumBigSmall),
                    c = "大" == o ? l + "#f13d35'" : "'",
                    u = "0" == this.lastBigSmall ? "尾大" : "尾小",
                    f = "尾大" == u ? l + "#f12d35'" : "'",
                    m = "0" == this.firstDragonTiger ? "龙" : "虎",
                    p = "龙" == m ? l + "#f12d35'" : "'";
                this.secondDragonTiger, this.thirdDragonTiger, this.fourthDragonTiger
            }
            var b = "<tr>" + s + n + a + ("<td " + d + ">" + h + "</td><td " + c + ">" + o + "</td><td " + f + ">" + u + "</td><td " + p + ">" + m + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(b)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    fcSSQ: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width="150">时间</th><th width="130">期数</th><th id="numberbtn" class="numberbtn">号码</th><th colspan="2">总和</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "";
            if ("" != this.preDrawCode || void 0 != this.preDrawCode) {
                var r = this.preDrawCode.split(","),
                    l = r.length;
                $(r).each(function (t) {
                    i += "<li class='numblue " + (t != l - 1 ? "numredkong" : "") + "' style='color:#012537'><i>" + this + "</i></li>"
                })
            } else i += "";
            if (r.length <= 1) a = "<td class='blueqiu'></td>";
            else {
                var a = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='cursor:pointer;width:384px;max-width:384px'>" + i + "</ul></td>",
                    n = "0" == this.sumSingleDouble ? "单" : "双",
                    h = "双" == n ? "style='color:#f12d35'" : "'";
                this.sumBigSmall, tools.typeOf("lhh", this.dragonTiger)
            }
            var d = "<tr>" + s + a + ("<td>" + this.sumNum + "</td><td " + h + ">" + n + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(d)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    cjDLT: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width="150">时间</th><th width="130">期数</th><th id="numberbtn" class="numberbtn">号码</th><th colspan="2">总和</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "";
            if ("" != this.preDrawCode || void 0 != this.preDrawCode) {
                var r = this.preDrawCode.split(","),
                    l = r.length;
                $(r).each(function (t) {
                    var e = "";
                    t == l - 1 || t == l - 2 || (e = "numredkong"), i += "<li class='numblue " + e + "' style='color:#012537'><i>" + this + "</i></li>"
                })
            } else i += "";
            if (r.length <= 1) a = "<td class='blueqiu'></td>";
            else {
                var a = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='width:338px;max-width:338px;cursor:pointer'>" + i + "</ul></td>",
                    n = "0" == this.sumSingleDouble ? "单" : "双",
                    h = "双" == n ? "style='color:#f12d35'" : "'";
                this.sumBigSmall, tools.typeOf("lhh", this.dragonTiger)
            }
            var d = "<tr>" + s + a + ("<td>" + this.sumNum + "</td><td " + h + ">" + n + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(d)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    fc3d: function (t, e) {
        $("#jrsmhmtj>table").empty();
        s = "";
        if ("10041" == lotCode) var s = "<th>试机号</th>";
        $("#jrsmhmtj>table").html('<tr><th width="150">时间</th><th width="130">期数</th><th id="numberbtn" width="300" style="padding-left:10px" class="numberbtn">号码</th>' + s + '<th colspan="3">佰拾和</th><th colspan="3">佰个和</th><th colspan="3">拾个和</th><th colspan="3">总和</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "";
            if ("" != this.preDrawCode || void 0 != this.preDrawCode) {
                var r = this.preDrawCode.split(",");
                r.length;
                $(r).each(function (t) {
                    i += "<li class='numblue numredkong' style='color:#012537'><i>" + this + "</i></li>"
                })
            } else i += "";
            if (r.length <= 1) l = "<td class='blueqiu'></td>";
            else var l = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='cursor:pointer;width:144px;max-width:144px'>" + i + "</ul></td>";
            "10041" == lotCode && (l += "<td>" + this.sjh + "</td>");
            var a = "<td>" + this.sumHundredTen + "</td><td>" + (0 == this.htSingleDouble ? "单" : "双") + "</td><td>" + (0 == this.httailBigSmall ? "尾大" : "尾小") + "</td>";
            a += "<td>" + this.sumHundredOne + "</td><td>" + (0 == this.hoSingleDouble ? "单" : "双") + "</td><td>" + (0 == this.hotailBigSmall ? "尾大" : "尾小") + "</td>", a += "<td>" + this.sumTenOne + "</td><td>" + (0 == this.toSingleDouble ? "单" : "双") + "</td><td>" + (0 == this.totailBigSmall ? "尾大" : "尾小") + "</td>";
            var n = "<tr>" + s + l + (a += "<td>" + this.sumNum + "</td><td>" + (0 == this.sumSingleDouble ? "单" : "双") + "</td><td>" + (0 == this.sumBigSmall ? "大" : "小") + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(n)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    tcPL5: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width="150">时间</th><th width="130">期数</th><th id="numberbtn" class="numberbtn">号码</th><th colspan="2">总和</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "";
            if ("" != this.preDrawCode || void 0 != this.preDrawCode) {
                var r = this.preDrawCode.split(",");
                r.length;
                $(r).each(function (t) {
                    i += "<li class='numblue numredkong' style='color:#012537'><i>" + this + "</i></li>"
                })
            } else i += "";
            if (r.length <= 1) l = "<td class='blueqiu'></td>";
            else {
                var l = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='cursor:pointer;width:249px;max-width:249px'>" + i + "</ul></td>",
                    a = "0" == this.sumSingleDouble ? "单" : "双",
                    n = "双" == a ? "style='color:#f12d35'" : "'";
                this.sumBigSmall, tools.typeOf("lhh", this.dragonTiger)
            }
            var h = "<tr>" + s + l + ("<td>" + this.sumNum + "</td><td " + n + ">" + a + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(h)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    tcQXC: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width="150">时间</th><th width="130">期数</th><th id="numberbtn" class="numberbtn">号码</th><th colspan="2">总和</th></tr>'), $(t).each(function (t) {
            var s = "<td>" + this.preDrawTime + "</td><td>" + this.preDrawIssue + "</td>",
                i = "";
            if ("" != this.preDrawCode || void 0 != this.preDrawCode) {
                var r = this.preDrawCode.split(",");
                r.length;
                $(r).each(function (t) {
                    var e = "";
                    t <= 3 || (e = "sscnumblue"), i += "<li class='numblue " + e + "' style='color:#012537'><i>" + this + "</i></li>"
                })
            } else i += "";
            if (r.length <= 1) l = "<td class='blueqiu'></td>";
            else {
                var l = "<td class='blueqiu'><ul onclick='getH(" + e + ")' style='cursor:pointer;width:338px;max-width:338px'>" + i + "</ul></td>",
                    a = "0" == this.sumSingleDouble ? "单" : "双",
                    n = "双" == a ? "style='color:#f12d35'" : "'";
                this.sumBigSmall, tools.typeOf("lhh", this.dragonTiger)
            }
            var h = "<tr>" + s + l + ("<td>" + this.sumNum + "</td><td " + n + ">" + a + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(h)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    pcege28: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th width=136>时间</th><th width:100>期数</th><th id="numberbtn" class="numberbtn"><span id="kjhm">开奖号码</span></th><th colspan="3">总和</th></tr>'), $(t).each(function (t) {
            var s = "<td width=200>" + this.preDrawTime + "</td><td width=100>" + this.preDrawIssue + "</td>",
                i = "",
                r = this.preDrawCode.split(",");
            $(r).each(function (t) {
                t == r.length - 1 ? i += "<li class='sscnumblue' style='color:#292c2e;font-size:18px'><i>" + this + "</i></li>" : i += "<li class='sscnumblue' style='color:#292c2e;font-size:18px'><i>" + this + "</i></li><li class='addF'></li>"
            });
            var l = "<td>" + this.sumNum + "</td>";
            if (r.length <= 1) a = "<td class='blueqiu'></td>";
            else var a = "<td class='blueqiu egxyhis_blueqiu'><ul onclick='getH(" + e + ")' class='egxyul'  style='cursor:pointer;position:relative'>" + i + "</ul></td>",
                n = tools.typeOf("pcdxh", this.sumBigSmall),
                h = "大" == n ? "style='color:#f12d35'" : "'",
                d = tools.typeOf("pcdsh", this.sumSingleDouble),
                o = "双" == d ? "style='color:#f13d35'" : "'";
            var c = "<tr>" + s + a + l + ("<td " + h + ">" + n + "</td><td " + o + ">" + d + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(c)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    },
    xgc: function (t, e) {
        $("#jrsmhmtj>table").empty(), $("#jrsmhmtj>table").html('<tr><th rowspan="2" width=136>日期/期数</th><th rowspan="2" id="numberbtn" class="numberbtn"><span id="kjhm">正码</span></th><th rowspan="2" id="tmbtn"><span id="tmsan">特码</span></th><th colspan="4">总和</th><th colspan="5">特码</th></tr><tr><td style="background:#f5f5f5">总数</td><td style="background:#f5f5f5">单双</td><td style="background:#f5f5f5">大小</td><td style="background:#f5f5f5">七色波</td><td style="background:#f5f5f5">单双</td><td style="background:#f5f5f5">大小</td><td style="background:#f5f5f5">和单双</td><td style="background:#f5f5f5">和大小</td><td style="background:#f5f5f5">尾大小</td></tr>'), $(t.bodyList).each(function (t) {
            var s, i = "<td>" + this.preDrawDate + " " + this.issue + "期</td>",
                r = "",
                l = "",
                a = this.preDrawCode.split(","),
                n = this.czAndFe;
            $(a).each(function (t) {
                s = tools.typeOf("shengxiao", n[t]), t == a.length - 1 ? 1 == this || 2 == this || 7 == this || 8 == this || 12 == this || 13 == this || 18 == this || 19 == this || 23 == this || 24 == this || 29 == this || 30 == this || 34 == this || 35 == this || 40 == this || 45 == this || 46 == this ? l = "<td width=80 style='position:relative'><span class='numredHead tmNum' style='color:#fff;font-size:16px'>" + this + "</span><span class='shengxiaospan'>" + s + "</span></td>" : 3 == this || 4 == this || 9 == this || 10 == this || 14 == this || 15 == this || 20 == this || 25 == this || 26 == this || 31 == this || 36 == this || 37 == this || 41 == this || 42 == this || 47 == this || 48 == this ? l = "<td width=80 style='position:relative'><span class='numblueHead tmNum' style='color:#fff;font-size:16px'>" + this + "</span><span class='shengxiaospan'>" + s + "</span></td>" : 5 != this && 6 != this && 11 != this && 16 != this && 17 != this && 21 != this && 22 != this && 27 != this && 28 != this && 32 != this && 33 != this && 38 != this && 39 != this && 43 != this && 44 != this && 49 != this || (l = "<td width=80 style='position:relative'><span class='numgreenHead tmNum' style='color:#fff;font-size:16px'>" + this + "</span><span class='shengxiaospan'>" + s + "</span></td>") : 1 == this || 2 == this || 7 == this || 8 == this || 12 == this || 13 == this || 18 == this || 19 == this || 23 == this || 24 == this || 29 == this || 30 == this || 34 == this || 35 == this || 40 == this || 45 == this || 46 == this ? r += "<li class='numredHead' style='color:#fff;font-size:16px'><i>" + this + "</i></li><li class='shengxiaoli'>" + s + "</li>" : 3 == this || 4 == this || 9 == this || 10 == this || 14 == this || 15 == this || 20 == this || 25 == this || 26 == this || 31 == this || 36 == this || 37 == this || 41 == this || 42 == this || 47 == this || 48 == this ? r += "<li class='numblueHead' style='color:#fff;font-size:16px'><i>" + this + "</i></li><li class='shengxiaoli'>" + s + "</li>" : 5 != this && 6 != this && 11 != this && 16 != this && 17 != this && 21 != this && 22 != this && 27 != this && 28 != this && 32 != this && 33 != this && 38 != this && 39 != this && 43 != this && 44 != this && 49 != this || (r += "<li class='numgreenHead' style='color:#fff;font-size:16px'><i>" + this + "</i></li><li class='shengxiaoli'>" + s + "</li>")
            });
            var h = "style='color:",
                d = "<td>" + this.sumTotal + "</td>";
            if (a.length <= 1) o = "<td class='blueqiu'></td>";
            else var o = "<td class='blueqiu' style='cursor:pointer;position:relative'><ul onclick='getH(" + e + ")' class='egxyul'>" + r + "</ul></td>",
                c = tools.typeOf("zhds", this.totalSingleDouble),
                u = "双" == c ? h + "#f13d35'" : "'",
                f = tools.typeOf("zhdx", this.totalBigSmall),
                m = "大" == f ? h + "#f12d35'" : "'",
                p = tools.typeOf("qsb", this.nanairo),
                b = "红" == p ? h + "#f12d35'" : "'",
                g = tools.typeOf("tmds", this.seventhSingleDouble),
                w = "双" == g ? h + "#f13d35'" : "'",
                y = tools.typeOf("tmdx", this.seventhBigSmall),
                D = "大" == y ? h + "#f12d35'" : "'",
                x = tools.typeOf("hds", this.seventhCompositeDouble),
                v = "合双" == x ? h + "#f12d35'" : "'",
                j = tools.typeOf("hdx", this.seventhCompositeBig),
                k = "合大" == j ? h + "#f13d35'" : "'",
                S = tools.typeOf("wdx", this.seventhMantissaBig),
                C = "尾大" == S ? h + "#f12d35'" : "'";
            var T = "<tr>" + i + o + l + d + ("<td " + u + ">" + c + "</td><td " + m + ">" + f + "</td><td " + b + ">" + p + "</td><td " + w + ">" + g + "</td><td " + D + ">" + y + "</td><td " + v + ">" + x + "</td><td " + k + ">" + j + "</td><td " + C + ">" + S + "</td>") + "</tr>";
            $("#jrsmhmtj>table").append(T)
        }), $("table").find("td").each(function () {
            "undefined" == $(this).text() && $(this).text("")
        })
    }
}, tools.typeOf = function (t, e) {
    if ("shengxiao" == t) switch (1 * e) {
    case 1:
        return "鼠";
    case 2:
        return "牛";
    case 3:
        return "虎";
    case 4:
        return "兔";
    case 5:
        return "龙";
    case 6:
        return "蛇";
    case 7:
        return "马";
    case 8:
        return "羊";
    case 9:
        return "猴";
    case 10:
        return "鸡";
    case 11:
        return "狗";
    case 12:
        return "猪"
    } else if ("zhds" == t) switch (1 * e) {
    case 0:
        return "单";
    case 1:
        return "双"
    } else if ("zhdx" == t) switch (1 * e) {
    case 0:
        return "大";
    case 1:
        return "小"
    } else if ("qsb" == t) switch (1 * e) {
    case 0:
        return "红";
    case 1:
        return "绿";
    case 2:
        return "蓝";
    case 3:
        return "合局"
    } else if ("tmds" == t) switch (1 * e) {
    case 0:
        return "单";
    case 1:
        return "双";
    case 2:
        return "和"
    } else if ("tmdx" == t) switch (1 * e) {
    case 0:
        return "大";
    case 1:
        return "小";
    case 2:
        return "和"
    } else if ("hds" == t) switch (1 * e) {
    case 0:
        return "合单";
    case 1:
        return "合双";
    case 2:
        return "和"
    } else if ("hdx" == t) switch (1 * e) {
    case 0:
        return "合大";
    case 1:
        return "合小";
    case 2:
        return "和"
    } else if ("wdx" == t) switch (1 * e) {
    case 0:
        return "尾大";
    case 1:
        return "尾小";
    case 2:
        return "和"
    } else if ("rank" == t) switch (1 * e) {
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
    } else if ("state" == t) switch (1 * e) {
    case 0:
        return "总和大小";
    case 1:
        return "总和单双";
    case 2:
        return "总和大小单双";
    case 3:
        return "前后和";
    case 4:
        return "单双和";
    case 5:
        return "五行"
    } else if ("dxh" == t) switch (1 * e) {
    case -1:
        return "小";
    case 0:
        return "和";
    case 1:
        return "大"
    } else if ("dsh" == t) switch (1 * e) {
    case -1:
        return "双";
    case 0:
        return "和";
    case 1:
        return "单"
    } else if ("qhh" == t) switch (1 * e) {
    case -1:
        return "后多";
    case 0:
        return "前后和";
    case 1:
        return "前多"
    } else if ("dsd" == t) switch (1 * e) {
    case -1:
        return "双多";
    case 0:
        return "单双和";
    case 1:
        return "单多"
    } else if ("zhzh" == t) switch (1 * e) {
    case 1:
        return "总大单";
    case 2:
        return "总大双";
    case 3:
        return "总小单";
    case 4:
        return "总小双";
    case 5:
        return "总和"
    } else if ("wuxing" == t) switch (1 * e) {
    case 1:
        return "金";
    case 2:
        return "木";
    case 3:
        return "水";
    case 4:
        return "火";
    case 5:
        return "土"
    } else if ("klsfdxh" == t) switch (1 * e) {
    case 0:
        return "大";
    case 1:
        return "小";
    case 2:
        return "和"
    } else if ("seafood" == t) switch (1 * e) {
    case 1:
        return "鱼";
    case 2:
        return "虾";
    case 3:
        return "葫芦";
    case 4:
        return "金钱";
    case 5:
        return "蟹";
    case 6:
        return "鸡"
    } else if ("dxtc" == t) switch (1 * e) {
    case 0:
        return "大";
    case 1:
        return "小";
    case 2:
        return "通吃"
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
    } else if ("pcdxh" == t) switch (1 * e) {
    case -1:
        return "小";
    case 0:
        return "和";
    case 1:
        return "大"
    } else if ("pcdsh" == t) switch (1 * e) {
    case -1:
        return "双";
    case 0:
        return "和";
    case 1:
        return "单"
    } else if ("dsd" == t) switch (1 * e) {
    case -1:
        return "双多";
    case 0:
        return "单双和";
    case 1:
        return "单多"
    }
};