<?php
namespace app\live;
class oggame {
    public static $config = array(
        'url'=>'http://cashapi.dg20mu.com/cashapi/',
        'agent'=>'jinpai',
        'key'=>'xzasi893we1u',//'fy#swo@%9',
        'suffix'=>'',
    );
    
    /**
     * 账户是否存在，存在则返回1，不存在返回0，代理不存在直接退出
     * @param string $params
     * @param string $key 接口秘钥
     * @return boolean 是否存在
     */
    public static function CheckAccountIsExist($username){
        $params = array(
            'agent'=>self::$config['agent'],
            'username'=>$username.self::$config['suffix'],
            'method' => 'caie'
        );
        $param = oggame::builtParams($params);
        $xmlstr = self::sendRequst($param);
        $result = self::xmlToArray($xmlstr);
        if($result[0] == '1'){
            return 1;
        }elseif($result[0] == '0'){
            return 0;
        }elseif($result[0] == '10'){
            exit('代理不存在！');
        }
    }
    
    /**
     * 创建用户，成功返回1，失败返回0
     * @param string $username 注册的用户名
     * @param string $password 注册的密码
     */
    public static function CheckAndCreateAccount($username,$password){
        $params = array(
            'agent'         => self::$config['agent'],
            'username'      => $username.self::$config['suffix'],
            'password'      => $password,
            'limit'         => '1,1,1,1,1,1,1,1,1,1,1,1,0',
            'limitvideo'    => '38',
            'limitroulette' => '5',
            'method'        => 'caca',
        );
        $params = self::builtParams($params);
        $xmlstr = self::sendRequst($params);
        $result = self::xmlToArray($xmlstr);
        if($result[0] == '1' ){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 查询余额
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $platformname[optional] 平台名称<p>
     * 必须是下面的一个
     * ibc，ag，oriental,opus,mg,allbet,Laxino,zzh,habanero ,pt
     * </p>
     * @return number
     */
    public static function GetBalance($username,$password,$platformname =''){
     
        $params = array(
            'agent'         => self::$config['agent'],
            'username'      => $username.self::$config['suffix'],
            'password'      => $password,
        );
        if(!empty($platformname)){
            $params['platformname'] = $platformname;
        }
        $params['method'] = 'gb';
        
        $params = self::builtParams($params);
        $xmlstr = self::sendRequst($params);
        $result = self::xmlToArray($xmlstr);
        if(is_numeric($result[0])){
            return $result[0];
        }else{
            return false;
        }
    }
    /**
     * 转账,如果成功返回1，如果返回2需要用查询确认，返回其他则不成功
     * @param string $useranme 用户名
     * @param string $password 密码
     * @param string $billno 订单号 <br/>
     * 订单号必须唯一，由前缀和13~16个数字串组成
     * @param string $type 类型<br/>
     * type必须是"IN" 或者 "OUT"
     * @param number $money 转账金额<br/>保留2位小数
     * @param int $usertype   用户类型<br/>
     * 1为正式用户，0位测试用户
     *
     */
    public static function TransferCredit($useranme,$password,$billno,$type,$money,$usertype = 1){
        $params = array(
            'agent'         => self::$config['agent'],
            'username'      => $useranme.self::$config['suffix'],
            'password'      => $password,
            'billno'        => $billno,
            'type'          => $type,
            'usertype'      => $usertype,
            'credit'        => number_format($money,2),
            'method'        => 'ptc'
        );
        $params = self::builtParams($params);
        $xmlstr = self::sendRequst($params);
        $result = self::xmlToArray($xmlstr);
        return $result[0];
    }
    
    /**
     * 依据订单信息查询转账,成功则返回1，其他则转账为失败
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $billno 订单号
     * @param string $type 转账类型<br/>
     *只能是"IN"，"OUT"
     * @param number $money
     * @return mixed
     */
    public static  function ConfirmTransferCredit($username,$password,$billno,$type,$money){
        $params = array(
            'agent'         => self::$config['agent'],
            'username'      => $username.self::$config['suffix'],
            'password'      => $password,
            'billno'        => $billno,
            'type'          => $type,
            'credit'        => number_format($money,2),
            'method'        =>'ctc'
        );
        $params =  self::builtParams($params);
        $xmlstr = self::sendRequst($params);
        $result = self::xmlToArray($xmlstr);
        return $result[0];
    }
    
    
    public static function TransferGame($username,$password,$domain,$gametype,$gamekind,$platformname='oriental',$lang='zh'){
        $params = array(
            'agent'           => self::$config['agent'],
            'username'        => $username.self::$config['suffix'],
            'password'        => $password,
            'domain'          => $domain,
            'gametype'        => $gametype,
            'gamekind'        => $gamekind,
            'platformname'    => $platformname,
            'lang'            => $lang,
            'method'          => 'tg'
        );
        $params = self::builtParams($params);
        $query = http_build_query(array('params'=>$params,'key'=>md5($params.self::$config['key'])));
        $url = self::$config['url'].'DoBusiness.aspx?'.$query;

        return $url;
    }
    
    
    public static function sendRequst($params,$timeout = 0){
        $opts = array(
            'http'=>array(
                'method' => 'GET',
                'timeout' => '10',
            )
        );
        $query = http_build_query(array('params'=>$params,'key'=>md5($params.self::$config['key'])));
        $url = self::$config['url'].'DoBusiness.aspx?'.$query;
        try{
            $result = file_get_contents($url);
        }catch(\Exception $e){
            $result = "<?xml version='1.0'?><document>0</document>";     
        }
        return $result;
    }
    
    /**
     * 构建查询参数params,已经过base64转换
     * @param array $params 需要传入的参数
     * @return string
     */
    public static function builtParams($params){
        $str = array();
        foreach($params as $k=>$v){
            $str [] = $k.'='.$v;
        }
        $str = implode('$', $str);
        $str = base64_encode($str);
        return $str;
    }
    //select a.id from c_bet as a,c_bet_b as b where a.mingxi_1 != b.mingxi_1 or a.mingxi_2 != b.mingxi_2 or a.money != b.money
    
    /**
     * 将xml文档转换成数组
     * @param string $xmlStr
     * @return mixed
     */
    public static function xmlToArray($xmlstr){
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $xmlstring = simplexml_load_string($xmlstr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $val = json_decode(json_encode($xmlstring),true);
        return $val;
        
    }
    
}
