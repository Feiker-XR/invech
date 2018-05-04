$(function() {
	videoTools.createNum();
	setTimeout(function() {
		setTimeout(function() {
			$(".loading").fadeOut(600);
		}, 100);
	}, 200);
	$(".menubox").on("click", ".tyrbtn", function() {
		var id = $(this).attr("id");
		if(id) {} else {
			$(this).attr("id", "true");
			animate.sscAnimate("#numBig");
			videoTools.testOpen();
		}
	});
	$(".menubox").on("click", ".soundbtn", function() {
		if($(this).hasClass("closesoundbtn")) {
			$(this).removeClass("closesoundbtn");
			var audio = $("audio")
			if($(".oping ").is(":hidden")) {
				if(videoTools.ifsund() && ifopen) {
					$("#bgsound").attr("src", "sound/bg.mp3");
					videoTools.sounds.soundsT.play("bgsound");
				}
			} else {
				if(videoTools.ifsund() && ifopen) {
					$("#bgsound").attr("src", "sound/opening.mp3");
					videoTools.sounds.soundsT.play("bgsound");
				}
			}
		} else {
			$(this).addClass("closesoundbtn");
			$("#bgsound").attr("src", "");
		}
	});
	//初始化数据
	$(".djs").show();
	var $regularlyItems = $(".codeboxl .perspectiveView");
	/*$regularlyItems.hover(function() {
		var _$this = $(this);
		_$this.children(".flip").eq(1).addClass("out").removeClass("in");
		setTimeout(function() {
			_$this.find(".flip").show().eq(0).addClass("in").removeClass("out");
			_$this.children(".flip").eq(1).hide();
		}, 225);
	}, function() {
		var _$this = $(this);
		_$this.children(".flip").eq(0).addClass("out").removeClass("in");
		setTimeout(function() {
			_$this.find(".flip").show().eq(1).addClass("in").removeClass("out");
			_$this.children(".flip").eq(0).hide();
		}, 225);
	});*/

});

function sscAnimateEnd(data) {
	if(ifopen) {
		animate.sscAnimateEnd(data.preDrawCode, data.id, data.counttime, false);
		videoTools.inseartData(data);
		datestr = data.counttime; //得到时间
		preDrawCode = data.preDrawCode; //得到时间
	}
}
var animate = {},
	datestr = "",
	timerInterval = "",
	ifopen = false,
	preDrawCode = "",
	animateID = [],
	videoTools = {};
animate.sscAnimate = function(id) {
	clearInterval(animateID[id]);
	//播放背景声音
	if(videoTools.ifsund() && ifopen) {
		$("#bgsound").attr("src", "sound/opening.mp3");
		videoTools.sounds.soundsT.play("bgsound");
	}
	//传入要执行动画的ID
	var intervalSsc = setInterval(function() {
		var spanobj = $(id).find(".box");
		var lilength = $(spanobj).find("span").length;
		for(var i = 0; i < lilength; i++) {
			$(spanobj).find("span").eq(i).removeClass().addClass("num" + $(spanobj).find("span").eq(i).text());
			//还原上次的定位
			$(spanobj).find("span").eq(i).css({
				backgroundPositionY: "0",
				backgroundPositionX: "0",
				backgroundSize: "100%"
			});
			//为li产生随机数字
			//追加动画
			var runspac = videoTools.excutenum();
			$(spanobj).find("span").eq(i).stop().animate({
				backgroundPositionY: '-30',
				backgroundPositionX: '67px',
				backgroundSize: "50%"
			}, runspac * 50 == "0" ? "100" : runspac * 50);
			$(spanobj).find("span").eq(i).text(videoTools.excutenum());
		}
	}, 100);
	//开始翻转
	var regularlyItems = $(".codeboxl .perspectiveView");
	$(regularlyItems).each(function(i) {
		videoTools.xz3D(regularlyItems[i], false);
	});
	//显示开奖中
	$(".oping").show();
	$(".djs").hide();
	//记录动画的ID
	animateID[id] = intervalSsc;
}
//球填充数据终极动画
animate.sscAnimateEnd = function(num, id, counttime, type) {
	if(!ifopen) {
		return;
	}
	//播放背景声音
	if(videoTools.ifsund() && ifopen) {
		$("#bgsound").attr("src", "sound/over.mp3");
		videoTools.sounds.soundsT.play("bgsound");
	}
	clearInterval(animateID[id]);
	var spanobj = $(id).find(".box");
	//显示开奖中
	$(".oping").hide();
	$(".djs").show();
	var spanObj = [];
	$(spanobj).each(function(i) {
		$(this).find("span").text("");
		$(this).find("span").removeClass().addClass("num" + num[i]);
		spanObj.push($(this).find("span"));
	});
	videoTools.showNUM(spanObj, num);

	//启动倒计时
	if(!type) {
		videoTools.cutTime(counttime);
	}
}
videoTools.excutenum = function() {
	var j = Math.floor(Math.random() * 10); //得到0到9的随机数
	//var j = Math.ceil(Math.random()*10);//得到0到10的随机数
	return j;
}
videoTools.xz3D = function(obj, flag) {
	var obj = $(obj);
	if(flag) {
		$(obj).children(".flip").eq(0).addClass("out").removeClass("in");
		setTimeout(function() {
			$(obj).find(".flip").show().eq(1).addClass("in").removeClass("out");
			$(obj).children(".flip").eq(0).hide();
		}, 225);
	} else {
		$(obj).children(".flip").eq(1).addClass("out").removeClass("in");
		setTimeout(function() {
			$(obj).find(".flip").show().eq(0).addClass("in").removeClass("out");
			$(obj).children(".flip").eq(1).hide();
		}, 225);
	}
}

videoTools.showNUM = function(obj, num) {
	var tl = $(".tl .perspectiveView");
	var bl = $(".bl .perspectiveView");
	var anmiate = function(obj) {
		$(obj).css({
			backgroundPositionY: '28px',
			backgroundPositionX: '26px',
			backgroundSize: "10%"
		});
		$(obj).stop().animate({
			backgroundPositionY: '-18px',
			backgroundPositionX: '-16px',
			backgroundSize: "150%"
		}, 200, function() {
			$(obj).stop().animate({
				backgroundPositionY: '0',
				backgroundPositionX: '0',
				backgroundSize: "100%"
			}, 200);
		});

	}
	for(var i = 0, time = 0; i < 5; i++) {
		time += 150;
		if(i >= 4) {
			var count = 0;
		}
		setTimeout(function() {
			anmiate(obj[count]);
			videoTools.xz3D(tl[count], true);
			videoTools.xz3D(bl[count], true);
			count++;
		}, time);
	}
	setTimeout(function() {
		if(videoTools.ifsund() && ifopen) {
			$("#bgsound").attr("src", "sound/bg.mp3");
			setTimeout(videoTools.sounds.soundsT.play("bgsound"), 1000);
		}
	}, 2800);
	$(".tl").find(".box").each(function(i) {
		var numstr = '';
		var ifex = $(this).find("span").eq(1).attr("class");
		if(num[i] >= 5) {
			numstr = "bigbg";
			if(ifex.indexOf(numstr) != -1) {} else {
				ifex = ifex.replace("smallbg", numstr);
			}
		} else {
			numstr = "smallbg";
			if(ifex.indexOf(numstr) != -1) {} else {
				ifex = ifex.replace("bigbg", numstr);
			}
		}
		$(this).find("span").eq(1).removeAttr("class").attr("class", ifex);
	});
	$(".bl").find(".box").each(function(i) {
		var numstr = '';
		var ifex = $(this).find("span").eq(1).attr("class");
		if(num[i] % 2 == 0) {
			numstr = "doublebg";
			if(ifex.indexOf(numstr) != -1) {} else {
				ifex = ifex.replace("singlebg", numstr);
			}
		} else {
			numstr = "singlebg";
			if(ifex.indexOf(numstr) != -1) {} else {
				ifex = ifex.replace("doublebg", numstr);
			}
		}
		$(this).find("span").eq(1).removeAttr("class").attr("class", ifex);
	});
}
videoTools.sounds = {
	//声音控制
	soundsT: {
		play: function(obj) {
			if(videoTools.ifsund() && ifopen) {
				var sundT = $("#" + obj).attr("src");
				if(sundT == "sound/over.mp3") {
					$("#" + obj).removeAttr("loop", "loop");
				} else {
					$("#" + obj).attr("loop", "loop");
				}
				document.getElementById(obj).play();
			}
		},
		stop: function(obj) {
			document.getElementById(obj).pause();
		}
	}
}
//倒计时
videoTools.cutTime = function(counttime) {
	var sys_second = counttime;
	clearInterval(animateID["timer"]); //清除当前定时器
	timerInterval = setInterval(function() {
		if(sys_second >= 1) {
			sys_second -= 1;
			//var day = Math.floor((sys_second / 3600) / 24);
			var hour = Math.floor(sys_second / (60 * 60));
			var minute = Math.floor((sys_second / (60)) % 60);
			var second = Math.floor((sys_second) % 60);
			var html = "";
			//如果时间小于0则删除时间显示
			if(hour <= 0) {
				html = "";
			} else {
				html = (hour < 10 ? ("0" + hour) : hour) + ":";
			}
			html = html + "" + (minute < 10 ? ("0" + minute) : minute) + ":" + (second < 10 ? ("0" + second) : second);
			$(".bluefont").text(html); //计算小时
		} else {
			clearInterval(timerInterval); //清除当前定时器
			if(ifopen) {
				animate.sscAnimate("#numBig");
			}
		}
	}, 1000);
	animateID["timer"] = timerInterval;
}
videoTools.inseartData = function(data) {
	$("#preDrawIssue").text(data.preDrawIssue);
	$("#drawTime").text(data.drawTime);
	$("#sumNum").text(data.sumNum);
	$("#sumSingleDouble").text(data.sumSingleDouble);
	$("#sumBigSmall").text(data.sumBigSmall);
	$("#dragonTiger").text(data.dragonTiger);
	$("#litNum").find(".box").each(function(i) {
		$(this).find("span").removeClass().addClass("num" + data.preDrawCode[i]);
	});
}
videoTools.createNum = function() {
	var arr = [];
	for(var i = 0; i < 5; i++) {
		arr.push(((Math.random() * 9) + "").split(".")[0]);
	}
	return arr;
}
videoTools.testOpen = function() {
	var i = 0;
	var interval = setInterval(function() {
		i++;
		if(i >= 8) {
			clearInterval(interval);
			animate.sscAnimateEnd(videoTools.createNum(), "#numBig", datestr, true);
			setTimeout(function() {
				setTimeout(function() {
					animate.sscAnimateEnd(preDrawCode, "#numBig", datestr, true);
					$(".menubox .tyrbtn").removeAttr("id");
				}, 100);
			}, 8000);
		}
	}, 1000);
}
videoTools.clearInterval = function() {
	clearInterval(timerInterval);
}
videoTools.ifsund = function() {
	var flag = null;
	//返回true为开启声音
	if($("#soundbtn").hasClass("closesoundbtn")) {
		flag = false;
	} else {
		flag = true;
	}
	console.log("flag："+flag);
	return flag
}

function stopSound(obj) {
	videoTools.sounds.soundsT.stop(obj);
}