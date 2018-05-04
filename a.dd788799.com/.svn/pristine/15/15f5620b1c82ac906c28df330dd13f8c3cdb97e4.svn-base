<?php

namespace app\middlewares;
use Closure;
use bong\service\Cors as CorsService;

class Cors
{
    public function handle($request, Closure $next)
    {
        $configs = config('cors');
        $cors = new CorsService($configs);

        if (! $cors->isCorsRequest($request)) {
            return $next($request);
        }

        if ($cors->isPreflightRequest($request)) {
            //$response = $next($request);
            $response = json('nothing.');
            return $cors->addPreflightRequestHeaders($response, $request);
        }

        if (! $cors->isActualRequestAllowed($request)) {
            return json('Not allowed.', 403);
        }

        $response = $next($request);

        if (! $response->getHeader('Access-Control-Allow-Origin')) {
            $response = $cors->addActualRequestHeaders($response, $request);
        }

        return $response;    
    }

}
