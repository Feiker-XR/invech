<?php
namespace app\common\model\type;

//随机开奖函数
//期数函数暂时不做修改;

trait RandomTrait
{
    public function random(){
        $kjData = [];
        $codes = explode(',',$this->codeList);
        $num = count($codes);
        for($i=0;$i<$this->codeNum;$i++) {
            while(true){
                $index = mt_rand(0,$num-1);
                $code = $codes[$index];
                if(!$this->codeRepeat){
                    $ret = array_search($code,$codes);
                    if($ret !== false){
                        continue;
                    }
                }
                break;    
            }
            $kjData[] = $code;             
        }
        return implode(',',$kjData);
    }
}

