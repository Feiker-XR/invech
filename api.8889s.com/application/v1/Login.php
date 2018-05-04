<?php 
namespace app\v1;
use app\v1\Base;
use think\Db;
use think\Session;
class Login extends Base{
    public function _initialize(){
        parent::_initialize();
        //session('uid',11256);
        if(session('uid') == ''){
            //$info = [];
            die(json_encode(['status'=>-1,'msg'=>'请先登录!']));
            //session('uid',11256);            
        }        
        $this->uid = session('uid');
        $this->user = db('k_user')->where('uid',$this->uid)->find();
    }

    //在行为扩展中实现

    //session支持的api;在行为扩展中实现;
    //通过设置PHPSSID这个cookie;要求app请求头带上cookie;

    //无session支持
    protected function check_token(){
    	$access_token = input('access_token');
    	if(!$access_token){
    		$access_token = request()->header('authorization');
        	// Authentication 非Bearer
    	}

    	if(!$access_token)return false;

    	$this->user = db('k_user')->where('api_token',$access_token)->find();
    	if(!$this->user){
    		return false;
    	}

    	return true;
    }    
}