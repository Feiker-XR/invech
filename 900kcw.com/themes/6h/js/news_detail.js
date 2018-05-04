$(function () {
    var a = window.location.href;
    var b = a.split("?")[1];
    caizhonmethod.loadData(b);
    $(".left").css("min-height", $(".right").height());
    $(".bread_title").text(sessionStorage.getItem("bread_title"));
    $(".bread_text").text(sessionStorage.getItem("bread_text"))
});
var publicurl = config.publicUrl;
var caizhonmethod = {};
var tools = {};
caizhonmethod.loadData = function (b) {
    var a = {
        id: b
    };
    console.log("request:" + JSON.stringify(a));
    $.ajax({
        url: url.config140_2 + "news/findNewsParticularById.php",
        type: "POST",
        data: a,
        success: function (c) {
            caizhonmethod.createEdite(c)
        }, error: function (c) {
            console.log("data error")
        }
    })
};
caizhonmethod.createEdite = function (a) {
    // var a = JSON.parse(a);
    console.log(a);
    if (a.errorCode == "0") {
        a = a.result.data;
        var b = $("#dhguanli_bianji");
        $("#title").text(a.title);
        $("#data").text(a.releaseDate);
        $("#labels").text(a.labels);
        $("#pageView").text(a.pageView);
        $("#content").html(a.content)
    } else {
        alert("数据错误，请稍后重新操作！")
    }
};
tools.ifChecked = function () {
    var a = $("#tbodylist").find(".checkedinput");
    var b = [];
    $(a).each(function (c) {
        if ($(this).is(":checked")) {
            b.push(parseInt($(this).attr("id")))
        }
    });
    return b
};
$(function () {
    $.ajax({
        type: "get",
        url: url.config140_2 + "programa/findDisplay.php",
        async: false,
        dataType: "json",
        success: function (a) {
            console.log(a);
            $(".lanmu1>h3").text(a.result.data[0].name);
            LanmuFun(a.result.data[0].id, "lanmu1");
            $(".lanmu2>h3").text(a.result.data[1].name);
            LanmuFun(a.result.data[1].id, "lanmu2")
        }
    });
    console.log(url.news_adurl);
    $(".news_ad").attr("href", url.news_adurl)
});

function LanmuFun(b, a) {
    $.ajax({
        type: "get",
        url: url.config140_2 + "news/findNewsByPIdForPage.php",
        async: false,
        data: {
            programaId: b,
            pageNo: "",
            pageSize: ""
        },
        dataType: "json",
        success: function (d) {
            console.log(d);
            if (d.result.data == "") {
                return false
            }
            var c = "";
            $.each(d.result.data.list, function (e, f) {
                c += "<li><a href='news_detail.html?" + f.newsId + "'>" + f.title + "</a></li>"
            });
            $("." + a + ">ul").html(c)
        }
    })
};