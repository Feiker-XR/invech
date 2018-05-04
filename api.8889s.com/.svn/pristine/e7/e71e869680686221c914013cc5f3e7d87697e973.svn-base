<?php
namespace app\index\controller;
use app\index\Base;
use think\Db;
use app\index\Login;
use think\Session;
use app\model\dzyx;
use think\Cache;
use think\Validate;
use think\Request;
use think\Config;
class Index extends Base
{
    
    public function index()
    {
        $tanchuang = cache('content');
        if(!empty(Session::get('uid'))){
            $uid = Session::get('uid');
            $user = Db::table('k_user')->where(array('uid'=>$uid))->find();
            $this->assign('user',$user);
        }
      

        if(!$tanchuang){
            $tanchuang = Db::table('web_tc')
            ->where(array('id'=>1))
            ->find();
            cache('content',$tanchuang);
        }
        // 最新中奖名单
        $zjlist = array();
       
        $zjlist =  Db::table('c_bet')->field('username,win,type')->where('win>0 AND js =1')->order('id desc')->limit(15)->select();
     
         $this->assign('zjlist',$zjlist);
        $this->assign('tanchuang',$tanchuang);
        return $this->fetch('index');
    }
    
    public function home(){
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	
    	//if (isset($_POST['ajax']) && isset($_POST['get_money'])) {
        if (isset($_REQUEST['ajax']) && isset($_REQUEST['get_money'])) {
    	    if($uid){
    	        $userinfo = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	        echo round($userinfo['money'],2);
    	        exit;
    	    }else{
    	        exit('0');
    	    }
    		
    	}
    	$tanchuang = cache('content');
    	if(!$tanchuang){
    	    $tanchuang = Db::table('web_tc')
    	    ->where(array('id'=>1))
    	    ->find();
    	    cache('content',$tanchuang);
    	}
    	$this->assign('tanchuang',$tanchuang);
        $this->assign('agHotGame',$this->getHotGame('ag'));
        $this->assign('bbHotGame',$this->getHotGame('bb'));
        $this->assign('mgHotGame',$this->getHotGame('mg'));
        $this->assign('ptHotGame',$this->getHotGame('pt'));
        $this->assign('user',$user);
        return $this->fetch('home');
    }
    
    public function noticle(){
          $title = '系统公告';
         $this->assign('title',$title);
        return $this->fetch('noticle');
    }
    
    public function money(){
        $session = new Session();
        $uid = $session->get('uid');
        if(!$uid){
            echo '0';
        }else{
            $user = new \app\model\user();
            $money = $user->getAttr('money');
            echo $money;
        }
    }
    
    /**
     * 检测用户名是否重复
     */
    public function check(){
        $username = $_REQUEST['param'];
        $validate = new \app\index\validate\user();
        $data = array('username'=>$username);
        if(!$validate->scene('check')->check($data)){
            $return = array('status' => 'n' ,'info' => $validate->getError());
        }
        $user = new \app\model\user();
        $info = $user->get(function ($query) use ($username){
            $query->where ('username',$username);
        });
        if($info){
            $return = array('status' => 'n','info' => '用户已存在!');
        }else{
            $return = array('status' => 'y','info' => '恭喜您，该用户名可以注册！');
        }
        echo json_encode($return);
        exit;
    }

    /**
     * 检查真实用户是否存在!
     */
    public function truename(){
        
        $name = $this->request->param('param');
        $validate = new \app\index\validate\user();
        $data = array('zcturename' => $name);
        if(!$validate->scene('truename')->check($data)){
            $return = array('status' => 'n','info'=>$validate->getError());
        }
        $user = new \app\model\user();
        $info = $user->get(function ($query) use ($name){
            $query->where('pay_name',$name);
        });
        if($info){
            $return = array('status' => 'n' ,'info' => '真实姓名已经存在!');
        }else{
            $return = array('status' => 'y' ,'info' => '恭喜您,真实姓名验证通过!');
        }
        echo json_encode($return );
        exit();
    }
    
    public function reg(){

    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
        $topUser = getTopUid();
        $topUid = $topUser['uid'];
        $topUserName = $topUser['username'];
        $this->assign('topUid',$topUid);
        $this->assign('topUserName',$topUserName);
        $conf = Cache::get('sysConfig');
        $this->assign('regYzm',$conf['regYzm']);
        $this->assign('user',$user);
        return $this->fetch('reg');
    }
    
    public function create(){
        $conf = Cache::get('sysConfig');

        //是否开启了验证码?
        if($conf['regYzm']){
            //验证码错误!
            if(!captcha_check($_POST['zcyzm'])){
                $this->error('验证码错误!');
                //exit(json_encode(array('status'=>0,'info' => '验证码错误!')));
            }
        }
       
        $data = array(
            'username'      =>  input('zcname'),
            'password'      =>  input('zcpwd1'),
            'repassword'    =>  input('zcpwd2'),
            'zcturename'    =>  input('zcturename'),
            'qkpwd1'        =>  input('qkpwd1'),
            'qkpwd2'        =>  input('qkpwd2'),
            'zcquestion'    =>  input('zcquestion'),
            'zcanswer'      =>  input('zcanswer'),
        );

         $validate = new \app\index\validate\user();
        if($validate->scene('reg')->check($data)){
            $user = new \app\model\user();
            $sysConfig = cache('sysConfig');
            $userinfo =array();
            $userinfo['username'] = $data['username'];
            $userinfo['password'] = md5($data['password']);
           // $userinfo['currency']   = input('currency');
            $reg_ip = $userinfo['reg_ip']     = $this->request->ip();
           
            $userinfo['pay_name'] = $data['zcturename'];
            $userinfo['qk_pwd'] = md5($data['qkpwd1']);

            $userinfo['ask'] = $data['zcquestion'];
            $userinfo['answer'] = $data['zcanswer'];

            $userinfo['gid'] = 1;

                 //限制用户名
             if( $data['username']){
                    $username = $data['username'];
             
                    $info = $user->get(function ($query) use ($username){
                        $query->where('username',$username);
                    });
                   
                    if($info){
                        if(request()->isMobile()){
                            return ['status'=>0,'msg'=>'登录账户已经存在!',];
                        }else{                    
                            $this->error('登录账户已经存在!');
                        }
                    }
             }
           
            //限制IP
            
            if($sysConfig['reg_ip'] && 0){
                $info = $user->get(function ($query) use ($reg_ip){
                    $query->where('reg_ip',$reg_ip);
                });
                if($info){
                    if(request()->isMobile()){
                        return ['status'=>0,'msg'=>'当前限制每个IP只能注册一个用户!',];
                    }else{
                        $this->error('当前限制每个IP只能注册一个用户!');    
                    }                    
                }
            }
            //限制用户真实姓名
          
            if($sysConfig['reg_name']){
                $truename= $userinfo['pay_name'];
                $info = $user->get(function ($query) use ($truename){
                    $query->where('pay_name',$truename);
                });

                if($info){
                    if(request()->isMobile()){
                        return ['status'=>0,'msg'=>'用户真实姓名已经存在!',];
                    }else{                    
                        $this->error('用户真实姓名已经存在!');
                    }
                }
            }
     
            $user->allowField(True)->save($userinfo);

            if(request()->isMobile()){
                return ['status'=>1,'msg'=>'注册成功!请登录!',];
            }else{   
                $this->success('注册成功!请登录!');
            }
        }else{

            if(request()->isMobile()){
                return ['status'=>0,'msg'=>$validate->getError(),];
            }else{              
                $this->error($validate->getError());
            }
        }
        
    }
    public function loginMobile(){

        return $this->fetch('login');

    }

    public function login(){
    	$validate = new \app\index\validate\user();
    	$sysConfig = Cache::get('sysConfig');
    	//var_dump($sysConfig);
    	if($sysConfig['loginYzm'] == '1' && isset($_POST['dlyzm'])){
    	    if(!captcha_check($_POST['dlyzm'])){
    	        exit(json_encode(array('status'=>'n','info'=>'验证码错误!',)));
    	        //exit(json_encode(array('status'=>0,'info' => '验证码错误!')));
    	    }
    	}
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $data = array(
        		'username'  =>  $username,
        		'password'  =>  $password,
        );
        if($validate->scene('login')->check($data)){
        	$this->is_login($username, $password);
        }else {
        	echo json_encode(array('status'=>'n','info'=>$validate->getError()));
        	return;
        } 
    }
    
    public function logout(){
    	//Session::init();
       	//Session::destroy();
        session(null);
       	$this->redirect('/');
    }
    
    
    public function regtest(){
        $username = 'test'.rand('ymdhis').rand(100,999);
    }
    
    
    /**
     * 获取热门游戏
     * @param string $platform
     */
    protected function getHotGame($platform,$number = 8){
        $dzyx = new dzyx();
        $cache = new Cache();
        $name = $platform.'HotGame';
        $hotGames = $cache->get($name);
        if(!$hotGames){
            $hotGames = $dzyx->all(function($query) use ($platform,$number){
                $query -> where ('platform',$platform) ->where ('ishot',1) ->limit($number);
            });
            $cache->set($name, $hotGames);
        }
        return $hotGames;
    }
    
    /**
     * 登录&验证
     * @param string $username 用户名
     * @param string $password 密码
     */
    protected function is_login($username,$password){
        date_default_timezone_set('PRC');
    	$request = Request::instance();
    	$ClientSity = GetIpLookup($request->ip());//取出客户端IP所在城市
	   $ipinfo = config('ipinfo');
    	//$json = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$request->ip());
    	$json = file_get_contents("{$ipinfo}?ip=".$request->ip());
	   $arr = json_decode($json);
    	$arr = object2array($arr);
    	if(empty($arr)){
    		if($ClientSity['city']!=''){
    			$city = $ClientSity['city'];
    		}else {
    			$city = $ClientSity['country'];
    		}
    	}else {
    		if($arr['data']['city']!=''){
    			$city = $arr['data']['city'];
    		}else {
    			$city = $arr['data']['country'];
    		}
    	}
    	$user = Db::table('k_user')->where(array('username'=>$username,'password'=>md5($password)))->find();

    	if(empty($user)){
    		echo json_encode(array('status'=>'n','info'=>'用户名称或密码错误!'));
    		return;
    	}
    	if($user["is_delete"] == 1 && $user["is_stop"] == 1){ 	//停用，或被删除，或其它信息
    		echo json_encode(array('status'=>'n','info'=>'账户异常无法登陆，如有疑问请联系在线客服!'));
    		return;
    	}
    	//Session::init();
    	$session_id = session_id();
    	$res['is_kick'] = 0;
    	$res['login_time'] = date("Y-m-d H:i:s", time());
    	$res['login_ip'] = $request->ip();
    	$res['lognum'] = +$user['lognum']+1;
    	$res['session_id'] = $session_id;
    	//Db::table('k_user')->where(array('uid'=>$user['uid']))->update($res);
      
    	Db::table('k_user')->where('uid',$user['uid'])->cache()->update($res);
    	 
    	$userlogin = Db::table('k_user_login')->where(array('uid'=>$user['uid']))->find();
    	$url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    	$time	=	time();
    	$date	=	date('YmdHis');
    	if($userlogin){
    		$r['login_id'] = $time."_".$user['uid']."_".$username;
    		$r['login_time'] = $time;
    		$r['is_login'] = 1;
    		$r['www'] = $url;
            
    		Db::table('k_user_login')->where(array('uid'=>$user['uid']))->update($r);
          

    	}else {
    		$r['login_id'] = $time."_".$user['uid']."_".$username;
    		$r['uid'] = $user['uid'];
    		$r['login_time'] = $time;
    		$r['is_login'] = 1;
    		$r['www'] = $url;
    		Db::table('k_user_login')->insert($r);
    	}
    	$db = Db::connect(Config::get('otherdb'));
    	$sql = " insert into `history_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES (".$user['uid'].",'$username','".$request->ip()."','".$city."','".date("Y-m-d H:i:s", time())."','$url') ";
      
    	$db->query($sql);
    	Session::set('uid',$user['uid']);
    	Session::set('username',$username);
    	Session::set('is_daili',$user['is_daili']);
    	Session::set('gid',$user['gid']);
    	Session::set('denlu','one');
    	Session::set('user_login_id',$time.'_'.$user["uid"].'_'.$username);
    	echo json_encode(array('status'=>'y','info'=>'登录成功',));
    	return;
    }
    
    public function left(){
        return $this->fetch('left');
    }
    
    public function betiframe(){
        return $this->fetch('betiframe');
    }
    
    public function leftcp(){
        return $this->fetch('leftcp');
    }
    
}
