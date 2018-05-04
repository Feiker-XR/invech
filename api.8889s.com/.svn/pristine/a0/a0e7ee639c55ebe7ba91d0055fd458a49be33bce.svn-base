<?php
namespace app\agent;
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

    protected function doLogin($username,$pwd='',$remember=false){

            if($pwd){
                $pwd = md5($pwd);

                $agent = db('k_user')->where('is_daili',1)
                ->where('username',$username)
                ->where('password',$pwd)
                ->find();

            }else{//记住我
                $agent = db('k_user')->where('is_daili',1)
                ->where('remember',$username)
                ->find();
            }

            if(empty($agent)){
                return null;
            }

            session('agentid',$agent['uid']);
            session('agent',$agent);

            //只记住7天;
            if ($remember) {
                $remember_token = md5($agent['username'].$agent['password'].time());
                cookie('remember', $remember_token, 24 * 3600 * 7);
                db('k_user')->where('uid',$agent['uid'])->update(['remember'=>$remember_token,]);
            }            

            return $agent;
    }	

    protected function isLogin(){
    	$agentid = session('agentid');
        if($agentid == ''){
            if (cookie('?remember')) {
            	$agent = $this->doLogin(cookie('remember'));
            	if($agent)return $agent['uid'];
            }
            return 0;
        }else{
        	return $agentid;
        }
    }    
}