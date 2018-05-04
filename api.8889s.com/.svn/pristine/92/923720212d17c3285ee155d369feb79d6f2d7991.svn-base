<?php
namespace app\model;

use think\Model;
class msg extends Model{
    protected $table = 'k_user_msg';
    
    public function msg_add($uid,$from,$title,$info){
        $data = array(
            'uid'       => $uid,
            'msg_from'  => $from,
            'msg_title' => $title,
            'msg_info'  => $info,
        );
        return $this->insert($data);
    }
    
}