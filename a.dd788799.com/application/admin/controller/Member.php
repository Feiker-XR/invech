<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Cache;
use app\common\model\Member as UserModel;
use app\common\model\MemberLevel as LevelModel;
use bong\service\JsonExtra;
use app\common\model\ActionLog as LogModel;
class Member extends Login{

    public function index(){
        $this->view->page_header    =   '会员列表';
        $request    =   request();
        $list       =   UserModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function edit(){
        $request    =   request();
        $params     =   $request->param();   
        if(request()->isGet()){
            if(!empty($params['uid'])){
                $info   =   UserModel::get(['uid'=>$params['uid']]);
                $this->assign('info',$info);  
            }
            return view();
        }else{
            $uid            =   !empty($params['uid'])? $params['uid']:'';
            $bank_name      =   !empty($params['bank_name'])? $params['bank_name']:'';
            $bank_username  =   !empty($params['bank_username'])? $params['bank_username']:'';
            $bank_account   =   !empty($params['bank_account'])? $params['bank_account']:'';
            $bank_address   =   !empty($params['bank_address'])? $params['bank_address']:'';
            if($uid){
                $member     =   UserModel::get(intval($uid));
                $member->bank->bank_name        =   $bank_name;
                $member->bank->bank_username    =   $bank_username;
                $member->bank->bank_account     =   $bank_account;
                $member->bank->bank_address     =   $bank_address;
                $list = $member->validate('Member.edit')->save($params);
            }else{
                $member = new UserModel($params);
                $member->data('bank','');
                $member->bank->bank_name        =   $bank_name;
                $member->bank->bank_username    =   $bank_username;
                $member->bank->bank_account     =   $bank_account;
                $member->bank->bank_address     =   $bank_address;
                $list =  $member->register($request);
            }
            if($list){
                LogModel::log(LogModel::BUSINESS_TYPE_EDIT,$member,LogModel::BUSINESS_TYPES[LogModel::BUSINESS_TYPE_EDIT]);
                return $this->success('操作成功');
            }else{
                return $this->error($member->getError());
            }
        }
    }

    public function del(){
        $request    =   request();
        $params     =   $request->param();
        $member     =   UserModel::get(intval($params['uid']));
        $list       =   $member->delete();
        if($list){
            LogModel::log(LogModel::BUSINESS_TYPE_DELE,$member,LogModel::BUSINESS_TYPES[LogModel::BUSINESS_TYPE_DELE]);
            return $this->success('操作成功');
        }else{
            return $this->error($member->getError());
        }
    }
    
    public function member_level(){
        $this->view->page_header    =   '会员等级';
        $request        =   request();
        $member_level   =   LevelModel::getList($request);
        $this->assign('member_level',$member_level);
        return $this->fetch();
    }
    
    public  function member_level_edit(){  
        $request    =   request();
        $params     =   $request->param(); 
        if(request()->isGet()){
            if(!empty($params['id'])){
                $info   =   LevelModel::get(['id'=>$params['id']]);
                $this->assign('info',$info);  
            }
            return view();              
        }else{
            $id     =   !empty($params['id'])? $params['id']:'';
            if($id){
                $member_level   =   LevelModel::get(intval($id));
            }else{
                $member_level   =   new LevelModel();    
            } 
            $list   =   $member_level->validate('Member.level')->save($params);
           
            if($list){
                LogModel::log(LogModel::BUSINESS_TYPE_ADD,$member_level,LogModel::BUSINESS_TYPES[LogModel::BUSINESS_TYPE_ADD]);
                return $this->success('操作成功');
            }else{
                return $this->error($member_level->getError());
            }
        }
        
    }

    public function member_level_del(){
        $request    =   request();
        $params     =   $request->param();
        $member_level   =  LevelModel::get(intval($params['id']));
        $list   =   $member_level->delete();
        if($list){
            LogModel::log(LogModel::BUSINESS_TYPE_DELE,$member_level,LogModel::BUSINESS_TYPES[LogModel::BUSINESS_TYPE_DELE]);
            return $this->success('操作成功');
        }else{
            return $this->error($member_level->getError());
        }
    }
     
}