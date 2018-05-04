<?php
namespace app\logic;
use think\Db;

class history {
    
    public function gsf($rows){
        include_once APP_PATH .'../common/lottery/auto_class.php';
        foreach ($rows as $key => $row) {
            $hm = array();
            $hm[] = $row['ball_1'];
            $hm[] = $row['ball_2'];
            $hm[] = $row['ball_3'];
            $hm[] = $row['ball_4'];
            $hm[] = $row['ball_5'];
            $hm[] = $row['ball_6'];
            $hm[] = $row['ball_7'];
            $hm[] = $row['ball_8'];
            $hms = array();
            $hms[]      = Ssc_Auto($hm,1);
            $hms[]      = Ssc_Auto($hm,2);
            $hms[]      = Ssc_Auto($hm,3);
            $hms[]      = Ssc_Auto($hm,4);
            $hms[]      = Ssc_Auto($hm,5);                
            //$rows[$key]['hm'] = implode($hm,'-');  
            $rows[$key]['hm'] = $this->BuLing($row['ball_1']).'-'
                . $this->BuLing($row['ball_2']).'-'
                . $this->BuLing($row['ball_3']).'-'
                . $this->BuLing($row['ball_4']).'-'
                . $this->BuLing($row['ball_5']).'-'
                . $this->BuLing($row['ball_6']).'-'
                . $this->BuLing($row['ball_7']).'-'
                . $this->BuLing($row['ball_8']);       
            $rows[$key]['hms'] = $hms; 
        }
        return $rows;
    }
    
    public function cqssc($rows){
        include_once APP_PATH .'../common/lottery/auto_class.php';
        foreach ($rows as $key => $row) {
            $hm = array();
            $hm[] = $row['ball_1'];
            $hm[] = $row['ball_2'];
            $hm[] = $row['ball_3'];
            $hm[] = $row['ball_4'];
            $hm[] = $row['ball_5'];
            $hms = array();
            $hms[]      = Ssc_Auto($hm,1);
            $hms[]      = Ssc_Auto($hm,2);
            $hms[]      = Ssc_Auto($hm,3);
            $hms[]      = Ssc_Auto($hm,4);
            $hms[]      = Ssc_Auto($hm,5);
            $hms[]      = Ssc_Auto($hm,6);
            $hms[]      = Ssc_Auto($hm,7);
            //$rows['qishu'] = substr($row['qishu'],-3)
            $rows[$key]['hm'] = implode($hm,'-');  
            $rows[$key]['hms'] = $hms;         
        }
        return $rows;
    }
    
    public function pk10($rows){
        foreach($rows as $key=>$rs){
            $hm = array();
            $hms = array();
    		$hm[]		= $rs['ball_1'];
    		$hm[]		= $rs['ball_2'];
    		$hm[]		= $rs['ball_3'];
    		$hm[]		= $rs['ball_4'];
    		$hm[]		= $rs['ball_5'];
    		$hm[]		= $rs['ball_6'];
    		$hm[]		= $rs['ball_7'];
    		$hm[]		= $rs['ball_8'];
    		$hm[]		= $rs['ball_9'];
    		$hm[]		= $rs['ball_10'];
    		$hms[]		= Pk10_Auto($hm,1);
    		$hms[]		= Pk10_Auto($hm,2);
    		$hms[]		= Pk10_Auto($hm,3);
    		$hms[]		= Pk10_Auto($hm,4);
    		$hms[]		= Pk10_Auto($hm,5);
    		$hms[]		= Pk10_Auto($hm,6);
    		$hms[]		= Pk10_Auto($hm,7);
    		$hms[]		= Pk10_Auto($hm,8);
            $rows[$key]['hm'] = implode($hm,'-');  
            $rows[$key]['hms'] = $hms;                  
        }
        return $rows;
    }
    
    public function xyft($rows){
        foreach($rows as $key=>$rs){       
            $hm = array();
            $hms = array();
            $hm[]		= $rs['ball_1'];
            $hm[]		= $rs['ball_2'];
            $hm[]		= $rs['ball_3'];
            $hm[]		= $rs['ball_4'];
            $hm[]		= $rs['ball_5'];
            $hm[]		= $rs['ball_6'];
            $hm[]		= $rs['ball_7'];
            $hm[]		= $rs['ball_8'];
            $hm[]		= $rs['ball_9'];
            $hm[]		= $rs['ball_10'];
            $hms[]		= Ssc_Auto($hm,1);
            $hms[]		= Ssc_Auto($hm,2);
            $hms[]		= Ssc_Auto($hm,3);
            $hms[]		= Ssc_Auto($hm,4);
            $hms[]		= Ssc_Auto($hm,5);
            $hms[]		= Ssc_Auto($hm,6);
            $hms[]		= Ssc_Auto($hm,7);
            $hms[]		= Ssc_Auto($hm,8);
            $rows[$key]['hm'] = implode($hm,'-');  
            $rows[$key]['hms'] = $hms;             
        }
        return $rows;
    }
    
    public function xjssc($rows){
        foreach($rows as $key=>$rs){
                $hm = array();
                $hms = array();
                $hm[]		= $rs['ball_1'];
                $hm[]		= $rs['ball_2'];
                $hm[]		= $rs['ball_3'];
                $hm[]		= $rs['ball_4'];
                $hm[]		= $rs['ball_5'];
                
                $hms[]		= Ssc_Auto($hm,1);
                $hms[]		= Ssc_Auto($hm,2);
                $hms[]		= Ssc_Auto($hm,3);
                $hms[]		= Ssc_Auto($hm,4);
                $hms[]		= Ssc_Auto($hm,5);
                $hms[]		= Ssc_Auto($hm,6);
                $hms[]		= Ssc_Auto($hm,7);
                $rows[$key]['hm'] = implode($hm,'-');  
                $rows[$key]['hms'] = $hms;                 
        }
        return $rows;
    }
    
    public function csf($rows)
    {
        foreach($rows as $key=>$row){
            $hm = array();
            $hms = array();
            $hm[] = $row['ball_1'];
            $hm[] = $row['ball_2'];
            $hm[] = $row['ball_3'];
            $hm[] = $row['ball_4'];
            $hm[] = $row['ball_5'];
            $hm[] = $row['ball_6'];
            $hm[] = $row['ball_7'];
            $hm[] = $row['ball_8'];
            $hms[]      = G10_Auto($hm,1);
            $hms[]      = G10_Auto($hm,2);
            $hms[]      = G10_Auto($hm,3);
            $hms[]      = G10_Auto($hm,4);
            $hms[]      = G10_Auto($hm,5);                
            //$rows[$key]['hm'] = implode($hm,'-');  
            $rows[$key]['hm'] = $this->BuLing($row['ball_1']).'-'
                . $this->BuLing($row['ball_2']).'-'
                . $this->BuLing($row['ball_3']).'-'
                . $this->BuLing($row['ball_4']).'-'
                . $this->BuLing($row['ball_5']).'-'
                . $this->BuLing($row['ball_6']).'-'
                . $this->BuLing($row['ball_7']).'-'
                . $this->BuLing($row['ball_8']);       
            $rows[$key]['hms'] = $hms;         
        }
        return $rows;
    }
    
    public function gxsf()
    {
        include_once APP_PATH .'../common/lottery/auto_class.php';
        $rows = Db::name('c_auto_5') -> order('qishu desc') ->limit(3) -> select();
        foreach($rows as $key=>$rs) {
            $hm = array();
            $hms = array();
            $qishu		= $rs['qishu'];
            $hm[]		= $this->BuLing($rs['ball_1']);
            $hm[]		= $this->BuLing($rs['ball_2']);
            $hm[]		= $this->BuLing($rs['ball_3']);
            $hm[]		= $this->BuLing($rs['ball_4']);
            $hm[]		= $this->BuLing($rs['ball_5']);
            $hms[]		= Gxsf_Auto($hm,1);
            $hms[]		= Gxsf_Auto($hm,2);
            $hms[]		= Gxsf_Auto($hm,3);
            $hms[]		= Gxsf_Auto($hm,4);
            $hms[]		= Gxsf_Auto($hm,5);
            $hms[]		= Gxsf_Auto($hm,6);
            $hms[]		= Gxsf_Auto($hm,7);
            $rows[$key]['hm']  = implode('-',$hm) ;
            $rows[$key]['hms'] = $hms    ;
            //$hmlist[$rs['qishu']][]	= $this->BuLing($rs['ball_1']).','.$this->BuLing($rs['ball_2']).','.$this->BuLing($rs['ball_3']).','.$this->BuLing($rs['ball_4']).','.$this->BuLing($rs['ball_5']);
            //$is++;
        }
//        $arr = array(
//            'numbers' => $qishu,
//            'hm' => $hm,
//            'hms' => $hms,
//            'hmlist' => $hmlist,
//        );
//        $json_string = json_encode($arr);
        return $rows ;
    }
    
    public function jsk3()
    {
        include_once APP_PATH .'../common/lottery/auto_class.php';
        $rows = Db::name('c_auto_6') -> order('qishu desc') ->limit(3) -> select();

        $hm    = $hms = $hmlist = array();
        $qishu = '';
        foreach($rows as $key=>$rs){
            $hm = array();
            $hms = array();
            $qishu		= $rs['qishu'];
            $hm[]		= $this->BuLing($rs['ball_1']) ;
            $hm[]		= $this->BuLing($rs['ball_2']) ;
            $hm[]		= $this->BuLing($rs['ball_3']) ;
            $hms[]		= Gxsf_Auto($hm,1) ;
            $hms[]		= Gxsf_Auto($hm,2) ;
            $hms[]		= Gxsf_Auto($hm,3) ;
            $rows[$key]['hm']  = implode('-',$hm) ;
            $rows[$key]['hms'] = $hms    ;
            unset($rows[$key]['ball_4']) ;
            unset($rows[$key]['ball_5']) ;
           // $hmlist[$rs['qishu']][]	= $this->BuLing($rs['ball_1']).','.$this->BuLing($rs['ball_2']).','.$this->BuLing($rs['ball_3']);
        }
//        $arr = array(
//            'numbers' => $qishu,
//            'hm' => $hm,
//            'hms' => $hms,
//            'hmlist' => $hmlist,
//        );
//        dd($arr) ;
//        $json_string = json_encode($arr);
        return $rows;
    }
    

    
    private function BuLing ( $num ) {
    	if ( $num<10 ) {
    		$num = '0'.$num;
    	}
    	return $num;
    }
    
}