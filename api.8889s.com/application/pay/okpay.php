<?php
// +----------------------------------------------------------------------
// | FileName: okpay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年11月24日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------

namespace app\pay;

class okpay extends basepay{
    
    public function pay(){
        
        $arr = $this->params;
        
        //签名参数 取 params属性中一部分
        //重新构造 表单参数
        
        $params['version']  =   '1.0';
        $params['partner']	=	$arr['pid'];
        $params['orderid']	=	$arr['order_id'];
        $params['payamount']	=	$arr['order_money'];
        $params['payip'] = request()->ip();
        $params['notifyurl']	=	 $arr['callbackurl'];
        $params['returnurl']	=	 $arr['hrefbackurl'];
        $params['paytype']		=	$arr['tcode'];
        $params['remark']		=	$arr['pid']."-".$arr['order_id'];
        $params['sign']		=	$this->create_sign();
        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        return $html;
    }
    
    /**
     * 创建签名
     */
    public function create_sign() {
        $arr = $this->params;
        $payip = request()->ip();
        $signText = "version=1.0&partner=".$arr['pid']."&orderid=".$arr['order_id']."&payamount=".$arr['order_money']."&payip=".$payip."&notifyurl=".$arr['callbackurl']."&returnurl=".$arr['hrefbackurl']."&paytype=".$arr['tcode']."&remark=".$arr['pid']."-".$arr['order_id']."&key=".$arr['pkey'];
        $signValue = strtolower(md5($signText));
        return $signValue;
    }
    
    public function check_sign(){
        
        $version = trim(input('version'));
        $rpartner = trim(input('partner'));
        $orderid = trim(input('orderid'));
        $payamount = trim(input('payamount'));
        $opstate = trim(input('opstate'));
        $orderno = trim(input('orderno'));
        $okfpaytime = trim(input('okfpaytime'));
        $message = trim(input('message'));
        $paytype = trim(input('paytype'));
        $remark = trim(input('remark'));
        $sign = trim(input('sign'));
        
        $info = db('vc_order')->where(['order_id'=>$orderid])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();
        $apikey = $thirdpay['pkey'];
        
        $signText = "version=".$version."&partner=".$rpartner."&orderid=".$orderid."&payamount=".$payamount."&opstate=".$opstate."&orderno=".$orderno."&okfpaytime=".$okfpaytime."&message=".$message."&paytype=".$paytype."&remark=".$remark."&key=".$thirdpay['pkey'];
        
        $signValue = strtolower(md5($signText));
        return $sign == $signValue;
    }
    
    public function transid(){
        return input('orderno');//系统订单号
    }
    
    public function orderid(){
        return input('orderid');
    }
    
    public function pay_ok(){
        return 2 == input('opstate');
    }
    
}