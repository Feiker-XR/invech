<?php

namespace app\common\model;

class Role extends Base
{
    protected $table='gygy_admin_role';

    private $admin_role_id = 1;

    public function perms()
    {
        return $this->belongsToMany('Perm','AdminPermRole','perm_id','role_id');
    }

    //普通管理员
    public function isAdmin(){
        return $this->id === $this->admin_role_id;
    }

    public function getPerms()
    {
        if($this->isAdmin()){
            return Perm::all();
        }else{
            return $this->perms;
        }
    }    

}
