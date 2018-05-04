<?php
namespace app\home\model;
use app\base\model\BaseModel;
/**
 * 操作记录
 */
class ContentModel extends BaseModel {


    protected $_auto = array (
//        array('time','time',1,'function'),
//        array('ip','get_client_ip',1,'function'),
//        array('app',APP_NAME,1,'string'),
//        array('user_id',ADMIN_ID,1,'string'),
        
     ) ;

    /**
     * 获取列表
     * @return array 列表
     */
    public function loadList($where = array(), $limit = 1) {
        $data = $this->table('content')
            ->field('content_id,title,time,description,image,views')
            ->where($where)
            ->limit($limit)
            ->order("content_id DESC")
            ->select();
        return $data ;
    }

    /**
     * 统计总条数
     */
    public function countRecord($limit=10,$where=array())
    {
        $res = $this->table('content')
            ->field('content_id')
            ->where($where)
            ->count();
        return ceil(bcdiv($res,10,1)) ;
    }


    /**
     * 添加信息
     * @param string  增加数据
     * @return bool 更新状态
     */
    public function addData($data){
        if (!empty($data)) {
            $data = $this->create($data);
            return $this->add($data);
        }
    }


}
