<?php
namespace app\common\validate;
use think\Validate;
class Message extends Validate
{
    protected $rule = [
        'recv_type'     => 'require',
        'title'         => 'require',
        'text'          => 'require',
    ];

    protected $message = [
        'recv_type.require'  => '请选择收件群组',
        'title.require'      => '请输入标题',
        'text.require'       => '请输入内容',
       
    ];

    protected $scene = [
       'index'  =>    ['recv_type','title','text'],
    ];
}