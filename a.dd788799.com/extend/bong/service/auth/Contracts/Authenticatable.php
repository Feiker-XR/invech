<?php

namespace bong\service\auth\Contracts;

interface Authenticatable
{

    public function getAuthIdentifierName();

    public function getAuthIdentifier();

    public function getAuthPassword();

    public function getRememberToken();

    public function setRememberToken($value);

    public function getRememberTokenName();
}
