<?php
namespace app\Pay\Driver;

use app\Pay\Contracts\Pay;
use app\Pay\BasePay;

class Ympay implements Pay
{
    use BasePay;

    public function pay($params = null){

        date_default_timezone_set('PRC');

        foreach ($params as $key => $value ) {
            $this->params[$key] = $value;
        }
        $arr = $this->params;        
        
        $bank_types = ['ICBC','ABC','BOC','CCB','COMM','CMB','SPDB','CIB','CMBC','GDB','CNCB','CEB','HXB','PSBC','PAB','BOBJ','BONB'];
        $post = [
            'apiName'=>request()->isMobile()?'WAP_PAY_B2C':'WEB_PAY_B2C',
            //'apiName'=>'WAP_PAY_B2C',
            'apiVersion'=>'1.0.0.1',
            'platformID'=>$arr['pid'],
            'merchNo'=>$arr['pid'],//'108001002002',
            'orderNo'=>$arr['orderno'],
            'tradeDate'=>date('Ymd'),
            'amt'=>$arr['amount'],
            'merchUrl'=>$arr['hrefbackurl'],
            'merchParam'=>iconv("GBK","UTF-8", 'abcd'),
            'tradeSummary'=>"虚拟商品",
            'customerIP'=>request()->ip(),
            'bankCode'=>in_array($arr['pay_code'],$bank_types)?$arr['pay_code']:'',
            'choosePayType'=>!in_array($arr['pay_code'],$bank_types)?$arr['pay_code']:'1',

            'pkey' => $arr['pkey']
        ];

        if($arr['pay_code'] == 11 || $arr['pay_code'] == 13){
            $post['bankCode'] = 'weixin';
        }

        $post['signMsg'] = $this->create_sign($post);

        $html = $this->form($post, $arr['purl']);
        return ['mode'=>'html','content'=>$html,];
    }
    
    /**
     * 创建签名
     */
    public function create_sign($params=[]) {
        $data = $params;
        if(empty($params)){
            $data = $this->params;
        }
        if($data['apiName'] == 'MOBO_TRAN_QUERY') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt']
            );
            return MD5($result.$data['pkey']);
        } else if ($data['apiName'] == 'AUTO_SETT_QUERY') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&startDate=%s&endDate=%s&startIndex=%s&endIndex=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['startDate'], $data['endDate'], $data['startIndex'],$data['endIndex']
            );
            return MD5($result.$data['pkey']);
        } else if ((($data['apiName'] == 'WEB_PAY_B2C') ||($data['apiName'] == 'WAP_PAY_B2C'))&& ($data['apiVersion'] == '1.0.0.0')) {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s&merchUrl=%s&merchParam=%s&tradeSummary=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['merchUrl'], $data['merchParam'], $data['tradeSummary']
            );
            return MD5($result.$data['pkey']);
        } else if ($data['apiName'] == 'MOBO_USER_WEB_PAY') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&userNo=%s&accNo=%s&orderNo=%s&tradeDate=%s&amt=%s&merchUrl=%s&merchParam=%s&tradeSummary=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['userNo'], $data['accNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['merchUrl'], $data['merchParam'], $data['tradeSummary']
            );
            return MD5($result.$data['pkey']);
        } else if ($data['apiName'] == 'MOBO_TRAN_RETURN') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s&tradeSummary=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['tradeSummary']
            );
            return MD5($result.$data['pkey']);
        } else if ($data['apiName'] == 'PAY_RESULT_NOTIFY') {
            $result = sprintf(
                "apiName=%s&notifyTime=%s&tradeAmt=%s&merchNo=%s&merchParam=%s&orderNo=%s&tradeDate=%s&accNo=%s&accDate=%s&orderStatus=%s",
                $data['apiName'], $data['notifyTime'], $data['tradeAmt'], $data['merchNo'], $data['merchParam'], $data['orderNo'], $data['tradeDate'], $data['accNo'], $data['accDate'], $data['orderStatus']
            );
            return MD5($result.$data['pkey']);
        }else if ((($data['apiName'] == 'WEB_PAY_B2C') ||($data['apiName'] == 'WAP_PAY_B2C')) && ($data['apiVersion'] == '1.0.0.1')) {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&amt=%s&merchUrl=%s&merchParam=%s&tradeSummary=%s&customerIP=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['amt'], $data['merchUrl'], $data['merchParam'], $data['tradeSummary'],$data['customerIP']
            );
            return MD5($result.$data['pkey']);
        }else if ($data['apiName'] == 'SINGLE_ENTRUST_SETT') {
            $result = sprintf(
                "apiName=%s&apiVersion=%s&platformID=%s&merchNo=%s&orderNo=%s&tradeDate=%s&merchUrl=%s&merchParam=%s&bankAccNo=%s&bankAccName=%s&bankCode=%s&bankName=%s&Amt=%s&tradeSummary=%s",
                $data['apiName'], $data['apiVersion'], $data['platformID'], $data['merchNo'], $data['orderNo'], $data['tradeDate'], $data['merchUrl'], $data['merchParam'], $data['bankAccNo'], $data['bankAccName'],$data['bankCode'], $data['bankName'],$data['Amt'], $data['tradeSummary']
            );
            return MD5($result.$data['pkey']);
        }

        $array = array();
        foreach ($data as $key=>$value) {
            if($key != 'pkey'){
                array_push($array, $key.'='.$value);
            }
        }
        $signStr = implode($array, '&');
        return MD5($signStr.$data['pkey']);
    }
    
    public function check_sign(){        
        $params = request()->param();
        $params['pkey'] = $this->params['pkey'];
        $sign = trim(input('signMsg'));
        return  strcasecmp($this->create_sign($params), $sign) == 0;
    }
    
    //SUCCESS 交易成功,FAILED 交易失败
    public function pay_ok(){
        return "1" == input('orderStatus');
    }
    
    public function out_trade_no(){
        return input('orderNo');//系统订单号
    }
    
    public function orderno(){
        return input('orderNo');
    }
    
    public function success() {
        echo "SUCCESS";
    }
}

