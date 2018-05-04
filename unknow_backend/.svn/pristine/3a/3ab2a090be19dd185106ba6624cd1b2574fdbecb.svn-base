<?php
// +----------------------------------------------------------------------
// | FileName: lypay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年11月19日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;

class lypay extends basepay{
    
    public function pay(){
        
        $arr = $this->params;
        
        //签名参数 取 params属性中一部分
        //重新构造 表单参数
        $params['sign']		=	$this->create_sign();
        $params['version']  =   '1.0';
        $params['customerid']	=	$arr['pid'];
        $params['paytype']		=	$arr['tcode'];
        $params['total_fee']	=	$arr['order_money'];
        $params['sdorderno']	=	$arr['order_id'];
        $params['notifyurl']	=	 $arr['callbackurl'];
        $params['returnurl']	=	 $arr['callbackurl'];
        $params['remark']		=	$arr['pid']."-".$arr['order_id'];
        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        return $html;
    }
    
    /**
     * 创建签名
     */
    public function create_sign() {
        $arr = $this->params;
       /* $str ="parter=".$arr['pid']. "&type=".$arr['tcode']. "&value=".$arr['order_money']. "&orderid=".$arr['order_id']. "&callbackurl=".$arr['callbackurl']. $arr['pkey'];*/
        $str = "version=1.0&customerid={$arr['pid']}&total_fee={$arr['order_money']}&sdorderno={$arr['order_id']}&notifyurl={$arr['callbackurl']}&returnurl={$arr['callbackurl']}&{$arr['pkey']}";
        return md5($str);
    }
    
    public function check_sign(){
       
        $data['status'] = input('status');
        $data['customerid'] = input('customerid');
        $data['remark']  = input('remark');
        $data['sdpayno']     = input('sdpayno');
        $data['sdorderno']      = input('sdorderno');
        $data['total_fee']  = input('total_fee');
        $data['paytype'] = input('paytype');
        $signature    = input('sign');
        
        $info = db('vc_order')->where(['order_id'=>$data['sdorderno']])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();
        $apikey = $thirdpay['pkey'];
        
        $signStr = '';
        $signStr ="customerid={$data['customerid']}&status={$data['status']}&sdpayno={$data['sdpayno']}&sdorderno={$data['sdorderno']}&total_fee={$data['total_fee']}&paytype={$data['paytype']}&{$apikey}";
        return $signature == md5($signStr);
    }
    
    public function transid(){
        return input('sdpayno');//系统订单号
    }
    
    public function orderid(){
        return input('sdorderno');
    }
    
    public function pay_ok(){
        return 1 == input('status');
    }
    
}