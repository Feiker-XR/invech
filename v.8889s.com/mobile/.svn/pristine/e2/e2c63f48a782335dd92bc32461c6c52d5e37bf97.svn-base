//{{{ 通用复制函数
function CopyToClipboard(meintext, cb) {
	if (window.clipboardData) {
		window.clipboardData.setData("Text", meintext);
	} else if (window.netscape) {
		netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
		var clip = Components.classes['@mozilla.org/widget/clipboard;1']
			.createInstance(Components.interfaces.nsIClipboard);
		if (!clip) return;
		var trans = Components.classes['@mozilla.org/widget/transferable;1']
			.createInstance(Components.interfaces.nsITransferable);
		if (!trans) return;
		trans.addDataFlavor('text/unicode');
		var str = new Object();
		var len = new Object();
		var str = Components.classes["@mozilla.org/supports-string;1"]
			.createInstance(Components.interfaces.nsISupportsString);
		var copytext = meintext;
		str.data = copytext;
		trans.setTransferData("text/unicode", str, copytext.length * 2);
		var clipid = Components.interfaces.nsIClipboard;
		if (!clip) return false;
		clip.setData(trans, null, clipid.kGlobalClipboard);
	} else {
		return false;
	}
	if(typeof cb=='function'){
		return cb(meintext);
	}else{
		return true;
	}
}
function userCoinBeforeSubmitCode(){
	if(this.coin.value<=0) throw('金额必须大于0');
}
function userCoinSubmitCode(err, data){
	if(err){
		winjinAlert(err,"err");
	}else{
		location.reload();
	}
}
function showBetInfo(id){
	$.get('/index.php/record/betInfo/'+id, function(data){
		$(data).dialog({
			title:'投注信息',
			width:300,
			buttons:{
				"关闭":function(){
					$(this).dialog("destroy");
				}
			}
		});
	});
}
function closekjtip(){
	$("#alert_close_button").click();
}
function wait(){
	layer.open({
                type:2,
                content:'购买中....',
                shadeClose:false
            })
			
}
function destroyWait(){
	layer.closeAll();
}
function defaultModalCloase(event, ui){
	$(this).dialog('destroy');
}
function dataAddCode(){
	$('form', this).trigger('submit');
}
function newcode(code_arr){
	var _html='';
	if(game.type==20||game.type==65||game.type==66){ //pk10开奖动画
		$.each(code_arr,function(index,value){
			_html += "<li class=''><span></span></li>";
		});
			$("#num").removeClass().addClass("pk10_ul").empty().html(_html);
			$("#num li").each(function(index){
			var num = $(this);
			num.removeClass().addClass("car" + code_arr[index]).hide();
			window.setTimeout(function(){
				num.fadeIn();
			},100+index*200);
		});
	}else if(game.type==34 || game.type==77){
		code_arr.splice(6,0,'-');
		$.each(code_arr,function(index,value){
			_html += "<li><span>-</span></li>";
		});
		$("#num").addClass("lhc").empty().html(_html).css({'width': 92+code_arr.length + "%"});
		$("#num li").each(function(index){
			var num = $(this);
			var color='';
			var a=['01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46'];
			var b=['03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48'];
			var c=['05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49'];
			if(in_array(code_arr[index], a)){
				color='red';
			}else if(in_array(code_arr[index], b)){
				color='blue';
			}else if(in_array(code_arr[index], c)){
				color='green';
			}else{
				color='and';
			}
			num.removeClass().addClass(color);
			setTimeout(function(){
				num.animate({top: "39px"},100, function() {
					num.html('<span>'+code_arr[0]+'</span><span>'+code_arr[1]+'</span><span>'+code_arr[2]+'</span><span>'+code_arr[3]+'</span><span>'+code_arr[4]+'</span><span>'+code_arr[5]+'</span><span>'+code_arr[6]+'</span><span>'+code_arr[7]+'</span>');
					num.animate({top: "39px"}, 200, function(){
						if(index!=6){
							num.html("<span>" + code_arr[index] + "</span>");
						} else {
							num.html("<span>and</span>");
						}
						num.css("top","-39px");
						num.animate({top: "0px"}, 100);
					});
				});
			}, 100+index*200);
		});
	}else{
		$.each(code_arr,function(index,value){
			_html += "<li><span>-</span></li>";
		});
		$("#num").empty().html(_html).css({'width': 95+code_arr.length + "%"});//时时彩开奖动画位置	
		$("#num li").each(function(index){
			var num = $(this).children('span');
			setTimeout(function(){
				num.animate({top: "39px"},100, function() {
					num.html('<p>'+code_arr[0]+'</p><p>'+code_arr[1]+'</p><p>'+code_arr[2]+'</p><p>'+code_arr[3]+'</p><p>'+code_arr[4]+'</p>');
					num.css("top","-195px");
					num.animate({top: "39px"}, 600, function(){ 
						num.html(code_arr[index]);
						num.css("top","-39px");
						num.animate({top: "0px"}, 100);
					});
				});
			}, 400+index*300);
		});
	}
}
function codeplay(code_arr){
	var _html='';
	if(game.type==20|| game.type==61|| game.type==73|| game.type==74|| game.type==71|| game.type==72||game.type==78|| game.type==65||game.type==66){//正在开奖中彩球大小
		if(code_arr.length==20||code_arr.length==65||code_arr.length==66){
			var code_arr=strCut(code_arr, 2);
			$.each(code_arr,function(index,value){
				_html += "<li class=''><span></span></li>";
			});
			$("#num").addClass("pk10_ul").empty().html(_html);
			$("#num li").each(function(index){
				var num = $(this);
				num.removeClass().addClass("car" + code_arr[index]).hide();
				window.setTimeout(function(){
					num.fadeIn();
				},100+index*200);
			});
		}else{
			var code_arr=code_arr.split('');
			$.each(code_arr,function(index,value){
				_html += "<li><span>-</span></li>";
			});
			$("#num").removeClass().addClass("pk10_ul_line").empty().html(_html);

			$("#num").empty().html(_html).css({'width': 95+code_arr.length + "%"});//PK10 快乐十分彩球位置
			$("#num li").each(function(index){
				var num = $(this);
				num.animate({ 
					top:"50px"
				},100+index*50,function(){ 
					num.html('<span>' + code_arr[index] + '</span>');
					num.css("top","-50px");
					num.animate({ 
						top:"0"
					},1000+index*200,"easeOutBounce");
				});
			});
		}
	}else if(game.type==6 || game.type==7 || game.type==16){
		if(code_arr.length==10){
			var code_arr=strCut(code_arr, 2);
		}else{
			var code_arr=code_arr.split('');
		}
		$.each(code_arr,function(index,value){
			_html += "<li><span>-</span></li>";
		});
		$("#num").empty().html(_html).css({'width': 95+code_arr.length + "%"});
		$("#num li").each(function(index){
			var num = $(this);
			num.animate({ 
				top:"50px"
			},100+index*50,function(){ 
				num.html('<span>' + code_arr[index] + '</span>');
				num.css("top","-50px");
				num.animate({ 
					top:"0"
				},1000+index*200,"easeOutBounce");
			});
		});
	}else if(game.type==34 ||  game.type==77){
		if(code_arr.length==14){
			var code_arr=strCut(code_arr, 2);
		}else{
			var code_arr=code_arr.split('');
		}
		if(code_arr.length==7){
			code_arr.splice(6,0,'-');
			$.each(code_arr,function(index,value){
				_html += "<li><span>-</span></li>";
			});
			$("#num").addClass("lhc").empty().html(_html).css({'width': 44*code_arr.length + "px"});//正在开奖彩球位置
		}else{
			$.each(code_arr,function(index,value){
				_html += "<li><span>-</span></li>";
			});
			$("#num").removeClass("lhc").empty().html(_html).css({'width': 95+code_arr.length + "%"});//正在开奖彩球位置
		}
		$("#num li").each(function(index){
			var num = $(this);
			if(code_arr.length==8){
				var color='';
				var a=['01','02','07','08','12','13','18','19','23','24','29','30','34','35','40','45','46'];
				var b=['03','04','09','10','14','15','20','25','26','31','36','37','41','42','47','48'];
				var c=['05','06','11','16','17','21','22','27','28','32','33','38','39','43','44','49'];
				if(in_array(code_arr[index], a)){
					color='red';
				}else if(in_array(code_arr[index], b)){
					color='blue';
				}else if(in_array(code_arr[index], c)){
					color='green';
				}else{
					color='and';
				}
				num.removeClass().addClass(color);
			}
			num.animate({ 
				top:"50px"
			},100+index*50,function(){
				num.html('<span>' + code_arr[index] + '</span>');
				num.css("top","-50px");
				num.animate({ 
					top:"0"
				},1000+index*200,"easeOutBounce");
			});
		});
	}else{
		var code_arr=code_arr.split('');
		$.each(code_arr,function(index,value){
			_html += "<li><span>-</span></li>";
		});
		$("#num").empty().html(_html).css({'width': 95+code_arr.length + "%"});//重庆彩开奖位置
		$("#num li").each(function(index){
			var num = $(this);
			num.animate({ 
				top:"50px"
			},100+index*50,function(){ 
				num.html('<span>' + code_arr[index] + '</span>');
				num.css("top","-50px");
				num.animate({ 
					top:"0"
				},1000+index*200,"easeOutBounce");
			});
		});
	}
}

function in_array(needle,haystack) {
	var n=haystack.length;
	for(var i=0;i<n;i++){
	  if(haystack[i]==needle) return true;
	}
	return false;
}
//{{{ 开奖相关函数
var T,S,KT,KS,TIPS;
function gameKanJiangDataC(diffTime, actionNo){
	var $dom=$('#sur-times');
	var thisNo=$('.thisno').html();
	
	var tH,tM,tS;
	var timeStr='<b></span>';
	var timeStr_new='{@hour1}{@hour2}:{@min1}{@min2}:{@sec1}{@sec2}';
	
	TIPS='本期['+thisNo+']已截至投注';
	if(diffTime<=0){
		if(game.type==20|| game.type==65|| game.type==66) $('#num').removeClass("pk10_ul");
		codeplay('正在封单中');
		$('#btnaddBet').unbind('click');
		$('#btnaddBet').bind('click', function(){
			winjinAlert(TIPS);
		});
		if(S){
			winjinAlert('当期销售已截止，请进入下一期购买。');
			$(".layui-m-layerbtn span").html("(5) 确定");
			
			var second = 4;
			timer5 = window.setTimeout(timeFun5,1000);
			
			function timeFun5(){
				$(".layui-m-layerbtn span").html("(" + second + ") 确定");
				second--;
				if(second < 0){
					if($("#JS_blockOverlay").length == 1 && $("#JS_blockPage").length == 1){
						$("#JS_blockOverlay").remove();
						$("#JS_blockPage").remove();
					}
					clearTimeout(timer5);
					layer.closeAll();
				}else{
					timer5 = window.setTimeout(timeFun5,1000);
				}
			}
		
		}
	

			if($.browser.msie){
				setTimeout(function(){
					gameFreshOrdered();
					$('#btnPostBet').unbind('click');
					$('#btnPostBet').bind('click',gamePostCode);
					if((typeof $('#wanjinDialog').dialog("isOpen")=='object') || $('#wanjinDialog').dialog('isOpen')){
						$('#wanjinDialog').dialog('close');
					}
					gameFreshTimer();

					}, 3000);
			}else{
				setTimeout(function xx(a){
					gameFreshOrdered();
					$('#btnPostBet').unbind('click');
					$('#btnPostBet').bind('click',gamePostCode);
					if((typeof $('#wanjinDialog').dialog("isOpen")=='object') || $('#wanjinDialog').dialog('isOpen')){
						$('#wanjinDialog').dialog('close');
					}
					gameFreshTimer();

					}, 3000, '');
			}
		
	}else{
		var m=Math.floor(diffTime % 60),
		s=(diffTime---m)/60,
		h=0;
		if(s>60){
			h=Math.floor(s/60);
			s=s-h*60;
		}
		if(h<10){tH="0"+h;}else{tH=h;}
		if(s<10){tS="0"+s;}else{tS=s;}
		if(m<10){tM="0"+m;}else{tM=m;}
		tH=tH.toString();
		tS=tS.toString();
		tM=tM.toString();
		timeStr=timeStr.replace('{@hour1}',tH.split('')[0]).replace('{@hour2}',tH.split('')[1]).replace('{@min1}',tS.split('')[0]).replace('{@min2}',tS.split('')[1]).replace('{@sec1}',tM.split('')[0]).replace('{@sec2}',tM.split('')[1]);
		//$dom.html(timeStr);
		timeStr_new=timeStr_new.replace('{@hour1}',tH.split('')[0]).replace('{@hour2}',tH.split('')[1]).replace('{@min1}',tS.split('')[0]).replace('{@min2}',tS.split('')[1]).replace('{@sec1}',tM.split('')[0]).replace('{@sec2}',tM.split('')[1]);//new
		$dom.html(timeStr_new);//new
		if(S && h==0 && m==5 && s==0){
			playVoice('/skin/sound/stop-time.wav', 'stop-time-voice');
		}
		if(h==0 && m==0 && s==0){
		    loadKjData();
		}else{
			if($.browser.msie){
				T=setTimeout(function(){
					gameKanJiangDataC(diffTime);
				}, 1000);
			}else{
				T=setTimeout(gameKanJiangDataC, 1000, diffTime);
			}
		}
    }
}
function setKJWaiting(kjDiffTime){
	var mm=Math.floor(kjDiffTime % 60), ss=(kjDiffTime---mm)/60;
	$('#posttime').html('封单剩余时间');
	if(ss<10){
		ss="0"+ss;
	}
	if(mm<10){
		mm="0"+mm;
	}
	var mmx=mm, ssx=ss, hhx;
	if(ssx>60){
		hhx=Math.floor(ssx/60);
		ssx=ssx-hhx*60;
		if(hhx<10){$('#s1s').html(0);$('#s1x').html(0);$('#s2s').html(hhx);$('#s2x').html(hhx);}else{hhx=hhx.toString().split('');$('#s1s').html(hhx['0']);$('#s1x').html(hhx['0']);$('#s2s').html(hhx['1']);$('#s2x').html(hhx['1']);}
		if(ssx<10){$('#f1s').html(0);$('#f1x').html(0);$('#f2s').html(ssx);$('#f2x').html(ssx);}else{ssx=ssx.toString().split('');$('#f1s').html(ssx['0']);$('#f1x').html(ssx['0']);$('#f2s').html(ssx['1']);$('#f2x').html(ssx['1']);}
		mmx=mmx.toString().split('');$('#m1s').html(mmx['0']);$('#m1x').html(mmx['0']);$('#m2s').html(mmx['1']);$('#m2x').html(mmx['1']);
	}else{
		$('#s1s').html(0);$('#s1x').html(0);$('#s2s').html(0);$('#s2x').html(0);
		ssx=ssx.toString().split('');$('#f1s').html(ssx['0']);$('#f1x').html(ssx['0']);$('#f2s').html(ssx['1']);$('#f2x').html(ssx['1']);
		mmx=mmx.toString().split('');$('#m1s').html(mmx['0']);$('#m1x').html(mmx['0']);$('#m2s').html(mmx['1']);$('#m2x').html(mmx['1']);
	}
	if(Math.floor(mm)==0 && Math.floor(ss)==0){
		KS=false;
		getQiHao();
	}else{
		if($.browser.msie){
			KT=setTimeout(function(){
				setKJWaiting(kjDiffTime);
			}, 1000);
		}else{
			KT=setTimeout(setKJWaiting, 1000, kjDiffTime);
		}
	}
}
function getQiHao(){
	$.getJSON('/index.php/index/getQiHao/'+game.type, function(data){
		if(data && data.lastNo && data.thisNo){
			gameFreshOrdered();
			$('#btnaddBet').unbind('click');
			$('#btnaddBet').bind('click',gameActionAddCode);
			$('#posttime').html('投注剩余时间');
			$('#current_issue').html(data.thisNo.actionNo);
			$('.lottery_history_issue span').html(data.lastNo.actionNo);
			S=true;
			if(T) clearTimeout(T);
			kjTime=parseInt(data.kjdTime);
			gameKanJiangDataC(data.diffTime-kjTime, data.thisNo.actionNo);
			loadKjData();
		}
	});
}

var  moveno;
function setKjing(){
	
	if(!KS){
		$('#kaijiang #kjsay').html('<em class="kjtips">正在开奖中</em>');
		$('#kaijiang #kjsay').show();
		$('.wjkjData p').hide();
		$('.wjkjData ul').show();
	}
	
	var ctype=$('.kj-hao').attr('ctype');
	var cnum=$('.kj-hao').attr('cnum'),num;
	
		cnum=parseInt(cnum);
	$(".kj-hao").find("li").attr("flag", "move");
		if(ctype=='g1'){
			moveno = window.setInterval(function () {
				$.each($(".kj-hao").find("li"), function (i, n) {
					if ($(this).attr("flag") == "move") {
						num=Math.floor((cnum-1) * Math.random() + 1);
						if(num<10) num='0'+num;
						$(this).html(num);
					}
				})
			}, 40);
		}else if(ctype=='g2'){  //快3
			moveno = window.setInterval(function () {
				$.each($(".kj-hao").find("li"), function (i, n) {
					if ($(this).attr("flag") == "move") {
						$(this).attr("class", "gr_ks gr_ksm" + Math.floor(6 * Math.random() + 1));
					}
				})
			}, 70);
		}else if(ctype=='g3'){ //11选5
			moveno = window.setInterval(function () {
				$.each($(".kj-hao").find("li"), function (i, n) {
					if ($(this).attr("flag") == "move") {
						$(this).attr("class", "gr_s gr_s0" + Math.floor(8 * Math.random() + 1));
					}
				})
			}, 40);
		}else if(ctype=='lhc'){ //六合彩
			moveno = window.setInterval(function () {
				$.each($(".kj-hao").find("li"), function (i, n) {
					if ($(this).attr("flag") == "move") {
						//setTimeout("setKjing2("+i+",'<img src=\"/skin/main/images/lhc/number/"+hao[i]+".gif\" />')",times);
				    }
				})
			}, 40);
		}else if(ctype=='pk10'){ //pk10
			moveno = window.setInterval(function () {
				$.each($(".kj-hao").find("li"), function (i, n) {
					if ($(this).attr("flag") == "move") {
						$(this).attr("class", "ball2 ball_0" + Math.floor(4 * Math.random() + 1));
					}
				})
			}, 40);
		}else{
			 moveno = window.setInterval(function () {
				$.each($(".kj-hao").find("li"), function (i, n) {
					if ($(this).attr("flag") == "move") {
						$(this).attr("class", "gr_s gr_s" + Math.floor(10 * Math.random()));
					}
				})
			}, 40);
		}
}
function setKjing2(i,hao)
{
	$("#num_"+i).removeClass("no");
	$("#num_"+i).html(hao);
}
function setKjing1(i,str)
{
	$(".kj-hao li:eq("+i+")").attr("class",str);
}
function loadKjData(){
	var type=$('#kaijiang').attr('type');
	$.ajax('/index.php/index/getLastKjData/'+type,{
		dataType:'json',
		cache:false,
		error:function(){
			setTimeout(loadKjData, 5000);
		},
		success:function(data, textStatus, xhr){
			if(!data){
				if(!KS) codeplay('正在开奖中');
				setTimeout(loadKjData, 5000);
			}else{
				try{
					if(type==20||type==65||type==66) $('#num').addClass("pk10_ul");
					var hao=data.data.split(',');
					$('.lottery_history_issue span').html(data.actionNo);
					newcode(hao);
					
					freshKaiJiangData(data.actionNo, hao);
					getYKTip(game.type,data.actionNo)
					$('#btnPostBet').unbind('click');
					$('#btnPostBet').bind('click',gamePostCode);
					if((typeof $('#wanjinDialog').dialog("isOpen")=='object') || $('#wanjinDialog').dialog('isOpen')){
						$('#wanjinDialog').dialog('close');
					}
					S=true;
					KS=true;
					
					if(type==73||type==74||type==78){
						$('.pk10_ul_line').removeClass().addClass('k8').css({"width":"100%"});
					}else{
						$('.pk10_ul_line').removeClass().addClass('klsf').css({"width":"100%"});
					}
				
					if(KT) clearTimeout(KT);
					if(T) clearTimeout(T);
					kjTime=parseInt(data.kjdTime);
					gameKanJiangDataC(data.diffTime-kjTime, data.thisNo);
					playVoice('/skin/sound/kai-jiang.wav', 'kai-jian-voice');
					gameFreshOrdered();
					reloadMemberInfo();
				}catch(err){
					setTimeout(loadKjData, 5000);
				}
			}
		}
	});
}
function freshKaiJiangData(type){
	$('#historylot').load('/index.php/index/getHistoryDataiframe/'+type);
}
//刷新投注时间
function gameFreshTimer(){
	S=true;KS=true;
	updateThisNo();
	$(".kj-hao").find("li").attr("flag", "normal");
	$(".kj-hao").find("em").attr("flag", "normal");//new
	if(T) clearTimeout(T);
	if(KT) clearTimeout(KT);
	if(moveno) clearInterval(moveno);
	$('#gameHeader').load('/index.php/display/freshKanJiang/'+game.type);
	$('.block_three').load('/index.php/display/freshKanJiang_new/'+game.type);//new
}
//获取本期盈亏
function getYKTip(type,actionNo){
	if(type && actionNo){
		$.getJSON('/index.php/Tip/getYKTip/'+type+'/'+actionNo, function(tip){
			if(tip){
				winjinAlert(tip.message);
		  }
		})
	}
}

function safeBeforSetPwd(){
	if(!this.oldpassword.value){winjinAlert("请输入旧登入密码");return false;}
	if(this.oldpassword.value.length<6){winjinAlert("旧登入密码至少6位");return false;}
	if(!this.newpassword.value){winjinAlert("请输入新登入密码");return false;}
	if(this.newpassword.value.length<6){winjinAlert("新登入密码至少6位");return false;}
	if(!this.qrpassword.value){winjinAlert("请确认新登入密码");return false;}
	var confirmpwd=$(':password.confirm', this).val();
	if(confirmpwd!=this.newpassword.value){winjinAlert("两次输入密码不一样");return false;}
	return true;
}
/**
 * 修改资金密码前调用
 */
function safeBeforSetCoinPwd(){	
	if(!this.newpassword.value){winjinAlert("提款密码不符合规则，请重新输入");return false;}
	if(this.newpassword.value.length<6){winjinAlert("提款密码至少6位数");return false;}	
	var confirmpwd=$(':password.confirm', this).val();
	//if(confirmpwd!=this.newpassword.value){winjinAlert("两次输入密码不一样");return false;}	
	return true;
}
function safeBeforSetCoinPwd2(){	
	if(!this.oldpassword.value){winjinAlert("请输入旧提款密码");return false;}
	if(this.oldpassword.value.length<6){winjinAlert("旧提款密码至少6位");return false;}
	if(!this.newpassword.value){winjinAlert("请输入新提款密码");return false;}
	if(this.newpassword.value.length<6){winjinAlert("新提款密码至少6位");return false;}
	if(!this.qrpassword.value){winjinAlert("请确认新提款密码");return false;}
	var confirmpwd=$(':password.confirm', this).val();
	if(confirmpwd!=this.newpassword.value){winjinAlert("两次输入的新提款密码不一样");return false;}
	return true;
}
/**
 * 修改密码和资金密码调用
 */
function safeSetPwd(err, data){
	if(err){
		winjinAlert(err,"err");	
	}else{
		this.reset();
		winjinAlert(data,"ok");
		
	}
}

/**
 * 修改银行信息前调用
 */
function safeBeforSetCBA(){
	if(!this.bankId.value){winjinAlert("请选择银行类型");return false;}
	if(!this.countname.value){winjinAlert("支行地址没有填写");return false;}
	if(!this.username.value){winjinAlert("开户姓名没有填写");return false;}
	if(!this.account.value){winjinAlert("银行卡号没有填写");return false;}
	if(this.account.value.length<16){winjinAlert("银行卡号至少16位");return false;}
	//if(!this.coinPassword.value){winjinAlert("请输入提款密码");return false;}	
	//if(this.coinPassword.value<6){winjinAlert("提款密码至少6位");return false;}
	return true;
}
/**
 * 修改银行信息调用
 */
function safeSetCBA(err, data){
	if(err){
		winjinAlert(err,"err");
	}else{
		winjinAlert(data,"ok");
		  window.location.reload();
		  
	}
}

//{{{ 团队管理相关函数
function teamCopyTip(text){
	if(text){
		winjinAlert("复制成功","ok");	
		}
}
/**
 * 新增会员前调用
 */
function teamBeforeAddMember(){
	var type=$('[name=type]:checked',this).val();
	if(!this.username.value){winjinAlert("请输入会员帐号");return false;}
	if(!/^\w{5,16}$/.test(this.username.value)){winjinAlert("用户名由5到16位的字母或数字组成");return false;}
	if(!this.password.value){winjinAlert("请输入登入密码");return false;}
	if(this.password.value.length<6){winjinAlert("登入密码至少6位数");return false;}
	if(!this.cpasswd.value){winjinAlert("请确认登入密码");return false;}
	if(document.getElementById('cpasswd').value!=this.password.value){winjinAlert("两次输入的登入密码不一样");return false;}
	if(!this.qq.value){winjinAlert("请输入QQ帐号");return false;}
	if(this.qq.value.length<5){winjinAlert("QQ帐号至少5位数");return false;}
	if(!this.fanDian.value){winjinAlert("请输入返点");return false;}
	if(parseFloat(this.fanDian.value)<0){winjinAlert("返点不能小于0%"); return false;}
	if(parseFloat(this.fanDian.value)>parseFloat($(this.fanDian).attr('max'))){winjinAlert('返点不能大于'+$(this.fanDian).attr('max')); return false;}
	var fanDianDiff= $(this.fanDian).attr('fanDianDiff');
	if((this.fanDian.value*1000) % (fanDianDiff*1000)){winjinAlert('返点只能是'+fanDianDiff+'%的倍数');return false;}
}
function teamAddMember(err, data){
	if(err){
		winjinAlert(err,"err");
		$("#vcode").trigger("click");
	}else{
		$('#username').val(this.username.value);
		$('#password').val(this.password.value);
		winjinAlert(data,"ok");
		$("#resetmenber").trigger("click");
		window.location='/index.php/team/memberList';
	}
}
function dataAddCode(){
	$('form', this).trigger('submit');
}
function defaultCloseModal(){
	$(this).dialog('destroy');
}
//修改会员
function userDataBeforeSubmitCode(){
	
	if(!this.fanDian.value.match(/^[\d\.\%]{1,4}$/)) throw('请正确设置返点');
	if(parseFloat(this.fanDian.value)>=parseFloat($(this.fanDian).attr('max'))) throw('返点不能大于或等于'+$(this.fanDian).attr('max'));
	if(parseFloat(this.fanDian.value)<parseFloat($(this.fanDian).attr('min'))) throw('返点不能小于'+$(this.fanDian).attr('min'));
	if(parseFloat(this.fanDian.value)<parseFloat($(this.fanDian).attr('val'))) throw('返点不能小于'+$(this.fanDian).attr('val'));
	var fanDianDiff= $(this.fanDian).attr('fanDianDiff');
	if((this.fanDian.value*1000) % (fanDianDiff*1000)) throw('返点只能是'+fanDianDiff+'%的倍数');
}
function userDataSubmitCode(err, data){
	if(err){
		winjinAlert(err,"err");
	}else{
		winjinAlert("修改成功","ok");
		$(this).parent().dialog('destroy');
		reload();
	}
}

/**
 * 新增注册链接前调用
 */
function teamBeforeAddLink(){
	var type=$('[name=type]:checked',this).val();
	if(!this.fanDian.value.match(/^[\d\.\%]{1,4}$/)) throw('请正确设置返点');
	if(!this.fanDian.value) throw('请输入返点');
	if(parseFloat(this.fanDian.value)<0) throw('返点不能小于0%');
	if(parseFloat(this.fanDian.value)>parseFloat($(this.fanDian).attr('max'))) throw('返点不能大于'+$(this.fanDian).attr('max'));
	var fanDianDiff= $(this.fanDian).attr('fanDianDiff');
	if((this.fanDian.value*1000) % (fanDianDiff*1000)) throw('返点只能是'+fanDianDiff+'%的倍数');
}
function teamAddLink(err, data){
	if(err){
		winjinAlert(err,"err");
	}else{
		winjinAlert(data,"ok");
		this.reset();
		window.location='/index.php/team/linkList';
	}
}
//}}}
//修改注册链接
function linkDataBeforeSubmitCode(){
	if(!this.fanDian.value.match(/^[\d\.\%]{1,4}$/)) throw('请正确设置返点');
	if(parseFloat(this.fanDian.value)>parseFloat($(this.fanDian).attr('max'))) throw('返点不能大于或等于'+$(this.fanDian).attr('max'));
	if(parseFloat(this.fanDian.value)<parseFloat($(this.fanDian).attr('min'))) throw('返点不能小于'+$(this.fanDian).attr('min'));
	var fanDianDiff= $(this.fanDian).attr('fanDianDiff');
	if((this.fanDian.value*1000) % (fanDianDiff*1000)) throw('返点只能是'+fanDianDiff+'%的倍数');
}
function linkDataSubmitCode(err, data){
	if(err){
		winjinAlert(err,"err");
	}else{
		winjinAlert("修改成功","ok");
		$(this).parent().dialog('destroy');
		reload();
	}
}
//删除注册链接
function beforeDelLink(){
	var obj=$(this);
	var tipString='<span class="ui-wjicon-confirm"></span>一旦删除将无法恢复，是否确定删除？';
		var wjDialog=$('#wanjinDialog').html(tipString).dialog({
		title:'温馨提示',
		resizable: false,
		width:300,
		minHeight:150,
		modal: true,
		buttons: {
		"确定": function() {
			$( this ).dialog( "close" );
			obj.attr("onajax","");
			obj.click();
			
		},
		"取消": function() {
			$( this ).dialog( "close" );
		}
		}
		});//dialog end	
    return false;
}
function delLink(err, data){
	if(err){
		winjinAlert(err,"err");
	}else{
		if(data) 
		winjinAlert(data,"ok");
		location.reload();
	}
}
//{{{ 游戏相关函数
/**
 * 快速选择唯一选择
 */
function uniqueSelect(parent){
	var $this=$(this),$unique=parent.closest('.unique'),
	fun=function(i,c){
		return $('input.code.checked[value='+this.value+']').length?'':'checked';
	};
	if($this.is('.all')){
		// 全－全部选中
		$('input.code',parent).addClass(fun);
	}else if($this.is('.large')){
		// 大－选中5到9
		$('input.code.max',parent).addClass(fun);
		$('input.code.min',parent).removeClass('checked');
	}else if($this.is('.small')){
		// 小－选中0到4
		$('input.code.min',parent).addClass(fun);
		$('input.code.max',parent).removeClass('checked');
	}else if($this.is('.odd')){
		// 单－选中单数
		$('input.code.d',parent).addClass(fun);
		$('input.code.s',parent).removeClass('checked');
	}else if($this.is('.even')){
		// 双－选中双数
		$('input.code.s',parent).addClass(fun);
		$('input.code.d',parent).removeClass('checked');
	}else if($this.is('.none')){
		// 清－全不选
		$('input.code',parent).removeClass('checked');
	}
}
function reload(){
	location.reload();
}
function reloadMemberInfo(){
	$('.userInfo').load('/index.php/index/userInfo');
}
function randomSelectCode(len, codes){
	var i,selectCode=[], codesLen=codes.length;
	for(i=0; i<len; i++){
		selectCode[i]=Math.floor(Math.random()*codesLen);
	}
	return selectCode;
}
/**
 * 追号
 * fpcount 是否飞盘 费用翻倍
 */
function setGameZhuiHao(data){
	//console.log(data);
	var fpcount=1,$feipan=$(':checkbox[name=fpEnable]'); 
	if($feipan.prop('checked')) fpcount=2;
	$.get('/index.php/index/zhuiHaoModal', function(html){
		$(html).dialog({
			title:'追号期数：<span class="qs">0</span>　总金额：<span class="amount">0.00</span>元',
			
			height:300,
			modal:true,
			stack:false,
			dialogClass:'zhui-hao-modal',
			buttons:{
				"确定追号":function(){
					var data=[];
					$('tbody :checkbox:checked', this).each(function(){
						var $this=$(this),
						$tr=$this.closest('tr');
						data.push([$('td:eq(1)', $tr).text(), $('.beishu', $tr).val(), $('td:eq(4)', $tr).text()].join('|'));
					});
					if(!data.length){
						winjinAlert('追号至少选一期',"alert");
						return false;
					}
					$('.orderNow .checkZhui :checkbox[name=zhuiHao]').data({
						zhuiHao:data.join(';'),
						zhuiHaoMode:$(this).closest('.zhui-hao-modal').find(':checkbox[name=zhuiHaoMode]:first')[0].checked?1:0
					})[0].checked=true;
					$( this ).dialog( "destroy" );
					gameCalcAmount();
				},
				"取消追号":function(){
					$('.orderNow .checkZhui :checkbox[name=zhuiHao]').removeData()[0].checked=false;
					$( this ).dialog( "destroy" );
					gameCalcAmount();
				}
			},
			open:function(event, ui){
				var $this=$(this),
				price=Math.round(data.mode * data.actionNum  * fpcount * 100)/100;
				$this.attr('rel', price);
				$this.attr('src', '/index.php/index/zhuiHaoQs/'+data.type+'/'+price+'/');
				$('.tr-cont', this).load($this.attr('src')+10);
				$this.closest('.zhui-hao-modal').find('select:first').change(function(){
					$('tbody', $this).load($this.attr('src')+this.value);
				});
			}
		});
	});
}
function doZhuiHaoCount(){
	var count=0, amount=0;
	$('tbody tr :checkbox', this).each(function(i, v){
	});
}
/**
 * 查看投注号码
 */
function displayCodeList(opts){
	$('<div>').append(
		$('<textarea class="code-tip-box"></textarea>')
		.append(opts.actionData)
	).dialog({title:'投注号码'});
}
function gameMsgAutoTip(){
	var obj,$game=$('#num-select .pp'),
	calcFun=$game.attr('action');
	if(calcFun && (calcFun=window[calcFun]) && (typeof calcFun=='function')){
		try{
			obj=calcFun.call($game);
			if($.isArray(obj)){
				o={actionNum:0};
				obj.forEach(function(v,i){
					o.actionNum+=v.actionNum;
				});
				obj=o;
			}
			$('#game-tip-dom').text('共'+obj.actionNum+'注，金额'+(gameGetMode()*gameGetBeiShu()*obj.actionNum).round(3)+'元');
		}catch(err){
			$('#game-tip-dom').text(err);
		}
	}
}
$(function(){
	$(':radio[name=danwei]').live("click",function(){
		var value=$(this).val();
		if($(this).attr("checked")){
			$.cookie('mode', value, { expires: 7, path: '/'});
		}
	})	
	$('#slider').live("mouseover",function(){
		$.cookie('fanDian', gameGetFanDian(), { expires: 7, path: '/'});
	})	
	$('.changebg a').live("click",function(){
		var img=$(this).attr("rel");
		$.cookie('pagepg', img, { expires: 7, path: '/'});
		location.reload();
		return false;
	})	
	
})
/**
 * 设置cookie
 */
$(function(){
	//切换背景模式
	$('.danwei').live("click",function(){
		var value=$(this).attr('value');
		$.cookie('mode', value, { expires: 7, path: '/'});
		$(this).addClass('dwon').siblings('b').removeClass('dwon');
		gameMsgAutoTip();
	})	
	$('#slider-range-min').live("mouseover",function(){
		$.cookie('fanDian', gameGetFanDian(), { expires: 7, path: '/'});
		//alert(gameGetFanDian());
	})	
	//保存背景
	$('.changebg a').live("click",function(){
		var img=$(this).attr("rel");
		$.cookie('pagepg', img, { expires: 7, path: '/'});
		location.reload();
		return false;
	})	
	
})

/**
 * 清除号码
 *
 * @params bool isSelected	是否只清除选中的项，默认false
 */
function gameActionRemoveCode(isSelected){
	$('.touzhu-cont tr').remove();
	$('.orderNow :checkbox[name=zhuiHao]').removeData()[0].checked=false;
	gameCalcAmount();
}
/**
 * 添加预投注
 * code {actionNo:'12,3,4,567,8', actionNum:6}
 */
function gameAddCode(code){
	wait();
	var actionNo=$.parseJSON($.ajax('/index.php/game/checkBuy',{async:false}).responseText);
	destroyWait();
	if(actionNo){
		winjinAlert('本期投注已截止，请下一期再投注');
		return false;
	}
	
	if($.isArray(code)){
		for(var i=0; i<code.length; i++) gameAddCode(code[i]);
		return;
	}
	if(code.actionNum==0) throw('号码不正确');
	try{
		var weizhiTypejsh=$('#wei-shu').attr('type');
		var caizhongTypejsh=$('input[name="playedId"]').val();
		if((weizhiTypejsh=='z3_r3_zuhetouzhu'&&caizhongTypejsh=='22')
				//||(weizhiTypejsh=='z3_r6_zuhetouzhu'&&caizhongTypejsh=='23')
				||(weizhiTypejsh=='3x_rz3_zuhetouzhu'&&$('#wei-shu').attr('playedIdjsh')=='24')){
			var weiShusel=[],weizhiAr=[],
			$wei=$('#wei-shu');

			var weiShu=0;
			if($(':checked', $wei).length<$wei.attr('length')) throw('至少需要选择'+codeLen+'个位置');
			$(':checked', $wei).each(function(i){
				if(this.checked) weiShusel.push(i);
			});
			var weishuzhi=[16,8,4,2,1];
			weiShusel.forEach(function(v1,i1){
				weiShusel.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						weiShusel.forEach(function(v3,i3){
							if(v2!=v3&&v2<v3){
								weiShu|=parseInt(weishuzhi[v1]);
								weiShu|=parseInt(weishuzhi[v2]);
								weiShu|=parseInt(weishuzhi[v3]);
								weizhiAr[weizhiAr.length]=weiShu;
								weiShu=0;
							}
						});
					}
				});
			});
			for(var iii=0;iii<weizhiAr.length;iii++){
				code=$.extend({
					fanDian: gameGetFanDian(),
					bonusProp:gameGetPl(code),
					mode: gameGetMode(),
					beiShu: gameGetBeiShu(),
					orderId: (new Date())-2147486647*623
				}, code);
				
				modeName={'2':'元', '0.2':'角', '0.02':'分', '0.002':'厘'},
				amount=code.mode * code.beiShu * code.actionNum,
				playedName=code.playedName||$('.game-cont .current').text(),
				weiCount=parseInt($wei.attr('length'));
				//if(code.playedName) delete code.playedName;
				delete code.isZ6;
				if($wei.length){
					//if($(':checked', $wei).length!=weiCount) throw('请选择'+weiCount+'位数！');
					//TODO:0507--jinshanhu
					var weizhiType=$('#wei-shu').attr('type');
					if($(':checked', $wei).length<weiCount) throw('请选择'+weiCount+'位数！');
					$(':checked', $wei).each(function(){
						//weiShu|=parseInt(this.value);
					});
				}
				var wei='';
				code.weiShu=weizhiAr[iii];
				if(weizhiAr[iii]){
					var w={16:'万', 8:'千', 4:'百', 2:'十',1:'个'}
					for(var p in w){
						if(weizhiAr[iii] & p) wei+=w[p];
					}
					wei+=':';
				}
				$('#num-select input:hidden').each(function(){
					code[$(this).attr('name')]=this.value;
				});
				delete code.undefined;
				$('<tr>').data('code', code)
				.append(
					$('<td>').append(playedName)
				)
				.append(
					$('<td class="code-list">').append(wei+(code.actionData.length>18?(code.actionData.substr(0,5)+'...'):code.actionData))
				)
				.append(
					$('<td>').data('value', code.actionNum).append('['+code.actionNum+'注]')
				)
				.append(
					$('<td>').data('value', amount).append(amount.round(3)+"元")
				)
				.append(
					$('<td>').append(code.beiShu+'倍')
				)
				.append(
					$('<td>').append(modeName[code.mode])
				)
				.append(
					$('<td>').append('奖－返：'+parseFloat(code.bonusProp).round(3)+'-'+parseFloat(code.fanDian).round(1)+'%')
				)
				.append(
					$('<td><div class="del"></div></td>')
				)
				.appendTo('.touzhu-cont table');
				//alert("good");
				$('#textarea-code').val("");
				gameCalcAmount();
				$('.checkZhui :checkbox[name=zhuiHao]').removeData()[0].checked=false;
				$('.num-table :button.checked').removeClass('checked');
			}
		}else{
			code=$.extend({
				fanDian: gameGetFanDian(),
				bonusProp:gameGetPl(code),
				mode: gameGetMode(),
				beiShu: gameGetBeiShu(),
				orderId: (new Date())-2147486647*623
			}, code);
			var weiShu=0, wei='',
			modeName={'2':'元', '0.2':'角', '0.02':'分', '0.002':'厘'},
			amount=code.mode * code.beiShu * code.actionNum,
			$wei=$('#wei-shu'),
			playedName=code.playedName||$('.game-cont .current').text(),
			weiCount=parseInt($wei.attr('length'));
			if(code.playedName) delete code.playedName;
			delete code.isZ6;
			if($wei.length){
				var weizhiTypejsh=$('#wei-shu').attr('type');
				var caizhongTypejsh=$('input[name="playedId"]').val();
				if((weizhiTypejsh=='2x_r2d_zuhetouzhu'&&caizhongTypejsh=='30')
					||(weizhiTypejsh=='2x_r3d_zuhetouzhu'&&caizhongTypejsh=='15')
					||(weizhiTypejsh=='dx_r4d_zuhetouzhu'&&caizhongTypejsh=='9')
					||(weizhiTypejsh=='z3_r3_zuhetouzhu'&&caizhongTypejsh=='22')
					||(weizhiTypejsh=='z3_r6_zuhetouzhu'&&caizhongTypejsh=='23')
					||(weizhiTypejsh=='3x_rz3_zuhetouzhu'&&$('#wei-shu').attr('playedIdjsh')=='24')){
					if($(':checked', $wei).length<weiCount) throw('请选择'+weiCount+'位数(1)！');
				}else{
					//if($(':checked', $wei).length!=weiCount) throw('请选择'+weiCount+'位数(2)！');
				}
				$(':checked', $wei).each(function(){
					weiShu|=parseInt(this.value);
				});
			}
			code.weiShu=weiShu;
			if(weiShu){
				var w={16:'万', 8:'千', 4:'百', 2:'十',1:'个'}
				for(var p in w){
					if(weiShu & p) wei+=w[p];
				}
				wei+=':';
			}
			$('#num-select input:hidden').each(function(){
				code[$(this).attr('name')]=this.value;
			});
			delete code.undefined;
			$('<tr>').data('code', code)
			.append(
				$('<td>').append(playedName)
			)
			.append(
				$('<td class="code-list">')//.append(wei+(code.actionData.length>18?(code.actionData.substr(0,5)+'...'):code.actionData))
			)
			.append(
				$('<td>').data('value', code.actionNum).append('['+code.actionNum+'注]')
			)
			.append(
				$('<td>').data('value', amount).append(amount.round(3)+"元")
			)
			.append(
				$('<td>').append(code.beiShu+'倍')
			)
			.append(
				$('<td>').append(modeName[code.mode]+'模式')
			)
			//.append(
			//	$('<td>').append('奖－返：'+parseFloat(code.bonusProp).round(2)+'-'+parseFloat(code.fanDian).round(1)+'%')
			//)
			.append(
				$('<td><div class="del"></div></td>')
			)
			.appendTo('.touzhu-cont table');
			$('#textarea-code').val("");
			gameCalcAmount();
			$('.checkZhui :checkbox[name=zhuiHao]').removeData()[0].checked=false;
			$('.num-table :button.checked').removeClass('checked');
		}
	}catch(err){
		winjinAlert(err);
	}
}

function demo(){   $("#demo").attr("checked",false);}
/**
 * 添加投注
 */
function gamePostCode(){
	var code=[],	// 存放投注号特有信息
	zhuiHao,		// 存放追号信息
	data={},is_combine=0;		// 存放共同信息
	$('.touzhu-cont tr').each(function(){
		code.push($(this).data('code'));
	});
	if(code==""){
		winjinAlert('您还未添加预投注');
		return false;
	}
	$('.touzhu-bottom :checkbox:checked').each(function(){
		data[$(this).attr('name')]=this.value;
	});
	if($(':checkbox[name=zhuiHao]')[0].checked){
		var $dom=$(':checkbox[name=zhuiHao]');
		zhuiHao=$dom.data('zhuiHao');
		data.zhuiHao=1;
		data.zhuiHaoMode=$dom.data('zhuiHaoMode');
	}
	wait();
	var actionNo=$.parseJSON($.ajax('/index.php/game/getNo/'+game.type,{async:false}).responseText);
	destroyWait();
	if(!actionNo){
		winjinAlert('获取投注期号出错');
		return false;
	}
	var tipString='';
	tipString+='<br /><table width="100%" class="form-tips"><tr><th>注数</th><th>倍数</th><th>模式</th></tr>';
	$('.touzhu-cont tr').each(function(){
		var $this=$(this);
		tipString+="<tr><td>"+$('td:eq(2)', $this).data('value')+"</td><td>"+$('td:eq(4)', $this).text()+"</td><td>"+$('td:eq(5)', $this).text()+"</td></tr>";
	});
	tipString+='</table>';
	$('#wanjinDialog').html(tipString).dialog({
		title:'购买信息',
		resizable: false,
		width:'90%',
		minHeight:150,
		modal: true,
		buttons: {
		"确定购买": function() {
			$( this ).dialog( "close" );

			data['type']=game.type;
			data['actionNo']=actionNo.actionNo;
			data['kjTime']=actionNo.actionTime;
			 if($('.is_combine').prop('checked') == true){
            is_combine = 1;
        }
		
			wait();
			$.ajax('/index.php/game/postCode', {
				data:{
					code:code,
					para:data,
					zhuiHao:zhuiHao,
					is_combine:is_combine
				},
				type:'post',
				dataType:'json',
				error:function(xhr, textStatus, errorThrown){
					gamePostedCode(errorThrown||textStatus);
				},
				success:function(data){
					destroyWait();
					gamePostedCode(null, data);
					if(data) winjinAlert(data);
					$("#cannel_chckbox").attr("checked",false);//提交初始化
				},
				
				complete:function(xhr, textStatus){
					var errorMessage=xhr.getResponseHeader('X-Error-Message');
					if(errorMessage) gamePostedCode(decodeURIComponent(errorMessage));
				}
			});
	    },		
				}	 
	});	
}
function demo(){  $('.is_combine').attr("checked",false);}
/**
 * 投注后置函数
 */
function gamePostedCode(err, data){
	if(err){
	layer.open({
		content:'您的可用资金不足，是否充值？',
		btn:['充值','取消'],
		yes:function(){
			window.location.href='/index.php/cash/recharge'
		}
    })
	}else{
		gameActionRemoveCode();
		gameFreshOrdered();
		reloadMemberInfo();
		gameCalcAmount();
		$('#game-tip-dom').text('');
		//reload();
	}
}
/**
 * 计算注数与金额，并显示
 * fpcount 是否飞盘 费用翻倍
 */
function gameCalcAmount(){
	var count=0;fpcount=1;amount=0.0, $zhuiHao=$(':checkbox[name=zhuiHao]'), $feipan=$(':checkbox[name=fpEnable]');
	if($feipan.prop('checked')) fpcount=2;
	if($zhuiHao.prop('checked')){
		var data=$('.touzhu-cont tr').data('code');
		$zhuiHao.data('zhuiHao').split(';').forEach(function(v){
			count+=parseInt(v.split('|')[1]);
		});
		amount=data.mode*data.actionNum*count*fpcount;
	}else{
		$('.touzhu-cont tr').each(function(){
			var $this=$(this);
			count+=$('td:eq(2)', $this).data('value');
			amount+=$('td:eq(3)', $this).data('value')*fpcount;
		});
	}

	$('#all-count').text(count);
	$('#all-amount').text(amount.round(3));

}
/**
 * 添加投注
 */
function gameActionAddCode(){
	//奖金返点限制[如奖金模式在1920以下才能购买分模式(返点大于最大返点-11)]
	//代理不能买单
	if($('#wjdl'))
	{
		if(parseInt($('#wjdl').val())>0){
			winjinAlert('代理不能买单');
			return false;
		}
	}
	var modeName={'2.000':'元','0.200':'角','0.02':'分','0.002':'厘'},
	$mode=$('.danwei.dwon'),
	$slider=$('#slider-range-min'),
	fanDian=gameGetFanDian(),
	modeFanDian=$mode.data().maxFanDian,
	userFanDian=$slider.attr('fan-dian'),
	mode=$mode.attr("value");

	if(userFanDian-fanDian> modeFanDian){
		var pl=$('#fandian-value').data(),
		_amount=(pl.maxpl-pl.minpl)/$slider.attr('game-fan-dian')*modeFanDian+(pl.minpl-0);
		winjinAlert(modeName[mode]+'模式最大奖金只能为'+_amount.toFixed(3));
		return false;
	}
	// 单笔中奖限额
	var maxZjAmount=$slider.data().betZjAmount;
		//console.log('限额：%s, 中奖：%s', maxZjAmount, gameGetPl() * mode * ($('#beishu').val()||1));
	if(maxZjAmount){
		if($('#fandian-value').data('pl') * mode/2 * ($('#beishu').val()||1) > maxZjAmount){
			winjinAlert('单笔中奖奖金不能超过'+maxZjAmount+'元');
			return false;
		}
	}
	var obj,$game=$('#num-select .pp'),
	calcFun=$game.attr('action');
	if(calcFun && (calcFun=window[calcFun]) && (typeof calcFun=='function')){
		try{
			obj=calcFun.call($game);
			var maxBetCount=$slider.data().betCount;
			if(maxBetCount && obj.actionNum>maxBetCount){
				winjinAlert('单笔投注注数最大不能超过'+maxBetCount+'注');
				return false;
			}
			if(typeof obj!='object'){
				throw('未知出错');
			}else{
				//throw("111");
				gameAddCode(obj);
				//throw("222");
				$game.find('input.action').removeClass('on');
				//throw("333");
			}
		}catch(err){
			winjinAlert(err);
		}
	}
}
//撤单

function confirmCancel() {  
        //利用对话框返回的值 （return true 或者return false）  
        if (confirm("是否确定撤单？")) {  
            winjinAlert("撤单成功");  
			return true;
        }  
        else {  
            winjinAlert("取消撤单");
			return false;
        }  
  
    }  
/**
 * 更新定单列表
 */
function gameFreshOrdered(err, msg){
	if(err){
		winjinAlert(err);
	}else{
		$('#order-history').load('/index.php/game/getOrdered/'+game.type, reloadMemberInfo);
	}
}
/**
 * 设置反点
 *
 * @params value		反点值，可以是个浮点数，表示在当前值时的增量
 */
function gameSetFanDian(value){
	var $dom=$("#fandian-value"),
	gameFanDian=parseFloat($('#slider-range-min').attr('game-fan-dian')),
	myFanDian=parseFloat($('#slider-range-min').attr('fan-dian')),
	pl=parseFloat($dom.data('maxpl')),
	minPl=parseFloat($dom.data('minpl')),
	str=(pl-minPl)/gameFanDian*myFanDian+minPl-(pl-minPl)*value/gameFanDian;
	str=str.round(2);	
	if(pl==minPl){
		$('#slider-range-min').hide();
	}else{
		$('#slider-range-min').show();
	}
	$('#slider-range-min').slider('option', 'value', value);
	$dom.data('pl', str);
	str+='/'+value.round(1)+'%';
	$dom.text(str);
}
/**
 * 设置赔率
 */
var FANDIAN=0;
function gameSetPl(value, flag, fanDianBdw){
	//console.log(value);
	var $dom=$('#slider-range-min');
	//value=((100-parseFloat($dom.attr('game-fan-dian'))+parseFloat($dom.attr('max')))*value/100).round(1);
	$('#fandian-value').data('maxpl', value.bonusProp);
	$('#fandian-value').data('minpl', value.bonusPropBase);
	if(flag){
		$('.fandian-k').css('visibility','hidden');
	}else{
		$('.fandian-k').css('visibility','visible');
	}
		FANDIAN=FANDIAN||gameGetFanDian();
		gameSetFanDian(FANDIAN);
}
/**
 * 读取反点值
 */
function gameGetFanDian(){
	return $('#slider-range-min').slider('option', 'value');
}
/**
 * 读取陪率
 */
function gameGetPl(code){
	var $dom=$('#num-select .pp');
	if($dom.is('[action=tzSscHhzxInput_2]') || $dom.is('[action=tzSscHhzxInput_1]')){
		if(code.isZ6){
			var set={
				bonusProp:parseFloat($dom.attr('z6max')),
				bonusPropBase:parseFloat($dom.attr('z6min'))
			};
		}else{
			var set={
				bonusProp:parseFloat($dom.attr('z3max')),
				bonusPropBase:parseFloat($dom.attr('z3min'))
			};
		}
		gameSetPl(set, true);
	}
	return $('#fandian-value').data('pl');
}
// 读取模式
function gameGetMode(){
	return parseFloat($('#game-dom .danwei.dwon').attr('value')||1);
}
// 读取倍数
function gameGetBeiShu(){
	var txt=$('#beishu').val();
	if(!txt) return 1;
	var re=/^[1-9][0-9]*$/;
	if(!re.test(txt)){
		throw('倍数只能为大于1正整数');
		$('#beishu').val(1);
	}
	if(isNaN(txt=parseInt(txt))) throw('倍数设置不正确');
	return txt;
}
//{{{ 相关算法集
function DescartesAlgorithm(){
	var i,j,a=[],b=[],c=[];
	if(arguments.length==1){
		if(!$.isArray(arguments[0])){
			return [arguments[0]];
		}else{
			return arguments[0];
		}
	}
	if(arguments.length>2){
		for(i=0;i<arguments.length-1;i++) a[i]=arguments[i];
		b=arguments[i];
		return arguments.callee(arguments.callee.apply(null, a), b);
	}
	if($.isArray(arguments[0])){
		a=arguments[0];
	}else{
		a=[arguments[0]];
	}
	if($.isArray(arguments[1])){
		b=arguments[1];
	}else{
		b=[arguments[1]];
	}
	for(i=0; i<a.length; i++){
		for(j=0; j<b.length; j++){
			if($.isArray(a[i])){
				c.push(a[i].concat(b[j]));
			}else{
				c.push([a[i],b[j]]);
			}
		}
	}
	return c;
}
/* 组合算法*/
function combine(arr, num) {
	var r = [];
	(function f(t, a, n) {
		if (n == 0) return r.push(t);
		for (var i = 0, l = a.length; i <= l - n; i++) {
			f(t.concat(a[i]), a.slice(i + 1), n - 1);
		}
	})([], arr, num);
	return r;
}
/* 排列算法*/
function permutation(arr, num){
	var r=[];
	(function f(t,a,n){
		if (n==0) return r.push(t);
		for (var i=0,l=a.length; i<l; i++){
			f(t.concat(a[i]), a.slice(0,i).concat(a.slice(i+1)), n-1);
		}
	})([],arr,num);
	return r;
}
function gameLoadZnzPage(type){
	$('.game-left.img-bj').load('/index.php/index/znz/'+type);
}
//计算注数算法集
function tzAllSelect(){
	var code=[], len=1,codeLen=parseInt(this.attr('length')), delimiter=this.attr('delimiter')||"";
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	this.each(function(i){
		var $code=$('input.code.checked', this);
		if($code.length==0){
			code[i]='-';
		}else{
			len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			code[i]=code[i].join(delimiter);
		}
	});
	return {actionData:code.join(','), actionNum:len};
}
/* 排列组选2  除去对子和豹子*/
function tzDesAlgorSelect(){
	var code=[], len=1,codeLen=parseInt(this.attr('length')), delimiter=this.attr('delimiter')||"";
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	this.each(function(i){
		var $code=$('input.code.checked', this);
		if($code.length==0){
			code[i]='-';
		}else{
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			code[i]=code[i].join(delimiter);
		}
	});
	code=code.join(',');
	len=DescartesAlgorithm.apply(null, code.split(",").map(function(v){return v.split(delimiter)}))
	.map(function(v){ return v.join(','); })
	.filter(function(v){ return (!isRepeat(v.split(","))) })
	.length;
	return {actionData:code, actionNum:len};
}
  function isRepeat(arr){ 
         var hash = {};  
         for(var i in arr) {  
             if(hash[arr[i]])  
                  return true;  
             hash[arr[i]] = true;  
         }  
         return false;  
    }  
/*大小单双选号*/
function tzDXDS(){
	var code=[], len=1,codeLen=2;
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	this.each(function(i){
		var $code=$('input.code.checked', this);
		if($code.length==0){
			code[i]='-';
		}else{
			len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			code[i]=code[i].join("");
			
		}
	});
	return {actionData:code.join(','), actionNum:len};
}
/*大小单双选号*/
function tzDXDSq3h3(){
	var code=[], len=1,codeLen=3;
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	this.each(function(i){
		var $code=$('input.code.checked', this);
		if($code.length==0){
			code[i]='-';
		}else{
			len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			code[i]=code[i].join("");
		}
	});
	return {actionData:code.join(','), actionNum:len};
}
/*趣味选号*/
function qwwf(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	this.each(function(i){
		var $code=$('input.code.checked', this);
		if($code.length==0){
			code[i]='-';
		}else{
			len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			code[i]=code[i].join("");
		}
	});
	return {actionData:code.join(','), actionNum:len};
}
/*五星定位胆选号*/
function tz5xDwei(){
	var code=[], len=0, delimiter=this.attr('delimiter')||"";
	this.each(function(i){
		var $code=$('input.code.checked', this);
		if($code.length==0){
			code[i]='-';
		}else{
			len+=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			code[i]=code[i].join(delimiter);
		}
	});
	if(!len) throw('至少选一个号码');
	return {actionData:code.join(','), actionNum:len};
}
/*不定胆选号*/
function tz5xBDwei(){
	var code="", len=0, $code=$('input.code.checked', this);
	len=$code.length;
	if(!len) throw('至少选一个号码');
	$code.each(function(){
		code+=this.value;
	});
	return {actionData:code, actionNum:len};
}
function tz5xBDweix(){
	var code="", len=0, $code=$('input.code.checked', this);
	len=$code.length;
	if(!len) throw('至少选一个号码');
	$code.each(function(){
		code+=this.value;
	});
	
    if($('#wei-shu :checked',this).length<3) throw('请选3个及以上位置');
	if($('#wei-shu :checked',this).length==4) len=len * 4;
	if($('#wei-shu :checked',this).length==5) len=len * 10;

	
	return {actionData:code, actionNum:len};
}

/* 时时彩录入式投注*/
function tzSscInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	codes=codes.map(function(code){
		return code.split("").join(',')
	});
	return {actionData:codes.join('|'), actionNum:codes.length}
}

/* 时时彩录入式投注*/
function ssc2xzxds(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,''),
	z=[],
	n=0,
	str2='';
	
	str.replace(/[^\d]/gm,'').match(/\d{2}/g).forEach(function(code){
		var str1=code.toString();
		if(parseInt(str1.substr(0,1))==parseInt(str1.substr(1,1))){return false;}
		
		var sum1='';
		var xx=[],yy=0;
		xx[0]=parseInt(str1.substr(0,1));	
		xx[1]=parseInt(str1.substr(1,1));
		xx[2]=parseInt(str1.substr(2,1));	
		for(i=1;i<3;i++){
			if(xx[i]>xx[0]){yy=xx[0];xx[0]=xx[i];xx[i]=yy;}
		}
		for(i=2;i<3;i++){
			if(xx[i]>xx[1]){yy=xx[1];xx[1]=xx[i];xx[i]=yy;}
		}
		sum1=xx[0]+','+xx[1]+','+xx[2];
		
		z.push(sum1);
		if(n>=1){
		for(a=0;a<n;a++){
			if(z[n]==z[a]){return false;}
		}
		}
		
		n = n+1;
		str2 = str2 + code;
	});

	str=str2;
		
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	codes=codes.map(function(code){
		return code.split("").join(',')
	});
	codes2=filterArray(codes);
	//if(codes2.toString()!=codes.toString()) winjinAlert("系统已自动过滤重复号码");
	return {actionData:codes2.join('|'), actionNum:codes2.length}
}
function ssc2xzxdsx(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,''),
	z=[],
	n=0,
	str2='';
	
	str.replace(/[^\d]/gm,'').match(/\d{2}/g).forEach(function(code){
		var str1=code.toString();
		if(parseInt(str1.substr(0,1))==parseInt(str1.substr(1,1))){return false;}
		
		var sum1='';
		var xx=[],yy=0;
		xx[0]=parseInt(str1.substr(0,1));	
		xx[1]=parseInt(str1.substr(1,1));	
		for(i=1;i<2;i++){
			if(xx[i]>xx[0]){yy=xx[0];xx[0]=xx[i];xx[i]=yy;}
		}
		sum1=xx[0]+','+xx[1];
		
		z[n]=sum1;
		if(n>=1){
			for(a=0;a<n;a++){
				if(z[n]==z[a]){n=n-1;code='';break;}
			}
		}
		
		n = n+1;
		str2 = str2 + code;
	});

	str=str2;
		
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	codes=codes.map(function(code){
		return code.split("").join(',')
	});
	codes2=filterArray(codes);
	//if(codes2.toString()!=codes.toString()) winjinAlert("系统已自动过滤重复号码");
	return {actionData:codes2.join('|'), actionNum:codes2.length}
}

/*11选5录入式投注*/
function tz11x5Input(){
	var codeLen=parseInt(this.attr('length'))*2,
	codes=[],
	ncode,
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	codes=codes.map(function(code){
		code=code.split("");
		ncode="";
		code.forEach(function(v,i){
			if(i % 2==0 && ncode){	
				 ncode+=","+v;
			}else{ 
				 ncode+=v;
			}
		});
		return ncode;
	});
	return {actionData:codes.join('|'), actionNum:codes.length}
}

function tz11x5Inputrxds(){
	var codeLen=parseInt(this.attr('length'))*2,codes=[],str=$('#textarea-code',this).val().replace(/[^\d]/g,''),str2=str;
	str2=strCut(str2,2);
	var info=['01','02','03','04','05','06','07','08','09','10','11'];
	if(isRepeat(str2)) throw('号码有重复，请重新输入!');
	if(str.length<codeLen) throw('至少输入'+parseInt(this.attr('length'))+'个号!');
	if(str.length && str.length / codeLen == 1){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符!');
		for(var j=0;j<str2.length;j++){
			if(info.indexOf(str2[j])==-1) throw('号码输入有误，请重新输入!');
		}
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		len=0;
	}
	len=codes.length;
	return {actionData:codes.join('|'), actionNum:len}
}
/*时时彩录入式组选投注*/
function tzSscZuInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[];
	$('#textarea-code',this).val().split(/[\r\n]/).forEach(function(str){
		if(str.length && str.length % codeLen == 0){
			if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
			codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
		}else{
			throw('输入号码不正确');
		}
	});
	codes.forEach(function(code){
		//if((new RegExp("^(\\d)\\1{"+(codeLen-1)+"}$")).test(code)) throw('组选不能为豹子');
	});
	codes=codes.map(function(code){
		return code.split("").join(',')
	});
	return {actionData:codes.join('|'), actionNum:codes.length}
}
/*时时彩录入式选位数投注*/
function tzSscWeiInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();
	if((weizhiTypejsh=='2x_r2d_zuhetouzhu'&&caizhongTypejsh=='30')
			||(weizhiTypejsh=='2x_r3d_zuhetouzhu'&&caizhongTypejsh=='15')
			||(weizhiTypejsh=='dx_r4d_zuhetouzhu'&&caizhongTypejsh=='9')){
		if($('#wei-shu :checked',this).length<codeLen) throw('请选'+codeLen+'位数~');
		$('#wei-shu :checkbox',this).each(function(i){
			if(this.checked) weiShu.push(i);
			//alert(i);
		});
	}else{
		if($('#wei-shu :checked',this).length!=codeLen) throw('请选'+codeLen+'位数~');
		$('#wei-shu :checkbox',this).each(function(i){
			if(!this.checked) weiShu.push(i);
		});
	}	
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	//throw(codes[1]);
	var tcodes=codes.join('');
	//throw(tcodes);
	var code=tcodes.split("");
	//throw(code);
	var temp=['-','-','-','-','-'];
	var weitype=$('#wei-shu').attr('length');
	//var tlen=tcodes.length/weitype;
	//计算是否有重复输入
	/*var arTemp=[];
	for(var i=0;i<tlen;i++){
		arTemp.push(tcodes.substr(i*weitype,weitype));
	}
	var code=[];hsTemp={};reTemp=[];
	for(var i=0;i<arTemp.length;i++){
		if(!hsTemp[arTemp[i]]){
			hsTemp[arTemp[i]]=true;
			var strTemp=arTemp[i].split('');
			for(var kk=0;kk<strTemp.length;kk++){
				code.splice(code.length,0,strTemp[kk]);
			}
		}else{
			reTemp.push(arTemp[i]);
		}
	}*/
	//if(reTemp.length>0) winjinAlert('存在输入重复的数据 '+reTemp.join(','));
	
	tlen=code.length/weitype;
	var k=0;
	var g=0;
	if(weitype==2&&weizhiTypejsh=='2x_r2d_zuhetouzhu'&&caizhongTypejsh=='30'){
		code.forEach(function(v0,i0){
			//throw(v0+'-'+i0);
			if(tlen<=i0)return;
			weiShu.forEach(function(v1,i1){
				weiShu.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						//alert(v1+"-"+v2);
						var temp1=[];
						temp1.push(v1);
						temp1.push(v2);
						k=i0*weitype;
						temp1.forEach(function(v3,i3){
							temp[v3]=code[k];
							k++;
						});
						codes[g]=temp;
						g++;
						temp=['-','-','-','-','-'];
					}
				});
			});
		});
	}else if(weitype==3&&weizhiTypejsh=='2x_r3d_zuhetouzhu'&&caizhongTypejsh=='15'){
		code.forEach(function(v0,i0){
			if(tlen<=i0)return;
			weiShu.forEach(function(v1,i1){
				weiShu.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						weiShu.forEach(function(v3,i3){
							if(v2!=v3&&v2<v3){
								var temp1=[];
								temp1.push(v1);
								temp1.push(v2);
								temp1.push(v3);
								k=i0*weitype;
								temp1.forEach(function(v4,i4){
									temp[v4]=code[k];
									k++;
								});
								codes[g]=temp;
								g++;
								temp=['-','-','-','-','-'];
							}
						});
					}
				});
			});
		});
	}else if(weitype==4&&weizhiTypejsh=='dx_r4d_zuhetouzhu'&&caizhongTypejsh=='9'){
		code.forEach(function(v0,i0){
			if(tlen<=i0)return;
			weiShu.forEach(function(v1,i1){
				weiShu.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						weiShu.forEach(function(v3,i3){
							if(v2!=v3&&v2<v3){
								weiShu.forEach(function(v4,i4){
									if(v3!=v4&&v3<v4){
										var temp1=[];
										temp1.push(v1);
										temp1.push(v2);
										temp1.push(v3);
										temp1.push(v4);
										k=i0*weitype;
										temp1.forEach(function(v5,i5){
											temp[v5]=code[k];
											k++;
										});
										codes[g]=temp;
										g++;
										temp=['-','-','-','-','-'];
									}
								});
							}
						});
					}
				});
			});
		});
	}else{
		codes=codes.map(function(code){
			code=code.split("");
			weiShu.forEach(function(v,i){
				code.splice(v, 0, '-');
			});
			return code.join(',');
		});
	}


	//alert(codes);
	return {actionData:codes.join('|'), actionNum:codes.length}
}
/*11选5录入式选位数投注*/
function tz11x5WeiInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],ncode,
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	if($('#wei-shu :checked',this).length!=codeLen) throw('请选'+codeLen+'位数');
	$('#wei-shu :checkbox',this).each(function(i){
		if(!this.checked) weiShu.push(i);
	});
	codeLen*=2;
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
		codes=codes.map(function(code){
		code=code.split("");
		ncode="";
		code.forEach(function(v,i){
			if(i % 2==0 && ncode){	
				 ncode+=","+v;
			}else{ 
				 ncode+=v;
			}
		});
		ncode=ncode.split(",");
		weiShu.forEach(function(v,i){
			ncode.splice(v, 0, '-');
		});
		return ncode;
	});
	return {actionData:codes.join('|'), actionNum:codes.length}
}
/*时时彩录入式组选位数投注*/
function tzSscZuWeiInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,''),
	z=[],
	n=0,
	str2='';
	
	str.replace(/[^\d]/gm,'').match(/\d{2}/g).forEach(function(code){
		var str1=code.toString();
		if(parseInt(str1.substr(0,1))==parseInt(str1.substr(1,1))){return false;}


		var sum1='';
		var xx=[],yy=0;
		xx[0]=parseInt(str1.substr(0,1));	
		xx[1]=parseInt(str1.substr(1,1));
		xx[2]=parseInt(str1.substr(2,1));	
		for(i=1;i<3;i++){
			if(xx[i]>xx[0]){yy=xx[0];xx[0]=xx[i];xx[i]=yy;}
		}
		for(i=2;i<3;i++){
			if(xx[i]>xx[1]){yy=xx[1];xx[1]=xx[i];xx[i]=yy;}
		}
		sum1=xx[0]+','+xx[1]+','+xx[2];
		
		z.push(sum1);
		
		if(n>=1){
		for(a=0;a<n;a++){
			if(z[n]==z[a]){return false;}
		}
		}
		
		n = n+1;
		str2 = str2 + code;
	});

	str=str2;
	
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();

		if($('#wei-shu :checked',this).length<codeLen) throw('请选'+codeLen+'位数(1)');
		$('#wei-shu :checkbox',this).each(function(i){
			if(this.checked) weiShu.push(i);
			//alert(i);
		});
	
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	//throw(codes[1]);
	var tcodes=codes.join('');
	//throw(tcodes);
	var code=tcodes.split("");
	//throw(code);
	var temp=['-','-','-','-','-'];
	var weitype=$('#wei-shu').attr('length');
	//var tlen=tcodes.length/weitype;
	//计算是否有重复输入
	/*var arTemp=[];
	for(var i=0;i<tlen;i++){
		arTemp.push(tcodes.substr(i*weitype,weitype));
	}
	var code=[];hsTemp={};reTemp=[];
	for(var i=0;i<arTemp.length;i++){
		if(!hsTemp[arTemp[i]]){
			hsTemp[arTemp[i]]=true;
			var strTemp=arTemp[i].split('');
			for(var kk=0;kk<strTemp.length;kk++){
				code.splice(code.length,0,strTemp[kk]);
			}
		}else{
			reTemp.push(arTemp[i]);
		}
	}*/
	//if(reTemp.length>0) winjinAlert('存在输入重复的数据 '+reTemp.join(','));
	
	tlen=code.length/weitype;
	var k=0;
	var g=0;

		code.forEach(function(v0,i0){
			//throw(v0+'-'+i0);
			if(tlen<=i0)return;
			weiShu.forEach(function(v1,i1){
				weiShu.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						//alert(v1+"-"+v2);
						var temp1=[];
						temp1.push(v1);
						temp1.push(v2);
						k=i0*weitype;
						temp1.forEach(function(v3,i3){
							temp[v3]=code[k];
							k++;
						});
						codes[g]=temp;
						g++;
						temp=['-','-','-','-','-'];
					}
				});
			});
		});



	//alert(codes);
	return {actionData:codes.join('|'), actionNum:codes.length}
}
function tzSscZuWeiInputx(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,''),
	z=[],
	n=0,
	str2='';
	
	str.replace(/[^\d]/gm,'').match(/\d{2}/g).forEach(function(code){
		var str1=code.toString();
		if(parseInt(str1.substr(0,1))==parseInt(str1.substr(1,1))){return false;}


		var sum1='';
		var xx=[],yy=0;
		xx[0]=parseInt(str1.substr(0,1));	
		xx[1]=parseInt(str1.substr(1,1));	
		for(i=1;i<2;i++){
			if(xx[i]>xx[0]){yy=xx[0];xx[0]=xx[i];xx[i]=yy;}
		}
		sum1=xx[0]+','+xx[1];
		
		z[n]=sum1;
		if(n>=1){
			for(a=0;a<n;a++){
				if(z[n]==z[a]){n=n-1;code='';break;}
			}
		}
		
		n = n+1;
		str2 = str2 + code;
	});

	str=str2;
	
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();

		if($('#wei-shu :checked',this).length<codeLen) throw('请选'+codeLen+'位数(1)');
		$('#wei-shu :checkbox',this).each(function(i){
			if(this.checked) weiShu.push(i);
			//alert(i);
		});
	
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	//throw(codes[1]);
	var tcodes=codes.join('');
	//throw(tcodes);
	var code=tcodes.split("");
	//throw(code);
	var temp=['-','-','-','-','-'];
	var weitype=$('#wei-shu').attr('length');
	//var tlen=tcodes.length/weitype;
	//计算是否有重复输入
	/*var arTemp=[];
	for(var i=0;i<tlen;i++){
		arTemp.push(tcodes.substr(i*weitype,weitype));
	}
	var code=[];hsTemp={};reTemp=[];
	for(var i=0;i<arTemp.length;i++){
		if(!hsTemp[arTemp[i]]){
			hsTemp[arTemp[i]]=true;
			var strTemp=arTemp[i].split('');
			for(var kk=0;kk<strTemp.length;kk++){
				code.splice(code.length,0,strTemp[kk]);
			}
		}else{
			reTemp.push(arTemp[i]);
		}
	}*/
	//if(reTemp.length>0) winjinAlert('存在输入重复的数据 '+reTemp.join(','));
	
	tlen=code.length/weitype;
	var k=0;
	var g=0;

		code.forEach(function(v0,i0){
			//throw(v0+'-'+i0);
			if(tlen<=i0)return;
			weiShu.forEach(function(v1,i1){
				weiShu.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						//alert(v1+"-"+v2);
						var temp1=[];
						temp1.push(v1);
						temp1.push(v2);
						k=i0*weitype;
						temp1.forEach(function(v3,i3){
							temp[v3]=code[k];
							k++;
						});
						codes[g]=temp;
						g++;
						temp=['-','-','-','-','-'];
					}
				});
			});
		});



	//alert(codes);
	return {actionData:codes.join('|'), actionNum:codes.length}
}

/*组合组选*/
function tzCombineSelect(){

	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],$select=$('.checked'),str='';
	$select.each(function(){
		str+=this.value;
	});
	//str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();
	
	    if($select.length!=codeLen) throw('请选'+codeLen+'位数(1)');
		if($('#wei-shu :checked',this).length<codeLen) throw('请选'+codeLen+'位数(2)');
		$('#wei-shu :checkbox',this).each(function(i){
			if(this.checked) weiShu.push(i);
		});
	
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	var tcodes=codes.join('');
	var code=tcodes.split("");
	var temp=['-','-','-','-','-'];
	var weitype=$('#wei-shu').attr('length');
	
	tlen=code.length/weitype;
	var k=0;
	var g=0;

		code.forEach(function(v0,i0){
			if(tlen<=i0)return;
			weiShu.forEach(function(v1,i1){
				weiShu.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						weiShu.forEach(function(v3,i3){
							if(v2!=v3&&v2<v3){
								var temp1=[];
								temp1.push(v1);
								temp1.push(v2);
								temp1.push(v3);
								k=i0*weitype;
								temp1.forEach(function(v4,i4){
									temp[v4]=code[k];
									k++;
								});
								codes[g]=temp;
								g++;
								temp=['-','-','-','-','-'];
							}
						});
					}
				});
			});
		});
		//throw(codes.join('|'));
		//throw(codes.length);

	return {actionData:codes.join('|'), actionNum:codes.length}

}
/*排列组选*/
function tzPermutationSelect(){

	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],$select=$('.checked'),str='';
	$select.each(function(){
		str+=this.value;
	});
	//str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();
	
	    if($select.length!=codeLen) throw('请选'+codeLen+'位数(1)');
		if($('#wei-shu :checked',this).length<codeLen) throw('请选'+codeLen+'位数(2)');
		$('#wei-shu :checkbox',this).each(function(i){
			if(this.checked) weiShu.push(i);
		});
	
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	var tcodes=codes.join('');
	var code=tcodes.split("");
	var temp=['-','-','-','-','-'];
	var weitype=$('#wei-shu').attr('length');
	
	tlen=code.length/weitype;
	var k=0;
	var g=0;

		code.forEach(function(v0,i0){
			if(tlen<=i0)return;
			weiShu.forEach(function(v1,i1){
				weiShu.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						weiShu.forEach(function(v3,i3){
							if(v2!=v3&&v2<v3){
								var temp1=[];
								temp1.push(v1);
								temp1.push(v2);
								temp1.push(v3);
								k=i0*weitype;
								temp1.forEach(function(v4,i4){
									temp[v4]=code[k];
									k++;
								});
								codes[g]=temp;
								g++;
								temp=['-','-','-','-','-'];
							}
						});
					}
				});
			});
		});
		//throw(codes.join('|'));
		//throw(codes.length);

	return {actionData:codes.join('|'), actionNum:codes.length}

	
}
/*混合组选录入式投注*/
function tzSscHhzxInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();
		if($('#wei-shu :checked',this).length<codeLen) throw('请选'+codeLen+'位数~');
		$('#wei-shu :checkbox',this).each(function(i){
			if(this.checked) weiShu.push(i);
		});	
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	//throw(codes[1]);
	var tcodes=codes.join('');
	//throw(tcodes);
	var code=tcodes.split("");
	//throw(code);
	var temp=['-','-','-','-','-'];
	var weitype=$('#wei-shu').attr('length');
	
	tlen=code.length/weitype;
	var k=0;
	var g=0;

		code.forEach(function(v0,i0){
			if(tlen<=i0)return;
			weiShu.forEach(function(v1,i1){
				weiShu.forEach(function(v2,i2){
					if(v1!=v2&&v1<v2){
						weiShu.forEach(function(v3,i3){
							if(v2!=v3&&v2<v3){
								var temp1=[];
								temp1.push(v1);
								temp1.push(v2);
								temp1.push(v3);
								k=i0*weitype;
								temp1.forEach(function(v4,i4){
									temp[v4]=code[k];
									k++;
								});
								codes[g]=temp;
								g++;
								temp=['-','-','-','-','-'];
							}
						});
					}
				});
			});
		});



	//alert(codes);
	return {actionData:codes.join('|'), actionNum:codes.length}
}



/*时时彩录入式组选位数投注*/
function tzSscZuWeiInput_1(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	if($('#wei-shu :checked',this).length!=codeLen) throw('请选'+codeLen+'位数');
	$('#wei-shu :checkbox',this).each(function(i){
		if(!this.checked) weiShu.push(i);
	});
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	codes.forEach(function(code){
		if((new RegExp("^(\\d)\\1{"+(codeLen-1)+"}$")).test(code)) throw('组选不能为豹子');
	});
	codes=codes.map(function(code){
		code=code.split("");
		weiShu.forEach(function(v,i){
			code.splice(v, 0, '-');
		});
		return code.join(',');
	});
	return {actionData:codes.join('|'), actionNum:codes.length};
}

/*组合组选*/
function tzCombineSelect_1(){
	var codeLen=parseInt(this.attr('length')),
	codes='', $select=$('.checked'),len;
	if($select.length<codeLen) throw('请选'+codeLen+'位数');
	$select.each(function(){
		codes+=this.value;
	});
	len=combine(codes.split(""), codeLen).length;
	return {actionData:codes, actionNum:len};
}
function tzCombineSelect_1x(){
	var codeLen=parseInt(this.attr('length')),
	codes='', $select=$('.checked'),len;
	if($select.length<codeLen) throw('请选'+codeLen+'位数');
	$select.each(function(){
		codes+=this.value;
	});
	len=combine(codes.split(""), codeLen).length;

	if($('#wei-shu :checked',this).length<codeLen) throw('请选'+codeLen+'个及以上位置');
	if($('#wei-shu :checked',this).length==3) len=len * 3;
	if($('#wei-shu :checked',this).length==4) len=len * 6;
	if($('#wei-shu :checked',this).length==5) len=len * 10;
		
	return {actionData:codes, actionNum:len};
}

/*排列组选*/
function tzPermutationSelect_1(){
	var codeLen=parseInt(this.attr('length')),
	codes='', $select=$('.checked'),len;
	if($select.length<codeLen) throw('请选'+codeLen+'位数');
	$select.each(function(){
		codes+=this.value;
	});
	len=permutation(codes.split(""), codeLen).length;
	return {actionData:codes, actionNum:len};
}
/*混合组选录入式投注*/
function tzSscHhzxInput_1(){
	var codeList=$('#textarea-code').val(),	
	played=this.attr('played'),	
	z3=[],
	z6=[],
	z=[],
	n=0;
	var o={"前":[16,17],"中":[289,290],"后":[19,20],"任选":[22,23],"混":[59,60]};
	if(played=='任选' && $('#wei-shu :checked',this).length <3) throw('请选3位及以上的数');
	codeList=codeList.replace(/[^\d]/gm,'');
	if(codeList.length==0) throw('请输入号码');
	if(codeList.length % 3) throw('输入号码不正确');
	codeList.replace(/[^\d]/gm,'').match(/\d{3}/g).forEach(function(code){
		var str=code.toString();
		var ff=0;

		
		var sum1='';
		var xx=[],yy=0;
		xx[0]=parseInt(str.substr(0,1));	
		xx[1]=parseInt(str.substr(1,1));
		xx[2]=parseInt(str.substr(2,1));	
		for(i=1;i<3;i++){
			if(xx[i]>xx[0]){yy=xx[0];xx[0]=xx[i];xx[i]=yy;}
		}
		for(i=2;i<3;i++){
			if(xx[i]>xx[1]){yy=xx[1];xx[1]=xx[i];xx[i]=yy;}
		}
		sum1=xx[0]+','+xx[1]+','+xx[2];
		
		z.push(sum1);
		if(n>=1){
		for(a=0;a<n;a++){
			//alert(z[a]);
			if(z[n]==z[a]){ff=1;}
		}
		}

		

		if(ff==0){
		var reg=/(\d)(.*)\1/;
		if(/(\d)\1{2}/.test(code)){
			throw('组选不能为豹子');
		}else if(reg.test(code)){
			z3.push(code);
		}else{
			z6.push(code);
		}
		
	    }
	    n = n+1;
	});
	if(z3.length && z6.length){
		return [{playedId:o[played][0], playedName:played+'三组三', actionData:z3.join(','), actionNum:z3.length, isZ6:false},
				{playedId:o[played][1], playedName:played+'三组六', actionData:z6.join(','), actionNum:z6.length, isZ6:true}];
	}else if(z3.length){
		return {playedId:o[played][0], playedName:played+'三组三', actionData:z3.join(','), actionNum:z3.length, isZ6:false};
	}else if(z6.length){
		return {playedId:o[played][1], playedName:played+'三组六', actionData:z6.join(','), actionNum:z6.length, isZ6:true};
	}
}
function ssc_z3_r6(){
	var codeLen=parseInt(this.attr('length')),
	codes='', $select=$('.checked'),len;
	var $num=$('#num',this).html();
	if($select.length<codeLen) throw('请选'+codeLen+'位数');
	$select.each(function(){
		codes+=this.value;
	});
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();
	if(weizhiTypejsh=='z3_r6_zuhetouzhu'&&caizhongTypejsh=='23'){
		len=combine(codes.split(""), codeLen).length*$num;
		//len=combine_r3z6(codes.split(""), codeLen).length*$num;
	}else{
		len=combine(codes.split(""), codeLen).length*$num;
	}
	
	return {actionData:codes, actionNum:len};
}








/*大小单双选号*/
function tzDXDSq3h3_2(){
	var code=[], len=1,codeLen=3;
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	this.each(function(i){
		var $code=$('input.code.checked', this);
		if($code.length==0){
			code[i]='-';
		}else{
			len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			code[i]=code[i].join("");
		}
	});
	return {actionData:code.join(','), actionNum:len};
}


/*排列组选*/
function tzPermutationSelect_2(){
	var codeLen=parseInt(this.attr('length')),
	codes='', $select=$('.checked'),len;
	if($select.length<codeLen) throw('请选'+codeLen+'位数');
	$select.each(function(){
		codes+=this.value;
	});
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();
	if(weizhiTypejsh=='z3_r3_zuhetouzhu'&&caizhongTypejsh=='22'){
		//len=permutation2(codes.split(""), codeLen).length;
		len=permutation(codes.split(""), codeLen).length;
	}else{
		len=permutation(codes.split(""), codeLen).length;
	}
	
	return {actionData:codes, actionNum:len};
}
function tzPermutationSelect_2x(){
	var codeLen=parseInt(this.attr('length')),
	codes='', $select=$('.checked'),len;
	if($select.length<codeLen) throw('请选'+codeLen+'位数!');
	$select.each(function(){
		codes+=this.value;
	});
	var weizhiTypejsh=$('#wei-shu').attr('type');
	var caizhongTypejsh=$('input[name="playedId"]').val();
	if(weizhiTypejsh=='z3_r3_zuhetouzhu'&&caizhongTypejsh=='22'){
		//len=permutation2(codes.split(""), codeLen).length;
		len=permutationx(codes.split(""), codeLen).length;
	}else{
		len=permutationx(codes.split(""), codeLen).length;
	}
	
	return {actionData:codes, actionNum:len/2};
}
function permutationx(arr, num){
	var r=[];
	(function f(t,a,n){
		if (n==0) return r.push(t);
		for (var i=0,l=a.length; i<l; i++){
			f(t.concat(a[i]), a.slice(0,i).concat(a.slice(i+1)), n-1);
		}
	})([],arr,num);
	return r;
}
/*混合组选录入式投注*/
function tzSscHhzxInput_2(){
	var codeList=$('#textarea-code').val(),	
	played=this.attr('played'),	
	z3=[],
	z6=[];
	var o={"前":[16,17],"中":[289,290],"后":[19,20],"任选":[22,23],"混":[59,60]};
	var weizhiTypejsh=$('#wei-shu').attr('type');
	if(weizhiTypejsh=='3x_rz3_zuhetouzhu'&&$('#wei-shu').attr('playedIdjsh')=='24'){
		if(played=='任选' && $('#wei-shu :checked',this).length<3) throw('请选3位数');
	}else{
		if(played=='任选' && $('#wei-shu :checked',this).length!=3) throw('请选3位数');
	}
	codeList=codeList.replace(/[^\d]/gm,'');
	if(codeList.length==0) throw('请输入号码');
	if(codeList.length % 3) throw('输入号码不正确');







	var z=[],n=0;
	codeList.replace(/[^\d]/gm,'').match(/\d{3}/g).forEach(function(code){
		var str=code.toString();		
		var ff=0;

		var sum1='';
		var xx=[],yy=0;
		xx[0]=parseInt(str.substr(0,1));	
		xx[1]=parseInt(str.substr(1,1));
		xx[2]=parseInt(str.substr(2,1));	
		for(i=1;i<3;i++){
			if(xx[i]>xx[0]){yy=xx[0];xx[0]=xx[i];xx[i]=yy;}
		}
		for(i=2;i<3;i++){
			if(xx[i]>xx[1]){yy=xx[1];xx[1]=xx[i];xx[i]=yy;}
		}
		sum1=xx[0]+','+xx[1]+','+xx[2];
		
		z.push(sum1);
		if(n>=1){
			for(a=0;a<n;a++){
				//alert(z[a]);
				if(z[n]==z[a]){ff=1;}
			}
		}

		if(ff==0){
			var reg=/(\d)(.*)\1/;
			if(/(\d)\1{2}/.test(code)){
				throw('组选不能为豹子');
			}else if(reg.test(code)){
				z3.push(code);
			}else{
				z6.push(code);
			}
	    }
	    n = n+1;
	    
	});




	
	if(z3.length && z6.length){
		return [{playedId:o[played][0], playedName:played+'三组三', actionData:z3.join(','), actionNum:z3.length, isZ6:false},
				{playedId:o[played][1], playedName:played+'三组六', actionData:z6.join(','), actionNum:z6.length, isZ6:true}];
	}else if(z3.length){
		return {playedId:o[played][0], playedName:played+'三组三', actionData:z3.join(','), actionNum:z3.length, isZ6:false};
	}else if(z6.length){
		return {playedId:o[played][1], playedName:played+'三组六', actionData:z6.join(','), actionNum:z6.length, isZ6:true};
	}
}








/*十一选五任选玩法投注*/
function tz11x5Select(){
	var code=[], len=1,codeLen=parseInt(this.attr('length')),sType=!!$('.dantuo :radio:checked').val();
	if(sType){
		var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
		if(dLen==0){
			throw('至少选一位胆码');
		}else if(dLen>=codeLen){
			throw('最多只能选择'+(codeLen-1)+'个胆码');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
			len=combine(tCode, codeLen-dCode.length).length;
			return {actionData:'('+dCode.join(' ')+')'+tCode.join(' '), actionNum:len};
		}
	}else{
		$(':input:visible.code.checked').each(function(i,o){
			code[i]=o.value;
		});
		if(code.length<codeLen) throw('至少选择'+codeLen+'位数');
		return {actionData:code.join(' '), actionNum:combine(code, codeLen).length};
	}
}

function lhc_2z2(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen<2){
			throw('至少选2位数');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			len=combine(dCode, codeLen).length;
			return {actionData:dCode.join(' '), actionNum:len};
		}
}

function lhc_3z3(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen<3){
			throw('至少选3位数');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			len=combine(dCode, codeLen).length;
			return {actionData:dCode.join(' '), actionNum:len};
		}
}

function lhctmdx(){
	var code=[],len=1,codeLen=parseInt(this.attr('length'));
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen!=1){
			throw('请选择一种形态');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			return {actionData:dCode.join(' '), actionNum:len};
		}
}

function lhc_5bz(){
	var code=[],len=1,codeLen=parseInt(this.attr('length'));
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen!=5){
			throw('请选择5个号码');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			return {actionData:dCode.join(' '), actionNum:len};
		}
}

function lhc_7bz(){
	var code=[],len=1,codeLen=parseInt(this.attr('length'));
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen!=7){
			throw('请选择7个号码');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			return {actionData:dCode.join(' '), actionNum:len};
		}
}

function ssc_5z_120(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen<5){
			throw('至少选5位数');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			len=combine(dCode, codeLen).length;
			return {actionData:dCode.join(','), actionNum:len};
		}
}

function ssczx60(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var c;var anum=0;var bnum=0;var d;
	var sele_count= new Array('0','0','0','1','4','10','20','35','56','84');
	var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
	    tLen=$('.code.checked', $t).length;
		if(dLen==0){
			throw('至少选一位二重号');
		}else if(tLen<3){
			throw('至少选三位单号');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
			num=Sames(dCode,tCode);
		    if(tLen-1>=0){c=tLen-1;}else{c=0;}
	        if(num-1>=0){if(dLen-num==0){anum=sele_count[c]*dLen;}if(dLen-num>0){anum=sele_count[tLen]*(dLen-num)+sele_count[c]*num;}}else{anum=sele_count[tLen]*dLen;}
			len=parseInt(anum);
			return {actionData:dCode.join('')+','+tCode.join(''), actionNum:len};
		}
}
function ssczx30(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var d;
	var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
	    tLen=$('.code.checked', $t).length;
		if(dLen<2){
			throw('至少选两位二重号');
		}else if(tLen<1){
			throw('至少选一位单号');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
			for (i=0;i<dLen-1;i++){d=i+1;for (j=d;j<dLen;j++){for (c=0;c<tLen;c++){if(dCode[i]-tCode[c]!=0 && dCode[j]-tCode[c]!=0){bnum=bnum+1;}}}}
			len=bnum;
			return {actionData:dCode.join('')+','+tCode.join(''), actionNum:len};
		}
}
function ssczx20(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var d;
	var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
	    tLen=$('.code.checked', $t).length;
		if(dLen<1){
			throw('至少选一位三重号');
		}else if(tLen<2){
			throw('至少选两位单号');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
			for (i=0;i<tLen-1;i++){d=i+1;for (j=d;j<tLen;j++){for (c=0;c<dLen;c++){if(tCode[i]-dCode[c]!=0 && tCode[j]-dCode[c]!=0){bnum=bnum+1;}}}}
			len=bnum;
			return {actionData:dCode.join('')+','+tCode.join(''), actionNum:len};
		}
}
function ssczx10(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;
	var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
	    tLen=$('.code.checked', $t).length;
		if(dLen<1){
			throw('至少选一位三重号');
		}else if(tLen<1){
			throw('至少选一位二重号');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
			for (i=0;i<dLen;i++){for (j=0;j<tLen;j++){if(dCode[i]-tCode[j]!=0){bnum=bnum+1;}}}
			len=bnum;
			return {actionData:dCode.join('')+','+tCode.join(''), actionNum:len};
		}
}
function ssczx5(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;
	var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
	    tLen=$('.code.checked', $t).length;
		if(dLen<1){
			throw('至少选一位四重号');
		}else if(tLen<1){
			throw('至少选一位单号');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
			for (i=0;i<dLen;i++){for (j=0;j<tLen;j++){if(dCode[i]-tCode[j]!=0){bnum=bnum+1;}}}
			len=bnum;
			return {actionData:dCode.join('')+','+tCode.join(''), actionNum:len};
		}
}
function ssczx24(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var sele_count= new Array('0','0','0','1','5','15','35','70','126','210');
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen<4){
			throw('至少选择四位！');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			var endnum=0;var num=dCode.length-1;endnum=parseInt(sele_count[num]);
			len=endnum;
			return {actionData:dCode.join(','), actionNum:len};
		}
}
function ssczx12(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var a;var b;var c;
	var anum=0;var bnum=0;var c;var d;
	var sele_count= new Array('0','1','3','6','10','15','21','28','36');
	var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
	    tLen=$('.code.checked', $t).length;
		if(dLen<1){
			throw('至少选一位二重号');
		}else if(tLen<2){
			throw('至少选两位单号');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
			num=Sames(dCode,tCode);  
            if(tLen-1>=0){c=tLen-1;}else{c=0;}
	        if(tLen-2>=0){d=tLen-2;}else{d=0;} 
	        if(num-1>=0){
		    if(dCode.length-num==0){c=tLen-2;anum=sele_count[c]*dCode.length;}
		    if(dCode.length-num>0){c=tLen-2;anum=sele_count[c]*num;anum=anum+sele_count[tLen-1]*(dCode.length-num);}
	        }else{if(tLen-1>=0){c=tLen-1;}else{c=0;}anum=sele_count[c]*dCode.length;}
	        endnum=parseInt(anum);
			len=endnum;
			return {actionData:dCode.join('')+','+tCode.join(''), actionNum:len};
		}
}
function ssczx6(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var sele_count= new Array('0','0','1','3','6','10','15','21','28','36','45');
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen<2){
			throw('至少选择两位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			var endnum=sele_count[dLen];
			len=endnum;
			return {actionData:dCode.join(','), actionNum:len};
		}
}
function ssczx4(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var a;var b;var c;var d_arr=new Array();
	var anum=0;var bnum=0;var d;
	var sele_count= new Array('0','1','2','3','4','5','6','7','8','9');
	var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
	    tLen=$('.code.checked', $t).length; 
		if(dLen<1){
			throw('至少选一位三重号');
		}else if(tLen<1){
			throw('至少选一位单号');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
		    for(var e=0;e<dCode.length;e++){
		    var this_num=dCode[e];
		    d_arr=drop_array_lines(tCode,this_num); 
		    endnum+=d_arr.length;
	        }
			len=endnum;
			return {actionData:dCode.join('')+','+tCode.join(''), actionNum:len};
		}
}
function ssch3zxhz(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var sele_count= new Array('1','2','2','4','5','6','8','10','11','13','14','14','15','15','14','14','13','11','10','8','6','5','4','2','2','1');
	var endnum=0;var num;

	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
        
		if(dLen<1){
			throw('至少选择一位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
		    for (i=0;i<dCode.length;i++){num=dCode[i]-1;endnum=endnum+parseInt(sele_count[num]);} 
			len=endnum;
			return {actionData:dCode.join(','), actionNum:len};
		}
}
function ssch3ts(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));

	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
        
		if(dLen<1){
			throw('至少选择一位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			len=dLen;
			return {actionData:dCode.join(','), actionNum:len};
		}
}
function ssch3kd(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
    var sele_count= new Array('10','54','96','126','144','150','144','126','96','54');
	var endnum=0;var num;
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
        
		if(dLen<1){
			throw('至少选择一位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			for(i=0;i<dCode.length;i++){num=dCode[i];if(num-1>=-1){endnum=endnum+parseInt(sele_count[num]);}}
			len=endnum;
			return {actionData:dCode.join(','), actionNum:len};
		}
}

function sscq3qw2x(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var a;var b;var c;var d_arr=new Array();
	var anum=0;var bnum=0;var c;var d;
	var sele_count= new Array('0','1','2','3','4','5','6','7','8','9');
	var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
	    tLen=$('.code.checked', $t).length; 
		if(dLen<1){
			throw('至少选一位三重号');
		}else if(tLen<1){
			throw('至少选一位单号');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
		    for(var e=0;e<dCode.length;e++){
		    var this_num=dCode[e];
		    d_arr=drop_array_lines(tCode,this_num); 
		    endnum+=d_arr.length;
	        }
			return {actionData:dCode.join('')+','+tCode.join(''), actionNum:endnum};
		}
}

function ssc2xh2zxbd(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
    var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;var alist= new Array;var blist= new Array
	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
		if(dLen<1){
			throw('至少选择一位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var c;var d;var alist= new Array;var blist= new Array 
	        for (j=0;j<10;j++){for (c=j;c<10;c++){if(j-c!=0){if(dCode-c==0 || dCode-j==0){bnum=bnum+1;}}}} 
			return {actionData:dCode.join(','), actionNum:bnum};
		}
}

function zxhz3d(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var sele_count= new Array('1','3','6','10','15','21','28','36','45','55','63','69','73','75','75','73','69','63','55','45','36','28','21','15','10','6','3','1');
	var endnum=0;var num;

	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
        
		if(dLen<1){
			throw('至少选择一位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
		    for (i=0;i<dCode.length;i++){num=dCode[i];endnum=endnum+parseInt(sele_count[num]);} 
			len=endnum;
			return {actionData:dCode.join(','), actionNum:len};
		}
}

function zuxhz3d(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var sele_count= new Array('1','2','2','4','5','6','8','10','11','13','14','14','15','15','14','14','13','11','10','8','6','5','4','2','2','1');
	var endnum=0;var num;

	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
        
		if(dLen<1){
			throw('至少选择一位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
		    for (i=0;i<dCode.length;i++){num=dCode[i]-1;endnum=endnum+parseInt(sele_count[num]);} 
			len=endnum;
			return {actionData:dCode.join(','), actionNum:len};
		}
}

function sscq2zhixhz(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var a;var b;var c;var anum=0;var bnum=0;var cnum=0;var bnum=0;var d;var alist= new Array;var blist= new Array;

	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
        
		if(dLen<1){
			throw('至少选择一位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
		    alist=dCode;a=dLen;
			for (i=0;i<a;i++){for (j=0;j<10;j++){for (c=0;c<10;c++){if(j+c-alist[i]==0){bnum=bnum+1;}}}}
			return {actionData:dCode.join(','), actionNum:bnum};
		}
}

function sscqh2zhuxhz(){
	var code=[], len=1,codeLen=parseInt(this.attr('length'));
	var endnum=0;var num=0;var a;var b;var c;var d;var anum=0;var bnum=0;var cnum=0;var alist= new Array;var blist= new Array;

	var $d=$(this).filter(':visible:first'),
		dLen=$('.code.checked', $d).length;
        
		if(dLen<1){
			throw('至少选择一位！');
		}else{
			var dCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
		    alist=dCode;a=dLen;
			for (i=0;i<a;i++){b=alist[i];for (j=0;j<10;j++){for (c=j;c<10;c++){if(j-c!=0){if(b-j-c==0){bnum=bnum+1;}}}}}
			return {actionData:dCode.join(','), actionNum:bnum};
		}
}

/*快乐十分任选玩法投注*/
function tzKLSFSelect(){
	var code=[], len=1,codeLen=parseInt(this.attr('length')),sType=!!$('.dantuo :radio:checked').val();
	if(sType){
		var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
		
		if(dLen==0){
			throw('至少选一位胆码');
		}else if(dLen>=codeLen){
			throw('最多只能选择'+(codeLen-1)+'个胆码');
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.value;
			});
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.value;
			});
			len=combine(tCode, codeLen-dCode.length).length;
			return {actionData:'('+dCode.join(' ')+')'+tCode.join(' '), actionNum:len};
		}
	}else{
		$(':input:visible.code.checked').each(function(i,o){
			code[i]=o.value;
		});
		if(code.length<codeLen) throw('至少选择'+codeLen+'位数');
		return {actionData:code.join(' '), actionNum:combine(code, codeLen).length};
	}
}
function GetRandomNum(Min,Max)
{   
	var Range = Max - Min;   
	var Rand = Math.random();   
	return(Min + Math.round(Rand * Range));   
}
function Sames(a,b){
	var num=0;
	for (i=0;i<a.length;i++)
	{   var zt=0;
		for (j=0;j<b.length;j++)
		{
			if(a[i]-b[j]==0){
				zt=1;
			}
		}
		if(zt==1){
			num+=1; 
		}
	}
	return num;
}
function drop_array_lines(arr,num){
	var drop_arr=new Array();
	for(o=0;o<arr.length;o++){
		if(parseInt(arr[o],10)-parseInt(num,10)==0){ 
			 
		}else{
			drop_arr.push(arr[o]); 
		}
	}
	return drop_arr;
}
function indexSign(err, data){
	$('#sign').css('display','none');
	if(err){
		winjinAlert(err);
	}else{
		reloadMemberInfo();
		winjinAlert(data);
	}
} 
function wi1njinAlert(tips,style,minH){
  layer.open({
  icon: 9,
  content: (tips) ,
  scrollbar: false,
  btn:"确定"
});
}

function winjinAlert(tips) {			
	 layer.open({
		
		content: tips,
		timeout: 2,
		onyes: true,
		btn:"确定"
	});
		
}
function updateThisNo(){
	  $.get(location.href,function(r){
		return $('.thisno').html($(r).find('.thisno').text())
	  })
	}
//获取本期盈亏

function Combination(c, b) {
    b = parseInt(b);
    c = parseInt(c);
    if (b < 0 || c < 0) {
        return false
    }
    if (b == 0 || c == 0) {
        return 1
    }
    if (b > c) {
        return 0
    }
    if (b > c / 2) {
        b = c - b
    }
    var a = 0;
    for (i = c; i >= (c - b + 1) ; i--) {
        a += Math.log(i)
    }
    for (i = b; i >= 1; i--) {
        a -= Math.log(i)
    }
    a = Math.exp(a);
    return Math.round(a)
}
function strCut(str, len){
	var strlen = str.length;
	if(strlen == 0) return false;
	var j = Math.ceil(strlen / len);
	var arr = Array();
	for(var i=0; i<j; i++)
		arr[i] = str.substr(i*len, len)
	return arr;
}

function filterArray(arrs){
    var k=0,n=arrs.length; 
	var arr = new Array(); 
    for(var i=0;i<n;i++)
    {
        for(var j=i+1;j<n;j++)
        {
            if(arrs[i]==arrs[j])
            {
                arrs[i]=null;
                break;
            }
        }
    }    
    for(var i=0;i<n;i++)
    {
        if(arrs[i])
        {
            arr[k++]=arrs[i]; // arr.push(this[i]);
        }
    } 
    return arr;
}



//base64加密
var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
var base64DecodeChars = new Array(
　　-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
　　-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
　　-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63,
　　52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1,
　　-1,　0,　1,　2,　3,  4,　5,　6,　7,　8,　9, 10, 11, 12, 13, 14,
　　15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1,
　　-1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
　　41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);
function base64_encode(str) {
　　var out, i, len;
　　var c1, c2, c3;
　　len = str.length;
　　i = 0;
　　out = "";
　　while(i < len) {
 c1 = str.charCodeAt(i++) & 0xff;
 if(i == len)
 {
　　 out += base64EncodeChars.charAt(c1 >> 2);
　　 out += base64EncodeChars.charAt((c1 & 0x3) << 4);
　　 out += "==";
　　 break;
 }
 c2 = str.charCodeAt(i++);
 if(i == len)
 {
　　 out += base64EncodeChars.charAt(c1 >> 2);
　　 out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
　　 out += base64EncodeChars.charAt((c2 & 0xF) << 2);
　　 out += "=";
　　 break;
 }
 c3 = str.charCodeAt(i++);
 out += base64EncodeChars.charAt(c1 >> 2);
 out += base64EncodeChars.charAt(((c1 & 0x3)<< 4) | ((c2 & 0xF0) >> 4));
 out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >>6));
 out += base64EncodeChars.charAt(c3 & 0x3F);
　　}
　　return out;
}




