<?php

namespace bong\service\auth\traits;

use bong\foundation\Str;

trait AttemptLogin
{
    
    public function attempt(array $credentials = [], $remember = false)
    {
        $this->lastAttempted = $user = $this->retrieveByCredentials($credentials);

        if ($this->hasValidCredentials($user, $credentials)) {
            return $this->login($user, $remember);
        }

        return null;
    }

    protected function hasValidCredentials($user, $credentials)
    {
        return ! is_null($user) && $this->validateCredentials($user, $credentials);
    }

    public function login($user, $remember = false)
    {
        
    }    
}
