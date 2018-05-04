<?php
namespace app\logic;
use app\logic\Lunar;
class jsauto {
    //六合彩波色函数
    public static function Six_BoSe($num){
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
    public static function Six_DanShuang($num){
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
    public static function Six_DaXiao($num){
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
    public static function Six_WeiShuDaXiao($num){
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
    public static function Six_WeiShuDanShuang($num){
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
    public static function Six_HeShuDaXiao($num){
        if($num==49){
            return '49';
            exit;
        }
        $num1=intval(substr($num,0,1));
        $num2=intval(substr($num,1,1));
        $num3=$num1+$num2;
        if($num3>6){
            return '合大';
        }else{
            return '合小';
        }
    }
    //六合彩合数单双函数
    public static function Six_HeShuDanShuang($num){
        if($num==49){
            return '49';
            exit;
        }
        $num1=intval(substr($num,0,1));
        $num2=intval(substr($num,1,1));
        $num3=$num1+$num2;
        if($num3%2==0){
            return '合双';
        }else{
            return '合单';
        }
    }
    //六合彩总和单双函数
    public static function Six_ZongHeDanShuang($num){
        if($num%2==0){
            return '总和双';
        }else{
            return '总和单';
        }
    }
    //六合彩总和大小函数
    public static function Six_ZongHeDaXiao($num){
        if($num>=175){
            return '总和大';
        }else{
            return '总和小';
        }
    }
    
    //六合彩正码转换成开奖号
    public static function Six_ZhengMaToNum($haoma){
        if($haoma=="正一"){return 1;}
        elseif($haoma=="正二"){return 2;}
        elseif($haoma=="正三"){return 3;}
        elseif($haoma=="正四"){return 4;}
        elseif($haoma=="正五"){return 5;}
        elseif($haoma=="正六"){return 6;}
    }
    public static function Six_ZhengMaGuoGuang($haoma,$num){
        if(($num=="大" || $num=="小") && self::Six_DaXiao($haoma)==$num) {return true;}
        else{return false;}
        if(($num=="单" || $num=="双") && self::Six_DanShuang($haoma)==$num) {return true;}
        else{return false;}
        if(($num=="合大" || $num=="合小") && self::Six_HeShuDaXiao($haoma)==$num) {return true;}
        else{return false;}
        if(($num=="合单" || $num=="合双") && self::Six_HeShuDanShuang($haoma)==$num) {return true;}
        else{return false;}
        if(($num=="尾大" || $num=="尾小") && self::Six_WeiShuDaXiao($haoma)==$num) {return true;}
        else{return false;}
        if(($num=="红波" || $num=="蓝波" || $num=="绿波") && self::Six_BoSe($haoma)==$num) {return true;}
        else{return false;}
    }
    //六合彩尾数函数
    public static function Six_WeiShu($num){
        return ($num%10)."尾";
        
    }
    //广东快乐十分开奖函数
    public static function G10_Auto($num , $type){
        $zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6]+$num[7];
        if($type==1){
            echo $zh;
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
    public static function G10_Ds($ball){
        if($ball%2==0){
            return '双';
        }else{
            return '单';
        }
    }
    //广东快乐十分大小
    public static function G10_Dx($ball){
        if($ball>10){
            return '大';
        }else{
            return '小';
        }
    }
    //广东快乐十分尾数大小
    public static function G10_WsDx($ball){
        $wsdx = substr($ball, -1);
        if($wsdx>4){
            return '尾大';
        }else{
            return '尾小';
        }
    }
    //广东快乐十分合数单双
    public static function G10_HsDs($ball){
        $ball = self::BuLing($ball);
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
    public static function G10_Fw($ball){
        if(self::BuLing($ball) == '01' || self::BuLing($ball) == '05' || self::BuLing($ball) == '09' || self::BuLing($ball) == '13' || self::BuLing($ball) == '17'){
            return '东';
        }else if(self::BuLing($ball) == '02' || self::BuLing($ball) == '06' || self::BuLing($ball) == '10' || self::BuLing($ball) == '14' || self::BuLing($ball) == '18'){
            return '南';
        }else if(self::BuLing($ball) == '03' || self::BuLing($ball) == '07' || self::BuLing($ball) == '11' || self::BuLing($ball) == '15' || self::BuLing($ball) == '19'){
            return '西';
        }else{
            return '北';
        }
    }
    //广东快乐十分号码中发白
    public static function G10_Zfb($ball){
        if(self::BuLing($ball) == '01' || self::BuLing($ball) == '02' || self::BuLing($ball) == '03' || self::BuLing($ball) == '04' || self::BuLing($ball) == '05' || self::BuLing($ball) == '06' || self::BuLing($ball) == '07'){
            return '中';
        }else if(self::BuLing($ball) == '08' || self::BuLing($ball) == '09' || self::BuLing($ball) == '10' || self::BuLing($ball) == '11' || self::BuLing($ball) == '12' || self::BuLing($ball) == '13' || self::BuLing($ball) == '14'){
            return '发';
        }else{
            return '白';
        }
    }
    //重庆时时彩开奖函数
    public static function Ssc_Auto($num , $type){
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
            }else if($a == '012' || $a == '021' || $a == '102' || $a == '120' || $a == '201' || $a == '210' || $a == '123' || $a == '132' || $a == '213' || $a == '231' || $a == '312' || $a == '321' || $a == '234' || $a == '243' || $a == '324' || $a == '342' || $a == '423' || $a == '432' || $a == '345' || $a == '354' || $a == '435' || $a == '453' || $a == '534' || $a == '543' || $a == '456' || $a == '465' || $a == '546' || $a == '564' || $a == '645' || $a == '654' || $a == '567' || $a == '576' || $a == '657' || $a == '675' || $a == '756' || $a == '765' || $a == '678' || $a == '687' || $a == '768' || $a == '786' || $a == '867' || $a == '876' || $a == '789' || $a == '798' || $a == '879' || $a == '897' || $a == '978' || $a == '987' || $a == '890' || $a == '809' || $a == '980' || $a == '908' || $a == '089' || $a == '098' || $a == '901' || $a == '910' || $a == '091' || $a == '019' || $a == '190' || $a == '109' || sorts($hm, 3)){
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
    public static function Ssc_Ds($ball){
        if($ball%2==0){
            return '双';
        }else{
            return '单';
        }
    }
    //重庆时时彩大小
    public static function Ssc_Dx($ball){
        if($ball>4){
            return '大';
        }else{
            return '小';
        }
    }
    //重庆时时彩顺子，半顺判断函数
    public static function sorts($a, $p)
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
    public static function Pk10_Auto($num , $type , $ballnum){
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
    public static function Gxsf_Auto($num , $type){
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
            }else if($hm == array(1,20,21) || $hm == array(1,2,21) || self::shunzi($hm, 3)){
                return '顺子';
            }else if(($hm[0]==1 && $hm[2] == 21) || self::shunzi($hm, 2)){
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
            }else if($hm == array(1,20,21) || $hm == array(1,2,21) || self::shunzi($hm, 3)){
                return '顺子';
            }else if(($hm[0]==1 && $hm[2] == 21) || self::shunzi($hm, 2)){
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
            }else if($hm == array(1,20,21) || $hm == array(1,2,21) || self::shunzi($hm, 3)){
                return '顺子';
            }else if(($hm[0]==1 && $hm[2] == 21) || self::shunzi($hm, 2)){
                return '半顺';
            }else{
                return '杂六';
            }
        }
    }
    
    //广西快乐十分单双
    public static function Gxsf_Ds($ball){
        if($ball%2==0){
            return '双';
        }else{
            return '单';
        }
    }
    //广西快乐十分大小
    public static function Gxsf_Dx($ball){
        if($ball>10){
            return '大';
        }else{
            return '小';
        }
    }
    
    //三顺，二顺判断
    public static function shunzi($a, $type){
        
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
    public static function Jsk3_Auto($num , $type){
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
    
    public static function Get_ShengXiao($hm)
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
    
    /*
     数字补0函数，当数字小于10的时候在前面自动补0
     */
   public static function BuLing ( $num ) {
        if ( $num<10 ) {
            $num = '0'.$num;
        }
        return $num;
    }
}