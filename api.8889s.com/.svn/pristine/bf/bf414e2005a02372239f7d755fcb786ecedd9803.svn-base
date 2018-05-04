<?php
namespace app\agent;
use app\agent\Base;
use think\Db;
class Login extends Base{
    public function _initialize(){
    	parent::_initialize();
        //session('adminid','185');
        //session('adminname','admin');
        if(!$this->isLogin()){
            /*
            if($this->request->isAjax()){
                return ['status'=>0,'message'=>'请登录后执行操作!'];
            }else{
                echo "<script type='text/javascript'>";
                echo "alert('请登录后执行操作!');";
                echo "window.location='".url('index/login')."'";
                echo "</script>";
            }*/
            $this->error('请登录后执行操作!','index/login');                  
        }

        $this->view->menu_list = config('menu_list');
    	//$dispatch = $this->request->dispatch();
    	$controller = $this->request->controller();
    	$action = $this->request->action();
    	//$path = $this->request->path();
    	$this->view->request_path = $controller.'/'.$action;
        $this->view->menu_group = $this->get_menu_group();
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