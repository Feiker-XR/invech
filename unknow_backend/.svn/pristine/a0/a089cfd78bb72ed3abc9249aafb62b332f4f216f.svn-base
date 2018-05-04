<?php
$webdb['cookie']		=	'vgc7bjx0om15069906l3689437';
$webdb['datesite']		=	'http://123.255.231.129/';
$webdb['user']			=	'dashanghai98 ';
$webdb['pawd']			=	'qaz123qaz';
$webdb['uid']			=	'1';

session_start();

$webdb['cookie']		=	'x0h6wie3m15069906l3416458';
$webdb['datesite']		=	'http://66.133.81.209/';
//$webdb['user']			=	'xixiwang43';
//$webdb['pawd']			=	'azqq123123';
$webdb['uid']			=	'1';

class getCookie{
    private static $_instance;
    private $datesite;
    //private标记的构造方法
    private function __construct($datesite){
        $this->datesite = $datesite;
    }

    //创建__clone方法防止对象被复制克隆
    public function __clone(){
        trigger_error('Clone is not allow!',E_USER_ERROR);
    }

    //单例方法,用于访问实例的公共的静态方法
    public static function getInstance($datesite){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self($datesite);
        }
        return self::$_instance;
    }
    
    public function get(){
        if($_SESSION['thiefInfo'] == '' || time() - $_SESSION['thiefTime']  > 600 ){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->datesite.'app/member/new_login.php');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('username'=>'xixiwang43','passwd'=>'654321xixi','langx'=>'zh-cn'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_REFERER,'http://w088.hg0088.com/app/member/');
            curl_setopt($ch,CURLOPT_HTTPHEADER,array('User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36'));
            $output = curl_exec($ch);
            curl_close($ch);
            //echo $output;
            if(!empty($output)){
                $tmp = explode('|',$output);
                $_SESSION['thiefTime'] = time();
                $_SESSION['thiefInfo']  = $tmp[3];
            }
        }
        return $_SESSION['thiefInfo'];
        
    }
}
$getCookie = getCookie::getInstance($webdb['datesite']);
$webdb['cookie'] = $getCookie->get();

?>