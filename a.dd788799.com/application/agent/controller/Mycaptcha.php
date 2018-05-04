<?php
namespace app\agent\controller;
use app\agent\Base;
use think\captcha\Captcha;

class Mycaptcha extends Base
{
    public function admin_login($id = 'admin_login')
    {
        $config = [
            'codeSet'  => '1234567890',
            'fontSize'=>16,
            //vendor\topthink\think-captcha\assets\ttfs下1.ttf--6.ttf(默认)
            //没办法调整字体间距
            'fontttf'=>'6.ttf',
            'length'=> 4,
            'useNoise'=>0,
            'useCurve'=>0,
        ];

        $captcha = new Captcha($config);        
        return $captcha->entry($id);
        //captcha_check($value, $id = "mobile_reg")
    }      
}