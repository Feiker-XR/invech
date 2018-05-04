<?php
function xjssc_js($rs,$rows){
    $hm = array();
    $hm[] = $rs['ball_1'];
    $hm[] = $rs['ball_2'];
    $hm[] = $rs['ball_3'];
    $hm[] = $rs['ball_4'];
    $hm[] = $rs['ball_5'];
    // 开始结算第一球
    if ($rows['mingxi_1'] == '第一球') {
        $ds = Ssc_Ds($rs['ball_1']);
        $dx = Ssc_Dx($rs['ball_1']);
        if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第二球
    if ($rows['mingxi_1'] == '第二球') {
        $ds = Ssc_Ds($rs['ball_2']);
        $dx = Ssc_Dx($rs['ball_2']);
        if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第三球
    if ($rows['mingxi_1'] == '第三球') {
        $ds = Ssc_Ds($rs['ball_3']);
        $dx = Ssc_Dx($rs['ball_3']);
        if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第四球
    if ($rows['mingxi_1'] == '第四球') {
        $ds = Ssc_Ds($rs['ball_4']);
        $dx = Ssc_Dx($rs['ball_4']);
        if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算第五球
    if ($rows['mingxi_1'] == '第五球') {
        $ds = Ssc_Ds($rs['ball_5']);
        $dx = Ssc_Dx($rs['ball_5']);
        if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算总和大小
    if ($rows['mingxi_2'] == '总和大' || $rows['mingxi_2'] == '总和小') {
        $zonghe = Ssc_Auto($hm, 2);
        if ($rows['mingxi_2'] == $zonghe) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算总和单双
    if ($rows['mingxi_2'] == '总和单' || $rows['mingxi_2'] == '总和双') {
        $zonghe = Ssc_Auto($hm, 3);
        if ($rows['mingxi_2'] == $zonghe) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算龙虎和
    if ($rows['mingxi_2'] == '龙' || $rows['mingxi_2'] == '虎' || $rows['mingxi_2'] == '和') {
        $longhu = Ssc_Auto($hm, 4);
        if ($rows['mingxi_2'] == $longhu) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算前三
    if ($rows['mingxi_1'] == '前三') {
        $qiansan = Ssc_Auto($hm, 5);
        $dx = ($hm[0] + $hm[1] + $hm[2] > 13) ? '大' : '小';
        $ds = (($hm[0] + $hm[1] + $hm[2]) % 2 == 0) ? '双' : '单';
        if ($rows['mingxi_2'] == $qiansan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算中三
    if ($rows['mingxi_1'] == '中三') {
        $zhongsan = Ssc_Auto($hm, 6);
        $dx = ($hm[1] + $hm[2] + $hm[3] > 13) ? '大' : '小';
        $ds = (($hm[1] + $hm[2] + $hm[3]) % 2 == 0) ? '双' : '单';
        if ($rows['mingxi_2'] == $zhongsan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算后三
    if ($rows['mingxi_1'] == '后三') {
        $housan = Ssc_Auto($hm, 7);
        $dx = ($hm[2] + $hm[3] + $hm[4] > 13) ? '大' : '小';
        $ds = (($hm[2] + $hm[3] + $hm[4]) % 2 == 0) ? '双' : '单';
        if ($rows['mingxi_2'] == $housan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
            return true;
        } else {
            return false;
        }
    }

    if ($rows['gfwf']) {
        if($rows['weiShu']){
            return $rows['ruleFun']($rows['mingxi_2'],implode(",",$hm),$rows['weiShu']);
        }else{
            return $rows['ruleFun']($rows['mingxi_2'],implode(",",$hm));    
        }
    }

}