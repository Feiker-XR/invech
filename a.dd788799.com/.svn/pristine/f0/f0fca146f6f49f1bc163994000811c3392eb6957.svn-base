<?php
namespace app\Pay\Driver;

use app\Pay\Contracts\Pay;
use app\Pay\BasePay;

class Fktpay implements Pay
{    
    use BasePay;

    public  function pay($params = null)
    {
        foreach ($params as $key => $value ) {
            $this->params[$key] = $value;
        }
        $arr = $this->params;

        $params = [];
        $params['input_charset'] = 'UTF-8';//参数字符集
        $params['inform_url'] = $arr['hrefbackurl'];
        $params['return_url'] = $arr['callbackurl'];
        $params['pay_type'] = '1';//支付方式
        $params['bank_code'] = $arr['pay_code'];  //银行编码
        $params['merchant_code'] = $arr['pid']; //商户ID
        $params['order_no'] = $arr['orderno'] ; //订单ID
        $params['order_amount'] = $this->cryptAES1();  //支付金额
        $params['order_time'] = date('Y-m-d H:i:s',time());//商户订单时间
        $params['customer_ip'] = request()->ip();//获取支付者ip
        $params['sign'] = $this->create_sign($params) ;
        $html = $this->form($params,$arr['purl']) ;
        return ['mode'=>'html','content'=>$html,];
    }
    
    /*
     * 创建金额加密方法
     */
    public  function cryptAES1(){
        try{
            $arr   = $this->params;
            $money = sprintf("%0.2f",$arr['amount']);
            $path  = dirname(__FILE__).'/AES.php' ;
            require_once($path) ;
            $aes   = new AES();
            $aes->set_key($arr['pkey']);
            $aes->require_pkcs5();
            $orderAmount  = $aes->encrypt($money);
            return $orderAmount;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage()) ;
        }
    }
    
    
    /**
     * 创建签名
     */
    public function create_sign($params=[])
    {
        $signStr ='';
        ksort($params);
        foreach($params as $k => $v){
            if("" != $v && "sign" != $k){
                $signStr .= "$k=$v&";     }
        }
        $signStr .= "key=".$this->params['pkey'];
        
        return md5($signStr);
        
    }
    
    /**
     * 支付通知验证签名,参数在request中
     */
    public function check_sign()
    {
        $arr=[];
        $arr['merchant_code'] = $_REQUEST["merchant_code"];
        $arr['order_no']      = $_REQUEST["order_no"];
        $arr['order_time']    = $_REQUEST["order_time"];
        $arr['order_amount']  = $_REQUEST["order_amount"];
        $arr['trade_status'] = $_REQUEST["trade_status"];
        $arr['trade_no']      = $_REQUEST["trade_no"];
        $arr['return_params'] = $_REQUEST["return_params"];
        $sign        = $_REQUEST["sign"];
        
        $signStr = '';
        ksort($arr);
        foreach ($arr as $k => $v){
            if($v != '' && $v != 'null'){
                $signStr .= "$k=$v&";
            }
        }
        $signStr .= "key=".$this->params['pkey'];
        $mySign = md5($signStr);
        return $mySign == $sign ;
    }
    
    /**
     * 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
    public function out_trade_no()
    {
        return $_REQUEST['trade_no'] ;
    }
    
    public function orderno()
    {
        return $_REQUEST['order_no'] ;
    }
    
    /**
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
    public function pay_ok()
    {
        return $_REQUEST['trade_status'] == 'success' ;
    }
    
    public function success()
    {
        echo 'SUCCESS';
    }
    
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
}