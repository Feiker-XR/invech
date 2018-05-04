<?php
namespace app\admin\controller;
use app\admin\Login;
use app\common\model\Withdraw as WithdrawModel;
use app\common\model\ActionLog as LogModel;
class Withdraw extends Login{

    public function index(){
        $this->view->page_header = '提款记录';
        $request    =   request();
        $list       =   WithdrawModel::getList($request);
        $this->assign('list',$list);
        $get_status =   input('status');
        if(!is_numeric($get_status)){
            $get_status = -1;
        }
        $this->assign('get_status',$get_status);
        return $this->fetch();
    }

    public function edit(){
        $request    =   request();
        $params     =   $request->param();
        if(request()->isGet()){
            if(!empty($params['id'])){
                $info   =  WithdrawModel::get(['id'=>$params['id']]);
                $this->assign('info',$info);  
            }
            return view();    
        }else{
            $id     =   !empty($params['id'])? $params['id']:'';
            if($id){
                $Withd  =   WithdrawModel::get(intval($id));
                $Withd->data('handled_at',date("Y-m-d: H:i:s",time()));
                $list   =   $Withd->save($params);
                if($list){
                    LogModel::log(LogModel::BUSINESS_TYPE_EDIT,$Withd,LogModel::BUSINESS_TYPES[LogModel::BUSINESS_TYPE_EDIT]);
                    return $this->success('操作成功');
                }else{
                    return $this->error($Withd->getError());
                }    
            }
            return $this->error("编辑错误");
        } 
        
    }

}