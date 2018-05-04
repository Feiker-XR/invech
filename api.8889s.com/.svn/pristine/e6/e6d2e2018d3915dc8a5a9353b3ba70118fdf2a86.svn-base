<?php 
namespace app\v1;

use think\Controller;
use think\Cache;
use app\model\config;

class Base extends Controller{
    
    protected function _initialize(){
        config('default_return_type','json');

        $cache = new Cache();

        $ipxz = $cache->get('ipxz') ?: [];
        $dqxz = $cache->get('dqxz') ?: [];
        $ip = $this->request->ip();
        //$json = json_decode(file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$ip),true);
        $iplookup = config('iplookup');      
		//$json = json_decode(file_get_contents("{$iplookup}?format=json&ip=".$ip),true);        
        $region = isset( $json['province']) ? $json['province'] : '';
        if(in_array($ip,$ipxz)){
            exit('您的IP'.$ip.'不在我们的服务范围内') ;
        }
        foreach ($dqxz as $v){
            if($region){
                if(strstr($region, $v) || strstr($v,$region)){
                    exit('您所在的地区:"'.$region.'"不在我们的服务范围内!');
                }
            }
        }        	
        
        //$cache::rm('sysConfig');
        $sysConfig = $cache->get('sysConfig');
        if(!$sysConfig){
            $config = new config();
            $sysConfig = $config->get(1)->getData();
            $cache->set('sysConfig',$sysConfig);
        }
        if($sysConfig['close']){
            exit($sysConfig['why']);
        }

        $view_path = APP_PATH.$this->request->module().DS.'mview'.DS;
        $this->view->config('view_path',$view_path);
    }

    //重写trait jump的error
    protected function api_error($msg = '', $url = NULL, $data = '', $wait = 3, array $header = []){
    	return ['status'=>1,'msg'=>$msg,'data'=>null,];
    }

    //api 自定义返回
    protected function api_custom($info=[],$data=null) {
        if (empty($info)) {
            $info['status'] = 1 ;
            $info['msg'] = '' ;
        }
        return ['status'=>$info['status'],'msg'=>$info['msg'],'data'=>$data,];
    }

    protected function api_success($data=null,$msg='success')
    {
    	return ['status'=>0,'msg'=>$msg,'data'=>$data,];
    }  


    //api处理重定向,不是用header重定向,而是返回html格式的get表单
/*
    protected function location($gateway, $method = 'get', $charset = 'utf-8'){
        return $this->form([],$gateway,$method,$charset);
    }
*/
    protected function location($url){
    	$sHtml = "<script>location.href='".$url."';</script>";
        return $sHtml;        
    }    


    /**
     * 表单方式
     */
    protected function form($params, $gateway, $method = 'post', $charset = 'utf-8') {
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
        header("Content-type:text/html;charset={$charset}");
        $sHtml = "<form id='paysubmit' name='paysubmit' action='{$gateway}' method='{$method}'>";

        foreach ($params as $k => $v) {
            $sHtml.= "<input type=\"hidden\" name=\"{$k}\" value=\"{$v}\" />\n";
        }
        //$sHtml .= "<input type='submit' />";

        $sHtml = $sHtml . "</form>正在跳转 ...";

        $sHtml = $sHtml . "<script>document.forms['paysubmit'].submit();</script>";
        return $sHtml;
    }

}
