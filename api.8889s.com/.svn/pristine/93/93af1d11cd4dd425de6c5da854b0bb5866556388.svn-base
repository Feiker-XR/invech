<?php 
namespace app\apipay;

class sxfpay extends basepay {
	public function pay(){

		$arr = $this->params;

        //开始组织发起支付
        $params="partner=".$arr['pid'];
        $params.="&banktype=".$arr['tcode'];
        $params.="&paymoney=".$arr['order_money'];
        $params.="&ordernumber=".$arr['order_id'];
        $params.="&callbackurl=".$arr['callbackurl'];
        $params.="&sign=".$this->create_sign();
        

        //header("location:".$arr['purl']."?$params");        
        $html = $this->location($arr['purl']."?$params");
        $data = ['mode'=>'html','content'=>$html,];
        return ['status'=>0,'msg'=>'','data'=>$data,];
	}

    /**
     * 创建签名
     */
    public function create_sign() {
    	$arr = $this->params;
    	$str ="partner=".$arr['pid']. "&banktype=".$arr['tcode']. "&paymoney=".$arr['order_money']. "&ordernumber=".$arr['order_id']. "&callbackurl=".$arr['callbackurl']. $arr['pkey'];
		return md5($str);
    }
        
    public function check_sign(){

        $orderid = input('ordernumber');//订单号
        $orderstatus = input("orderstatus");
        $paymoney = input("paymoney");
        $sign = input('sign');
        
        //partner={}&ordernumber={}&orderstatus={}&paymoney={}key
        
        $info = db('vc_order')->where(['order_id'=>$orderid])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();        
        $partner = $thirdpay['pid'];
        $apikey = $thirdpay['pkey'];
        
        $toSignString ="partner=".$partner . "&ordernumber=".$orderid . "&orderstatus=".$orderstatus . "&paymoney=" .$paymoney . $apikey;
        return $sign == md5($toSignString);
    }

    public function pay_ok(){
        return "1" == input('orderstatus');
    }
    
    public function transid(){
        return input('sysnumber');//系统订单号
    }
    
    public function orderid(){
        return input('ordernumber');
    }

    public function success() {
        echo "ok";
    }
}
?>


