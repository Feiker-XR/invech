<?php
namespace app\admin\controller;
use app\admin\Login;
class gameball extends Login{

    public function index($gid){
        $game = new \app\model\game();
        $gameinfo =$game->get($gid)->getData();
        $gameball = new \app\model\gameball();
        $gameballs = $gameball->where(['game_id ' => $gid ]) -> paginate(20);
        $this->assign('gameinfo',$gameinfo);
        $this->assign('gameballs',$gameballs);
        return $this->fetch('index');
    }
    
    public function add($gid){
        $game = new \app\model\game();
        $gameinfo =$game->get($gid)->getData();
        $this->assign('gameinfo',$gameinfo);
        return $this->fetch('add');
    }
    
    public function edit($gid,$bid){
        $game = new \app\model\game();
        $gameinfo =$game->get($gid)->getData();
        $this->assign('gameinfo',$gameinfo);
        $gameball = new \app\model\gameball();
        $ball = $gameball -> get($bid);
        $this->assign('info',$ball);
        return $this->fetch('edit');
    }
    
    public function save($gid){
        $bid = isset($_POST['id']) ? $_POST['id'] : NULL;
         $gameball = new \app\model\gameball();
        $_POST['game_id'] = $gid;
        if($bid){
            $status = $gameball ->allowField(true)->save($_POST,['id' => $bid]);
        }else{
            var_dump($_POST);
            $status = $gameball -> allowField(true)->save($_POST);
        }
        if($status){
            $this->success('操作成功!');
        }else{
            $this->error('操作失败!');
        }
    }
    
    public function delete($bid){
        $gameball = new \app\model\gameball();
        $return = $gameball -> get($bid) -> delete();
        if($return){
            $this->success('操作成功!');
        }else{
            $this -> error('操作失败!');
        }
    }
    
}