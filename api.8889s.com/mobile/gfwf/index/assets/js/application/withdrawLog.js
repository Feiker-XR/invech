requirejs(["jquery", "common"], function($) {
       
        $(function() {
             var statusType = null;
            var pageIndex = 1; //初始化
            getWithdrawList();
            function initLoading() {
                var loadHtml = '<li class="loading">' + '<div class="order-list-tit"></div>' + '<div class="c-gary" style="text-align: center">正在加载...</div>' + '</li>';
                $('ul#withdraw_list').html(loadHtml);
                $('a.on-more').hide();
                $('div.mine-message').hide();
            }
            $('a.on-more').on("click",function() {
                getWithdrawList(1);
            });
            $('div.ui-bett-refresh').on("click",function() {
                initLoading();
                getWithdrawList(2);
            });
            $('div.beet-tips a').on("click",function() {
                $('div.beet-tips a').removeClass('beet-active');
                $('div.beet-tips').hide();
                $(this).addClass('beet-active');
                $('span#status_type').text($(this).text());
                statusType = $(this).data('type');
                initLoading();
                getWithdrawList(2);
            });

            function getWithdrawList(more) {
                if (more == 1) {
                    pageIndex++;
                } else if (more == 2) {
                    pageIndex = 1;
                }
                $.ajax({
                    url: '/index.php/Cash/getListToCash',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'type': statusType,
                        'pageIndex': pageIndex
                    },
                    timeout: 30000,
                    success: function(results) {
                        $('ul#withdraw_list li.loading').remove();
                        if (results.status == "100") {
                            location.href = "";
                            return;
                        }
                        if (results.status == "200") {
                            var data = results.data.data;
                            var txtHtml = '';
                            var statusArr = {'0':'已到帐', '1':'正在办理', '2':'已取消', '3':'已支付', '4':'失败'};
	                        for (var i = 0; i < data.length; i++) {
	                            txtHtml += '<li>' + '<a href="/index.php/Cash/todetail/' + data[i].id + '">' + '<div class="order-list-tit">' + '<span class="fr c-red">-' + data[i].amount + '元</span><span class="order-top-left" style="width:50%;">' + '出款' + '</span>' + '</div>' + '<div class="c-gary"><span class="fr">' + statusArr[data[i].state] + '</span><p class="order-time">单号 ' + data[i].id + '</p></div>' + '</a>' + '</li>';
	                        }
	                        if (data.length<1) {
	                            $('div.mine-message').show();
	                        } else {
	                            $('div.mine-message').hide();
	                        }
	                        if (more == 2) { //刷新
	                            $('ul#withdraw_list').html(txtHtml);
	                        } else {
	                            $('ul#withdraw_list').append(txtHtml);
	                        }
	                        if (results.data.total > (pageIndex*10)) {
	                            $('a.on-more').show();
	                        } else {
	                            $('a.on-more').hide();
	                        }
                        }
                    },
                    error:function(e){
                    }
                });
            }
        });
    });