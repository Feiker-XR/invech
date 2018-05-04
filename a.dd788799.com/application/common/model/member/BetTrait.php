<?php
namespace app\common\model\member;

use app\common\model\Bet;
use app\common\model\Config;
use bong\foundation\Str;

trait BetTrait
{
    //-------------前台----------------
    public function bet($code,$remark){        
        unset($code['plid']);
        $code['wjorderId'] = $code['type'] . $code['playedId'] . Str::random(8 - strlen($code['type'] . $code['playedId']));
        $bet = Bet::create($code);

        $money = $code['actionNum'] * $code['mode'] * $code['beiShu'];
        $this->decBalance($money,'bet',$bet->id,$remark);

        $betFlowRate = Config::getByName('betFlowRate');
        $audit = $betFlowRate * $money;
        $this->decAuditFlow($audit);   
    }
}
