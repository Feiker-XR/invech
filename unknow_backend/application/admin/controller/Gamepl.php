<?php
namespace app\admin\controller;
use app\admin\Login;
class gamepl extends Login{
    
    public function index($gid){
        $game = new \app\model\game();
        $gameinfo = $game->get($gid);
        $pl = new \app\model\gamepl();
        $plinfo = $pl->all(function ($query) use ($gid){
            $query->where(['game_id' => $gid]);
        });
        $tmp = array();
        foreach($plinfo as $v){
            $tmp[$v['gameball_id']][$v['playtype_id']] = $v['pl'];
        }
        $plinfo = $tmp;
        $ball = new \app\model\gameball();
        $ballinfo = $ball->all(function($query) use ($gid){
            $query->where(['game_id' => $gid]);
        });
        $playtype = new \app\model\playtype();
        $playtypes = $playtype -> all(function ($query) use ($gid){
            $query->where(['game_id' => $gid]);
        });
        
        $this->assign('gameinfo',$gameinfo);
        $this->assign('plinfo',$plinfo);
        $this->assign('ballinfo',$ballinfo);
        $this->assign('playtypes',$playtypes);
        return $this->fetch("index");
    }
    
    public function save(){
        
    }
    
}