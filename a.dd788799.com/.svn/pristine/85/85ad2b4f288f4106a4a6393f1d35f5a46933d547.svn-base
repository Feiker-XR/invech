<?php
namespace app\behavior;

class InitCommon 
{


    public function initConst(){
        define('COMPANY'                , 'bong');
        define('JWT_KEY'                , config('auth.guards.jwt.jwt_key')??COMPANY);

		defined('IS_POST')          or define('IS_POST',         request()->isPost());
		defined('IS_GET')           or define('IS_GET',          request()->isGet());
		defined('IS_AJAX')          or define('IS_AJAX',         request()->isAjax());

		//request()->module()//此时为空
    }

	public function run(&$dispatch)
	{		
        $this->initConst();   
	}

}
