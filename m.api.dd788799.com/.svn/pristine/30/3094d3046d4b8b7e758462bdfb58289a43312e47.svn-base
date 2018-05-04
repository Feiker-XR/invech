requirejs(["jquery", "common"], function($) {
    $(function() {
        var dataType = 0;
        var pageIndex = 1; //初始第一页
       var transType={
        1: '充值',
        111: '卡密充值',
        2: '返点',
        //3: '返点',//分红
        //4: '抽水金额',
        5: '停止追号',
        6: '中奖金额',
        7: '撤单',
        8: '提现失败返回冻结金额',
        9: '管理员充值',
        10: '解除抢庄冻结金额',
        //11: '收单金额',
        12: '上级充值',
        13: '上级充值成功扣款',
        50: '签到赠送',
        51: '首次绑定工行卡赠送',
        52: '充值佣金',
        53: '消费佣金',
        54: '充值活动奖金',
        55: '注册佣金',
        56: '至尊佣金奖励',
        57: '积分兑换',
        
        100: '抢庄冻结金额',
        101: '投注冻结金额',
        102: '追号投注',
        103: '抢庄返点金额',
        //104: '抢庄抽水金额',
        105: '抢庄赔付金额',
        106: '提现冻结',
        107: '提现成功扣除冻结金额',
        108: '开奖扣除冻结金额',
        120: '幸运大转盘赠送',
        130: '幸运砸蛋赠送',
        140: '存入投资理财',
        150: '投资理财提款',
        160: '幸运大抽奖中奖金额'
    };
        
        getAccountDetail();

        function initLoading() {
            var loadHtml = '<li class="loading">' + '<div class="order-list-tit"></div>' + '<div class="c-gary" style="text-align: center">正在加载...</div>' + '</li>';
            $('ul#account_list').html(loadHtml);
            $('a.on-more').hide();
            $('div.mine-message').hide();
        }
        $('div.beet-tips a').click(function() {
            $('div.beet-tips a').removeClass('beet-active');
            $('div.beet-tips').hide();
            $(this).addClass('beet-active');
            $('span#account_type').text($(this).text());
            dataType = $(this).data('type');
            initLoading();
            getAccountDetail(2);
        });
        $('div.ui-bett-refresh').click(function() {
            initLoading();
            getAccountDetail(2);
        });
        $('a.on-more').click(function() {
            getAccountDetail(1);
        });

        function getAccountDetail(more) {
            if (more == 1) {
                pageIndex++;
            } else if (more == 2) {
                pageIndex = 1;
            }
            $.ajax({
                url: '/index.php/report/getList',
                type: 'POST',
                dataType: 'json',
                data: {
                    'dataType': dataType,
                    'pageIndex': pageIndex
                },
                timeout: 30000,
                success: function(results) {
                    $('ul#account_list li.loading').remove();
                    if(results.status == "100") {
                        location.href = "common/login";
                        return;
                    }
                    if (results.status == "200") {
                        var data = results.data.data;
                        var txtHtml = '';
                        var txtType = '';
                        var txtColor = '';
                        var d;
                        for (var i = 0; i < data.length; i++) {
                            d = data[i];
                            txtColor = (d.coin > 1) ? 'style="color: #00bf16;"' : '-';
                            txtHtml +='<li><div class="order-list-tit"><span class="fr c-red" '+txtColor+'>'+d.coin+'元</span><span class="order-top-left">'+d.info+'</span></div><div class="c-gary"><span class="fr" style="font-size: 12px;">余额 '+d.userCoin+'</span><p class="order-time" style="font-size: 12px;">单号 '+d.extfield1+'</p></div></li>';
                            
                        }
                        if (!data.length) {
                            $('div.mine-message').show();
                        } else {
                            $('div.mine-message').hide();
                        }
                        if (more == 2) { //刷新
                            $('ul#account_list').html(txtHtml);
                        } else {
                            $('ul#account_list').append(txtHtml);
                        }
                        if (results.data.total > (pageIndex*10)) {
                            $('a.on-more').show();
                        } else {
                            $('a.on-more').hide();
                        }
                    }

                }
            });
        }
    });
});
