<?php

namespace app\admin\policy;

use app\common\model\Admin;

class AdminPolicy
{
    //操作用户
    public function optAdmin(Admin $current, Admin $other){
        return $current->isManagerOf($other);
    }
}
