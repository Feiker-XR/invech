<?php
// +----------------------------------------------------------------------
// | FileName: qypay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年12月11日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\apipay;
use app\apipay\shunpay;
use app\apipay\shunpay\Util;
class qypay extends shunpay{

    //接口请求返回状态码 1 为请求失败, 0为请求成功
    const  STATUS_ERROR   = 1 ;
    const  STATUS_SUCCESS = 0 ;

    public function pay()
    {
        //定义返回数据格式
        $return = array();
        $return['status'] = self::STATUS_ERROR ;
        $return['msg']    = '' ;  //错误提示信息
        $return['data']   = [] ;  //错误提示信息

        try{
            date_default_timezone_set('PRC');
            $arr = $this->params;
            $ip = request()->ip();
            $pay['version'] = 'V2.0.0.0';
            $pay['merNo'] = $arr['pid']; #商户号
            $pay['netway'] = $arr['tcode'];  #WX 或者 ZFB
            $pay['random'] = (string) rand(1000,9999);  #4位随机数    必须是文本型
            $pay['orderNum'] =  $arr['order_id'];  #商户订单号
            $pay['goodsName'] = '会员充值';
            $pay_amt = $arr['order_money'];
            $pay['amount']  = strval(intval($arr['order_money']) * 100);  #默认分为单位 转换成元需要 * 100   必须是文本型
            $pay['callBackViewUrl'] = $arr['callbackurl'];  #通知地址 可以写成固定
            $pay['callBackUrl'] = $arr['callbackurl'];
            $pay['charset'] = 'UTF-8';
            ksort($pay); #排列数组 将数组已a-z排序
            $sign = md5(Util::json_encode($pay) . $arr['pkey']); #生成签名
            $pay['sign'] = strtoupper($sign); #设置签名
            $data = Util::json_encode($pay); #将数组转换为JSON格式
            $post = array('data'=>$data);
            $ret = $this->post($arr['purl'],$post);
            $row = Util::json_decode($ret); #将返回json数据转换为数组


            if ($row['stateCode'] !== '00'){
                //$return['msg'] = '系统错误,错误号：' . $row['resultCode'] . '错误描述：' . $row['resultMsg'];                
                $return['msg'] = $row['msg'];
            }else{
                if ($this->is_sign($row,$arr['pkey'])){ #验证返回签名数据
                    $qrcodeUrl = $row['qrcodeUrl'];
                    //PC站: $qrcodeUrl 是 二维码图片地址
                    //手机站: $qrcodeUrl 是 手机收银台地址
//                    if(request()->isMobile()){
////                        header("location:".$qrcodeUrl);
//                     $this->location($qrcodeUrl);
//                    }


                    // $msg = $row['msg'];
                    // $return['data'] = $qrcodeUrl;
//                     header("location:" . 'qrcode.php?code=' . $qrcodeUrl.'&netway='.$pay['payNetway']);
                    //$html = $this->location('qrcode.php?code=' . $qrcodeUrl.'&netway='.$pay['payNetway']);
                    $html = $this->location($qrcodeUrl);
                                        
                    //$return['orderid'] = $row['orderNum'];
                    $return['status']  = self::STATUS_SUCCESS ;
                    $return['msg']     = $row['msg'];
                    //$return['data'] = ['mode'=>'qrcode','content'=>$html,];
                    $return['data'] = ['mode'=>'htmml','content'=>$html,];
                }
            }
        } catch (\Exception $e) {
            $return['status'] = self::STATUS_ERROR ;
            $return['msg'] = $e->getMessage() ;
        }

        return $return ;
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
        var_dump($arr);
        $form = "<Form action='http://hg.dd788799.com/pay/notify/thirdtype/qypay/' method='POST'>";
        foreach ($_REQUEST as $k=>$v){
            $form .= "<input name='$k' value='$v' />";
        }
        $form .='</form>';
        file_put_contents(dirname(__FILE__).'/wflog.html', $form."\r\n",FILE_APPEND);
        $data = str_replace("\\", "", $_POST['data']);
        $js = json_decode($data);
        $js = $this->object_array($js);
        $this->return = $js;
        return $this->is_sign($js, $arr['pkey']);
    }
    
    //SUCCESS 交易成功,FAILED 交易失败
    public function pay_ok(){
        return "00" == $this->return['payResult'];
    }
    
    public function transid(){
        return $this->return['orderNum'];//系统订单号
    }
    
    public function orderid(){
        return $this->return['orderNum'];
    }
    
    public function success() {
        echo "0";
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
                $array[$key] = $this->object_array($value);
            }
        }
        return $array;
    }
}

