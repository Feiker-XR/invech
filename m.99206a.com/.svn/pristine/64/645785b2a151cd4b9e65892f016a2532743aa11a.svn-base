<?php
namespace app\v2\controller;
use app\v2\Base;
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