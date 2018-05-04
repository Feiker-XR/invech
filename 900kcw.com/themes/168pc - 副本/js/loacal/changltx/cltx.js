$(function() {
	cltxmethod.start();
})
var cltxmethod = {};
cltxmethod.start = function() {
	var path = window.location.href; //获取url
	if(path.split("?")[1] == undefined) {
		return;
	}
	var lotCode = path.split("?")[1]; //得到lotCode
	var rank = path.split("?")[2]; //得到type
	var type = path.split("?")[3]; //得到type
	//PK10系列
	$("#box" + cltxmethod.getBoxId(lotCode, rank, type)).show().siblings().hide();
}
cltxmethod.getBoxId = function(lotCode, rank, type) {
	console.log(JSON.stringify(zhmssxmc));
	zhmssxlz = [];
	zhmssxmc = [];
	zhmssxmc.push(rank);
	//pk10系列
	if(lotCode == "10001") {
		$($("#zhms").find(".sinli")).each(function(index) {
			if($(this).hasClass("checked")) {
				var btnRank = $(this).find("i").text();
				if(btnRank != rank) {
					$(this).removeClass("checked");
				}
			}
		});
		if(type == "1" || type == "2") {
			$("#zhms .zhmslz").find(".lztype").eq(1).addClass().siblings().removeClass("checked");
			zhmssxlz.push(1);
			return rank + "" + 1;
		} else if(type == "3" || type == "4") {
			$("#zhms .zhmslz").find(".lztype").eq(0).addClass().siblings().removeClass("checked");
			zhmssxlz.push(2);
			return rank + "" + 2;
		} else if(type == "5" || type == "6") {
			$("#zhms .zhmslz").find(".lztype").eq(2).addClass().siblings().removeClass("checked");
			zhmssxlz.push(3);
			return rank + "" + 3;
		}
		//时时彩系统
	} else if(lotCode == "10002"||lotCode == "10004"||lotCode == "10003") {
		$($("#zhms").find(".sinli")).each(function(index) {
			if($(this).hasClass("checked")) {
				var btnRank = $(this).find("i").text();
				if(btnRank != rank) {
					if(rank=="11") {//当为总和是
						zhmssxmc = [];
						zhmssxmc.push("6");
						rank=6;
						if(btnRank!="6"){
							$(this).removeClass("checked");
						}
					}else{
						$(this).removeClass("checked");
					}
				}
			}
		});
		if(type == "1" || type == "2") {
			$("#zhms .zhmslz").find(".lztype").eq(1).addClass().siblings().removeClass("checked");
			zhmssxlz.push(1);
			return rank + "" + 1;
		} else if(type == "3" || type == "4") {
			$("#zhms .zhmslz").find(".lztype").eq(0).addClass().siblings().removeClass("checked");
			zhmssxlz.push(2);
			return rank + "" + 2;
		} else if(type == "5" || type == "6" || type == "7") {
			$("#zhms .zhmslz").find(".lztype").eq(2).addClass().siblings().removeClass("checked");
			zhmssxlz.push(3);
			return "123";
		}
		//广东快乐时分系列
	} else if(lotCode == "10005"||lotCode=="10009") {
		$($("#zhms").find(".sinli")).each(function(index) {
			if($(this).hasClass("checked")) {
				var btnRank = $(this).find("i").text();
				if(btnRank != rank) {
					if(rank=="11") {//当为总和是
						zhmssxmc = [];
						zhmssxmc.push("6");
						rank=9;
						if(btnRank!="6"){
							$(this).removeClass("checked");
						}
					}else{
						$(this).removeClass("checked");
					}
				}
			}
		});
		if(type == "1" || type == "2"|| type == "11") {
			$("#zhms .zhmslz").find(".lztype").eq(1).addClass().siblings().removeClass("checked");
			zhmssxlz.push(1);
			return rank + "" + 1;
		} else if(type == "3" || type == "4") {
			$("#zhms .zhmslz").find(".lztype").eq(0).addClass().siblings().removeClass("checked");
			zhmssxlz.push(2);
			return rank + "" + 2;
		} else if(type == "5" || type == "6") {
			$("#zhms .zhmslz").find(".lztype").eq(2).addClass().siblings().removeClass("checked");
			zhmssxlz.push(3);
			return rank+"3";
		}else if(type == "8"||type == "7"){
			$("#zhms .zhmslz").find(".lztype").eq(3).addClass().siblings().removeClass("checked");
			zhmssxlz.push(4);
			return rank+"4";
		}else if(type == "9"||type == "10"){
			$("#zhms .zhmslz").find(".lztype").eq(4).addClass().siblings().removeClass("checked");
			zhmssxlz.push(5);
			return rank+"5";
		}
		//广西快乐十分
	} else if(lotCode=="10038") {
		$($("#zhms").find(".sinli")).each(function(index) {
			if($(this).hasClass("checked")) {
				var btnRank = $(this).find("i").text();
				if(btnRank != rank) {
					if(rank=="11") {//当为总和是
						zhmssxmc = [];
						zhmssxmc.push("6");
						rank=6;
						if(btnRank!="6"){
							$(this).removeClass("checked");
						}
					}else{
						$(this).removeClass("checked");
					}
				}
			}
		});
		if(type == "1" || type == "2") {
			$("#zhms .zhmslz").find(".lztype").eq(0).addClass().siblings().removeClass("checked");
			zhmssxlz.push(1);
			return rank + "" + 1;
		} else if(type == "3" || type == "4") {
			$("#zhms .zhmslz").find(".lztype").eq(1).addClass().siblings().removeClass("checked");
			zhmssxlz.push(2);
			return rank + "" + 2;
		}else if(type == "5"||type == "6") {
			$("#zhms .zhmslz").find(".lztype").eq(4).addClass().siblings().removeClass("checked");
			zhmssxlz.push(5);
			return rank + "" + 5;
		}else if(type == "7" || type == "8") {
			$("#zhms .zhmslz").find(".lztype").eq(2).addClass().siblings().removeClass("checked");
			zhmssxlz.push(3);
			return rank + "" + 3;
		} else if(type == "9"||type == "10") {
			$("#zhms .zhmslz").find(".lztype").eq(3).addClass().siblings().removeClass("checked");
			zhmssxlz.push(4);
			return rank + "4";
		} else if(type == "11") {
			$("#zhms .zhmslz").find(".lztype").eq(1).addClass().siblings().removeClass("checked");
			zhmssxlz.push(2);
			return rank + "2";
		}
	} else if(lotCode=="10008"||lotCode=="10006") {
		$($("#zhms").find(".sinli")).each(function(index) {
			if($(this).hasClass("checked")) {
				var btnRank = $(this).find("i").text();
				if(btnRank != rank) {
					if(rank=="11") {//当为总和是
						zhmssxmc = [];
						zhmssxmc.push("6");
						rank=6;
						if(btnRank!="6"){
							$(this).removeClass("checked");
						}
					}else{
						$(this).removeClass("checked");
					}
				}
			}
		});
		if(type == "1" || type == "2") {
			$("#zhms .zhmslz").find(".lztype").eq(1).addClass().siblings().removeClass("checked");
			zhmssxlz.push(1);
			return rank + "" + 1;
		} else if(type == "3" || type == "4") {
			$("#zhms .zhmslz").find(".lztype").eq(0).addClass().siblings().removeClass("checked");
			zhmssxlz.push(2);
			return rank + "" + 2;
		}else if(type == "5") {
			$("#zhms .zhmslz").find(".lztype").eq(0).addClass().siblings().removeClass("checked");
			zhmssxlz.push(2);
			return rank + "" + 2;
		}else if(type == "6") {
			$("#zhms .zhmslz").find(".lztype").eq(2).addClass().siblings().removeClass("checked");
			zhmssxlz.push(3);
			return rank + "" + 3;
		}else if(type == "7" || type == "8") {
			$("#zhms .zhmslz").find(".lztype").eq(2).addClass().siblings().removeClass("checked");
			zhmssxlz.push(3);
			return rank + "" + 3;
		} else if(type == "9"||type == "10") {
			$("#zhms .zhmslz").find(".lztype").eq(3).addClass().siblings().removeClass("checked");
			zhmssxlz.push(4);
			return rank + "4";
		} else if(type == "11") {
			$("#zhms .zhmslz").find(".lztype").eq(1).addClass().siblings().removeClass("checked");
			zhmssxlz.push(2);
			return rank + "2";
		}
	}else if(lotCode=="10014"){
		$($("#dxms").find(".sinli")).each(function(index) {
			if($(this).hasClass("selected")) {
				var btnRank = $(this).find("i").text();
				if(btnRank != rank) {
					if(rank=="11") {//当为总和是
						zhmssxmc = [];
						zhmssxmc.push("6");
						rank=6;
						if(btnRank!="6"){
							$(this).removeClass("selected");
						}
					}else{
						$(this).removeClass("selected");
					}
				}
			}
		});
		if(type == "1" || type == "2") {
			$("#dxms").find(".sinli").eq(1).addClass("selected").siblings().removeClass("selected");
			zhmssxlz.push(1);
			return 11;
		} else if(type == "3" || type == "4"|| type == "5") {
			$("#dxms").find(".sinli").eq(0).addClass("selected").siblings().removeClass("selected");
			zhmssxlz.push(2);
			return 01;
		} else if(type == "6"|| type == "7"|| type == "8") {
			$("#dxms").find(".sinli").eq(4).addClass("selected").siblings().removeClass("selected");
			zhmssxlz.push(4);
			return 41;
		}else if(type == "9" || type == "10"|| type == "11") {
			$("#dxms").find(".sinli").eq(3).addClass("selected").siblings().removeClass("selected");
			zhmssxlz.push(3);
			return 31;
		} else if(type == "12"||type == "13"||type == "14"||type == "15"||type == "16") {
			$("#dxms").find(".sinli").eq(2).addClass("selected").siblings().removeClass("selected");
			zhmssxlz.push(4);
			return 21;
		} else if(type == "17"|| type == "18"|| type == "19"|| type == "20"|| type == "21") {
			$("#dxms").find(".sinli").eq(5).addClass("selected").siblings().removeClass("selected");
			zhmssxlz.push(2);
			return 51;
		}
	
	}
}