$(document).ready(function(){

    $(".play_options_choose_header").find($(".edit")).click(function () {
        if($(this).text()=='编辑'){
            $(this).text('正在编辑');
            $(".play_options_choose_main_wp").find("i").show();
            addFn();
            deleteFu();
        }else{
            $(this).text('编辑');
            $(".play_options_choose_main_wp").find("i").hide();
        }
    })
    function addFn() {
        $(".play_options_list_add input").click(function() {
            if($(this).is(".list_options_add")){
                $(this).removeClass("list_options_add");
                $(".my_play_options_list_delete").append($(this).parent($(".play_options_list_add")).clone());
                $('.my_play_options_list_delete').find('i').addClass("icon iconfont icon-guanbi list_options_i");
                $('.my_play_options_list_delete').find("input").addClass("deleteFn");
                $(".my_play_options_list_delete").find("p").click(function(){
                    $(this).remove();
                    $(".play_options_list_add").find("input").addClass("list_options_add");
                });
            }else{

            }
        })
    }
    function deleteFu(){
        $(".my_play_options_list_delete input").click(function () {
            $(this).parent($(".my_play_options_list_delete")).remove()
        })
    }

});
