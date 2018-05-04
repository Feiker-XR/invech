<?php

namespace app\api\middlewares;

use Closure;
use RuntimeException;
use Illuminate\Support\Str;
use bong\service\RateLimiter;

class ThrottleRequests
{

    public function handle($request, Closure $next, $maxAttempts = 60, $decayMinutes = 1)
    {
        $key = $request->domain().'|'.$request->ip();
        /*
        $timer = $key.':timer';
        $msg = 'key=' . cache($key) . '&timer=' . cache($timer);
        $now = date('Y-m-d H:i:s');
        $msg = "[{$now}]" . $msg;
        $dir = APP_PATH.request()->module(). DS . 'log' . DS;
        file_put_contents($dir.'throttle.log',$msg."\r\n",FILE_APPEND);
        */
        $limiter = container(RateLimiter::class);
        
        if ($limiter->tooManyAttempts($key, $maxAttempts, $decayMinutes)) {
//            throw $this->buildException($key, $maxAttempts);
            return json(['Too Many Attempts.']);
        }

        $limiter->hit($key, $decayMinutes);

        return $response = $next($request);

    }




    protected function getTimeUntilNextRetry($key)
    {
        return $limiter->availableIn($key);
    }

    protected function calculateRemainingAttempts($key, $maxAttempts, $retryAfter = null)
    {
        if (is_null($retryAfter)) {
            return $limiter->retriesLeft($key, $maxAttempts);
        }

        return 0;
    }
}
