<?php
namespace app\live;
use app\live\base;

class mgGame extends base{
    public static $root_url = 'https://api.adminserv88.com';
    public static $api_username = 'JPCNYAPI';
    public static $api_password = '6xZsC$EnsvizGpe8MuI4Yj^f';
    public static $client_id = "";
    public static $secret = "";
    
    public static $timezone = "UTC+8";
    public static $currency = "CNY";
    public static $language = "zh-CN";
    public static $parentid = '507203';
    
    public static $default_wallet_code = 'CREDIT_CASH1';
    public static $default_balance_type = 'CREDIT_BALANCE';
    
    /**
     * 生成txid
     * @param string $username
     */
    public static function genTxid($username = ''){
        $str = md5(time().rand(1000000,9999999).$username);
        return substr($str, 0,8).'-'.substr($str,8,4).'-'.substr($str,12,4).'-'.substr($str,16,4).'-'.substr($str,20,12);
    }
    
    /**
     *
     * @param string $sub_url 提交的URL
     * @param string $auth 授权口令
     * @param string $http_method 提交方式
     * @param string $contentType mime类型
     * @param string $data 内容
     * @param string $tx_id 序列ID
     */
    public static function sendRequest($sub_url, $auth, $http_method, $contentType, $data,$tx_id = ''){
        try {
            $api_url = self::$root_url . $sub_url;
            $headers[] = "";
            $headers[] = "Authorization:{$auth}";
            $headers[] = "X-DAS-TZ:".self::$timezone;
            $headers[] = "X-DAS-CURRENCY:".self::$currency;
            $headers[] = "X-DAS-TX-ID:".($tx_id == '' ? self::genTxid() : $tx_id);
            $headers[] = "X-DAS-LANG:".self::$language;
            
            if ($contentType == "json") {
                $headers[] = "Content-Type:application/json";
                $dataStr = json_encode($data);
            } else if ($contentType == "query_string"){
                $dataStr = http_build_query($data);
            }
            // echo $dataStr;
            //var_dump($headers);
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_method);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20 );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataStr);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
file_put_contents(dirname(__FILE__) . '/mg.log', '$api_url=' . $api_url . "\r\n", FILE_APPEND);            
            $resp = curl_exec($ch);
            $failed = curl_errno($ch);
            if($failed){
                $error = curl_error($ch);
                var_dump($error);
            }
            curl_close($ch);
            
            if($failed) {
                return self::generateResponse(false, "System error.");
            }
            
file_put_contents(dirname(__FILE__) . '/mg.log', $resp . "\r\n", FILE_APPEND);
            $resp_json = json_decode($resp, true);
            if ($resp_json["error"] ?? false) {
                return self::generateResponse(false, $resp_json["error"]);
            } else if ($resp_json["data"] ?? false) {
                return self::generateResponse(true, $resp_json["data"]);
            } else {
                return self::generateResponse(true, $resp_json);
            }
        }catch (Exception $e){
            return self::generateResponse(false, "system error.");
        }
    }
    
    /**
     * 生成回复内容
     * @param string $success
     * @param string $body
     * @return multitype:unknown
     */
    public static function generateResponse ($success, $body) {
        $resp_str = array(
            "success" => $success,
            "body" => $body
        );
        return $resp_str;
    }
    
    public static function authenticate (){
        $sub_url = '/oauth/token';
        $auth = 'Basic R2FtaW5nTWFzdGVyMUNOWV9hdXRoOjlGSE9SUWRHVFp3cURYRkBeaVpeS1JNZ1U=';
        $contentType = 'query_string';
        $http_method = 'POST';
        $data = array(
            'grant_type' => 'password',
            'username'  => self::$api_username,
            'password'  => self::$api_password,
        );
        // $tx_id = '12344321';
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
    /**
     * 创建会员
     * @param string $auth
     * @param string $username
     * @param string $password
     * @param string $ext_ref
     * @param string $group_id
     * @return multitype:unknown
     */
    public static function createMember($auth,$username,$password,$ext_ref= '',$group_id = ''){
        $sub_url = '/v1/account/member';
        $http_method = 'POST';
        $contentType = 'json';
        $auth = 'Bearer '.$auth;
        $data = array(
            'parent_id' => self::$parentid,
            'username'  => $username,
            'password'  => $password,
        );
        if($ext_ref){
            $data['ext_ref'] = $ext_ref;
        }
        if($group_id){
            $data['group_id'] = $group_id;
        }
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
    /**
     * 更新用户密码
     * @param string $auth
     * @param string $password
     * @param string $ext_ref
     * @param string $account_id
     * @return multitype:unknown
     */
    public static function updateMemberPassword($auth,$password,$ext_ref,$account_id = ''){
        if(!($ext_ref != '' || $ext_ref != '')){
            return self::generateResponse(false, '参数错误!');
        }
        $sub_url = '/v1/account/member/password';
        $http_method = 'PUT';
        $contentType = 'json';
        $data = array(
            'password' => $password
        );
        $auth = 'Bearer '.$auth;
        if($account_id != ''){
            $data['account_id'] = $account_id;
        }
        if($ext_ref != ''){
            $data['ext_ref'] = $ext_ref;
        }
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
        
    }
    
    /**
     * 根据ID来获取用户账户信息
     * @param string $auth
     * @param string $account_id
     */
    public static function getAccountById($auth,$account_id){
        $sub_url = "/v1/account/{$account_id}";
        $auth = 'Bearer '.$auth;
        $http_method = 'GET';
        $contentType = 'json';
        $data = '';
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
    /**
     * 根据别名信息来获取账户信息
     * @param string $auth
     * @param string $ext_ref
     */
    public static function getAccountByExtref($auth,$ext_ref){
        $sub_url = "/v1/account/?ext_ref=$ext_ref";
        $auth = 'Bearer '.$auth;
        $http_method = 'GET';
        $contentType = 'json';
        $data = '';
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
    /**
     * 获取所有的子账户
     * @param string $auth
     * @param string $account_id
     * @param string $page
     * @param string $page_size
     * @param string $desc
     */
    public static function listChildAccounts($auth,$account_id ,$page = '1' , $page_size = '100' ,$desc = false){
        $sub_url = "/v1/account/{$account_id}/children";
        $auth = 'Bearer '.$auth;
        $http_method = 'GET';
        $contentType = 'query_string';
        $data = array(
            'account_id' => $account_id,
            'page'  => $page,
            'page_size' => $page_size,
            'desc'  => $desc
        );
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
    /**
     * 转账
     * @param string $auth accesstoken
     * @param number $money 转账金额
     * @param string $order_id 订单号
     * @param int $type 转账类型 0为给充值 加款 1为提现
     * @param string $ext_ref 账号
     * @param integer $account_id 账户id
     * @return multitype:array
     */
    public static function createTranscation($auth,$money,$order_id,$type = 0,$account_ext_ref = '', $account_id = '' ){
        $transcation_array  = array(
            'CREDIT',
            'DEBIT',
        );
        $transcation = $transcation_array[$type];
        if(!($account_id != '' || $account_ext_ref != '')){
            return self::generateResponse(false, '参数$account_ext_ref和参数account_id不能同时为空!');
        }
        $sub_url = "/v1/transaction";
        $auth = 'Bearer '.$auth;
        $http_method = 'POST';
        $contentType = 'json';
        $data[] = array(
            'balance_type'  =>  'CREDIT_BALANCE',
            'category'      =>  'TRANSFER',
            'amount'        =>  $money,
            'account_ext_ref'   => $account_ext_ref,
            'external_ref'       => $order_id,
            'account_id'    => $account_id,
            'type'          => $transcation
        );
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
    /**
     * 验证转账
     * @param string $auth
     * @param string $order_id
     * @param string $account_ext_ref
     * @param string $account_id
     */
    public static function verfyTranscation ($auth,$order_id,$account_ext_ref = '',$account_id = '') {
        if(!($account_ext_ref != '' || $account_id != '')){
            return self::generateResponse(false, 'ext_ref与account_id不能同时为空!');
        }
        $sub_url = "/v1/transaction?ext_ref={$account_ext_ref}&account_id={$account_id}";
        $http_method = 'GET';
        $contentType = 'json';
        $auth = 'Bearer '.$auth;
        $data = array(
            'account_id'        =>  $account_id,
            'account_ext_ref'   =>  $account_ext_ref,
            'ext_ref'           => $order_id,
        );
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
    /**
     * 获取余额
     * @param string $auth
     * @param string $account_ext_ref
     * @param string $account_id
     *
     */
    public static function getBalance($auth,$account_ext_ref = '',$account_id = ''){
        if(!($account_ext_ref != '' || $account_id != '')){
            return self::generateResponse(false, '$account_ext_ref与$account_id不能同时为空!');
        }
        $auth = 'Bearer '.$auth;
        $sub_url = "/v1/wallet?account_ext_ref=$account_ext_ref";
        $http_method = 'GET';
        $contentType = 'json';
        $data = array(
            'account_ext_ref'   => $account_ext_ref,
        );
        
$compact = compact('sub_url','auth','http_method','contentType','data');
file_put_contents(dirname(__FILE__) . '/mg.log', var_export($compact,true)  . "\r\n", FILE_APPEND);      
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
        
    }
    
    /**
     *
     * @param string $auth
     * @param string $start_time
     * @param string $end_time
     * @param string $page_size
     * @param string $include_transfers
     * @param string $include_end_round
     * @return multitype:unknown
     */
    public static function requestByCompanyId($auth,$start_time,$end_time,$page_size = 100,$include_transfers = true , $include_end_round = false ){
        $sub_url = "/v1/feed/transaction?company_id=".self::$parentid."&start_time=$start_time&end_time=$end_time";
        $sub_url .= "&page_size=$page_size";
        echo $sub_url,'<br/>';
        $http_method = 'GET';
        $auth = 'Bearer '.$auth;
        $contentType = 'json';
        $data = '';
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
    public static function lauchItem($auth,$account_ext_ref,$item_id,$app_id,$lang = 'zh-CN'){
        $sub_url = '/v1/launcher/item';
        $http_method = 'POST';
        $contentType = 'json';
        $auth = 'Bearer '.$auth;
        $data = array(
            'ext_ref' => $account_ext_ref,
            'app_id'    => $app_id,
            'item_id'   => $item_id,
            'login_context'  => array(
                'lang'	=> $lang,
            ),
        );
        return self::sendRequest($sub_url, $auth, $http_method, $contentType, $data);
    }
    
     public static function create($username,$password){
         ;
     }
     public static function login($username,$password){
         ;
     }
     public static function balance($username){
         ;
     }
     public static function transfer($username,$orderid,$money){
         ;
     }
     public static function recharge($username,$orderid,$money){
         ;
     }
}
