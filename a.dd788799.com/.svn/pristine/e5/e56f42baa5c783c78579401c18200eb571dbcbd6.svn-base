<?php

namespace app\common\traits\model;

use bong\foundation\Str;

trait ApiToken
{
    public function freshToken(){
        $random = Str::random(8);
        $str = $random . time();
        $api_token = md5($str);
        $this->api_token = $api_token;
        //$this->update();//tp的模型update必须传参数;
        $this->save();
        return $api_token;
    } 
}
