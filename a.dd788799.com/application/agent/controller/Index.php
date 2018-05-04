<?php
namespace app\agent\controller;
use app\agent\Login;
use think\Cache;
use think\Validate;

use bong\service\auth\traits\ThrottlesLogins;

class index extends Login{
    use ThrottlesLogins;
    public function index(){
        $this->view->page_header = '首页';
        return $this->fetch();    
    }

    public function login(){        
        if(request()->isGet()){                    
            return $this->fetch("login");   
        }else{        	
        	$remember = input('remember/i')??0;
            if($uid = $this->doLogin($this->request,$remember)){
                $url = config('auth.redirect.auth_ok.'.MODULE);             
                return $this->success('登录成功',$url);
            }else{
                $url = config('auth.redirect.auth_fail.'.MODULE); 
                return $this->error('登录错误',$url);    
            }                
        }
    }

    public function logout(){
        session(null);
        cookie(null,config('cookie.prefix'));
        $this->redirect('/index/login');
    }    

}