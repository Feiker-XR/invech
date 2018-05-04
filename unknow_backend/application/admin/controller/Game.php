<?php
namespace app\admin\controller;
use app\admin\Login;
class Game extends Login{
    
    public function index(){
        $game = new \app\model\game();
        $gamelist = $game->paginate(20);
        $this->assign('gamelist',$gamelist);
        return $this->fetch('index');
    }
    
    public function edit($id){
        $game = new \app\model\game();
        $info = $game->get($id);
        $this->assign('info',$info);
        return $this->fetch('edit');
    }
    
    public function save(){
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $game = new \app\model\game();
        if($id){
            $status = $game->allowField(true)->save($_POST,['id' => $id]);
        }else{
            $status = $game->allowField(true)->save($_POST);
        }
        if($status){
            $this->success('操作成功!');
        }else{
            $this->error('操作失败!');
        }
    }
    
    public function add(){
        return $this->fetch('add');
    }
    
}