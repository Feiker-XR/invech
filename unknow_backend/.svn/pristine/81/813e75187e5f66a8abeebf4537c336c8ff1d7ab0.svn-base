<?php
/**
 * 广西快乐十分
 * @param array $rs 开奖号码
 * @param array $rows 投注信息
 * @return boolean
 */
function gxklsf_js($rs,$rows)
{
    $hm = array();
    $hm[] = $rs['ball_1'];
    $hm[] = $rs['ball_2'];
    $hm[] = $rs['ball_3'];
    $hm[] = $rs['ball_4'];
    $hm[] = $rs['ball_5'];
    $hm[] = $rs['ball_6'];
    $hm[] = $rs['ball_7'];
    $hm[] = $rs['ball_8'];
    // 开始结算第一球
    if ($rows['mingxi_1'] == '第一球') {
        $ds = Gxsf_Ds($rs['ball_1']);
        $dx = Gxsf_Dx($rs['ball_1']);
        if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第二球
    if ($rows['mingxi_1'] == '第二球') {
        $ds = Gxsf_Ds($rs['ball_2']);
        $dx = Gxsf_Dx($rs['ball_2']);
        if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第三球
    if ($rows['mingxi_1'] == '第三球') {
        $ds = Gxsf_Ds($rs['ball_3']);
        $dx = Gxsf_Dx($rs['ball_3']);
        if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第四球
    if ($rows['mingxi_1'] == '第四球') {
        $ds = Gxsf_Ds($rs['ball_4']);
        $dx = Gxsf_Dx($rs['ball_4']);
        if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第五球
    if ($rows['mingxi_1'] == '第五球') {
        $ds = Gxsf_Ds($rs['ball_5']);
        $dx = Gxsf_Dx($rs['ball_5']);
        if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算总和大小
    if ($rows['mingxi_2'] == '总和大' || $rows['mingxi_2'] == '总和小') {
        $zonghe = Gxsf_Auto($hm, 2);
        if ($rows['mingxi_2'] == $zonghe) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算总和单双
    if ($rows['mingxi_2'] == '总和单' || $rows['mingxi_2'] == '总和双') {
        $zonghe = Gxsf_Auto($hm, 3);
        if ($rows['mingxi_2'] == $zonghe) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算龙虎和
    if ($rows['mingxi_2'] == '龙' || $rows['mingxi_2'] == '虎' || $rows['mingxi_2'] == '和') {
        $longhu = Gxsf_Auto($hm, 4);
        if ($rows['mingxi_2'] == $longhu) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算前三
    if ($rows['mingxi_1'] == '前三') {
        $qiansan = Gxsf_Auto($hm, 5);
        if ($rows['mingxi_2'] == $qiansan) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算中三
    if ($rows['mingxi_1'] == '中三') {
        $zhongsan = Gxsf_Auto($hm, 6);
        if ($rows['mingxi_2'] == $zhongsan) {
            
            return true;
        } else {
            
            return false;
        }
    }
    // 开始结算后三
    if ($rows['mingxi_1'] == '后三') {
        $housan = Gxsf_Auto($hm, 7);
        if ($rows['mingxi_2'] == $housan) {
            return true;
        } else {
            return false;
        }
    }
}