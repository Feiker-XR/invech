<?php

namespace app\pay;

class Xmpay extends basepay{
    private  $data  = [] ; //存储组合的第三方参数
    private  $payType = ''  ;//支付类型
    private  $words = '' ; //支付类型中文描述
    private  $isWap = 0  ; //判断用何种请求发送

    /**
     *   支 付
     */
    public function pay($params = null)
    {

        $arr = $this->params;
        $this->getPayType(); //设置支付参数
        $data['messageid'] = 200001;
        $data['out_trade_no'] = $arr['order_id'];
        $data['branch_id'] = $arr['pid'];
        $data['pay_type'] = $arr['tcode'];
        $data['total_fee'] = $arr['order_money']*100;
        $data['prod_name'] = 'pay';
        $data['prod_desc'] = 'pay';
        $data['back_notify_url'] = $arr['callbackurl'];
        $data['nonce_str'] = $this->createNoncestr(32);
        $this->data = $this->sign($data, $arr['pkey']);
        $result     =$this->httpPost($arr['purl'], $this->data) ;
        $resultJson = json_decode($result) ;
        if ($resultJson->resultCode == '00' && $resultJson->resCode == '00') {
            $resultToSign = array();
            foreach ($resultJson as $key => $value) {
                if ($key != 'sign') {
                    $resultToSign[$key] = $value;
                }
            }
            $str = $this->formatBizQueryParaMap($resultToSign);
            $resultSign = strtoupper(md5($str."&key=".$arr['pkey']));

            if ($resultSign != $resultJson->sign) {
                exit("<script>alert('网络错误!');history.go(-1);</script>") ;
            }
        } else {
            exit("<script>alert('".$resultJson->resDesc."');history.go(-1);</script>") ;
        }

            $coin   = $arr['order_money'] ; //支付金额
            $code_url = '' ;
            $orderNo  = $this->data['out_trade_no'] ; //订单ID
            if($resultJson->resCode == 00){
                $code_url = $resultJson->payUrl;
            }else{
                echo "错误";
            }
            $path  = dirname(dirname(dirname(__FILE__))).'/public/scan/qrcode.php' ;
            $words = $this->words ;
            include($path);



    }
    /**
     * 新码支付 特殊的公共文件
     */

    public
    function formatBizQueryParaMap($map, $urlencode = false)
    {

        ksort($map);
        $result = array();
        foreach ($map as $key => $value) {

            if ($value == null) {

                continue;

            }
            if ($urlencode) {

                $value = urlencode($value);

            }
            $result[$key] = $value;

        }
        return urldecode(http_build_query($result));

    }

    public
    function sign($req, $signKey = '')
    {

        $str = $this->formatBizQueryParaMap($req);
        $req['sign'] = strtoupper(md5($str . "&key=" . $signKey));
        return $req;

    }

    public
    function createNoncestr($length)
    {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $res = '';
        for ($i = 0; $i < $length; $i++) {

            $random = mt_rand(0, strlen($chars) - 1);
            $res .= $chars{$random};

        }
        return $res;

    }

    public
    function httpPost($url, $post_data)
    {

        $data_string = $this->zh_json_encode($post_data);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在

        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl);//捕抓异常
        }
        curl_close($curl);
        return $result;

    }
  public  function zh_json_encode($array) {
        $array =$this-> urlencode_array($array);
        return urldecode(json_encode($array));
    }
    /**
     * 递归多维数组，进行urlencode
     * @param $array
     * @return mixed
     */
  private  function urlencode_array($array) {
        foreach($array as $k => $v) {
            if(is_array($v)) {
                $array[$k] = urlencode_array($v);
            } else {
                $array[$k] = urlencode($v);
            }
        }
        return $array;
    }

    /**
     * 特殊公共文件结束
     */





    /**
     * 选择支付类型
     */
    private  function  getPayType()
    {
        $is_wap = 0 ;
        $words = '';
        $type   = '';
        switch($this->params['pay_type']){
            case 'ALIPAY':
                $type = 'ALIPAY';
                $words = '支付宝';
                break;
            case 'ALIPAYWAP':
                $is_wap = 1;
                $type = 'ALIPAYWAP';
                break;
            case 'TENPAY':
                $type = 'TENPAY';
                $words = '财付通';
                break;
            case 'WECHAT':
                $type = 'WEIXIN';
                $words = '微信';
                break;
            case 'WAP':
                $is_wap = 1;
                $type = 'WEIXINWAP';
                break;
            case 'QQPAY':
                $type = 'QQPAY';
                $words = 'QQ';
                break;
            case 'QQPAYWAP':
                $is_wap = 1;
                $type = 'QQPAYWAP';
                break;
            case 'JDPAY':
                $type = 'JDPAY';
                $words = '京东';
                break;
            case 'JDPAYWAP':
                $is_wap = 1;
                $type = 'JDPAYWAP';
                break;
            case 'BANKSCAN':
                $type = 'UNIONPAY';
                $words = '银联钱包';
                break;
            default :
                exit( "<script>alert('尚未支持的支付方式!');history.go(-1)</script>");
                break;
        }
        $this->isWap = $is_wap ;
        $this->words = $words ;
        $this->payType = $type ;
    }
    /**
     *
     *
     * 创建签名
     */
    public function   create_sign($params = null){

    }


    /**
     * y验证签名
     */
    public function   check_sign(){
        $data = file_get_contents("php://input");
        $data = json_decode($data,true) ;
        $data = empty($data) ? $_REQUEST : $data ;
        $arr = $this->params;
        $url=$arr['callbackurl'];
        $form = "<form action=$url >";
        foreach($data as $k => $v){
            $form .= "<input type='' name='$k' value='$v' />";
        }
        $form .="<input type='submit'/><form/>";
        file_put_contents(dirname(dirname(dirname(__FILE__))).'/public/log.html', $form."\r\n"."</br>",FILE_APPEND);

        $sign = $data['sign'] ; //签名
        $data2 = array();
        foreach($data as $k => $v){
            if($k != 'sign' && $v != ''){
                $data2[$k] = $v;
            }
        }

        unset($data2['gamepopup_cookie']);
        unset($data2['yunsuo_session_verify']);
        $data2  = $this->sign($data2, $arr['pkey']) ;


//比较签名密钥结果是否一致，一致则保证了数据的一致性
//比较签名密钥结果是否一致，一致则保证了数据的一致性
     return $sign == $data2['sign'] ;



    }









    /**
     * 支付通知的支付单号,参数在request中,参数名 视支付平台而定
     */
    public function transid()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data,true) ;
        $data = empty($data) ? $_REQUEST : $data ;

        return $data['outTradeNo'] ;
    }

    public function orderid()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data,true) ;
        $data = empty($data) ? $_REQUEST : $data ;

        return $data['outTradeNo'] ;
    }

    /**
     * 支付通知的支付状态判定,参数名以及判定条件 视支付平台而定
     */
    public function pay_ok()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data,true) ;
        $data = empty($data) ? $_REQUEST : $data ;

        return $data['status'] =="02";
    }


    /**
     * 表单方式
     */
//     protected function form($params, $gateway, $method = 'post', $charset = 'utf-8') {
//         header("Cache-Control: no-cache");
//         header("Pragma: no-cache");
//         header("Content-type:text/html;charset={$charset}");
//         $sHtml = "<form id='paysubmit' name='paysubmit' action='{$gateway}' method='{$method}'>";
//
//         foreach ($params as $k => $v) {
//             $sHtml.= "<input type=\"hidden\" name=\"{$k}\" value=\"{$v}\" />\n";
//         }
//
//         $sHtml = $sHtml . "<input type='submit'/></form>正在跳转 ...";
//
//         $sHtml = $sHtml . "<script>document.forms['paysubmit'].submit1();</script>";
//
//         return $sHtml;
//     }

    public function success()
    {
        echo 'SUCCESS';
    }
}
