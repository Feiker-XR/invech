<?php

namespace app\classes;


class qishu{

    public static function onHdXjSsc($actionNo, $time=null){        
        if($actionNo>=96){
            $actionNo=date('Ymd-'.$actionNo, $time - 24*3600);
        }else{
            $actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
        }
        return $actionNo;
    }
    
    public static function noHd($actionNo, $time=null){        
        $actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
        return $actionNo;
    }

    public static function no6Hd($actionNo, $time=null){
        $actionNo=substr(date('Yz', $time),0,4).substr(1000+$actionNo,1);
        return $actionNo;
    }

    public static function no0Hdk3($actionNo, $time=null){        
        $actionNo=date('md', $time).substr(100+$actionNo,1);
        return $actionNo;
    }

    public static function no0Hdf($actionNo, $time=null){        
        $actionNo=date('Ymd-', $time).substr(10000+$actionNo,1);
        return $actionNo;
    }
    
    public static function GXklsf($actionNo, $time=null){        
        $actionNo=date('Yz', $time).substr(100+$actionNo,1)+100;
        $actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+100000,1);
        return $actionNo;
    }
    
    //北京快乐8
    public static function bjkl8($actionNo, $time=null){        
        $actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-3857;
        return $actionNo;        
    }

    //澳门快乐8
    public static function amkl8($actionNo, $time=null){        
        $actionNo = 288*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-1234;
        return $actionNo;
    }

    //韩国快乐8
    public static function hgkl8($actionNo, $time=null){        
        $actionNo = 288*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-4567;
        return $actionNo;
    }

    //澳门幸运农场
    public static function amxync($actionNo, $time=null){        
        $actionNo=date('17md', $time).substr(1000+$actionNo,1);
        return $actionNo;
    }   
    
    //台湾幸运农场
    public static function twxync($actionNo, $time=null){        
        $actionNo=date('17md', $time).substr(1000+$actionNo,1);
        return $actionNo;
    }       

    //澳门PK10
    public static function ampk10($actionNo, $time=null){        
        $actionNo = 288*(strtotime(date('Y-m-d', $time))-strtotime('2007-11-11'))/3600/24+$actionNo-6789;
        return $actionNo;
    }

    //台湾PK10
    public static function twpk10($actionNo, $time=null){        
        $actionNo = 288*(strtotime(date('Y-m-d', $time))-strtotime('2007-11-11'))/3600/24+$actionNo-4321;
        return $actionNo;
    }   

    //天津时时彩
    public static function tjssc($actionNo, $time=null){        
        if($actionNo>84){
            $time-=24*3600;
        }        
        $actionNo=date('17md', $time).substr(1000+$actionNo,1);
        return $actionNo;
    }   

    //广东11选5
    public static function gd11($actionNo, $time=null){        
        if($actionNo>84){
            $time-=24*3600;
        }        
        $actionNo=date('17md', $time).substr(100+$actionNo,1);
        return $actionNo;
    }   

    //江西11选5
    public static function jx11($actionNo, $time=null){        
        if($actionNo>84){
            $time-=24*3600;
        }        
        $actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
        return $actionNo;
    }   

    //山东11选5
    public static function sd11($actionNo, $time=null){        
        if($actionNo>90){
            $time-=24*3600;
        }        
        $actionNo=date('17md', $time).substr(100+$actionNo,1);
        return $actionNo;
    }   

    //上海11选5
    public static function sh11($actionNo, $time=null){        
        $actionNo=date('17md', $time).substr(100+$actionNo,1);
        return $actionNo;
    }

    //江苏快3
    public static function jsk3($actionNo, $time=null){        
        $actionNo=date('Ymd', $time).substr(1000+$actionNo,1);
        return $actionNo;
    }   
    
    public static function xjssc($actionNo, $time=null){        
        if($actionNo>84){
            $time-=24*3600;
        }        
        $actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
        return $actionNo;
    }
    

    //重庆时时彩 后置事件处理函数
    public static function noHdCQSSC($actionNo, $time=null) {        
        if($actionNo==0||$actionNo==120){
            $actionNo=date('Ymd-120', $time - 24*3600);
            //$actionTime=date('Y-m-d 00:00', $time);            
        }else{
            $actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
        }
        return $actionNo;
    }

    //江西时时彩
    public static function no0Hd($actionNo, $time=null){        
        $actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
        return $actionNo;
    }
    
    public static function noFF0Hd($actionNo, $time=null){        
        $actionNo=date('Ymd-', $time).substr(10000+$actionNo,1);
        return $actionNo;
    }
    
    // 韩国1.5分彩
    public static function hgssc($actionNo, $time=null) {        
        $actionTimeStamps = strtotime(date('Y-m-d 00:00:00', $time)) + ($actionNo-1)*90;
        $actionTime = date('Y-m-d H:i:s', $actionTimeStamps);
        $actionNo = intval((strtotime($actionTime) - 30 - strtotime('2016-12-20 23:57:00')) / 90) + 1718360;
        $actionNo = strval($actionNo);
        return $actionNo;
    }
    
    // dj1.5分彩
    public static function djssc($actionNo, $time=null) {    
        $actionTimeStamps = strtotime(date('Y-m-d 00:00:00', $time)) + ($actionNo-1)*90;
        $actionTime = date('Y-m-d H:i:s', $actionTimeStamps);        
        $actionNo = intval((strtotime($actionTime) - 30 - strtotime('2016-12-20 23:57:00')) / 90) + 1713161;
        $actionNo = strval($actionNo);
        return $actionNo;
    }
    
    //五分 二分彩 //未处理
    public static function noWF0Hd($actionNo, $time=null){        
        if($actionNo==1 && time()>strtotime(' 23:55:00')){
            if($time > time()+ 23*3600) $time = $time-24*3600;
            $actionNo=date('Ymd-001', $time + 24*3600);
            $actionTime=date('Y-m-d 00:00', $time + 24*3600);
            
        }elseif($actionNo==2 && time()>strtotime(' 23:55:00')){
            $actionNo=date('Ymd-002', strtotime($actionTime) + 24*3600);
            $actionTime=date('Y-m-d H:i:s', strtotime($actionTime) + 24*3600);
        }
        else{
            $actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
        }
        return $actionNo;
    }
    
    //新疆时时彩
    public static function noxHd($actionNo, $time=null){        
        if($actionNo>=84){
            $time-=24*3600;
        }        
        $actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
        return $actionNo;
    }
    
    //福彩3D、排列三
    public static function pai3($actionNo, $time=null){
        
        $actionNo=date('Yz', $time);
        $actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+994,1);
        /*
        if($actionTime >= date('Y-m-d H:i:s', $time)){
            
        }else{
            $kjTime=$this->getTypeFtime($this->type);
            if(date('Y-m-d H:i:s', time()+$kjTime)<date('Y-m-d 23:59:59',time()))
                $actionTime=date('Y-m-d 19:30', time()+24*60*60);
                else
                {
                    $actionNo = $actionNo+1;
                    $actionTime=date('Y-m-d 19:30', time()+24*60*60);
                }
        }
        */
        return $actionNo;
    }
    
    //北京PK10
    public static function BJpk10($actionNo, $time=null){        
        $actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2007-11-11'))/3600/24+$actionNo-3774-19;
        return $actionNo;
    }
    
    //北京快乐8
    public static function Kuai8($actionNo, $time=null){        
        $actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-3838;
        return $actionNo;
    }
    
    //幸运飞艇
    public static function onXyft($actionNo, $time=null){        
        if($actionNo>132){
            $actionNo = date("Ymd",$time-60*60*5).substr(1000+$actionNo,1);
        }else{
            $actionNo = date("Ymd",$time).substr(1000+$actionNo,1);
        }
        return $actionNo;
    }

    //重庆快乐十分 96期 同新疆时时彩
    public static function onCsf($actionNo, $time=null){
        self::noxHd($actionNo,$actionTime,$time);
        return $actionNo;
    }
}

