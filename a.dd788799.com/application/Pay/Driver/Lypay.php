<?php
namespace app\Pay\Driver;

use app\Pay\Contracts\Pay;
use app\Pay\BasePay;

class Lypay implements Pay {

    use BasePay;

    public function pay($params = null){
        foreach ($params as $key => $value ) {
            $this->params[$key] = $value;
        }

        $arr = $this->params;
        
        //签名参数 取 params属性中一部分
        //重新构造 表单参数
        $params['sign']		=	$this->create_sign();
        $params['version']  =   '1.0';
        $params['customerid']	=	$arr['pid'];
        $params['paytype']		=	$arr['pay_code'];
        $params['total_fee']	=	$arr['amount'];
        $params['sdorderno']	=	$arr['orderno'];
        $params['notifyurl']	=	 $arr['callbackurl'];
        $params['returnurl']	=	 $arr['callbackurl'];
        $params['remark']		=	$arr['pid']."-".$arr['orderno'];
        $html = $this->form($params, $arr['purl'], 'post', 'utf8');
        $data = ['mode'=>'html','content'=>$html,];
        //$data = ['mode'=>'qrcode','content'=>'/uploads/1496665656963.png',];        
        return $data;
    }
    
    /**
     * 创建签名
     */
    public function create_sign($params=[]) {
        $arr = $this->params;
       /* $str ="parter=".$arr['pid']. "&type=".$arr['tcode']. "&value=".$arr['order_money']. "&orderid=".$arr['order_id']. "&callbackurl=".$arr['callbackurl']. $arr['pkey'];*/
        $str = "version=1.0&customerid={$arr['pid']}&total_fee={$arr['amount']}&sdorderno={$arr['orderno']}&notifyurl={$arr['callbackurl']}&returnurl={$arr['callbackurl']}&{$arr['pkey']}";
        return md5($str);
    }
    
    public function check_sign(){
       
        $arr = $this->params;

        $data['status'] = input('status');
        $data['customerid'] = input('customerid');
        $data['remark']  = input('remark');
        $data['sdpayno']     = input('sdpayno');
        $data['sdorderno']      = input('sdorderno');
        $data['total_fee']  = input('total_fee');
        $data['paytype'] = input('paytype');
        $signature    = input('sign');

        $apikey = $arr['pkey'];
        
        $signStr = '';
        $signStr ="customerid={$data['customerid']}&status={$data['status']}&sdpayno={$data['sdpayno']}&sdorderno={$data['sdorderno']}&total_fee={$data['total_fee']}&paytype={$data['paytype']}&{$apikey}";
        return $signature == md5($signStr);
    }
    
    public function out_trade_no(){
        return input('sdpayno');//系统订单号
    }
    
    public function orderno(){
        return input('sdorderno');
    }
    
    public function pay_ok(){
        return 1 == input('status');
    }

    public function success() {
        echo "success";
    }    
}