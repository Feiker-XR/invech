<?php

//快速调试函数
function dd($data) {
    echo '<pre>';
    print_r($data);die;
}

//microtime微秒,返回6精度的秒数
function runtime($microtime){
    $runtime    = round(microtime(true) - $microtime, 10);
    return number_format($runtime, 6);
}

function is_repeat($arr){
    return count(array_unique(_arr($arr))) != count(_arr($arr));
}

function array_remove($arr,$val){
    $key = array_search($val,$arr);
    if($key !== false){
        unset($arr[$key]);
    }
    return $arr;
}

//mb_split原生函数,用正则分割字符串
function mb_str_split($mb){
    return preg_split('/(?<!^)(?!$)/u',$mb);    
}

// 字符串分隔次序: '|' > ',' > ' '
function _arr($str,$delim='',$split=true){
    if(is_array($str)){
        return $str;
    }

    if(is_null($str)){
        return [];
    }

    if($delim){
        return explode($delim,$str);
    }else{
        if(false !== strpos($str, '|')){
            return explode('|',$str);
        }elseif(false !== strpos($str, ',')){
            return explode(',',$str);
        }elseif(false !== strpos($str, ' ')){
            return explode(' ',$str);
        }else{
            if($split){
                return mb_str_split($str);
            }else{
                return [$str];
            }
        }        
    }
}

//时时双面 总和、龙虎和-总单  不做split分割
//fc3d  百十和数-14~18        不做split分割
//pk10  冠亚军和-3,4,18,19    不能根据','分割,
//pk10  冠亚军和-和大         也不能split分割
function _arr_no_split($str){//默认分隔符分割,但是不要split
    return _arr($str,'',false);
}

function _arr_no_delim($str){//不用默认分隔符分割
    return _arr($str,'X');
}

function _arr_fs_split($str){
    $ret = [];
    foreach(_arr($str) as $arr){
        $ret = array_merge($ret,_arr($arr));
    }
    return $ret;
}

//任选的通配符处理
function rx_tpf($betData,$kjData){
    $tmpArr = explode(',' , $kjData) ;
    foreach(_arr($betData) as $key=>$bet){
        if('-' == $bet){
            $tmpArr[$key] = '-';
        }
    }
    return implode(',',$tmpArr);
}

//未使用
function rx_tpf_ds($betData,$kjData){
    $pairs = [];
    $betData = _arr($betData,'|');
    foreach ($betData as $bets) {
        $bets  = _arr($bets);
        $kjs  = _arr($kjData);   
        foreach($bets as $key=>$bet){
            if('-' == $bet){                                
                unset($bets[$key]);
                unset($kjs[$key]);
            }
        }
        $bets = implode(',',$bets);
        $kjs = implode(',', $kjs);
        $pairs[] = [$bets,$kjs];
    }
    return $pairs;
}

function rx_tpf_trim(&$betData,&$kjData){

    $ret = 0;

    $bets = _arr($betData);
    $kjs  = _arr($kjData);
    
    foreach($bets as $key=>$bet){
        if('-' == $bet){
            //array_splice($bets,$key,1);
            //array_splice($kjs,$key,1);
            unset($bets[$key]);
            unset($kjs[$key]);
            $ret++;
        }
    }

    $betData = implode(',',$bets);
    $kjData = implode(',', $kjs);

    return $ret;
}

//任选的位掩码处理
function rx_wym($w,$kjData){   
    $kjData = _arr($kjData);
    $weishu = [16,8,4,2,1] ;    
    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) {
            //array_splice($kjData,$key,1);
            unset($kjData[$key]);
        }
    }
    return implode(',',$kjData);
}

//num=3,前三,num=-3,后三;
function _qh($kjData,$num = 0){
    $arr = _arr($kjData);
    if($num == 0){
        $arr = [];
    }
    if($num > 0){
        $arr = array_slice($arr,0,$num);
    }
    if($num < 0){
        $arr = array_slice($arr,$num,-$num);
    }
    return implode(',',$arr);
}



//$times = 1 , $num1 = 3 表示出现1个3重号
function parse_repeat($kjData,$times1,$num1,$times2=0,$num2=1){
    $val = array_count_values(_arr($kjData));
    $cnt = array_count_values($val);
    $arr1 = [];$arr2=[];
    $b1 = ($cnt[$num1]??0) == $times1;
    $b2 = ($cnt[$num2]??0) == $times2;
    if($b2 && $b2){
        foreach ($val as $key => $value) {
            if($value == $num1){
                $arr1[] = $key;
            }
            if($value == $num2){
                $arr2[] = $key;
            }            
        }
        return [$arr1,$arr2];
    }

    return [];
}

function array_equal($arr1,$arr2){
    $arr11 = _arr($arr1);
    $arr22 = _arr($arr2);
    sort($arr11);
    sort($arr22);
    return $arr11 == $arr22;
}

function array_intersect_my($arr1,$arr2){
    $arr1 = _arr($arr1);
    $arr2 = _arr($arr2);    
    $ret = [];
    foreach ($arr1 as $value) {
        $index = array_search($value,$arr2);
        if($index !== false){
            $ret[] = $value;
            array_splice($arr2, $index, 1); 
        }
    }
    return $ret;
}

function array_contain($arr1,$arr2){
    $sub = array_intersect_my($arr1,$arr2);
    return array_equal($sub,$arr2);
}

function array_include($arr1,$arr2){
    $diff = array_diff(_arr($arr2),_arr($arr1));
    return empty($diff);
}

//判定某注输赢 四中一,四中二,三中二,四全中 都可以
function any_in($bet,$kjData,$num=0){
    //$set = array_intersect(_arr($bet),_arr($kjData));
    $set = array_intersect_my(_arr($bet),_arr($kjData));

    //return !empty($set); 
    
    $num1 = count(_arr($bet));
    $num2 = count(_arr($kjData));
    
    if(0==$num1||0==$num2){
        return false;
    }
    
    $min = ($num1<$num2)?$num1:$num2;
    if($num>$min){
        throw new \Exception("任选命中次数参数有误!");        
    }
    if(!$num){
        $num = $min;
    }
    return count($set) >= $num; 
}

//全不中;
function any_not_in($bet,$kjData,$num=0){
    $set = array_intersect(_arr($bet),_arr($kjData));

    return count($set) == 0;
}

function trim_zero($arr){
    //$arr = preg_split("/(|,)/",$string);//多个分隔符进行分隔
    return preg_replace_callback('/\d{2}/', function($matches){
        return (int)$matches[0];
    }, $arr);
}


//重庆时时彩顺子，半顺判断函数
function ssc_sorts($a, $p){
    $i = 0; $tmp=0; 
    foreach ($a as $k=>$v)
    {
        if($v == @$a[$k-1]+1 || $v == @$a[$k+1]-1)
        {
            $tmp = $v;
            if (isset($date[$i]) && end($date[$i])+1 == $tmp) 
            {
                $date[$i][] = $tmp;
            } else {
                $date[++$i][] = $tmp;
            }
        }
    }
    if (count(@$date[1]) == $p || count(@$date[2]) == $p)
        $a = true;
    else 
        $a = false;
    return $a;
}

function ssc_baozi($num){
    $a = $num[0].$num[1].$num[2];
    $hm = [$num[0],$num[1],$num[2],];
    sort($hm);
    $match = '/.09|0.9|09.|.90|9.0|90./';
    if($num[0]==$num[1] && $num[0]==$num[2] && $num[1]==$num[2]){
        return '豹子';
    }else if($num[0]==$num[1] || $num[0]==$num[2] || $num[1]==$num[2]){
        return '对子';
    }else if($a == '012' || $a == '021' || $a == '102' || $a == '120' || $a == '201' || $a == '210' || $a == '123' || $a == '132' || $a == '213' || $a == '231' || $a == '312' || $a == '321' || $a == '234' || $a == '243' || $a == '324' || $a == '342' || $a == '423' || $a == '432' || $a == '345' || $a == '354' || $a == '435' || $a == '453' || $a == '534' || $a == '543' || $a == '456' || $a == '465' || $a == '546' || $a == '564' || $a == '645' || $a == '654' || $a == '567' || $a == '576' || $a == '657' || $a == '675' || $a == '756' || $a == '765' || $a == '678' || $a == '687' || $a == '768' || $a == '786' || $a == '867' || $a == '876' || $a == '789' || $a == '798' || $a == '879' || $a == '897' || $a == '978' || $a == '987' || $a == '890' || $a == '809' || $a == '980' || $a == '908' || $a == '089' || $a == '098' || $a == '901' || $a == '910' || $a == '091' || $a == '019' || $a == '190' || $a == '109' || ssc_sorts($hm, 3)){
        return '顺子';
    }else if(preg_match($match, $a) || ssc_sorts($hm, 2)){
        return '半顺';
    }else{
        return '杂六';
    }
}
?>