$(function () {
    // /**
    //  *  提交
    //  */
    // $(".submit").click(function () {
    //     var nickName=$("#nickName").val(),
    //         linkNumber=$("#linkNumber").val(),
    //         fedBack=$("#fedBack").val();
    //     if(nickName.length==0 || linkNumber.length==0 || fedBack.length==0){
    //         alert('请认真填写意见反馈哟！');
    //         return false;
    //     }else{
    //         $(".inputbody_one").hide();
    //         $(".displaynone").show();
    //     }
    // })
    // /**
    //  *  返回首页
    //  */
    // $(".back_response").click(function () {
    //     console.log("....")
    //     window.location.href="index.html";
    //     $(".displaynone").hide();
    //     $(".inputbody_one").show();
    //     $("#backbnt").removeClass("back_response");
    // })
    $(".inputbody").on("touchstart", ".submit", function() {
        method.submitData();
    });
    // 返回
    $("#backbnt").on("touchstart", function() {
        //window.history.go(-1);
        window.location.href="index.html";
    });
})
var method = {};
method.submitData = function() {
    //禁止重复提交
    if($("#submit").text() != "提交") {
        return;
    }
    var flag = false;
    $("input,textarea[class=reqired]").each(function() {
        if($(this).val() == "") {
            $(this).css({ border: "1px solid red" });
            $(this).attr("placeholder", "该项不能为空");
            flag = true;
        } else {
            $(this).css({ border: "1px solid #dbdbdb" });
            if($(this).attr("id")=="linkNumber") {
                if(!tools.noChinesFont($(this).val())) {
                    $(this).css({ border: "1px solid red" });
                    $(this).val("");
                    $(this).attr("placeholder", "该项不能有中文");
                    flag = true;
                }
            }
        }
    });
    //表单验证没有通过就返回
    if(flag) {
        return;
    }
    var nickName = $("#nickName").val();
    var linkNumber = $("#linkNumber").val();
    var fedBack = $("#fedBack").val();
    var data = {
        "nickName": nickName,
        "linkType": "0",
        "linkNumber": linkNumber,
        "fedBack": fedBack
    };
    // $.ajax({
    //     url: config.publicUrl + "fedBack/saveFedBack.do",
    //     type: "post",
    //     data: data,
    //     beforeSend: function() {
    //         $("#submit").text("正在提交...");
    //     },
    //     success: function(data) {
            //执行数据请求
            var res_data={
                status:1,
                result:{
                    businessCode:0,
                }
            }
            if(res_data.status==1){
                method.createList(res_data);
            }
    //     },
    //     error: function(data) {
    //         alert("提交失败，请稍后再试！")
    //         $("#submit").text("提交");
    //     }
    // });
}
method.createList = function(data) {
    var data = tools.parseObj(data);
    if(data.result.businessCode == 0) {
        $("#inputbox").hide("200");
        $("#success").show("200");
    } else {
        alert("提交失败，请稍后再试！");
        $("#submit").text("提交");
    }
}