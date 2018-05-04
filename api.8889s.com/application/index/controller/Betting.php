<?php
namespace app\index\controller;
use app\index\Base;
class betting extends Base{
    
    public function index(){
        return $this->fetch();
    }
    
}