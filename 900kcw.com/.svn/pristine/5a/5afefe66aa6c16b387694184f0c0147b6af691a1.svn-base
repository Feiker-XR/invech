var indexObj = {};
var hometools = {};
$(function () {
    indexObj.ajaxBanner();
    setTimeout(function () {
        $(".main_image ul li").find("img").width($(".main_image").width());
        $(".main_image").height($(".main_image ul li").find("img").height())
    }, 1);
    setInterval(function () {
        $(".main_image ul li").find("img").width($(".main_image").width());
        $(".main_image").height($(".main_image ul li").find("img").height())
    }, 500);
    window.onresize = function () {
        $(".main_image ul li").find("img").width($(".main_image").width());
        $(".main_image").height($(".main_image ul li").find("img").height())
    };
    var a = $(".main_image").find("li");
    $(a).each(function (b) {
        $(".flicking_con").append("<a href='javascript:;' class='" + (b == 0 ? "on" : "") + "'>" + (b + 1) + "</a>")
    });
    $dragBln = false;
    if ($(".main_image ul li").find("img").length > 1) {
        $(".main_image").touchSlider({
            flexible: true,
            speed: 200,
            btn_prev: $("#btn_prev"),
            btn_next: $("#btn_next"),
            paging: $(".flicking_con a"),
            counter: function (b) {
                $(".flicking_con a").removeClass("on").eq(b.current - 1).addClass("on")
            }
        })
    } else {
        $(".main_image ul li").find("img").width($(".main_image").width())
    }
    $(".main_image ul li").find("img").width($(".main_image").width());
    $(".main_image").bind("mousedown", function () {
        $dragBln = false
    });
    $(".main_image").bind("dragstart", function () {
        $dragBln = true
    });
    $(".main_image a").click(function () {
        if ($dragBln) {
            return false
        }
    });
    timer = setInterval(function () {
        $("#btn_next").click()
    }, 5000);
    $(".main_visual").hover(function () {
        clearInterval(timer)
    }, function () {
        timer = setInterval(function () {
            $("#btn_next").click()
        }, 5000)
    });
    $(".main_image").bind("touchstart", function () {
        clearInterval(timer)
    }).bind("touchend", function () {
        timer = setInterval(function () {
            $("#btn_next").click()
        }, 5000)
    });
    window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function () {
        $(".main_image ul li").find("img").width($(".main_image").width());
        $(".main_image").height($(".main_image ul li").find("img").height())
    }, false)
});
indexObj.ajaxBanner = function () {
    var a = false;
    $.ajax({
        url: url.apiurl + "focusPicture/findNewestFocusPicture.php?type=1",
        type: "GET",
        timeout: 60000,
        async: false,
        success: function (b) {
            try {
                indexObj.loadBanner(b)
            } catch (c) {
                setTimeout(function () {
                    indexObj.ajaxBanner()
                }, 2000)
            }
        }, error: function (b) {
            setTimeout(function () {
                indexObj.ajaxBanner()
            }, 2000);
            a = true
        }, complete: function (b, c) {
            b = null;
            if (!a) {
                if (c == "timeout") {
                    setTimeout(function () {
                        indexObj.ajaxBanner()
                    }, 2000)
                }
            }
        }
    })
};

function nofind(a) {
    a.src = "img/banner.png"
}
indexObj.loadBanner = function (b) {
    var b = JSON.parse(b).result.data;
    var a = "";
    $(".main_image ul").empty();
    $.each(b, function (c, f) {
        var e = "";
        var d = f.link == "" ? "javascript:;" : f.link;
        a += '<a target="_blank" href="' + d + '"><li><img onerror="nofind(this)" src="' + url.imgurl + "" + f.image + '" /></li></a>'
    });
    $(".main_image ul").append(a)
};
$(".table_type").on("tap", "a", function (b) {
    b.preventDefault();
    $(this).find("span").addClass("checked").parents().parents().siblings().children().find(".checked").removeClass("checked");
    var a = $(this).attr("href").replace("#", "");
    $("." + a).fadeIn("slow").siblings(".tt").hide()
});
var thisText = "",
    typeSix, indexFunObj = {},
    sessionArr = {};
sessionArr.numberCode = [], sessionArr.zooCode = [], sessionArr.color = [];
indexFunObj.ifAnimateFun = function (b, c, d) {
    if (b == 4) {
        $(".issue").html(c.result.data.preDrawIssue);
        indexFunObj.elseFun(c, d);
        $(".kaijiIn").hide().prev().show();
        $("#kjType").html("开奖结果").css({
            display: "inline-block",
            color: "#666"
        })
    } else {
        if (b == 6) {
            $(".kaijiIn").text("请不要走开，今天晚上21：30开奖...").show().prev().hide();
            $("#kjType").hide();
            typeSix = setTimeout(function () {
                clearTimeout(typeSix);
                TishIssuc()
            }, 60000)
        } else {
            if (b == 0) {
                $(".kaijiIn").text("准备报码，请稍后...").show().prev().hide();
                $("#kjType").hide();
                typeSix = setTimeout(function () {
                    clearTimeout(typeSix);
                    TishIssuc()
                }, 10000)
            } else {
                if (b == 2) {
                    $(".kaijiIn").text("节目广告中...").show().prev().hide();
                    $("#kjType").hide();
                    typeSix = setTimeout(function () {
                        clearTimeout(typeSix);
                        TishIssuc()
                    }, 10000)
                } else {
                    if (b == 3) {
                        $(".kaijiIn").text("主持人解说中...").show().prev().hide();
                        $("#kjType").hide();
                        typeSix = setTimeout(function () {
                            clearTimeout(typeSix);
                            TishIssuc()
                        }, 5000)
                    } else {
                        if (b == 1) {
                            $(".kaijiIn").text("正在搅珠中...").hide().prev().show();
                            $("#kjType").html(" 正在搅珠中...").css({
                                display: "inline-block",
                                color: "red"
                            });
                            $(".code_box").show();
                            indexFunObj.elseFun(c, d);
                            var a = setTimeout(function () {
                                TishIssuc();
                                clearTimeout(a)
                            }, 1000)
                        }
                    }
                }
            }
        }
    }
    $(".issue").text(c.result.data.preDrawIssue)
};
indexFunObj.elseFun = function (c, f) {
    var b = $(".result_zoo li");
    var e = $(".result_five li");
    var d = $(".result_num>li>i");
    for (var a = 0; a < f.ThisCode.length; a++) {
        if (f.ThisCode[a] == undefined || proto.fiveLineArr[c.result.data.fiveElements[a]] == undefined) {
            return false
        }
        if (c.result.data.fiveElements[a] == undefined) {
            return false
        }
        if (a != 6) {
            b[a].innerHTML = (proto.Zoo[c.result.data.chineseZodiac[a]]);
            e[a].innerHTML = (proto.fiveLineArr[c.result.data.fiveElements[a]]);
            d[a].parentNode.className = proto.colorEng[c.result.data.color[a]];
            d[a].innerHTML = f.ThisCode[a] > 9 ? f.ThisCode[a] : "0" + f.ThisCode[a]
        } else {
            if (a == 6) {
                b[a + 1].innerHTML = (proto.Zoo[c.result.data.chineseZodiac[a]]);
                e[a + 1].innerHTML = (proto.fiveLineArr[c.result.data.fiveElements[a]]);
                d[a + 1].parentNode.className = proto.colorEng[c.result.data.color[a]];
                d[a + 1].innerHTML = f.ThisCode[a] > 9 ? f.ThisCode[a] : "0" + f.ThisCode[a]
            }
        } if ($(".result_num>li:last-child>i").text() != "") {
            $("#kjType").text("开奖结果").css("color", "#666")
        }
    }
};

function TishIssuc() {
    $.ajax({
        type: "get",
        url: url.apiurl + "smallSix/findSmallSixInfo.php",
        dataType: "json",
        success: function (a) {
            console.log(a);
            nextIssue = a.result.data.drawIssue;
            var b = {};
            b.nextTime = a.result.data.drawTime;
            b.ThisCode = a.result.data.preDrawCode.split(",");
            indexFunObj.ifAnimateFun(a.result.data.type, a, b);
            $(".issue_num").html(a.result.data.drawIssue);
            $(".nextissue_time").html("&nbsp;&nbsp;" + (b.nextTime).slice(5, 7) + "月" + (b.nextTime).slice(8, 10) + "日&nbsp;" + (b.nextTime).slice(11, 13) + "时" + (b.nextTime).slice(14, 16) + "分")
        }
    })
}
TishIssuc();
$(function () {
    $.ajax({
        type: "get",
        url: url.apiurl + "news/findNewsByPIdForPage.php?programaId=7",
        data: {
            pageNo: 1,
            pageSize: 5
        },
        async: true,
        dataType: "json",
        success: function (b) {
            console.log(b);
            if (b.result.data.list == "") {
                return false
            }
            var a = "";
            $.each(b.result.data.list, function (c, d) {
                a += "<div class='icom_item'><a href='html/datum_detail.html?newsId=" + d.newsId + "'><p class='i_title'>" + d.title + "</p><span class='icom_date'>" + d.releaseDate + "</span></a></div>"
            });
            $(".com_box").html(a)
        }
    })
});
$("#fiveElem").click(function () {
    $.ajax({
        type: "get",
        url: url.apiurl + "smallSixMobile/findFiveElements.php",
        async: true,
        dataType: "json",
        success: function (h) {
            console.log(h);
            var a = h.result.data.metalNumber;
            var c = h.result.data.woodNumber;
            var b = h.result.data.waterNumber;
            var g = h.result.data.fireNumber;
            var f = h.result.data.earthNumber;
            var e = {};
            e.gold = "<div class='row'><div><span>金</span><ul>";
            e.wood = "<div class='row'><div><span>木</span><ul>";
            e.water = "<div class='row'><div><span>水</span><ul>";
            e.fire = "<div class='row'><div><span>火</span><ul>";
            e.soil = "<div class='row'><div><span>土</span><ul>";
            for (var d = 0; d < 10; d++) {
                if (a[d] != undefined) {
                    if (a[d][0] < 10) {
                        a[d][0] = "0" + a[d][0]
                    }
                    e.gold += "<li class='" + proto.colorEng[a[d][1]] + "'>" + a[d][0] + "</li>"
                } else {
                    e.gold += "<li></li>"
                } if (c[d] != undefined) {
                    if (c[d][0] < 10) {
                        c[d][0] = "0" + c[d][0]
                    }
                    e.wood += "<li class='" + proto.colorEng[c[d][1]] + "'>" + c[d][0] + "</li>"
                } else {
                    e.wood += "<li></li>"
                } if (b[d] != undefined) {
                    if (b[d][0] < 10) {
                        b[d][0] = "0" + b[d][0]
                    }
                    e.water += "<li class='" + proto.colorEng[b[d][1]] + "'>" + b[d][0] + "</li>"
                } else {
                    e.water += "<li></li>"
                } if (g[d] != undefined) {
                    if (g[d][0] < 10) {
                        g[d][0] = "0" + g[d][0]
                    }
                    e.fire += "<li class='" + proto.colorEng[g[d][1]] + "'>" + g[d][0] + "</li>"
                } else {
                    e.fire += "<li></li>"
                } if (f[d] != undefined) {
                    if (f[d][0] < 10) {
                        f[d][0] = "0" + f[d][0]
                    }
                    e.soil += "<li class='" + proto.colorEng[f[d][1]] + "'>" + f[d][0] + "</li>"
                } else {
                    e.soil += "<li></li>"
                }
            }
            html2 = "</ul></div></div>";
            console.log(e);
            $(".t3").html(e.gold + html2 + e.wood + html2 + e.water + html2 + e.fire + html2 + e.soil + html2)
        }
    })
});
$("#zooElem").click(function () {
    $.ajax({
        type: "get",
        url: url.apiurl + "smallSix/findChineseZodiac.php",
        async: true,
        dataType: "json",
        success: function (c) {
            console.log(c);
            if (c.result.data == "") {
                return false
            }
            var a = c.result.data.animals.split(",");
            var d = $(".t2>div>div>span");
            for (var b = 0; b < d.length; b++) {
                d[b].innerHTML = a[b]
            }
        }
    })
});
var if_one = true;
$("#open_video").click(function (a) {
    a.preventDefault();
    if ($(".ifame_box").hasClass("anheight")) {
        $("iframe")[0].contentWindow.stopanimate()
    }
    $(".ifame_box").toggleClass("anheight");
    if (if_one) {
        $("iframe")[0].contentWindow.pause_play();
        if_one = false
    }
});
$(".vide_close").click(function (a) {
    a.preventDefault();
    $("iframe")[0].contentWindow.stopanimate();
    $(".ifame_box").removeClass("anheight")
});