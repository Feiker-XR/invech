<?php
namespace app\v2\controller;

use app\index\Base;
class linecheck extends Base{
    
    
    public function index(){
        return $this->fetch('index');
    }
    
}