<?php
namespace app\agent\controller;
use app\agent\Login;

use app\common\model\Message as MessageModel;
use app\common\model\Member as MemberModel;

class Message extends Login{
    
    public function outbox(){
        $query = $this->user->getOutboxBuilder();
        $list = $query->paginate();
        $this->assign('list',$list);

        $this->view->page_header = '发件箱';
        return $this->fetch();
    }

    //发信
    public function send(){
        if(IS_GET){
            return $this->fetch();
        }else{
            //MessageModel::create
        }
    }

    //收件箱支持软删除,请自行查询文档;
    //getInboxBuilder获取查询构造器,
    public function inbox(){

        $query = $this->user->getInboxBuilder();

        $params = request()->param();
        $status = $params['status']??null;
        if($params&&is_numeric($status)){
            $query->where('status',$status);
        }
        
        //其他条件自行添加
        $list = $query->paginate();
        $this->assign('list',$list);
        
        $this->view->page_header = '收件箱';
        return $this->fetch();
    }
}


