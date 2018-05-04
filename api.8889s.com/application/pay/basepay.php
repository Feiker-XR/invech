<?php

namespace app\pay;

abstract class basepay {

    protected $params;

    //public function __construct($params) {
    public function params($params) {
        $this->params = $params;
    }

    /**
     * 生成订单号
     * 可根据自身的业务需求更改
     */
    public function orderno() {
        return date("YmdHis").rand(100000,999999);         
    }

    /**
     * pay支持 表单方式,重定向方式,二维码方式
     */
    abstract public function pay();

    /**
     * 表单方式
     */
    protected function form($params, $gateway, $method = 'post', $charset = 'utf-8') {
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
        header("Content-type:text/html;charset={$charset}");
        $sHtml = "<form id='paysubmit' name='paysubmit' action='{$gateway}' method='{$method}'>";

        foreach ($params as $k => $v) {
            $sHtml.= "<input type=\"hidden\" name=\"{$k}\" value=\"{$v}\" />\n";
        }
        //$sHtml .= "<input type='submit' />";

        $sHtml = $sHtml . "</form>正在跳转 ...";

        $sHtml = $sHtml . "<script>document.forms['paysubmit'].submit();</script>";
        return $sHtml;
    }

    protected function post($url,$data){ #POST访问
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }	
        return $tmpInfo;      
    }

    /**
     * 创建签名
     */
    abstract public function create_sign();

    /**
     * 支付通知验证签名,参数在request中
     */
    abstract public function check_sign();

    /**
     * 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
    abstract public function transid();
    
    /**
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
    abstract public function pay_ok();
    
    /**
     * 支付通知判断,参数在request中,参数名视支付平台而定
     */
    public function check_success(){
        if($this->check_sign() && $this->pay_ok()){
            return true;
        }
        return false;
    }


    
    /**
     * 异步通知验证成功返回信息
     */
    public function success() {
        echo "success";
    }
}
