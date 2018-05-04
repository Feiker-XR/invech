<?php

namespace app\common\traits\model;

use InvalidArgumentException;
use think\Loader;
use bong\service\JsonExtra;

trait Extra
{

    //protected $extra = 'extra';//在模型中的定义,目前只支持一个json字段的处理
    
    private function getExtraFieldName(){
        return $this->extra??'extra';
    }

    public function getExtraAttr(){
        
        $extra_field = $this->getExtraFieldName();

        try {
            $value = $this->getData($extra_field);
        } catch (InvalidArgumentException $e) {
            $value    = null;
        }
        
        if(!is_object($value)){
            $this->data[$extra_field] = new JsonExtra($value);
        }
        return $this->data[$extra_field];
    }

    public function setExtraAttr($obj){
        
        $extra_field = $this->getExtraFieldName();

        if(!is_object($obj)){
            $obj = new JsonExtra($obj); 
        }       
        return $this->data[$extra_field] = $obj;
    }

    //public function __set($name, $value)
    public function setAttr($name, $value, $data = [])
    {
        $extra_field = $this->getExtraFieldName();
        if(empty($this->field)){
            $this->field = $this->getQuery()->getTableInfo('', 'fields');    
        }        
        if(in_array($name,$this->field)){
            if($name==$extra_field){
                return $this->setExtraAttr($value);
            }else{
                return parent::setAttr($name,$value);
            }
        }else{
            $extra = $this->getExtraAttr();
            $extra->$name = $value;
            return $this;            
        }
    }

    //public function __get($name)
    public function getAttr($name)
    {
        $extra_field = $this->getExtraFieldName();

        if($name==$extra_field){
            return $this->getExtraAttr();
        }

        try{
            return parent::getAttr($name);
        }catch(\InvalidArgumentException $e){        
            return $this->getExtraAttr()->$name;        
        }   
    }

}
