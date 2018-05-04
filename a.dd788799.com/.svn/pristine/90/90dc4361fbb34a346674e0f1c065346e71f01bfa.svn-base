<?php
namespace app\api\middlewares;
use Closure;

class Version 
{
    public function handle($request, Closure $next)
    {
    	//redis永久缓存,key不存在返回false
    	$game_types = cache('gygy_types_version');
    	$game_kqwfpls = cache('gygy_pls_version');
    	
		$response = $next($request);
		$response->header('game-types', (int)$game_types);
		$response->header('game-kqwfpls', (int)$game_kqwfpls);
		return $response;
	}
}
