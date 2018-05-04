<?php
error_reporting(E_ERROR);
//六合彩波色函数
function Six_BoSe($num){
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
//六合彩单双函数
function Six_DanShuang($num){
	if($num==49){
		return '49';
		exit;
	}
	if($num%2==0){
		return '双';
	}else{
		return '单';
	}
}
//六合彩大小函数
function Six_DaXiao($num){
	if($num==49){
		return '49';
		exit;
	}
	if($num>24){
		return '大';
	}else{
		return '小';
	}
}
//六合彩尾数大小函数
function Six_WeiShuDaXiao($num){
	if($num==49){
		return '49';
		exit;
	}
	$zhws = substr($num,strlen($num)-1);
	if($zhws>=5){
		return '尾大';
	}else{
		return '尾小';
	}
}
//六合彩尾数大小函数
function Six_WeiShuDanShuang($num){
	if($num==49){
		return '49';
		exit;
	}
	$zhws = substr($num,strlen($num)-1);
	if($num%2==0){
		return '尾双';
	}else{
		return '尾单';
	}
}
//六合彩合数大小函数
function Six_HeShuDaXiao($num){
	if($num==49){
		return '49';
		exit;
	}
	$num1=substr($num,0,1);
	$num2=substr($num,1,1);
	$num3=$num1+$num2;
	if($num3>6){
		return '合大';
	}else{
		return '合小';
	}
}
//六合彩合数单双函数
function Six_HeShuDanShuang($num){
	if($num==49){
		return '49';
		exit;
	}
	$num1=substr($num,0,1);
	$num2=substr($num,1,1);
	$num3=$num1+$num2;
	if($num3%2==0){
		return '合双';
	}else{
		return '合单';
	}
}
//六合彩总和单双函数
function Six_ZongHeDanShuang($num){
	if($num%2==0){
		return '总和双';
	}else{
		return '总和单';
	}
}
//六合彩总和大小函数
function Six_ZongHeDaXiao($num){
	if($num>=175){
		return '总和大';
	}else{
		return '总和小';
	}
}
//广东快乐十分开奖函数
function G10_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6]+$num[7];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>=85 && $zh<=132){
			return '总和大';
		}
		if($zh>=36 && $zh<=83){
			return '总和小';
		}
		if($zh==84){
			return '和';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	if($type==4){
		$zhws = substr($zh,strlen($zh)-1);
		if($zhws>=5){
			return '总和尾大';
		}else{
			return '总和尾小';
		}
	}
	if($type==5){
		if($num[0]>$num[7]){
			return '龙';
		}else{
			return '虎';
		}
	}
}
//广东快乐十分单双
function G10_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}
//广东快乐十分大小
function G10_Dx($ball){
	if($ball>10){
		return '大';
	}else{
		return '小';
	}
}
//广东快乐十分尾数大小
function G10_WsDx($ball){
	$wsdx = substr($ball, -1);
	if($wsdx>4){
		return '尾大';
	}else{
		return '尾小';
	}
}
//广东快乐十分合数单双
function G10_HsDs($ball){
	$ball = BuLing($ball);
	$a = substr($ball, 0,1);
	$b = substr($ball, -1);
	$c = $a+$b;
	if($c%2==0){
		return '合数双';
	}else{
		return '合数单';
	}
}
//广东快乐十分号码方位
function G10_Fw($ball){
	if(BuLing($ball) == '01' || BuLing($ball) == '05' || BuLing($ball) == '09' || BuLing($ball) == '13' || BuLing($ball) == '17'){
		return '东';
	}else if(BuLing($ball) == '02' || BuLing($ball) == '06' || BuLing($ball) == '10' || BuLing($ball) == '14' || BuLing($ball) == '18'){
		return '南';
	}else if(BuLing($ball) == '03' || BuLing($ball) == '07' || BuLing($ball) == '11' || BuLing($ball) == '15' || BuLing($ball) == '19'){
		return '西';
	}else{
		return '北';
	}
}
//广东快乐十分号码中发白
function G10_Zfb($ball){
	if(BuLing($ball) == '01' || BuLing($ball) == '02' || BuLing($ball) == '03' || BuLing($ball) == '04' || BuLing($ball) == '05' || BuLing($ball) == '06' || BuLing($ball) == '07'){
		return '中';
	}else if(BuLing($ball) == '08' || BuLing($ball) == '09' || BuLing($ball) == '10' || BuLing($ball) == '11' || BuLing($ball) == '12' || BuLing($ball) == '13' || BuLing($ball) == '14'){
		return '发';
	}else{
		return '白';
	}
}
//重庆时时彩开奖函数
function Ssc_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>=23){
			return '总和大';
		}
		if($zh<=22){
			return '总和小';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	if($type==4){
		if($num[0]>$num[4]){
			return '龙';
		}
		if($num[0]<$num[4]){
			return '虎';
		}
		if($num[0]==$num[4]){
			return '和';
		}
	}
	if($type==5){
		$a = $num[0].$num[1].$num[2];
		$hm 		= array();
		$hm[]		= $num[0];
		$hm[]		= $num[1];
		$hm[]		= $num[2];
		sort($hm);
		$match = '/.09|0.9|09.|.90|9.0|90./';
		if($num[0]==$num[1] && $num[0]==$num[2] && $num[1]==$num[2]){
			return '豹子';
		}else if($num[0]==$num[1] || $num[0]==$num[2] || $num[1]==$num[2]){
			return '对子';
		}else if($a == '012' || $a == '021' || $a == '102' || $a == '120' || $a == '201' || $a == '210' || $a == '123' || $a == '132' || $a == '213' || $a == '231' || $a == '312' || $a == '321' || $a == '234' || $a == '243' || $a == '324' || $a == '342' || $a == '423' || $a == '432' || $a == '345' || $a == '354' || $a == '435' || $a == '453' || $a == '534' || $a == '543' || $a == '456' || $a == '465' || $a == '546' || $a == '564' || $a == '645' || $a == '654' || $a == '567' || $a == '576' || $a == '657' || $a == '675' || $a == '756' || $a == '765' || $a == '678' || $a == '687' || $a == '768' || $a == '786' || $a == '867' || $a == '876' || $a == '789' || $a == '798' || $a == '879' || $a == '897' || $a == '978' || $a == '987' || $a == '890' || $a == '809' || $a == '980' || $a == '908' || $a == '089' || $a == '098' || $a == '901' || $a == '910' || $a == '091' || $a == '019' || $a == '190' || $a == '109' || sorts($hm, 3)){
			return '顺子';
		}else if(preg_match($match, $a) || sorts($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
	if($type==6){
		$a = $num[1].$num[2].$num[3];
		$hm 		= array();
		$hm[]		= $num[1];
		$hm[]		= $num[2];
		$hm[]		= $num[3];
		sort($hm);
		$match = '/.09|0.9|09.|.90|9.0|90./';
		if($num[1]==$num[2] && $num[1]==$num[3] && $num[2]==$num[3]){
			return '豹子';
		}else if($num[1]==$num[2] || $num[1]==$num[3] || $num[2]==$num[3]){
			return '对子';
		}else if($a == '012' || $a == '021' || $a == '102' || $a == '120' || $a == '201' || $a == '210' || $a == '123' || $a == '132' || $a == '213' || $a == '231' || $a == '312' || $a == '321' || $a == '234' || $a == '243' || $a == '324' || $a == '342' || $a == '423' || $a == '432' || $a == '345' || $a == '354' || $a == '435' || $a == '453' || $a == '534' || $a == '543' || $a == '456' || $a == '465' || $a == '546' || $a == '564' || $a == '645' || $a == '654' || $a == '567' || $a == '576' || $a == '657' || $a == '675' || $a == '756' || $a == '765' || $a == '678' || $a == '687' || $a == '768' || $a == '786' || $a == '867' || $a == '876' || $a == '789' || $a == '798' || $a == '879' || $a == '897' || $a == '978' || $a == '987' || $a == '890' || $a == '809' || $a == '980' || $a == '908' || $a == '089' || $a == '098' || $a == '901' || $a == '910' || $a == '091' || $a == '019' || $a == '190' || $a == '109' || sorts($hm, 3)
		){
			return '顺子';
		}else if(preg_match($match, $a) || sorts($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
	if($type==7){
		$a = $num[2].$num[3].$num[4];
		$hm 		= array();
		$hm[]		= $num[2];
		$hm[]		= $num[3];
		$hm[]		= $num[4];
		sort($hm);
		$match = '/.09|0.9|09.|.90|9.0|90./';
		if($num[2]==$num[3] && $num[2]==$num[4] && $num[3]==$num[4]){
			return '豹子';
		}else if($num[2]==$num[3] || $num[2]==$num[4] || $num[3]==$num[4]){
			return '对子';
		}else if($a == '012' || $a == '021' || $a == '102' || $a == '120' || $a == '201' || $a == '210' || $a == '123' || $a == '132' || $a == '213' || $a == '231' || $a == '312' || $a == '321' || $a == '234' || $a == '243' || $a == '324' || $a == '342' || $a == '423' || $a == '432' || $a == '345' || $a == '354' || $a == '435' || $a == '453' || $a == '534' || $a == '543' || $a == '456' || $a == '465' || $a == '546' || $a == '564' || $a == '645' || $a == '654' || $a == '567' || $a == '576' || $a == '657' || $a == '675' || $a == '756' || $a == '765' || $a == '678' || $a == '687' || $a == '768' || $a == '786' || $a == '867' || $a == '876' || $a == '789' || $a == '798' || $a == '879' || $a == '897' || $a == '978' || $a == '987' || $a == '890' || $a == '809' || $a == '980' || $a == '908' || $a == '089' || $a == '098' || $a == '901' || $a == '910' || $a == '091' || $a == '019' || $a == '190' || $a == '109' || sorts($hm, 3)){
			return '顺子';
		}else if(preg_match($match, $a) || sorts($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
}
//重庆时时彩单双
function Ssc_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}
//重庆时时彩大小
function Ssc_Dx($ball){
	if($ball>4){
		return '大';
	}else{
		return '小';
	}
}
//重庆时时彩顺子，半顺判断函数 
function sorts($a, $p)
{
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
//北京PK拾开奖函数
function Pk10_Auto($num , $type , $ballnum = NULL){
	$zh = $num[0]+$num[1];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>11){
			return '冠亚大';
		}else{
			return '冠亚小';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '冠亚双';
		}else{
			return '冠亚单';
		}
	}
	if($type==4){
		if($num[0]>$num[9]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==5){
		if($num[1]>$num[8]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==6){
		if($num[2]>$num[7]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==7){
		if($num[3]>$num[6]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==8){
		if($num[4]>$num[5]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==9){
		if($ballnum>5){
			return '大';
		}else{
			return '小';
		}	
	}
	if($type==10){
		if($ballnum%2==0){
			return '双';
		}else{
			return '单';
		}	
	}
}


//广西快乐十分开奖函数
function Gxsf_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4];
	
	
	//总和
	if($type==1){
		return $zh;
	}
	
	//总和大小
	if($type==2){
		if($zh>=55){
			return '总和大';
		}
		if($zh<=54){
			return '总和小';
		}
	}
	
	//总和单双
	if($type==3){
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	
	//龙虎和
	if($type==4){
		if($num[0]>$num[4]){
			return '龙';
		}
		if($num[0]<$num[4]){
			return '虎';
		}
		if($num[0]==$num[4]){
			return '和';
		}
	}
	
	//前三
	if($type==5){
		
		$hm 		= array();
		$hm[]		= $num[0];
		$hm[]		= $num[1];
		$hm[]		= $num[2];
		sort($hm);
		$a = $hm[0].$hm[1].$hm[2];
		
		//$match = '/1.21|0.9/';
		if($hm[0]==$hm[1] && $hm[0]==$hm[2] && $hm[1]==$hm[2]){
			return '豹子';
		}else if($hm[0]==$hm[1] || $hm[0]==$hm[2] || $hm[1]==$hm[2]){
			return '对子';
		}else if($hm == array(1,20,21) || $hm == array(1,2,21) || shunzi($hm, 3)){
			return '顺子';
		}else if(($hm[0]==1 && $hm[2] == 21) || shunzi($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
	
	//中三
	if($type==6){
		$hm 		= array();
		$hm[]		= $num[1];
		$hm[]		= $num[2];
		$hm[]		= $num[3];
		sort($hm);
		$a = $hm[0].$hm[1].$hm[2];
		
		//$match = '/1.21|0.9/';
		if($hm[0]==$hm[1] && $hm[0]==$hm[2] && $hm[1]==$hm[2]){
			return '豹子';
		}else if($hm[0]==$hm[1] || $hm[0]==$hm[2] || $hm[1]==$hm[2]){
			return '对子';
		}else if($hm == array(1,20,21) || $hm == array(1,2,21) || shunzi($hm, 3)){
			return '顺子';
		}else if(($hm[0]==1 && $hm[2] == 21) || shunzi($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
	
	//后三
	if($type==7){
		$hm 		= array();
		$hm[]		= $num[2];
		$hm[]		= $num[3];
		$hm[]		= $num[4];
		sort($hm);
		$a = $hm[0].$hm[1].$hm[2];
		
		//$match = '/1.21|0.9/';
		if($hm[0]==$hm[1] && $hm[0]==$hm[2] && $hm[1]==$hm[2]){
			return '豹子';
		}else if($hm[0]==$hm[1] || $hm[0]==$hm[2] || $hm[1]==$hm[2]){
			return '对子';
		}else if($hm == array(1,20,21) || $hm == array(1,2,21) || shunzi($hm, 3)){
			return '顺子';
		}else if(($hm[0]==1 && $hm[2] == 21) || shunzi($hm, 2)){
			return '半顺';
		}else{
			return '杂六';
		}
	}
}

//广西快乐十分单双
function Gxsf_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}
//广西快乐十分大小
function Gxsf_Dx($ball){
	if($ball>10){
		return '大';
	}else{
		return '小';
	}
}

//三顺，二顺判断
function shunzi($a, $type){
	
	sort($a);
	
	if($type == 2){
		
		if($a[0]+1 == $a[1] || $a[1]+1 == $a[2]){
			return true;
		}else{
			return false;
		}
		
		
	}else if($type == 3){
		
		if($a[0]+1 == $a[1] && $a[1]+1 == $a[2]){
			return true;
		}else{
			return false;
		}
		
	}
	
}


//江苏快3开奖函数
function Jsk3_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2];
	
	
	//点数
	if($type==1){
		return $zh;
	}
	
	//点数大小
	if($type==2){
		if($zh>=4 && $zh <= 10){
			return '点数小';
		}
		if($zh>=11 && $zh <= 17){
			return '点数大';
		}
		return '';
	}
	
	//点数单双
	if($type==3){
		if($zh%2==0){
			return '点数双';
		}else{
			return '点数单';
		}
	}
	
}


//公历转农历函数
class Lunar
{
	private  $_SMDay = array(1 => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);//定义公历月分天数
	private  $_LStart = 1950 ;//农历从1950年开始
	private  $_LMDay = array(
	//差：该年的农历正月初一到该年公历1月1日的天数；1~12：农历月份天数；闰：如有闰月，记录该月平月天数
	//    差  1  2  3  4  5  6  7  8  9 10 11 12 闰
	array(47,29,30,30,29,30,30,29,29,30,29,30,29),
	array(36,30,29,30,30,29,30,29,30,29,30,29,30),
    array(6,29,30,29,30,59,29,30,30,29,30,29,30,29),    //五月29 闰五月30
   	array(44,29,30,29,29,30,30,29,30,30,29,30,29),
    array(33,30,29,30,29,29,30,29,30,30,29,30,30),
    array(23,29,30,59,29,29,30,29,30,29,30,30,30,29),    //三月29 闰三月30
    array(42,29,30,29,30,29,29,30,29,30,29,30,30),
    array(30,30,29,30,29,30,29,29,59,30,29,30,29,30),    //八月30 闰八月29
    array(48,30,30,30,29,30,29,29,30,29,30,29,30),
    array(38,29,30,30,29,30,29,30,29,30,29,30,29),
    array(27,30,29,30,29,30,59,30,29,30,29,30,29,30),    //六月30 闰六月29
    array(45,30,29,30,29,30,29,30,30,29,30,29,30),
    array(35,29,30,29,29,30,29,30,30,29,30,30,29),
    array(24,30,29,30,58,30,29,30,29,30,30,30,29,29),    //四月29 闰四月29
    array(43,30,29,30,29,29,30,29,30,29,30,30,30),
    array(32,29,30,29,30,29,29,30,29,29,30,30,29),
    array(20,30,30,59,30,29,29,30,29,29,30,30,29,30),    //三月30 闰三月29
    array(39,30,30,29,30,30,29,29,30,29,30,29,30),
    array(29,29,30,29,30,30,29,59,30,29,30,29,30,30),    //七月30 闰七月29
    array(47,29,30,29,30,29,30,30,29,30,29,30,29),
    array(36,30,29,29,30,29,30,30,29,30,30,29,30),
    array(26,29,30,29,29,59,30,29,30,30,30,29,30,30),    //五月30 闰五月29
    array(45,29,30,29,29,30,29,30,29,30,30,29,30),
    array(33,30,29,30,29,29,30,29,29,30,30,29,30),
    array(22,30,30,29,59,29,30,29,29,30,30,29,30,30),    //四月30 闰四月29
    array(41,30,30,29,30,29,29,30,29,29,30,29,30),
    array(30,30,30,29,30,29,30,29,59,29,30,29,30,30),    //八月30 闰八月29
    array(48,30,29,30,30,29,30,29,30,29,30,29,29),
    array(37,30,29,30,30,29,30,30,29,30,29,30,29),
    array(27,30,29,29,30,29,60,29,30,30,29,30,29,30),    //六月30 闰六月30
    array(46,30,29,29,30,29,30,29,30,30,29,30,30),
    array(35,29,30,29,29,30,29,29,30,30,29,30,30),
    array(24,30,29,30,58,30,29,29,30,29,30,30,30,29),    //四月29 闰四月29
    array(43,30,29,30,29,29,30,29,29,30,29,30,30),
    array(32,30,29,30,30,29,29,30,29,29,59,30,30,30),    //十月30 闰十月29
    array(50,29,30,30,29,30,29,30,29,29,30,29,30),
    array(39,29,30,30,29,30,30,29,30,29,30,29,29),
    array(28,30,29,30,29,30,59,30,30,29,30,29,29,30),    //六月30 闰六月29
    array(47,30,29,30,29,30,29,30,30,29,30,30,29),
    array(36,30,29,29,30,29,30,29,30,29,30,30,30),
    array(26,29,30,29,29,59,29,30,29,30,30,30,30,30),    //五月30 闰五月29
    array(45,29,30,29,29,30,29,29,30,29,30,30,30),
    array(34,29,30,30,29,29,30,29,29,30,29,30,30),
    array(22,29,30,59,30,29,30,29,29,30,29,30,29,30),    //三月30 闰三月29
    array(40,30,30,30,29,30,29,30,29,29,30,29,30),
    array(30,29,30,30,29,30,29,30,59,29,30,29,30,30),    //八月30 闰八月29
    array(49,29,30,29,30,30,29,30,29,30,30,29,29),
    array(37,30,29,30,29,30,29,30,30,29,30,30,29),
    array(27,30,29,29,30,58,30,30,29,30,30,29,30,29),    //五月29 闰五月29
    array(46,30,29,29,30,29,29,30,29,30,30,30,29),
    array(35,30,30,29,29,30,29,29,30,29,30,30,29),
    array(23,30,30,29,59,30,29,29,30,29,30,29,30,30),    //四月30 闰四月29
    array(42,30,30,29,30,29,30,29,29,30,29,30,29),
    array(31,30,30,29,30,30,29,30,29,29,30,29,30),
    array(21,29,59,30,30,29,30,29,30,29,30,29,30,30),    //二月30 闰二月29
    array(39,29,30,29,30,29,30,30,29,30,29,30,29),
    array(28,30,29,30,29,30,29,59,30,30,29,30,30,30),    //七月30 闰七月29
    array(48,29,29,30,29,29,30,29,30,30,30,29,30),
    array(37,30,29,29,30,29,29,30,29,30,30,29,30),
    array(25,30,30,29,29,59,29,30,29,30,29,30,30,30),    //五月30 闰五月29
    array(44,30,29,30,29,30,29,29,30,29,30,29,30),
    array(33,30,29,30,30,29,30,29,29,30,29,30,29),
    array(22,30,29,30,59,30,29,30,29,30,29,30,29,30),    //四月30 闰四月29
    array(40,30,29,30,29,30,30,29,30,29,30,29,30),
    array(30,29,30,29,30,29,30,29,30,59,30,29,30,30),    //九月30 闰九月29
    array(49,29,30,29,29,30,29,30,30,30,29,30,29),
    array(38,30,29,30,29,29,30,29,30,30,29,30,30),
    array(27,29,30,29,30,29,59,29,30,29,30,30,30,29),    //六月29 闰六月30
    array(46,29,30,29,30,29,29,30,29,30,29,30,30),
    array(35,30,29,30,29,30,29,29,30,29,29,30,30),
    array(24,29,30,30,59,30,29,29,30,29,30,29,30,30),    //四月30 闰四月29
    array(42,29,30,30,29,30,29,30,29,30,29,30,29),
    array(31,30,29,30,29,30,30,29,30,29,30,29,30),
    array(21,29,59,29,30,30,29,30,30,29,30,29,30,30),    //二月30 闰二月29
    array(40,29,30,29,29,30,29,30,30,29,30,30,29),
    array(28,30,29,30,29,29,59,30,29,30,30,30,29,30),    //六月30 闰六月29
    array(47,30,29,30,29,29,30,29,29,30,30,30,29),
    array(36,30,30,29,30,29,29,30,29,29,30,30,29),
    array(25,30,30,30,29,59,29,30,29,29,30,30,29,30),    //五月30 闰五月29
    array(43,30,30,29,30,29,30,29,30,29,29,30,30),
    array(33,29,30,29,30,30,29,30,29,30,29,30,29),
    array(22,29,30,59,30,29,30,30,29,30,29,30,29,30),    //三月30 闰三月29
    array(41,30,29,29,30,29,30,30,29,30,30,29,30),
    array(30,29,30,29,29,30,29,30,29,30,30,59,30,30),    //十一月30 闰十一月29
    array(49,29,30,29,29,30,29,30,29,30,30,29,30),
    array(38,30,29,30,29,29,30,29,29,30,30,29,30),
    array(27,30,30,29,30,29,59,29,29,30,29,30,30,29),    //六月29 闰六月30
    array(45,30,30,29,30,29,29,30,29,29,30,29,30),
    array(34,30,30,29,30,29,30,29,30,29,29,30,29),
    array(23,30,30,29,30,59,30,29,30,29,30,29,29,30),    //五月30 闰五月29
    array(42,30,29,30,30,29,30,29,30,30,29,30,29),
    array(31,29,30,29,30,29,30,30,29,30,30,29,30),
    array(21,29,59,29,30,29,30,29,30,30,29,30,30,30),    //二月30 闰二月29
    array(40,29,30,29,29,30,29,29,30,30,29,30,30),
    array(29,30,29,30,29,29,30,58,30,29,30,30,30,29),    //七月29 闰七月29
    array(47,30,29,30,29,29,30,29,29,30,29,30,30),
    array(36,30,29,30,29,30,29,30,29,29,30,29,30),
    array(25,30,29,30,30,59,29,30,29,29,30,29,30,29),    //五月29 闰五月30
    array(44,29,30,30,29,30,30,29,30,29,29,30,29),
    array(32,30,29,30,29,30,30,29,30,30,29,30,29),
    array(22,29,30,59,29,30,29,30,30,29,30,30,29,29),    //三月29 闰三月30		
	);
	//是否闰年
	private function IsLeapYear($AYear){
        return ($AYear % 4 == 0) && (($AYear % 100 != 0) || ($AYear % 400 == 0));
	}
	//公历该月的天数(year：年份； month：月份)
	private function GetSMon($year,$month)
	{
		if($this->IsLeapYear($year) && $month == 2)
			return 29;
		else
			return $this->_SMDay[$month];
	}
	//农历名称转换
	private function LYearName($year)
	{
		$Name = array("零","一","二","三","四","五","六","七","八","九");
		for($i=0;$i<4;$i++)
			for($k=0;$k<10;$k++)
				if($year[$i]==$k)
					$tmp.=$Name[$k];
		return $tmp;
	}
	
	private function LMonName($month)
	{
		if($month >=1 && $month <=12 )
		{
			$Name = array( 1=>"正","二","三","四","五","六","七","八","九","十","十一","十二");
			return $Name[$month];
		}
		return $month;
	}
	
	private function LDayName($day)
	{
		if($day >=1 && $day <=30 )
		{
			$Name = array( 1 =>
			"初一","初二","初三","初四","初五","初六","初七","初八","初九","初十",
			"十一","十二","十三","十四","十五","十六","十七","十八","十九","二十",
			"廿一","廿二","廿三","廿四","廿五","廿六","廿七","廿八","廿九","三十"
			);
			return $Name[$day];
		} 
		return $day;
	}
	
	//公历转农历(Sdate：公历日期)
	public function S2L($date)
	{
		list($year, $month, $day) = explode("-", $date);
		if($year <= 1951 || $month <= 0 || $day <= 0 || $year >= 2051 )	return false;
		//获取查询日期到当年1月1日的天数
		$date1 = strtotime($year."-01-01");//当年1月1日
		$date2 = strtotime($year."-".$month."-".$day);
		$days=round(($date2-$date1)/3600/24);
		$days += 1;
		//获取相应年度农历数据，化成数组Larray
		$Larray = $this->_LMDay[$year - $this->_LStart];
		if($days <= $Larray[0])
		{
			$Lyear = $year - 1;
			$days = $Larray[0] - $days;
			$Larray = $this->_LMDay[$Lyear - $this->_LStart];
			if($days < $Larray[12])
			{
				$Lmonth = 12;
				$Lday = $Larray[12] - $days;
			}
			else
			{
				$Lmonth = 11;
				$days = $days - $Larray[12];
				$Lday = $Larray[11] - $days;
			}			
		}
		else
		{
			$Lyear = $year;
			$days = $days - $Larray[0];
			for($i = 1;$i <= 12;$i++)
			{
				if($days > $Larray[$i]) $days = $days - $Larray[$i];
				else 
				{
					if ($days > 30){
						$days = $days - $Larray[13];
						$Ltype = 1;
					}
				
					$Lmonth = $i;
					$Lday = $days;
					break;
				}
			}
		}
		return mktime(0, 0, 0, $Lmonth, $Lday, $Lyear);
		//$Ldate = $Lyear."-".$Lmonth."-".$Lday;
		//$Ldate = $this->LYearName($Lyear)."年".$this->LMonName($Lmonth)."月".$this->LDayName($Lday);
		//if($Ltype) $Ldate.="(闰)";
		//return $Ldate;
	}
	//农历转公历(date：农历日期； type：是否闰月)
	public function L2S($date,$type = 0)
	{
		list($year, $month, $day) = split("-",$date);
		if($year <= 1951 || $month <= 0 || $day <= 0 || $year >= 2051 )	return false;
		$Larray = $this->_LMDay[$year - $this->_LStart];
		if($type == 1 && count($Larray)<=12 ) return false;//要求查询闰，但查无闰月
		//如果查询的农历是闰月并该年度农历数组存在闰月数据就获取
		if($Larray[$month]>30 && $type == 1 && count($Larray) >=13)	$day = $Larray[13] + $day;
		//获取该年农历日期到公历1月1日的天数
		$days = $day;
		for($i=0;$i<=$month-1;$i++)
			$days += $Larray[$i];
		//当查询农历日期距离公历1月1日超过一年时
		if($days > 366 || ($this->GetSMon($month,2)!=29 && $days>365 ))
		{
			$Syear = $year +1;
			if($this->GetSMon($month,2)!=29) 
				$days-=366;
			else
				$days-=365;
			if($days > $this->_SMDay[1]) 
			{
				$Smonth = 2;
				$Sday = $days - $this->_SMDay[1];
			}
			else
			{
				$Smonth = 1;
				$Sday = $days;
			}		
		}
		else
		{
			$Syear =$year;
			for($i=1;$i<=12;$i++)
			{
				if($days > $this->GetSMon($Syear,$i))
					$days-=$this->GetSMon($Syear,$i);
				else
				{
					$Smonth = $i;
					$Sday = $days;
					break;
				}
			}
		}
		return mktime(0, 0, 0, $Smonth, $Sday, $Syear);
		//$Sdate = $Syear."-".$Smonth."-".$Sday;
		//return $Sdate;
	}
}
//根据农历新年以及开奖号码整出12计算出该号码的生肖属性
function Get_ShengXiao($hm)
{
	$today = date("Y-m-d",time()+1*12*3600);
	$lunar = new Lunar();
	$year = date("Y",$lunar->S2L($today));
	$hm = $hm % 12;
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
	if($hm==0){
		return $sx[11];
	}else{
		return $sx[$hm-1];
	}
}
//六合彩尾数函数
function Six_WeiShu($num){
    $zhws = substr($num,strlen($num)-1);
    return $zhws.'尾';
}
?>