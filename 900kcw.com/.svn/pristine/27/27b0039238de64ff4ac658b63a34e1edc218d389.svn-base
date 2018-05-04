function addFavorite2() { var t = window.location,
        r = document.title,
        e = navigator.userAgent.toLowerCase(); if (e.indexOf("360se") > -1) alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
    else if (e.indexOf("msie 8") > -1) window.external.AddToFavoritesBar(t, r);
    else if (document.all) try { window.external.addFavorite(t, r) } catch (t) { alert("您的浏览器不支持,请按 Ctrl+D 手动收藏!") } else window.sidebar ? window.sidebar.addPanel(r, t, "") : alert("您的浏览器不支持,请按 Ctrl+D 手动收藏!") }

function setTextColor(t) { $("#noBgIframe iframe").contents().find("body").css("background-color", "#" + t.toString()); var r = $("#noBgIframe").find("iframe").attr("src");
    $("#noBgIframe").find("iframe").attr("src", r.split("?")[0] + "?" + r.split("?")[1] + "?" + r.split("?")[2] + "?" + t.toString() + "?" + r.split("?")[4]) }
var path = window.location.href,
    public = config.path(),
    indexObj = new Object,
    tools = {},
    arrObj = { rmc: "", gpc: "", qgc: "", jwc: "", xgc: "" },
    ulId = "",
    lotCodeArr = [],
    linameArr = [],
    defaultGArr = [],
    lotco, g, whoL, bgColor = null,
    url = config.publicUrl + "lottery/getLotteryListByType.php?";
$(function() { $("#more,#sing").on("click", function() { var t, r; if (void 0 == lotCodeArr[0]) t = "", r = "";
        else if (t = [lotCodeArr[0]], r = [linameArr[0]], lotCodeArr = t, linameArr = r, "s" == tools.ifMore()) { $("#kindsul").find(".onli").each(function() { $(this).attr("id") != lotCodeArr[0] && $(this).removeClass("onli") }), $("#morelist").empty(); var e = "<option title='" + defaultGArr[0] + "' value='" + lotCodeArr + "'>" + linameArr + "</option>";
            $("#morelist").append(e) } if (1 == $("#haveBgIframe").length) { o = $("#haveBgIframe").find("iframe").attr("src");
            $("#haveBgIframe").find("iframe").attr("src", o.split("?")[0] + "?" + o.split("?")[1] + "?" + o.split("?")[2] + "?none?" + tools.ifMore());
            o = $("#noBgIframe").find("iframe").attr("src");
            $("#noBgIframe").find("iframe").attr("src", o.split("?")[0] + "?" + o.split("?")[1] + "?" + o.split("?")[2] + "?" + o.split("?")[3] + "?" + tools.ifMore()) } else if (1 == $("#tziframe").length) { var o = $("#tziframe").find("iframe").attr("src");
            $("#tziframe").find("iframe").attr("src", o.split("?")[0] + "?" + o.split("?")[1] + "?" + o.split("?")[2] + "?" + tools.ifMore()) } }), indexObj.ajaxInit(url, 1), indexObj.ajaxInit(url, 2), indexObj.ajaxInit(url, 3), indexObj.ajaxInit(url, 4), indexObj.ajaxInit(url, 5), $("#ShowTul").on("mouseover", ".cailist", function() { $(this).siblings().removeClass("deflibg"), $(this).addClass("ahover").siblings().removeClass("ahover"); var t = $(this).attr("id");
        ulId = 1 * t, 1 == t ? $(".kindslist>ul").html(tools.cHTML(arrObj.gpc)) : 2 == t ? $(".kindslist>ul").html(tools.cHTML(arrObj.qgc)) : 3 == t ? $(".kindslist>ul").html(tools.cHTML(arrObj.jwc)) : 4 == t ? $(".kindslist>ul").html(tools.cHTML(arrObj.rmc)) : 5 == t && $(".kindslist>ul").html(tools.cHTML(arrObj.xgc)), tools.checkBtn() }), $("#kindsul").on("click", "li", function() { var t = $(this).find("em").attr("class"),
            r = $(this).attr("id"),
            e = $(this).text(); if ($(this).hasClass("onli")) $(lotCodeArr).each(function(t) { lotCodeArr[t] == r && (lotCodeArr.splice(t, 1), g = lotCodeArr.length <= 0 ? "1" : $(lotCodeArr[0]).find("em").attr("class")) }), $(linameArr).each(function(t) { linameArr[t] == e && linameArr.splice(t, 1) }), $(defaultGArr).each(function(r) { defaultGArr[r] == t && (defaultGArr.splice(r, 1), g = defaultGArr.length <= 0 ? "1" : defaultGArr[0]) });
        else if (lotCodeArr.length <= 0) tools.saveLotCode(r, e, $(this), t), g = $(this).find("em").attr("class");
        else { var o = !1;
            $(lotCodeArr).each(function(t) { lotCodeArr[t] == r && (o = !0) }), o || (tools.saveLotCode(r, e, $(this), t), g = $(this).find("em").attr("class")) } $(this).toggleClass("onli"), $("#morelist").empty(), $(lotCodeArr).each(function(t) { var r = linameArr[t],
                e = lotCodeArr[t],
                o = "<option title='" + defaultGArr[t] + "' value='" + e + "'>" + r + "</option>";
            $("#morelist").append(o) }), 0 == lotCodeArr.length ? lotco = "10001" : 1 == lotCodeArr.length ? lotco = lotCodeArr[0] : (lotco = whoL = lotCodeArr.join(","), lotCodeArr = lotco.split(",")), console.log("lotCodeArr:" + lotCodeArr), console.log("linameArr:" + linameArr), console.log("defaultGArr:" + defaultGArr), tools.haveBgIframe(g, lotco, bgColor), tools.noBgIframe(g, lotco, "f0f0f0"), tools.tziframe(g, lotco), "kaihole" == $("#kaihole").val() && tools.loadIframe($("#ShowTul").find(".ahover").eq(0).attr("title")) }), $("#morelist").change(function(t) { var r = $("#morelist option:selected").val(),
            e = $("#morelist option:selected").attr("title"),
            o = $("#morelist option:selected").text(); if ($(lotCodeArr).each(function(t) { lotCodeArr[t] == r && (lotCodeArr.splice(t, 1), defaultGArr.splice(t, 1), linameArr.splice(t, 1)) }), lotCodeArr.unshift(r), defaultGArr.unshift(e), linameArr.unshift(o), 1 == lotCodeArr.length ? lotco = lotCodeArr[0] : (lotco = whoL = lotCodeArr.join(","), lotCodeArr = lotco.split(",")), tools.haveBgIframe(e, lotco, bgColor), tools.noBgIframe(e, lotco, "f0f0f0"), tools.tziframe(e, r), 1 == $("#tziframe").length) { var l = $("#tziframe").find("iframe").attr("src");
            $("#tziframe").find("iframe").attr("src", l.split("?")[0] + "?" + l.split("?")[1] + "?" + lotco + "?" + tools.ifMore()) } }) }), indexObj.ajaxInit = function(t, r) { $.ajax({ type: "get", url: t, async: !1, data: { type: r }, dataType: "json", beforeSend: function() {}, success: function(t) { indexObj.loadotherData(t, r) } }) }, indexObj.loadotherData = function(t, r) { t = (t = tools.ifObj(t)).result.data, 1 == r ? arrObj.gpc = t : 2 == r ? arrObj.qgc = t : 3 == r ? arrObj.jwc = t : 4 == r ? ($(".kindslist>ul").html(tools.cHTML(t)), arrObj.rmc = t) : 5 == r && (arrObj.xgc = t) }, tools.cHTML = function(t) { var r = ""; return $.each(t, function(t, e) { r += 0 != t && 8 == t || (t - 8) % 9 == 0 ? "<li id='" + e.lotCode + "' class='noright'>" + e.lotName + "<em class='" + e.groupCode + "'></em></li>" : "<li id='" + e.lotCode + "'>" + e.lotName + "<em class='" + e.groupCode + "'></em></li>" }), r }, tools.checkBtn = function() { $(lotCodeArr).each(function(t) { $("#kindsul>li").each(function(r) { $(this).attr("id") == lotCodeArr[t] && $(this).addClass("onli") }) }) }, tools.saveLotCode = function(t, r, e, o) { $('input:radio[class="morelecect"]').is(":checked"), $('input:radio[class="morelecect"]').is(":checked") ? (lotCodeArr.unshift(t), linameArr.unshift(r), defaultGArr.unshift(o)) : (linameArr = [], defaultGArr = [], (lotCodeArr = []).unshift(t), linameArr.unshift(r), defaultGArr.unshift(o), e.siblings().removeClass("onli")) }, tools.ifLoading = function(t) { t ? ($(".loading").fadeIn("100"), $("#kindsul").hide()) : ($(".loading").hide(), $("#kindsul").fadeIn("100")) }, tools.ifObj = function(t) { var r = null; return "object" != typeof t ? r = JSON.parse(t) : (r = JSON.stringify(t), r = JSON.parse(r)), r }, tools.haveBgIframe = function(t, r, e) { var o = t,
        l = r,
        i = e,
        a = public + "" + tools.pageView(o) + "?" + o + "?" + l + "?" + i + "?" + tools.ifMore();
    $("#haveBgIframe>iframe").attr("src", a) }, tools.ifMore = function() { return $('input:radio[class="morelecect"]').is(":checked") ? "d" : "s" }, tools.noBgIframe = function(t, r, e) { var o = t,
        l = r,
        i = e,
        a = public + "" + tools.pageView(o) + "?" + o + "?" + l + "?" + i + "?" + tools.ifMore();
    $("#noBgIframe>iframe").attr("src", a) }, tools.tziframe = function(t, r) { var e = t,
        o = r,
        l = public + "" + tools.listpageView(e) + "?" + e + "?" + o + "?" + tools.ifMore();
    $("#tziframe>iframe").attr("src", l) }, tools.loadIframe = function(t) { window.location.href; for (var r = "", e = 0, o = lotCodeArr.length; e < o; e++) r += lotCodeArr[e] + ",";
    $("iframe").attr("src", config.path() + "cz_list.php?" + r + "?" + t) }, tools.pageView = function(t) { switch (1 * t) {
        case 1:
            return "kj/pk10.html";
        case 2:
            return "kj/ssc.html";
        case 3:
            return "kj/klsf.html";
        case 4:
            return "kj/cqnc.html";
        case 5:
            return "kj/kuai3.html";
        case 6:
            return "kj/shiyxw.html";
        case 7:
            return "kj/bjkl8.html";
        case 8:
            return "kj/gxklsf.html";
        case 39:
            return "kj/fcSSQ.html";
        case 40:
            return "kj/cjDLT.html";
        case 41:
            return "kj/fc3d.html";
        case 42:
            return "kj/fcQLC.html";
        case 43:
            return "kj/tcPL3.html";
        case 44:
            return "kj/tcPL5.html";
        case 45:
            return "kj/tcQXC.html";
        case 46:
            return "kj/pcege28.html";
        case 48:
            return "kj/xgc.html";
        case 35:
            return "kj/pk10.html" } }, tools.listpageView = function(t) { switch (1 * t) {
        case 1:
            return "kj/pk10_list.html";
        case 2:
            return "kj/ssc_list.html";
        case 3:
            return "kj/klsf_list.html";
        case 4:
            return "kj/cqnc_list.html";
        case 5:
            return "kj/kuai3_list.html";
        case 6:
            return "kj/shiyxw_list.html";
        case 7:
            return "kj/bjkl8_list.html";
        case 8:
            return "kj/gxklsf_list.html";
        case 39:
            return "kj/fcSSQ_list.html";
        case 40:
            return "kj/cjDLT_list.html";
        case 41:
            return "kj/fc3d_list.html";
        case 42:
            return "kj/fcQLC_list.html";
        case 43:
            return "kj/tcPL3_list.html";
        case 44:
            return "kj/tcPL5_list.html";
        case 45:
            return "kj/tcQXC_list.html";
        case 46:
            return "kj/pcege28_list.html";
        case 48:
            return "kj/xgc_list.html";
        case 35:
            return "kj/pk10_list.html" } };