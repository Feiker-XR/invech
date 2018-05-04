<?php
namespace app\index\validate;
use think\Validate;
class user extends Validate{
    protected $rule = [
        'username' => 'require|length:5,16|alphaNum',
        'password' => 'require|length:6,32',
        'repassword' => 'require|length:6,32|confirm:password',
        'zcturename' => 'require',/*|length:2,16|chsAlphaNum',*/
        'qkpwd1'    => 'require|length:4,12',
        'qkpwd2'    => 'require|confirm:qkpwd1',
        'zcanswer'  => 'require',
        'qq'        => 'require',
    ];
    protected $message = [
        'username.require'  =>  '用户名必须填写!',
        'username.length'   =>  '用户名长度必须在5~16之间!',
        'username.alphaNum' =>  '用户名必须是数字和字母的组合!',
        'password.require'  =>  '密码必须填写!',
        'password.length'   =>  '密码长度必须在6~32位之间!',
        'repassword.confirm' => '两次密码不一致!',
        'zcturename.require'=>  '真实姓名必须填写!',
        'qq.require' =>'QQ或者微信必须填写!',
        /*'zcturename.length'=>  '真实姓名长度为2~8位!',
        'zcturename.chsAlphaNum'=>  '真实姓名必须是汉字!',*/
        'qkpwd1.require'    =>  '取款密码必须填写!',
        'qkpwd1.length'     =>  '取款密码长度为4-12!',
        'qkpwd2.require'    =>  '确认取款密码必须填写!',
        'qkpwd2.confirm'    =>  '两次取款密码不一致!',
        'zcanswer.require'  =>  '答案必须填写!',
        //'zcanswer.length'   =>  '答案长度必须为2~32!',
        //'zcanswer.chsAlphaNum'  =>  '答案必须是中文和字母或者数字的组合!',        
    ];
    
    protected $scene  = [
        'check'     =>  ['username'],
        'reg'       =>  ['username','password','repassword',/*'zcturename',*/'qkpwd1','qkpwd2','zcanswer','qq'],
        'login'     =>  ['username','password'],
        'truename'  =>  ['zcturename']
    ];
}