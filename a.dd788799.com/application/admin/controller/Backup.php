<?php
namespace app\admin\controller;
use app\admin\Login;
use app\common\model\Backup as BackupModel;
use app\common\model\backup\Order as OrderModel;
use app\common\model\backup\Money as MoneyModel;
use app\common\model\backup\ActionLog as ActionLogModel;
use app\common\model\backup\Apply as ApplyModel;
use app\common\model\backup\BackWater as BackWaterModel;
use app\common\model\backup\Commission as CommissionModel;
use app\common\model\Bonus as BonusModel;
use app\common\model\Type as TypeModel;
use app\common\model\backup\Bet as BetModel;
use app\common\model\backup\BonusFlow as BonusFlowModel;
use app\common\model\backup\Data as DataModel;
//use bong\service\Database;

class Backup extends Login{
    
    public function index(){
        $this->view->page_header = '恢复区';
        
        //$dates = BackupModel::getDates();
        //$this->assign('dates',$dates);

        $businesses = BackupModel::BUSINESS_ARRAY;
        $this->assign('businesses',$businesses);        

        $list = BackupModel::getRecovery();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function restore(){

        try{
            BackupModel::restore(input('table'),input('date'));
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
        $this->success('恢复成功!','backup/index');
    }

    public function clear(){

        try{
            BackupModel::clear(input('table'));
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
        
        $this->success('清理成功!','backup/index');
    }    

    //测试用
    /*
    public function backup(){
        try{
            $date = date('Y-m-d');
            BackupModel::backup($date);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }

        $this->success('备份测试成功!','backup/index');
    }
    */

    public function getDates($table){
        $data = BackupModel::getDates($table);
        $this->success('操作成功!','',$data);
    }

    public  function recharge(){
        $this->view->page_header = '充值订单列表';
        $request = request();
        $list = OrderModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch("order/index");             
    }

    public  function money(){
        $this->view->page_header = '资金列表';
        $request = request();
        $list = MoneyModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch("money/index");            
    } 
    
    public  function bet(){
        $this->view->page_header = '注单列表';
        $request = request();
        $list = BetModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch("bet/index");            
    }

    public  function backwater(){
        $this->view->page_header = '返水列表 ';
        $request = request();
        $list = BackWaterModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch("backwater/index");            
    }

    public  function commission(){
        $this->view->page_header = '分佣列表';
        $request = request();
        $list = CommissionModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch("commission/index");            
    }

    public  function bonus(){
        $this->view->page_header = '红利列表';
        $request = request();
        $list = BonusFlowModel::getList($request);
        $this->assign('list',$list);
        $bonuses = BonusModel::all(['enable'=>1,]);
        $this->assign('bonuses',$bonuses);
        return $this->fetch("bonus/flow");            
    }

    public  function data(){
        $types = TypeModel::allTypes();
        $this->assign('types',$types);
        $request = request();
        $list = DataModel::getList($request);
        $this->assign('list',$list);
        $this->view->page_header = '开奖结果';
        return $this->fetch("backup/data");              
    }

    public  function apply(){
        $this->view->page_header = '提案列表';
        $request    =   request();
        $list = ApplyModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch("apply/index");       
    }

    public  function action(){
        $this->view->page_header = '日志列表';
        $request = request();
        $list = ActionLogModel::getList($request);
        $this->assign('list',$list);
        $this->assign('business_type',ActionLogModel::BUSINESS_TYPES);
        return $this->fetch("help/action_log");            
    }    
}