<?php
namespace app\logic;

use think\Db;

class bet_ds
{ 

    static function dx_add($uid, $ball_sort, $point_column, $match_name, $master_guest, $match_id, $bet_info, $bet_money, $bet_point, $ben_add, $bet_win, $match_time, $match_endtime, $lose_ok, $match_showtype, $match_rgg, $match_dxgg, $match_nowscore, $match_type, $balance, $assets, $Match_HRedCard, $Match_GRedCard, $ksTime,$fs=0,$istj = 1)
    {
        $request = \think\Request::instance();
        if(isset($_SERVER['HTTP_X_REAL_IP'])){
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }else{
            $ip = $request->ip();
        }
        
        $isMobile = $request->isMobile();
        $tmp = explode('VS.',$master_guest);
        $master = $tmp[0];
        $guest = isset($tmp[1]) ? $tmp[1] : '';
        Db::startTrans();
        
        $q_qian = $balance + $bet_money;
        try {            
            $rs = Db::name('k_user')->where('money','>=',$bet_money)
            ->where('uid','=',$uid)
            ->update(['money' => ['exp',"money-$bet_money"]]);
            if(!$rs){
                Db::rollback();
                return false;
            }
            $saltStr= $uid.$ball_sort.$point_column.$match_name.$master_guest.$bet_info.$bet_money.$bet_point;
            date_default_timezone_set('PRC');
            $data = [
                'uid'               => $uid,
                'ball_sort'         => $ball_sort,
                'point_column'      => $point_column,
                'match_name'        => $match_name,
                'master_guest'      => $master_guest,
                'match_id'          => $match_id,
                'bet_info'          => $bet_info,
                'bet_money'         => $bet_money,
                'bet_point'         => $bet_point,
                'ben_add'           => $ben_add,
                'bet_win'           => $bet_win,
                'match_time'        => $match_time,
                'bet_time'          => date("Y-m-d H:i:s"), //这里需要注意时区转换
                'match_endtime'     => $match_endtime,
                'lose_ok'           => $lose_ok,
                'match_showtype'    => $match_showtype,
                'match_rgg'         => $match_rgg,
                'match_dxgg'        => $match_dxgg,
                'match_nowscore'    => $match_nowscore,
                'match_type'        => $match_type,
                'balance'           => $balance,
                'assets'            => $assets,
                'Match_HRedCard'    => $Match_HRedCard,
                'Match_GRedCard'    => $Match_GRedCard,
                'www'               => $_SERVER['HTTP_HOST'],
                'match_coverdate'   => $ksTime,
                'q_qian'            => $q_qian,
                'h_qian'            => $balance,
                'master'            => $master,
                'guest'             => $guest,
                'fs'                => $fs,
                'istongji'          => $istj,
                'ip'                => $ip,
                'device'            => $isMobile ? 'MOBILE' : 'PC',
                'saltCode'          => md5($saltStr.$balance.$assets),
                'betDate'           =>date("Y-m-d"),
            ];
            $id = Db::name('k_bet')->insertGetId($data,false,'bid');
            $datereg = $id;
            $rs = Db::name('k_bet')->where('bid','=',$id)
            ->update(['number'=>$datereg]);
            $log = [];
            $log['m_order']   = 'KBET'.$datereg;
            $log['uid']     = Session('uid');
            $log['m_value'] = $bet_money;
            $log['q_qian']  = $q_qian;
            $log['h_qian']  = $balance;
            $log['status']  = '1';
            $log['m_make_time'] = date('Y-m-d H:i:s');
            $log['about'] = '体育投注,订单号:'.$datereg.',金额:'.$bet_money;
            $log['type'] = '310';
            Db::table('k_money') -> insert($log);
            if(!$rs){
                Db::rollback();
                return false;
            }
            Db::commit();
            return true;
        } catch (Exception $e) {
            Db::rollback(); // 数据回滚
            return false;
        }
    }
}