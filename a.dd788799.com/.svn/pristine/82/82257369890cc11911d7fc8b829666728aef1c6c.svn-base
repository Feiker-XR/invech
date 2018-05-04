<?php

namespace app\index\controller;

use app\index\Base;

class Sms extends Base
{   
    
    public function token(){
        if(IS_GET&&IS_AJAX){
            $token = container('sms')->token();
            $this->success('','',$token);
        }
    }

}
