<?php
namespace app\admin;
use think\Controller;
use think\Cache;
use app\model\config;

class Base extends Controller{
	protected function _initialize(){
		$cache = new Cache();
	    $cache::rm('sysConfig');
	    $sysConfig = $cache->get('sysConfig');
	    if(!$sysConfig){
	        $config = new config();
	        $sysConfig = $config->get(1)->getData();
	        $cache->set('sysConfig',$sysConfig);
	    }	
	    $this->assign('sysConfig',$sysConfig);
	}

    protected function doLogin($username,$pwd,$remember=false){
            $data['login_name'] = $username;
            $data['login_pwd'] = md5($pwd);
            $admin = db('sys_admin','otherdb')->where($data)->find();
            if(empty($admin)){
                return null;
            }

            session('adminid',$admin['uid']);
            session('adminname',$admin['login_name']);

            //只记住7天;
            if ($remember) {      
                cookie('username', $username, 24 * 3600 * 7);
                cookie('password', $pwd, 24 * 3600 * 7);
            }            

            $updata['ip'] = request()->ip();
            $updata['updatetime'] = time();
            db('sys_admin','otherdb')->where('uid',$admin['uid'])->update($updata);

            return $admin;
    }	

    protected function isLogin(){
    	$adminid = session('adminid');
        if($adminid == ''){
            if (cookie('?username') && cookie('?password')) {
            	$admin = $this->doLogin(cookie('username'),cookie('password'));
            	if($admin)return $admin['uid'];
            }
            return 0;
        }else{
        	return $adminid;
        }
    }    
}