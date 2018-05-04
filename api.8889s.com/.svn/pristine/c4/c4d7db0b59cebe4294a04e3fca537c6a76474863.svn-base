<?php
function jsk3_js($rs,$rows){
    $hm = array();
    $hm[] = $rs['ball_1'];
    $hm[] = $rs['ball_2'];
    $hm[] = $rs['ball_3'];
    $dianshu = $hm[0] + $hm[1] + $hm[2];
    // 开始结算点数
    if ($rows['mingxi_1'] == '点数') {
        if ($rows['mingxi_2'] == $dianshu) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算双面
    if ($rows['mingxi_1'] == '双面') {
        $ds = $dx = '';
        if ($dianshu >= 4 && $dianshu <= 10) {
            $dx = '点数小';
        }
        if ($dianshu >= 11 && $dianshu <= 17) {
            $dx = '点数大';
        }
        // 点数单双
        if ($dianshu % 2 == 0) {
            $ds = '点数双';
        } else {
            $ds = '点数单';
        }
        if ($rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算三军
    if ($rows['mingxi_1'] == '三军') {
        if (in_array(intval($rows['mingxi_2']), $hm)) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算围骰
    if ($rows['mingxi_1'] == '围骰') {
        $ws = "0" . $hm[0] . "0" . $m[1] . "0" . $m[2];
        if ($rows['mingxi_2'] == $ws) {
            return true;
        } else {
            return false;
        }
    }
    // 开始结算长牌
    if ($rows['mingxi_1'] == '长牌') {
        $tmphm = $hm;
        sort($tmphm);
        $cp1 = "0" . $tmphm[0] . "0" . $tmphm[1];
        $cp2 = "0" . $tmphm[1] . "0" . $tmphm[2];
        $cp3 = "0" . $tmphm[0] . "0" . $tmphm[2];
        if ($rows['mingxi_2'] == $cp1 || $rows['mingxi_2'] == $cp2 || $rows['mingxi_2'] == $cp3) {
            return true;
        } else {
            return false;
        }
    }
    
    // 开始结算短牌
    if ($rows['mingxi_1'] == '短牌') {
        $tmphm = $hm;
        sort($tmphm);
        $cp1 = "0" . $tmphm[0] . "0" . $tmphm[1];
        $cp2 = "0" . $tmphm[1] . "0" . $tmphm[2];
        $cp3 = "0" . $tmphm[0] . "0" . $tmphm[2];
        if ($rows['mingxi_2'] == $cp1 || $rows['mingxi_2'] == $cp2 || $rows['mingxi_2'] == $cp3) {
            return true;
        } else {
           return false;
        }
    }

    /*
    if ($rows['gfwf']) {
        if($rows['weiShu']){
            return $rows['ruleFun']($rows['mingxi_2'],implode(",",$hm),$rows['weiShu']);
        }else{
            return $rows['ruleFun']($rows['mingxi_2'],implode(",",$hm));    
        }
    }
    */          
}