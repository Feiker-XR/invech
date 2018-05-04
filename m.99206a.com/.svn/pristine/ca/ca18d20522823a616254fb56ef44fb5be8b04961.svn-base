<?php
namespace app\logic;
use think\Config;
use think\Db;
class changlong{
    public static $config = array(
        'ssc_typecode' => array(
            1000=>array(5,"第一球"),
            1001=>array(6,"第二球"),
            1002=>array(7,"第三球"),
            1003=>array(8,"第四球"),
            1004=>array(9,"第五球"),
            
            1005=>array(10,"1-5大小","大"),//大
            1006=>array(10,"1-5大小","小 "),//小
            
            1007=>array(11,"1-5单双","单"),//单
            1008=>array(11,"1-5单双","双"),//双
            
            1009=>array(12,"总和大小","总和大"),//總大
            1010=>array(12,"总和大小","总和小"),//總小
            
            1011=>array(13,"总和单双","总和单"),//總單
            1012=>array(13,"总和单双","总和双"),//總雙
            
            1013=>array(14,"龙虎和","龙"),//龙
            1014=>array(14,"龙虎和","虎"),//虎
            1015=>array(14,"龙虎和","和"),//和
            
            1016=>array(15,"前三","豹子"),//豹子
            1017=>array(15,"前三","顺子"),//顺子
            1018=>array(15,"前三","对子"),//对子
            1019=>array(15,"前三","半顺"),//半顺
            1020=>array(15,"前三","杂六"),//杂六
            
            1021=>array(16,"中三","豹子"),//豹子
            1022=>array(16,"中三","顺子"),//顺子
            1023=>array(16,"中三","对子"),//对子
            1024=>array(16,"中三","半顺"),//半顺
            1025=>array(16,"中三","杂六"),//杂六
            
            1026=>array(17,"后三","豹子"),//豹子
            1027=>array(17,"后三","顺子"),//顺子
            1028=>array(17,"后三","对子"),//对子
            1029=>array(17,"后三","半顺"),//半顺
            1030=>array(17,"后三","杂六"),//杂六
        ),
        'ten_typecode' => array(
            2001=>array(19,"第一球"),
            2002=>array(20,"第二球"),
            2003=>array(21,"第三球"),
            2004=>array(22,"第四球"),
            2005=>array(23,"第五球"),
            2006=>array(24,"第六球"),
            2007=>array(25,"第七球"),
            2008=>array(26,"第八球"),
            2009=>array(27,"1-8大小","大"),//大
            2010=>array(27,"1-8大小","小"),//小
            2011=>array(28,"1-8单双","单"),//單
            2012=>array(28,"1-8单双","双"),//雙
            2013=>array(29,"1-8尾数大小","尾大"),//尾大
            2014=>array(29,"1-8尾数大小","尾小"),//尾小
            2015=>array(30,"1-8合数单双","合数单"),//合單
            2016=>array(30,"1-8合数单双","合数双"),//合雙
            2017=>array(31,"1-8方位","东"),//东
            2018=>array(31,"1-8方位","南"),//南
            2019=>array(31,"1-8方位","西"),//西
            2020=>array(31,"1-8方位","北"),//北
            2021=>array(32,"1-8中发白","中"),//中
            2022=>array(32,"1-8中发白","发"),//发
            2023=>array(32,"1-8中发白","白"),//白
            2024=>array(33,"总和大小","总和大"),//總大
            2025=>array(33,"总和大小","总和小"),//總小
            2026=>array(34,"总和单双","总和单"),//總單
            2027=>array(34,"总和单双","总和双"),//總雙
            2028=>array(35,"总和尾数大小","总和尾大"),//總尾大
            2029=>array(35,"总和尾数大小","总和尾小"),//總尾小
            2030=>array(36,"龙虎","龙"),//龙
            2031=>array(36,"龙虎","虎"),//虎
            2032=>array(37,"任选二","任选二"),
            2033=>array(38,"选二连直","选二连直"),
            2034=>array(39,"选二连組","选二连組"),
            2035=>array(40,"任选三","任选三"),
            2036=>array(41,"选三前直","选三前直"),
            2037=>array(42,"选三前組","选三前組"),
            2038=>array(43,"任选四","任选四"),
            2039=>array(44,"任选五","任选五"),
        ),
        'saiche_typecode' => array(
            3001=>array(53,"冠军"),
            3002=>array(54,"亚军"),
            3003=>array(55,"第三名"),
            3004=>array(56,"第四名"),
            3005=>array(57,"第五名"),
            3006=>array(58,"第六名"),
            3007=>array(59,"第七名"),
            3008=>array(60,"第八名"),
            3009=>array(61,"第九名"),
            3010=>array(62,"第十名"),
            3011=>array(63,"1-10大小","大"),
            3012=>array(63,"1-10大小","小"),
            3013=>array(64,"1-10单双","单"),
            3014=>array(64,"1-10单双","双"),
            3015=>array(65,"1-5龙虎","龙"),
            3016=>array(65,"1-5龙虎","虎"),
            3017=>array(66,"冠亚军和","大"),
            3018=>array(66,"冠亚军和","小"),
            3019=>array(67,"冠亚军和","单"),
            3020=>array(67,"冠亚军和","双"),
            3021=>array(68,"冠亚军和")
        ),
        'xfive_typecode' => array(
            4001=>array(136,"第一球"),
            4002=>array(137,"第二球"),
            4003=>array(138,"第三球"),
            4004=>array(139,"第四球"),
            4005=>array(140,"第五球"),
            4006=>array(141,"1-5大小","大"),
            4007=>array(141,"1-5大小","小"),
            4008=>array(142,"1-5单双","单"),
            4009=>array(142,"1-5单双","双"),
            4010=>array(143,"总和大小","大"),
            4011=>array(143,"总和大小","小"),
            4010=>array(144,"总和单双","单"),
            4011=>array(144,"总和单双","双"),
            4012=>array(145,"总和尾数大小","大"),
            4013=>array(145,"总和尾数大小","小"),
            4014=>array(146,"龙虎","龙"),
            4015=>array(146,"龙虎","虎"),
            4016=>array(147,"一中一"),
            4017=>array(148,"二中二"),
            4018=>array(149,"三中三"),
            4019=>array(150,"四中四"),
            4020=>array(151,"五中五"),
            4021=>array(152,"六中五"),
            4022=>array(153,"七中五"),
            4023=>array(154,"八中五"),
            4024=>array(155,"組选前二"),
            4025=>array(156,"組选前三"),
            4026=>array(157,"直选前二"),
            4027=>array(158,"直选前三")
        )
    );
    
    public static function get_gameType($type){
        $game=0;
        switch($type){
            case '香港六合彩' : $game=0;break;
            case '广东快乐十分' : $game=1;break;
            case '重庆时时彩' : $game=2;break;
            case '北京PK拾' : $game=3;break;
            case '重庆快乐十分' : $game=4;break;
            case '广西快乐十分' : $game=5;break;
            case '江苏快3' : $game=6;break;
            case '新疆时时彩' : $game=7;break;
            case '幸运飞艇' : $game=9;break;
            /*case '北京快乐8' : $game=1;break;
             case '重庆时时彩' : $game=2;break;
             case '广东快乐10分' : $game=3;break;
             case '北京赛车PK拾' : $game=1;break;
             case '幸运28' : $game=5;break;
             case '江苏快3' : $game=6;break;
             case '江西时时彩' : $game=7;break;
             case '幸运飞艇' : $game=8;break;
             case '福彩3D' : $game=9;break;
             case '排列3' : $game=10;break;
             case '幸运农场' : $game=11;break;
             case '幸运28' : $game=12;break;
             case '加拿大28' : $game=13;break;
             case '新疆时时彩' : $game=14;break;*/
        }
        return $game;
    }
    
    public static function switchtable($game_code)
    {
        if(empty($game_code)){
            throw new Exception('期数为空', '00', '');
        }
        return 'c_auto_'.self::get_gameType($game_code);
    } 
    
    public static function _inital($game_code){
        $DataArray = array();
        $endtime = mktime(06, 0, 0, date("m", time() - 6 * 60 * 60), date("d", time() - 6 * 60 * 60), date("Y", time() - 6 * 60 * 60));
        $table = self::switchtable($game_code);
        $SscCode = array('重庆时时彩','新疆时时彩','广西快乐十分');
        $TenCode = array('重庆快乐十分','广东快乐十分');
        $SaicheCode = array('北京PK拾','幸运飞艇');
        $TypeCode = self::$config['ssc_typecode'];
        if($game_code == '广西快乐十分'){
            for ($i = 1; $i <= 5; $i ++) {
                $DataArray[$i][1005] = 0;
                $DataArray[$i][1006] = 0;
                $DataArray[$i][1007] = 0;
                $DataArray[$i][1008] = 0;
            }
            $DataArray[6][1009] = 0;
            $DataArray[6][1010] = 0;
            $DataArray[6][1011] = 0;
            $DataArray[6][1012] = 0;
            $DataArray[6][1013] = 0;
            $DataArray[6][1014] = 0;
            $sql = "select * from $table where datetime>= '".date('Y-m-d H:i:s',$endtime)."' ";
            $sql .= "order by id asc ";
            $row = Db::name($table) ->where('datetime','>=',date('Y-m-d H:i:s',$endtime))->order('id asc')->select();
            foreach ($row as $value) {
                $Number = array($value['ball_1'],$value['ball_2'],$value['ball_3'],$value['ball_4'],$value['ball_5']);
                $NumberTotal = array_sum($Number);
                // 处理1-5球
                $i = 0;
                foreach ($Number as $val) {
                    $i ++;
                    $Ball_number = (int) $val;
                    // 大小
                    if ($Ball_number >= 5) {
                        $DataArray[$i][1005] += 1;
                        $DataArray[$i][1006] = 0;
                    } else {
                        $DataArray[$i][1005] = 0;
                        $DataArray[$i][1006] += 1;
                    }
                    // 单双
                    if ($Ball_number % 2 != 0) {
                        $DataArray[$i][1007] += 1;
                        $DataArray[$i][1008] = 0;
                    } else {
                        $DataArray[$i][1007] = 0;
                        $DataArray[$i][1008] += 1;
                    }
                }
                // 总和大小
                if ($NumberTotal >= 55) {
                    $DataArray[6][1009] += 1;
                    $DataArray[6][1010] = 0;
                } else {
                    $DataArray[6][1009] = 0;
                    $DataArray[6][1010] += 1;
                }
                // 总和单双
                if ($NumberTotal % 2 != 0) {
                    $DataArray[6][1011] += 1;
                    $DataArray[6][1012] = 0;
                } else {
                    $DataArray[6][1011] = 0;
                    $DataArray[6][1012] += 1;
                }
                // 龙虎
                $Number_1 = (int) $Number[0];
                $Number_8 = (int) $Number[4];
                if ($Number_1 > $Number_8) {
                    $DataArray[6][1013] += 1;
                    $DataArray[6][1014] = 0;
                } else {
                    $DataArray[6][1013] = 0;
                    $DataArray[6][1014] += 1;
                }
            }
            // 组合结果
            $Title = array(
                1 => "第1球",
                2 => "第2球",
                3 => "第3球",
                4 => "第4球",
                5 => "第5球",
                6 => ""
            );
            $Result = array();
            foreach ($DataArray as $key => $value) {
                foreach ($value as $k => $v) {
                    if ($v >= 2) {
                        $str = $Title[$key] == "" ? $TypeCode[$k][2] : $Title[$key] . "-" . $TypeCode[$k][2];
                        $Result[] = array(
                            "num" => $v,
                            "title" => $str
                        );
                    }
                }
            }
        }
        if (in_array($game_code, $SscCode) && $game_code != '广西快乐十分') {
            for ($i = 1; $i <= 5; $i ++) {
                $DataArray[$i][1005] = 0;
                $DataArray[$i][1006] = 0;
                $DataArray[$i][1007] = 0;
                $DataArray[$i][1008] = 0;
            }
            $DataArray[6][1009] = 0;
            $DataArray[6][1010] = 0;
            $DataArray[6][1011] = 0;
            $DataArray[6][1012] = 0;
            $DataArray[6][1013] = 0;
            $DataArray[6][1014] = 0;
            $row = Db::name($table) ->where('datetime','>=',date('Y-m-d H:i:s',$endtime))->order('id asc')->select();
            foreach ($row as $value) {
                $Number = array($value['ball_1'],$value['ball_2'],$value['ball_3'],$value['ball_4'],$value['ball_5']);
                $NumberTotal = array_sum($Number);
                // 处理1-5球
                $i = 0;
                foreach ($Number as $val) {
                    $i ++;
                    $Ball_number = (int) $val;
                    // 大小
                    if ($Ball_number >= 5) {
                        $DataArray[$i][1005] += 1;
                        $DataArray[$i][1006] = 0;
                    } else {
                        $DataArray[$i][1005] = 0;
                        $DataArray[$i][1006] += 1;
                    }
                    // 单双
                    if ($Ball_number % 2 != 0) {
                        $DataArray[$i][1007] += 1;
                        $DataArray[$i][1008] = 0;
                    } else {
                        $DataArray[$i][1007] = 0;
                        $DataArray[$i][1008] += 1;
                    }
                }
                // 总和大小
                if ($NumberTotal >= 23) {
                    $DataArray[6][1009] += 1;
                    $DataArray[6][1010] = 0;
                } else {
                    $DataArray[6][1009] = 0;
                    $DataArray[6][1010] += 1;
                }
                // 总和单双
                if ($NumberTotal % 2 != 0) {
                    $DataArray[6][1011] += 1;
                    $DataArray[6][1012] = 0;
                } else {
                    $DataArray[6][1011] = 0;
                    $DataArray[6][1012] += 1;
                }
                // 龙虎
                $Number_1 = (int) $Number[0];
                $Number_8 = (int) $Number[4];
                if ($Number_1 > $Number_8) {
                    $DataArray[6][1013] += 1;
                    $DataArray[6][1014] = 0;
                } else {
                    $DataArray[6][1013] = 0;
                    $DataArray[6][1014] += 1;
                }
            }
            // 组合结果
            $Title = array(
                1 => "第1球",
                2 => "第2球",
                3 => "第3球",
                4 => "第4球",
                5 => "第5球",
                6 => ""
            );
            $Result = array();
            foreach ($DataArray as $key => $value) {
                foreach ($value as $k => $v) {
                    if ($v >= 2) {
                        $str = $Title[$key] == "" ? $TypeCode[$k][2] : $Title[$key] . "-" . $TypeCode[$k][2];
                        $Result[] = array(
                            "num" => $v,
                            "title" => $str
                        );
                    }
                }
            }
        }
        if (in_array($game_code, $TenCode)) {
            $TypeCode = self::$config['ten_typecode'];
            for ($i = 1; $i <= 8; $i ++) {
                $DataArray[$i][2009] = 0;
                $DataArray[$i][2010] = 0;
                $DataArray[$i][2011] = 0;
                $DataArray[$i][2012] = 0;
                $DataArray[$i][2013] = 0;
                $DataArray[$i][2014] = 0;
                $DataArray[$i][2015] = 0;
                $DataArray[$i][2016] = 0;
            }
            $DataArray[9][2024] = 0;
            $DataArray[9][2025] = 0;
            $DataArray[9][2026] = 0;
            $DataArray[9][2027] = 0;
            $DataArray[9][2028] = 0;
            $DataArray[9][2029] = 0;
            $DataArray[9][2030] = 0;
            $DataArray[9][2031] = 0;
            $row = Db::name($table) ->where('datetime','>=',date('Y-m-d H:i:s',$endtime))->order('id asc')->select();
            foreach ($row as $value) {
                $i = 0;
                $Number = array(
                    $value['ball_1'],$value['ball_2'],$value['ball_3'],$value['ball_4'],
                    $value['ball_5'],$value['ball_6'],$value['ball_7'],$value['ball_8']
                );
                $NumberTotal = array_sum($Number);
                foreach ($Number as $val) {
                    $i ++;
                    $Ball_number = (int) $val;
                    // 大小
                    if ($Ball_number >= 11) {
                        $DataArray[$i][2009] += 1;
                        $DataArray[$i][2010] = 0;
                    } else {
                        $DataArray[$i][2009] = 0;
                        $DataArray[$i][2010] += 1;
                    }
                    // 单双
                    if ($Ball_number % 2 != 0) {
                        $DataArray[$i][2011] += 1;
                        $DataArray[$i][2012] = 0;
                    } else {
                        $DataArray[$i][2011] = 0;
                        $DataArray[$i][2012] += 1;
                    }
                    // 尾数大小
                    $Ball_number = $val{1};
                    if ($Ball_number < 5 && !empty($Ball_number)) {
                        $DataArray[$i][2013] = 0;
                        $DataArray[$i][2014] += 1;
                    } else if($Ball_number >=5) {
                        $DataArray[$i][2013] += 1;
                        $DataArray[$i][2014] = 0;
                    }
                    // 合数单双
                    $Ball_number = (int) $val{0} + (int) $val{1};
                    if ($Ball_number % 2 != 0) {
                        $DataArray[$i][2015] += 1;
                        $DataArray[$i][2016] = 0;
                    } else {
                        $DataArray[$i][2015] = 0;
                        $DataArray[$i][2016] += 1;
                    }
                }
                // 总和大小
                if ($NumberTotal >= 85 && $NumberTotal <= 132) {
                    $DataArray[9][2024] += 1;
                    $DataArray[9][2025] = 0;
                } elseif ($NumberTotal >= 36 && $NumberTotal <= 83) {
                    $DataArray[9][2024] = 0;
                    $DataArray[9][2025] += 1;
                }
                // 总和单双
                if ($NumberTotal % 2 != 0) {
                    $DataArray[9][2026] += 1;
                    $DataArray[9][2027] = 0;
                } else {
                    $DataArray[9][2026] = 0;
                    $DataArray[9][2027] += 1;
                }
                // 总和尾数大小
                $TotalString = (string) $NumberTotal;
                $Weishu = $TotalString{strlen($TotalString) - 1};
                if ($Weishu >= 5) {
                    $DataArray[9][2028] += 1;
                    $DataArray[9][2029] = 0;
                } elseif ($Weishu < 5 && !empty($Weishu) ) {
                    $DataArray[9][2028] = 0;
                    $DataArray[9][2029] += 1;
                }
                // 龙虎
                $Number_1 = (int) $Number[0];
                $Number_8 = (int) $Number[7];
                if ($Number_1 > $Number_8) {
                    $DataArray[9][2030] += 1;
                    $DataArray[9][2031] = 0;
                } else {
                    $DataArray[9][2030] = 0;
                    $DataArray[9][2031] += 1;
                }
            }
            $Title = array(
                1 => "第1球",
                2 => "第2球",
                3 => "第3球",
                4 => "第4球",
                5 => "第5球",
                6 => "第6球",
                7 => "第7球",
                8 => "第8球",
                9 => ""
            );
            $Result = array();
            foreach ($DataArray as $key => $value) {
                foreach ($value as $k => $v) {
                    if ($v >= 3) {
                        $str = $Title[$key] == "" ? $TypeCode[$k][2] : $Title[$key] . "-" . $TypeCode[$k][2];
                        $Result[] = array(
                            "num" => $v,
                            "title" => $str
                        );
                    }
                }
            }
        }
        if (in_array($game_code, $SaicheCode)) {
            $TypeCode = self::$config["saiche_typecode"];
            for ($i = 1; $i <= 10; $i ++) {
                $DataArray[$i][3011] = 0;
                $DataArray[$i][3012] = 0;
                $DataArray[$i][3013] = 0;
                $DataArray[$i][3014] = 0;
                $DataArray[$i][3015] = 0;
                $DataArray[$i][3016] = 0;
            }
            $DataArray[11][3017] = 0;
            $DataArray[11][3018] = 0;
            $DataArray[11][3019] = 0;
            $DataArray[11][3020] = 0;
            $sql = "select * from $table where datetime>= '".date('Y-m-d H:i:s',$endtime)."' ";
            $sql .= "order by id asc ";
            $row = Db::name($table) ->where('datetime','>=',date('Y-m-d H:i:s',$endtime))->order('id asc')->select();
            foreach ($row as $key => $value) {
                $i = 0;
                $Number = array(
                    $value['ball_1'],$value['ball_2'],$value['ball_3'],$value['ball_4'],
                    $value['ball_5'],$value['ball_6'],$value['ball_7'],$value['ball_8'],
                    $value['ball_9'],$value['ball_10']
                );
                $NumberTotal = ((int) $Number[0] + (int) $Number[1]);
                $ArrayLH = "";
                // 龙虎
                $ArrayLH = array(
                    1 => array(
                        $Number[0],
                        $Number[9]
                    ),
                    2 => array(
                        $Number[1],
                        $Number[8]
                    ),
                    3 => array(
                        $Number[2],
                        $Number[7]
                    ),
                    4 => array(
                        $Number[3],
                        $Number[6]
                    ),
                    5 => array(
                        $Number[4],
                        $Number[5]
                    )
                );
                foreach ($Number as $val) {
                    $i ++;
                    $Ball_number = (int) $val;
                    // 大小
                    if ($Ball_number >= 6) {
                        $DataArray[$i][3011] += 1;
                        $DataArray[$i][3012] = 0;
                    } else {
                        $DataArray[$i][3011] = 0;
                        $DataArray[$i][3012] += 1;
                    }
                    // 单双
                    if ($Ball_number % 2 != 0) {
                        $DataArray[$i][3013] += 1;
                        $DataArray[$i][3014] = 0;
                    } else {
                        $DataArray[$i][3013] = 0;
                        $DataArray[$i][3014] += 1;
                    }
                }
                // 1-5龙虎
                for ($i = 1; $i <= 5; $i ++) {
                    if ($ArrayLH[$i][0] > $ArrayLH[$i][1]) {
                        $DataArray[$i][3015] += 1;
                        $DataArray[$i][3016] = 0;
                    } else {
                        $DataArray[$i][3015] = 0;
                        $DataArray[$i][3016] += 1;
                    }
                }
                // 冠亚和
                // 大小
                if ($NumberTotal > 11) {
                    $DataArray[11][3017] += 1;
                    $DataArray[11][3018] = 0;
                } else {
                    $DataArray[11][3017] = 0;
                    $DataArray[11][3018] += 1;
                }
                // 单双
                if ($NumberTotal % 2 != 0) {
                    $DataArray[11][3017] += 1;
                    $DataArray[11][3018] = 0;
                } else {
                    $DataArray[11][3017] = 0;
                    $DataArray[11][3018] += 1;
                }
            }
            // 组合结果
            $Title = array(
                1 => "冠军",
                2 => "亚军",
                3 => "第三名",
                4 => "第四名",
                5 => "第五名",
                6 => "第六名",
                7 => "第七名",
                8 => "第八名",
                9 => "第九名",
                10 => "第十名",
                11 => "冠亚和"
            );
            $Result = array();
            foreach ($DataArray as $key => $value) {
                foreach ($value as $k => $v) {
                    if ($v >= 3) {
                        $str = $Title[$key] . "-" . $TypeCode[$k][2];
                        $Result[] = array(
                            "num" => $v,
                            "title" => $str
                        );
                    }
                }
            }
        }
        // 排序
        unset($num);
        $num = [];
        $title = [];
        foreach ($Result as $key => $row) {
            $num[$key] = $row['num'];
            $title[$key] = $row['title'];
        }
        array_multisort($num, SORT_DESC, $title, SORT_ASC, $Result);
        return $Result;
    }
}