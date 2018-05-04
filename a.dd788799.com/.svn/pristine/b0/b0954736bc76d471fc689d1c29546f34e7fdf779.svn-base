<?php 
namespace app\api\controller;

use app\api\Base;
use think\Cache;
use think\Response;
use bong\service\auth\traits\ThrottlesLogins;
use app\api\error\CodeBase;
use bong\service\CaptchaService;

use app\common\model\Member as UserModel;
use app\common\model\Money;
class Pub extends Base {
    
    use ThrottlesLogins;

    public function captcha($config='default')
    {
        $ret = (new CaptchaService())->captcha($config);
        return $this->apiReturn([],$ret);
    }     

    //app注册只需要用户名和密码即可;
    public function register(){
        $params = request()->param();
        $code = $params['code'];
        $key = $params['key'];
        if(!(new CaptchaService())->check_verify($code,$key)){
            return $this->apiReturn(CodeBase::$error,'验证码错误!');
        }
        
        $UserModel = new UserModel();
        $ret =  $UserModel->register();
        if($ret){
            return $this->apiReturn([],$ret);
        }else{
            return $this->apiReturn(CodeBase::$error,$UserModel->getError());
        }         
    }    

    public function login(){
        
        try{
            if($ret = $this->doLogin($this->request,true)){
                $user = request()->user();
                event('user.login',[$user]);                          
                return $this->apiReturn([],$ret);
            }
            return $this->apiReturn(CodeBase::$error,'用户名或密码错误!');
        }catch(\Exception $e){
            return $this->apiReturn(CodeBase::$error,$e->getMessage());
        }

        
    }

    public function index(){
        /*
        $data = ['status'=>1,'msg'=>'HttpResponseException!',];
        $response = Response::create($data, 'json');
        abort($response);
        */
        return $this->apiReturn([],'index');
    }


    
    public function app(){
        $name = input('name');
        if(empty($name)){
            $name = 'default';
        }
        $status = config('app_shenhe');
        $data = $status[$name]??[];
        return $this->apiReturn([],$data);
    }

    public function moneyType() {
        $list = Money::NAME_ARRAY;  
        return $this->apiReturn([],$list);   
    }
}

