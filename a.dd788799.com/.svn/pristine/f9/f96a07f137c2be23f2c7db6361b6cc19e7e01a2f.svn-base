<?php

namespace app\Pay\Driver;

use app\Pay\Contracts\Pay;
use app\Pay\BasePay;

class Hypay implements Pay {

    use BasePay;

    public function pay($params = null){
        foreach ($params as $key => $value ) {
            $this->params[$key] = $value;
        }        
        $arr = $this->params;

        $params['merchantcode']	=	$arr['pid'];
        $params['type']	=	$arr['pay_code'];
        $params['amount']	=	$arr['amount'];
        $params['orderid'] = $arr['orderno'];
        $params['notifyurl']	=	 $arr['callbackurl'];
        $params['sign']		=	$this->create_sign();
        $params['callbackurl']	=	 $arr['hrefbackurl'];
        $params['clientip']	=	 $_SERVER['REMOTE_ADDR'];
        $params['desc']	=	 "";

        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        return ['mode'=>'html','content'=>$html,];
    }


    public function create_sign($params=[]){
        $arr = $this->params;
        $signValue = md5("amount={$arr['amount']}&merchantcode ={$arr['pid']}&notifyurl ={$arr['callbackurl']}&orderid ={$arr['orderno']}&type ={$arr['pay_code']}&key={$arr['pkey']}");;
        return strtoupper($signValue);
    }

    public function check_sign(){

        $arr = $this->params;

        $orderstatus = $_GET["status"]; // 支付状态
        $orderid = $_GET["orderid"]; // 订单号
        $ovalue = $_GET["amount"]; //付款金额
        $sign = $_GET["sign"];	//字符加密串

        $signValue = md5($signSource = "amount={$ovalue}merchantcode={$_GET["merchantcode"]}orderid={$orderid}paytime={$_GET["paytime"]}status={$orderstatus}key={$arr['pkey']}");
        return $sign == strtoupper($signValue);
    }

    public function out_trade_no(){
        return $ordernumber =  trim(input('orderid')) ;
    }

    public function orderno(){
        return $ordernumber =  trim(input('orderid')) ;
    }

    public function pay_ok(){
        $orderstatus = trim(input('status'));
        return $orderstatus==0;
    }

}