<?php

namespace app\pay;
use app\classes\page;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 14:36
 */

class ccpay extends basepay
{
    private  $data = [] ;
    private  $words   = '' ; //支付类型描述
    private  $scan    = '' ; //扫码类型
    private  $gateWay = '' ;
    private  $gateWay_scan  = 'http://a.cc8pay.com/api/passivePay';  //扫码网关
    private  $gateWay_wap   = 'http://a.cc8pay.com/api/wapPay'; //wap网关


    public function pay()
    {
        $arr = $this->params ;
        $this->setPayInfo($arr['pay_type']) ; //设置支付相关参数
        $this->data['merchno']    =  $arr['pid'] ; // 商户ID
        $this->data['amount']     =  $arr['order_money'] ; //金额
        $this->data['traceno']    =  $arr['order_id'] ; //订单ID
        $this->data['payType']    =  $arr['tcode'] ; //支付类型
        $this->data['goodsName']  =  '用户充值';
        $this->data['remark']     =  input('username').'-'.$arr['pay_type']; //备注
        $this->data['notifyUrl']  =  $arr['callbackurl'] ; //回调地址
        ksort($this->data);
        $this->data['signature']  =  $this->create_sign() ; //创建签名
        //var_dump($this->data);
        $res = $this->post($this->gateWay, $this->data);
        $res = iconv('gbk', 'utf-8', $res);
        $info = json_decode($res,true);
        
        if($info['respCode'] == '00'){
            $url = $info['barCode'];
            if(!$this->scan){
                header("location:".$url);
                exit();
            }else{
                return $url;
            }
        }
        return '系统错误!' ;
    }

    /**
     * 创建签名
     */
    public function create_sign()
    {
        $signStr = '';
        foreach($this->data as $k => $v){
            $signStr .= "{$k}={$v}&";
        }
        $signStr .= $this->params['pkey'] ;
        echo $signStr;

        return md5($signStr) ;
    }

    /**
     * 支付通知验证签名,参数在request中
     */
    public function check_sign()
    {
        $data['merchno']        = input('merchno');
        $data['status']         = input('status');
        $data['remark']         = input('remark');
        $data['traceno']        = input('traceno'); //订单号
        $data['orderno']        = input('orderno');
        $data['merchName']      = input('merchName');
        $data['channelOrderno'] = input('channelOrderno');
        $data['amount']         = input('amount');
        $data['transDate']      = input('transDate');
        $data['channelTraceno'] = input('channelTraceno');
        $data['payType']        = input('payType');
        $data['transTime']      = input('transTime');
        $signature              = input('signature');
        ksort($data);
        $signStr = '';
        foreach ($data as $k => $v){
            if($v){
                $signStr .= "{$k}={$v}&";
            }
        }
        $info     = db('vc_order')->where(['order_id'=>$data['traceno']])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();
        $key   = $thirdpay['pkey'];

        $signStr .= $key;
        $sign = strtoupper(md5($signStr));

        return $signature == $sign ;
    }

    /**
     * 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
    public function transid()
    {
        return  input('traceno') ;
    }

    /**
     *  返回平台订单号
     */
    public function orderid()
    {
        return input('orderno') ;
    }


    /**
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
    public function pay_ok()
    {
        return input('status') == 1 ;
    }


    /**
     * 设置支付相关信息
     */
    public function setPayInfo($type)
    {
        switch($type){
            case 'ALIPAY':
                $this->words = '支付宝';
                $this->scan = 1;
                $this->gateWay = $this->gateWay_scan;
                break;
            case 'ALIPAYWAP':
                $this->gateWay = $this->gateWay_wap;
                $this->scan = 0;
                break;
            case 'WECHAT':
                $this->gateWay = $this->gateWay_wap;
                $this->scan = 1;
                $this->words = '微信';
                break;
            case 'WAP':
                $this->gateWay = $this->gateWay_wap;
                $this->scan = 0;
                break;
            case 'JDPAY':
                $this->gateWay = $this->gateWay_scan;
                $this->scan = 1;
                $this->words = '京东钱包';
                break;
            case 'BDPAY':
                $this->gateWay = $this->gateWay_scan;
                $this->scan = 1;
                $this->words = '百度钱包';
                break;
            case 'QQPAY':
                $this->gateWay = $this->gateWay_scan;
                $this->scan    = 1;
                $this->words   = 'QQ钱包';
                break;
            default:
                exit('不支持的支付方式!');
            
        }
    }
}