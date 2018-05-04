<?php
function xyft_js($rs,$rows){
    $hm = array();
    $hm[] = $rs['ball_1'];
    $hm[] = $rs['ball_2'];
    $hm[] = $rs['ball_3'];
    $hm[] = $rs['ball_4'];
    $hm[] = $rs['ball_5'];
    $hm[] = $rs['ball_6'];
    $hm[] = $rs['ball_7'];
    $hm[] = $rs['ball_8'];
    $hm[] = $rs['ball_9'];
    $hm[] = $rs['ball_10'];
    // 开始结算第一球
    if ($rows['mingxi_1'] == '冠军') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_1']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_1']);
        $lh = Pk10_Auto($hm, 4, 0);
        if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第二球
    if ($rows['mingxi_1'] == '亚军') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_2']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_2']);
        $lh = Pk10_Auto($hm, 5, 0);
        if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第三球
    if ($rows['mingxi_1'] == '第三名') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_3']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_3']);
        $lh = Pk10_Auto($hm, 6, 0);
        if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第四球
    if ($rows['mingxi_1'] == '第四名') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_4']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_4']);
        $lh = Pk10_Auto($hm, 7, 0);
        if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第五球
    if ($rows['mingxi_1'] == '第五名') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_5']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_5']);
        $lh = Pk10_Auto($hm, 8, 0);
        if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第六球
    if ($rows['mingxi_1'] == '第六名') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_6']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_6']);
        if ($rows['mingxi_2'] == $rs['ball_6'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第七球
    if ($rows['mingxi_1'] == '第七名') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_7']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_7']);
        if ($rows['mingxi_2'] == $rs['ball_7'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第八球
    if ($rows['mingxi_1'] == '第八名') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_8']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_8']);
        if ($rows['mingxi_2'] == $rs['ball_8'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第九球
    if ($rows['mingxi_1'] == '第九名') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_9']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_9']);
        if ($rows['mingxi_2'] == $rs['ball_9'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第十球
    if ($rows['mingxi_1'] == '第十名') {
        $ds = Pk10_Auto($hm, 10, $rs['ball_10']);
        $dx = Pk10_Auto($hm, 9, $rs['ball_10']);
        if ($rows['mingxi_2'] == $rs['ball_10'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算冠亚军和
    if ($rows['mingxi_1'] == '冠亚军和') {
        $zh = Pk10_Auto($hm, 1, 0);
        $dx = Pk10_Auto($hm, 2, 0);
        $ds = Pk10_Auto($hm, 3, 0);
        if ($rows['mingxi_2'] == $zh || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
}