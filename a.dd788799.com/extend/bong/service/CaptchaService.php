<?php
namespace bong\service;

use bong\service\captcha\Captcha;

class CaptchaService
{
    public function captcha($config = 'default',$id='')
    {
        $config = config('captcha.'.$config)??[];
        $captcha = new Captcha($config);
        if('api' == module()){
            return $captcha->entry_api();
        }else{
            return $captcha->entry($id);
        }
    }

   public  function check_verify($code, $id = ''){
        $captcha = new Captcha();
        if('api' == module()){
            return $captcha->check_api($code, $id);
        }else{
            return $captcha->check($code, $id);
        }
        
    }
}