<?php
namespace app\admin\controller;

use think\Db;
use app\admin\Login;
use think\Model;

class Agent extends Login
{

    public function bili()
    {
        $rows = Db::table('k_user_daili_bili')->order('px asc')->select();
        $this->assign('rows', $rows);
        return $this->fetch();
    }

    public function bilidel($id = 0)
    {
        echo $id;
        Db::startTrans();
        if (Db::table('k_user_daili_bili')->delete($id)) {
            Db::commit();
            $this->success('删除成功!');
        } else {
            $this->error('删除失败!');
            Db::rollback();
        }
    }

    public function bilinew()
    {
        return $this->fetch('biliedit');
    }

    public function biliadd()
    {
        $bili = new \app\model\dailibili();
        if ($bili->allowField(true)
            ->data(request()->param(), true)
            ->save()) {
            $this->success('操作成功!', url('agent/bili'));
        } else {
            $this->error('操作失败!');
        }
    }

    public function biliedit($id = 0)
    {
        $rs = Db::table('k_user_daili_bili')->find($id);
        $this->assign('rs', $rs);
        return $this->fetch();
    }

    public function cmd()
    {
        $param = $this->request->param();
        $status = intval($param['status'] ?? '');
        $did = intval($param['did'] ?? '');
        $uid = intval($param['uid'] ?? '');
        $msg = new \app\model\msg();
        if ($status == 1) {
            $sql = "update k_user set is_daili = 1 where uid = $uid and is_daili = 0";
            Db::startTrans();
            try {
                $q1 = Db::execute($sql);
                if ($q1 == 1) {
                    Db::commit();
                    sys_log(Session('adminid'), "用户ID" . $uid . "获得本网代理资格");
                    $msg->msg_add($uid, '商务合作中心', '恭喜您成为本公司代理', "您的代理申请已获得本公司的批准！");
                } else {
                    Db::rollback();
                    $this->error('操作失败，该会员原来已经属于本网代理！');
                }
            } catch (\think\Exception $e) {
                Db::rollback();
                $this->error('由于系统问题:' . $e->getMessage() . '此次操作失败!');
            }
        } else {
            sys_log(Session('adminid'), "不批准用户ID" . $uid . "成为本网代理");
            $msg->msg_add($uid, '商务合作中心', '对不起，您的代理申请被驳回了', '请检查您的申请信息是否真实，内容是否具有足够的吸引力！');
        }
        $msg = '操作失败!';
        $sql = 'update k_user_daili set status =' . $status . ' where d_id = ' . $did;
        Db::startTrans();
        try {
            $q1 = Db::execute($sql);
            if ($q1 == 1) {
                Db::commit();
                $msg = '操作成功!';
            } else {
                Db::rollback();
            }
        } catch (\think\Exception $e) {
            Db::rollback();
            $this->error('由于系统问题:' . $e->getMessage() . '此次操作失败!');
        }
        $this->success($msg);
    }

    public function jiesuan()
    {
        $param = $this->request->param();
        $nian = date("Y", time());
        $yue = date("m", time());
        if ($param['nian'] ?? '') {
            $nian = $param['nian'];
        }
        if ($param['yue'] ?? '') {
            $yue = $param['yue'];
        }
        $date = $this->mfirstAndLast($nian, $yue);
        $date_s = date("Y-m-d", $date['firstday']);
        $date_o = date("Y-m-d", $date['lastday']);
        $sql = "select uid,username from k_user where is_daili=1 order by login_time desc"; // 取出所有代理用户
        $tmp = Db::query($sql);
        $info = [];
        foreach ($tmp as $k => $ag){
            $sql_xj = "select uid,username from k_user where top_uid=" . $ag["uid"] . " order by uid desc";
            $query_xj = Db::query($sql_xj);
            $uids = $name = '';
            foreach ($query_xj as $row_xj){
                $uids = $uids . $row_xj['uid'] . ',';
                $name = $name . "'" . $row_xj['username'] . "',";
            }
            $uids = $uids . '00';
            $name = $name . "'hwd0'";
            $cptz1 = $cpsy1 = $tytz = $tysy = $cgtz = $cgsy = $cptz = $cpsy = $zrtz = $zrsy = $zrtz2 = $zrsy2 = $hyck = $hyqk = $hyfs = $sxf = $qtfy = $yxhy = 0;
            
            $sql_ty = "select sum(bet_money) as bet_money,sum(win) as win from k_bet where uid in(" . $uids . ") and bet_time>='" . $date_s . " 00:00:00' and bet_time<='" . $date_o . " 23:59:59' and status in(1,2,4,5) order by uid desc";
            $query_ty = Db::query($sql_ty);
            foreach($query_ty as $ty){
                $tytz += $ty['bet_money'];
                $tysy += $ty['win'];
            }
            // 根据会员UID读取会员串关数据
            $sql_cg = "select sum(bet_money) as bet_money,sum(win) as win from k_bet_cg_group where uid in(" . $uids . ") and bet_time>='" . $date_s . " 00:00:00' and bet_time<='" . $date_o . " 23:59:59' and status=1 order by uid desc";
            $query_cg = Db::query($sql_cg);
            foreach ($query_cg as $cg){
                $tytz += $cg['bet_money'];
                $tysy += $cg['win'] - $cg['bet_money'];
                $tysy += $cg['win'];
            }
            
            // 根据会员UID读取会员彩票数据
            $sql_cp = "select sum(money) as money,sum(win) as win from c_bet where uid in(" . $uids . ") and addtime>='" . $date_s . " 00:00:00' and addtime<='" . $date_o . " 23:59:59' and js=1 order by uid desc";
            $query_cp = Db::query($sql_cp);
            foreach ($query_cp as $cp){
                $cptz += $cp['money'];
                $cpsy += $cp['win'];
            }
            
            // 根据会员UID读取会员新彩票数据 （新彩票玩法）
            $sql_cp1 = "select sum(money) as money,sum(win) as win from c_bet_lt where uid in(" . $uids . ") and addtime>='" . $date_s . " 00:00:00' and addtime<='" . $date_o . " 23:59:59' and js=1 order by uid desc";
            $query_cp1 = Db::query($sql_cp1);
            foreach ($query_cp1 as $cp1){
                $cptz1 += $cp1['money'];
                $cpsy1 += $cp1['win'];
            }
            // 根据会员账号读取会员真人数据
            $sql_zr = "select sum(validBetAmount) as money,sum(netAmount) as win from live_data where playerName in(" . $name . ") and betTime>='" . $date_s . " 00:00:00' and betTime<='" . $date_o . " 23:59:59' order by id desc";
            $query_zr = Db::query($sql_zr);
            foreach($query_zr as $zr){
                $zrtz += $zr['money'];
                $zrsy += $zr['win'];
            }
            // 根据会员UID读取会员汇款数据
            $sql_hk = "select sum(money) as money,sum(zsjr) as sxf from huikuan where uid in(" . $uids . ") and adddate>='" . $date_s . " 00:00:00' and adddate<='" . $date_o . " 23:59:59' and status=1 order by uid desc";
            $query_hk = Db::query($sql_hk);
            foreach($query_hk as $hk){
                $hyck += $hk['money'];
                $sxf += $hk['sxf'];
            }
            
            // 根据会员UID读取会员存款数据
            $sql_ck = "select sum(m_value) as money,sum(sxf) as sxf from k_money where uid in(" . $uids . ") and m_make_time>='" . $date_s . " 00:00:00' and m_make_time<='" . $date_o . " 23:59:59' and status=1 and type=1 order by uid desc";
            $query_ck = Db::query($sql_ck);
            foreach ($query_ck as $ck){
                $hyck += $ck['money'];
                $sxf += $ck['sxf'];
            }
            
            // 根据会员UID读取会员取款数据
            $sql_qk = "select sum(m_value) as money,sum(sxf) as sxf from k_money where uid in(" . $uids . ") and m_make_time>='" . $date_s . " 00:00:00' and m_make_time<='" . $date_o . " 23:59:59' and status=1 and type=11 order by uid desc";
            $query_qk = Db::query($sql_qk);
            foreach($query_qk as $qk){
                $hyqk += - $qk['money'];
                $sxf += $qk['sxf'];
            }
            
            // 根据会员UID读取会员反水数据
            $sql_fs = "select sum(m_value) as money from k_money where uid in(" . $uids . ") and m_make_time>='" . $date_s . " 00:00:00' and m_make_time<='" . $date_o . " 23:59:59' and status=1 and type=3 order by uid desc";
            $query_fs = Db::query($sql_fs);
            foreach($query_fs as $fs){
                $hyfs += $fs['money'];
            }
            
            // 根据会员UID读取会员其他加钱数据
            $sql_qt = "select sum(m_value) as money from k_money where uid in(" . $uids . ") and m_make_time>='" . $date_s . " 00:00:00' and m_make_time<='" . $date_o . " 23:59:59' and status=1 and type in (2,4) order by uid desc";
            $query_qt = Db::query($sql_qt);
            foreach($query_qt as $qt){
                $qtfy += $qt['money'];
            }
            // 开始统计有效会员
            $arr_uid = array();
            $sql_yx1 = "select uid from k_bet where uid in(" . $uids . ") and bet_time>='" . $date_s . " 00:00:00' and bet_time<='" . $date_o . " 23:59:59' order by uid desc";
            $query_yx1 = Db::query($sql_yx1);
            foreach($query_yx1 as $rs_yx1 ){
                $arr_uid[] = $rs_yx1['uid'];
            }
            
            $sql_yx2 = "select uid from c_bet where uid in(" . $uids . ") and addtime>='" . $date_s . " 00:00:00' and addtime<='" . $date_o . " 23:59:59' and js=1 order by uid desc";
            $query_yx2 = Db::query($sql_yx2);
            foreach($query_yx2 as $rs_yx2){
                $arr_uid[] = $rs_yx2['uid'];
            }
            $arr_uid = array_unique($arr_uid);
            sort($arr_uid); // 重新排序键名
            
            $yxhy = count($arr_uid);
            if ($yxhy > 0) {
                
            }
            $uids = '';
            $info[$k]['username'] = $ag['username']; //代理账号
            $info[$k]['yxhy'] = $yxhy; //有效会员
            $info[$k]['tytz'] = round($tytz,2); //体育投注
            $info[$k]['tysy'] = round($tysy,2); //体育输赢
            $info[$k]['cptz'] = round($cptz,2); //彩票投注
            $info[$k]['cpsy'] = round($cpsy,2); //彩票输赢
            $info[$k]['cptz1'] = round($cptz1,2); //新彩票投注
            $info[$k]['cpsy1'] = round($cpsy1,2); ///新彩票输赢
            //$info[$k]['zhenren_all_input'] = round($zhenren_all_input,2); //真人流水
            //$info[$k]['zhenren_all_getout'] = round($zhenren_all_getout,2); //真人输赢
            $info[$k]['syzj']=((round($tysy,2)-round($tytz,2)) + (round($cpsy,2)-round($cptz,2))+ (round($cpsy1,2)-round($cptz1,2)) ); //输赢总计
            $info[$k]['yjbl'] = $this->fenchengbili($yxhy,round($tytz-$tysy,2)+round($cptz-$cpsy,2)+round($cptz1-$cpsy1,2),round($tytz-$tysy,2),0,round($cptz-$cpsy+$cptz1-$cpsy1,2),round($hyfs,2),round($sxf,2),round($qtfy,2),1);//佣金比例
            $info[$k]['hyck'] = round($hyck,2);//会员存款
            $info[$k]['hyqk'] = round($hyqk,2);//会员提款
            $info[$k]['hyfs'] = round($hyfs,2);//会员反水
            $info[$k]['sxf'] = round($sxf,2);//手续费
            $info[$k]['qtfy'] = round($qtfy,2);//其他费用
            $info[$k]['ydyj'] = $this->fengchengbili2($yxhy,((round($tysy,2)-round($tytz,2)) + (round($cpsy,2)-round($cptz,2))+ (round($cpsy1,2)-round($cptz1,2)) )); //应得佣金
        }
        $this->assign('nian',$nian);
        $this->assign('yue',$yue);

        $this->assign('info',$info);
        return $this->fetch();
    }

    public function reg()
    {
        $list = Db::name('daili')->paginate(15);
        $this->assign('list', $list);
        return $this->fetch();
    }

    private function fenchengbili($yxhy, $syzj, $tysy, $zrsy, $cpsy, $hyfs, $sxf, $qtfy, $type)
    {
        $sql_bl = "select * from k_user_daili_bili order by px asc";
        $tmp = Db::query($sql_bl);
        $win = $ren = $ty = $cp = $zr = array();
        foreach ($tmp as $row_bl){
            $win[$row_bl['px']] = $row_bl['win'];
            $ren[$row_bl['px']] = $row_bl['ren'];
            $ty[$row_bl['px']] = $row_bl['ty'];
            $cp[$row_bl['px']] = $row_bl['cp'];
            $zr[$row_bl['px']] = $row_bl['zr'];
        }
        
        if ($yxhy < $ren['1']) {
            return '<font color="#0000FF">未达到最低标准</font>';
            exit();
        }
        if (($yxhy == $ren['1'] || $syzj == $win['2']) && $type == 1) {
            return '当前佣金比例：<font color="#FF0000">' . $ty['1'] . '%</font>';
            exit();
        }
        $s = $o = $z = 1;
        for ($i = 2; $i <= count($ren); $i ++) {
            $ii = $i - 1;
            if ($i == count($ren)) {
                if ($yxhy >= $ren['' . $i . '']) {
                    $s = $i;
                }
                if ($syzj > $win['' . $i . '']) {
                    $o = $i;
                }
            } else {
                if ($yxhy >= $ren['' . $ii . ''] && $yxhy <= $ren['' . $i . '']) {
                    $s = $ii;
                }
                if ($syzj > $win['' . $ii . ''] && $syzj < $win['' . $i . '']) {
                    $o = $ii;
                }
            }
        }
        if ($s > $o) {
            $z = $o;
        }
        if ($s < $o) {
            $z = $s;
        }
        if ($s == $o) {
            $z = $s;
        }
        if ($type == 1) {
            return '体育：<font color="#FF0000">' . $ty['' . $z . ''] . '%</font> 真人：<font color="#FF0000">' . $zr['' . $z . ''] . '%</font> 彩票：<font color="#FF0000">' . $cp['' . $z . ''] . '%</font>';
        } else {
            $yongjin = ($tysy * $ty['' . $z . ''] / 100) + ($zrsy * $zr['' . $z . ''] / 100) + ($cptz * $cp['' . $z . ''] / 100);
            // $yongjin = round(($yongjin - $hyfs - $sxf - $qtfy),0);
            if ($yongjin > 0) {
                return '<font color="#FF0000">' . $yongjin . '</font>';
            } else {
                return '<font color="#0000FF">' . $yongjin . '</font>';
            }
        }
    }

    /**
     *
     * @param 会员数 $yxhy            
     * @param 总输赢 $syzj            
     */
    private function fengchengbili2($yxhy, $syzj)
    {
        $sql_bl = "select * from k_user_daili_bili order by px asc";
        $tmp = Db::query($sql_bl);
        $win = $ren = $ty = $cp = $zr = array();
        foreach ($tmp as $row_bl) {
            $win[$row_bl['px']] = $row_bl['win'];
            $ren[$row_bl['px']] = $row_bl['ren'];
            $ty[$row_bl['px']] = $row_bl['ty'];
            $cp[$row_bl['px']] = $row_bl['cp'];
            $zr[$row_bl['px']] = $row_bl['zr'];
        }
        if ($yxhy < $ren['1']) {
            return '<font color="#0000FF">未达到最低标准</font>';
        }
        $s = $o = $z = 1;
        for ($i = 2; $i <= count($ren); $i ++) {
            $ii = $i - 1;
            if ($i == count($ren)) {
                if ($yxhy >= $ren['' . $i . '']) {
                    $s = $i;
                }
                if ($syzj > $win['' . $i . '']) {
                    $o = $i;
                }
            } else {
                if ($yxhy >= $ren['' . $ii . ''] && $yxhy <= $ren['' . $i . '']) {
                    $s = $ii;
                }
                if ($syzj > $win['' . $ii . ''] && $syzj < $win['' . $i . '']) {
                    $o = $ii;
                }
            }
        }
        if ($s > $o) {
            $z = $o;
        }
        if ($s < $o) {
            $z = $s;
        }
        if ($s == $o) {
            $z = $s;
        }
        
        if ($syzj < 0) {
            $yongjin = abs($syzj * $ty['' . $z . ''] / 100);
            return $yongjin;
        } else {
            return 0;
        }
    }

    private function mfirstAndLast($y = '', $m = '')
    {
        if ($y == "")
            $y = date("Y");
        if ($m == "")
            $m = date("m");
        $m = sprintf("%02d", intval($m));
        $y = str_pad(intval($y), 4, "0", STR_PAD_RIGHT);
        
        $m > 12 || $m < 1 ? $m = 1 : $m = $m;
        $firstday = strtotime($y . $m . "01000000");
        $firstdaystr = date("Y-m-01", $firstday);
        $lastday = strtotime(date('Y-m-d 23:59:59', strtotime("$firstdaystr +1 month -1 day")));
        return array(
            "firstday" => $firstday,
            "lastday" => $lastday
        );
    }
}