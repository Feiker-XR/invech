<?php
namespace app\common\validate;

use think\Validate;

class Manual extends Validate
{
    protected $rule = [
        'username'         => 'require',
        'amount'           => 'require|float',
        'bonus_id'         =>  'require|integer',
        //'bonus_id'         =>  function($value, $data){},
    ];

    protected $message = [
        'username.require'  => '请输入用户名',
        'amount.require'    => '请输入金额',
        'bonus_id.require'  => '请选择业务场景',
    ];

    protected $scene = [
        'money'      =>  ['username','amount','bonus_id',],
        //'money'      =>  function($key, $data){}
        //'money'    => ['username'=>'require',]
    ];

}