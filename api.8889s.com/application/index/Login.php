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
        }      
    }
}