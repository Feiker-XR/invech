$(function() {
	$(".eleAnimate").on("click", "#mnKai", function() {
		k3v.tryPlay();
		//		k3v.startGame(true);
	});
	$(".drawInfo").on("click", "#spanbtn", function() {
		var playa = function(){
			console.log(audioType);
			if(audioType=="b"){
				k3v.sound.play("audioidB");
				k3v.sound.stop("audioidR");
			}else{
				audioType=="r"
				k3v.sound.play("audioidR");
				k3v.sound.stop("audioidB");
			}
		}
		if($("#spanbtn").attr("class") == "soundsOn") {
			$("#spanbtn").removeClass("soundsOn").addClass("soundsOff");
			k3v.sound.stop("audioidB");
			k3v.sound.stop("audioidR");
		} else {
			$("#spanbtn").removeClass("soundsOff").addClass("soundsOn");
			playa();
		}
	});
	k3v.btnStyle();
})

var k3v = {},
	tryflag = true, //试试手
	timer = null, //试试手
	audioType = "b",
	firth11Load = true,
	ifopen = false,
	animateId = {};
var dataStr = {
	preDrawCode: [2, 4, 6, 4, 5],
	sumNum: 12,
	sumBigSmall: "小",
	sumSingleDouble: "单",
	drawIssue: "170517061",
	preDrawTime: "2017-05-17 18:40:00"
};
k3v.startGame = function(flag) {
	//操作号码
	var obj = this;
	obj.codePlay = function() {
		var li = $(".codeNum").find("li");
		obj.run(-154, 6, "0", li);
		obj.run(-1370, 4, "1", li);
		obj.run(-762, 10, "2", li);
		obj.run(-1522, 5, "3", li);
		obj.run(-2, 7, "4", li);
		/*obj.run(5, "80", "1", li);
		obj.run(8, "80", "2", li);*/
	}
	obj.run = function(num, space, id, li) {
		var interval = setInterval(function() {
			$(li).eq(id).css("backgroundPositionY", num + "px");
			num = num + space;
			if(num >= -2) {
				num = -1522;
			}
		}, space);
		animateId[id] = interval;
	}
	if(flag) {
		obj.codePlay();
	}
	$(".linelist").find("li").addClass("redli");
	//添加音乐播放
	k3v.sound.stop("audioidB");
	k3v.sound.play("audioidR");
	audioType = "r";
	k3v.bressBG(10); //呼吸动作
}
k3v.stopGame = function(arr,obj) {
	this.stop = function(i, arr) {
		if(obj=="1") {
			setTimeout(function() {
				clearInterval(animateId[i]);
				var li = $(".codeNum").find("li");
				$(li).eq(i).removeAttr("style");
				$(li).eq(i).removeClass().addClass("num" + arr);
				/*var y = $(li).eq(i).css("background-position-y").split("px")[0] * 1 + 20;
				$(li).eq(i).css({
					"background-position-y": y + "px"
				});
				$(li).eq(i).animate({
					"background-position-y": y - 20 + "px"
				});*/
			}, i * 400);
		} else if(obj=="2") {
			clearInterval(animateId[i]);
			var li = $(".codeNum").find("li");
			$(li).eq(i).removeAttr("style");
			$(li).eq(i).removeClass().addClass("num" + arr);
		}
	}
	for(var i = 0, len = 5; i < len; i++) {
		this.stop(i, arr[i]);
	}
	//添加音乐播放
	audioType = "b";
	k3v.sound.play("audioidB");
	k3v.sound.stop("audioidR");
}
//模拟开奖
var trytime = [];
//点击完成样式事件
k3v.btnStyle = function() {
	$(".animate").on("mousedown", "#mnKai", function() {
		$("#mnKai").addClass("mnKaiD");
	});
	$(".animate").on("mouseup", "#mnKai", function() {
		$("#mnKai").removeClass("mnKaiD");
	});
}
k3v.tryPlay = function() {
	var arr = [],
		videoB = $(".animate");
	if(tryflag) {
		$(videoB).find("#opening").text("模拟开奖中...");
		$(".noinfor").text("模拟中...");
		$("#hourtxt").hide();
		$("#opening").show();
		tryflag = false;
		k3v.startGame(true);
		var time1 = setTimeout(function() {
			for(var i = 0; i < 5; i++) {
				arr.push(Math.round(Math.random() * 5 + 1));
			}
			k3v.stopGame(arr,"1");
			var time3 = null;
			$("#hourtxt").fadeIn();
			$("#opening").hide();
			if(animateId["bressBG"] != undefined) {
				clearInterval(animateId["bressBG"]);
				$(".manPic").find("span").eq(0).removeClass().addClass("manll");
				$(".manPic").find("span").eq(1).removeClass().addClass("manrl");
			}
			var time2 = setTimeout(function() {
				var codetop = $(".codeArr").find("li");
				var resultArr = [];
				for(var i = 0; i < 5; i++) {
					resultArr.push($(codetop).eq(i).attr("class").split("code")[1]);
				}
				k3v.stopGame(resultArr, "2");
				time3 = setTimeout(function() {
					tryflag = true;
				}, 2000)
				trytime.push(time3);
			}, 8000);
			trytime.push(time1);
			trytime.push(time2);
		}, 5000);
	} else {
		$(".noinfor").fadeIn(200, "", function() {
			setTimeout(function() {
				$(".noinfor").fadeOut("300");
			}, 1000)
		});

	}
}
//倒计时完成启动动画
k3v.playGame = function() {
	$("#opening").text("正在开奖...");
	$("#hourtxt").hide();
	$("#opening").show();
	k3v.startGame(true);
}
//停止开奖时更新数据
k3v.updateData = function(data) {
	$("#drawIssue").text(data.drawIssue);
	$("#drawTime").text(data.drawTime);
	$(data.preDrawCode).each(function(i) {
		$(".codeArr").find("li").eq(i).removeClass().addClass("code" + this);
	});
	$(".codeArr").find("li").eq(5).find("span").eq(0).text(data.sumNum);
	$(".codeArr").find("li").eq(5).find("span").eq(1).text(data.sumBigSmall);
	$(".codeArr").find("li").eq(5).find("span").eq(2).text(data.sumSingleDouble);
}
//倒计时
//倒计时
k3v.cutTime = function(sys_second) {
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
			html = (hour < 10 ? ("0" + hour) : hour) + ":";
			html = html + "" + (minute < 10 ? ("0" + minute) : minute) + ":" + (second < 10 ? ("0" + second) : second);
			$("#hourtxt").text(html); //计算小时
			if(sys_second < 10) {
				var lilist = $(".linelist").find("li");
				$(lilist).eq(sys_second).addClass("redli");
			}
			if(sys_second < 20) {
				tryflag = false;
				$(".noinfor").text("即将开奖，禁止模拟");
			}
		} else {
			$(".noinfor").text("正在开奖，禁止模拟");
			clearInterval(timer); //清除当前定时器
			k3v.playGame();
		}
	}, 1000);
}
k3v.clearTime = function(){
	clearInterval(timer);
}
k3v.startVideo = function(data) {
	k3v.sound.stop("audioidB");
	k3v.sound.play("audioidR");
	audioType = "r";
	k3v.updateData(data);
	k3v.stopGame(data.preDrawCode, "2");
	//启动数据
	//k3v.updateData(data);
	k3v.cutTime(k3v.getSecond(data.preDrawTime));
	setTimeout(function() {
		$(".animate").find(".loading").fadeOut();
		firth11Load = false;
	}, 1000)
}
k3v.getSecond = function(preDrawTime){
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
k3v.sound = {
	play: function(id) {
		if($("#spanbtn").attr("class") == "soundsOn" && ifopen) {
			document.getElementById(id).play();
		}
	},
	stop: function(id) {
		document.getElementById(id).pause();
	}
}
//停止动画
k3v.stopVideo = function(data) {
	//dataStr为模拟数据
	//终止游戏传入开奖号码
	k3v.stopGame(data.preDrawCode,1);
	setTimeout(function(){
		k3v.cutTime(k3v.getSecond(data.preDrawTime));
		tryflag = true;
	},1000);
	//更新数据
	k3v.updateData(data);
	$("#hourtxt").fadeIn();
	$("#opening").hide();
	if(animateId["bressBG"] != undefined) {
		clearInterval(animateId["bressBG"]);
		$(".manPic").find("span").eq(0).removeClass().addClass("manll");
		$(".manPic").find("span").eq(1).removeClass().addClass("manrl");
	}
}
k3v.bressBG = function(space) {
	var opacityV = 1,
		flag = false;
	if(animateId["bressBG"] != undefined) {
		clearInterval(animateId["bressBG"]);
	}
	var timesetInterval = setInterval(function() {
		$(".bodybg").find("img").css({
			opacity: opacityV
		});
		if(flag) {
			opacityV = 0;
			$(".manPic").find("span").eq(0).removeClass("manll").addClass("manlr");
			$(".manPic").find("span").eq(1).removeClass("manrr").addClass("manrl");
			flag = false;
		} else {
			opacityV = 1;
			$(".manPic").find("span").eq(1).removeClass("manrl").addClass("manrr");
			$(".manPic").find("span").eq(0).removeClass("manlr").addClass("manll");
			flag = true;
		}
	}, 200);
	animateId["bressBG"] = timesetInterval;
}