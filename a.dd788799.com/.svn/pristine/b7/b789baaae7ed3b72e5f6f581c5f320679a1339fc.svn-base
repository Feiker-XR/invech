$(function(){
    var env = "!test";
    if(env != 'test'){
        return
    }
    setTimeout(function () {
        $('#tabbar-div-s2>span').eq(1).click();     //点击五星

        setTimeout(function () {
            handleFuShi();
            setTimeout(function () {
                $('#lt_bet_immediate').click(); // 一键投注
            },1000)
        },1000)

    },1500)






    function _changeTab(main,sub){
        $('#tabbar-div-s2>span').eq(main).click()
    }

    function handleFuShi(){
        $('#lt_selector .pp').each(function (index,value) {
            var _random = Math.floor(Math.random()*10);
            $(value).find('input').eq(_random).click();
        })
    }

})