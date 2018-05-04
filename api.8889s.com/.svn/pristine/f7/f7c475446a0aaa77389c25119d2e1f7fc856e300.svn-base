<?php
namespace app\index\controller;
use app\index\Base;
class vipcheck extends Base{
    
    
    public function index(){
        return $this-> fetch();
    }
    
    public function check(){
        $username = input('username');
        $user = db('k_user')->where('username','eq',$username)->find();
        if($user){
            
            if($user['vip']){
                $data = array('status' => 0,'levelNum' => $user['vip']);
            }else{
                $data = array('status'=>1);
            }
        }else{
            $data = array('status'=>1);
        }
        echo json_encode($data);
    }
    
}