<?php
namespace app\common\model\admin;

use app\common\model\Perm;
use app\common\model\Role;

trait PolicyTrait
{
    //CONST ROOT_ID = 1;//trait不可定义常量
	private $root_id = 1;
    private $admin_role_id = 1;

    //超级管理员
    public function isRoot(){
        return $this->id === $this->root_id;
    }   

    //普通管理员
    public function isAdmin(){
        return $this->role_id === $this->admin_role_id;
    }

    //用户策略
    public function isManagerOf($admin){
        //根用户
        if($this->isRoot()){
            return true;
        }

        //管理员可以添加后台用户
        $id = $admin->id ?? 0;
        if($this->isAdmin() && !$id){
            return true;
        }

        //管理员可以操作其他非管理员用户
        if($this->isAdmin() && !$admin->isAdmin()){
            return true;
        }

        //可以编辑自己;
        if($this->id == $admin->id){
            return true;
        }

        return false;
    }

    public function role(){
      return $this->belongsTo('Role','role_id','id');      
    }

    public function hasPerm($perm)
    {
        if (is_string($perm)) {
            $perm = Perm::where('url',$perm)->find();
            if (!$perm) return false;
        }

        if (is_string($perm)) {
            return $this->role->perms->contains('name', $perm);
        }
        //在think\model\Collection重写think\Collection的intersect函数
        return !!$this->role->perms->intersect(compact('perm'))->count();
    }

    public function getMenu(){

        $policy = container('policy');
        $route_url = CONTROLLER.'/'.ACTION;

        $path_arr = [];
        $tree = [];
        $tree['top'] = [];    

        $menus = Perm::where('is_menu', 1)
        //->whereOr('pid', 0) 首页的pid=0,不是菜单;
        ->order('sort')->select();

        foreach ($menus as $menu) {

            if ($menu->pid == 0 || $policy->check($menu->url)) {
                if ($menu->url == $route_url) {
                    $path_arr[] = $menu->pid;
		    $path_arr[] = $menu->id;
		    $tree['top_menu'] = $menu->top_menu;
		    $tree['sub_menu'] = $menu;
                }
                $tree[$menu->pid][] = $menu;//->toArray();
            }
        }

        //过滤无子菜单的顶级菜单
        foreach ($tree[0] as $menu) {
            if (isset($tree[$menu->id]) && is_array($tree[$menu->id]) 
                && count($tree[$menu->id]) > 0) {
                $tree['top'][] = $menu;
            }
        }
        unset($tree[0]);

        $tree['patharr'] = array_unique($path_arr);
        return $tree;        
    }

    // 给用户分配角色
    public function assignRole(Role $role)
    {
        //$this->role()->associate();
        $this->role()->associate($role)->save();
    }
}
