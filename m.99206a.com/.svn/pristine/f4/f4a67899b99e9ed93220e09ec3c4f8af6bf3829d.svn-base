<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
use think\Config;
use think\Request;
class activity extends Login{
    
    public function test(){
        echo 'hello,world'; 
    }
    
    public function todaysignin(){
        $request = Request::instance();
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $list = array();
        $stime = date("Y-m-d 00:00:00");
        $etime = date("Y-m-d 23:59:59");
        $where = '';
        $conf = array();
        if($username){
            $conf['username'] = $username;
            Config::set('paginate.query',$conf);
            $where .= " and b.username = '$username' ";
        }
        $where .= "and a.m_make_time >= '$stime'";
        $where .= " and a.m_make_time <= '$etime'";
        $list = Db::view('k_money a','m_id,uid,m_make_time,m_value,about')
            ->view('k_user b',['username'],"a.uid=b.uid  and a.about like '%签到第%' $where")
            -> order('m_make_time desc')->paginate(20);
        $this->assign('username',$username);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    public function historysignin($query= ''){
        $request = Request::instance();
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $stime = isset($_REQUEST['stime']) ? $_REQUEST['stime'] : '';
        $etime = isset($_REQUEST['etime']) ? $_REQUEST['etime'] : '';
        $list = array();
        $conf['query'] = $query;
        if($query){
            $where = '';
            if($username){
                $conf['username'] = $username;
                $where .= " and b.username = '$username' ";
            }
            if($stime){
                $conf['stime'] = $stime;
                $where .= "and a.m_make_time >= '$stime  00:00:00'";
            }
            if($etime){
                $conf['etime'] = $etime;
                $where .= " and m_make_time <= '$etime 23:59:59'";
            }
            Config::set("paginate.query",$conf);
            $list = Db::view('k_money a','m_id,uid,m_make_time,m_value,about')
            ->view('k_user b',['username'],"a.uid=b.uid  and a.about like '%签到第%' $where")
            -> order('m_make_time desc')->paginate(20);
        }
        $this->assign('query',$query);
        $this->assign('username',$username);
        $this->assign('stime',$stime);
        $this->assign('etime',$etime);
        $this->assign('list',$list);
        return $this->fetch('historysignin');
    }
    
    public function todayzhuanpan(){
        $request = Request::instance();
        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $list = array();
        $stime = date("Y-m-d 00:00:00");
        $etime = date("Y-m-d 23:59:59");
        $where = '';
        if($username){
            Config::set('paginate.query',['username'=>$username]);
            $where .= " and b.username = '$username' ";
        }
        $where .= "and a.m_make_time >= '$stime'";
        $where .= " and a.m_make_time <= '$etime'";
        $list = Db::view('k_money a','m_id,uid,m_make_time,m_value,about')
        ->view('k_user b',['username'],"a.uid=b.uid  and a.about like '%轮盘%' $where")
        -> order('m_make_time desc')->paginate(20);
        $this->assign('username',$username);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    public function historyzhuanpan($query=''){
        $request = Request::instance();
        $username   = $request->param('username');
        $stime      = $request->param('stime');
        $etime      = $request->param('etime');
        $query      = $request->param('query');
        //$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        //$stime = isset($_REQUEST['stime']) ? $_REQUEST['stime'] : '';
        //$etime = isset($_REQUEST['etime']) ? $_REQUEST['etime'] : '';
        $list = array();
        $conf = array();
        $conf['query'] = $query; 
        if($query){
            $where = '';
            if($username){
                $conf['username'] = $username;
                $where .= " and b.username = '$username' ";
            }
            if($stime){
                $conf['stime'] = $stime;
                $where .= "and a.m_make_time >= '$stime  00:00:00'";
            }
            if($etime){
                $conf['etime'] = $etime;
                $where .= " and m_make_time <= '$etime 23:59:59'";
            }
            Config::set('paginate.query',$conf);
            $list = Db::view('k_money a','m_id,uid,m_make_time,m_value,about')
            ->view('k_user b',['username'],"a.uid=b.uid  and a.about like '%轮盘%' $where")
            -> order('m_make_time desc')->paginate(20);
        }
        $this->assign('query',$query);
        $this->assign('username',$username);
        $this->assign('stime',$stime);
        $this->assign('etime',$etime);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
}
