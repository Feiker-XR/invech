<?php
namespace app\admin\controller;
use think\Db;
use app\admin\Login;
use app\model\user;
use app\model\money;
use app\model\hk;
use app\model\kbet;
use app\model\betcg;
use app\model\cbet;
use app\model\ag;
class report extends Login{
    
    public function quanju(){
        date_default_timezone_set('PRC');
        $param = $this->request->param();
        $date_s = $param['date_s'] ?? date('Y-m-d');
        $date_e = $param['date_e'] ?? date('Y-m-d');
        $user = new user();
        $user->where('reg_date','>=',$date_s.' 00:00:00');
        $user->where('reg_date','<=',$date_e.' 23:59:59');
        $reg_user = $user->count('uid');

        $money = new money();
        
        //$test = db('k_money')->where('type',11)->limit(10)->select();//->sum('m_value');
        //echo json_encode($test);die;
        //db('k_money')->where('type',3)->update(['type'=>600]);
        //db('k_money')->where('type',11)->update(['type'=>900]);
        //echo $ret; die;

        $money->where('m_make_time','>=',$date_s)->where('m_make_time','<=',$date_e.' 23:59:59')->where('status',1);
        /*旧后台
        $field = [
            'sum(case when type=1 then m_value else 0 end) as ck',
            'sum(case when type=2 then m_value else 0 end) as zs',
            'sum(case when type=3 then m_value else 0 end) as fs',
            'sum(case when type=4 then m_value else 0 end) as qt',
            'sum(case when type=11 then m_value else 0 end) as qk',
            'sum(case when type=12 then m_value else 0 end) as kk',            
        ];
        */

        /*新后台
        $field = [
            'sum(case when type=1 then m_value else 0 end) as ck',
            'sum(case when type=200 then m_value else 0 end) as zs',
            'sum(case when type=600 then m_value else 0 end) as fs',
            'sum(case when type=4 then m_value else 0 end) as qt',
            'sum(case when type=900 then m_value else 0 end) as qk',
            'sum(case when type=12 then m_value else 0 end) as kk',            
        ];     
        */  

        //新旧后台数据
        /* type = 1 的表示赠送
        $field = [
            'sum(case when type=1 or type = 100 then m_value else 0 end) as ck',
            'sum(case when type=2 or type=200 or type=2000 then m_value else 0 end) as zs',
            'sum(case when type=3 or type=600 then m_value else 0 end) as fs',
            'sum(case when type=4 or type=4000 then m_value else 0 end) as qt',
            'sum(case when type=11 or type=255 or type=900 then m_value else 0 end) as qk',
            'sum(case when type=120 then m_value else 0 end) as kk',            
        ];    
        */
        $field = [
            'sum(case when type = 100 then m_value else 0 end) as ck',
            'sum(case when type=1 or type=2 or type=200 or type=2000 then m_value else 0 end) as zs',
            'sum(case when type=3 or type=600 then m_value else 0 end) as fs',
            'sum(case when type=4 or type=4000 then m_value else 0 end) as qt',
            'sum(case when type=11 or type=255 or type=900 then m_value else 0 end) as qk',
            'sum(case when type=120 then m_value else 0 end) as kk',            
        ];    


        $moneyinfo = $money->field($field)->find()->getData();
        //var_dump($moneyinfo);die;
        //array(6) { ["ck"]=> NULL ["zs"]=> NULL ["fs"]=> NULL ["qt"]=> NULL ["qk"]=> NULL ["kk"]=> NULL }


        //$query_ck		=	$mysqli->query($sql_ck);
        //$rs_ck 			=	$query_ck->fetch_array();
        //$sql_hk			=	"select sum(money) as hk from huikuan where adddate>='".$date_s." 00:00:00' and 
        //adddate<='".$date_e." 23:59:59' and status=1";
        //$query_hk		=	$mysqli->query($sql_hk);
        //$rs_hk			=	$query_hk->fetch_array();
        $hk =new hk();
        $hk->where('adddate','>=',$date_s.' 00:00:00')->where('adddate','<=',$date_e.' 23:59:59' )->where('status','eq',1);
        $hkmoney = $hk->sum('money');
        
        $kbet = new kbet();
        $kbet->where('bet_time','>=',$date_s.' 00:00:00') -> where('bet_time','<=',$date_e.' 23:59:59') -> where('status','in',[1,2,4,5]);
        $kbetmoney = $kbet->sum('bet_money');
        
        //"select sum(bet_money) as money,sum(win) as win from k_bet_cg_group where match_coverdate>='".$date_s." 00:00:00' 
        //and match_coverdate<='".$date_e." 23:59:59' and status in(1,2)";
        $kbetcg = new betcg();
        $cginfo = $kbetcg->where('match_coverdate','>=',$date_s.' 00:00:00')->where('match_coverdate','<=',$date_e.' 23:59:59')
        ->where('status','in',[1,2])->field(['sum(bet_money) as money','sum(win) as win'])->find();
        $cbet = new cbet();
        $cbetinfo = $cbet->where('addtime','>=',$date_s.' 00:00:00')->where('addtime','<=',$date_e.' 23:59:59')->where('js','eq',1)
        ->field(['sum(money) as money','sum(win) as win '])->find();

        $hkzsjr = $hk->where('adddate','>=',$date_s.' 00:00:00')->where('adddate','<=',$date_e.' 23:59:59' )->where('status','eq',1)->sum('zsjr');
        
        $this->assign('date_s',$date_s);
        $this->assign('date_e',$date_e);
        $this->assign('reg_user',$reg_user);
        $this->assign('rs_ck',$moneyinfo);
        $this->assign('hkmoney',$hkmoney);
        $this->assign('hkzsjr',$hkzsjr);
        return $this->fetch();
    }
    
    public function money(){
        //读取某个日期范围内所有存款、汇款、取款的会员id，并且存入数组
        //date_default_timezone_set('PRC');
        $param = $this->request->param(); 
        $date_s = $param['date_s'] ?? date('Y-m-d',strtotime('-1 days'));
        $date_e = $param['date_e'] ?? date('Y-m-d',strtotime('-1 days'));
        $kmoney = new money();
        $hk = new hk();
        $uid_p1 = $kmoney->where('m_make_time','>=',$date_s.' 00:00:00')->where('m_make_time','<=',$date_e.' 23:59:59')->where('status','eq','1')->group('uid')->column('uid');
        //var_dump($uid_p1);
        $uid_p2 = $hk->where('adddate','>=',$date_s.' 00:00:00') ->where('adddate','<=',$date_e.' 23:59:59')
        ->where('status','eq',1)->column('uid');
        $uid_all = array_merge($uid_p1,$uid_p2);

        $user = new user();
        if($username=input('username')){
            $userOne = $user->where('username','like',"%".$username."%")->field(['uid','username'])->find();
            if($userOne){
                $uid_all = [$userOne['uid'],];    
            }else{
                $uid_all = []; 
            }            
        }$this->assign('username',$username);
        $names = $user->where('uid','in',$uid_all)->field(['uid','username'])
        //->select();
        ->paginate(20);$this->assign('names',$names);
        $info = [];
        foreach($names as $k=>$v){
            /*
            $sql_m		=	"select sum(case when type=1 and about not like '%管理员结算%' then m_value else 0 end) as ck,sum(case when about like '%管理员结算%' then m_value else 0 end) as zs,sum(case when type=3 then m_value else 0 end) as fs,sum(case when type=4 then m_value else 0 end) as qt,sum(case when type=11 then m_value else 0 end) as qk,sum(case when type=12 then m_value else 0 end) as kk from k_money where m_make_time>='".$date_s." 00:00:00' and m_make_time<='".$date_e." 23:59:59' and uid=".$v['uid']." and status=1";
            $rs_m = Db::query($sql_m)[0];
            */
            $field = [
                'sum(case when type = 100 then m_value else 0 end) as ck',
                'sum(case when type=1 or type=2 or type=200 or type=2000 then m_value else 0 end) as zs',
                'sum(case when type=3 or type=600 then m_value else 0 end) as fs',
                'sum(case when type=4 or type=4000 then m_value else 0 end) as qt',
                'sum(case when type=11 or type=255 or type=900 then m_value else 0 end) as qk',
                'sum(case when type=120 then m_value else 0 end) as kk',            
            ];     

            $rs_m = $kmoney->field($field)
            ->where('uid',$v['uid'])
            ->where('m_make_time','>=',$date_s)
            ->where('m_make_time','<=',$date_e.' 23:59:59')
            ->find()->getData();

            $info[$k]['uid'] = $v['uid'];
            $info[$k]['username'] = $v['username'];
            $info[$k]['rs_m'] = $rs_m;
            $sql_h		=	"select sum(money-zsjr) as hk,sum(zsjr) zs2 from huikuan where adddate>='".$date_s." 00:00:00' and adddate<='".$date_e." 23:59:59' and uid=".$v['uid']." and status=1";
            $rs_h = Db::query($sql_h)[0];
            $info[$k]['rs_h'] = $rs_h;
            $info[$k]['zs'] = $rs_m['zs'] + $rs_h['zs2'];
        }
        $this->assign('info',$info);
        $this->assign('date_s',$date_s);
        $this->assign('date_e',$date_e);
        $this -> assign('ck_z',0);
        $this -> assign('hk_z',0);
        $this -> assign('zs_z',0);
        $this -> assign('fs_z',0);
        $this -> assign('qk_z',0);
        return $this->fetch();
    }
    
    public function sport() {
        $param = $this->request->param();
        $date_s = $param['date_s'] ?? date('Y-m-d',strtotime('-1 days'));
        $date_e = $param['date_e'] ?? date('Y-m-d',strtotime('-1 days'));
        $kbet = new kbet();
        $cg = new betcg();
        
        $uid_bet = $kbet->where('bet_time','>=',$date_s.' 00:00:00')->where('bet_time','<=',$date_e." 23:59:59")->where('status','in',[1,2,4,5])
        ->column('uid');
        $uid_cg = $cg -> where('match_coverdate','>=',$date_s.' 00:00:00')->where('match_coverdate','<=',$date_e.' 23:59:59')
        ->where('status','in',[1,2])->column('uid');
        $uids = array_merge($uid_bet,$uid_cg);

        $arr_uid = array_unique($uids);
        sort($arr_uid);
        $user = new user();
        $userinfos = $user->where('uid','in',$arr_uid)->field(['uid','username'])->select();
        $info = [];
        foreach($userinfos as $k => $v){
            $info[$k]['username'] = $v['username'];
            $sql_ty		=	"select uid,count(bid) as num,sum(bet_money) as money,sum(win) as win from k_bet where bet_time>='".$date_s." 00:00:00' and bet_time<='".$date_e." 23:59:59' and status in(1,2,4,5) and uid=".$v['uid']."";
            $rs_ty = Db::query($sql_ty)[0];
            $info[$k]['rs_ty'] = $rs_ty;
            $sql_cg		=	"select uid,count(gid) as num,sum(bet_money) as money,sum(win) as win from k_bet_cg_group where bet_time>='".$date_s." 00:00:00' and bet_time<='".$date_e." 23:59:59' and status in(1,2) and uid=".$v['uid']."";
            $rs_cg = Db::query($sql_cg)[0];
            $info[$k]['rs_cg'] = $rs_cg;
            if(round($rs_ty['win']-$rs_ty['money'],2) < 0){
                $danshi		=	'<font color="#FF0000">'.round($rs_ty['win']-$rs_ty['money'],2).'</font>';
            }else{
                $danshi		=	round($rs_ty['win']-$rs_ty['money'],2);
            }
            if(round($rs_cg['win']-$rs_cg['money'],2) < 0){
                $chuanguan		=	'<font color="#FF0000">'.round($rs_cg['win']-$rs_cg['money'],2).'</font>';
            }else{
                $chuanguan		=	round($rs_cg['win']-$rs_cg['money'],2);
            }
            if(round(($rs_ty['win']-$rs_ty['money'])+($rs_cg['win']-$rs_cg['money']),2) < 0){
                $win		=	'<font color="#FF0000">'.round(($rs_ty['win']-$rs_ty['money'])+($rs_cg['win']-$rs_cg['money']),2).'</font>';
            }else{
                $win		=	round(($rs_ty['win']-$rs_ty['money'])+($rs_cg['win']-$rs_cg['money']),2);
            }
            $info[$k]['danshi'] = $danshi;
            $info[$k]['chuanguan'] = $chuanguan;
            $info[$k]['win']    = $win;
        }
        $num_z = $num_d = $num_c = $dan = $chuan = $money_z = $dan_sy = $chuan_sy = $win_z = 0;
        $this->assign('info',$info);
        $this->assign('num_z',0);
        $this->assign('num_d',0);
        $this->assign('num_c',0);
        $this->assign('dan',0);
        $this->assign('chuan',0);
        $this->assign('money_z',0);
        $this->assign('dan_sy',0);
        $this->assign('chuan_sy',0);
        $this->assign('win_z',0);
        $this->assign('dan_sy',0);
        $this->assign('date_s',$date_s);
        $this->assign('date_e',$date_e);
        return $this->fetch('sports');
        
    }
    
    public function lottery(){
        $param = $this->request->param();
        $date_s = $param['date_s'] ?? date('Y-m-d',strtotime('-1 days'));
        $date_e = $param['date_e'] ?? date('Y-m-d',strtotime('-1 days'));
        $cbet = new cbet();
        $data =$cbet -> where('addtime','>=',$date_s.' 00:00:00')->where('addtime','<=',$date_e.' 23:59:59')->where('js','eq',1)
        ->field(['username','count(id) as num','sum(money) as money','sum(win) as win'])->group('username')->order('num desc')->select();
        $ndata = array();
        foreach ($data as $k=>$d) {
            if(isset($ndata[$d['username']])){
                $ndata[$d['username']]['num'] += $d['num'];
                $ndata[$d['username']]['money'] += $d['money'];
                $ndata[$d['username']]['win'] += $d['win'];
            }else{
                $ndata[$d['username']] = $d;
            }
            
        }
        
        
        $num_z = $money_z = $win_z = 0;
        $info = [];
        $win_s = 0;
        foreach ($ndata as $k => $rs) {
            $info[$k][] = $rs;
            if(round($rs['win']-$rs['money'],2)<0){
                $info[$k]['win'] = '<font color="#FF0000">'.round($rs['win']-$rs['money'],2).'</font>';
            }else{
                $info[$k]['win'] = round($rs['win']-$rs['money'],2);
            }
            $num_z += $rs['num'];
            $money_z += round($rs['money'],2);
            $win_s += round($rs['win']-$rs['money'],2);
            if($win_s<0){
                $win_z = '<font color="#FF0000">'.$win_s.'</font>';
            }else{
                $win_z = $win_s;
            }
        }
        $this->assign('num_z',$num_z);
        $this->assign('money_z',$money_z);
        $this->assign('win_z',$win_z);
        $this->assign('info',$info);
        $this->assign('date_s',$date_s);
        $this->assign('date_e',$date_e);
        return $this->fetch();
    }
    
    public function newlottery(){
        
    }


    /**
     *  代理报表
     */
    public function agency()
    {
        $param  = $this->request->param();
        $date_s = (isset($param['date_s']) && !empty($param['date_s'])) ? $param['date_s'] : date('Y-m-d'); //默认当天
        $date_e = (isset($param['date_e']) && !empty($param['date_e'])) ? $param['date_e'] :date('Y-m-d');//默认当天

        $agencyData = $this->getAgencyData($date_s,$date_e) ;
        $data = $this->formatAgencyData($agencyData) ; //格式化报表数据
        //统计总计,并填充数据
        $amount =  $this->FullAgencyData($data) ;

        $this->assign('date_s',$date_s) ;
        $this->assign('date_e',$date_e) ;
        $this->assign('data',$data)     ;
        $this->assign('amount',$amount) ;

        return $this->fetch() ;
    }

    /**
     *  得到代理数据
     */
    private  function getAgencyData($date_s,$date_e)
    {
        //统计每个代理的盈利情况
        $sql = "SELECT U.top_uid, U.username,R.platform, R.gametype, sum(R.bet) as bet_amount ,sum(R.payout) as payout_amount, (SUM(R.payout) - SUM(R.bet)) as win
        FROM web_report R 
        LEFT JOIN k_user U  ON R.uid=U.uid 
        WHERE R.date>='{$date_s}' AND R.date<='{$date_e}'
        GROUP  BY U.top_uid,R.platform,R.gametype 
        ORDER BY win DESC  " ;
        $data = Db::query($sql) ;

        return $data ;
    }
    //整理代理数据

    /**
     * @param $data
     * @return array
     */
    private  function  formatAgencyData(&$data)
    {
        $res = [];

        //数据整理
        foreach ($data as $key=>$val) {
            $topUid = (is_null($val['top_uid'])) ? -1 : $val['top_uid'] ;
            unset($val['top_uid']) ;

            //ag 或者 bbin 派奖额就是盈利额 盈利= 派奖-投注
            //所以 ag 和bbin的派奖额需要重新计算,不能直接拿值来用
            // 实际派奖额公式: 实际派奖额 =  原派奖额 +投注金额
           if ($val['platform'] =='ag' || $val['platform'] =='bbin') {
               $val['win']           = $val['payout_amount'] ; //ag 或者 bbin 派奖额就是盈利额 盈利= 派奖-投注
               $val['payout_amount'] = bcadd($val['payout_amount'],$val['bet_amount'],2) ; //所以AG和BBIN的 实际派奖额 = 原派奖额+ 投注金额
           }
           $res[$topUid]['data'][$val['platform']][$val['gametype']] = $val ; //数据按游戏平台和类型归类

            //统计总金额
            $bet    = ( isset($res[$topUid]['total']['bet_amount'])    && !empty($res[$topUid]['total']['bet_amount']))    ? bcadd($res[$topUid]['total']['bet_amount'],$val['bet_amount'],2)       : $val['bet_amount'] ;
            $payout = ( isset($res[$topUid]['total']['payout_amount']) && !empty($res[$topUid]['total']['payout_amount'])) ? bcadd($res[$topUid]['total']['payout_amount'],$val['payout_amount'],2) : $val['payout_amount'] ;
            $win    = ( isset($res[$topUid]['total']['win'])           && !empty($res[$topUid]['total']['win']))           ? bcadd($res[$topUid]['total']['win'],$val['win'],2)                     : $val['win'] ;

            $res[$topUid]['total']['bet_amount']    = $bet ;
            $res[$topUid]['total']['payout_amount'] = $payout ;
            $res[$topUid]['total']['win']           = $win ;
            $res[$topUid]['username'] = $val['username'] ;

        }

        return $res ;
    }
    //计算总计,并填充代理数据
    private  function FullAgencyData(&$data)
    {
        $amount['self']['lottery'] = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['self']['sport']   = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['ag']['dianzi']    = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'];
        $amount['ag']['live']      = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['bbin']['dianzi']  = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['bbin']['live']    = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['bbin']['lottery'] = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['bbin']['sport']   = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['mg']['dianzi']    = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['pt']['dianzi']    = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['og']['live']      = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;
        $amount['total']           = ['bet'=>'0.00','payout'=>'0.00','win'=>'0.00'] ;

        foreach ($data as $key=>$val) {
            $this->calculateAgencyAmount($amount,$val); //计算总计
            //判断自有平台
            //彩票
            if  ( !isset($val['data']['self']['lottery'])) {
                $data[$key]['data']['self']['lottery']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //体育
            if  ( !isset($val['data']['self']['sport'])) {
                $data[$key]['data']['self']['sport']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //判断AG
            //电子
            if  ( !isset($val['data']['ag']['dianzi'])) {
                $data[$key]['data']['ag']['dianzi']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //视讯
            if  ( !isset($val['data']['ag']['live'])) {
                $data[$key]['data']['ag']['live']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //判断BBIN
            //电子
            if  ( !isset($val['data']['bbin']['dianzi'])) {
                $data[$key]['data']['bbin']['dianzi']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //视讯
            if  ( !isset($val['data']['bbin']['live'])) {
                $data[$key]['data']['bbin']['live']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //彩票
            if  ( !isset($val['data']['bbin']['lottery'])) {
                $data[$key]['data']['bbin']['lottery']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //体育
            if  ( !isset($val['data']['bbin']['sport'])) {
                $data[$key]['data']['bbin']['sport']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //判断MG
            //电子
            if  ( !isset($val['data']['mg']['dianzi'])) {
                $data[$key]['data']['mg']['dianzi']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //判断PT
            //电子
            if  ( !isset($val['data']['pt']['dianzi'])) {
                $data[$key]['data']['pt']['dianzi']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
            //判断OG
            //视讯
            if  ( !isset($val['data']['og']['live'])) {
                $data[$key]['data']['og']['live']  = [
                    'bet_amount'    => '0.00',
                    'payout_amount' => '0.00',
                    'win'           => '0.00',
                ] ;
            }
        }
        return $amount ;
    }
    /**
     *  计算总计
     * @param $amount
     * @param $agencyData
     */
    private  function  calculateAgencyAmount(&$amount,$agencyData)
    {
        //自营处理(彩票)
        if (isset($agencyData['data']['self']['lottery'])) {
            $amount['self']['lottery']['bet']     = bcadd( $amount['self']['lottery']['bet']    , $agencyData['data']['self']['lottery']['bet_amount'] , 2 ) ;
            $amount['self']['lottery']['payout']  = bcadd( $amount['self']['lottery']['payout'] , $agencyData['data']['self']['lottery']['payout_amount'] , 2 ) ;
            $amount['self']['lottery']['win']     = bcadd( $amount['self']['lottery']['win']    , $agencyData['data']['self']['lottery']['win'] , 2 ) ;
        }
        //自营处理(体育)
        if (isset($agencyData['data']['self']['sport'])) {
            $amount['self']['sport']['bet']     = bcadd( $amount['self']['sport']['bet']    , $agencyData['data']['self']['sport']['bet_amount'] , 2 ) ;
            $amount['self']['sport']['payout']  = bcadd( $amount['self']['sport']['payout'] , $agencyData['data']['self']['sport']['payout_amount'] , 2 ) ;
            $amount['self']['sport']['win']     = bcadd( $amount['self']['sport']['win']    , $agencyData['data']['self']['sport']['win'] , 2 ) ;
        }

        //AG(电子)
        if (isset($agencyData['data']['ag']['dianzi'])) {
            $amount['ag']['dianzi']['bet']     = bcadd( $amount['ag']['dianzi']['bet']    , $agencyData['data']['ag']['dianzi']['bet_amount'] , 2 ) ;
            $amount['ag']['dianzi']['payout']  = bcadd( $amount['ag']['dianzi']['payout'] , $agencyData['data']['ag']['dianzi']['payout_amount'] , 2 ) ;
            $amount['ag']['dianzi']['win']     = bcadd( $amount['ag']['dianzi']['win']    , $agencyData['data']['ag']['dianzi']['win'] , 2 ) ;
        }
        //AG(视讯)
        if (isset($agencyData['data']['ag']['live'])) {
            $amount['ag']['live']['bet']     = bcadd( $amount['ag']['live']['bet']    , $agencyData['data']['ag']['live']['bet_amount'] , 2 ) ;
            $amount['ag']['live']['payout']  = bcadd( $amount['ag']['live']['payout'] , $agencyData['data']['ag']['live']['payout_amount'] , 2 ) ;
            $amount['ag']['live']['win']     = bcadd( $amount['ag']['live']['win']    , $agencyData['data']['ag']['live']['win'] , 2 ) ;
        }

        //BBIN(电子)
        if (isset($agencyData['data']['bbin']['dianzi'])) {
            $amount['bbin']['dianzi']['bet']     = bcadd( $amount['bbin']['dianzi']['bet']    , $agencyData['data']['bbin']['dianzi']['bet_amount'] , 2 ) ;
            $amount['bbin']['dianzi']['payout']  = bcadd( $amount['bbin']['dianzi']['payout'] , $agencyData['data']['bbin']['dianzi']['payout_amount'] , 2 ) ;
            $amount['bbin']['dianzi']['win']     = bcadd( $amount['bbin']['dianzi']['win']    , $agencyData['data']['bbin']['dianzi']['win'] , 2 ) ;
        }
        //BBIN(视讯)
        if (isset($agencyData['data']['bbin']['live'])) {
            $amount['bbin']['live']['bet']     = bcadd( $amount['bbin']['live']['bet']    , $agencyData['data']['bbin']['live']['bet_amount'] , 2 ) ;
            $amount['bbin']['live']['payout']  = bcadd( $amount['bbin']['live']['payout'] , $agencyData['data']['bbin']['live']['payout_amount'] , 2 ) ;
            $amount['bbin']['live']['win']     = bcadd( $amount['bbin']['live']['win']    , $agencyData['data']['bbin']['live']['win'] , 2 ) ;
        }
        //BBIN(彩票)
        if (isset($agencyData['data']['bbin']['lottery'])) {
            $amount['bbin']['lottery']['bet']     = bcadd( $amount['bbin']['lottery']['bet']    , $agencyData['data']['bbin']['lottery']['bet_amount'] , 2 ) ;
            $amount['bbin']['lottery']['payout']  = bcadd( $amount['bbin']['lottery']['payout'] , $agencyData['data']['bbin']['lottery']['payout_amount'] , 2 ) ;
            $amount['bbin']['lottery']['win']     = bcadd( $amount['bbin']['lottery']['win']    , $agencyData['data']['bbin']['lottery']['win'] , 2 ) ;
        }
        //BBIN(体育)
        if (isset($agencyData['data']['bbin']['sport'])) {
            $amount['bbin']['sport']['bet']     = bcadd( $amount['bbin']['sport']['bet']    , $agencyData['data']['bbin']['sport']['bet_amount'] , 2 ) ;
            $amount['bbin']['sport']['payout']  = bcadd( $amount['bbin']['sport']['payout'] , $agencyData['data']['bbin']['sport']['payout_amount'] , 2 ) ;
            $amount['bbin']['sport']['win']     = bcadd( $amount['bbin']['sport']['win']    , $agencyData['data']['bbin']['sport']['win'] , 2 ) ;
        }

        //MG(电子)
        if (isset($agencyData['data']['mg']['dianzi'])) {
            $amount['mg']['dianzi']['bet']     = bcadd( $amount['mg']['dianzi']['bet']    , $agencyData['data']['mg']['dianzi']['bet_amount'] , 2 ) ;
            $amount['mg']['dianzi']['payout']  = bcadd( $amount['mg']['dianzi']['payout'] , $agencyData['data']['mg']['dianzi']['payout_amount'] , 2 ) ;
            $amount['mg']['dianzi']['win']     = bcadd( $amount['mg']['dianzi']['win']    , $agencyData['data']['mg']['dianzi']['win'] , 2 ) ;
        }

        //PT(电子)
        if (isset($agencyData['data']['pt']['dianzi'])) {
            $amount['pt']['dianzi']['bet']     = bcadd( $amount['pt']['dianzi']['bet']    , $agencyData['data']['pt']['dianzi']['bet_amount'] , 2 ) ;
            $amount['pt']['dianzi']['payout']  = bcadd( $amount['pt']['dianzi']['payout'] , $agencyData['data']['pt']['dianzi']['payout_amount'] , 2 ) ;
            $amount['pt']['dianzi']['win']     = bcadd( $amount['pt']['dianzi']['win']    , $agencyData['data']['pt']['dianzi']['win'] , 2 ) ;
        }

        //OG(视讯)
        if (isset($agencyData['data']['og']['dianzi'])) {
            $amount['og']['live']['bet']     = bcadd( $amount['og']['live']['bet']    , $agencyData['data']['og']['live']['bet_amount'] , 2 ) ;
            $amount['og']['live']['payout']  = bcadd( $amount['og']['live']['payout'] , $agencyData['data']['og']['live']['payout_amount'] , 2 ) ;
            $amount['og']['live']['win']     = bcadd( $amount['og']['live']['win']    , $agencyData['data']['og']['live']['win'] , 2 ) ;
        }

        //总计
        if (isset($agencyData['total'])) {
            $amount['total']['bet']     = bcadd( $amount['total']['bet']    , $agencyData['total']['bet_amount'] , 2 ) ;
            $amount['total']['payout']  = bcadd( $amount['total']['payout'] , $agencyData['total']['payout_amount'] , 2 ) ;
            $amount['total']['win']     = bcadd( $amount['total']['win']    , $agencyData['total']['win'] , 2 ) ;
        }
    }


    /**
     *  代理下所属用户数据
     */
    public function agency_user()
    {
       $param     = $this->request->param();
       $date_s    = (isset($param['date_s'])&&!empty($param['date_s'])) ? $param['date_s'] : date('Y-m-d'); //默认当天
       $date_e    = (isset($param['date_e'])&&!empty($param['date_e'])) ? $param['date_e'] : date('Y-m-d');//默认当天
       $agency_id = (isset($param['agency_id']) &&  $param['agency_id'] !== '') ? $param['agency_id'] : '' ;

       $data = $this->getAgencyUserData($agency_id,$date_s,$date_e); //代理下面所属用户数据
       $data = $this->formatAgencyUserData($data) ; //格式化代理下面所属用户数据
       $amount = $this->FullAgencyData($data) ; //填充数据便于前台展示

       $this->assign('amount',$amount) ;
       $this->assign('data',$data) ;
       $this->assign('date_s',$date_s) ;
       $this->assign('date_e',$date_e) ;
       return $this->fetch('agency_user');
    }

    //获取代理下用户数据
    private function getAgencyUserData($agency_id='',$date_s='',$date_e='')
    {
        //1.根据top_uid为条件,找到所属的用户
        //2.用户ID关联 web_report表uid,拿到所属用户的所有投注记录
        //3.用户ID分组,然后按平台,类型统计出,用户的盈利情况
        $res =  [] ;
        $sql = " SELECT  R.uid, U.username, R.platform, R.gametype,  SUM(R.bet) as bet_amount, SUM(R.payout) as payout_amount, (SUM(R.payout)-SUM(R.bet)) as win 
              FROM k_user U 
              LEFT JOIN web_report R ON U.uid = R.uid
              WHERE U.top_uid = {$agency_id} AND (R.date>='{$date_s}' AND R.date<='{$date_e}')
              GROUP  BY U.uid,R.platform,R.gametype 
              ORDER BY win DESC " ;
        $data = Db::query($sql) ;
        return $data ;
    }
    //数据整理
    private  function formatAgencyUserData(&$data)
    {
        foreach ($data as $key=>$val) {
            $uid      = $val['uid'] ;
            $username = $val['username'] ;
            unset($val['uid']); unset($val['username']);
            if (!$uid) { continue ;}

            // ag 或者 bbin 派奖额就是盈利额 盈利= 派奖-投注
            // 所以 ag 和bbin的派奖额需要重新计算,不能直接拿值来用
            // 实际派奖额公式: 实际派奖额 =  原派奖额 +投注金额
            if ($val['platform'] =='ag' || $val['platform'] =='bbin') {
                $val['win']           = $val['payout_amount'] ; //ag 或者 bbin 派奖额就是盈利额 盈利= 派奖-投注
                $val['payout_amount'] = bcadd($val['payout_amount'],$val['bet_amount'],2) ; //所以AG和BBIN的 实际派奖额 = 原派奖额+ 投注金额
            }
            $res[$uid]['data'][$val['platform']][$val['gametype']] = $val ; //数据按游戏平台和类型归类

            //统计总金额
            $bet    = (isset($res[$uid]['total']['bet_amount'])    && !empty($res[$uid]['total']['bet_amount']))    ? bcadd($res[$uid]['total']['bet_amount'],$val['bet_amount'],2)       : $val['bet_amount'] ;
            $payout = (isset($res[$uid]['total']['payout_amount']) && !empty($res[$uid]['total']['payout_amount'])) ? bcadd($res[$uid]['total']['payout_amount'],$val['payout_amount'],2) : $val['payout_amount'] ;
            $win    = (isset($res[$uid]['total']['win']) && !empty($res[$uid]['total']['win'])) ? bcadd($res[$uid]['total']['win'],$val['win'],2) : $val['win'] ;

            $res[$uid]['total']['bet_amount']    = $bet ;
            $res[$uid]['total']['payout_amount'] = $payout ;
            $res[$uid]['total']['win']           = $win ;
            $res[$uid]['username'] = $username ;
        }
        return $res ;
    }

    /**
     *  展示指定用户投注记录
     */
    public function user_bet()
    {
        $param     = $this->request->param();
        $date_s    = (isset($param['date_s']) && !empty($param['date_s'])) ? $param['date_s'] : date('Y-m-d'); //默认当天
        $date_e    = (isset($param['date_e']) && !empty($param['date_e'])) ? $param['date_e'] : date('Y-m-d');//默认当天
        $uid       = (isset($param['uid'])    && $param['uid'] !== '')     ? $param['uid'] : '' ;
        $data = $this->getUserBetByUid($uid,$date_s,$date_e)   ; //获取数据
        $amount = $this->formatUserBetData($data) ; //整理数据,并返回总计

        $this->assign('data',$data);
        $this->assign('amount',$amount);
        return $this->fetch('user_bet');
    }

    //整理用户投注数据,并返回总计
    private  function formatUserBetData(&$data)
    {
        $amount['bet']    = 0 ; //总投注额
        $amount['payout'] = 0 ; //总派奖额
        $amount['win']    = 0 ; //总盈利

        foreach ($data as $key =>$val) {
            //计算盈利
            $win = bcsub($val['payout'],$val['bet'],2) ;
            $data[$key]['win'] = $win;
            //统计总盈利
            $amount['bet']    = bcadd($amount['bet'],$val['bet'],2) ;
            $amount['payout'] = bcadd($amount['payout'],$val['payout'],2) ;
            $amount['win']    = bcadd($amount['win'],$win,2) ;

            //平台英文标识转为中文,方便阅读
            if($val['platform'] =='self') {
                $data[$key]['platform'] = '自营' ;
            }
            //游戏类型转换
            if($val['gametype'] =='sport') {
                $data[$key]['gametype'] = '体育' ;
            }
            if($val['gametype'] =='lottery') {
                $data[$key]['gametype'] = '彩票' ;
            }
            if($val['gametype'] =='dianzi') {
                $data[$key]['gametype'] = '电子' ;
            }
            if($val['gametype'] =='live') {
                $data[$key]['gametype'] = '视讯' ;
            }
        }
        return $amount ;
    }
    //根据uid获取所有的投注记录
    private  function getUserBetByUid($uid='',$date_s='',$date_e='')
    {
        $res= [] ;
        if ($uid) {
           $filed = 'R.*,U.username' ;
           $res = db('web_report')
               ->alias('R')
               ->field($filed)
               ->join(['k_user' => 'U'],'R.uid = U.uid','LEFT')
               ->where('R.uid','eq',$uid)
               ->where('R.date','egt',$date_s)
               ->where('R.date','elt',$date_e)
               ->order('R.date DESC')
               ->select() ;
        }
        return $res;
    }

    
    private function data() {
        /*
        $user = db('k_user')->where('username','kis886')->find();
        //$date = date('Y-m-d',strtotime('-1 days'));
        $date = date('Y-m-d');
        $moneys = db('k_money')->where('uid',$user['uid'])->where('m_make_time','>=',$date.' 00:00:00')->where('m_make_time','<=',$date." 23:59:59")
        ->field('type,m_value,q_qian,h_qian,m_make_time')->select();
        echo json_encode($moneys);
        */
        $user = db('k_user')->where('username','ckb131')->find();//ckb131,kis886
        $query = db('k_money')->where('uid',$user['uid']);
        $date = input('date')??null;
        if($date){
            $query->where('m_make_time','>=',$date.' 00:00:00')->where('m_make_time','<=',$date." 23:59:59");
        }
        $moneys = $query->field('type,m_value,q_qian,h_qian,m_make_time,assets,balance')->paginate(20);
        echo json_encode($moneys);
        /*汇款bug
        $rs = Db::table('huikuan_user')->where('id',184743)->find();
        echo json_encode($rs);
        */
    }

    private function zz_info(){
        $user = db('k_user')->where('username','ckb131')->find();
        $query = db('zz_info')->where('uid',$user['uid']);
        $moneys = $query->where('type','in',['12','13','14','111'])->where('status',1)->select();
        echo json_encode($moneys);  
    }

    private function money_type(){
        $ret = db()->query('SELECT DISTINCT `type` FROM k_money');
        echo json_encode($ret);
    }

    private function money_total(){
        $field = [
            'sum(case when type=1 then m_value else 0 end) as ck1',
            'sum(case when type = 100 then m_value else 0 end) as ck100',
            'sum(case when type = 11 then m_value else 0 end) as qk11',
            'sum(case when type = 255 then m_value else 0 end) as qk255',
            'sum(case when type = 900 then m_value else 0 end) as qk900',
        ];     

        $date_s = $date_e = date('y-m-d');

        $ret = db('k_money')->field($field)
        ->where('m_make_time','between',[$date_s,$date_e.' 23:59:59'])
        ->where('m_value','<',0)->where('status',1)
        //->where('m_make_time','<=',$date_e.' 23:59:59')
        ->find();        
        echo json_encode($ret);


       $ret2 = db()->query("SELECT sum(a.m_value) AS tp_sum FROM k_money a LEFT JOIN `k_user` `b` ON `a`.`uid`=`b`.`uid` WHERE `type` IN (11,255,900) AND `a`.`status` = '1' AND `a`.`m_make_time` >= '2018-04-07 00:00:00' AND `a`.`m_make_time` <= '2018-04-07 23:59:59' AND `a`.`m_value` < 0 LIMIT 1");
       echo json_encode($ret2);//[{"tp_sum":-462454}]

       //{"ck1":28175.60000348091,"ck100":36507,"qk11":0,"qk255":0,"qk900":-578274}[{"tp_sum":-466834}]
    }

    private function pay_way(){
        $ret = db('vc_set_config')->select();
        echo json_encode($ret);
    }     

    private function pay_third(){
        $ret = db('vc_thirdpay')->select();        
        echo json_encode($ret);
    }

    private function pay_channel(){
        $ret = db('vc_thirdcode')->where('thirdid','in',[25,26,30,32,33,34])
        ->order('thirdid,setid,set_configid')->select();
        echo json_encode($ret);
    }    

    public function pay_set(){
        $ret = db('vc_set')->select();
        echo json_encode($ret);
    } 

}
