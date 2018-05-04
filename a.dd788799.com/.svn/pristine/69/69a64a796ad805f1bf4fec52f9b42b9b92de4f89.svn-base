<?php
namespace app\admin;
//use think\Controller;
use app\common\Controller\Base as Controller;
use think\Cache;
use app\model\config;
use \think\View;
class Base extends Controller{
	
	protected function _initialize(){
        parent::_initialize();
        $controller = $this->request->controller();
        $action = $this->request->action();
        $this->user = $this->request->user();
        if(!IS_AJAX){
        
            if(!isset(\think\View::$var['menu_list'])){
                $this->view->menu_list = config('menu_list');
                $this->view->request_path = $controller.'/'.$action;
                $this->view->menu_group = $this->get_menu_group();     
            }
        }
  		$this->assign('user',$this->user);
        $this->initExceptionHandle();

	}

    private function initExceptionHandle(){
        config('exception_handle',\app\admin\exceptions\Handler::class);
    }

    private function get_menu_group(){
    
        foreach ($this->view->menu_list as $menu) {
            if(!empty($menu['sub_menu'])){
                foreach ($menu['sub_menu'] as $submenu) {
                    if($this->view->request_path == $submenu['link']){
                        return $menu['group'];
                    }
                }
            }
          
        }
        return ;
    }
}