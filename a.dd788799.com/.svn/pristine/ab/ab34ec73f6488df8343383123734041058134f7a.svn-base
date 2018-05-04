<?php
namespace app\common\model;
use think\Db;
use think\Model;

use app\common\traits\model\UserFlow;

use app\common\model\report\DailyMakerTrait;
//use app\common\model\attach\MoneyRecordTrait;
use app\common\model\report\CommonForFlowTrait;
use app\common\model\report\DailyAndMonthForFlowTrait;
//use app\common\model\report\GlobalUserFromFlowTrait;
//use app\common\model\report\GlobalAgentFromFlowTrait;
use app\common\model\report\GlobalFromFlowTrait;

class Bet extends Base{

    protected $table = 'gygy_bets';
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $autoWriteTimestamp = 'datetime';
    
    use UserFlow;
    use DailyMakerTrait;
    use CommonForFlowTrait,DailyAndMonthForFlowTrait;
    use /*GlobalUserFromFlowTrait,GlobalAgentFromFlowTrait,*/GlobalFromFlowTrait;

    public function money()
    {
        return $this->morphMany('Money',['type','item_id']);
    }

    public function getBetMoneyAttr($value)
    {        
        //快钱玩法和官方玩法的投注金额算法一样
        return $this->data['mode'] * $this->data['beiShu'] * $this->data['actionNum'];
    }

    public function getWinMoneyAttr($value)
    {        
        if($this->data['lotteryNo']){
            return $this->data['bonus'] - $this->bet_money;
        }else{
            return 0;
        }        
    }

    public function getLotteryTimeAttr($value)
    {        
        if($this->data['kjTime'] >0 ){
            return date('Y-m-d H:i:S',$this->data['kjTime']);
        }else{
            return '';
        }
    }

    //----------------前台------------------
    public function types(){
           return $this->belongsTo('Type','type','id');
    }

    public function played(){
        return $this->belongsTo('Played','playedId','id');
    }

/*
    public function user()
    {
        return $this->belongsTo('Member','uid','uid');
    }
*/


    public static function attachToSelfRequest(&$query,$params=[]){

        $params = request()->param();

        if(isset($params['type']) && is_numeric($params['type'])){
            $query->where('x.type', $params['type']);
        }
        if(isset($params['playedId']) && is_numeric($params['playedId'])){
            $query->where('x.playedId', $params['playedId']);
        }        
    }   

    public static function getQlist($request){
        $params =   $request->param();
        $query  =   self::order('id desc');
        if(isset($params['type']) && is_numeric($params['type'])){
            $query->where('type',$params['type']);
        }
       
        if($params['startTime']??''){  
            $query->where('created_at', '>=', $params['startTime']);          
        }
        if($params['endTime']??''){
            $query->where('created_at', '<=', $params['endTime']);
        }
        $query->where('uid',$request->user()->id);
        $options = $query->getOptions();
        $data   =   [];
        $tz     =   $query->options($options)->sum('case when lotteryNo !="" then actionNum*mode*beiShu else 0 end'); //投注
        $cha    =   $query->options($options)->sum('case when lotteryNo !="" then bonus*zjCount-actionNum*mode*beiShu else 0 end'); 
        $data['list']       =   $query->options($options)->paginate();
        $data['tz']         =   $tz?$tz:0;
        $data['cha']        =   $cha?$cha:0;
        $Pagetz = $Pagecha = 0;
        foreach ($data['list'] as $k=>$v){
            if(!empty($v->lotteryNo)){
                $Pagetz      =  bcadd($Pagetz,bcmul(bcmul($v->actionNum,$v->mode,2),$v->beiShu,2),2);
                $Pagecha     =  bcadd($Pagecha,bcsub(bcmul($v->bonus,$v->zjCount,2),bcmul(bcmul($v->actionNum,$v->mode,2),$v->beiShu,2),2),2);
                $data['list'][$k]['cha'] = bcsub(bcmul($v->bonus,$v->zjCount,2),bcmul(bcmul($v->actionNum,$v->mode,2),$v->beiShu,2),2);
            }else{
                $Pagetz     +=  0;
                $Pagecha    +=  0;
                $data['list'][$k]['cha'] = "";
            }
        }

        $data['Pagetz']     =  $Pagetz;
        $data['Pagecha']    =  $Pagecha;
        return $data;
    }
    

    //----------------后台------------------
    public function scopeSsc($query){return $query->where('type',1);}

    //----api----
    protected $append = ['lottery_title','played_name',
    'bet_money','win_money','lottery_time','username'];
    protected $visible = ['id','actionData','lotteryNo','fanDian','fanDianAmount','bonus','created_at', ];    
    //protected $hidden = ['user','types','played',];

    public function getLotteryTitleAttr($value,$data){
        return $this->types->title;
    } 
    public function getPlayedNameAttr($value,$data){
        return $this->played->getAttr('name');
    }    
}
