<?php
namespace app\agent\controller;
use app\agent\Login;

use app\common\model\Member as MemberModel;

class Test extends Login{

    function policy(){
        $member = MemberModel::get(313);
        $ret = $this->user->can('opt-member',$member);
        $a = 1;
    }

}