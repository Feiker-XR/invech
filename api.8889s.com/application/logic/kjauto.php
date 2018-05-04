<?php
namespace app\logic;

class kjauto
{
    // 香港六合彩开奖函数
    public static function Six_Auto($num, $type)
    {
        if ($type == 1) {
            if ($num == 0) {
                return '<span class="blacks">未开奖</span>';
                exit();
            }
            $today = date("Y-m-d", time() + 1 * 12 * 3600);
            $lunar = new Lunar();
            $nl = date("Y", $lunar->S2L($today));
            return '<span class="' . self::Six_Bose($num, 2) . '" title="' . self::Six_DanShuang($num) . ' / ' . self::Six_DaXiao($num) . ' / ' . self::Six_WeiShuDanShuang($num) . ' / ' . self::Six_WeiShuDaXiao($num) . ' / ' . self::Six_HeShuDanShuang($num) . ' / ' . self::Six_HeShuDaXiao($num) . ' / ' . self::Get_ShengXiao($nl, $num % 12) . '">' . self::BuLing($num) . '</span>';
        }
        if ($type == 2) {
            $zh = $num[0] + $num[1] + $num[2] + $num[3] + $num[4] + $num[5] + $num[6];
            if ($zh == 0) {
                return '<span class="blacks">未开奖</span>';
                exit();
            }
            return '<span class="blacks">' . $zh . ' / ' . self::Six_ZongHeDanShuang($zh) . ' / ' . self::Six_ZongHeDaXiao($zh) . '</span>';
        }
    }

    public static function Six_BoSe($num, $type)
    {
        if ($type == 1) {
            if ($num == 1 || $num == 2 || $num == 7 || $num == 8 || $num == 12 || $num == 13 || $num == 18 || $num == 19 || $num == 23 || $num == 24 || $num == 29 || $num == 30 || $num == 34 || $num == 35 || $num == 40 || $num == 45 || $num == 46) {
                return '红';
            }
            if ($num == 3 || $num == 4 || $num == 9 || $num == 10 || $num == 14 || $num == 15 || $num == 20 || $num == 25 || $num == 26 || $num == 31 || $num == 36 || $num == 37 || $num == 41 || $num == 42 || $num == 47 || $num == 48) {
                return '蓝';
            }
            if ($num == 5 || $num == 6 || $num == 11 || $num == 16 || $num == 17 || $num == 21 || $num == 22 || $num == 27 || $num == 28 || $num == 32 || $num == 33 || $num == 38 || $num == 39 || $num == 43 || $num == 44 || $num == 49) {
                return '绿';
            }
        }
        if ($type == 2) {
            if ($num == 1 || $num == 2 || $num == 7 || $num == 8 || $num == 12 || $num == 13 || $num == 18 || $num == 19 || $num == 23 || $num == 24 || $num == 29 || $num == 30 || $num == 34 || $num == 35 || $num == 40 || $num == 45 || $num == 46) {
                return 'reds';
            }
            if ($num == 3 || $num == 4 || $num == 9 || $num == 10 || $num == 14 || $num == 15 || $num == 20 || $num == 25 || $num == 26 || $num == 31 || $num == 36 || $num == 37 || $num == 41 || $num == 42 || $num == 47 || $num == 48) {
                return 'blues';
            }
            if ($num == 5 || $num == 6 || $num == 11 || $num == 16 || $num == 17 || $num == 21 || $num == 22 || $num == 27 || $num == 28 || $num == 32 || $num == 33 || $num == 38 || $num == 39 || $num == 43 || $num == 44 || $num == 49) {
                return 'greens';
            }
        }
    }
    
    // 六合彩单双函数
    public static function Six_DanShuang($num)
    {
        if ($num == 49) {
            return '49';
            exit();
        }
        if ($num % 2 == 0) {
            return '双';
        } else {
            return '单';
        }
    }
    
    // 六合彩大小函数
    public static function Six_DaXiao($num)
    {
        if ($num == 49) {
            return '49';
            exit();
        }
        if ($num > 24) {
            return '大';
        } else {
            return '小';
        }
    }
    // 六合彩尾数大小函数
    public static function Six_WeiShuDaXiao($num)
    {
        if ($num == 49) {
            return '49';
            exit();
        }
        $zhws = substr($num, strlen($num) - 1);
        if ($zhws >= 5) {
            return '尾大';
        } else {
            return '尾小';
        }
    }
    // 六合彩尾数大小函数
    public static function Six_WeiShuDanShuang($num)
    {
        if ($num == 49) {
            return '49';
            exit();
        }
        $zhws = substr($num, strlen($num) - 1);
        if ($num % 2 == 0) {
            return '尾双';
        } else {
            return '尾单';
        }
    }
    // 六合彩合数大小函数
    public static function Six_HeShuDaXiao($num)
    {
        if ($num == 49) {
            return '49';
            exit();
        }
        $num1 = substr($num, 0, 1);
        $num2 = substr($num, 1, 1);
        $num3 = intval($num1) + intval($num2);
        if ($num3 > 6) {
            return '合大';
        } else {
            return '合小';
        }
    }
    // 六合彩合数单双函数
    public static function Six_HeShuDanShuang($num)
    {
        if ($num == 49) {
            return '49';
            exit();
        }
        $num1 = substr($num, 0, 1);
        $num2 = substr($num, 1, 1);
        $num3 = intval($num1) + intval($num2);
        if ($num3 % 2 == 0) {
            return '合双';
        } else {
            return '合单';
        }
    }
    // 六合彩总和单双函数
    public static function Six_ZongHeDanShuang($num)
    {
        if ($num % 2 == 0) {
            return '双';
        } else {
            return '单';
        }
    }
    // 六合彩总和大小函数
    public static function Six_ZongHeDaXiao($num)
    {
        if ($num >= 175) {
            return '大';
        } else {
            return '小';
        }
    }
    // 广东快乐十分开奖函数
    public static function G10_Auto($num, $type)
    {
        $zh = $num[0] + $num[1] + $num[2] + $num[3] + $num[4] + $num[5] + $num[6] + $num[7];
        if ($type == 1) {
            return $zh;
        }
        if ($type == 2) {
            if ($zh >= 85 && $zh <= 132) {
                return '大';
            }
            if ($zh >= 36 && $zh <= 83) {
                return '小';
            }
            if ($zh == 84) {
                return '和';
            }
        }
        if ($type == 3) {
            if ($zh % 2 == 0) {
                return '双';
            } else {
                return '单';
            }
        }
        if ($type == 4) {
            $zhws = substr($zh, strlen($zh) - 1);
            if ($zhws >= 5) {
                return '尾大';
            } else {
                return '尾小';
            }
        }
        if ($type == 5) {
            if ($num[0] > $num[7]) {
                return '龙';
            } else {
                return '虎';
            }
        }
    }
    // 重庆时时彩开奖函数
   public static function Ssc_Auto($num, $type)
    {
        $zh = $num[0] + $num[1] + $num[2] + $num[3] + $num[4];
        if ($type == 1) {
            return $zh;
        }
        if ($type == 2) {
            if ($zh >= 23) {
                return '大';
            }
            if ($zh <= 23) {
                return '小';
            }
        }
        if ($type == 3) {
            if ($zh % 2 == 0) {
                return '双';
            } else {
                return '单';
            }
        }
        if ($type == 4) {
            if ($num[0] > $num[4]) {
                return '龙';
            }
            if ($num[0] < $num[4]) {
                return '虎';
            }
            if ($num[0] == $num[4]) {
                return '和';
            }
        }
        if ($type == 5) {
            $a = $num[0] . $num[1] . $num[2];
            $hm = array();
            $hm[] = $num[0];
            $hm[] = $num[1];
            $hm[] = $num[2];
            sort($hm);
            $match = '/.09|0.9/';
            if ($num[0] == $num[1] && $num[0] == $num[2] && $num[1] == $num[2]) {
                return '豹子';
            } else 
                if ($num[0] == $num[1] || $num[0] == $num[2] || $num[1] == $num[2]) {
                    return '对子';
                } else 
                    if ($a == '019' || $a == '091' || $a == '098' || $a == '089' || $a == '109' || $a == '190' || $a == '901' || $a == '910' || $a == '809' || $a == '890' || self::sorts($hm, 3)) {
                        return '顺子';
                    } else 
                        if (preg_match($match, $a) || self::sorts($hm, 2)) {
                            return '半顺';
                        } else {
                            return '杂六';
                        }
        }
        if ($type == 6) {
            $a = $num[1] . $num[2] . $num[3];
            $hm = array();
            $hm[] = $num[1];
            $hm[] = $num[2];
            $hm[] = $num[3];
            sort($hm);
            $match = '/.09|0.9/';
            if ($num[1] == $num[2] && $num[1] == $num[3] && $num[2] == $num[3]) {
                return '豹子';
            } else 
                if ($num[1] == $num[2] || $num[1] == $num[3] || $num[2] == $num[3]) {
                    return '对子';
                } else 
                    if ($a == '019' || $a == '091' || $a == '098' || $a == '089' || $a == '109' || $a == '190' || $a == '901' || $a == '910' || $a == '809' || $a == '890' || self::sorts($hm, 3)) {
                        return '顺子';
                    } else 
                        if (preg_match($match, $a) || self::sorts($hm, 2)) {
                            return '半顺';
                        } else {
                            return '杂六';
                        }
        }
        if ($type == 7) {
            $a = $num[2] . $num[3] . $num[4];
            $hm = array();
            $hm[] = $num[2];
            $hm[] = $num[3];
            $hm[] = $num[4];
            sort($hm);
            $match = '/.09|0.9/';
            if ($num[2] == $num[3] && $num[2] == $num[4] && $num[3] == $num[4]) {
                return '豹子';
            } else 
                if ($num[2] == $num[3] || $num[2] == $num[4] || $num[3] == $num[4]) {
                    return '对子';
                } else 
                    if ($a == '019' || $a == '091' || $a == '098' || $a == '089' || $a == '109' || $a == '190' || $a == '901' || $a == '910' || $a == '809' || $a == '890' || self::sorts($hm, 3)) {
                        return '顺子';
                    } else 
                        if (preg_match($match, $a) || self::sorts($hm, 2)) {
                            return '半顺';
                        } else {
                            return '杂六';
                        }
        }
    }
    // 重庆时时彩顺子，半顺判断函数
   public static  function sorts($a, $p)
    {
        $i = 0;
        $tmp = 0;
        foreach ($a as $k => $v) {
            if ($v == @$a[$k - 1] + 1 || $v == @$a[$k + 1] - 1) {
                $tmp = $v;
                if (isset($date[$i]) && end($date[$i]) + 1 == $tmp) {
                    $date[$i][] = $tmp;
                } else {
                    $date[++ $i][] = $tmp;
                }
            }
        }
        if (count(@$date[1]) == $p || count(@$date[2]) == $p)
            $a = true;
        else
            $a = false;
        return $a;
    }
    // 北京PK拾开奖函数
   public static function Pk10_Auto($num, $type)
    {
        $zh = $num[0] + $num[9];
        if ($type == 1) {
            echo $zh;
        }
        if ($type == 2) {
            if ($zh > 11) {
                echo '<font color="#FF0000">大</font>';
            } else {
                echo '小';
            }
        }
        if ($type == 3) {
            if ($zh % 2 == 0) {
                echo '<font color="#FF0000">双</font>';
            } else {
                echo '单';
            }
        }
        if ($type == 4) {
            if ($num[0] > $num[9]) {
                echo '<font color="#FF0000">龙</font>';
            } else {
                echo '虎';
            }
        }
        if ($type == 5) {
            if ($num[1] > $num[2]) {
                echo '<font color="#FF0000">龙</font>';
            } else {
                echo '虎';
            }
        }
        if ($type == 6) {
            if ($num[2] > $num[7]) {
                echo '<font color="#FF0000">龙</font>';
            } else {
                echo '虎';
            }
        }
        if ($type == 7) {
            if ($num[3] > $num[6]) {
                echo '<font color="#FF0000">龙</font>';
            } else {
                echo '虎';
            }
        }
        if ($type == 8) {
            if ($num[4] > $num[5]) {
                echo '<font color="#FF0000">龙</font>';
            } else {
                echo '虎';
            }
        }
    }
    // 重庆快乐十分开奖函数
   public static  function C10_Auto($num, $type)
    {
        $zh = $num[0] + $num[1] + $num[2] + $num[3] + $num[4] + $num[5] + $num[6] + $num[7];
        if ($type == 1) {
            return $zh;
        }
        if ($type == 2) {
            if ($zh >= 85 && $zh <= 132) {
                return '大';
            }
            if ($zh >= 36 && $zh <= 83) {
                return '小';
            }
            if ($zh == 84) {
                return '和';
            }
        }
        if ($type == 3) {
            if ($zh % 2 == 0) {
                return '双';
            } else {
                return '单';
            }
        }
        if ($type == 4) {
            $zhws = substr($zh, strlen($zh) - 1);
            if ($zhws >= 5) {
                return '尾大';
            } else {
                return '尾小';
            }
        }
        if ($type == 5) {
            if ($num[0] > $num[7]) {
                return '龙';
            } else {
                return '虎';
            }
        }
    }
    // 数字自动补0函数
    public static function BuLing($num)
    {
        if ($num < 10) {
            return '0' . $num;
        } else {
            return $num;
        }
    }
    
    // 广西快乐十分开奖函数 开始
    public static function Gxsf_Auto($num, $type)
    {
        $zh = $num[0] + $num[1] + $num[2] + $num[3] + $num[4];
        
        // 总和
        if ($type == 1) {
            return $zh;
        }
        
        // 总和大小
        if ($type == 2) {
            if ($zh >= 55) {
                return '总和大';
            }
            if ($zh <= 54) {
                return '总和小';
            }
        }
        
        // 总和单双
        if ($type == 3) {
            if ($zh % 2 == 0) {
                return '总和双';
            } else {
                return '总和单';
            }
        }
        
        // 龙虎和
        if ($type == 4) {
            if ($num[0] > $num[4]) {
                return '龙';
            }
            if ($num[0] < $num[4]) {
                return '虎';
            }
            if ($num[0] == $num[4]) {
                return '和';
            }
        }
        
        // 前三
        if ($type == 5) {
            
            $hm = array();
            $hm[] = $num[0];
            $hm[] = $num[1];
            $hm[] = $num[2];
            sort($hm);
            $a = $hm[0] . $hm[1] . $hm[2];
            
            // $match = '/1.21|0.9/';
            if ($hm[0] == $hm[1] && $hm[0] == $hm[2] && $hm[1] == $hm[2]) {
                return '豹子';
            } else 
                if ($hm[0] == $hm[1] || $hm[0] == $hm[2] || $hm[1] == $hm[2]) {
                    return '对子';
                } else 
                    if ($hm == array(
                        1,
                        20,
                        21
                    ) || $hm == array(
                        1,
                        2,
                        21
                    ) || self::shunzi($hm, 3)) {
                        return '顺子';
                    } else 
                        if (($hm[0] == 1 && $hm[2] == 21) || self::shunzi($hm, 2)) {
                            return '半顺';
                        } else {
                            return '杂六';
                        }
        }
        
        // 中三
        if ($type == 6) {
            $hm = array();
            $hm[] = $num[1];
            $hm[] = $num[2];
            $hm[] = $num[3];
            sort($hm);
            $a = $hm[0] . $hm[1] . $hm[2];
            
            // $match = '/1.21|0.9/';
            if ($hm[0] == $hm[1] && $hm[0] == $hm[2] && $hm[1] == $hm[2]) {
                return '豹子';
            } else 
                if ($hm[0] == $hm[1] || $hm[0] == $hm[2] || $hm[1] == $hm[2]) {
                    return '对子';
                } else 
                    if ($hm == array(
                        1,
                        20,
                        21
                    ) || $hm == array(
                        1,
                        2,
                        21
                    ) || self::shunzi($hm, 3)) {
                        return '顺子';
                    } else 
                        if (($hm[0] == 1 && $hm[2] == 21) || self::shunzi($hm, 2)) {
                            return '半顺';
                        } else {
                            return '杂六';
                        }
        }
        
        // 后三
        if ($type == 7) {
            $hm = array();
            $hm[] = $num[2];
            $hm[] = $num[3];
            $hm[] = $num[4];
            sort($hm);
            $a = $hm[0] . $hm[1] . $hm[2];
            
            // $match = '/1.21|0.9/';
            if ($hm[0] == $hm[1] && $hm[0] == $hm[2] && $hm[1] == $hm[2]) {
                return '豹子';
            } else 
                if ($hm[0] == $hm[1] || $hm[0] == $hm[2] || $hm[1] == $hm[2]) {
                    return '对子';
                } else 
                    if ($hm == array(
                        1,
                        20,
                        21
                    ) || $hm == array(
                        1,
                        2,
                        21
                    ) || self::shunzi($hm, 3)) {
                        return '顺子';
                    } else 
                        if (($hm[0] == 1 && $hm[2] == 21) || self::shunzi($hm, 2)) {
                            return '半顺';
                        } else {
                            return '杂六';
                        }
        }
    }
    
    // 广西快乐十分单双
    public static function Gxsf_Ds($ball)
    {
        if ($ball % 2 == 0) {
            return '双';
        } else {
            return '单';
        }
    }
    // 广西快乐十分大小
    public static function Gxsf_Dx($ball)
    {
        if ($ball > 10) {
            return '大';
        } else {
            return '小';
        }
    }
    
    // 三顺，二顺判断
   public static function shunzi($a, $type)
    {
        sort($a);
        
        if ($type == 2) {
            
            if ($a[0] + 1 == $a[1] || $a[1] + 1 == $a[2]) {
                return true;
            } else {
                return false;
            }
        } else 
            if ($type == 3) {
                
                if ($a[0] + 1 == $a[1] && $a[1] + 1 == $a[2]) {
                    return true;
                } else {
                    return false;
                }
            }
    }
    
    // 广西快乐十分开奖函数 结束
    
    // 江苏快3开奖函数 开始
   public static function Jsk3_Auto($num, $type)
    {
        $zh = $num[0] + $num[1] + $num[2];
        
        // 点数
        if ($type == 1) {
            return $zh;
        }
        
        // 点数大小
        if ($type == 2) {
            if ($zh >= 4 && $zh <= 10) {
                return '点数小';
            }
            if ($zh >= 11 && $zh <= 17) {
                return '点数大';
            }
            return '';
        }
        
        // 点数单双
        if ($type == 3) {
            if ($zh % 2 == 0) {
                return '点数双';
            } else {
                return '点数单';
            }
        }
    }
    
    //获取当前年份的生肖
   public static  function Get_DqShengXiao($year)
    {
        $arr = array('猴','鸡','狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊');
        if( preg_match("/^\d{4}$/",$year))
        {
            $m = $year % 12;
            //echo $m;
            $x = $arr[$m];
        }
        return $x;
    }
    //根据农历新年以及开奖号码整出12计算出该号码的生肖属性
    public static function Get_ShengXiao($year,$hm)
    {
        //$year="2015";
        $arr = array('猴','鸡','狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊');
    
        if( preg_match("/^\d{4}$/",$year))
        {
            $m = $year % 12;
            //echo $m;
            $x = $arr[$m];
        }
        //echo $x;exit;
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
}