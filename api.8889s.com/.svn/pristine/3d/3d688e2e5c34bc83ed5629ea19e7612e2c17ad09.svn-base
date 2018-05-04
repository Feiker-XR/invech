//返回全部倍率金额和返点数
function getAllPlAndMaxFd() {
    return gfwfPlJson.sscPlayPlList;
}

$(function () {
    //官方玩法
    $(".Playmethod ul li span").click(function () {

        var name_flag = $(this).parent().data('name');
        if (name_flag == 'gfwf') {
            var flag_acti = $(this).parent().parent().next().find('b').hasClass('acti');
            if (flag_acti == true) {
                $(this).parent().parent().next().find('b').removeClass('acti');
            }
            $(this).parent().parent().find('b').addClass('acti');
            $(".left_it0").show();
            $(".right_it1").show();
            $(".Detailedlist").show();

        } else {
            var flag_acti = $(this).parent().parent().prev().find("b").hasClass('acti');
            if (flag_acti == true) {
                $(this).parent().parent().prev().find("b").removeClass('acti');
            }
            $(this).parent().parent().find('b').addClass('acti');
            $(".left_it0").hide();
            $(".right_it1").hide();
            $(".Detailedlist").hide();
        }

        if(playGroupId == 23 || playGroupId == 9){
            getOpenCodeHistory();
        }

    });


    // $(".btn-cgwf").click(function(){
    //     var flagFT_cg = $(".gf-cgwf").hasClass("hide_flag");
    //     var flagFT_rx = $(".gf-rxwf").hasClass("hide_flag");
    //     if(flagFT_cg){
    //         $(".gf-cgwf").removeClass("hide_flag");
    //     }
    //     if(!flagFT_rx){
    //         $(".gf-rxwf").addClass("hide_flag");
    //     }
    //     $(".Single .layout  .Playmethod ul li.gf-li p span:first-child").addClass("acti");
    // });
    // $(".btn-rxwf").click(function(){
    //     var flagFT_cg = $(".gf-cgwf").hasClass("hide_flag");
    //     var flagFT_rx = $(".gf-rxwf").hasClass("hide_flag");
    //     if(!flagFT_cg){
    //         $(".gf-cgwf").addClass("hide_flag");
    //     }
    //     if(flagFT_rx){
    //         $(".gf-rxwf").removeClass("hide_flag");
    //     }
    //     $(".Single .layout  .Playmethod ul li.gf-li p span.rx2-span").addClass("acti");
    // });
});

// //加倍数 或 重新选钱时改变当前显示注数金额状态
// function changeStateCommon(){
//     var zhushu = $('.p1 .i0').html();
//     if(zhushu == null || typeof zhushu == "undefined"){
//         zhushu = 0;
//     }else{
//         zhushu = parseInt(zhushu);
//     }
//     $('.p1 .i_beishu').html($("#inputBeishu").val());
//     var strFd = $(".fandian-bfb").html();
//     var num = parseFloat(strFd.toString().substr(0,strFd.length-1)) / 100;
//     var totalMoney = parseFloat($("#inputBeishu").data("beishu")) * zhushu * parseFloat($("#inputMoney").data("money"));
//     var p1_i2 = totalMoney * num;
//     if(isNaN(p1_i2) || p1_i2 == 0){
//         $('.p1 .i_fanD').html(0);
//     } else {
//         $('.p1 .i_fanD').html(p1_i2.toFixed(2));
//     }
//     if(parseInt(totalMoney) == 0){
//         $('.p1 .i_money').html(0);
//     } else{
//         $('.p1 .i_money').html(parseFloat(totalMoney).toFixed(2));
//     }
//
// }

// 数字批量选择算法
function selectFun_1(obj) {
    $(obj).parent().find(".acti").removeClass("acti");
    $(obj).addClass("acti");

    var objArr = $(obj).parent().parent().find("span");
    objArr.each(function () {
        $(this).removeClass("acti");
        var num = parseInt($(this).find("i").html());
        if ($.inArray(num, [0, 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11]) >= 0) {
            $(this).addClass("acti");
        }
    });

    var objName = $(obj).parent().parent().parent().find("li").eq(0).find(".numLines").attr('class');
    var maName = '';
    if(typeof objName != 'undefined'){
        maName = objName.split(' ')[1];
        var objBtn = getCommonObj(obj, maName);
        var btnFlag = "quan";
        changeActi(btnFlag, objBtn);
    }

    renderZhushu();
}


function selectFun_2(obj) {
    $(obj).parent().find(".acti").removeClass("acti");
    $(obj).addClass("acti");

    var objArr = $(obj).parent().parent().find("span");
    objArr.each(function () {
        $(this).removeClass("acti");
        var num = parseInt($(this).find("i").html());
        if ($.inArray(num, [5, 6, 7, 8, 9,10]) >= 0) {
            $(this).addClass("acti");
        }
    });
    renderZhushu();
}

// 以一开头的的数字大小
function selectFun_str2(obj) {
    $(obj).parent().find(".acti").removeClass("acti");
    $(obj).addClass("acti");

    var objArr = $(obj).parent().parent().find("span");
    objArr.each(function () {
        $(this).removeClass("acti");
        var num = parseInt($(this).find("i").html());
        if ($.inArray(num, [6, 7, 8, 9, 10,11]) >= 0) {
            $(this).addClass("acti");
        }
    });

    var objName = $(obj).parent().parent().parent().find("li").eq(0).find(".numLines").attr('class');
    var maName = '';
    if(typeof objName != 'undefined'){
        maName = objName.split(' ')[1];
        var objBtn = getCommonObj(obj, maName);
        var btnFlag = "da";
        changeActi(btnFlag, objBtn);
    }

    renderZhushu();
}




function selectFun_3(obj) {
    $(obj).parent().find(".acti").removeClass("acti");
    $(obj).addClass("acti");

    var objArr = $(obj).parent().parent().find("span");
    objArr.each(function () {
        $(this).removeClass("acti");
        var num = parseInt($(this).find("i").html());
        if ($.inArray(num, [0, 1, 2, 3, 4]) >= 0) {
            $(this).addClass("acti");
        }
    });
    renderZhushu();
}

// 以一开头的的数字大小
function selectFun_str3(obj) {
    $(obj).parent().find(".acti").removeClass("acti");
    $(obj).addClass("acti");

    var objArr = $(obj).parent().parent().find("span");
    objArr.each(function () {
        $(this).removeClass("acti");
        var num = parseInt($(this).find("i").html());
        if ($.inArray(num, [1, 2, 3, 4, 5]) >= 0) {
            $(this).addClass("acti");
        }
    });
    var objName = $(obj).parent().parent().parent().find("li").eq(0).find(".numLines").attr('class');
    var maName = '';
    if(typeof objName != 'undefined'){
        maName = objName.split(' ')[1];
        var objBtn = getCommonObj(obj, maName);
        var btnFlag = "xiao";
        changeActi(btnFlag, objBtn);
    }

    renderZhushu();

}

function selectFun_4(obj) {
    $(obj).parent().find(".acti").removeClass("acti");
    $(obj).addClass("acti");

    var objArr = $(obj).parent().parent().find("span");
    objArr.each(function () {
        $(this).removeClass("acti");
        var num = parseInt($(this).find("i").html());
        if ($.inArray(num, [1, 3, 5, 7, 9,11]) >= 0) {
            $(this).addClass("acti");
        }
    });
    var objName = $(obj).parent().parent().parent().find("li").eq(0).find(".numLines").attr('class');
    var maName = '';
    if(typeof objName != 'undefined'){
        maName = objName.split(' ')[1];
        var objBtn = getCommonObj(obj, maName);
        var btnFlag = "qi";
        changeActi(btnFlag, objBtn);
    }

    renderZhushu();
}

function selectFun_5(obj) {
    $(obj).parent().find(".acti").removeClass("acti");
    $(obj).addClass("acti");

    var objArr = $(obj).parent().parent().find("span");
    objArr.each(function () {
        $(this).removeClass("acti");
        var num = parseInt($(this).find("i").html());
        if ($.inArray(num, [0, 2, 4, 6, 8, 10]) >= 0) {
            $(this).addClass("acti");
        }
    });

    var objName = $(obj).parent().parent().parent().find("li").eq(0).find(".numLines").attr('class');
    var maName = '';
    if(typeof objName != 'undefined'){
        maName = objName.split(' ')[1];
        var objBtn = getCommonObj(obj, maName);
        var btnFlag = "ou";
        changeActi(btnFlag, objBtn);
    }

    renderZhushu();
}


function selectFun_6(obj) {
    $(obj).parent().parent().find(".acti").removeClass("acti");
    $(obj).addClass("acti");
    clearStateTouZhu();//清除投注状态栏

}

// 获取当前胆码的对象
function getCommonObj(obj, maName){
    var objBtn = $(obj).parent().parent().parent().find("."+ maName +" span").eq(0);
    return objBtn;
}

//去掉被选中号数
function changeActi(btnFlag, obj){

    var flagNameDtsm = $(obj).parent().parent().parent().find('li .numLines').hasClass('danma_selected');
    var flagNameDtem = $(obj).parent().parent().parent().find('li .numLines').hasClass('em_danma_selected');
    var flagNameDtsim = $(obj).parent().parent().parent().find('li .numLines').hasClass('sim_danma_selected');
    var flagNameDtwm = $(obj).parent().parent().parent().find('li .numLines').hasClass('wm_danma_selected');
    var flagNameDtlm = $(obj).parent().parent().parent().find('li .numLines').hasClass('lm_danma_selected');
    var flagNameDtqm = $(obj).parent().parent().parent().find('li .numLines').hasClass('qm_danma_selected');
    var flagNameDtbm = $(obj).parent().parent().parent().find('li .numLines').hasClass('bm_danma_selected');
    var danMaStr = '';

    if(flagNameDtsm){
        danMaStr = 'danma3';
        delActi(btnFlag, obj, danMaStr);
    } else if(flagNameDtem){
        danMaStr = 'danma2';
        delActi(btnFlag, obj, danMaStr);
    } else if(flagNameDtsim){
        danMaStr = 'danma4';
        delActi(btnFlag, obj, danMaStr);
    } else if(flagNameDtwm){
        danMaStr = 'danma5';
        delActi(btnFlag, obj, danMaStr);
    } else if(flagNameDtlm){
        danMaStr = 'danma6';
        delActi(btnFlag, obj, danMaStr);
    } else if(flagNameDtqm){
        danMaStr = 'danma7';
        delActi(btnFlag, obj, danMaStr);
    } else if(flagNameDtbm){
        danMaStr = 'danma8';
        delActi(btnFlag, obj, danMaStr);
    }
}


function delActi(btnFlag, obj, danMaStr){
    if(btnFlag == "quan"){
        for(var i = 1; i < 12; i++){
            delDanmActiClass(i, obj);
        }
    } else if(btnFlag == "da"){
        var daArr = [6, 7, 8, 9, 10, 11];
        for(var n = 0; n < daArr.length; n++){
            delDanmActiClass(daArr[n], obj);
            minusDanmaNum(getDanMaArr(danMaStr), daArr[n]);
        }
    } else if(btnFlag == "xiao"){
        var xiaoArr = [1, 2, 3, 4, 5];
        for(var m = 0; m < xiaoArr.length; m++){
            delDanmActiClass(xiaoArr[m], obj);
            minusDanmaNum(getDanMaArr(danMaStr), xiaoArr[m]);
        }
    }  else if(btnFlag == "ou"){
        var ouArr = [2, 4, 6, 8, 10];
        for(var y = 0; y < ouArr.length; y++){
            delDanmActiClass(ouArr[y], obj);
            minusDanmaNum(getDanMaArr(danMaStr), ouArr[y]);
        }
    }  else if(btnFlag == "qi"){
        var qiArr = [1, 3, 5, 7, 9, 11];
        for(var x = 0; x < qiArr.length; x++){
            delDanmActiClass(qiArr[x], obj);
            minusDanmaNum(getDanMaArr(danMaStr), qiArr[x]);
        }
    }


    var sumSelectedTuodan = $(obj).parent().find("span.acti").length;
    if(sumSelectedTuodan <= 0){
        initArrNum();
    }
}

function getDanMaArr(danMaStr){
    var objArr = null;
    if(danMaStr == 'danma3'){
        objArr = arrNum3;
    } else if(danMaStr == 'danma2'){
        objArr = arrNum2;
    } else if(danMaStr == 'danma4'){
        objArr = arrNum4;
    } else if(danMaStr == 'danma5'){
        objArr = arrNum5;
    } else if(danMaStr == 'danma6'){
        objArr = arrNum6;
    } else if(danMaStr == 'danma7'){
        objArr = arrNum7;
    } else if(danMaStr == 'danma8'){
        objArr = arrNum8;
    }
    return objArr;
}

//去掉胆码选中样式
function delDanmActiClass(x, obj){
    $(obj).parent().parent().parent().parent().find(".danma_selected span.n" + x + ".acti").removeClass('acti');
    $(obj).parent().parent().parent().parent().find(".em_danma_selected span.n" + x + ".acti").removeClass('acti');
    $(obj).parent().parent().parent().parent().find(".sim_danma_selected span.n" + x + ".acti").removeClass('acti');
    $(obj).parent().parent().parent().parent().find(".wm_danma_selected span.n" + x + ".acti").removeClass('acti');
    $(obj).parent().parent().parent().parent().find(".lm_danma_selected span.n" + x + ".acti").removeClass('acti');
    $(obj).parent().parent().parent().parent().find(".qm_danma_selected span.n" + x + ".acti").removeClass('acti');
    $(obj).parent().parent().parent().parent().find(".bm_danma_selected span.n" + x + ".acti").removeClass('acti');
}

//删除重复号码
function delRrepet(obj) {
    var xObj = $(obj).parent().parent().parent();
    var textStr = $(xObj).find(".content_tex").val();
    var newArr = [], repeatArr = [], tempArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0) {
            newArr.push(arr_new[i]);
        }
    }

    repeatArr = newArr.duplicateNew().uniqueArr();
    tempArr = newArr.uniqueArr();

    if (repeatArr.length <= 0) {
        alert("无重复号码！");
    } else {
        alert("已删除掉重复号: " + repeatArr.join(" "));
        $(".content_jiang .content_tex").val(tempArr.join(" "));
    }
    //重新计算注数
    renderZhushu();
}


//删除重复号码
function delRepetSsq(obj) {
    var arrNewRepet = []; //新的重复数组
    var newArrTemp = [];
    var newArrTempStr = [];
    var newArrTempReturn = [];
    var noSyhFlag = false; //无双引号注数
    var xObj = $(obj).parent().parent().parent();
    var textStr = $(xObj).find(".content_tex").val();
    var newArr = [], repeatArr = [], tempArr = [];
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,' ',:,：]/g, ','));
    var newArr = textStr.split(",");

    for (var n = 0; n < newArr.length; n++) {
        var newStr = '';
        var temp = newArr[n].toString();
        var tempStr = null;
        if(temp.indexOf(':') >= 0){
            tempStr = (newArr[n].toString()).split(':');
            noSyhFlag = true;
        } else if(temp.indexOf('：') >= 0) {
            tempStr = (newArr[n].toString()).split('：');
            noSyhFlag = true;
        } else {
            //没有冒号注数
            tempStr = newArr[n].toString();
            noSyhFlag = false;
        }

        var tempStrArr = (tempStr.toString()).split(' ');
        for(var i = 0; i < tempStrArr.length; i++){
            newArrTemp.push(parseInt(tempStrArr[i]));
        }

        var newAT = newArrTemp.sort(function(a,b){return a-b;});
        newArrTempStr.push();

        for(var m = 0; m < newAT.length; m++){
            if(m == newAT.length - 1){
                newStr += (getMinStr(parseInt(newAT[m])));
            } else {
                newStr += (getMinStr(parseInt(newAT[m])) + ' ');
            }
        }
        if(noSyhFlag){
            newStr += (":" + tempStr[1]);
        }
        arrNewRepet.push(newStr); //处理过的重复数组数据

        newArrTemp.splice(0,newArrTemp.length); //清掉数组数据(初始化)
    }

    repeatArr = arrNewRepet.duplicateNew();
    tempArr = arrNewRepet.uniqueArr();

    if (repeatArr.length <= 0) {
        alert("无重复号码！");
    } else {
        alert("已删除掉重复号: " + repeatArr.join(" "));
        $(".content_jiang .content_tex").val(tempArr.join("；"));
    }
    //重新计算注数
    renderZhushu();
}

//获取小于10的带“0”号
function getMinStr(num){
    var strNum ='';
    if(num < 10){
        strNum = "0" + num;
    } else {
        strNum = num;
    }
    return strNum;
}

//后三组选-组三复式
function getZuXuanNewArrs(zuXuanArr) {
    var tempArr = [], zxArr = [];
    zxArr = zuXuanArr;

    for (var i = 0; i < zxArr.length - 1; i++) {
        for (var i1 = 1; i1 < zxArr.length; i1++) {
            if (zxArr[i1] != zxArr[i]) {
                tempArr.push(zxArr[i] + "" + zxArr[i1] + "" + zxArr[i1]);
                tempArr.push(zxArr[i1] + "" + zxArr[i] + "" + zxArr[i]);
            }
        }
    }
    tempArr = tempArr.uniqueArr();
    return tempArr;
}


//后三组选-组选包胆
function getZxbdNewArrs(zuXuanArr) {
    var tempArr = [], bdArr = [];
    bdArr = zuXuanArr;
    for (var n = 0; n < bdArr.length; n++) {
        for (var n1 = 0; n1 < 10; n1++) {
            for (var n2 = 0; n2 < 10; n2++) {
                if (bdArr[n] != n1 && bdArr != n2 && n1 != n2 || n1 == n2 && bdArr[n] != n2 || n2 == bdArr[n] && bdArr[n] != n1 || n1 == bdArr[n] && bdArr[n] != n2) {
                    var sortArr = [];
                    sortArr.push(bdArr[n]);
                    sortArr.push(n1);
                    sortArr.push(n2);
                    sortArr.sort();
                    tempArr.push(sortArr.join(""));
                }
            }
        }
    }

    tempArr = tempArr.uniqueArr();
    return tempArr;
}

//后三组选-组六复式
function getZuLiuNewArrs(zuXuanArr) {
    var tempArr = [], zxArr = [];
    zxArr = zuXuanArr;
    for (var i = 0; i < zxArr.length; i++) {
        for (var i1 = 0; i1 < zxArr.length; i1++) {
            for (var i2 = 0; i2 < zxArr.length; i2++) {
                if (zxArr[i] != zxArr[i1] && zxArr[i1] != zxArr[i2] && zxArr[i] != zxArr[i2]) {
                    var sortArr = [];
                    sortArr.push(zxArr[i]);
                    sortArr.push(zxArr[i1]);
                    sortArr.push(zxArr[i2]);
                    sortArr.sort();
                    tempArr.push(sortArr.join(""));
                }
            }
        }
    }
    tempArr = tempArr.uniqueArr();
    return tempArr;
}

//后三组选-组选和值
function getZxhzNewArrs(zuXuanArr) {
    var heZhiArr = [], tempArr = [];
    var sumTemp = 0;
    var num = 0; //当前号码
    var fjHaoZuhe = []; //分解号组合

    heZhiArr = zuXuanArr;
    //号码分解---所选号分解成所有组合的值等于此号的所有组合
    for (var i = 0; i < heZhiArr.length; i++) {
        var temp = [];
        sumTemp = parseInt(heZhiArr[i]);
        num = parseInt(heZhiArr[i]);
        while (sumTemp >= 0) {
            temp.push(sumTemp);
            sumTemp--;
        }

        //获取所选号的组选三和组选六形态的所有组数（不包含豹子号、顺序不限）
        for (var n = 0; n < temp.length; n++) {
            for (var m = 0; m < temp.length; m++) {
                for (var mn = 0; mn < temp.length; mn++) {
                    if (temp[n] + temp[m] + temp[mn] == num && temp[mn] <= 9 && temp[m] <= 9 && temp[n] <= 9) {
                        if (temp[m] != temp[n] && temp[n] != temp[mn] && temp[mn] != temp[n]) {
                            var sortArr = [];
                            sortArr.push(temp[n]);
                            sortArr.push(temp[m]);
                            sortArr.push(temp[mn]);
                            sortArr.sort();
                            fjHaoZuhe.push(sortArr.join(""));

                        }
                    }
                }
            }
        }

    }
    tempArr = fjHaoZuhe.uniqueArr();
    return tempArr;
}

// 后三直选-跨度所选跨度值所有组合
function getKaduNewArrs(kDArr) {
    var kaDuArr = [], tempArr1 = [], tempArr2 = [], tempArr3 = [];
    var allArr = [];
    for (var t = 0; t < 10; t++) {
        tempArr1[t] = t;
        tempArr2[t] = t;
        tempArr3[t] = t;
    }
    var maxZhi = 0, minZhi = 0, tempZhi = 0;
    kaDuArr = kDArr;
    for (var i = 0; i < kaDuArr.length; i++) {
        tempZhi = parseInt(kaDuArr[i]);
        for (var n = 0; n < tempArr1.length; n++) {
            for (var n1 = 0; n1 < tempArr2.length; n1++) {
                for (var n2 = 0; n2 < tempArr3.length; n2++) {
                    maxZhi = tempArr1[n] > tempArr2[n1] ? tempArr1[n] : tempArr2[n1];
                    maxZhi = maxZhi > tempArr3[n2] ? maxZhi : tempArr3[n2];
                    minZhi = tempArr1[n] < tempArr2[n1] ? tempArr1[n] : tempArr2[n1];
                    minZhi = minZhi < tempArr3[n2] ? minZhi : tempArr3[n2];
                    if ((maxZhi - minZhi) == tempZhi) {
                        allArr.push(n + "" + n1 + "" + n2);
                        maxZhi = 0;
                        minZhi = 0;
                    }
                }
            }
        }
    }
    return allArr;
}

//后三直选--获取所选号码分散为三位所有组合的和值
function getHezNewArrs(hZArr) {
    var heZhiArr = [], shuArr = [], tempArr = [];
    var sumTemp = 0;
    var num = 0; //当前号码
    var fjHaoZuhe = []; //分解号组合

    heZhiArr = hZArr;

    //号码分解---所选号分解成所有组合的值等于此号的所有组合
    for (var i = 0; i < heZhiArr.length; i++) {
        var temp = [];
        sumTemp = parseInt(heZhiArr[i]);
        num = parseInt(heZhiArr[i]);
        while (sumTemp >= 0) {
            temp.push(sumTemp);
            sumTemp--;
        }

        //所选号码分解至零，被分解出所有的号码三个为一组，所组成的所有组合的每一组值等于所选号的值的组合数
        for (var n = 0; n < temp.length; n++) {
            for (var m = 0; m < temp.length; m++) {
                for (var mn = 0; mn < temp.length; mn++) {
                    if (temp[n] + temp[m] + temp[mn] == num && temp[mn] <= 9 && temp[m] <= 9 && temp[n] <= 9) {
                        fjHaoZuhe.push(temp[n] + "" + temp[m] + "" + temp[mn]);
                    }
                }
            }
        }
        tempArr = fjHaoZuhe.uniqueArr();
    }
    return tempArr;
}

// 获取百、十、个固定位数的个数所组成3位所有组合
function getThreeNewArrs(baiA, shiA, geA) {
    var bArr = [], sArr = [], gArr = [];
    bArr = baiA;
    sArr = shiA;
    gArr = geA;
    var tempArr = [];
    for (var b = 0; b < bArr.length; b++) {
        for (var s = 0; s < sArr.length; s++) {
            for (var g = 0; g < gArr.length; g++) {
                tempArr.push(bArr[b] + "" + sArr[s] + "" + gArr[g]);
            }
        }
    }
    return tempArr;
}

var tmpBetContent = null;
function buyBtn() {
    var len = $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").length;
    var totalM = 0;
    if (len > 0) {
        showloadTxtTemplate();

        var flagsp = $('.clearLiZhudanbtn').attr('sp');
        if (flagsp == 1) {
            var nameF = '';
            var num = selectedZhqishu();
            var moneyValTb = $('.zhzjetxt').html(); //同倍追号总金额值
            var moneyValFb = $('.zhfbzjetxt').html(); //翻倍追号总金额值

                $('.reBetting .tabs ul li').each(function () {
                var ft = $(this).hasClass('acti');
                if (ft) {
                    nameF = $(this).attr('data-opertype');
                }
            });

            $('.tzTishiTemplate').find('.qiTishi').html("确定要追号" + num + "期？");
            if (nameF == 'tbzh') {
                $('.tzTishiTemplate').find('.total-money').html(moneyValTb);
                totalM = moneyValTb;
            } else if(nameF == 'fbzh') {
                $('.tzTishiTemplate').find('.total-money').html(moneyValFb);
                totalM = moneyValFb;
            }
        } else {
            totalM = $("#zongtouInfo .totalM").html();
            $(".total-money").html(totalM);
        }

        $(".tzTishiTemplate").parent().parent().css({
            "border": "6px solid #ccc",
            "border-radius": "8px",
            "top": "80px"
        });
        $("#block_close").click(function () {
            if (layerInfo != null) {
                layer.close(layerInfo);
                layerInfo = null;
            }
        });

        //投注内容显示处理
        $(".tzTishiTemplate .content-table tr:not(.head-tr)").each(function () {
            var strNr = $(this).find("td:eq(1)").html();
            $(this).find("td:eq(1)").html(strNr);
        });

        //投注内容模板
        var htmlStr = addContent();
        $(".tzTishiTemplate .content-table .head-tr").after(htmlStr);

        $(".qihao").html(getNumber());

        // 注单内容
        var betForm = {
            totalMoney: 0,
            totalZhushu: 0,
            isZhuihao : flagsp,
            sscBetList: [],
            sscBetZhList: []
        };

        $("#zhudanList .re_touzhu_tem").each(function () {
            betForm.sscBetList.push({
                playGroupId: $(this).data("bet_play_group_id"),
                number: getNumber(),
                playId: $(this).data("bet_play_id"),
                zhushu: $(this).data("bet_zhushu"),
                perMoney: $(this).data("bet_per_money"),
                content: $(this).data("bet_content"),
                playPlId: $(this).data("bet_play_pl_id"),
                playPl: $(this).data("bet_play_pl"),
                beishu: $(this).data("bet_beishu"),
                totalMoney: $(this).data("bet_total_money"),
                type: 2,
                mode: $(this).data("bet_mode"),
                fandian: $(this).data("bet_fandian")
            });

            betForm.totalMoney += parseFloat($(this).data("bet_total_money"));
            betForm.totalZhushu += $(this).data("bet_zhushu");
        });
        //追号
        var money = 0;
        var zs = 0;
        if (betForm.isZhuihao == 1) {

            $('.reBetting .tabs ul li').each(function () {
                var ft = $(this).hasClass('acti');
                if (ft) {
                    nameF = $(this).attr('data-opertype');
                }
            })

            if (nameF == 'tbzh') {
                $(".list_wrap_zh .tbulzh .checkbox_selected").each(function () {
                    betForm.sscBetZhList.push({
                        number: $(this).children(".content_qs").text(),
                        beishu: $(this).children(".nosel").children('input[type="text"]').val()
                    });
                    var bei = $(this).children(".nosel").children('input[type="text"]').val();
                    zs += betForm.totalZhushu;
                });
            } else if (nameF == 'fbzh') {
                $(".list_wrap_zh .fbulzh .checkbox_selected").each(function () {
                    betForm.sscBetZhList.push({
                        number: $(this).children(".content_qs").text(),
                        beishu: $(this).children(".nosel").children('input[type="text"]').val()
                    });
                    var bei = $(this).children(".nosel").children('input[type="text"]').val();
                    zs += betForm.totalZhushu;
                });
            }

            betForm.totalMoney = parseFloat(totalM);
            betForm.totalZhushu = zs;
        }

        betForm.totalMoney = (betForm.totalMoney).toFixed(3);
        betForm = JSON.stringify(betForm);
        // 解决双引号冲突
        tmpBetContent = betForm;

        // 确定按钮
        $("#gfwfBetForm_submit").click(function () {
            sureGfwtXz(tmpBetContent);
            //清除追号模板
            var flag = $(".clearLiZhudanbtn").attr('sp');
            if(flag == 1){
                zhTempletHideOrShow();
            }
            //清除弹框layerInfo
            cancel();
        });
    } else {
        showTishi2Template();
    }
}

function sureGfwtXz(betForm) {
    ajaxRequest({
        url: CONFIG.BASEURL + "ssc/ajaxBet.json",
        data: {
            betForm: betForm
        },
        beforeSend: function () {
            layer.closeAll();
            parent.showLoading();
        },
        success: function (json) {
            parent.hideLoading();
            if (json.result == 1) {
                // 清空临时变量
                tmpBetContent = null;
                layer.msg("下注成功", {icon: 1});
                // 刷新我的投注
                getBetDetails();
                // 刷新余额
                parent.getUserSession();
                // 重置预投注
                clearContent();
            } else {
                layer.msg("下注失败：" + json.description, {icon: 2});
            }
        },
        complete: function () {
        }
    });
}

function cancel() {
    if (layerInfo != null) {
        layer.close(layerInfo);
        layerInfo = null;
    }
}

var layerInfo = null;
var layerTishi1 = null;
var layerTishi2 = null;
var layerInfoInsert = null;

//投注信息框
function showloadTxtTemplate() {
    if (layerInfo != null) {
        return;
    }
    var loadTxt_template = '\
    <div class="tzTishiTemplate">\
        <h3>温馨提示</h3>\
        <span id="block_close"></span>\
        <table style="width: 100%">\
             <tobody>\
                 <tr>\
                     <td>\
                        <h4>\
                              <i class="imgTishi"></i>\
                              <sapn class="qiTishi">您确定加入 <var class="qihao"></var> 期？</span>\
                        </h4>\
                        <div class="tz-data">\
                             <table class="content-table" style="border: 0; width: 100%;">\
                                   <tobody>\
                                      <tr class="head-tr">\
                                         <td width="110">玩法</td>\
                                         <td width="180">内容</td>\
                                         <td width="80">注数</td>\
                                         <td width="40">每注</td>\
                                         <td width="30">模式</td>\
                                         <td width="40">倍数</td>\
                                         <td >金额</td>\
                                      </tr>\
                                      <span class="content-td">\
                                      </span>\
                                   </tobody>\
                             </table>\
                        </div>\
                        <div class="binfo">\
                            <span class="bbm">\
                               投注总金额: <span class="total-money">2</span> 元\
                            </span>\
                        </div>\
                      </td>\
                 </tr>\
                 <tr>\
                    <td class="btns">\
                        <input type="hidden" id="gfwfBetForm_input">\
                        <button type="button" id="gfwfBetForm_submit">确定</button>\
                        <button type="button" onclick="cancel()">取消</button>\
                    </td>\
                  </tr>\
             </tobody>\
        </table>\
    </div>\
    ';

    layer.closeAll();
    //页面层
    layerInfo = layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        area: ['615px', '428px'], //宽高1
        content: loadTxt_template
    });
}


//导入文本信息框
function showloadTxtTemplate1() {
    if (layerInfoInsert != null) {
        return;
    }
    var tiShi_template = '\
    <div class="tzTishiTemplate del-Tishi tzInsertTemplate">\
        <h3>文件载入</h3>\
        <span id="block_close"></span>\
        <table style="width: 100%">\
             <tobody>\
                 <tr>\
                     <td>\
                        <h4>\
                              <span class="txtinfo">请选择你要载入的文件</span>\
                        </h4>\
                        <h4 class="txt-select">\
                              <input type="file" id="file" name="file" size="30" value="未选择任何文件">\
                              <span class="errorTxt"></span>\
                        </h4>\
                     </td>\
                 </tr>\
                 <tr>\
                    <td class="btns">\
                        <button type="button" onclick="ajaxSubmit()">导入文件</button>\
                    </td>\
                  </tr>\
             </tobody>\
        </table>\
    </div>\
    ';

    //页面层
    layerInfoInsert = layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        area: ['536px', '256px'], //宽高
        content: tiShi_template
    });

    $(".tzInsertTemplate").parent().parent().css({"border": "6px solid #ccc", "border-radius": "8px"});
    $("#block_close").click(function () {
        closeLayerInsert();
    });
}
var removeSpan = "";
function ajaxSubmit() {
    if (typeof(FileReader) == "undefined") {
        alert("你的浏览器不支持文件读取");
        return;
    }
    var file = document.getElementById("file").files[0];
    if (typeof file == "undefined") {
        return;
    }
    var flag = false; //状态
    var name = file.name;
    var removeSpan = null;

    var arr = ["txt", "csv"];
    //取出上传文件的扩展名
    var index = name.lastIndexOf(".");
    var ext = name.substr(index + 1);
    //循环比较
    for (var i = 0; i < arr.length; i++) {
        if (ext == arr[i]) {
            flag = true; //一旦找到合适的，立即退出循环
            break;
        }
    }

    //条件判断
    if (flag) {
        var reader = new FileReader();
        reader.readAsText(file);
        reader.onload = function (data) {
            $(".content_tex").val(this.result);
            /* tt.innerHTML = this.result;*/
        }
    } else {
        $(".tzInsertTemplate .errorTxt").html("文件名不合法,只能上传txt格式");
        removeSpan = setInterval(function () {
            $(".tzInsertTemplate .errorTxt").empty();
            clearInterval(removeSpan);
        }, 5000);
        return;
    }
    closeLayerInsert();

}

//清除注单内容提示框
function showTishi1Template(infoStr) {
    if (layerTishi1 != null) {
        return;
    }

    var tiShi_template = '\
    <div class="tzTishiTemplate del-Tishi">\
        <h3>温馨提示</h3>\
        <span id="block_close"></span>\
        <table style="width: 100%">\
             <tobody>\
                 <tr>\
                     <td>\
                        <h4>\
                              <i class="imgTishi"></i>\
                              <sapn class="des-txt">是否清空确认区中所有投注内容？</span>\
                        </h4>\
                     </td>\
                 </tr>\
                 <tr>\
                    <td class="btns">\
                        <button type="button" onclick="enterType1()">确定</button>\
                        <button type="button" onclick="cancelType1()">取消</button>\
                    </td>\
                  </tr>\
             </tobody>\
        </table>\
    </div>\
    ';

    layer.closeAll();
    //页面层
    layerTishi1 = layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        area: ['370px', '220px'], //宽高
        content: tiShi_template
    });
}

//无注单内容提示框
function showTishi2Template(infoStr) {
    if (layerTishi2 != null) {
        return;
    }

    var tiShi_template = '\
    <div class="tzTishiTemplate del-Tishi del-TishiType2">\
        <h3>温馨提示</h3>\
        <span id="block_close"></span>\
        <table style="width: 100%">\
             <tobody>\
                 <tr>\
                     <td>\
                        <h4>\
                              <i class="imgTishi"></i>\
                              <sapn class="des-txt">无添加投注内容</span>\
                        </h4>\
                     </td>\
                 </tr>\
                 <tr>\
                    <td class="btns">\
                        <button type="button" onclick="enterType2()">确定</button>\
                    </td>\
                  </tr>\
             </tobody>\
        </table>\
    </div>\
    ';

    layer.closeAll();
    //页面层
    layerTishi2 = layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        area: ['282px', '222px'], //宽高
        content: tiShi_template
    });

    $("#block_close").click(function () {
        closeLayer2();
    });
    $(".del-TishiType2").parent().parent().css({"border": "6px solid #ccc", "border-radius": "8px", "top": "150px"});
}

//=========================================GFWF================================
/**
 * 初始化子页面，刷新滚动条，赔率，倍数等等
 */
var arrNum2 = []; //获取点击数的数组
var arrNum3 = [];
var arrNum4 = [];
var arrNum5 = [];
var arrNum6 = [];
var arrNum7 = [];
var arrNum8 = [];

function initSubPage() {
    // 初始化11选5计数器变量
    initArrNum();
    // 初始化模板
    $("#subPage").html(template("template_" + getPlayPlTemplateName()));
    $("#subJRange").html(template("template_jRange"));

    // 内容点击，触发统计注数函数
    $(".Pick ul li span i").click(function () {
        var nowFlag = $(".re-5x-i i").hasClass('acti');

        if (nowFlag == true) {
            $(".re-5x-i i").removeClass('acti');
        }
        var nameNow = $(this).parent().parent().attr('data-flag');
        if (typeof nameNow != 'undefined' || nameNow == "bdDanXuan") {
            var nowFlag = $(this).parent().hasClass('acti');
            if (nowFlag == true) {
                $(this).parent().removeClass('acti');

            } else {
                $(this).parent().parent().find('span.acti').removeClass('acti');
                $(this).parent().toggleClass('acti');
            }
        } else {
            var flagNameDanma = $(this).parent().parent().hasClass('danma_selected');
            var flagDanMaEm = $(this).parent().parent().hasClass('em_danma_selected');
            var flagDanMaSim = $(this).parent().parent().hasClass('sim_danma_selected');
            var flagDanMaWm = $(this).parent().parent().hasClass('wm_danma_selected');
            var flagDanMaLm = $(this).parent().parent().hasClass('lm_danma_selected');
            var flagDanMaQm = $(this).parent().parent().hasClass('qm_danma_selected');
            var flagDanMaBm = $(this).parent().parent().hasClass('bm_danma_selected');

            var flagNameDantuo = $(this).parent().parent().hasClass('dantuo_selected');

            var flagActi = $(this).parent().hasClass('acti'); //判断是否再次点击选中的号数

            if (flagNameDanma) {
                getDanmaCommon(this, arrNum3, 2, flagActi);
            } else if (flagDanMaEm) {
                getDanmaCommon(this, arrNum2, 1, flagActi);
            } else if (flagDanMaSim) {
                getDanmaCommon(this, arrNum4, 3, flagActi);
            } else if (flagDanMaWm) {
                getDanmaCommon(this, arrNum5, 4, flagActi);
            } else if (flagDanMaLm) {
                getDanmaCommon(this, arrNum6, 5, flagActi);
            } else if (flagDanMaQm) {
                getDanmaCommon(this, arrNum7, 6, flagActi);
            } else if (flagDanMaBm) {
                getDanmaCommon(this, arrNum8, 7, flagActi);
            } else if (flagNameDantuo) {
                var numTuo = parseInt($(this).html());
                $(this).parent().parent().parent().parent().find(".danma_selected span.n" + numTuo + ".acti").removeClass('acti');
                $(this).parent().parent().parent().parent().find(".em_danma_selected span.n" + numTuo + ".acti").removeClass('acti');
                $(this).parent().parent().parent().parent().find(".sim_danma_selected span.n" + numTuo + ".acti").removeClass('acti');
                $(this).parent().parent().parent().parent().find(".wm_danma_selected span.n" + numTuo + ".acti").removeClass('acti');
                $(this).parent().parent().parent().parent().find(".lm_danma_selected span.n" + numTuo + ".acti").removeClass('acti');
                $(this).parent().parent().parent().parent().find(".qm_danma_selected span.n" + numTuo + ".acti").removeClass('acti');
                $(this).parent().parent().parent().parent().find(".bm_danma_selected span.n" + numTuo + ".acti").removeClass('acti');

                $(this).parent().toggleClass('acti');
                var nameStr = $(this).parent().parent().attr('data-name');
                if (nameStr == 'danma2') {
                    minusDanmaNumObj(arrNum2, this);
                } else if (nameStr == 'danma3') {
                    minusDanmaNumObj(arrNum3, this);
                } else if (nameStr == 'danma4') {
                    minusDanmaNumObj(arrNum4, this);
                } else if (nameStr == 'danma5') {
                    minusDanmaNumObj(arrNum5, this);
                } else if (nameStr == 'danma6') {
                    minusDanmaNumObj(arrNum6, this);
                } else if (nameStr == 'danma7') {
                    minusDanmaNumObj(arrNum7, this);
                } else if (nameStr == 'danma8') {
                    minusDanmaNumObj(arrNum8, this);
                }

            } else {
                $(this).parent().toggleClass('acti'); // 变色
            }

        }

        // 渲染中部注数，赔率，返点等等
        renderZhushu();
    });

    // 内容点击，触发统计注数函数（特殊号）
    $(".Pick ul li.tsh_li span").click(function () {
        $(this).toggleClass('acti_tsh');   // 变色
        // 渲染中部注数，赔率，返点等等
        renderZhushu();
    });

    // 手动输入，触发统计注数函数
    $('.content_jiang .content_tex').keyup(function () {
        renderZhushu();
    });

    //位置选择
    $(".selposition label input").click(function () {
        var flag = $(this).parent().parent().attr("data-flag");
        var obj = $(this).parent().parent();
        var fnId = $(obj).attr("data-name");   //方案id

        if (typeof flag != "undefined" && flag == "wei-r2") {
            getZuChengFangAnR2(obj, fnId);
        } else if (typeof flag != "undefined" && flag == "wei-r3") {
            getZuChengFangAnR3(obj, fnId);
        } else if (typeof flag != "undefined" && flag == "wei-r4") {
            getZuChengFangAnR4(obj, fnId);
        }
        renderZhushu();
    });

    //输入倍数十重新计算
    $("#inputBeishu").keyup(function () {
        var val = parseInt($(this).val());
        if (isNaN(val) || typeof val != 'number') {
            val = 1;
        }
        val = parseInt(val);
        val = val < 1 ? 1 : val;
        $(this).data("beishu", val).val(val);
        renderZhushu();
    });

    //输入倍数失去焦点计算
    $("#inputBeishu").blur(function () {
        var valStr = $("#inputBeishu").val();
        if (typeof valStr == "undefined" || valStr == "" || valStr == null) {
            $("#inputBeishu").val("1");
        }
        renderZhushu();
    });

    // 加减号
    initJjh();

    var plAndMaxFd = getPlAndMaxFd();   // 获取当前选中的玩法赔率和返点
    var maxPlayPl;  // 最高赔率
    var maxFandian;  // 最大返点
    var minPl;  // 最低赔率
    var convertBlMoney;  // 每1%转换赔率

    if (plAndMaxFd instanceof Array) {  // 多赔率
        maxPlayPl = plAndMaxFd[0].playPl;  // 最高赔率
        maxFandian = plAndMaxFd[0].maxFdBl;    // 最大返点



        minPl = plAndMaxFd[0].minPl;   // 最低赔率
    } else {
        maxPlayPl = plAndMaxFd.playPl;  // 最高赔率
        maxFandian = plAndMaxFd.maxFdBl;    // 最大返点
        
        minPl = plAndMaxFd.minPl;   // 最低赔率

    }
    convertBlMoney = (maxPlayPl - minPl) / maxFandian;  // 每1%转换赔率

    // 初始化返点赔率滚动条
    $('.slider-input').jRange({
        from: 0,
        to: maxFandian, // 最大返点
        step: 0.1,  // 每步
        format: '%s',
        width: $(".cl-1004").width(),   // 滚动条总长度
        theme: 'theme-green my-slide-theme',
        showLabels: false,
        showScale: false,
        snap: true,
        onstatechange: function () {

            // 返点比例
            var fandianBili = parseFloat($(".slider-input").val()).toFixed(1); // 当前滚动条移动的比例
            $("#fandian-bfb").data("value", fandianBili);
            $("#fandian-bfb").html(fandianBili + "%");    // 渲染界面中百分比部分

            // 赔率 = 最大配率 - 返点比例 * 转换比例
            var pl = (maxPlayPl - fandianBili * convertBlMoney).toFixed(3);
            $("#jiangjin-change").data("value", pl);

            // 渲染界面中赔率部分
            if (plAndMaxFd instanceof Array) {  // 多赔率
                var strArr = [];
                $.each(plAndMaxFd, function (index, value) {
                    var valTemp = value.maxFdBl;
                    var tmpConvertBlMoney = (value.playPl - value.minPl) / (valTemp == 0 ? 1 : valTemp);

                    if(playGroupId == 12){
                        strArr.push((value.playPl - fandianBili * tmpConvertBlMoney).toFixed());
                    } else {
                        strArr.push((value.playPl - fandianBili * tmpConvertBlMoney).toFixed(3));
                    }

                });
                $("#jiangjin-change").html(strArr.join('|'));
                $("#jiangjin-change").data("plStr", strArr.join('|'));
            } else {
                $("#jiangjin-change").html(pl);
                $("#jiangjin-change").data("plStr",pl);
            }

            // 渲染中部注数，赔率，返点等等
            renderZhushu();
        }
    });

    $(".my-slide-theme .back-bar .pointer").attr("tabIndex", -1);    // 滑块添加tabIndex来获得focus事件
//        $(".my-slide-theme .back-bar .pointer").focus(function() {
//            if ($(this).hasClass("my-slide-theme-focus")) {
//                return;
//            }
//            $(this).addClass("my-slide-theme-focus");
//        });
//
//        $(".my-slide-theme .back-bar .pointer").focus(function() {
//            $(this).addClass("my-slide-theme-focus");
//        });
}

//初始化11选5胆码计数器全局变量
function initArrNum(){
    arrNum2.splice(0, arrNum2.length);
    arrNum3.splice(0, arrNum3.length);
    arrNum4.splice(0, arrNum4.length);
    arrNum5.splice(0, arrNum5.length);
    arrNum6.splice(0, arrNum6.length);
    arrNum7.splice(0, arrNum7.length);
    arrNum8.splice(0, arrNum8.length);
}

//胆码增加计数器
function getDanmaCommon(obj, numArr, x, flagActi){
    var numDan = parseInt($(obj).html());
    //所选胆码保证小于x个并且当点击时不是被选中的号码
    if (numArr.length >= x && !flagActi) {
        $(obj).parent().parent().find("span.n" + numArr[numArr.length - 1] + ".acti").removeClass('acti');
        numArr.splice(numArr.length - 1, 1);
    }

    //当点击选中号码时相应减去
    if(flagActi){
        minusDanmaNum(numArr, numDan);
    } else{
        numArr.push(parseInt($(obj).html()));
    }

    $(obj).parent().toggleClass('acti');
    //点击胆码时去掉相应的胆码选号
    $(obj).parent().parent().parent().parent().find(".dantuo_selected span.n" + numDan + ".acti").removeClass('acti');

    var sumSelectedTuodan = $(obj).parent().parent().find("span.acti").length;
    if(sumSelectedTuodan <= 0){
        numArr.splice(0, numArr.length);
    }

}

//胆码减少计数器
function minusDanmaNumObj(numArr, obj){
    var indexVal = numArr.indexOf(parseInt($(obj).html()));
    if(indexVal > -1){
        numArr.splice(indexVal, 1);
    }
}

//胆码减少计数器
function minusDanmaNum(numArr, num){
    var indexVal = numArr.indexOf(num);
    if(indexVal > -1){
        numArr.splice(indexVal, 1);
    }
}

//任选2 组成方案获取函数
function getZuChengFangAnR2(obj, fnId) {
    //选中位置自动获取组成方案-直选单式
    var arrTemp = [];
    $(obj).find("input[type='checkbox']:checked").each(function () {
        arrTemp.push($(this).val());
    });
    if (arrTemp.length == 3) {
        $("#positioninfo-" + fnId + "").html(3);
        $("#positioncount-" + fnId + "").html(3);
    } else if (arrTemp.length == 4) {
        $("#positioninfo-" + fnId + "").html(6);
        $("#positioncount-" + fnId + "").html(4);
    } else if (arrTemp.length == 5) {
        $("#positioninfo-" + fnId + "").html(10);
        $("#positioncount-" + fnId + "").html(5);
    } else if (arrTemp.length == 2) {
        $("#positioninfo-" + fnId + "").html(1);
        $("#positioncount-" + fnId + "").html(2);
    } else if (arrTemp.length == 1) {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(1);
    } else {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(0);
    }
}


//任选3 组成方案获取函数
function getZuChengFangAnR3(obj, fnId) {
    //选中位置自动获取组成方案-直选单式
    var arrTemp = [];
    $(obj).find("input[type='checkbox']:checked").each(function () {
        arrTemp.push($(this).val());
    });
    if (arrTemp.length == 3) {
        $("#positioninfo-" + fnId + "").html(1);
        $("#positioncount-" + fnId + "").html(3);
    } else if (arrTemp.length == 4) {
        $("#positioninfo-" + fnId + "").html(4);
        $("#positioncount-" + fnId + "").html(4);
    } else if (arrTemp.length == 5) {
        $("#positioninfo-" + fnId + "").html(10);
        $("#positioncount-" + fnId + "").html(5);
    } else if (arrTemp.length == 2) {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(2);
    } else if (arrTemp.length == 1) {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(1);
    } else {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(0);
    }
}


//任选4 组成方案获取函数
function getZuChengFangAnR4(obj, fnId) {
    //选中位置自动获取组成方案-直选单式
    var arrTemp = [];
    $(obj).find("input[type='checkbox']:checked").each(function () {
        arrTemp.push($(this).val());
    });
    if (arrTemp.length == 3) {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(3);
    } else if (arrTemp.length == 4) {
        $("#positioninfo-" + fnId + "").html(1);
        $("#positioncount-" + fnId + "").html(4);
    } else if (arrTemp.length == 5) {
        $("#positioninfo-" + fnId + "").html(5);
        $("#positioncount-" + fnId + "").html(5);
    } else if (arrTemp.length == 2) {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(2);
    } else if (arrTemp.length == 1) {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(1);
    } else {
        $("#positioninfo-" + fnId + "").html(0);
        $("#positioncount-" + fnId + "").html(0);
    }
}

function initJjh() {
    $(".Single .layout .add_spot .left .sopt_wrap .down .down_menu i").click(function () {
        var text = $(this).text();
        $(this).parent().parent().find('input').val(text);
        $(this).parent().hide();

        $(this).parent().parent().find('input').data("money", parseInt(text));
        renderZhushu();
    });

    $(".Single .layout .add_spot .left .sopt_wrap .down span").click(function () {
        $(this).parent().find(".down_menu").show();
    });

    $(".Single .layout .add_spot .left .sopt_wrap .down .down_menu i").parent().parent().hover(function () {
    }, function () {
        $(this).find(".down_menu").hide();
    });

    $(".Single .layout .add_spot .left .sopt_wrap .reduce a.fl").click(function () {
        var val = parseInt($(".Single .layout .add_spot .left .sopt_wrap .reduce input").val());
        if (isNaN(val) || typeof val != 'number') {
            val = 1;
        }
        val = parseInt(val);

        --val;
        val = val < 1 ? 1 : val;
        $(".Single .layout .add_spot .left .sopt_wrap .reduce input").data("beishu", val).val(val);
        renderZhushu();
    });

    $(".Single .layout .add_spot .left .sopt_wrap .reduce a.fr").click(function () {
        var val = parseInt($(".Single .layout .add_spot .left .sopt_wrap .reduce input").val());
        if (isNaN(val) || typeof val != 'number') {
            val = 1;
        }
        val = parseInt(val);

        ++val;
        val = val < 1 ? 1 : val;
        $(".Single .layout .add_spot .left .sopt_wrap .reduce input").data("beishu", val).val(val);
        renderZhushu();
    });
}

/**
 * 渲染中部注数，赔率，返点等等
 */
function renderZhushu() {

    // 注数算法
    var zhushuFun = getPlayPlFun_zhushu();
    if (typeof zhushuFun != 'undefined'||zhushuFun!=isNaN()) {
        var zhushu = eval(zhushuFun + "()");   // 注数


        if (typeof zhushu == "undefined" || zhushu < 0) {
//                clearStateTouZhu();
            return;
        }

        var inputBeishu = $("#inputBeishu").val();
        var inputFandianBili = $("#fandian-bfb").data("value") / 100;
        var mode = getSelectMode();//获取模式
        var moneyMode = getMode(mode);

        $('.p1 .i0').html(zhushu);  // 渲染注数
        $('.p1 .i_beishu').html($("#inputBeishu").val());   // 渲染倍数

        // 投注总金额 = 倍数 * 注数 * 单注金额
        var totalMoney = parseFloat((moneyMode * inputBeishu * zhushu * $("#inputMoney").data("money")).toFixed(3));
        $('.p1 .i_money').html(totalMoney);

        // 返点金额 = 投注总金额 * 返点比例
        var fandianMoney = parseFloat((totalMoney * inputFandianBili).toFixed(3));
        $('.p1 .i_fanD').html(fandianMoney);
    }
}

/**
 * 获取当前赔率模板名称
 */
function getPlayPlTemplateName() {
    return $(".playPlIdBtn.acti").data("name");
}

/**
 * 获取当前赔率随机算法
 */
function getPlayPlFun_suiji() {
    return $(".playPlIdBtn.acti").data("fun_suiji");
}

/**
 * 获取当前赔率注数算法
 */
function getPlayPlFun_zhushu() {
    return $(".playPlIdBtn.acti").data("fun_zhushu");
}

/**
 * 获取当前赔率内容算法
 */
function getPlayPlFun_content() {
    return $(".playPlIdBtn.acti").data("fun_content");
}

/**
 * 获取当前赔率ID
 */
function getPlayPlId() {
    return $(".playPlIdBtn.acti").data("play_pl_id");
}

/**
 * 获取当前玩法ID
 */
function getPlayId() {
    return $(".playPlIdBtn.acti").data("play_id");
}

/**
 * 获取当前期数
 */
function getNumber() {
    return $("#number").data("number");
}

/**
 * 获取赔率和最高返点
 */
function getPlAndMaxFd() {
    // 全局赔率变量
    var playPlId = getPlayPlId();   // 当前赔率ID

    if (playPlId.toString().indexOf('|') > 0) {    // 多赔率
        var result = [];
        var tmpArr = playPlId.split('|');
        $.each(tmpArr, function (index, value) {
            for (var i = 0; i < gfwfPlJson.sscPlayPlList.length; ++i) {
                var o = gfwfPlJson.sscPlayPlList[i];
                if (o.playPlId == value) {
                    result.push(o);
                }
            }
        });
        return result;
    } else {    // 单一赔率
        for (var i = 0; i < gfwfPlJson.sscPlayPlList.length; ++i) {
            var o = gfwfPlJson.sscPlayPlList[i];
            if (o.playPlId == playPlId) {
                return o;
            }
        }
    }
    return;
}

/**
 * 清除状态
 */
function clearStateTouZhu() {
    renderZhushu();
    /*$('.p1 .i0').html('0');
    $('.p1 .i_beishu').html('1');
    $('.p1 .i_fanD').html('0');
    $('.p1 .i_money').html('0');
    $('.slider-input').jRange("setValue", '0');*/
}

//=======================遍历进行统计注数=================================

//******************注数-任选4*******************

/**
 * 注数-组选4
 */
function zhushu_rx4zu4() {
    var sanChongHaoArr = [], danHaoArr = [], tempArr = [], nowArr = [];
    $.each($(".recl-1007-zux4 ul li[data-name = '三重号'] span.acti"), function (index, value) {
        sanChongHaoArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1007-zux4 ul li[data-name = '单号'] span.acti"), function (index, value) {
        danHaoArr.push($.trim($(this).find("i").html()));
    });

    for (var d = 0; d < sanChongHaoArr.length; d++) {
        for (var n = 0; n < danHaoArr.length; n++) {
            if (sanChongHaoArr[d] != danHaoArr[n]) {
                tempArr.push(sanChongHaoArr[d] + "" + danHaoArr[n]);
            }
        }
    }
    if (tempArr.length < 1) {
        return 0;
    }
    var zhushu = tempArr.length;
    var shu = $("#positioninfo-zux4").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-组选6
 */
function zhushu_rx4zu6() {
    var erChongHaoArr = [], tempArr = [], nowArr = [];
    $.each($(".recl-1006-zux6 ul li[data-name = '二重号'] span.acti"), function (index, value) {
        erChongHaoArr.push($.trim($(this).find("i").html()));
    });
    if (erChongHaoArr.length < 2) {
        return;
    }
    for (var d = 0; d < erChongHaoArr.length; d++) {
        for (var n = 0; n < erChongHaoArr.length; n++) {
            if (erChongHaoArr[d] != erChongHaoArr[n]) {
                var arr = [];
                arr.push(erChongHaoArr[d]);
                arr.push(erChongHaoArr[n]);
                arr.sort();
                tempArr.push(arr.join(""));
            }
        }
    }
    tempArr = tempArr.uniqueArr();
    var zhushu = tempArr.length;
    var shu = $("#positioninfo-zux6").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-组选12
 */
function zhushu_rx4zu12() {
    var erChongHaoArr = [], danHaoArr = [], tempArr = [], nowArr = [];
    $.each($(".recl-1005-zux12 ul li[data-name = '二重号'] span.acti"), function (index, value) {
        erChongHaoArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1005-zux12 ul li[data-name = '单号'] span.acti"), function (index, value) {
        danHaoArr.push($.trim($(this).find("i").html()));
    });

    if (danHaoArr.length < 2 && erChongHaoArr.length < 1) {
        return;
    }
    //单号两两组合一共有若干对
    for (var d = 0; d < danHaoArr.length; d++) {
        for (var n = 0; n < danHaoArr.length; n++) {
            if (danHaoArr[d] != danHaoArr[n]) {
                var arr = [];
                arr.push(danHaoArr[d]);
                arr.push(danHaoArr[n]);
                arr.sort();
                tempArr.push(arr.join(""));
            }
        }
    }
    tempArr = tempArr.uniqueArr();

    for (var i = 0; i < erChongHaoArr.length; i++) {
        for (var m = 0; m < tempArr.length; m++) {
            var onestr = (tempArr[m].toString()).substr(0, 1);
            var twostr = (tempArr[m].toString()).substr(1, 1);
            if (parseInt(onestr) != erChongHaoArr[i] && parseInt(twostr) != erChongHaoArr[i]) {
                var arr = [];
                arr.push(onestr);
                arr.push(twostr);
                arr.sort();
                nowArr.push(erChongHaoArr[i] + "" + arr.join(""));
            }
        }
    }
    nowArr = nowArr.uniqueArr();
    var zhushu = nowArr.length;
    var shu = $("#positioninfo-zux12").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}
/**
 * 注数-组选24
 */
function zhushu_rx4zu24() {
    var fuShiArr = [], newArr = [];
    $.each($(".recl-1004-zux24 ul li[data-name = '组选24'] span.acti"), function (index, value) {
        fuShiArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = fuShiArr.length;
    if (zlLength < 4) {
        return 0;
    }

    for (var n1 = 0; n1 < fuShiArr.length; n1++) {
        for (var n2 = 0; n2 < fuShiArr.length; n2++) {
            for (var n3 = 0; n3 < fuShiArr.length; n3++) {
                for (var n4 = 0; n4 < fuShiArr.length; n4++) {
                    if (fuShiArr[n1] != fuShiArr[n2] && fuShiArr[n1] != fuShiArr[n3] && fuShiArr[n1] != fuShiArr[n4] && fuShiArr[n2] != fuShiArr[n3] && fuShiArr[n2] != fuShiArr[n4] && fuShiArr[n3] != fuShiArr[n4]) {
                        var arr = [];
                        arr.push(fuShiArr[n1]);
                        arr.push(fuShiArr[n2]);
                        arr.push(fuShiArr[n3]);
                        arr.push(fuShiArr[n4]);
                        arr.sort();
                        newArr.push(arr.join(""));
                    }
                }
            }
        }
    }
    newArr = newArr.uniqueArr();
    var zhushu = newArr.length;
    var shu = $("#positioninfo-zux24").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-直选单式
 */
function zhushu_rx4zxds() {
    var tempArr = [];
    var textStr = $(".recl-1003-zxds .content_jiang .content_tex").val();
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        }
    }

    var temp = newArr.length;
    var shu = $("#positioninfo-ds").html();
    return temp * shu;
}

/**
 * 注数-直选复式
 */
function zhushu_rx4zxfs() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [], newArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var numArr = [];
    var indexArr = [wanArr, qianArr, baiArr, shiArr, geArr];

    if (wanArr.length > 0) {
        numArr.push(0);
    }
    if (qianArr.length > 0) {
        numArr.push(1);
    }
    if (baiArr.length > 0) {
        numArr.push(2);
    }
    if (shiArr.length > 0) {
        numArr.push(3);
    }
    if (geArr.length > 0) {
        numArr.push(4);
    }

    if (numArr.length < 4) {
        return 0;
    }

    var tmpArr = getFlagArrs(numArr, 4);
    var result = 0;
    $.each(tmpArr, function (index, value) {
        var tmpResult = 0;
        var tmpIndexArr = value.split(" ");
        $.each(tmpIndexArr, function (index2, value2) {
            tmpResult = tmpResult == 0 ? 1 : tmpResult;
            tmpResult *= indexArr[parseInt(value2)].length;

        });
        result += tmpResult;
    });
    return result;
}
//******************任选3*******************
/**
 * 注数-组选和值
 */
function zhushu_rx3zuxhz() {
    var hzArr = [];
    $.each($(".recl-1010-zuxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    if (hzArr.length <= 0) {
        return 0;
    }

    var newArr = [];
    for (var i = 0; i < hzArr.length; i++) {
        for (var x = 0; x < 10; x++) {
            for (var y = 0; y < 10; y++) {
                for (var y1 = 0; y1 < 10; y1++) {
                    if (x + y + y1 == hzArr[i] && !(x == y && x == y1 && y == y1)) {
                        var arr = [];
                        arr.push(x);
                        arr.push(y);
                        arr.push(y1);
                        arr.sort();
                        newArr.push(arr.join(""));
                    }
                }
            }
        }
    }

    newArr = newArr.uniqueArr();
    var zhushu = newArr.length;
    var shu = $("#positioninfo-zuxhz").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-混合组合
 */
function zhushu_rx3hhzux() {
    var zhushu = 0;
    var arrTemp = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-hhzux input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    var textStr = $(".recl-1009-hhzux .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var arr = [];
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        arr.push(oneStr);
        arr.push(twoStr);
        arr.push(threeStr);
        arr.sort();
        if (!(twoStr == threeStr && oneStr == threeStr && twoStr == oneStr)) {
            tempArr.push(arr.join(""));
        }
    }
    tempArr = tempArr.uniqueArr(); // 去掉重复号码

    zhushu = tempArr.length;
    var tempNum = $("#positioninfo-hhzux").html();
    zhushu = tempNum * zhushu;
    return zhushu;
}

/**
 * 注数-组六单式
 */
function zhushu_rx3z6ds() {
    var zhushu = 0;
    var arrTemp = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-zu6ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    var textStr = $(".recl-1008-zu6ds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var arr = [];
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        arr.push(oneStr);
        arr.push(twoStr);
        arr.push(threeStr);
        arr.sort();
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr) {
            tempArr.push(arr.join(""));
        }
    }

    zhushu = tempArr.length;
    var tempNum = $("#positioninfo-zu6ds").html();
    zhushu = tempNum * zhushu;
    return zhushu;
}

/**
 * 注数-组六复式
 */
function zhushu_rx3z6fs() {
    var fuShiArr = [], newArr = [];
    $.each($(".recl-1007-zu6fs ul li[data-name = '组六'] span.acti"), function (index, value) {
        fuShiArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = fuShiArr.length;
    if (zlLength < 3) {
        return 0;
    }

    newArr = getZuLiuNewArrs(fuShiArr);
    var zhushu = newArr.length;
    var shu = $("#positioninfo-zu6fs").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-组三单式
 */
function zhushu_rx3z3ds() {
    var zhushu = 0;
    var repeatArr = [], allErrorArr = [];
    var errorArr = [], arrTemp = [];
    var textStr = $(".recl-1006-zu3ds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));

    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-zu3ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    var arr_new = textStr.split(",");

    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            errorArr.push(arr_new[i]);
        }
    }

    for (var n = 0; n < newArr.length; n++) {
        var arr = [];
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        arr.push(oneStr);
        arr.push(twoStr);
        arr.push(threeStr);
        arr.sort();
        if (oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(arr.join(""));
        } else {
            errorArr.push(newArr[n]);
        }
    }

    zhushu = tempArr.length;
    var tempNum = $("#positioninfo-zu3ds").html();
    zhushu = tempNum * zhushu;
    return zhushu;
}

/**
 * 注数-组三复式
 */
function zhushu_rx3z3fs() {
    var zuArr = [];
    $.each($(".recl-1005-zu3fs ul li[data-name = '组三'] span.acti"), function (index, value) {
        zuArr.push($.trim($(this).find("i").html()));
    });
    var tempArr = [];
    for (var i = 0; i < zuArr.length; i++) {
        for (var i1 = 0; i1 < zuArr.length; i1++) {
            if (zuArr[i] != zuArr[i1]) {
                tempArr.push(zuArr[i] + "" + zuArr[i1]);
            }
        }

    }
    var shu = $("#positioninfo-zu3fs").html();
    var lengthArr = tempArr.length * shu;
    return lengthArr;
}

/**
 * 注数-直选和值
 */
function zhushu_rx3zxhz() {
    var hzArr = [];
    $.each($(".recl-1004-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    if (hzArr.length <= 0) {
        return 0;
    }

    var newArr = [];
    for (var i = 0; i < hzArr.length; i++) {
        for (var x = 0; x < 10; x++) {
            for (var y = 0; y < 10; y++) {
                for (var y1 = 0; y1 < 10; y1++) {
                    if (x + y + y1 == hzArr[i]) {
                        newArr.push(x + "" + y + "" + y1);
                    }
                }
            }
        }
    }

    var zhushu = newArr.length;
    var shu = $("#positioninfo-hz").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-直选单式
 */
function zhushu_rx3zxds() {
    var errorStr = '';
    var allErrorArr = [];
    var errorArr = [];
    var newArr = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    var textStr = $(".recl-1003-zxds .content_jiang .content_tex").val();
    var shu = $("#positioninfo-ds").html();
    var zhushu = 0;

    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));

    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }

    var temp = newArr.length;
    zhushu = temp * shu;
    return zhushu;
}

/**
 * 注数-直选复式
 */
function zhushu_rx3zxfs() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [], newArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var numArr = [];
    var indexArr = [wanArr, qianArr, baiArr, shiArr, geArr];

    if (wanArr.length > 0) {
        numArr.push(0);
    }
    if (qianArr.length > 0) {
        numArr.push(1);
    }
    if (baiArr.length > 0) {
        numArr.push(2);
    }
    if (shiArr.length > 0) {
        numArr.push(3);
    }
    if (geArr.length > 0) {
        numArr.push(4);
    }

    if (numArr.length < 3) {
        return 0;
    }

    var tmpArr = getFlagArrs(numArr, 3);
    var result = 0;
    $.each(tmpArr, function (index, value) {
        var tmpResult = 0;
        var tmpIndexArr = value.split(" ");
        $.each(tmpIndexArr, function (index2, value2) {
            tmpResult = tmpResult == 0 ? 1 : tmpResult;
            tmpResult *= indexArr[parseInt(value2)].length;

        });
        result += tmpResult;
    });
    return result;
}

//******************任选2*******************
/**
 * 注数-组选和值
 */
function zhushu_rx2zuxhz() {
    var hzArr = [];
    $.each($(".recl-1007-zuxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    if (hzArr.length <= 0) {
        return 0;
    }
    var newArr = [];
    for (var i = 0; i < hzArr.length; i++) {
        for (var x = 0; x < 10; x++) {
            for (var y = 0; y < 10; y++) {
                if ((x + y) == hzArr[i] && x != y) {
                    var arr = [];
                    arr.push(x);
                    arr.push(y);
                    arr.sort();
                    newArr.push(arr.join(""));
                }
            }
        }
    }
    newArr = newArr.uniqueArr();
    var zhushu = newArr.length;
    var shu = $("#positioninfo-zuhz").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-直选单式
 */
function zhushu_rx2zuxds() {
    var checkStrArr = [], checkArr = [];
    var zhushu = 0;
    //选取选中checkbox
    $.each($(".re-select-zuxds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    var errorStr = '';
    var repeatArr = [], allErrorArr = [];
    var errorArr = [], arrTemp = [];
    var textStr = $(".recl-1006-zuxds .content_jiang .content_tex").val();
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            var oneStr = (arr_new[i].toString()).substr(0, 1);
            var twoStr = (arr_new[i].toString()).substr(1, 1);
            var arr = [];
            arr.push(parseInt(oneStr));
            arr.push(parseInt(twoStr));
            arr.sort();
            newArr.push(arr.join(""));
        }
    }

    repeatArr = newArr.duplicateNew().uniqueArr(); //重复号码
    newArr = newArr.uniqueArr();
    var temp = newArr.length;
    var shu = $("#positioninfo-zuds").html();
    zhushu = temp * shu;
    return zhushu;
}

/**
 * 注数-组选复式
 */
function zhushu_rx2zuxfs() {
    var zuArr = [];
    var tempArr = [];
    $.each($(".recl-1005-zuxfs ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuArr.push($.trim($(this).find("i").html()));
    });

    var zuLength = zuArr.length;

    if (zuLength < 2) {
        return;
    }

    for (var i = 0; i < zuArr.length; i++) {
        for (var i1 = 0; i1 < zuArr.length; i1++) {
            if (zuArr[i] != zuArr[i1]) {
                var arr = [];
                arr.push(zuArr[i]);
                arr.push(zuArr[i1]);
                arr.sort();
                tempArr.push(arr.join(""));
            }
        }
    }

    tempArr = tempArr.uniqueArr();
    var zhushu = tempArr.length;
    var shu = $("#positioninfo-zufs").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-直选和值
 */
function zhushu_rx2zxhz() {
    var hzArr = [];
    var newArr = [];
    $.each($(".recl-1004-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    if (hzArr.length <= 0) {
        return 0;
    }
    for (var i = 0; i < hzArr.length; i++) {
        for (var x = 0; x < 10; x++) {
            for (var y = 0; y < 10; y++) {
                if (x + y == hzArr[i]) {
                    newArr.push(x + "" + y);
                }
            }
        }
    }
    var zhushu = newArr.length;
    var shu = $("#positioninfo-hz").html();
    var lengthArr = zhushu * shu;
    return lengthArr;
}

/**
 * 注数-直选单式
 */
function zhushu_rx2zxds() {
    var checkStrArr = [], checkArr = [];
    var textStr = $(".recl-1003-zxds .content_jiang .content_tex").val();
    //选取选中checkbox
    $.each($(".re-select-ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    var newArr = [], arrTemp = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            newArr.push(arr_new[i]);
        }
    }

    var temp = newArr.length;
    var shu = $("#positioninfo-ds").html();
    var zhushu = temp * shu;
    return zhushu;
}

/**
 * 注数-直选复式
 */
function zhushu_rx2zxfs() {
    var arrNew = [], tempArr = [];
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    if (wanArr.length > 0) {
        arrNew.push(wanArr);
    }
    if (qianArr.length > 0) {
        arrNew.push(qianArr);
    }
    if (baiArr.length > 0) {
        arrNew.push(baiArr);
    }
    if (shiArr.length > 0) {
        arrNew.push(shiArr);
    }
    if (geArr.length > 0) {
        arrNew.push(geArr);
    }

    if (arrNew.length < 2) {
        return 0;
    }

    for (var i = 0; i < arrNew.length; i++) {
        for (var i1 = 0; i1 < arrNew[i].length; i1++) {
            for (var x = i + 1; x < arrNew.length; x++) {
                for (var n = 0; n < arrNew[x].length; n++) {
                    tempArr.push(arrNew[i][i1] + "" + arrNew[x][n]);
                }
            }
        }
    }
    return tempArr.length;

}

//******************不定位*******************
/**
 * 注数-五星三码
 */
function zhushu_wx3m() {
    var budwArr = [];
    $.each($(".recl-1012-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });
    var newArr = [];
    for (var i = 0; i < budwArr.length; i++) {
        for (var j = 0; j < budwArr.length; j++) {
            for (var x = 0; x < budwArr.length; x++) {
                if (i != j && j != x && i != x) {
                    var arr = [];
                    arr.push(budwArr[i]);
                    arr.push(budwArr[j]);
                    arr.push(budwArr[x]);
                    arr.sort();
                    newArr.push(arr.join(","));
                }
            }
        }
    }

    newArr = newArr.uniqueArr();
    return newArr.length;
}

/**
 * 注数-五星二码
 */
function zhushu_wxem() {
    var budwArr = [];
    $.each($(".recl-1011-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });
    var newArr = [];
    for (var i = 0; i < budwArr.length; i++) {
        for (var j = 0; j < budwArr.length; j++) {
            if (i != j) {
                var arr = [];
                arr.push(budwArr[i]);
                arr.push(budwArr[j]);
                arr.sort();
                newArr.push(arr.join(","));
            }
        }
    }

    newArr = newArr.uniqueArr();
    return newArr.length;
}

/**
 * 注数-五星一码
 */
function zhushu_wxym() {
    var budwArr = [];
    $.each($(".recl-1010-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    return budwArr.length;
}

/**
 * 注数-后四二码
 */
function zhushu_h4em() {
    var budwArr = [];
    $.each($(".recl-1009-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });
    var newArr = [];
    for (var i = 0; i < budwArr.length; i++) {
        for (var j = 0; j < budwArr.length; j++) {
            if (i != j) {
                var arr = [];
                arr.push(budwArr[i]);
                arr.push(budwArr[j]);
                arr.sort();
                newArr.push(arr.join(","));
            }
        }
    }

    newArr = newArr.uniqueArr();
    return newArr.length;
}

/**
 * 注数-后四一码
 */
function zhushu_h4ym() {
    var budwArr = [];
    $.each($(".recl-1008-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    return budwArr.length;
}

/**
 * 注数-前四二码
 */
function zhushu_q4em() {
    var budwArr = [];
    $.each($(".recl-1007-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });
    var newArr = [];
    for (var i = 0; i < budwArr.length; i++) {
        for (var j = 0; j < budwArr.length; j++) {
            if (i != j) {
                var arr = [];
                arr.push(budwArr[i]);
                arr.push(budwArr[j]);
                arr.sort();
                newArr.push(arr.join(","));
            }
        }
    }

    newArr = newArr.uniqueArr();
    return newArr.length;
}

/**
 * 注数-前四一码
 */
function zhushu_q4ym() {
    var budwArr = [];
    $.each($(".recl-1006-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    return budwArr.length;
}

/**
 * 注数-后三二码
 */
function zhushu_hsem() {
    var budwArr = [];
    $.each($(".recl-1005-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });
    var newArr = [];
    for (var i = 0; i < budwArr.length; i++) {
        for (var j = 0; j < budwArr.length; j++) {
            if (i != j) {
                var arr = [];
                arr.push(budwArr[i]);
                arr.push(budwArr[j]);
                arr.sort();
                newArr.push(arr.join(","));
            }
        }
    }
    newArr = newArr.uniqueArr();
    return newArr.length;
}

/**
 * 注数-后三一码
 */
function zhushu_hsym() {
    var budwArr = [];
    $.each($(".recl-1004-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    return budwArr.length;
}

/**
 * 注数-前三二码
 */
function zhushu_qsem() {
    var budwArr = [];
    $.each($(".recl-1003-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });
    var newArr = [];
    for (var i = 0; i < budwArr.length; i++) {
        for (var j = 0; j < budwArr.length; j++) {
            if (i != j) {
                var arr = [];
                arr.push(budwArr[i]);
                arr.push(budwArr[j]);
                arr.sort();
                newArr.push(arr.join(","));
            }
        }
    }
    newArr = newArr.uniqueArr();
    return newArr.length;
}

/**
 * 注数-前三一码
 */
function zhushu_qsym() {
    var budwArr = [];
    $.each($(".cl-1002 ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    return budwArr.length;
}

//*************************定位胆****************************
/**
 * 注数-定位胆
 */
function zhushu_dwd() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [], newArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;
    var shiLength = shiArr.length;
    var geLength = geArr.length;

    if (wanLength <= 0 && qianLength <= 0 && baiLength <= 0 && shiLength <= 0 && geLength <= 0) {
        return 0;
    }

    if (wanLength > 0) {
        newArr = newArr.concat(wanArr);
    }
    if (qianLength > 0) {
        newArr = newArr.concat(qianArr);
    }
    if (baiLength > 0) {
        newArr = newArr.concat(baiArr);
    }
    if (shiLength > 0) {
        newArr = newArr.concat(shiArr);
    }
    if (geLength > 0) {
        newArr = newArr.concat(geArr);
    }
    return newArr.length;
}


/**
 * 注数-定位胆
 */
function zhushu_gd11x5_dwd() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [], newArr = [];
    $.each($(".cl-1002 ul li[data-name = '第一位'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第二位'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第三位'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第四位'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第五位'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;
    var shiLength = shiArr.length;
    var geLength = geArr.length;

    if (wanLength <= 0 && qianLength <= 0 && baiLength <= 0 && shiLength <= 0 && geLength <= 0) {
        return 0;
    }

    if (wanLength > 0) {
        newArr = newArr.concat(wanArr);
    }
    if (qianLength > 0) {
        newArr = newArr.concat(qianArr);
    }
    if (baiLength > 0) {
        newArr = newArr.concat(baiArr);
    }
    if (shiLength > 0) {
        newArr = newArr.concat(shiArr);
    }
    if (geLength > 0) {
        newArr = newArr.concat(geArr);
    }
    return newArr.length;
}
//*************************定位胆****************************
/**
 * 注数-定位胆
 */
function zhushu_dwdzxfs() {
    var gj = [], yj = [],  jj = [], ds = [],dw = [] ,dt = [],dq = [],db = [],dj = [],dsm = [],newArr = [];;
    $.each($(".cl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        gj.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '亚军'] span.acti"), function (index, value) {
        yj.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '季军'] span.acti"), function (index, value) {
        jj.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第四名'] span.acti"), function (index, value) {
        ds.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第五名'] span.acti"), function (index, value) {
        dw.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第六名'] span.acti"), function (index, value) {
        dt.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第七名'] span.acti"), function (index, value) {
        dq.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第八名'] span.acti"), function (index, value) {
        db.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第九名'] span.acti"), function (index, value) {
        dj.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第十名'] span.acti"), function (index, value) {
        dsm.push($.trim($(this).find("i").html()));
    });


    var gjlength = gj.length;
    var yjLength = yj.length;
    var jjLength = jj.length;
    var dsLength = ds.length;
    var dwlength = dw.length;
    var dtlength = dt.length;
    var dqlength = dq.length;
    var dblength = db.length;
    var djlength = dj.length;
    var dsmlength = dsm.length;

    if (gjlength <= 0 && yjLength <= 0 && jjLength <= 0 && dsLength <= 0 && dwlength <= 0&& dtlength <= 0&& dqlength <= 0&& dblength <= 0&& djlength <= 0&& dsmlength <= 0) {
        return 0;
    }

    if (gjlength > 0) {
        newArr = newArr.concat(gj);
    }
    if (yjLength > 0) {
        newArr = newArr.concat(yj);
    }
    if (jjLength > 0) {
        newArr = newArr.concat(jj);
    }
    if (dsLength > 0) {
        newArr = newArr.concat(ds);
    }
    if (dwlength > 0) {
        newArr = newArr.concat(dw);
    }
    if (dtlength > 0) {
        newArr = newArr.concat(dt);
    }
    if (dqlength > 0) {
        newArr = newArr.concat(dq);
    }
    if (dblength > 0) {
        newArr = newArr.concat(db);
    }
    if (djlength > 0) {
        newArr = newArr.concat(dj);
    }
    if (dsmlength > 0) {
        newArr = newArr.concat(dsm);
    }
    return newArr.length;
}

//*************************前2****************************
/**
 * 注数-组选包胆
 */
function zhushu_q2zuxbd(valArr) {
    var tempArr = [];
    var bdArr = [], nowTemp = [];
    $.each($(".recl-1009-zuxbd ul li[data-name = '胆码'] span.acti"), function (index, value) {
        nowTemp.push($.trim($(this).find("i").html()));
    });

    if (typeof valArr != "undefined") {
        bdArr = valArr;
    } else {
        bdArr = nowTemp;
    }
    var bdLength = bdArr.length;
    if (bdLength <= 0) {
        return 0;
    }
    for (var n = 0; n < bdArr.length; n++) {
        for (var i = 0; i < 10; i++) {
            if (i != bdArr[n]) {
                tempArr.push(i + "" + bdArr[n]);
            }
        }
    }
    return tempArr.length;
}

/**
 * 注数-组选和值
 */
function zhushu_q2zuxhz(valArr) {
    var tempArr = [];
    var hzArr = [], temp = [], nowTemp = [];
    var sumTemp = 0, num = 0;
    $.each($(".recl-1008-zuxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        nowTemp.push($.trim($(this).find("i").html()));
    });
    if (typeof valArr != "undefined") {
        hzArr = valArr;
    } else {
        hzArr = nowTemp;
    }
    var hzLength = hzArr.length;
    if (hzLength <= 0) {
        return 0;
    }

    for (var n = 0; n < hzArr.length; n++) {
        sumTemp = parseInt(hzArr[n]);
        num = parseInt(hzArr[n]);
        while (sumTemp >= 0) {
            temp.push(sumTemp);
            sumTemp--;
        }

        for (var i = 0; i < temp.length; i++) {
            for (var i1 = 0; i1 < temp.length; i1++) {
                if (temp[i] + temp[i1] == num && temp[i] <= 9 && temp[i1] <= 9) {
                    if (temp[i] != temp[i1]) {
                        var arr1 = [];
                        arr1.push(temp[i]);
                        arr1.push(temp[i1]);
                        arr1.sort();
                        tempArr.push(arr1.join(""));
                    }
                }
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }
    tempArr = tempArr.uniqueArr();
    return tempArr.length;
}

/**
 * 注数-组选单式
 */
function zhushu_q2zuxds() {
    var textStr = $(".recl-1007-zuxds .content_jiang .content_tex").val();
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            var strTemp = "", strTemp1 = "";
            var str1 = arr_new[i].toString();
            var str2 = arr_new[i].toString();
            strTemp = str1.substr(0, 1);
            strTemp1 = str2.substr(1, 1);
            if (strTemp != strTemp1) {
                var tempArr = [];
                tempArr.push(parseInt(strTemp));
                tempArr.push(parseInt(strTemp1));
                tempArr.sort();
                newArr.push(tempArr.join(""));
            }
        }
    }
    if (newArr.length <= 0) {
        return 0;
    }
    return newArr.length;
}


/**
 * 注数-组选复式
 */
function zhushu_q2zuxfs() {
    var tempArr = [], zuxArr = [];
    $.each($(".recl-1006-zuxfs ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuxArr.push($.trim($(this).find("i").html()));
    });

    var xLength = zuxArr.length;
    if (xLength < 2) {
        return 0;
    }

    for (var i = 0; i < zuxArr.length; i++) {
        for (var i1 = 0; i1 < zuxArr.length; i1++) {
            if (zuxArr[i] != zuxArr[i1]) {
                var xArr = [];
                xArr.push(zuxArr[i]);
                xArr.push(zuxArr[i1]);
                xArr.sort();
                tempArr.push(xArr.join(""));
            }
        }
    }
    tempArr = tempArr.uniqueArr();
    return tempArr.length;
}

/**
 * 注数-直选跨度
 */
function zhushu_q2zxkd(valArr) {
    var tempArr = [];
    var kdArr = [], numTemp = [];
    var num = 0;
    $.each($(".recl-1005-zxkd ul li[data-name = '跨度'] span.acti"), function (index, value) {
        numTemp.push($.trim($(this).find("i").html()));
    });
    if (typeof valArr != "undefined") {
        kdArr = valArr;
    } else {
        kdArr = numTemp;
    }

    var hzLength = kdArr.length;
    if (hzLength <= 0) {
        return 0;
    }

    for (var n = 0; n < kdArr.length; n++) {
        num = kdArr[n];
        for (var i = 0; i < 10; i++) {
            for (var i1 = 0; i1 < 10; i1++) {
                var numTemp = [];
                numTemp.push(i);
                numTemp.push(i1);
                numTemp.sort();
                if (numTemp[1] - numTemp[0] == num) {
                    tempArr.push(i + "" + i1);
                }
            }
        }
    }

    tempArr = tempArr.uniqueArr();
    return tempArr.length;
}

/**
 * 注数-直选和值
 */
function zhushu_q2zxhz(valArr) {
    var tempArr = [];
    var hzArr = [], temp = [], nowTemp = [];
    var tempValue = 0, sumTemp = 0, num = 0;
    $.each($(".recl-1004-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        nowTemp.push($.trim($(this).find("i").html()));
    });

    if (typeof valArr != "undefined") {
        hzArr = valArr;
    } else {
        hzArr = nowTemp;
    }

    var hzLength = hzArr.length;
    if (hzLength <= 0) {
        return 0;
    }

    for (var n = 0; n < hzArr.length; n++) {
        sumTemp = parseInt(hzArr[n]);
        num = parseInt(hzArr[n]);
        while (sumTemp >= 0) {
            temp.push(sumTemp);
            sumTemp--;
        }

        for (var i = 0; i < temp.length; i++) {
            for (var i1 = 0; i1 < temp.length; i1++) {
                if (temp[i] + temp[i1] == num && temp[i] <= 9 && temp[i1] <= 9) {
                    tempArr.push(temp[i] + "" + temp[i1]);
                }
            }
        }
    }

    tempArr = tempArr.uniqueArr();
    return tempArr.length;
}

/**
 * 注数-直选单式
 */
function zhushu_q2zxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            newArr.push(arr_new[i]);
        }
    }

    if (newArr.length <= 0) {
        return 0;
    }
    return newArr.length;
}


/**
 * 注数 前二-直选单式
 */
function zhushu_qezxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        if (oneStr != twoStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12) {
                tempArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {

        return 0;

    }


    return tempArr.length;
}


/**
 * 注数 前三-直选单式
 */
function zhushu_qszxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        if (oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12) {
                tempArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    return tempArr.length;
}

/**
 * 注数 前三-直选单式
 */
function zhushu_gd11x5_qszxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        if (oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12) {
                tempArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    return tempArr.length;
}


function zhushu_gd11x5_qezuxdt(){
    var newArr = [];
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });
    if (wanArr.length <= 0) {
        return 0;
    }

    for (var i = 0; i < qianArr.length; i++) {
        newArr.push(wanArr[0] + '' + qianArr[i]);
    }

    return newArr.length;
}


function zhushu_gd11x5_hezuxdt(){
    var newArr = [];
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });
    if (wanArr.length <= 0) {
        return 0;
    }

    for (var i = 0; i < qianArr.length; i++) {
        newArr.push(wanArr[0] + '' + qianArr[i]);
    }

    return newArr.length;
}


function zhushu_gd11x5_rxwzwdt(){
    var arrLength=5;
    var tempLength =0;
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });

    if(wanArr.length <= 0 || qianArr.length <= 0){
        return 0;
    }

    for(var i = 0; i < arrLength; i++){
        if(wanArr.length == i) {
            tempLength = getFlagArrs(qianArr, arrLength - i);
        }
    }

    return tempLength.length;
}


function zhushu_gd11x5_rxsizsdt(){
    var arrLength=4;
    var tempLength =0;
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });

    if(wanArr.length <= 0 || qianArr.length <= 0){
        return 0;
    }

    for(var i = 0; i < arrLength; i++){
        if(wanArr.length == i) {
            tempLength = getFlagArrs(qianArr, arrLength - i);
        }
    }

    return tempLength.length;
}


function zhushu_gd11x5_rxlzwdt(){
    var arrLength=6;
    var tempLength = 0;
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });

    if(wanArr.length <= 0 || qianArr.length <= 0){
        return 0;
    }

    for(var i = 0; i < arrLength; i++){
        if(wanArr.length == i) {
            tempLength = getFlagArrs(qianArr, arrLength - i);
        }
    }

    return tempLength.length;
}

function zhushu_gd11x5_rxqzwdt(){
    var tempLength = 0;
    var arrLength=7;
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });

    if(wanArr.length <= 0 || qianArr.length <= 0){
        return 0;
    }

    for(var i = 0; i < arrLength; i++){
        if(wanArr.length == i) {
            tempLength = getFlagArrs(qianArr, arrLength - i);
        }
    }

    return tempLength.length;
}
function zhushu_gd11x5_rxbzwdt(){
    var arrLength=8;
    var tempLength = 0;
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });

    if(wanArr.length <= 0 || qianArr.length <= 0){
        return 0;
    }

    for(var i = 0; i < arrLength; i++){
        if(wanArr.length == i) {
            tempLength = getFlagArrs(qianArr, arrLength - i);
        }
    }

    return tempLength.length;
}



function zhushu_gd11x5_rxezwdt() {
    var newArr = [];
    var tempStr = '';
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });
    if (wanArr.length <= 0 || qianArr.length <= 0) {
        return 0;
    }
    for (var i = 0; i < wanArr.length; i++) {
        for (var n = 0; n < qianArr.length; n++) {
            if (parseInt(wanArr[i]) != parseInt(qianArr[n])) {
                newArr.push(wanArr[i] + '' + qianArr[n]);
            }
        }
    }

    return newArr.length;
}

function zhushu_gd11x5_rxszsdt() {
    var newArr = [];
    var tempStr = '';
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });

    if (wanArr.length <= 0 || qianArr.length <= 0) {
        return 0;
    }

    if (wanArr.length == 2) {
        for (var m = 0; m < qianArr.length; m++) {
            newArr.push(wanArr[0] + '' + wanArr[1] + '' + qianArr[m]);
        }
    } else {
        for (var x = 0; x < qianArr.length; x++) {
            for (var y = x; y < qianArr.length; y++) {
                if (qianArr[x] != qianArr[y]) {
                    if (parseInt(qianArr[x]) > parseInt(qianArr[y])) {
                        tempStr = qianArr[x];
                        qianArr[x] = qianArr[y];
                        qianArr[y] = tempStr;
                    }
                    newArr.push(wanArr[0] + '' + qianArr[x] + '' + qianArr[y]);
                }
            }
        }
    }
    return newArr.length;
}


function zhushu_gd11x5_qszuxdt(){
    var newArr = [];
    var tempStr = '';
    var wanArr = [], qianArr = [], baiArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });
    if (wanArr.length <= 0 || qianArr.length <= 0) {
        return 0;
    }

    if (wanArr.length == 2) {
        for (var m = 0; m < qianArr.length; m++) {
            newArr.push(wanArr[0] + '' + wanArr[1] + '' + qianArr[m]);
        }
    } else {
        for (var x = 0; x < qianArr.length; x++) {
            for (var y = x; y < qianArr.length; y++) {
                if (qianArr[x] != qianArr[y]) {
                    if (parseInt(qianArr[x]) > parseInt(qianArr[y])) {
                        tempStr = qianArr[x];
                        qianArr[x] = qianArr[y];
                        qianArr[y] = tempStr;
                    }
                    newArr.push(wanArr[0] + '' + qianArr[x] + '' + qianArr[y]);
                }
            }
        }
    }
    return newArr.length;
}

function zhushu_gd11x5_zszuxdt(){
    var newArr = [];
    var tempStr = '';
    var wanArr = [], qianArr = [], baiArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });
    if (wanArr.length <= 0 || qianArr.length <= 0) {
        return 0;
    }

    if (wanArr.length == 2) {
        for (var m = 0; m < qianArr.length; m++) {
            newArr.push(wanArr[0] + '' + wanArr[1] + '' + qianArr[m]);
        }
    } else {
        for (var x = 0; x < qianArr.length; x++) {
            for (var y = x; y < qianArr.length; y++) {
                if (qianArr[x] != qianArr[y]) {
                    if (parseInt(qianArr[x]) > parseInt(qianArr[y])) {
                        tempStr = qianArr[x];
                        qianArr[x] = qianArr[y];
                        qianArr[y] = tempStr;
                    }
                    newArr.push(wanArr[0] + '' + qianArr[x] + '' + qianArr[y]);
                }
            }
        }
    }
    return newArr.length;
}

function content_gd11x5_qezuxdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).html()));
    });


    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m] );
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "任选胆拖-2中2";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_hezuxdt(){
    var newArr = [];
    var tempStr = '';
    var wanArr = [], qianArr = [], baiArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });
    if(wanArr.length <= 0 || qianArr.length <= 0){
        return 0;
    }

    return wanArr.join(",") + "|" + qianArr.join(",");
}


function zhushu_gd11x5_hszuxdt(){
    var newArr = [];
    var tempStr = '';
    var wanArr = [], qianArr = [], baiArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).html()));
    });
    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).html()));
    });
    if (wanArr.length <= 0 || qianArr.length <= 0) {
        return 0;
    }

    if (wanArr.length == 2) {
        for (var m = 0; m < qianArr.length; m++) {
            newArr.push(wanArr[0] + '' + wanArr[1] + '' + qianArr[m]);
        }
    } else {
        for (var x = 0; x < qianArr.length; x++) {
            for (var y = x; y < qianArr.length; y++) {
                if (qianArr[x] != qianArr[y]) {
                    if (parseInt(qianArr[x]) > parseInt(qianArr[y])) {
                        tempStr = qianArr[x];
                        qianArr[x] = qianArr[y];
                        qianArr[y] = tempStr;
                    }
                    newArr.push(wanArr[0] + '' + qianArr[x] + '' + qianArr[y]);
                }
            }
        }
    }
    return newArr.length;
}

function zhushu_gd11x5_rxszsds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        if (oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3);
            }
        }

    }
    if (tempArr.length <= 0) {
        return 0;
    }
    chongfuArr = tempArr.uniqueArr();

    return chongfuArr.length;
}

function zhushu_gd11x5_rxsizsds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 8) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var foureStr = temp.substr(6, 2);
        if (threeStr != foureStr && twoStr != foureStr && oneStr != foureStr && oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12 && parseInt(foureStr) < 12) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.push(parseInt(foureStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3+threeStr4);

            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }
    var chongfuArr = tempArr.uniqueArr();

    return chongfuArr.length;
}
function zhushu_gd11x5_rxwzwds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 10) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var foureStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        if (oneStr != fiveStr &&twoStr != fiveStr &&foureStr != fiveStr &&threeStr != fiveStr &&threeStr != foureStr &&twoStr != foureStr &&oneStr != foureStr &&oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12 && parseInt(foureStr) < 12 && parseInt(fiveStr) < 12) {

                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.push(parseInt(foureStr));
                sotrArr.push(parseInt(fiveStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
                var threeStr5 = sotrArr[4] >= 10 ? sotrArr[4] : ('0' + sotrArr[4]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3+threeStr4+threeStr5);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }
    var chongfuArr = tempArr.uniqueArr();

    return chongfuArr.length;
}

function zhushu_gd11x5_rxlzwds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 12) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var foureStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        var sixStr = temp.substr(10, 2);
        if (fiveStr != sixStr &&foureStr != sixStr &&threeStr != sixStr &&twoStr != sixStr &&oneStr != sixStr &&oneStr != fiveStr &&twoStr != fiveStr &&foureStr != fiveStr &&threeStr != fiveStr &&threeStr != foureStr &&twoStr != foureStr &&oneStr != foureStr &&oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12 && parseInt(foureStr) < 12 && parseInt(fiveStr) < 12 && parseInt(sixStr) < 12) {

                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.push(parseInt(foureStr));
                sotrArr.push(parseInt(fiveStr));
                sotrArr.push(parseInt(sixStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
                var threeStr5 = sotrArr[4] >= 10 ? sotrArr[4] : ('0' + sotrArr[4]);
                var threeStr6 = sotrArr[5] >= 10 ? sotrArr[5] : ('0' + sotrArr[5]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3+threeStr4+threeStr5+threeStr6);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }
    var chongfuArr = tempArr.uniqueArr();

    return chongfuArr.length;
}

function zhushu_gd11x5_rxqzwds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 14) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var foureStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        var sixStr = temp.substr(10, 2);
        var sevenStr = temp.substr(12, 2);
        if (oneStr != sevenStr &&twoStr != sevenStr &&threeStr != sevenStr &&foureStr != sevenStr &&sixStr != sevenStr &&fiveStr != sevenStr &&fiveStr != sixStr &&foureStr != sixStr &&threeStr != sixStr &&twoStr != sixStr &&oneStr != sixStr &&oneStr != fiveStr &&twoStr != fiveStr &&foureStr != fiveStr &&threeStr != fiveStr &&threeStr != foureStr &&twoStr != foureStr &&oneStr != foureStr &&oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if(parseInt(oneStr)<12&&parseInt(twoStr)<12&& parseInt(threeStr)<12&&parseInt(foureStr)<12&&parseInt(fiveStr)<12&&parseInt(sixStr)<12&&parseInt(sevenStr)<12) {

                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.push(parseInt(foureStr));
                sotrArr.push(parseInt(fiveStr));
                sotrArr.push(parseInt(sixStr));
                sotrArr.push(parseInt(sevenStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
                var threeStr5 = sotrArr[4] >= 10 ? sotrArr[4] : ('0' + sotrArr[4]);
                var threeStr6 = sotrArr[5] >= 10 ? sotrArr[5] : ('0' + sotrArr[5]);
                var threeStr7 = sotrArr[6] >= 10 ? sotrArr[6] : ('0' + sotrArr[6]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3+threeStr4+threeStr5+threeStr6+threeStr7);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }
    var chongfuArr = tempArr.uniqueArr();

    return chongfuArr.length;
}

function zhushu_gd11x5_rxbzwds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 16) {

                newArr.push(arr_new[i]);


        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var foureStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        var sixStr = temp.substr(10, 2);
        var sevenStr = temp.substr(12, 2);
        var eitStr = temp.substr(14, 2);
        if (sevenStr != eitStr &&sixStr != eitStr &&fiveStr != eitStr &&foureStr != eitStr &&threeStr != eitStr &&twoStr != eitStr &&oneStr != eitStr &&oneStr != sevenStr &&twoStr != sevenStr &&threeStr != sevenStr &&foureStr != sevenStr &&sixStr != sevenStr &&fiveStr != sevenStr &&fiveStr != sixStr &&foureStr != sixStr &&threeStr != sixStr &&twoStr != sixStr &&oneStr != sixStr &&oneStr != fiveStr &&twoStr != fiveStr &&foureStr != fiveStr &&threeStr != fiveStr &&threeStr != foureStr &&twoStr != foureStr &&oneStr != foureStr &&oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if(parseInt(oneStr)<12&&parseInt(twoStr)<12&& parseInt(threeStr)<12&&parseInt(foureStr)<12&&parseInt(fiveStr)<12&&parseInt(sixStr)<12&&parseInt(sevenStr)<12&&parseInt(eitStr)<12) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.push(parseInt(foureStr));
                sotrArr.push(parseInt(fiveStr));
                sotrArr.push(parseInt(sixStr));
                sotrArr.push(parseInt(sevenStr));
                sotrArr.push(parseInt(eitStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
                var threeStr5 = sotrArr[4] >= 10 ? sotrArr[4] : ('0' + sotrArr[4]);
                var threeStr6 = sotrArr[5] >= 10 ? sotrArr[5] : ('0' + sotrArr[5]);
                var threeStr7 = sotrArr[6] >= 10 ? sotrArr[6] : ('0' + sotrArr[6]);
                var threeStr8 = sotrArr[7] >= 10 ? sotrArr[7] : ('0' + sotrArr[7]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3+threeStr4+threeStr5+threeStr6+threeStr7+threeStr8);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }
    var chongfuArr = tempArr.uniqueArr();

    return chongfuArr.length;
}


/**
 * 注数 前二-直选单式
 */
function zhushu_gd11x5_qezxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if (oneStr != twoStr ) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12) {
                tempArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    return tempArr.length;
}


function gd11x5_zhushu_rxyzyds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);


        if (parseInt(oneStr) < 12 ) {
            tempArr.push(newArr[n]);
        }
    }

    if (newArr.length <= 0) {
        return 0;
    }

    return newArr.length;
}

function zhushu_ssqds(){
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,' ',:,：]/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 13) {
            newArr.push(arr_new[i]);
        }
    }

    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var foureStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        var sixStr = temp.substr(11, 2);
        if (oneStr != fiveStr && twoStr != fiveStr && foureStr != fiveStr && threeStr != fiveStr && threeStr != foureStr && twoStr != foureStr && oneStr != foureStr && oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 34 && parseInt(twoStr) < 34 && parseInt(threeStr) < 34 && parseInt(foureStr) < 34 && parseInt(fiveStr) < 34 && parseInt(sixStr) < 17) {
                tempArr.push(oneStr + twoStr + threeStr + foureStr + fiveStr + sixStr);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }
    var newArrT = tempArr.uniqueArr();

    return newArrT.length;
}


function zhushu_gd11x5_rxezeds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        }
    }

    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if (oneStr != twoStr ) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                tempArr.push(oneStr1 + twoStr2);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    var chongfuArr = tempArr.uniqueArr();
    return chongfuArr.length;
}


/**
 * 注数 前二-直选单式
 */
function zhushu_gd11x5_hezxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if (oneStr != twoStr ) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 ) {
                tempArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    return tempArr.length;
}




/**
 * 注数 后三-直选单式
 */
function zhushu_gd11x5_hszxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];

    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');

    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        if (oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12) {
                tempArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    return tempArr.length;
}

/**
 * 注数 中三-直选单式
 */
function zhushu_gd11x5_zszxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var tempArr = [];
    var newArr = [];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        if (oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12) {
                tempArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    return tempArr.length;
}



/**
 * 注数-直选复式
 */
function zhushu_q2zxfs() {
    var tempArr = [];
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;

    if (wanLength <= 0 || qianLength <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        for (var i1 = 0; i1 < qianArr.length; i1++) {
            tempArr.push(wanArr[i] + "" + qianArr[i1]);
        }
    }
    return tempArr.length;
}

/**
 * 注数 前二-直选复式
 */
function zhushu_qezxfs() {
    var tempArr = [];
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1002 ul li[data-name = '亚军'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;

    if (wanLength <= 0 || qianLength <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        for (var i1 = 0; i1 < qianArr.length; i1++) {
            if (wanArr[i] != qianArr[i1])
                tempArr.push(wanArr[i] + "," + qianArr[i1]);
        }
    }
    return tempArr.length;
}
/**
 * 注数 前三-直选复式
 */
function zhushu_gd11x5_zszxfs() {
    var tempArr = [];
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".recl-1002 ul li[data-name = '第二位'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第三位'] span.acti"), function () {
        qianArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第四位'] span.acti"), function () {
        baiArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;

    if (wanLength <= 0 || qianLength <= 0 || baiLength <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        for (var m = 0; m < qianArr.length; m++) {
            for (var n = 0; n < baiArr.length; n++) {
                if (wanArr[i] != qianArr[m] && wanArr[i] != baiArr[n] && baiArr[n] != qianArr[m])
                    tempArr.push(wanArr[i] + "," + qianArr[m] + "," + baiArr[n]);
            }
        }
    }
    return tempArr.length;
}



/**
 * 注数 前三-直选复式
 */
function gd11x5_zhushu_qszxfs() {
    var tempArr = [];
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".recl-1002 ul li[data-name = '第一位'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第二位'] span.acti"), function () {
        qianArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第三位'] span.acti"), function () {
        baiArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;

    if (wanLength <= 0 || qianLength <= 0 || baiLength <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        for (var m = 0; m < qianArr.length; m++) {
            for (var n = 0; n < baiArr.length; n++) {
                if (wanArr[i] != qianArr[m] && wanArr[i] != baiArr[n] && baiArr[n] != qianArr[m])
                    tempArr.push(wanArr[i] + "," + qianArr[m] + "," + baiArr[n]);
            }
        }
    }
    return tempArr.length;
}

/**
 * 注数 前二-直选复式
 */
function gd11x5_zhushu_qezxfs() {
    var tempArr = [];
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '第一位'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第二位'] span.acti"), function () {
        qianArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;


    if (wanLength <= 0 || qianLength <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        for (var m = 0; m < qianArr.length; m++) {
                if (wanArr[i] != qianArr[m] )
                    tempArr.push(wanArr[i] + "," + qianArr[m]);
        }
    }
    return tempArr.length;
}

/**
 * 注数 后二-直选复式
 */
function zhushu_gd11x5_hezxfs() {
    var tempArr = [];
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '第四位'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第五位'] span.acti"), function () {
        qianArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;


    if (wanLength <= 0 || qianLength <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        for (var m = 0; m < qianArr.length; m++) {
            if (wanArr[i] != qianArr[m] )
                tempArr.push(wanArr[i] + "," + qianArr[m]);
        }
    }
    return tempArr.length;
}


/**
 * 注数 前三-直选复式
 */
function zhushu_gd11x5_hszxfs() {
    var tempArr = [];
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".recl-1002 ul li[data-name = '第三位'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第四位'] span.acti"), function () {
        qianArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第五位'] span.acti"), function () {
        baiArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;

    if (wanLength <= 0 || qianLength <= 0 || baiLength <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        for (var m = 0; m < qianArr.length; m++) {
            for (var n = 0; n < baiArr.length; n++) {
                if (wanArr[i] != qianArr[m] && wanArr[i] != baiArr[n] && baiArr[n] != qianArr[m])
                    tempArr.push(wanArr[i] + "," + qianArr[m] + "," + baiArr[n]);
            }
        }
    }
    return tempArr.length;
}



/**
 * 注数 前三-直选复式
 */
function zhushu_qszxfs() {
    var tempArr = [];
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".recl-1002 ul li[data-name = '冠军'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '亚军'] span.acti"), function () {
        qianArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '季军'] span.acti"), function () {
        baiArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;

    if (wanLength <= 0 || qianLength <= 0 || baiLength <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        for (var m = 0; m < qianArr.length; m++) {
            for (var n = 0; n < baiArr.length; n++) {
                if (wanArr[i] != qianArr[m] && wanArr[i] != baiArr[n] && baiArr[n] != qianArr[m])
                    tempArr.push(wanArr[i] + "," + qianArr[m] + "," + baiArr[n]);
            }
        }
    }
    return tempArr.length;
}

//=======================前3=======================
/**
 * 注数-特殊号
 */
function zhushu_q3tsh() {
    var tsArr = [];
    $.each($(".cl-1015-tsh ul li.tsh_li[data-name = '特殊号'] span.acti_tsh"), function (index, value) {
        tsArr.push($.trim($(this).html()));
    });
    var zlLength = tsArr.length;
    if (zlLength <= 0) {
        return 0;
    }
    return tsArr.length;
}

/**
 * 注数-和值尾数
 */
function zhushu_q3hzws() {
    var wsArr = [], newArr = [];
    $.each($(".cl-1014-hzws ul li[data-name = '和值尾数'] span.acti"), function (index, value) {
        wsArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = wsArr.length;
    if (zlLength < 0) {
        return 0;
    }
    return zlLength;
}

/**
 * 注数-组选包胆
 */
function zhushu_q3zxbd() {
    var baoDanArr = [], newArr = [];
    $.each($(".cl-1013-zxbd ul li[data-name = '包胆'] span.acti"), function (index, value) {
        baoDanArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = baoDanArr.length;
    if (zlLength < 0) {
        return 0;
    }
    newArr = getZxbdNewArrs(baoDanArr);
    return newArr.length;
}

/**
 * 注数-组选和值
 */
function zhushu_q3zuxhz() {
    var fuShiArr = [], newArr = [];
    $.each($(".cl-1012-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        fuShiArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = fuShiArr.length;
    if (zlLength <= 0) {
        return 0;
    }
    newArr = getZxhzNewArrs(fuShiArr);
    return newArr.length;
}

/**
 * 注数-混合组选
 */
function zhushu_q3hhzx() {
    var textStr = $(".cl-1011-hhzx .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '';
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr || oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        }
    }
    return tempArr.length;
}

/**
 * 注数-组六单式
 */
function zhushu_q3z6ds() {
    var textStr = $(".cl-1010-zlds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        }
    }
    return tempArr.length;
}

/**
 * 注数-组san单式
 */
function zhushu_gd11x5_qszuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [] ,chongfuArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        }
    }

    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        if (oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3);
            }
        }

    }
    if (tempArr.length <= 0) {
        return 0;
    }
    chongfuArr = tempArr.uniqueArr();

    return chongfuArr.length;
}

/**
 * 注数-组二单式
 */
function zhushu_gd11x5_qezuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if (oneStr != twoStr ) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                tempArr.push(oneStr1 + twoStr2);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    var chongfuArr = tempArr.uniqueArr();
    return chongfuArr.length;
}
/**
 * 注数-组二单式
 */
function zhushu_gd11x5_hezuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if (oneStr != twoStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 ) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                tempArr.push(oneStr1 + twoStr2);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    var chongfuArr = tempArr.uniqueArr();
    return chongfuArr.length;
}

/**
 * 注数-组sa单式
 */
function zhushu_gd11x5_hszuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        if (oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    var chongfuArr = tempArr.uniqueArr();
    return chongfuArr.length;
}

/**
 * 注数-组sa单式
 */
function zhushu_gd11x5_zszuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        if (oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 12 && parseInt(twoStr) < 12 && parseInt(threeStr) < 12) {
                var sotrArr = [];
                sotrArr.push(parseInt(oneStr));
                sotrArr.push(parseInt(twoStr));
                sotrArr.push(parseInt(threeStr));
                sotrArr.sort();

                var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
                var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
                var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
                tempArr.push(oneStr1 + twoStr2 + threeStr3);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    var chongfuArr = tempArr.uniqueArr();
    return chongfuArr.length;
}

/**
 * 注数-组六复式
 */
function zhushu_q3z6fs() {
    var fuShiArr = [], newArr = [];
    $.each($(".cl-1009-zlfs ul li[data-name = '组六'] span.acti"), function (index, value) {
        fuShiArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = fuShiArr.length;
    if (zlLength < 3) {
        return 0;
    }
    newArr = getZuLiuNewArrs(fuShiArr);

    return newArr.length;
}

/**
 * 注数-组三单式
 */
function zhushu_q3z3ds() {
    var zhushu = 0;
    var textStr = $(".cl-1008-zsds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        }
    }

    return tempArr.length;
}


/**
 * 注数-组三复式
 */
function zhushu_q3z3fs() {
    var fuShiArr = [], newArr = [];
    $.each($(".cl-1007-zsfs ul li[data-name = '组三'] span.acti"), function (index, value) {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var heZhiLength = fuShiArr.length;
    if (heZhiLength <= 1) {
        return 0;
    }
    newArr = getZuXuanNewArrs(fuShiArr);
    return newArr.length;
}

/**
 * 注数-组三复式
 */
function zhushu_gd11x5_qszuxfs() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var heZhiLength = fuShiArr.length;
    if (heZhiLength <= 1) {
        return 0;
    }

    newArr = getZuLiuNewArrs(fuShiArr);
    var zhushu=newArr.length;
    return zhushu;
}


/**
 * 注数-组三复式
 */
function zhushu_gd11x5_rxszs() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '选3中3'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var heZhiLength = fuShiArr.length;
    if (heZhiLength <= 1) {
        return 0;
    }

    newArr = getZuLiuNewArrs(fuShiArr);
    var zhushu=newArr.length;
    return zhushu;
}

/**
 * 注数-组三复式
 */
function zhushu_gd11x5_rxsizs() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '选4中4'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var zlLength = fuShiArr.length;
    if (zlLength < 4) {
        return 0;
    }
    var tim = getFlagArrs(fuShiArr, 4);

    return tim.length;
}

function zhushu_gd11x5_rxwzw() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '选5中5'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var zlLength = fuShiArr.length;
    if (zlLength < 4) {
        return 0;
    }
    var tim = getFlagArrs(fuShiArr, 5);

    return tim.length;
}

function zhushu_gd11x5_rxqzw() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '选7中5'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var zlLength = fuShiArr.length;
    if (zlLength < 6) {
        return 0;
    }
    var tim = getFlagArrs(fuShiArr, 7);
   /* for (var n1 = 0; n1 < fuShiArr.length; n1++) {
        for (var n2 = 0; n2 < fuShiArr.length; n2++) {
            for (var n3 = 0; n3 < fuShiArr.length; n3++) {
                for (var n4 = 0; n4 < fuShiArr.length; n4++) {
                    for (var n5 = 0; n5 < fuShiArr.length; n5++) {
                        for (var n6 = 0; n6 < fuShiArr.length; n6++) {
                            for (var n7 = 0; n7 < fuShiArr.length; n7++) {
                                if (fuShiArr[n6] != fuShiArr[n7] &&fuShiArr[n5] != fuShiArr[n7] &&fuShiArr[n4] != fuShiArr[n7] &&fuShiArr[n3] != fuShiArr[n7] &&fuShiArr[n2] != fuShiArr[n7] &&fuShiArr[n1] != fuShiArr[n7] &&fuShiArr[n1] != fuShiArr[n6] &&fuShiArr[n5] != fuShiArr[n6] &&fuShiArr[n4] != fuShiArr[n6] &&fuShiArr[n3] != fuShiArr[n6] &&fuShiArr[n2] != fuShiArr[n6] &&fuShiArr[n2] != fuShiArr[n5] &&fuShiArr[n3] != fuShiArr[n5] &&fuShiArr[n4] != fuShiArr[n5] &&fuShiArr[n1] != fuShiArr[n5] &&fuShiArr[n1] != fuShiArr[n2] && fuShiArr[n1] != fuShiArr[n3] && fuShiArr[n1] != fuShiArr[n4] && fuShiArr[n2] != fuShiArr[n3] && fuShiArr[n2] != fuShiArr[n4] && fuShiArr[n3] != fuShiArr[n4]) {
                            var arr = [];
                            arr.push(fuShiArr[n1]);
                            arr.push(fuShiArr[n2]);
                            arr.push(fuShiArr[n3]);
                            arr.push(fuShiArr[n4]);
                            arr.push(fuShiArr[n5]);
                            arr.push(fuShiArr[n6]);
                            arr.push(fuShiArr[n7]);
                            arr.sort();
                            newArr.push(arr.join(""));
                        }
                            }
                        }
                    }
                }
            }
        }
    }*/

    return tim.length;
}

function zhushu_gd11x5_rxbzw() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '选8中5'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var zlLength = fuShiArr.length;
    if (zlLength < 7) {
        return 0;
    }
    var tim = getFlagArrs(fuShiArr, 8);

    return tim.length;
}







function zhushu_gd11x5_rxlzw() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '选6中5'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var zlLength = fuShiArr.length;
    if (zlLength < 5) {
        return 0;
    }
    var tim = getFlagArrs(fuShiArr, 6);

    return tim.length;
}


function zhushu_gd11x5_qezuxfs() {
    var tempArr = [], zuxArr = [];
    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function () {
        zuxArr.push($.trim($(this).find("i").html()));
    });

    var xLength = zuxArr.length;
    if (xLength < 2) {
        return 0;
    }

    for (var i = 0; i < zuxArr.length; i++) {
        for (var i1 = 0; i1 < zuxArr.length; i1++) {
            if (zuxArr[i] != zuxArr[i1]) {
                var xArr = [];
                xArr.push(zuxArr[i]);
                xArr.push(zuxArr[i1]);
                xArr.sort();
                tempArr.push(xArr.join(""));
            }
        }
    }
    tempArr = tempArr.uniqueArr();
    return tempArr.length;
}

function zhushu_gd11x5_hezuxfs() {
    var tempArr = [], zuxArr = [];
    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function () {
        zuxArr.push($.trim($(this).find("i").html()));
    });

    var xLength = zuxArr.length;
    if (xLength < 2) {
        return 0;
    }

    for (var i = 0; i < zuxArr.length; i++) {
        for (var i1 = 0; i1 < zuxArr.length; i1++) {
            if (zuxArr[i] != zuxArr[i1]) {
                var xArr = [];
                xArr.push(zuxArr[i]);
                xArr.push(zuxArr[i1]);
                xArr.sort();
                tempArr.push(xArr.join(""));
            }
        }
    }
    tempArr = tempArr.uniqueArr();
    return tempArr.length;
}


function zhushu_gd11x5_rxeze() {
    var tempArr = [], zuxArr = [];
    $.each($(".recl-1002 ul li[data-name = '选2中2'] span.acti"), function () {
        zuxArr.push($.trim($(this).find("i").html()));
    });

    var xLength = zuxArr.length;
    if (xLength < 2) {
        return 0;
    }

    for (var i = 0; i < zuxArr.length; i++) {
        for (var i1 = 0; i1 < zuxArr.length; i1++) {
            if (zuxArr[i] != zuxArr[i1]) {
                var xArr = [];
                xArr.push(zuxArr[i]);
                xArr.push(zuxArr[i1]);
                xArr.sort();
                tempArr.push(xArr.join(""));
            }
        }
    }
    tempArr = tempArr.uniqueArr();
    return tempArr.length;
}


/**
 * 注数-组三复式
 */
function zhushu_gd11x5_zszuxfs() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var heZhiLength = fuShiArr.length;
    if (heZhiLength <= 1) {
        return 0;
    }

    newArr = getZuLiuNewArrs(fuShiArr);
    var zhushu=newArr.length;
    return zhushu;
}


/**
 * 注数-组三复式
 */
function zhushu_gd11x5_hszuxfs() {
    var fuShiArr = [], newArr = [];
    var tim =[];
    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function () {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var heZhiLength = fuShiArr.length;
    if (heZhiLength <= 1) {
        return 0;
    }

    newArr = getZuLiuNewArrs(fuShiArr);
    var zhushu=newArr.length;
    return zhushu;
}

/**
 * 注数-直选跨度
 */
function zhushu_q3zxkd() {
    var newArr = [];
    var kaDuArr = [];
    $.each($(".cl-1006-zxkd ul li[data-name = '跨度'] span.acti"), function (index, value) {
        kaDuArr.push($.trim($(this).find("i").html()));
    });
    if (kaDuArr.length <= 0) {
        return 0;
    }
    newArr = getKaduNewArrs(kaDuArr);
    return newArr.length;
}

/**
 * 注数-直选和值
 */
function zhushu_q3zxhz() {
    var heZhiArr = [], newArr = [];
    $.each($(".cl-1005-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        heZhiArr.push($.trim($(this).find("i").html()));
    });

    var heZhiLength = heZhiArr.length;
    if (heZhiLength <= 0) {
        return 0;
    }

    newArr = getHezNewArrs(heZhiArr);
    return newArr.length;
}

/**
 * 注数-前3组合
 */
function zhushu_q3zh() {
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;

    if (wanLength <= 0 || qianLength <= 0 || baiLength <= 0) {
        return;
    }

    var newArr = getHszhNewArrs(wanArr, qianArr, baiArr);

    return newArr.length;
}

/**
 * 注数-前3直选单式
 */
function zhushu_q3zxds() {
    var textStr = $(".content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorStr = '';
    var zhushu = 0;
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    return newArr.length;
}

/**
 * 注数-前3直选复式
 */
function zhushu_q3zxfs() {
    var newArr = [];
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;
    newArr = getThreeNewArrs(wanArr, qianArr, baiArr);
    return newArr.length;
}


/*********************************/
/**********后三**********/

/**
 * 注数-特殊号
 */
function zhushu_h3tsh() {
    var tsArr = [];
    $.each($(".cl-1015-tsh ul li.tsh_li[data-name = '特殊号'] span.acti_tsh"), function (index, value) {
        tsArr.push($.trim($(this).html()));
    });
    var zlLength = tsArr.length;
    if (zlLength <= 0) {
        return 0;
    }
    return tsArr.length;
}

/**
 * 注数-和值尾数
 */
function zhushu_h3hzws() {
    var wsArr = [], newArr = [];
    $.each($(".cl-1014-hzws ul li[data-name = '和值尾数'] span.acti"), function (index, value) {
        wsArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = wsArr.length;
    if (zlLength < 0) {
        return 0;
    }
    return zlLength;
}

/**
 * 注数-组选包胆
 */
function zhushu_h3zxbd() {
    var baoDanArr = [], newArr = [];
    $.each($(".cl-1013-zxbd ul li[data-name = '包胆'] span.acti"), function (index, value) {
        baoDanArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = baoDanArr.length;
    if (zlLength < 0) {
        return 0;
    }
    newArr = getZxbdNewArrs(baoDanArr);
    return newArr.length;
}

/**
 * 注数-组选和值
 */
function zhushu_h3zuxhz() {
    var fuShiArr = [], newArr = [];
    $.each($(".cl-1012-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        fuShiArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = fuShiArr.length;
    if (zlLength <= 0) {
        return 0;
    }
    newArr = getZxhzNewArrs(fuShiArr);
    return newArr.length;
}

/**
 * 注数-混合组选
 */
function zhushu_h3hhzx() {
    var textStr = $(".cl-1011-hhzx .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '';
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr || oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        }
    }
    return tempArr.length;
}

/**
 * 注数-组六单式
 */
function zhushu_h3z6ds() {
    var textStr = $(".cl-1010-zlds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        }
    }
    return tempArr.length;
}

/**
 * 注数-组六复式
 */
function zhushu_h3z6fs() {
    var fuShiArr = [], newArr = [];
    $.each($(".cl-1009-zlfs ul li[data-name = '组六'] span.acti"), function (index, value) {
        fuShiArr.push($.trim($(this).find("i").html()));
    });
    var zlLength = fuShiArr.length;
    if (zlLength < 3) {
        return 0;
    }
    newArr = getZuLiuNewArrs(fuShiArr);
    return newArr.length;
}

/**
 * 注数-组三单式
 */
function zhushu_h3z3ds() {
    var zhushu = 0;
    var textStr = $(".cl-1008-zsds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        }
    }

    return tempArr.length;
}


/**
 * 注数-组三复式
 */
function zhushu_h3z3fs() {
    var fuShiArr = [], newArr = [];
    $.each($(".cl-1007-zsfs ul li[data-name = '组三'] span.acti"), function (index, value) {
        fuShiArr.push($.trim($(this).find("i").html()));
    });

    var heZhiLength = fuShiArr.length;
    if (heZhiLength <= 1) {
        return 0;
    }
    newArr = getZuXuanNewArrs(fuShiArr);
    return newArr.length;
}

/**
 * 注数-直选跨度
 */
function zhushu_h3zxkd() {
    var newArr = [];
    var kaDuArr = [];
    $.each($(".cl-1006-zxkd ul li[data-name = '跨度'] span.acti"), function (index, value) {
        kaDuArr.push($.trim($(this).find("i").html()));
    });
    if (kaDuArr.length <= 0) {
        return 0;
    }
    newArr = getKaduNewArrs(kaDuArr);
    return newArr.length;
}

/**
 * 注数-直选和值
 */
function zhushu_h3zxhz() {
    var heZhiArr = [], newArr = [];
    $.each($(".cl-1005-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        heZhiArr.push($.trim($(this).find("i").html()));
    });

    var heZhiLength = heZhiArr.length;
    if (heZhiLength <= 0) {
        return 0;
    }

    newArr = getHezNewArrs(heZhiArr);
    return newArr.length;
}

/**
 * 注数-后3组合
 */
function zhushu_h3zh() {
    var baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var baiLength = baiArr.length;
    var shiLength = shiArr.length;
    var geLength = geArr.length;

    if (baiLength <= 0 || shiLength <= 0 || geLength <= 0) {
        return;
    }

    var newArr = getHszhNewArrs(baiArr, shiArr, geArr);
    return newArr.length;
}

/**
 * 注数-后3直选单式
 */
function zhushu_h3zxds() {
    var textStr = $(".content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorStr = '';
    var zhushu = 0;
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    return newArr.length;
}

/**
 * 注数-后3直选复式
 */
function zhushu_h3zxfs() {
    var newArr = [];
    var baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var baiLength = baiArr.length;
    var shiLength = shiArr.length;
    var geLength = geArr.length;
    if (baiLength <= 0 || shiLength <= 0 || geLength <= 0) {
        return 0;
    }
    newArr = getThreeNewArrs(baiArr, shiArr, geArr);
    return newArr.length;
}

/**
 * 注数-5星直选单式
 */
function zhushu_5xzxds() {
    var textStr = $(".content_jiang .content_tex").val();
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 5) {
            newArr.push(arr_new[i]);
        }
    }
    return newArr.length;
}

/**
 * 注数-4星直选单式
 */
function zhushu_4xzxds() {
    var textStr = $(".content_jiang .content_tex").val();
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        }
    }
    return newArr.length;
}
function zhushu_ssqfs(){
    var hq=[],lq=[];
    $.each($(".Pick ul li[data-name = '红球'] span.acti"), function () {
        hq.push($.trim($(this).find("i").html()));
    });

    $.each($(".Pick ul li[data-name = '蓝球'] span.acti"), function () {
        lq.push($.trim($(this).find("i").html()));
    });
    if(hq.length <= 0 || lq.length <= 0){
        return 0;
    }

   var  hqLength = getFlagArrs(hq, 5);
   var  lqLength = getFlagArrs(lq, 1);
   var totalLength = hqLength.length * lqLength.length;
    return totalLength;
}
function suiji_ssqfs(){
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [],arrTsh1=[];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33'];
    arrTsh1 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11','12','13','14','15','16'];
    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh6 = arrTsh1[parseInt(Math.random() * 16)];
        if (zhiTsh5 != zhiTsh4&&zhiTsh5 != zhiTsh3&&zhiTsh4 != zhiTsh3&&zhiTsh1 != zhiTsh2&&zhiTsh1 != zhiTsh3&&zhiTsh1 != zhiTsh4&&zhiTsh1 != zhiTsh5&&zhiTsh2 != zhiTsh5&&zhiTsh2 != zhiTsh3&&zhiTsh2 != zhiTsh4&&zhiTsh2 != zhiTsh5) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3+" ");
            newArr.push(zhiTsh4+" ");
            newArr.push(zhiTsh5);
            newArr.push(zhiTsh6);
        }

    }

    showPlayName = "红蓝直选/复式";
    showContent = "红码: (" + newArr[0] + " "+newArr[1]+" "+newArr[2]+" "+newArr[3]+" "+newArr[4]+") 蓝码: (" + newArr[5] + ") ";
    betContent = newArr[0] + "" + newArr[1]+"" +newArr[2]+"" +newArr[3]+"" +newArr[4]+"," +newArr[5];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_ssqds(){
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [],arrTsh1=[];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33'];
    arrTsh1 = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11','12','13','14','15','16'];
    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 33)];
        var zhiTsh6 = arrTsh1[parseInt(Math.random() * 16)];
        if (zhiTsh5 != zhiTsh4&&zhiTsh5 != zhiTsh3&&zhiTsh4 != zhiTsh3&&zhiTsh1 != zhiTsh2&&zhiTsh1 != zhiTsh3&&zhiTsh1 != zhiTsh4&&zhiTsh1 != zhiTsh5&&zhiTsh2 != zhiTsh5&&zhiTsh2 != zhiTsh3&&zhiTsh2 != zhiTsh4&&zhiTsh2 != zhiTsh5) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3+" ");
            newArr.push(zhiTsh4+" ");
            newArr.push(zhiTsh5);
            newArr.push(zhiTsh6);

        }

    }

    showPlayName = "红蓝直选/单式";
    showContent = "红码: (" + newArr[0] + " "+newArr[1]+" "+newArr[2]+" "+newArr[3]+" "+newArr[4]+") 蓝码: (" + newArr[5] + ") ";
    betContent = newArr[0] + "" + newArr[1]+"" +newArr[2]+"" +newArr[3]+"" +newArr[4]+"," +newArr[5];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function content_ssqfs(){
    var hq=[],lq=[];
    $.each($(".Pick ul li[data-name = '红球'] span.acti"), function () {
        hq.push($.trim($(this).find("i").html()));
    });

    $.each($(".Pick ul li[data-name = '蓝球'] span.acti"), function () {
        lq.push($.trim($(this).find("i").html()));
    });

    if (hq.length <= 0 || lq.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        hq.join(" "),
        lq.join(" ")
    ];

    showPlayName = "红蓝直选/复式";
    showContent = "红码: ({0}), 蓝码: ({1})".format(arr[0], arr[1]);
    betContent = "{0},{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };



}


/**
 * 注数-5星直选复式
 */
function zhushu_5xzxfs() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var wanLength = wanArr.length;
    var qianLength = qianArr.length;
    var baiLength = baiArr.length;
    var shiLength = shiArr.length;
    var geLength = geArr.length;

    if (wanLength <= 0 || qianLength <= 0 || baiLength <= 0 || shiLength <= 0 || geLength <= 0) {
        return 0;
    }

    var newArr = getNewArrs(wanArr, qianArr, baiArr, shiArr, geArr);
    if (typeof newArr == "undefined" || newArr.length <= 0) {
        if (typeof clearStateTouZhu == 'function') {
            clearStateTouZhu();
        }
        return;
    }
    return newArr.length;
}

/**
 * 注数-4星直选复式
 */
function zhushu_4xzxfs() {
    var qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var qianLength = qianArr.length;
    var baiLength = baiArr.length;
    var shiLength = shiArr.length;
    var geLength = geArr.length;

    if (qianLength <= 0 || baiLength <= 0 || shiLength <= 0 || geLength <= 0) {
        return 0;
    }

    var newArr = getFourNewArrs(qianArr, baiArr, shiArr, geArr);
    if (typeof newArr == "undefined" || newArr.length <= 0) {
        if (typeof clearStateTouZhu == 'function') {
            clearStateTouZhu();
        }
        return;
    }
    return newArr.length;
}

function zhushu_qy() {
    var qyArr = [];
    $.each($(".cl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        qyArr.push($.trim($(this).find("i").html()));
    });


    var qianLength = qyArr.length;

    if (qianLength <= 0) {
        return 0;
    }

    return qyArr.length;
}

function zhushu_jspk10_qy() {
    var qyArr = [];
    $.each($(".cl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        qyArr.push($.trim($(this).find("i").html()));
    });


    var qianLength = qyArr.length;

    if (qianLength <= 0) {
        return 0;
    }

    return qyArr.length;
}



/**
 * 注数-前二大小单双
 */
function zhushu_q2dxds() {
    var dxdsWArr = [], dxdsQArr = [], tempArr = [];
    $.each($(".recl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m]);
        }
    }
    return tempArr.length;
}

/**
 * 注数-后二大小单双
 */
function zhushu_h2dxds() {
    var dxdsSArr = [], dxdsGArr = [];
    $.each($(".recl-1003-h2dxds ul li[data-name = '十'] span.acti"), function (index, value) {
        dxdsSArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1003-h2dxds ul li[data-name = '个'] span.acti"), function (index, value) {
        dxdsGArr.push($.trim($(this).find("i").html()));
    });
    return dxdsSArr.length * dxdsGArr.length;
}

/**
 * 注数-前三大小单双
 */
function zhushu_q3dxds() {
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [];
    $.each($(".recl-1004-q3dxds ul li[data-name = '万'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1004-q3dxds ul li[data-name = '千'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1004-q3dxds ul li[data-name = '百'] span.acti"), function (index, value) {
        dxdsBArr.push($.trim($(this).find("i").html()));
    });
    return dxdsWArr.length * dxdsQArr.length * dxdsBArr.length;
}

/**
 * 注数-后三大小单双
 */
function zhushu_h3dxds() {
    var dxdsBArr = [], dxdsSArr = [], dxdsGArr = [];
    $.each($(".recl-1005-h3dxds ul li[data-name = '百'] span.acti"), function (index, value) {
        dxdsBArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1005-h3dxds ul li[data-name = '十'] span.acti"), function (index, value) {
        dxdsSArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1005-h3dxds ul li[data-name = '个'] span.acti"), function (index, value) {
        dxdsGArr.push($.trim($(this).find("i").html()));
    });
    return dxdsBArr.length * dxdsSArr.length * dxdsGArr.length;
}

//=============================================随机注数算法汇总======================================
// 随机生成注数
function getSuiji(total) {
    var zhushu = 1;
    var plSelName = '';
    var plSelIndex = 0;
    var plSelVal = 0;

    var suijiFun = getPlayPlFun_suiji();
    if (typeof suijiFun == 'undefined') {
        return;
    }

    // 获取随机注数
    for (var i = 0; i < total; ++i) {
        var data = eval(suijiFun + "()");
        if (typeof data == 'undefined' || data.length <= 0) {
            return;
        }

        //位置选择不正确（rx2,rx3,rx4中）
        if (data == -1) {
            return;
        }

        if ($.inArray(playId, [515, 534, 936, 914, 639, 625, 1013, 991, 730, 708, 859, 837]) >= 0) {
            plSelName = data.betContent;
            if (plSelName == '豹子') {
                plSelIndex = 0;
            } else if (plSelName == '顺子') {
                plSelIndex = 1;
            } else if (plSelName == '对子') {
                plSelIndex = 2;
            }

            var tempNum = $("#jiangjin-change").data("plStr");
            plSelVal = (tempNum.split("|"))[plSelIndex];
        } else {
            plSelVal = $("#jiangjin-change").data("value");
        }

        var obj = {};
        //======函数获取=====
        obj.showPlayName = data.showPlayName;
        obj.showContent = data.showContent;
        zhushu = (typeof data.betZhushu != 'undefined' || data.betZhushu > 1) ? data.betZhushu : zhushu;
        obj.betContent = data.betContent;
        obj.betPlayGroupId = data.playGroupId;
        //========动态获取=====
        obj.betPerMoney = $("#inputMoney").data("money");
        obj.betZhushu = zhushu;
        obj.betBeishu = $("#inputBeishu").data("beishu");
        obj.betMode = getSelectMode();
        obj.betTotalMoney = obj.betZhushu * obj.betPerMoney * getMode(obj.betMode) * obj.betBeishu;
        obj.betPlayPl = plSelVal;
        obj.betFandian = $("#fandian-bfb").data("value");
        var strPlId = getPlayPlId();
        if (strPlId.toString().indexOf('|') > 0) {
            obj.betPlayPlId = (strPlId.toString().split("|"))[plSelIndex];
        } else {
            obj.betPlayPlId = getPlayPlId();
        }
        obj.betPlayId = getPlayId();

        // 添加预算
        addYuxuan(obj);
    }

    // 统计右侧注数，金额
    calcAll();

    //改变追号模板内每期总额值
    var optionVal = parseInt($('#lt_zh_qishu').val());
    selectedCheckboxtbzh(optionVal);

    //点击随机数时计算追号总额
    $("#zhInfo .tabs ul li:first-child").trigger('click');
    $('.zhfbzjetxt').html(getFbTotelMoney());
    $('.zhzjetxt').html(getTbTotelMoney());
}

//**********************任选4***********************
/**
 * 任选4-组选4
 */
function suiji_rx4zu4() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkStrArr = [], checkArr = [];
    var arrZux4 = [], str1 = '', str2 = '';
    while (arrZux4.length < 1) {
        var x1 = parseInt(Math.random() * 10);
        var x2 = parseInt(Math.random() * 10);
        if (x1 != x2) {
            arrZux4.push("三重号: (" + x1 + "), 单号: (" + x2 + ")");
            str1 = x1;
            str2 = x2;
        }
    }

    //选取选中checkbox
    $.each($(".re-select-zux4 input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }

    var shu = $("#positioninfo-zux4").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任四组选-组选4";
    showContent = arrZux4.join("");
    betContent = checkStrArr.join(',') + "|" + str1 + "|" + str2;
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    }
}

/**
 * 任选4-组选6
 */
function suiji_rx4zu6() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkStrArr = [], checkArr = [];
    var arrZux6 = [];
    var str1 = '', str2 = '';
    ;
    while (arrZux6.length < 1) {
        var x1 = parseInt(Math.random() * 10);
        var x2 = parseInt(Math.random() * 10);
        if (x1 != x2) {
            arrZux6.push("二重号: (" + x1 + "," + x2 + ")");
            str1 = x1;
            str2 = x2;
        }
    }

    //选取选中checkbox
    $.each($(".re-select-zux6 input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }

    var shu = $("#positioninfo-zux6").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任四组选-组选6";
    showContent = arrZux6.join("");
    betContent = checkStrArr.join(',') + "|" + str1 + "," + str2;
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选4-组选12
 */
function suiji_rx4zu12() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkStrArr = [], checkArr = [];
    var arrZux12 = [];
    var str1 = '', str2 = '';
    while (arrZux12.length < 1) {
        var x1 = parseInt(Math.random() * 10);
        var x2 = parseInt(Math.random() * 10);
        var x3 = parseInt(Math.random() * 10);
        if (x1 != x2 && x1 != x3 && x2 != x3) {
            arrZux12.push("二重号: (" + x1 + "), " + "单号: (" + x2 + "," + x3 + ")");
            str1 = x1;
            str2 = x2 + "," + x3;
        }
    }

    //选取选中checkbox
    $.each($(".re-select-zux12 input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }

    var shu = $("#positioninfo-zux12").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任四组选-组选12";
    showContent = arrZux12.join("");
    betContent = checkStrArr.join(',') + "|" + str1 + "|" + str2;
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选4-组选24
 */
function suiji_rx4zu24() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkStrArr = [], checkArr = [];
    var arrZu6 = [];
    var arrZux24 = [];
    while (arrZux24.length < 1) {
        var x1 = parseInt(Math.random() * 10);
        var x2 = parseInt(Math.random() * 10);
        var x3 = parseInt(Math.random() * 10);
        var x4 = parseInt(Math.random() * 10);
        if (x1 != x2 && x1 != x3 && x1 != x4 && x2 != x3 && x2 != x4 && x3 != x4) {
            arrZux24.push(x1 + "," + x2 + "," + x3 + "," + x4);
        }
    }

    //选取选中checkbox
    $.each($(".re-select-zux24 input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }

    var shu = $("#positioninfo-zux24").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任四组选-组选24";
    showContent = "组选24: (" + arrZux24.join("") + ")";
    betContent = checkStrArr.join(',') + "|" + arrZux24.join(",");
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选4-直选单式
 */
function suiji_rx4zxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkStrArr = [], checkArr = [];
    var arrZu6 = [];
    while (arrZu6.length < 1) {
        var x1 = parseInt(Math.random() * 10);
        var x2 = parseInt(Math.random() * 10);
        var x3 = parseInt(Math.random() * 10);
        var x4 = parseInt(Math.random() * 10);
        arrZu6.push(x1 + "" + x2 + "" + x3 + "" + x4);

    }
    //选取选中checkbox
    $.each($(".re-select-ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }

    var shu = $("#positioninfo-ds").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任四直选-直选单式";
    showContent = "号码: (" + arrZu6[0] + ")";
    betContent = checkStrArr.join(',') + "|" + arrZu6[0];
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选4-直选复式
 */
function suiji_rx4zxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var arr = [];

    while (arr.length < 5) {
        var num1 = parseInt(Math.random() * 10);
        arr.push(num1);
    }

    showPlayName = "任四直选-直选复式";
    showContent = "万位: " + arr[0] + " 千位: " + arr[1] + " 百位: " + arr[2] + " 十位: " + arr[3] + " 个位: " + arr[4];
    betContent = arr[0] + '|' + arr[1] + '|' + arr[2] + '|' + arr[3] + '|' + arr[4];
    betZhushu = 5;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}


//**********************任选3***********************

/**
 * 任选3-组选和值
 */
function suiji_rx3zuxhz() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var hzArr = [], checkStrArr = [], checkArr = [];

    while (hzArr.length < 1) {
        var num1 = parseInt(Math.random() * 26) + 1;
        hzArr.push(num1);
    }
    var newArr = [];
    for (var i = 0; i < hzArr.length; i++) {
        for (var x = 0; x < 10; x++) {
            for (var y = 0; y < 10; y++) {
                for (var y1 = 0; y1 < 10; y1++) {
                    if (x + y + y1 == hzArr[i] && !(x == y && x == y1 && y == y1)) {
                        var arr = [];
                        arr.push(x);
                        arr.push(y);
                        arr.push(y1);
                        arr.sort();
                        newArr.push(arr.join(""));
                    }
                }
            }
        }
    }
    newArr = newArr.uniqueArr();
    //选取选中checkbox
    $.each($(".re-select-zuxhz input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    var shu = $("#positioninfo-zuxhz").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三组选-组选和值";
    showContent = "号码: (" + hzArr[0] + ")";
    betContent = checkStrArr.join(',') + "|" + hzArr[0];
    betZhushu = newArr.length * shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选3-混合组选
 */
function suiji_rx3hhzux() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkStrArr = [], checkArr = [];
    var arrZu6 = [];
    while (arrZu6.length < 1) {
        var x1 = parseInt(Math.random() * 10);
        var x2 = parseInt(Math.random() * 10);
        var x3 = parseInt(Math.random() * 10);
        if (!(x1 == x2 && x2 == x3 && x3 == x2)) {
            arrZu6.push(x1 + "" + x2 + "" + x3);
        }
    }
    //选取选中checkbox
    $.each($(".re-select-hhzux input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    var shu = $("#positioninfo-hhzux").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三直选-混合组选";
    showContent = "号码: (" + arrZu6[0] + ")";
    betContent = checkStrArr.join(',') + "|" + arrZu6.join(',');
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选3-组六单式
 */
function suiji_rx3z6ds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkStrArr = [], checkArr = [];
    var arrZu6 = [];
    while (arrZu6.length < 1) {
        var x1 = parseInt(Math.random() * 10);
        var x2 = parseInt(Math.random() * 10);
        var x3 = parseInt(Math.random() * 10);
        if (x1 != x2 && x2 != x3 && x3 != x2) {
            arrZu6.push(x1 + "" + x2 + "" + x3);
        }
    }
    //选取选中checkbox
    $.each($(".re-select-zu6ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    var shu = $("#positioninfo-zu6ds").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三直选-组六单式";
    showContent = "号码: (" + arrZu6[0] + ")";
    betContent = checkStrArr.join(',') + "|" + arrZu6[0];
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选3-组六复式
 */
function suiji_rx3z6fs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkStrArr = [], checkArr = [];
    var arrZu6 = [];
    while (arrZu6.length < 1) {
        var x1 = parseInt(Math.random() * 10);
        var x2 = parseInt(Math.random() * 10);
        var x3 = parseInt(Math.random() * 10);
        if (x1 != x2 && x2 != x3 && x3 != x2) {
            arrZu6.push(x1 + "," + x2 + "," + x3);
        }
    }
    //选取选中checkbox
    $.each($(".re-select-zu6fs input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    var shu = $("#positioninfo-zu6fs").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三直选-组六复式";
    showContent = "号码: (" + arrZu6[0] + ")";
    betContent = checkStrArr.join(',') + "|" + arrZu6[0];
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}


/**
 * 任选3-组三单式
 */
function suiji_rx3z3ds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var arrZu3ds = [];
    var checkStrArr = [], checkArr = [];
    while (arrZu3ds.length < 1) {
        var num1 = parseInt(Math.random() * 10);
        var num2 = parseInt(Math.random() * 10);
        var num3 = parseInt(Math.random() * 10);
        if (num1 == num2 && num2 != num3 || num2 == num3 && num3 != num1 || num3 == num1 && num1 != num2) {
            arrZu3ds.push(num1 + "" + num2 + "" + num3);
        }
    }
    //选取选中checkbox
    $.each($(".re-select-zu3ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    var shu = $("#positioninfo-zu3ds").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三直选-组三单式";
    showContent = "号码: (" + arrZu3ds[0] + ")";
    betContent = checkStrArr.join(',') + "|" + arrZu3ds[0];
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选3-组三复式
 */
function suiji_rx3z3fs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var arr = [];
    var checkStrArr = [], checkArr = [];

    while (arr.length < 2) {
        var num1 = parseInt(Math.random() * 10);
        var num2 = parseInt(Math.random() * 10);
        if (num1 != num2) {
            arr.push(num1);
            arr.push(num2);
        }

    }
    var tempArr = [];
    for (var i = 0; i < arr.length; i++) {
        for (var i1 = 0; i1 < arr.length; i1++) {
            if (arr[i] != arr[i1]) {
                tempArr.push(arr[i] + "" + arr[i1]);
            }
        }

    }
    //选取选中checkbox
    $.each($(".recl-1005-zu3Rx3 input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    var shu = $("#positioninfo-zu3fs").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三直选-组三复式";
    showContent = "号码: (" + arr[0] + "," + arr[1] + ")";
    betContent = checkStrArr.join(',') + "|" + arr[0] + "," + arr[1];
    betZhushu = tempArr.length * shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选3-直选和值
 */
function suiji_rx3zxhz() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var hzArr = [], checkStrArr = [], checkArr = [];

    while (hzArr.length < 1) {
        var num1 = parseInt(Math.random() * 28);
        hzArr.push(num1);
    }
    var newArr = [];
    for (var i = 0; i < hzArr.length; i++) {
        for (var x = 0; x < 10; x++) {
            for (var y = 0; y < 10; y++) {
                for (var y1 = 0; y1 < 10; y1++) {
                    if (x + y + y1 == hzArr[i]) {
                        newArr.push(x + "" + y + "" + y1);
                    }
                }
            }
        }
    }

    //选取选中checkbox
    $.each($(".recl-1004-zxhz input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    var shu = $("#positioninfo-hz").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三直选-直选和值";
    showContent = "号码: (" + hzArr[0] + ")";
    betContent = checkStrArr.join(',') + "|" + hzArr[0];
    betZhushu = shu * newArr.length;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}


/**
 * 任选3-直选单式
 */
function suiji_rx3zxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var arr = [], checkStrArr = [], checkArr = [];

    while (arr.length < 3) {
        var num1 = parseInt(Math.random() * 10);
        arr.push(num1);
    }
    //选取选中checkbox
    $.each($(".re-select-ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    var shu = $("#positioninfo-ds").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三直选-直选复式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = checkStrArr.join(',') + "|" + arr[0] + "" + arr[1] + "" + arr[2];
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选3-直选复式
 */
function suiji_rx3zxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var arr = [];

    while (arr.length < 5) {
        var num1 = parseInt(Math.random() * 10);
        arr.push(num1);
    }

    showPlayName = "任三直选-直选复式";
    showContent = "万位: " + arr[0] + " 千位: " + arr[1] + " 百位: " + arr[2] + " 十位: " + arr[3] + " 个位: " + arr[4];
    betContent = arr[0] + "|" + arr[1] + "|" + arr[2] + "|" + arr[3] + "|" + arr[4];
    betZhushu = 10;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

//**********************任选2************************
/**
 * 任选2-组选和值
 */
function suiji_rx2zuxhz() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var zuxhz = [];
    var checkArr = [], checkStrArr = [];
    var newArr = [];
    //选取选中checkbox
    $.each($(".re-select-zuxhz input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    zuxhz.push(parseInt(Math.random() * 17) + 1);

    for (var i = 0; i < zuxhz.length; i++) {
        for (var x = 0; x < 10; x++) {
            for (var y = 0; y < 10; y++) {
                if ((x + y) == zuxhz[i] && x != y) {
                    var arr = [];
                    arr.push(x);
                    arr.push(y);
                    arr.sort();
                    newArr.push(arr.join(""));
                }
            }
        }
    }
    newArr = newArr.uniqueArr();
    var shu = $("#positioninfo-zuhz").html();
    showPlayName = "任二直选-组选和值";
    betZhushu = newArr.length * shu;
    showContent = "号码: (" + zuxhz[0] + ")";
    betContent = checkStrArr.join(',') + "|" + zuxhz.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选2-组选单式
 */
function suiji_rx2zuxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkArr = [], checkStrArr = [];
    var arr = [];

    while (arr.length < 2) {
        var num1 = parseInt(Math.random() * 10);
        var num2 = parseInt(Math.random() * 10);
        if (num1 != num2) {
            arr.push(num1);
            arr.push(num2);
        }
    }

    //选取选中checkbox
    $.each($(".re-select-zuxds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    var shu = $("#positioninfo-zuds").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    betZhushu = shu;
    showPlayName = "任二组选-组选单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + ")";
    betContent = checkStrArr.join(',') + "|" + arr[0] + "" + arr[1];
    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选2-组选复式
 */
function suiji_rx2zuxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var arr = [];

    while (arr.length < 2) {
        var num1 = parseInt(Math.random() * 10);
        var num2 = parseInt(Math.random() * 10);
        if (num1 != num2) {
            arr.push(num1);
            arr.push(num2);
        }
    }
    var checkArr = [], checkStrArr = [];
    var shu = $("#positioninfo-zufs").html();
    //选取选中checkbox
    $.each($(".recl-1005-fs input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    showPlayName = "任二组选-组选复式";
    showContent = "号码: (" + arr[0] + "," + arr[1] + ")";
    betContent = checkStrArr.join(',') + "|" + arr[0] + "," + arr[1];
    betZhushu = shu;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选2-直选和值
 */
function suiji_rx2zxhz() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var hzsj = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".recl-1004-hz input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    hzsj.push(parseInt(Math.random() * 19));
    var newArr = [];
    for (var i = 0; i < hzsj.length; i++) {
        for (var x = 0; x < 10; x++) {
            for (var y = 0; y < 10; y++) {
                if (x + y == hzsj[i]) {
                    newArr.push(x + "" + y);
                }
            }
        }
    }

    var shu = $("#positioninfo-hz").html();

    showPlayName = "任二直选-直选和值";
    betZhushu = newArr.length * shu;
    showContent = "号码: (" + hzsj[0] + ")";
    betContent = checkStrArr.join(',') + "|" + hzsj.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选2-直选单式
 */
function suiji_rx2zxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var checkArr = [], checkStrArr = [];
    var arr = [];

    while (arr.length < 2) {
        var num = parseInt(Math.random() * 10);
        arr.push(num);
    }

    //选取选中checkbox
    $.each($(".re-select-ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    var shu = $("#positioninfo-ds").html();
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    betZhushu = shu;
    showPlayName = "任二直选-直选单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + ")";
    betContent = checkStrArr.join(',') + "|" + arr[0] + "" + arr[1];
    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 任选2-直选复式
 */
function suiji_rx2zxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;
    var tempArr = [];
    var arr = [];

    for (var i = 0; i <= 9; ++i) {
        tempArr[i] = 0;
    }

    while (arr.length < 5) {
        var num = parseInt(Math.random() * 10);
        arr.push(num);
    }

    showPlayName = "任二直选-直选复式";
    showContent = "万位: " + arr[0] + " 千位: " + arr[1] + " 百位: " + arr[2] + " 十位: " + arr[3] + " 个位: " + arr[4];
    betContent = arr[0] + "|" + arr[1] + "|" + arr[2] + "|" + arr[3] + "|" + arr[4];
    betZhushu = 10;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

//**********************不定位************************
/**
 * 不定位-五星三码"
 */
function suiji_wx3m() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [];
    while (arr.length < 3) {
        var zhiHao1 = parseInt(Math.random() * 10);
        var zhiHao2 = parseInt(Math.random() * 10);
        var zhiHao3 = parseInt(Math.random() * 10);
        if (zhiHao1 != zhiHao2 && zhiHao2 != zhiHao3 && zhiHao1 != zhiHao3) {
            arr.push(zhiHao1);
            arr.push(zhiHao2);
            arr.push(zhiHao3);
        }
    }

    showPlayName = "五星-五星三码";
    showContent = "不定位: (" + zhiHao1 + "," + zhiHao2 + "," + zhiHao3 + ")";
    betContent = zhiHao1 + "," + zhiHao2 + "," + zhiHao3;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-五星二码"
 */
function suiji_wxem() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = getRandom2num();
    var zhiHao1 = arr[0];
    var zhiHao2 = arr[1];

    showPlayName = "五星-五星二码";
    showContent = "不定位: (" + zhiHao1 + "," + zhiHao2 + ")";
    betContent = zhiHao1 + "," + zhiHao2;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-五星一码"
 */
function suiji_wxym() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var zhiHao1 = parseInt(Math.random() * 10);

    showPlayName = "五星-五星一码";
    showContent = "不定位: (" + zhiHao1 + ")";
    betContent = zhiHao1;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-后四二码"
 */
function suiji_h4em() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = getRandom2num();
    var zhiHao1 = arr[0];
    var zhiHao2 = arr[1];

    showPlayName = "四星-后四二码";
    showContent = "不定位: (" + zhiHao1 + "," + zhiHao2 + ")";
    betContent = zhiHao1 + "," + zhiHao2;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-后四一码"
 */
function suiji_h4ym() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var zhiHao1 = parseInt(Math.random() * 10);

    showPlayName = "四星-后四一码";
    showContent = "不定位: (" + zhiHao1 + ")";
    betContent = zhiHao1;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-前四二码"
 */
function suiji_q4em() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = getRandom2num();
    var zhiHao1 = arr[0];
    var zhiHao2 = arr[1];

    showPlayName = "四星-前四二码";
    showContent = "不定位: (" + zhiHao1 + "," + zhiHao2 + ")";
    betContent = zhiHao1 + "," + zhiHao2;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-前四一码"
 */
function suiji_q4ym() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var zhiHao1 = parseInt(Math.random() * 10);

    showPlayName = "四星-前四一码";
    showContent = "不定位: (" + zhiHao1 + ")";
    betContent = zhiHao1;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-后三二码"
 */
function suiji_hsem() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = getRandom2num();
    var zhiHao1 = arr[0];
    var zhiHao2 = arr[1];

    showPlayName = "三星-后三二码";
    showContent = "不定位: (" + zhiHao1 + "," + zhiHao2 + ")";
    betContent = zhiHao1 + "," + zhiHao2;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-后三一码"
 */
function suiji_hsym() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    while (newArr.length < 1) {
        var zhiTsh = parseInt(Math.random() * 10);
        newArr.push(zhiTsh);
    }

    showPlayName = "三星-后三一码";
    showContent = "不定位: (" + newArr[0] + ")";
    betContent = newArr.join("");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 不定位-前三二码"
 */
function suiji_qsem() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = getRandom2num();
    var zhiHao1 = arr[0];
    var zhiHao2 = arr[1];

    showPlayName = "三星-前三二码";
    showContent = "不定位: (" + zhiHao1 + "," + zhiHao2 + ")";
    betContent = zhiHao1 + "," + zhiHao2;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

//获取两位0到9之间的随机数
function getRandom2num() {
    var arr = [];
    while (arr.length < 2) {
        var zhiHao1 = parseInt(Math.random() * 10);
        var zhiHao2 = parseInt(Math.random() * 10);
        if (zhiHao1 != zhiHao2) {
            arr.push(zhiHao1);
            arr.push(zhiHao2);
        }
    }
    return arr;
}

/**
 * 不定位-前三一码"
 */
function suiji_qsym() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    while (newArr.length < 1) {
        var zhiTsh = parseInt(Math.random() * 10);
        newArr.push(zhiTsh);
    }

    showPlayName = "三星-前三一码";
    showContent = "不定位: (" + newArr[0] + ")";
    betContent = newArr.join("");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

//**************定位胆***************
/**
 * 定位胆"
 */
function suiji_dwd() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var numArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var xArr = ["万位", "千位", "百位", "十位", "个位"];

    var arr = [];
    var betStr = '';
    while (arr.length < 1) {
        var num1 = parseInt(Math.random() * 5);
        var num2 = parseInt(Math.random() * 10);
        var str = xArr[num1];
        str = str + ": (" + numArr[num2] + ")";
        arr.push(str);
        if (num1 == 0) {
            betStr = numArr[num2] + "|" + "|" + "|" + "|";
        } else if (num1 == 1) {
            betStr = "|" + numArr[num2] + "|" + "|" + "|";
        } else if (num1 == 2) {
            betStr = "|" + "|" + numArr[num2] + "|" + "|";
        } else if (num1 == 3) {
            betStr = "|" + "|" + "|" + numArr[num2] + "|";
        } else if (num1 == 4) {
            betStr = "|" + "|" + "|" + "|" + numArr[num2];
        }

    }

    showPlayName = "定位胆-定位胆";
    showContent = arr[0];
    betContent = betStr;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 定位胆"
 */
function suiji_gd11x5_dwd() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var numArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var xArr = ["第一名", "第二名", "第三名", "第四名", "第五名"];

    var arr = [];
    var betStr = '';
    while (arr.length < 1) {
        var num1 = parseInt(Math.random() * 5);
        var num2 = parseInt(Math.random() * 10+1);
        var str = xArr[num1];
        str = str + ": (" + numArr[num2] + ")";
        arr.push(str);
        if (num1 == 0) {
            betStr = numArr[num2] + "|" + "|" + "|" + "|";
        } else if (num1 == 1) {
            betStr = "|" + numArr[num2] + "|" + "|" + "|";
        } else if (num1 == 2) {
            betStr = "|" + "|" + numArr[num2] + "|" + "|";
        } else if (num1 == 3) {
            betStr = "|" + "|" + "|" + numArr[num2] + "|";
        } else if (num1 == 4) {
            betStr = "|" + "|" + "|" + "|" + numArr[num2];
        }

    }

    showPlayName = "定位胆-定位胆";
    showContent = arr[0];
    betContent = betStr;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}



//**************定位胆***************
/**
 * 定位胆"
 */
function suiji_dwdzxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var numArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];
    var xArr = ["冠军", "亚军", "季军", "第四名", "第五名","第六名","第七名","第八名","第九名","第十名"];

    var arr = [];
    var betStr = '';
    while (arr.length < 1) {
        var num1 = parseInt(Math.random() * 10);
        var num2 = numArr[parseInt(Math.random() * 10)];
        var str = xArr[num1];
        str = str + ": (" + num2 + ")";
        arr.push(str);
        if (num1 == 0) {
            betStr = num2 + "|" + "|" + "|" + "|" + "|" + "|" + "|" + "|" + "|";
        } else if (num1 == 1) {
            betStr ="|" + num2 + "|" + "|" + "|" + "|" + "|" + "|" + "|" + "|";
        } else if (num1 == 2) {
            betStr ="|" + "|" + num2  + "|" + "|" + "|" + "|" + "|" + "|" + "|";
        } else if (num1 == 3) {
            betStr ="|" + "|" + "|" + num2 + "|" + "|" + "|" + "|" + "|" + "|";
        } else if (num1 == 4) {
            betStr ="|" + "|" + "|" +"|"+ num2 + "|" + "|" + "|" + "|" + "|";
        }else if (num1 == 5) {
            betStr ="|" + "|"+ "|" + "|" + "|" + num2  + "|" + "|" + "|" + "|";
        }else if (num1 == 6) {
            betStr ="|" + "|"+ "|" + "|" + "|"  + "|" + num2 + "|" + "|" + "|";
        }else if (num1 == 7) {
            betStr ="|" + "|"+ "|" + "|" + "|"  + "|"  + "|"+ num2 + "|" + "|";
        }else if (num1 == 8) {
            betStr ="|" + "|"+ "|" + "|" + "|"  + "|"  + "|" + "|"+ num2 + "|";
        }else if (num1 == 9) {
            betStr ="|" + "|"+ "|" + "|" + "|"  + "|"  + "|" + "|" + "|"+  num2
        }

    }

    showPlayName = "定位胆-定位胆";
    showContent = arr[0];
    betContent = betStr;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

//**********************前二**********************
/**
 * 前2直选-组选包胆"
 */
function suiji_q2zuxbd() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = '';

    var arrTsh = [], newArr = [];
    while (newArr.length < 1) {
        var zhiTsh = parseInt(Math.random() * 10);
        newArr.push(zhiTsh);
    }
    betZhushu = zhushu_q2zuxbd(newArr);
    showPlayName = "前二组选-包胆";
    showContent = "包胆: (" + newArr[0] + ")";
    betContent = newArr.join("");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}


/**
 * 前2直选-组选和值"
 */
function suiji_q2zuxhz() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = '';

    var arrTsh = [], newArr = [];
    while (newArr.length < 1) {
        var zhiTsh = parseInt(Math.random() * 17) + 1;
        newArr.push(zhiTsh);
    }
    betZhushu = zhushu_q2zuxhz(newArr);
    showPlayName = "前二组选-和值";
    showContent = "和值: (" + newArr[0] + ")";
    betContent = newArr.join("");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 前2直选-组选单式"
 */
function suiji_q2zuxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var newArr = [];
    while (newArr.length < 2) {
        var zhiHao1 = parseInt(Math.random() * 10);
        var zhiHao2 = parseInt(Math.random() * 10);
        if (zhiHao1 != zhiHao2) {
            newArr.push(zhiHao1);
            newArr.push(zhiHao2);
        }
    }
    showPlayName = "前二组选-单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    betContent = newArr.join("");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前2直选-组选复式"
 */
function suiji_q2zuxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var newArr = [];
    while (newArr.length < 2) {
        var zhiHao1 = parseInt(Math.random() * 10);
        var zhiHao2 = parseInt(Math.random() * 10);
        if (zhiHao1 != zhiHao2) {
            newArr.push(zhiHao1);
            newArr.push(zhiHao2);
        }
    }
    showPlayName = "前二组选-复式";
    showContent = "组选: (" + newArr.join(",") + ")";
    betContent = newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前2直选-直选跨度"
 */
function suiji_q2zxkd() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = '';

    var arrTsh = [], newArr = [];
    while (newArr.length < 1) {
        var zhiTsh = parseInt(Math.random() * 10);
        newArr.push(zhiTsh);
    }
    betZhushu = zhushu_q2zxkd(newArr);
    showPlayName = "前二直选-跨度";
    showContent = "跨度: (" + newArr[0] + ")";
    betContent = newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 前2直选-直选和值"
 */
function suiji_q2zxhz() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = '';

    var arrTsh = [], newArr = [];
    while (newArr.length < 1) {
        var zhiTsh = parseInt(Math.random() * 19);
        newArr.push(zhiTsh);
    }
    betZhushu = zhushu_q2zxhz(newArr);
    showPlayName = "前二直选-和值";
    showContent = "和值: (" + newArr[0] + ")";
    betContent = newArr.join("");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 前2直选-直选单式"
 */
function suiji_q2zxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

    while (newArr.length < 2) {
        var zhiTsh = parseInt(Math.random() * arrTsh.length);
        newArr.push(arrTsh[parseInt(zhiTsh)]);
    }

    showPlayName = "前二直选-直选单式";
    showContent = "号码: (" + newArr[0] + "" + newArr[1] + ")";
    betContent = newArr[0] + "" + newArr[1];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前2直选-直选单式"
 */
function suiji_qezxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];

    while (newArr.length < 2) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10)];

        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2);
        }

    }


    showPlayName = "前二直选-直选单式";
    showContent = "号码: (" + newArr[0] + "" + newArr[1] + ")";
    betContent = newArr[0] + "" + newArr[1];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前3直选-直选单式
 */
function suiji_qszxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10)];
        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3);
        }
    }


    showPlayName = "前三直选-直选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_qszuxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3);
        }
    }


    showPlayName = "前三组选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_qezuxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2 ) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2);
        }
    }


    showPlayName = "前二组选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
function gd11x5_zhushu_qsw(){
    var newArr = [];
    var wanArr = [];
    $.each($(".recl-1002 ul li[data-name = '前三位'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });
    if (wanArr.length <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        newArr.push(wanArr[i]);
    }

    return newArr.length;
}

function gd11x5_zhushu_rxyzy(){
    var newArr = [];
    var wanArr = [];

    $.each($(".recl-1002 ul li[data-name ='选1中1'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });
    if (wanArr.length <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        newArr.push(wanArr[i]);
    }
    return newArr.length;
}



function zhushu_gd11x5_zsw(){
    var newArr = [];
    var wanArr = [];
    $.each($(".recl-1002 ul li[data-name = '中三位'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });
    if (wanArr.length <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        newArr.push(wanArr[i]);
    }

    return newArr.length;
}

function zhushu_gd11x5_hsw(){
    var newArr = [];
    var wanArr = [];
    $.each($(".recl-1002 ul li[data-name = '后三位'] span.acti"), function () {
        wanArr.push($.trim($(this).find("i").html()));
    });
    if (wanArr.length <= 0) {
        return 0;
    }

    for (var i = 0; i < wanArr.length; i++) {
        newArr.push(wanArr[i]);
    }

    return newArr.length;
}



function suiji_gd11x5_hezuxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2);
        }
    }


    showPlayName = "后二组选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_hszuxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3);
        }
    }


    showPlayName = "后三组选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
function suiji_gd11x5_zszuxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3);
        }
    }


    showPlayName = "中三组选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}




/**
 * 前3直选-直选单式
 */
function suiji_gd11x5_qszxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3);
        }
    }


    showPlayName = "前三直选-直选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_rxszsds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }
    }


    showPlayName = "任选单式-3中3";
    showContent = "号码: (" + newArr.join(' ') + ")";
    betContent =newArr[0]+","+newArr[1]+","+newArr[2]+"|";

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxsizsds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh3 != zhiTsh4 &&zhiTsh2 != zhiTsh4 &&zhiTsh1 != zhiTsh4 &&zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
        }
    }


    showPlayName = "任选单式-4中4";
    showContent = "号码: (" + newArr.join(' ') + ")";
    betContent =newArr[0]+","+newArr[1]+","+newArr[2]+","+newArr[3]+"|";

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxwzwds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh4 != zhiTsh5 &&zhiTsh2 != zhiTsh5 &&zhiTsh1 != zhiTsh5 &&zhiTsh3 != zhiTsh5 &&zhiTsh3 != zhiTsh4 &&zhiTsh2 != zhiTsh4 &&zhiTsh1 != zhiTsh4 &&zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
            newArr.push(zhiTsh5);
        }
    }


    showPlayName = "任选单式-5中5";
    showContent = "号码: (" + newArr.join(' ') + ")";
    betContent =newArr[0]+","+newArr[1]+","+newArr[2]+","+newArr[3]+","+newArr[4]+"|";

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_rxlzwds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh6 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh6 &&zhiTsh2 != zhiTsh6 &&zhiTsh3 != zhiTsh6 &&zhiTsh5 != zhiTsh6 &&zhiTsh4 != zhiTsh6 &&zhiTsh4 != zhiTsh5 &&zhiTsh2 != zhiTsh5 &&zhiTsh1 != zhiTsh5 &&zhiTsh3 != zhiTsh5 &&zhiTsh3 != zhiTsh4 &&zhiTsh2 != zhiTsh4 &&zhiTsh1 != zhiTsh4 &&zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
            newArr.push(zhiTsh5);
            newArr.push(zhiTsh6);
        }
    }


    showPlayName = "任选单式-6中5";
    showContent = "号码: (" + newArr.join(' ') + ")";
    betContent = newArr[0]+","+newArr[1]+","+newArr[2]+","+newArr[3]+","+newArr[4]+","+newArr[5]+"|";

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxqzwds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh6 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh7 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh6 != zhiTsh7 &&zhiTsh5 != zhiTsh7 &&zhiTsh4 != zhiTsh7 &&zhiTsh3 != zhiTsh7 &&zhiTsh2 != zhiTsh7 &&zhiTsh1 != zhiTsh7 &&zhiTsh1 != zhiTsh6 &&zhiTsh2 != zhiTsh6 &&zhiTsh3 != zhiTsh6 &&zhiTsh5 != zhiTsh6 &&zhiTsh4 != zhiTsh6 &&zhiTsh4 != zhiTsh5 &&zhiTsh2 != zhiTsh5 &&zhiTsh1 != zhiTsh5 &&zhiTsh3 != zhiTsh5 &&zhiTsh3 != zhiTsh4 &&zhiTsh2 != zhiTsh4 &&zhiTsh1 != zhiTsh4 &&zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
            newArr.push(zhiTsh5);
            newArr.push(zhiTsh6);
            newArr.push(zhiTsh7);
        }
    }


    showPlayName = "任选单式-7中5";
    showContent = "号码: (" + newArr.join(' ') + ")";
    betContent = newArr[0]+","+newArr[1]+","+newArr[2]+","+newArr[3]+","+newArr[4]+","+newArr[5]+","+newArr[6]+"|";

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxbzwds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh6 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh7 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh8 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh8 &&zhiTsh2 != zhiTsh8 &&zhiTsh3 != zhiTsh8 &&zhiTsh4 != zhiTsh8 &&zhiTsh5 != zhiTsh8 &&zhiTsh7 != zhiTsh8 &&zhiTsh6 != zhiTsh8 &&zhiTsh6 != zhiTsh7 &&zhiTsh5 != zhiTsh7 &&zhiTsh4 != zhiTsh7 &&zhiTsh3 != zhiTsh7 &&zhiTsh2 != zhiTsh7 &&zhiTsh1 != zhiTsh7 &&zhiTsh1 != zhiTsh6 &&zhiTsh2 != zhiTsh6 &&zhiTsh3 != zhiTsh6 &&zhiTsh5 != zhiTsh6 &&zhiTsh4 != zhiTsh6 &&zhiTsh4 != zhiTsh5 &&zhiTsh2 != zhiTsh5 &&zhiTsh1 != zhiTsh5 &&zhiTsh3 != zhiTsh5 &&zhiTsh3 != zhiTsh4 &&zhiTsh2 != zhiTsh4 &&zhiTsh1 != zhiTsh4 &&zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
            newArr.push(zhiTsh5);
            newArr.push(zhiTsh6);
            newArr.push(zhiTsh7);
            newArr.push(zhiTsh8);
        }
    }


    showPlayName = "任选单式-8中5";
    showContent = "号码: (" + newArr.join(' ') + ")";
    betContent = newArr[0]+","+newArr[1]+","+newArr[2]+","+newArr[3]+","+newArr[4]+","+newArr[5]+","+","+newArr[6]+newArr[7]+"|";

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前2直选-直选单式
 */
function suiji_gd11x5_qezxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2);
        }
    }


    showPlayName = "前二直选-直选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxezeds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 2) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
        }
    }


    showPlayName = "任选单式-2中2";
    showContent = "号码: (" + newArr.join(' ') + ")";
    betContent = newArr[0]+","+newArr[1]+"|";

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
/**
 * 后2直选-直选单式
 */
function suiji_gd11x5_hezxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
        }
    }


    showPlayName = "后二直选-直选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
/**
 * 后3直选-直选单式
 */
function suiji_gd11x5_hszxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3);
        }
    }


    showPlayName = "后三直选-直选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 中3直选-直选单式
 */
function suiji_gd11x5_zszxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 3) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1+" ");
            newArr.push(zhiTsh2+" ");
            newArr.push(zhiTsh3);
        }
    }


    showPlayName = "中三直选-直选单式";
    showContent = "号码: (" + newArr.join('') + ")";
    betContent = newArr.join('');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/**
 * 前2直选-直选复式"
 */
function suiji_qezxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];

    while (newArr.length < 2) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10)];
            if (zhiTsh1 != zhiTsh2) {
                newArr.push(zhiTsh1);
                newArr.push(zhiTsh2);
            }
    }

    showPlayName = "前二直选-复式";
    showContent = "冠军: (" + newArr[0] + ") 亚军: (" + newArr[1] + ")";
    betContent = newArr[0] + "|" + newArr[1];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前2直选-直选复式"
 */
function suiji_qszxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10)];

        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }

    }

    showPlayName = "前三直选-直选复式";
    showContent = "冠军: (" + newArr[0] + ") 亚军: (" + newArr[1] + ") 季军 : (" + newArr[2] + ")";
    betContent = newArr[0] + "|" + newArr[1] + "|" + newArr[2];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_qszxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }

    }

    showPlayName = "前三直选-直选复式";
    showContent = "第一位: (" + newArr[0] + ") 第二位: (" + newArr[1] + ") 第三位 : (" + newArr[2] + ")";
    betContent = newArr[0] + "|" + newArr[1] + "|" + newArr[2];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}





function suiji_gd11x5_rxyzydsds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
            newArr.push(zhiTsh1);

    }

    showPlayName = "任选单式-1中1";
    showContent = "选1中1: (" + newArr[0] + ")";
    betContent = newArr[0];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_qsw() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
            newArr.push(zhiTsh1);
    }

    showPlayName = "不定位-前3";
    showContent = "前三位: (" + newArr[0] + ")";
    betContent = newArr[0] ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
function suiji_gd11x5_rxyzy() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        newArr.push(zhiTsh1);
    }

    showPlayName = "任选复式-1中1";
    showContent = "选1中1: (" + newArr[0] + ")";
    betContent = newArr[0] ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
function suiji_gd11x5_zsw() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        newArr.push(zhiTsh1);
    }

    showPlayName = "不定位-中3";
    showContent = "中三位: (" + newArr[0] + ")";
    betContent = newArr[0] ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_hsw() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        newArr.push(zhiTsh1);
    }

    showPlayName = "不定位-后3";
    showContent = "后三位: (" + newArr[0] + ")";
    betContent = newArr[0] ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_hezxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];


        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
        }

    }

    showPlayName = "后二直选-复式";
    showContent = "第四位: (" + newArr[0] + ") 第五位: (" + newArr[1] + ")";
    betContent = newArr[0] + "|" + newArr[1];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_qezxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];


        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
        }

    }

    showPlayName = "前二直选-复式";
    showContent = "第一位: (" + newArr[0] + ") 第二位: (" + newArr[1] + ")";
    betContent = newArr[0] + "|" + newArr[1];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
/*中三直选复式*/
function suiji_gd11x5_zszxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }

    }

    showPlayName = "中三直选-直选复式";
    showContent = "第二位: (" + newArr[0] + ") 第三位: (" + newArr[1] + ") 第四位 : (" + newArr[2] + ")";
    betContent = newArr[0] + "|" + newArr[1] + "|" + newArr[2];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_qszuxdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }

    }

    showPlayName = "前三组选-胆拖";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + "," + newArr[2] + ") ";
    betContent = newArr[0] + "|" + newArr[1] + "," + newArr[2];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_rxszsdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }

    }

    showPlayName = "任选胆拖-3中3";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + "," + newArr[2] + ") ";
    betContent = newArr[0] + "|" + newArr[1] + "," + newArr[2];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_qezuxdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);

        }

    }

    showPlayName = "前二组选-胆拖";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + ") ";
    betContent = newArr[0] + "|" + newArr[1] ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxezwdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);

        }

    }

    showPlayName = "后二组选-胆拖";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + ") ";
    betContent = newArr[0] + "|" + newArr[1] ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}



function suiji_gd11x5_rxsizsdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh3 != zhiTsh4&&zhiTsh2 != zhiTsh4&&zhiTsh1 != zhiTsh4&&zhiTsh4 != zhiTsh3&&zhiTsh2 != zhiTsh3&&zhiTsh1 != zhiTsh3&&zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);

        }

    }

    showPlayName = "任选胆拖-4中4";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + ","+ newArr[2] +","+ newArr[3] +") ";
    betContent = newArr[0] + "|" + newArr[1]+","+newArr[2]+","+newArr[3] ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxwzwdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh5&&zhiTsh4 != zhiTsh5&&zhiTsh2 != zhiTsh5&&zhiTsh3 != zhiTsh5&&zhiTsh3 != zhiTsh4&&zhiTsh2 != zhiTsh4&&zhiTsh1 != zhiTsh4&&zhiTsh4 != zhiTsh3&&zhiTsh2 != zhiTsh3&&zhiTsh1 != zhiTsh3&&zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
            newArr.push(zhiTsh5);

        }

    }

    showPlayName = "任选胆拖-5中5";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + ","+ newArr[2] +","+ newArr[3] +","+ newArr[4] +") ";
    betContent = newArr[0] + "|" + newArr[1]+","+newArr[2]+","+newArr[3]+ ","+newArr[4];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxlzwdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh6 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh5 != zhiTsh6&&zhiTsh4 != zhiTsh6&&zhiTsh3 != zhiTsh6&&zhiTsh2 != zhiTsh6&&zhiTsh1 != zhiTsh6&&zhiTsh1 != zhiTsh5&&zhiTsh4 != zhiTsh5&&zhiTsh2 != zhiTsh5&&zhiTsh3 != zhiTsh5&&zhiTsh3 != zhiTsh4&&zhiTsh2 != zhiTsh4&&zhiTsh1 != zhiTsh4&&zhiTsh4 != zhiTsh3&&zhiTsh2 != zhiTsh3&&zhiTsh1 != zhiTsh3&&zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
            newArr.push(zhiTsh5);
            newArr.push(zhiTsh6);

        }

    }

    showPlayName = "任选胆拖-6中5";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + ","+ newArr[2] +","+ newArr[3] +","+ newArr[4] +","+ newArr[5] +") ";
    betContent = newArr[0] + "|" + newArr[1]+","+newArr[2]+","+newArr[3]+ ","+newArr[4]+ ","+newArr[5];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_rxqzwdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh6 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh7 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh7&&zhiTsh2 != zhiTsh7&&zhiTsh3 != zhiTsh7&&zhiTsh4 != zhiTsh7&&zhiTsh6 != zhiTsh7&&zhiTsh5 != zhiTsh7&&zhiTsh5 != zhiTsh6&&zhiTsh4 != zhiTsh6&&zhiTsh3 != zhiTsh6&&zhiTsh2 != zhiTsh6&&zhiTsh1 != zhiTsh6&&zhiTsh1 != zhiTsh5&&zhiTsh4 != zhiTsh5&&zhiTsh2 != zhiTsh5&&zhiTsh3 != zhiTsh5&&zhiTsh3 != zhiTsh4&&zhiTsh2 != zhiTsh4&&zhiTsh1 != zhiTsh4&&zhiTsh4 != zhiTsh3&&zhiTsh2 != zhiTsh3&&zhiTsh1 != zhiTsh3&&zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
            newArr.push(zhiTsh5);
            newArr.push(zhiTsh6);
            newArr.push(zhiTsh7);

        }

    }

    showPlayName = "任选胆拖-7中5";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + ","+ newArr[2] +","+ newArr[3] +","+ newArr[4] +","+ newArr[5] +","+ newArr[6] +") ";
    betContent = newArr[0] + "|" + newArr[1]+","+newArr[2]+","+newArr[3]+ ","+newArr[4]+ ","+newArr[5]+ ","+newArr[6];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_rxbzwdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh4 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh5 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh6 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh7 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh8 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh7 != zhiTsh8&&zhiTsh6 != zhiTsh8&&zhiTsh5 != zhiTsh8&&zhiTsh4 != zhiTsh8&&zhiTsh3 != zhiTsh8&&zhiTsh2 != zhiTsh8&&zhiTsh1 != zhiTsh8&&zhiTsh1 != zhiTsh7&&zhiTsh2 != zhiTsh7&&zhiTsh3 != zhiTsh7&&zhiTsh4 != zhiTsh7&&zhiTsh6 != zhiTsh7&&zhiTsh5 != zhiTsh7&&zhiTsh5 != zhiTsh6&&zhiTsh4 != zhiTsh6&&zhiTsh3 != zhiTsh6&&zhiTsh2 != zhiTsh6&&zhiTsh1 != zhiTsh6&&zhiTsh1 != zhiTsh5&&zhiTsh4 != zhiTsh5&&zhiTsh2 != zhiTsh5&&zhiTsh3 != zhiTsh5&&zhiTsh3 != zhiTsh4&&zhiTsh2 != zhiTsh4&&zhiTsh1 != zhiTsh4&&zhiTsh4 != zhiTsh3&&zhiTsh2 != zhiTsh3&&zhiTsh1 != zhiTsh3&&zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
            newArr.push(zhiTsh4);
            newArr.push(zhiTsh5);
            newArr.push(zhiTsh6);
            newArr.push(zhiTsh7);
            newArr.push(zhiTsh8);

        }

    }

    showPlayName = "任选胆拖-8中5";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + ","+ newArr[2] +","+ newArr[3] +","+ newArr[4] +","+ newArr[5] +","+ newArr[6] +","+ newArr[7] +") ";
    betContent = newArr[0] + "|" + newArr[1]+","+newArr[2]+","+newArr[3]+ ","+newArr[4]+ ","+newArr[5]+ ","+newArr[6]+ ","+newArr[7];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}



function suiji_gd11x5_hezuxdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);

        }

    }

    showPlayName = "后二组选-胆拖";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + ") ";
    betContent = newArr[0] + "|" + newArr[1] ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_zszuxdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }

    }

    showPlayName = "中三组选-胆拖";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + "," + newArr[2] + ") ";
    betContent = newArr[0] + "|" + newArr[1] + "," + newArr[2];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_hszuxdt() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }

    }

    showPlayName = "后三组选-胆拖";
    showContent = "胆拖: (" + newArr[0] + ") 拖码: (" + newArr[1] + "," + newArr[2] + ") ";
    betContent = newArr[0] + "|" + newArr[1] + "," + newArr[2];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/*后三直选复式*/
function suiji_gd11x5_hszxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];

    while (newArr.length < 1) {
        var zhiTsh1 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh2 = arrTsh[parseInt(Math.random() * 10+1)];
        var zhiTsh3 = arrTsh[parseInt(Math.random() * 10+1)];

        if (zhiTsh1 != zhiTsh2 && zhiTsh1 != zhiTsh3 && zhiTsh3 != zhiTsh2) {
            newArr.push(zhiTsh1);
            newArr.push(zhiTsh2);
            newArr.push(zhiTsh3);
        }

    }

    showPlayName = "后三直选-直选复式";
    showContent = "第三位: (" + newArr[0] + ") 第四位: (" + newArr[1] + ") 第五位 : (" + newArr[2] + ")";
    betContent = newArr[0] + "|" + newArr[1] + "|" + newArr[2];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}



/**
 * 前2直选-直选复式"
 */
function suiji_q2zxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

    while (newArr.length < 2) {
        var zhiTsh = parseInt(Math.random() * arrTsh.length);
        newArr.push(arrTsh[parseInt(zhiTsh)]);
    }

    showPlayName = "前二直选-复式";
    showContent = "万位: (" + newArr[0] + ") 千位: (" + newArr[1] + ")";
    betContent = newArr[0] + "|" + newArr[1];
    ;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


//*************前三***************
/**
 * 前三其它-特殊号"
 */
function suiji_q3tsh() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh[0] = "对子";
    arrTsh[1] = "顺子";
    arrTsh[2] = "豹子";
    while (newArr.length != 1) {
        var zhiTsh = parseInt(Math.random() * 3);
        newArr.push(arrTsh[parseInt(zhiTsh)]);
    }

    showPlayName = "前三其它-特殊号";
    showContent = "特殊号: (" + newArr[0] + ")";
    betContent = newArr[0];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前三其它-前三和值尾数"
 */
function suiji_q3hzws() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "前三其它-前三和值尾数";
    showContent = "尾数: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/**
 * 前三直选-组选包胆
 */
function suiji_q3zxbd() {
    var baoDanArr = [];
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    baoDanArr.push(arr);
    betZhushu = getZxbdNewArrs(baoDanArr).length;
    showPlayName = "前三直选-组选包胆";
    showContent = "包胆: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 前三直选-组选和值
 */
function suiji_q3zuxhz() {
    var fuShiArr = [];
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;

    var tempArr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    fuShiArr.push(arr);
    betZhushu = getZxhzNewArrs(fuShiArr).length;
    showPlayName = "前三直选-组选和值";
    showContent = "和值: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 前三组选-混合组选
 */
function suiji_q3hhzx() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        var xHhzx = parseInt(Math.random() * 10);
        var yHhzx = parseInt(Math.random() * 10);
        var zHhzx = parseInt(Math.random() * 10);
        if (xHhzx == yHhzx && yHhzx != zHhzx || xHhzx == zHhzx && zHhzx != yHhzx || yHhzx == zHhzx && zHhzx != xHhzx || xHhzx != yHhzx && yHhzx != zHhzx && zHhzx != xHhzx) {
            arr.push(xHhzx);
            arr.push(yHhzx);
            arr.push(zHhzx);
        }
    }

    showPlayName = "前三组选-混合组选";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = "{0}{1}{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前三组选-组六单式
 */
function suiji_q3z6ds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = parseInt(Math.random() * 10);
        var yZlfs = parseInt(Math.random() * 10);
        var zZlfs = parseInt(Math.random() * 10);
        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "前三组选-组六单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = "{0}{1}{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前三组选复式
 */
function suiji_gd11x5_qszuxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];

        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "前三组选复式";
    showContent = "前三组选复式: ({0},{1},{2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0},{1},{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前三组选复式
 */
function suiji_gd11x5_rxszs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];

        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "任选复式-3中3";
    showContent = "任选复式-3中3: ({0},{1},{2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0},{1},{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


function suiji_gd11x5_rxsizs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var cZlfs = tempArr[parseInt(Math.random()* 10+1)];

        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs && xZlfs != cZlfs &&  yZlfs != cZlfs  &&  zZlfs != cZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
            arr.push(cZlfs);
        }
    }

    showPlayName = "任选复式-4中4";
    showContent = "任选复式-4中4: ({0},{1},{2},{3})".format(arr[0], arr[1], arr[2], arr[3]);
    betContent = "{0},{1},{2},{3}".format(arr[0], arr[1], arr[2], arr[3]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxwzw() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var cZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var aZlfs = tempArr[parseInt(Math.random()* 10+1)];

        if (yZlfs != aZlfs &&zZlfs != aZlfs &&cZlfs != aZlfs &&xZlfs != aZlfs &&xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs && xZlfs != cZlfs &&  yZlfs != cZlfs  &&  zZlfs != cZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
            arr.push(cZlfs);
            arr.push(aZlfs);
        }
    }

    showPlayName = "任选复式-5中5";
    showContent = "任选复式-5中5: ({0},{1},{2},{3},{4})".format(arr[0], arr[1], arr[2], arr[3],arr[4]);
    betContent = "{0},{1},{2},{3},{4}".format(arr[0], arr[1], arr[2], arr[3],arr[4]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_rxlzw() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var cZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var aZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var bZlfs = tempArr[parseInt(Math.random()* 10+1)];

        if (xZlfs != bZlfs &&zZlfs != bZlfs &&cZlfs != bZlfs &&aZlfs != bZlfs &&yZlfs != bZlfs &&yZlfs != aZlfs &&zZlfs != aZlfs &&cZlfs != aZlfs &&xZlfs != aZlfs &&xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs && xZlfs != cZlfs &&  yZlfs != cZlfs  &&  zZlfs != cZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
            arr.push(cZlfs);
            arr.push(aZlfs);
            arr.push(bZlfs);
        }
    }

    showPlayName = "任选复式-6中5";
    showContent = "任选复式-6中5: ({0},{1},{2},{3},{4},{5})".format(arr[0], arr[1], arr[2], arr[3],arr[4],arr[5]);
    betContent = "{0},{1},{2},{3},{4},{5}".format(arr[0], arr[1], arr[2], arr[3],arr[4],arr[5]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
function suiji_gd11x5_rxqzw() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var cZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var aZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var bZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var dZlfs = tempArr[parseInt(Math.random()* 10+1)];
        if (bZlfs != dZlfs &&aZlfs != dZlfs &&cZlfs != dZlfs &&zZlfs != dZlfs &&yZlfs != dZlfs &&xZlfs != dZlfs &&xZlfs != bZlfs &&zZlfs != bZlfs &&cZlfs != bZlfs &&aZlfs != bZlfs &&yZlfs != bZlfs &&yZlfs != aZlfs &&zZlfs != aZlfs &&cZlfs != aZlfs &&xZlfs != aZlfs &&xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs && xZlfs != cZlfs &&  yZlfs != cZlfs  &&  zZlfs != cZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
            arr.push(cZlfs);
            arr.push(aZlfs);
            arr.push(bZlfs);
            arr.push(dZlfs);
        }
    }

    showPlayName = "任选复式-7中5";
    showContent = "任选复式-7中5: ({0},{1},{2},{3},{4},{5},{6})".format(arr[0], arr[1], arr[2], arr[3],arr[4],arr[5],arr[6]);
    betContent = "{0},{1},{2},{3},{4},{5},{6}".format(arr[0], arr[1], arr[2], arr[3],arr[4],arr[5],arr[6]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
function suiji_gd11x5_rxbzw() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var cZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var aZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var bZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var dZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var eZlfs = tempArr[parseInt(Math.random()* 10+1)];
        if (xZlfs != eZlfs &&yZlfs != eZlfs &&zZlfs != eZlfs &&cZlfs != eZlfs &&aZlfs != eZlfs &&dZlfs != eZlfs &&bZlfs != eZlfs &&bZlfs != dZlfs &&aZlfs != dZlfs &&cZlfs != dZlfs &&zZlfs != dZlfs &&yZlfs != dZlfs &&xZlfs != dZlfs &&xZlfs != bZlfs &&zZlfs != bZlfs &&cZlfs != bZlfs &&aZlfs != bZlfs &&yZlfs != bZlfs &&yZlfs != aZlfs &&zZlfs != aZlfs &&cZlfs != aZlfs &&xZlfs != aZlfs &&xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs && xZlfs != cZlfs &&  yZlfs != cZlfs  &&  zZlfs != cZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
            arr.push(cZlfs);
            arr.push(aZlfs);
            arr.push(bZlfs);
            arr.push(dZlfs);
            arr.push(eZlfs);
        }
    }

    showPlayName = "任选复式-8中5";
    showContent = "任选复式-8中5: ({0},{1},{2},{3},{4},{5},{6},{7})".format(arr[0], arr[1], arr[2], arr[3],arr[4],arr[5],arr[6],arr[7]);
    betContent = "{0},{1},{2},{3},{4},{5},{6},{7}".format(arr[0], arr[1], arr[2], arr[3],arr[4],arr[5],arr[6],arr[7]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前二组选复式
 */
function suiji_gd11x5_qezuxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 1) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];


        if (xZlfs != yZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);

        }
    }

    showPlayName = "前二组选复式";
    showContent = "号码: ({0},{1})".format(arr[0], arr[1]);
    betContent = "{0},{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_gd11x5_hezuxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 1) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];


        if (xZlfs != yZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);

        }
    }

    showPlayName = "后二组选复式";
    showContent = "号码: ({0},{1})".format(arr[0], arr[1]);
    betContent = "{0},{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/**
 * 前二组选复式
 */
function suiji_gd11x5_rxeze() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];


        if (xZlfs != yZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);

        }
    }

    showPlayName = "任选复式-2中2";
    showContent = "任选复式-2中2: ({0},{1})".format(arr[0], arr[1]);
    betContent = "{0},{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}



/**
 * 后三组选复式
 */
function suiji_gd11x5_hszuxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];

        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "后三组选复式";
    showContent = "后三组选复式: ({0},{1},{2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0},{1},{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}



/**
 * 中三组选复式
 */
function suiji_gd11x5_zszuxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];

        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "中三组选复式";
    showContent = "中三组选复式: ({0},{1},{2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0},{1},{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/**
 * 前三组选复式
 */
function suiji_gd11x5_qszuxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10','11'];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var yZlfs = tempArr[parseInt(Math.random()* 10+1)];
        var zZlfs = tempArr[parseInt(Math.random()* 10+1)];

        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "前三组选复式";
    showContent = "前三组选复式: ({0},{1},{2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0},{1},{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前三组选-组六复式
 */
function suiji_q3z6fs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = parseInt(Math.random() * 10);
        var yZlfs = parseInt(Math.random() * 10);
        var zZlfs = parseInt(Math.random() * 10);
        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "前三组选-组六复式";
    showContent = "组六: ({0},{1},{2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0},{1},{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/**
 * 前三组选-组三单式
 */
function suiji_q3z3ds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        var xZxds = parseInt(Math.random() * 10);
        var yZxds = parseInt(Math.random() * 10);
        var zZxds = parseInt(Math.random() * 10);
        if (xZxds == yZxds && yZxds != zZxds || xZxds == zZxds && zZxds != yZxds || yZxds == zZxds && zZxds != xZxds) {
            arr.push(xZxds);
            arr.push(yZxds);
            arr.push(zZxds);
        }
    }

    showPlayName = "前三组选-组三单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = "{0}{1}{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 后三组选-组三复式
 */
function suiji_q3z3fs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 2) {
        var x = parseInt(Math.random() * 10);
        var y = parseInt(Math.random() * 10);
        if (x != y) {
            arr.push(x);
            arr.push(y);
        }
    }

    showPlayName = "前三组选-组三复式";
    showContent = "组三: ({0},{1})".format(arr[0], arr[1]);
    betContent = "{0},{1}".format(arr[0], arr[1]);
    betZhushu = 2; //默认两个号码两注
    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 后三直选-跨度
 */
function suiji_q3zxkd() {
    // 初始化变量
    var betZhushu = 0;
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    betZhushu = getKaduNewArrs(arr).length;
    showPlayName = "前三直选-跨度";
    showContent = "跨度: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 前三直选-和值
 */
function suiji_q3zxhz() {
    var betZhushu = 0;
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    betZhushu = getHezNewArrs(arr).length;
    showPlayName = "前三直选-和值";
    showContent = "和值: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 前三直选-组合
 */
function suiji_q3zh() {
    var baiArr = [], shiArr = [], geArr = [];
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    baiArr.push(arr[0]);
    shiArr.push(arr[1]);
    geArr.push(arr[2]);
    betZhushu = (getHszhNewArrs(baiArr, shiArr, geArr)).length
    showPlayName = "前三直选-组合";
    showContent = "万位: ({0}), 千位: ({1}), 百位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 前三直选-单式
 */
function suiji_q3zxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "前三直选-单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = "{0}{1}{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前三直选复式
 */
function suiji_q3zxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "前三直选-复式";
    showContent = "万位: ({0}), 千位: ({1}), 百位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/******************************************************/
/**************后三*************/

/**
 * 后三其它-特殊号"
 */
function suiji_h3tsh() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arrTsh = [], newArr = [];
    arrTsh[0] = "对子";
    arrTsh[1] = "顺子";
    arrTsh[2] = "豹子";
    while (newArr.length != 1) {
        var zhiTsh = parseInt(Math.random() * 3);
        newArr.push(arrTsh[parseInt(zhiTsh)]);
    }

    showPlayName = "后三其它-特殊号";
    showContent = "特殊号: (" + newArr[0] + ")";
    betContent = newArr[0];

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 后三其它-后三和值尾数"
 */
function suiji_h3hzws() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "后三其它-后三和值尾数";
    showContent = "尾数: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/**
 * 后三直选-组选包胆
 */
function suiji_h3zxbd() {
    var baoDanArr = [];
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    baoDanArr.push(arr);
    betZhushu = getZxbdNewArrs(baoDanArr).length;
    showPlayName = "后三直选-组选包胆";
    showContent = "包胆: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 后三直选-组选和值
 */
function suiji_h3zuxhz() {
    var fuShiArr = [];
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;

    var tempArr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    fuShiArr.push(arr);
    betZhushu = getZxhzNewArrs(fuShiArr).length;
    showPlayName = "后三直选-组选和值";
    showContent = "和值: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 后三组选-混合组选
 */
function suiji_h3hhzx() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        var xHhzx = parseInt(Math.random() * 10);
        var yHhzx = parseInt(Math.random() * 10);
        var zHhzx = parseInt(Math.random() * 10);
        if (xHhzx == yHhzx && yHhzx != zHhzx || xHhzx == zHhzx && zHhzx != yHhzx || yHhzx == zHhzx && zHhzx != xHhzx || xHhzx != yHhzx && yHhzx != zHhzx && zHhzx != xHhzx) {
            arr.push(xHhzx);
            arr.push(yHhzx);
            arr.push(zHhzx);
        }
    }

    showPlayName = "后三组选-混合组选";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = "{0}{1}{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 后三组选-组六单式
 */
function suiji_h3z6ds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = parseInt(Math.random() * 10);
        var yZlfs = parseInt(Math.random() * 10);
        var zZlfs = parseInt(Math.random() * 10);
        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "后三组选-组六单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = "{0}{1}{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 后三组选-组六复式
 */
function suiji_h3z6fs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        var xZlfs = parseInt(Math.random() * 10);
        var yZlfs = parseInt(Math.random() * 10);
        var zZlfs = parseInt(Math.random() * 10);
        if (xZlfs != yZlfs && yZlfs != zZlfs && zZlfs != xZlfs) {
            arr.push(xZlfs);
            arr.push(yZlfs);
            arr.push(zZlfs);
        }
    }

    showPlayName = "后三组选-组六复式";
    showContent = "组六: ({0},{1},{2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0},{1},{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/**
 * 后三组选-组三单式
 */
function suiji_h3z3ds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        var xZxds = parseInt(Math.random() * 10);
        var yZxds = parseInt(Math.random() * 10);
        var zZxds = parseInt(Math.random() * 10);
        if (xZxds == yZxds && yZxds != zZxds || xZxds == zZxds && zZxds != yZxds || yZxds == zZxds && zZxds != xZxds) {
            arr.push(xZxds);
            arr.push(yZxds);
            arr.push(zZxds);
        }
    }

    showPlayName = "后三组选-组三单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = "{0}{1}{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 后三组选-组三复式
 */
function suiji_h3z3fs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = 0;

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 2) {
        var x = parseInt(Math.random() * 10);
        var y = parseInt(Math.random() * 10);
        if (x != y) {
            arr.push(x);
            arr.push(y);
        }
    }

    showPlayName = "后三组选-组三复式";
    showContent = "组三: ({0},{1})".format(arr[0], arr[1]);
    betContent = "{0},{1}".format(arr[0], arr[1]);
    betZhushu = 2; //默认两个号码两注
    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 后三直选-跨度
 */
function suiji_h3zxkd() {
    // 初始化变量
    var betZhushu = 0;
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    betZhushu = getKaduNewArrs(arr).length;
    showPlayName = "后三直选-跨度";
    showContent = "跨度: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 后三直选-和值
 */
function suiji_h3zxhz() {
    var betZhushu = 0;
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27];
    var arr = [];
    while (arr.length < 1) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    betZhushu = getHezNewArrs(arr).length;
    showPlayName = "后三直选-和值";
    showContent = "和值: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 后三直选-组合
 */
function suiji_h3zh() {
    var baiArr = [], shiArr = [], geArr = [];
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';
    var betZhushu = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    baiArr.push(arr[0]);
    shiArr.push(arr[1]);
    geArr.push(arr[2]);
    betZhushu = (getHszhNewArrs(baiArr, shiArr, geArr)).length
    showPlayName = "后三直选-组合";
    showContent = "百位: ({0}), 十位: ({1}), 个位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        betZhushu: betZhushu,
        playGroupId: playGroupId
    };
}

/**
 * 后三直选-单式
 */
function suiji_h3zxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "后三直选-单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + ")";
    betContent = "{0}{1}{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 后三直选复式
 */
function suiji_h3zxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 3) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "后三直选-复式";
    showContent = "百位: ({0}), 十位: ({1}), 个位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 5星直选复式
 */
function suiji_5xzxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 5) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "五星直选-复式";
    showContent = "万位: ({0}), 千位: ({1}), 百位: ({2}), 十位: ({3}), 个位: ({4})".format(arr[0], arr[1], arr[2], arr[3], arr[4]);
    betContent = "{0}|{1}|{2}|{3}|{4}".format(arr[0], arr[1], arr[2], arr[3], arr[4]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 4星直选复式
 */
function suiji_4xzxfs() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 4) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "四星直选-复式";
    showContent = "千位: ({0}), 百位: ({1}), 十位: ({2}), 个位: ({3})".format(arr[0], arr[1], arr[2], arr[3]);
    betContent = "{0}|{1}|{2}|{3}".format(arr[0], arr[1], arr[2], arr[3]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
function suiji_jspk10_qy() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];
    var arr = [];
    while (arr.length <= 1) {
        arr.push(tempArr[parseInt(Math.random() * 10)]);
    }

    showPlayName = "前一-直选复式";
    showContent = "冠军: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

function suiji_qy() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'];
    var arr = [];
    while (arr.length <= 1) {
        arr.push(tempArr[parseInt(Math.random() * 10)]);
    }

    showPlayName = "前一-直选复式";
    showContent = "冠军: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}
/**
 * 5星直选单式
 */
function suiji_5xzxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 5) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "五星直选-单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + "" + arr[3] + "" + arr[4] + ")";
    betContent = "{0}{1}{2}{3}{4}".format(arr[0], arr[1], arr[2], arr[3], arr[4]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 4星直选单式
 */
function suiji_4xzxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var arr = [];
    while (arr.length < 4) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "4星直选-单式";
    showContent = "号码: (" + arr[0] + "" + arr[1] + "" + arr[2] + "" + arr[3] + ")";
    betContent = "{0}{1}{2}{3}".format(arr[0], arr[1], arr[2], arr[3]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前二大小单双
 */
function suiji_q2dxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ["大", "小", "单", "双"];
    var arr = [];
    while (arr.length < 2) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }
    showPlayName = "前二大小单双";
    showContent = "万位: ({0}), 千位: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}


/**
 * 后二大小单双
 */
function suiji_h2dxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ["大", "小", "单", "双"];
    var arr = [];
    while (arr.length < 2) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "后二大小单双";
    showContent = "十位: ({0}), 个位: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 前三大小单双
 */
function suiji_q3dxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ["大", "小", "单", "双"];
    var arr = [];
    while (arr.length < 3) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "后二大小单双";
    showContent = "万位: ({0}), 千位: ({1}), 百位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 后三大小单双
 */
function suiji_h3dxds() {
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var tempArr = ["大", "小", "单", "双"];
    var arr = [];
    while (arr.length < 3) {
        arr.push(tempArr[parseInt(Math.random() * tempArr.length)]);
    }

    showPlayName = "后三大小单双";
    showContent = "百位: ({0}), 十位: ({1}), 个位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

// 官方玩法数据转换，转换为提交格式
//===============================获取内容算法===================================
function tjzd() {
    var plSelIndex = 0; //特殊号多赔率
    var plSelName = ''; //特殊号多赔率名称
    var plSelVal = 0; //特殊号赔率值

    var contentFun = getPlayPlFun_content();    // 内容算法
    var zhushuFun = getPlayPlFun_zhushu();  // 注数算法
    if (typeof contentFun == 'undefined' || typeof zhushuFun == 'undefined') {
        return;
    }


    var data = eval(contentFun + "()");
    var zhushu = eval(zhushuFun + "()");

    if (data == -1) {
        return;
    }

    if (typeof data == 'undefined' || typeof zhushu == 'undefined' || zhushu <= 0) {
        alert("号码选择不完整，请重新选择");
        return;
    }

    if ($.inArray(playId, [515, 534, 936, 914, 639, 625, 1013, 991, 730, 708, 859, 837]) >= 0) {
        var l = $('.cl-1015-tsh ul li span.acti_tsh').length;
        if (l == 1) {
            $('.cl-1015-tsh ul li span.acti_tsh').each(function () {
                plSelName = $(this).html();
            });
            if (plSelName == '豹子') {
                plSelIndex = 0;
            } else if (plSelName == '顺子') {
                plSelIndex = 1;
            } else if (plSelName == '对子') {
                plSelIndex = 2;
            }
        }
        var tempNum = $("#jiangjin-change").data("plStr");
        plSelVal = (tempNum.split("|"))[plSelIndex];
    } else {
        plSelVal = $("#jiangjin-change").data("value");
    }

    var obj = {};
    //======函数获取=====
    obj.showPlayName = data.showPlayName;
    obj.showContent = data.showContent;
    obj.betContent = data.betContent;
    //======动态获取=====
    obj.betPerMoney = $("#inputMoney").data("money");
    obj.betZhushu = zhushu;
    obj.betBeishu = $("#inputBeishu").data("beishu");
    obj.betMode = getSelectMode();
    obj.betTotalMoney = (obj.betZhushu * obj.betPerMoney * getMode(obj.betMode) * obj.betBeishu).toFixed(3);
    obj.betPlayGroupId = playGroupId;
    obj.betFandian = $("#fandian-bfb").data("value");
    obj.betPlayPl = plSelVal;
    var strPlId = getPlayPlId();
    if (strPlId.toString().indexOf('|') > 0) {
        obj.betPlayPlId = (strPlId.toString().split("|"))[plSelIndex];
    } else {
        obj.betPlayPlId = getPlayPlId();
    }
    obj.betPlayId = getPlayId();

    clearSelected();
    clearTextarea();
    clearStateTouZhu();
    addYuxuan(obj);
    calcAll();

    //改变追号模板内每期总额值
    var optionVal = parseInt($('#lt_zh_qishu').val());
    selectedCheckboxtbzh(optionVal);

    //点击随机数时计算追号总额
    $("#zhInfo .tabs ul li:first-child").trigger('click');
    $('.zhfbzjetxt').html(getFbTotelMoney());
    $('.zhzjetxt').html(getTbTotelMoney());
}
//**************任选4***************
/**
 * 任选4-组选4
 */
function content_rx4zu4() {
    var sanChongHaoArr = [], danHaoArr = [];
    var checkStrArr = [], checkArr = [];

    $.each($(".recl-1007-zux4 ul li[data-name = '三重号'] span.acti"), function (index, value) {
        sanChongHaoArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1007-zux4 ul li[data-name = '单号'] span.acti"), function (index, value) {
        danHaoArr.push($.trim($(this).find("i").html()));
    });

    $(".re-select-zux4 input[name='position_zux4']:checked").each(function () {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任四组选-组选4";
    showContent = "三重号: (" + sanChongHaoArr.join(",") + "), " + "单号: (" + danHaoArr.join(",") + ")";
    betContent = checkStrArr.join(',') + "|" + sanChongHaoArr.join(",") + "|" + danHaoArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}

/**
 * 任选4-组选6
 */
function content_rx4zu6() {
    var erChongHaoArr = [];
    var checkStrArr = [], checkArr = [];
    $.each($(".recl-1006-zux6 ul li[data-name = '二重号'] span.acti"), function (index, value) {
        erChongHaoArr.push($.trim($(this).find("i").html()));
    });

    $(".re-select-zux6 input[name='position_zux6']:checked").each(function () {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任四组选-组选6";
    showContent = "二重号: (" + erChongHaoArr.join(",") + ")";
    betContent = checkStrArr.join(',') + "|" + erChongHaoArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}

/**
 * 任选4-组选12
 */
function content_rx4zu12() {
    var erChongHaoArr = [], danHaoArr = [];
    var checkStrArr = [], checkArr = [];
    $.each($(".recl-1005-zux12 ul li[data-name = '二重号'] span.acti"), function (index, value) {
        erChongHaoArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1005-zux12 ul li[data-name = '单号'] span.acti"), function (index, value) {
        danHaoArr.push($.trim($(this).find("i").html()));
    });

    $(".re-select-zux12 input[name='position_zux12']:checked").each(function () {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任四组选-组选12";
    showContent = "二重号: (" + erChongHaoArr.join(",") + "), " + "单号: (" + danHaoArr.join(",") + ")";
    betContent = checkStrArr.join(',') + "|" + erChongHaoArr.join(",") + "|" + danHaoArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}

/**
 * 任选4-组选24
 */
function content_rx4zu24() {
    var zu24Arr = [];
    var checkArr = [], checkStrArr = [];
    $.each($(".recl-1004-zux24 ul li[data-name = '组选24'] span.acti"), function (index, value) {
        zu24Arr.push($.trim($(this).find("i").html()));
    });

    $(".re-select-zux24 input[type='checkbox']:checked").each(function () {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任四组选-组选24";
    showContent = "组选24: (" + zu24Arr.join(",") + ")";
    betContent = checkStrArr.join(',') + "|" + zu24Arr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}

/**
 * 任选4-组选24cyd
 */
function content_gd11x5_rxsizs() {
    var zu24Arr = [];
    $.each($(".recl-1002 ul li[data-name = '选4中4'] span.acti"), function (index, value) {
        zu24Arr.push($.trim($(this).find("i").html()));
    });

    if (zu24Arr.length < 4) {
        alert("[选四中四]至少需要选择4个位置");
        return -1;
    }
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选复式-4中4";
    showContent = "任选复式-4中4: (" + zu24Arr.join(",") + ")";
    betContent = zu24Arr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}

/**
 * 任选4-组选24cyd
 */
function content_gd11x5_rxwzw() {
    var zu24Arr = [];
    $.each($(".recl-1002 ul li[data-name = '选5中5'] span.acti"), function (index, value) {
        zu24Arr.push($.trim($(this).find("i").html()));
    });

    if (zu24Arr.length < 5) {
        alert("[选5中5]至少需要选择5个位置");
        return -1;
    }
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选复式-5中5";
    showContent = "任选复式-5中5: (" + zu24Arr.join(",") + ")";
    betContent = zu24Arr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}


function content_gd11x5_rxlzw() {
    var zu24Arr = [];
    $.each($(".recl-1002 ul li[data-name = '选6中5'] span.acti"), function (index, value) {
        zu24Arr.push($.trim($(this).find("i").html()));
    });

    if (zu24Arr.length < 6) {
        alert("[选6中5]至少需要选择6个位置");
        return -1;
    }
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选复式-6中5";
    showContent = "任选复式-6中5: (" + zu24Arr.join(",") + ")";
    betContent = zu24Arr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}

function content_gd11x5_rxqzw() {
    var zu24Arr = [];
    $.each($(".recl-1002 ul li[data-name = '选7中5'] span.acti"), function (index, value) {
        zu24Arr.push($.trim($(this).find("i").html()));
    });

    if (zu24Arr.length < 7) {
        alert("[选7中5]至少需要选择7个位置");
        return -1;
    }
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选复式-7中5";
    showContent = "任选复式-7中5: (" + zu24Arr.join(",") + ")";
    betContent = zu24Arr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}

function content_gd11x5_rxbzw() {
    var zu24Arr = []
    $.each($(".recl-1002 ul li[data-name = '选8中5'] span.acti"), function (index, value) {
        zu24Arr.push($.trim($(this).find("i").html()));
    });

    if (zu24Arr.length < 8) {
        alert("[选8中5]至少需要选择8个位置");
        return -1;
    }
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选复式-8中5";
    showContent = "任选复式-8中5: (" + zu24Arr.join(",") + ")";
    betContent = zu24Arr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}


/**
 * 任选4-直选单式
 */
function content_rx4zxfs() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var wanStr = wanArr.length > 0 ? ("万位: " + wanArr.join("")) : '';
    var qianStr = qianArr.length > 0 ? (" 千位: " + qianArr.join("")) : '';
    var baiStr = baiArr.length > 0 ? (" 百位: " + baiArr.join("")) : '';
    var shiStr = shiArr.length > 0 ? (" 十位: " + shiArr.join("")) : '';
    var geStr = geArr.length > 0 ? (" 个位: " + geArr.join("")) : '';

    var strTemp = $.trim(
        (wanStr == ' ' ? ' ' : wanArr.join(",") + "|") +
        (qianStr == ' ' ? ' ' : qianArr.join(",") + "|") +
        (baiStr == ' ' ? ' ' : baiArr.join(",") + "|") +
        (shiStr == ' ' ? ' ' : shiArr.join(",") + "|") +
        (geStr == ' ' ? ' ' : geArr.join(","))
    );

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任四直选-直选复式";
    showContent = $.trim(wanStr + qianStr + baiStr + shiStr + geStr);
    betContent = strTemp;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}
/**
 * 任选4-直选单式
 */
function content_rx4zxds() {
    var errorStr = '';
    var repeatArr = [], allErrorArr = [];
    var errorArr = [];
    var checkArr = [], checkStrArr = [];
    var textStr = $(".recl-1003-zxds .content_jiang .content_tex").val();
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != "") {
                errorArr.push(arr_new[i]);
            }
        }
    }

    // repeatArr = newArr.duplicateNew(); //重复号码
    // newArr = newArr.uniqueArr();
    var arrTemp = [];
    $(".re-select-ds input[type='checkbox']:checked").each(function () {
        checkArr.push($(this).val());
    });

    if (checkArr.length < 4) {
        alert("[任选四]至少需要选择4个位置");
        return -1;
    }

    if (newArr.length <= 0) {
        return 0;
    }

    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    // if (repeatArr.length > 0) {
    //     allErrorArr.push("自动过滤重复号码:");
    //     for(var r = 0; r < repeatArr.length; r++){
    //         allErrorArr.push(repeatArr[r]);
    //     }
    // }
    if (errorArr.length > 0) {
        allErrorArr.push(" 被过滤掉的错误号码");
        for (var l = 0; l < errorArr.length; l++) {
            allErrorArr.push(errorArr[l]);
        }
    }

    if (allErrorArr.length > 0) {
        for (var e = 0; e < allErrorArr.length; e++) {
            errorStr += allErrorArr[e] + " ";
        }
        alert(errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任四直选-直选单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    betContent = checkStrArr.join(',') + "|" + newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    }
}

//**************任选3***************
/**
 * 任选3-组选和值
 */
function content_rx3zuxhz() {
    var hzArr = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-zuxhz input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    $.each($(".recl-1010-zuxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    })

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    showPlayName = "任三直选-组选和值";
    showContent = "号码: (" + hzArr.join(",") + ")";
    betContent = checkStrArr.join(',') + "|" + hzArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
        playGroupId: playGroupId
    };
}

/**
 * 任选3-混合组选
 */
function content_rx3hhzux() {
    var errorStr = '', zhushu = 0;
    var repeatArr = [], allErrorArr = [];
    var errorArr = [], arrTemp = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-hhzux input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    var textStr = $(".recl-1009-hhzux .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            if(arr_new[i] != ''){
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var arr = [];
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        arr.push(oneStr);
        arr.push(twoStr);
        arr.push(threeStr);
        arr.sort();
        if (twoStr == threeStr && oneStr == threeStr && twoStr == oneStr) {
            errorArr.push(newArr[n]);
        } else {
            tempArr.push(arr.join(""));
        }
    }
    repeatArr = tempArr.duplicate(); //重复号码
    tempArr = tempArr.uniqueArr(); // 去掉重复号码

    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    if (repeatArr.length > 0) {
        allErrorArr.push("自动过滤重复号码:");
        for (var r = 0; r < repeatArr.length; r++) {
            allErrorArr.push(repeatArr[r]);
        }
    }

    if (errorArr.length > 0) {
        allErrorArr.push(" 被过滤掉的错误号码:");
        for (var l = 0; l < errorArr.length; l++) {
            allErrorArr.push(errorArr[l]);
        }
    }

    if (allErrorArr.length > 0) {
        for (var e = 0; e < allErrorArr.length; e++) {
            errorStr += allErrorArr[e] + " ";
        }
        alert($.trim(errorStr));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任三组选-混合组选";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + tempArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选3-组六单式
 */
function content_rx3z6ds() {
    var errorStr = '', zhushu = 0;
    var repeatArr = [], allErrorArr = [];
    var errorArr = [], arrTemp = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-zu6ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    var textStr = $(".recl-1008-zu6ds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != "") {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var arr = [];
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        arr.push(oneStr);
        arr.push(twoStr);
        arr.push(threeStr);
        arr.sort();
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr) {
            tempArr.push(arr.join(""));
        } else {
            errorArr.push(newArr[n]);
        }
    }

    // repeatArr = tempArr.duplicateNew().uniqueArr(); //重复号码
    // tempArr = tempArr.uniqueArr(); // 去掉重复号码

    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    // if (repeatArr.length > 0) {
    //     allErrorArr.push("自动过滤重复号码:");
    //     for (var r = 0; r < repeatArr.length; r++) {
    //         allErrorArr.push(repeatArr[r]);
    //     }
    // }
    if (errorArr.length > 0) {
        allErrorArr.push(" 被过滤掉的错误号码:");
        for (var l = 0; l < errorArr.length; l++) {
            allErrorArr.push(errorArr[l]);
        }
    }

    if (allErrorArr.length > 0) {
        for (var e = 0; e < allErrorArr.length; e++) {
            errorStr += allErrorArr[e] + " ";
        }
        alert($.trim(errorStr));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任三组选-组六单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + tempArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选3-组六复式
 */
function content_rx3z6fs() {
    var zuArr = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-zu6fs input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    $.each($(".recl-1007-zu6fs ul li[data-name = '组六'] span.acti"), function (index, value) {
        zuArr.push($.trim($(this).find("i").html()));
    });

    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任三组选-组六复式";
    showContent = "号码: (" + zuArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + zuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选3-组三单式
 */
function content_rx3z3ds() {
    var errorStr = '', zhushu = 0;
    var repeatArr = [], allErrorArr = [];
    var errorArr = [], arrTemp = [];
    var textStr = $(".recl-1006-zu3ds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));

    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-zu3ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    var arr_new = textStr.split(",");

    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != "") {
                errorArr.push(arr_new[i]);
            }
        }
    }

    for (var n = 0; n < newArr.length; n++) {
        var arr = [];
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        arr.push(oneStr);
        arr.push(twoStr);
        arr.push(threeStr);
        arr.sort();
        if (oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(arr.join(""));
        } else {
            errorArr.push(newArr[n]);
        }
    }
    // repeatArr = tempArr.duplicateNew().uniqueArr(); //重复号码
    // tempArr = tempArr.uniqueArr(); // 去掉重复号码

    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    // if (repeatArr.length > 0) {
    //     allErrorArr.push("自动过滤重复号码:");
    //     for (var r = 0; r < repeatArr.length; r++) {
    //         allErrorArr.push(repeatArr[r]);
    //     }
    // }
    if (errorArr.length > 0) {
        allErrorArr.push(" 被过滤掉的错误号码:");
        for (var l = 0; l < errorArr.length; l++) {
            allErrorArr.push(errorArr[l]);
        }
    }

    if (allErrorArr.length > 0) {
        for (var e = 0; e < allErrorArr.length; e++) {
            errorStr += allErrorArr[e] + " ";
        }
        alert($.trim(errorStr));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任三组选-组三单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + tempArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选3-组三复式
 */
function content_rx3z3fs() {
    var zuArr = [], arrTemp = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".recl-1005-zu3Rx3 input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    $.each($(".recl-1005-zu3fs ul li[data-name = '组三'] span.acti"), function (index, value) {
        zuArr.push($.trim($(this).find("i").html()));
    });

    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任三组选-组三复式";
    showContent = "号码: (" + zuArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + zuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选3-直选和值
 */
function content_rx3zxhz() {
    var hzArr = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".recl-1004-hz input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    $.each($(".recl-1004-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任三直选-直选和值";
    showContent = "号码: (" + hzArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + hzArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选3-直选单式
 */
function content_rx3zxds() {
    var errorStr = '';
    var repeatArr = [], allErrorArr = [];
    var errorArr = [];
    var newArr = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    var textStr = $(".recl-1003-zxds .content_jiang .content_tex").val();

    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != "") {
                errorArr.push(arr_new[i]);
            }
        }
    }


    if (checkArr.length < 3) {
        alert("[任选三]至少需要选择3个位置");
        return -1;
    }

    if (newArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        allErrorArr.push(" 被过滤掉的错误号码");
        for (var l = 0; l < errorArr.length; l++) {
            allErrorArr.push(errorArr[l]);
        }
    }

    if (allErrorArr.length > 0) {
        for (var e = 0; e < allErrorArr.length; e++) {
            errorStr += allErrorArr[e] + " ";
        }
        alert(errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任三直选-直选单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选3-直选复式
 */
function content_rx3zxfs() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var wanStr = wanArr.length > 0 ? ("万位: " + wanArr.join("")) : '';
    var qianStr = qianArr.length > 0 ? (" 千位: " + qianArr.join("")) : '';
    var baiStr = baiArr.length > 0 ? (" 百位: " + baiArr.join("")) : '';
    var shiStr = shiArr.length > 0 ? (" 十位: " + shiArr.join("")) : '';
    var geStr = geArr.length > 0 ? (" 个位: " + geArr.join("")) : '';
    var strTemp = $.trim(
        (wanStr == ' ' ? ' ' : wanArr.join(",") + "|") +
        (qianStr == ' ' ? ' ' : qianArr.join(",") + "|") +
        (baiStr == ' ' ? ' ' : baiArr.join(",") + "|") +
        (shiStr == ' ' ? ' ' : shiArr.join(",") + "|") +
        (geStr == ' ' ? ' ' : geArr.join(","))
    );

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任三直选-直选复式";
    showContent = $.trim(wanStr + qianStr + baiStr + shiStr + geStr);
    // 转换投注格式
    betContent = strTemp;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

//**************任选2***************
/**
 * 任选二-组选和值
 */
function content_rx2zuxhz() {
    var hzArr = [], arrTemp = [];
    var checkArr = [], checkStrArr = [];
    //选取选中checkbox
    $.each($(".re-select-zuxhz input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    $.each($(".recl-1007-zuxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    $(".recl-1007-zuxhz input[name='position_zuxhz']:checked").each(function () {
        arrTemp.push($(this).val());
    });
    if (arrTemp.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任二组选-组选和值";
    showContent = "号码: (" + hzArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + hzArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选二-组选单式
 */
function content_rx2zuxds() {
    var checkStrArr = [], checkArr = [];
    //选取选中checkbox
    $.each($(".re-select-zuxds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    var errorStr = '';
    var repeatArr = [], allErrorArr = [];
    var errorArr = [], arrTemp = [];
    var textStr = $(".recl-1006-zuxds .content_jiang .content_tex").val();
    var newArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            var oneStr = (arr_new[i].toString()).substr(0, 1);
            var twoStr = (arr_new[i].toString()).substr(1, 1);
            var arr = [];
            arr.push(parseInt(oneStr));
            arr.push(parseInt(twoStr));
            arr.sort();
            newArr.push(arr.join(""));
        } else {
            if (arr_new[i] != "") {
                errorArr.push(arr_new[i]);
            }
        }
    }

    if (checkArr.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    if (newArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        allErrorArr.push(" 被过滤掉的错误号码");
        for (var l = 0; l < errorArr.length; l++) {
            allErrorArr.push(errorArr[l]);
        }
    }

    if (allErrorArr.length > 0) {
        for (var e = 0; e < allErrorArr.length; e++) {
            errorStr += allErrorArr[e] + " ";
        }
        alert(errorStr);
    }

    $(".re-select-zuxds input[type='checkbox']:checked").each(function () {
        arrTemp.push($(this).val());
    });
    if (arrTemp.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任二组选-组选单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选二-组选复式
 */
function content_rx2zuxfs() {
    var checkStrArr = [], checkArr = [];
    //选取选中checkbox
    $.each($(".recl-1005-fs input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    var zuArr = [], arrTemp = [];
    $.each($(".recl-1005-zuxfs ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuArr.push($.trim($(this).find("i").html()));
    });

    if (checkArr.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任二组选-组选复式";
    showContent = "号码: (" + zuArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + zuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选二-直选和值
 */
function content_rx2zxhz() {
    var hzArr = [], arrTemp = [], checkStrArr = [], checkArr = [];
    $.each($(".recl-1004-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });
    //选取选中checkbox
    $.each($(".recl-1004-hz input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);

    $(".recl-1004-zxhz input[name='position_hz']:checked").each(function () {
        arrTemp.push($(this).val());
    });
    if (arrTemp.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任二直选-直选和值";
    showContent = "号码: (" + hzArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + hzArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选二-直选单式
 */
function content_rx2zxds() {
    var checkStrArr = [], checkArr = [];
    var errorStr = '';
    var repeatArr = [], allErrorArr = [];
    var errorArr = [];

    var textStr = $(".recl-1003-zxds .content_jiang .content_tex").val();
    //选取选中checkbox
    $.each($(".re-select-ds input[type='checkbox']:checked"), function (index, value) {
        checkArr.push($(this).val());
    });
    //获取位数字符串
    checkStrArr = getNoWeiStr(checkArr);
    var newArr = [], arrTemp = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != "") {
                errorArr.push(arr_new[i]);
            }
        }
    }

    $(".recl-1003-zxds input[name='position_ds']:checked").each(function () {
        arrTemp.push($(this).val());
    });
    if (arrTemp.length < 2) {
        alert("[任选二]至少需要选择2个位置");
        return -1;
    }

    if (newArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        allErrorArr.push(" 被过滤掉的错误号码");
        for (var l = 0; l < errorArr.length; l++) {
            allErrorArr.push(errorArr[l]);
        }
    }

    if (allErrorArr.length > 0) {
        for (var e = 0; e < allErrorArr.length; e++) {
            errorStr += allErrorArr[e] + " ";
        }
        alert(errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任二直选-直选单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    // 转换投注格式
    betContent = checkStrArr.join(',') + "|" + newArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 任选二-直选复式
 */
function content_rx2zxfs() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var wanStr = wanArr.length > 0 ? ("万位: " + wanArr.join("")) : '';
    var qianStr = qianArr.length > 0 ? (" 千位: " + qianArr.join("")) : '';
    var baiStr = baiArr.length > 0 ? (" 百位: " + baiArr.join("")) : '';
    var shiStr = shiArr.length > 0 ? (" 十位: " + shiArr.join("")) : '';
    var geStr = geArr.length > 0 ? (" 个位: " + geArr.join("")) : '';
    var strTemp = $.trim(
        (wanStr == ' ' ? ' ' : wanArr.join(",") + "|") +
        (qianStr == ' ' ? ' ' : qianArr.join(",") + "|") +
        (baiStr == ' ' ? ' ' : baiArr.join(",") + "|") +
        (shiStr == ' ' ? ' ' : shiArr.join(",") + "|") +
        (geStr == ' ' ? ' ' : geArr.join(","))
    );

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任二直选-直选复式";
    showContent = $.trim(wanStr + qianStr + baiStr + shiStr + geStr);
    // 转换投注格式
    betContent = strTemp;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

//**************不定位***************
/**
 * 不定位-五星三码
 */
function content_wx3m() {
    var budwArr = [];
    $.each($(".recl-1012-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "五星-五星三码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-五星二码
 */
function content_wxem() {
    var budwArr = [];
    $.each($(".recl-1011-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "五星-五星二码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-五星一码
 */
function content_wxym() {
    var budwArr = [];
    $.each($(".recl-1010-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "五星-五星一码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 不定位-后三二码
 */
function content_h4em() {
    var budwArr = [];
    $.each($(".recl-1009-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "四星-后四二码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-后四一码
 */
function content_h4ym() {
    var budwArr = [];
    $.each($(".recl-1008-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "四星-后四一码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-前四二码
 */
function content_q4em() {
    var budwArr = [];
    $.each($(".recl-1007-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "四星-前四二码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-前四一码
 */
function content_q4ym() {
    var budwArr = [];
    $.each($(".recl-1006-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "四星-前四一码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-后三二码
 */
function content_hsem() {
    var budwArr = [];
    $.each($(".recl-1005-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "三星-后三二码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-后三一码
 */
function content_hsym() {
    var budwArr = [];
    $.each($(".recl-1004-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "三星-后三一码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-前三二码
 */
function content_qsem() {
    var budwArr = [];
    $.each($(".recl-1003-budw ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "三星-前三二码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",")

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 不定位-前三一码
 */
function content_qsym() {
    var budwArr = [];
    $.each($(".cl-1002 ul li[data-name = '不定位'] span.acti"), function (index, value) {
        budwArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "三星-前三一码";
    showContent = "不定位: (" + budwArr.join(",") + ")";
    // 转换投注格式
    betContent = budwArr.join(",")

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

//**************定位胆***************
/**
 * 定位胆
 */
function content_dwd() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var wanStr = wanArr.length > 0 ? ("万位: (" + wanArr.join(",") + ")") : "";
    var qianStr = qianArr.length > 0 ? (" 千位: (" + qianArr.join(",") + ")") : "";
    var baiStr = baiArr.length > 0 ? (" 百位: (" + baiArr.join(",") + ")") : "";
    var shiStr = shiArr.length > 0 ? (" 十位: (" + shiArr.join(",") + ")") : "";
    var geStr = geArr.length > 0 ? (" 个位: (" + geArr.join(",") + ")") : "";

    var nowArr = [];
    var strTemp = $.trim(
        (wanStr == ' ' ? ' ' : wanArr.join(",") + "|") +
        (qianStr == ' ' ? ' ' : qianArr.join(",") + "|") +
        (baiStr == ' ' ? ' ' : baiArr.join(",") + "|") +
        (shiStr == ' ' ? ' ' : shiArr.join(",") + "|") +
        (geStr == ' ' ? ' ' : geArr.join(","))
    );

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "定位胆-定位胆";
    showContent = $.trim(wanStr + qianStr + baiStr + shiStr + geStr);
    // 转换投注格式
    betContent = strTemp;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 定位胆
 */
function content_gd11x5_dwd() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '第一位'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第二位'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第三位'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第四位'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第五位'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    var wanStr = wanArr.length > 0 ? ("(" + wanArr.join(",") + ")") : "";
    var qianStr = qianArr.length > 0 ? ("(" + qianArr.join(",") + ")") : "";
    var baiStr = baiArr.length > 0 ? ("(" + baiArr.join(",") + ")") : "";
    var shiStr = shiArr.length > 0 ? ("(" + shiArr.join(",") + ")") : "";
    var geStr = geArr.length > 0 ? ("(" + geArr.join(",") + ")") : "";

    var nowArr = [];
    var strTemp = $.trim(
        (wanStr == ' ' ? ' ' : wanArr.join(",") + "|") +
        (qianStr == ' ' ? ' ' : qianArr.join(",") + "|") +
        (baiStr == ' ' ? ' ' : baiArr.join(",") + "|") +
        (shiStr == ' ' ? ' ' : shiArr.join(",") + "|") +
        (geStr == ' ' ? ' ' : geArr.join(","))
    );

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "定位胆-定位胆";
    showContent = $.trim(wanStr + qianStr + baiStr + shiStr + geStr);
    // 转换投注格式
    betContent = strTemp;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


//**************定位胆***************
/**
 * 定位胆
 */
function content_dwdzxfs() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    var gj = [], yj = [],  jj = [], ds = [],dw = [] ,dt = [],dq = [],db = [],dj = [],dsm = [];
    $.each($(".cl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        gj.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '亚军'] span.acti"), function (index, value) {
        yj.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '季军'] span.acti"), function (index, value) {
        jj.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第四名'] span.acti"), function (index, value) {
        ds.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第五名'] span.acti"), function (index, value) {
        dw.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第六名'] span.acti"), function (index, value) {
        dt.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第七名'] span.acti"), function (index, value) {
        dq.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第八名'] span.acti"), function (index, value) {
        db.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第九名'] span.acti"), function (index, value) {
        dj.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '第十名'] span.acti"), function (index, value) {
        dsm.push($.trim($(this).find("i").html()));
    });

    var gjStr = gj.length > 0 ? ("冠军: (" + gj.join(",") + ")") : "";
    var yjStr = yj.length > 0 ? (" 亚军: (" + yj.join(",") + ")") : "";
    var jjStr = jj.length > 0 ? (" 季军: (" + jj.join(",") + ")") : "";
    var dsStr = ds.length > 0 ? (" 第四名: (" + ds.join(",") + ")") : "";
    var dwStr = dw.length > 0 ? (" 第五名: (" + dw.join(",") + ")") : "";
    var dtStr = dt.length > 0 ? (" 第六名: (" + dt.join(",") + ")") : "";
    var dqStr = dq.length > 0 ? (" 第七名: (" + dq.join(",") + ")") : "";
    var dbStr = db.length > 0 ? (" 第八名: (" + db.join(",") + ")") : "";
    var djStr = dj.length > 0 ? (" 第九名: (" + dj.join(",") + ")") : "";
    var dsmStr = dsm.length > 0 ? (" 第十名: (" + dsm.join(",") + ")") : "";

    var nowArr = [];
    var strTemp = $.trim(
        (gjStr == ' ' ? ' ' : gj.join(",") + "|") +
        (yjStr == ' ' ? ' ' : yj.join(",") + "|") +
        (jjStr == ' ' ? ' ' : jj.join(",") + "|") +
        (dsStr == ' ' ? ' ' : ds.join(",") + "|") +
        (dwStr == ' ' ? ' ' : dw.join(",")+"|")+
        (dtStr == ' ' ? ' ' : dt.join(",") + "|") +
        (dqStr == ' ' ? ' ' : dq.join(",") + "|") +
        (dbStr == ' ' ? ' ' : db.join(",") + "|") +
        (djStr == ' ' ? ' ' : dj.join(",") + "|") +
        (dsmStr == ' ' ? ' ' : dsm.join(","))
    );

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "定位胆-定位胆";
    showContent = $.trim(gjStr + yjStr + jjStr +dsStr + dwStr+ dtStr+ dqStr+ dbStr+ djStr+ dsmStr);
    // 转换投注格式
    betContent = strTemp;

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

//**************前2***************
/**
 * 前二组选-组选包胆
 */
function content_q2zuxbd() {
    var dmArr = [];
    $.each($(".recl-1009-zuxbd ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dmArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二组选-包胆";
    showContent = "包胆: (" + dmArr.join(",") + ")";
    // 转换投注格式
    betContent = dmArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二组选-组选和值
 */
function content_q2zuxhz() {
    var hzArr = [];
    $.each($(".recl-1008-zuxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二组选-和值";
    showContent = "和值: (" + hzArr.join(",") + ")";
    // 转换投注格式
    betContent = hzArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二组选-组选单式
 */
function content_q2zuxds() {
    var textStr = $(".recl-1007-zuxds .content_jiang .content_tex").val();
    var newArr = [];
    var repeatArr = [], errorArr = [], allErrorArr = [], pairArr = [];
    var errorStr = '';
    var zhushu = 0;
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            var strTemp = "", strTemp1 = "";
            var str1 = arr_new[i].toString();
            var str2 = arr_new[i].toString();
            strTemp = str1.substr(0, 1);
            strTemp1 = str2.substr(1, 1);
            if (strTemp != strTemp1) {
                var tempArr = [];
                tempArr.push(parseInt(strTemp));
                tempArr.push(parseInt(strTemp1));
                tempArr.sort();
                newArr.push(tempArr.join(""));
            } else {
                pairArr.push(arr_new[i]);
            }
        } else {
            if (arr_new[i] != "") {
                errorArr.push(arr_new[i]);
            }
        }
    }

    if (newArr.length <= 0) {
        return 0;
    }

    if (pairArr.length > 0) {
        allErrorArr.push("自动过滤对子号码:");
        for (var p = 0; p < pairArr.length; p++) {
            allErrorArr.push(pairArr[p]);
        }
    }

    if (errorArr.length > 0) {
        allErrorArr.push(" 被过滤掉的错误号码");
        for (var l = 0; l < errorArr.length; l++) {
            allErrorArr.push(errorArr[l]);
        }
    }

    if (allErrorArr.length > 0) {
        for (var e = 0; e < allErrorArr.length; e++) {
            errorStr += allErrorArr[e] + " ";
        }
        alert(errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二组选-单式";
    showContent = "号码: (" + newArr + ")";
    // 转换投注格式
    betContent = newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二组选-组选复式
 */
function content_q2zuxfs() {
    var zuxArr = [];
    $.each($(".recl-1006-zuxfs ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuxArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二组选-复式";
    showContent = "组选: (" + zuxArr.join(",") + ")";
    // 转换投注格式
    betContent = zuxArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前二直选-直选跨度
 */
function content_q2zxkd() {
    var kdArr = [];
    $.each($(".recl-1005-zxkd ul li[data-name = '跨度'] span.acti"), function (index, value) {
        kdArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二直选-跨度";
    showContent = "跨度: (" + kdArr.join(",") + ")";
    // 转换投注格式
    betContent = kdArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二直选-直选和值
 */
function content_q2zxhz() {
    var hzArr = [];
    $.each($(".recl-1004-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二直选-和值";
    showContent = "和值: (" + hzArr.join(",") + ")";
    // 转换投注格式
    betContent = hzArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二直选-直选单式
 */
function content_qezxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var errorStr = '';
    var zhushu = 0;
    arrTsh = [01, 02, 03, 04, 05, 06, 07, 08, 09, 10];
   /* textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10]/g, ','));

    var arr_new = textStr.split(",");*/
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var towStr = temp.substr(2, 2);

        tempArr.push(oneStr +" "+ towStr);
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + "";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二直选-直选单式";
    showContent = "号码: (" + tempArr + ")";
    // 转换投注格式
    betContent = tempArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}




/**
 * 前三直选-直选单式
 */
function content_qszxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var errorStr = '';
    var zhushu = 0;

    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);

        if(oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            tempArr.push(oneStr +" "+ twoStr+" " + threeStr);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + "";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三直选-直选单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}
/**
 * 前三直选-直选单式
 */
function content_gd11x5_qszxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorArrs = [];
    var tempArr = [];
    var chongfuArr = [];
    var allStrError = [];
    var zhushu = 0;

    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');

    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i]  != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
               var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }

    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);

        if(oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            tempArr.push(oneStr + ' ' + twoStr + ' ' + threeStr);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(" "));
    }


    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三直选-直选单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}
function content_suiji_gd11x5_rxszsds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var tempArr1 = [];
    var errorArrs = [];
    var chongfuArr1 = [];
    var errorStr = '';
    var zhushu = 0;
    var  chongfuArr = [], allStrError = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);

        if(oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            tempArr.push(oneStr1+"," + twoStr2+"," + threeStr3);
            tempArr1.push(oneStr1+" " + twoStr2+" " + threeStr3);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    chongfuArr1 = tempArr1.duplicateNew();
    tempArr1 = tempArr1.uniqueArr();

    if (chongfuArr1.length > 0) {
        chongfuArr1 = tempArr1.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr1.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选单式-3中3";
    showContent = "号码: (" + tempArr1.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join('|');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxsizsds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var tempArr1 = [];
    var chongfuArr1 = [];
    var tempArr1 = [];
    var chongfuArr1 = [];
    var errorArrs = [];
    var errorStr = '';
    var zhushu = 0;
    var  chongfuArr = [], allStrError = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 8) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var fourStr = temp.substr(6, 2);

        if(threeStr != fourStr &&twoStr != fourStr &&oneStr != fourStr &&oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.push(parseInt(fourStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
            tempArr.push(oneStr1+"," + twoStr2+"," + threeStr3+","+threeStr4);
            tempArr1.push(oneStr1+" " + twoStr2+" " + threeStr3+" "+threeStr4);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    chongfuArr1 = tempArr1.duplicateNew();
    tempArr1 = tempArr1.uniqueArr();

    if (chongfuArr1.length > 0) {
        chongfuArr1 = chongfuArr1.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr1.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选单式-4中4";
    showContent = "号码: (" + tempArr1.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join('|');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxwzwds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var errorStr = '';
    var tempArr1 = [];
    var chongfuArr1 = [];
    var errorArrs = [];
    var zhushu = 0;

    var  chongfuArr = [], allStrError = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 10) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var fourStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        if(fourStr != fiveStr &&threeStr != fiveStr &&twoStr != fiveStr &&oneStr != fiveStr &&threeStr != fiveStr &&threeStr != fourStr &&twoStr != fourStr &&oneStr != fourStr &&oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.push(parseInt(fourStr));
            sotrArr.push(parseInt(fiveStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
            var threeStr5 = sotrArr[4] >= 10 ? sotrArr[4] : ('0' + sotrArr[4]);
            tempArr.push(oneStr1+"," + twoStr2+"," + threeStr3+","+threeStr4+","+threeStr5);
            tempArr1.push(oneStr1+" " + twoStr2+" " + threeStr3+" "+threeStr4+" "+threeStr5);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    chongfuArr1 = tempArr1.duplicateNew();
    tempArr1 = tempArr1.uniqueArr();

    if (chongfuArr.length > 0) {
        chongfuArr1 = chongfuArr1.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr1.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选单式-5中5";
    showContent = "号码: (" + tempArr1.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join('|');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_ssqds(){
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var showTempArr = [];
    var tempArr1 = [];
    var chongfuArr1 = [];
    var errorStr = '';
    var zhushu = 0;
    var  chongfuArr = [], allStrError = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,' ',:,：]/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length ==13) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {  //获取错误红码数字原输入格式
                var str = null;
                var strFlag = true; //是否有分割符《：》(默认错误号有)
                if((arr_new[i].toString()).indexOf(':') >= 0){
                    str = (arr_new[i].toString()).split(':'); //拆分红码和蓝码成两个数组（半角冒号）
                    strFlag = true;
                } else if((arr_new[i].toString()).indexOf('：') >= 0){
                    str =(arr_new[i].toString()).split('：'); //拆分红码和蓝码成两个数组（圆角冒号）
                    strFlag = true;
                } else{
                    str = arr_new[i].toString();
                    strFlag = false;
                }
                var str0 = getReNum(str);
                if(strFlag){
                    errorArr.push(str0 + ':' + str[1]);
                } else {
                    errorArr.push(str0);
                }
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var foureStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        var sixStr = temp.substr(11, 2);
        if (oneStr != fiveStr && twoStr != fiveStr && foureStr != fiveStr && threeStr != fiveStr && threeStr != foureStr && twoStr != foureStr && oneStr != foureStr && oneStr != twoStr && twoStr != threeStr && oneStr != threeStr) {
            if (parseInt(oneStr) < 34 && parseInt(twoStr) < 34 && parseInt(threeStr) < 34 && parseInt(foureStr) < 34 && parseInt(fiveStr) < 34 && parseInt(sixStr) < 17) {
                tempArr.push(oneStr + " " + twoStr + " " + threeStr + " " + foureStr + " " + fiveStr + "," + sixStr);
                showTempArr.push(oneStr + " " + twoStr + " " + threeStr + " " + foureStr + " " + fiveStr + "：" + sixStr);
            } else {
                if (newArr[n] != '') {
                    errorArr.push(oneStr + " " + twoStr + " " + threeStr + " " + foureStr + " " + fiveStr + "：" + sixStr);
                }
            }
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr1 = showTempArr.duplicateNew();
        tempArr = tempArr.uniqueArr();

    if (chongfuArr1.length > 0) {
        chongfuArr1 = chongfuArr1.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr1.join(' '));
    }

    if (errorArr.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArr.join('，'));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }
    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "红蓝直选/单式";
    showContent = "号码: (" + showTempArr.join('； ') + ")";
    // 转换投注格式
    betContent = tempArr.join('|');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

//获取错误重组双色红球号码格式
function getReNum(str){
    var num1 = str[0].toString().length; //红码字符串长度
    var num1str = str[0].toString();
    var numArr = [];
    var numArrStr = '';

    if (num1 % 2 == 0) {
        var weiN1 = 0;
        for (var n1 = 0; n1 < num1; n1 += 2) {
            numArr.push(num1str.substr(n1, 2));
            weiN1 += (weiN1 + 2);
        }
    } else {
        var weiN2 = 0;
        for (var n2 = 0; n2 <= num1 / 2; n2++) {
            if (n2 == num1 / 2) {
                numArr.push(num1str.substr(weiN2, num1 / 2));
            } else {
                numArr.push(num1str.substr(weiN2, 2));
            }
            weiN2 += (weiN2 + 2);
        }
    }

    for(var x = 0; x < numArr.length; x++){
        if(x != numArr.length -1 ){
            numArrStr += numArr[x] + ' ';
        } else{
            numArrStr += numArr[x];
        }
    }

    return numArrStr;
}


function content_gd11x5_rxlzwds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var tempArr1 = [];
    var chongfuArr1 = [];
    var errorArrs = [];
    var errorStr = '';
    var zhushu = 0;
    var  chongfuArr = [], allStrError = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length ==12) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                 errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var fourStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        var sixStr = temp.substr(10, 2);
        if(fiveStr != sixStr &&threeStr != sixStr &&twoStr != sixStr &&oneStr != sixStr &&fourStr != sixStr &&fourStr != fiveStr &&threeStr != fiveStr &&twoStr != fiveStr &&oneStr != fiveStr &&threeStr != fiveStr &&threeStr != fourStr &&twoStr != fourStr &&oneStr != fourStr &&oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.push(parseInt(fourStr));
            sotrArr.push(parseInt(fiveStr));
            sotrArr.push(parseInt(sixStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
            var threeStr5 = sotrArr[4] >= 10 ? sotrArr[4] : ('0' + sotrArr[4]);
            var threeStr6 = sotrArr[5] >= 10 ? sotrArr[5] : ('0' + sotrArr[5]);
            tempArr.push(oneStr1+"," + twoStr2+"," + threeStr3+","+threeStr4+","+threeStr5+","+threeStr6);
            tempArr1.push(oneStr1+" " + twoStr2+" " + threeStr3+" "+threeStr4+" "+threeStr5+" "+threeStr6);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    chongfuArr1 = tempArr1.duplicateNew();
    tempArr1 = tempArr1.uniqueArr();

    if (chongfuArr1.length > 0) {
        chongfuArr1 = chongfuArr1.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr1.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选单式-6中5";
    showContent = "号码: (" + tempArr1.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join('|');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxqzwds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var tempArr1 = [];
    var chongfuArr1 = [];
    var errorArrs = [];
    var errorStr = '';
    var zhushu = 0;
    var  chongfuArr = [], allStrError = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length ==14) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
               errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var fourStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        var sixStr = temp.substr(10, 2);
        var sevenStr = temp.substr(12, 2);
        if(oneStr != sevenStr &&twoStr != sevenStr &&threeStr != sevenStr &&fourStr != sevenStr &&sixStr != sevenStr &&fiveStr != sevenStr &&fiveStr != sixStr &&threeStr != sixStr &&twoStr != sixStr &&oneStr != sixStr &&fourStr != sixStr &&fourStr != fiveStr &&threeStr != fiveStr &&twoStr != fiveStr &&oneStr != fiveStr &&threeStr != fiveStr &&threeStr != fourStr &&twoStr != fourStr &&oneStr != fourStr &&oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.push(parseInt(fourStr));
            sotrArr.push(parseInt(fiveStr));
            sotrArr.push(parseInt(sixStr));
            sotrArr.push(parseInt(sevenStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
            var threeStr5 = sotrArr[4] >= 10 ? sotrArr[4] : ('0' + sotrArr[4]);
            var threeStr6 = sotrArr[5] >= 10 ? sotrArr[5] : ('0' + sotrArr[5]);
            var threeStr7 = sotrArr[6] >= 10 ? sotrArr[6] : ('0' + sotrArr[6]);
            tempArr.push(oneStr1+"," + twoStr2+"," + threeStr3+","+threeStr4+","+threeStr5+","+threeStr6+","+threeStr7);
            tempArr1.push(oneStr1+" " + twoStr2+" " + threeStr3+" "+threeStr4+" "+threeStr5+" "+threeStr6+" "+threeStr7);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();
    chongfuArr1 = tempArr1.duplicateNew();
    tempArr1 = tempArr1.uniqueArr();

    if (chongfuArr.length > 0) {
        chongfuArr1 = chongfuArr1.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr1.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选单式-7中5";
    showContent = "号码: (" + tempArr1.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join('|');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxbzwds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var tempArr1 = [];
    var chongfuArr1 = [];
    var errorArrs = [];
    var errorStr = '';
    var zhushu = 0;
    var  chongfuArr = [], allStrError = [];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length ==16) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);
        var fourStr = temp.substr(6, 2);
        var fiveStr = temp.substr(8, 2);
        var sixStr = temp.substr(10, 2);
        var sevenStr = temp.substr(12, 2);
        var eitStr = temp.substr(14, 2);
        if(sevenStr != eitStr &&sixStr != eitStr &&fiveStr != eitStr &&fourStr != eitStr &&threeStr != eitStr &&twoStr != eitStr &&oneStr != eitStr &&oneStr != sevenStr &&twoStr != sevenStr &&threeStr != sevenStr &&fourStr != sevenStr &&sixStr != sevenStr &&fiveStr != sevenStr &&fiveStr != sixStr &&threeStr != sixStr &&twoStr != sixStr &&oneStr != sixStr &&fourStr != sixStr &&fourStr != fiveStr &&threeStr != fiveStr &&twoStr != fiveStr &&oneStr != fiveStr &&threeStr != fiveStr &&threeStr != fourStr &&twoStr != fourStr &&oneStr != fourStr &&oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.push(parseInt(fourStr));
            sotrArr.push(parseInt(fiveStr));
            sotrArr.push(parseInt(sixStr));
            sotrArr.push(parseInt(sevenStr));
            sotrArr.push(parseInt(eitStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            var threeStr4 = sotrArr[3] >= 10 ? sotrArr[3] : ('0' + sotrArr[3]);
            var threeStr5 = sotrArr[4] >= 10 ? sotrArr[4] : ('0' + sotrArr[4]);
            var threeStr6 = sotrArr[5] >= 10 ? sotrArr[5] : ('0' + sotrArr[5]);
            var threeStr7 = sotrArr[6] >= 10 ? sotrArr[6] : ('0' + sotrArr[6]);
            var threeStr8 = sotrArr[7] >= 10 ? sotrArr[7] : ('0' + sotrArr[7]);
            tempArr.push(oneStr1+"," + twoStr2+"," + threeStr3+","+threeStr4+","+threeStr5+","+threeStr6+","+threeStr7+","+threeStr8);
            tempArr1.push(oneStr1+" " + twoStr2+" " + threeStr3+" "+threeStr4+" "+threeStr5+" "+threeStr6+" "+threeStr7+" "+threeStr8);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr1 = tempArr1.duplicateNew();
    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();
    tempArr1 = tempArr1.uniqueArr();

    if (chongfuArr.length > 0) {
        chongfuArr1 = chongfuArr1.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr1.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选单式-8中5";
    showContent = "号码: (" + tempArr1.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join('|');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxezeds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var tempArr1 = [];
    var chongfuArr1 = [];
    var errorStr = '';
   var  chongfuArr = [], errorArr = [], allStrError = [];
    var zhushu = 0;

    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length ==4) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if(oneStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            tempArr.push(oneStr1+"," + twoStr2);
            tempArr1.push(oneStr1+" " + twoStr2);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    chongfuArr1 = tempArr1.duplicateNew();
    tempArr1 = tempArr1.uniqueArr();

    if (chongfuArr1.length > 0) {
        chongfuArr1 = chongfuArr1.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr1.join(' '));
    }

    if (errorArr.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArr.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }


    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选单式-2中2";
    showContent = "号码: (" + tempArr1.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join('|');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxyzyds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var errorStr = '';
    var zhushu = 0;

    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
            tempArr.push(oneStr);

    }

    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + "";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选单式-1中1";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前二直选-直选单式
 */
function content_gd11x5_qezxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var chongfuArr = [];
    var allStrError = [];
    var zhushu = 0;

    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if(oneStr != twoStr){
            tempArr.push(oneStr+" " + twoStr);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArr.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArr.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二直选-直选单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}
/**
 * 后二直选-直选单式
 */
function content_gd11x5_hezxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var chongfuArr = [];
    var allStrError = [];
    var zhushu = 0;

    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {

        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if(oneStr != twoStr){
            tempArr.push(oneStr + twoStr);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArr.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArr.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后二直选-直选单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 后三直选-直选单式
 */
function content_gd11x5_hszxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var tempArr = [];
    var errorArrs=[];
    var chongfuArr = [];
    var allStrError = [];
    var zhushu = 0;

    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');

    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);

        if(oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            tempArr.push(oneStr+" " + twoStr+" " + threeStr);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三直选-直选单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 中三直选-直选单式
 */
function content_gd11x5_zszxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorArrs=[];
    var tempArr = [];
    var chongfuArr = [];
    var allStrError = [];
    var zhushu = 0;

    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);

        if(oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            tempArr.push(oneStr+" " + twoStr+" " + threeStr);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "中三直选-直选单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    // 转换投注格式
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二直选-直选单式
 */
function content_q2zxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorStr = '';
    var zhushu = 0;
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 2) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }

    if (newArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + "";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二直选-单式";
    showContent = "号码: (" + newArr + ")";
    // 转换投注格式
    betContent = newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二直选-直选复式
 */
function content_q2zxfs() {
    var wanArr = [], qianArr = [];
    $.each($(".recl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二直选-复式";
    showContent = "万位：({0})，千位：({1})".format(
        wanArr.join(","),
        qianArr.join(",")
    );
    // 转换投注格式
    betContent = gfwf_2xfs(
        wanArr,
        qianArr
    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

//*************************前三***************************
/**
 * 前三组选-特殊号
 */
function content_q3tsh() {
    var thArr = [];
    $.each($(".cl-1015-tsh ul li[data-name = '特殊号'] span.acti_tsh"), function (index, value) {
        thArr.push($.trim($(this).html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三其它-特殊号";
    showContent = "特殊号: (" + thArr.join(",") + ")";
    betContent = thArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前三组选-前三和值尾数
 */
function content_q3hzws() {
    var hzArr = [];
    $.each($(".cl-1014-hzws ul li[data-name = '和值尾数'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三其它-前三和值尾数";
    showContent = "和值尾数: (" + hzArr.join(",") + ")";
    betContent = hzArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前三组选-组选包胆
 */
function content_q3zxbd() {
    var bdArr = [];
    $.each($(".cl-1013-zxbd ul li[data-name = '包胆'] span.acti"), function (index, value) {
        bdArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-组选包胆";
    showContent = "包胆: (" + bdArr.join(",") + ")";
    betContent = bdArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三组选-组选和值
 */
function content_q3zuxhz() {
    var heZhiArr = [];
    $.each($(".cl-1012-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        heZhiArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-组选和值";
    showContent = "和值: (" + heZhiArr.join(",") + ")";
    betContent = heZhiArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三组选-组六混合
 */
function content_q3hhzx() {
    var textStr = $(".cl-1011-hhzx .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            errorArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr || oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        } else {
            errorArr.push(newArr[n]);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-混合组选";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三组选-组六单式
 */
function content_q3z6ds() {
    var textStr = $(".cl-1010-zlds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        } else {
            if (newArr[n] != '') {
                errorArr.push(newArr[n]);
            }
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-组六单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前三组选-单式
 */
function content_gd11x5_qszuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], chongfuArr = [], errorArr = [], allStrError = [],errorArrs=[];
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                 errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);

        if(oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            tempArr.push(oneStr1+" " + twoStr2+" " + threeStr3);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        chongfuArr = chongfuArr.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二组选-单式
 */
function content_gd11x5_qezuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], chongfuArr = [], errorArr = [], allStrError = [];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if(oneStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            tempArr.push(oneStr1+" " + twoStr2);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        chongfuArr = chongfuArr.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArr.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArr.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二组选-组选单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}
/**
 * 后二组选-单式
 */
function content_gd11x5_hezuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], chongfuArr = [], errorArr = [], allStrError = [];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);

        if(oneStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            tempArr.push(oneStr1+" " + twoStr2);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        chongfuArr = chongfuArr.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArr.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArr.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后二组选-组选单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 中三组选-单式
 */
function content_gd11x5_zszuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], chongfuArr = [], errorArr = [], allStrError = [],errorArrs=[];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);

        if(oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            tempArr.push(oneStr1+" " + twoStr2+" " + threeStr3);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        chongfuArr = chongfuArr.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "中三组选-组六单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 后三组选-单式
 */
function content_gd11x5_hszuxds() {
    var textStr = $(".recl-1003 .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], chongfuArr = [], errorArr = [],errorArrs=[], allStrError = [];
    // textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11]/g, ','));
    // var arr_new = textStr.split(",");
    textStr = textStr.replace(/(^\s+)|(\s+$)/g, "");//去掉前后空格
    textStr = $.trim(textStr.replace(/[^01,02,03,04,05,06,07,08,09,10,11,' ']/g, ','));
    textStr = $.trim(textStr.replace(/\s/g,""));
    var arr_new = textStr.split(',');
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 6) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
                errorArr.toString();
                var stnum= getReNum(errorArr);
                errorArrs.push(stnum);
            }
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 2);
        var twoStr = temp.substr(2, 2);
        var threeStr = temp.substr(4, 2);

        if(oneStr != twoStr && oneStr != threeStr && threeStr != twoStr){
            var sotrArr = [];
            sotrArr.push(parseInt(oneStr));
            sotrArr.push(parseInt(twoStr));
            sotrArr.push(parseInt(threeStr));
            sotrArr.sort();

            var oneStr1 = sotrArr[0] >= 10 ? sotrArr[0] : ('0' + sotrArr[0]);
            var twoStr2 = sotrArr[1] >= 10 ? sotrArr[1] : ('0' + sotrArr[1]);
            var threeStr3 = sotrArr[2] >= 10 ? sotrArr[2] : ('0' + sotrArr[2]);
            tempArr.push(oneStr1+" " + twoStr2+" " + threeStr3);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    chongfuArr = tempArr.duplicateNew();
    tempArr = tempArr.uniqueArr();

    if (chongfuArr.length > 0) {
        chongfuArr = chongfuArr.uniqueArr();
        allStrError.push(" 被过滤掉的重复号码 " + chongfuArr.join(' '));
    }

    if (errorArrs.length > 0){
        allStrError.push(" 被过滤掉的错误号码 " + errorArrs.join(' '));
    }

    if (allStrError.length > 0) {
        alert(allStrError.join(""));
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选-组六单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后 三组选复式
 */
function content_gd11x5_hszuxfs() {
    var zuLiuArr = [];

    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选复式";
    showContent = "后三组选复式: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前三组选-复式
 */
function content_suiji_gd11x5_qszuxfs() {
    var zuLiuArr = [];

    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-复式";
    showContent = "前三组选-复式: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前三组选-复式
 */
function content_suiji_gd11x5_rxszs() {
    var zuLiuArr = [];

    $.each($(".recl-1002 ul li[data-name = '选3中3'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选复式-3中3";
    showContent = "任选复式-3中3: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前二组选-复式
 */
function content_suiji_gd11x5_qezuxfs() {
    var zuLiuArr = [];

    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前二组选-复式";
    showContent = "号码: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_hezuxfs() {
    var zuLiuArr = [];

    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后二组选-复式";
    showContent = "号码: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 任2选2
 */
function content_gd11x5_rxeze() {
    var zuLiuArr = [];

    $.each($(".recl-1002 ul li[data-name = '选2中2'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "任选复式-2中2";
    showContent = "任2选2: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后二组选-复式
 */
function gd11x5_hezuxfs() {
    var zuLiuArr = [];

    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后二组选-复式";
    showContent = "号码: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}



/**
 * 中三组选-复式
 */
function content_gd11x5_zszuxfs() {
    var zuLiuArr = [];

    $.each($(".recl-1002 ul li[data-name = '组选'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "中三组选-复式";
    showContent = "中三组选-复式: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三组选-组六复式
 */
function content_q3z6fs() {
    var zuLiuArr = [];

    $.each($(".cl-1009-zlfs ul li[data-name = '组六'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-组六复式";
    showContent = "组六: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三组选-组三单式
 */
function content_q3z3ds() {
    var textStr = $(".cl-1008-zsds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        } else {
            if (newArr[n] != '') {
                errorArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }


    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-组三单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三组选-组三复式
 */
function content_q3z3fs() {
    var zuSanArr = [];
    $.each($(".cl-1007-zsfs ul li[data-name = '组三'] span.acti"), function (index, value) {
        zuSanArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三组选-组三复式";
    showContent = "组三: (" + zuSanArr.join(",") + ")";
    betContent = zuSanArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三直选-前三组合
 */
function content_q3zh() {
    var wanArr = [], qianArr = [], baiArr = [];
    $.each($(".cl-1004-hszh ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1004-hszh ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1004-hszh ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三直选-组合";
    showContent = "万位：({0})，千位：({1})，百位：({2})".format(
        wanArr.join(","),
        qianArr.join(","),
        baiArr.join(",")
    );
    betContent = gfwf_3xfs(
        wanArr,
        qianArr,
        baiArr
    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 后三直选-跨度
 */
function content_q3zxkd() {
    var kaDuArr = [];
    $.each($(".cl-1006-zxkd ul li[data-name = '跨度'] span.acti"), function (index, value) {
        kaDuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三直选-跨度";
    showContent = "跨度: (" + kaDuArr.join(",") + ")";
    betContent = kaDuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三直选-和值
 */
function content_q3zxhz() {
    var heZhiArr = [];
    var zhushu = 0;
    $.each($(".cl-1005-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        heZhiArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三直选-和值";
    showContent = "和值: (" + heZhiArr.join(",") + ")";
    betContent = heZhiArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前三直选-直选单式
 */
function content_q3zxds() {
    var textStr = $(".content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorStr = '';
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }

    if (newArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三直选-单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    betContent = newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三直选复式
 */
function content_q3zxfs() {
    var wanArr = [], qianArr = [], shiArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前三直选-复式";
    showContent = "万位：({0})，千位：({1})，百位：({2})".format(
        wanArr.join(","),
        qianArr.join(","),
        shiArr.join(",")
    );
    betContent = gfwf_3xfs(
        wanArr,
        qianArr,
        shiArr
    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**********************************/
/**后三**/
/**
 * 后三组选-特殊号
 */
function content_h3tsh() {
    var thArr = [];
    $.each($(".cl-1015-tsh ul li[data-name = '特殊号'] span.acti_tsh"), function (index, value) {
        thArr.push($.trim($(this).html()));
    });

    if (thArr.length <= 0) {
        return 0;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三其它-特殊号";
    showContent = "特殊号: (" + thArr.join(",") + ")";
    betContent = thArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 后三组选-后三和值尾数
 */
function content_h3hzws() {
    var hzArr = [];
    $.each($(".cl-1014-hzws ul li[data-name = '和值尾数'] span.acti"), function (index, value) {
        hzArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三其它-后三和值尾数";
    showContent = "和值尾数: (" + hzArr.join(",") + ")";
    betContent = hzArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 后三组选-组选包胆
 */
function content_h3zxbd() {
    var bdArr = [];
    $.each($(".cl-1013-zxbd ul li[data-name = '包胆'] span.acti"), function (index, value) {
        bdArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选-组选包胆";
    showContent = "包胆: (" + bdArr.join(",") + ")";
    betContent = bdArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三组选-组选和值
 */
function content_h3zuxhz() {
    var heZhiArr = [];
    $.each($(".cl-1012-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        heZhiArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选-组选和值";
    showContent = "和值: (" + heZhiArr.join(",") + ")";
    betContent = heZhiArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三组选-组六混合
 */
function content_h3hhzx() {
    var textStr = $(".cl-1011-hhzx .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            errorArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr || oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        } else {
            errorArr.push(newArr[n]);
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选-混合组选";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三组选-组六单式
 */
function content_h3z6ds() {
    var textStr = $(".cl-1010-zlds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (twoStr != threeStr && oneStr != threeStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        } else {
            if (newArr[n] != '') {
                errorArr.push(newArr[n]);
            }
        }
    }

    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选-组六单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(',');

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三组选-组六复式
 */
function content_h3z6fs() {
    var zuLiuArr = [];

    $.each($(".cl-1009-zlfs ul li[data-name = '组六'] span.acti"), function (index, value) {
        zuLiuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选-组六复式";
    showContent = "组六: (" + zuLiuArr.join(",") + ")";
    betContent = zuLiuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三组选-组三单式
 */
function content_h3z3ds() {
    var textStr = $(".cl-1008-zsds .content_jiang .content_tex").val();
    var newArr = [], tempArr = [], errorStr = '', errorArr = [];
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        }
    }
    for (var n = 0; n < newArr.length; n++) {
        var temp = newArr[n].toString();
        var oneStr = temp.substr(0, 1);
        var twoStr = temp.substr(1, 1);
        var threeStr = temp.substr(2, 1);
        if (oneStr == twoStr && twoStr != threeStr || twoStr == threeStr && oneStr != threeStr || threeStr == oneStr && twoStr != oneStr) {
            tempArr.push(newArr[n]);
        } else {
            if (newArr[n] != '') {
                errorArr.push(newArr[n]);
            }
        }
    }
    if (tempArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }


    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选-组三单式";
    showContent = "号码: (" + tempArr.join(',') + ")";
    betContent = tempArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三组选-组三复式
 */
function content_h3z3fs() {
    var zuSanArr = [];
    $.each($(".cl-1007-zsfs ul li[data-name = '组三'] span.acti"), function (index, value) {
        zuSanArr.push($.trim($(this).find("i").html()));
    });


    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三组选-组三复式";
    showContent = "组三: (" + zuSanArr.join(",") + ")";
    betContent = zuSanArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三直选-后三组合
 */
function content_h3zh() {
    var baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1004-hszh ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1004-hszh ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1004-hszh ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三直选-组合";
    showContent = "百位：({0})，十位：({1})，个位：({2})".format(
        baiArr.join(","),
        shiArr.join(","),
        geArr.join(",")
    );
    betContent = gfwf_3xfs(
        baiArr,
        shiArr,
        geArr
    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent,
    };

}


/**
 * 后三直选-跨度
 */
function content_h3zxkd() {
    var kaDuArr = [];
    $.each($(".cl-1006-zxkd ul li[data-name = '跨度'] span.acti"), function (index, value) {
        kaDuArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三直选-跨度";
    showContent = "跨度: (" + kaDuArr.join(",") + ")";
    betContent = kaDuArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三直选-和值
 */
function content_h3zxhz() {
    var heZhiArr = [];
    var zhushu = 0;
    $.each($(".cl-1005-zxhz ul li[data-name = '和值'] span.acti"), function (index, value) {
        heZhiArr.push($.trim($(this).find("i").html()));
    });

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三直选-和值";
    showContent = "和值: (" + heZhiArr.join(",") + ")";
    betContent = heZhiArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 后三直选-直选单式
 */
function content_h3zxds() {
    var textStr = $(".content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorStr = '';
    var zhushu = 0;
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 3) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }

    if (newArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三直选-单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    betContent = newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三直选复式
 */
function content_h3zxfs() {
    var baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    if (baiArr.length <= 0 || shiArr.length <= 0 || geArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "后三直选-复式";
    showContent = "百位：({0})，十位：({1})，个位：({2})".format(
        baiArr.join(","),
        shiArr.join(","),
        geArr.join(",")
    );
    betContent = gfwf_3xfs(
        baiArr,
        shiArr,
        geArr
    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 5星直选复式
 */
function content_5xzxfs() {
    var wanArr = [], qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        wanArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    if (wanArr.length <= 0 || qianArr.length <= 0 || baiArr.length <= 0 || shiArr.length <= 0 || geArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "五星直选-复式";
    showContent = "万位：({0})，千位：({1})，百位：({2})，十位：({3})，个位：({4})".format(
        wanArr.join(","),
        qianArr.join(","),
        baiArr.join(","),
        shiArr.join(","),
        geArr.join(",")
    );
    betContent = gfwf_5xfs(
        wanArr,
        qianArr,
        baiArr,
        shiArr,
        geArr
    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 4星直选复式
 */
function content_4xzxfs() {
    var qianArr = [], baiArr = [], shiArr = [], geArr = [];
    $.each($(".cl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        qianArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '百'] span.acti"), function (index, value) {
        baiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '十'] span.acti"), function (index, value) {
        shiArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".cl-1002 ul li[data-name = '个'] span.acti"), function (index, value) {
        geArr.push($.trim($(this).find("i").html()));
    });

    if (qianArr.length <= 0 || baiArr.length <= 0 || shiArr.length <= 0 || geArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "四星直选-复式";
    showContent = "千位：({0})，百位：({1})，十位：({2})，个位：({3})".format(
        qianArr.join(","),
        baiArr.join(","),
        shiArr.join(","),
        geArr.join(",")
    );
    betContent = gfwf_4xfs(
        qianArr,
        baiArr,
        shiArr,
        geArr
    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_qy() {
    var qyArr = [];
    $.each($(".cl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        qyArr.push($.trim($(this).find("i").html()));
    });


    if (qyArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前一直选复式";
    showContent = "冠军：({0})".format(
        qyArr.join(",")
    );
    betContent = gfwf_qyfs(
        qyArr

    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_jspk10_qy() {
    var qyArr = [];
    $.each($(".cl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        qyArr.push($.trim($(this).find("i").html()));
    });


    if (qyArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "前一直选复式";
    showContent = "冠军：({0})".format(
        qyArr.join(",")
    );
    betContent = gfwf_qyfs(
        qyArr

    );

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 5星直选单式
 */
function content_5xzxds() {
    var textStr = $(".content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorStr = '';
    var zhushu = 0;
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 5) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }
    if (newArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "五星直选-单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    betContent = newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 4星直选单式
 */
function content_4xzxds() {
    var textStr = $(".content_jiang .content_tex").val();
    var newArr = [];
    var errorArr = [];
    var errorStr = '';
    var zhushu = 0;
    textStr = $.trim(textStr.replace(/[^0-9]/g, ','));
    var arr_new = textStr.split(",");
    for (var i = 0; i < arr_new.length; i++) {
        if (arr_new[i].toString().length > 0 && arr_new[i].toString().length == 4) {
            newArr.push(arr_new[i]);
        } else {
            if (arr_new[i] != '') {
                errorArr.push(arr_new[i]);
            }
        }
    }

    if (newArr.length <= 0) {
        return 0;
    }

    if (errorArr.length > 0) {
        for (var e = 0; e < errorArr.length; e++) {
            errorStr += errorArr[e] + ",";
        }
        alert("被过滤掉的错误号码" + errorStr);
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    showPlayName = "四星直选-单式";
    showContent = "号码: (" + newArr.join(",") + ")";
    betContent = newArr.join(",");

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前2大小单双
 */
function content_q2dxds() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '万'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '千'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m]);
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(",")
    ];

    showPlayName = "前二大小单双";
    showContent = "万位: ({0}), 千位: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前2直选复式-PK10
 */
function content_qezxfs() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '亚军'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m]);
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(",")
    ];

    showPlayName = "前二直选-单式";
    showContent = "冠军: ({0}), 亚军: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前3直选复式
 */
function content_gd11x5_qszxfs() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '第一位'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第二位'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第三位'] span.acti"), function (index, value) {
        dxdsBArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            for (var j = 0; j < dxdsBArr.length; j++) {
                tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m] + "" + dxdsBArr[j]);
            }
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0 || dxdsBArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "前三直选复式";
    showContent = "第一位: ({0}), 第二位: ({1}), 第三位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


function content_gd11x5_qezuxdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "前二组选胆拖-2前2";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


function content_gd11x5_hezuxdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "后二组选胆拖-2后2";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxezwdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "任选胆拖-2中2";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


function content_gd11x5_qszuxdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "前三组选胆拖";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


function content_suiji_gd11x5_rxszsdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "前三组选胆拖";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


function content_gd11x5_zszuxdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "中三组选胆拖";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


function content_gd11x5_hszuxdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "后三组选胆拖";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxsizsdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "任选胆拖-4中4";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}
function content_gd11x5_rxwzwdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "任选胆拖-5中5";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxlzwdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "任选胆拖-6中5";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}
function content_gd11x5_rxqzwdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "任选胆拖-7中5";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

function content_gd11x5_rxbzwdt() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '胆码'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '拖码'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "任选胆拖-8中5";
    showContent = "胆码: ({0}), 拖码: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}
/**
 * 后二直选复式
 */
function content_gd11x5_hezxfs() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '第四位'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第五位'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });


    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m] );
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "后二直选复式";
    showContent = "第四位: ({0}), 第五位: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前二直选复式
 */
function content_gd11x5_qezxfs() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '第一位'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第二位'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });


    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
                tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m] );
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "前二直选复式";
    showContent = "第一位: ({0}), 第二位: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 前三位
 */
function content_gd11x5_qsw() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '前三位'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
            tempArr.push(dxdsWArr[n]);

    }

    if (dxdsWArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "不定位-前3";
    showContent = "前三位: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 选一中一
 */
function content_gd11x5_rxyzy() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '选1中1'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        tempArr.push(dxdsWArr[n]);

    }

    if (dxdsWArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "任选复式-1中1";
    showContent = "选1中1: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 中三位
 */
function content_gd11x5_zsw() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '中三位'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        tempArr.push(dxdsWArr[n]);

    }

    if (dxdsWArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "不定位-中3";
    showContent = "中三位: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}


/**
 * 后三位
 */
function content_suiji_gd11x5_hsw() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '后三位'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        tempArr.push(dxdsWArr[n]);

    }

    if (dxdsWArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
    ];

    showPlayName = "不定位-后3";
    showContent = "后三位: ({0})".format(arr[0]);
    betContent = "{0}".format(arr[0]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前3直选复式
 */
function content_gd11x5_hszxfs() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '第三位'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第四位'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第五位'] span.acti"), function (index, value) {
        dxdsBArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            for (var j = 0; j < dxdsBArr.length; j++) {
                tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m] + "" + dxdsBArr[j]);
            }
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0 || dxdsBArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "后三直选复式";
    showContent = "第三位: ({0}), 第四位: ({1}), 第五位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}



/**
 * 中3直选复式
 */
function content_gd11x5_zszxfs() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '第二位'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第三位'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '第四位'] span.acti"), function (index, value) {
        dxdsBArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            for (var j = 0; j < dxdsBArr.length; j++) {
                tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m] + "" + dxdsBArr[j]);
            }
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0 || dxdsBArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "中三直选复式";
    showContent = "第二位: ({0}), 第三位: ({1}), 第四位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前3直选复式-PK10
 */
function content_qszxfs() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];

    $.each($(".recl-1002 ul li[data-name = '冠军'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '亚军'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });

    $.each($(".recl-1002 ul li[data-name = '季军'] span.acti"), function (index, value) {
        dxdsBArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            for (var j = 0; j < dxdsBArr.length; j++) {
                tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m] + "" + dxdsBArr[j]);
            }
        }
    }

    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0 || dxdsBArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "前三直选-直选单式";
    showContent = "冠军: ({0}), 亚军: ({1}), 季军: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后2大小单双
 */
function content_h2dxds() {
    var zhushu = 0;
    var dxdsSArr = [], dxdsGArr = [], tempArr = [];
    $.each($(".recl-1003-h2dxds ul li[data-name = '十'] span.acti"), function (index, value) {
        dxdsSArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1003-h2dxds ul li[data-name = '个'] span.acti"), function (index, value) {
        dxdsGArr.push($.trim($(this).find("i").html()));
    });

    for (var n = 0; n < dxdsSArr.length; n++) {
        for (var m = 0; m < dxdsGArr.length; m++) {
            tempArr.push(dxdsSArr[n] + "" + dxdsGArr[m]);
        }
    }
    if (dxdsSArr.length <= 0 || dxdsGArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsSArr.join(","),
        dxdsGArr.join(",")
    ];

    showPlayName = "后二大小单双";
    showContent = "十位: ({0}), 个位: ({1})".format(arr[0], arr[1]);
    betContent = "{0}|{1}".format(arr[0], arr[1]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 前三大小单双
 */
function content_q3dxds() {
    var zhushu = 0;
    var dxdsWArr = [], dxdsQArr = [], dxdsBArr = [], tempArr = [];
    $.each($(".recl-1004-q3dxds ul li[data-name = '万'] span.acti"), function (index, value) {
        dxdsWArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1004-q3dxds ul li[data-name = '千'] span.acti"), function (index, value) {
        dxdsQArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1004-q3dxds ul li[data-name = '百'] span.acti"), function (index, value) {
        dxdsBArr.push($.trim($(this).find("i").html()));
    });


    for (var n = 0; n < dxdsWArr.length; n++) {
        for (var m = 0; m < dxdsQArr.length; m++) {
            for (var h = 0; h < dxdsQArr.length; h++) {
                tempArr.push(dxdsWArr[n] + "" + dxdsQArr[m] + "" + dxdsBArr[h]);
            }
        }
    }
    if (dxdsWArr.length <= 0 || dxdsQArr.length <= 0 || dxdsBArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsWArr.join(","),
        dxdsQArr.join(","),
        dxdsBArr.join(",")
    ];

    showPlayName = "前三大小单双";
    showContent = "万位: ({0}), 千位: ({1}), 百位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 后三大小单双
 */
function content_h3dxds() {
    var zhushu = 0;
    var dxdsBArr = [], dxdsSArr = [], dxdsGArr = [], tempArr = [];
    $.each($(".recl-1005-h3dxds ul li[data-name = '百'] span.acti"), function (index, value) {
        dxdsBArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1005-h3dxds ul li[data-name = '十'] span.acti"), function (index, value) {
        dxdsSArr.push($.trim($(this).find("i").html()));
    });
    $.each($(".recl-1005-h3dxds ul li[data-name = '个'] span.acti"), function (index, value) {
        dxdsGArr.push($.trim($(this).find("i").html()));
    });

    for (var i = 0; i < dxdsBArr.length; i++) {
        for (var n = 0; n < dxdsSArr.length; n++) {
            for (var m = 0; m < dxdsGArr.length; m++) {
                tempArr.push(dxdsBArr[i] + "" + dxdsSArr[n] + "" + dxdsGArr[m]);
            }
        }
    }
    if (dxdsBArr.length <= 0 || dxdsSArr.length <= 0 || dxdsGArr.length <= 0) {
        return;
    }

    // 初始化变量
    var showPlayName = '';
    var showContent = '';
    var betContent = '';

    var arr = [
        dxdsBArr.join(","),
        dxdsSArr.join(","),
        dxdsGArr.join(",")
    ];

    showPlayName = "后三大小单双";
    showContent = "百位: ({0}), 十位: ({1}), 个位: ({2})".format(arr[0], arr[1], arr[2]);
    betContent = "{0}|{1}|{2}".format(arr[0], arr[1], arr[2]);

    return {
        showPlayName: showPlayName,
        showContent: showContent,
        betContent: betContent
    };
}

/**
 * 时时彩-五星复选
 * @param wanArr 万数组
 * @param qianArr 千数组
 * @param baiArr 百数组
 * @param shiArr 十数组
 * @param geArr 个数组
 */
function gfwf_5xfs(wanArr,
                   qianArr,
                   baiArr,
                   shiArr,
                   geArr) {
    var tmpStr_1 = wanArr.join(",");
    var tmpStr_2 = qianArr.join(",");
    var tmpStr_3 = baiArr.join(",");
    var tmpStr_4 = shiArr.join(",");
    var tmpStr_5 = geArr.join(",");

    return "{0}|{1}|{2}|{3}|{4}".format(
        tmpStr_1,
        tmpStr_2,
        tmpStr_3,
        tmpStr_4,
        tmpStr_5
    );
}

function gfwf_4xfs(qianArr,
                   baiArr,
                   shiArr,
                   geArr) {
    var tmpStr_1 = qianArr.join(",");
    var tmpStr_2 = baiArr.join(",");
    var tmpStr_3 = shiArr.join(",");
    var tmpStr_4 = geArr.join(",");

    return "{0}|{1}|{2}|{3}".format(
        tmpStr_1,
        tmpStr_2,
        tmpStr_3,
        tmpStr_4
    );
}

function gfwf_qyfs(qyArr
                   ) {
    var tmpStr_1 = qyArr.join(",");


    return "{0}".format(
        tmpStr_1

    );
}

function gfwf_3xfs(baiArr,
                   shiArr,
                   geArr) {
    var tmpStr_1 = baiArr.join(",");
    var tmpStr_2 = shiArr.join(",");
    var tmpStr_3 = geArr.join(",");

    return "{0}|{1}|{2}".format(
        tmpStr_1,
        tmpStr_2,
        tmpStr_3
    );
}

function gfwf_2xfs(shiArr,
                   geArr) {
    var tmpStr_1 = shiArr.join(",");
    var tmpStr_2 = geArr.join(",");
    return "{0}|{1}".format(
        tmpStr_1,
        tmpStr_2
    );
}

function getMode(mode) {
    if (mode == 1) {    // 元
        return 1;
    } else if (mode == 2) { // 角
        return 0.1;
    } else if (mode == 3) { // 分
        return 0.01;
    } else if (mode == 4) { // 厘
        return 0.001;
    }
    return;
}

// 获取选中的模式
function getSelectMode() {
    var mode = $("#inputMoneyStr").val();
    if (mode == '元') {
        return 1;
    } else if (mode == '角') {
        return 2;
    } else if (mode == '分') {
        return 3;
    }
    return;
}

$(function () {
    //隐藏追号模板
    $("#zhInfo").hide();

    $("#zhInfo .tabs ul li").click(function () {
        $("#zhInfo .tabs ul li.acti").removeClass("acti");
        $(this).addClass("acti");
        $("#zhInfo .list_wrap_zh").hide();
        var objLi = $("#zhInfo .list_wrap_zh").eq($(this).index());
        $(objLi).show();

        var operType = $(this).data("opertype");
        if (operType == 'tbzh') {
            var objtbzh = $("#zhbtn");
            renderZhuihao('tbzh', objtbzh);
        } else if (operType == 'fbzh') {
            var objfbzh = $("#zhbtn");
            renderZhuihao('fbzh', objfbzh);
        }
    });
});

function getZhuihaoList(callback) {
    if (typeof zhuihaoSscOpenTimeList == 'undefined') {
        return;
    }

   /* if (zhuihaoSscOpenTimeList != null && zhuihaoSscOpenTimeList[0].number == getNumber()) {
        if (typeof callback == 'function') {
            callback();
        }
        return;
    }*/

    ajaxRequest({
        url: CONFIG.BASEURL + "ssc/ajaxGetLatestOpenTimeList.json",
        data: {
            playGroupId: playGroupId   // 全局变量
        },
        beforeSend: function(){
            // $(container).html('<li style="width:100%;padding:15px;text-align:center;"><img src="' + CONFIG.RESURL + 'img/base_loading.gif"/>');
        },success: function(json) {
            if (json.result != 1) {
                return;
            }

            zhuihaoSscOpenTimeList = json.sscOpenTimeList;

            if (typeof callback == 'function') {
                callback();
            }
        }
    });
}

//注单列表
function removeThisItem(obj) {
    $(obj).parent().parent().trigger("mouseout");
    $(obj).parent().parent().remove();
    calcAll();
    bindYuxuan();
    if ($("#zhudanList .re_touzhu_tem").length <= 0) {
        $("#zhudanList").html('<tr class="noRecord"><td>暂无投注项</td></tr>');
        //清除追号模板
        var flag = $(".clearLiZhudanbtn").attr('sp');
        if(flag == 1){
            zhTempletHideOrShow();
        }
    } else{
        $("#zhInfo .tabs ul li:first-child").trigger('click');
    }
}

// 最近最新开奖时间（默认10期），用于追号模板渲染
function renderZhuihao(strZh, obj) {
    var totelMoney = 0;
    var tempMoney = 0;
    var len = $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").length;
    if (len <= 0) {
        showTishi2Template();
        $(".del-TishiType2 .des-txt").empty();
        $(".del-TishiType2 .des-txt").html("请先添加投注内容");
        return;
    }

    //点击追加按钮执行
    if (strZh == null) {
        zhTempletHideOrShow(); //追号模板显示与隐藏
    }

    $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").each(function () {
        var perMoney = $(this).data('bet_per_money');   //每注金额
        var zhushu = $(this).data('bet_zhushu');  //注数
        var mode = $(this).data('bet_mode');  //模式
        var modeVal = getMode(mode);
        tempMoney = perMoney * zhushu * modeVal;
        totelMoney += tempMoney;
    });

    getZhuihaoList(function() {
        // 模板逻辑处理.......
        var dataContent = {
            listContent: []
        };

        $.each(zhuihaoSscOpenTimeList, function(index, value) {
            dataContent.listContent.push({
                zhqishu: value.number,
                zhbeishu: $("#startBeiShu.Zh").val(),
                totelMoney: '￥' + totelMoney.toFixed(2),
                zhkjshijian: Tools.formatDate(value.openTime)
            });
        });

        var strZh = $("#zhInfo .hy-info.acti").data("opertype");
        if (typeof strZh == 'undefined' || strZh == 'tbzh') {
            var container = $(".tbzh");
            var html = template('tbzhTemplate', dataContent);
            $(container).html(html);
            $("#lt_zh_qishu").val(10);  //默认选中第10期选项
            selectedCheckboxtbzh(10);
        } else {
            var containerfbzh = $(".fbzh");
            var htmlfbzh = template('fbzhTemplate', dataContent);
            $(containerfbzh).html(htmlfbzh);
            $("#rt_zh_qishu").val(10);  //默认选中第10期选项
            selectedCheckboxfbzh(10);
        }

        //总金额
        var num = selectedZhqishu();
        $('.zhzjetxt').html((totelMoney * num).toFixed(2));
        $('.zhfbzjetxt').html(getFbTotelMoney());

        //单行点击选中事件
        $(".content_heigth .ulzh li input[type='checkbox']").click(function () {
            var selectedbox = $(this).prop('checked');
            var beishu = $("#startBeiShuZh").val();

            if (!selectedbox) {
                $(this).parent().removeClass('checkbox_selected');
                $(this).parent().find('input[type="text"]').attr("disabled", "disabled");
                $(this).parent().find('input[type="text"]').val('0');
            } else {
                $(this).parent().addClass('checkbox_selected');
                $(this).parent().find('input[type="text"]').removeAttr("disabled");
                $(this).parent().find('input[type="text"]').val(beishu);
            }

            selectedZhqishu(); //改变及获取当前选中期数

            changeContent();
            changeContentFbzh();

            $('.zhzjetxt').html(getFbTotelMoney());
            $('.zhfbzjetxt').html(getFbTotelMoney());
        });

        //输入倍数时改变选中倍数input值
        $("#startBeiShuZh").keyup(function () {
            changeContent();
            $('.zhzjetxt').html(getFbTotelMoney());
        });

        //输入倍数失去焦点计算
        $("#startBeiShuZh").blur(function () {
            var valStr = $("#startBeiShuZh").val();
            if (typeof valStr == "undefined" || valStr == "" || valStr == null) {
                $("#startBeiShuZh").val(1);
            }
            changeContent();
            $('.zhzjetxt').html(getFbTotelMoney());
        });

        //列表中的倍数输入框动态改变单行值
        $(".ulzh li").each(function () {
            $(this).find('input[type="text"]').keyup(function () {
                var totelMoney = getZhuJinE();
                var beishu = $(this).val();

                $(this).parent().parent().find('.content_money').html('￥'+ (beishu * totelMoney).toFixed(2));
                $('.zhzjetxt').html(getFbTotelMoney());
            });

            $(this).find('input[type="text"]').blur(function () {
                var valStr = $(this).val();
                if (typeof valStr == "undefined" || valStr == "" || valStr == null) {
                    $(this).val(1);
                }
                var totelMoney = getZhuJinE();
                var beishu = $(this).val();
                $(this).parent().parent().find('.content_money').html('￥'+ (beishu * totelMoney).toFixed(2));
                $('.zhzjetxt').html(getFbTotelMoney());
            });
        });


        $("#rt_trace_diff").keyup(function () {
            changeContentFbzh();
            $('.zhfbzjetxt').html(getFbTotelMoney());
        });

        $("#rt_trace_diff").blur(function () {
            var valStr = $("#rt_trace_diff").val();
            if (typeof valStr == "undefined" || valStr == "" || valStr == null) {
                $("#rt_trace_diff").val(1);
            }
            changeContentFbzh();
            $('.zhfbzjetxt').html(getFbTotelMoney());
        });

        $("#rt_trace_times_diff").keyup(function () {
            changeContentFbzh();
            $('.zhfbzjetxt').html(getFbTotelMoney());
        });

        $("#rt_trace_times_diff").blur(function () {
            var valStr = $("#rt_trace_times_diff").val();
            if (typeof valStr == "undefined" || valStr == "" || valStr == null) {
                $("#rt_trace_times_diff").val(1);
            }
            changeContentFbzh();
            $('.zhfbzjetxt').html(getFbTotelMoney());
        });

    });
}

$(function () {
    //选择选项-同倍追号
    $(document).on("change", 'select#lt_zh_qishu', function () {
        var optionVal = parseInt($(this).val());

        $(".zhqishutxt").html(optionVal);
        $(".qs").val(optionVal);
        selectedCheckboxtbzh(optionVal);
        $('.zhzjetxt').html(getTbTotelMoney());

    });

    //选择选项-翻倍追号
    $(document).on("change", 'select#rt_zh_qishu', function () {
        var optionVal = parseInt($(this).val());

        $(".zhfbqishutxt").html(optionVal);
        $(".qs").val(optionVal);
        selectedCheckboxfbzh(optionVal); //改变前选中选行数
        $('.zhfbzjetxt').html(getFbTotelMoney());

    });
});

//获取当前选中的期数
function getFbTotelQishu() {
    var zhTotelZQshu = 0;
    $("#fbLiList li").each(function () {
        var flagStatus = $(this).find('input').prop('checked');
        if (flagStatus) {
            zhTotelZQshu++;
        }
    });
    return zhTotelZQshu;
}

//获取当前倍同倍与翻倍标签
function getTbFbFlag(){
    var strTFb = '';
    $('#zhInfo .tabs li').each(function(){
        var f = $(this).hasClass('acti');
        if(f){
            strTFb = $(this).attr('data-opertype');
        }
    });
    return strTFb;
}

//获取注追号的基本金额
function getZhuJinE(){
    var tempMoney= 0;
    var totelMoney= 0;
    $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").each(function () {
        var perMoney = $(this).data('bet_per_money');   //每注金额
        var zhushu = $(this).data('bet_zhushu');  //注数
        var mode = $(this).data('bet_mode');  //模式
        var modeVal = getMode(mode);
        tempMoney = perMoney * zhushu * modeVal;
        totelMoney += tempMoney;
    });

    return totelMoney;
}

//计算购买追号翻倍总金额
function getFbTotelMoney(){
    var zhTotelMoney = 0;
    $(".fbulzh li span.content_money").each(function () {
        var flagStatus = $(this).parent().find('input').prop('checked');
        if(flagStatus){
            var strMoney = ($(this).html()).toString();
            zhTotelMoney += parseFloat(strMoney.substr(1,strMoney.length));
        }
    });

    return zhTotelMoney.toFixed(2);
}

//计算购买追号同倍总金额
function getTbTotelMoney(){
    var totelMoney = 0;
    var tempMoney = 0;
    $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").each(function () {
        var perMoney = $(this).data('bet_per_money');   //每注金额
        var zhushu = $(this).data('bet_zhushu');  //注数
        var mode = $(this).data('bet_mode');  //模式
        var modeVal = getMode(mode);
        tempMoney = perMoney * zhushu * modeVal;
        totelMoney += tempMoney;
    });

    var num = selectedZhqishu();
    return (totelMoney * num).toFixed(2);
}

// 清除和显示追号模板
function zhTempletHideOrShow() {
    var obj = $('.clearLiZhudanbtn').children();
    var spStauts = $(obj).parent().attr("sp");

    //是追加按钮点击执行
    $("#zhInfo").show();
    $("#zhInfo .list_wrap_zh").hide();
    var f_Or_t = $(obj).find(".imgZh").hasClass('imgZhCancle');

    if (spStauts == 1) {
        if (f_Or_t == true) {
            $(obj).children().removeClass('imgZhCancle');
        }
        $(obj).parent().attr("sp", "0");
        $("#zhInfo").hide();
    } else if (spStauts == 0) {
        if (f_Or_t == false) {
            $(obj).children().addClass('imgZhCancle');
        }
        $(obj).parent().attr("sp", "1");
        $("#zhInfo .tabs ul li:first-child").trigger('click');
        $("#zhInfo .list_wrap_zh").eq(0).show();
    }

}

//选中checkbox
function selectedCheckboxtbzh(countLi) {
    $("#tbLiList li").each(function(i, v) {
        if (i < countLi) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    $(".tbulzh li").each(function () {
        var flagStatus = $(this).find('input').prop('checked');
        if (flagStatus) {
            $(this).find("input[type='checkbox']").removeAttr("checked");
        }
    });
    for (var i = 0; i < countLi; i++) {
        $(".content_heigth .tbulzh li:eq(" + i + ") input").prop("checked", true);
    }

    changeBgColor();
    changeContent();
}

function selectedCheckboxfbzh(countLi) {
    $("#fbLiList li").each(function(i, v) {
        if (i < countLi) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    $(".reConHei .fbulzh li").each(function () {
        var flagStatus = $(this).find('input').prop('checked');
        if (flagStatus) {
            $(this).find("input[type='checkbox']").removeAttr("checked");
        }
    });

    for (var i = 0; i < countLi; i++) {
        $(".reConHei .fbulzh li:eq(" + i + ") input").prop("checked", true);
    }

    changeBgColor();
    changeContentFbzh();
}

//选中的追号期数
function selectedZhqishu() {
    var zongQiShu = 0;
    var f = getTbFbFlag();
    changeBgColor();
    if(f == 'tbzh'){
        $(".ulzh li").each(function () {
            var flagStatus = $(this).find('input').prop('checked');
            if (flagStatus) {
                zongQiShu++;
            }
        });

        $(".zhqishutxt").html(zongQiShu);
        $(".qs").val(zongQiShu);
    } else if(f == 'fbzh'){
        $(".fbulzh li").each(function () {
            var flagStatus = $(this).find('input').prop('checked');
            if (flagStatus) {
                zongQiShu++;
            }
        });
        $(".zhfbqishutxt").html(zongQiShu);
        $(".qs").val(zongQiShu);
    }
    return zongQiShu;
}

//改变选中checkbox 行的背景颜色
function changeBgColor() {
    $(".ulzh li").each(function () {
        var flagStatus = $(this).find('input').prop('checked');
        if (flagStatus == true) {
            $(this).addClass('checkbox_selected');
        } else {
            var hasSelect = $(this).hasClass('checkbox_selected');
            if (hasSelect) {
                $(this).removeClass('checkbox_selected');
            }
        }

        // 更换input背景
        if (!flagStatus) {
            $(this).find('input[type="text"]').attr("disabled", "disabled");
        } else {
            $(this).find('input[type="text"]').removeAttr("disabled");
        }
    });
}

//改变被选中checkbox行的内容--同倍追号
function changeContent() {
    var totelMoney = 0;
    var tempMoney = 0;

    $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").each(function () {
        var perMoney = $(this).data('bet_per_money');   //每注金额
        var zhushu = $(this).data('bet_zhushu');  //注数
        var mode = $(this).data('bet_mode');  //模式
        var modeVal = getMode(mode);
        tempMoney = perMoney * zhushu * modeVal;
        totelMoney += tempMoney;
    });

    $(".tbulzh li").each(function () {
        var flagStatus = $(this).find('input').prop('checked');
        if (!flagStatus) {
            $(this).find('input[type="text"]').val('0');
            $(this).find('.content_money').html('￥0.0');
        } else {
            var beishu = $("#startBeiShuZh").val();
            beishu = beishu == '' ? 1 : beishu;
            $(this).find('input[type="text"]').val(beishu);
            $(this).find('.content_money').html('￥' + (beishu * totelMoney).toFixed(2));
        }
    });
}

//改变被选中checkbox行的内容--同倍追号--翻倍追号
function changeContentFbzh() {
    var totelMoney = 0;
    var bsTemp = 1;
    var num = 0;
    var tempMoney = 0;
    $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").each(function () {
        var perMoney = $(this).data('bet_per_money');   //每注金额
        var zhushu = $(this).data('bet_zhushu');  //注数
        var mode = $(this).data('bet_mode');  //模式
        var modeVal = getMode(mode);
        tempMoney = perMoney * zhushu * modeVal;
        totelMoney += tempMoney;
    });

    $(".reConHei .fbulzh li").each(function (index, value) {
        var flagStatus = $(this).find('input').prop('checked');
        if (!flagStatus) {
            $(this).find('input[type="text"]').val('0');
            $(this).find('.content_money').html('￥0.0');
        } else {
            var geqi = $("#rt_trace_diff").val();  //隔期数
            var beishu = $("#rt_trace_times_diff").val();  //倍数

            beishu = beishu == '' ? 1 : beishu;
            geqi = geqi == '' ? 1 : geqi;

            if (geqi == num) {
                bsTemp *= beishu;
                num = 0;
            }

            num++; //间隔计算临时数量
            $(this).find('input[type="text"]').val(bsTemp);
            $(this).find('.content_money').html('￥' + (bsTemp * totelMoney).toFixed(2));

        }
    });
}


// 获取当前选中位数
function getWeiStr(arr) {
    var checkArr = [], checkStrArr = [];
    checkArr = arr;
    for (var i = 0; i < checkArr.length; i++) {
        if (checkArr[i] == 1) {
            checkStrArr.push("万位");
        } else if (checkArr[i] == 2) {
            checkStrArr.push("千位");
        } else if (checkArr[i] == 3) {
            checkStrArr.push("百位");
        } else if (checkArr[i] == 4) {
            checkStrArr.push("十位");
        } else if (checkArr[i] == 5) {
            checkStrArr.push("个位");
        }
    }
    return checkStrArr;
}

function getNoWeiStr(arr) {
    var checkArr = [], checkStrArr = [];
    checkArr = arr;
    for (var i = 0; i < checkArr.length; i++) {
        if (checkArr[i] == 1) {
            checkStrArr.push("万");
        } else if (checkArr[i] == 2) {
            checkStrArr.push("千");
        } else if (checkArr[i] == 3) {
            checkStrArr.push("百");
        } else if (checkArr[i] == 4) {
            checkStrArr.push("十");
        } else if (checkArr[i] == 5) {
            checkStrArr.push("个");
        }
    }
    return checkStrArr;
}


// 字符串格式化函数
String.prototype.format = function (args) {
    var result = this;
    if (arguments.length > 0) {
        if (arguments.length == 1 && typeof (args) == "object") {
            for (var key in args) {
                if (args[key] != undefined) {
                    var reg = new RegExp("({" + key + "})", "g");
                    result = result.replace(reg, args[key]);
                }
            }
        }
        else {
            for (var i = 0; i < arguments.length; i++) {
                if (arguments[i] != undefined) {
                    var reg = new RegExp("({[" + i + "]})", "g");
                    result = result.replace(reg, arguments[i]);
                }
            }
        }
    }
    return result;
}

//清除注单内容按钮
function clearZhudan() {
    var len = $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").length;
    if (len > 0) {
        showTishi1Template();
        $("#block_close").click(function () {
            closeLayer();
        });
        $(".del-Tishi").parent().parent().css({"border": "6px solid #ccc", "border-radius": "8px", "top": "150px"});
    } else {
        showTishi2Template();
        $("#block_close").click(function () {
            closeLayer2();
        });
        $(".del-TishiType2").parent().parent().css({
            "border": "6px solid #ccc",
            "border-radius": "8px",
            "top": "150px"
        });
    }

}

//清除投注内容确认按钮
function enterType1() {
    var len = $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").length;
    if (len > 0) {
        closeLayer();
        clearContent();
    } else {
        closeLayer();
    }

    //清除追号模板
    var flag = $(".clearLiZhudanbtn").attr('sp');
    if (flag == 1) {
        zhTempletHideOrShow();
    }

}

//清除注单提示取消按钮
function cancelType1() {
    closeLayer();
}

//清除
function enterType2() {
    closeLayer2();
}

//清除注单内容
function clearContent() {
    $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").remove();
    calcAll();
    if ($("#zhudanList .re_touzhu_tem").length <= 0) {
        $("#zhudanList").html('<tr class="noRecord"><td>暂无投注项</td></tr>');
    }
}

//清除手动输入区域
function clearTextarea() {
    $(".content_jiang textarea").val('');
    clearStateTouZhu();
}

//清除手动选中内容
function clearSelected() {
    $(".Single .layout .Pick ul li span.acti").removeClass("acti");
    $(".re-5x-i i.acti").removeClass("acti");
    $(".Pick ul li span.acti_tsh").removeClass("acti_tsh");
    $("#zhushuInfo").data("zhushu", 0);
    if (typeof clearStateTouZhu == 'function') {
        clearStateTouZhu();
    }

    initArrNum();
}

function closeLayer() {
    if (layerTishi1 != null) {
        layer.close(layerTishi1);
        layerTishi1 = null;
    }
}

function closeLayer2() {
    if (layerTishi2 != null) {
        layer.close(layerTishi2);
        layerTishi2 = null;
    }
}

function closeLayerInsert() {
    if (layerInfoInsert != null) {
        layer.close(layerInfoInsert);
        layerInfoInsert = null;
    }
}

// 当前注数内容状态
function calcAll() {
    var totalZhushu = 0;
    var totalBeishu = 0;
    var totalMoney = 0;
    var valStr = $("#inputBeishu").val();
    var str = '';

    $(".Detailedlist .layout .boxt .left table tbody tr.re_touzhu_tem").each(function () {
        totalZhushu = add(totalZhushu, $(this).data("bet_zhushu"));
        totalBeishu = add(totalBeishu, $(this).data("bet_beishu"));
        totalMoney = add(totalMoney, $(this).data("bet_total_money"));
    });

    str = '总投 <span>' + totalZhushu + '</span> 注，<span>' + totalBeishu + '</span> 倍，共 <span class="totalM">' + totalMoney + '</span> 元。';
    $("#zongtouInfo").html(str);
    $(".i_beishu").html(valStr);
}
