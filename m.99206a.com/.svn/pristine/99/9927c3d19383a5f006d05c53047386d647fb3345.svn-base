<?php
namespace app\admin\controller;
use app\admin\Login;
class playtype extends Login{
    
    public function index($gid,$bid){
        $game = new \app\model\game();
        $gameinfo =$game->get($gid)->getData();
 
        $playtype = new \app\model\playtype();
        $playtypes = $playtype->where(['game_id ' => $gid ,'ball_id' => $bid]) -> paginate(20);
        $ball = new \app\model\gameball();
        $ballinfo = $ball->get($bid);
        $this->assign('ballinfo',$ballinfo);
        $this->assign('gameinfo',$gameinfo);
        $this->assign('playtypes',$playtypes);
        return $this->fetch('index');
    }
    
    public function add($gid,$bid){
        $game = new \app\model\game();
        $gameinfo =$game->get($gid)->getData();
        $ball = new \app\model\gameball();
        $ballinfo = $ball->get($bid);
        $this->assign('ballinfo',$ballinfo) ;
        $this->assign('gameinfo',$gameinfo);
        return $this->fetch('add');
    }
    
    public function edit($pid){
        $playtype = new \app\model\playtype();
        $playtypes = $playtype->get($pid);
        $this->assign('info',$playtypes);
        $gid = $playtypes->game_id;
        $game = new \app\model\game();
        $bid = $playtypes->ball_id;
        $ball = new \app\model\gameball();
        $ballinfo = $ball->get($bid);
        
        $this->assign('ballinfo',$ballinfo);
        $gameinfo =$game->get($gid)->getData();
        $this->assign('gameinfo',$gameinfo);
        return $this->fetch('edit');
    }
    
    public function save($gid,$bid){
        $pid = isset($_POST['id']) ? $_POST['id'] : NULL;
        $playtype = new \app\model\playtype();
        $_POST['game_id'] = $gid;
        $_POST['ball_id']   = $bid;
        if($pid){
            $status = $playtype ->allowField(true)->save($_POST,['id' => $pid]);
        }else{
            $status = $playtype -> allowField(true)->save($_POST);
        }

        if($status){
            $this->success('操作成功!');
        }else{
            $this->error('操作失败!');
        }
    }
    
    public function delete($pid){
        $playtype = new \app\model\playtype();
        $status = $playtype->get($pid) -> delete();
        if($status){
            $this->success('操作成功!');
        }else{
            $this -> success('操作失败!');
        }
    }
    
}