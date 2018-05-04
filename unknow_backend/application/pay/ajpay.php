<?php

namespace app\pay;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/23 0023
 * Time: 17:58
 */
class ajpay extends basepay
{
    private  $data = [] ; //第三方请求参数

    public function pay()
    {
        $arr = $this->params;
        $this->data = [
            'mechno'    => $arr['pid'], //商户号
            'amount'    => $arr['order_money']*100, //总金额
            'body'      => '客服电话:13016620245', //商品名称
            //'returl'    => $arr['hrefbackurl'], //同步跳转地址
            'notifyurl' => $arr['callbackurl'], //异步通知地址
            'orderno'   => $arr['order_id'],    //订单号
            'payway'    => $arr['pay_type'],    //支付方式
            'paytype'   => $arr['tcode'], //支付类别 例:ALIPAY_WAP
        ] ;
        switch ($arr['tcode']){
            case 'ALIPAY_WAP':
                $this->data['payway'] = 'ALIPAY';
                break;
            case 'ALIPAY_SCAN_PAY':
                $this->data['payway'] = 'ALIPAY';
                break;
            case 'WECHAT_SCANPAY':
                $this->data['payway'] = 'WECHAT';
                break;
            case 'WECHAT_H5PAY':
                $this->data['payway'] = 'WECHAT';
                break;
            case 'QQ_SCANPAY':
                $this->data['payway'] = 'QQ';
                break;
            case 'QQ_WAP':
                $this->data['payway'] = 'QQ';
                break;
        }
        $this->data['sign'] = $this->create_sign() ;

        $html = $this->form($this->data,$arr['purl'], 'post', 'utf8') ;
        return $html ;
    }

    /**
     *  签名
     */
     public function create_sign()
     {
         $url  = $this->params['purl'] ; //请求地址
         $key  = $this->params['pkey'] ; //商户密钥
         ksort($this->data);
         reset($this->data);
         $str = '';

         foreach ($this->data as $k => $v) {
             $str .= $k.'='.$v.'&';
         }
         $sign_str  = $str.'key='.$key ;
         $sign_data = strtoupper(md5($sign_str)) ;
//         $str       = $str.'sign='.$sign_data ;
         return $sign_data ;
     }

    /**
     * 支付通知验证签名,参数在request中
     */
     public function check_sign()
     {
         $str     = '' ;
         $orderid = $this->orderid();
         
         //组合签名
         $data = [
             'status'    => input('status'),
             'charset'    =>input('charset'),
             'transactionid' =>input('transactionid'),
             'orderno'    =>input('orderno'),
             'amount' =>input('amount'),
             'mechno'   =>input('mechno')
         ] ;
         ksort($data);
         reset($data);
         foreach ($data as $k => $v) {
             $str .= $k.'='.$v.'&';
         }
         
         $info     = db('vc_order')->where(['order_id'=>$orderid])->find();
         $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();
         $apikey   = $thirdpay['pkey'];
         
         $str  = rtrim($str, '&') ;
         $str .= $apikey ;
         
         return input('sign') == strtoupper($str)  ;
     }

    /**
     *  返回平台订单号
     */
     public function orderid()
     {
         return input('orderno') ;
     }

    /**
     * (第三方订单号) 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
     public function transid()
     {
        return  input('transactionid') ;
     }
     
    /**
     * 
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
     public function pay_ok()
     {
         return ($_REQUEST['status'] == 100) ? true : false ;
     }

     
     /**
      * 表单方式
      */
     protected function form($params, $gateway, $method = 'post', $charset = 'utf-8') {
         header("Cache-Control: no-cache");
         header("Pragma: no-cache");
         header("Content-type:text/html;charset={$charset}");
         $sHtml = "<form id='paysubmit' name='paysubmit' action='{$gateway}' method='{$method}' target='_parent' >";
         
         foreach ($params as $k => $v) {
             $sHtml.= "<input type=\"hidden\" name=\"{$k}\" value=\"{$v}\" />\n";
         }
         //$sHtml .= "<input type='submit' />";
         
         $sHtml = $sHtml . "</form>正在跳转 ...";
         
         $sHtml = $sHtml . "<script>document.forms['paysubmit'].submit();</script>";
         return $sHtml;
     }
}