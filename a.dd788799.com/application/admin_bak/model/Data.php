<?php
namespace app\admin\model;
use think\Model;

/**
 *开奖数据表模型
 * @author mack
 */
class Data extends Model {

    /**
     * 根据开奖期号，获取开奖数据
     * @param $actionNo
     */
    public function getOneByActionNo($actionNo)
    {
       return $this->where('number',$actionNo)->find();
    }

}
