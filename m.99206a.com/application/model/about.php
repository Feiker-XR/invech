<?php
namespace app\model;
use think\Model;
class about extends Model{
    protected  $table = 'web_about';
    
    public function getList($ids = ''){
        return $this->all([1,2,3,4,5,6]);
    }
}