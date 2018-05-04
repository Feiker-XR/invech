<?php

namespace app\pay;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/23 0023
 * Time: 17:58
 */
class ydpay extends basepay
{
    private  $data = [] ; //第三方请求参数

    public function pay()
    {
        $arr = $this->params;
        $this->data = [
            'partner'    => $arr['pid'], //商户号
            'paymoney'    => $arr['order_money'], //总金额
            'attach'      => '虚拟商品', //商品名称
            'hrefbackurl'    => $arr['hrefbackurl'], //同步跳转地址
            'callbackurl' => $arr['callbackurl'], //异步通知地址
            'ordernumber'   => $arr['order_id'],    //订单号
            'banktype'   => $arr['tcode'], //支付类别 例:ALIPAY_WAP
        ] ;
//        switch ($arr['tcode']){
//            case 'ALIPAY_WAP':
//                $this->data['payway'] = 'ALIPAY';
//                break;
//            case 'ALIPAY_SCAN_PAY':
//                $this->data['payway'] = 'ALIPAY';
//                break;
//            case 'WECHAT_SCANPAY':
//                $this->data['payway'] = 'WECHAT';
//                break;
//            case 'WECHAT_H5PAY':
//                $this->data['payway'] = 'WECHAT';
//                break;
//            case 'QQ_SCANPAY':
//                $this->data['payway'] = 'QQ';
//                break;
//            case 'QQ_WAP':
//                $this->data['payway'] = 'QQ';
//                break;
//        }
        $this->data['sign'] = $this->create_sign() ;

        $html = $this->form($this->data,$arr['purl'], 'get', 'utf8') ;
        return $html ;
    }

    /**
     *  签名
     */
     public function create_sign()
     {
         $arr = $this->params;
         $signSource = sprintf("partner=%s&banktype=%s&paymoney=%s&ordernumber=%s&callbackurl=%s%s", $arr['pid'], $arr['tcode'], $arr['order_money'], $arr['order_id'], $arr['callbackurl'], $arr['pkey']); //字符串连接处理
         return md5($signSource);  //字符串加密处理
     }

    /**
     * 支付通知验证签名,参数在request中
     */
     public function check_sign()
     {
         $orderstatus = $_GET["orderstatus"]; // 支付状态
         $orderid = $_GET["ordernumber"]; // 订单号
         $ovalue = $_GET["paymoney"]; //付款金额
         $sign = $_GET["sign"];	//字符加密串
         $signSource = sprintf("partner=%s&ordernumber=%s&orderstatus=%s&paymoney=%s%s", $this->params['pid'], $orderid, $orderstatus, $ovalue, $this->params['pkey']); //连接字符串加密处理
         
         return $sign == md5($signSource);
     }

    /**
     *  返回平台订单号
     */
     public function orderid()
     {
         return input('ordernumber') ;
     }

    /**
     * (第三方订单号) 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
     public function transid()
     {
        return  input('ordernumber') ;
     }
     
    /**
     * 
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
     public function pay_ok()
     {
         return ($_REQUEST['orderstatus'] == 1) ? true : false ;
     }

    public function success() {
        echo "ok";
    }
}