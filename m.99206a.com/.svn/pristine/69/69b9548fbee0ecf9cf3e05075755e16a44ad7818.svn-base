<?php

namespace app\pay;


/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 14:36
 */

class gfpay extends basepay
{
    private  $data = [] ;


    public function pay()
    {

        $arr=$this->params;
        $this->data["parter"]=$arr['pid'];
        $this->data["value"]=$arr['order_money'];
        $this->data["type"]=$arr['tcode'];
        $this->data["orderid"]=$arr['order_id'];
        $this->data["notifyurl"]=$arr['callbackurl'];
        $this->data["callbackurl"]=$arr['hrefbackurl'];
        $this->data["sign"]=$this->create_sign();

        $html = $this->form($this->data, $arr['purl'], 'get', 'utf8');
        return $html ;
    }

    /**
     * 创建签名
     */
    public function create_sign()

    {
        $arr=$this->params;

        $this->data["parter"]=$arr['pid'];
        $this->data["value"]=$arr['order_money'];
        $this->data["type"]=$arr['tcode'];
        $this->data["orderid"]=$arr['order_id'];
        $this->data["notifyurl"]=$arr['callbackurl'];
        $this->data["callbackurl"]=$arr['hrefbackurl'];
        ksort($this->data);
        $sign = md5( urldecode( http_build_query( $this->data ) .'&key='.$arr['pkey']));
        return $sign;

    }
    //验证签名
    public function check_sign()
    {

        $arr=$this->params;
        $form = "<Form action=".$arr['callbackurl']." method='get'>";
        foreach ($_REQUEST as $k=>$v){
            $form .= "<input name='$k' value='$v' />";
        }
        $form .='<input type="submit"></form>';
        file_put_contents(dirname(dirname(dirname(__FILE__))).'/public/callbackLog/gflog.html', $form."\r\n",FILE_APPEND);



        $arr=$this->params;
        $this->data['parter']=$arr['pid'];
        $this->data['orderid']=input('orderid');
        $this->data['opstate']=input('opstate');
        $this->data['ovalue']=input('ovalue');
        ksort($this->data);
        $localSign=md5( urldecode( http_build_query($this->data).'&key='.$arr['pkey'] ));
        $sign=input('sign');
        return $sign==$localSign;
    }

    /**
     * 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
    public function transid()
    {
        return  $ordernumber =  trim( input('orderid')) ;
    }

    /**
     *  返回平台订单号
     */
    public function orderid()
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