<?php
// 
//                                  _oo8oo_
//                                 o8888888o
//                                 88" . "88
//                                 (| -_- |)
//                                 0\  =  /0
//                               ___/'==='\___
//                             .' \\|     |// '.
//                            / \\|||  :  |||// \
//                           / _||||| -:- |||||_ \
//                          |   | \\\  -  /// |   |
//                          | \_|  ''\---/''  |_/ |
//                          \  .-\__  '-'  __/-.  /
//                        ___'. .'  /--.--\  '. .'___
//                     ."" '<  '.___\_<|>_/___.'  >' "".
//                    | | :  `- \`.:`\ _ /`:.`/ -`  : | |
//                    \  \ `-.   \_ __\ /__ _/   .-` /  /
//                =====`-.____`.___ \_____/ ___.`____.-`=====
//                                  `=---=`
// 
// 
//               ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//
//                          佛祖保佑         永不宕机/永无bug
// +----------------------------------------------------------------------
// | FileName: Fsset.php
// +----------------------------------------------------------------------
// | CreateDate: 2018年4月14日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
class fsset extends Login{
    
    public function getplatform(){
        $info = db('gameplateform')->field(['id','plateformname'])->select();
        return $info;
    }
    
    public function getgametype($id){
        if(!$id){
            return [''];
        }else{
           $info = db('gametype')->field(['gametype','gametypename'])->where('gameplatform','eq',$id)->select();
           return $info;
        }
    }
    
    public function usergroup(){
        $info = db('k_group')->field(['id','name'])->select();
        return $info;
    }
    
    public function index(){
        
    }
    
    public function add(){
        return $this->fetch();
    }
    
    public function save(){
        
    }
    
    public function del(){
        
    }
    
}