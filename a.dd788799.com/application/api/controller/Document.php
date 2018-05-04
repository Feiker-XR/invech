<?php

namespace app\api\controller;
use app\api\Base;
use app\common\model\ApiGroup as ApiGroupModel;
use app\common\model\Api as ApiModel;

class Document extends Base{
    
    public function _initialize(){
        parent::_initialize();
        config('default_return_type','html');            
    }


    public function index(){
    	$groups = ApiGroupModel::with('apis')->order('sort')->select();
    	$errors = $this->getErrorCode();

    	$this->assign('groups',$groups);
    	$this->assign('errors',$errors);

        $content = $this->fetch('content_default');
        $this->assign('content', $content);

        $remark = $this->fetch('content_remark');
        $this->assign('remark', $remark);

        return $this->fetch();
    }


	protected function getErrorCode(){
		$path = APP_PATH.'/api/error';
		$file_list  = file_list($path);
        $code_data = [];
        
        foreach ($file_list as $v)
        {
            
            $class_path = '\\app\\api\\error\\';
            $class_name = str_replace(EXT, '', $v);

            
            $ref = new \ReflectionClass($class_path . $class_name);

            $props = $ref->getStaticProperties();
            
            foreach ($props as $k => $v)
            {

                $data['class']          = $class_name;
                $data['property']       = $k;
                $data[API_CODE_NAME]    = $v[API_CODE_NAME];
                $data[API_MSG_NAME]     = $v[API_MSG_NAME];
                
                $code_data[] = $data;
            }
        }
        
        return $code_data;		
	}

	public function details($id=0){


        $api = ApiModel::get($id);        
        $this->assign('api', $api);

        $request_data = $this->apiAttachField($api);
        $this->assign('request_data', $request_data);

/*
        $method = ($api->request_type==0)?'post':'get';
        $method = 'param';
        $param = ['username'=>'leon2017','password'=>'123456',];
        $param = ['username'=>'aaa666','password'=>'123456',];   //uid=312
        //md5('123456') == e10adc3949ba59abbe56e057f20f883e      
        $method_data = $this->request->$method($param);
        $ret = action('pub/login');//        
        //$ret = container('auth')->guard('jwt')->attempt($param);//与action函数等效;
        $api_token = $ret['data'];
*/             

        $access_token = get_access_token();
        $this->assign('access_token', $access_token);        
        
        $data_type = config('api.data_type');
        $this->assign('data_type',$data_type);

        $content = $this->fetch('content_template');
        if ($this->request->isAjax()) {            
            return ['content' => $content];
        }
        
        $this->assign('content', $content);
        
        $groups = ApiGroupModel::with('apis')->select();
        $this->assign('groups', $groups);        
        return $this->fetch('index');        
	}



    private function apiAttachField($api)
    {
        $request_data = $api->request_data ?? [];

        if ($api->is_page??0)
        {
            $page_attach_field = config('api.page_attach_field');
            
            foreach ($page_attach_field as $field) {
                
                array_unshift($request_data, $field);
            }
        }
        /*暂时不要数据签名,只要访问秘钥access_token
        if($api->is_request_sign??0){
            array_unshift($request_data,   config('api.data_sign_attach_field'));
        }              
        if($api->is_response_sign??0){
            array_unshift($request_data,   config('api.data_sign_attach_field'));
        }              
        */
        if($api->is_user_token??0){
            array_unshift($request_data,   config('api.user_token_attach_field'));
        }

        array_unshift($request_data, config('api.access_token_attach_field'));        
        
        return $request_data;
    }	
}