<?php
use app\logic\ip2addr;

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 获取上级的信息
 * @return Ambigous <\think\static, NULL>
 */
function getTopUid(){
    $intro = @$_REQUEST['intro'];
    $domain = $_SERVER['HTTP_HOST'];
    if(!empty($intro)){  //Url中介绍人不为空,则默认介绍人为intro
        $user = new \app\model\user();
        $userinfo = $user->get(function($query) use ($intro){
            $query->where('username',$intro);
        });
    }elseif(!empty($domain)){
        $url = new \app\model\dailiurl();
        $info = $url -> get(function($query) use ($domain){
            $query->where('domain',$domain);
        });
        $user = new \app\model\user();
        $uid = $info['uid'];
        $userinfo = $user->get($uid);
    }
    return $userinfo;
}


function double_format($double_num){
    return $double_num>0 ? sprintf("%.2f",$double_num) : $double_num<0 ? sprintf("%.2f",$double_num) : 0;
}

function NOnull($str){
    return $str>0?sprintf("%.2f",$str):0;
}

function NOkong($str2){
    return $str2<>""?$str2:0;
}

function sessionNum($uid,$type,$cal=''){
	if(!$_SESSION["sessionIf"]){
		$_SESSION["sessionIf"] = 1;
		$_SESSION["sessionTime"] = time();
		$_SESSION["3ssessionIf"] = 1;
		$_SESSION["3ssessionTime"] = time();
	}

	$time3 = time() - $_SESSION["3ssessionTime"];	
	if($time3>='60') {
		$_SESSION["3ssessionIf"]   = '0';
		$_SESSION["3ssessionTime"] = time();
	}
	if($_SESSION["3ssessionIf"]<='50'){
		$_SESSION["3ssessionIf"] = $_SESSION["3ssessionIf"]+1;	
	}else{
		global $mysqli;
		$mysqli->query("update `k_user` set `is_stop`=1 where uid='$uid'");	
		@session_destroy();
	}
	$time  = time() - $_SESSION["sessionTime"];
	if($time>='30') {
		$_SESSION["sessionIf"]   = '0';
		$_SESSION["sessionTime"] = time();
	}
	if($_SESSION["sessionIf"]<=25){
		$_SESSION["sessionIf"] = $_SESSION["sessionIf"]+1;
	}else{
		$_SESSION["sessionTime"] = time();
		if($type==3) {
			echo "<div id=\"location\"  style='line-height:40px;text-align:center;color:#666; border-bottom:1px solid #999;'>对不起,您点击页面太快,请在60秒后进行操作</div><script>check();</script>";
		}elseif($type==4){
			$json['zq']				= 0;
			$json['zq_ds']			= 0;
			$json['zq_gq']			= 0;
			$json['zq_sbc']			= 0;
			$json['zq_sbbd']		= 0;
			$json['zq_bd']			= 0;
			$json['zq_rqs']			= 0;
			$json['zq_bqc']			= 0;
			$json['zq_jg']			= 0;
			$json['zqzc']			= 0;
			$json['zqzc_ds']		= 0;
			$json['zqzc_sbc']		= 0;
			$json['zqzc_sbbd']		= 0;
			$json['zqzc_bd']		= 0;
			$json['zqzc_rqs']		= 0;
			$json['zqzc_bqc']		= 0;
			$json['lm']				= 0;
			$json['lm_ds']			= 0;
			$json['lm_dj']			= 0;
			$json['lm_gq']			= 0;
			$json['lm_jg']			= 0;
			$json['lmzc']			= 0;
			$json['lmzc_ds']		= 0;
			$json['lmzc_dj']		= 0;
			$json['wq']				= 0;
			$json['wq_ds']			= 0;
			$json['wq_bd']			= 0;
			$json['wq_jg']			= 0;
			$json['pq']				= 0;
			$json['pq_ds']			= 0;
			$json['pq_bd']			= 0;
			$json['pq_jg']			= 0;
			$json['bq']				= 0;
			$json['bq_ds']			= 0;
			$json['bq_zdf']			= 0;
			$json['bq_jg']			= 0;
			$json['bqzc']			= 0;
			$json['bqzc_ds']		= 0;
			$json['bqzc_zdf']		= 0;
			$json['gj']				= 0;
			$json['gj_gj']			= 0;
			$json['gj_gjjg']		= 0;
			$json['gj_jg']			= 0;
			$json['jr']				= 0;
			$json['jr_jr']			= 0;
			$json['jr_jrjg']		= 0;
			$json['jr_jg']			= 0;
			$json['tz_money']		= "0 RMB";
			$json['user_money']		= "0 RMB";
			$json['user_num']		= 0;
			echo $cal."(".json_encode($json).");";
		}else{
			$json["fy"]["p_page"] = "error2";
			echo $type."(".json_encode($json).");";
		}
		exit;
	}
	return true;
}

/**
 * js 页面提示信息，后重定向页面
 */
function message($value,$url=""){ //默认返回上一页
	header("Content-type: text/html; charset=utf-8");
	$js  ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>message</title>
</head>
			
<body>';
	$js  .= "<script type=\"text/javascript\" language=\"javascript\">\r\n";
	$js .= "alert(\"".$value."\");\r\n";
	if($url) $js .= "window.location.href=\"$url\";\r\n";
	else $js .= "window.history.go(-1);\r\n";
	$js .= "</script>\r\n";
	$js.="</body></html>";
	echo $js;
	exit;
}

function write_bet_info($ball_sort,$column,$master_guest,$bet_point,$match_showtype,$match_rgg,$match_dxgg,$match_nowscore,$tid=0){
    $dm			=	explode("VS.",$master_guest); //队名
    $qcrq		=	array("Match_Ho","Match_Ao"); //全场让球盘口
    $qcdx		=	array("Match_DxDpl","Match_DxXpl"); //全场大小盘口
    $ds			=	array("Match_DsDpl","Match_DsSpl"); //单双
    $info		=	"";
    if(strrpos($ball_sort,"足球") === 0){
        $bcrq	=	array("Match_BHo","Match_BAo"); //半场让球盘口
        $bcdx	=	array("Match_Bdpl","Match_Bxpl"); //半场大小盘口
        $qcdy	=	array("Match_BzM","Match_BzG","Match_BzH"); //全场独赢
        $bcdy	=	array("Match_Bmdy","Match_Bgdy","Match_Bhdy"); //半场独赢
        $sbbdz	=	array("Match_Hr_Bd10","Match_Hr_Bd20","Match_Hr_Bd21","Match_Hr_Bd30","Match_Hr_Bd31","Match_Hr_Bd32","Match_Hr_Bd40","Match_Hr_Bd41","Match_Hr_Bd42","Match_Hr_Bd43"); //上半波胆主
        $sbbdk	=	array("Match_Hr_Bdg10","Match_Hr_Bdg20","Match_Hr_Bdg21","Match_Hr_Bdg30","Match_Hr_Bdg31","Match_Hr_Bdg32","Match_Hr_Bdg40","Match_Hr_Bdg41","Match_Hr_Bdg42","Match_Hr_Bdg43"); //上半波胆客
        $sbbdp	=	array("Match_Hr_Bd00","Match_Hr_Bd11","Match_Hr_Bd22","Match_Hr_Bd33","Match_Hr_Bd44","Match_Hr_Bdup5"); //上半波胆平
        $bdz	=	array("Match_Bd10","Match_Bd20","Match_Bd21","Match_Bd30","Match_Bd31","Match_Bd32","Match_Bd40","Match_Bd41","Match_Bd42","Match_Bd43"); //波胆主
        $bdk	=	array("Match_Bdg10","Match_Bdg20","Match_Bdg21","Match_Bdg30","Match_Bdg31","Match_Bdg32","Match_Bdg40","Match_Bdg41","Match_Bdg42","Match_Bdg43"); //波胆客
        $bdp	=	array("Match_Bd00","Match_Bd11","Match_Bd22","Match_Bd33","Match_Bd44","Match_Bdup5"); //波胆平
        $rqs	=	array("Match_Total01Pl","Match_Total23Pl","Match_Total46Pl","Match_Total7upPl"); //入球数
        $bqc	=	array("Match_BqMM","Match_BqMH","Match_BqMG","Match_BqHM","Match_BqHH","Match_BqHG","Match_BqGM","Match_BqGH","Match_BqGG"); //半全场

        if(in_array($column,$qcrq) || in_array($column,$bcrq)){ //让球
            if(in_array($column,$qcrq))		$info	.=	"让球-";
            else	$info	.=	"上半场让球-";
            	
            if($match_showtype ==	"H")	$info	.=	"主让$match_rgg-";
            else	$info	.=	"客让$match_rgg-";
            	
            if($column == "Match_Ho" || $column == "Match_BHo") $info .= $dm[0];
            else	$info	.=	$dm[1];
            	
        }elseif(in_array($column,$qcdx) || in_array($column,$bcdx)){ //大小
            if(in_array($column,$qcdx)){
                $info		.=	"大小-";
                if($column	==	"Match_DxDpl")	$info	.=	"O";
                else $info	.=	"U";
            }else{
                $info		.=	"上半场大小-";
                if($column	==	"Match_Bdpl")	$info	.=	"O";
                else $info	.=	"U";
            }
            $info			.=	$match_dxgg;
        }elseif(in_array($column,$qcdy) || in_array($column,$bcdy)){ //独赢
            if(in_array($column,$qcdy))			$info	.=	"标准盘-";
            else	$info	.=	"上半场标准盘-";
            	
            if(		$column == "Match_BzM" || $column == "Match_Bmdy") $info	.=	$dm[0]."-独赢";
            elseif(	$column == "Match_BzG" || $column == "Match_Bgdy") $info	.=	$dm[1]."-独赢";
            else	$info	.=	"和局";
        }elseif(in_array($column,$ds)){ //单双
            $info			.=	"单双-";
            if($column 		== "Match_DsDpl")	$info .= "单";
            else	$info	.=	"双";
        }elseif(in_array($column,$sbbdz) || in_array($column,$sbbdk) || in_array($column,$sbbdp) || in_array($column,$bdz) || in_array($column,$bdk) || in_array($column,$bdp)){ //波胆
            if(in_array($column,$sbbdz) || in_array($column,$sbbdk) || in_array($column,$sbbdp)) $info	.=	"上半波胆-";
            else	$info	.=	"波胆-";
            	
            if(strrpos($column,"up5")){
                $info		.=	"UP5";
            }else{
                $z			 =	substr($column,-2,1);
                $k			 =	substr($column,-1,1);
                if(in_array($column,$sbbdz) || in_array($column,$bdz))	$info	.=	$z.":".$k;
                else $info	.=	$k.":".$z;
            }
        }elseif(in_array($column,$rqs)){ //入球数
            $info			.=	"入球数-";
            if(strrpos($column,"7up")){
                $info		.=	"7UP";
            }else{
                $info		.=	substr($column,-4,1)."~".substr($column,-3,1);
            }
        }elseif(in_array($column,$bqc)){ //半全场
            $info			.=	"半全场-";
            $n1				 = "".substr($column,-2,1);
            $n2				 = "".substr($column,-1,1);
            $n1				 = ($n1 === "H" ? "和" : ($n1 === "M" ? "主" : "客"));
            $n2				 = ($n2 === "H" ? "和" : ($n2 === "M" ? "主" : "客"));
            $info			.=	$n1."/".$n2;
        }
        if($ball_sort		==	"足球滚球"){
            $info		  	.=	"(".$match_nowscore.")";
        }
        $info				.=	"@".$bet_point;

    }elseif(strrpos($ball_sort,"篮球") === 0){
        if(in_array($column,$qcrq)){
            $info			.=	"让分-";
            if($match_showtype ==	"H") $info	.=	"主让$match_rgg-";
            else	$info	.=	"客让$match_rgg-";
            	
            if($column 		== "Match_Ho")$info .= $dm[0];
            else	$info	.=	$dm[1];
            	
        }elseif(in_array($column,$qcdx)){
            $info			.=	"大小-";
            if($column		==	"Match_DxDpl")$info	.=	"O$match_dxgg";
            else $info		.=	"U$match_dxgg";
            	
        }elseif(in_array($column,$ds)){ //单双
            $info			.=	"单双-";
            if($column 		== "Match_DsDpl")	$info .= "单";
            else	$info	.=	"双";
        }
        $info			  	.=	"@".$bet_point;
    }elseif(strrpos($ball_sort,"棒球") === 0 || strrpos($ball_sort,"网球") === 0 || strrpos($ball_sort,"排球") === 0){
        $qcdy	=	array("Match_BzM","Match_BzG","Match_BzH"); //全场独赢
        if(in_array($column,$qcrq)){
            $info			.=	"让球-";
            if($match_showtype ==	"H") $info	.=	"主让$match_rgg-";
            else	$info	.=	"客让$match_rgg-";
            	
            if($column 		== "Match_Ho")$info .= $dm[0];
            else	$info	.=	$dm[1];
            	
        }elseif(in_array($column,$qcdx)){
            $info			.=	"大小-";
            if($column		==	"Match_DxDpl")$info	.=	"O$match_dxgg";
            else $info		.=	"U$match_dxgg";
            	
        }elseif(in_array($column,$ds)){ //单双
            $info			.=	"单双-";
            if($column 		== "Match_DsDpl")	$info .= "单";
            else	$info	.=	"双";
        }elseif(in_array($column,$qcdy)){ //独赢
            $info			.=	"标准盘-";
            	
            if(		$column == "Match_BzM") $info	.=	$dm[0]."-独赢";
            elseif(	$column == "Match_BzG") $info	.=	$dm[1]."-独赢";
        }
        $info			  	.=	"@".$bet_point;
    }elseif(strrpos($ball_sort,"金融") === 0 || strrpos($ball_sort,"冠军") === 0){
        global $mysqlis;
        $query	=	$mysqlis->query("SELECT team_name FROM t_guanjun_team where tid=$tid limit 1");
        $row	=	$query->fetch_array();
        if(strrpos($ball_sort,"金融") === 0) $row['team_name']=strtolower(str_replace(" ",'',$row['team_name']));
        $info	=	$row['team_name'].'@'.$bet_point;
    }
    return $info;
}

/**
 * 根据新浪 IP地址获取所在城市
 */
function GetIpLookup($ip = ''){
	if(empty($ip)){
		$ip = GetIp();
	}
	$iplookup = config('iplookup');
	//$res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
	$res = @file_get_contents("{$iplookup}?format=js&ip=" . $ip);

	if(empty($res)){ return false; }
	$jsonMatches = array();
	preg_match('#\{.+?\}#', $res, $jsonMatches);
	if(!isset($jsonMatches[0])){ return false; }
	$json = json_decode($jsonMatches[0], true);
	if(isset($json['ret']) && $json['ret'] == 1){
		$json['ip'] = $ip;
		unset($json['ret']);
	}else{
		return false;
	}
	return $json;
} 

function object2array(&$object) {
	$object =  json_decode( json_encode( $object),true);
	return  $object;
}

function getMatchTable($ball_sort){
    switch ($ball_sort){
        case '足球滚球':
        case '足球单式':
            return 'bet_match';
        case '冠军':
            return 't_guanjun';
        case '金融':
            return 'bet_match';
        case '篮球滚球':
        case '篮球单式':
            return 'lq_match';
        case '棒球单式':
            return 'baseball_match';
        case '网球单式':
            return 'tennis_match';
        case '排球单式':
            return 'volleyball_match';
    }
}


//Manage\Sports\Get_Point.php的两个函数挪过来

if (!function_exists('make_point')) {

function make_point($column,$mb_inball,$tg_inball,$mb_inball_hr,$tg_inball_hr,$match_type,$match_showtype,$rgg,$dxgg,$match_nowscore){

if(empty($mb_inball))$mb_inball=0;
if(empty($tg_inball))$tg_inball=0;
if(empty($mb_inball_hr))$mb_inball_hr=0;
if(empty($tg_inball_hr))$tg_inball_hr=0;
$temp = 0;

    if($mb_inball<0){ //全场取消
        return array("column"=>$column,"ben_add"=>0,"status"=>3,"mb_inball"=>$mb_inball,"tg_inball"=>$tg_inball);
    }elseif($mb_inball=="" && $mb_inball_hr<0){ //半场取消
        return array("column"=>$column,"ben_add"=>0,"status"=>3,"mb_inball"=>$mb_inball_hr,"tg_inball"=>$tg_inball_hr);
    }
    $ben_add    =   0;
    $status     =   2; //默认为输
    $mb_temp = 0;
    $tg_temp = 0;
    switch ($column){
        case 'match_bzm'://标准盘独赢
            if($mb_inball>$tg_inball) $status=1; break;
        case 'match_bzg':
            if($mb_inball<$tg_inball) $status=1; break;
        case 'match_bzh':
            if($mb_inball==$tg_inball) $status=1;break;
        case 'match_ho':
            $m          =   explode('/',$rgg);
            $ben_add    =   1;
            if(count($m)==2){  
                foreach($m as $k){
                    if(strtolower($match_showtype)=='h'){
                        $mb_temp    =   $mb_inball;
                        $tg_temp    =   $tg_inball+$k;
                    }else{
                        $mb_temp    =   $mb_inball+$k;
                        $tg_temp    =   $tg_inball;
                    }
                    if($match_type==2){ // 如果是滚球,减去下注比分
                        $n          =   explode(':',$match_nowscore);
                        $mb_temp    -=  intval($n[0] ?? 0);
                        $tg_temp    -=  intval($n[1] ?? 0);
                    }
                    if($mb_temp>$tg_temp) $temp+=1;
                    elseif($mb_temp==$tg_temp) $temp+=0.5;
                    else $temp+=0;
                }
                if($temp==0.5) $status=5;
                elseif($temp==1.5) $status=4;
                elseif($temp==2) $status=1;
                elseif($temp==0) $status=2;
            }else{ 
                if(strtolower($match_showtype)=='h'){
                    $mb_temp    =   $mb_inball;
                    $tg_temp    =   $tg_inball+$rgg;
                }else{
                    $mb_temp    =   $mb_inball+$rgg;
                    $tg_temp    =   $tg_inball;
                }
                if($match_type==2){ // 如果是滚球,减去下注比分
                    $n          =   explode(':',$match_nowscore);
                    $mb_temp    -=  intval($n[0] ?? 0);
                    $tg_temp    -=  intval($n[1] ?? 0);
                }
                if($mb_temp>$tg_temp) $status=1;
                elseif($mb_temp==$tg_temp) $status=8;
                else $status=2;
            } break;
        case 'match_ao':
            $m          =   explode('/',$rgg);
            $ben_add    =   1;
            if(count($m)==2){
                foreach($m as $k){
                    if(strtolower($match_showtype)=='h'){
                        $mb_temp    =   $mb_inball;
                        $tg_temp    =   $tg_inball+$k;
                    }else{
                        $mb_temp    =   $mb_inball+$k;
                        $tg_temp    =   $tg_inball;
                    }
                    if($match_type==2){ // 如果是滚球,减去下注比分
                        $n          =   explode(':',$match_nowscore);
                        $mb_temp    -=  intval($n[0] ?? 0);
                        $tg_temp    -=  intval($n[1] ?? 0);
                    }
                    if($mb_temp<$tg_temp) $temp+=1;
                    elseif($mb_temp==$tg_temp) $temp+=0.5;
                    else $temp+=0;
                }
                if($temp==0.5) $status=5;
                elseif($temp==1.5) $status=4;
                elseif($temp==2) $status=1;
                elseif($temp==0) $status=2;
            }else{
                if(strtolower($match_showtype)=='h'){
                    $mb_temp    =   $mb_inball;
                    $tg_temp    =   $tg_inball+$rgg;
                }else{
                    $mb_temp    =   $mb_inball+$rgg;
                    $tg_temp    =   $tg_inball;
                }
                if($match_type==2){ // 如果是滚球,减去下注比分
                    $n          =   explode(':',$match_nowscore);
                    $mb_temp    -=  intval($n[0] ?? 0);
                    $tg_temp    -=  intval($n[1] ?? 0);
                }
                if($mb_temp<$tg_temp) $status=1;
                elseif($mb_temp==$tg_temp) $status=8;
                else $status=2;
           }break;
        case 'match_dxdpl':
            $m          =   explode('/',$dxgg);
            $ben_add    =   1;
            $total      =   $mb_inball+$tg_inball;
            if(count($m)==2){
                foreach($m as $t){
                    if($total>$t) $temp+=1;
                    elseif($total==$t) $temp+=0.5;
                }
                if($temp==0.5) $status=5;
                elseif($temp==1.5) $status=4;
                elseif($temp==2) $status=1;
                elseif($temp==0) $status=2;
            }else{
                if($total>$dxgg) $status=1;
                elseif($total==$dxgg) $status=8;
                else $status=2;
            }break;
        case 'match_dxxpl':
            $m          =   explode('/',$dxgg);
            $ben_add    =   1;
            $total      =   $mb_inball+$tg_inball;
            if(count($m)==2){
                foreach($m as $t){
                    if($total<$t) $temp+=1;
                    elseif($total==$t) $temp+=0.5;
                }
                if($temp==0.5) $status=5;
                elseif($temp==1.5) $status=4;
                elseif($temp==2) $status=1;
                elseif($temp==0) $status=2;
            }else{
                if($total<$dxgg) $status=1;
                elseif($total==$dxgg) $status=8;
                else $status=2;
            }break;
        case 'match_dsdpl':
            if(($mb_inball+$tg_inball)%2==1) $status=1; break;
        case 'match_dsspl':
            if(($mb_inball+$tg_inball)%2==0) $status=1; break;
        case 'match_bmdy'://上半场独赢
            if($mb_inball_hr>$tg_inball_hr) $status=1;
            $mb_inball  =   $mb_inball_hr;
            $tg_inball  =   $tg_inball_hr;
            break;
        case 'match_bgdy':
            if($mb_inball_hr<$tg_inball_hr) $status=1;
            $mb_inball  =   $mb_inball_hr;
            $tg_inball  =   $tg_inball_hr;
            break;
        case 'match_bhdy':
            if($mb_inball_hr==$tg_inball_hr) $status=1; 
            $mb_inball  =   $mb_inball_hr;
            $tg_inball  =   $tg_inball_hr;
            break;
        case 'match_bho':   
            $m          =   explode('/',$rgg);
            $ben_add    =   1;
            if(count($m)==2){
                foreach($m as $k){
                    if(strtolower($match_showtype)=='h'){
                        $mb_temp    =   $mb_inball_hr;
                        $tg_temp    =   $tg_inball_hr+$k;
                    }else{
                        $mb_temp    =   $mb_inball_hr+$k;
                        $tg_temp    =   $tg_inball_hr;
                    }
                    if($match_type==2){ // 如果是滚球,减去下注比分
                        $n          =   explode(':',$match_nowscore);
                        $mb_temp    -=  intval($n[0] ?? 0);
                        $tg_temp    -=  intval($n[1] ?? 0);
                    }
                    if($mb_temp>$tg_temp) $temp+=1;
                    elseif($mb_temp==$tg_temp) $temp+=0.5;
                }
                if($temp==0.5) $status=5;
                elseif($temp==1.5) $status=4;
                elseif($temp==2) $status=1;
                elseif($temp==0) $status=2;
            }else{
                if(strtolower($match_showtype)=='h'){
                    $mb_temp    =   $mb_inball_hr;
                    $tg_temp    =   $tg_inball_hr+$rgg;
                }else{
                    $mb_temp    =   $mb_inball_hr+$rgg;
                    $tg_temp    =   $tg_inball_hr;
                }
                if($match_type==2){ // 如果是滚球,减去下注比分
                    $n          =   explode(':',$match_nowscore);
                    $mb_temp    -=  intval($n[0] ?? 0);
                    $tg_temp    -=  intval($n[1] ?? 0);
                }
                if($mb_temp>$tg_temp) $status=1;
                elseif($mb_temp==$tg_temp) $status=8;
                else $status=2;
            }
           $mb_inball   =   $mb_inball_hr;
           $tg_inball   =   $tg_inball_hr;
           break;
        case 'match_bao':   
            $m          =   explode('/',$rgg);
            $ben_add    =   1;
            if(count($m)==2){
                foreach($m as $k){
                    if(strtolower($match_showtype)=='h'){
                        $mb_temp    =   $mb_inball_hr;
                        $tg_temp    =   $tg_inball_hr+$k;
                    }else{
                        $mb_temp    =   $mb_inball_hr+$k;
                        $tg_temp    =   $tg_inball_hr;
                    }
                    if($match_type==2){ // 如果是滚球,减去下注比分
                        $n          =   explode(':',$match_nowscore);
                        $mb_temp    -=  intval($n[0] ?? 0);
                        $tg_temp    -=  intval($n[1] ?? 0);
                    }
                    if($mb_temp<$tg_temp) $temp+=1;
                    elseif($mb_temp==$tg_temp) $temp+=0.5;
                    else $temp+=0;
                }
                if($temp==0.5) $status=5;
                elseif($temp==1.5) $status=4;
                elseif($temp==2) $status=1;
                elseif($temp==0) $status=2;
            }else{ 
                if(strtolower($match_showtype)=='h'){
                    $mb_temp    =   $mb_inball_hr;
                    $tg_temp    =   $tg_inball_hr+$rgg;
                }else{
                    $mb_temp    =   $mb_inball_hr+$rgg;
                    $tg_temp    =   $tg_inball_hr;
                }
                if($match_type==2){ // 如果是滚球,减去下注比分
                    $n          =   explode(':',$match_nowscore);
                    $mb_temp    -=  intval($n[0] ?? 0);
                    $tg_temp    -=  intval($n[1] ?? 0);
                }
                if($mb_temp<$tg_temp) $status=1;
                elseif($mb_temp==$tg_temp) $status=8;
                else $status=2;
           }
           $mb_inball   =   $mb_inball_hr;
           $tg_inball   =   $tg_inball_hr;
           break;
        case 'match_bdpl':  
            $m          =   explode('/',$dxgg);
            $ben_add    =   1;
            $total      =   $mb_inball_hr+$tg_inball_hr;
            if(count($m)==2){
                foreach($m as $t){
                    if($total>$t) $temp+=1;
                    elseif($total==$t) $temp+=0.5;
                }
                if($temp==0.5) $status=5;
                elseif($temp==1.5) $status=4;
                elseif($temp==2) $status=1;
                elseif($temp==0) $status=2;
            }else{
                if($total>$dxgg) $status=1;
                elseif($total==$dxgg) $status=8;
                else $status=2;
            }
            $mb_inball  =   $mb_inball_hr;
            $tg_inball  =   $tg_inball_hr;
            break;
        case 'match_bxpl':
            $m          =   explode('/',$dxgg);
            $ben_add    =   1;
            $total      =   $mb_inball_hr+$tg_inball_hr;
            if(count($m)==2){
                foreach($m as $t){
                    if($total<$t) $temp+=1;
                    elseif($total==$t) $temp+=0.5;
                    else $temp+=0;
                }
                if($temp==0.5) $status=5;
                elseif($temp==1.5) $status=4;
                elseif($temp==2) $status=1;
                elseif($temp==0) $status=2;
            }else{
                if($total<$dxgg) $status=1;
                elseif($total==$dxgg) $status=8;
                else $status=2;
            }
            $mb_inball  =   $mb_inball_hr;
            $tg_inball  =   $tg_inball_hr;
            break;
        case 'match_bd10':
            if(($mb_inball==1)&&($tg_inball==0))$status=1;break;
        case 'match_bd20':
            if(($mb_inball==2)&&($tg_inball==0))$status=1;break;
        case 'match_bd21':
            if(($mb_inball==2)&&($tg_inball==1))$status=1;break;
        case 'match_bd30':
            if(($mb_inball==3)&&($tg_inball==0))$status=1;break;
        case 'match_bd31':
            if(($mb_inball==3)&&($tg_inball==1))$status=1;break;
        case 'match_bd32':
            if(($mb_inball==3)&&($tg_inball==2))$status=1;break;
        case 'match_bd40':
            if(($mb_inball==4)&&($tg_inball==0))$status=1;break;
        case 'match_bd41':
            if(($mb_inball==4)&&($tg_inball==1))$status=1;break;
        case 'match_bd42':
            if(($mb_inball==4)&&($tg_inball==2))$status=1;break;
        case 'match_bd43':
            if(($mb_inball==4)&&($tg_inball==3))$status=1;break;
        case 'match_bd00':
            if(($mb_inball==0)&&($tg_inball==0))$status=1;break;
        case 'match_bd11':
            if(($mb_inball==1)&&($tg_inball==1))$status=1;break;
        case 'match_bd22':
            if(($mb_inball==2)&&($tg_inball==2))$status=1;break;
        case 'match_bd33':
            if(($mb_inball==3)&&($tg_inball==3))$status=1;break;
        case 'match_bd44':
            if(($mb_inball==4)&&($tg_inball==4))$status=1;break;
        case 'match_bdup5':
            if(($mb_inball>=5)||($tg_inball>=5))$status=1;break;
        case 'match_bdg10':
            if(($mb_inball==0)&&($tg_inball==1))$status=1;break;
        case 'match_bdg20':
            if(($mb_inball==0)&&($tg_inball==2))$status=1;break;
        case 'match_bdg21':
            if(($mb_inball==1)&&($tg_inball==2))$status=1;break;
        case 'match_bdg30':
            if(($mb_inball==0)&&($tg_inball==3))$status=1;break;
        case 'match_bdg31':
            if(($mb_inball==1)&&($tg_inball==3))$status=1;break;
        case 'match_bdg32':
            if(($mb_inball==2)&&($tg_inball==3))$status=1;break;
        case 'match_bdg40':
            if(($mb_inball==0)&&($tg_inball==4))$status=1;break;
        case 'match_bdg41':
            if(($mb_inball==1)&&($tg_inball==4))$status=1;break;
            case 'match_bdg42':
            if(($mb_inball==2)&&($tg_inball==4))$status=1;break;
        case 'match_bdg43':
            if(($mb_inball==3)&&($tg_inball==4))$status=1;break;
        case 'match_hr_bd10':
            if(($mb_inball_hr==1)&&($tg_inball_hr==0))$status=1;break;
        case 'match_hr_bd20':
            if(($mb_inball_hr==2)&&($tg_inball_hr==0))$status=1;break;
        case 'match_hr_bd21':
            if(($mb_inball_hr==2)&&($tg_inball_hr==1))$status=1;break;
        case 'match_hr_bd30':
            if(($mb_inball_hr==3)&&($tg_inball_hr==0))$status=1;break;
        case 'match_hr_bd31':
            if(($mb_inball_hr==3)&&($tg_inball_hr==1))$status=1;break;
        case 'match_hr_bd32':
            if(($mb_inball_hr==3)&&($tg_inball_hr==2))$status=1;break;
        case 'match_hr_bd40':
            if(($mb_inball_hr==4)&&($tg_inball_hr==0))$status=1;break;
        case 'match_hr_bd41':
            if(($mb_inball_hr==4)&&($tg_inball_hr==1))$status=1;break;
        case 'match_hr_bd42':
            if(($mb_inball_hr==4)&&($tg_inball_hr==2))$status=1;break;
        case 'match_hr_bd43':
            if(($mb_inball_hr==4)&&($tg_inball_hr==3))$status=1;break;
        case 'match_hr_bd00':
            if(($mb_inball_hr==0)&&($tg_inball_hr==0))$status=1;break;
        case 'match_hr_bd11':
            if(($mb_inball_hr==1)&&($tg_inball_hr==1))$status=1;break;
        case 'match_hr_bd22':
            if(($mb_inball_hr==2)&&($tg_inball_hr==2))$status=1;break;
        case 'match_hr_bd33':
            if(($mb_inball_hr==3)&&($tg_inball_hr==3))$status=1;break;
        case 'match_hr_bd44':
            if(($mb_inball_hr==4)&&($tg_inball_hr==4))$status=1;break;
        case 'match_hr_bdup5':
            if(($mb_inball_hr>=5)||($tg_inball_hr>=5))$status=1;break;
        case 'match_hr_bdg10':
            if(($mb_inball_hr==0)&&($tg_inball_hr==1))$status=1;break;
        case 'match_hr_bdg20':
            if(($mb_inball_hr==0)&&($tg_inball_hr==2))$status=1;break;
        case 'match_hr_bdg21':
            if(($mb_inball_hr==1)&&($tg_inball_hr==2))$status=1;break;
        case 'match_hr_bdg30':
            if(($mb_inball_hr==0)&&($tg_inball_hr==3))$status=1;break;
        case 'match_hr_bdg31':
            if(($mb_inball_hr==1)&&($tg_inball_hr==3))$status=1;break;
        case 'match_hr_bdg32':
            if(($mb_inball_hr==2)&&($tg_inball_hr==3))$status=1;break;
        case 'match_hr_bdg40':
            if(($mb_inball_hr==0)&&($tg_inball_hr==4))$status=1;break;
        case 'match_hr_bdg41':
            if(($mb_inball_hr==1)&&($tg_inball_hr==4))$status=1;break;
        case 'match_hr_bdg42':
            if(($mb_inball_hr==2)&&($tg_inball_hr==4))$status=1;break;
        case 'match_hr_bdg43':
            if(($mb_inball_hr==3)&&($tg_inball_hr==4))$status=1;break;
        case 'match_total01pl':
            $total  =   $mb_inball+$tg_inball;
            if(($total>=0)&&($total<=1))$status=1;break;
        case 'match_total23pl':
            $total  =   $mb_inball+$tg_inball;
            if(($total>=2)&&($total<=3))$status=1;break;
        case 'match_total46pl':
            $total  =   $mb_inball+$tg_inball;
            if(($total>=4)&&($total<=6))$status=1;break;
        case 'match_total7uppl':
            $total  =   $mb_inball+$tg_inball;
            if(($total>=7))$status=1;break;
        //半全场开始
        case 'match_bqmm':
            if(($mb_inball>$tg_inball)&&($mb_inball_hr>$tg_inball_hr)) $status=1;break;
        case 'match_bqmh':
            if(($mb_inball==$tg_inball)&&($mb_inball_hr>$tg_inball_hr)) $status=1;break;
        case 'match_bqmg':
            if(($mb_inball<$tg_inball)&&($mb_inball_hr>$tg_inball_hr)) $status=1;break;
        case 'match_bqhm':
            if(($mb_inball>$tg_inball)&&($mb_inball_hr==$tg_inball_hr)) $status=1;break;
        case 'match_bqhh':
            if(($mb_inball==$tg_inball)&&($mb_inball_hr==$tg_inball_hr)) $status=1;break;
        case 'match_bqhg':
            if(($mb_inball<$tg_inball)&&($mb_inball_hr==$tg_inball_hr)) $status=1;break;
        case 'match_bqgm':
            if(($mb_inball>$tg_inball)&&($mb_inball_hr<$tg_inball_hr)) $status=1;break;
        case 'match_bqgh':
            if(($mb_inball==$tg_inball)&&($mb_inball_hr<$tg_inball_hr)) $status=1;break;
        case 'match_bqgg':
            if(($mb_inball<$tg_inball)&&($mb_inball_hr<$tg_inball_hr)) $status=1;break;
        default:break;
    }
    
    return array("column"=>$column,"ben_add"=>$ben_add,"status"=>$status,"mb_inball"=>$mb_inball,"tg_inball"=>$tg_inball);
}

}

function isset_column($m,$column){
  foreach($m as $t){
      if($t["column"]==$column){
         return $t;
      }
  }
  return false; 
}

function sys_log($uid,$log_info){

    $request = request();

    //$log_ip = request()->server('HTTP_X_FORWARDED_FOR'); //原本代码有问题,已修改
    $log_ip = request()->server('REMOTE_ADDR');

    $insert_data = ['uid'=>$uid,'log_info'=>$log_info,'log_ip'=>$log_ip,];
              
    $db = think\Db::connect(config('otherdb'));
     
    $db->table('sys_log')->insert($insert_data);  
}

function msg_add($uid,$from,$title,$info){
    $sql    =   "insert into k_user_msg(uid,msg_from,msg_title,msg_info) values ($uid,'$from','$title','$info')";
    think\Db::execute($sql);
} 

function sys_log_remote_addr($uid,$log_info){

    $request = request();

    $log_ip = request()->server('REMOTE_ADDR'); 

    $insert_data = ['uid'=>$uid,'log_info'=>$log_info,'log_ip'=>$log_ip,];
              
    $db = think\Db::connect(config('otherdb'));
     
    $db->table('sys_log')->insert($insert_data);  
}

function Alert($Str,$Typ="back",$TopWindow="",$Tim=100){
    echo "<script>".chr(10);
    if(!empty($Str)){
        echo "alert(\"消息提示:\\n\\n{$Str}\\n\\n\");".chr(10);
    }

    echo "function _r_r_(){";
    $WinName=(!empty($TopWindow))?"top":"self";
    switch (strtolower($Typ)){
    case "#":
        break;
    case "back":
        echo $WinName.".history.go(-1);".chr(10);
        break;
    case "reload":
        echo $WinName.".window.location.reload();".chr(10);
        break;
    case "close":
        echo "window.opener=null;window.close();".chr(10);
        break;
    case "function":
        echo "var _T=new Function('return {$TopWindow}')();_T();".chr(10);
        break;
        //Die();
    default:
        if($Typ!=""){
            //echo "window.{$WinName}.location.href='{$Typ}';";
            echo "window.{$WinName}.location=('{$Typ}');";
        }
    }

    echo "}".chr(10);

    //為防止Firefox不執行setTimeout
    echo "if(setTimeout(\"_r_r_()\",".$Tim.")==2){_r_r_();}";
    if($Tim==100){
        echo "_r_r_();".chr(10);
    }else{
        echo "setTimeout(\"_r_r_()\",".$Tim.");".chr(10);
    }
    echo "</script>".chr(10);
    exit();
}

function getWeek($num){
    $s	=	'';
    switch ($num) {
        case 0:
            $s	=	'天';
            break;
        case 1:
            $s	=	'一';
            break;
        case 2:
            $s	=	'二';
            break;
        case 3:
            $s	=	'三';
            break;
        case 4:
            $s	=	'四';
            break;
        case 5:
            $s	=	'五';
            break;
        case 6:
            $s	=	'六';
            break;
    }
    return $s;
}

function cutNum($title,$s=4,$e=4){
    mb_internal_encoding("UTF-8");
    $tmpstr = mb_substr($title,0,$s);
    for($i=0;$i<mb_strlen($title)-$s-$e;$i++){
        $tmpstr .= '*';
    }
    return $tmpstr.mb_substr($title,mb_strlen($title)-$e);
}

function BuLing ( $num ) {
    if ( $num<10 ) {
        $num = '0'.$num;
    }
    return $num;
}

function ip2addr($ip){
    $ip2addr = new \app\logic\ip2addr();
    if($ip){
        $info = $ip2addr ->getlocation($ip);
        $addr = $info['country']. "\t". $info['area'];
    }else{
        $addr = 'IP地址为空!';
    }
    return $addr ;
}
?>