window.onload = function() {
    $(".loading").hide();
}

function pause_play() {
    for(var i = 1; i < 50; i++) {
        var numSound = document.getElementById("numSound" + i);
        numSound.play();
        numSound.pause();
        if(i == 1) {
            Engnum = "one"
        } else if(i == 2) {
            Engnum = "two"
        } else if(i == 3) {
            Engnum = "three"
        } else if(i == 4) {
            Engnum = "four"
        } else if(i == 5) {
            Engnum = "five"
        } else if(i == 6) {
            Engnum = "six"
        } else if(i == 7) {
            Engnum = "seven"
        }
        numSound = document.getElementById("numSound_" + Engnum);
        numSound.play();
        numSound.pause();
    }
}
var oldLog = console.log; //重写 console.log
console.log = function() {
    if(false) {
        oldLog.apply(console, arguments);
    } else {
        return
    }

}
loadAjax(); //打开页面请求数据
// 定义每个球的颜色
var BooColor = ["", "red", "red", "blue", "blue", "green", "green", "red", "red", "blue", "blue", "green", "red", "red", "blue", "blue", "green", "green", "red", "red", "blue", "green", "green", "red", "red", "blue", "blue", "green", "green", "red", "red", "blue", "green", "green", "red", "red", "blue", "blue", "green", "green", "red", "blue", "blue", "green", "green", "red", "red", "blue", "blue", "green"];

var bgSound = document.getElementById("bgSound");
var numSound = document.getElementById("numSound");
var originalHtml = ""; //保存原本的开奖html 内容
var stopsound = false;
$("#sound").click(function(e) { // 声音开关程序 
    e.preventDefault();
    if($(this).hasClass("on")) {
        $(this).removeClass("on").addClass("off"); //关掉声音
        bgSound.pause();
        numSound.pause();
    } else {
        $(this).removeClass("off").addClass("on"); //开声音
        if(orplay()) {
            bgSound.play();
            numSound.play();
        }
    }
})

$("#try").click(function(e) { //试试手气
    e.preventDefault();
    stopsound = false;
    if(orplay()) { // 如果 在搅珠则返回
        return;
    }
    originalHtml = $(".number>ul").html();
    $(".number>ul").html("");
    if($("#sound").hasClass("on")) {
        bgSound.play();
        numSound.play();
    }
    $("#die").addClass("play");
    $(".status").css("background-image", "url(img/status.gif)")
    var eachnone = setTimeout(function() {
        $(".each").css("display", "none")
        $("#die").css("background-image", "initial");
        clearTimeout(eachnone)
    }, 1000)
    var eachtime = setTimeout(function() {
        $(".each").css("display", "block").css("background-image", "url(img/each.gif)");
        addDOM(createArr(), false) //加载随机数到 DOM
        clearTimeout(eachtime);
    }, 2500)
})

//判断是否在播放
function orplay() {
    if($("#die").hasClass("play")) {
        console.log(true)
        return true;
    } else {
        console.log(false)

        return false;
    }
}

//得到去重后的随机数据（数组）
function createArr() {
    var arr = [];
    for(var i = 0; i < 7; i++) {
        var a = createNum(1, 49);
        if(i != 0) {
            for(var c = 0, b = arr.length - 1; c < arr.length; c++) {
                if(a == arr[c]) {
                    i--;
                    break;
                }
                if(c == b) {
                    arr.push(a);
                    break;
                }
            }
        } else {
            arr.push(a)
        }
    }
    return arr;
}
//生成单个随机数
function createNum(min, max) {
    var r = Math.random() * (max - min);
    var re = Math.round(r + min);
    re = Math.max(Math.min(re, max), min)
    return re;
}

//把数级遍历添加 dom，播放聲音
var addinter, oldI, breckClond

function addDOM(Arr, kaiji) { //arr 传入的数组 ，kaiji是否在搅珠/ t rue  /  false
    clearInterval(addinter);
    if(kaiji == false) {
        var html = "";
        var i = 0;
        var addinter = setInterval(function() {
            if(stopsound) {
                clearInterval(addinter);
                clearTimeout(bbc);
                numSound = document.getElementById("numSound");
                return;
            }
            var number = Arr[i] > 9 ? Arr[i] : "0" + Arr[i];
            shakeBall(BooColor[Arr[i]], i)
            if(i != 6) {
                html = "<li class='" + BooColor[Arr[i]] + "'>" + number + "</li>"
            } else {
                html = "<li class='" + BooColor[Arr[i]] + " lastLi'>" + number + "</li>"
            }
            panduSound(i, Arr[i], Arr.length) //导入音频数据，播放对应的音频;
            var bbn = setTimeout(function() { //  延迟2秒加载到html ，等待音频同步
                $(".number>ul").append(html);
                clearTimeout(bbn)
            }, 2000)
            i++;
            if(i == 7) {
                clearInterval(addinter);
                var bbc = setTimeout(function() {
                    stopanimate();
                    clearTimeout(bbc)
                }, 5000)
            }
        }, 4000)
    } else { //在开奖中
        var html = "";
        breckClond = Arr.length;
        if(oldI == undefined) {
            var i = 0;
        } else {
            var i = oldI + 1;
        }
        if(i < oldI) {
            return false;
        }
        if(i == NaN) {
            var i = 0
        }
        console.log(i)
        var addinter = setInterval(function() {
            console.log("oldI " + oldI, "   i " + i)
            if(Arr[i] != undefined && Arr[i] != 0) {
                if(oldI != i) {
                    var number = Arr[i] > 9 ? Arr[i] : "0" + Arr[i];

                    shakeBall(BooColor[Arr[i]], i)
                    if(i != 6) {

                        html = "<li class='" + BooColor[Arr[i]] + "'>" + number + "</li>"
                        //                  panduSound(i, Arr[i],breckClond) //导入音频数据，播放对应的音频
                    } else {
                        html = "<li class='" + BooColor[Arr[i]] + " lastLi'>" + number + "</li>"
                    }
                    panduSound(i, Arr[i], breckClond) //导入音频数据，播放对应的音频
                    oldI = i;
                    var bbn = setTimeout(function() { //  延迟2秒加载到html ，等待音频同步
                        $(".number>ul").append(html);
                        if(i == 7) {
                            originalHtml = $(".number>ul").html();
                        }
                        clearTimeout(bbn)
                    }, 2000)
                    i++;
                    if(i == 7) {
                        clearInterval(addinter);
                        var bbc = setTimeout(function() {
                            nextopenTime(nextopent)
                            stopanimate();
                            clearTimeout(bbc)
                        }, 5000)
                    }
                } else {
                    if(breckClond > i) {
                        i++
                    }
                }
                var number = Arr[i] > 9 ? Arr[i] : "0" + Arr[i];
            } else {
                i = oldI + 1;
            }
        }, 4000)
    }
}
// 每个球的转出
function shakeBall(color, index) {
    var minWidth = $(".min").width();
    var elem = index + 1;
    var top = "16px",
        left = "114px",
        roatatexy = "14px 108px"; //top,left 在pc端球转到顶部再旋转的位置 ， rotatexy pc 端特码 的原点
    if(minWidth <= 983) { //top,left 在移动端球转到顶部再旋转的位置 ， rotatexy 移动 端特码 的原点
        top = "0.2rem";
        left = "1.45rem";
        roatatexy = "0.2rem 1.35rem"
    }
    var boll = $(".ball>span");
    $(".ball>span:nth-child(" + elem + ")").show().addClass(color).animate({
        top: top,
        left: left,
    }, 500)
    var rotate = ""
    //每个球旋转的角度
    if(elem == 1) {
        rotate = -168
    } else if(elem == 2) {
        rotate = -160
    } else if(elem == 3) {
        rotate = -152
    } else if(elem == 4) {
        rotate = -145
    } else if(elem == 5) {
        rotate = -138
    } else if(elem == 6) {
        rotate = -130
    } else if(elem == 7) {
        rotate = 173
    }
    var seltimeout = setTimeout(function() {
        if(elem != 7) {
            $(".ball>span:nth-child(" + elem + ")").addClass("rotate").css("transform", "rotate(" + rotate + "deg)")
        } else {
            //如果是特码转换原点
            $(".ball>span:nth-child(" + elem + ")").addClass("rotate").css({
                "transform-origin": roatatexy,
                "transform": "rotate(" + rotate + "deg)"
            })
        }
        clearTimeout(seltimeout)
    }, 500)
}

//停止动画与音频，html加载原开奖结果
function stopanimate() {
    if(stopsound) {
        stopsound = false
    } else {
        stopsound = true
    }
    clearInterval(addinter)
    if($(".min").width() <= 983) {
        var top = "2.6rem",
            left = "1.45rem"
    } else {
        var top = "199px",
            left = "114px"
    }
    $(".ball>span").removeClass(); //清除球转出时添加的 class 
    $("#die").removeClass("play");
    $("#die").css("background-image", "url(img/0001.png)");
    $(".status").css("display", "initial").siblings(".each").css("display", "initial")
    $(".status").css("background-image", "url(img/0001.png)");
    $(".ball>span").removeClass("rotate").css({
        "transform": "rotate(0deg)",
        "top": top,
        "left": left,
        "display": "none"
    })
    bgSound.pause();
    numSound.pause();
    //  numSound.setAttribute("src", "sound/empt.mp3");
    numSound = document.getElementById("numSound");
    $(".number>ul").html(originalHtml);
}
//判断数字音频
function panduSound(i, n, length) { // i 第几个号码   n 开出的号码
    /*  var Engnum = "";
      if(i == 0) {
          Engnum = "one"
      } else if(i == 1) {
          Engnum = "two"
      } else if(i == 2) {
          Engnum = "three"
      } else if(i == 3) {
          Engnum = "four"
      } else if(i == 4) {
          Engnum = "five"
      } else if(i == 5) {
          Engnum = "six"
      } else if(i == 6) {
          Engnum = "seven"
      }
      numSound = document.getElementById("numSound_" + Engnum);
      if($("#sound").hasClass("on")) { // 判断是否静音，如果不是则播放
          numSound.play();
      }
      numsound(n);*/
    switch(i) {
        case 0:
            numSound = document.getElementById("numSound_one"); //加载几个号码的音频
            if($("#sound").hasClass("on")) { // 判断是否静音，如果不是则播放
                numSound.play();
            }
            numsound(n); // 加载出奖号码的音频
            break;
        case 1:
            numSound = document.getElementById("numSound_two")
            if($("#sound").hasClass("on")) {
                numSound.play();
            }
            numsound(n);
            break;
        case 2:
            numSound = document.getElementById("numSound_three")
            if($("#sound").hasClass("on")) {
                numSound.play();
            }
            numsound(n);
            break;
        case 3:
            numSound = document.getElementById("numSound_four")
            if($("#sound").hasClass("on")) {
                numSound.play();
            }
            numsound(n);
            break;
        case 4:
            numSound = document.getElementById("numSound_five")
            if($("#sound").hasClass("on")) {
                numSound.play();
            }
            numsound(n);
            break;
        case 5:
            numSound = document.getElementById("numSound_six")
            if($("#sound").hasClass("on")) {
                numSound.play();
            }
            numsound(n);
            break;
        case 6:
            numSound = document.getElementById("numSound_seven")
            if($("#sound").hasClass("on")) {
                numSound.play();
            }
            numsound(n);
            break;
    }
    console.log("第几个号码 " + i, "arr长度 " + length)
    if(i != 7 && (i + 2) >= length && length != 7) {
        console.log("timeout")
        typetwo = setTimeout(function() {
            clearTimeout(typetwo)
            loadAjax();
        }, 2000)
    }

    function numsound(n) {
        var abc = setTimeout(function() {
            clearTimeout(abc)
            //          numSound.setAttribute("src", "sound/" + n + ".mp3");
            numSound = document.getElementById("numSound" + n)
            if($("#sound").hasClass("on")) {
                numSound.play();
            }
        }, 2000)
    }
}
var typeSix, typeten, typetwo, nextopent
//请求后台开奖数据

//var httpurl="http://192.168.1.153:8080/six-api/smallSix/testCurrentVideoInfo.php?"   // 本地
//var httpurl="http://192.168.1.140/six-api/smallSix/testCurrentVideoInfo.php?"   // 140
//var httpurl="http://1680660.com/smallSix/findCurrentVideoInfo.php?"   // 线上
var errcount = 0;

function loadAjax() {
    $.ajax({
        type: "get",
        url: url.apiurl +"/smallSix/findCurrentVideoInfo.php?",
        async: true,
        dataType: "json",
        success: function(data) {
            console.log(data);
            nextopent = data.nextdate
            dateAndissue(data) ////填充下期开奖时间与开奖期号 
            if(data.type == 4) {
                clearInterval(addinter);
                stopanimate();
                addloadhtml(data); // 加载开奖号码
                nextopenTime(data.nextdate) // 底部栏的倒计时
            } else if(data.type == 6) {
                $("#nextTime").text("请不要走开，今天晚上21：30开奖...");
                bgSound.play()
                typeSix = setTimeout(function() {
                    clearTimeout(typeSix)
                    loadAjax();
                }, 60000)
            } else if(data.type == 0) {
                $("#nextTime").text("准备报码，请稍后...");
                typeten = setTimeout(function() {
                    clearTimeout(typeten)
                    loadAjax();
                }, 10000)
            } else if(data.type == 2) {
                $("#nextTime").text("节目广告中...");
                typeten = setTimeout(function() {
                    clearTimeout(typeten)
                    loadAjax();
                }, 10000)
            } else if(data.type == 3) {
                $("#nextTime").text("主持人解说中...");
                typeten = setTimeout(function() {
                    clearTimeout(typeten)
                    loadAjax();
                }, 10000)
            } else if(data.type == 1) {
                $("#nextTime").text("正在搅珠中...");
                var ma = data.ma.split(",");
                var kaijiArr = [];
                for(var i = 0; i < ma.length; i += 3) {
                    kaijiArr.push(ma[i] * 1)
                }
                if(breckClond != kaijiArr.length) {
                    kaijiIn(kaijiArr)
                } else {
                    var loadtime = setTimeout(function() {
                        console.log('跟上一期结果相同，重新load 一下')
                        loadAjax();
                        clearTimeout(loadtime)
                    }, 2000)
                }
            }
        },
        error: function(data) {
            console.log("error+++++++" + data)
            if(errcount <= 5) {
                loadAjax();
            }
            errcount++

        }
    });
}
var In = "";
//开奖时正在搅珠
function kaijiIn(maArr) {
    if(In == "") {
        if($("#sound").hasClass("on")) {
            bgSound.play();
            numSound.play();
        }
        $("#die").addClass("play");
        $(".status").css("background-image", "url(img/status.gif)")
        var eachnone = setTimeout(function() {
            $(".each").css("display", "none")
            $("#die").css("background-image", "initial");
            clearTimeout(eachnone)
        }, 1000)
        var eachtime = setTimeout(function() {
            $(".each").css("display", "block").css("background-image", "url(img/each.gif)");
            addDOM(maArr, true) //加载随机数到 DOM
            clearTimeout(eachtime);
        }, 2500)
        In = true;
    } else {
        addDOM(maArr, true) //加载随机数到 DOM
    }
}
//解释请求到的数据加载到 DOM
function addloadhtml(data) {
    console.log(data)
    var ma = data.ma.split(",");
    var kaijiArr = [];
    for(var i = 0; i < ma.length; i += 3) {
        kaijiArr.push(ma[i] * 1)
    }
    var ber = "",
        html = "";
    $.each(kaijiArr, function(c, l) {
        ber = l > 9 ? l : "0" + l
        if(c != 6) {
            html += "<li class='" + BooColor[l] + "'>" + ber + "</li>"
        } else {
            html += "<li class='" + BooColor[l] + " lastLi'>" + ber + "</li>"
        }
    });
    $(".number>ul").html(html);
    originalHtml = html;

}
////填充下期开奖时间与开奖期号 
function dateAndissue(data) {
    var nextdate = data.nextdate.slice(0, 10).replace("/", '年').replace("/", "月") + "号";
    $("#data_b").text(nextdate);
    $("#issue_b").text(data.nextid)

}
//计算距离下期开奖的时间
function nextopenTime(nextTime) {
    console.log(new Date(nextTime))
    var nexttimeinter = setInterval(function() {
        var time = new Date(nextTime).getTime() - new Date().getTime()
        var day = parseInt(time / (1000 * 60 * 60) / 24)
        var hours = parseInt(time / (1000 * 60 * 60) - (day * 24));
        var fen = parseInt((time / (1000 * 60 * 60) - (day * 24) - hours) * 60)
        var miao = parseInt(((time / (1000 * 60 * 60) - (day * 24) - hours) * 60 - fen) * 60);
        if(time < 0 || day < 0 || time < 0 || time < 0 || time < 0) {
            return;
        } else {
            var textime = '距离下期开奖还有：' + day + '天' + hours + '小时' + fen + '分' + miao + '秒'
            $("#nextTime").text(textime)
        }
    }, 1000)
}

//