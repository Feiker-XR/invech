<?php
namespace app\admin\middlewares;

use traits\controller\Jump;
use \think\View;
use Closure;

class AuthMenu
{
	use Jump;
	private $menu;
	private $request_path;
	private $menu_group;
	private $menu_list;
	
	public function handle($request,Closure $next)
	{
        $user = $request->user();
        // if($user->isRoot()){
        //     return $next($request);
        // }

        $route_url = CONTROLLER.'/'.ACTION;

        if (!container('policy')->check($route_url)) {
            $this->error('您没有权限执行此操作');
        }

        $menus = $user->getMenu();
        
        View::share('menus',$menus);

        return $next($request);
	}
}
