$(function() {
    $(window).resize(function(){
        resize();
    });

    resize();

    function resize() {
        var width = $(window).width();
        if (width < 1000) {
            width = 1000;
        }

        var rightHeight = $(".help_l_menu").height();

        var rightHeight = $(window).height() - $(".head").height() - $(".bottom").height();
        if (rightHeight < 672) {
            rightHeight = 672;
        }
        $("body").height($(".top").height() + $(".bottom").height() + rightHeight + "px")
        $("body").width(width + "px");
        $(".helpCont").width(width + "px");
        var leftWidth = $(".help_l_menu").width();
        var rightWidth = width - leftWidth;
        $("#ifm").width(rightWidth);

        $(".help_l_menu").height(rightHeight + "px");
        $("#ifm").height(rightHeight + "px");

        setInterval(function(){
            var time = $("#bjTime").data("time");
            if (isNaN(time) || time < 0) {
                return;
            }
            $("#bjTime").html(Tools.formatDate(time));
            $("#bjTime").data("time", time + 1000);
        }, 1000);
    }

    $("#leftNav li a").click(function() {
        goSubUrl($(this).data("url"));
    });

    layer.ready(function() {
        goSubPage();
    });
});

function goSubUrl(url) {
    window.location.href = CONFIG.BASEURL + "user/index.html#" + url;
    goSubPage();
}

function goSubPage() {
    showLoading();

    var subPageUrl = Tools.getSubUrlFromSurl(window.location.toString());
    if (!subPageUrl) {
        subPageUrl = CONFIG.BASEURL + "user/main.html";
    }
    $("#ifm").attr("src", subPageUrl);
    $("#leftNav li a.sli").removeClass("sli");
    $("#leftNav li a.eveb_nav_hover").removeClass("eveb_nav_hover");

    $("#leftNav li a").each(function() {
        var tmpUrl_1 = Tools.getUrlNoParams($(this).data("url"));
        var tmpUrl_2 = Tools.getUrlNoParams(subPageUrl);
        if (tmpUrl_1 == tmpUrl_2) {
            $(this).addClass("sli eveb_nav_hover");
            return false;
        }
    });
}

function showLoading() {
    layer.load(2, {
        shade: [0.1,'#000'] //0.1透明度的白色背景
    })
}

function hideLoading() {
    layer.ready(function() {
        layer.closeAll();
    });
}