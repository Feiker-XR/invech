<?php
namespace app\common\model;

use app\common\traits\model\UserFlow;
use app\common\traits\model\Resettlement;

class BetLottery extends Base{

    protected $table = 'gygy_bet_lottery';
    
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';    

    use UserFlow,Resettlement;

    public function bet(){
        return $this->belongsTo('Bet','bet_id','id');
    }

    //
    public static function attachToSelfRequest(&$query,$params=[]){

        $status = $params['status']??'';
        if(is_numeric($status)){
            if($status == 0){//未撤销
                $field = (new static)->getDeleteTimeField(true);
                $query->useSoftDelete($field);                
            }
            if($status == 1){//已撤销
                $field = (new static)->getDeleteTimeField(true);
                $query->useSoftDelete($field, ['not null', '']);
            }        
        }

        $type = $params['type']??'';
        $phase = $params['phase']??'';
        if(is_numeric($type) || $phase){
            $subsql = db()->table('gygy_bets')
                    ->field('id,type,actionNo')->buildSql();
            $query->join([$subsql=> 'b'], 'b.id = x.bet_id');                  
            if($type){
                $query->where('type',$type);
            }
            if($phase){
                $query->where('actionNo',$phase);
            }
        }

        $query->with('bet');
    }

/*
    //protected $visible = ['id','status'];
    protected $append = ['status_text','msg_sender','msg_title','msg_text','msg_sendtime',];
    protected $hidden = ['message',];
*/
    
}
