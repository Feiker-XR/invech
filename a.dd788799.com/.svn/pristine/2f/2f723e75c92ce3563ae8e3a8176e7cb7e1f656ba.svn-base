<?php

namespace app\api\controller;
use app\api\Base;

use app\classes\bet;
use app\classes\betC;
use app\classes\betQ;
use app\api\error\CodeBase;
use app\common\model\Type;
use app\common\model\Data;

class Game extends Base
{

    public function types(){
        $id = input('id/i')??0;
        $types = Type::allTypes($id);
        return $this->apiReturn([],$types);     
    }

    public function kqwfpls(){
        $playedId = input('playedId/i')??0;
        $pls = model('played')->kqwfPls($playedId);
        return $this->apiReturn([],$pls);
    }

    public function phase(){
        $type = input('id/i')??0;
        //$types = Type::allTypes();
        $types = Type::getAll();
        if(!isset($types[$type])){
            return $this->apiReturn(CodeBase::$error);
        }
        $lottery = $types[$type];

        //$lastNo = Type::getLastGamePhase($type);
        //$thisNo = Type::getGamePhase($type);
        $lastNo = $lottery->getLastGamePhase();
        $thisNo = $lottery->getGamePhase();

        $time = time();
        $ftime = $lottery->data_ftime;
        $fptime = strtotime($thisNo['actionTime']) - $time - $ftime ;
        $kptime = strtotime($thisNo['actionTime']) - $time ;
        //$thisNo['ftime'] = $ftime;
        $thisNo['fptime'] = $fptime;
        $thisNo['kptime'] = $kptime;

        $data = ['lastNo'=>$lastNo,'thisNo'=>$thisNo,];
        return $this->apiReturn([],$data);
    }

    public function history(){
        $type = input('id/i')??0;
        $types = Type::allTypes();
        if(!isset($types[$type])){
            return $this->apiReturn(CodeBase::$error);
        }

        $data = Data::getHistory($type);
        return $this->apiReturn([],$data);
    }
    
    /*前端自行计算
    private function getPl($played = null)
    {        
        $sql = "select bonusProp, bonusPropBase from {$this->prename}played where id=" . $played;

        $data = db('played')->where('id',$played)
            ->field('is_mix,mix_ids,bonusProp, bonusPropBase')->find();
        if($data['is_mix']){
            $data = db('played')->where('id','in',$data['mix_ids'])
            ->field('bonusProp, bonusPropBase')->select();
            $data = $data->toArray();
        }else{
            $data = [$data];
        }
        return $data;    
    }
    */

    public function postAll(){
        try{
            $error = CodeBase::$error;

            $codes   = input('code/a');
            $para    = input('para/a');
            
            if ($this->settings['switchBuy'] == 0)
                throw new \Exception('本平台已经停止购买！');
            /*
            if ($this->settings['switchDLBuy'] == 0 && $this->user['type'])
                throw new \Exception('代理不能买单！');
            */
            if (count($codes) == 0)
                throw new \Exception('请先选择号码再提交投注');

            $actionTime = $this->getGameActionTime($para['type']);
            $actionNo = $this->getGameActionNo($para['type']); 
            $actionNo_num = doubleval(str_replace('-', '', $actionNo));//数字化

            $actionNos = explode('|', $para['actionNo']);
            foreach ($actionNos as $action_no) {                
                $action_no_num = doubleval(str_replace('-', '', $action_no)); 
                if ($action_no_num < $actionNo_num)
                    throw new \Exception('投注失败：该期投注时间已过'.$action_no_num.'----'.$actionNo_num);              
            }

            $zhuihao = input('zhuiHao');
            if($zhuihao){
                $beishus = explode('|', $para['beishu']);
                if(count($actionNos)!=count($beishus)){
                    throw new \Exception('投注失败：追号期数个数和倍数个数不一致!');
                }
                $liqType  = 102;
                $info     = '追号投注';                
            }else{
                $beishus = [1];
                $liqType  = 101;
                $info     = '投注';                 
            }
            
            // 查检每个注单的数据完整性
            $amount = 0;
            $bets = [];//注单,追号,一个投注内容,对应多个期数,则对应多个注单;
            
            $type = $para['type']??null;
            if(!$type){
                throw new \Exception("请输入彩种ID!");
            }
            $groups = model('type')->allTypes($type);//参数彩种ID
            if(!$groups){
                throw new \Exception("彩种不存在!");                    
            }

            foreach ($codes as $code) {
                $groupId = $code['playedGroup']??null;
                $group = $groups[$groupId]??null;
                if(!$group){
                    throw new \Exception("玩法组不存在!");
                }
                $playedId = $code['playedId']??null;
                $played = $group['playeds'][$playedId]??null;
                if(!$played){
                    throw new \Exception("玩法不存在!");
                }
                if (! $played['enable']){
                    throw new \Exception('玩法已停!');
                }
                
                if ($para['type']!=$code['type']){
                    throw new \Exception('彩种id有误!');
                }

                $actionData = $code['actionData']??'';
                if(is_null($actionData)){
                    throw new \Exception("投注内容不能为空!");
                }    

                if (floatval($code['mode']) <= 0)
                    throw new \Exception('倍数模式必须大于0!');

                if($played['is_kqwf']){
                    $actionData = explode('-',$actionData,2);
                    if(count($actionData)<2){
                        throw new \Exception("投注内容格式错误!");
                    }
                    $plg = $actionData[0];//赔率组
                    $bet = $actionData[1];

                    $plid = $code['plid']??0;//input('plid/d');
                  
                    $pl = model('played_pl')->get($plid);
                  
                    if(!$pl){
                        throw new \Exception("赔率不存在!");
                    }
                    if($plg != $pl->plgroup->name){
                        throw new \Exception("投注内容-赔率组错误!");
                    }

                    if($pl->plgroup->mode == 2){
                        if(count(_arr($bet)) != $pl->value){
                            throw new \Exception("赔率有误!");
                        }
                    }
                    
                    $bonusProp = $code['bonusProp']??0;                
                    if($pl->pl != $bonusProp){
                        throw new \Exception("赔率有误!");
                    }

                    $money = floatval($code['mode']??0);
                    if($money<=0){
                        throw new \Exception("投注额有误!");
                    }

                    $code['beiShu'] = 1;
                    $code['fanDian'] = 0.0;                    
                    $code['flag'] = 0;
                    //$code['mode'] = 2;
                }else{

                    // 检查返点
                    if (floatval($code['fanDian']) > floatval($this->user['fanDian']) || floatval($code['fanDian']) > floatval($this->settings['fanDianMax']))
                    throw new \Exception('返点数据出错，请重新投注!');

                    // 检查赔率
                    if($played['is_mix']){
                        $prop_pairs = db('played')->where('id','in',$played['mix_ids'])->field('bonusProp,bonusPropBase')->select();
                    }else{
                        $prop_pairs = [['bonusProp'=>$played['bonusProp'],
                                        'bonusPropBase'=>$played['bonusPropBase'],],];
                    }
                    $props = explode('|',$code['bonusProp']);
                    if(count($props)!=count($prop_pairs)){
                        throw new \Exception('赔率个数出错，请重新投注!');
                    }
                    foreach($prop_pairs as $key => $pair){
                        $chkBonus = ($pair['bonusProp'] - $pair['bonusPropBase']) / $this->settings['fanDianMax'] * ($this->user['fanDian'] - $code['fanDian']) + $pair['bonusPropBase']; // 实际奖金
                        if ($props[$key] > $pair['bonusProp'])
                            throw new \Exception('赔率出错，请重新投注 -1');
                        if ($props[$key] < $pair['bonusPropBase'])
                            throw new \Exception('赔率出错，请重新投注 -2');
                        if (intval($chkBonus) != intval($props[$key]))
                            throw new \Exception('赔率出错，请重新投注 -3');
                    }
                    
                    // 检查倍数
                    if (intval($code['beiShu']) < 1)
                    throw new \Exception('倍数只能为大于1正整数');                 
                }
                
                $orderId = $code['orderId']??null;
                if(!$orderId){
                    throw new \Exception("订单id不能为空!");
                }

                // 检查注数
                $betCountFun = $played['betCountFun'];
                if($betCountFun){
                    $betCount = bet::$betCountFun($code['actionData']);
                    if($code['actionNum'] != $betCount){
                        throw new \Exception('提交数据出错，请重新投注，有效注数' . $betCount);
                    }                
                }
                
                if($played['rx_mode']!='wym'){
                    $code['weiShu'] = 0;
                }

                $betCheckFun = $played['betCheckFun'];
                if($betCheckFun){
                    $betCheck = betC::$betCheckFun($code['actionData'],$code['weiShu']);
                    if(!$betCheck){
                        throw new \Exception('投注内容有误，请重新投注!');
                    }                
                }

                $ip = $this->ip(true);
                $code['zhuiHao'] = (bool)$zhuihao;
                $zhuiHaoMode = isset($para['zhuiHaoMode']) ? $para['zhuiHaoMode'] : '';

                //追号倍数,1个元素时表示普通投注
                foreach($actionNos as $key=>$actionNo){
                    $para2 = array(
                        'actionTime' => $this->time,
                        'actionNo' => $actionNo,
                        'kjTime' => $actionTime,
                        'actionIP' => $ip,
                        'uid' => $this->user['uid'],
                        'username' => $this->user['username'],
                        'zhuiHaoMode' => $zhuiHaoMode,
                        'serializeId' => uniqid(),
                    );
                    $code['beiShu'] = $code['beiShu'] * $beishus[$key];
                    $bets[] = array_merge($code, $para2);

                    $money = $code['actionNum'] * $code['mode'] * $code['beiShu'];
                    $money = $money * $beishus[$key];
                    $amount += $money;
                }
            }    

            // 查询用户可用资金
            $coin = db('members')->where('uid',$this->user['uid'])->value('coin');
            if ($coin < $amount){
                throw new \Exception('您的可用资金不足，是否充值？');
            }

            // 开始事物处理,bets中的注单,是经过补全和调整过的
            db()->startTrans() ;
            foreach ($bets as $code) {     
                /*      
                unset($code['plid']);
                $code['wjorderId'] = $code['type'] . $code['playedId'] . $this->randomkeys(8 - strlen($code['type'] . $code['playedId']));
                $betid = db('bets')->data($code)->insert();
                if(!$betid){
                    db()->rollback();
                    $error[API_MSG_NAME] = '添加注单失败!';
                    return $this->apiReturn($error);                  
                }
                $money = $code['actionNum'] * $code['mode'] * $code['beiShu'];
                $r = $this->addCoin(array(
                    'uid' => $this->user['uid'],
                    'type' => $code['type'],
                    'liqType' => $liqType,
                    'info' => $info,
                    'extfield0' => $betid,
                    'extfield1' => $para2['serializeId'],
                    'coin' => - $money,
                ));
                if(!$r){
                    db()->rollback();
                    $error[API_MSG_NAME] = '添加资金流水失败!';
                    return $this->apiReturn($error);
                }
                */
                $this->user->bet($code,$info);
            }
            db()->commit() ; // 成功则提交
            return $this->apiReturn([]);
        }catch (\Exception $e) {
            db()->rollback();            
            $error[API_MSG_NAME] = $e->getMessage();
            return $this->apiReturn($error);
        }
    }

    
    //ajax撤单 public final function deleteCode()



   

}
