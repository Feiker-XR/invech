<?php

return [

    //"smtp", "sendmail",
    //mailgun驱动暂未实现
    'driver' => 'smtp',
    //'driver' => \think\Env::get('mail.driver', 'smtp'),

    //'smtp.mailgun.org'
    'host' => 'smtp.mailtrap.io',
    'port' => 2525,
    //'host' => \think\Env::get('mail.host', 'smtp.mailtrap.io'),
    //'port' => \think\Env::get('mail.port', '2525'),

    //'username' => env('mail.username',''),
    //'password' => env('mail.password',''),
    //加载配置的时候未载入common.php和helper.php,不能使用env函数;
    'username' => \think\Env::get('mail.username', ''),
    'password' => \think\Env::get('mail.password', ''),

    'from' => [
        'address' => 'hello@example.com',
        'name' => 'Example',
    ],

    //邮件加密协议
    'encryption' => 'tls',


    'sendmail' => '/usr/sbin/sendmail -bs',

];
