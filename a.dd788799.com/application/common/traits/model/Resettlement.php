<?php

namespace app\common\traits\model;
use \traits\model\SoftDelete;

trait Resettlement
{
    use SoftDelete;
    protected $deleteTime = 'deleted_at';

    //查询出包括软删除的数据
    public static function getAllList(){
        //$query = self::getListBuild();
        $model = (new static);
        $query = $model->getListBuild([],false);
        return $query->paginate(15);
    }    
}
