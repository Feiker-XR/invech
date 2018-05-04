<?php
namespace app\admin;
use app\admin\Base;
use think\Db;
class Login extends Base{
    public function _initialize(){
    	parent::_initialize();
        //session('adminid','185');
        //session('adminname','admin');
        if(!$this->isLogin()){
            if($this->request->isAjax()){
                return ['status'=>0,'message'=>'请登录后执行操作!'];
            }else{
                echo "<script type='text/javascript'>";
                echo "alert('请登录后执行操作!');";
                echo "window.location='".url('index/login')."'";
                echo "</script>";
            }                    
        }
    }

}