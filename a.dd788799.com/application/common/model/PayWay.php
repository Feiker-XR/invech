<?php
namespace app\common\model;
use think\Model;
class PayWay extends Base{

	
    protected $table = 'gygy_pay_way';
    protected $pk = 'id';
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $autoWriteTimestamp = 'datetime';
/*
    public function setIdAttr($value){
        return $this->data['id'] = $value;
    }

    public function getIdAttr($value)
    {
        return $this->data['id'];
    }
*/
    //----------------后台------------------
    public static function getList(){
        $params = request()->param();
        $query  = self::order('id desc');
         if($params['keywords']??''){
            $query->where('name|code','like','%'.trim($params['keywords']).'%'); 
        }
        if($params['set_id']??''){
            $query->where('set_id',$params['set_id']);
        }
        return $query->paginate();
    }
    
    public function set(){
        return $this->belongsTo('PaySet','set_id','id');
    }

    //-------------------api-------------------

    //------------------关联-------------------
    public function payChannels()
    {
        return $this->hasMany('PayChannel','way_id')->where('status',0)        
        ->order('third_id')->field('third_id,way_id,code as pay_code,min,max');
        //->field('thirdid');//需要set_configid属性才做预加载        
    }
}
