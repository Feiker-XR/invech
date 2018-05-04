<?php
namespace app\admin\controller;
use app\admin\Login;
class notice extends Login{
    
    protected $noticeType = ['0' => '首页公告','1'=>'体育公告','2'=>'彩票公告','3' => '真人公告','888' => '代理公告'];
    
    public function index($type = 0){
        if(!in_array($type,array_keys($this->noticeType))){
            $this->error('类型错误!');
        }
        $notice = new \app\model\notice();
        $notices = $notice->where('is_class' , $type)->order('end_time desc')->paginate(20);
        $this->assign('notices',$notices);
        $this->assign('typelist',$this->noticeType);
        return $this->fetch('index');
    }
    
    
    public function save(){
        $id = $_POST['nid'];
        $notice = new \app\model\notice();
        if($id){
            $status = $notice->allowField(true)->save($_POST,['nid' => $id]);
        }else{
            $status = $notice->allowField(true)->save($_POST);
        }
        if($status){
            $this->success('处理成功!');
        }else{
            $this->error('处理失败!');
        }
    }
    
    public function edit($id = 0){
        $notice = new \app\model\notice();
        $info = $notice -> get($id);
        $this->assign('info',$info);
        $type = $info['is_class'];
        $notices = $notice->where('is_class' , $type)->order('end_time desc')->paginate(20);
        $this->assign('notices',$notices);
        $this->assign('typelist',$this->noticeType);
        return $this->fetch('edit');
    }
    
    public function delete($id = 0){
        $notice = new \app\model\notice();
        $return = $notice->get($id)->delete();
        if($return){
            $this->success('处理成功!');
        }else{
            $this->error('处理失败!');
        }
        
    }
    
    public function type(){
        
    }
    
    
}