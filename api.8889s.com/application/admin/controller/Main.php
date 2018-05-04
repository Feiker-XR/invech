<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
class Main extends Login{
    
    public function index(){
        return $this->fetch('index');
    }
    
    public function top(){
        return $this->fetch('top');
    }
    
    public function left(){
        return $this->fetch('left');
    }
    
    public function info(){
        return $this->fetch('info');
    }
    
    public function SysTopDao(){
        $callback = $this->request->param('callback');
        $tknum		=	$ssnum = $hknum = $tsjynum = $dlsqnum = $cgnum = $logout = 0;
        //$sql	=	"select uid from sys_admin where login_name='".$_SESSION["login_name"]."' and yz='".$_SESSION["adminyz"]."' limit 1";
        //$t = Db::connect(config('otherdb'))->where('login_name','eq',$_SESSION['login_name']) -> where('yz','eq',$_SESSION['adminyz'])->limit(1)->select();
        Db::startTrans();
        $sql		=	"select count(*) as s from k_money where m_value<0 and status=2";
        $tknum		=	Db::query($sql)[0];
        $tknum      =   $tknum['s'] ?? 0;
        
        $sql		=	"select count(*) as s from huikuan where status=0";
        $hknum		=	Db::query($sql)[0];
        $hknum      =   $hknum['s'] ?? 0;
        
        $sql		=	"select count(*) as s from k_user_daili where `status`=0";
        $dlsqnum	=	Db::query($sql)[0];
        $dlsqnum    = $dlsqnum['s'] ?? 0;
        
        $online = db('g_user_login')->where('ul_type',1)->count();

        $sql		=	"SELECT count(*) as s FROM k_bet_cg_group cg where cg.`status` in (0,2) and cg.cg_count=(select count(*) from k_bet_cg c where c.gid=cg.gid and c.`status` not in(0,3))";
        $cgnum		=	Db::query($sql)[0];
        $cgnum      =   $cgnum['s'] ?? 0;
        
        $json['sum']  		=	$tknum+$ssnum+$hknum+$dlsqnum+$cgnum;
        $json['tknum']		=	$tknum;
        $json['ssnum']		=	$ssnum;
        $json['hknum']		=	$hknum;
        $json['dlsqnum']	=	$dlsqnum;
        $json['cgnum']		=	$cgnum;
        $json['logout']		=	$logout;
        $json['online']     =   $online;
        
        echo $callback."(".json_encode($json).");";
    }
    
}