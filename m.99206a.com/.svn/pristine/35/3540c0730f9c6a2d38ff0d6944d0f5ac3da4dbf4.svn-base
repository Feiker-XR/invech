<?php
namespace app\index\controller;
use app\index\Base;
use think\Db;
use app\index\Login;
use think\Session;
use app\model\dzyx;
use think\Cache;
use think\Validate;
use think\Request;
use think\Config;
use think\Response;
use app\logic\ip2addr;

class Demo extends Base
{
    /**
     *
     *  财务报表 每个代理的盈利情况 (测试)
     */
    public function index()
    {
        $res = [] ;
        //统计每个代理的盈利情况
        $sql = 'SELECT U.top_uid, R.platform, R.gametype, sum(R.bet) as bet_amount ,sum(R.payout) as payout_amount, (SUM(R.payout) - SUM(R.bet)) as win 
        FROM web_report R 
        LEFT JOIN k_user U  ON R.uid=U.uid  
        GROUP  BY U.top_uid,R.platform,R.gametype';

        $data = Db::query($sql) ;
        //数据整理
         foreach ($data as $key=>$val) {
            $topUid = (is_null($val['top_uid'])) ? -1 : $val['top_uid'] ;
            unset($val['top_uid']) ;
            $res[$topUid]['data'][$val['platform']][$val['gametype']] = $val ; //数据按游戏平台和类型归类

             //统计总金额
            $bet    = (isset($res[$topUid]['total']['bet_amount'])    && !empty($res[$topUid]['total']['bet_amount']))    ? bcadd($res[$topUid]['total']['bet_amount'],$val['bet_amount'],2)       : $val['bet_amount'] ;
            $payout = (isset($res[$topUid]['total']['payout_amount']) && !empty($res[$topUid]['total']['payout_amount'])) ? bcadd($res[$topUid]['total']['payout_amount'],$val['payout_amount'],2) : $val['payout_amount'] ;
            $win    = (isset($res[$topUid]['total']['win'])           && !empty($res[$topUid]['total']['win']))           ? bcadd($res[$topUid]['total']['win'],$val['win'],2)                     : $val['win'] ;
            $res[$topUid]['total']['bet_amount']    = $bet ;
            $res[$topUid]['total']['payout_amount'] = $payout ;
            $res[$topUid]['total']['win']           = $win ;
        }

        echo '<pre>';
        print_r($res) ;
        die;
    }

    /**
     * 财务报表,每个代理下的用户的盈利情况 (测试)
     */
    public function user($topUid=0)
    {
        //1.根据top_uid为条件,找到所属的用户
        //2.用户ID关联 web_report表uid,拿到所属用户的所有投注记录
        //3.用户ID分组,然后按平台,类型统计出,用户的盈利情况

        $res =  [] ;
        $sql = " SELECT  R.uid, R.platform, R.gametype,  SUM(R.bet) as bet_amount, SUM(R.payout) as payout_amount, (SUM(R.payout)-SUM(R.bet)) as win 
              FROM k_user U 
              LEFT JOIN web_report R ON U.uid = R.uid
              WHERE U.top_uid = {$topUid} 
              GROUP  BY U.uid,R.platform,R.gametype " ;
        $data = Db::query($sql) ;

        //4.数据整理
        foreach ($data as $key=>$val) {
            $uid = $val['uid'] ;
            unset($val['uid']) ;
            if (!$uid) { continue ;}
            $res[$uid]['data'][$val['platform']][$val['gametype']] = $val ;

            //统计总金额
            $bet    = (isset($res[$uid]['total']['bet_amount'])    && !empty($res[$uid]['total']['bet_amount']))    ? bcadd($res[$uid]['total']['bet_amount'],$val['bet_amount'],2)       : $val['bet_amount'] ;
            $payout = (isset($res[$uid]['total']['payout_amount']) && !empty($res[$uid]['total']['payout_amount'])) ? bcadd($res[$uid]['total']['payout_amount'],$val['payout_amount'],2) : $val['payout_amount'] ;
            $win    = (isset($res[$uid]['total']['win'])           && !empty($res[$uid]['total']['win']))          ? bcadd($res[$uid]['total']['win'],$val['win'],2)                      : $val['win'] ;
            $res[$uid]['total']['bet_amount']    = $bet ;
            $res[$uid]['total']['payout_amount'] = $payout ;
            $res[$uid]['total']['win']           = $win ;
        }

        echo '<pre>';
        print_r($res) ;
        die;

    }

}