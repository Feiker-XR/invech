<?php

namespace app\pay;


/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 14:36
 */

class yfpay extends basepay
{
    private  $data = [] ;


    public function pay()
    {

        $arr=$this->params;
        $money=sprintf("%.2f",$arr['order_money']);
        $this->data["parter"]=$arr['pid'];       //商户号
        $this->data["type"]=$arr['tcode'];   //类型
        $this->data["value"]=$money;      //金额
        $this->data["orderid"]=$arr['order_id'];  //订单id
        $this->data["callbackurl"]=$arr['callbackurl']; //异步
        $this->data["hrefbackurl"]=$arr['hrefbackurl']; //同步url地址
        $this->data["payerIp"]=$this->get_client_ip(); //客户端ip
        $sign="parter={$arr['pid']}&type={$arr['tcode']}&value={$money}&orderid={$arr['order_id']}&callbackurl={$arr['callbackurl']}{$arr['pkey']}";
        $sign=MD5($sign);

        $this->data["sign"]=$sign; //

        $html = $this->form($this->data, $arr['purl'], 'POST', 'utf8');
        return $html ;
    }

    /**
     * 创建签名
     */
    public function create_sign()

    {

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
        file_put_contents(dirname(dirname(dirname(__FILE__))).'/public/callbackLog/yflog.html', $form."\r\n",FILE_APPEND);



        $arr=$this->params;
        $this->data['orderid']=input('orderid');
        $this->data['opstate']=input('opstate');
        $this->data['ovalue']=input('ovalue');
        $localSign="orderid={$this->data['orderid']}&opstate={$this->data['opstate']}&ovalue={$this->data['ovalue']}{$arr["pkey"]}" ;
        $localSign=md5($localSign);
        $sign=input('sign');
        return $sign==$localSign;
    }

    /**
     * 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
    public function transid()
    {
        return  $ordernumber =  trim( input('sysorderid')) ;
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
        return input('opstate') == 0  ;
    }


}