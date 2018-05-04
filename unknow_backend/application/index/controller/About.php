<?php
namespace app\index\controller;
use app\index\Base;
class about extends Base{
    public function index($id){
        $about = new \app\model\about();
        $info = $about->get($id);
        $menu = $about->getList('1,2,3,4,5');
        $this->assign('current',$id);
        $this -> assign('menu',$menu);
        $this->assign('info',$info); 
        return $this->fetch('index');
    }
    
}