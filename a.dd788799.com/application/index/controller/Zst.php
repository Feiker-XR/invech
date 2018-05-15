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
// | FileName: Zst.php
// +----------------------------------------------------------------------
// | CreateDate: 2018年5月14日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\index\controller;
use app\index\Base;
use app\common\model\Type;

class Zst extends Base{
    public function _empty(){
        $type = request()->param('type',1);
        $action = request()->action();
        $lottery = Type::nameMaps();
        if(isset($lottery[$action]) && $lottery[$action]){
            $this->assign('name',$lottery[$action]->name);
            $this->assign('title',$lottery[$action]->title);
            $this->assign('pic',$lottery[$action]->pic);
            $this->assign('info',$lottery[$action]->info);
            $this->assign('id',$lottery[$action]->id);
            $this->assign('type',$type);
            return $this->fetch($action);
        }else{
            redirect('404');
        }
    }
}