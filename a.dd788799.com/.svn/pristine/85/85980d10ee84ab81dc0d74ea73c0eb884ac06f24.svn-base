<?php
namespace app\common\model;
use think\Model;
class AdminGroup extends Base{
	protected $table = 'gygy_admin_group';
        //----------------后台------------------
    public function ruleRoles(){
        return $this->belongsToMany('AdminRule','AuthRule','rule_id','group_id');
    }

    public static function getList(){
        $params = request()->param();
        $query = self::order('group_id');
        $data = $query->paginate();
        return $data;
    }

    public static function getAll(){
        $query = self::order('group_id');
        $data = $query->select();
        $list =[];
        foreach($data as $k=>$v){
            $list[$v['group_id']] = $v;
        }
        return $list;
    }  

}
