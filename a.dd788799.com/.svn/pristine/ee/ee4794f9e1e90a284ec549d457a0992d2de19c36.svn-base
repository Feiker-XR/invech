<?php

namespace app\index\exceptions;

use Exception;
use bong\service\auth\AuthenticationException;
use think\exception\HttpResponseException;
use think\exception\Handle as ExceptionHandler;

use traits\controller\Jump;

class Handler extends ExceptionHandler
{
    use Jump;

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render(Exception $e)
    {
        if ($e instanceof HttpException) {
            return $this->renderHttpException($e);
        }elseif($e instanceof HttpResponseException) {
            return $e->getResponse();
        }elseif($e instanceof AuthenticationException) {
            $url = config('auth.redirect.auth_fail.'.MODULE);
            $this->error($e->getMessage(),$url);
        }else{
            return parent::render($e);
        }
    }

}
