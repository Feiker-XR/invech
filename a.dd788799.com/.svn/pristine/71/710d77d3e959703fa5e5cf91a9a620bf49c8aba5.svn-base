<?php
namespace app\common\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'username'         => 'require|unique:members|min:3',
        'password'         => 'require|confirm:password_confirm|min:6',
        'mobile'           => 'number|length:11',
        'email'            => 'email',
        'bank_name'        => 'require',
        'bank_username'    => 'require',
        'bank_account'     => 'require',
        'bank_address'     => 'require',
        'level'            => 'require',
        'levelName'        => 'require',
        'minScore'         => 'require',
        'bank'             => 'require',
        'amount'           => 'require',
        'newPassword'      => 'require|different:oldPassword|confirm:confirmPassword|min:6',
        'coinPassword'     => 'require|confirm:confirmcoinPassword|min:6',
        
    ];

    protected $message = [
        'username.require'         => '请输入用户名',
        'username.unique'          => '用户名已存在',
        'username.min'             => '用户名长度需大于3',
        'password.require'         => '密码不能为空',
        'password.min'             => '密码长度需大于等于6位',
        'password.confirm'         => '两次输入密码不一致',
        'newPassword.require'      => '新密码不能为空',
        'newPassword.min'          => '新密码长度需大于等于6位',
        'newPassword.confirm'      => '两次输入的新密码不一致',
        'newPassword.different'    => '新密码不能与旧密码相同',

        'coinPassword.require'     => '支付密码不能为空',
        'coinPassword.min'         => '支付密码长度需大于等于6位',
        'coinPassword.confirm'     => '两次输入的支付密码不一致',
        
        'mobile.number'            => '手机号格式错误',
        'mobile.length'            => '手机号长度错误',
        'email.email'              => '邮箱格式错误',
        'bank_name.require'        => '请输入银行名称',
        'bank_username.require'    => '请输入开户人名称',
        'bank_account.require'     => '请输入开户行账户',
        'bank_address.require'     => '请输入开户行地址',
        'level.require'            => '请输入等级',
        'levelName.require'        => '请输入等级名称',
        'minScore.require'         => '请输入最低分数',
        'bank.require'             => '请先配置银行卡信息',
        'amount.require'            => '请输入金额',

    ];

    protected $scene = [
        'edit'      =>  ['username'=>'require|unique:members,username=username',],
        'register'  =>  ['username','password',],
        'bank'      =>  ['bank_name','bank_username','bank_account','bank_address',],
        'level'     =>  ['level','levelName','minScore'],
        'withdraw'  =>  ['bank','amount'],
        'save_password'     =>  ['newPassword'],
        'coinPassword'      =>  ['coinPassword'],
        'webedit'  =>  ['mobile','email'],
    ];

}