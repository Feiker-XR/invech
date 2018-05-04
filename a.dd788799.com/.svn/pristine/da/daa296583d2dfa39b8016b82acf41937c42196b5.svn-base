<?php
namespace app\common\model;
use think\Model;

use app\common\model\HelpCat as HelpCatModel;

class Help extends Base{

    protected $table = 'gygy_help';
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $autoWriteTimestamp = 'datetime';

    public static function getList(){
        $params = request()->param();
        $query = self::order('id');
        if($params['type']??null){
           $query->where('tag', 'like', '%'.$params['type'].'%');
        }
        $data = $query->paginate();
        return $data;
    }

    public function helpCat()
    {
        return $this->belongsTo('HelpCat','cat_id')->where('enable',1);
    }    

}
