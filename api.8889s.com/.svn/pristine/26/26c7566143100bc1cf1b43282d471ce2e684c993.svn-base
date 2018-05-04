<?php
namespace app\admin\controller;

use app\admin\Login;
use think\Db;
class havebet extends Login{
    
    public function zuqiu(){
        $param = $this->request->param();
        $page_date = $param['date'] ?? date('m-d');
        $page_date2 = date('Y').'-'.$page_date;
        

        $rows = Db::table('havebet_ft')->where('match_js','eq','0')->where('match_date',['eq',$page_date],['eq',$page_date2],'or')->select();
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('list',$rows);
        return $this -> fetch();
    }
    
    public function lanqiu(){
        $param = $this->request->param();
        $page_date = $param['date'] ?? date('m-d');
        $page_date2 = date('Y').'-'.$page_date;
        $rows = Db::table('havebet_bk')->where('match_js','eq','0')->where('match_date',['eq',$page_date],['eq',$page_date2],'or')->select();
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('list',$rows);
        return $this -> fetch();
    }
    
    public function gunqiu(){
        
    }
    
    public function matchlist($matchid){
        $matchid = intval($matchid);
        $match_info = Db::connect('sportdb')->table('bet_match')->where('match_id','eq',$matchid)->find();
        $this->assign('match_info',$match_info);
        $list = Db::table('bet_user')->where('match_id','eq',$matchid)->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    public function lqmatchlist($matchid){
        $matchid = intval($matchid);
        $match_info = Db::connect('sportdb')->table('lq_match')->where('Match_ID','eq',$matchid)->find();
        $this->assign('match_info',$match_info);
        $list = Db::table('bet_user')->where('match_id','eq',$matchid)->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    public function lanqiu_yes(){
        $param = $this->request->param();
        $page_date = $param['date'] ?? date('m-d');
        $page_date2 = date('Y').'-'.$page_date;
        $rows = Db::table('havebet_bk')->where('match_js','eq','1')->where('match_date',['eq',$page_date],['eq',$page_date2],'or')->select();
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('list',$rows);
        return $this -> fetch();
    }
    
    public function ft_yes(){
        $param = $this->request->param();
        $page_date = $param['date'] ?? date('m-d');
        $page_date2 = date('Y').'-'.$page_date;
        $rows = Db::table('havebet_ft')->where('match_js','eq','1')->where('match_date',['eq',$page_date],['eq',$page_date2],'or')->select();
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('list',$rows);
        return $this -> fetch();
    }

}
