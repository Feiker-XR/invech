<?php

namespace bong\service\auth\Driver;

use \Firebase\JWT\JWT;
use bong\foundation\Str;

use bong\service\auth\Contracts\Guard;
use bong\service\auth\Contracts\UserProvider as UserProviderContract;
use bong\service\auth\traits\GuardHelpers;
use bong\service\auth\traits\UserProvider;
use bong\service\auth\traits\AttemptLogin;

class JwtRefreshTokenGuard implements Guard,UserProviderContract
{
    use GuardHelpers,UserProvider,AttemptLogin;

    public function __construct($model,$scope)
    {
        $this->setModel($model);
        $this->setScope($scope);    
        $this->inputKey = 'api_token';
    }

    private function genToken($sub,$time=null,$expire_time=null){
        $time = $time??time();
        $expire_time = $expire_time??config('auth.guards.jwt.expire_time')??3600;
        
        //$jwt是对象,$payload是数组
        $payload = [
            //三个控制属性
            "iat"   => $time,                   // 签发时间
            "exp"   => $time + $expire_time,    // 过期时间
            //"nbf"   =>    0,                  // 在某个时间戳之前不能使用

            //任意多个自定义属性
            "iss"   => COMPANY,                 // 签发者
            "sub"   => $sub,             // uid
        ];
        
        return $new_token = JWT::encode($payload, JWT_KEY); 
    }

    public function user()
    {

        if (! is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $jwt = request()->jwt();

        if ($jwt) {
                
            $user =  $this->retrieveById($jwt->sub);

            $time = time();
            $refresh_time = $jwt->exp - config('auth.guards.jwt.refresh_time')??60;
            if($user && ($time > $refresh_time)){

                $new_token = cache('jwt_new_token'.$token);
                if(!$new_token){
                   $new_token = $this->genToken($jwt->sub,$time);
                   cache('jwt_new_token'.$token,$new_token);
                }

                $this->user = $user;
                throw new \JwtRefreshTokenException($new_token);
            }
        }

        return $this->user = $user;
    }    

    public function login($user, $remember = false)
    {
        $this->setUser($user);        
        return $this->genToken($user->getAuthIdentifier());  
    }

}
