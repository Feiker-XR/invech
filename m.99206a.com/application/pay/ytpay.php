<?php
// +----------------------------------------------------------------------
// | FileName: gtpay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年12月15日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;
//御投支付
class ytpay extends basepay {

    public function pay(){
        $arr = $this->params;

        //签名参数 取 params属性中一部分
        //重新构造 表单参数

        $params['merNo']	=	$arr['pid'];
        $params['payType']	=	$arr['tcode'];
        $params['amount']	=	$arr['order_money'];
        $params['orderNo'] = $arr['order_id'];
        $params['notifyUrl']	=	 $arr['callbackurl'];
        $params['sign']		=	$this->create_sign();
        $params['returnUrl']	=	 $arr['hrefbackurl'];
        $params['isDirect']	=	 0;
        $params['bankSegment']	=	 "";


        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        return $html;
    }


    public function create_sign(){
        $arr = $this->params;
        $signValue = md5("merNo=".$arr['pid']."&merSecret=".$arr['pkey']."&amount=".$arr['order_money']."&payType=".$arr['tcode']);;
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
        $orderid =  trim(input('orderNo')) ;
        $orderstatus =  trim(input('orderStatus')) ;
        $ovalue =  trim(input('orderAmount')) ;

        $info = db('vc_order')->where(['order_id'=>$orderid])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();
        $apikey = $thirdpay['pkey'];
        $signValue = md5("status=200&payType=".$_REQUEST['payType']."&orderNo=".$orderid."&orderStatus=".$orderstatus."&orderAmount=".$ovalue."&payoverTime=".$_REQUEST['payoverTime']."&merSecret=". $apikey);
        return $sign == $signValue;
    }

    public function transid(){
        return $ordernumber =  trim(input('orderNo')) ;
    }

    public function orderid(){
        return $ordernumber =  trim(input('orderNo')) ;
    }

    public function pay_ok(){
        $orderstatus = trim(input('orderStatus'));
        return $orderstatus=='SUCCESS';
    }

}