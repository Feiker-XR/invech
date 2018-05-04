<?php

namespace app\listeners;

use app\common\model\Member;

use bong\service\queue\Contracts\ShouldQueue;

class UserListener //implements ShouldQueue
{

    //public $queue = '';

	//记录登录ip
    public function onLogin(Member $user, ...$extra){
    	$user->loginIP = request()->ip();
    	$user->loginTime = date('Y-m-d H:i:s');
    	return $user->save();
    }

}


