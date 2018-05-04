<?php

namespace bong\service\auth\Contracts;

interface Guard
{

    public function check();


    public function guest();


    public function user();


    public function id();

    //public function validate(array $credentials = []);

    public function setUser($user);
}
