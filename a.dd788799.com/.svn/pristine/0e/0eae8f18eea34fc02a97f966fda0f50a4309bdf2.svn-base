<?php
namespace app\common\model;
use think\Model;

class PasswrodReset extends Base{

    protected $table = 'gygy_password_resets';
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $autoWriteTimestamp = 'datetime';
   

    public static function genToken($email){
        self::where('email',$email)->delete();
        $token = md5($email.time());
        self::create(['token'=>$token,'email'=>$email,]);
        return $token;
    }

    public static function validateReset(array $params){
        if(!(isset($params['email']) && isset($params['token']))){
            return false;
        }
        return self::where('email',$params['email'])->where('token',$params['token'])->find();
    }



}
