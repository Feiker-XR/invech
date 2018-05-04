<?php
namespace app\admin\controller;
use app\admin\Login;
use app\common\model\Apply as ApplyModel; 
use app\common\model\Config;
use app\common\model\ActionLog as LogModel;
class Apply extends Login{

    public function _initialize(){
        parent::_initialize();
        $classname = ApplyModel::class;
        foreach (ApplyModel::BUSINESS_ARRAY as $business) {
            $event = 'audit.'.$business;
            $handle = $classname . '@audit' . ucfirst($business);
            container('events')->listen($event,$handle); 
        }
    }  

    public function index(){
        $this->view->page_header = '提案列表';
        $request    =   request();
        $list = ApplyModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch();  
    }

/*    public function agent(){
        $this->view->page_header = '代理申请';
        $list = ApplyModel::agent()->paginate();
        $this->assign('list',$list);
        return $this->fetch();        
    }

    public function withdraw(){
        $this->view->page_header = '提现申请';
        $list = ApplyModel::withdraw()->paginate();
        $this->assign('list',$list);
        return $this->fetch();        
    }*/

    public function detail($id){
        $info           =   ApplyModel::get($id);
        $auditLimit     =   Config::getByName('auditLimit');
        $this->assign('auditLimit',$auditLimit); 
        $this->assign('info',$info); 
        return view('apply/detail_'.$info->business);
    }

    public function apply_detail($id){
        $info           =   ApplyModel::get($id);
        $auditLimit     =   Config::getByName('auditLimit');
        $this->assign('auditLimit',$auditLimit); 
        $this->assign('info',$info); 
        return view('apply/apply_detail_'.$info->business);
    }

    public function audit(){

        $apply  = ApplyModel::get(input('id/i'));
        $agree  = input('agree/i');
        $remark = input('remark');
        if($agree){
           $rel = $this->user->agree_audit($apply,$remark); 
        }else{
           $rel = $this->user->deny_audit($apply,$remark);  
        }
        if($rel){
            LogModel::log(LogModel::BUSINESS_TYPE_EDIT,$apply,LogModel::BUSINESS_TYPES[LogModel::BUSINESS_TYPE_EDIT]);
            return $this->success('操作成功');
        }else{
            return $this->error('操作失败');
        }
    }
    //清空稽核量
    public function chage_audit(){
        $info   =   ApplyModel::get(input('id/i'));
        $rel    =   $info->user->save(['audit_flow'=>0]);
        if($rel){
            LogModel::log(LogModel::BUSINESS_TYPE_EDIT,$info,LogModel::BUSINESS_TYPES[LogModel::BUSINESS_TYPE_EDIT]);
            return $this->success('操作成功');
        }else{
            return $this->error($info->getError());
        }
        
    }
    
}