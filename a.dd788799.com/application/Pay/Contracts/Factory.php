<?php

namespace app\Pay\Contracts;

interface Factory
{

    public function driver($name = null);

}
