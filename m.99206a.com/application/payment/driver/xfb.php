<?php
namespace app\payment;

class xfb extends Driver{
    
    public function encrypt($param){
        $signStr = "parter={$param['parter']}&type={$param['type']}&value={$param['value']}&orderid ={$param['orderid']}&callbackurl={$param['callbackurl']}{$param['key']}";
        return md5($signStr);
    }
    
    public function builtform($param){
        $tmpstr = '';
        foreach ($param as $k=>$v){
            $tmpstr .= "<input type='hidden' name='$k' value='$v' />\r\n";
        }
        return $tmpstr;
    }
}