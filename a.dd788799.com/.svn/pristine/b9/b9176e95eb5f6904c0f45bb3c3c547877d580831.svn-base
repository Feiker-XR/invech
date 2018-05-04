<?php
namespace app\agent;
use app\agent\Base;
use think\Db;
use think\Response;
class Login extends Base{
    public function _initialize(){
    	parent::_initialize();
        //session('adminid','185');
        //session('adminname','admin');
        
        //$dispatch = $this->request->dispatch();
        $controller = $this->request->controller();
        $action = $this->request->action();
        //$path = $this->request->path();

        if(!IS_AJAX){
            $this->view->menu_list = config('menu_list');
            $this->view->request_path = $controller.'/'.$action;
            $this->view->menu_group = $this->get_menu_group(); 
        }

    }

    private function get_menu_group(){
        foreach ($this->view->menu_list as $menu) {
    	    foreach ($menu['sub_menu'] as $submenu) {
        		if($this->view->request_path == $submenu['link']){
        		    return $menu['group'];
        		}
    	    }
        }
        return ;
    }
}