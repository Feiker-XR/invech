<?php
// +----------------------------------------------------------------------
// | FileName: gtpay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年12月15日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;

class hypay extends basepay {

    public function pay(){
        $arr = $this->params;

        //签名参数 取 params属性中一部分
        //重新构造 表单参数

        $params['merchantcode']	=	$arr['pid'];
        $params['type']	=	$arr['tcode'];
        $params['amount']	=	$arr['order_money'];
        $params['orderid'] = $arr['order_id'];
        $params['notifyurl']	=	 $arr['callbackurl'];
        $params['sign']		=	$this->create_sign();
        $params['callbackurl']	=	 $arr['hrefbackurl'];
        $params['clientip']	=	 $_SERVER['REMOTE_ADDR'];
        $params['desc']	=	 "";

        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        return $html;
    }


    public function create_sign(){
        $arr = $this->params;
        $signValue = md5("amount={$arr['order_money']}&merchantcode ={$arr['pid']}&notifyurl ={$arr['callbackurl']}&orderid ={$arr['order_id']}&type ={$arr['tcode']}&key={$arr['pkey']}");;
        return strtoupper($signValue);
    }

    public function check_sign(){

        $arr = $this->params;
        $form = "<Form action='{$arr['purl']}' method='POST'>";
        foreach ($_REQUEST as $k=>$v){
            $form .= "<input name='$k' value='$v' />";
        }
        $form .='<input type="submit"></form>';
        file_put_contents(dirname(__FILE__).'/hylog.html', $form."\r\n",FILE_APPEND);
        $orderstatus = $_GET["status"]; // 支付状态
        $orderid = $_GET["orderid"]; // 订单号
        $ovalue = $_GET["amount"]; //付款金额
        $sign = $_GET["sign"];	//字符加密串


        $info = db('vc_order')->where(['order_id'=>$orderid])->find();
        $thirdpay = db('vc_thirdpay')->where(['name'=>$info['pay_api']])->find();
        $apikey = $thirdpay['pkey'];
        $signValue = md5($signSource = "amount={$ovalue}merchantcode={$_GET["merchantcode"]}orderid={$orderid}paytime={$_GET["paytime"]}status={$orderstatus}key={$apikey}");
        return $sign == strtoupper($signValue);
    }

    public function transid(){
        return $ordernumber =  trim(input('orderid')) ;
    }

    public function orderid(){
        return $ordernumber =  trim(input('orderid')) ;
    }

    public function pay_ok(){
        $orderstatus = trim(input('status'));
        return $orderstatus==0;
    }

}