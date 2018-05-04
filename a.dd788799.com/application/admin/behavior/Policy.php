<?php
namespace app\admin\behavior;

use app\common\model\Perm;

class Policy 
{

	public function run($request)
	{		
        if(IS_CLI)return;

        $policy = container('policy');

        $policy->before(function ($user, $ability) {
            if($user->isRoot()){
                return true;
            }

            if('opt-admin' != $ability && $user->isAdmin()){
                return true;
            }
        });   

        $perms = Perm::all();

        foreach ($perms as $perm) {
            if($perm->url){
                $policy->define($perm->url, function ($user) use ($perm) {
                    return $user->hasPerm($perm);
                });                
            }
        }

	}

}
