var syxwV = {};
var isTry = false,
	ifopen = false,
	playa = "b",
	animateId={},
	timer = null; //试试手;
var scale = parent.window.config.ifScalse; //判断中、小屏
$(function() {
	//点击声音按钮
	$("#soundBth").on("click", function() {
		var playa = function() {
			if(audioType == "b") {
				syxwV.sound.play("audioidBg");
				syxwV.sound.stop("audioidKai");
			} else {
				audioType == "r"
				syxwV.sound.play("audioidKai");
				syxwV.sound.stop("audioidBg");
			}
		}
		if($("#soundBth").attr("class") == "soundsOn") {
			$("#soundBth").removeClass("soundsOn").addClass("soundsOff");
			syxwV.sound.stop("audioidKai");
			syxwV.sound.stop("audioidBg");
		} else {
			$("#soundBth").removeClass("soundsOff").addClass("soundsOn");
			playa();
		}
	});
	//点击试试手气
	$("#tryBtn").on("click", function() {
		if(!isTry) { //第一次可以点击
			isTry = true;
		} else {
			$(".jzCheck").show();
			setTimeout(function() {
				$(".jzCheck").hide();
			}, 1000);
			return false;
		}
		goRun(); //开奖动画界面中
	});
	syxwV.createPaLi();
})
//进入开奖动画界面中
function goRun() {
	syxwV.intoKai(); //点击试试手气，进入模拟开奖界面动画
	syxwV.startAnimateTry(); //开启动画
}
//声音开启，关闭
syxwV.sound = {
	play: function(id) {
		if($("#soundBth").attr("class") == "soundsOn") {
			document.getElementById(id).play();
		}
	},
	stop: function(id) {
		document.getElementById(id).pause();
	}
}
//将开奖号码数组最后一个移置第一个
syxwV.moveEle = function(numArr){
	var newnumArr = numArr;
	var delDom = newnumArr.pop();
	newnumArr.unshift(delDom);
	return newnumArr;
	console.log(newnumArr);
}

//默认界面数据展示
syxwV.startVid = function(dateArr) {
	//倒计时和开奖中状态切换
	$("#hourtxt").show();
	$("#opening").hide();
	bgMusic(); //添加背景音乐播放
	syxwV.Data(dateArr,1); //更新当前本期开奖号码
	console.log("startVid" + dateArr);
}
//倒计时完成，动画执行后，结束动画
syxwV.stopVid = function(dateArr) {
	//倒计时和开奖中状态切换
	$("#hourtxt").show();
	$("#opening").hide();
	bgMusic(); //添加背景音乐播放
	syxwV.stopAllFun(dateArr.preDrawCode);
	syxwV.Data(dateArr,2); //更新当前本期开奖号码
	console.log("stopVid:"  + dateArr);
}

syxwV.Data = function(data,n) {
	$(".numList").find("ul").empty();
	var numArr = data.preDrawCode;
	if(n == 1){
		numArr = syxwV.moveEle(numArr);
	} else{
		
	}
	console.log(numArr);
	$("#issue").text(data.drawIssue);
	$("#kaiTime").text(data.drawTime);
	var hourTxt = data.preDrawTime.split(":");
	var hour = hourTxt[0];
	var minute = hourTxt[1];
	var second = hourTxt[2];
	syxwV.cutTime(syxwV.getSecond(data.preDrawTime));
	var tdli = "";
	var tdliFirst = "";
	var tdlis = "";
	for(var i = 0; i < numArr.length; i++) {
		if(i == 0) {
			tdliFirst = "<li class='codeRed" + numArr[i] + "'></li>"
		} else {
			if(numArr[i] < 10) {
				numCode = "0" + numArr[i];
				tdlis += "<li class='code" + numCode + "'></li>"
			} else {
				tdlis += "<li class='code" + numArr[i] + "'></li>"
			}
		}
	}
	tdli = tdliFirst + tdlis;
	$(".numList").find("ul").append(tdli);
}
//倒计时
syxwV.getSecond = function(preDrawTime) {
	var hourtxt = (preDrawTime).split(":");
	var hour = hourtxt[0];
	var minute = hourtxt[1];
	var second = hourtxt[2];
	hour = hour < 10 ? hour.substring(hour.length - 1, hour.length) : hour;
	minute = minute < 10 ? minute.substring(minute.length - 1, minute.length) : minute;
	second = second < 10 ? second.substring(second.length - 1, second.length) : second;
	var seconds = hour * 3600 + minute * 60 + second * 1;
	return seconds;
}

syxwV.cutTime = function(sys_second) {
	if(timer != null) {
		clearInterval(timer);
	}
	var sys_second = sys_second;
	timer = setInterval(function() {
		if(sys_second >= 1) {
			sys_second -= 1;
			//var day = Math.floor((sys_second / 3600) / 24);
			var hour = Math.floor(sys_second / (60 * 60));
			var minute = Math.floor((sys_second / (60)) % 60);
			var second = Math.floor((sys_second) % 60);
			var html = "";
			//如果时间小于0则删除时间显示
			html = (hour < 10 ? ("0" + hour) : hour) + " : ";
			html = html + "" + (minute < 10 ? ("0" + minute) : minute) + " : " + (second < 10 ? ("0" + second) : second);
			$("#hourtxt").text(html); //计算小时
			if(sys_second < 10) {
				var lilist = $(".linelist").find("li");
				$(lilist).eq(sys_second).addClass("redli");
			}
		} else {
			clearInterval(timer); //清除当前定时器
			$("#hourtxt").hide();
			$("#opening").show();
			syxwV.sound.stop("audioidBg");
			syxwV.sound.stop("audioidKai");
			syxwV.intoKai(); //进入模拟开奖界面动画
			syxwV.startFun();
		}
	}, 1000);
}
syxwV.clearTime = function(){
	clearInterval(timer); //清除当前定时器
}
//点击试试手气，进入模拟开奖界面动画
syxwV.intoKai = function() {
	$("#defaultDiv").animate({
		"z-index": "-1",
		"height": "0",
	}, 500);
	$("#kaiDiv").animate({
		"top": "180px"
	}, 500);
	for(var i = 0; i < 2; i++) {
		syxwV.createKaiPaLi(); //模拟开奖界面生成号码球*2管道		
	}
}
//模拟开奖、或者开奖完成，恢复初始 默认界面
syxwV.recover = function() {
	$("#defaultDiv").animate({
		"z-index": "1",
		"height": "540",
	}, 500);
	$("#kaiDiv").animate({
		"top": "720px"
	}, 500);
	$("#kaiDiv").find(".pipkai ul li").remove();
}

//默认状态下号码管号码球
syxwV.createPaLi = function() {
	//给管道添加号码球
	var paLiLen = $("#defaultDiv").find(".paUl .paLi").length;
	for(var i = 0; i < paLiLen; i++) { //管道数量
		var tdli = "";
		if(i == 0) { //第一条管道为红球
			var redArr = [1, 2, 3, 4, 5, 10];
			for(var r = 0; r < redArr.length; r++) {
				tdli += "<li class='numRed" + redArr[r] + "'></li>";
			}
		} else if(i == paLiLen - 1) { //最后一条管道
			for(var j = 0; j < 8; j++) {
				tdli += "<li class='num" + (j + 1) + "" + "0" + "'></li>"
			}
		} else {
			for(var j = 0; j < 8; j++) { //每组管道中号码球的数量
				tdli += "<li class='num" + j + "" + i + "'></li>";
			}
		}
		$("#defaultDiv").find(".paLi").eq(i).find(".sonUl").append(tdli);
	}
}

//开奖界面中号码管号码球
syxwV.createKaiPaLi = function() {
	var kaiLiLen = $("#kaiDiv").find(".paUl .pipkai").length;
	for(var i = 0; i < kaiLiLen; i++) {
		var tdkaili = "";
		if(i == 0) {
			for(var j = 0; j < 6; j++) {
				if(j == 5) {
					tdkaili += "<li class='numRed10" + "'></li>"
				} else {
					tdkaili += "<li class='numRed" + (j + 1) + "" + "'></li>"
				}
			}
		} else if(i == kaiLiLen - 1) {
			for(var j = 0; j < 8; j++) {
				if(j < 6) {
					tdkaili += "<li class='num" + (j + 1) + "" + "0" + "'></li>"
				} else {
					tdkaili += "<li class='num" + (j + 1) + "" + "0" + "'></li>"
				}
			}
		} else {
			for(var j = 0; j < 8; j++) { //每组管道中号码球的数量
				if(j < 6) {
					tdkaili += "<li  class='num" + j + "" + i + "'></li>";
				} else {
					tdkaili += "<li class='num" + j + "" + i + "'></li>";
				}
			}
		}
		$("#kaiDiv").find(".pipkai").eq(i).find(".sonUl").append(tdkaili);
	}
}

//开启动画，号码球开始掉落动画
syxwV.startDrop = function() {
	var y1;
	var pipLen = $("#kaiDiv").find(".paUl .pipkai").length; //管道个数（11）
	for(var i = 0; i < pipLen; i++) {
		syxwV.dropBall(i);
	}
}

//号码球执行掉落动作
syxwV.dropBall = function(i) {
	var j;
	if(i == 0) {
		j = 11;
	} else {
		j = 15;
	}
	var ballInt = setInterval(function() {
		y1 = $("#kaiDiv").find(".paUl .pipkai").eq(i).find(".sonUl li").eq(j).position().top + (j * 6);
		if(j <= 14) {
			y1 += 46;
		}
		syxwV.run(y1, i, j, scale);
		j--;
		if(j < 0) {
			clearInterval(ballInt);
		}
	}, 100)
}
syxwV.run = function(Y, i, kaiLiLen, scale) {
	var x = createNum(-80, 50);
	var curLiX = $("#kaiDiv").find(".paUl .pipkai").eq(i).find(".sonUl li").eq(kaiLiLen).position().left / scale + x;
	if(i == 0) {
		if(curLiX < -35) {
			curLiX = -35;
		}
	} else if(i == 10) {
		if(curLiX > 35) {
			//curLiX = 35;
		}
	}
	$("#kaiDiv").find(".paUl .pipkai").eq(i).find(".sonUl li").eq(kaiLiLen).animate({
		"top": (Y + 340) + "px",
		"left": curLiX + "px"
	}, 800);
}
syxwV.startAnimateTry = function(){
	syxwV.sound.stop("audioidBg");
	syxwV.sound.stop("audioidKai");
	syxwV.startFun();
	setTimeout(function(){
		syxwV.stopAllFun();
	},5000);
}
//转动十字架拨动号码球
syxwV.startFun = function() {
	scale = parent.window.config.ifScalse; //判断中、小屏
	console.log("statuu");
	setTimeout(function() {
		syxwV.startDrop(); //启动动画
		setTimeout(function() {
			kaiMusic(); //添加开奖音乐播放
			syxwV.szjCir(); //十字架开始转动和结束转动
			var showBall = setInterval(function() {
				syxwV.createBall(); //号码球随意移动
			}, 285); //每隔200ms，改变一次所有号码球位置
			animateId["tryid"]=showBall;
		}, 2300); //启动十字架搅动号码球 
	}, 500) //点击后延迟500ms，号码球掉落
}
//十字架开始转动和结束转动
syxwV.szjCir = function(){
	$("#crossL").addClass("rotationL");
	$("#crossR").addClass("rotationR");
	setTimeout(function() {
		$("#crossL").addClass("rotationL2").removeClass("rotationL");
		$("#crossR").addClass("rotationR2").removeClass("rotationR");
	}, 1000); //加快十字架转动速度
}
syxwV.stopAllFun = function(arrObg){
	if(arrObg != undefined){
		syxwV.stopFun(arrObg); //倒计时完成模拟开奖完成		
	} else{
		var createArr = syxwV.createTryArr();	
		syxwV.stopFunTry(createArr); //试试手气模拟开奖完成		
	}
	setTimeout(function(){
		clearInterval(animateId["tryid"]);
		syxwV.ballDown(); //号码球掉落最底部
		setTimeout(function() {
			$("#crossL").removeClass("rotationL2");
			$("#crossR").removeClass("rotationR2");
			bgMusic(); //添加背景音乐播放
			syxwV.recoverFun();
		}, 1500)
	},1000);
}
//恢复默认界面
syxwV.recoverFun = function(){
	setTimeout(function() {
		syxwV.recover(); //恢复默认界面
		isTry = false;
	}, 5000);
}

//底部区域随机生成背景号码球
syxwV.createBall = function() {
	var ballLeft,
		ballTop,
		ballNum;
	var ballLeft = "";
	var ballRight = "";
	var ballCodelt = $(".paUl .pipkai:lt(6)").find(".sonUl").find("li");
	var ballCodegt = $(".paUl .pipkai:gt(5)").find(".sonUl").find("li");
	//左边号码球区
	for(var i = 0; i < ballCodelt.length; i++) {
		ballLeft = createNum(0, 450); //水平left值范围
		ballTop = createNum(130, 466); //垂直top值范围
		if(ballTop > 240 && ballTop < 333 && ballLeft > 140 && ballLeft < 233) {
			ballTop = 240;
			ballLeft = 140;
		}
		syxwV.ltfun(ballCodelt[i], ballLeft, ballTop)
	}
	//右边号码球区
	for(var i = 0; i < ballCodegt.length; i++) {
		ballLeft = createNum(350, 836); //水平left值范围
		ballTop = createNum(130, 466); //垂直top值范围
		if(ballTop > 240 && ballTop < 333 && ballLeft > 591 && ballLeft < 680) {
			ballTop = 240;
			ballLeft = 591;
		}
		syxwV.ltfun(ballCodegt[i], ballLeft, ballTop)
	}
}
syxwV.ltfun = function(obj, left, top) {
	if($(obj).hasClass("checkBall")) {
		return false
	};
	var timer = createNum(100, 500)
	$(obj).animate({
		"top": top + "px",
		"left": left + "px",
	}, timer)
}

//产生随机开奖号码球，停止搅动球动画
syxwV.stopFun = function(arrObg) {
	console.log("top")
	var rNum,
		Num,
		objClass,
		ballNum, //匹配生成的号码球
		checkNum,
		createArr; //随机匹配生成的号码球类名
	var countLeft = 87;
	var flag = true;
	var checkRed = "numRed"; //随机匹配生成的红球类名
	createArr = arrObg;	//数组最后一个为红球值，（将数组最后一个元素放置数组最前面）
	var delDom = createArr.pop();
	createArr.unshift(delDom);
	for(var i = 0; i < createArr.length; i++) {
		if(i == 0) { //生成红球
			checkRed = checkRed + createArr[i];				
			rNum = $(".paUl .pipkai").eq(0).find(".sonUl").find("li");
			syxwV.checkFun_Red(checkRed);
		} else {
			ballNum = createArr[i];
			if(ballNum < 10) {
				ballNum = "0" + ballNum; //将0-9号码球转换为“01”两位数形式
			}
			checkNum = "num" + ballNum; //随机匹配生成的号码球类名
			if(i < 11) { //i为1-10表示第一排top=0
				syxwV.checkFun(checkNum, countLeft, 1);
				if(i >= 5 && i <= 10) {
					countLeft += 82;
				} else {
					countLeft += 80;
				}
			} else { //11-20表示第二排top=50
				if(flag) {
					countLeft = 87;
					flag = false;
				}
				syxwV.checkFun(checkNum, countLeft, 2);
				if(i >= 15 && i <= 20) {
					countLeft += 82;
				} else {
					countLeft += 80;
				}
			}

		}
	}
}

//stopFunTry试试手气开奖结束
syxwV.stopFunTry = function(arrObg){
	console.log("stop")
	var rNum,
		Num,
		objClass,
		ballNum, //匹配生成的号码球
		checkNum,
		createArrTry; //随机匹配生成的号码球类名
	var countLeft = 87;
	var flag = true;
	var checkRed = "numRed"; //随机匹配生成的红球类名
	createArrTry = arrObg;
	console.log(createArrTry);
	for(var i = 0; i < createArrTry.length; i++) {
		if(i == 0) { //生成红球
			checkRed = checkRed + createArrTry[i];				
			rNum = $(".paUl .pipkai").eq(0).find(".sonUl").find("li");
			syxwV.checkFun_Red(checkRed);
		} else {
			ballNum = createArrTry[i];
			if(ballNum < 10) {
				ballNum = "0" + ballNum; //将0-9号码球转换为“01”两位数形式
			}
			checkNum = "num" + ballNum; //随机匹配生成的号码球类名
			if(i < 11) { //i为1-10表示第一排top=0
				syxwV.checkFun(checkNum, countLeft, 1);
				if(i >= 5 && i <= 10) {
					countLeft += 82;
				} else {
					countLeft += 80;
				}
			} else { //11-20表示第二排top=50
				if(flag) {
					countLeft = 87;
					flag = false;
				}
				syxwV.checkFun(checkNum, countLeft, 2);
				if(i >= 15 && i <= 20) {
					countLeft += 82;
				} else {
					countLeft += 80;
				}
			}

		}
	}

}
//生成一组开奖号码展示
syxwV.checkFun_Red = function(cla) {
	var objClass = $("." + cla);
	syxwV.redAnimate(objClass); //调动红球animate函数
}
//红球复位移动
syxwV.redAnimate = function(objClass) {
	$(objClass[1]).addClass("checkBall").animate({
		"top": "120px",
		"left": "7px"
	}, 500).animate({
		"top": "0px",
	}, 500);
}

//生成一组开奖号码展示
syxwV.checkFun = function(cla, countLeft, n) {
	var objClass = $("." + cla);
	if(n == 1) {
		syxwV.animateFun1(objClass, countLeft); //调动“第1排”号码球animate函数
	} else {
		syxwV.animateFun2(objClass, countLeft); ///调动“第2排”号码球animate函数			
	}
}
//第1排号码球复位移动
syxwV.animateFun1 = function(objClass, countLeft) {
	$(objClass[1]).addClass("checkBall").animate({
		"top": "120px",
		"left": countLeft + "px"
	}, 200).animate({
		"top": "0px",
	}, 200);
}
//第2排号码球复位移动
syxwV.animateFun2 = function(objClass, countLeft) {
	$(objClass[1]).addClass("checkBall").animate({
		"top": "120px",
		"left": countLeft + "px"
	}, 1000).animate({
		"top": "48px",
	}, 1000);
}

//模拟开奖完后，剩下号码top改变，球掉到最底部
syxwV.ballDown = function() {
	var ifCheck;
	var sjTop = 0;
	var liCpount = $("#kaiDiv .pipkai").find(".sonUl li");
	$(liCpount).each(function() {
		sjTop = 430 + createNum(-15, 35)
		ifCheck = $(this).hasClass("checkBall");
		if(!ifCheck) {
			$(this).animate({
				"top": sjTop + "px"
			})
		}
	});
}

//产生n-m之间的随机数
function createNum(min, max) {
	var Range = max - min;
	var Rand = Math.random();
	var re = (min + Math.round(Rand * Range));
	return re;
}
//播放背景音乐
function bgMusic() {
	//添加开奖音乐播放
	audioType = "b";
	syxwV.sound.play("audioidBg");
	syxwV.sound.stop("audioidKai");
}

//播放正在开奖音乐
function kaiMusic() {
	//添加开奖音乐播放
	audioType = "r";
	syxwV.sound.play("audioidKai");
	syxwV.sound.stop("audioidBg");
}

//生成去重的随机数组
syxwV.createArr = function() {
	var arr = [];
	for(var i = 0; i < 20; i++) {
		var a = createNum(1, 80);
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
//试试手气从号码球中抽取21个球组成放入数组中
syxwV.createTryArr = function(){
	var createTryArr;
	var rArr = [1,2,3,4,5,10];
	var rIndex = createNum(0,5);
	var redNum = rArr[rIndex];
	createTryArr = syxwV.createArr(); //一个20位随机数的数组，还需在追加一个红球号码【1.2.3.4.5.10】
	createTryArr.unshift(redNum);
	return createTryArr;
}
