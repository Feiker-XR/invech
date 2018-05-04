<?php
namespace app\validate;
use think\Validate;
class level extends Validate{
    protected  $rule = [
        'name' => 'require',
    ];
}