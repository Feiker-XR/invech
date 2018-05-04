<?php
namespace app\common\model;

use app\common\traits\model\MyTable;

class LotteryData extends Base{

    use MyTable;

    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    protected $table = 'gygy_lottery_data';

    protected static $id_table = 'gygy_lottery_data_id';    
    protected $prefix = 'gygy_lottery_data';
    protected $prefix_db = 'lottery_data';

    //      phase,data
    //code ,number,data,

    public function getNumberAttr($value)
    {
        return $this->data['phase'];
    }

    public function setNumberAttr($value,$data)
    {
        return $this->data['phase'] = $value;
    }

    public function getQishuAttr($value)
    {
        return $this->data['phase'];
    }

    public function setQishuAttr($value,$data)
    {
        return $this->data['phase'] = $value;
    }    

    public static function getByCodeAndPeriod($code,$period){
        $query = (new static)->db(true,false);
        
        $query->where('code',$code)->where('phase',$period);
   
        return $query->find();
    }

    public static function addApiData($lottery){
        
        if( !( isset($lottery['type']) && isset($lottery['period']) && isset($lottery['number']) ) ){
            throw new \Exception('API数据格式有误!');
        }
        
        $data = [
            'code'  =>  $lottery['type'],
            'phase' =>  $lottery['period'],
            'data'  =>  $lottery['number'],
        ];

        return self::create($data);
    }

    public function getBetBuild(){
        
        $types = Type::nameMaps();
        $type = $types[$this->code];//彩种对象,不用动态属性避免查询

        $query = Bet::where('type',$type->id)
                ->where('actionNo',$this->number)
                ->where('lotteryNo','');
        return $query;
    }
}
