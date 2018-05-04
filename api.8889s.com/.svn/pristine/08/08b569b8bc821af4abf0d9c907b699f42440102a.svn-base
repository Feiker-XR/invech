<?php 
namespace app\live;
use app\live\base;
class sunbet extends base {
    private static $server         = 'https://staging.tgpaccess.com';
    private static $client_id      = 'JinPai';
    private static $client_secret  = 'hfFkrnJfPiNXUIQZV4FjDJsArPwpR2ckLZutyjGWv0R';
    private static $grant_type     = 'client_credentials';
    private static $scope          = 'playerapi';
    private $token          = '';
    public static $suffix   = '';
    private $user_id        = '';
    
    /**
     * 统一接口,创建AG用户
     * @param string $userName
     * @param string $password
     * @param string $betLimitCode
     * @param string $currencyCode
     * @param string $isSpeed
     * @param string $isDemo
     * @return string[]
     */
    public static function create($userName, $password = 'jpa12344321', $betLimitCode = 'A', $currencyCode = 'CNY', $isSpeed = '', $isDemo = '1')
    {
        return;
    }
    
    /**
     * 统一登录接口,新增
     * @param unknown $userName
     * @param string $password
     * @param string $lang
     * @param string $gameType
     * @param string $betLimitCode
     * @param string $currencyCode
     * @param string $dm
     * @param string $actype
     * @return string
     */
    public static function login($userName, $password = 'jpa12344321', $lang = '1', $gameType = '1', $betLimitCode = 'A', $currencyCode = 'CNY', $dm = "www.jinpaizhan.com", $actype = '1')
    {
        return;    
    }
    
    /**
     * 统一查询余额接口
     * @param unknown $userName
     * @param string $password
     * @param string $currencyCode
     * @param string $isSpeed
     * @param string $isDemo
     * @return unknown
     */
    public static function balance($userName, $password = 'jpa12344321', $currencyCode = 'CNY', $isSpeed = '', $isDemo = '1')
    {
        return;
    }
    
    /**
     * 统一转账接口,转出!
     * @param unknown $username
     * @param string $amount
     * @param string $transSN
     * @return number
     */
    public static function transfer ($username, $amount = '0', $transSN = '')
    {
        return;
    }
    
    /**
     * 统一转账接口,充值
     * @param unknown $username
     * @param string $amount
     * @param string $transSN
     * @return number
     */
    public static function recharge($username, $amount = '1', $transSN = '')
    {
        return;
    }
    
    public static  function getToken(){
        $url = self::$server . '/api/oauth/token'; 
        $data['client_id'] = self::$client_id;        
        $data['client_secret'] = self::$client_secret;
        $data['grant_type'] = self::$grant_type;
        $data['scope'] = self::$scope;
        $query = http_build_query($data);  
        $ch = curl_init($url);
        $headers = array(
            "Content-type: application/x-www-form-urlencoded; charset=utf-8",
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $result = curl_exec($ch);
        $errNo = curl_errno($ch);
        curl_close($ch);
        if($errNo){return;}
        $response = json_decode($result);
        if(@$response->err){
            exit("获取登陆Token错误！错误描述为：".@$response->err_description);
        }else{
            return @$response->access_token;
        }
    }
    
    public static function authorize($token,$username){
        $url = self::$server.'/api/player/authorize';
        $user_id = $username.self::$suffix;
        $data['ipaddress']      = self::get_client_ip();
        $data['username']       = $username;
        $data["istestplayer"]   = false;
        $data["userid"]         = $user_id;
        $data["lang"]           = "zh-CN";
        $data["cur"]            = "RMB";
        $data["betlimitid"]     = 5;
        $data["platformtype"]   = 0;
        $query = http_build_query($data);
        $jsonStr = json_encode($data);
        $ch = curl_init($url);
        $headers = array(
            "Content-type: application/json; charset=utf-8",
            'Content-Length:'.strlen($jsonStr),
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        $result = curl_exec($ch);
        $errNo = curl_errno($ch);
        if($errNo){return;}
        $response = json_decode($result);
        if(@$response->err){
            exit("获取认证Token错误！错误描述为：".$response->err_description);
        }else{
            if($response->isnew){
                //sunbetDb::addUser($user_id, $_SESSION['uid']);
            }
            //sunbetDb::addUser($user_id, $_SESSION['uid']);
            //$this->authtoken = $response->authtoken;
            return $response->authtoken;
        }
        curl_close($ch);
    }
    
    public function deauthorize($token,$username){
        $url = self::$server.'/api/player/deauthorize';
        $data['userid'] = $username.self::$suffix;
        $jsonStr = json_encode($data);
        $ch = curl_init($url);
        $headers = array(
            "Content-type: application/json; charset=utf-8",
            'Content-Length:'.strlen($jsonStr),
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        $result = curl_exec($ch);
        $errNo = curl_errno($ch);
        $response = json_decode($result);
    }
    
    
    public static function getBalance($token,$username){
        $userid = $username.self::$suffix;
        $data = array('userid'=>$userid,'cur'=>'RMB');
        $jsonStr = json_encode($data);
        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $url = self::$server.'/api/player/balance?userid='.$userid.'&cur=RMB';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }
        curl_close($ch);
file_put_contents(dirname(__FILE__) . '/sb.log', $result . "\r\n", FILE_APPEND);      
        return json_decode($result);
        
    }
    
    public static function getBalanceList($token){
        $data['cur'] = "RMB";
        $data['includezero'] = 'True';
        $query = http_build_query($data);
        $url = self::$server.'/api/players/balance/list?'.$query;
        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }
        curl_close($ch);
    }
    
    public static function addMoney($token,$money,$username){
        $money = number_format(floatval($money),2);
        /*
        if(empty($_SESSION['uid'])){
            echo "<script>alert('请登陆!');window.location.href='/'</script>";
        }
        */
        $userid = $username.self::$suffix;
        $data = array(
            'userid'    =>$userid,
            'cur'       =>'RMB',
            'amt'       => $money,
            'txid'      =>$userid.'-addmoney-'.time() ,
            'timestamp' =>date(DATE_ISO8601)
        );
        $jsonStr = json_encode($data);
        $headers = array(
            "Content-type: application/json; charset=utf-8",
            'Content-Length:'.strlen($jsonStr),
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $url = self::$server.'/api/wallet/credit';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }
        return $result;
    }
    
    public static function reduceMoney($token,$money,$username){
        $money = number_format(floatval($money),2);
        /*
        if(empty($_SESSION['uid'])){
            echo "<script>alert('请登陆!');window.location.href='/'</script>";
        }
        */
        $userid = $username.self::$suffix;
        $data = array(
            'userid'    =>$userid,
            'cur'       =>'RMB',
            'amt'       => $money,
            'txid'      =>$userid.'-reduce-'.time() ,
            'timestamp' =>date(DATE_ISO8601)
        );
        $jsonStr = json_encode($data);
        $headers = array(
            "Content-type: application/json; charset=utf-8",
            'Content-Length:'.strlen($jsonStr),
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $url = self::$server.'/api/wallet/debit';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            //echo curl_errno($ch);
            return;
        }
        return $result;
    }
    
    /**
     * 获取玩家的历史投注,查询时间不能超过24小时
     * @param timestamp $start
     * @param timestamp $end
     * @param string $userid
     */
    public static function betHistory($start,$end,$token,$userid=''){
        if(($end - $start) > 48 * 3600){
            return false;
        }
        $data['startdate']  = date(DATE_ISO8601,$start);
        $data['enddate']    = date(DATE_ISO8601,$end);
        if(!empty($userid)){
            $data['userid'] = $userid;
        }
        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $query = http_build_query($data);
        $url = self::$server.'/api/history/bettransaction?'.$query;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }
        curl_close($ch);
        return $result;
    }
    
    /**
     * 投注历史方法是用来获取指定的日期/时间范围内的投注记录
     * @param timestamp $start  结束时间
     * @param timestamp $end    开始时间
     * @param string $token     口令
     * @param string $issettled[optional] 只能是字符串的True和False
     * @param string $usesrid[optional]  查询指定用户的，为空时查询所有的
     * @return mixed|boolean 
     */
    public static function bethistoryRecommand($start,$end,$token,$issettled = 'False',$userid = ''){
        if(($end - $start) > 48 * 3600){
            return false;
        }
        $data['startdate']  = date(DATE_ISO8601,$start);
        $data['enddate']    = date(DATE_ISO8601,$end);
        $data['issettled'] = $issettled;
        if($userid){
            $data['userid'] = $userid; 
        }
        $query = http_build_query($data);
        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $url = self::$server.'/api/history/bets?'.$query;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }
        curl_close($ch);
        return $result;
    }
    
    /**
     * 查询玩家的转账记录
     * @param timestamp $start  开始时间
     * @param timestamp $end   结束时间
     * @param string $token   查询token
     * @param string $userid[optional] 用户id 为空的时候返回的是所有的用户
     * @return boolean|mixed
     */
    public static function transfers($start,$end,$token,$userid = ''){
        if(($end - $start) > 48 * 3600){
            return false;
        }
        $data['startdate']  = date(DATE_ISO8601,$start);
        $data['enddate']    = date(DATE_ISO8601,$end);
        if(!empty($userid)){
            $data['userid'] = $userid;
        }
        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $query = http_build_query($data);
        $url = self::$server.'/api/history/transfers?'.$query;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }
        return $result;
        curl_close($ch);
    }
    
    public static function gameHistory($start, $end, $token, $userid = ''){
        if(($end - $start) > 48 * 3600){
            return false;
        }
        $data['startdate']  = date(DATE_ISO8601,$start);
        $data['enddate']    = date(DATE_ISO8601,$end);
        //$data['includetestplayers'] = "True";
        if(!empty($userid)){
            $data['userid'] = $userid;
        }
        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $query  = http_build_query($data);
        $url    = self::$server.'/api/history/game?'.$query;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }
        curl_close($ch);
		return $result;
    }

    public static function gameDetailHistory($token,$userid,$gpcode,$roundid,$platformtype){
        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $data['platformtype'] = $platformtype;
        //http://<TGPIntegrationAPIServer>/api/history/providers/{gpcode}​/rounds/{roundid}​/users/{userid}​?platformtype={platformtype}
        $query = http_build_query($data);
        $url    = self::$server.'/api/history/providers/'.$gpcode.'/rounds/'.$roundid.'/users/'.$userid.'?'.$query;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }
        curl_close($ch);
        return $result;
        
    }
	public static function getGameList($platform,$token){
        $platform_code = array('0','1','4');
        $data = array('lang'=>'zh-CN','platformtype'=>$platform);
        $headers = array(
            'Accept: application/json',
            'Authorization: Bearer '.$token,
        );
        $query = http_build_query($data);
        $url = self::$server.'/api/games?'.$query;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,5);
        $result = curl_exec($ch);
        $err = curl_errno($ch);
        if($err){
            echo curl_errno($ch);
        }else{
			echo $result;
		}
        curl_close($ch);
    }
    
    public function sendRequest($url,$method='GET',$data = array(),$options = array()){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($method == 'POST'){
            curl_setopt($ch, CURLOPT_POST, 1);
            if(count($data) >0){
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }
        if(count($options) == 0){
            curl_setopt_array($ch, $options);
        }
        $output = curl_exec($ch);
        return $output;
    }
    
    public static function get_client_ip($type = 0) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
    
    static public function isotime(){
        $time = microtime();
    }
    
}