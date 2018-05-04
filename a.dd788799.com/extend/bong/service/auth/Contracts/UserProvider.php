<?php

namespace bong\service\auth\Contracts;

interface UserProvider
{

    public function retrieveById($identifier);

    public function retrieveByToken($identifier, $token);

    //public function updateRememberToken($user, $token);

    public function retrieveByCredentials(array $credentials);

    public function validateCredentials($user, array $credentials);
}
