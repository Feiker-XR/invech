<?php
namespace app\common\validate;
use think\Validate;
class Company extends Validate
{
    protected $rule = [
        'type'             => 'require',  
        'bank_name'        => 'require',
        'bank_username'    => 'require',
        'bank_account'     => 'require',
        'bank_address'     => 'require',
        'qrcode'              => 'require',
        
    ];

    protected $message = [
        'type.require'             => '请选择类型',
        'bank_name.require'        => '请输入银行名称',
        'bank_username.require'    => '请输入开户人名称',
        'bank_account.require'     => '请输入开户行账户',
        'bank_address.require'     => '请输入开户行地址',
        'qrcode.require'              => '请选择图片',
    ];

    protected $scene = [
        'bank'          =>  ['type','bank_name','bank_username','bank_account','bank_address',],
        'mobliePay'     =>  ['type','qrcode'],
    ];

}