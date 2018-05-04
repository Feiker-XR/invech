<?php

namespace app\Pay\Driver;

use app\Pay\Contracts\Pay;
use app\Pay\BasePay;

//use app\pay\bqpay\Util;

class Bqpay implements Pay {

    public function pay($params = null){

        foreach ($params as $key => $value ) {
            $this->params[$key] = $value;
        }        
        $arr = $this->params;

        $isApp  = request()->isMobile()?'app':'';

        $DataContentParms =array();
        $DataContentParms["X1_Amount"] = $arr['amount'];; //订单金额
        $DataContentParms["X2_BillNo"] = date("YmdHis").rand(100,100000);//订单号
        $DataContentParms["X3_MerNo"] = $arr['pid'];//商户号
        $DataContentParms["X4_ReturnURL"] = $arr['callbackurl'];
        $DataContentParms["X6_MD5info"] = $this->GetMd5str($DataContentParms,$arr['pkey']);

        $DataContentParms["X5_NotifyURL"] = $arr['hrefbackurl'];
        $DataContentParms["X7_PaymentType"] = $arr['pay_code'];
        $DataContentParms["X8_MerRemark"] = "虚拟商品";
        $DataContentParms["isApp"] = $isApp; //固定值： 值为"app",表示app接入； 值为空，表示web接入

        if($arr['pay_code'] == 'KJZF'){
            $html = $this->form($DataContentParms, $arr['purl'],'post');
            return $html;
        }

        $ret = $this->post($arr['purl'],$DataContentParms);
        $row = json_decode($ret, true); #将返回json数据转换为数组
        
        if (!isset($row['status'])){
            throw new \Exception('错误描述：' . $row['Result']);
        }
        if($row['status'] != '88'){
            throw new \Exception('系统错误,错误号：' . $row['status'] . '错误描述：' . $row['msg']);
        }else{
                $qrcodeUrl = $row['imgUrl'];
                /*
                if(request()->isMobile()){
                    header("location:".$qrcodeUrl);
                }
                */
                return ['mode'=>'qrcode','content'=>$qrcodeUrl,];
        }
        
   
    }

    public function create_sign($params=[])
    {
        // TODO: Implement create_sign() method.
    }

    public function check_sign($params=[]){

        $arr = $this->params;

        $MD5info         =     $_REQUEST["MD5info"];

        $DataContentParms =array();
        $DataContentParms["MerNo"] = $_REQUEST['MerNo'];
        $DataContentParms["BillNo"] = $_REQUEST["BillNo"];
        $DataContentParms["Amount"] =  $_REQUEST["Amount"];
        $DataContentParms["Succeed"] =  $_REQUEST["Succeed"];

        $apikey = $arr['pkey'];
        $md5sign = $this->GetMd5str($DataContentParms,$apikey);
        return $MD5info == $md5sign;
    }
    
    //SUCCESS 交易成功,FAILED 交易失败
    public function pay_ok(){
        return "88" == $_REQUEST['Succeed'];
    }
    
    public function out_trade_no(){
        return $_REQUEST['BillNo'];//系统订单号
    }
    
    public function orderno(){
        return $_REQUEST['BillNo'];
    }


    public function GetMd5str($Parm,$Key){
        $prestr = $this->CreateLinkstring($this->ArgSort($Parm));         //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $mysgin = strtoupper(md5($prestr."&". strtoupper(md5($Key))));              //把最终的字符串签名，获得签名结果
        return $mysgin; 
    }

    public function ArgSort($array) 
    {   
        ksort($array);
        reset($array);
        return $array;
    }
        
    /**
    *把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
    *$array 需要拼接的数组
    *return 拼接完成以后的字符串
    */
    public function CreateLinkstring($array) 
    {
        $arg  = "";
        while (list ($key, $val) = each ($array)){            
            if($val !=''){
                $arg.=$key."=".$val."&";
            }            
        }
        $arg = substr($arg,0,count($arg)-2);             //去掉最后一个&字符
        return $arg;
    }    
}