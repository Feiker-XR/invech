<?php
namespace app\home\model;
use app\base\model\BaseModel;
/**
 * 操作记录
 */
class ContentArticleModel extends BaseModel {


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
    public function getContentById($id) {

        $data = $this->table('content_article')
            ->where(['content_id'=>$id])
            ->find();
        return $data ;
    }


}
