<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
use think\Config;
use app\logic\kjauto;
use app\logic\jsauto;
use app\logic\Lunar;
use think\Exception;
class Six extends Login{
    
    public function index(){
        date_default_timezone_set('PRC');
        $list = DB::table('c_auto_0')->order('qishu desc')->paginate(20);
        $info = array();
        foreach($list as $k => $rows){
            $hm 		= array();
    		$hm[]		= $rows['ball_1'];
    		$hm[]		= $rows['ball_2'];
    		$hm[]		= $rows['ball_3'];
    		$hm[]		= $rows['ball_4'];
    		$hm[]		= $rows['ball_5'];
    		$hm[]		= $rows['ball_6'];
    		$hm[]		= $rows['ball_7'];
    		$sql_sum = "select sum(money) as bet ,sum(if(js,win,0)) as win from c_bet where type='香港六合彩' and qishu = '{$rows['qishu']}' ";
    		$res = Db::query($sql_sum)[0];
    		$info[$k]['win'] = $res['win'];
    		$info[$k]['bet'] = $res['bet'];
    		$info[$k]['ball_1'] = kjauto::Six_Auto($rows['ball_1'],1);
    		$info[$k]['ball_2'] = kjauto::Six_Auto($rows['ball_2'],1);
    		$info[$k]['ball_3'] = kjauto::Six_Auto($rows['ball_3'],1);
    		$info[$k]['ball_4'] = kjauto::Six_Auto($rows['ball_4'],1);
    		$info[$k]['ball_5'] = kjauto::Six_Auto($rows['ball_5'],1);
    		$info[$k]['ball_6'] = kjauto::Six_Auto($rows['ball_6'],1);
    		$info[$k]['ball_7'] = kjauto::Six_Auto($rows['ball_7'],1);
    		$info[$k]['hm']     = kjauto::Six_Auto($hm,2);
    		$info[$k]['ok']           = $rows['ok'];
        }
        $this->assign('info',$info);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    public function add(){
        return $this->fetch('edit');
    }
    
    public function open(){
        
    }
    
    public function edit($id = 0){
        $six = new \app\model\six();
        $info = $six->get($id);
        $opentime = $info['opentime'] ?? '';
        $endtime = $info['endtime'] ?? '';
        $datetime = $info['datetime'] ?? '';
        $this->assign('opentime',$opentime);
        $this->assign('endtime',$endtime);
        $this->assign('datetime',$datetime);
        $this->assign('rs',$info);
        return $this -> fetch();
    }
    
    public function save(){
        $six = new \app\model\six();
        $data = $this->request->param();
        $id= $data['id'] ?? '';
        if($id){
            $res = $six->allowField(true)->save($data,['id'=>$id]);
        }else{
            $res = $six->allowField(true) -> save($data);
        }
        if($res){
            $this->success('操作成功!',url('six/index'));
        }else{
            $this->error('操作失败!');
        }
    }
    
    public function odds($type = 1){
        $type=='7' ? $se1 = 'int_1' : $se1 = 'int_2';
        $type=='1' ? $se2 = 'int_1' : $se2 = 'int_2';
        $type=='2' ? $se3 = 'int_1' : $se3 = 'int_2';
        $type=='3' ? $se4 = 'int_1' : $se4 = 'int_2';
        $type=='4' ? $se5 = 'int_1' : $se5 = 'int_2';
        $type=='5' ? $se6 = 'int_1' : $se6 = 'int_2';
        $type=='6' ? $se7 = 'int_1' : $se7 = 'int_2';
        $type=='8' ? $se8 = 'int_1' : $se8 = 'int_2';
        $type=='9' ? $se9 = 'int_1' : $se9 = 'int_2';
        $type=='10' ? $se10 = 'int_1' : $se10 = 'int_2';
        $type=='11' ? $se11 = 'int_1' : $se11 = 'int_2';
        $type=='12' ? $se12 = 'int_1' : $se12 = 'int_2';
        $type=='13' ? $se13 = 'int_1' : $se13 = 'int_2';
        $type=='14' ? $se14 = 'int_1' : $se14 = 'int_2';
        $type=='15' ? $se15 = 'int_1' : $se15 = 'int_2';
        $this->assign('se1',$se1);
        $this->assign('se2',$se2);
        $this->assign('se3',$se3);
        $this->assign('se4',$se4);
        $this->assign('se5',$se5);
        $this->assign('se6',$se6);
        $this->assign('se7',$se7);
        $this->assign('se8',$se8);
        $this->assign('se9',$se9);
        $this->assign('se10',$se10);
        $this->assign('se11',$se11);
        $this->assign('se12',$se12);
        $this->assign('se13',$se13);
        $this->assign('se14',$se14);
        $this->assign('se15',$se15);
        $this->assign('type',$type);
        return $this->fetch();
    }
    
    public function order(){
        //设置条件
        $conf = [];
        $param = $this->request->param();
        if(isset($param['username']) && $param['username'] != ''){
            $where['username'] = ['=',$param['username']];
            $this->assign('username',$param['username']);
            $conf['username'] = $param['username'];
        }
        if(isset($param['s_time']) && $param['s_time'] != ''){
            $where['addtime'] = ['>=',$param['s_time'].' 00:00:00'];
            $this->assign('s_time',$param['s_time']);
            $conf['s_time'] = $param['s_time'];
        }
        if(isset($param['e_time']) && $param['e_time'] != ''){
            $where2['addtime'] = ['<=',$param['e_time'].' 23:59:59'];
            $this->assign('e_time',$param['e_time']);
            $conf['e_time'] = $param['e_time'];
        }
        $js = $param['js'] ?? '';
        if($js !== ''){
            $conf['js'] = $js;
            $where2['js'] = ['=',$js];
        }
        $this->assign('js',$js);
        if(isset($param['tf_id']) && $param['tf_id'] != ''){
            $where['id'] = ['=',$param['tf_id']];
            $this->assign('tf_id',$param['tf_id']);
        }
        $where2['type'] = ['=','香港六合彩'];
        $where['money'] = ['>',0];
        $suminfo = Db::table('c_bet')->field('sum(money) as all_money,sum(if(js = 1 ,win,0)) as all_win')->where($where)->where($where2)->select()[0];
        $this->assign('all_money',$suminfo['all_money']);
        $this->assign('all_win',$suminfo['all_win']);
        Config::set('paginate.query',$conf);
        $list = Db::table('c_bet')->where($where)->where($where2)->order('id desc')->paginate(20);
        $this->assign('list',$list);
        $this->assign('current_sum',0);
        $this->assign('current_win',0);
        return $this->fetch();
        //获取所有满足条件的金额
        //获取当前页数的金额
    }
    
    public function orderedit(){
        
    }
    
    public function js($qi = ''){
        if($qi == ''){
            $this->error('期号为空!拒绝结算!');
        }
        //$sql		= "select * from c_auto_0 where qishu=".$qi." order by id desc limit 1";
        $rs = DB::table('c_auto_0')->where('qishu','eq',intval($qi))->order('id desc') ->select();
        if(!$rs){
            $this->error('开奖号码都没有,怎么结算?你是在逗我吗?');
        }
        $rs = $rs[0];
        $lists = Db::table('c_bet')->where('type','eq','香港六合彩')->where('js','eq',0)->where('qishu','eq',$qi)->select();
        foreach($lists as $rows){
            echo $rows['id'],'<br/>';
            if($this->jisuan($rs,$rows)){
                Db::startTrans();
                try{
                    $sql = "update c_bet set js=1 where id='".$rows['id']."' and js=0";
                    $affect = Db::execute($sql);
                    if($affect){
                        $msql = "select money from k_user where uid = '".$rows['uid']."'";
                        $balance = Db::query($msql)[0] ?? 0;
                        $log = [];
                        $log['m_order']   = 'SIXPJ'.$rows['id'];
                        $log['uid']     = $rows['uid'];
                        $log['m_value'] = $rows['win'];
                        $log['q_qian']  = $balance['money'];
                        $log['h_qian']  = $rows['win']+ $balance['money'];
                        $log['status']  = '1';
                        $log['m_make_time'] = date('Y-m-d H:i:s');
                        $log['about'] = '六合彩派奖,订单号:'.$rows['did'].',金额:'.$rows['win'];
                        $log['type'] = '400';
                        Db::table('k_money') -> insert($log);
                        $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
                        $affect2 = Db::execute($msql);
                        if($affect2){
                            Db::commit();
                        }else{
                            echo '噢噢,要撤回咯在第'.__LINE__.'行!';
                            Db::rollback();
                        }
                    }else{
                        echo '噢噢,要撤回咯在第'.__LINE__.'行!';
                        Db::rollback();
                    }
                }catch (\Exception $e){
                    Db::rollback();
                    $this->error('由于系统问题:'.$e->getMessage().'!结算异常终止!');
                }
            }else{
                $msql="update c_bet set win=0,js=1 where id=".$rows['id']."  and js=0";
                Db::query($msql);
            }
        }
        $msql ="update c_auto_0 set ok = 1 where qishu ='$qi'";
        Db::query($msql);
        $this->success('结算完毕!',url('six/index'));
    }
    
    public function dzcs($bid = ''){
        if($bid == ''){
            $this->error('注单id为空,不给你结算!');
        }
        $rows = Db::table('c_bet')->where('id','eq',$bid)->find();
        $qishu = $rows['qishu'];
        Db::startTrans();
        try{
            Db::table('k_money')->where('m_order','eq','SIXPJ'.$bid) -> delete();
            Db::table('k_user')->where('uid','eq',$rows['uid'])->update([
                'money'=>['exp',"money-{$rows['win']}"],
            ]);
            Db::table('c_bet')->where('id','eq',$bid)->update(['win'=>$rows['money'] * $rows['odds'],'js'=>0]);
            Db::commit();
        }catch(Exception $e){
            Db::rollback();
            $this->error('由于系统问题:'.$e->getMessage().',重置注单失败!重算结束!');
        }
        $kjinfo = Db::table('c_auto_0')->where('qishu','eq',$qishu)->find();
        if($this->jisuan($kjinfo,$rows)){
            Db::startTrans();
            try{
                $sql = "update c_bet set js=1 where id='".$rows['id']."' and js=0";
                $affect = Db::execute($sql);
                if($affect){
                    $msql = "select money from k_user where uid = '".$rows['uid']."'";
                    $balance = Db::query($msql)[0] ?? 0;
                    $log = [];
                    $log['m_order']   = 'SIXPJ'.$rows['id'];
                    $log['uid']     = $rows['uid'];
                    $log['m_value'] = $rows['win'];
                    $log['q_qian']  = $balance['money'];
                    $log['h_qian']  = $rows['win']+ $balance['money'];
                    $log['status']  = '1';
                    $log['m_make_time'] = date('Y-m-d H:i:s');
                    $log['about'] = '六合彩派奖,订单号:'.$rows['did'].',金额:'.$rows['win'];
                    $log['type'] = '400';
                    Db::table('k_money') -> insert($log);
                    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
                    $affect2 = Db::execute($msql);
                    if($affect2){
                        Db::commit();
                    }else{
                        echo '噢噢,要撤回咯在第'.__LINE__.'行!';
                        Db::rollback();
                    }
                }else{
                    echo '噢噢,要撤回咯在第'.__LINE__.'行!';
                    Db::rollback();
                }
            }catch (\Exception $e){
                Db::rollback();
                $this->error('由于系统问题:'.$e->getMessage().'!结算异常终止!');
            }
        }else{
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']."  and js=0";
            Db::query($msql);
        }
        $this->success('结算完成!');
    }
    
    public function jsdz($bid){
        if($bid == ''){
            $this->error('注单id为空,不给你结算!');
        }
        $rows = Db::table('c_bet')->where('id','eq',$bid)->find();
        $qishu = $rows['qishu'];
        $kjinfo = Db::table('c_auto_0')->where('qishu','eq',$qishu)->find();
        if(!$kjinfo){
            $this->error('开奖结果为空!不给你结算!');
        }
        if($this->jisuan($kjinfo,$rows)){
            Db::startTrans();
            try{
                $sql = "update c_bet set js=1 where id='".$rows['id']."' and js=0";
                $affect = Db::execute($sql);
                if($affect){
                    $msql = "select money from k_user where uid = '".$rows['uid']."'";
                    $balance = Db::query($msql)[0] ?? 0;
                    $log = [];
                    $log['m_order']   = 'SIXPJ'.$rows['id'];
                    $log['uid']     = $rows['uid'];
                    $log['m_value'] = $rows['win'];
                    $log['q_qian']  = $balance['money'];
                    $log['h_qian']  = $rows['win']+ $balance['money'];
                    $log['status']  = '1';
                    $log['m_make_time'] = date('Y-m-d H:i:s');
                    $log['about'] = '六合彩派奖,订单号:'.$rows['did'].',金额:'.$rows['win'];
                    $log['type'] = '400';
                    Db::table('k_money') -> insert($log);
                    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
                    $affect2 = Db::execute($msql);
                    if($affect2){
                        Db::commit();
                    }else{
                        echo '噢噢,要撤回咯在第'.__LINE__.'行!';
                        Db::rollback();
                    }
                }else{
                    echo '噢噢,要撤回咯在第'.__LINE__.'行!';
                    Db::rollback();
                }
            }catch (\Exception $e){
                Db::rollback();
                $this->error('由于系统问题:'.$e->getMessage().'!结算异常终止!');
            }
        }else{
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']."  and js=0";
            Db::query($msql);
        }
        $this->success('结算完成!');
    }
    
    public function rejs($qi = ''){
        if(!$qi){
            $this->error('期数为空!不给你重算!');
        }
        $list = Db::table('c_bet')->where('type','eq','香港六合彩')->where('js','eq','1')->where('qishu','eq',$qi)->order('addtime asc')->select();
        if(!$list){
            //$this->error('没有注单!不给你结算!');
        }
        Db::startTrans();
        try{
            foreach ($list as $rows){
                $tmp_odds = $rows['odds'];
                $tmp_money = $rows['money'];
                $tmp_win = $rows['win'];
                $tmp_uid = $rows['uid'];
                
                $temp_will_win = $tmp_odds*$tmp_money;
                $tmp_id = $rows['id'];
                $sql2 = "update c_bet set js=0, win='$temp_will_win' where id='$tmp_id'";
                echo $sql2,"<br/>";
                Db::query($sql2);
                $sql2 = "update k_user set money=money-$tmp_win where uid='$tmp_uid'";
                echo $sql2,"<br/>";
                Db::query($sql2);
            }
            Db::commit();
            
            echo '重置完毕!即将重算!';
           // exit();
            $this->redirect(url('six/js','qi='.$qi));
        }catch (Exception $e){
            Db::rollback();
        }
        
        
    }
    
    private function jisuan($rs,$rows){
        //开始结算特码
        if($rows['mingxi_1']=='特码' || $rows['mingxi_1']=='特肖'){
            $dx		= jsauto::Six_DaXiao($rs['ball_7']);
            $ds		= jsauto::Six_DanShuang($rs['ball_7']);
            $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_7']);
            $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_7']);
            $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_7']);
            $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_7']);
            $bs		= jsauto::Six_Bose($rs['ball_7']);
            $sx		= jsauto::Get_ShengXiao($rs['ball_7']);
            if($rs['ball_7']==49){
                if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                    return true;
                    
                }else if($rows['mingxi_2']==$rs['ball_7']|| $rows['mingxi_2'] == $sx){
                    //如果投注内容等于第一球开奖号码，则视为中奖
                    return true;
                }else{
                    //注单未中奖，修改注单内容
                    return false;
                }
            }else if($rows['mingxi_2']==$rs['ball_7'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        
        //开始结算正一
        if($rows['mingxi_1']=='正一'){
            $dx		= jsauto::Six_DaXiao($rs['ball_1']);
            $ds		= jsauto::Six_DanShuang($rs['ball_1']);
            $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_1']);
            $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_1']);
            $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_1']);
            $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_1']);
            $bs		= jsauto::Six_Bose($rs['ball_1']);
            $sx		= jsauto::Get_ShengXiao($rs['ball_1']);
            if($rs['ball_1']==49){
                if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                    return true;
                }else if($rows['mingxi_2']==$rs['ball_1']){
                    //如果投注内容等于第一球开奖号码，则视为中奖
                    return true;
                }else{
                    //注单未中奖，修改注单内容
                    return false;
                    
                }
            }else if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        
        //开始结算正二
        if($rows['mingxi_1']=='正二'){
            $dx		= jsauto::Six_DaXiao($rs['ball_2']);
            $ds		= jsauto::Six_DanShuang($rs['ball_2']);
            $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_2']);
            $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_2']);
            $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_2']);
            $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_2']);
            $bs		= jsauto::Six_Bose($rs['ball_2']);
            $sx		= jsauto::Get_ShengXiao($rs['ball_2']);
            if($rs['ball_2']==49){
                if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                    return true;
                }else if($rows['mingxi_2']==$rs['ball_2']){
                    //如果投注内容等于第一球开奖号码，则视为中奖
                    return true;
                }else{
                    //注单未中奖，修改注单内容
                    return false;
                    
                }
            }else if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        
        //开始结算正三
        if($rows['mingxi_1']=='正三'){
            $dx		= jsauto::Six_DaXiao($rs['ball_3']);
            $ds		= jsauto::Six_DanShuang($rs['ball_3']);
            $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_3']);
            $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_3']);
            $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_3']);
            $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_3']);
            $bs		= jsauto::Six_Bose($rs['ball_3']);
            $sx		= jsauto::Get_ShengXiao($rs['ball_3']);
            if($rs['ball_3']==49){
                if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                    return true;
                }else if($rows['mingxi_2']==$rs['ball_3']){
                    //如果投注内容等于第一球开奖号码，则视为中奖
                    return true;
                }else{
                    //注单未中奖，修改注单内容
                    return false;
                    
                }
            }else if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算正四
        if($rows['mingxi_1']=='正四'){
            $dx		= jsauto::Six_DaXiao($rs['ball_4']);
            $ds		= jsauto::Six_DanShuang($rs['ball_4']);
            $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_4']);
            $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_4']);
            $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_4']);
            $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_4']);
            $bs		= jsauto::Six_Bose($rs['ball_4']);
            $sx		= jsauto::Get_ShengXiao($rs['ball_4']);
            if($rs['ball_4']==49){
                if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                    return true;
                }else if($rows['mingxi_2']==$rs['ball_4']){
                    //如果投注内容等于第一球开奖号码，则视为中奖
                    return true;
                }else{
                    //注单未中奖，修改注单内容
                    return false;
                    
                }
            }else if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算正五
        if($rows['mingxi_1']=='正五'){
            $dx		= jsauto::Six_DaXiao($rs['ball_5']);
            $ds		= jsauto::Six_DanShuang($rs['ball_5']);
            $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_5']);
            $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_5']);
            $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_5']);
            $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_5']);
            $bs		= jsauto::Six_Bose($rs['ball_5']);
            $sx		= jsauto::Get_ShengXiao($rs['ball_5']);
            if($rs['ball_5']==49){
                if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                    return true;
                }else if($rows['mingxi_2']==$rs['ball_5']){
                    //如果投注内容等于第一球开奖号码，则视为中奖
                    return true;
                }else{
                    //注单未中奖，修改注单内容
                    return false;
                    
                }
            }else if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算正六
        if($rows['mingxi_1']=='正六'){
            $dx		= jsauto::Six_DaXiao($rs['ball_6']);
            $ds		= jsauto::Six_DanShuang($rs['ball_6']);
            $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_6']);
            $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_6']);
            $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_6']);
            $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_6']);
            $bs		= jsauto::Six_Bose($rs['ball_6']);
            $sx		= jsauto::Get_ShengXiao($rs['ball_6']);
            if($rs['ball_6']==49){
                if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                    return true;
                    
                }else if($rows['mingxi_2']==$rs['ball_6']){
                    //如果投注内容等于第一球开奖号码，则视为中奖
                    return true;
                }else{
                    //注单未中奖，修改注单内容
                    return false;
                    
                }
            }else if($rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算正码
        if($rows['mingxi_1']=='正码'){
            $sx1		= jsauto::Get_ShengXiao($rs['ball_1']);
            $sx2		= jsauto::Get_ShengXiao($rs['ball_2']);
            $sx3		= jsauto::Get_ShengXiao($rs['ball_3']);
            $sx4		= jsauto::Get_ShengXiao($rs['ball_4']);
            $sx5		= jsauto::Get_ShengXiao($rs['ball_5']);
            $sx6		= jsauto::Get_ShengXiao($rs['ball_6']);
            if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$sx1 || $rows['mingxi_2']==$sx2 || $rows['mingxi_2']==$sx3 || $rows['mingxi_2']==$sx4 || $rows['mingxi_2']==$sx5 || $rows['mingxi_2']==$sx6){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算正码过关
        if($rows['mingxi_1']=='正码过关'){
            $mignxi_2_arr=explode("<hr />",$rows['mingxi_2']);
            $arr_num=count($mignxi_2_arr)-1;
            $win=0;
            for($i=0;$i<$arr_num;$i++){
                $mingxi2_arr=explode("|",$mignxi_2_arr[$i]);
                if(!jsauto::Six_ZhengMaGuoGuang($rs['ball_'.jsauto::Six_ZhengMaToNum($mingxi2_arr[0])],$mingxi2_arr[1])){$win=0;break;}
                else{$win=1;}
            }
            if($win){
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算总和
        if($rows['mingxi_1']=='总和'){
            $zhdx = jsauto::Six_ZongHeDaXiao($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
            $zhds = jsauto::Six_ZongHeDanShuang($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
            if($rows['mingxi_2']==$zhdx || $rows['mingxi_2']==$zhds){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算一肖
        if($rows['mingxi_1']=='一肖'){
            if($rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_1']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_2']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_3']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_4']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_5']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_6']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_7'])){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算尾数
        if($rows['mingxi_1']=='尾数'){
            if($rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_1']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_2']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_3']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_4']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_5']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_6']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_7'])){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算全中
        if($rows['mingxi_1']=='四全中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            foreach($mingxi2_arr as $val){
                if(intval($val)==intval($rs['ball_1'])){$win++;}
                if(intval($val)==intval($rs['ball_2'])){$win++;}
                if(intval($val)==intval($rs['ball_3'])){$win++;}
                if(intval($val)==intval($rs['ball_4'])){$win++;}
                if(intval($val)==intval($rs['ball_5'])){$win++;}
                if(intval($val)==intval($rs['ball_6'])){$win++;}
            }
            if($win>=4){
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='三全中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            foreach($mingxi2_arr as $val){
                if(intval($val)==intval($rs['ball_1'])){$win++;}
                if(intval($val)==intval($rs['ball_2'])){$win++;}
                if(intval($val)==intval($rs['ball_3'])){$win++;}
                if(intval($val)==intval($rs['ball_4'])){$win++;}
                if(intval($val)==intval($rs['ball_5'])){$win++;}
                if(intval($val)==intval($rs['ball_6'])){$win++;}
            }
            if($win>=3){
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='三中二'){
            $zall=105;
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            foreach($mingxi2_arr as $val){
                if(intval($val)==intval($rs['ball_1'])){$win++;}
                if(intval($val)==intval($rs['ball_2'])){$win++;}
                if(intval($val)==intval($rs['ball_3'])){$win++;}
                if(intval($val)==intval($rs['ball_4'])){$win++;}
                if(intval($val)==intval($rs['ball_5'])){$win++;}
                if(intval($val)==intval($rs['ball_6'])){$win++;}
            }
            if($win==2){
                return true;
                
            }elseif($win>2){
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='二全中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            foreach($mingxi2_arr as $val){
                if(intval($val)==intval($rs['ball_1'])){$win++;}
                if(intval($val)==intval($rs['ball_2'])){$win++;}
                if(intval($val)==intval($rs['ball_3'])){$win++;}
                if(intval($val)==intval($rs['ball_4'])){$win++;}
                if(intval($val)==intval($rs['ball_5'])){$win++;}
                if(intval($val)==intval($rs['ball_6'])){$win++;}
            }
            if($win>=2){
                return true;
                
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='二中特'){
            $zall=50;
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=$win2=0;
            foreach($mingxi2_arr as $val){
                if(intval($val)==intval($rs['ball_1'])){$win++;}
                if(intval($val)==intval($rs['ball_2'])){$win++;}
                if(intval($val)==intval($rs['ball_3'])){$win++;}
                if(intval($val)==intval($rs['ball_4'])){$win++;}
                if(intval($val)==intval($rs['ball_5'])){$win++;}
                if(intval($val)==intval($rs['ball_6'])){$win++;}
                if(intval($val)==intval($rs['ball_7'])){$win2++;}
            }
            if($win>=2){
                return true;
                
            }elseif($win2>=1){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='特串'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $win2=0;
            foreach($mingxi2_arr as $val){
                if(intval($val)==intval($rs['ball_7'])){
                    $win++;
                }else{
                    if(intval($val)==intval($rs['ball_1'])){$win2++;}
                    if(intval($val)==intval($rs['ball_2'])){$win2++;}
                    if(intval($val)==intval($rs['ball_3'])){$win2++;}
                    if(intval($val)==intval($rs['ball_4'])){$win2++;}
                    if(intval($val)==intval($rs['ball_5'])){$win2++;}
                    if(intval($val)==intval($rs['ball_6'])){$win2++;}
                }
            }
            if($win>=1 && $win2>=1){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='合肖'){
            if($rs['ball_7']==49){
                return true;
            }else{
                $sx		= jsauto::Get_ShengXiao($rs['ball_7']);
                if(strpos($rows['mingxi_2'],$sx)!==false){
                    return true;
                }else{
                    //注单未中奖，修改注单内容
                    return false;
                }
            }
        }
        //开始结算生肖连
        if($rows['mingxi_1']=='二肖连中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $dis_sx='';
            foreach($mingxi2_arr as $val){
                if($val==jsauto::Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            }
            if($win>=2){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='三肖连中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $dis_sx='';
            foreach($mingxi2_arr as $val){
                if($val==jsauto::Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            }
            //echo "<p>======</p>";
            if($win>=3){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='四肖连中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $dis_sx='';
            foreach($mingxi2_arr as $val){
                if($val==jsauto::Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            }
            if($win>=4){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='五肖连中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $dis_sx='';
            foreach($mingxi2_arr as $val){
                if($val==jsauto::Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            }
            if($win>=5){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        //开始结算尾数连
        if($rows['mingxi_1']=='二尾连中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $dis_sx='';
            foreach($mingxi2_arr as $val){
                if($val==jsauto::Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            }
            if($win>=2){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='三尾连中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $dis_sx='';
            foreach($mingxi2_arr as $val){
                if($val==jsauto::Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            }
            if($win>=3){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='四尾连中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $dis_sx='';
            foreach($mingxi2_arr as $val){
                if($val==jsauto::Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            }
            if($win>=4){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='五尾连中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            $dis_sx='';
            foreach($mingxi2_arr as $val){
                if($val==jsauto::Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
                if($val==jsauto::Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            }
            if($win>=5){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
        if($rows['mingxi_1']=='五不中' || $rows['mingxi_1']=='六不中' || $rows['mingxi_1']=='七不中' || $rows['mingxi_1']=='八不中' || $rows['mingxi_1']=='九不中' || $rows['mingxi_1']=='十不中' || $rows['mingxi_1']=='十一不中' || $rows['mingxi_1']=='十二不中'){
            $mingxi2_arr=explode(",",$rows['mingxi_2']);
            $win=0;
            foreach($mingxi2_arr as $val){
                if(intval($val)==intval($rs['ball_1'])){$win++;break;}
                if(intval($val)==intval($rs['ball_2'])){$win++;break;}
                if(intval($val)==intval($rs['ball_3'])){$win++;break;}
                if(intval($val)==intval($rs['ball_4'])){$win++;break;}
                if(intval($val)==intval($rs['ball_5'])){$win++;break;}
                if(intval($val)==intval($rs['ball_6'])){$win++;break;}
                if(intval($val)==intval($rs['ball_7'])){$win++;break;}
            }
            if($win>0){
                //注单未中奖，修改注单内容
                return false;
                
            }else{
                return true;
            }
        }
    }

    private function qishu_modify(){
        
        $sql = "UPDATE c_bet SET qishu = 2017145 WHERE js = 0 AND `type` = '香港六合彩' AND `addtime` BETWEEN '2017-12-09 21:40:00' AND  '2017-12-12 21:30:00'";

        $ret = Db::execute($sql); 

        echo $ret;       
    }
}