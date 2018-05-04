<?php
namespace app\v2\controller;
use app\v2\Login;
class Sixbet extends Login{
    
    private function _initialize(){
        $uid = $_SESSION["uid"];
        $class = $_GET['class'];
        $username = $_SESSION["username"];
        //清空所有POST数据为空的表单
        $datas = array_filter($_POST);
        //获取清空后的POST键名
        $names = array_keys($datas);
    }
    
}