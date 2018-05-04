<?php
namespace app\common\model;
use think\Model;
use bong\service\Database;

class Backup extends Base{

    protected $table = 'gygy_backup';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    CONST BUSINESS_ARRAY = [
        /*
        'gygy_money' => '资金流水',
        'gygy_orders' => '充值流水',
        'gygy_apply' => '提案申请',
        'gygy_bets' => '投注流水',
        'gygy_backwater' => '返水流水',
        'gygy_bonus_flow' => '红利流水',
        'gygy_action_log' => '操作日志',
        'gygy_data'  => '开奖结果',
        'gygy_commission' => '佣金流水',
        */
        'gygy_config' => '测试一',
        'gygy_config_bak' => '测试二',          
    ];

    CONST TABLE_ARRAY = [
        /*
        'gygy_money',
        'gygy_orders',
        'gygy_apply',
        'gygy_bets',
        'gygy_backwater',
        'gygy_bonus_flow',
        'gygy_action_log',
        'gygy_data',                        
        //'gygy_commission',月结,N年内不用备份;  
        */      
        'gygy_config',
        'gygy_config_bak',          
    ];

    public static function getRecovery(){

        $backups = self::order('date')->where('is_recovery',1)->select();

        $backup_map = [];
        foreach (self::TABLE_ARRAY as $table) {
            $backup_map[$table] = [];
            $backup_map[$table]['business'] = self::BUSINESS_ARRAY[$table];
        }
        foreach ($backups as $backup) {
            $backup_map[$backup->tablename]['date'][] = $backup->date;
        }
        foreach($backup_map as &$item){
            if(isset($item['date'])){
                $item['date'] = implode(',',$item['date']);
            }
        }

        return $backup_map;

    }

    public static function restore($table,$date){

        $backup = self::where('tablename',$table)
        ->where('date',$date)->where('is_recovery',1)->find();
        if($backup){
            throw new \Exception('所选数据段已经在数据库恢复区中!');
        }        

        return transaction(function() use ($table,$date){            
            self::recovery($table);
            $database = new Database(); 
            return $database->import($table,$date,'_tmp');            
        });

    }

    public static function clear($table){

        if(!in_array($table,self::TABLE_ARRAY)){
            throw new \Exception('参数不合法!');
        }

        $backups = self::where('tablename',$table)->where('is_recovery',1)->select();
        if(empty($backups)){
            throw new \Exception('数据库恢复区中没有数据可清理!');
        }

        return transaction(function() use ($table){
            self::recovery($table,false);
            $tmp_table = $table . '_tmp';
            return db()->setTable($tmp_table)->where('1=1')->delete();
        });
    }

    public static function backup($date,$tables=[],$date_f=null,$date_t=null){

        foreach ($tables as $table) {
            if(!in_array($table,self::TABLE_ARRAY)){
                throw new \Exception('参数不合法!');
            }
        }
        if(empty($tables)){
            $tables = self::TABLE_ARRAY;    
        }

        $date_f = $date_f??date('Y-m-d');
        $date_t = $date_t??date('Y-m-d');

        return transaction(function() use ($tables,$date,$date_f,$date_t){
            
            $database = new Database();

            foreach ($tables as $table) {   

                $exists = self::where('date',$date)->where('tablename',$table)->find();

                //再次备份,生成空数据的备份文件 覆盖 原来有数据的备份文件
                if($exists || $database->exists($date,$table)){
                    throw new \Exception('不能重复备份文件!');    
                }

                $ret = self::create([
                    'tablename' => $table,
                    'date' => $date,
                    'date_from'=>$date_f,
                    'date_to'=>$date_t, 
                ]);
                $where = [];
                $where['created_at'] = ['between' , [$date_f.' 00:00:00',$date_t.' 23:59:59'],];
                $ret = $database->backup($date,$table,$where);        
            }      
        });
     
    }

    public static function recovery($table,bool $recovery = true){
        $recovery = (int)$recovery;
        return self::where('tablename',$table)->update(['is_recovery'=>$recovery]);    
    }
    
    public static function getDates($table=null){        
        //$database = new Database(); 
        //return $database->getDates();
        $query = (new static)->db();
        if(!is_null($table)){
            $query->where('tablename',$table);
        }
        return $query->where('is_recovery',0)->column('date');
    }

}
