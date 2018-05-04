<?php
namespace app\admin\middlewares;
use app\common\model\Admin as AdminModel;
use traits\controller\Jump;
use \think\Session;
use \think\View;
use Closure;
class CheckAuthRule 
{
	use Jump;
	private $menu;
	private $request_path;
	private $menu_group;
	private $menu_list;
	public function handle($request,Closure $next)
	{		
		if(config('app_debug')){
			$this->menu_list = config('menu_list');
			return $next($request);
		}
		$admin	=	AdminModel::get(session('uid'));
		if($admin){
			$admin  = $admin->toArray();
  			if($admin['username'] == 'admin'){
				return $next($request);
		    }else{
	        	$rel = $this->check();
	        	$this->menu_list =  $this->menu['menu_list']? $this->menu['menu_list']:[];
				$this->request_path = '/'.request()->controller().'/'.request()->action();
	            $this->menu_group = $this->get_menu_group($this->menu_list); 
	            \think\View::share(['menu_list'=>$this->menu_list,'request_path'=>$this->request_path,'menu_group'=> $this->menu_group]);
	        	if(!$rel){
	        		$this->error("没有权限访问");
				}
	        }
  		}
  		return $next($request);
	}

	private function check(){
		
		$admin	=	AdminModel::get(session('uid'));
		$info	=	[];
		$rule 	=	[];
		foreach ( $admin->roles as $role) {
        	foreach($role->ruleRoles->toArray() as $val){
        		if(!in_array($val['pivot']['rule_id'],$rule)){
        			$rule[] = $val['pivot']['rule_id'];
        			$info[] = $val;
        		}
        	}
        }
      	if(!empty($info)){
        	$arr		=	$this->channelLevel($info);
        	$munulist	=	[];
	      	if(!empty($arr)){
	      		foreach($arr as $k=>$v){
	      			$munulist['menu_list'][$k]['name'] = $v['name'];
	      			$munulist['menu_list'][$k]['group'] = $v['c'];
	      			if(!empty($v['_data'])){
		      			foreach($v['_data'] as $key=>$val){
		      				$munulist['menu_list'][$k]['sub_menu'][$key]['name'] = $val['name'];
		      				$munulist['menu_list'][$k]['sub_menu'][$key]['link'] = '/'.$val['c'].'/'.$val['a'];
		      			}		
	      			}
	      			
	      		}
	      	}
	     	$this->menu = $munulist;
	      	foreach($info as $key=>$val){
	        	if(request()->controller() == $val['c'] && request()->action() == $val['a']){
	        		return true;
	        	}
			}

        }else{
        	session(null);
       		cookie(null,config('cookie.prefix'));
       		$this->error("你还没有任何权限,请联系管理员添加",'/index/login');
        	exit;
        }
        if(in_array(request()->controller(),['Index']) && in_array(request()->action(), ['logout'])){
	        return true;
	    }
     	return false;
    } 
    //获得权限的菜单列表
    private function channelLevel($data, $pid = 0, $level = 1){
        if (empty($data)) {
            return array();
        }
        $arr = array();
        foreach ($data as $v) {
            if ($v['pid'] == $pid) {
                $arr[$v['id']] = $v;
                $arr[$v['id']]['_level'] = $level;
                if($level < 2){
                	$arr[$v['id']]["_data"] = $this->channelLevel($data, $v['id'],$level + 1);
                }
             	
            }
        }
        return $arr;
    } 

    private function get_menu_group(){
    
        foreach ($this->menu_list  as $menu) {
        	if(!empty($menu['sub_menu'])){
        		foreach ($menu['sub_menu'] as $submenu) {
        			if($this->request_path == $submenu['link']){
	        		    return $menu['group'];
	        		}
    	    	}
        	}
    	  
        }
        return ;
    }
}
