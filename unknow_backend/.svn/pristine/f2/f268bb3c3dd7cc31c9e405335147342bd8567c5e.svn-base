<?php
namespace app\logic;
use think\Db;

class qishu {
    
    public static function six(){
        date_default_timezone_set('PRC');
        $ctime = date("Y-m-d H:i:s");
        //$sql	=	"select qishu from c_auto_".$type." where opentime<='".date("Y-m-d H:i:s",$lottery_time)."' and endtime>='".date("Y-m-d H:i:s",$lottery_time)."' and ok=0 limit 1";
        $qs = Db::table('c_auto_0')->where('opentime','<=',$ctime)->where('endtime','>=',$ctime)->where('ok',0)->limit(1)->find();
		//$query	=	$mysqli->query($sql);
		//$qs		=	$query->fetch_array();
		//var_dump($qs);exit;
		if($qs){
			return $qs['qishu'];
		}else{
			return -1;
		}
    }
    
    public static function cqssc(){
        date_default_timezone_set('PRC');
        $ctime = date("H:i:s");
        if($ctime >= '23:59:30' || $ctime <= '00:04:30'){
            $qs = Db::table('c_opentime_2')->where('qishu' ,'=','1')->limit('1')->select();
        }else{
            $qs = Db::table('c_opentime_2')->where('kaipan','<=',$ctime)->where('fengpan','>=',$ctime)->select();
        }
        if($qs){
            $qs = $qs[0];
            if($ctime >= '23:59:30'){
                return date("Ymd", time()+86400) . self::BuLings($qs['qishu']);
            }else{
                return date("Ymd", time()) . self::BuLings($qs['qishu']);
            }
        }else{
            return -1;
        }    
    }
    
    public static function xyft(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $h = date("H",$lottery_time);
        $i = date('i',$lottery_time);
        $last = strtotime(date("Y-m-d",$lottery_time)." 23:59:00");
        $first = strtotime(date("Y-m-d",$lottery_time)." 00:04:00");
        $ctime = date("H:i:s");
        if($lottery_time >= $last || $lottery_time <=  $first){
            $qs = Db::table('c_opentime_9')->where('qishu' ,'=','132')->limit('1')->select()[0];
        }else{
            $qs = Db::table('c_opentime_9')->where('kaipan','<=',$ctime)->where('fengpan','>=',$ctime)->select()[0];
        }
        if($qs){
            if($qs['qishu'] >= 130) {
                return date("Ymd",$lottery_time-60*60*5).self::BuLings($qs['qishu']);
            }else{
                return date("Ymd",$lottery_time).self::BuLings($qs['qishu']);
            }
        }else{
            return -1;
        }
    }
    
    public static function xjssc(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $ctime = date("H:i:s");
        $qs = Db::table('c_opentime_7')->where('kaipan','<=',$ctime)->where('fengpan','>=',$ctime)->select()[0];
        if($qs){
            if($qs['qishu'] >= 85) {
                return date("Ymd",$lottery_time-60*60*2).self::BuLings($qs['qishu']);
            }else{
                return date("Ymd",$lottery_time).self::BuLings($qs['qishu']);
            }
        }else{
            return -1;
        }
        
    }
    
    public static function cqklsf(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $h = date("H",$lottery_time);
        $i = date('i',$lottery_time);
        $ctime = date("H:i:s",$lottery_time);
        $last = strtotime(date("Y-m-d",$lottery_time)." 23:53:00");
        $first = strtotime(date("Y-m-d",$lottery_time)." 00:03:00");
        if($lottery_time >= $last || $lottery_time <=  $first){
            $qs = Db::table('c_opentime_4')->where('qishu' ,'=','1')->limit('1')->select()[0];
        }else{
            $qs = Db::table('c_opentime_4') -> where('kaipan','<=',$ctime) -> where('fengpan','>=',$ctime)->order('id asc')->select()[0];
        }
        if($qs){
            if($qs['qishu'] == 1){
                return date("Ymd",$lottery_time + 7*60*60).self::BuLings($qs['qishu']);
            }else{
                return date("Ymd",$lottery_time).self::BuLings($qs['qishu']);
            }
        }else{
            return -1;
        }
    }
    
    public static function gsf(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $ctime = date("H:i:s");
        $qs = Db::table('c_opentime_1')->where('kaipan','<=',$ctime)->where('fengpan','>=',$ctime)->select()[0];
        if($qs){
            return date("Ymd",$lottery_time).self::BuLings($qs['qishu']);
        }else{
            return -1;
        }
    }
    
    /**
     * PK10期数
     */
    public static function pk10(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $ctime = date("H:i:s");
        $h = date("H",$lottery_time);
        $i = date('i',$lottery_time);
        $last = strtotime(date("Y-m-d",$lottery_time)." 23:59:00");
        $first = strtotime(date("Y-m-d",$lottery_time)." 00:04:00");
        $qs = Db::table('c_opentime_3') -> where('kaipan','<=',$ctime)->where('fengpan','>=',$ctime) ->limit(1)->select() ;
        if($qs){
            $qs = $qs[0];
            $l_date=date("Y-m-d",$lottery_time);
			//echo $l_date;
			$pk10_date = '2016-06-09';
			$pk10_qi = 558287;
			$pk10_t = intval((strtotime($l_date)-strtotime($pk10_date))/86400)+1-14;
			$pk10_t = $pk10_t == 0 ? 1 : $pk10_t ;
			$qishu		= ($pk10_t-1)*179+$qs['qishu']+$pk10_qi -20;
			return $qishu ;
        }else{
            return -1;
        }
        
    }
    
    public static function gxsf(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $ctime = date("H:i:s");
        $qs = Db::table('c_opentime_5') -> where('kaipan','<=',$ctime)->where('fengpan','>=',$ctime) ->limit(1)->select()[0] ;
        if($qs){
            return date("Y",$lottery_time).(self::BuLings(date("z",$lottery_time - 6*86400))).self::BuLing($qs['qishu']);
        }else{
            return -1;
        }
    }
    
    public static function jsk3(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $ctime = date("H:i:s");
        $qs = Db::table('c_opentime_6') -> where('kaipan','<=',$ctime)->where('fengpan','>=',$ctime) ->limit(1)->select()[0] ;
        if($qs){
            return substr(date("Ymd",$lottery_time), 2,6).self::BuLings($qs['qishu']);
        }else{
            return -1;
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
    /*
     数字补0函数2，当数字小于10的时候在前面自动补00，当数字大于10小于100的时候在前面自动补0
     */
   public static function BuLings ( $num ) {
        if ( $num<10 ) {
            $num = '00'.$num;
        }
        if ( $num>=10 && $num<100 ) {
            $num = '0'.$num;
        }
        return $num;
    }
}