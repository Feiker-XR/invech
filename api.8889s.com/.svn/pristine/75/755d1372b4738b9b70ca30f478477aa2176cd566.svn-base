<?php
namespace app\model;
use think\Model;
class level extends Model{
    protected $table = 'k_group';
    public function getList(){
        return db($this->table)->alias('a')->join('k_user b','a.id = b.gid','LEFT')->group('a.id')->column('a.*,count(b.gid) total');
    }
}