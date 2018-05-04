<?php
namespace app\live;
// 约定好 md5 key
// 约定好 密码加密key
class auth
{
    static protected $suffix = 'test';
    private $pkeys;
    private $md5key;
    /*
    private $pkeys = array(
        'jsa' => '1y$JanW2LlyrE^8VVJU4kkaW-X@O.a[f',
    );
    
    private $md5key = array(
        'jsa' => 'DYj@@t~Y4SGq~c4t~jsUf11#r7oCOXEf',
    );
    */
    
    /**
     *时间差为180s
     */
    private $limit = 180;
    
    public function __construct()
    {
        $this->pkeys  = [self::$suffix => '1y$JanW2LlyrE^8VVJU4kkaW-X@O.a[f',];
        $this->md5key = [self::$suffix => 'DYj@@t~Y4SGq~c4t~jsUf11#r7oCOXEf',];
    }
    
    public function check($data){
        $from = $data['param3'];
        if(!$this->pkeys[$from] || !$this->md5key[$from]){
            return false;
        }
        $time = $data['param4'];
        $diff = abs(strtotime($time) - time());
        if($diff > $this->limit){
            return false;
        }else{
            $username = $data['param1'];
            $password = $data['param2'];
            $gameid = $data['param5'];
            $sign = $data['param6'];
            $signStr = "param1={$data['param1']}&param2={$data['param2']}&param3={$data['param3']}&param4={$data['param4']}&param5={$data['param5']}{$this->md5key[$from]}";
            if($sign == md5($signStr)){
                return array(true,'data' => array('username'=>$username,'password'=>$this->decrypt($password, $this->pkeys[$from])));
            }
        }
    }
    
    protected function encrypt($data, $key){
        $key = md5($key);
        $x = 0;
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        $str = '';
        for ($i = 0; $i < $len; $i ++) {
            if ($x == $l) {
                $x = 0;
            }
            $char .= $key{$x};
            $x ++;
        }
        for ($i = 0; $i < $len; $i ++) {
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        return base64_encode($str);
    }
    
    protected function decrypt($data, $key){
        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        $str = '';
        for ($i = 0; $i < $len; $i ++) {
            if ($x == $l) {
                $x = 0;
            }
            $char .= substr($key, $x, 1);
            $x ++;
        }
        for ($i = 0; $i < $len; $i ++) {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            } else {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return $str;
    }
    
    public function test($data){
        $signStr = '';
        $data['param2'] = $this->encrypt($data['param2'], $this->pkeys[$data['param3']]);
        ksort($data);
        foreach($data as $k=>$v){
            $signStr .= "$k=$v&";
        }
        $signStr = trim($signStr,'&');
        $signStr .= $this->md5key[$data['param3']];
        //echo $signStr;
        $data['param6'] = md5($signStr);
        return $data;
    }
}
