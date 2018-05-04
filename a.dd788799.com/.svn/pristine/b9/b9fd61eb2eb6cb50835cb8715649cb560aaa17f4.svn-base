<?php
namespace app\common\model;
use think\Model;

class MemberLevel extends Base{
    protected $table = 'gygy_member_level';
    protected $pk = 'id';

    public function setIdAttr($value){
        return $this->data['id'] = $value;
    }

    public function getIdAttr($value)
    {
        return $this->data['id'];
    }

    //----------------后台------------------

    public static function getList(){    
        $params = request()->param();
        $query = self::order('id');
        $data = $query->paginate();
        return $data;
    }	
    
}
