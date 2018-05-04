<?php
namespace app\index\controller;

use app\index\Base;
use think\Db;

class Openlist extends Base{
    
    public function cqssc($t = 1){
        date_default_timezone_set('PRC');
        include APP_PATH.'/../common/lottery/auto_class.php';
        $t = intval($t);
        if($t<1 || $t > 7){
            $t = 1;
        }
        $tday = date("Y-m-d",time()-($t-1)*24*3600);
        $list = Db::table('c_auto_2')->where("DATEDIFF(datetime, '$tday')=0")->order('qishu desc')->select();
        $data = [];
        foreach($list as $k => $v){
            $data[$k]['color'] = "#FFF";
            $data[$k]['over'] = "#EBEBEB";
            $data[$k]['out'] = "#FFF";
            $data[$k]['datetime'] = $v['datetime'];
            $data[$k]['qishu'] = $v['qishu'];
            $data[$k]['hm']['ball_1'] = $v['ball_1'];
            $data[$k]['hm']['ball_2'] = $v['ball_2'];
            $data[$k]['hm']['ball_3'] = $v['ball_3'];
            $data[$k]['hm']['ball_4'] = $v['ball_4'];
            $data[$k]['hm']['ball_5'] = $v['ball_5'];
            $data[$k]['hm']['ball_6'] = $v['ball_6'];
            $data[$k]['hm']['ball_7'] = $v['ball_7'];
            $data[$k]['hm']['ball_8'] = $v['ball_8'];
            $data[$k]['hm']['ball_9'] = $v['ball_9'];
            $data[$k]['hm']['ball_10'] = $v['ball_10'];
            $data[$k]['auto']['1'] =  Ssc_Auto(array_values($data[$k]['hm']),1);
            $data[$k]['auto']['2'] =  Ssc_Auto(array_values($data[$k]['hm']),2);
            $data[$k]['auto']['3'] =  Ssc_Auto(array_values($data[$k]['hm']),3);
            $data[$k]['auto']['4'] =  Ssc_Auto(array_values($data[$k]['hm']),4);
            $data[$k]['auto']['5'] =  Ssc_Auto(array_values($data[$k]['hm']),5);
            $data[$k]['auto']['6'] =  Ssc_Auto(array_values($data[$k]['hm']),6);
            $data[$k]['auto']['7'] =  Ssc_Auto(array_values($data[$k]['hm']),7);
            $data[$k]['auto']['8'] =  Ssc_Auto(array_values($data[$k]['hm']),8);
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    
    public function cqklsf($t = 1){
        date_default_timezone_set('PRC');
        include APP_PATH.'/../common/lottery/auto_class.php';
        $t = intval($t);
        if($t<1 || $t > 7){
            $t = 1;
        }
        $tday = date("Y-m-d",time()-($t-1)*24*3600);
        $list = Db::table('c_auto_4')->where("DATEDIFF(datetime, '$tday')=0")->order('qishu desc')->select();
        $data = [];
        foreach($list as $k => $v){
            $data[$k]['color'] = "#FFF";
            $data[$k]['over'] = "#EBEBEB";
            $data[$k]['out'] = "#FFF";
            $data[$k]['datetime'] = $v['datetime'];
            $data[$k]['qishu'] = $v['qishu'];
            $data[$k]['hm']['ball_1'] = $v['ball_1'];
            $data[$k]['hm']['ball_2'] = $v['ball_2'];
            $data[$k]['hm']['ball_3'] = $v['ball_3'];
            $data[$k]['hm']['ball_4'] = $v['ball_4'];
            $data[$k]['hm']['ball_5'] = $v['ball_5'];
            $data[$k]['hm']['ball_6'] = $v['ball_6'];
            $data[$k]['hm']['ball_7'] = $v['ball_7'];
            $data[$k]['hm']['ball_8'] = $v['ball_8'];
            $data[$k]['auto']['1'] =  G10_Auto(array_values($data[$k]['hm']),1);
            $data[$k]['auto']['2'] =  G10_Auto(array_values($data[$k]['hm']),2);
            $data[$k]['auto']['3'] =  G10_Auto(array_values($data[$k]['hm']),3);
            $data[$k]['auto']['4'] =  G10_Auto(array_values($data[$k]['hm']),4);
            $data[$k]['auto']['5'] =  G10_Auto(array_values($data[$k]['hm']),5);
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    
    public function bjpk10($t=1){
        date_default_timezone_set('PRC');
        include APP_PATH.'/../common/lottery/auto_class.php';
        $t = intval($t);
        if($t<1 || $t > 7){
            $t = 1;
        }
        $tday = date("Y-m-d",time()-($t-1)*24*3600);
        $list = Db::table('c_auto_3')->where("DATEDIFF(datetime, '$tday')=0")->order('qishu desc')->select();
        $data = [];
        foreach($list as $k => $v){
            $data[$k]['color'] = "#FFF";
            $data[$k]['over'] = "#EBEBEB";
            $data[$k]['out'] = "#FFF";
            $data[$k]['datetime'] = $v['datetime'];
            $data[$k]['qishu'] = $v['qishu'];
            $data[$k]['hm']['ball_1'] = $v['ball_1'];
            $data[$k]['hm']['ball_2'] = $v['ball_2'];
            $data[$k]['hm']['ball_3'] = $v['ball_3'];
            $data[$k]['hm']['ball_4'] = $v['ball_4'];
            $data[$k]['hm']['ball_5'] = $v['ball_5'];
            $data[$k]['hm']['ball_6'] = $v['ball_6'];
            $data[$k]['hm']['ball_7'] = $v['ball_7'];
            $data[$k]['hm']['ball_8'] = $v['ball_8'];
            $data[$k]['hm']['ball_9'] = $v['ball_9'];
            $data[$k]['hm']['ball_10'] = $v['ball_10'];
            $data[$k]['auto']['1'] =  Pk10_Auto(array_values($data[$k]['hm']),1);
            $data[$k]['auto']['2'] =  Pk10_Auto(array_values($data[$k]['hm']),2);
            $data[$k]['auto']['3'] =  Pk10_Auto(array_values($data[$k]['hm']),3);
            $data[$k]['auto']['4'] =  Pk10_Auto(array_values($data[$k]['hm']),4);
            $data[$k]['auto']['5'] =  Pk10_Auto(array_values($data[$k]['hm']),5);
            $data[$k]['auto']['6'] =  Pk10_Auto(array_values($data[$k]['hm']),6);
            $data[$k]['auto']['7'] =  Pk10_Auto(array_values($data[$k]['hm']),7);
            $data[$k]['auto']['8'] =  Pk10_Auto(array_values($data[$k]['hm']),8);
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    
    public function gdklsf($t = 1){
        date_default_timezone_set('PRC');
        include APP_PATH.'/../common/lottery/auto_class.php';
        $t = intval($t);
        if($t<1 || $t > 7){
            $t = 1;
        }
        $tday = date("Y-m-d",time()-($t-1)*24*3600);
        $list = Db::table('c_auto_1')->where("DATEDIFF(datetime, '$tday')=0")->order('qishu desc')->select();
        $data = [];
        foreach($list as $k => $v){
            $data[$k]['color'] = "#FFF";
            $data[$k]['over'] = "#EBEBEB";
            $data[$k]['out'] = "#FFF";
            $data[$k]['datetime'] = $v['datetime'];
            $data[$k]['qishu'] = $v['qishu'];
            $data[$k]['hm']['ball_1'] = $v['ball_1'];
            $data[$k]['hm']['ball_2'] = $v['ball_2'];
            $data[$k]['hm']['ball_3'] = $v['ball_3'];
            $data[$k]['hm']['ball_4'] = $v['ball_4'];
            $data[$k]['hm']['ball_5'] = $v['ball_5'];
            $data[$k]['hm']['ball_6'] = $v['ball_6'];
            $data[$k]['hm']['ball_7'] = $v['ball_7'];
            $data[$k]['hm']['ball_8'] = $v['ball_8'];
            $data[$k]['auto']['1'] =  G10_Auto(array_values($data[$k]['hm']),1);
            $data[$k]['auto']['2'] =  G10_Auto(array_values($data[$k]['hm']),2);
            $data[$k]['auto']['3'] =  G10_Auto(array_values($data[$k]['hm']),3);
            $data[$k]['auto']['4'] =  G10_Auto(array_values($data[$k]['hm']),4);
            $data[$k]['auto']['5'] =  G10_Auto(array_values($data[$k]['hm']),5);
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    
    public function gxklsf($t = 1){
        date_default_timezone_set('PRC');
        include APP_PATH.'/../common/lottery/auto_class.php';
        $t = intval($t);
        if($t<1 || $t > 7){
            $t = 1;
        }
        $tday = date("Y-m-d",time()-($t-1)*24*3600);
        $list = Db::table('c_auto_5')->where("DATEDIFF(datetime, '$tday')=0")->order('qishu desc')->select();
        $data = [];
        foreach($list as $k => $v){
            $data[$k]['color'] = "#FFF";
            $data[$k]['over'] = "#EBEBEB";
            $data[$k]['out'] = "#FFF";
            $data[$k]['datetime'] = $v['datetime'];
            $data[$k]['qishu'] = $v['qishu'];
            $data[$k]['hm']['ball_1'] = $v['ball_1'];
            $data[$k]['hm']['ball_2'] = $v['ball_2'];
            $data[$k]['hm']['ball_3'] = $v['ball_3'];
            $data[$k]['hm']['ball_4'] = $v['ball_4'];
            $data[$k]['hm']['ball_5'] = $v['ball_5'];
            $data[$k]['auto']['1'] =  Gxsf_Auto(array_values($data[$k]['hm']),1);
            $data[$k]['auto']['2'] =  Gxsf_Auto(array_values($data[$k]['hm']),2);
            $data[$k]['auto']['3'] =  Gxsf_Auto(array_values($data[$k]['hm']),3);
            $data[$k]['auto']['4'] =  Gxsf_Auto(array_values($data[$k]['hm']),4);
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    
    public function xyft($t = 1){
        date_default_timezone_set('PRC');
        include APP_PATH.'/../common/lottery/auto_class.php';
        $t = intval($t);
        if($t<1 || $t > 7){
            $t = 1;
        }
        $tday = date("Y-m-d",time()-($t-1)*24*3600);
        $list = Db::table('c_auto_9')->where("DATEDIFF(datetime, '$tday')=0")->order('qishu desc')->select();
        $data = [];
        foreach($list as $k => $v){
            $data[$k]['color'] = "#FFF";
            $data[$k]['over'] = "#EBEBEB";
            $data[$k]['out'] = "#FFF";
            $data[$k]['datetime'] = $v['datetime'];
            $data[$k]['qishu'] = $v['qishu'];
            $data[$k]['hm']['ball_1'] = $v['ball_1'];
            $data[$k]['hm']['ball_2'] = $v['ball_2'];
            $data[$k]['hm']['ball_3'] = $v['ball_3'];
            $data[$k]['hm']['ball_4'] = $v['ball_4'];
            $data[$k]['hm']['ball_5'] = $v['ball_5'];
            $data[$k]['hm']['ball_6'] = $v['ball_6'];
            $data[$k]['hm']['ball_7'] = $v['ball_7'];
            $data[$k]['hm']['ball_8'] = $v['ball_8'];
            $data[$k]['hm']['ball_9'] = $v['ball_9'];
            $data[$k]['hm']['ball_10'] = $v['ball_10'];
            $data[$k]['auto']['1'] =  Pk10_Auto(array_values($data[$k]['hm']),1);
            $data[$k]['auto']['2'] =  Pk10_Auto(array_values($data[$k]['hm']),2);
            $data[$k]['auto']['3'] =  Pk10_Auto(array_values($data[$k]['hm']),3);
            $data[$k]['auto']['4'] =  Pk10_Auto(array_values($data[$k]['hm']),4);
            $data[$k]['auto']['5'] =  Pk10_Auto(array_values($data[$k]['hm']),5);
            $data[$k]['auto']['6'] =  Pk10_Auto(array_values($data[$k]['hm']),6);
            $data[$k]['auto']['7'] =  Pk10_Auto(array_values($data[$k]['hm']),7);
            $data[$k]['auto']['8'] =  Pk10_Auto(array_values($data[$k]['hm']),8);
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    
    public function xjssc($t=1){
        date_default_timezone_set('PRC');
        include APP_PATH.'/../common/lottery/auto_class.php';
        $t = intval($t);
        if($t<1 || $t > 7){
            $t = 1;
        }
        $tday = date("Y-m-d",time()-($t-1)*24*3600);
        $list = Db::table('c_auto_7')->where("DATEDIFF(datetime, '$tday')=0")->order('qishu desc')->select();
        $data = [];
        foreach($list as $k => $v){
            $data[$k]['color'] = "#FFF";
            $data[$k]['over'] = "#EBEBEB";
            $data[$k]['out'] = "#FFF";
            $data[$k]['datetime'] = $v['datetime'];
            $data[$k]['qishu'] = $v['qishu'];
            $data[$k]['hm']['ball_1'] = $v['ball_1'];
            $data[$k]['hm']['ball_2'] = $v['ball_2'];
            $data[$k]['hm']['ball_3'] = $v['ball_3'];
            $data[$k]['hm']['ball_4'] = $v['ball_4'];
            $data[$k]['hm']['ball_5'] = $v['ball_5'];
            $data[$k]['hm']['ball_6'] = $v['ball_6'];
            $data[$k]['hm']['ball_7'] = $v['ball_7'];
            $data[$k]['hm']['ball_8'] = $v['ball_8'];
            $data[$k]['hm']['ball_9'] = $v['ball_9'];
            $data[$k]['hm']['ball_10'] = $v['ball_10'];
            $data[$k]['auto']['1'] =  Ssc_Auto(array_values($data[$k]['hm']),1);
            $data[$k]['auto']['2'] =  Ssc_Auto(array_values($data[$k]['hm']),2);
            $data[$k]['auto']['3'] =  Ssc_Auto(array_values($data[$k]['hm']),3);
            $data[$k]['auto']['4'] =  Ssc_Auto(array_values($data[$k]['hm']),4);
            $data[$k]['auto']['5'] =  Ssc_Auto(array_values($data[$k]['hm']),5);
            $data[$k]['auto']['6'] =  Ssc_Auto(array_values($data[$k]['hm']),6);
            $data[$k]['auto']['7'] =  Ssc_Auto(array_values($data[$k]['hm']),7);
            $data[$k]['auto']['8'] =  Ssc_Auto(array_values($data[$k]['hm']),8);
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    
    public function jsk3($t = 1){
        date_default_timezone_set('PRC');
        include APP_PATH.'/../common/lottery/auto_class.php';
        $t = intval($t);
        if($t<1 || $t > 7){
            $t = 1;
        }
        $tday = date("Y-m-d",time()-($t-1)*24*3600);
        $list = Db::table('c_auto_6')->where("DATEDIFF(datetime, '$tday')=0")->order('qishu desc')->select();
        $data = [];
        foreach($list as $k => $v){
            $data[$k]['color'] = "#FFF";
            $data[$k]['over'] = "#EBEBEB";
            $data[$k]['out'] = "#FFF";
            $data[$k]['datetime'] = $v['datetime'];
            $data[$k]['qishu'] = $v['qishu'];
            $data[$k]['hm']['ball_1'] = $v['ball_1'];
            $data[$k]['hm']['ball_2'] = $v['ball_2'];
            $data[$k]['hm']['ball_3'] = $v['ball_3'];
            $data[$k]['auto']['1'] =  Jsk3_Auto(array_values($data[$k]['hm']),1);
            $data[$k]['auto']['2'] =  Jsk3_Auto(array_values($data[$k]['hm']),2);
            $data[$k]['auto']['3'] =  Jsk3_Auto(array_values($data[$k]['hm']),3);
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
}
