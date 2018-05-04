<?php
namespace app\index\controller;
use app\index\Base;
use think\Db;
use think\Session;
use think\Cache;
class Game1 extends Base
{
    const  PAGE_SIZE = 10;
    public function index($type = 'ag')
    {
        $uid = Session::get('uid');
        $user = Db::table('k_user')->where(array('uid'=>$uid))->find();
        $this->assign('user',$user);
        $this->assign('type',strtoupper($type));
        $dzGameConfigs  = db('dzyx')->where('platform',$type)->select();
        //推荐游戏分组
        $dzGameTypes = [];
        if (!empty($dzGameConfigs)){
            foreach ($dzGameConfigs as $dzGameConfig=>$val) {
                if (!in_array($val['gametype'],$dzGameTypes)){
                    $dzGameTypes[]=$val['gametype'];
                }
            }
        }
        $dzplat = ['AG','BBIN','MG','PT','太阳城'];
        if (request()->isAjax()){
            $data = [
                'type'=>$dzGameTypes,
                'data'=>$dzGameConfigs,
                'cate'=>$dzplat,
                'Ytype'=>strtoupper($type),
            ];
            return json_encode($data);
        }else{
            $this->assign('dzGameConfigs',$dzGameConfigs);
            $this->assign('dzGameTypes',array_filter($dzGameTypes));
            $this->assign('dzplat',$dzplat);
            return $this->fetch();
        }
    }

    public function ag(){

    }

    public function bbin(){

    }

    public function mg(){

    }

    public function pt(){

    }

    public function sunbet(){

    }
}