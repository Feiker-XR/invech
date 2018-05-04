<?php

namespace bong\service\auth\Contracts;

interface Factory
{
    public function guard($name = null);

    public function shouldUse($name);
}
