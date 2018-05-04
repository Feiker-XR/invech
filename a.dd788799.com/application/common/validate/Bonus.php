<?php
namespace app\common\validate;
use think\Validate;
class Bonus extends Validate
{
    protected $rule = [
        'name'         => 'require',
       
        'event'        => 'require',
        'business'     => 'require',
     ];

    protected $message = [
        'name.require'  => '请输入名称',
       
        'event.require'  => '请输入事件',
        'business.require'  => '请输入 业务',
     ];

    protected $scene = [
       'index'  =>    ['name','event','business'],
       
    ];
}