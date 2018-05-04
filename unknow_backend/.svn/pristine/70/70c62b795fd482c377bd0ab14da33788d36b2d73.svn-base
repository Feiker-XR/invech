<?php 
namespace app\pay;

class lbpay extends basepay {
	public function pay(){

		$arr = $this->params;

		//签名参数 取 params属性中一部分
		//重新构造 表单参数
        $params['sign']		=	$this->create_sign();
		$params['parter']	=	$arr['pid'];
        $params['type']		=	$arr['tcode'];
        $params['value']	=	$arr['order_money'];
        $params['orderid']	=	$arr['order_id'];
        $params['callbackurl']	=	 $arr['callbackurl'];
        $params['payerIp']		=	$_SERVER["REMOTE_ADDR"];
        $params['attach']		=	$arr['pid']."-".$arr['order_id'];       
        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        return $html;
	}

    /**
     * 创建签名
     */
    public function create_sign() {
    	$arr = $this->params;
		$str ="parter=".$arr['pid']. "&type=".$arr['tcode']. "&value=".$arr['order_money']. "&orderid=".$arr['order_id']. "&callbackurl=".$arr['callbackurl']. $arr['pkey'];
		return md5($str);
    }
        
    public function check_sign(){
        $orderid = input('orderid');//订单号
        $opstate = input('opstate');//状态
        $ovalue = input('ovalue');//支付金额
        $ekaorderid = input('ekaorderid');//系统订单号
        $ekatime = input('ekatime');//时间
        $sysorderid = input('sysorderid');//商户订单号
        $attach = input('attach');//扩展
        $cid = input('cid');//商户号
        $msg = input('msg');
        $sign = input('sign');
        
        $info = db('vc_order')->where(['order_id'=>$orderid])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();        
        $apikey = $thirdpay['pkey'];
        
        $toSignString ="orderid=".$orderid . "&opstate=".$opstate . "&ovalue=".$ovalue . $apikey;
        return $sign == md5($toSignString);
    }

    public function transid(){
        return input('ekaorderid');//系统订单号
    }
    
    public function orderid(){
        return input('orderid');
    }
    
    public function pay_ok(){
        return 0 == input('opstate');
    }

    
}
?>


