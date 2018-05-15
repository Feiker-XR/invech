<?php
/**
 * 常用函数文件
 * User: Administrator
 * Date: 2018/1/2 0002
 * Time: 12:52
 */
namespace app\pay\ymfpay;

/**
 * 获取支付类型
 *
 */
function getPayType()
{
    $payType = '' ;
    $words   = '' ;
    $type    = $_REQUEST['type'] ;
    switch ($type) {

        case 'WECHAT' :
            $payType = 5 ;
            $words = '微信';
            break ;
        case 'WAP' :
            $payType = 13 ;
            $words = '微信';
            break ;

        case 'ALIPAY' :
            $payType = 4 ;
            $words = '支付宝';
            break ;
        case 'ALIPAYWAP' :
            $payType = 9 ;
            $words = '支付宝';
            break ;

        case 'QQPAY' :
            $payType = 6 ;
            $words = 'QQ';
            break ;
        case 'QQPAYWAP' :
            $payType = 15;
            $words = 'QQ';
            break ;

        case 'JDPAY' :
            $payType = 8 ;
            $words = '京东';
            break ;

        case 'BANK' :
            $payType = 1 ;
            $words = '银联';
            break ;
        case 'BANKWAP' :
            $payType = 1 ;
            $words = '银联';
            break ;
        case 'BANKSCAN' :
            $payType = 17 ;
            $words = '银联扫码';
            break ;
         case 'BANKQUICK' :
            $payType = 12 ;
            $words = '快捷支付';
            break ;
         case 'JDPAY' :
            $payType = 8 ;
            $words = '京东扫码';
            break ;
         case 'JDPAYWAP' :
            $payType = 21 ;
            $words = '京东H5';
            break ;

        default:
             break ;
    }

    return $payType ;
}

/**
 * 创建签名
 * @param $data
 * @param $key
 */
function create_sign($data,$sign_key)
{
    $sign = '' ;
     ksort($data) ;
    foreach ($data as $key=>$val) {
        $sign .= $key.'='.$val.'&';
    }
    $sign = substr($sign,0,-1) ;
    $sign .=$sign_key ;
    return (md5($sign)) ;
}

/**
 * 返回本地请求地址
 */
function getLocalRequestUrl()
{
    $pay_url = '' ;
    //记录支付处理地址
    if ( !$_SERVER['HTTP_REFERER'] ) {
        $pay_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ;
    } else {
        $pay_url = $_SERVER['HTTP_REFERER'] ;
    }
    return $pay_url ;
}

/*
 * 获取银行简码
 */
function getBankCode()
{
    $bank = $_REQUEST['bank'] ;
    $bankInfo['962'] = 'CNCB' ; //中信银行
    $bankInfo['963'] = 'BOC'  ; //中国银行
    $bankInfo['964'] = 'ABC'  ; //中国农业银行
    $bankInfo['965'] = 'CCB'  ; //中国建设银行
    $bankInfo['967'] = 'ICBC' ; //中国工商银行
    $bankInfo['968'] = 'CZSB' ; //浙商银行
    $bankInfo['970'] = 'CMB'  ; //招商银行
    $bankInfo['971'] = 'PSBC' ; //中国邮政储蓄银行
    $bankInfo['972'] = 'CIB'  ; //兴业银行
    $bankInfo['975'] = 'BOSH' ; //上海银行
    $bankInfo['977'] = 'SPDB' ; //浦发银行
    $bankInfo['978'] = 'PAB'  ; //平安银行
    $bankInfo['980'] = 'CMBC' ; //中国民生银行
    $bankInfo['981'] = 'COMM' ; //交通银行
    $bankInfo['982'] = 'HXB'  ; //华夏银行
    $bankInfo['985'] = 'GDB'  ; //广发银行
    $bankInfo['986'] = 'CEB'  ; //中国光大银行
    $bankInfo['988'] = 'CBHB' ; //渤海银行
    $bankInfo['989'] = 'BOBJ' ; //北京银行

    if (!isset($bankInfo[$bank])) {
        exit("<script>alert('很抱歉,暂不支持该行...');history.go(-1);</script>");
    }
    return $bankInfo[$bank];
}

/**
 * POST访问
 * @param $url
 * @param $data
 * @return mixed|string
 */
 function submitPostData($url,$data) {
    $ch = curl_init() ;
    curl_setopt($ch, CURLOPT_URL, $url) ;
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST") ;
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE) ;
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE) ;
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)') ;
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1) ;
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1) ;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data) ;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
    $tmpInfo = curl_exec($ch) ;
    if ( curl_errno($ch) ) {
        return curl_error($ch) ;
    }
    return $tmpInfo;
}

/**
 * 表单方式
 */
 function submitFormMethod($params, $gateway, $method = 'post', $charset = 'utf-8') {
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
    header("Content-type:text/html;charset={$charset}");
    $sHtml = "<form id='paysubmit' name='paysubmit' action='{$gateway}' method='{$method}'>";

    foreach ($params as $k => $v) {
        $sHtml.= "<input type=\"hidden\" name=\"{$k}\" value=\"{$v}\" />\n";
    }

    $sHtml = $sHtml . "</form>正在提交支付数据 ...";

    $sHtml = $sHtml . "<script>document.forms['paysubmit'].submit();</script>";

    return $sHtml;
}

//WAP方式：“WAP_PAY_B2C”（手机支付） WEB方式：“WEB_PAY_B2C”（pc浏览器
function get_api_name()
{
    $apiName = '' ;
    if (isMobile()) {
        $apiName = 'WAP_PAY_B2C' ;
    } else {
        $apiName = 'WEB_PAY_B2C' ;
    }
    return $apiName ;
}


function isMobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA'])) {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}


function dd($arr)
{
    echo '<pre>';
    print_r($arr) ;
    die;
}