<?php
namespace bong\service;

use bong\foundation\Str;

class KeyToken{

    public static function token($expire=300){
        $str = Str::random();
        $token = bcrypt($str);
        cache($token,$str,$expire);
        return $token;
    }

    public static function check($token){
        $str = cache($token)??null;
        return !is_null($str);
    }
    
}