<?php

namespace app\pay;


/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 14:36
 */

class sypay extends basepay
{
    private  $data = [] ;
    private   $pay_public_key="";

    public function pay()
    {






        $purl='';
        $arr=$this->params;
        switch ($arr['tcode']){
            case "ZFB":
                $purl="http://zfb.637pay/api/pay";
                break;
            case "ZFB_WAP":
                 $purl="http://zfbwap.637pay.com/api/pay";
            case "WX":
                $purl="http://wx.637pay.com/api/pay";
                break;
            case "WX_WAP":
                $purl="http://wxwap.637pay.com/api/pay";
                break;
            case "QQ":
                $purl="http://qq.637pay.com/api/pay";
                break;
            case "QQ_WAP":
                $purl='http://qqwap.637pay.com/api/pay';
                break;
        }
        $data['orderNum'] = $arr['order_id'];  //订单id
        $data['version'] = 'V4.0.0.0';     //版本
        $data['charset'] = 'UTF-8';        //字符
        $data['random'] = (string) rand(1000,9999);//随机数
        $data['merNo'] =$arr['pid'];      //商户号
        $data['subMerNo'] = $arr['pid']; //子商户号
        $data['netway'] = $arr['tcode'];    //支付类型
        $data['amount'] = $arr['order_money']*100;	// 金额 单位:分
        $data['goodsName'] = 'onlinePay';//商品名称
        $data['callBackUrl'] =$arr['callbackurl']; //支付结果通知地址
        $data['callBackViewUrl'] =$arr['hrefbackurl']; //同步显示地址
        $data['sign'] = $this->create_1sign($data,$arr['pkey']);
        $json = $this->json_encode_ex($data);
        $dataStr = $this->encode_pay($json);
        $param = 'data=' . urlencode($dataStr) . '&merchNo=' . $arr['pid'] . '&version=V4.0.0.0';
        $result = $this->wx_post($purl,$param);
        $rows = $this->json_to_array($result,$purl);
        if ($rows['stateCode'] == '00'){
            echo "订单查询成功,以下是订单数据</br>";
           $this->P($rows); 	#支付状态 00:支付成功 01:支付失败 03:签名错误 04:其他错误 05:未知06:初始 50:网络异常 99:未支付

        }else{
            echo "错误代码：" . $rows['stateCode'] . ' 错误描述:' . $rows['msg'];

        }
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




    /**
     *
     * util
     *
     */



    public function encode_pay($data){
        $pu_key = openssl_pkey_get_public($this->pay_public_key);
        if ($pu_key == false){
            echo "打开密钥出错";
            die;
        }
        $encryptData = '';
        $crypto = '';
        foreach (str_split($data, 117) as $chunk) {
            openssl_public_encrypt($chunk, $encryptData, $pu_key);
            $crypto = $crypto . $encryptData;
        }

        $crypto = base64_encode($crypto);
        return $crypto;

    }


    public function encode_remit($data){#加密
        $pu_key = openssl_pkey_get_public($this->remit_public_key);
        if ($pu_key == false){
            echo "打开密钥出错";
            die;
        }
        $encryptData = '';
        $crypto = '';
        foreach (str_split($data, 117) as $chunk) {
            openssl_public_encrypt($chunk, $encryptData, $pu_key);
            $crypto = $crypto . $encryptData;
        }

        $crypto = base64_encode($crypto);
        return $crypto;

    }



    public function decode($data){
        $pr_key = openssl_get_privatekey($this->private_key);
        if ($pr_key == false){
            echo "打开密钥出错";
            die;
        }
        $data = base64_decode($data);
        $crypto = '';
        foreach (str_split($data, 128) as $chunk) {
            openssl_private_decrypt($chunk, $decryptData, $pr_key);
            $crypto .= $decryptData;
        }
        return $crypto;
    }
    function p($array){
        $str = '<pre>' . print_r($array,true) . '</pre>';
        echo $str;
    }
    function ps($array){
        $str =  print_r($array,true);
        return $str;
    }

    function wx_post($url,$data){
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

    function json_encode_ex($value){
        if (version_compare(PHP_VERSION,'5.4.0','<')){
            $str = json_encode($value);
            $str = preg_replace_callback("#\\\u([0-9a-f]{4})#i","replace_unicode_escape_sequence",$str);
            $str = stripslashes($str);
            return $str;
        }else{
            return json_encode($value,320);
        }
    }

    function json_decode_ex($value){
        return json_decode($value,true);
    }

    function replace_unicode_escape_sequence($match) {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }
    function log_write($log){
        $file = date('Y-m-d') . '.log';
        $str = date('H:i:s') . " " . $log . "\r\n";
        file_put_contents($file,$str,FILE_APPEND);
    }

    function create_1sign($data,$key){
        ksort($data);
        $sign = strtoupper(md5($this->json_encode_ex($data) . $key));
        return $sign;
    }

    function json_to_array($json,$key){
        $array = json_decode_ex($json);
        if ($array['stateCode'] == '00'){
            $sign_string = $array['sign'];
            ksort($array);
            $sign_array = array();
            foreach ($array as $k => $v) {
                if ($k !== 'sign'){
                    $sign_array[$k] = $v;
                }
            }

            $md5 =  strtoupper(md5(json_encode_ex($sign_array) . $key));
            if ($md5 == $sign_string){
                return $sign_array;
            }else{
                $result = array();
                $result['stateCode'] = '99';
                $result['msg'] = '返回签名验证失败';
                return $result;
            }



        }else{
            $result = array();
            $result['stateCode'] = $array['stateCode'];
            $result['msg'] = $array['msg'];
            return $result;
        }

    }


    function callback_to_array($json,$key){
        $array = json_decode_ex($json);
        $sign_string = $array['sign'];
        ksort($array);
        $sign_array = array();
        foreach ($array as $k => $v) {
            if ($k !== 'sign'){
                $sign_array[$k] = $v;
            }
        }

        $md5 =  strtoupper(md5(json_encode_ex($sign_array) . $key));
        if ($md5 == $sign_string){
            return $sign_array;
        }else{
            $result = array();
            $result['payResult'] = '99';
            $result['msg'] = '返回签名验证失败';
            return $result;
        }

    }

}


