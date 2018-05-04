var lhc_ball_color = {
	'01':'color_red', '02':'color_red', '07':'color_red', '08':'color_red', '12':'color_red', '13':'color_red',
	'18':'color_red', '19':'color_red', '23':'color_red', '24':'color_red', '29':'color_red', '30':'color_red',
	'34':'color_red', '35':'color_red', '40':'color_red', '45':'color_red', '46':'color_red',
	
	'03':'color_blue', '04':'color_blue', '09':'color_blue', '10':'color_blue', '14':'color_blue', '15':'color_blue',
	'20':'color_blue', '25':'color_blue', '26':'color_blue', '31':'color_blue', '36':'color_blue', '37':'color_blue',
	'41':'color_blue', '42':'color_blue', '47':'color_blue', '48':'color_blue',
	
	'05':'color_green', '06':'color_green', '11':'color_green', '16':'color_green', '17':'color_green', '21':'color_green',
	'22':'color_green', '27':'color_green', '28':'color_green', '32':'color_green', '33':'color_green', '38':'color_green',
	'39':'color_green', '43':'color_green', '44':'color_green', '49':'color_green'
};

var pcdd_ball_color = {
	'0':'color_grey', '1':'color_green', '2':'color_blue', '3':'color_red', '4':'color_green', '5':'color_blue', '6':'color_red', '7':'color_green', '8':'color_blue',
	'9':'color_red', '10':'color_green', '11':'color_blue', '12':'color_red', '13':'color_grey', '14':'color_grey', '15':'color_red', '16':'color_green', '17':'color_blue',
	'18':'color_red', '19':'color_green', '20':'color_blue', '21':'color_red', '22':'color_green', '23':'color_blue', '24':'color_red', '25':'color_green', '26':'color_blue', '27':'color_grey'
};

requirejs(["jquery"], function($) {
    var gameShowType = 1; //1:列表，2:方格
    $('.head-list').click(function() {
        gameShowType = 2;
        $('.lottery-list').show();
        $('.lottery-list-erect').hide();
        $(this).parents('.ui-toolbar-right').removeClass('ui-head');
    });
    $('.head-icon').click(function() {
        gameShowType = 1;
        $('.lottery-list').hide();
        $('.lottery-list-erect').show();
        $(this).parents('.ui-toolbar-right').addClass('ui-head');
    });
    //menu
    $('div.lott-menu li').click(function() {
        var cat = $(this).data('cat');
        if (cat == 1) { //高频
            $('div.lottery-list li.game_category_2').hide();
            $('div.lottery-list-erect li.game_category_2').hide();
            $('div.lottery-list li.game_category_1').show();
            $('div.lottery-list-erect li.game_category_1').show();
        } else if (cat == 2) { //低频
            $('div.lottery-list li.game_category_1').hide();
            $('div.lottery-list-erect li.game_category_1').hide();
            $('div.lottery-list li.game_category_2').show();
            $('div.lottery-list-erect li.game_category_2').show();
        } else { //全部
            $('div.lottery-list li').show();
            $('div.lottery-list-erect li').show();
        }
        for (var i = 0; i < 3; i++) {
            if (i == cat) { //选中
                $('div.lott-menu li.nav_category_' + i).hide();
                $('div.lott-menu li.nav_sel_' + i).show();
            } else { //未选中
                $('div.lott-menu li.nav_category_' + i).show();
                $('div.lott-menu li.nav_sel_' + i).hide();
            }
        }
    });
    //投注信息
    $(function() {
        getNextPeriod();
    });

    function getLastResult() {
        $.ajax({
            url: '/index/hall/getLastDraw',
            type: 'POST',
            dataType: 'json',
            timeout: 30000,
            success: function(results) {
                var data=results.data;
                if (data.itemCount <= 0) {
                    return;
                }
                var txtHtml = '';
                for (var i = 0; i < data.itemCount; i++) {
                    var gid = data.items[i].num;
                    var period = data.items[i].period;
                    var opennum = data.items[i].content;
                    opennum = (opennum == undefined || opennum == '') ? '等待开奖' : opennum.replace(/\|/g, ' ');
                    $('span.last_period_' + gid).text('第' + period + '期');
                    
                    if(opennum != '等待开奖') {
                    	var temp = '';
                    	var lastnum = opennum.replace(/\|/g, ' ');
                        lastnum = lastnum.split(' ');
                    	if(gid=="41" || gid=="42") {
                    		temp = lastnum[0]+' + '+lastnum[1]+' + '+lastnum[2]+' = <b style="color:' + pcdd_ball_color[lastnum[3]].replace('color_', '') + '">'+lastnum[3]+'</b>';
                        } else if(gid == 18) {
                    		for(var i=0;i<lastnum.length;i++){
                        		if(i==6) {
                        			temp += "\+&nbsp;<b style=\"color:" + lhc_ball_color[lastnum[i]].replace('color_', '') + "\">"+lastnum[i]+"</b>";
                        		} else {
                        			temp += "<b style=\"color:" + lhc_ball_color[lastnum[i]].replace('color_', '') + "\">"+lastnum[i]+"</b>&nbsp;";
                        		}
                    		}
                        }
                    	opennum = temp;
                    } else {
                    	opennum = '<b style="color:red;">' + opennum + '</b>';
                    }
                    $('p.last_open_' + gid).html(opennum);
                }
            }
        });
    }

    //获取下一期相关数据
    lefttimes = {1:'0',2:'0',3:'0',4:'0',5:'0',7:'0',9:'0',
    	    10:'0',11:'0',12:'0',13:'0',14:'0',15:'0',16:'0',17:'0',18:'0',28:'0',41:'0',42:'0',51:'0',52:'0'};
    isCanGetNext = true;

    function getNextPeriod(all) {
        if (!isCanGetNext) {
            return;
        }
        isCanGetNext = false;
        var param = '';
        for (var k in lefttimes) {
            if (all != 1 && lefttimes[k] > 1) {
                continue;
            }
            if (param != '') {
                param += ',';
            }
            param += k;
        }
        $.ajax({
            url: 'index.php/index/getNextPeriod',
            type: 'GET',
            dataType: 'json',
            data: {
            },
            timeout: 30000,
            success: function(results) {
            	var data=results.data;
                if (data.itemCount > 0) {
                    for (var j = 0; j < data.itemCount; j++) {
                        var gid = data.items[j].gameId;
                        lefttimes[gid] = data.items[j].timeout;
                        
                        $('span.period_msg_'+gid).text('截止');
                        if(data.items[j].isOpen==0) {
                        	$('span.period_msg_'+gid).text('开盘');
                        }
                        $('span.period_show_' + gid).text(data.items[j].issue);
                        //上一期信息
                        $('span.last_period_' + gid).text('第' + data.items[j].lastIssue + '期');
                        var lastnum = data.items[j].lastIssueNum;
                        if (gid=="41" || gid=="42") {
                            if (lastnum != undefined && lastnum != '') {
                            	lastnum = lastnum.replace(/\|/g, ' ')
                                lastnum = lastnum.split(' ');
                                lastnum = lastnum[0]+' + '+lastnum[1]+' + '+lastnum[2]+' = <b style="color:' + pcdd_ball_color[lastnum[3]].replace('color_', '') + '">'+lastnum[3]+'</b>';
                            } else {
                                lastnum = '等待开奖';
                            }
                        } else if(gid == 18) {
                        	var temp = '';
                        	if(lastnum != undefined && lastnum != '') {
                        		lastnum = lastnum.replace(/\|/g, ' ')
                                lastnum = lastnum.split(' ');
                        		for(var i=0;i<lastnum.length;i++){
	                        		if(i==6) {
	                        			temp += "\+&nbsp;<b style=\"color:" + lhc_ball_color[lastnum[i]].replace('color_', '') + "\">"+lastnum[i]+"</b>";
	                        		} else {
	                        			temp += "<b style=\"color:" + lhc_ball_color[lastnum[i]].replace('color_', '') + "\">"+lastnum[i]+"</b>&nbsp;";
	                        		}
                        		}
                            }
                        	lastnum = temp == '' ? '等待开奖' : temp;
                        } else {
                        	 lastnum = (lastnum == undefined || lastnum == '') ? '等待开奖' : lastnum.replace(/\|/g, ' ');
                        }
                       
                        $('p.last_open_' + gid).html(lastnum);
                    }
                    if (all != 1) {
                        setLeaveTimer();
                    }
                }
                isCanGetNext = true;
            },
			error:function(e){
				console.log(e);
			}
        });
    }

    runSec = 1; //定时器运行了多少秒
    firstPage = 1;
    objList = ''; //时间显示jqery对象
    timeLeave = 0; //倒计时剩余时间
    localTime = 0; //最后一次倒计时的本机时间（毫秒）
    isTimerStarted = false; //是否启动了定时器
    function setLeaveTimer() { //启动定时，进行倒计时。
        if (isTimerStarted) {
            return;
        }
        isTimerStarted = true;

        function format(dateStr) { //格式化时间
            return new Date(dateStr.replace(/[\-\u4e00-\u9fa5]/g, "/"));
        }

        function fftime(n) {
            return Number(n) < 10 ? "" + 0 + Number(n) : Number(n);
        }

        function diff(t) { //根据时间差返回相隔时间
            return t > 0 ? {
                day: Math.floor(t / 86400),
                hour: Math.floor(t / 3600),
                minute: Math.floor(t % 3600 / 60),
                second: Math.floor(t % 60)
            } : {
                day: 0,
                hour: 0,
                minute: 0,
                second: 0
            };
        }

        //timeLeave = 0//倒计时总秒数
        clearInterval(timerno); //删除定时器
        var timerno = window.setInterval(function() {
            if (runSec < 271) {
                if (runSec % 90 == 0) {
                    getLastResult();
                }
                runSec++;
            }
            var tmpLocalTime = new Date().getTime() + 0; //本机毫秒数
            if (localTime > 0 && (tmpLocalTime - localTime) > 3000) { //倒计时已不准确，重新获取倒计时
                getNextPeriod(1);
            }
            localTime = tmpLocalTime;
            //对所有倒计时遍历，重新赋值
            if (objList == undefined || objList == '') {
                objList = $('div.erect-right');
            }
            for (var i = 0; i < objList.length; i++) {
                var tmpGid = $(objList[i]).data('gid');
                var tmpTimeLeave = lefttimes[tmpGid];
                if (tmpTimeLeave > -1) {
                    tmpTimeLeave--;
                }
                lefttimes[tmpGid] = tmpTimeLeave;
                if (isCanGetNext && tmpTimeLeave == 0) {
                    getNextPeriod();
                    continue;
                }
                tmpTimeLeave = (tmpTimeLeave == undefined || tmpTimeLeave == '') ? 0 : tmpTimeLeave;
                var oDate = diff(tmpTimeLeave);
                var ahour = fftime(oDate.hour).toString().split("");
                var aminute = fftime(oDate.minute).toString().split("");
                var asecond = fftime(oDate.second).toString().split("");
                var timeShow = ahour[0] + ahour[1] + ':' + aminute[0] + aminute[1] + ':' + asecond[0] + asecond[1];
                if (gameShowType == 1) { //列表显示
                    $('span.time_show_1_' + tmpGid).text(timeShow);
                } else { //宫格显示
                    $('span.time_show_2_' + tmpGid).text(timeShow);
                }
            }
        }, 1000);
    }
});
