<?php
namespace app\admin\controller;
use app\admin\Login;
class opentime extends Login{
    
    public function index($gid = 0){
        $game = new \app\model\game();
        $gameinfo = $game->get($gid);
        $this->assign('gameinfo',$gameinfo);
        $opentime = new \app\model\opentime();
        $opentimes = $opentime->all(function($query) use ($gid){
            $query->where(['game_id'=> $gid]);
        });
        $this->assign('opentimes',$opentimes);
        return $this->fetch('index');
    }
    
    public function edit($gid = 0,$tid = 0){
        $game = new \app\model\game();
        $gameinfo = $game->get($gid);
        $this->assign('gameinfo',$gameinfo);
        $opentime = new \app\model\opentime();
        $info = $opentime->get($tid);
        $this->assign('info',$info);
        return $this->fetch('edit');
    }
    
    public function add($gid){
        $game = new \app\model\game();
        $gameinfo = $game->get($gid);
        $this->assign('gameinfo',$gameinfo);
        return $this->fetch('add');
    }
    
    public function save($gid = 0){
        if(!$gid){
            $this->error('参数错误!请返回重试!');
        }
        $_POST['game_id'] = $gid;
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $opentime = new \app\model\opentime();
        if($id){
            $status = $opentime->allowField(true)->save($_POST,['id' => $id]);
        }else{
            $status = $opentime->allowField(true)->save($_POST);
        }
        if($status){
            $this->success('操作成功!');
        }else{
            $this->error('操作失败!');
        }
    }
    
    public function delete($tid){
        $opentime = new \app\model\opentime();
        $info = $opentime->get($tid)->delete();
        if($info){
            $this->success('操作成功');
        }else{
            $this->error('操作失败!');
        }
    }
    
}
