<?php
// +----------------------------------------------------------------------
// | FileName: gtpay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年12月15日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;

class gtpay extends basepay {

    public function pay(){
        $arr = $this->params;

        //签名参数 取 params属性中一部分
        //重新构造 表单参数

        $params['partner']	=	$arr['pid'];
        $params['banktype']	=	$arr['tcode'];
        $params['paymoney']	=	$arr['order_money'];
        $params['ordernumber'] = $arr['order_id'];
        $params['callbackurl']	=	 $arr['callbackurl'];
        $params['hrefbackurl']	=	 $arr['hrefbackurl'];
        $params['sign']		=	$this->create_sign();
        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        return $html;
    }


    public function create_sign(){
        $arr = $this->params;
        $signValue = md5("partner={$arr['pid']}&banktype={$arr['tcode']}&paymoney={$arr['order_money']}&ordernumber={$arr['order_id']}&callbackurl={$arr['callbackurl']}".$arr['pkey']);;
        return $signValue;
    }

    public function check_sign(){

        $arr = $this->params;
        $form = "<Form action='http://hg.dd788799.com/pay/notify/thirdtype/wfpay/' method='POST'>";
        foreach ($_REQUEST as $k=>$v){
            $form .= "<input name='$k' value='$v' />";
        }
        $form .='</form>';
        file_put_contents(dirname(__FILE__).'/gtlog.html', $form."\r\n",FILE_APPEND);
        $sign = trim(input('sign'));
        $partner =  trim(input('partner')) ;
        $orderno = $ordernumber =  trim(input('ordernumber')) ;
        $orderstatus =  trim(input('orderstatus')) ;
        $value = $paymoney =  trim(input('paymoney')) ;

        $info = db('vc_order')->where(['order_id'=>$orderno])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();
        $apikey = $thirdpay['pkey'];
        $signValue = md5("partner={$partner}&ordernumber={$ordernumber}&orderstatus={$orderstatus}&paymoney={$paymoney}".$apikey);
        return $sign == $signValue;
    }

    public function transid(){
        return $ordernumber =  trim(input('ordernumber')) ;
    }

    public function orderid(){
        return $ordernumber =  trim(input('ordernumber')) ;
    }

    public function pay_ok(){
        return '1' == trim(input('orderstatus'));
    }

}