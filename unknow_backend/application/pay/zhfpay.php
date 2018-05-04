<?php
// +----------------------------------------------------------------------
// | FileName: zhfpay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年11月20日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;
class zhfpay extends basepay{
    public function pay(){
        date_default_timezone_set('PRC');
        $arr = $this->params;
        $ip = request()->ip();
        $post = [
            'merchant_code'=>$arr['pid'],//'108001002002',
            'service_type'=>$arr['tcode'],//'weixin_scan',
            'notify_url'=>$arr['callbackurl'],//'http://www.xxx.com/dinpay/offline.php',
            'interface_version'=>'V3.1',
            'sign_type'=>'RSA-S',
            'order_no'=>$arr['order_id'],//'123456',
            'client_ip'=>$ip,//'120.237.123.242',
            //'sign'=>'ScNybhGl1a4FJ36SAZ8ax9iGfcQ6AOBiWOzJ7vFAfTq02J611JTQWSQr2h4RRlqumDI0VMAsiQVICRadkr2hgbWULDV0DQ9+ZW82rgrg6WUILHZ18ttllUdnR6zfcaEvTY9jlrvKfOO6WUwVZMFClSTvzZL0pg3oZ3uVbIUHOoc=',
            'order_time'=>date('Y-m-d H:i:s'),//'2016-12-10 12:36:25',
            'order_amount'=>$arr['order_money'],
            'product_name'=>'虚拟商品',
        ];
        switch ($arr['tcode']){
            case 'alipay_scan':
            case 'weixin_scan':
            case 'tenpay_scan':
                $arr['purl'] = 'https://pay.zhihfpay.com/gateway?input_charset=UTF-8';
                break;
            case 'alipay_h5api':
            case 'weixin_h5api':
            case 'qq_h5api':
                $arr['purl'] = 'https://pay.zhihfpay.com/gateway?input_charset=UTF-8';
                break;
            default:
                $post['purl'] = 'https://pay.zhihfpay.com/gateway?input_charset=UTF-8';
                $post['interface_version'] = 'V3.0';
                $post['service_type'] = 'direct_pay';
                $post['bank_code'] = $arr['tcode'];
                $post['input_charset'] = 'UTF-8';
                break;
        }
        $post['sign'] = $this->create_sign($post);
        if($post['service_type'] == 'direct_pay'){
            return $this->form($post, 'http://pay.xcymyf.cn/pay.php');
        }
        var_dump($post);
        $ret = $this->post($arr['purl'],$post);
        /*
         <?xml version="1.0" encoding="UTF-8" standalone="yes"?><dinpay><response><resp_code>FAIL</resp_code><resp_desc>商家号不能为空</resp_desc><result_code>1</result_code></response></dinpay>
         */
        
        $ret = simplexml_load_string($ret);
        /*
         if('SUCCESS' == $ret->response->resp_code && "0" == $ret->response->result_code){
         
         }
         */
        
        $data = ['status'=>(string)$ret->response->result_code,
            'orderid'=>(string)@$ret->response->order_no,
            'data'=>(string)@$ret->response->qrcode,
            'msg'=>(string)$ret->response->resp_desc,];
        return $data;
    }
    
    /**
     * 创建签名
     */
    public function create_sign($params=[]) {
        $arr = $this->params;
        $str = '';
        if(isset($params['bank_code'])){
            $str .= 'bank_code='.$params['bank_code'].'&';
        }
        $str .= "client_ip=".$params['client_ip'].'&';
        if(isset($params['input_charset'])){
            $str .= 'input_charset='.$params['input_charset'].'&';
        }
        $str .= "interface_version=".$params['interface_version'].'&';
        $str .= "merchant_code=".$params['merchant_code'].'&';
        $str .= "notify_url=".$params['notify_url'].'&';
        $str .= "order_amount=".$params['order_amount'].'&';
        $str .= "order_no=".$params['order_no'].'&';
        $str .= "order_time=".$params['order_time'].'&';
        $str .= "product_name=".$params['product_name'].'&';
        $str .= "service_type=".$params['service_type'];
        
        //echo $str;
        $dir = ROOT_PATH."houtai/uploads/";
        $prikey = file_get_contents($dir.$arr['prikey']);
        
        $merchant_private_key = openssl_get_privatekey($prikey);
        openssl_sign($str,$sign_info,$merchant_private_key,OPENSSL_ALGO_MD5);
        $sign = base64_encode($sign_info);
        return $sign;
    }
    
    public function check_sign(){
        $arr = $this->params;
        $arr = $this->params;
        $form = "<Form action='http://hg.dd788799.com/pay/notify/thirdtype/zhfpay/' method='POST'>";
        foreach ($_REQUEST as $k=>$v){
            $form .= "<input name='$k' value='$v' />";
        }
        $form .='</form>';
        file_put_contents(dirname(__FILE__).'/wflog.html', $form."\r\n",FILE_APPEND);
        $str = '';
        if($_POST['bank_seq_no'] ?? false){
            $str .= "bank_seq_no=". $_POST['bank_seq_no'].'&';
        }
        $str .= "interface_version=".$_POST['interface_version'].'&';
        $str .= "merchant_code=".$_POST['merchant_code'].'&';
        $str .= "notify_id=".$_POST['notify_id'].'&';
        $str .= "notify_type=".$_POST['notify_type'].'&';
        $str .= "order_amount=".$_POST['order_amount'].'&';
        $str .= "order_no=".$_POST['order_no'].'&';
        $str .= "order_time=".$_POST['order_time'].'&';
        //$str .= "orginal_money=".$_POST['orginal_money'];
        $str .= "trade_no=".$_POST['trade_no'].'&';
        $str .= "trade_status=".$_POST['trade_status'].'&';
        $str .= "trade_time=".$_POST['trade_time'];
        $sign = base64_decode($_POST["sign"]);
        
        //公钥目录名在当前目录下的wfpay
        $dir = substr(__CLASS__,strrpos(__CLASS__,DS)+1);
        
        $dir = ROOT_PATH."houtai/uploads/";
        $pubkey = file_get_contents($dir.$arr['pubkey']);
        $dinpay_public_key = openssl_get_publickey($pubkey);
        $flag  = openssl_verify($str,$sign,$dinpay_public_key,OPENSSL_ALGO_MD5);
        return $flag;  
    }
    
    //SUCCESS 交易成功,FAILED 交易失败
    public function pay_ok(){
        return "SUCCESS" == $_POST['trade_status'];
    }
    
    public function transid(){
        return $_POST['trade_no'];//系统订单号
    }
    
    public function orderid(){
        return $_POST['order_no'];
    }
    
    public function success() {
        echo "SUCCESS";
    }
}

