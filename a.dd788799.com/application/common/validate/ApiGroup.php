<?php

namespace app\common\validate;

use think\Validate;

class ApiGroup extends Validate
{
    
    // 验证规则
    protected $rule =   [
        'name'          => 'require|unique:api_group',
    ];

    // 验证提示
    protected $message  =   [
        'name.require'         => '分组名称不能为空',
        'name.unique'          => '分组名称已经存在',
    ];
    
    // 应用场景
    protected $scene = [
        'edit'  =>  ['name'],
    ];
}
