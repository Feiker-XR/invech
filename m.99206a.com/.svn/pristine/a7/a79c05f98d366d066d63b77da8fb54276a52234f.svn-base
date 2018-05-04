<?php
// +----------------------------------------------------------------------
// | FileName: shunpay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年11月19日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;
use app\pay\shunpay\Util;
class shunpay extends basepay {
    public function pay(){
        date_default_timezone_set('PRC');
        $arr = $this->params;
        $ip = request()->ip();
        $pay['merNo'] = $arr['pid']; #商户号
        $pay['payNetway'] = $arr['tcode'];  #WX 或者 ZFB
        $pay['random'] = (string) rand(1000,9999);  #4位随机数    必须是文本型
        $pay['orderNo'] =  $arr['order_id'];  #商户订单号
        $pay['goodsInfo'] = '会员充值';
        $pay_amt = $arr['order_money'];
        $pay['amount']  = strval(intval($arr['order_money']) * 100);  #默认分为单位 转换成元需要 * 100   必须是文本型
        $pay['callBackUrl'] = $arr['callbackurl'];  #通知地址 可以写成固定
        $pay['clientIP'] = $ip;  #客户请求IP
        ksort($pay); #排列数组 将数组已a-z排序
        $sign = md5(Util::json_encode($pay) . $arr['pkey']); #生成签名
        $pay['sign'] = strtoupper($sign); #设置签名
        $data = Util::json_encode($pay); #将数组转换为JSON格式
        $post = array('data'=>$data);
        $ret = $this->post($arr['purl'],$post);
        $row = Util::json_decode($ret); #将返回json数据转换为数组
        $return = array();
        if ($row['resultCode'] !== '00'){
            $return['status'] = 'error';
            $return['msg'] = '系统错误,错误号：' . $row['resultCode'] . '错误描述：' . $row['resultMsg'];
        }else{
            if ($this->is_sign($row,$arr['pkey'])){ #验证返回签名数据
                $qrcodeUrl = $row['qrcodeInfo'];
                if(request()->isMobile()){
                    header("location:".$qrcodeUrl);
                }
                
                $msg = $row['resultMsg'];
                $return['status'] = 'success';
                $return['data'] = $qrcodeUrl;
                $return['orderid'] = $row['orderNo'];
                $return['msg'] = $msg;
                //header("location:" . 'qrcode.php?code=' . $qrcodeUrl.'&netway='.$pay['payNetway']);
                //exit();
            }
        }
        
        return $return;
    }
    
    public function orderno() {
        return date("YmdHis").rand(100,99);
    }
    /**
     * 创建签名
     */
    public function create_sign($params=[]) {
       
    }
    
    public function check_sign(){
        $arr = $this->params;
        $data = str_replace("\\", "", $_POST['data']);
        $js = json_decode($data);
        $js = object_array($js);
        $this->return = $js;
        return $this->is_sign($arr, $arr['pkey']);
    }
    
    //SUCCESS 交易成功,FAILED 交易失败
    public function pay_ok(){
        return "00" == $this->return['resultCode'];
    }
    
    public function transid(){
        return $this->return['orderNo'];//系统订单号
    }
    
    public function orderid(){
        return $this->return['orderNo'];
    }
    
    public function success() {
        echo "000000";
    }
    
    public function  is_sign($row, $signKey)
    { // 效验服务器返回数据
        $r_sign = $row['sign']; // 保留签名数据
        $arr = array();
        foreach ($row as $key => $v) {
            if ($key !== 'sign') { // 删除签名
                $arr[$key] = $v;
            }
        }
        ksort($arr);
        $sign = strtoupper(md5(Util::json_encode($arr) . $signKey)); // 生成签名
        if ($sign == $r_sign) {
            return true;
        } else {
            return false;
        }
    }
    
    public function object_array($array)
    {
        if (is_object($array)) {
            $array = (array) $array;
        }
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $array[$key] = object_array($value);
            }
        }
        return $array;
    }
}