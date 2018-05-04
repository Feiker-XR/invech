<?php
// +----------------------------------------------------------------------
// | FileName: betQ.php
// +----------------------------------------------------------------------
// | CreateDate: 2018年1月30日
// 获取追号未来期数及开奖时间函数
// +----------------------------------------------------------------------
// | Author: sky
// +----------------------------------------------------------------------
namespace app\logic;
use think\Db;

class betQ{

     public static function ssc($type,$actionNum,$price,$beishu,$count){
          date_default_timezone_set("PRC");
          $cqtime = '';
         switch ($type) {
            case 1:
                 $cqtime = 'c_opentime_2';
                 break;
            case 2:
                 $cqtime = 'c_opentime_7';
                  break;
            case 4:
                 $cqtime = 'c_opentime_2fc';
                  break;
            case 5:
                 $cqtime = 'c_opentime_5fc';
                  break;
             
          } 
         //获取传进了的期号
        $dqqh =intval(substr($actionNum, -3)); 
        if($dqqh[0] =='0'){
             $dqqh =  intval(substr($dqqh, -2)); 
        }else if($dqqh[0] =='0' && $dqqh[1] =='0'){
            $dqqh =  intval(substr($dqqh, -1)); 
        }
        $list = [];

        //获取未来多少期
        if($count == 0){
             $qs = Db::table( $cqtime)->field('qishu,kaijiang')->where('qishu' ,'>=',$dqqh)->select();

             foreach($qs as $k=>$v){
                $list[$k]['lastactionNum'] = date("Ymd", time()) . self::BuLings($v['qishu']);
                $list[$k]['kjtime'] = date('Y-m-d H:i:s',strtotime(date("Y-m-d", time()) . ' ' . $v['kaijiang']));
                $list[$k]['price'] = $price;
                $list[$k]['beishu'] = $beishu;
               
            }

        }else{
            $qs = Db::table($cqtime)->field('qishu,kaijiang')->where('qishu' ,'>=',$dqqh)->limit($count)->order('id asc')->select();
            $num = count( $qs);
            if($num<$count){
                $count = $count -  $num;
                 $qsm = Db::table($cqtime)->field('qishu,kaijiang')->where('qishu' ,'>=',1)->limit($count)->order('id asc')->select();
                 $i=0;
                 foreach($qs as $k=>$v){
                    $list[$i]['lastactionNum'] = date("Ymd", time()) . self::BuLings($v['qishu']);
                    $list[$i]['kjtime'] = date('Y-m-d H:i:s',strtotime(date("Y-m-d", time()) . ' ' . $v['kaijiang']));
                    $list[$k]['price'] = $price;
                     $list[$k]['beishu'] = $beishu;
                     $i++;
                 }
                foreach($qsm as $key=>$val){
                    $list[$i]['lastactionNum'] = date("Ymd",strtotime(date('Y-m-d',strtotime('+1 day')))) . self::BuLings($val['qishu']);
                    $list[$i]['kjtime'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d',strtotime('+1 day')) . ' ' . $val['kaijiang']));
                    $list[$k]['price'] = $price;
                    $list[$k]['beishu'] = $beishu;
                     $i++;
                 }

            }else{
                 foreach($qs as $k=>$v){
                    $list[$k]['lastactionNum'] = date("Ymd", time()) . self::BuLings($v['qishu']);
                    $list[$k]['kjtime'] = date('Y-m-d H:i:s',strtotime(date("Y-m-d", time()) . ' ' . $v['kaijiang']));
                    $list[$k]['price'] = $price;
                    $list[$k]['beishu'] = $beishu;
                 }
            }
        }

      return  $list;

     }

      public static function pk10($type,$actionNum,$price,$beishu,$count){
            //获取当前期数
             date_default_timezone_set("PRC");
            $ctime = date("H:i:s",time());
            $dqqs = Db::table('c_opentime_3')->field('qishu')->where('kaipan','<=',$ctime)->where('kaijiang','>=',$ctime)->order('id asc') -> find();
            $list = [];
            $pk10_date = '2016-06-09';
            $pk10_qi = 558287;
            $qishu = 0;
             //获取未来多少期 $count = 0 获取今天全部期数
            if($count == 0){
                 $qs = Db::table('c_opentime_3')->field('qishu,kaijiang')->where('qishu' ,'>=', $dqqs['qishu'])->select();
                foreach($qs as $k=>$v){
                    $l_date = date("Y-m-d",time());
                    $pk10_t = intval((strtotime($l_date)-strtotime($pk10_date))/86400)+1-7;
                    $pk10_t = $pk10_t == 0 ? 1 : $pk10_t ;
                    $qishu      = ($pk10_t-1)*179+$v['qishu']+$pk10_qi -20;
                    $list[$k]['lastactionNum'] = $qishu;
                    $list[$k]['kjtime'] = date('Y-m-d H:i:s',strtotime(date("Y-m-d", time()) . ' ' . $v['kaijiang']));
                    $list[$k]['price'] = $price;
                    $list[$k]['beishu'] = $beishu;
                  
                }
             }else{
                    $qs = Db::table('c_opentime_3')->field('qishu,kaijiang')->where('qishu' ,'>=',$dqqs['qishu'])->limit($count)->order('id asc')->select();
                    $num = count( $qs);
                    if($num<$count){
                        $count = $count -  $num;
                         $qsm = Db::table('c_opentime_3')->field('qishu,kaijiang')->where('qishu' ,'>=',1)->limit($count)->order('id asc')->select();
                         $i=0;
                         foreach($qs as $k=>$v){
                            $l_date = date("Y-m-d",time());
                            $pk10_t = intval((strtotime($l_date)-strtotime($pk10_date))/86400)+1-7;
                            $pk10_t = $pk10_t == 0 ? 1 : $pk10_t ;
                            $qishu      = ($pk10_t-1)*179+$v['qishu']+$pk10_qi -20;
                            $list[$i]['lastactionNum'] =  $qishu;
                            $list[$i]['kjtime'] = date('Y-m-d H:i:s',strtotime(date("Y-m-d", time()) . ' ' . $v['kaijiang']));
                            $list[$k]['price'] = $price;
                            $list[$k]['beishu'] = $beishu;
                            $i++;
                         }
                        foreach($qsm as $key=>$val){
                            $l_date = date('Y-m-d',strtotime('+1 day'));
                            $pk10_t = intval((strtotime($l_date)-strtotime($pk10_date))/86400)+1-7;
                            $pk10_t = $pk10_t == 0 ? 1 : $pk10_t ;
                            $qishu   = ($pk10_t-1)*179+$v['qishu']+$pk10_qi -20;
                            $list[$i]['lastactionNum'] =  $qishu;
                            $list[$i]['kjtime'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d',strtotime('+1 day')) . ' ' . $val['kaijiang']));
                            $list[$k]['price'] = $price;
                            $list[$k]['beishu'] = $beishu;
                             $i++;
                         }

                    }else{
                         foreach($qs as $k=>$v){
                            $l_date = date("Y-m-d",time());
                            $pk10_t = intval((strtotime($l_date)-strtotime($pk10_date))/86400)+1-7;
                            $pk10_t = $pk10_t == 0 ? 1 : $pk10_t ;
                            $qishu  = ($pk10_t-1)*179+$v['qishu']+$pk10_qi -20;
                            $list[$k]['lastactionNum'] =  $qishu;
                            $list[$k]['kjtime'] = date('Y-m-d H:i:s',strtotime(date("Y-m-d", time()) . ' ' . $v['kaijiang']));
                            $list[$k]['price'] = $price;
                            $list[$k]['beishu'] = $beishu;
                         }
                    }
             }
              return  $list;
      }
    
 
        /*
     * 数字补0函数2，当数字小于10的时候在前面自动补00，当数字大于10小于100的时候在前面自动补0
     */
    private static function BuLings($num)
    {
        if ($num < 10) {
            $num = '00' . $num;
        }
        if ($num > 10 && $num < 100) {
            $num = '0' . $num;
        }
        return $num;
    }
}

