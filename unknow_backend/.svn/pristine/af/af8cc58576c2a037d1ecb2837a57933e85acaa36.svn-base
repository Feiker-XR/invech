<?php 
namespace app\pay;

class xfpay extends basepay {
	public function pay(){
		$arr = $this->params;

        $params['merNo'] = $arr['pid'];
        $params['payNetway'] = $arr['tcode'];//'WX',ZFB,ZFB_WAP
        $params['random'] = (string) rand(1000,9999);
        $params['orderNo'] = $arr['order_id'];  //商户订单号
        $params['amount'] = (string) ($arr['order_money']*100);  //默认分为单位,必须是字符串,否则经json编码后签名错误;
        $params['goodsInfo'] = '虚拟商品';
        $params['callBackUrl'] = $arr['callbackurl'];
        $params['callBackViewUrl'] = \request()->scheme. '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?rec=View';  //前台跳转 可以写成固定
        $params['clientIP'] = $this->GetRemoteIP();  #客户请求IP        
        ksort($params);
        $params['sign'] = $this->create_sign($params);    
        $data = $this->json_encode($params);         
        $post = array('data'=>$data);    
        $ret = $this->post($arr['purl'],$post);
        //所有扫码支付统一返回格式为{status:0表示成功,msg}
        $ret = json_decode($ret);

        return ['status'=>0,
            'orderid'=>@$ret->orderNo,
            'data'=>@$ret->qrcodeInfo,
            'msg'=>$ret->resultMsg,];
	//{"resultCode":"99","resultMsg":"支付宝通道不可用！"}  //ZFB
    //WX ok
    //{"merNo":"SF170621103544706","orderNo":"20170906071030101812","qrcodeInfo":"weixin://wxpay/bizpayurl?pr=H2tHrYM","resultCode":"00","resultMsg":"提交成功","sign":"03DF7CE859344D04A8BC9B43F0DB0ECB"}
    //ZFB_WAP ok
    //{"merNo":"SF170621103544706","orderNo":"20170906074234692053","qrcodeInfo":"https://qr.alipay.com/bax03327qcsd1lqg8ecw605a","resultCode":"00","resultMsg":"提交成功","sign":"E957B95E6EC2D71D570DEACD512A8C85"}

	}

    private function GetRemoteIP(){ 
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
        $ip = getenv("HTTP_CLIENT_IP"); 
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
        $ip = getenv("HTTP_X_FORWARDED_FOR"); 
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
        $ip = getenv("REMOTE_ADDR"); 
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
        $ip = $_SERVER['REMOTE_ADDR']; 
        else 
        $ip = "unknown"; 
        return($ip); 
    }

    private function json_encode($input){
        if(is_string($input)){
            $text = $input;
            $text = str_replace('\\', '\\\\', $text);
            $text = str_replace(
                array("\r", "\n", "\t", "\""),
                array('\r', '\n', '\t', '\\"'),
                $text);
            $text = str_replace("\\/", "/", $text); 
            return '"' . $text . '"';
        }else if(is_array($input) || is_object($input)){
            $arr = array();
            $is_obj = is_object($input) || (array_keys($input) !== range(0, count($input) - 1));
            foreach($input as $k=>$v){
                if($is_obj){
                    $arr[] = self::json_encode($k) . ':' . self::json_encode($v);
                }else{
                    $arr[] = self::json_encode($v);
                }
            }
            if($is_obj){
                $arr = str_replace("\\/", "/", $arr);
                return '{' . join(',', $arr) . '}';
            }else{
                $arr = str_replace("\\/", "/", $arr);
                return '[' . join(',', $arr) . ']';
            }
        }else{
            $input = str_replace("\\/", "/", $input);
            return $input . '';
        }
    }

    private function json_decode($json){
        $comment = false;
        $out = '$x=';
        for ($i=0; $i<strlen($json); $i++){
            if (!$comment){
                if (($json[$i] == '{') || ($json[$i] == '[')) $out .= ' array(';
                else if (($json[$i] == '}') || ($json[$i] == ']')) $out .= ')';
                else if ($json[$i] == ':') $out .= '=>';
                else $out .= $json[$i];
            }
            else $out .= $json[$i];
            if ($json[$i] == '"' && $json[($i-1)]!="\\") $comment = !$comment;
        }
        eval($out . ';');
        return $x;
    }

    /**
     * 创建签名
     */
    public function create_sign($params=[]) {
    	$arr = $this->params;
        $tosign = $this->json_encode($params) . $arr['pkey'];
        $sign = md5($tosign);
        return strtoupper($sign); 
    }
        
    public function check_sign(){
        /*
        $form = "<form action='' method=''>\r\n";
        foreach($_REQUEST as $k => $v){
            $form .="<input name='$k' value='$v' />";
        }
        $form .="</form>";
        file_put_contents(dirname(__FILE__).'/shunpay.form.html', $form,FILE_APPEND);
        */
        $arr = $this->params;
        $data = $_POST['data'];
        $data = json_decode($data,true);//$this->json_decode($data);
        $r_sign = $data['sign'];
        $sign_arr = array();
        foreach ($data as $key=>$v){
            if ($key !== 'sign'){
                $sign_arr[$key] = $v;
            }
        }
        ksort($sign_arr);
        $sign = strtoupper(md5($this->json_encode($sign_arr) . $arr['pkey']));
        return $sign == $r_sign;
    }

    public function pay_ok(){
        $data = $_POST['data'];
        $data = $this->json_decode($data);
        return "00" == $data['resultCode'];
    }
    
    public function transid(){
        $data = $_POST['data'];
        $data = $this->json_decode($data);        
        return $data['orderNo'];//系统订单号
    }
    
    public function orderid(){
        $data = $_POST['data'];
        $data = $this->json_decode($data);
        return $data['orderNo'];
    }

    public function success() {
        echo "000000";
    }
}



