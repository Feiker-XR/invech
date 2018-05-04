<?php
namespace app\Pay\Driver;

use app\Pay\Contracts\Pay;
use app\Pay\BasePay;

class Gfpay implements Pay
{
    use BasePay;

    public function pay($params = null)
    {
        foreach ($params as $key => $value ) {
            $this->params[$key] = $value;
        }
        $arr = $this->params;

        $params["parter"]=$arr['pid'];
        $params["value"]=$arr['amount'];
        $params["type"]=$arr['pay_code'];
        $params["orderid"]=$arr['orderno'];
        $params["notifyurl"]=$arr['callbackurl'];
        $params["callbackurl"]=$arr['hrefbackurl'];
        $params["sign"]=$this->create_sign();

        $html = $this->form($params, $arr['purl'], 'get', 'utf8');
        return ['mode'=>'html','content'=>$html,];
    }

    /**
     * 创建签名
     */
    public function create_sign($params=[])
    {
        $arr=$this->params;

        $params["parter"]=$arr['pid'];
        $params["value"]=$arr['order_money'];
        $params["type"]=$arr['pay_code'];
        $params["orderid"]=$arr['orderno'];
        $params["notifyurl"]=$arr['callbackurl'];
        $params["callbackurl"]=$arr['hrefbackurl'];
        ksort($params);
        $sign = md5( urldecode( http_build_query( $params ) .'&key='.$arr['pkey']));
        return $sign;
    }

    //验证签名
    public function check_sign()
    {
        $arr=$this->params;
        $params['parter']=$arr['pid'];
        $params['orderid']=input('orderid');
        $params['opstate']=input('opstate');
        $params['ovalue']=input('ovalue');
        ksort($params);
        $localSign=md5( urldecode( http_build_query($params).'&key='.$arr['pkey'] ));
        $sign=input('sign');
        return $sign==$localSign;
    }

    /**
     * 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
    public function out_trade_no()
    {
        return  $ordernumber =  trim( input('orderid')) ;
    }

    /**
     *  返回平台订单号
     */
    public function orderno()
    {
        return  $ordernumber =  trim(input('orderid')) ;
    }


    /**
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
    public function pay_ok()
    {
        return input('opstate') == 1  ;
    }


}