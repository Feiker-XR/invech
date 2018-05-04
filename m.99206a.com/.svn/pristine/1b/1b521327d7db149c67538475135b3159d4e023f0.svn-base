<?php

namespace app\pay;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/23 0023
 * Time: 17:58
 */
//腾付支付
class tfpay extends basepay
{
    private  $data = [] ; //第三方请求参数

    public function pay()
    {
        $arr = $this->params;
        $this->data = [
            'version'=>'1.0',
            'customerid'=>$arr['pid'],
            'sdorderno'=>$arr['order_id'],
            'total_fee'=> $arr['order_money'],
            'paytype' => $arr['tcode'],
            'notifyurl' => $arr['callbackurl'],
            'returnurl'=>$arr['hrefbackurl'],
            'remark' => '虚拟商品',
        ] ;
//        switch ($arr['tcode']){
//            case 'ALIPAY':
//                $this->data['paytype'] = 'alipay';
//                break;
//            case 'ALIPAYWAP':
//                $this->data['paytype'] = 'alipaywap';
//                break;
//            case 'WECHAT':
//                $this->data['paytype'] = 'weixin';
//                break;
//            case 'WECAHTWAP':
//                $this->data['paytype'] = 'wxh5';
//                break;
//            case 'QQPAYWAP':
//                $this->data['paytype'] = 'qqwallet';
//                break;
//            case 'QQPAY':
//                $this->data['paytype'] = 'qqrcode';
//                break;
//        }
        if(!in_array($arr['tcode'], array('alipay','alipaywap','weixin','wxh5','qqwallet','qqrcode'))){
            $this->data['paytype'] = 'bank';
            $this->data['bankcode'] = $arr['tcode'];
        }
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
         $signSource = sprintf("version=%s&customerid=%s&total_fee=%s&sdorderno=%s&notifyurl=%s&returnurl=%s&%s", '1.0', $arr['pid'], sprintf('%.2f', $arr['order_money']), $arr['order_id'], $arr['callbackurl'], $arr['hrefbackurl'],$arr['pkey']); //字符串连接处理
//         var_dump($signSource);die;
         return md5($signSource);  //字符串加密处理
     }

    /**
     * 支付通知验证签名,参数在request中
     */
     public function check_sign()
     {
         $sign = $_REQUEST["sign"];	//字符加密串
         $signSource = "customerid={$_REQUEST['customerid']}&status={$_REQUEST['status']}&sdpayno={$_REQUEST['sdpayno']}&sdorderno={$_REQUEST['sdorderno']}&total_fee={$_REQUEST['total_fee']}&paytype={$_REQUEST['paytype']}&{$this->params['pkey']}"; //连接字符串加密处理
         
         return $sign == md5($signSource);
     }

    /**
     *  返回平台订单号
     */
     public function orderid()
     {
         return input('sdorderno') ;
     }

    /**
     * (第三方订单号) 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
     public function transid()
     {
        return  input('sdpayno') ;
     }
     
    /**
     * 
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
     public function pay_ok()
     {
         return ($_REQUEST['status'] == 1) ? true : false ;
     }
}