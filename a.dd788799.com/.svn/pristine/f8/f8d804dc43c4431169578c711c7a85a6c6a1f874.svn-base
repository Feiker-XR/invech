<?php


return [

    'access_token' => 'sms_access_token',

    'interval' => 60,
    
    'fields' => [
        'mobile',
    ],
    
    //tp5验证器规则;
    'field_rules' => [
        'mobile' => 'require',
    ],
    'field_messages' => [        
        'mobile.require' => '手机号必须',
    ],    
    /*
    |--------------------------------------------------------------------------
    | 验证码管理
    |--------------------------------------------------------------------------
    |
    | - length        验证码长度
    | - validMinutes  验证码有效时间长度，单位为分钟
    | - repeatIfValid 如果原验证码还有效，是否重复使用原验证码
    | - maxAttempts   验证码最大尝试验证次数，超过该数值验证码自动失效，0或负数则不启用
    |
    */
    'code' => [
        'length'        => 5,
        'validMinutes'  => 5,
        'repeatIfValid' => false,
        'maxAttempts'   => 0,
    ],

    /*
    |--------------------------------------------------------------------------
    | 验证码短信通用内容
    |--------------------------------------------------------------------------
    |
    */
    'content' => function ($code, $minutes, $input) {
        return '【signature】您的验证码是' . $code . '，有效期为' . $minutes . '分钟，请尽快验证。';
    },

    /*
    |--------------------------------------------------------------------------
    | 验证码短信模版
    |--------------------------------------------------------------------------
    |
    | 每项数据的值可以为以下三种之一:
    |
    | - 字符串/数字
    |   如: 'YunTongXun' => '短信模版id'
    |
    | - 数组
    |   如: 'Alidayu' => ['短信模版id', '语音模版id'],
    |
    | - 匿名函数
    |   如: 'YunTongXun' => function ($input, $type) {
    |           return $input['isRegister'] ? 'registerTempId' : 'commonId';
    |       }
    */
    'templates' => [
    ],

    /*
    |--------------------------------------------------------------------------
    | 模版数据管理
    |--------------------------------------------------------------------------
    |
    | 每项数据的值可以为以下两种之一:
    |
    | - 基本数据类型
    |   如: 'minutes' => 5
    |
    | - 匿名函数（如果该函数不返回任何值，即表示不使用该项数据）
    |   如: 'serialNumber' => function ($code, $minutes, $input, $type) {
    |           return $input['serialNumber'];
    |       }
    |   如: 'hello' => function ($code, $minutes, $input, $type) {
    |           //不返回任何值，那么hello将会从模版数据中移除 :)
    |       }
    */
    'data' => [
        'code' => function ($code) {
            return $code;
        },
        'minutes' => function ($code, $minutes) {
            return $minutes;
        },
    ],

    'storage' => [
        //'driver' => 'bong\service\CacheStorage',
        'prefix' => 'think_sms',
    ],

    'dbLogs' => true,

    /*
    |--------------------------------------------------------------------------
    | 验证码模块提示信息
    |--------------------------------------------------------------------------
    |
    */
    'notifies' => [
        // 频繁请求无效的提示
        'request_invalid' => '请求无效，请在%s秒后重试',

        // 验证码短信发送失败的提示
        'sms_sent_failure' => '短信验证码发送失败，请稍后重试',

        // 语音验证码发送发送成功的提示
        'voice_sent_failure' => '语音验证码请求失败，请稍后重试',

        // 验证码短信发送成功的提示
        'sms_sent_success' => '短信验证码发送成功，请注意查收',

        // 语音验证码发送发送成功的提示
        'voice_sent_success' => '语音验证码发送成功，请注意接听',
    ],
];
