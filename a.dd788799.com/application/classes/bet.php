<?php
// +----------------------------------------------------------------------
// | FileName: bet.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年10月5日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\classes;


class bet{
    

    //排列
    //A(n,m)=n(n-1)(n-2)……(n-m+1)= n!/(n-m)!
    public static function A($n, $m){
        if($n<$m) return false;
        $num=1;
        for($i=0; $i<$m; $i++) $num*=$n-$i;
        return $num;
    }
    
    //组合
    //C(n,m)=A(n,m)/m!=n!/((n-m)!*m!)
    public static function C($n, $m){
        if($n<$m) return false;
        return self::A($n, $m)/self::A($m, $m);
    }

    public static function combineArray($arr1,$arr2) {
        $result = array();
        foreach ($arr1 as $item1) {
            foreach ($arr2 as $item2) {
                $temp     = $item1 ;
                $temp[]   = $item2 ;
                $result[] = $temp ;
            }
        }
        return $result;
    }

    /**
     * 笛卡尔乘积算法
     * useage:
     * (descartesAlgorithm(2, [4,5], [6,0],[7,8,9],...));
     * (descartesAlgorithm([2,3,4], [4,5], [6,0],[7,8,9],...));
     */
    public static function descartesAlgorithm($data) {
        //$data   = func_get_args();
        $result = array();

        //笛卡尔积X
        foreach($data[0] as $item) {
            $result[] =  is_array($item) ? $item :[$item];
        }

        //计算笛卡尔积
        $cnt   = count($data);
        for($i = 1; $i < $cnt; $i++) {
            $result = self::combineArray($result,$data[$i]);
        }

        return $result;
    }

    /*
    // 直选复式
    // 大小单双
    public static function fs($bet){
        $bets=explode(',', $bet);
        $ret=1;
        
        foreach($bets as $b){
            $codes=str_split($b);
            $ret*=count($codes);
        }
        
        return $ret;
    }
    // 排除对子 豹子
    public static function descar($bet){
        $bets=explode(',', $bet);
        $ret=1;
        
        foreach($bets as $b){
            $codes=str_split($b);
            $ret*=count($codes);
            
        }
        
        return $ret;
    }
    */

    public static function ssc_dw_fs($betData) {
        $betData = explode('-',$betData,2);
        $bet = $betData[1];
        $ret=1;
        $bets=explode(',', $bet);
        foreach($bets as $b){
            $codes=_arr($b);
            $ret*=count($codes);
        }
        return $ret;        
    }

    public static function fs($bet, $reject = null){
        if(!$reject){
            $ret=1;
            $bets=explode(',', $bet);
            foreach($bets as $b){
                $codes=_arr($b);
                $ret*=count($codes);
            }
            return $ret;            
        }else{
            $bets = [];
            foreach (_arr($bet) as $b) {
                $bets[] = _arr($b);
            }

            $descar = self::descartesAlgorithm($bets);
            foreach ($descar as $key => $val){
                if($reject($val)){
                    unset($descar[$key]);
                }
            }

            return count($descar);
        }
    }

    //01,02 03,04 05 先","分割再" "分割,不能使用split分割
    public static function pk10_fs($bet, $reject = null){
        if(!$reject){
            $ret=1;
            $bets=explode(',', $bet);
            foreach($bets as $b){
                $codes=_arr($b," ");
                $ret*=count($codes);
            }
            return $ret;            
        }else{
            $bets = [];
            foreach (_arr($bet) as $b) {
                $bets[] = _arr($b," ");
            }

            $descar = self::descartesAlgorithm($bets);
            foreach ($descar as $key => $val){
                if($reject($val)){
                    unset($descar[$key]);
                }
            }

            return count($descar);
        }
    }
    
    // 排除对子 豹子
    public static function descar($bet){
        return self::fs($bet,function($bet){
            return count(array_unique(_arr($bet))) != count(_arr($bet));
        });
    }

    public static function pk10_descar($bet){
        return self::pk10_fs($bet,function($bet){
            return count(array_unique(_arr($bet))) != count(_arr($bet));
        });
    }
    
    // 直选单式 "1,2"或者"1,2|3,4" 只支持"|"分隔
    public static function ds($bet){
        return count(_arr($bet,"|"));
    }

    //"龙" 或 "龙虎" 支持任意分隔
    public static function enum($bet){
        return count(_arr($bet));
    }

    // "总和大"或"总和大 总和小" 不支持split
    public static function enum_not_split($bet){
        //return count(explode('|', $bet));
        return count(_arr($bet,'',false));
    }

    // 任四单式
    public static function ds4($bet){
        $bets = explode('|', $bet);
        foreach($bets as $b){
            $b=str_replace("-","",$b,$i);
            if($i!=1)
                return 0;
                $b=str_replace(",","",$b,$i);
                if($i!=4)
                    return 0;
        }
        return count($bets);
    }
    // 任三单式
    public static function ds3($bet){
        $bets = explode('|', $bet);
        foreach($bets as $b){
            $b=str_replace("-","",$b,$i);
            if($i!=2)
                return 0;
                $b=str_replace(",","",$b,$i);
                if($i!=4)
                    return 0;
        }
        return count($bets);
    }
    // 任二单式
    public static function ds2($bet){
        $bets = explode('|', $bet);
        foreach($bets as $b){
            $b=str_replace("-","",$b,$i);
            if($i!=3)
                return 0;
                $b=str_replace(",","",$b,$i);
                if($i!=4)
                    return 0;
        }
        return count($bets);
    }

    // 组三
    public static function z3($bet){
        //检查是否有除逗号之外的非数字，防止黑客作弊20150824
        $bet2=str_replace(',' ,'', $bet);
        //dump($bet2);
        if(!is_numeric($bet2))
            return -9997;
            
            if(strpos($bet, ',')===false && !preg_match('/(\d).*\1/', $bet)){
                return self::A(count(str_split($bet)), 2);
            }
            elseif(strpos($bet, ',')===false && preg_match('/(\d).*\1/', $bet))//防止类如前三组六投注中投注'01234567898'注数却为1的漏洞
            {
                return -9997;
            }else{
                // 来自混合组选
                return count(explode(',', $bet));
            }
    }
    
    // 组六
    public static function z6($bet){
        //检查是否有除逗号之外的非数字，防止黑客作弊20150824
        $bet2=str_replace(',' ,'', $bet);
        if(!is_numeric($bet2))
            return -9997;
            
            if(strpos($bet, ',')===false && !preg_match('/(\d).*\1/', $bet)){
                return self::C(count(str_split($bet)), 3);
            }elseif(strpos($bet, ',')===false && preg_match('/(\d).*\1/', $bet))//防止类如前三组六投注中投注'01234567898'注数却为1的漏洞
            {
                return -9997;
            }
            else{
                return count(explode(',', $bet));
            }
    }
    
    // 组二
    public static function z2($bet){
        return self::C(count(str_split($bet)), 2);
    }
    
    // 五星定位胆
    // 三星定位胆
    // 五星定胆
    public static function dwd($bet){
        return strlen(str_replace(array(',','-'), '', $bet));
    }

    // 十星定胆
    public static function dwd10($bet){
        return strlen(str_replace(array(',','-',' '), '', $bet))/2;
    }
    
    // 大小单双
    public static function dxds($bet){
        $bet=str_replace(array('大','小','单', '双'), array(1,2,3,4), $bet);
        return self::fs($bet);
    }
    
    // 龙虎
    public static function lh($bet){
        $bet=str_replace(array('龙','虎'), array(1,2), $bet);
        return self::fs($bet);
    }
    
    // 任选一 "01 02 03" 只能以" "分割,不能split做字符分割
    public static function r1($bet){
        //return count(explode(' ', $bet));
        return count(_arr($bet,' ',false));
    }
    
    // 任选二
    // 前二组选
    public static function r2($bet){
        return self::rx($bet, 2);
    }
    
    // 任选三
    // 前三组选
    public static function r3($bet){
        return self::rx($bet, 3);
    }
    public static function r4($bet){
        return self::rx($bet, 4);
    }
    public static function r5($bet){
        return self::rx($bet, 5);
    }
    public static function r6($bet){
        return self::rx($bet, 6);
    }
    public static function r7($bet){
        return self::rx($bet, 7);
    }
    public static function r8($bet){
        return self::rx($bet, 8);
    }
    public static function r9($bet){
        return self::rx($bet, 9);
    }
    public static function r10($bet){
        return self::rx($bet, 10);
    }
    
    // 十一选五直选
    public static function zx11($bet){
        $bets=explode(',', $bet);
        $ret=1;
        
        foreach($bets as $b){
            $codes=explode(' ', $b);
            $ret*=count($codes);
        }
        
        return $ret;
    }

    // 十一选五任选
    public static function rx($bet, $num){
        if($pos=strpos($bet, ')')){
            $dm=substr($bet, 1, $pos-1);
            $tm=substr($bet, $pos+1);
            
            //printf("胆码：%s，拖码：%s", $dm, $tm);
            $len = count(explode(' ', $tm));
            $num-=count(explode(' ', $dm));
        }else{
            //$len = count(explode(' ', $bet));
            $len = count(_arr($bet));
        }
        
        return self::C($len, $num);
    }

    public static function kqwf_single($bet){
        return 1;
    }

    //时时彩5星组选
    public static function x5_z120($bet){
        $len = count(_arr($bet));
        return self::C($len, 5);
    }
    public static function x5_z60($bet){
        /*
        $bets = _arr($bet);        
        $p2 = _arr($bets[0]);//2重号数组
        $p1 = _arr($bets[1]);//1重号数组
        $c2 = count($p2);
        $c1 = count($p1);
        //2重号选1,1重号选3 组成5个数字;
        return self::C($c2, 1) * self::C($c1, 3);
        */
        $bets = _arr($bet);
        $p2 = _arr($bets[0]);//2重号数组
        $p1 = _arr($bets[1]);//1重号数组

        $count = 0;
        foreach($p2 as $p){
            $p11 = array_remove($p1,$p);
            $c1 = count($p11);
            $count += self::C($c1, 3);
        }
        return $count;            
    }
    public static function x5_z30($bet){
        /*
        $bets = _arr($bet);
        $p2 = _arr($bets[0]);//2重号数组
        $p1 = _arr($bets[1]);//1重号数组
        $c2 = count($p2);
        $c1 = count($p1);
        //2重号选2,1重号选1 组成5个数字;
        return self::C($c2, 2) * self::C($c1, 1);        
        */
        $bets = _arr($bet);
        $p2 = _arr($bets[0]);//2重号数组
        $p1 = _arr($bets[1]);//1重号数组

        $count = 0;
        foreach($p1 as $p){
            $p22 = array_remove($p2,$p);
            $c2 = count($p22);
            $count += self::C($c2, 2);
        }
        return $count;         
    }
    public static function x5_z20($bet){
        /*
        $bets = _arr($bet);
        $p3 = _arr($bets[0]);//3重号数组
        $p1 = _arr($bets[1]);//1重号数组
        $c3 = count($p3);
        $c1 = count($p1);
        //3重号选1,1重号选2 组成5个数字;
        return self::C($c3, 1) * self::C($c1, 2);          
        */
        $bets = _arr($bet);
        $p3 = _arr($bets[0]);//3重号数组
        $p1 = _arr($bets[1]);//1重号数组

        $count = 0;
        foreach($p3 as $p){
            $p11 = array_remove($p1,$p);
            $c1 = count($p11);
            $count += self::C($c1, 2);
        }
        return $count;                  
    }
    public static function x5_z10($bet){
        /*
        $bets = _arr($bet);
        $p3 = _arr($bets[0]);//3重号数组
        $p2 = _arr($bets[1]);//2重号数组
        $c3 = count($p3);
        $c2 = count($p2);
        //3重号选1,2重号选1 组成5个数字;
        return self::C($c3, 1) * self::C($c2, 1);         
        */
        $bets = _arr($bet);
        $p3 = _arr($bets[0]);//3重号数组
        $p2 = _arr($bets[1]);//2重号数组

        $count = 0;
        foreach($p3 as $p){
            $p22 = array_remove($p2,$p);
            $c2 = count($p22);
            $count += self::C($c2, 1);
        }
        return $count;                   
    }
    public static function x5_z5($bet){
        /*
        $bets = _arr($bet);
        $p4 = _arr($bets[0]);//4重号数组
        $p1 = _arr($bets[1]);//1重号数组
        $c4 = count($p4);
        $c1 = count($p1);
        //4重号选1,1重号选1 组成5个数字;
        return self::C($c4, 1) * self::C($c1, 1);          
        */
        $bets = _arr($bet);
        $p4 = _arr($bets[0]);//4重号数组
        $p1 = _arr($bets[1]);//1重号数组 

        $count = 0;
        foreach($p4 as $p){
            $p11 = array_remove($p1,$p);
            $c1 = count($p11);
            $count += self::C($c1, 1);
        }
        return $count;   
    }

    //时时彩4星组选
    public static function x4_z24($bet){
        $len = count(_arr($bet));
        return self::C($len, 4);
    }
    public static function x4_z12($bet){
        /*
        $bets = _arr($bet);
        $p2 = _arr($bets[0]);//2重号数组
        $p1 = _arr($bets[1]);//1重号数组
        $c2 = count($p2);
        $c1 = count($p1);
        //2重号选1,1重号选2 组成4个数字;
        return self::C($c2, 1) * self::C($c1, 2);
        */
        $bets = _arr($bet);
        $p2 = _arr($bets[0]);//2重号数组
        $p1 = _arr($bets[1]);//1重号数组

        $count = 0;
        foreach($p2 as $p){
            $p11 = array_remove($p1,$p);
            $c1 = count($p11);
            $count += self::C($c1, 2);
        }
        return $count;                   
    }
    public static function x4_z6($bet){
        /*
        $bets = _arr($bet);
        $p2 = _arr($bets[0]);//2重号数组       
        $c2 = count($p2);        
        //2重号选2, 组成4个数字;
        return self::C($c2, 2);
        */
        $len = count(_arr($bet));
        return self::C($len, 2);        
    }
    public static function x4_z4($bet){
        /*
        $bets = _arr($bet);
        $p3 = _arr($bets[0]);//3重号数组
        $p1 = _arr($bets[1]);//1重号数组
        $c3 = count($p3);
        $c1 = count($p1);
        //3重号选1,1重号选1 组成4个数字;
        return self::C($c3, 1) * self::C($c1, 1);          
        */
        $bets = _arr($bet);
        $p3 = _arr($bets[0]);//3重号数组
        $p1 = _arr($bets[1]);//1重号数组

        $count = 0;
        foreach($p3 as $p){
            $p11 = array_remove($p1,$p);
            $c1 = count($p11);
            $count += self::C($c1, 1);
        }
        return $count;             
    }



    //直选和值 从拉菲前端抠出(checkNum的ZXHZ,ZUHZ), 投注号码20,$zxhz[20-1]对应36,表示需要36注; 投注号码1表示需要3注;  那么投注1和20共需要3+36注
    public static function zxhz($bet){
        $zxhz = [1,3,6,10,15,21,28,36,45,55,63,69,73,75,75,73,69,63,55,45,36,28,21,15,10,6,3,1];
        $count = 0;        
        $bets = _arr($bet,',');
        foreach($bets as $b){
            $count += $zxhz[$b];
        }
        return $count;
    }  

    //3星直选跨度
    public static function zxkd($bet){
        $zxkd = [10,54,96,126,144,150,144,126,96,54];
        $count = 0;        
        $bets = _arr($bet);
        foreach($bets as $b){
            $count += $zxkd[$b];
        }
        return $count;        
    }


    //组选和值 从拉菲前端抠出
    public static function zuhz($bet){
        $zuhz = [1,2,2,4,5,6,8,10,11,13,14,14,15,15,14,14,13,11,10,8,6,5,4,2,2,1];
        $count = 0;        
        $bets = _arr($bet,',');
        foreach($bets as $b){
            $count += $zuhz[$b-1];
        }
        return $count;        
    }  

    //3星组选包胆,只能选一个号,每个号表示56注
    public static function zubd($bet){
        if(count(_arr($bet))>1){
            return -1;
        }
        return 56;
    }      

    //2星直选和值
    public static function zxhz2($bet){
        $zxhz = [1,2,3,4,5,6,7,8,9,10,9,8,7,6,5,4,3,2,1];
        $count = 0;        
        $bets = _arr($bet,',');
        foreach($bets as $b){
            $count += $zxhz[$b];
        }
        return $count;            
    }

    //2星直选跨度
    public static function zxkd2($bet){
        $zxkd = [10,18,16,14,12,10,8,6,4,2];
        $count = 0;        
        $bets = _arr($bet);
        foreach($bets as $b){
            $count += $zxkd[$b];
        }
        return $count; 
    }  

    //2星组选和值
    public static function zuhz2($bet){
        $zuhz = [1,1,2,2,3,3,4,4,5,4,4,3,3,2,2,1,1];
        $count = 0;        
        $bets = _arr($bet,',');
        foreach($bets as $b){
            $count += $zuhz[$b-1];
        }
        return $count;         
    }

    //2星组选包胆,只能选一个号,每个号表示9注
    public static function zubd2($bet){
        if(count(_arr($bet))>1){
            return -1;
        }
        return 9;
    }      

    //五星直选-五星组合
    public static function ssc_5xzh($bet){
        $cnt = 5;
        foreach(_arr($bet) as $val){
            $cnt *= count(_arr($val));
        }
        return $cnt;
    }   

    //四星直选-四星组合
    public static function ssc_4xzh($bet){
        $cnt = 4;
        foreach(_arr($bet) as $val){
            $cnt *= count(_arr($val));
        }
        return $cnt;
    }   

    //三星直选-三星组合
    public static function ssc_3xzh($bet){
        $cnt = 3;
        foreach(_arr($bet) as $val){
            $cnt *= count(_arr($val));
        }
        return $cnt;
    }           


    //快钱玩法的注单数统计函数和规则函数 同名;

    //四全中-1,2,3,4
    public static function six_lm($bet){

        $ret = 0;

        $betData = explode('-',$bet);
        $wf = $betData[0];
        $bet = $betData[1];

        if('四全中' == $wf || '四中一' == $wf){
            $ret = self::rx($bet, 4);
        }

        if('三全中' == $wf || '三中二' == $wf){
            $ret = self::rx($bet, 3);
        }

        if('二全中' == $wf || '二中特' == $wf || '特串' == $wf){
            $ret = self::rx($bet, 2);
        }      

        return $ret;    
    }

    //三肖-鼠,虎,龙
    public static function six_hx($bet){
        $ret = 0;
        $wfs = ['二肖','三肖','四肖','五肖','六肖','七肖','八肖','九肖','十肖','十一肖'];
        $betData = explode('-',$bet);
        $wf = $betData[0];
        $bet = $betData[1];
        if( ($key = array_search($wf,$wfs)) !== false ){
            $ret = self::rx($bet, $key+2);
        }
        return $ret;
    }

    public static function six_sxl($bet){
        $ret = 0;

        $betData = explode('-',$bet);
        $wf = $betData[0];
        $bet = $betData[1];

        if('二肖连中' == $wf || '二肖连不中' == $wf){
            $ret = self::rx($bet, 2);
        }

        if('三肖连中' == $wf || '三肖连不中' == $wf){
            $ret = self::rx($bet, 3);
        }

        if('四肖连中' == $wf || '四肖连不中' == $wf){
            $ret = self::rx($bet, 4);
        }

        if('五肖连中' == $wf){
            $ret = self::rx($bet, 5);
        }

        return $ret;
    }

    public static function six_wsl($bet){
        $ret = 0;

        $betData = explode('-',$bet);
        $wf = $betData[0];
        $bet = $betData[1];

        if('二尾连中' == $wf || '二尾连不中' == $wf){
            $ret = self::rx($bet, 2);
        }

        if('三尾连中' == $wf || '三尾连不中' == $wf){
            $ret = self::rx($bet, 3);
        }

        if('四尾连中' == $wf || '四尾连不中' == $wf){
            $ret = self::rx($bet, 4);
        }

        return $ret;                 
    }

    public static function six_qbz($bet){
        $ret = 0;

        $betData = explode('-',$bet);
        $wf = $betData[0];
        $bet = $betData[1];  

        if('五不中' == $wf){
            $ret = self::rx($bet, 5);
        }

        if('六不中' == $wf){
            $ret = self::rx($bet, 6);
        }

        if('七不中' == $wf){
            $ret = self::rx($bet, 7);
        }

        if('八不中' == $wf){
            $ret = self::rx($bet, 8);
        }

        if('九不中' == $wf){
            $ret = self::rx($bet, 9);
        }

        if('十不中' == $wf){
            $ret = self::rx($bet, 10);
        }   

        if('十一不中' == $wf){
            $ret = self::rx($bet, 11);
        }   

        if('十二不中' == $wf){
            $ret = self::rx($bet, 12);
        }            

        return $ret;   
    }

    public static function fc3d_dw($bet){
        $ret = 0;
        $betData = explode('-',$bet);
        $wf = $betData[0];
        $bet = $betData[1];     
        if(in_array($wf,['百定位','十定位','个定位'])){
            return self::kqwf_single($bet);
        }
        if(in_array($wf,['百十定位','百个定位','十个定位','百十个定位'])){
            return self::fs($bet);
        }        
    }

    //二同号单选-11 22,3 4
    public static function k3_2dx($bet){
        $ret = 1;
        $betData = explode('-',$bet);  
        $wf = $betData[0];
        $bet = $betData[1];
        
        foreach(_arr($bet) as $items){
            $ret = $ret * count(_arr_no_split($items));
        }

        return $ret;
    }
}

