// function openHyzx() {
//     windowOpen('<%=basePath%>member/index.html','会员中心', 1250, 834);
// }
// function gotoGrzl() {
//     $("#nav_8").trigger("click");
// }
function showContent(obj) {
    var content = $(obj).data("content");
    var time = $(obj).data("time");
    var name = $(obj).data("name");
    var str = '';
    str += '<h5><span>优惠活动</span><i>×</i></h5>';
    str += '<h2>' + name + '</h2>';
    str += '<div>';
    str += content;
    str += '</div>';
    // str += '<h4>${webName}</h4>';
    str += '<h4>' + time + '</h4>';
    parent.$(".alert_col").html(str);

    parent.$('.alert_col h5 i').click(function(){
        parent.$('.alert').hide();
    })
    parent.$('.alert').show();
}
