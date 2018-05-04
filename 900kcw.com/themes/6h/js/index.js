$(function () {
    var a = setTimeout(function () {
        $(".xy").css({
            color: "#fff",
            background: "#ED2842"
        });
        if ($(".xy").length != 0) {
            clearTimeout(a)
        }
    }, 100)
});
var indexFunObj = {};
var nextIssue = 0;
$(function () {
    $(".header>ul>li:first-child").find("a").css("color", "red");
    $("#datebox").calendar({
        zIndex: 999,
    });
    attrTable();
    var a, b;
    var c = 20;
    $.ajax({
        type: "get",
        url: url.config140 + "findSpecialNumberTrend.php",
        data: {
            periods: c
        },
        dataType: "json",
        success: function (l) {
            console.log(l);
            if (l.result.data == "") {
                return false
            }
            b = l.result.data.issues;
            a = l.result.data.numbers;
            var E = c1.getContext("2d");
            E.font = "14px Arial Regular";
            E.textBaseline = "alphabetic";
            E.shadowBlur = "";
            E.beginPath();
            E.strokeStyle = "#B4B4B4";
            E.lineWidth = 1;
            E.lineJoin = "round";
            E.moveTo(810, 325.5);
            E.lineTo(50.5, 325.5);
            E.lineTo(50.5, 25.5);
            E.stroke();
            var C = 75.5,
                A = 800,
                v = 50,
                D = 50;
            for (var n = 0; n < 5; n++) {
                E.beginPath();
                E.strokeStyle = "#DEDEDE";
                E.lineWidth = 1;
                p(E, v, C, A, C, 4);
                E.stroke();
                E.font = "16px Arial Regular";
                E.fillStyle = "#999999";
                E.fillText(D, v - 25, C);
                D -= 10;
                C += 50;
                if (D == 0) {
                    E.fillText(D, v - 25, C)
                }
            }

            function p(F, h, z, d, y, f) {
                f = f === undefined ? 5 : f;
                var k = d - h;
                var j = y - z;
                var x = Math.floor(Math.sqrt(k * k + j * j) / f);
                for (var t = 0; t < x; ++t) {
                    F[t % 2 === 0 ? "moveTo" : "lineTo"](h + (k / x) * t, z + (j / x) * t)
                }
                F.stroke()
            }
            var B = 70,
                w = 325,
                s = 315;
            E.font = "14px Arial Regular";
            for (var u = 0; u < b.length; u++) {
                E.beginPath();
                E.moveTo(B, w);
                E.lineTo(B, s);
                E.strokeStyle = "#ccc";
                E.lineWidth = 0.5;
                E.stroke();
                E.fillText(b[u], B - 10, w + 20);
                B += 38
            }
            var r = [];
            var o = 70;
            for (var q = 0; q < a.length; q++) {
                var e = 0;
                E.beginPath();
                if (a[q] > 50) {
                    e = 25 + (50 - (50 * (((a[q] - 50) * 10) / 100)))
                } else {
                    if (a[q] > 40) {
                        e = 75 + (50 - (50 * (((a[q] - 40) * 10) / 100)))
                    } else {
                        if (a[q] > 30) {
                            e = 125 + (50 - (50 * (((a[q] - 30) * 10) / 100)))
                        } else {
                            if (a[q] > 20) {
                                e = 175 + (50 - (50 * (((a[q] - 20) * 10) / 100)))
                            } else {
                                if (a[q] > 10) {
                                    e = 225 + (50 - (50 * (((a[q] - 10) * 10) / 100)))
                                } else {
                                    e = 275 + (50 - (50 * ((a[q] * 10) / 100)))
                                }
                            }
                        }
                    }
                }
                r.push(e);
                E.arc(o, e, 4, 0, 2 * Math.PI);
                E.fillStyle = "#FC223B";
                E.fill();
                E.fillStyle = "#666666";
                E.fillText(a[q], o - 8, e - 13);
                o += 38
            }
            var g = 70;
            E.beginPath();
            for (var q = 0; q < r.length; q++) {
                E.lineTo(g, r[q]);
                E.strokeStyle = "#F8213B";
                E.lineWidth = 0.8;
                g += 38
            }
            E.stroke()
        }
    })
});

function formatDate(b) {
    var e = b.getFullYear();
    var a = b.getMonth() + 1;
    a = a < 10 ? "0" + a : a;
    var c = b.getDate();
    c = c < 10 ? ("0" + c) : c;
    return e + "-" + a + "-" + c
}

function attrTable() {
    $(".propTable").on("click", "ul>li", function (b) {
        b.preventDefault();
        $(this).addClass("checked").siblings().removeClass("checked");
        var a = $(this).find("a").attr("href");
        console.log(a);
        $("#" + a).css("display", "table").siblings("table").css("display", "none")
    })
}
var thisText = "",
    errorCount = 0,
    typeSix;
sessionArr = {}, sessionArr.numberCode = [], sessionArr.zooCode = [], sessionArr.color = [];
indexFunObj.ifAnimateFun = function (b, c, d) {
    if (b == 4) {
        $(".predrawCode").html(c.result.data.preDrawIssue);
        indexFunObj.elseFun(c, d);
        $(".kjspr .data").show();
        if ($("#jnumber>li:last-child").text() != "") {
            $("#kjType").text("开奖结果").css("color", "#333")
        }
    } else {
        if (b == 6) {
            $("#kjType").text("请不要走开，今天晚上21：30开奖...").css("color", "#F8223C");
            typeSix = setTimeout(function () {
                clearTimeout(typeSix);
                TishIssuc()
            }, 60000)
        } else {
            if (b == 0) {
                $("#kjType").text("准备报码，请稍后...").css("color", "#F8223C");
                typeSix = setTimeout(function () {
                    clearTimeout(typeSix);
                    TishIssuc()
                }, 10000)
            } else {
                if (b == 2) {
                    $("#kjType").text("节目广告中...").css("color", "#F8223C");
                    typeSix = setTimeout(function () {
                        clearTimeout(typeSix);
                        TishIssuc()
                    }, 10000)
                } else {
                    if (b == 3) {
                        $("#kjType").text("主持人解说中...").css("color", "#F8223C");
                        typeSix = setTimeout(function () {
                            clearTimeout(typeSix);
                            TishIssuc()
                        }, 5000)
                    } else {
                        if (b == 1) {
                            $("#kjType").text("正在搅珠中...").css("color", "#F8223C");
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
    $(".predrawCode").text(c.result.data.preDrawIssue)
};
indexFunObj.elseFun = function (c, f) {
    console.log(c);
    $("#zongfen").text(c.result.data.sumTotal);
    var b = $(".sh_xzlist>li>span:first-child");
    var e = $(".sh_xzlist>li>span:last-child");
    var d = $("#jnumber>li:not(.addpic)");
    for (var a = 0; a < f.ThisCode.length; a++) {
        if (f.ThisCode[a] == undefined || proto.fiveLineArr[c.result.data.fiveElements[a]] == undefined) {
            return false
        }
        if (c.result.data.fiveElements[a] == undefined) {
            return false
        }
        b[a].innerHTML = (proto.Zoo[c.result.data.chineseZodiac[a]]);
        e[a].innerHTML = (proto.fiveLineArr[c.result.data.fiveElements[a]]);
        d[a].className = proto.colorEng[c.result.data.color[a]];
        d[a].innerHTML = f.ThisCode[a] > 9 ? f.ThisCode[a] : "0" + f.ThisCode[a]
    }
    $(".kjspr>.data").html((c.result.data.preDrawTime).slice(0, 10))
};

function TishIssuc() {
    $.ajax({
        type: "get",
        url: url.config140 + "findSmallSixInfo.php",
        dataType: "json",
        success: function (a) {
            console.log(a);
            nextIssue = a.result.data.drawIssue;
            var b = {};
            b.nextTime = a.result.data.drawTime;
            b.ThisCode = a.result.data.preDrawCode.split(",");
            indexFunObj.ifAnimateFun(a.result.data.type, a, b);
            $(".nextcode").next().html(a.result.data.drawIssue).next().next().html("&nbsp;&nbsp;" + (b.nextTime).slice(5, 7) + "月" + (b.nextTime).slice(8, 10) + "日&nbsp;" + (b.nextTime).slice(11, 13) + "时" + (b.nextTime).slice(14, 16) + "分")
        }, error: function () {
            if (errorCount <= 5) {
                TishIssuc()
            } else {
                return
            }
            errorCount++
        }
    })
}
TishIssuc();

function ready() {
    var a = new Date();
    var d = a.getFullYear();
    var c = a.getMonth() + 1;
    var b = a.getFullYear();
    $("#date_year>p").html(d + "/" + c);
    dateFun(d, c)
}
ready();
$("#date_year").on("click", "button", function (a) {
    if ($(a.target).attr("class") == "date_lt") {
        var c = $("#date_year>p").html().split("/");
        var b = Number(c[0]);
        m = Number(c[1]);
        m -= 1;
        if (m < 1) {
            m = 12;
            b -= 1
        }
        $("#date_year>p").html(b + "/" + m);
        dateFun(b, m);
        console.log(b + "-" + m)
    } else {
        var c = $("#date_year>p").html().split("/");
        var b = Number(c[0]);
        m = Number(c[1]);
        m += 1;
        if (m > 12) {
            m = 1;
            b += 1
        }
        $("#date_year>p").html(b + "/" + m);
        dateFun(b, m)
    }
});

function dateFun(b, a) {
    if ((a * 1) < 10) {
        a = "0" + a
    }
    console.log(a);
    $.ajax({
        type: "get",
        url: url.config140 + "queryLotteryDate.php",
        data: {
            ym: b + "-" + a
        },
        success: function (g) {
            
            console.log(g);
            if (g.result.data == "") {
                return false
            }
            var f = new Date().toLocaleDateString().replace("年", "/").replace("月", "/").replace("日", "").split("/");
            var d = new Date();
            var i = d.getFullYear();
            var k = d.getMonth() + 1;
            var j = d.getDate();
            var e = d.getHours();
            var c = d.getMinutes();
            console.log(e, c);
            var h = "";
            $.each(g.result.data.kjDate, function (l, n) {
                if (n[0] == 0) {
                    n[0] = " "
                } else {
                    if (n[0] < 10) {
                        n[0] = "0" + n[0]
                    }
                } if (Number(b) >= i & Number(a) >= k & Number(n[0]) >= j) {
                    if (n[1] == 1) {
                        n[1] = "red"
                    } else {
                        n[1] = ""
                    }
                } else {
                    if (Number(b) >= i & Number(a) > k) {
                        if (n[1] == 1) {
                            n[1] = "red"
                        } else {
                            n[1] = ""
                        }
                    } else {
                        if (Number(b) > i) {
                            if (n[1] == 1) {
                                n[1] = "red"
                            } else {
                                n[1] = ""
                            }
                        } else {
                            if (n[1] == 1) {
                                n[1] = "grey"
                            } else {
                                n[1] = ""
                            }
                        }
                    }
                } if (Number(b) == i & Number(a) == k & Number(n[0]) == j & e >= 21 & c >= 35 || Number(b) == i & Number(a) == k & Number(n[0]) == j & e > 21) {
                    if (n[1] == "red") {
                        n[1] = "grey"
                    } else {
                        n[1] = ""
                    }
                }
                h += "<li class='" + n[1] + "'>" + n[0] + "</li>";
                $("#date_day>ul").html(h)
            });
            if (g.result.data.kjDate.length > 35) {
                $(".box .box_firstr .timeboxbg #date_day>ul>li").css("margin-bottom", "4px")
            }
        }
    })
}

function ycFun(a) {
    $.ajax({
        type: "get",
        url: url.config140_2 + "mapDepot/findHomePageMapDepotList.php",
        data: {
            issue: a
        },
        success: function (d) {
            console.log(d);
            if (d.result.data == "") {
                console.log("mapDepot/findHomePageMapDepotList.php==============空");
                return false
            }
            var b = "",
                c = "";
            $.each(d.result.data, function (f, h) {
                var g = h.issue.toString();
                var e = g.slice(g.length - 3);
                b += "<li><a href='html/yuctk.html?sue=" + h.issue + "&Pid=" + h.newspaperId + "'><img src='" + url.photoUrl + h.imageA + "' /><span>第" + e + "期 " + h.newspaperName + "</span></a></li>";
                if (f > 5) {
                    c += "<li><a href='html/yuctk.html?issue=" + h.issue + "&Pid=" + h.newspaperId + "'>第" + e + "期 " + h.newspaperName + "</a></li>"
                }
            });
            $(".yctk_more>ul").html(b);
            $(".drawlist>ul").html(c);
            $(".yctk_more").ready(function () {
                Kright = $(".yctk_more>ul>li").length - 6;
                console.log(Kright);
                if (Kright <= 0) {
                    $(".spanlabel>.right").addClass("disabled")
                }
                $(".yctk_more>ul").css({
                    width: $(".yctk_more>ul>li").length * 196 + "px"
                })
            })
        }
    })
}
$(".spanlabel>span").mouseenter(function (a) {
    if ($(this).hasClass("right")) {
        $(this).find("img").attr("src", "img/next_2.png")
    } else {
        if ($(this).hasClass("left")) {
            $(this).find("img").attr("src", "img/prev_2.png")
        }
    }
});
$(".spanlabel>span").mouseleave(function (a) {
    if ($(this).hasClass("right")) {
        $(this).find("img").attr("src", "img/next.png")
    } else {
        if ($(this).hasClass("left")) {
            $(this).find("img").attr("src", "img/prev.png")
        }
    }
});
var liWidth = 196;
var viewCount = 6;
var Klfet = 0,
    Kright = 0,
    leftpx = 0;
$(".spanlabel").on("click", "span:not('.disabled'),span:not('.disabled')>img", function (a) {
    if ($(a.target).attr("class") == "right" || $(a.target).parent().attr("class") == "right") {
        if (Kright >= 6) {
            leftpx += viewCount * liWidth;
            Klfet += viewCount;
            Kright -= viewCount
        } else {
            leftpx += Kright * liWidth;
            Klfet += Kright;
            Kright -= Kright
        }
    } else {
        if ($(a.target).attr("class") == "left" || $(a.target).parent().attr("class") == "left") {
            if (Klfet >= 6) {
                leftpx -= viewCount * liWidth;
                Kright += viewCount;
                Klfet -= viewCount
            } else {
                leftpx -= Klfet * liWidth;
                Kright += Klfet;
                Klfet -= Klfet
            }
            $(".yctk_more>ul").css("left", leftpx + "px")
        }
    } if (Klfet > 0) {
        $(".left").removeClass("disabled")
    } else {
        $(".left").addClass("disabled")
    } if (Kright > 0) {
        $(".right").removeClass("disabled")
    } else {
        $(".right").addClass("disabled")
    }
    $(".yctk_more>ul").css("left", -leftpx + "px")
});
ycFun(nextIssue);
$(".propKinds>li:nth-child(2)").one("click", function () {
    $.ajax({
        type: "get",
        url: url.config140_2 + "smallSix/findChineseZodiac.do",
        async: true,
        dataType: "json",
        success: function (d) {
            console.log(d);
            if (d.result.data == "") {
                return false
            }
            var c = d.result.data.animals.split(",");
            var b = "";
            for (var a = 0; a < c.length; a++) {
                if (a == 0) {
                    b += "<th colspan='3'>" + c[a] + "</th><th class='itemspace' rowspan='3'></th>"
                } else {
                    if (a == 11) {
                        b += "<th colspan='2'>" + c[a] + "</th>"
                    } else {
                        b += "<th colspan='2'>" + c[a] + "</th><th class='itemspace' rowspan='3'></th>"
                    }
                }
            }
            $(".zoodata").html(b)
        }
    });
    console.log("1")
});
$(".propKinds>li:nth-child(3)").one("click", function () {
    $.ajax({
        type: "get",
        url: url.config140_2 + "smallSix/findFiveElements.do",
        async: true,
        dataType: "json",
        success: function (t) {
            console.log(t);
            if (t.result.data == "") {
                return false
            }
            var q = t.result.data.metalNumber.split(","),
                f = t.result.data.woodNumber.split(","),
                j = t.result.data.waterNumber.split(","),
                u = t.result.data.fireNumber.split(","),
                e = t.result.data.earthNumber.split(","),
                a = "",
                b = "",
                o = "",
                k = "",
                n = "",
                c = "",
                s = "",
                p = "",
                g = "",
                d = "";
            var h = "<td></td>";
            for (var r = 0; r < 10; r++) {
                if (r < 5) {
                    a += "<td>" + q[r] + "</td>";
                    b += "<td>" + f[r] + "</td>";
                    o += "<td>" + j[r] + "</td>";
                    k += "<td>" + u[r] + "</td>";
                    n += "<td>" + e[r] + "</td>"
                } else {
                    c += "<td>" + q[r] + "</td>";
                    s += "<td>" + f[r] + "</td>";
                    p += "<td>" + j[r] + "</td>";
                    g += "<td>" + u[r] + "</td>";
                    if (e[r] != undefined) {
                        d += "<td>" + e[r] + "</td>"
                    } else {
                        d += "<td>&nbsp;</td>"
                    }
                }
            }
            var l = "<tr>" + a + h + b + h + o + h + k + h + n + "</tr><tr>" + c + h + s + h + p + h + g + h + d + "</tr>";
            $(".fiveNumber").html(l)
        }
    });
    console.log("1")
});
$(function () {
    $.ajax({
        type: "get",
        url: url.config140_2 + "programa/findDisplay.php",
        async: false,
        dataType: "json",
        success: function (a) {
            if (a.result.data == "") {
                return false
            }
            console.log(a);
            $(".yctj>div>h1").text(a.result.data[0].name).next().find("a").attr("href", "html/news_list.html?" + a.result.data[0].id);
            LanmuFun(a.result.data[0].id, "yctj");
            $(".zjxs>div>h1").text(a.result.data[1].name).next().find("a").attr("href", "html/news_list.html?" + a.result.data[1].id);
            LanmuFun(a.result.data[1].id, "zjxs")
        }
    })
});

function LanmuFun(b, a) {
    $.ajax({
        type: "get",
        url: url.config140_2 + "news/findNewsByPIdForPage.php",
        async: false,
        data: {
            programaId: b,
            pageNo: 1,
            pageSize: 5
        },
        dataType: "json",
        success: function (d) {
            $("." + a + ">ul").html("");
            console.log(d);
            if (d.result.data == "") {
                return false
            }
            var c = "";
            $.each(d.result.data.list, function (e, f) {
                c += "<li> <a href='html/news_detail.html?" + f.newsId + "'>" + f.title + "</a></li>"
            });
            $("." + a + ">ul").html(c)
        }
    })
}
$(".box_third>div>div>span").on("click", "a", function () {
    sessionStorage.setItem("bread_title", $(this).parent().prev().text())
});
$(".box_third").on("click", "div>ul>li>a", function () {
    sessionStorage.setItem("bread_text", $(this).text());
    sessionStorage.setItem("bread_title", $(this).parent().parent().prev().find("h1").text())
});