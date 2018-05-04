<?php
namespace app\api\middlewares;
use Closure;

class CheckAccessToken 
{

    public function handle($request, Closure $next)
    {		
		$b = config('need_access_token')??false;
		if($b){
			$access_token = input('access_token');
			if(!$access_token){
				$access_token = $request->header('access_token');
			}
			if(!check_access_token($access_token)){
				return json(['access_token no valid.']);
			}			
		}
		return $response = $next($request);
	}
}
