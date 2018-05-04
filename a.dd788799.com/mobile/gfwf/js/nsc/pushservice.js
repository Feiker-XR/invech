var publicPushStream, pushstreamObject;
var pushModule = $.parseJSON(pushServiceObj.pushModule);

//初始化方法
function pushInit(url) {
	if (pushstreamObject) {
		pushstreamObject.disconnect();
	}
	pushstreamObject = getPushStream(url);
	if (typeof pushstreamObject == "object") {
		pushstreamObject.disconnect();
		pushstreamObject.onmessage = broadcastFun;
		pushstreamObject.onerror = broadcastError;
		pushstreamObject.addChannel(pushServiceObj.pubChannelId);
		pushstreamObject.addChannel(pushServiceObj.userChannelId);
		pushstreamObject.connect();
		return pushstreamObject;
	}
}

$(document).ready(function(){
	publicPushStream = pushInit(pushServiceObj.pushServerHost);
});


/*广播信息方法*/
function broadcastFun(data) {
	var obj = (typeof data === "string") ? jQuery.parseJSON(data) : data;
	
	if (!obj.module || !obj.data) {
		return;
	}
	pullFun(obj.module, obj.data);
};

/*异常处理方法*/
function broadcastError(){
	pushServiceObj.pushStatus = "0";
	publicPushStream.disconnect();
	
	//推送服务器出错处理
	//当推送服务器第一次出错
	if(pushServiceObj.pushServerStatus == "good" || pushServiceObj.pushServerStatus == "warning"){
		//修改服务器状态
		pushServiceObj.pushServerStatus = "warning";
		pushServiceRestart(pushServiceObj.pushDelayNum);
	}
	
}

/*服务器500错误变为轮训后，隔断时间重连推送，超过最大次数后保持轮训机制*/
function pushServiceRestart(num){
	var arrTime = pushServiceObj.pushDelayTime.split(",");
	var len = arrTime.length;
	if(pushServiceObj.pushDelayMaxNum == pushServiceObj.pushDelayNum){
		pushServiceObj.pushServerStatus = "dead";
		return;
	}
	if(pushServiceObj.pushDelayMaxNum == len){//检查时间间隔和重启推送次数是否对应
		//如果在规定的时间间隔中推送服务正常启动了或者到达启动次数上限就不做处理
		if(pushServiceObj.pushDelayMaxNum == pushServiceObj.pushDelayNum && pushServiceObj.pushServerStatus == "warning"){
			pushServiceObj.pushServerStatus = "dead";
			return;
		}else{
			window.setTimeout(function(){
				num++;
				if(num <= pushServiceObj.pushDelayMaxNum){
					pushServiceObj.pushStatus = "0";
					pushServiceObj.pushDelayNum = num;
					//如果推送服务是页面初始化过后宕掉
					if(typeof $.globelData === 'object'){//判断是首页逻辑
						if($.globelData.reviewStatus){//如果页面初始化过
							$.globelData.getBigJson("update");
						}else{//如果推送服务是一开始就宕掉
							$.globelData.getBigJson("init");
						}
					}

					//历史奖期推送
					$.getHistoryFun(pushServiceObj,pushModule,{});
				}
			},arrTime[num]*1000);
		}
	}else{
		alert("请检查延迟推送发起的时间间隔与次数是否对应");
	}
}


//获取推送数据后的相关处理
function pullFun(module, data) {
	if (typeof data == "object"){
		var funList;

		//公共模块
		var publicList = {
			"lottery_data" : function(data) {//用于存所有彩种的数据，目前主要用来矫正倒计时
				$.globelData.bigJson = data;
				$.globelTimer.reSet();
			},
			"push_service" : function(data) {//推送服务处理
				//如果关闭推送
				if (data.is_enabled != undefined && data.is_enabled == "0") {
					pushServiceObj.pushStatus = "0";
					publicPushStream.disconnect();
					if(typeof $.globelData === 'object'){//判断是首页逻辑
						if($.globelData.reviewStatus){//如果页面初始化过
							$.globelData.getBigJson("update");
						}else{
							$.globelData.getBigJson("init");
						}
					}

					//历史奖期推送
					$.getHistoryFun(pushServiceObj,pushModule,{});
					return;
				}
				
				//修改服务器状态
				pushServiceObj.pushStatus = "1";
				pushServiceObj.pushDelayNum = 0;
				pushServiceObj.pushServerStatus = "good";
				
				//如果切换了推送域名
				if (data.push_server_host != undefined && data.push_server_host != pushServiceObj.pushServerHost) {
					publicPushStream.disconnect();
					pushServiceObj.pushServerHost = data.push_server_host;
					pushInit(pushServiceObj.pushServerHost);
				}
				
				// 如果变更了公共频道ID
				if (data.public_chid != undefined && data.public_chid != pushServiceObj.pubChannelId) {
					publicPushStream.removeChannel(pushServiceObj.pubChannelId);
					pushServiceObj.pubChannelId = data.public_chid;
					publicPushStream.addChannel(pushServiceObj.pubChannelId);
				}

			},
			"issue_data" : function(data){//用于处理历史奖期的方法
				var lottery_id,lottery_history,issue,code,codeHtml = '',page_lottery_id = lottery_key.split('-')[1];
				$.each(data,function(key,value){
					lottery_id = key;//id
					lottery_history = value;//获取所有历史奖期
				});

				if(lottery_history.length == 1){
					$.each(lottery_history,function(k,v){
						issue = v["issue"];
						code = v["code"];
					});
				}else{
					return false;
				}

				//重新渲染
				if(lottery_id === page_lottery_id){
					//重新渲染首页信息
					$.globelData.bigJson["lottery_" +　lottery_id]["issue"]=issue;
					$.globelData.bigJson["lottery_" +　lottery_id]["code"]=code;
					
					//重新渲染子容器信息
					var hdata = {
						"issue" : issue,
						"code" : code,
						"iscurent" : 2
					};
					$.getHistoryFun(pushServiceObj,pushModule,hdata);
					$.funList.tzjlfn();//获取投注记录
				}
			},
			"notice" : function(data){//公告模块
				var title,sendtime,tag = "【公告】",_html = "",_id;
				title = data["title"];
				sendtime = data["sendtime"].split(" ")[0];
				_id = data["id"];
				if($(".gg_list").length===1){//大厅页面公告
					_html += '<li>' +
                                '<a title="系统公告" href="javascript:void(0)" class="notice" url="/?controller=help&action=noticelist&nid=' + _id + '">' + tag + title +'</a>' +
                                '<span style="display: inline;">' + sendtime + '</span>' +
                            '</li>';
                    $(_html).prependTo(".gg_list ul");
                    $(".gg_list ul li:first").children().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();
               		//$(".gg_list ul").prepend(_html); 
				}
				if($(".recentConGG").length===1){//购彩页面公告
					_html += '<li>' + 
								'<a title="系统公告" class="notice" href="javascript:void(0)" url="/?controller=help&action=noticelist&nid=' + _id + '">' + tag + title +'</a>' + 
							'</li>';

					$(_html).prependTo(".recentConGG ul");
					$(".recentConGG ul li:first").children().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();
				}
			  	$(".notice").unbind("click").on("click",function(){
			  		$(this).layer({height:"567","scale":false});
			  	});

			}
		};


		//用户模块

		var userList = {
			"user_balance" : function(data) {//用户余额

				var availablebalance = data.availablebalance;
				$("#refff").html(moneyFormat(availablebalance).substr(0,14)).attr("title",moneyFormat(availablebalance));
			},
			"user_message": function(data){//站内信
				var count,title,content,link,time,sender,is_show;
				count = data["count"] - 0;
				title = data["message"]["title"];
				content = data["message"]["content"];
				link = data["message"]["link"];
				time = data["message"]["time"];
				sender = data["message"]["sender"];
				is_show = data["message"]["is_show"];

				$(".msg_num a,.ui_msgnum").html(count).show();
				if(is_show === true && count > 0){
					$(".msg_num,.ui_msgnum").fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();
				}
			},
			"user_project" : function(data){//用户投注中奖推送模块
				var bonus,code,issue,lotteryid,projectid;
				bonus = data["bonus"];
				code = data["code"];
				issue = data["issue"];
				lotteryid = data["lotteryid"];
				projectid = data["projectid"];
				if($(".C_" + projectid).length === 1){
					$(".C_" + projectid).html(code).fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();	
				}
				if($(".S_" + projectid).length === 1){
					$(".S_" + projectid).html("已派奖").addClass("orange").fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();	
				}
				if($(".B_" + projectid).length === 1){
					$(".B_" + projectid).html(bonus).fadeOut().fadeIn().fadeOut().fadeIn().fadeOut().fadeIn();	
				}
			}
		};
		
		funList = $.extend({},publicList,userList);
		if (typeof funList[module] == "function") {
			funList[module](data);
		}
	} else {
		//console.log(data);
		alert("bigJson异常");
	}
}

function getPushStream(url) {
	var host,port;
	if (pushServiceObj.pushStatus == "0") {
		return "";
	}

	if (url != undefined && pushServiceObj.pushStatus == "1") {
		// 解析推送服务URL
		if (url.split(":").length != 1) {
			host = url.split(":")[0];
			port = url.split(":")[1] || "80";
		} else {
			host = url;
			port = "80";
		}
		
		// 实例化 PushStream
		return new PushStream({
			host: host,
			port: port,
			modes: "longpolling",
			messagesControlByArgument: false,
			tagArgument: 'tag', //this is the default value, you have to change it to be the same value used on push_stream_last_received_message_tag directive
			timeArgument: 'time', //this is the default value, you have to change it to be the same value used on push_stream_last_received_message_time directive
			extraParams: function() {
				return {'token':pushServiceObj.pubToken};
			},
			useJSONP: true, //this is used only to force jsonp usage on example, it is automatic true when the domains are different
			timeout: 30000         //this is the default value, you have to change it to be the same value used on push_stream_longpolling_connection_ttl directive in miliseconds
		});
	}

	return "";
}