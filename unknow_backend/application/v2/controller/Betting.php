<?php
namespace app\v2\controller;
use app\v2\Base;
class betting extends Base{
    
    public function index(){
        return $this->fetch();
    }
    
}