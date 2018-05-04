<?php
namespace app\common\model;
use think\Model;

class HelpCat extends Base{

    protected $table = 'gygy_help_cat';
    //protected $createTime = 'created_at';
    //protected $updateTime = 'updated_at';
    //protected $autoWriteTimestamp = 'datetime';

    public static function getList(){

        $params = request()->param();
        
        $query = self::order('id');

        if($params['type']??null){
           $query->where('tag', 'like', '%'.$params['type'].'%');
        }

        $data = $query->paginate(10);
        
        return $data;
    }

    public function helps()
    {
        return $this->hasMany('Help','cat_id')->where('enable',1);
    }  
    public static  function allHelpCat($type=""){
        $help_cat = cache('gygy_help_cat');
        if(!$help_cat){
            $help_cat = self::all(['enable'=>1]);
            $help_cat_map = [];
          
            foreach ($help_cat as $help) {
                $info = $help->toArray();
                 $help_cat_map[$help->id]['cat_name'] = $info['name'];
                 $help_cat_map[$help->id]['cat_id'] = $info['id'];
                foreach ($help->helps as $val) {
                    $help_cat_map[$help->id]['help'][$val->id]['title'] = $val->title;
                    $help_cat_map[$help->id]['help'][$val->id]['id'] = $val->id;
                 
                }
               
             }

         
            $help_cat = $help_cat_map;
            cache('gygy_help_cat',$help_cat);
     }

        return $help_cat;  
              
    }

    public static function getAll(){
        $query = self::order('id');
        $data = $query->select();
        $list =[];
        foreach($data as $k=>$v){
            $list[$v['id']] = $v;

        }
        return $list;
    }  
}
