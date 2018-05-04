requirejs(["jquery", "common"], function($) {
    $(function() {
        var orderType = 1;
        var pageIndex = 1; //初始第一页
        getBetList();

        function initLoading() {
            var loadHtml = '<li class="loading">' + '<div class="order-list-tit"></div>' + '<div class="c-gary" style="text-align: center">正在加载...</div>' + '</li>';
            $('ul#bet_list').html(loadHtml);
            $('a.on-more').hide();
            $('div.mine-message').hide();
        }
        $('div.ui-bett-refresh').on("click", function() {
            initLoading();
            getBetList(2);
        });
        $('a.on-more').on("click", function() {
            getBetList(1);
        });
          function getBetList(more) {//1:更多，2:充值
        if (more == 1) {
            pageIndex++;
        } else if (more == 2) {
            pageIndex = 1;
        }
        var weiArr = {0:'万',1:'千',2:'百',3:'十',4:'个'};
        $.ajax({
            url: '/index.php/record/getList',
            type: 'POST',
            dataType: 'json',
            data: {
                'state' : orderType,
                'pageIndex' : pageIndex
            },
            timeout: 30000,
            success: function (results) {

                $('ul#bet_list li.loading').remove();
                 if (results.status == "100") {
                    location.href = "common/login";
                    return;
                }
                var now = new Date(); 
                if (results.status == "200") {
                    var data = results['data'].data;
                    var txtHtml = '';
                    for (var i = 0; i < data.length; i++) {
                        var d=data[i]; 
                        var tmpStatus = '未中奖';
                        if(d['isDelete']==1){
                            tmpStatus = '已取消';
                        }else if(!d['lotteryNo']){
                            tmpStatus = '未开奖';
                        }else if(d['zjCount']>0){
                            tmpStatus = '<span style="color: #00bf16;">赢'+d.bonus+'元</span>';
                        }
                        
                        txtHtml += '<li>'
                            + '<a  class="" href="/index.php/record/betInfo/'+d.id+'">'
                                + '<div class="order-list-tit">'
                                    + '<span class="fr c-red">-'+d.amount+'元</span><span class="order-top-left">'+d.title+'</span>第'+d.actionNo+'期'
                                + '</div>'
                                + '<div class="c-gary"><span class="fr">'+tmpStatus+'</span><p class="order-time">'+getLocalTime(d.actionTime)+'</p></div>'
                            + '</a>'
                        + '</li>';
                    }
                    if (!d) {
                        $('div.mine-message').show();
                    } else {
                        $('div.mine-message').hide();
                    }
                    if (more == 2) {//刷新
                        $('ul#bet_list').html(txtHtml);
                    } else {
                        $('ul#bet_list').append(txtHtml);
                    }
                    pagenum = pageIndex*10;
                    if (results['data'].total > pagenum) {
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