<?php
namespace app\common\validate;
use think\Validate;
class Admin extends Validate
{
    protected $rule = [
        'name'        =>  'require',
        'username'    =>  'require|unique:admin',
        'password'    =>  'require|min:6',
        'pid'         =>  'require',
        'email'       =>  'require|email',
        'url'         =>  'require',
        'role_id'     =>  'require',
    ];

    protected $message = [
        'username.require'    =>  '请输入名称',
        'username.unique'     =>  '用户已存在',
        'email.require'       =>  '请输入邮箱',
        'email.email'         =>  '邮箱格式不正确',
        'password.require'    =>  '请输入密码',
        'password.min'        =>  '密码长度需大于6',
        'role_id.require'     =>  '请配置角色',
        'name.require'        =>  '请输入名称',
        'name.unique'         =>  '名称已存在',
        'pid.require'         =>  '请选择父级ID',
        'url.require'         =>  '请输入权限路由',
     ];

    protected $scene = [
       'admin_add'  => ['username','password','email','role_id'],
       'admin_edit' => ['username'=>'require|unique:admin,username=username','email','role_id'],
       'group_add'  => ['name'=>'require|unique:admin_role'],
       'group_edit' => ['name'=>'require|unique:admin_role,name=name'],
       'pem_fid'    => ['name'=>'require|unique:admin_perm,name=name','pid'],
       'pem_cid'    => ['name'=>'require|unique:admin_perm,name=name','pid','url'],
    ];
}