<?php
namespace app\v1\model;
use think\Model;

/**
 *   时时彩彩种模型
 * @author mack
 */
class  Type  extends Model
{
	
    protected $table = 'gfwf_lottery';

    public function groups()
    {
    	return $this->hasMany('PlayedGroup','type','type')
    	->where('enable',1)->order('sort,id');
    }

    static public function getTypes(){
    	return self::with('groups.playeds')->select()->toArray();
    }

    static public function allTypes($id=''){
    	$types = cache('hg_gfwf_types');
    	if(!$types){
    		
    		//$types = self::where('enable',1)->all();
    		$types = self::all(['enable'=>1]);

    		$types_map = [];
    		foreach ($types as $type) {

    			$groups_map = [];
    			foreach ($type->groups as $group) {
    				
    				$playeds_map = [];
    				foreach ($group->playeds as $played) {
    					$playeds_map[$played->id] = $played->toArray();
                        if($played->tag){
                            $playeds_map['tags'][$played->tag][$played->id] = $played->toArray();
                        }
    				}

    				$groups_map[$group->id] = $group->toArray();
    				$groups_map[$group->id]['playeds'] = $playeds_map;
    			}

    			$types_map[$type->id] = $type->toArray();
    			$types_map[$type->id]['groups'] = $groups_map;

    		}

    		$types = $types_map;
    		cache('hg_gfwf_types',$types);
            cache('hg_gfwf_types_time',time());
    	}

    	if($id){
    		return $types[$id]['groups']??null;
    	}else{
    		return $types;	
    	}    	
    }


}
