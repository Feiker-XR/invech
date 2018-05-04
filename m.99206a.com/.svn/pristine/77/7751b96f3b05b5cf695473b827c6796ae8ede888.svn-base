//金融指数js
function gopage(t,go_url)
{
var url=go_url+"?day="+t;
location.href=url;
//选择日期跳转
}



function setbet(typename_in,match_name_in,master_guest_in,touzhuxiang_in,match_id_in,point_in,match_date_in)
{
//typename 上证指数
//match_name 比赛名字（收盘点数）
//master_guest 大VS小
//touzhuxiang_in 投注想  大
//match_id      赛事ID
//match_date_in 封盘时间
//ben_add_in 是否带本金的赔率
if($(parent.leftFrame.document).find("#username").length)
 {   //没有登录
   alert("登录后才能进行此操作");
   return ;
 }
 
   
    $.post("/ajaxleft/jrzs.php",{ball_sort:typename_in,match_id:match_id_in,touzhuxiang:touzhuxiang_in,master_guest:master_guest_in,point:point_in,match_date:match_date_in,rand:Math.random()},function (data){  parent.leftFrame.bet(data); }); 
   
}
