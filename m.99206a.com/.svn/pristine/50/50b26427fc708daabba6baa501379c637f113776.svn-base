<?php
namespace app\live;
use app\live\base;

class bbingame extends base{
    const _URL = 'http://link.bong88.cn/app/WebService/JSON/display.php/'; //请求API
    const _WEBSITE = 'kingjp'; //网站名称
    const _SUFFIX = ''; //强制后缀
    const _UPPERNAME = 'dkingjp'; //上层账号的名字
    
    public static  $_KEYS = array(
        'CreateMember'      => array('KeyA'=>'2','KeyB' => '3d2ab7','KeyC' => '6'),
        'Login'             => array('KeyA'=>'7','KeyB' => '712833','KeyC' => '2'),
        'Logout'            => array('KeyA'=>'9','KeyB' => 'H5shSH3Gh','KeyC' => '1'),
        'CheckUsrBalance'   => array('KeyA'=>'3','KeyB' => '93W6vey55','KeyC' => '6'),
        'Transfer'          => array('KeyA'=>'1','KeyB' => 'vFgt6L83ei','KeyC' => '9'),
        'CheckTransfer'     => array('KeyA'=>'2','KeyB' => 'a8JLRgo21','KeyC' => '5'),
        'TransferRecord'    => array('KeyA'=>'2','KeyB' => 'a8JLRgo21','KeyC' => '5'),
        'BetRecord'         => array('KeyA'=>'3','KeyB' => 'FEquHv85','KeyC' => '9'),
        'BetRecordByModifiedDate3'   => array('KeyA'=>'3','KeyB' => 'FEquHv85','KeyC' => '9'),
    );
    
    /**
     * 
     * @param unknown $username
     * @param unknown $password
     * @return boolean
     */
    public static function create($username,$password){
        $action = 'CreateMember';
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . $username . self::_SUFFIX . $keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param = array(
            'website'       => self::_WEBSITE,
            'username'      => $username.self::_SUFFIX,
            'uppername'     => self::_UPPERNAME,
            'password'      => $password,
            'key'           => $key
            
        );
        $query = http_build_query($param);
        $url = self::_URL .$action.'?'.$query;
        $content = self::sendRequest($url);
        $result = json_decode($content);
        if($result !='' && $result->result === true){
            return true;
        }else{
            return false;
        }
    }
    
    
    
    /**
     * 创建用户
     * @param string $username 用户名
     * @param string $password 密码
     * @return boolean
     */
    public static function CreateMember($username,$password){
        $action = 'CreateMember';
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . $username . self::_SUFFIX . $keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param = array(
            'website'       => self::_WEBSITE,
            'username'      => $username.self::_SUFFIX,
            'uppername'     => self::_UPPERNAME,
            'password'      => $password,
            'key'           => $key
            
        );
        $query = http_build_query($param);
        $url = self::_URL .$action.'?'.$query;
        $content = self::sendRequest($url);
        $result = json_decode($content);
        if($result !='' && $result->result === true){
            return true;
        }else{
            return false;
        }
    }
    
    
    public static function Login($username,$password,$lang = 'zh-cn',$page_site = NULL){
        $action = 'Login';
        $param = array(
            'website'   => self::_WEBSITE,
            'username'  => $username.self::_SUFFIX,
            'uppername' => self::_UPPERNAME,
            'lang'      => $lang,
        );
        if($page_site){
            $param['page_site'] = $page_site;
        }
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . $username . self::_SUFFIX . $keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        $content = self::sendRequest($url);
        $result = json_decode($content);
        var_dump($result);
        
        if($result != '' && $result->result === false){
            return false;
        }else{
            echo $content;
            return true;
        }
    }
    
    public static function LoginReturn($username,$password,$lang = 'zh-cn',$page_site = NULL){
        $action = 'Login';
        $param = array(
            'website'   => self::_WEBSITE,
            'username'  => $username.self::_SUFFIX,
            'uppername' => self::_UPPERNAME,
            'lang'      => $lang,
        );
        if($page_site){
            $param['page_site'] = $page_site;
        }
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . $username . self::_SUFFIX . $keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        $content = self::sendRequest($url);
        $result = json_decode($content);
        if($result == '' || $result->result === false){
            return false;
        }else{
            //echo $content;
            return $content;
        }
    }
    
    public static function Logout($username){
        $action = 'Logout';
        $param = array(
            'website'   => self::_WEBSITE,
            'username'  => $username.self::_SUFFIX,
            'uppername' => self::_UPPERNAME,
        );
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . $username . self::_SUFFIX . $keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        $content = self::sendRequest($url);
    }
    
    public static function CheckUsrBalance($username,$page = 0,$pagelimit = 0){
        $action = 'CheckUsrBalance';
        $param = array(
            'website'   => self::_WEBSITE,
            'username'  => $username.self::_SUFFIX,
            'uppername' => self::_UPPERNAME,
        );
        if($page){
            $param['page'] = $page;
        }
        if($pagelimit){
            $param['pagelimit'] = $pagelimit;
        }
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . $username . self::_SUFFIX . $keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        $content = self::sendRequest($url);
    
        $result = json_decode($content);
        if($result !='' && $result->result){
            return $result->data[0]->Balance;
        }else{
            //$result->data->Code,$result->data->Message
            return false;
        }
    }
    
    /**
     * 转账
     * @param string $username 用户名
     * @param numberic $remit 转账金额
     * @param string $remitno 订单号
     * @param string $act 转入（IN），转出（OUT）
     */
    public static function Transfer($username,$remit,$remitno,$act = 'IN'){
        date_default_timezone_set('Etc/GMT+4');
        $action = 'Transfer';
        $param = array(
            'website'   => self::_WEBSITE,
            'username'  => $username.self::_SUFFIX,
            'uppername' => self::_UPPERNAME,
            'remitno'   => $remitno,
            'action'    => $act,
            'remit'     => $remit,
        );
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . $username . self::_SUFFIX .$remitno. $keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        $content = self::sendRequest($url);
        $result = json_decode($content);
         //var_dump($result);exit;
        if($result !='' && $result->result){
            if($result->data->Code == '11100'){
                return true;
            }
        }else{
            return false;
        }
        
    }
    
    /**
     * 查询转账
     * @param string $transid 账单ID
     * @return boolean
     */
    public static function CheckTransfer($transid){
        $action = "CheckTransfer";
        $param = array(
            'website'   => self::_WEBSITE,
            'transid'   => $transid,
        );
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE .  $keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        //{"result":true,"data":{"TransID":"4170170","TransType":"IN","Status":1}}
        $content = self::sendRequest($url);
        $result = json_decode($content);
        if($result !='' && $result->result){
            if($result->result->data->Status){
                return true;
            }
        }
        return false;
    }
    
    /**
     * 查询转账记录
     * @param date("Y-m-d") $date_start 开始日期,必须是年(4)-月(2)-日(2)
     * @param date("Y-m-d") $date_end   结束日期,格式同开始日期
     * @param array $extral 可选项,
     * 可以传入的值有
     * username= 用户名
     * transid 转账流水id
     * transtype 转账的类型,只能为"IN"(转入),"OUT"转出
     * start_hhmmss 开始日期的时间 与start_date 组成 Y-m-d H:i:s形式
     * end_hhmmss 结束日期的时间 与end_date 组成 Y-m-d H:i:s形式
     * page 如果页数不止一页,则可以设定查询的页数
     * pagelimit 每页记录条数
     * @return 查询成功则返回array(数据,分页信息) 失败则返回false
     */
    public static function TransferRecord($date_start,$date_end,$extral = array()){
        $action = 'TransferRecord';
        $extral_keys = array(
            'transid',
            'transtype',
            'start_hhmmss',
            'page',
            'pagelimit',
            'end_hhmmss',
            'username'
        );
        $param = array(
            'website'       => self::_WEBSITE,
            'uppername'     => self::_UPPERNAME,
            'date_start'    => $date_start,
            'date_end'      => $date_end,
        );
        foreach ($extral_keys as $v){
            $extral[$v] ? $param[$v] = $extral[$v] : '';
        }
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . ($param['username'] ? $param['uppername'].self::_SUFFIX : '').$keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        $content = self::sendRequest($url);
        $result = json_decode($content);
        if($result !='' && $result->result){
            return array($result->data,$result->pagination);
        }else{
            return false;
        }
    }
    
    /**
     * 根据日期获取BB的投注记录
     * @param integer $gamekind 游戏类型
     * 可选值为:    1 BB体育
     *            3 BB视讯
     *            5  BB电子
     *            12 BB彩票
     *            15 3d电子
     *            30 BB捕鱼
     *            99 BB小费
     * @param date $rounddate 查询的日期
     * @param array $extral 其他查询参数
     * 可选值为
     * username 指定用户名,只需传入用户名即可,会自动加后缀
     * starttime 与$rounddate构成精确的查询开始时间
     * endtime 与$rounddate 构成精确的查询结束时间
     * subgamekind 查询的子类 請詳查附件五
     * gametype  游戏类型 請詳查附件二(gamekind=12 時，需強制帶入)
     * page 查询的页数
     * pagelimit 每页的数量
     * @return multitype:NULL |boolean
     * 查询成功则返回数据array(数据,分页数据); 失败则返回false
     */
    public static function BetRecord($gamekind,$rounddate,$extral){
        $action = 'BetRecord';
        $extral_keys = array(
            'username',
            'starttime',
            'endtime',
            'subgamekind',
            'gametype',
            'page',
            'pagelimit'
        );
        $param = array(
            'website'       => self::_WEBSITE,
            'uppername'     => self::_UPPERNAME,
            'rounddate'     => $rounddate,
            'gamekind'      => $gamekind,
        );
        foreach($extral_keys as $v){
            $extral[$v] ? $param[$v] = $extral[$v] : '';
        }
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . ($param['username'] ? $param['uppername'].self::_SUFFIX : '').$keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        $content = self::sendRequest($url);
        $result = json_decode($content);
        if($result !='' && $result->result){
            return array($result->data,$result->pagination);
        }else{
            return false;
        }
    }
    
    /**
     * 查询开奖记录
     * @param string $start_date 开始日期
     * @param string $end_date 结束日期
     * @param array $extral [option] 扩展查询参数
     * 可选值为
     * startime 开始时间 与$start_date 构成精确的查询时间
     * endtime  结束时间 与$end_date 构成精确的结束时间
     * @return multitype:NULL |boolean
     */
    public static function GetJPHistory($start_date,$end_date,$extral = array()){
        $action = 'GetJPHistory';
        $extral_keys = array(
            'starttime',
            'endtime',
            'jptype',
            'page',
            'pagelimit',
        );
        $param = array(
            'website'       => self::_WEBSITE,
            'start_date'    => $start_date,
            'end_date'      => $end_date,
        );
        foreach($extral_keys as $v){
            $param[$v] = $extral[$v];
        }
        
        $key1 = self::genRand(self::$_KEYS[$action]['KeyA']);
        $keyb = self::$_KEYS[$action]['KeyB'];
        $key2 = md5(self::_WEBSITE . ($param['username'] ? $param['uppername'].self::_SUFFIX : '').$keyb . date("Ymd"));
        $key3 = self::genRand(self::$_KEYS[$action]['KeyC']);
        $key = strtolower($key1 . $key2 . $key3);
        $param['key'] = $key;
        $query = http_build_query($param);
        $url = self::_URL.$action.'?'.$query;
        echo $url;exit;
        $content = self::sendRequest($url);
        $result = json_decode($content);
        if($result !='' && $result->result){
            return array($result->data,$result->pagination);
        }else{
            return false;
        }
    }
    
    
    public static function sendRequest($url){
        $content = file_get_contents($url);
\think\Log::debug($content);
        return $content;
    }
    
    
    /**
     * 生成指定长度的随机数
     * @param int $len
     * @return number
     */
    public static function genRand($len){
        return rand(intval('1'. strval(str_repeat('0', $len-1))), intval(str_repeat('9',   $len)));
    }
    
    public static function balance($username){
        
    }
    
    public static function recharge ($username, $amount = '0', $transSN = ''){
        
    }
}