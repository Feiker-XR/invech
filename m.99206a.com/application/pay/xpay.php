<?php
// +----------------------------------------------------------------------
// | FileName: xpay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年11月19日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;
use app\pay\xpay\Pay as xpaylab;

class xpay extends basepay {
    public function pay(){
        date_default_timezone_set('PRC');
        $arr = $this->params;
        $ip = request()->ip();
        $data['version'] = '1.0.0.0';
        $data['merId'] = $arr['pid'];
        $data['tradeNo'] = $arr['order_id'];
        $data['extra'] = '';
        $data['bankId'] = '';
        
        
        switch ($arr['tcode']){
            case '1':
            case '2':
            case '4':
                $data['typeId'] = $arr['tcode'];
                request()->isMobile() ? $data['service'] = 'TRADE.H5PAY' : $data['service'] = 'TRADE.SCANPAY';
                break;
            case '5':
                $data['typeId'] = $arr['tcode'];
                $data['service'] = 'TRADE.SCANPAY';
                break;
            default :
                $data['service'] = 'TRADE.B2C';
                $data['bankId'] = $arr['tcode'];
                break;
        }
        $data['tradeDate'] = date("Ymd");
        $data['amount'] =sprintf("%.2f", $arr['order_money']);
        $data['notifyUrl'] = $arr['callbackurl'];
        $data['summary'] = 'online pay';
        $data['expireTime'] = 30*60;
        $data['clientIp'] = $ip;
        $pPay = new xpaylab($arr['pkey'],$arr['purl']);
        $str_to_sign = $pPay->prepareSign($data);
        $data['sign'] = $this->create_sign($data);
        
        
        if($data['service'] == 'TRADE.SCANPAY'){
            $to_requset = $pPay->prepareRequest($str_to_sign, $data['sign']);
            $resultData = $pPay->request($to_requset);
            preg_match('{<code>(.*?)</code>}', $resultData, $match);
            $respCode = $match[1];
            preg_match('{<desc>(.*?)</desc>}', $resultData, $match);
            $respDesc = $match[1];
            if($respCode == '00'){
                preg_match('{<qrCode>(.*?)</qrCode>}', $resultData, $match);
                $respqrCode= $match[1];
                $payurl = base64_decode($respqrCode);
                if(!request()->isMobile()){
                    $return['status'] = 'success';
                    $return['data'] = $payurl;
                    $return['orderid'] = $arr['order_id'];
                    $return['msg'] = $respDesc;
                }else{
                    $return['status'] = 'success';
                    $return['data'] = $payurl;
                    $return['orderid'] = $arr['order_id'];
                    $return['msg'] = $respDesc;
                    $return['action'] = 'redirect';
                }
            }else{
                $return['status'] = 'error';
                $return['data'] = '';
                $return['orderid'] = $arr['order_id'];
                $return['msg'] = $respDesc;
            }
            echo json_encode($return);
        }else{
            return $this->form($data, $arr['purl']); 
        }
        
    }
    
    /**
     * 创建签名
     */
    public function create_sign($params=[]) {
        $pPay = new xpaylab($this->params['pkey'],$this->params['purl']);
        $str_to_sign = $pPay->prepareSign($params);
        $signMsg = $pPay->sign($str_to_sign);
        return $signMsg;
    }
    
    public function check_sign(){
        $form = "<form action=''>";
        foreach($_REQUEST as $k => $v){
            $form .= "<input name='$k' value='$v' />";
        }
        $form .="</form>";
        //file_put_contents(dirname(__FILE__).'/form.html',$form."\r\n",FILE_APPEND);
        $arr = $this->params;
        $data = array();
        $data['service'] = $_REQUEST["service"];
        $data['merId'] = $_REQUEST["merId"];
        $order_no = $data['tradeNo'] = $_REQUEST["tradeNo"];
        $data['tradeDate'] = $_REQUEST["tradeDate"];
        $data['opeNo'] = $_REQUEST["opeNo"];
        $data['opeDate'] = $_REQUEST["opeDate"];
        $order_amount = $data['amount'] = $_REQUEST["amount"];
        $data['status'] = $_REQUEST["status"];
        $data['extra'] = $_REQUEST["extra"];
        $data['payTime'] = $_REQUEST["payTime"];
        $data['sign'] = $_REQUEST["sign"];
        $data['notifyType'] = $_REQUEST["notifyType"];
        $this->return = $data;
        $pPay = new xpaylab($arr['pkey'],$arr['purl']);
        
        $str_to_sign = $pPay->prepareSign($data);
        //var_dump($str_to_sign);
        $resultVerify = $pPay->verify($str_to_sign, $data['sign']);
        //var_dump($resultVerify);
        return $resultVerify;
    }
    
    //SUCCESS 交易成功,FAILED 交易失败
    public function pay_ok(){
        //var_dump($this->return);
        return "1" == $this->return['status'];
    }
    
    public function transid(){
        return $this->return['opeNo'];//系统订单号
    }
    
    public function orderid(){
        return $this->return['tradeNo'];
    }
    
    public function success() {
        echo "SUCCESS";
    }
}