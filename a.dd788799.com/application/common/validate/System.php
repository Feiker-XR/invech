<?php
namespace app\common\validate;
use think\Validate;
class System extends Validate
{
    protected $rule = [
        'name'      => 'require',
        'title'     => 'require',
        'value'     => 'require',
        'content'   => 'require',
        'cat_id'    => 'require',
     ];

    protected $message = [
        'name.require'  => '请输入名称',
        'title.require'  => '请输入标题',
        'value.require' =>  '请输入值',
        'content.require' => '请输入内容',
        'cat_id.require' => '请选择类型',
     ];

    protected $scene = [
       'config'  =>    ['name','title','value'],
       'notice'  =>    ['title','content'],
        'help'  =>    ['title','content','cat_id'],
     ];
}