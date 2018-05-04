<?php
namespace app\v2\controller;
use app\v2\Login;
use think\Session;
use think\Db;
use think\Request;
class Lotterybet extends Login{
    private $uid = '';
    private $username = '';
    private $datas = '';
    private $order_id = '';
    private $allmoney = 0;
    private $names = '';
    public function _initialize(){
        parent::_initialize();
        $this->uid = Session("uid");
        $this->username = Session("username");
        if(!$this->uid){
            echo '<script type="text/javascript">parent.layer.msg("<font color=red>请登录后再进行投注!</font>", {icon: 2});</script>';
            exit();
        }
        //清空所有POST数据为空的表单
        $datas = array_filter($_POST);
        //获取清空后的POST键名
        $names = array_keys($datas);
        $allmoney = 0;
        if($this->request->action() != 'six'){
            for ($i = 0; $i < count($datas); $i++){
                $this->allmoney += $datas[''.$names[$i].''];
                // 加入金额判断
                if($datas[''.$names[$i].''] < 0){
                    echo '<script type="text/javascript">parent.layer.msg("<font color=red>投注信息错误!</font>", {icon: 2});</script>';
                    exit();
                }
            }
        }
        
        $this->datas = $datas;
        $this->names = $names;
        unset($datas);
        unset($names);
    }
        
    public function cqssc(){
        $qishu = \app\logic\qishu::cqssc();
        if($qishu==-1){
            echo '<script type="text/javascript">parent.layer.msg("已经封盘，禁止下注！", {icon: 2});</script>';
            exit;
        }
        require APP_PATH.'../common/ballname/cqssc.php';
        $text_con = '';
        $betinfo = array();
        for ($i = 0; $i < count($this->datas); $i++){
            //分割键名，取ball_后的数字，来判断属于第几球
            $qiu	= explode("_",$this->names[$i]);
            $qiuhao = $ball_name['qiu_'.$qiu[1]];
            if( $qiu[1] == 6 ){
                $wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
            }else if( $qiu[1] == 7 ||$qiu[1] == 8 || $qiu[1] == 9 ){
                $wanfa	= $ball_name_s['ball_'.$qiu[2].''];
            }else{
                $wanfa	= $ball_name['ball_'.$qiu[2].''];
            }
            $money	= $this->datas[''.$this->names[$i].''];
            //获取赔率
            $odds = cache('cqsscodds');
            $odds = $odds['ball'][$qiu[1]][$qiu[2]];
            $betinfo[] = array(
                'uid'       => $this->uid,
                'username'  => $this->username,
                'type'      => '重庆时时彩',
                'qishu'     => $qishu,
                'mingxi_1'  => $qiuhao,
                'mingxi_2'  => $wanfa,
                'odds'      => $odds,
                'money'     => $money,
                'win'       => sprintf('%.2f',$money*$odds),
            );
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        //return $this->fetch('result');
        $html = $this->fetch('result');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }        
    }
    
    public function xyft(){
        $qishu = \app\logic\qishu::xyft();
        if($qishu==-1){
            echo '<script type="text/javascript">parent.layer.msg("已经封盘，禁止下注！", {icon: 2});</script>';
            exit;
        }
        require APP_PATH.'../common/ballname/xyft.php';
        $text_con = '';
        $betinfo = array();
        for ($i = 0; $i < count($this->datas); $i++){
            //分割键名，取ball_后的数字，来判断属于第几球
            $qiu	= explode("_",$this->names[$i]);
            $qiuhao = $ball_name['qiu_'.$qiu[1]];
            if( $qiu[1] == 11 ){
                $wanfa	= $ball_name_h['ball_'.$qiu[2].''];
            }else{
                $wanfa	= $ball_name['ball_'.$qiu[2].''];
            }
            
            $money	= $this->datas[''.$this->names[$i].''];
            //获取赔率
            $odds = cache('xyftodds');
            $odds = $odds['ball'][$qiu[1]][$qiu[2]];
            $betinfo[] = array(
                'uid'       => $this->uid,
                'username'  => $this->username,
                'type'      => '幸运飞艇',
                'qishu'     => $qishu,
                'mingxi_1'  => $qiuhao,
                'mingxi_2'  => $wanfa,
                'odds'      => $odds,
                'money'     => $money,
                'win'       => sprintf('%.2f',$money*$odds),
            );
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        //return $this->fetch('result');
        $html = $this->fetch('result');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }          
    }
    
    public function xjssc(){
        $qishu = \app\logic\qishu::xjssc();
        if($qishu==-1){
            echo '<script type="text/javascript">parent.layer.msg("已经封盘，禁止下注！", {icon: 2});</script>';
            exit;
        }
        require APP_PATH.'../common/ballname/xjssc.php';
        $text_con = '';
        $betinfo = array();
        for ($i = 0; $i < count($this->datas); $i++){
            $qiu	= explode("_",$this->names[$i]);
           $qiuhao = $ball_name['qiu_'.$qiu[1]];
            if( $qiu[1] == 6 ){
                $wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
            }else if( $qiu[1] == 7 ||$qiu[1] == 8 || $qiu[1] == 9 ){
                $wanfa	= $ball_name_s['ball_'.$qiu[2].''];

            }else{
                $wanfa	= $ball_name['ball_'.$qiu[2].''];
            }
            $money	= $this->datas[''.$this->names[$i].''];
            //获取赔率
            $odds = cache('xscodds');
            $odds = $odds['ball'][$qiu[1]][$qiu[2]];
            $betinfo[] = array(
                'uid'       => $this->uid,
                'username'  => $this->username,
                'type'      => '新疆时时彩',
                'qishu'     => $qishu,
                'mingxi_1'  => $qiuhao,
                'mingxi_2'  => $wanfa,
                'odds'      => $odds,
                'money'     => $money,
                'win'       => sprintf('%.2f',$money*$odds),
            );
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        //return $this->fetch('result');
        $html = $this->fetch('result');

        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }          
    }
    
    public function cqklsf(){
        $qishu = \app\logic\qishu::cqklsf();
        if($qishu==-1){
            echo '<script type="text/javascript">parent.layer.msg("已经封盘，禁止下注！", {icon: 2});</script>';
            exit;
        }
        require APP_PATH.'../common/ballname/cqklsf.php';
        $text_con = '';
        $betinfo = array();
        for ($i = 0; $i < count($this->datas); $i++){
            //分割键名，取ball_后的数字，来判断属于第几球
            $qiu	= explode("_",$this->names[$i]);
            $qiuhao = $ball_name['qiu_'.$qiu[1]];
            if( $qiu[1] == 9 ){
    			$wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
    		}else{
    			$wanfa	= $ball_name['ball_'.$qiu[2].''];
    		}
            $money	= $this->datas[''.$this->names[$i].''];
            //获取赔率
            $odds = cache('csfodds');
            $odds = $odds['ball'][$qiu[1]][$qiu[2]];
            $betinfo[] = array(
                'uid'       => $this->uid,
                'username'  => $this->username,
                'type'      => '重庆快乐十分',
                'qishu'     => $qishu,
                'mingxi_1'  => $qiuhao,
                'mingxi_2'  => $wanfa,
                'odds'      => $odds,
                'money'     => $money,
                'win'       => sprintf('%.2f',$money*$odds),
            );
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        //return $this->fetch('result');
        $html = $this->fetch('result');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }          
    }
    
    public function gsf(){ 
        $qishu = \app\logic\qishu::gsf();
        if($qishu == -1){
            echo '<script type="text/javascript">parent.layer.msg("已经封盘，禁止下注！", {icon: 2});</script>';
            exit;
        }
        require APP_PATH.'../common/ballname/gdklsf.php';
        $text_con = '';
        $betinfo = array();
        for ($i = 0; $i < count($this->datas); $i++){
            //分割键名，取ball_后的数字，来判断属于第几球
            $qiu	= explode("_",$this->names[$i]);
            $qiuhao = $ball_name['qiu_'.$qiu[1]];
            if( $qiu[1] == 9 ){
    			$wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
    		//}else if( $qiu[1] == 7 ||$qiu[1] == 8 || $qiu[1] == 9 ){
    		//	$wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
    		}else{
    			$wanfa	= $ball_name['ball_'.$qiu[2].''];
    		}
            $money	= $this->datas[''.$this->names[$i].''];
            //获取赔率
            $odds = cache('gsfodds');
            $odds = $odds['ball'][$qiu[1]][$qiu[2]];
            $betinfo[] = array(
                'uid'       => $this->uid,
                'username'  => $this->username,
                'type'      => '广东快乐十分',
                'qishu'     => $qishu,
                'mingxi_1'  => $qiuhao,
                'mingxi_2'  => $wanfa,
                'odds'      => $odds,
                'money'     => $money,
                'win'       => sprintf('%.2f',$money*$odds),
            );
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        //return $this->fetch('result');
        $html = $this->fetch('result');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }         
    }
    
    public function pk10(){
        $qishu = \app\logic\qishu::pk10();
        if($qishu==-1){
            echo '<script type="text/javascript">parent.layer.msg("已经封盘，禁止下注！", {icon: 2});</script>';
            exit;
        }
        require APP_PATH.'../common/ballname/bjpks.php';
        $text_con = '';
        $betinfo = array();
        for ($i = 0; $i < count($this->datas); $i++){
            //分割键名，取ball_后的数字，来判断属于第几球
            $qiu	= explode("_",$this->names[$i]);
            $qiuhao = $ball_name['qiu_'.$qiu[1]];
            if( $qiu[1] == 11 ){
                $wanfa	= $ball_name_h['ball_'.$qiu[2].''];
            }else{
                $wanfa	= $ball_name['ball_'.$qiu[2].''];
            }
            $money	= $this->datas[''.$this->names[$i].''];
            //获取赔率
            $odds = cache('pk10odds');
            $odds = $odds['ball'][$qiu[1]][$qiu[2]];
            $betinfo[] = array(
                'uid'       => $this->uid,
                'username'  => $this->username,
                'type'      => '北京PK拾',
                'qishu'     => $qishu,
                'mingxi_1'  => $qiuhao,
                'mingxi_2'  => $wanfa,
                'odds'      => $odds,
                'money'     => $money,
                'win'       => sprintf('%.2f',$money*$odds),
            );
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);

        //return $this->fetch('result');
        $html = $this->fetch('result');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }         
    }
    
    public function gxsf(){
        $qishu = \app\logic\qishu::gxsf();
        if($qishu==-1){
            echo '<script type="text/javascript">parent.layer.msg("已经封盘，禁止下注！", {icon: 2});</script>';
            exit;
        }
        require APP_PATH.'../common/ballname/gxklsf.php';
        $text_con = '';
        $betinfo = array();
        for ($i = 0; $i < count($this->datas); $i++){
            //分割键名，取ball_后的数字，来判断属于第几球
            $qiu	= explode("_",$this->names[$i]);
            $qiuhao = $ball_name['qiu_'.$qiu[1]];
            if( $qiu[1] == 6 ){
                $wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
            }else if( $qiu[1] == 7 ||$qiu[1] == 8 || $qiu[1] == 9 ){
                $wanfa	= $ball_name_s['ball_'.$qiu[2].''];
            }else{
                $wanfa	= $ball_name['ball_'.$qiu[2].''];
            }
            $money	= $this->datas[''.$this->names[$i].''];
            //获取赔率
            $odds = cache('gxsfodds');
            $odds = $odds['ball'][$qiu[1]][$qiu[2]];
            $betinfo[] = array(
                'uid'       => $this->uid,
                'username'  => $this->username,
                'type'      => '广西快乐十分',
                'qishu'     => $qishu,
                'mingxi_1'  => $qiuhao,
                'mingxi_2'  => $wanfa,
                'odds'      => $odds,
                'money'     => $money,
                'win'       => sprintf('%.2f',$money*$odds),
            );
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        //return $this->fetch('result');
        $html = $this->fetch('result');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }          
    }
    
    public function jsk3(){
        $qishu = \app\logic\qishu::jsk3();
        if($qishu==-1){
            echo '<script type="text/javascript">parent.layer.msg("已经封盘，禁止下注！", {icon: 2});</script>';
            exit;
        }
        require APP_PATH.'../common/ballname/jsks.php';
        $text_con = '';
        $betinfo = array();
        for ($i = 0; $i < count($this->datas); $i++){
            //分割键名，取ball_后的数字，来判断属于第几球
            $qiu	= explode("_",$this->names[$i]);
            $qiuhao = $ball_name['qiu_'.$qiu[1]];
            $wanfa = $ball_name['ball_'.$qiu[1].'_'.$qiu[2]];
            $money	= $this->datas[''.$this->names[$i].''];
            //获取赔率
            $odds = cache('jsk3odds');
            $odds = $odds['ball'][$qiu[1]][$qiu[2]];
            $betinfo[] = array(
                'uid'       => $this->uid,
                'username'  => $this->username,
                'type'      => '江苏快3',
                'qishu'     => $qishu,
                'mingxi_1'  => $qiuhao,
                'mingxi_2'  => $wanfa,
                'odds'      => $odds,
                'money'     => $money,
                'win'       => sprintf('%.2f',$money*$odds),
            );
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        //return $this->fetch('result');
        $html = $this->fetch('result');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }        
    }
    
    public function six(){
        $qishu = \app\logic\qishu::six();
        $class = intval(input('class'));
        require APP_PATH.'../common/check_betball.php';
        require APP_PATH.'../common/ballname/six.php';
        $oddinfo = file_get_contents(APP_PATH.'../public/odds/6hc.txt');
        $oddinfo = json_decode($oddinfo,true);
        $wanfa_zong = '';
        $odds_zong = 0;
        //var_dump($this->request->server());exit;
        switch ($class){
            case 8: //正码过关
                
                if(count($this->datas)<2){
                    echo '<script type="text/javascript">parent.layer.msg("正码过关至少选择 2 项！", 3, 3);</script>';
                    exit;
                }
                
                $money = intval($_POST['money']);
                
                for ($i = 0; $i < count($this->datas)-1; $i++){
                    //分割键名，取ball_后的数字，来判断属于第几球
                    $qiu	= explode("_",$this->datas[$this->names[$i]]);
                    $qiuhao = $ball_name['qiu_'.$qiu[0]];
                    $wanfa	= $ball_name['ball_'.$qiu[1].''];
                    //获取赔率
                    $odds	= $oddinfo['oddslist']['ball'][$qiu[0]][$qiu[1]];//lottery_odds($_GET['type'],'ball_'.$qiu[0],$qiu[1]);
                    $wanfa_zong .= $qiuhao.'|'.$wanfa.'|'.$odds.'<hr />';
                    $odds_zong += $odds;
                    
                }
                $qiuhao = '正码过关';
                $betinfo[] = array(
                    'uid'       => $this->uid,
                    'username'  => $this->username,
                    'type'      => '香港六合彩',
                    'qishu'     => $qishu,
                    'mingxi_1'  => $qiuhao,
                    'mingxi_2'  => $wanfa_zong,
                    'odds'      => $odds_zong,
                    'money'     => $money,
                    'win'       => sprintf('%.2f',$money*$odds_zong),
                );
                break;
            case 11: //连码
                $money = intval($_POST['money']);
                $qiuhao = $ball_name['qiu_'.$class.'_'.$_POST['ball_'.$class.'']];
                $playtype = $_POST['type'];
                switch ($playtype){
                    case 1 ://普通玩法
                        if(!lm_pt()){
                            echo '<script type="text/javascript">parent.layer.msg("投注信息错误！", 3, 3);</script>';
                            exit;
                        }
                        $ball_class = $_POST['ball_'.$class];
                        switch ($ball_class){
                            case 1 ://四全中
                                $odds = $oddinfo['oddslist']['ball']['11'][$_POST['ball_11']];
                                $ws = count($_POST['ball']);
                                if($ws < 4 || $ws > 10){
                                    echo '<script type="text/javascript">parent.layer.msg("只能选择 4 - 10 个号码！", 3, 3);</script>';
                                    exit;
                                }
                                $zz = $ws*($ws-1)*($ws-2)*($ws-3)/24;
                                $allmoney = $zz*$money;
                                $qw = 0;
                                for ( $a = 0 ; $a < $ws - 3 ; $a++ ){
                                    for ( $b = $a + 1 ; $b < $ws - 2 ; $b++ ){
                                        for ( $c= $b + 1 ; $c < $ws - 1 ; $c++ ){
                                            for ( $d = $c + 1 ; $d < $ws ; $d++ ){
                                                $qw++;
                                                $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d];
                                                $betinfo[] = array(
                                                    'uid'       => $this->uid,
                                                    'username'  => $this->username,
                                                    'type'      => '香港六合彩',
                                                    'qishu'     => $qishu,
                                                    'mingxi_1'  => $qiuhao,
                                                    'mingxi_2'  => $wanfa,
                                                    'odds'      => $odds,
                                                    'money'     => $money,
                                                    'win'       => sprintf('%.2f',$money*$odds),
                                                );
                                            }
                                        }
                                    }
                                }
                                break;
                            case 2 ://三全中
                            case 3 ://三全中
                                $odds	= $oddinfo['oddslist']['ball']['11'][$_POST['ball_11']];
                                $ws = count($_POST['ball']);
                                if($ws<3 || $ws>10){
                                    echo '<script type="text/javascript">parent.layer.msg("只能选择 3 - 10 个号码！", 3, 3);</script>';
                                    exit;
                                }
                                $zz = $ws*($ws-1)*($ws-2)/6;
                                $allmoney = $zz*$money;
                                $qw = 0;
                                for ( $a = 0 ; $a < $ws - 2 ; $a++ ){
                                    for ( $b = $a + 1 ; $b < $ws - 1 ; $b++ ){
                                        for ( $c= $b + 1 ; $c < $ws ; $c++ ){
                                            $qw++;
                                            $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c];
                                            $betinfo[] = array(
                                                'uid'       => $this->uid,
                                                'username'  => $this->username,
                                                'type'      => '香港六合彩',
                                                'qishu'     => $qishu,
                                                'mingxi_1'  => $qiuhao,
                                                'mingxi_2'  => $wanfa,
                                                'odds'      => $odds,
                                                'money'     => $money,
                                                'win'       => sprintf('%.2f',$money*$odds),
                                            );
                                        }
                                    }
                                }
                                break;
                            case 4 ://三全中
                            case 5 ://三全中
                            case 6 ://三全中
                                if($_POST['ball_'.$class.'']==4){
                                    $odds = $oddinfo['oddslist']['ball']['11']['5'];
                                }
                                if($_POST['ball_'.$class.'']==5){
                                    $odds = $oddinfo['oddslist']['ball']['11']['6'];
                                }
                                if($_POST['ball_'.$class.'']==6){
                                    $odds = $oddinfo['oddslist']['ball']['11']['8'];
                                }
                                $ws = count($_POST['ball']);
                                if($ws<2 || $ws>10){
                                    echo '<script type="text/javascript">parent.layer.msg("只能选择 2 - 10 个号码！", 3, 3);</script>';
                                    exit;
                                }
                                $zz = $ws*($ws-1)/2;
                                $qw = 0;
                                $allmoney = $zz*$money;
                                for ( $a = 0 ; $a < $ws - 1 ; $a++ ){
                                    for ( $b = $a + 1 ; $b < $ws ; $b++ ){
                                        $qw++;
                                        $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b];
                                        $betinfo[] = array(
                                            'uid'       => $this->uid,
                                            'username'  => $this->username,
                                            'type'      => '香港六合彩',
                                            'qishu'     => $qishu,
                                            'mingxi_1'  => $qiuhao,
                                            'mingxi_2'  => $wanfa,
                                            'odds'      => $odds,
                                            'money'     => $money,
                                            'win'       => sprintf('%.2f',$money*$odds),
                                        );
                                    }
                                }
                                break;
                        }
                        break;
                    case 2 :
                    case 3 ://生肖对碰，尾数对碰
                        if($_POST['type']==2){
                            if(!sxdp()){
                                echo '<script type="text/javascript">parent.layer.msg("投注信息错误！", 3, 3);</script>';
                                exit;
                            }
                            $ws  = count($_POST['ball_sx']);
                            $arr = explode(",",$_POST['ball_sx'][0]);
                            $brr = explode(",",$_POST['ball_sx'][1]);
                        }
                        if($_POST['type']==3){
                            if(!wsdp()){
                                echo '<script type="text/javascript">parent.layer.msg("投注信息错误！", 3, 3);</script>';
                                exit;
                            }
                            $ws  = count($_POST['ball_ws']);
                            $arr = explode(",",$_POST['ball_ws'][0]);
                            $brr = explode(",",$_POST['ball_ws'][1]);
                        }
                        if($ws!=2){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 2 组号码！", 3, 3);</script>';
                            exit;
                        }
                        if($_POST['ball_'.$class.'']==4){
                            $odds = $oddinfo['oddslist']['ball']['11']['5'];
                        }
                        if($_POST['ball_'.$class.'']==5){
                            $odds = $oddinfo['oddslist']['ball']['11']['6'];
                        }
                        if($_POST['ball_'.$class.'']==6){
                            $odds = $oddinfo['oddslist']['ball']['11']['8'];
                        }
                        $zz = count($arr)*count($brr);
                        $allmoney = $zz*$money;
                        $qw = 0;
                        for($i=0;$i<count($arr);$i++){
                            for ($a=0;$a<count($brr);$a++){
                                $qw++;
                                $wanfa =  $arr[$i].','.$brr[$a];
                                $betinfo[] = array(
                                    'uid'       => $this->uid,
                                    'username'  => $this->username,
                                    'type'      => '香港六合彩',
                                    'qishu'     => $qishu,
                                    'mingxi_1'  => $qiuhao,
                                    'mingxi_2'  => $wanfa,
                                    'odds'      => $odds,
                                    'money'     => $money,
                                    'win'       => sprintf('%.2f',$money*$odds),
                                );
                            }
                        }
                        break;
                    case 4 ://串肖尾数
            		    if(!lm_cxws()){
            		        echo '<script type="text/javascript">parent.layer.msg("投注信息错误！", 3, 3);</script>';
            		        exit;
            		    }
            			$arr = explode(",",$_POST['ball_sx']);
            			$brr = explode(",",$_POST['ball_ws']);
            			if(!$_POST['ball_sx'] || !$_POST['ball_ws']){
            				echo '<script type="text/javascript">parent.layer.msg("请正确选择生肖与尾数！", 3, 3);</script>';
            				exit;
            			}
            			$brr = $this->arrdel($arr,$brr);
            			if($_POST['ball_'.$class.'']==1){
            				$odds	= $oddinfo['oddslist']['ball']['11']['1'];
            				$zz 	= (count($brr)*(count($brr)-1)*(count($brr)-2)/6)*count($arr);
            			}
            			if($_POST['ball_'.$class.'']==2){
            				$odds	=  $oddinfo['oddslist']['ball']['11']['2'];
            				$zz 	= (count($brr)*(count($brr)-1)/2)*count($arr);
            			}
            			if($_POST['ball_'.$class.'']==3){
            				$odds	= $oddinfo['oddslist']['ball']['11']['3'];
            				$zz 	= (count($brr)*(count($brr)-1)/2)*count($arr);
            			}
            			if($_POST['ball_'.$class.'']==4){
            				$odds	=  $oddinfo['oddslist']['ball']['11']['5'];
            				$zz 	= count($brr)*count($arr);
            			}
            			if($_POST['ball_'.$class.'']==5){
            				$odds	=  $oddinfo['oddslist']['ball']['11']['6'];
            				$zz 	= count($brr)*count($arr);
            			}
            			if($_POST['ball_'.$class.'']==6){
            				$odds	=  $oddinfo['oddslist']['ball']['11']['8'];
            				$zz 	= count($brr)*count($arr);
            			}
            			$qw = 0;
            			$allmoney = $zz*$money;
            			if($_POST['ball_'.$class.'']==1){//四全中
            				for($i=0;$i<count($arr);$i++){
            					for ($a=0;$a<count($brr)-2;$a++){
            						for ($b=$a+1;$b<count($brr)-1;$b++){
            							for ($c=$b+1;$c<count($brr);$c++){
            								$qw++;
            								$wanfa =  $brr[$a].','.$brr[$b].','.$brr[$c].','.$arr[$i];
            								$betinfo[] = array(
                                                'uid'       => $this->uid,
                                                'username'  => $this->username,
                                                'type'      => '香港六合彩',
                                                'qishu'     => $qishu,
                                                'mingxi_1'  => $qiuhao,
                                                'mingxi_2'  => $wanfa,
                                                'odds'      => $odds,
                                                'money'     => $money,
            								    'win'       => sprintf('%.2f',$money*$odds),
                                            );
            							}
            						}
            					}
            				} 
            			}
            			if($_POST['ball_'.$class.'']==2 || $_POST['ball_'.$class.'']==3){//三全中，三中特
            				for($i=0;$i<count($arr);$i++){
            					for ($a=0;$a<count($brr)-1;$a++){
            						for ($b=$a+1;$b<count($brr);$b++){
            							$qw++;
            							$wanfa =  $brr[$a].','.$brr[$b].','.$arr[$i];
            							$betinfo[] = array(
                                            'uid'       => $this->uid,
                                            'username'  => $this->username,
                                            'type'      => '香港六合彩',
                                            'qishu'     => $qishu,
                                            'mingxi_1'  => $qiuhao,
                                            'mingxi_2'  => $wanfa,
                                            'odds'      => $odds,
                                            'money'     => $money,
            							    'win'       => sprintf('%.2f',$money*$odds),
                                        );
            						}
            					}
            				} 
            			}
            			if($_POST['ball_'.$class.'']==4 || $_POST['ball_'.$class.'']==5 || $_POST['ball_'.$class.'']==6){//二全中，二中特，特串
            				for($i=0;$i<count($arr);$i++){
            					for ($a=0;$a<count($brr);$a++){
            						$qw++;
            						$wanfa =  $brr[$a].','.$arr[$i];
            						$betinfo[] = array(
                                        'uid'       => $this->uid,
                                        'username'  => $this->username,
                                        'type'      => '香港六合彩',
                                        'qishu'     => $qishu,
                                        'mingxi_1'  => $qiuhao,
                                        'mingxi_2'  => $wanfa,
                                        'odds'      => $odds,
                                        'money'     => $money,
            						    'win'       => sprintf('%.2f',$money*$odds),
                                    );
            					}
            				} 
            			}
            			break;
                    case 5 :
                        if(!dm_tm()){
                            echo '<script type="text/javascript">parent.layer.msg("投注信息错误！", 3, 3);</script>';
                            exit;
                        }
                        $arr = $_POST['ball_dm'];
                        $brr = $_POST['ball_tm'];
                        $brr = $this->arrdel($arr,$brr);
                        if(count($arr)<1){
                            echo '<script type="text/javascript">parent.layer.msg("请选择胆码！", 3, 3);</script>';
                            exit;
                        }
                        if(count($brr)<1){
                            echo '<script type="text/javascript">parent.layer.msg("请选择拖码！", 3, 3);</script>';
                            exit;
                        }
                        if($_POST['ball_'.$class.'']==1){
                            $odds	= $oddinfo['oddslist']['ball']['11'][1];
                            if(count($arr)==3){
                                $zz = count($brr);
                            }
                            if(count($arr)==2){
                                $zz = count($brr)*(count($brr)-1)/2;
                            }
                            if(count($arr)==1){
                                $zz = count($brr)*(count($brr)-2)*(count($brr)-1)/6;
                            }
                        }
                        if($_POST['ball_'.$class.'']==2){
                            $odds	= $oddinfo['oddslist']['ball']['11']['2'];
                            if(count($arr)==2){
                                $zz = count($brr);
                            }
                            if(count($arr)==1){
                                $zz = count($brr)*(count($brr)-1)/2;
                            }
                        }
                        if($_POST['ball_'.$class.'']==3){
                            $odds	= $oddinfo['oddslist']['ball']['11']['3'];
                            if(count($arr)==2){
                                $zz = count($brr);
                            }
                            if(count($arr)==1){
                                $zz = count($brr)*(count($brr)-1)/2;
                            }
                        }
                        if($_POST['ball_'.$class.'']==4){
                            $odds	= $oddinfo['oddslist']['ball']['11'][5];
                            $zz 	= count($brr)*count($arr);
                        }
                        if($_POST['ball_'.$class.'']==5){
                            $odds	= $oddinfo['oddslist']['ball']['11'][6];
                            $zz 	= count($brr)*count($arr);
                        }
                        if($_POST['ball_'.$class.'']==6){
                            $odds	= $oddinfo['oddslist']['ball']['11'][8];
                            $zz 	= count($brr)*count($arr);
                        }
                        
                        $allmoney = $zz*$money;
                        $qw = 0;
                        if($_POST['ball_'.$class.'']==1){//四全中
                            if(count($arr)<1 || count($arr)>3){
                                echo '<script type="text/javascript">parent.layer.msg("请选择 1 - 3 个胆码！", 3, 3);</script>';
                                exit;
                            }
                            if(count($arr)==3){
                                for($i=0;$i<count($brr);$i++){
                                    for ($a=0;$a<count($arr)-2;$a++){
                                        for ($b=$a+1;$b<count($arr)-1;$b++){
                                            for ($c=$b+1;$c<count($arr);$c++){
                                                $qw++;
                                                $wanfa =  $brr[$i].','.$arr[$a].','.$arr[$b].','.$arr[$c];
                                                $betinfo[] = array(
                                                    'uid'       => $this->uid,
                                                    'username'  => $this->username,
                                                    'type'      => '香港六合彩',
                                                    'qishu'     => $qishu,
                                                    'mingxi_1'  => $qiuhao,
                                                    'mingxi_2'  => $wanfa,
                                                    'odds'      => $odds,
                                                    'money'     => $money,
                                                    'win'       => sprintf('%.2f',$money*$odds),
                                                );
                                            }
                                        }
                                    }
                                }
                            }
                            if(count($arr)==2){
                                for ($a=0;$a<count($brr)-1;$a++){
                                    for ($b=$a+1;$b<count($brr);$b++){
                                        $qw++;
                                        $wanfa =  $brr[$a].','.$brr[$b].','.$arr[0].','.$arr[1];
                                        $betinfo[] = array(
                                            'uid'       => $this->uid,
                                            'username'  => $this->username,
                                            'type'      => '香港六合彩',
                                            'qishu'     => $qishu,
                                            'mingxi_1'  => $qiuhao,
                                            'mingxi_2'  => $wanfa,
                                            'odds'      => $odds,
                                            'money'     => $money,
                                            'win'       => sprintf('%.2f',$money*$odds),
                                        );
                                    }
                                }
                            }
                            if(count($arr)==1){
                                for ($a=0;$a<count($brr)-2;$a++){
                                    for ($b=$a+1;$b<count($brr)-1;$b++){
                                        for ($c=$b+1;$c<count($brr);$c++){
                                            $qw++;
                                            $wanfa =  $brr[$a].','.$brr[$b].','.$brr[$c].','.$arr[0];
                                            $betinfo[] = array(
                                                'uid'       => $this->uid,
                                                'username'  => $this->username,
                                                'type'      => '香港六合彩',
                                                'qishu'     => $qishu,
                                                'mingxi_1'  => $qiuhao,
                                                'mingxi_2'  => $wanfa,
                                                'odds'      => $odds,
                                                'money'     => $money,
                                                'win'       => sprintf('%.2f',$money*$odds),
                                            );
                                        }
                                    }
                                }
                            }
                        }
                        if($_POST['ball_'.$class.'']==2 || $_POST['ball_'.$class.'']==3){//三全中，三中三
                            if(count($arr)<1 || count($arr)>2){
                                echo '<script type="text/javascript">parent.layer.msg("请选择 1 - 2 个胆码！", 3, 3);</script>';
                                exit;
                            }
                            if(count($arr)==2){
                                for($i=0;$i<count($brr);$i++){
                                    for ($a=0;$a<count($arr)-1;$a++){
                                        for ($b=$a+1;$b<count($arr);$b++){
                                            $qw++;
                                            $wanfa =  $brr[$i].','.$arr[$a].','.$arr[$b];
                                            $betinfo[] = array(
                                                'uid'       => $this->uid,
                                                'username'  => $this->username,
                                                'type'      => '香港六合彩',
                                                'qishu'     => $qishu,
                                                'mingxi_1'  => $qiuhao,
                                                'mingxi_2'  => $wanfa,
                                                'odds'      => $odds,
                                                'money'     => $money,
                                                'win'       => sprintf('%.2f',$money*$odds),
                                            );
                                        }
                                    }
                                }
                            }
                            if(count($arr)==1){
                                for ($a=0;$a<count($brr)-1;$a++){
                                    for ($b=$a+1;$b<count($brr);$b++){
                                        $qw++;
                                        $wanfa =  $brr[$a].','.$brr[$b].','.$arr[0];
                                        $betinfo[] = array(
                                            'uid'       => $this->uid,
                                            'username'  => $this->username,
                                            'type'      => '香港六合彩',
                                            'qishu'     => $qishu,
                                            'mingxi_1'  => $qiuhao,
                                            'mingxi_2'  => $wanfa,
                                            'odds'      => $odds,
                                            'money'     => $money,
                                            'win'       => sprintf('%.2f',$money*$odds),
                                        );
                                    }
                                }
                            }
                        }
                        if($_POST['ball_'.$class.'']==4 || $_POST['ball_'.$class.'']==5 || $_POST['ball_'.$class.'']==6){//二全中，二中特，特串
                            if(count($arr)<1 || count($arr)>3){
                                echo '<script type="text/javascript">parent.layer.msg("请选择 1 - 3 个胆码！", 3, 3);</script>';
                                exit;
                            }
                            for ($a=0;$a<count($arr);$a++){
                                for ($b=0;$b<count($brr);$b++){
                                    $qw++;
                                    $wanfa =  $brr[$b].','.$arr[$a];
                                    $betinfo[] = array(
                                        'uid'       => $this->uid,
                                        'username'  => $this->username,
                                        'type'      => '香港六合彩',
                                        'qishu'     => $qishu,
                                        'mingxi_1'  => $qiuhao,
                                        'mingxi_2'  => $wanfa,
                                        'odds'      => $odds,
                                        'money'     => $money,
                                        'win'       => sprintf('%.2f',$money*$odds),
                                    );
                                }
                            }
                        
                        }
                        break;
                    case 6 :
                        if(!lm_cxws()){
                            echo '<script type="text/javascript">parent.layer.msg("投注信息错误！", 3, 3);</script>';
                            exit;
                        }
                        $arr = explode(",",$_POST['ball_sx']);
                        $brr = explode(",",$_POST['ball_ws']);
                        if(!$_POST['ball_sx'] || !$_POST['ball_ws']){
                            echo '<script type="text/javascript">parent.layer.msg("请正确选择生肖与尾数！", 3, 3);</script>';
                            exit;
                        }
                        $brr = $this->arrdel($arr,$brr);
                        if($_POST['ball_'.$class.'']==1){
                            $odds	= $oddinfo['oddslist']['ball']['11']['1'];
                            $zz 	= (count($brr)*(count($brr)-1)*(count($brr)-2)/6)*count($arr);
                        }
                        if($_POST['ball_'.$class.'']==2){
                            $odds	= $oddinfo['oddslist']['ball']['11']['2'];
                            $zz 	= (count($brr)*(count($brr)-1)/2)*count($arr);
                        }
                        if($_POST['ball_'.$class.'']==3){
                            $odds	= $oddinfo['oddslist']['ball']['11']['3'];
                            $zz 	= (count($brr)*(count($brr)-1)/2)*count($arr);
                        }
                        if($_POST['ball_'.$class.'']==4){
                            $odds	= $oddinfo['oddslist']['ball']['11']['5'];
                            $zz 	= count($brr)*count($arr);
                        }
                        if($_POST['ball_'.$class.'']==5){
                            $odds	= $oddinfo['oddslist']['ball']['11']['6'];
                            $zz 	= count($brr)*count($arr);
                        }
                        if($_POST['ball_'.$class.'']==6){
                            $odds	= $oddinfo['oddslist']['ball']['11']['8'];
                            $zz 	= count($brr)*count($arr);
                        }
                        $allmoney = $zz*$money;
                        $qw = 0;
                        if($_POST['ball_'.$class.'']==1){//四全中
                            for($i=0;$i<count($arr);$i++){
                                for ($a=0;$a<count($brr)-2;$a++){
                                    for ($b=$a+1;$b<count($brr)-1;$b++){
                                        for ($c=$b+1;$c<count($brr);$c++){
                                            $qw++;
                                            $wanfa =  $brr[$a].','.$brr[$b].','.$brr[$c].','.$arr[$i];
                                            $betinfo[] = array(
                                                'uid'       => $this->uid,
                                                'username'  => $this->username,
                                                'type'      => '香港六合彩',
                                                'qishu'     => $qishu,
                                                'mingxi_1'  => $qiuhao,
                                                'mingxi_2'  => $wanfa,
                                                'odds'      => $odds,
                                                'money'     => $money,
                                                'win'       => sprintf('%.2f',$money*$odds),
                                            );
                                        }
                                    }
                                }
                            }
                        }
                        if($_POST['ball_'.$class.'']==2 || $_POST['ball_'.$class.'']==3){//三全中，三中特
                            for($i=0;$i<count($arr);$i++){
                                for ($a=0;$a<count($brr)-1;$a++){
                                    for ($b=$a+1;$b<count($brr);$b++){
                                        $qw++;
                                        $wanfa =  $brr[$a].','.$brr[$b].','.$arr[$i];
                                        $betinfo[] = array(
                                            'uid'       => $this->uid,
                                            'username'  => $this->username,
                                            'type'      => '香港六合彩',
                                            'qishu'     => $qishu,
                                            'mingxi_1'  => $qiuhao,
                                            'mingxi_2'  => $wanfa,
                                            'odds'      => $odds,
                                            'money'     => $money,
                                            'win'       => sprintf('%.2f',$money*$odds),
                                        );
                                    }
                                }
                            }
                        }
                        if($_POST['ball_'.$class.'']==4 || $_POST['ball_'.$class.'']==5 || $_POST['ball_'.$class.'']==6){//二全中，二中特，特串
                            for($i=0;$i<count($arr);$i++){
                                for ($a=0;$a<count($brr);$a++){
                                    $qw++;
                                    $wanfa =  $brr[$a].','.$arr[$i];
                                    $betinfo[] = array(
                                        'uid'       => $this->uid,
                                        'username'  => $this->username,
                                        'type'      => '香港六合彩',
                                        'qishu'     => $qishu,
                                        'mingxi_1'  => $qiuhao,
                                        'mingxi_2'  => $wanfa,
                                        'odds'      => $odds,
                                        'money'     => $money,
                                        'win'       => sprintf('%.2f',$money*$odds),
                                    );
                                }
                            }
                        }
                        break;
                }
                break;
            case 12: //合肖
                if(!hx()){
                    echo '<script type="text/javascript">parent.layer.msg("投注信息错误！", 3, 3);</script>';
                    exit;
                }
                $zs = 64;
                $qiuhao = $ball_name['qiu_'.$class];
                $money = intval($_POST['money']);
                $ws = count($_POST['ball']);
                if($ws<2 || $ws>11){
                    echo '<script type="text/javascript">parent.layer.msg("只能选择 2 - 11 个生肖！", 3, 3);</script>';
                    exit;
                }
                $wanfa = '';
                for( $i=0; $i<$ws-1; $i++){
                    $sx = $_POST['ball'][$i]+$zs;
                    $wanfa .= $ball_name['ball_'.$sx].',';
                }
                $ws1 = $_POST['ball'][$ws-1]+$zs;
                $wanfa .= $ball_name['ball_'.$ws1];
                //获取赔率
                $odds	= $oddinfo['oddslist']['ball']['12'][$ws-1];
                $betinfo[] = array(
                    'uid'       => $this->uid,
                    'username'  => $this->username,
                    'type'      => '香港六合彩',
                    'qishu'     => $qishu,
                    'mingxi_1'  => $qiuhao,
                    'mingxi_2'  => $wanfa,
                    'odds'      => $odds,
                    'money'     => $money,
                    'win'       => sprintf('%.2f',$money*$odds),
                );
                break;
            case 13://生肖连，尾数连
            case 14://生肖连，尾数连
                if($class==13){
                    $zs = 64;
                }
                if($class==14){
                    $zs = 76;
                }
                $qiuhao = $ball_name['qiu_'.$class.'_'.$_POST['ball_'.$class.'']];
                $qw = $zz = 0;//先定义循环注单数量与结算注单数量为0
                $ws = count($_POST['ball']);
                $money = intval($_POST['money']);
                $ball_class = $_POST['ball_'.$class.''];
                switch ($ball_class){
                    case 4 ://五连
                        if($ws<5 || $ws>6){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 5 - 6 个选项！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)/120;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 4 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 3 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 2 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 1 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws ; $e++ ){
                                            $qw++;
                                            $hm = array();
                                            $hm[] = $_POST['ball'][$a];
                                            $hm[] = $_POST['ball'][$b];
                                            $hm[] = $_POST['ball'][$c];
                                            $hm[] = $_POST['ball'][$d];
                                            $hm[] = $_POST['ball'][$e];
                                            $odds = $this->six_odds($class,$_POST['ball_'.$class.''],$hm);
                                            $wanfa =  $ball_name['ball_'.($_POST['ball'][$a]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$b]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$c]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$d]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$e]+$zs).''];
                                            $betinfo[] = array(
                                                'uid'       => $this->uid,
                                                'username'  => $this->username,
                                                'type'      => $ball_name['name'],
                                                'qishu'     => $qishu,
                                                'mingxi_1'  => $qiuhao,
                                                'mingxi_2'  => $wanfa,
                                                'odds'      => $odds,
                                                'money'     => $money,
                                                'win'       => sprintf('%.2f',$money*$odds),
                                            );
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case 3 : 
                        if($ws<4 || $ws>6){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 4 - 6 个选项！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)/24;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 3 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 2 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 1 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws ; $d++ ){
                                        $qw++;
                                        $hm = array();
                                        $hm[] = $_POST['ball'][$a];
                                        $hm[] = $_POST['ball'][$b];
                                        $hm[] = $_POST['ball'][$c];
                                        $hm[] = $_POST['ball'][$d];
                                        $odds = $this->six_odds($class,$_POST['ball_'.$class.''],$hm);
                                        $wanfa =  $ball_name['ball_'.($_POST['ball'][$a]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$b]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$c]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$d]+$zs).''];
                                        $betinfo[] = array(
                                            'uid'       => $this->uid,
                                            'username'  => $this->username,
                                            'type'      => $ball_name['name'],
                                            'qishu'     => $qishu,
                                            'mingxi_1'  => $qiuhao,
                                            'mingxi_2'  => $wanfa,
                                            'odds'      => $odds,
                                            'money'     => $money,
                                            'win'       => sprintf('%.2f',$money*$odds),
                                        );
                                    }
                                }
                            }
                        }
                        break;
                    case 2 :
                        if($ws<3 || $ws>6){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 3 - 6 个选项！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)/6;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 2 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 1 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws ; $c++ ){
                                    $qw++;
                                    $hm = array();
                                    $hm[] = $_POST['ball'][$a];
                                    $hm[] = $_POST['ball'][$b];
                                    $hm[] = $_POST['ball'][$c];
                                    $odds = $this->six_odds($class,$_POST['ball_'.$class.''],$hm);
                                    $wanfa =  $ball_name['ball_'.($_POST['ball'][$a]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$b]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$c]+$zs).''];
                                    $betinfo[] = array(
                                        'uid'       => $this->uid,
                                        'username'  => $this->username,
                                        'type'      => $ball_name['name'],
                                        'qishu'     => $qishu,
                                        'mingxi_1'  => $qiuhao,
                                        'mingxi_2'  => $wanfa,
                                        'odds'      => $odds,
                                        'money'     => $money,
                                        'win'       => sprintf('%.2f',$money*$odds),
                                    );
                                }
                            }
                        }
                        break;
                    case 1 :
                        if($ws<2 || $ws>6){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 2 - 6 个选项！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)/2;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 1 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws  ; $b++ ){
                                $qw++;
                                $hm = array();
                                $hm[] = $_POST['ball'][$a];
                                $hm[] = $_POST['ball'][$b];
                                $odds = $this->six_odds($class,$_POST['ball_'.$class.''],$hm);
                                $wanfa =  $ball_name['ball_'.($_POST['ball'][$a]+$zs).''].','.$ball_name['ball_'.($_POST['ball'][$b]+$zs).''];
                                $betinfo[] = array(
                                    'uid'       => $this->uid,
                                    'username'  => $this->username,
                                    'type'      => $ball_name['name'],
                                    'qishu'     => $qishu,
                                    'mingxi_1'  => $qiuhao,
                                    'mingxi_2'  => $wanfa,
                                    'odds'      => $odds,
                                    'money'     => $money,
                                    'win'       => sprintf('%.2f',$money*$odds),
                                );
                            }
                        }
                        break;
                }
                break;
            case 15:
                if(is_numeric(!$_POST['money'])){
                    echo '<script type="text/javascript">parent.layer.msg("参数错误，请重新下注！", 3, 3);</script>';
                    exit;
                }
                foreach($_POST['ball'] as $val){
                    if(intval($val)<1 || intval($val) > 49){
                        echo '<script type="text/javascript">parent.layer.msg("参数错误，请重新下注！", 3, 3);</script>';
                        exit;
                    }
                }
                $qiuhao = $ball_name['qiu_15_'.$_POST['ball_15']];
                $qw = $zz = 0;//先定义循环注单数量与结算注单数量为0
                $ws = count($_POST['ball']);
                $money = $_POST['money'];
                $odds = $oddinfo['oddslist']['ball']['15'][$_POST['ball_15']];
                $ball_15 = $_POST['ball_15'];
                switch ($ball_15){
                    case 1 ://五不中
                        if($ws<5 || $ws>10){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 5 - 10 个号码！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)/120;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 4 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 3 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 2 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 1 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws ; $e++ ){
                                            $qw++;
                                            $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e];
                                            $betinfo[] = array(
                                                'uid'       => $this->uid,
                                                'username'  => $this->username,
                                                'type'      => $ball_name['name'],
                                                'qishu'     => $qishu,
                                                'mingxi_1'  => $qiuhao,
                                                'mingxi_2'  => $wanfa,
                                                'odds'      => $odds,
                                                'money'     => $money,
                                                'win'       => sprintf('%.2f',$money*$odds),
                                            );
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case 2 ://六不中
                        if($ws<6 || $ws>10){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 6 - 10 个号码！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)/720;
                        $allmoney = $zz*$money;
                        
                        for ( $a = 0 ; $a < $ws - 5 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 4 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 3 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 2 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws - 1 ; $e++ ){
                                            for ( $f = $e + 1 ; $f < $ws ; $f++ ){
                                                $qw++;
                                                $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f];
                                                $betinfo[] = array(
                                                    'uid'       => $this->uid,
                                                    'username'  => $this->username,
                                                    'type'      => $ball_name['name'],
                                                    'qishu'     => $qishu,
                                                    'mingxi_1'  => $qiuhao,
                                                    'mingxi_2'  => $wanfa,
                                                    'odds'      => $odds,
                                                    'money'     => $money,
                                                    'win'       => sprintf('%.2f',$money*$odds),
                                                );
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case 3 ://七不中
                        if($ws<7 || $ws>10){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 7 - 10 个号码！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)/5040;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 6 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 5 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 4 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 3 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws - 2 ; $e++ ){
                                            for ( $f = $e + 1 ; $f < $ws - 1 ; $f++ ){
                                                for ( $g = $f + 1 ; $g < $ws ; $g++ ){
                                                    $qw++;
                                                    $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g];
                                                    $betinfo[] = array(
                                                        'uid'       => $this->uid,
                                                        'username'  => $this->username,
                                                        'type'      => $ball_name['name'],
                                                        'qishu'     => $qishu,
                                                        'mingxi_1'  => $qiuhao,
                                                        'mingxi_2'  => $wanfa,
                                                        'odds'      => $odds,
                                                        'money'     => $money,
                                                        'win'       => sprintf('%.2f',$money*$odds),
                                                    );
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case 4 ://八不中
                        if($ws<8 || $ws>11){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 8 - 11 个号码！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)/40320;
                        $allmoney = $zz*$money;
                        
                        for ( $a = 0 ; $a < $ws - 7 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 6 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 5 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 4 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws - 3 ; $e++ ){
                                            for ( $f = $e + 1 ; $f < $ws - 2 ; $f++ ){
                                                for ( $g = $f + 1 ; $g < $ws - 1 ; $g++ ){
                                                    for ( $h = $g + 1 ; $h < $ws ; $h++ ){
                                                        $qw++;
                                                        $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h];
                                                        $betinfo[] = array(
                                                            'uid'       => $this->uid,
                                                            'username'  => $this->username,
                                                            'type'      => $ball_name['name'],
                                                            'qishu'     => $qishu,
                                                            'mingxi_1'  => $qiuhao,
                                                            'mingxi_2'  => $wanfa,
                                                            'odds'      => $odds,
                                                            'money'     => $money,
                                                            'win'       => sprintf('%.2f',$money*$odds),
                                                        );
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case 5://九不中
                        if($ws<9 || $ws>12){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 9 - 12 个号码！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)*($ws-8)/362880;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 8 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 7 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 6 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 5 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws - 4 ; $e++ ){
                                            for ( $f = $e + 1 ; $f < $ws - 3 ; $f++ ){
                                                for ( $g = $f + 1 ; $g < $ws - 2 ; $g++ ){
                                                    for ( $h = $g + 1 ; $h < $ws  - 1; $h++ ){
                                                        for ( $i = $h + 1 ; $i < $ws ; $i++ ){
                                                            $qw++;
                                                            $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h].','.$_POST['ball'][$i];
                                                            $betinfo[] = array(
                                                                'uid'       => $this->uid,
                                                                'username'  => $this->username,
                                                                'type'      => $ball_name['name'],
                                                                'qishu'     => $qishu,
                                                                'mingxi_1'  => $qiuhao,
                                                                'mingxi_2'  => $wanfa,
                                                                'odds'      => $odds,
                                                                'money'     => $money,
                                                                'win'       => sprintf('%.2f',$money*$odds),
                                                            );
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case 6 ://十不中
                        if($ws<10 || $ws>13){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 10 - 13 个号码！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)*($ws-8)*($ws-9)/3628800;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 9 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 8 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 7 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 6 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws - 5 ; $e++ ){
                                            for ( $f = $e + 1 ; $f < $ws - 4 ; $f++ ){
                                                for ( $g = $f + 1 ; $g < $ws - 3 ; $g++ ){
                                                    for ( $h = $g + 1 ; $h < $ws  - 2; $h++ ){
                                                        for ( $i = $h + 1 ; $i < $ws - 1 ; $i++ ){
                                                            for ( $j = $i + 1 ; $j < $ws ; $j++ ){
                                                                $qw++;
                                                                $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h].','.$_POST['ball'][$i].','.$_POST['ball'][$j];
                                                                $betinfo[] = array(
                                                                    'uid'       => $this->uid,
                                                                    'username'  => $this->username,
                                                                    'type'      => $ball_name['name'],
                                                                    'qishu'     => $qishu,
                                                                    'mingxi_1'  => $qiuhao,
                                                                    'mingxi_2'  => $wanfa,
                                                                    'odds'      => $odds,
                                                                    'money'     => $money,
                                                                    'win'       => sprintf('%.2f',$money*$odds),
                                                                );
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case 7://十一不中
                        if($ws<11 || $ws>13){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 11 - 13 个号码！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)*($ws-8)*($ws-9)*($ws-10)/39916800;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 10 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 9 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 8 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 7 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws - 6 ; $e++ ){
                                            for ( $f = $e + 1 ; $f < $ws - 5 ; $f++ ){
                                                for ( $g = $f + 1 ; $g < $ws - 4 ; $g++ ){
                                                    for ( $h = $g + 1 ; $h < $ws  - 3 ; $h++ ){
                                                        for ( $i = $h + 1 ; $i < $ws - 2 ; $i++ ){
                                                            for ( $j = $i + 1 ; $j < $ws - 1 ; $j++ ){
                                                                for ( $k = $j + 1 ; $k < $ws ; $k++ ){
                                                                    $qw++;
                                                                    $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h].','.$_POST['ball'][$i].','.$_POST['ball'][$j].','.$_POST['ball'][$k];
                                                                    $betinfo[] = array(
                                                                        'uid'       => $this->uid,
                                                                        'username'  => $this->username,
                                                                        'type'      => $ball_name['name'],
                                                                        'qishu'     => $qishu,
                                                                        'mingxi_1'  => $qiuhao,
                                                                        'mingxi_2'  => $wanfa,
                                                                        'odds'      => $odds,
                                                                        'money'     => $money,
                                                                        'win'       => sprintf('%.2f',$money*$odds),
                                                                    );
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    case 8 : //十二不中
                        if($ws<12 || $ws>14){
                            echo '<script type="text/javascript">parent.layer.msg("只能选择 12 - 14 个号码！", 3, 3);</script>';
                            exit;
                        }
                        $zz = $ws*($ws-1)*($ws-2)*($ws-3)*($ws-4)*($ws-5)*($ws-6)*($ws-7)*($ws-8)*($ws-9)*($ws-10)*($ws-11)/479001600;
                        $allmoney = $zz*$money;
                        for ( $a = 0 ; $a < $ws - 11 ; $a++ ){
                            for ( $b = $a + 1 ; $b < $ws - 10 ; $b++ ){
                                for ( $c= $b + 1 ; $c < $ws - 9 ; $c++ ){
                                    for ( $d = $c + 1 ; $d < $ws - 8 ; $d++ ){
                                        for ( $e = $d + 1 ; $e < $ws - 7 ; $e++ ){
                                            for ( $f = $e + 1 ; $f < $ws - 6 ; $f++ ){
                                                for ( $g = $f + 1 ; $g < $ws - 5 ; $g++ ){
                                                    for ( $h = $g + 1 ; $h < $ws  - 4 ; $h++ ){
                                                        for ( $i = $h + 1 ; $i < $ws - 3 ; $i++ ){
                                                            for ( $j = $i + 1 ; $j < $ws - 2 ; $j++ ){
                                                                for ( $k = $j + 1 ; $k < $ws - 1 ; $k++ ){
                                                                    for ( $l = $k + 1 ; $l < $ws ; $l++ ){
                                                                        $qw++;
                                                                        $wanfa =  $_POST['ball'][$a].','.$_POST['ball'][$b].','.$_POST['ball'][$c].','.$_POST['ball'][$d].','.$_POST['ball'][$e].','.$_POST['ball'][$f].','.$_POST['ball'][$g].','.$_POST['ball'][$h].','.$_POST['ball'][$i].','.$_POST['ball'][$j].','.$_POST['ball'][$k].','.$_POST['ball'][$l];
                                                                        $betinfo[] = array(
                                                                            'uid'       => $this->uid,
                                                                            'username'  => $this->username,
                                                                            'type'      => $ball_name['name'],
                                                                            'qishu'     => $qishu,
                                                                            'mingxi_1'  => $qiuhao,
                                                                            'mingxi_2'  => $wanfa,
                                                                            'odds'      => $odds,
                                                                            'money'     => $money,
                                                                            'win'       => sprintf('%.2f',$money*$odds),
                                                                        );
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                }
                break;
            default:
                for ($i = 0; $i < count($this->datas); $i++){
                    //分割键名，取ball_后的数字，来判断属于第几球
                    $qiu	= explode("_",$this->names[$i]);
                    $qiuhao = isset($ball_name['qiu_'.$qiu[1]]) ? $ball_name['qiu_'.$qiu[1]] : '';
                    if( $qiu[1] == 9 ){
                        $wanfa	= $ball_name_zh['ball_'.$qiu[2].''];
                    }else if( $qiu[1] == 10 ){
                        $wanfa	= $ball_name['ball_'.($qiu[2]+64).''];
                        if( $qiu[2] > 12 ){
                            $qiuhao = $ball_name['qiu_'.$qiu[1].'_2'];
                        }else{
                            $qiuhao = $ball_name['qiu_'.$qiu[1].'_1'];
                        }
                    }else{
                        $wanfa	= $ball_name['ball_'.$qiu[2].''];
                    }
                    $money	= $this->datas[''.$this->names[$i].''];
                    //获取赔率
                    $odds	= $oddinfo['oddslist']['ball'][$qiu[1]][$qiu[2]];
                    $betinfo[] = array(
                        'uid'       => $this->uid,
                        'username'  => $this->username,
                        'type'      => $ball_name['name'],
                        'qishu'     => $qishu,
                        'mingxi_1'  => $qiuhao,
                        'mingxi_2'  => $wanfa,
                        'odds'      => $odds,
                        'money'     => $money,
                        'win'       => sprintf('%.2f',$money*$odds),
                    );
                }
                break;
        }
        $return = $this->bet($betinfo);
        if(!$return['status']){
            exit('<script type="text/javascript">parent.layer.msg("'.$return['msg'].'", {icon: 2});</script>');
        }
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        $html = $this->fetch('six');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }      
       
    }
    
    private function bet($data){
        
        Db::startTrans();
        $is_mobile = $this->request->isMobile();
        $ip = $this->request->ip();
        try{
            foreach ($data as $v){
                $v['q_qian'] = Db::table('k_user')->where('uid','=',$this->uid)->column('money')[0];
                if($v['q_qian'] < $v['money']){
                    Db::rollback();
                    return array('status'=>false,'msg' => '金额不足!');
                }
                $v['h_qian'] = $v['q_qian'] - $v['money'];
                Db::table('k_user')->where('uid',$this->uid)->update(['money' =>$v['h_qian']]);
                $v['did'] = $this->getDevice().date('YmdHis').rand(10000,99999);
                $v['addtime'] = date('Y-m-d H:i:s');
                $v['adddate'] = date('Y-m-d');
                $v['tms']     = time();
                $v['device'] =$this->getDevice();
                $v['ip']    = $ip;
                $v['www'] = $this->request->host();
                $signStr = $v['did'].$v['uid'].$v['username'].$v['addtime'];
                $signStr .= $v['type'].$v['qishu'].$v['mingxi_1'].$v['mingxi_2'];
                $signStr .= $v['odds'].sprintf('%.2f',$v['money']).sprintf('%.2f',$v['q_qian']);
                $v['saltCode'] = md5($signStr);
                $v['betDate'] = date('Y-m-d H:i:s');
                $insertid = Db::table('c_bet')->insertGetId($v);
                $log = [];
                $log['m_order']   = 'CBET'.$insertid;
                $log['uid']     = Session('uid');
                $log['m_value'] = $v['money'];
                $log['q_qian']  = $v['q_qian'];
                $log['h_qian']  = $v['h_qian'];
                $log['status']  = '1';
                $log['m_make_time'] = date('Y-m-d H:i:s');
                $log['about'] = $v['type'].'投注,订单号:'.$insertid.',金额:'.$v['money'];
                $log['type'] = '300';
                Db::table('k_money') -> insert($log);
                
            }
            Db::commit();
        }catch (\Exception $e){
            echo $e->getMessage();  
            Db::rollback();
            return array('status'=>false,'msg'=>$e->getMessage());
        }
        return array('status' => true);
    }
    
    private function arrdel ($arr1,$arr2){
    	$cccc='';
    	$arr3=array();
    	foreach($arr1 as $s){
    		foreach($arr2 as $x){
    			if($s==$x){
    				$cccc=$s;
    			}
    		}
    	}
    	foreach($arr2 as $t){
    		if($cccc!=$t){
    			$arr3[]=$t;
    		}
    	}
    	return $arr3;
    }
    
   private function six_odds($class,$type,$number){
        $t = Db::table('c_odds_0')->where('type','ball_'.$class)->find();
        if($class==14){
            $odds = 0;
            switch ($type)
            {
                case 1:
                    $zeng = 0;
                    break;
                case 2:
                    $zeng = 10;
                    break;
                case 3:
                    $zeng = 20;
                    break;
                case 4:
                    $zeng = 30;
                    break;
                default:
                    $zeng = 0;
            }
            for( $i=0; $i<count($number); $i++ ){
                if($t['h'.($number[$i] + $zeng)]>$odds){
                    $odds = $t['h'.($number[$i] + $zeng)];
                }
            }
    
        }
        if($class==13){
            $odds = 10000;
            switch ($type)
            {
                case 1:
                    $zeng = 0;
                    break;
                case 2:
                    $zeng = 12;
                    break;
                case 3:
                    $zeng = 24;
                    break;
                case 4:
                    $zeng = 36;
                    break;
                default:
                    $zeng = 0;
            }
            for( $i=0; $i<count($number); $i++ ){
                if($t['h'.($number[$i] + $zeng)]<$odds){
                    $odds = $t['h'.($number[$i] + $zeng)];
                }
            }
    
        }
        return $odds;
    }
}