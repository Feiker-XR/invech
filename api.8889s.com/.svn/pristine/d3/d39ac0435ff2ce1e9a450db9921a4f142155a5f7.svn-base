/**
 * 时间对象的格式化;
 */
Date.prototype.format = function (format) {
    /*
     * eg:format="yyyy-MM-dd hh:mm:ss";
     */
    var o = {
        "M+": this.getMonth() + 1, // month
        "d+": this.getDate(), // day
        "h+": this.getHours(), // hour
        "m+": this.getMinutes(), // minute
        "s+": this.getSeconds(), // second
        "q+": Math.floor((this.getMonth() + 3) / 3), // quarter
        "S": this.getMilliseconds()
        // millisecond
    }

    if (/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4
            - RegExp.$1.length));
    }

    for (var k in o) {
        if (new RegExp("(" + k + ")").test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1
                ? o[k]
                : ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return format;
}
var config = {
    DEBUG: false,
    ToastTimeLength: 1500
};
var Tools = {
    getUrlNoParams: function(url) {
        var tmpUrl = url;
        if (tmpUrl.indexOf("?") > 0) {
            tmpUrl = tmpUrl.split("?")[0];
        }
        return tmpUrl;
    },
    getSubUrlFromSurl: function(surl) {
        var paramArr = surl.split("#");
        var turl = "";
        var tparam = "";
        if (paramArr) {
            paramArr = paramArr[1];
            if (paramArr) {
                paramArr = paramArr.split("?");

                turl = paramArr[0];
                if (paramArr[1]) {
                    paramArr = paramArr[1].split("&");

                    $.each(paramArr, function(index, value) {
                        var tmp = value.split("=");
                        var key = tmp[0];
                        var v = tmp[1];

                        if (tparam === "") {
                            tparam = "?timestamp=" + (new Date()).getTime();
                        }
                        tparam += "&" + key + "=" + v;
                    });
                }
            }
        }

        if (!turl) {
            return null;
        }

        return turl + tparam;
    },
    error: function (str) {
        if (typeof(str) == "string") {
            alert(str);
        }
    },
    success: function (str) {
        if (typeof(str) == "string") {
            alert(str);
        }
    },
    toast: function (str) {
        if (typeof(str) == "string") {
            alert(str);
        }
    },
    log: function (str) {
        if (config.DEBUG) {
            console.log(str);
        }
    },
    sleep: function (numberMillis) {
        var now = new Date();
        var exitTime = now.getTime() + numberMillis;
        while (true) {
            now = new Date();
            if (now.getTime() > exitTime)
                return;
        }
    },
    formatDate: function (str) {
        str = parseInt(str);
        var now = new Date(str);
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var date = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();

        month = month < 10 ? '0' + month : month;
        date = date < 10 ? '0' + date : date;
        hour = hour < 10 ? '0' + hour : hour;
        minute = minute < 10 ? '0' + minute : minute;
        second = second < 10 ? '0' + second : second;
        return year + "-" + month + "-" + date + " " + hour + ":" + minute + ":" + second;
    },
    formatDateChinese: function (str) {
        str = parseInt(str);
        var now = new Date(str);
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var date = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        return year + "年" + month + "月" + date + "日" + hour + "时" + minute + "分" + second + "秒";
    },
    formatDateChineseShort: function (str) {
        str = parseInt(str);
        var now = new Date(str);
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var date = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        return year + "年" + month + "月" + date + "日 " + hour + ":" + minute;
    },
    formatDateStrShort: function (str) {
        // 2017-09-19 20:40
        str = parseInt(str);
        var now = new Date(str);
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var date = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        if(minute < 10){
            minute = '0' + minute;
        }
        return year + "-" + month + "-" + date + " " + hour + ":" + minute;
    },
    diffDateChinese: function (time1, time2) {
        var total = (time2 - time1) / 1000;
        var hour = Math.floor(total / (60 * 60));
        var minute = Math.floor((total - hour * 60 * 60) / 60);
        var second = Math.floor(total % 60);
        return hour + "时" + minute + "分" + second + "秒";
    },
    null2Str: function (str) {
        return str || '';
    },
    parseInt: function (str) {
        return parseInt(str, 10);
    }
}

var ajaxRequest = function (obj) {
    var data = new Array();
    if (typeof obj.data != "undefined") {    //typeof 可以用来检测给定变量的数据类型，可能的返回值：1. 'undefined' --- 这个值未定义
        data = obj.data;
    }

    var requestStr = obj.url;
    if (requestStr.indexOf("?") > 0) {   //indexOf() 方法可返回某个指定的字符串值在字符串中首次出现的位置
        requestStr += "&";
    } else {
        requestStr += "?";
    }

    var type;
    if (typeof obj.type == 'undefined') {
        type = 'GET';
    } else {
        type = obj.type;
    }

    var dataType;
    if (typeof obj.dataType == 'undefined') {
        dataType = 'json';
    } else {
        dataType = obj.dataType;
    }

    requestStr += "timestamp=" + new Date().getTime();
    $.ajax({
        type: type,
        url: requestStr,        dataType: dataType,
        data: data,
        timeout: 60000,
        success: function (json) {
            Tools.log(requestStr + "-success:");
            Tools.log(json);

            if (typeof(obj.success) == "function") {
                obj.success(json);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            Tools.log(requestStr + "-error");
            Tools.log({
                "XMLHttpRequest": XMLHttpRequest,
                "textStatus": textStatus,
                "errorThrown": errorThrown
            });

            if (textStatus == 'timeout') {
                // Tools.toast("操作超时，请联系管理员");
            } else {
                // Tools.toast("服务器异常，请联系管理员");
            }

            if (typeof(obj.error) == "function") {
                obj.error(XMLHttpRequest, textStatus, errorThrown);
            }
        },
        beforeSend: function () {
            Tools.log(requestStr + "-beforeSend");
            if (typeof(obj.beforeSend) == "function") {
                obj.beforeSend();
            }
        },
        complete: function () {
            Tools.log(requestStr + "-complete");
            if (typeof(obj.complete) == "function") {
                obj.complete();
            }
        }
    });
}



function add(a, b) {
    var c, d, e;
    try {
        c = a.toString().split(".")[1].length;
    } catch (f) {
        c = 0;
    }
    try {
        d = b.toString().split(".")[1].length;
    } catch (f) {
        d = 0;
    }
    return e = Math.pow(10, Math.max(c, d)), (mul(a, e) + mul(b, e)) / e;
}

function sub(a, b) {
    var c, d, e;
    try {
        c = a.toString().split(".")[1].length;
    } catch (f) {
        c = 0;
    }
    try {
        d = b.toString().split(".")[1].length;
    } catch (f) {
        d = 0;
    }
    return e = Math.pow(10, Math.max(c, d)), (mul(a, e) - mul(b, e)) / e;
}

function mul(a, b) {
    var c = 0,
        d = a.toString(),
        e = b.toString();
    try {
        c += d.split(".")[1].length;
    } catch (f) {
    }
    try {
        c += e.split(".")[1].length;
    } catch (f) {
    }
    return Number(d.replace(".", "")) * Number(e.replace(".", "")) / Math.pow(10, c);
}

function div(a, b) {
    var c, d, e = 0,
        f = 0;
    try {
        e = a.toString().split(".")[1].length;
    } catch (g) {
    }
    try {
        f = b.toString().split(".")[1].length;
    } catch (g) {
    }
    return c = Number(a.toString().replace(".", "")), d = Number(b.toString().replace(".", "")), mul(c / d, Math.pow(10, f - e));
}
function getRequest(url) {
    var theRequest = [];
    if (url.indexOf("?") != -1) {   //如果要检索的字符串值没有出现，则该方法返回 -1
        var str = url.substr(url.indexOf("?") + 1);
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            theRequest.push({
                key: strs[i].split("=")[0],
                value: unescape(strs[i].split("=")[1])
            });
        }
    }
    return theRequest;
}
// 获取万、千、百、十、个固定位数的个数所组成5位所有组合
function getNewArrs(wanA, qianA, baiA, shiA, geA) {
    var wArr = [], qArr = [], bArr = [], sArr = [], gArr = [];
    wArr = wanA;
    qArr = qianA;
    bArr = baiA;
    sArr = shiA;
    gArr = geA;
    var tempArr = [];
    for (var w = 0; w < wArr.length; w++) {
        for (var q = 0; q < qArr.length; q++) {
            for (var b = 0; b < bArr.length; b++) {
                for (var s = 0; s < sArr.length; s++) {
                    for (var g = 0; g < gArr.length; g++) {
                        tempArr.push(wArr[w] + "" + qArr[q] + "" + bArr[b] + "" + sArr[s] + "" + gArr[g]);
                    }
                }
            }
        }
    }
    return tempArr;
}

// 获取千、百、十、个固定位数的个数所组成4位所有组合
function getFourNewArrs(qianA, baiA, shiA, geA) {
    var qArr = [], bArr = [], sArr = [], gArr = [];
    qArr = qianA;
    bArr = baiA;
    sArr = shiA;
    gArr = geA;
    var tempArr = [];
    for (var q = 0; q < qArr.length; q++) {
        for (var b = 0; b < bArr.length; b++) {
            for (var s = 0; s < sArr.length; s++) {
                for (var g = 0; g < gArr.length; g++) {
                    tempArr.push(qArr[q] + "" + bArr[b] + "" + sArr[s] + "" + gArr[g]);
                }
            }
        }
    }
    return tempArr;
}

// 获取千、百、十、个固定位数的个数所组成4位所有组合
function getFourNewArrs(qianA, baiA, shiA, geA) {
    var qArr = [], bArr = [], sArr = [], gArr = [];
    qArr = qianA;
    bArr = baiA;
    sArr = shiA;
    gArr = geA;
    var tempArr = [];
    for (var q = 0; q < qArr.length; q++) {
        for (var b = 0; b < bArr.length; b++) {
            for (var s = 0; s < sArr.length; s++) {
                for (var g = 0; g < gArr.length; g++) {
                    tempArr.push(qArr[q] + "" + bArr[b] + "" + sArr[s] + "" + gArr[g]);
                }
            }
        }
    }
    return tempArr;
}

// 获取千、百、十、个固定位数的个数所组成4位所有组合
function getFourNewArrs(qianA, baiA, shiA, geA) {
    var qArr = [], bArr = [], sArr = [], gArr = [];
    qArr = qianA;
    bArr = baiA;
    sArr = shiA;
    gArr = geA;
    var tempArr = [];
    for (var q = 0; q < qArr.length; q++) {
        for (var b = 0; b < bArr.length; b++) {
            for (var s = 0; s < sArr.length; s++) {
                for (var g = 0; g < gArr.length; g++) {
                    tempArr.push(qArr[q] + "" + bArr[b] + "" + sArr[s] + "" + gArr[g]);
                }
            }
        }
    }
    return tempArr;
}

// 获取千、百、十、个固定位数的个数所组成4位所有组合
function getFourNewArrs(qianA, baiA, shiA, geA) {
    var qArr = [], bArr = [], sArr = [], gArr = [];
    qArr = qianA;
    bArr = baiA;
    sArr = shiA;
    gArr = geA;
    var tempArr = [];
    for (var q = 0; q < qArr.length; q++) {
        for (var b = 0; b < bArr.length; b++) {
            for (var s = 0; s < sArr.length; s++) {
                for (var g = 0; g < gArr.length; g++) {
                    tempArr.push(qArr[q] + "" + bArr[b] + "" + sArr[s] + "" + gArr[g]);
                }
            }
        }
    }
    return tempArr;
}


//去掉数组重复
Array.prototype.uniqueArr = function () {
    var temp = new Array();
    this.sort();
    for(i = 0; i < this.length; i++) {
        if( this[i] == this[i+1]) {
            continue;
        }
        temp[temp.length]=this[i];
    }
    return temp;
};

//获取重复元素
Array.prototype.duplicateNew = function () {
    var tempArr = new Array();
    this.sort();
    for(i = 0; i < this.length; i++) {
        if( this[i] == this[i+1]) {
            tempArr.push(this[i]);
            continue;
        }
    }
    return tempArr;
};

// 获取百、十、个固定位数的个数所组成(后三直选--后三组合)
function getHszhNewArrs(baiA, shiA, geA) {
    var bArr = [], sArr = [], gArr = [];
    bArr = baiA;
    sArr = shiA;
    gArr = geA;
    var tempArr = [];
    for (var b = 0; b < bArr.length; b++) {
        for (var s = 0; s < sArr.length; s++) {
            for (var g = 0; g < gArr.length; g++) {
                tempArr.push(bArr[b] + "" + sArr[s] + "" + gArr[g]);
                tempArr.push(sArr[s] + "" + gArr[g]);
                tempArr.push(gArr[g]);
            }
        }
    }
    return tempArr;
}

// 获取千、百、十、个固定位数的个数所组成4位所有组合
function getFourNewArrs(qianA, baiA, shiA, geA) {
    var qArr = [], bArr = [], sArr = [], gArr = [];
    qArr = qianA;
    bArr = baiA;
    sArr = shiA;
    gArr = geA;
    var tempArr = [];
    for (var q = 0; q < qArr.length; q++) {
        for (var b = 0; b < bArr.length; b++) {
            for (var s = 0; s < sArr.length; s++) {
                for (var g = 0; g < gArr.length; g++) {
                    tempArr.push(qArr[q] + "" + bArr[b] + "" + sArr[s] + "" + gArr[g]);
                }
            }
        }
    }
    return tempArr;
}

//查找数据中重复元素
Array.prototype.duplicate=function() {
    var tmp = [];
    this.concat().sort().sort(function(a,b){
        if(a==b && tmp.indexOf(a) === -1) tmp.push(a);
    });
    return tmp;
}

// 判断一个字符串是否都为数字
function isAllNaN(str) {
    for (var i = 0; i < str.length; i++) {
        if (isNaN(str.charAt(i))) {
            return 0;
        }
    }
    return 1;
}

/**
 * 获得从m中取n的所有组合
 */
function getFlagArrs(arr, num) {
    if (arr.length < num) {
        return [];
    }
    var list = [];
    var sb = "";
    var b = new Array();
    for (var i = 0; i < arr.length; i++) {
        if (i < num) {
            b[i] = "1";
        } else
            b[i] = "0";
    }

    var point = 0;
    var nextPoint = 0;
    var count = 0;
    var sum = 0;
    var temp = "1";
    while (true) {
        // 判断是否全部移位完毕
        for (var i = b.length - 1; i >= b.length - num; i--) {
            if (b[i] == "1")
                sum += 1;
        }
        // 根据移位生成数据
        for (var i = 0; i < b.length; i++) {
            if (b[i] == "1") {
                point = i;
                sb += arr[point];
                sb += " ";
                count++;
                if (count == num)
                    break;
            }
        }
        // 往返回值列表添加数据
        list.push(sb);

        // 当数组的最后num位全部为1 退出
        if (sum == num) {
            break;
        }
        sum = 0;

        // 修改从左往右第一个10变成01
        for (var i = 0; i < b.length - 1; i++) {
            if (b[i] == "1" && b[i + 1] == "0") {
                point = i;
                nextPoint = i + 1;
                b[point] = "0";
                b[nextPoint] = "1";
                break;
            }
        }
        // 将 i-point个元素的1往前移动 0往后移动
        for (var i = 0; i < point - 1; i++)
            for (var j = i; j < point - 1; j++) {
                if (b[i] == "0") {
                    temp = b[i];
                    b[i] = b[j + 1];
                    b[j + 1] = temp;
                }
            }
        // 清空 StringBuffer
        sb = "";
        count = 0;
    }
    for (var i = 0; i < list.length; ++i) {
        list[i] = $.trim(list[i]);
    }
    return list;
}

function windowOpenBlank(url) {
    window.open(url, '_blank');
}

function windowOpen(url, title, width, height) {
    var top = (window.screen.height - 30 - height) / 2; //获得窗口的垂直位置;
    var left = (window.screen.width - 10 - width) / 2; //获得窗口的水平位置;
    var win = window.open(url, title, 'height=' + height + ',innerHeight=' + height + ',width=' + width + ',innerWidth=' + width + ',top=' + top + ',left=' + left + ',fullscreen=1,toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
    win.focus();
}

// 生肖号码计算
var sx = ["猴", "鸡", "狗", "猪", "鼠", "牛", "虎", "兔", "龙", "蛇", "马", "羊"];
var sxArr = [];
// var startIndex = (new Date('<fmt:formatDate value="${serverTime}" pattern="yyyy-MM-dd HH:mm:ss"/>')).getFullYear() % 12;
var date = new Date();
var year = date.getFullYear();  //表示年份的四位数字
if (date.getTime() < (new Date('2017-1-28 00:00:00')).getTime()) {
    year = 2016;
}
var startIndex = year % 12;
for (var i = startIndex, count = 0; count < 12; i = (i + 1) % 12, ++count) {
    sxArr[count] = {
        name: sx[i],
        number: null
    };
}
sxArr[0].number = [1, 13, 25, 37, 49];
sxArr[1].number = [12, 24, 36, 48];
sxArr[2].number = [11, 23, 35, 47];
sxArr[3].number = [10, 22, 34, 46];
sxArr[4].number = [9, 21, 33, 45];
sxArr[5].number = [8, 20, 32, 44];
sxArr[6].number = [7, 19, 31, 43];
sxArr[7].number = [6, 18, 30, 42];
sxArr[8].number = [5, 17, 29, 41];
sxArr[9].number = [4, 16, 28, 40];
sxArr[10].number = [3, 15, 27, 39];
sxArr[11].number = [2, 14, 26, 38];
function getSxName(value) {
    for (var i = 0; i < sxArr.length; ++i) {
        var name = sxArr[i].name;
        for (var j = 0; j < sxArr[i].number.length; ++j) {
            if (sxArr[i].number[j] == parseInt(value)) {
                return name;
            }
        }
    }
    return "";
}
function getSxValue(name) {
    for (var i = 0; i < sxArr.length; ++i) {
        var sxName = sxArr[i].name;
        if (name == sxName) {
            return sxArr[i].number;
        }
    }
    return [];
}

// 红绿蓝
var hongboArr = [1, 2, 7, 8, 12, 13, 18, 19, 23, 24, 29, 30, 34, 35, 40, 45, 46];
var lanboArr = [3, 4, 9, 10, 14, 15, 20, 25, 26, 31, 36, 37, 41, 42, 47, 48];
var lvboArr = [5, 6, 11, 16, 17, 21, 22, 27, 28, 32, 33, 38, 39, 43, 44, 49];
function getBose(value) {
    for (var i = 0; i < hongboArr.length; ++i) {
        if (hongboArr[i] == parseInt(value)) {
            return 0;
        }
    }
    for (var j = 0; j < lanboArr.length; ++j) {
        if (lanboArr[j] == parseInt(value)) {
            return 1;
        }
    }
    for (var i = 0; i < lvboArr.length; ++i) {
        if (lvboArr[i] == parseInt(value)) {
            return 2;
        }
    }
}
function toFixed(value, scale, isUp) {
    if (isUp) {
        return value.toFixed(scale);
    } else {
        for (var i = 0; i < scale; ++i) {
            value *= 10;
        }
        value = parseInt(value);
        for (var i = 0; i < scale; ++i) {
            value /= 10;
        }
        return value.toFixed(scale);
    }
}

function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = top.window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}

function setIframeHeight(iframe) {
    if (iframe) {
        var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
        if (iframeWin.document.body) {
            iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
        }
    }
};