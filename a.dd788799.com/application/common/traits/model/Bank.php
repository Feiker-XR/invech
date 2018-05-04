<?php

namespace app\common\traits\model;

use bong\service\JsonExtra;

trait Bank
{

    public function getBankAttr($value,$data){      
        if(!is_object($this->data['bank'])){
            $this->data['bank'] = new JsonExtra($value);
        }
        return $this->data['bank'];
    }
    /*
    public function setBankAttr($value,$data){      
        if(is_object($this->data['bank'])){
            $this->data['bank'] = $this->data['bank']->toJson(); 
        }
        return $this->data['bank'];
    }
    */
    public function setBankAttr($obj,$data){
        if(!is_object($obj)){
            $obj = new JsonExtra($obj); 
        }       
        return $this->data['bank'] = $obj;
    }

    public function getBankNameAttr($value)
    {
        return $this->bank->bank_name;
    }
    /*
    //$user->bank_name = '银行名称';
    //bank_name修改器会在data[]中添加bank_name属性,导致异常;
    //模型定义属性列表field字段 可以避免此异常
    public function setBankNameAttr($value,$data)
    {
        return $this->bank->bank_name = $value;
    } 
    */ 
    
    public function getBankUsernameAttr($value)
    {
        return $this->bank->bank_username;
    }

    public function getBankAccountAttr($value)
    {
        return $this->bank->bank_account;
    }
    /*
    public function setBankAccountAttr($value,$data)
    {
        return $this->bank->bank_account = $value;
    }
    */   

    public function getBankAddressAttr($value)
    {
        return $this->bank->bank_address;
    }
    /*
    public function setBankAddressAttr($value,$data)
    {
        return $this->bank->bank_address = $value;
    }
    */      

}
