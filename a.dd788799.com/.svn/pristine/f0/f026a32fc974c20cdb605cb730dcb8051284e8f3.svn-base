<?php

namespace app\middlewares;
use Closure;
use traits\controller\Jump;

class RedirectIfAuthenticated
{
    use Jump;

    public function handle($request, Closure $next, $guard = null)
    {
        if (container('auth')->guard($guard)->check()) {
            /*
            if(IS_AJAX){ 	
            	return json(['code' => 0,'msg'  => '请登出后再登录!']);
            }else{
            	return redirect(config('auth.redirect.guest.'.MODULE));	
            }   
            */
            $this->error('请登出后再登录!',config('auth.redirect.guest.'.MODULE));                    
        }

        return $next($request);
    }
}
