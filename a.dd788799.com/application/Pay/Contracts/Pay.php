<?php

namespace app\Pay\Contracts;

interface Pay
{

    
    /**
     * 生成商户订单号.
     *
     * @return mixed
     */
    public function genOrderno();

    /**
     * 发起支付请求.
     *
     * @param  string|null  $name
     * @return mixed 0:url:重定向,1:form:表单提交,2:qrcode:二维码
     */
    public function pay($params = null);

    /**
     * 处理支付通知,放入业务层.
     *
     * @param  string|null  $name
     * @return mixed
     */
    //public function notify($params = null);

    /**
     * 创建签名
     */
    public function create_sign($params = []);

    /**
     * 支付通知验证签名,参数在request中
     */
    public function check_sign();

    /**
     * 支付通知的商户单号,参数在request中,参数名 视支付平台而定
     */
    public function orderno();

    /**
     * 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
    public function out_trade_no();
    
    /**
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
    public function pay_ok();

    /**
     * 异步通知验证成功返回信息
     */
    public function success();        
}
