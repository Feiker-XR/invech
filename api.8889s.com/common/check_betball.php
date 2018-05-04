<?php
function make_number($start,$end,$step = 1){
    $tmp = array();
    for($i = $start; $i<=$end; $i+= $step){
        $tmp[] = strval($i);
    }
    return $tmp;
}

function lm_pt(){
    $number = make_number(1, 49);
    foreach ($_POST['ball'] as $v){
        if(!in_array($v, $number)) return false;
    }
    return true;
}

function wsdp (){
    $tws = array(
        '10,20,30,40',
        '1,11,21,31,41',
        '2,12,22,32,42',
        '3,13,23,33,43',
        '4,14,24,34,44',
        '5,15,25,35,45',
        '6,16,26,36,46',
        '7,17,27,37,47',
        '8,18,28,38,48',
        '9,19,29,39,49',

        '01,11,21,31,41',
        '02,12,22,32,42',
        '03,13,23,33,43',
        '04,14,24,34,44',
        '05,15,25,35,45',
        '06,16,26,36,46',
        '07,17,27,37,47',
        '08,18,28,38,48',
        '09,19,29,39,49'        
    );
    $wscount = count($_POST['ball_ws']);
    if($wscount !=2) return false;
    foreach ($_POST['ball_ws'] as $v){
        if(!in_array($v, $tws)) return false;
    }
    return true;
}

function sxdp(){
    $zx = array(
        '9,21,33,45',
        '8,20,32,44',
        '7,19,31,43',
        '6,18,30,42',
        '5,17,29,41',
        '4,16,28,40',
        '3,15,27,39',
        '2,14,26,38',
        '1,13,25,37,49',

        '09,21,33,45',
        '08,20,32,44',
        '07,19,31,43',
        '06,18,30,42',
        '05,17,29,41',
        '04,16,28,40',
        '03,15,27,39',
        '02,14,26,38',
        '01,13,25,37,49',
        '12,24,36,48',
        '11,23,35,47',
        '10,22,34,46'
    );
    $sxcount = count($_POST['ball_sx']);
    if($sxcount !=2) return false;
    foreach ($_POST['ball_sx'] as $v){
        if(!in_array($v, $zx)) return false;
    }
    return true;
}

function lm_cxws(){
    $zx = array(
        '9,21,33,45',
        '8,20,32,44',
        '7,19,31,43',
        '6,18,30,42',
        '5,17,29,41',
        '4,16,28,40',
        '3,15,27,39',
        '2,14,26,38',
        '1,13,25,37,49',

        '09,21,33,45',
        '08,20,32,44',
        '07,19,31,43',
        '06,18,30,42',
        '05,17,29,41',
        '04,16,28,40',
        '03,15,27,39',
        '02,14,26,38',
        '01,13,25,37,49',
        '12,24,36,48',
        '11,23,35,47',
        '10,22,34,46'
    );
    $tws = array(
        '10,20,30,40',
        '1,11,21,31,41',
        '2,12,22,32,42',
        '3,13,23,33,43',
        '4,14,24,34,44',
        '5,15,25,35,45',
        '6,16,26,36,46',
        '7,17,27,37,47',
        '8,18,28,38,48',
        '9,19,29,39,49',

        '01,11,21,31,41',
        '02,12,22,32,42',
        '03,13,23,33,43',
        '04,14,24,34,44',
        '05,15,25,35,45',
        '06,16,26,36,46',
        '07,17,27,37,47',
        '08,18,28,38,48',
        '09,19,29,39,49',        
    );
    if(!in_array($_POST['ball_sx'],$zx)){
        return false;
    }
    if(!in_array($_POST['ball_ws'],$tws)) return false;
    return true;
}

function dm_tm(){
    $dm = make_number(1, 49);
    $tm = make_number(1, 49);
    $dmcount = count($_POST['ball_dm']);
    $tmcount = count($_POST['ball_tm']);
    if($dmcount <=0 || $dmcount >3) return false;
    if($tmcount <= 0 || $tmcount > 49) return false;
    foreach($_POST['ball_dm'] as $v){
        if(!in_array($v,$dm)) return false;
    }
    foreach ($_POST['ball_tm'] as $v){
        if(!in_array($v,$dm)) return false;
    }
    return true;
}

function hx(){
    $ball_array = make_number(1, 12);
    foreach ($_POST['ball'] as $v){
        if(!in_array($v,$ball_array)) return false;
    }
    return true;
}