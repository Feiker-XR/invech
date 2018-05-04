<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

/*
//路由暂不支持中间件,所有请求 都不会受到 访问频率 这样的限制;

Route::post(['broadcasting/auth'=>'\\bong\\service\\broadcast\\BroadcastController@auth',]);
//Route::get(['broadcasting/auth'=>'\\bong\\service\\broadcast\\BroadcastController@auth',]);

Route::get(['sms/send'=>'\\bong\\service\\SmsController@postSendCode',]);

//sms_access_token ip+uid+timestamp 注册时uid为空
\think\Validate::extend('sms', function ($code) {
    return container('sms')->sms_check($code);
});
\think\Validate::setTypeMsg('sms', '短信验证码错误!');


\think\Route::get('captcha/[:id]', "\\think\\captcha\\CaptchaController@index");
\think\Validate::extend('captcha', function ($value, $id = "") {
    return captcha_check($value, $id, (array)\think\Config::get('captcha'));
});
\think\Validate::setTypeMsg('captcha', '验证码错误!');


function captcha_src($id = "")
{
    return \think\Url::build('/captcha' . ($id ? "/{$id}" : ''));
}
function captcha_check($value, $id = "", $config = [])
{	
    $captcha = new \think\captcha\Captcha($config);
    return $captcha->check($value, $id);
}
*/

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    
];
