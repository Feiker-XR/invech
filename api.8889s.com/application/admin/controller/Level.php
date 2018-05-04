<?php
namespace app\admin\controller;

use app\admin\Login;

class Level extends Login
{

    public function index()
    {
        $level = new \app\model\level();
        $all = $level->getList();
        $this->assign('list', $all);
        return $this->fetch('index');
    }

    public function edit($id)
    {
        $level = new \app\model\level();
        $info = $level->get($id);
        $this->assign('info', $info);
        return $this->fetch('edit');
    }

    public function add()
    {
        return $this->fetch("add");
    }

    public function save()
    {
        $id = $_POST['hf_id'];
        $level = new \app\model\level();
        if($id){
           $status = $level->allowField(true)->save($_POST,['id' => $id]);
        }else{
           $status = $level->allowField(true)->save($_POST);
        }
        if($status){
            echo "<script>alert('操作成功!')</script>";
        }else{
            echo "<script>alert('操作失败!')</script>";
        }
        
    }

    public function delete($id)
    {
        $level = new \app\model\level();
        $return = $level->get($id)->delete();
        if($return){
            echo '';
        }else{
            echo '';
        }
    }
    
    public function member($id){
        
    }
}

