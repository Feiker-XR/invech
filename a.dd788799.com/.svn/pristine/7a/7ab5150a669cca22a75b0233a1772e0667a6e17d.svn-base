<?php

namespace bong\service\auth\access;

trait Authorizable
{
    public function can($ability, $arguments = [])
    {
        return container('policy')->check($ability, $arguments);
    }

    public function cant($ability, $arguments = [])
    {
        return ! $this->can($ability, $arguments);
    }

    public function cannot($ability, $arguments = [])
    {
        return $this->cant($ability, $arguments);
    }
}
