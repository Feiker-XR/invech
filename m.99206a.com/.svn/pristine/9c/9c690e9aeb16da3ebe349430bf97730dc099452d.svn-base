<?php


// 
//                                  _oo8oo_
//                                 o8888888o
//                                 88" . "88
//                                 (| -_- |)
//                                 0\  =  /0
//                               ___/'==='\___
//                             .' \\|     |// '.
//                            / \\|||  :  |||// \
//                           / _||||| -:- |||||_ \
//                          |   | \\\  -  /// |   |
//                          | \_|  ''\---/''  |_/ |
//                          \  .-\__  '-'  __/-.  /
//                        ___'. .'  /--.--\  '. .'___
//                     ."" '<  '.___\_<|>_/___.'  >' "".
//                    | | :  `- \`.:`\ _ /`:.`/ -`  : | |
//                    \  \ `-.   \_ __\ /__ _/   .-` /  /
//                =====`-.____`.___ \_____/ ___.`____.-`=====
//                                  `=---=`
// 
// 
//               ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//
//                          佛祖保佑         永不宕机/永无bug
// +----------------------------------------------------------------------
// | FileName: htypay.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年12月27日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\pay;
use app\pay\basepay;


class htypay extends basepay{
    /**
     * {@inheritDoc}
     * @see \app\pay\basepay::pay()
     */
    public function pay()
    {
        // TODO Auto-generated method stub
        $pay['p0_Cmd'] = 'Buy';
        $pay['p2_Order'] = strtoupper(uniqid('HTY'));
        $pay['p3_Amt'] = sprintf('%0.2f',isset($_REQUEST["coin"])? trim($_REQUEST["coin"]):'0');
        $username = $_REQUEST['username'];
        $pay['p4_Cur'] = 'CNY';
        $pay['p5_Pid'] = 'name';
        $pay['p6_Pcat'] = 'class';
        $pay['p7_Pdesc'] = 'desc';
        $pay['p8_Url']	= $callback;
        $pay['pd_FrpId'] = 'alipay';
        $pay['pa_MP'] = $_REQUEST['username'].'-'.$_REQUEST['type'];
        $pay['pr_NeedResponse'] = '1';
    }

    /**
     * {@inheritDoc}
     * @see \app\pay\basepay::create_sign()
     */
    public function create_sign()
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see \app\pay\basepay::check_sign()
     */
    public function check_sign()
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see \app\pay\basepay::transid()
     */
    public function transid()
    {
        // TODO Auto-generated method stub
        
    }

    /**
     * {@inheritDoc}
     * @see \app\pay\basepay::pay_ok()
     */
    public function pay_ok()
    {
        // TODO Auto-generated method stub
        
    }

    
    
    function HmacMd5($data,$key)
    {
        // RFC 2104 HMAC implementation for php.
        // Creates an md5 HMAC.
        // Eliminates the need to install mhash to compute a HMAC
        // Hacked by Lance Rushing(NOTE: Hacked means written)
        
        //需要配置环境支持iconv，否则中文参数不能正常处理
        $key = iconv("GB2312","UTF-8",$key);
        $data = iconv("GB2312","UTF-8",$data);
        
        $b = 64; // byte length for md5
        if (strlen($key) > $b) {
            $key = pack("H*",md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad ;
        $k_opad = $key ^ $opad;
        
        return md5($k_opad . pack("H*",md5($k_ipad . $data)));
    }
    
}