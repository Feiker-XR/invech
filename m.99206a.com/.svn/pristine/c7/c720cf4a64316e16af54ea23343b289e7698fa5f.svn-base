<?php
namespace app\index;
use app\index\Base;
use think\Db;
use think\Session;
class Login extends Base{
    public function _initialize(){
        parent::_initialize();
        if(Session('uid') == ''){
            if($this->request->isAjax()){
                echo json_encode(array('status'=>0,'message'=>'请登录后执行操作!'));
            }else{
                echo "<script type='text/javascript'>";
                echo "alert('请登录后执行操作!');";
                echo "window.location='".url('index/index')."'";
                echo "</script>";
            }
            exit();
        }else{
            $time = time() - 3600;
            $sql = "update `k_user_login` set `login_time`='".time()."',`is_login` = 1  where `uid`=".Session('uid');
            Db::query($sql); 
            $sql ="update `k_user_login` set `is_login`=0 WHERE login_time<$time and `is_login`>0";
            Db::query($sql);
            
        }
    }
    
}