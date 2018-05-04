<?php
namespace app\common\validate;
use think\Validate;
class Slide extends Validate
{
    protected $rule = [
        'name'         => 'require',
        'pic'         => 'require',
       
        
     ];

    protected $message = [
        'name.require'  => '请输入名称',
        'pic.require'  => '请选择图片',
       
     ];

    protected $scene = [
       'index'  =>    ['name','pic'],
       
    ];
}