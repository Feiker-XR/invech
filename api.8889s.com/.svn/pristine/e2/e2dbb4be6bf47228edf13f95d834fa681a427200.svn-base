<?php
namespace app\v1\controller;
use app\v1\Base;
use app\v1\Login;

use think\Db;
use think\Config;
use think\Session;
use app\live\agGame;
use app\live\bbingame;
use app\live\oggame;
use app\live\mycrypt;
use app\live\mgGame;
use app\live\ptGamePlayer;
use app\live\auth;
use think\Cache;

class Live extends Login
{
    const  STATUS_ERROR   = 1 ;
    const  STATUS_SUCCESS = 0  ;
    static protected $suffix = 'test';

    /**
     *  AG平台
     * @param string $type
     * @param int $actype
     * @return array
     */
	public function ag()
    {
        $type = $this->request->param('type') ;
        $type = ($type) ? strtolower($type) : '' ;

        $actype = $this->request->param('actype') ;
        $actype = ($actype) ? strtolower($actype) : 1 ;

//    	return ['status'=>1,'msg'=>'开发中,敬请期待!',];

		$fengpan = db('k_fengpan')->where('name',$type.'zr')->where('weihu',1)->select() ;
		if($fengpan){
			return ['status'=>1,'msg'=>"当前游戏正在维护中!请稍后再试!",];
		}

	    $uid = $this->uid;
	    $username = $this->user['username'];

	    if(!$actype){
	        $temp_username = $username.'tmpa';
	        if($result = agGame::regTempUser($temp_username)){
	        }
	    }else{
	        $temp_username = $username.self::$suffix;
	        if($result = agGame::regUser($temp_username)){
	        }
	    }

	    $result['Code'] = 0;//test
	    if($result['Code']){
	        return ['status'=>1,'msg'=>'登录失败!',];
	    }
	    

	    $res = '';
	    if(is_null($type)||$type==''){
	        $res = agGame::playAG($temp_username);
	    }else if($type=='buyu'){
	        $res = agGame::playAG($temp_username,6);
	    }else if($type=='dianzi'){
	        $res = agGame::playAG($temp_username,8);
	    }else{
	        $res = agGame::playAG($temp_username,$type);
	    }
	    $this->assign('res',$res);
	    $html = $this->fetch();
	    return ['status'=>0,'msg'=>'','data'=>$html,];
	}
	
	
	public function bb()
    {
		$fengpan = db('k_fengpan')->where('name','bbzr')->where('weihu',1)->select();
		if($fengpan){
			return ['status'=>1,'msg'=>"当前游戏正在维护中!请稍后再试!",];
		}

	    $uid = $this->uid;
	    $username = $this->user['username'];

	    $temp_username = $username . self::$suffix;
	    $password = substr(md5(md5($username)),3,12);
	    if($return = bbinGame::CreateMember($temp_username,$password)){
	        ;
	    }
	    $return = bbingame::Login($temp_username, $password);
	    //<html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body onload='document.post_form.submit();'><form id='post_form' name='post_form' method=post action='http://777.bb-api.net' ><input name=uid  type='hidden' value='1c134b265bb52df739040336ba50caacf3eb9fa6'><input name=langx type='hidden' value='zh-cn'></form></body></html>
	    //bbin 返回 html
	    $this->assign('return',$return);
	    $html = $this->fetch();
	    return ['status'=>0,'msg'=>'','data'=>$html,];
	}
	
	public function mg()
    {
        $type = $this->request->param('type') ;
        $type = ($type) ? strtolower($type) : '' ;
        $app_id = $this->request->param('appid') ;
        $app_id = ($app_id) ? $app_id : '1002' ;
//        $app_id = '1002';//手机h5

		$fengpan = db('k_fengpan')->where('name','bbzr')->where('weihu',1)->select();
		if($fengpan){
			return $this->api_error("当前游戏正在维护中!请稍后再试!");
		}


	    
	    $uid = $this->uid;
	    $username = $this->user['username'];

	    $password = substr(md5(md5($username)),3,12);
	    $mg_username = $username.'@'.self::$suffix;
	    
        $auth = mgGame::authenticate();
        if ($auth['success']) {
            $access_token = $auth['body']['access_token'];
            $mgusername = $username.'@'.self::$suffix;
            $info = mgGame::createMember($access_token, $mgusername, $password,$mgusername);
			//if($info['success']){
                $auth = mgGame::authenticate();
                if($auth['success']){
                    $access_token = $auth['body']['access_token'];
                    $info = mgGame::lauchItem($access_token, $mgusername, $type, $app_id);

                    if($info['success']){
                        //header('location:'.$info['body']);
                        $html = $this->location($info['body']);
                        return $this->api_success($html);
                    }else{
                        return $this->api_error("登录游戏失败!");
                    }
                }else{
                    return $this->api_error("认证失败!");
                }              
        }else{
            return $this->api_error("认证失败!");
        }
	    
	}
	
	public function pt()
    {
        $type = $this->request->param('type') ;
        $type = ($type) ? strtolower($type) : '' ;

		$fengpan = db('k_fengpan')->where('name','bbzr')->where('weihu',1)->select();
		if($fengpan){
			return $this->api_error("当前游戏正在维护中!请稍后再试!");
		}

	    $uid = $this->uid;
	    $username = $this->user['username'];

	    $password = substr(md5(md5($username)),3,12);

        if (mb_substr($username,-3,3,'utf-8') != self::$suffix) {
            $temp_username = $username . self::$suffix;
        } else {
            $temp_username = $username;
        }
 
 	$mgusername = $temp_username;

        $data = array(
            'param1' => $mgusername,
            'param2' => $password,
            //'param3' => 'jsa',
	    'param3' => self::$suffix,
            'param4' => date("Y-m-d H:i:s"),
            'param5' => $type,
        );
        $auth = new auth();
        $return = $auth -> test($data);

	    $this->assign('return',$return);
	    $html = $this->fetch();
	    return $this->api_success($html);
	}
	
	//只有大厅,无type参数
	public function sb()//sunbet
    {
    	return ['status'=>1,'msg'=>'开发中,敬请期待!',];
	}
	
	//只有大厅,无type参数
	public function og()
    {
		$fengpan = db('k_fengpan')->where('name','ogzr')->where('weihu',1)->select();
		if($fengpan){
			return $this->api_error("当前游戏正在维护中!请稍后再试!");
		}

	    $uid = $this->uid ;
	    $username = $this->user['username'] ;
	    $password = substr(md5(md5($username)),3,12) ;

        if (mb_substr($username,-3,3,'utf-8') != self::$suffix) {
            $temp_username = $username . self::$suffix;
        } else {
            $temp_username = $username;
        }

        //og用户注册
//        if ($this->user['og_username'] == '') {
//            $result = \app\live\oggame::CheckAndCreateAccount($temp_username, 'oga123456');
//            if ($result == '1') {
//                $s = "UPDATE k_user  set  og_username='" . $temp_username."' WHERE  uid=" . $uid;
//                Db::query($s);
//            }
//        }

	    $url = \app\live\oggame::TransferGame($temp_username, 'oga123456', 'cashapi.jinpaizhan.com', '1', '0');
	    //$url = og::createGameUrl("jp1" . $user['username'], 'oga123456');

	    $html = $this->location($url);

	    return $this->api_success($html);
	}

    /**
     *  获取各平台下的游戏列表
     *  @return array
     */
	public function lobby()
    {
        try {
            $type = $this->request->param('type') ;
            $type = ($type) ? strtolower($type) : '' ;
            if(!in_array($type,['ag','mg','pt','bb','sb'])){
                throw new \Exception(10001);
            }
            $dzyx = Cache::get('dzyx') ;

            if (!$dzyx) {
                $dzyx =[];
                $dzyx['ag'] = db('dzyx')->where('platform','ag')->where('isopen',1)->where(function($query){
                    $query->where('ishot',1)->whereOr('isnew',1);
                })->limit(40)->select();
                $dzyx['mg'] = db('dzyx')->where('platform','mg')->where('isopen',1)->where(function($query){
                    $query->where('ishot',1)->whereOr('isnew',1);
                })->limit(40)->select();
                $dzyx['pt'] = db('dzyx')->where('platform','pt')->where('isopen',1)->where(function($query){
                    $query->where('ishot',1)->whereOr('isnew',1);
                })->limit(40)->select();
                $dzyx['bb'] = db('dzyx')->where('platform','bb')->where('isopen',1)->where(function($query){
                    $query->where('ishot',1)->whereOr('isnew',1);
                })->limit(40)->select();
                $dzyx['sb'] = db('dzyx')->where('platform','sb')->where('isopen',1)->where(function($query){
                    $query->where('ishot',1)->whereOr('isnew',1);
                })->limit(40)->select();
                Cache::set('dzyx',$dzyx);
            }

           $this->addImgUrlForPt($dzyx['pt']) ; //给PT平台电子游艺添加图片路径

            return $this->api_success($dzyx[$type]) ;

        } catch (\Exception $e) {
            if  ($e->getMessage() ==10001) {
                $errorMsg = 'type参数不合法' ;
            } else {
                $errorMsg = '' ;
            }
            return $this->api_error($errorMsg) ;
        }
	}
    //给PT组合图片路径
	private  function addImgUrlForPt(&$data)
    {
        if ( !empty($data) ) {
            foreach ($data as $key=>$val) {
                $data[$key]['imageurl'] = "{$val['gameid']}.png" ;
            }
        }
    }

}