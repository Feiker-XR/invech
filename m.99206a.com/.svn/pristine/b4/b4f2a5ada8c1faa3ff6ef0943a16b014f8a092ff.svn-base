<?php
namespace app\admin\controller;
use app\admin\Login;
use app\model\user;
use think\Db;
class msg extends Login{
    
    public function index(){
        return $this->fetch();
    }
    
    public function add(){
        $param = $this->request->param();
        $users = array();
        if(isset($param['type'])){
            if($param['type'] == 'login'){
                $users = Db::table('k_user_login')->where('is_login','>',0)->field(['uid'])->select();
            }elseif($param['type'] == 'all'){
                $users = Db::table('k_user')->field(['uid'])->select();
            }elseif($param['type'] == 'group'){
                $users = Db::table('k_user')->where('gid','eq',$param['gid'])->field(['uid'])->select();
            }
        }else{
            if(trim($param['username']) != ''){
                $usernames = explode(',',trim($param['username'],','));
                var_dump($usernames);
                $users = Db::table('k_user') -> where('username','in',$usernames) -> field(['uid']) -> select();
                //var_dump($users);
                //exit();
            }
        }
        if($users){
            $msg_from = $param['msg_from'];
            $msg_title = $param['msg_title'];
            $msg_info = $param['msg_info'];
            $msg = new \app\model\msg();
            
            foreach ($users as $v){
                $msg->msg_add($v['uid'],$msg_from,$msg_title,$msg_info);
            }
            $this->success('操作成功!');
        }else{
            $this->error('操作失败!');
        }
        
    }
    
    public function sended($keyword =''){
        if($keyword){
            
        }
    }
    
    
}