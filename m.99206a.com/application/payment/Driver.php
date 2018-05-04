<?php
namespace app\payment;
abstract class Driver{
    
    /**
     * 加密
     */
    abstract public function encrypt(array $param,$type = 'md5');
    
    abstract public function builtform(array $param){
        
    }
}