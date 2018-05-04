<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="zh-cn">
    <title><?=$words?>扫码支付</title>
    <link href="http://www.99206a.com/scan/wechat_pay.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="http://www.99206a.com/scan/js/jquery-1.8.2.min.js"> </script>
    <script src="http://www.99206a.com/scan/js/jquery.qrcode.min.js"></script>
</head>
<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico-wechat"></span><span class="text"><?=$words?>支付</span>
    </h1>
    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount">
            <span>￥</span><?=$coin?>
        </div>
        <div class="qr-image" style="">
            <div id="barCode" style="margin-left: 155px;">

            </div>  
        </div>
        <!--detail-open 加上这个类是展示订单信息，不加不展示-->
        <div class="detail detail-open" id="orderDetail" style="">
            <dl class="detail-ct" style="display: block;">
                <dt>交易单号</dt>
                <dd id="billId"><?=$orderNo?></dd>
            </dl>
        </div>
        <div class="tip">
            <span class="dec dec-left"></span>
            <span class="dec dec-right"></span>
            <div class="ico-scan">
            </div>
            <div class="tip-text">
                <p>
                    请使用<?=$words?>扫一扫
                </p>
                <p>
                    扫描二维码完成支付
                </p>
            </div>
        </div>
    </div>
    <div class="foot">
        <div class="inner">
            <p>
            </p>

        </div>
    </div>
</div>
</body>

<script>
    function query(orderid) {
        var datas = 'OrderId='+orderid;
        $.ajax({
            url: 'http://www.99206a.com/scan/queryOrder.php',
            method: 'post',
            data: datas,
            dataType: 'json',
            success: function(data) {
                if(data.status == '1'){
                    alert('支付成功');
                    window.location.href = '/';
                }
            }
        });
    }

    $(function(){
        $('#barCode').empty();
        $('#barCode').qrcode({
            render : "canvas", //table方式
            width : 300, //宽度
            height : 300, //高度
            text : '<?=$code_url?>', //任意内容 background: "#ffffff",
            background : "#ffffff",
        });
        setInterval("query('<?=$this->data['out_trade_no']?>')",5000);
    })

</script>
</html>