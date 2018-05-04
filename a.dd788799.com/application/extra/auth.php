<?php

return [    
    'default' => [  'admin'=>'admin',
                    'agent'=>'agent',
                    'index'=>'index',
                    'api'=>'jwt',
                ],

    'redirect' => [
        'auth_ok' => [  'admin'=>'index/index',
                        'agent'=>'index/index',
                        'index'=>'user/index',
                ],
        'auth_fail' => ['admin'=>'index/login',
                        'agent'=>'index/login',
                        'index'=>'index/login',
                ],                
        'guest' => [    'admin'=>'admin/index',
                        'agent'=>'index/index',
                        'index'=>'user/index',
                ],
    ],

    'guards' => [
        'index' => [
            'driver' => 'session',
            'model' => \app\common\model\Member::class,
        ],

        'admin' => [
            'driver' => 'session',
            'model' => \app\common\model\Admin::class,
        ],

        'agent' => [
            'driver' => 'session',
            'model' => \app\common\model\Member::class,
            'scope' => 'AgentScope',
        ],

        'api' => [
            'driver' => 'token',//要求Member模型有api_token字段,
            'model' => \app\common\model\Member::class,
            'cache_time' => 3600,//定义过期时间,连续1小时未访问token失效
        ],

        'jwt' => [
            'driver' => 'jwt_refresh_token',
            'model' => \app\common\model\Member::class,
            'expire_time' => 3600,
            'refresh_time' => 60,
            'jwt_key' => 'XXXX',//没有长度要求
        ],        
    ],

];
