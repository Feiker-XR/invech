<?php
use app\classes\Lunar;

require_once(__DIR__.'/algo_common.php');

//-------------时时彩--------------------
//注单存储: 全部使用单注形式; 部分升级为复式;
//前三二字组合, 也使用单注形式
//组三,组六,    所选数字越多,赔率也小,本身就是单注形式
//时时彩,10个球,没有和局;

/**
 * 双面
 */
function ssc_sm($betData,$kjData) {
    return ssc_enum($betData, $kjData);
}

/**
 * 数字
 */
function ssc_sz($betData,$kjData) {
    return ssc_enum($betData, $kjData);
}

//一字定位-千定位-5
function ssc_dw1($betData,$kjData) {
    return ssc_enum($betData, $kjData);
}

/**
 * 定位(一字,两字,三字,只定位数字)
 * "万位-4 千位-5 百位-6" 改为 "二字定位-万位:4 千位:5"
 */
function ssc_dw($betData,$kjData) {
    $kjData = explode(',',$kjData);
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $bet = explode(' ',$bet);
    $poses = ['万位','千位','百位','十位','个位'];
    foreach ($betData as $pair) {
        $pair = explode(':',$pair);
        $pos = $pair[0];
        $bet = $pair[1];

        $key = array_search($pos,$poses);
        $ball = $kjData[$key];

        if($bet != $ball){
            return false;
        }
    }
    return true;
}

//二字定位--,-,-,14,23
function ssc_dw_fs($betData,$kjData) {
    $betData = explode('-',$betData,2);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = rx_tpf($bet,$kjData);
    return fs($bet,$kjData);
}

/**
 * 一二字组合
 *  全五一字组合-0,前三一字组合-0,  后三二字组合-4,8
 *  做成复式注单,就是前三一码,前三二码
 */
function ssc_zx($betData,$kjData) {

    $q3 = ['前三一字组合','前三二字组合'];
    $z3 = ['中三一字组合','中三二字组合'];
    $h3 = ['后三一字组合','后三二字组合'];

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if (in_array($wf,$q3)) {
        $kjData = array_slice($kjData,0,3);
    }
    if (in_array($wf,$z3)) {
        $kjData = array_slice($kjData,1,3);
    }
    if (in_array($wf,$h3)) {
        $kjData = array_slice($kjData,2,3);
    }    

    /*
    $nums = explode(',',$bet);
    foreach ($nums as $num) {
        $ret = array_search($num,$kjData);
        if($ret === false){
            return false;
        }
        unset($kjData[$ret]);
    }
    return true;
    */

    return any_in($bet,$kjData);
}

/**
 * 二字和数
 * 万千和数-单 万十和数-单
 */
function ssc_hs($betData,$kjData) {
    $pos = ['万','千','百','十','个'];
    
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $wf = preg_split('/(?<!^)(?!$)/u',$wf);

    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if ( ($key = array_search($wf[0],$pos)) !== false ) {
        $num1 = $kjData[$key];
    }

    if ( ($key = array_search($wf[1],$pos)) !== false ) {
        $num2 = $kjData[$key];
    }
    
    $ds = ($num1+$num2)%2==0?'双':'单';
    return $ds == $bet;
}

/**
 * 组3
 * 前三组选三,中三组选三,后三组选三
 * 前三组选三-0,1,2,3,4
 */
function ssc_z3($betData,$kjData) {
    //豹子不算中,3个开奖号码都落在2个号码的数组中算中;
    //选择5个号码,5选2中组合都要判定;无需组合

    $q3 = ['前三组选三'];
    $z3 = ['中三组选三'];
    $h3 = ['后三组选三'];

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if (in_array($wf,$q3)) {
        $kjData = array_slice($kjData,0,3);
    }
    if (in_array($wf,$z3)) {
        $kjData = array_slice($kjData,1,3);
    }
    if (in_array($wf,$h3)) {
        $kjData = array_slice($kjData,2,3);
    }   

    // 豹子不算中奖
    if (preg_match('/^(\d),\1,\1/',implode(',',$kjData))) return 0;

    //如果三位数没有相同,则不中奖
    if(!preg_match('/(\d)(,\d)?,\1/',implode(',',$kjData))) return 0;

    //3个开奖号码 不落在 所选N个号码中, 判定为不中, 在里面判定为中;
    //return array_contain(_arr($bet),$kjData);   
    return array_include(_arr($bet),$kjData);   
     
}

/**
 * 组6
 * 前三组选六,中三组选六,后三组选六
 * 前三组选六-0,1,2,3,4
 */
function ssc_z6($betData,$kjData) {
    $q3 = ['前三组选六'];
    $z3 = ['中三组选六'];
    $h3 = ['后三组选六'];

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if (in_array($wf,$q3)) {
        $kjData = array_slice($kjData,0,3);
    }
    if (in_array($wf,$z3)) {
        $kjData = array_slice($kjData,1,3);
    }
    if (in_array($wf,$h3)) {
        $kjData = array_slice($kjData,2,3);
    }   

    // 豹子不算中奖
    if (preg_match('/^(\d),\1,\1/',implode(',',$kjData))) return 0;

    //如果三位数有对子,则不中奖
    if(preg_match('/(\d)(,\d)?,\1/',implode(',',$kjData))) return 0;

    //3个开奖号码 不落在 所选N个号码中, 判定为不中, 在里面判定为中;
    return array_contain(_arr($bet),$kjData); 
}

/**
 * 跨度
 * 前三跨度,中三跨度,后三跨度
 * 前三跨度-0
 */
function ssc_kd($betData,$kjData) {
    $q3 = ['前三跨度'];
    $z3 = ['中三跨度'];
    $h3 = ['后三跨度'];

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if (in_array($wf,$q3)) {
        $kjData = array_slice($kjData,0,3);
    }
    if (in_array($wf,$z3)) {
        $kjData = array_slice($kjData,1,3);
    }
    if (in_array($wf,$h3)) {
        $kjData = array_slice($kjData,2,3);
    }

    sort($kjData);

    return $bet == $kjData[2]-$kjData[0];
}

/**
 * 龙虎
 * 龙1vs虎2-龙
 */
function ssc_lh($betData,$kjData) {
    $l = ['龙1','龙2','龙3','龙4','龙5'];
    $h = ['虎1','虎2','虎3','虎4','虎5'];

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $wf = explode('vs',$wf);

    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if ( ($key = array_search($wf[0],$l)) !== false ) {
        $num1 = $kjData[$key];
    }

    if ( ($key = array_search($wf[1],$h)) !== false ) {
        $num2 = $kjData[$key];
    }
    
    if($num1 == $num2){
        $ret = '和';   
    }elseif($num1 > $num2){
        $ret = '龙';    
    }else{
        $ret = '虎';
    }

    return $bet == $ret;
}

//双面/数字/枚举盘玩法
function ssc_enum($betData,$kjData) {
    
    $single = ['万位','千位','百位','十位','个位'];
    $single2 = ['万定位','千定位','百定位','十定位','个定位'];
    $single3 = ['总和、龙虎和'];
    $three = ['前三','中三','后三'];
    $five = ['五球'];
    $wfs = array_merge($single,$three,$five);

    $kjData = explode(',',$kjData);

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];
    
    if( ($key = array_search($wf,$single) ) !== FALSE || ($key = array_search($wf,$single2) ) !== FALSE){
        $ball = $kjData[$key];
        $ds = ssc_ds($ball);
        $dx = ssc_dx($ball);
        $zh = ssc_zh($ball);
        $values = [$ball,$ds,$dx,$zh];
        return in_array($bet,$values);
    }

    if( ( $key = array_search($wf,$single3) ) !== FALSE ){
        $balls = _arr($kjData);
        $dx = ($balls[0] + $balls[1] + $balls[2] + $balls[3] + $balls[4] > 23) ? '总大' : '总小';
        $ds = (($balls[0] + $balls[1] + $balls[2] + $balls[3] + $balls[4]) % 2 == 0) ? '总双' : '总单'; 
        $lh = ($balls[0] == $balls[4])?'和':( ($balls[0] > $balls[4])?'龙':'虎');

        $values = [$ds,$dx,$lh];
        return in_array($bet,$values);
    }

    if( ($key = array_search($wf,$three) ) !== FALSE){
        $balls = array_slice($kjData,$key,3);
        $bz = ssc_baozi($balls);
        $dx = ($balls[0] + $balls[1] + $balls[2] > 13) ? '大' : '小';
        $ds = (($balls[0] + $balls[1] + $balls[2]) % 2 == 0) ? '双' : '单';        

        $values = [$bz,$ds,$dx];
        return in_array($bet,$values);
    }    

    return false;
}

function ssc_ds($ball){
    if($ball%2==0){
        return '双';
    }else{
        return '单';
    }
}

function ssc_dx($ball){
    if($ball>4){
        return '大';
    }else{
        return '小';
    }
}

function ssc_zh($ball){
    if(in_array($ball,[1,2,3,5,7])){
        return '质';
    }else{
        return '合';
    }
}

function ssc_zhds($num){
    if($num%2==0){
        return '总双';
    }else{
        return '总单';
    }
}

function ssc_zhdx($num){
    if($num>=23){
        return '总大';
    }else{
        return '总小';
    }
}

//--------------算法优化----------------
//解析开奖结果,这样不用每个注单都调用解析函数;
/*
特别注意,ssc10个开奖号码,大小盘没有和局;
六合彩和局如下:  开出49表示和局,得退还本金;
大小,单双,和数大小,和数单双,尾数大小；
正码过关是两面盘的累积,也有和局,和局累乘1继续;
合肖,49号和局,所有生肖赔率一样,每个生肖表示4个号码;
半波,49号和局,
和局 不支持 复式投注, (复式投注返回赢的注数,无法统计和局)
每一种组合 作为 单独的注单入库;
返回-1表示和局 退还本金;
连码,生肖连,尾数连,全不中, 采用官方彩的存储方式, 一条bet记录表示多注;
*/


function six_parse($kjData){
    $ret = [];
    $wfs = ["正一","正二","正三","正四","正五","正六","特码"];        
    $kjData = explode(',',$kjData);
    foreach ($kjData as $key=>$value) {
        $dx = six_dx($value);
        $ds = six_ds($value);
        $bs = six_bose($value);
        $hsdx = six_hsdx($value);
        $hsds = six_hsds($value);
        $wsdx = six_wsdx($value);
        $wsds = six_wsds($value);
        $ret[$wfs[$key]] = [[$value],$dx,$ds,$bs,$hsdx,$hsds,$wsdx,$wsds];      
    }
    return $ret;
}

/**
 * 六合彩-定位
 * 正一-0
 */
function six_dw_bak($betData,$kjData){
    $parse = six_parse($kjData);
    $wfs = ["正一","正二","正三","正四","正五","正六","特码"];
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];    
    return in_array($bet,$parse[$wf]);
}

/**
 * 六合彩-定位 和局处理
 * 正一-0
 */
function six_dw($betData,$kjData){
    $kjData = explode(',',$kjData);
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];  

    $wfs = ["正一","正二","正三","正四","正五","正六","特码"];   
    $key = array_search($wf,$wfs);
    $ball = $kjData[$key];

    if(is_numeric($bet)){
        return $ball == $bet;
    }

    if(in_array($bet,['大','小'])){
        $res = six_dx($ball);
    }

    if(in_array($bet,['单','双'])){
        $res = six_ds($ball);
    }

    if(in_array($bet,['合大','合小'])){
        $res = six_hsdx($ball);
    }

    if(in_array($bet,['合单','合双'])){
        $res = six_hsds($ball);
    }

    if(in_array($bet,['尾大','尾小'])){
        $res = six_wsdx($ball);
    }

    if(in_array($bet,['尾单','尾双'])){
        $res = six_wsds($ball);
    }    

    if(in_array($bet,['红波','绿波','蓝波'])){
        $res = six_bose($ball);
    }    

    //和局
    if(49 == $res){
        return -1;
    }

    return $res == $bet;
}

/**
 * 六合彩-正码
 * 所选一个号码在6个正码中为赢
 */
function six_zm($betData,$kjData){
    $kjData = explode(',',$kjData);
    unset($kjData[6]);
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];      
    return in_array($bet,$kjData);
}

/**
 * 六合彩-连码
 * 四全中-1,2,3,4
 */
function six_lm($betData,$kjData){
 
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];    

    $bet = explode(',',$bet);
    $kjData = explode(',',$kjData);
    
    if('四全中' == $wf){
        unset($kjData[6]);        
        $bet = implode(' ',$bet);
        $ret = rx($bet,$kjData,4);
    }

    if('四中一' == $wf){
        unset($kjData[6]);
        $bet = implode(' ',$bet);
        $ret = rx($bet,$kjData,4,1);
    }

    if('三全中' == $wf){
        unset($kjData[6]);        
        $bet = implode(' ',$bet);
        $ret = rx($bet,$kjData,3);
    }

    if('三中二' == $wf){
        unset($kjData[6]);        
        $bet = implode(' ',$bet);
        $ret = rx($bet,$kjData,3,2);
    }    

    if('二全中' == $wf){
        unset($kjData[6]);        
        $bet = implode(' ',$bet);
        $ret = rx($bet,$kjData,2);
    }      

    /*
    if('二中特' == $wf){//7个号码中任2中2
        //unset($kjData[6]);        
        $bet = implode(' ',$bet);
        $ret = rx($bet,$kjData,2);
    }
    */
    if('二中特' == $wf){//2个号码中一个特码
        $ret = (int)in_array($kjData[6],_arr($bet));
    }

    if('特串' == $wf){
        //没中特码,判定为输
        $key == array_search($kjData[6],_arr($bet));
        if($key === false){
            return false;
        }
        array_splice($bet,$key,1);
        $bet = implode(' ',$bet);
        unset($kjData[6]);
        $ret = rx($bet,$kjData,1);
    }   

    return $ret;
}

/**
 * 六合彩-肖尾
 * '牛' ,'0尾'
 */
function six_xw($betData,$kjData){
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];  
    $kjData = explode(',',$kjData);
    $sx_ws = [];
    foreach($kjData as $ball){
        $sx_ws[] = six_sx($ball);
        $sx_ws[] = six_ws($ball);
    }
    return in_array($bet,$sx_ws);
}

/**
 * 六合彩-合肖,复式
 * '二肖-鼠,牛'
 */
function six_hx($betData,$kjData){
    $kjData = explode(',',$kjData);    
    $ball = $kjData[6];
    if(49 == $ball){
        return -1;
    }

    $sx = six_sx($ball);

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    return false !== strpos($bet,$sx);
}

/**
 * 六合彩-生肖连,
 * 二肖连中-鼠,牛
 */
function six_sxl($betData,$kjData){
    $kjData = explode(',',$kjData);
    foreach($kjData as &$ball){
        $ball = six_sx($ball);
    }

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];
    $bet = explode(',',$bet);
    $bet = implode(' ',$bet);

    if('二肖连中' == $wf){
        return rx($bet,$kjData,2);
    }

    if('三肖连中' == $wf){
        return rx($bet,$kjData,3);
    }

    if('四肖连中' == $wf){
        return rx($bet,$kjData,4);
    }

    if('五肖连中' == $wf){
        return rx($bet,$kjData,5);
    }

    if('二肖连不中' == $wf){
        return rx($bet,$kjData,2,0,'any_not_in');
    }

    if('三肖连不中' == $wf){
        return rx($bet,$kjData,3,0,'any_not_in');
    }

    if('四肖连不中' == $wf){
        return rx($bet,$kjData,4,0,'any_not_in');
    }     
}


/**
 * 六合彩-尾数连,
 * 二尾连中-1,6
 */
function six_wsl($betData,$kjData){
    $kjData = explode(',',$kjData);
    foreach($kjData as &$ball){
        $ball = six_ws2($ball);
    }

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];
    $bet = explode(',',$bet);
    $bet = implode(' ',$bet);

    if('二尾连中' == $wf){
        return rx($bet,$kjData,2);
    }

    if('三尾连中' == $wf){
        return rx($bet,$kjData,3);
    }

    if('四尾连中' == $wf){
        return rx($bet,$kjData,4);
    }

    if('二尾连不中' == $wf){
        return rx($bet,$kjData,2,0,'any_not_in');
    }

    if('三尾连不中' == $wf){
        return rx($bet,$kjData,3,0,'any_not_in');
    }

    if('四尾连不中' == $wf){
        return rx($bet,$kjData,4,0,'any_not_in');
    }     
}

/**
 * 六合彩-全不中,
 * 五不中-1,2,3,4,5,6
 */
function six_qbz($betData,$kjData){
    $kjData = explode(',',$kjData);

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];
    $bet = explode(',',$bet);
    $bet = implode(' ',$bet);

    if('五不中' == $wf){
        return rx($bet,$kjData,5,0,'any_not_in');
    }

    if('六不中' == $wf){
        return rx($bet,$kjData,6,0,'any_not_in');
    }

    if('七不中' == $wf){
        return rx($bet,$kjData,7,0,'any_not_in');
    }

    if('八不中' == $wf){
        return rx($bet,$kjData,8,0,'any_not_in');
    }

    if('九不中' == $wf){
        return rx($bet,$kjData,9,0,'any_not_in');
    }

    if('十不中' == $wf){
        return rx($bet,$kjData,10,0,'any_not_in');
    }   

    if('十一不中' == $wf){
        return rx($bet,$kjData,11,0,'any_not_in');
    }   

    if('十二不中' == $wf){
        return rx($bet,$kjData,12,0,'any_not_in');
    }

}


function six_bose($num){
    if($num==1 || $num==2 || $num==7 || $num==8 || $num==12 || $num==13 || $num==18 || $num==19 || $num==23 || $num==24 || $num==29 || $num==30 || $num==34 || $num==35 || $num==40 || $num==45 || $num==46){
        return '红波';
    }
    if($num==3 || $num==4 || $num==9 || $num==10 || $num==14 || $num==15 || $num==20 || $num==25 || $num==26 || $num==31 || $num==36 || $num==37 || $num==41 || $num==42 || $num==47 || $num==48){
        return '蓝波';
    }
    if($num==5 || $num==6 || $num==11 || $num==16 || $num==17 || $num==21 || $num==22 || $num==27 || $num==28 || $num==32 || $num==33 || $num==38 || $num==39 || $num==43 || $num==44 || $num==49){
        return '绿波';
    }
}

function six_ds($num){
    if($num==49){
        return '49';
    }
    if($num%2==0){
        return '双';
    }else{
        return '单';
    }
}

function six_dx($num){
    if($num==49){
        return '49';
    }
    if($num>24){
        return '大';
    }else{
        return '小';
    }
}

function six_wsdx($num){
    if($num==49){
        return '49';
    }
    $zhws = substr($num,strlen($num)-1);
    if($zhws>=5){
        return '尾大';
    }else{
        return '尾小';
    }
}

function six_wsds($num){
    if($num==49){
        return '49';
    }
    $zhws = substr($num,strlen($num)-1);
    if($num%2==0){
        return '尾双';
    }else{
        return '尾单';
    }
}

function six_hsdx($num){
    if($num==49){
        return '49';
    }
    if($num<10){$num='0'.$num;}
    $num1=substr($num,0,1);
    $num2=substr($num,1,1);
    $num3=$num1+$num2;
    if($num3>6){
        return '合大';
    }else{
        return '合小';
    }
}

function six_hsds($num){
    if($num==49){
        return '49';
    }
    if($num<10){$num='0'.$num;}
    $num1=substr($num,0,1);
    $num2=substr($num,1,1);
    $num3=$num1+$num2;
    if($num3%2==0){
        return '合双';
    }else{
        return '合单';
    }
}

function six_zhds($num){
    if($num%2==0){
        return '总和双';
    }else{
        return '总和单';
    }
}

function six_zhdx($num){
    if($num>=175){
        return '总和大';
    }else{
        return '总和小';
    }
}

function six_ws($num){
    return ($num%10)."尾";    
}

function six_ws2($num){
    return ($num%10);    
}

function six_sx($ball){
    $today = date("Y-m-d",time()+1*12*3600);
    require_once "../application/classes/Lunar.php";
    $lunar = new Lunar();
    $year = date("Y",$lunar->S2L($today));
    $ball = $ball % 12;
    $arr = array('猴','鸡','狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊');
    
    if( preg_match("/^\d{4}$/",$year))
    {
        $m = $year % 12;
        $x = $arr[$m];
    }
    
    switch ($x)
    {
        case '猪':
            $sx = array('猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠');
            break;
        case '狗':
            $sx = array('狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪');
            break;
        case '鸡':
            $sx = array('鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗');
            break;
        case '猴':
            $sx = array('猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡');
            break;
        case '羊':
            $sx = array('羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴');
            break;
        case '马':
            $sx = array('马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊');
            break;
        case '蛇':
            $sx = array('蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马');
            break;
        case '龙':
            $sx = array('龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇');
            break;
        case '兔':
            $sx = array('兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙');
            break;
        case '虎':
            $sx = array('虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔');
            break;
        case '牛':
            $sx = array('牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎');
            break;
        case '鼠':
            $sx = array('鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛');
            break;
        default:
            $sx = array('鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛');
    }
    if($ball==0){
        return $sx[11];
    }else{
        return $sx[$ball-1];
    }
}

/*
（九）七色波
以开出的7个色波，那种颜色最多为中奖。 开出的6个正码各以1个色波计，特别号以1.5个色波计。而以下3种结果视为和局。 
1： 6个正码开出3蓝3绿，而特别码是1.5红 
2： 6个正码开出3蓝3红，而特别码是1.5绿 
3： 6个正码开出3绿3红，而特别码是1.5蓝 
如果出现和局，所有投注红，绿，蓝七色波的金额将全数退回，玩家也可投注和局
（十）五行
挑选一个五行选项为一个组合，若开奖号码的特码在此组合内，即视为中奖；若开奖号码的特码不在此组合内，即视为不中奖； 
金：02、03、16、17、24、25、32、33、46、47 
木：06、07、14、15、28、29、36、37、44、45 
水：04、05、12、13、20、21、34、35、42、43 
火：01、08、09、22、23、30、31、38、39 
土：10、11、18、19、26、27、40、41、48、49
*/

function pk10_sm($betData,$kjData) {
    return pk10_enum($betData,$kjData);
}

function pk10_sz($betData,$kjData) {
    return pk10_enum($betData,$kjData);
}

/*
'3,4,18,19','和大','和单'
*/
function pk10_gyh($betData,$kjData) {

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = explode(',',$kjData);
    $gyh = $kjData[0] + $kjData[1];

    if(in_array($bet,['和大','和小'])){
        return $bet == pk10_gyh_dx($gyh);
    }

    if(in_array($bet,['和单','和双'])){
        return $bet == pk10_gyh_ds($gyh);
    }

    $bet = explode(',',$bet);
    return in_array($gyh,$bet);
}

function pk10_enum($betData,$kjData) {
    
    $wfs = ['冠军','亚军','季军','第四名','第五名','第六名','第七名','第八名','第九名','第十名'];

    $kjData = explode(',',$kjData);

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];
    
    if( ($key = array_search($wf,$wfs) ) !== FALSE){
        $ball = $kjData[$key];
        $ds = pk10_ds($ball);
        $dx = pk10_dx($ball);        
        $values = [$ball,$ds,$dx];
        if($key<=4){
            $lh = pk10_lh($kjData,$key+1);
            $values[] = $lh;
        }                
        return in_array($bet,$values);
    }

    return false;
}

function pk10_dx($num){
    if($num>5)return '大';
    else return '小';
}

function pk10_ds($num){
    if($num%2==0)return '双';
    else return '单';
}

function pk10_gyh_dx($num){
    if($num>11)return '和大';
    else return '和小';
}

function pk10_gyh_ds($num){
    if($num%2==0)return '和双';
    else return '和单';
}

function pk10_lh($kjData,$num=1){
    $total   = count($kjData); // 统计一共几个开奖号
    $val1    = intval($kjData[$num-1])  ;  //大位
    $val2    = intval($kjData[$total-$num]) ; //小位
    if($val1>$val2)return '龙';
    else return '虎';
}

function k3_hz($betData,$kjData){

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];
        
    $kjData = explode(',',$kjData);
    $ball = $kjData[0] + $kjData[1] + $kjData[2];

    $ds = k3_ds($ball);
    $dx = k3_dx($ball);        
    $values = [$ball,$ds,$dx];

    return in_array($bet,$values);
}

//豹子,顺子,对子,三不同
function k3_tx($betData,$kjData){
    $kjData = explode(',',$kjData);
    $bz = k3_baozi($kjData);

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    return $bet == $bz;
}

//三同号单选-111
function k3_3dx($betData,$kjData){

    if(!preg_match('/^(\d),\1,\1/',$kjData))return 0;

    $kjData = str_replace(',','',$kjData);

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    return $bet == $kjData;
}

//三不同-1,2,3, ;
function k3_3bt($betData,$kjData){
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $betData = $betData[1];

    //return any_in($betData,$kjData);//单注模式
    //$betData = str_replace(' ',',',$betData);
    return rx($betData,$kjData,3);  //多注模式
    return zx($betData,$kjData);
}

//二同号复选k3_2fx 二同号复选-11*
function k3_2fx($betData,$kjData){

    // 豹子不算中奖
    if (preg_match('/^(\d),\1,\1/',$kjData)) return 0;
    //如果三位数没有相同,则不中奖
    if(!preg_match('/(\d)(,\d)?,\1/',$kjData)) return 0;

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $betData = $betData[1];

    return any_in($betData,$kjData,2);//单注模式

}

//二同号单选k3_2dx 二同号单选-11,2
function k3_2dx_ds($betData,$kjData){

    // 豹子不算中奖
    if (preg_match('/^(\d),\1,\1/',$kjData)) return 0;
    //如果三位数没有相同,则不中奖
    if(!preg_match('/(\d)(,\d)?,\1/',$kjData)) return 0;

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $betData = $betData[1];

    $betData = str_replace(',','',$betData);

    return any_in($betData,$kjData);//单注模式
    
}

//二同号单选-11 22,3 4
function k3_2dx($betData,$kjData){
    $p = parse_repeat($kjData,1,2,1,1);
    if(!$p){
        return 0;
    }

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $betData = $betData[1];

    $number = _arr($betData);
    return array_contain($number[0],$p[0]) && array_contain($number[1],$p[1]);     
}

//二不同号k3_2bt 二不同号-1,2
function k3_2bt($betData,$kjData){
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $betData = $betData[1];

    //return any_in($betData,$kjData,2);//单注模式
    return rx($betData,$kjData,2);  //多注模式
}

//猜必出k3_bc 猜必出-1
function k3_bc($betData,$kjData){
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $betData = $betData[1];

    return any_in($betData,$kjData);//单注模式
}

//猜必不出k3_bbc
function k3_bbc($betData,$kjData){
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $betData = $betData[1];
        
    return any_not_in($betData,$kjData);//单注模式
}

function k3_dx($num){
    if($num>10)return '大';
    else return '小';
}

function k3_ds($num){
    if($num%2==0)return '双';
    else return '单';
}

function k3_baozi($num){
    $a = $num[0].$num[1].$num[2];

    if($num[0]==$num[1] && $num[0]==$num[2] && $num[1]==$num[2]){
        return '豹子';
    }else if($num[0]==$num[1] || $num[0]==$num[2] || $num[1]==$num[2]){
        return '对子';
    }else if(!array_diff(_arr('123'),$num) || !array_diff(_arr('234'),$num) || !array_diff(_arr('345'),$num) || !array_diff(_arr('456'),$num)){
        return '顺子';
    }else{
        return '三不同';
    }
}






function klsf_sm($betData,$kjData) {
    return klsf_enum($betData,$kjData);
}

function klsf_sz($betData,$kjData) {
    return klsf_enum($betData,$kjData);
}

//双面/数字/枚举盘玩法
function klsf_enum($betData,$kjData) {

    $single = ['第一球','第二球','第三球','第四球','第五球','第六球','第七球','第八球'];
    $zhlh = ['总和、龙虎'];

    $kjData = explode(',',$kjData);
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];  
    if( ($key = array_search($wf,$single) ) !== FALSE){

        $ball = $kjData[$key];

        if(is_numeric($bet)){
            return $ball == $bet;
        }

        if(in_array($bet,['大','小'])){
            $res = klsf_dx($ball);
        }    

        if(in_array($bet,['单','双'])){
            $res = klsf_ds($ball);
        }     

        if(in_array($bet,['尾大','尾小'])){
            $res = klsf_wsdx($ball);
        }      
        
        if(in_array($bet,['合单','合双'])){
           
            $res = klsf_hsds($ball);
        }  

        return $res == $bet;           
    }  

    if( ($key = array_search($wf,$zhlh) ) !== FALSE){
        $ball1 = $kjData[0];
        $ball2 = $kjData[7];
        $ball = $kjData[0] + $kjData[1] + $kjData[2] + $kjData[3]
            + $kjData[4] + $kjData[5] + $kjData[6] + $kjData[7];

        if(in_array($bet,['总单','总双'])){
            $res = klsf_zhds($ball);
        }    

        if(in_array($bet,['总大','总小'])){

            $res = klsf_zhdx($ball);
        }    

        if(in_array($bet,['总尾大','总尾小'])){

            $res = klsf_wszwdx($ball);

        }    

        if(in_array($bet,['总龙','总虎'])){
            $res = klsf_zhlh($ball1,$ball2);
        }

        //和局
        if(49 == $res){
            return -1;
        }

        return $res == $bet; 
    }

    return false;
}

function klsf_lh($betData,$kjData){

    $l = ['龙1','龙2','龙3','龙4','龙5','龙6','龙7','龙8'];
    $h = ['虎1','虎2','虎3','虎4','虎5','虎6','虎7','虎8'];

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $wf = explode('vs',$wf);

    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if ( ($key = array_search($wf[0],$l)) !== false ) {
        $num1 = $kjData[$key];
    }

    if ( ($key = array_search($wf[1],$h)) !== false ) {
        $num2 = $kjData[$key];
    }
    
    if($num1 > $num2){
        $ret = '龙';    
    }else{
        $ret = '虎';
    }

    return $bet == $ret;
}

function klsf_dx($num){
    if($num>10){
        return '大';        
    }
    else{
        return '小';
    }
}

function klsf_ds($num){
    if($num%2==0){
        return '双';
    }else{
        return '单';
    } 
}

function klsf_wsdx($num){
    $num = substr($num,strlen($num)-1);
    if($num>=5){
        return '尾大';
    }else{
        return '尾小';
    }
}
function klsf_wszwdx($num){
    $num = substr($num,strlen($num)-1);
    if($num>=5){
        return '总尾大';
    }else{
        return '总尾小';
    }
}

function klsf_wsds($num){
    $num = substr($num,strlen($num)-1);
    if($num%2==0){
        return '尾双';
    }else{
        return '尾单';
    }
}

function klsf_zhds($num){
    if($num%2==0){
        return '总双';
    }else{
        return '总单';
    }
}

function klsf_zhdx($num){
    if($num==84){
        return 84;
    }
    if($num>84){
        return '总大';
    }else{
        return '总小';
    }
}

function klsf_zhlh($num1,$num2){
    if($num1>$num2){
        return '总龙';
    }else{
        return '总虎';
    }
}

function klsf_hsds($num){
   // if($num<10){$num='0'.$num;}
  
    $num1=substr($num,0,1);
    $num2=substr($num,1,1);
    $num3=$num1+$num2;
    if($num3%2==0){
        return '合双';
    }else{
        return '合单';
    }
}


//百定位-0 百十定位-0,0
//百十定位扩展为复式存储  百十定位-01,03
function fc3d_dw($betData,$kjData){
    $pos = ['百','十','个'];
    $one = ['百定位','十定位','个定位'];
    $two = ['百十定位','百个定位','十个定位'];
    $three = ['百十个定位'];

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if ( ($key = array_search($wf,$one)) !== false ) {
        //return $bet == $kjData[$key];
        $ball = $kjData[$key];
        $dx = fc3d_dx($ball);
        $ds = fc3d_ds($ball);
        $zh = fc3d_zh($ball);
        return in_array($bet,[$ball,$dx,$ds,$zh]);
    }

    //百个定位
    if (in_array($wf,$two)) {
        /*
        $wf = mb_str_split($wf);
        $key0 = array_search($wf[0],$pos);
        $key1 = array_search($wf[1],$pos);
        $bet = explode(',',$bet);
        return $bet[0] == $kjData[$key0] && $bet[1] == $kjData[$key1];
        */
        $wf = mb_str_split($wf);
        $key0 = array_search($wf[0],$pos);
        $key1 = array_search($wf[1],$pos);
        return fs($bet,$kjData[$key0].','.$kjData[$key1]);
    }

    if (in_array($wf,$three)) {
        /*
        $bet = explode(',',$bet);
        return $bet[0] == $kjData[0] && $bet[1] == $kjData[1] && $bet[2] == $kjData[2];
        */
        return fs($bet,implode(",", $kjData));
    }

    return false;
}

//三字组合-5,6,7
function fc3d_zx($betData,$kjData){

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    return any_in($bet,$kjData);
}

/**
 * 和数
 * 百十个和数尾数-2
 */
function fc3d_hs($betData,$kjData) {

    $pos = ['百','十','个'];
    $two = ['百十和数','百十和数尾数',
            '百个和数','百个和数尾数',
            '十个和数','十个和数尾数',
        ];
    $three = ['百十个和数','百十个和数尾数',];

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    if (in_array($wf,$two)) {
        $wfs = mb_str_split($wf);
        $key0 = array_search($wfs[0],$pos);
        $key1 = array_search($wfs[1],$pos);
        $value0 = $kjData[$key0];
        $value1 = $kjData[$key1];
        $value  = $value0 + $value1;

        if (strpos($wf,'尾数') === false ) {
            $dx = fc3d_dx2($value);
            $num = fced_numeric2($value);
        }else{
            $value = fc3d_ws($value);
            $dx = fc3d_dx($value);
            $num = $value;
        }
    }

    if (in_array($wf,$three)) {
        $value = $kjData[0] + $kjData[1] + $kjData[2];
        if (strpos($wf,'尾数') === false ) {
            $dx = fc3d_dx3($value);
            $num = fced_numeric3($value);
        }else{
            $value = fc3d_ws($value);
            $dx = fc3d_dx($value);
            $num = $value;
        }
    }

    /*
    if(is_numeric($bet)){
        return $bet == $value;
    }
    */
    if($bet == $num){
        return true;
    }

    if(in_array($bet,['大','小'])){
        if($dx == 9){
            return -1;
        }
        return $bet == $dx;
    }

    //合数没有质合,或者说合数质合 便是 其尾数的质合,单双同理
    if (strpos($wf,'尾数') !== false ) {
        $ws = fc3d_ws($value);
        if(in_array($bet,['单','双'])){
            $ds = fc3d_ds($ws);
            return $bet == $ds;
        }
        if(in_array($bet,['质','合'])){
            $zh = fc3d_zh($ws);
            return $zh ==  $bet;
        }
    }

    return false;
}

//组选三-1,2,3,4,9
function fc3d_z3($betData,$kjData) {
    //豹子不算中,3个开奖号码都落在2个号码的数组中算中;
    //选择5个号码,5选2中组合都要判定;无需组合

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    //$kjData = explode(',',$kjData);

    // 豹子不算中奖
    if (preg_match('/^(\d),\1,\1/',$kjData)) return 0;

    //如果三位数没有相同,则不中奖
    if(!preg_match('/(\d)(,\d)?,\1/',$kjData)) return 0;

    //3个开奖号码 不落在 所选N个号码中, 判定为不中, 在里面判定为中;
    //return array_contain(_arr($bet),_arr($kjData));    
    return array_include(_arr($bet),_arr($kjData));    
}

/**
 * 组选六-0,1,2,3,4
 */
function fc3d_z6($betData,$kjData) {

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    // 豹子不算中奖
    if (preg_match('/^(\d),\1,\1/',$kjData)) return 0;

    //如果三位数有对子,则不中奖
    if(preg_match('/(\d)(,\d)?,\1/',$kjData)) return 0;

    //3个开奖号码 不落在 所选N个号码中, 判定为不中, 在里面判定为中;
    //return array_contain(_arr($bet),_arr($kjData)); 
    return array_include(_arr($bet),_arr($kjData)); 
}

/**
 * 跨度-0
 */
function fc3d_kd($betData,$kjData) {

    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];

    $kjData = explode(',',$kjData);

    sort($kjData);

    return $bet == $kjData[2]-$kjData[0];
}

function fced_numeric2($num){
    if($num<=4){
        $num = '0~4';
    }
    if($num>=18){
        $num = '14~18';
    }
    return $num;
}

function fced_numeric3($num){
    if($num<=6){
        $num = '0~6';
    }
    if($num>=21){
        $num = '21~27';
    }
    return $num;
}

function fc3d_dx($num){
    if($num>4){
        return '大';
    }else{
        return '小';
    }
}
function fc3d_dx2($num){
//两数和值0-18有19个数字,9位和局,
//400w没有两数和值;
    if($num==9)return 9;
    if($num>9){
        return '大';
    }else{
        return '小';
    }    
}
function fc3d_dx3($num){
    if($num>13){
        return '大';
    }else{
        return '小';
    }
}
function fc3d_ds($num){
    if($num%2==0){
        return '双';
    }else{
        return '单';
    }
}
function fc3d_zh($num){
    if(in_array($num,[1,2,3,5,7])){
        return '质';
    }else{
        return '合';
    }
}

function fc3d_ws($num){
    return ($num%10);    
}





function xy28_dw($betData,$kjData){
    $betData = explode('-',$betData);
    $wf = $betData[0];
    $bet = $betData[1];
    
    $kjData = explode(',',$kjData);
    $hz = $kjData[0] + $kjData[1] + $kjData[2];

    if('特码' == $wf){
        $res = $hz;
        return $bet == $res;
    }

    // in_array($bet,sm)

    if('双面' == $wf){
        if(in_array($bet,['大','小'])){
            $res = xy28_dx($hz);
        }

        if(in_array($bet,['单','双'])){
            $res = xy28_ds($hz);
        }

        if(in_array($bet,['大单','小单','大双','小双'])){
            $res = xy28_dxds($hz);
        }

        if(in_array($bet,['极大','极小'])){
            $res = xy28_jdx($hz);
        }        

        if(in_array($bet,['红波','绿波','蓝波'])){
            $res = xy28_bose($hz);
        }

        if(in_array($bet,['豹子'])){
            $res = xy28_bz($kjData);
        }

        return $bet == $res;
    }

    if('三压一' == $wf){
        return in_array($hz,_arr($bet));
    }

    return 0;
}

function xy28_bz($kjData){
    $ret = '';
    $kjData = _arr($kjData);
    if( $kjData[0]==$kjData[1] && $kjData[1]==$kjData[2] ){
        $ret = '豹子';
    }
    return $ret;
}

function xy28_3y1(){

}

function xy28_dx($num){
    return ($num>=14)?'大':'小';
}

function xy28_jdx($num){
    $ret = '';
    if($num>=22){
        $ret = '极大';
    }
    if($num<=5){
        $ret = '极小'; 
    }
    return $ret;
}

function xy28_ds($num){
    return ($num%2==0)?'双':'单';
}

function xy28_dxds($num){
    $dx = xy28_dx($num);
    $ds = xy28_ds($num);
    return $dx.$ds;
}

function xy28_bose($num){
    $ret = '';
    $green = [1,4,7,10,16,19,22,25];
    $blue  = [2,5,8,11,17,20,23,26];
    $red   = [3,6,9,12,15,18,21,24];
    if(in_array($num,$green)){
        $ret = '绿波';
    }
    if(in_array($num,$blue)){
        $ret = '蓝波';
    }
    if(in_array($num,$red)){
        $ret = '红波';
    }        
    return $ret;
}


