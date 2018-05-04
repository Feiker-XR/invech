$(document).ready(function () {
    $("#j-refresh").on("click", function () {
        $(this).addClass("fa-spin").addClass("fa-2x");
        autoupdate($(this).attr('action'));
    }).mouseover(function () {
        $(this).addClass("fa-2x");
    }).mouseout(function () {
        $(this).removeClass("fa-2x");
    });
});
//更新会员及时信息
function autoupdate(href) {
    $.ajax({
        type: "POST",
        url: href,
        dataType: "json",
        global: false,
        success: function (data) {
            $("#j-refresh").removeClass("fa-spin").removeClass("fa-2x");
            $("#user_sscmoney").html(data.coin);
            $("#user_nickname").html(data.nickname);
            if (data.enable == "0")
            {
                alert("您帐号被冻结，请联系在线客服");
                //document.location.href = "/common/logout";
                return;
            }
        },
        error: null,
        cache: false
    });
}
//_fastData = setInterval(autoupdate, 30000);