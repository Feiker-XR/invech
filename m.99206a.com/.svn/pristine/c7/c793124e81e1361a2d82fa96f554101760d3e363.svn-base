<?php
// 
//                                  _oo8oo_
//                                 o8888888o
//                                 88" . "88
//                                 (| -_- |)
//                                 0\  =  /0
//                               ___/'==='\___
//                             .' \\|     |// '.
//                            / \\|||  :  |||// \
//                           / _||||| -:- |||||_ \
//                          |   | \\\  -  /// |   |
//                          | \_|  ''\---/''  |_/ |
//                          \  .-\__  '-'  __/-.  /
//                        ___'. .'  /--.--\  '. .'___
//                     ."" '<  '.___\_<|>_/___.'  >' "".
//                    | | :  `- \`.:`\ _ /`:.`/ -`  : | |
//                    \  \ `-.   \_ __\ /__ _/   .-` /  /
//                =====`-.____`.___ \_____/ ___.`____.-`=====
//                                  `=---=`
// 
// 
//               ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//
//                          佛祖保佑         永不宕机/永无bug
// +----------------------------------------------------------------------
// | FileName: MbPay.php
// +----------------------------------------------------------------------
// | CreateDate: 2018年5月10日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay\ymfpay;
class MbPay {
    private $mbpKey;
    public $serverUrl;
    
    
    /**
     * 签名初始化
     * @param mbpKey	签名密钥
     * @param url		请求的URL
     */
    
    public function __construct($mbpKey, $url="") {
        $this->mbpKey = $mbpKey;
        $this->serverUrl = $url;
    }
    
    /**
     * 创建表单
     * @data		表单内容
     * @gateway 支付网关地址
     */
    function buildForm($data, $gateway) {
        $sHtml = "<form id='mobaopaysubmit' name='mobaopaysubmit' action='".$gateway."' method='post'>";
        while (list ($key, $val) = each ($data)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }
        $sHtml.= "</form>";
        $sHtml.= "<script>document.forms['mobaopaysubmit'].submit();</script>";
        
        return $sHtml;
    }
    
    /**
     * @name	准备签名/验签字符串
     * @desc prepare urlencode data
     * @mobaopay_tran_query
     * #apiName,apiVersion,platformID,merchNo,orderNo,tradeDate,amt
     * #@mobaopay_tran_return
     * #apiName,apiVersion,platformID,merchNo,orderNo,tradeDate,amt,tradeSummary
     * #@web_pay_b2c,wap_pay_b2c
     * #apiName,apiVersion,platformID,merchNo,orderNo,tradeDate,amt,merchUrl,merchParam,tradeSummary
     * #@pay_result_notify
     * #apiName,notifyTime,tradeAmt,merchNo,merchParam,orderNo,tradeDate,accNo,accDate,orderStatus
     choosePayType
     */
    public function prepareSign($data) {
        if($data['apiName'] == 'MOBO_TRAN_QUERY') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt']
                );
            return $result;
        } else if ($data['apiName'] == 'AUTO_SETT_QUERY') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&startDate=%s&endDate=%s&startIndex=%s&endIndex=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['startDate'], $data['endDate'], $data['startIndex'],$data['endIndex']
                );
            return $result;
        } else if ((($data['apiName'] == 'WEB_PAY_B2C') ||($data['apiName'] == 'WAP_PAY_B2C'))&& ($data['apiVersion'] == '1.0.0.0')) {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s&merchUrl=%s&merchParam=%s&tradeSummary=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['merchUrl'], $data['merchParam'], $data['tradeSummary']
                );
            return $result;
        } else if ($data['apiName'] == 'MOBO_USER_WEB_PAY') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&userNo=%s&accNo=%s&orderNo=%s&tradeDate=%s&amt=%s&merchUrl=%s&merchParam=%s&tradeSummary=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['userNo'], $data['accNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['merchUrl'], $data['merchParam'], $data['tradeSummary']
                );
            return $result;
        } else if ($data['apiName'] == 'MOBO_TRAN_RETURN') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s&tradeSummary=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['tradeSummary']
                );
            return $result;
        } else if ($data['apiName'] == 'PAY_RESULT_NOTIFY') {
            $result = sprintf(
                "apiName=%s&notifyTime=%s&tradeAmt=%s&merchNo=%s&merchParam=%s&orderNo=%s&tradeDate=%s&accNo=%s&accDate=%s&orderStatus=%s",
                $data['apiName'], $data['notifyTime'], $data['tradeAmt'], $data['merchNo'], $data['merchParam'], $data['orderNo'], $data['tradeDate'], $data['accNo'], $data['accDate'], $data['orderStatus']
                );
            return $result;
        }else if ((($data['apiName'] == 'WEB_PAY_B2C') ||($data['apiName'] == 'WAP_PAY_B2C')) && ($data['apiVersion'] == '1.0.0.1')) {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s&merchUrl=%s&merchParam=%s&tradeSummary=%s&customerIP=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['merchUrl'], $data['merchParam'], $data['tradeSummary'],$data['customerIP']
                );
            return $result;
        }else if ($data['apiName'] == 'SINGLE_ENTRUST_SETT') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&merchUrl=%s&merchParam=%s&bankAccNo=%s&bankAccName=%s&bankCode=%s&bankName=%s&Amt=%s&tradeSummary=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['merchUrl'], $data['merchParam'], $data['bankAccNo'], $data['bankAccName'],$data['bankCode'], $data['bankName'],$data['Amt'], $data['tradeSummary']
                );
            return $result;
        }
        
        $array = array();
        foreach ($data as $key=>$value) {
            array_push($array, $key.'='.$value);
        }
        return implode($array, '&');
    }
    
    /**
     * @name	生成签名
     * @param	sourceData
     * @return	签名数据
     */
    public function sign($data) {
        $signature = MD5($data.$this->mbpKey);
        return $signature;
    }
    
    /*
     * @name	准备带有签名的request字符串
     * @desc	merge signature and request data
     * @param	request字符串
     * @param	签名数据
     * @return
     */
    public function prepareRequest($string, $signature) {
        return $string.'&signMsg='.$signature;
    }
    
    /*
     * @name	请求接口
     * @desc	request api
     * @param	curl,sock
     */
    public function request($data, $method='curl') {
        # TODO:	当前只有curl方式，以后支持fsocket等方式
        $curl = curl_init();
        $curlData = array();
        $curlData[CURLOPT_POST] = true;
        $curlData[CURLOPT_URL] = $this->serverUrl;
        $curlData[CURLOPT_RETURNTRANSFER] = true;
        $curlData[CURLOPT_TIMEOUT] = 120;
        
        #CURLOPT_FOLLOWLOCATION
        $curlData[CURLOPT_POSTFIELDS] = $data;
        curl_setopt_array($curl, $curlData);
        //var_dump($curlData);
        
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($curl);
        
        if (!$result)
        {
            var_dump(curl_error($curl));
        }
        curl_close($curl);
        //echo $result;
        return $result;
    }
    
    /*
     * @name	准备获取验签数据
     * @desc	extract signature and string to verify from response result
     */
    public function prepareVerify($result) {
        preg_match('{<respData>(.*?)</respData>}', $result, $match);
        $srcData = $match[0];
        preg_match('{<signMsg>(.*?)</signMsg>}', $result, $match);
        $signature = $match[1];
        $signature = str_replace('%2B', '+', $signature);
        return array($srcData, $signature);
    }
    
    /*
     * @name	验证签名
     * @param	signData 签名数据
     * @param	sourceData 原数据
     * @return
     */
    public function verify($data, $signature) {
        $mySign = $this->sign($data);
        if (strcasecmp($mySign, $signature) == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * @name 支付查询请求交易
     * @desc
     */
    public function mobaopayTranQuery($data) {
        $str_to_sign = $this->prepareSign($data);
        $sign = $this->sign($str_to_sign);
        $to_request = $this->prepareRequest($str_to_sign, $sign);
        $result = $this->request($to_request);
        
        $to_verify = $this->prepareVerify($result);
        
        if ($this->verify($to_verify[0], $to_verify[1]) ) {
            return $result;
        } else{
            //echo "verify error";
            return false;
        }
    }
    
    /*
     * @name	支付退款请求交易
     * @desc
     */
    public function mobaopayTranReturn($data) {
        $str_to_sign = $this->prepareSign($data);
        $sign = $this->sign($str_to_sign);
        $to_requset = $this->prepareRequest($str_to_sign, $sign);
        $result = $this->request($to_requset);
        $to_verify = $this->prepareVerify($result);
        if ($this->verify($to_verify[0], $to_verify[1]) ) {
            return $result;
        } else {
            return false;
        }
    }
    
    /*
     * @name	组装请求的交易数据
     * @desc
     */
    public function getTradeMsg($data) {
        if($data['tradeSummary']){
            $data['tradeSummary'] = urlencode($data['tradeSummary']);
        }
        return $this->prepareSign($data);
    }
    /*
     * @name	支付系统请求交易
     * @desc
     */
    public function mobaopayOrder($data) {
        $str_to_sign = $this->prepareSign($data);
        $sign = $this->sign($str_to_sign);
        $sign = urlencode($sign);
        $to_request = $this->prepareRequest($this->getTradeMsg($data), $sign);
        $url = $this->serverUrl . '?' . $to_request;
        if($data['bankCode']){
            $url = $url . '&bankCode='.$data['bankCode'];
        }
        $this->redirect($url);
    }
    /*$getIp=$_SERVER["REMOTE_ADDR"];
     * @name	获取客服端ip
     * @desc
     */
    public function getIp(){
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            return $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORVARDED_FOR'])){
            return $_SERVER['HTTP_X_FORVARDED_FOR'];
        }elseif(!empty($_SERVER['REMOTE_ADDR'])){
            return $_SERVER['REMOTE_ADDR'];
        }else{
            return "未知IP";}
            
    }
}
?>
