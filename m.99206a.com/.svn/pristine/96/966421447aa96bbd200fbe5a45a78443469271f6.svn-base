<?php
// +----------------------------------------------------------------------
// | FileName: gtpay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年12月15日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;

class ecardpay extends basepay {

    public function pay(){
        $arr = $this->params;

        //签名参数 取 params属性中一部分
        //重新构造 表单参数

        $params['parter']	=	$arr['pid'];
        $params['type']	=	$arr['tcode'];
        $params['value']	=	$arr['order_money'];
        $params['orderid'] = $arr['order_id'];
        $params['callbackurl']	=	 $arr['callbackurl'];
        $params['sign']		=	$this->create_sign();
        $params['hrefbackurl']	=	 $arr['hrefbackurl'];
        $params['payerIp']	=	 $_SERVER['REMOTE_ADDR'];
        $params['attach']	=	 "";
        if($arr['tcode']=="994"||$arr['tcode']=="993"){
            $arr['purl']="http://gateway2019.dinswang.com/scanpay.aspx";
        }
        if($arr['tcode'] == '996'){
            $arr['purl'] = "http://gateway2018.dinswang.com/ChargeBank.aspx";
        }

        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        return $html;
    }


    public function create_sign(){
        $arr = $this->params;
        $signValue = md5("parter={$arr['pid']}&type={$arr['tcode']}&value={$arr['order_money']}&orderid={$arr['order_id']}&callbackurl={$arr['callbackurl']}{$arr['pkey']}");;
        return $signValue;
    }

    public function check_sign(){

        $arr = $this->params;
        $form = "<Form action='{$arr['purl']}' method='POST'>";
        foreach ($_REQUEST as $k=>$v){
            $form .= "<input name='$k' value='$v' />";
        }
        $form .='<input type="submit"></form>';
        file_put_contents(dirname(__FILE__).'/ecardtlog.html', $form."\r\n",FILE_APPEND);
        $sign = trim(input('sign'));
        $orderid =  trim(input('orderid')) ;
        $orderstatus =  trim(input('opstate')) ;
        $ovalue =  trim(input('ovalue')) ;

        $info = db('vc_order')->where(['order_id'=>$orderid])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();
        $apikey = $thirdpay['pkey'];
        $signValue = md5("orderid={$orderid}&opstate={$orderstatus}&ovalue={$ovalue}".$apikey);
        return $sign == $signValue;
    }

    public function transid(){
        return $ordernumber =  trim(input('orderid')) ;
    }

    public function orderid(){
        return $ordernumber =  trim(input('orderid')) ;
    }

    public function pay_ok(){
        $orderstatus = trim(input('opstate'));
        return $orderstatus==0 || $orderstatus == -3;
    }

}