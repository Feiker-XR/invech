<?php
namespace app\live;

use app\live\base;

class agGame extends base
{

    const _MD5key = 'pYuaWamJgnGo';

    const _DESkey = "lszwuE0w";
 // DES加密钥匙
    const _cagent = "S13_AGIN";

    const _GI = 'http://gi.jinpaizhan.com:81';

    const _GCI = 'http://gci.jinpaizhan.com:81';

    
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
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $userName . "/\\\\/method=lg/\\\\/actype=" . $isDemo . "/\\\\/password=" . $password . "/\\\\/oddtype=" . $betLimitCode . "/\\\\/cur=" . $currencyCode;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $url = self::_GI;
        $md5key = md5($params . self::_MD5key);
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        $text = file_get_contents($fullUrl);
        preg_match("'info=\"(.?)\"'", $text, $matches);
        if ($matches[1] !== '0') {
            return array(
                'Code' => '1',
                'Message' => 'error'
            );
        } else {
            return array(
                'Code' => '0',
                'Message' => ''
            );
        }
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
        if ($gameType == '6') {
            $actype = '0';
        }
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $userName . "/\\\\/password=" . $password . "/\\\\/dm=" . $dm . "/\\\\/sid=" . time() . rand(0, 1000) . "/\\\\/actype=" . $actype . "/\\\\/lang=" . $lang . "/\\\\/gameType=" . $gameType . "/\\\\/oddtype=" . $betLimitCode . "/\\\\/cur=" . $currencyCode;
        $url = self::_GCI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        
        return $fullUrl = $url . "/forwardGame.do?params=" . $params . "&key=" . $md5key;
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
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $userName . "/\\\\/method=gb/\\\\/actype=" . $isDemo . "/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
        $url = self::_GI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        
        $text = file_get_contents($fullUrl);
        
        // <?xml version="1.0" encoding="utf-8" <result info="0" msg=""/>';
        preg_match('/info="(.*?)"/', $text, $matches);
        return $matches[1];
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
        $currencyCode = 'CNY';
        $password = 'jpa12344321';
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $username . "/\\\\/method=tc/\\\\/billno=" . $transSN . "/\\\\/type=IN/\\\\/credit=" . $amount . "/\\\\/actype=1/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
        $url = self::_GI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        file_put_contents(dirname(__FILE__) . '/url.log', $fullUrl . "\r\n", FILE_APPEND);
        $text = file_get_contents($fullUrl);
        
        file_put_contents(dirname(__FILE__) . '/recharge.log', $text . "\r\n", FILE_APPEND);
        // <?xml version="1.0" encoding="utf-8" <result info="0" msg=""/>';
        preg_match("'info=\"(.?)\"'", $text, $matches);
        if ($matches[1] !== '0') {
            return - 1;
        } else {
            // 确认转账
            $input2 = "cagent=" . self::_cagent . "/\\\\/loginname=" . $username . "/\\\\/method=tcc/\\\\/billno=" . $transSN . "/\\\\/type=IN/\\\\/credit=" . $amount . "/\\\\/actype=1/\\\\/flag=1/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
            $crypt2 = new DES1Code(self::_DESkey);
            $params2 = $crypt2->encrypt($input2);
            $md5key2 = md5($params2 . self::_MD5key);
            $fullUrl2 = $url . "/doBusiness.do?params=" . $params2 . "&key=" . $md5key2;
            $result = file_get_contents($fullUrl2);
            preg_match("'info=\"(.?)\"'", $result, $tmp);
            if ($tmp[1] !== '0') {
                return - 1;
            } else {
                return 1;
            }
        }
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
        $currencyCode = 'CNY';
        $password = 'jpa12344321';
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $username . "/\\\\/method=tc/\\\\/billno=" . $transSN . "/\\\\/type=IN/\\\\/credit=" . $amount . "/\\\\/actype=1/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
        $url = self::_GI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        $text = file_get_contents($fullUrl);
        
        // <?xml version="1.0" encoding="utf-8" <result info="0" msg=""/>';
        preg_match("'info=\"(.?)\"'", $text, $matches);
        if ($matches[1] !== '0') {
            return - 1;
        } else {
            // 确认转账
            $input2 = "cagent=" . self::_cagent . "/\\\\/loginname=" . $username . "/\\\\/method=tcc/\\\\/billno=" . $transSN . "/\\\\/type=IN/\\\\/credit=" . $amount . "/\\\\/actype=1/\\\\/flag=1/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
            $crypt2 = new DES1Code(self::_DESkey);
            $params2 = $crypt2->encrypt($input2);
            $md5key2 = md5($params2 . self::_MD5key);
            $fullUrl2 = $url . "/doBusiness.do?params=" . $params2 . "&key=" . $md5key2;
            $result = file_get_contents($fullUrl2);
            preg_match("'info=\"(.?)\"'", $result, $tmp);
            if ($tmp[1] !== '0') {
                return - 1;
            } else {
                return 1;
            }
        }
    }


    /**
     * 注册用户
     * @param string $userName
     * @param string $password
     * @param string $betLimitCode
     * @param string $currencyCode
     * @param string $isSpeed
     * @param string $isDemo
     * @return string[]
     */
    public static function regUser($userName, $password = 'jpa12344321', $betLimitCode = 'A', $currencyCode = 'CNY', $isSpeed = '', $isDemo = '1')
    {
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $userName . "/\\\\/method=lg/\\\\/actype=" . $isDemo . "/\\\\/password=" . $password . "/\\\\/oddtype=" . $betLimitCode . "/\\\\/cur=" . $currencyCode;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $url = self::_GI;
        $md5key = md5($params . self::_MD5key);
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        $text = file_get_contents($fullUrl);
        file_put_contents(dirname(__FILE__) . '/reglog.log', $fullUrl . "\r\n", FILE_APPEND);
        file_put_contents(dirname(__FILE__) . '/reglog.log', $text . "\r\n", FILE_APPEND);
        preg_match("'info=\"(.?)\"'", $text, $matches);
        if ($matches[1] !== '0') {
            return array(
                'Code' => '1',
                'Message' => 'error'
            );
        } else {
            return array(
                'Code' => '0',
                'Message' => ''
            );
        }
    }

    /**
     * 注册临时用户
     * @param string $userName
     * @param string $password
     * @param string $betLimitCode
     * @param string $currencyCode
     * @param string $isSpeed
     * @param string $isDemo
     * @return string[]
     */
    public static function regTempUser($userName, $password = 'jpa12344321', $betLimitCode = 'A', $currencyCode = 'CNY', $isSpeed = '', $isDemo = '1')
    {
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $userName . "/\\\\/method=lg/\\\\/actype=0/\\\\/password=" . $password . "/\\\\/oddtype=" . $betLimitCode . "/\\\\/cur=" . $currencyCode;
        $url = self::_GI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        $text = file_get_contents($fullUrl);
        preg_match("'info=\"(.?)\"'", $text, $matches);
        if ($matches[1] !== '0') {
            return array(
                'Code' => '1',
                'Message' => 'error'
            );
        } else {
            return array(
                'Code' => '0',
                'Message' => ''
            );
        }
    }

    /**
     * 新的AG接口 打开游戏 ，即生成URL 之后在表单直接提交
     * 沒有返回結果, 使用form post method执行URL, 并進入游戏頁面
     * 
     * @param type $userName            
     * @param type $password            
     * @param type $gameType            
     * @param type $lang            
     * @param type $gameType            
     * @param type $betLimitCode            
     * @param type $currencyCode            
     */
    static public function playAG($userName,$gameType = '1', $actype = '1', $password = 'jpa12344321', $lang = '1', $betLimitCode = 'A', $currencyCode = 'CNY', $dm = "www.jinpaizhan.com")
    {
        if ($gameType == '6') {
            $actype = '0';
        }
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $userName . "/\\\\/password=" . $password . "/\\\\/dm=" . $dm . "/\\\\/sid=" . time() . rand(0, 1000) . "/\\\\/actype=" . $actype . "/\\\\/lang=" . $lang . "/\\\\/gameType=" . $gameType . "/\\\\/oddtype=" . $betLimitCode . "/\\\\/cur=" . $currencyCode;
        $url = self::_GCI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        
        return $fullUrl = $url . "/forwardGame.do?params=" . $params . "&key=" . $md5key;
    }

    /**
     * 新的转账 接口
     * 新接口要先预备转账
     *
     * @param type $userName            
     * @param type $password            
     * @param type $transSN            
     * @param type $amount            
     * @param type $currencyCode            
     * @param type $isSpeed            
     * @param type $isDemo            
     * @return type
     */
    static public function depositToAG ($username, $amount = '1', $transSN = '')
    {
        $currencyCode = 'CNY';
        $password = 'jpa12344321';
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $username . "/\\\\/method=tc/\\\\/billno=" . $transSN . "/\\\\/type=IN/\\\\/credit=" . $amount . "/\\\\/actype=1/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
        $url = self::_GI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        file_put_contents(dirname(__FILE__) . '/url.log', $fullUrl . "\r\n", FILE_APPEND);
        $text = file_get_contents($fullUrl);
        
        file_put_contents(dirname(__FILE__) . '/recharge.log', $text . "\r\n", FILE_APPEND);
        // <?xml version="1.0" encoding="utf-8" <result info="0" msg=""/>';
        preg_match("'info=\"(.?)\"'", $text, $matches);
        if ($matches[1] !== '0') {
            return - 1;
        } else {
            // 确认转账
            $input2 = "cagent=" . self::_cagent . "/\\\\/loginname=" . $username . "/\\\\/method=tcc/\\\\/billno=" . $transSN . "/\\\\/type=IN/\\\\/credit=" . $amount . "/\\\\/actype=1/\\\\/flag=1/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
            //$crypt2 = new DES1Code(self::_DESkey);
            //$params2 = $crypt2->encrypt($input2);
            $params2 = openssl_encrypt($input2, 'DES-ECB', self::_DESkey);
            $md5key2 = md5($params2 . self::_MD5key);            
            
            $fullUrl2 = $url . "/doBusiness.do?params=" . $params2 . "&key=" . $md5key2;
            $result = file_get_contents($fullUrl2);
            file_put_contents(dirname(__FILE__) . '/recharge2.log', $result . "\r\n", FILE_APPEND);
            preg_match("'info=\"(.?)\"'", $result, $tmp);
            if ($tmp[1] !== '0') {
                return - 1;
            } else {
                return 1;
            }
        }
    }

    /**
     * 从AG 转出到网站 新接口
     * 
     * @param type $userName            
     * @param type $password            
     * @param type $transSN            
     * @param type $amount            
     * @param type $currencyCode            
     * @return type
     */
    static public function AGToWithdrawal($username, $amount = '1', $transSN = '')
    {
        $currencyCode = 'CNY';
        // $transSN = 'AO' . date("YmdHis");
        $currencyCode = 'CNY';
        $password = 'jpa12344321';
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $username . "/\\\\/method=tc/\\\\/billno=" . $transSN . "/\\\\/type=OUT/\\\\/credit=" . $amount . "/\\\\/actype=1/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
        $url = self::_GI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        $text = file_get_contents($fullUrl);
        file_put_contents(dirname(__FILE__) . '/return.log', $text . "\r\n", FILE_APPEND);
        
        preg_match("'info=\"(.?)\"'", $text, $matches);
        if ($matches[1] !== '0') {
            return - 1;
        } else {
            // 确认转账
            $input2 = "cagent=" . self::_cagent . "/\\\\/loginname=" . $username . "/\\\\/method=tcc/\\\\/billno=" . $transSN . "/\\\\/type=OUT/\\\\/credit=" . $amount . "/\\\\/actype=1/\\\\/flag=1/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
            //$crypt2 = new DES1Code(self::_DESkey);            
            //$params2 = $crypt2->encrypt($input2);
            $params2 = openssl_encrypt($input2, 'DES-ECB', self::_DESkey);
            $md5key2 = md5($params2 . self::_MD5key);
            
            $fullUrl2 = $url . "/doBusiness.do?params=" . $params2 . "&key=" . $md5key2;
            $result = file_get_contents($fullUrl2);
            file_put_contents(dirname(__FILE__) . '/return.log', $result . "\r\n", FILE_APPEND);
            preg_match("'info=\"(.?)\"'", $result, $tmp);
            if ($matches[1] !== '0') {
                return - 1;
            } else {
                
                return 1;
            }
        }
    }

    // 从AG查询余额
    /**
     * 新 API 从AG查询余额
     * 
     * @param type $userName            
     * @param type $password            
     * @param type $currencyCode            
     * @param type $isSpeed            
     * @param type $isDemo            
     */
    static public function inquireBalance($userName, $password = 'jpa12344321', $currencyCode = 'CNY', $isSpeed = '', $isDemo = '1')
    {
        $input = "cagent=" . self::_cagent . "/\\\\/loginname=" . $userName . "/\\\\/method=gb/\\\\/actype=" . $isDemo . "/\\\\/password=" . $password . "/\\\\/cur=" . $currencyCode;
        $url = self::_GI;
        $params = openssl_encrypt($input, 'DES-ECB', self::_DESkey);
        $md5key = md5($params . self::_MD5key);
        $fullUrl = $url . "/doBusiness.do?params=" . $params . "&key=" . $md5key;
        
        $text = file_get_contents($fullUrl);
        file_put_contents(dirname(__FILE__) . '/inquire.log', $fullUrl . "\r\n", FILE_APPEND);
        file_put_contents(dirname(__FILE__) . '/inquire.log', $text . "\r\n", FILE_APPEND);
        // <?xml version="1.0" encoding="utf-8" <result info="0" msg=""/>';
        preg_match('/info="(.*?)"/', $text, $matches);
        return $matches[1];
    }
}

