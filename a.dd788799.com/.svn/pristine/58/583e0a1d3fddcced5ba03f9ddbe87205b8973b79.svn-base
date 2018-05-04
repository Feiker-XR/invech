<?php 
namespace app\api;

use think\Cookie;
//use think\Controller;
use app\common\Controller\Base as Controller;
use app\api\error\CodeBase;

class Base extends Controller{
    
    protected function _initialize(){

        parent::_initialize();

        $this->user = $this->request->user();
        
        config('default_return_type','json');
        $view_path = APP_PATH.$this->request->module().DS.'view'.DS;
        $this->view->config('view_path',$view_path);

        Cookie::prefix('api_');//这个前缀放在api/config.php中无效;
                
        $this->initExceptionHandle();
        $this->initApiConst();
    }

    private function initExceptionHandle(){
        config('exception_handle',\app\api\exceptions\Handler::class);
    }

    private function initApiConst()
    {        
        //中间件在module_init时执行,此时控制器没有实例化;
        //这里定义的常量无法被中间件使用
        defined('API_CODE_NAME') or define('API_CODE_NAME'          , 'code');
        defined('API_MSG_NAME')  or define('API_MSG_NAME'           , 'msg');
        defined('API_KEY')       or define('API_KEY'                , config('api_key')??COMPANY);  
    }


    public function apiReturn($code_data = [], $return_data = [])
    {
        
        if (array_key_exists(API_CODE_NAME, $code_data)) {
            
            !empty($return_data) && $code_data['data'] = $return_data;

            $result = $code_data;
            
        } else {
            
            $result = CodeBase::$success;
            
            $result['data'] = $return_data;
        }
        
        //$return_result = $this->checkDataSign($result);
        
        //$return_result['exe_time'] = debug('api_begin', 'api_end');
        
        $return_result = $result;

        //return $return_type == 'json' ? json($return_result) : $return_result;
        return $return_result;
    }

    public function bool_return($ret,$model=null){
        if(!$model){
            $model = $this->user;
        }

        if($ret){
            return $this->apiReturn([],$ret);
        }else{
            return $this->apiReturn(CodeBase::$error,$model->getError());
        }         
    }

}
