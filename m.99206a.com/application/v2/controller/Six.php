<?php
namespace app\v2\controller;
use app\v2\Base;
use think\Db;
use think\Session;
class six extends Base{
    
    public function _initialize(){
        parent::_initialize();
        $sx_01  = '<div class="ball_11">11</div><div class="ball_23">23</div><div class="ball_35">35</div><div class="ball_47">47</div>';
        $sx_02  = '<div class="ball_10">10</div><div class="ball_22">22</div><div class="ball_34">34</div><div class="ball_46">46</div>';
        $sx_03  = '<div class="ball_09">09</div><div class="ball_21">21</div><div class="ball_33">33</div><div class="ball_45">45</div>';
        $sx_04  = '<div class="ball_08">08</div><div class="ball_20">20</div><div class="ball_32">32</div><div class="ball_44">44</div>';
        $sx_05  = '<div class="ball_07">07</div><div class="ball_19">19</div><div class="ball_31">31</div><div class="ball_43">43</div>';
        $sx_06  = '<div class="ball_06">06</div><div class="ball_18">18</div><div class="ball_30">30</div><div class="ball_42">42</div>';
        $sx_07  = '<div class="ball_05">05</div><div class="ball_17">17</div><div class="ball_29">29</div><div class="ball_41">41</div>';
        $sx_08  = '<div class="ball_04">04</div><div class="ball_16">16</div><div class="ball_28">28</div><div class="ball_40">40</div>';
        $sx_09  = '<div class="ball_03">03</div><div class="ball_15">15</div><div class="ball_27">27</div><div class="ball_39">39</div>';
        $sx_10  = '<div class="ball_02">02</div><div class="ball_14">14</div><div class="ball_26">26</div><div class="ball_38">38</div>';
        $sx_11  = '<div class="ball_01">01</div><div class="ball_13">13</div><div class="ball_25">25</div><div class="ball_37">37</div><div class="ball_49">49</div>';
        $sx_12  = '<div class="ball_12">12</div><div class="ball_24">24</div><div class="ball_36">36</div><div class="ball_48">48</div>';
        $sx_01a = '11,23,35,47';
        $sx_02a = '10,22,34,46';
        $sx_03a = '09,21,33,45';
        $sx_04a = '08,20,32,44';
        $sx_05a = '07,19,31,43';
        $sx_06a = '06,18,30,42';
        $sx_07a = '05,17,29,41';
        $sx_08a = '04,16,28,40';
        $sx_09a = '03,15,27,39';
        $sx_10a = '02,14,26,38';
        $sx_11a = '01,13,25,37,49';
        $sx_12a = '12,24,36,48';
        for($i=1;$i<13;$i++){
            $var = 'sx_'.str_pad($i,2,'0',STR_PAD_LEFT);
            $var2 = 'sx_'.str_pad($i,2,'0',STR_PAD_LEFT).'a';
            $this->assign($var,$$var);
            $this->assign($var2,$$var2);
        }
        
        
    }
    public function index(){
      
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	$this->list_s();
    	$this->assign('user',$user); 
        return $this->fetch();
    }
        
    public function six_1(){
        $this->list_s();
        return $this->fetch('six_1');
    }
    
    public function six_1_6(){
        return $this->fetch('six_1_6');
    }
    
    public function six_2(){
        return $this->fetch('six_2');
    }
    
    public function six_3(){
        $this->list_s();
        return $this->fetch('six_3');
    }
    
    public function six_4(){
        return $this->fetch('six_4');
    }
    
    public function six_5(){
        return $this->fetch('six_5');
    }
    
    public function six_6(){
        return $this->fetch('six_6');
    }
    
    public function six_7_1(){
        return $this->fetch('six_7_1');
    }
    
    public function six_7_2(){
        return $this->fetch('six_7_2');
    }
    
    public function six_8_1(){
        return $this->fetch('six_8_1');
    }
    
    public function six_8_2(){
        return $this->fetch('six_8_2');
    }
    
    public function six_9(){
        return $this->fetch('six_9');
    }
    
    public function six_10(){
        return $this->fetch('six_10');
    }
    
    public function six_11(){
        return $this->fetch('six_11');
    }
    
    public function six_12(){
        return $this->fetch('six_12');
    }
    
    public function six_13(){
        return $this->fetch('six_13');
    }
    
    public function six_14(){
        return $this->fetch('six_14');
    }
    
    public function six_15(){
        return $this->fetch('six_15');
    }
    
    public function auto(){
        $file = APP_PATH .'../common/lottery/auto_class.php';
        if(file_exists($file)){
            include $file;
        }else{
            $this->error('算法文件不存在!');
        }
        $list = db('c_auto_0')->where('ok',1)->order('id desc')->limit(50)->select();
        foreach ($list as $k => $v){
            $list[$k]['dx']		=  Six_DaXiao($v['ball_7']);
            $list[$k]['ds']		= Six_DanShuang($v['ball_7']);
            $list[$k]['hsdx']	= Six_HeShuDaXiao($v['ball_7']);
            $list[$k]['hsds']	= Six_HeShuDanShuang($v['ball_7']);
            $list[$k]['wsdx']	= Six_WeiShuDaXiao($v['ball_7']);
            $list[$k]['ws']		= Six_WeiShu($v['ball_7']);
            $list[$k]['bs']		= Six_Bose($v['ball_7']);
            $list[$k]['sx']		= Get_ShengXiao($v['ball_7']);
            $list[$k]['zhdx'] = Six_ZongHeDaXiao($v['ball_1']+$v['ball_2']+$v['ball_3']+$v['ball_4']+$v['ball_5']+$v['ball_6']+$v['ball_7']);
            $list[$k]['zhds'] = Six_ZongHeDanShuang($v['ball_1']+$v['ball_2']+$v['ball_3']+$v['ball_4']+$v['ball_5']+$v['ball_6']+$v['ball_7']);
            $list[$k]['ball_1'] = str_pad($v['ball_1'], 2,'0',STR_PAD_LEFT);
            $list[$k]['ball_2'] = str_pad($v['ball_2'], 2,'0',STR_PAD_LEFT);
            $list[$k]['ball_3'] = str_pad($v['ball_3'], 2,'0',STR_PAD_LEFT);
            $list[$k]['ball_4'] = str_pad($v['ball_4'], 2,'0',STR_PAD_LEFT);
            $list[$k]['ball_5'] = str_pad($v['ball_5'], 2,'0',STR_PAD_LEFT);
            $list[$k]['ball_6'] = str_pad($v['ball_6'], 2,'0',STR_PAD_LEFT);
            $list[$k]['ball_7'] = str_pad($v['ball_7'], 2,'0',STR_PAD_LEFT);
        }
        $this->assign('list',$list);
        return $this -> fetch('auto');
    }
    
    public function time(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $ctime = date('Y-m-d H:i:s',$lottery_time);
        $qs = Db::table('c_auto_0') -> where('opentime','<=',$ctime)->where('endtime','>=',$ctime) -> order('id asc') -> find();
        if($qs){
            $qishu	= $qs['qishu'];
            $close	= strtotime($qs['endtime'])-$lottery_time;
        }else{
            $qishu	= -1;
            $close	= -1;
        }
        $rs = Db::table('c_auto_0') -> where('ok',1)->order('id desc')->limit(1) -> find();
        $k_qi		= $rs['qishu'];
        $k_hm[]		= str_pad($rs['ball_1'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_2'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_3'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_4'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_5'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_6'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_7'],2,'0',STR_PAD_LEFT);
        $arr = array(   
            'number' => $qishu, 
        	'close' => $close, 
        	'k_number' => $k_qi,
        	'k_hm' => $k_hm,
        );  
        $json_string = json_encode($arr);   
        echo $json_string; 
    }
    
    public function order(){
        
    }
    
    public function list_s(){       
        $file = APP_PATH .'../common/lottery/auto_class.php';
        if(file_exists($file)){
            include $file;
        }else{
            $this->error('算法文件不存在!');
        }
        $uid = Session("uid");
        $rs = Db::table('c_auto_0') -> where('ok','=',1) -> order('qishu desc') -> find();
        $sx1 = Get_ShengXiao($rs['ball_1']);
        $sx2 = Get_ShengXiao($rs['ball_2']);
        $sx3 = Get_ShengXiao($rs['ball_3']);
        $sx4 = Get_ShengXiao($rs['ball_4']);
        $sx5 = Get_ShengXiao($rs['ball_5']);
        $sx6 = Get_ShengXiao($rs['ball_6']);
        $sx7 = Get_ShengXiao($rs['ball_7']);
        $this->assign('sx1',$sx1);
        $this->assign('sx2',$sx2);
        $this->assign('sx3',$sx3);
        $this->assign('sx4',$sx4);
        $this->assign('sx5',$sx5);
        $this->assign('sx6',$sx6);
        $this->assign('sx7',$sx7);
       // return $this -> fetch('list_s');
    }
    
    public function list(){
        //include ("class/auto_class.php");
        $file = APP_PATH .'../common/lottery/auto_class.php';
        if(file_exists($file)){
            include $file;
        }else{
            $this->error('算法文件不存在!');
        }        
        $list = db('c_auto_0')->where('ok',1)->order('id desc')->limit(10)->select();
        $this->assign('list',$list);
        return $this -> fetch('list');
    }
    
}