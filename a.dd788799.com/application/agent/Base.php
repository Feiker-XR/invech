<?php
namespace app\agent;
//use think\Controller;
use app\common\Controller\Base as Controller;
use think\Cache;
use app\model\config;

class Base extends Controller{
	protected function _initialize(){
        parent::_initialize();
        $this->user = $this->request->user();
        $this->assign('user',$this->user);

        $this->initExceptionHandle();     
	}

    private function initExceptionHandle(){
        config('exception_handle',\app\agent\exceptions\Handler::class);
    }	
}