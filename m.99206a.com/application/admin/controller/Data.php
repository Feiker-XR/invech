<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
class data extends Login{
	public function quanju(){
		
		return $this->fetch('quanju');
	}
	public function money(){
		
		return $this->fetch('money');
	}
	public function sports(){
		
		return $this->fetch('sports');
	}
	public function lottery(){
		
		return $this->fetch('lottery');
	}
	public function newlottery(){
		
		return $this->fetch('newlottery');
	}
	public function fanshui(){
/*
	    $where = '';
	    $start_time = input('date_s');
	    $end_time = input('date_e');
	    if($start_time||$end_time){
	        if($start_time&&$end_time){
	            $stime = strtotime($start_time);
	            $etime = strtotime($end_time);
	            if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
	                //$where['addtime'] = ['>=',$stime];
	                $stime = date('Y-m-d',$stime);
	                $where = "--FIELD-- >= $stime";
	            }else{
	                //$where['addtime'] = ['between',[$stime,$etime]];
	                $stime = date('Y-m-d',$stime);
	                $etime = date('Y-m-d',$etime);
	                $where = "--FIELD-- BETWEEN $stime AND  $etime";
	            }
	        }elseif($start_time){
	            $stime = strtotime($start_time);
	            //$where['addtime'] = ['>=',$stime];
	            $stime = date('Y-m-d',$stime);
	            $where = "--FIELD-- >= $stime";
	        }else{
	            $etime = strtotime($end_time);
	            //$where['addtime'] = ['<=',$etime];
	            $etime = date('Y-m-d',$etime);
	            $where = "--FIELD-- <= $etime";
	        }
	    }
	    
	    $uids = collection([]);//collection([]);
	    
	    $k_where = str_replace('--FIELD--', 'bet_time', $where);
	    $k_uids = db('k_bet')->where($k_where)->where('status','in',[1,2,4,5])->order('uid desc')->field('uid')->select();
	    
	    $c_where = str_replace('--FIELD--', 'addtime', $where);
	    $c_uids = db('c_bet')->where($c_where)->where('js',1)->order('uid desc')->field('uid')->select();
	    
	    $ag_uids = collection([]);	    
	    $ag_where = str_replace('--FIELD--', 'betTime', $where);
	    $ag_names = db('ag_gameresult')->where($ag_where)->group('username')->order('id desc')->field('username')->select();
	    foreach ($ag_names as $name){
	        $user = db('k_user')->where('username',$name['username'])->field('uid')->find();
	        if($user && $user['uid']){
	            $ag_uids->unshif($user['uid']);
	        }	        
	    }
	    
	    $t1_uids = collection([]); // table1 mg
	    $t1_where = str_replace('--FIELD--', 'date_time', $where);
	    $t1_names = db('table1')->where($t1_where)->where('flag','mg')->group('username')->order('myid desc')->field('username')->select();
	    foreach ($t1_names as $name){
	        $user = db('k_user')->where('username',$name['username'])->field('uid')->find();
	        if($user && $user['uid']){
	            $t1_uids->unshif($user['uid']);
	        }
	    }
	    	    
	    $bb_uids = collection([]); 
	    $bb_where = str_replace('--FIELD--', 'WagersDate', $where);
	    $bb_names = db('bbin_gameresult')->where($bb_where)->group('username')->order('id desc')->field('username')->select();
	    foreach ($bb_names as $name){
	        $user = db('k_user')->where('username',$name['username'])->field('uid')->find();
	        if($user && $user['uid']){
	            $bb_uids->unshif($user['uid']);
	        }
	    }
	    
	    
	    //$sql = "select playerName from ag_htresult where SceneStartTime >='".$date_s." 00:00:00' and SceneStartTime<='".$date_e." 23:59:59' group by playerName order by id desc";      
        $ht_uids = collection([]);
        $ht_where = str_replace('--FIELD--', 'SceneStartTime', $where);
        $ht_names = db('ag_htresult')->where($ht_where)->group('playerName')->order('id desc')->field('playerName')->select();
        foreach ($ht_names as $name){
            $user = db('k_user')->where('username',$name['playerName'])->field('uid')->find();
            if($user && $user['uid']){
                $ht_uids->unshif($user['uid']);
            }
        }
    
        //$sql = "select UserName from og_live_history where AddTime >='".$date_s." 00:00:00' and AddTime<='".$date_e." 23:59:59' group by playerName order by id desc";
        $ogl_uids = collection([]);
        $ogl_where = str_replace('--FIELD--', 'AddTime', $where);
        $ogl_names = db('og_live_history')->where($ogl_where)->group('UserName')->order('id desc')->field('UserName')->select();
        foreach ($ogl_names as $name){
            $user = db('k_user')->where('username',$name['UserName'])->field('uid')->find();
            if($user && $user['uid']){
                $ogl_uids->unshif($user['uid']);
            }
        }

        //$sql = "select username from sunbet_history_bets where timestamp >='".$date_s." 00:00:00' and timestamp<='".$date_e." 23:59:59' group by username order by id desc";
        $sb_uids = collection([]);
        $sb_where = str_replace('--FIELD--', 'timestamp', $where);
        $sb_names = db('og_live_history')->where($ogl_where)->group('username')->order('id desc')->field('username')->select();
        foreach ($sb_names as $name){
            $user = db('k_user')->where('username',$name['username'])->field('uid')->find();
            if($user && $user['uid']){
                $sb_uids->unshif($user['uid']);
            }
        }
       
	    $a = $uids->merge($k_uids)->merge($c_uids)
	    ->merge($ag_uids)->merge($t1_uids)
	    ->merge($bb_uids)->merge($ht_uids)
	    ->merge($ogl_uids)->merge($sb_uids)
	    ->sort();
dump($a);return;
*/
		return $this->fetch('fanshui');
	}

	public function _initialize()
	{
	    parent::_initialize();
	    config('paginate',[
	        'type'      => 'Pay',
	        'var_page'  => 'page',
	        'list_rows' => 10,
	    ]);
	}
	public function ag(){
        /*
         db('k_user')->join('')->
         $rs_ty  = k_bet.sum(bet_money) where status in(1,2)
         $rs_tyb = k_bet.sum(bet_money) where status in(4,5)
         $rs_cg  = k_bet_cg_group.sum(bet_money) WHERE status in(1,2)
         */
	    
        $where1 = $where2 = ['commissioned'=>0,];
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            //开始时间大于结束时间时,开始时间当作无效参数            
            //$where1['betTime'] = ['>=',$start_time];
            //$where2['SceneStartTime'] = ['>=',$start_time];
            $where1['betTime'] = ['<=',$end_time];
            $where2['SceneStartTime'] = ['<=',$end_time];
        }else{
            $where1['betTime'] = ['between',[$start_time,$end_time.' 23:59:59']];
            $where2['SceneStartTime'] = ['between',[$start_time,$end_time.' 23:59:59']];
        }
        
        //SELECT username,SUM(validBetAmount) AS zr FROM ag_gameresult GROUP BY username
        $subquery1 = db('ag_gameresult')->where($where1)
        ->group('username')->field('username,SUM(validBetAmount) AS zr')
        ->fetchSql(true)->select();
//echo       $subquery1;return;
        //SELECT playerName,SUM(Cost) AS ht FROM ag_htresult GROUP BY playerName
        $subquery2 = db('ag_htresult')->where($where2)
        ->group('playerName')->field('playerName,SUM(Cost) AS ht')
        ->fetchSql(true)->select();

        /*不添加where子句,内连接丢失数据
         SELECT u.uid,u.username,zr,ht FROM k_user u
         LEFT JOIN ( SELECT username,SUM(validBetAmount) AS zr FROM ag_gameresult GROUP BY username ) AS t1 ON u.username = t1.username
         LEFT JOIN ( SELECT playerName,SUM(Cost) AS ht FROM ag_htresult GROUP BY playerName ) AS t2 ON u.username = t2.playerName
        */
        $data = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.username = t1.username','left')
        ->join('('.$subquery2.')'.' AS t2', 'u.username = t2.playerName','left')
        ->fetchSql(true)->field('u.uid,u.username,zr,ht')->select();
        //->field('u.uid,u.gid,u.username,zr,ht')->paginate();
        
        /*效率太低，程序挂掉
        SELECT u.uid,u.username,zr,ht FROM k_user u
        LEFT JOIN ( SELECT username,SUM(validBetAmount) AS zr FROM ag_gameresult GROUP BY username ) AS t1 ON u.username = t1.username
        LEFT JOIN ( SELECT playerName,SUM(Cost) AS ht FROM ag_htresult GROUP BY playerName ) AS t2 ON u.username = t2.playerName
        WHERE u.username IN
        (
            SELECT username FROM ag_gameresult GROUP BY username
            UNION
            SELECT playerName AS username FROM ag_htresult GROUP BY playerName
        )
                
        //实际生成
        //SELECT * FROM `k_user` `u` LEFT JOIN (SELECT `username`,SUM(validBetAmount) AS zr FROM `ag_gameresult` WHERE `betTime` BETWEEN '2017-08-15' AND '2017-08-15 23:59:59' GROUP BY username) AS t1 ON `u`.`username`=`t1`.`username` LEFT JOIN (SELECT `playerName`,SUM(Cost) AS ht FROM `ag_htresult` WHERE `SceneStartTime` BETWEEN '2017-08-15' AND '2017-08-15 23:59:59' GROUP BY playerName) AS t2 ON `u`.`username`=`t2`.`playerName` WHERE `u`.`username` IN ( SELECT `username` FROM `ag_gameresult` WHERE `betTime` BETWEEN '2017-08-15' AND '2017-08-15 23:59:59' GROUP BY username UNION SELECT `playerName` FROM `ag_htresult` WHERE `SceneStartTime` BETWEEN '2017-08-15' AND '2017-08-15 23:59:59' GROUP BY playerName )
        */
        $data = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.username = t1.username')
        ->join('('.$subquery2.')'.' AS t2', 'u.username = t2.playerName')
        ->where('u.username','IN',function($query)use($where1,$where2){                
            $query->table('ag_gameresult')->where($where1)
            ->group('username')->field('username')
            ->union(function($query)use($where2){
                $query->table('ag_htresult')->where($where2)
                ->group('playerName')->field('playerName');
            });
        })
        ->fetchSql(true)->field('u.uid,u.username,zr,ht')->select();
        //->field('u.uid,u.gid,u.username,zr,ht')->paginate();


        /*优化后, 体育的需要做3个结果集的全连接，不好优化
SELECT *
FROM (       
        SELECT u.uid,u.username,zr FROM k_user u
        JOIN ( SELECT username,SUM(validBetAmount) AS zr FROM ag_gameresult GROUP BY username ) AS t1 ON u.username = t1.username
      ) AS j1
LEFT JOIN       
        
        (
        SELECT u.uid,u.username,ht FROM k_user u
        JOIN ( SELECT playerName,SUM(Cost) AS ht FROM ag_htresult GROUP BY playerName ) AS t2 ON u.username = t2.playerName
	) AS j2
	ON j1.uid = j2.uid
	
UNION

SELECT *
FROM (       
        SELECT u.uid,u.username,zr FROM k_user u
        JOIN ( SELECT username,SUM(validBetAmount) AS zr FROM ag_gameresult GROUP BY username ) AS t1 ON u.username = t1.username
      ) AS j1
RIGHT JOIN       
        
        (
        SELECT u.uid,u.username,ht FROM k_user u
        JOIN ( SELECT playerName,SUM(Cost) AS ht FROM ag_htresult GROUP BY playerName ) AS t2 ON u.username = t2.playerName
	) AS j2
	ON j1.uid = j2.uid	        */
        //SELECT username,SUM(validBetAmount) AS zr FROM ag_gameresult GROUP BY username
        /*
        SELECT u.uid,u.username,ht FROM k_user u
        JOIN ( SELECT playerName,SUM(Cost) AS ht FROM ag_htresult GROUP BY playerName ) AS t2 ON u.username = t2.playerName
*/

        $subquery1 = db('ag_gameresult')->where($where1)
        ->group('username')->field('username,SUM(validBetAmount) AS je')
        ->fetchSql(true)->select();

        $subquery2 = db('ag_htresult')->where($where2)
        ->group('playerName')->field('playerName,SUM(Cost) AS je')
        ->fetchSql(true)->select();
        
        $subquery1 = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.username = t1.username')        
        ->fetchSql(true)->field('u.uid,u.username,u.gid,je')->select();

        $subquery2 = db('k_user')->alias('u')
        ->join('('.$subquery2.')'.' AS t2', 'u.username = t2.playerName')
        ->fetchSql(true)->field('u.uid,u.username,u.gid,je')->select();
        
        $union = Db::table('('.$subquery1.')'.' AS j1')
        ->join('('.$subquery2.')'.' AS j2','j1.uid = j2.uid','LEFT')
        ->field('j1.uid as uid1,j1.username as username1,j1.gid as gid1,j1.je as je1')
        ->field('j2.uid as uid2,j2.username as username2,j2.gid as gid2,j2.je as je2')
        ->union(function($query)use($subquery1,$subquery2){
            $query->table('('.$subquery1.')'.' AS j1')
            ->join('('.$subquery2.')'.' AS j2','j1.uid = j2.uid','RIGHT')
            ->field('j1.uid as uid1,j1.username as username1,j1.gid as gid1,j1.je as je1')
            ->field('j2.uid as uid2,j2.username as username2,j2.gid as gid2,j2.je as je2');
        })
        ->fetchSql(true)->select();
        //->fetchSql(true)->paginate();
        //->fetchSql(true)->limit(0,10)->select();
        
        $list = Db::table('('.$union.')'.' AS a')//必须有别名
        //->fetchSql(true)->select();//paginate不能和fetchSql一起使用
        ->paginate();
       
        $data = $list->all();
        
        foreach($data as $key => $row){
            $data[$key]['uid'] = $row["uid1"]??$row["uid2"];
            $data[$key]['gid'] = $row["gid1"]??$row["gid2"];
            $data[$key]['username'] = $row["username1"]??$row["username2"];
            $data[$key]['zr'] = $row["je1"]??0;
            $data[$key]['ht'] = $row["je2"]??0;
        }
        
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['gid']){
                $tz_ag = $row['zr'] + $row['ht'];
                //select * from k_user_fanshui_bili where gid = $gid and tz_ag order by px asc
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['gid'])->where('tz_ag','<=',$tz_ag)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['ag'];
                    $data[$key]['je'] = round($tz_ag*$bl['ag']/100,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;  
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        /*
        $tyfs 		= round(s_num($rs_ty['money']+$rs_tyb['money']/2+$rs_cg['money'])*$tybl/100,2);
        $cpfs 		= round(s_num($rs_cp['money'])*$cpbl/100,2);
        //$zrfs 		= round(s_num($rs_zr['money']+$rs_zr3['money']+$rs_zr5['money']+$rs_zr6['money']-$rs_zr7['money'])*$zrbl/100,2);
        $zrfs 		= round(s_num($rs_zr['money']+$rs_zr3['money']+$rs_zr5['money']+$rs_zr6['money'] +$rs_oglive['money'] +$rs_sbet['money'])*$zrbl/100,2);
        $ydfs 		= round($tyfs + $cpfs + $zrfs,2);
        $fspd 		= k_fsok($arr_uid[$i],$date_s .'~'. $date_e .' 投注返水');
        */
        return $this->fetch();
	}
	
	public function ag_fs(){
	    $uid = input('uid/d');
	    $stime = input('date_s');
	    $etime = input('date_e');
    
	    if(!$uid || !$stime || !$etime){
	        return ['status'=>1,'msg'=>'参数不能为空'];
	    }
	    
	    //用户在ag的投注额;
	    $user = db('k_user')->where('uid',$uid)->find();
	    //echo db('k_user')->getLastSql();return;
	    if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
	
	    $where1 = $where2 = ['commissioned'=>0,'uid'=>$uid];
	    $where1['betTime'] = ['between',[$stime,$etime.' 23:59:59']];
	    $where2['SceneStartTime'] = ['between',[$stime,$etime.' 23:59:59']];

        $sum1 = db('k_user')->alias('u')->where($where1)
	    ->join('ag_gameresult', 'u.username = ag_gameresult.username')
	    ->sum('validBetAmount');
        //->fetchSql(true)->select();
        //dump($sum1);return;        
	    $zr = $sum1??0;
  
	    $sum2 = db('k_user')->alias('u')->where($where2)
	    ->join('ag_htresult h', 'u.username = h.playerName')
	    ->sum('Cost');
	    //->fetchSql(true)->select();
	    //dump($sum2);return; 
	    $ht = $sum2??0;
  
	    $tz_ag = $zr + $ht;

	    $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_ag','<=',$tz_ag)->order('px desc')->find();
        
	    if(!$bl){
	        return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
	    }
        $ag_bl = $bl['ag'];
        $ag_fs = round($tz_ag*$bl['ag']/100,2);
	    
	    Db::startTrans();
	    try{
	        
	        $bet1 = db('k_user')->alias('u')->where($where1)
	        ->join('ag_gameresult ag', 'u.username = ag.username')
	        //->fetchSql(true)->select();
	        ->select();
	        foreach($bet1 as $bet){
	            $commission = round($bet['validBetAmount']*$ag_bl/100,2);
	            $update_data = ['commissioned'=>1,'commission'=>$commission];
	            db('ag_gameresult')->where('id',$bet['id'])->update($update_data);
	        }
	        
	        $bet2 = db('k_user')->alias('u')->where($where2)
	        ->join('ag_htresult h', 'u.username = h.playerName')
	        //->fetchSql(true)->select();
	        ->select();
      
	        foreach($bet2 as $bet){
	            $commission = round($bet['Cost']*$ag_bl/100,2);
	            $update_data = ['commissioned'=>1,'commission'=>$commission];
	            db('ag_htresult')->where('id',$bet['id'])->update($update_data);
	        }
	        
	        db('k_user')->where('uid',$uid)->setInc('money',$ag_fs);
	        
	        $liyou = $stime .'~'. $etime .' ag投注返水';
	        $info = $stime .'~'. $etime .' ag投注返水 '.$ag_fs.'RMB 已经存入您的账户，请注意查收！';
	        
	        $insert_data = ['uid'=>$uid,'m_value'=>$ag_fs,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
	        db('k_money')->insert($insert_data);	        

	        $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
	        db('k_user_msg')->insert($msg);
	        
	        Db::commit();	        
	        return ['status'=>0,'msg'=>'操作成功'];
	    }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
	}
	
	public function ty(){//1:赢,2:输,
        //$rs_ty  = k_bet.sum(bet_money) where status in(1,2)
        //$rs_tyb = k_bet.sum(bet_money) where status in(4,5)
        //$rs_cg  = k_bet_cg_group.sum(bet_money) WHERE status in(1,2) 
        $where = ['commissioned'=>0,'status'=>['IN','1,2']];
        
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            $where['bet_time'] = ['<=',$end_time];
        }else{
            $where['bet_time'] = ['between',[$start_time,$end_time.' 23:59:59']];            
        }
        
        $subquery1 = db('k_bet')->where($where)
        ->group('uid')->field('uid,SUM(bet_money) AS tz')
        ->fetchSql(true)->select();
 
        $list = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.uid = t1.uid')
        ->field('u.uid,u.gid,u.username,tz')
        //->fetchSql(true)->select();
        ->paginate();
        //dump($data);return; 
        
        $data = $list->all();
       
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['gid']){
                $tz = $row['tz'];
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['gid'])->where('tz_ty','<=',$tz)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['ty'];
                    $data[$key]['je'] = round($tz*$bl['ty']/100,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        
        return $this->fetch();
    }
    
    public function ty_fs(){
        $uid = input('uid/d');
        $stime = input('date_s');
        $etime = input('date_e');
        
        if(!$uid || !$stime || !$etime){
            return ['status'=>1,'msg'=>'参数不能为空'];
        }
        
        $user = db('k_user')->where('uid',$uid)->find();
        if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
        
        $where = ['commissioned'=>0,'status'=>['IN','1,2'],'u.uid'=>$uid];
        $where['bet_time'] = ['between',[$stime,$etime.' 23:59:59']];
        
        $sum = db('k_user')->alias('u')->where($where)
        ->join('k_bet b', 'u.uid = b.uid')
        ->sum('bet_money');
        //->fetchSql(true)->select();
        //dump($sum);return;
        $tz_ty = $sum??0;

        $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_ty','<=',$tz_ty)->order('px desc')->find();
        
        if(!$bl){
            return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
        }
        $bl_ty = $bl['ty'];
        $fs_ty = round($tz_ty*$bl_ty/100,2);
        
        Db::startTrans();
        try{
            
            $bets = db('k_user')->alias('u')->where($where)
            ->join('k_bet b', 'u.uid = b.uid')
            //->fetchSql(true)->select();
            ->select();
            foreach($bets as $bet){
                $commission = round($bet['bet_money']*$bl_ty/100,2);
                $update_data = ['commissioned'=>1,'commission'=>$commission];
                db('k_bet')->where('bid',$bet['bid'])->update($update_data);
            }
            
            db('k_user')->where('uid',$uid)->setInc('money',$fs_ty);
            
            $liyou = $stime .'~'. $etime .' 体育(全赢)投注返水';
            $info = $stime .'~'. $etime .' 体育(全赢)投注返水 '.$fs_ty.'RMB 已经存入您的账户，请注意查收！';
            
            $insert_data = ['uid'=>$uid,'m_value'=>$fs_ty,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
            db('k_money')->insert($insert_data);
            
            $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
            db('k_user_msg')->insert($msg);
            
            Db::commit();
            return ['status'=>0,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
    }
    
    public function tyb(){//4:赢一半, 5:输一半  反水也是原来的一半
        //$rs_ty  = k_bet.sum(bet_money) where status in(1,2)
        //$rs_tyb = k_bet.sum(bet_money) where status in(4,5)
        //$rs_cg  = k_bet_cg_group.sum(bet_money) WHERE status in(1,2)    
        $where = ['commissioned'=>0,'status'=>['IN','4,5']];
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            $where['bet_time'] = ['<=',$end_time];
        }else{
            $where['bet_time'] = ['between',[$start_time,$end_time.' 23:59:59']];
        }
        
        $subquery1 = db('k_bet')->where($where)
        ->group('uid')->field('uid,SUM(bet_money) AS tz')
        ->fetchSql(true)->select();
        
        $list = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.uid = t1.uid')
        ->field('u.uid,u.gid,u.username,tz')
        //->fetchSql(true)->select();
        ->paginate();
        //dump($data);return;
        
        $data = $list->all();
        
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['gid']){
                $tz = $row['tz'];
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['gid'])->where('tz_ty','<=',$tz)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['ty'];
                    $data[$key]['je'] = round($tz*$bl['ty']/200,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        
        return $this->fetch();
    }
    
    public function tyb_fs(){
        $uid = input('uid/d');
        $stime = input('date_s');
        $etime = input('date_e');
        
        if(!$uid || !$stime || !$etime){
            return ['status'=>1,'msg'=>'参数不能为空'];
        }
        
        $user = db('k_user')->where('uid',$uid)->find();
        if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
        
        $where = ['commissioned'=>0,'status'=>['IN','4,5'],'u.uid'=>$uid];
        $where['bet_time'] = ['between',[$stime,$etime.' 23:59:59']];
        
        $sum = db('k_user')->alias('u')->where($where)
        ->join('k_bet b', 'u.uid = b.uid')
        ->sum('bet_money');
        //->fetchSql(true)->select();
        //dump($sum);return;
        $tz_ty = $sum??0;
        
        $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_ty','<=',$tz_ty)->order('px desc')->find();
        
        if(!$bl){
            return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
        }
        $bl_ty = $bl['ty'];
        $fs_ty = round($tz_ty*$bl_ty/200,2);
        
        Db::startTrans();
        try{
            
            $bets = db('k_user')->alias('u')->where($where)
            ->join('k_bet b', 'u.uid = b.uid')
            //->fetchSql(true)->select();
            ->select();
            foreach($bets as $bet){
                $commission = round($bet['bet_money']*$bl_ty/200,2);
                $update_data = ['commissioned'=>1,'commission'=>$commission];
                db('k_bet')->where('bid',$bet['bid'])->update($update_data);
            }
            
            db('k_user')->where('uid',$uid)->setInc('money',$fs_ty);
            
            $liyou = $stime .'~'. $etime .' 体育(输赢一半)投注返水';
            $info = $stime .'~'. $etime .' 体育(输赢一半)投注返水 '.$fs_ty.'RMB 已经存入您的账户，请注意查收！';
            
            $insert_data = ['uid'=>$uid,'m_value'=>$fs_ty,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
            db('k_money')->insert($insert_data);
            
            $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
            db('k_user_msg')->insert($msg);
            
            Db::commit();
            return ['status'=>0,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
    }
    
    public function tycg(){//1:赢, 2:输
        //$rs_ty  = k_bet.sum(bet_money) where status in(1,2)
        //$rs_tyb = k_bet.sum(bet_money) where status in(4,5)
        //$rs_cg  = k_bet_cg_group.sum(bet_money) WHERE status in(1,2)
        $where = ['isfs'=>0,'status'=>['IN','1,2']];
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            $where['bet_time'] = ['<=',$end_time];
        }else{
            $where['bet_time'] = ['between',[$start_time,$end_time.' 23:59:59']];
        }
        
        $subquery1 = db('k_bet_cg_group')->where($where)
        ->group('uid')->field('uid,SUM(bet_money) AS tz')
        ->fetchSql(true)->select();
        
        $list = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.uid = t1.uid')
        ->field('u.uid,u.gid ugid,u.username,tz')
        //->fetchSql(true)->select();
        ->paginate();
        //dump($list);return;
        
        $data = $list->all();
        
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['ugid']){
                $tz = $row['tz'];
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['ugid'])->where('tz_ty','<=',$tz)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['ty'];
                    $data[$key]['je'] = round($tz*$bl['ty']/100,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        
        return $this->fetch();
    }
    
    public function tycg_fs(){
        $uid = input('uid/d');
        $stime = input('date_s');
        $etime = input('date_e');
        
        if(!$uid || !$stime || !$etime){
            return ['status'=>1,'msg'=>'参数不能为空'];
        }
        
        $user = db('k_user')->where('uid',$uid)->find();
        if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
        
        $where = ['isfs'=>0,'status'=>['IN','1,2'],'u.uid'=>$uid];
        $where['bet_time'] = ['between',[$stime,$etime.' 23:59:59']];
        
        $sum = db('k_user')->alias('u')->where($where)
        ->join('k_bet_cg_group b', 'u.uid = b.uid')
        ->sum('bet_money');
        //->fetchSql(true)->select();
        //dump($sum);return;
        $tz_ty = $sum??0;
        
        $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_ty','<=',$tz_ty)->order('px desc')->find();
        
        if(!$bl){
            return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
        }
        $bl_ty = $bl['ty'];
        $fs_ty = round($tz_ty*$bl_ty/100,2);
        
        Db::startTrans();
        try{
            
            $bets = db('k_user')->alias('u')->where($where)
            ->join('k_bet_cg_group b', 'u.uid = b.uid')
            ->field('u.uid,u.gid ugid,bet_money,b.gid gid')
            //->fetchSql(true)->select();
            ->select();
            //dump($bets);return;
            foreach($bets as $bet){
                $commission = round($bet['bet_money']*$bl_ty/100,2);
                $update_data = ['isfs'=>1,'fs'=>$commission];
                db('k_bet_cg_group')->where('gid',$bet['gid'])->update($update_data);
            }
            
            db('k_user')->where('uid',$uid)->setInc('money',$fs_ty);
            
            $liyou = $stime .'~'. $etime .' 体育(串关)投注返水';
            $info = $stime .'~'. $etime .' 体育(串关)投注返水 '.$fs_ty.'RMB 已经存入您的账户，请注意查收！';
            
            $insert_data = ['uid'=>$uid,'m_value'=>$fs_ty,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
            db('k_money')->insert($insert_data);
            
            $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
            db('k_user_msg')->insert($msg);
            
            Db::commit();
            return ['status'=>0,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
    }

    public function cp(){
        //$rs_cp  = c_bet.sum(money) where js=1 and money<>0
        $where = ['commissioned'=>0,'js'=>1,];
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            $where['addtime'] = ['<=',$end_time];
        }else{
            $where['addtime'] = ['between',[$start_time,$end_time.' 23:59:59']];
        }
        
        $subquery1 = db('c_bet')->where($where)
        ->group('uid')->field('uid,SUM(money) AS tz')
        ->fetchSql(true)->select();
        
        $list = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.uid = t1.uid')
        //->field('u.uid,u.gid ugid,u.username,tz')
        //->fetchSql(true)->select();
        ->paginate();
        //dump($list);return;
        
        $data = $list->all();
        
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['gid']){
                $tz = $row['tz'];
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['gid'])->where('tz_cp','<=',$tz)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['cp'];
                    $data[$key]['je'] = round($tz*$bl['cp']/100,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        
        return $this->fetch();
    }
    
    public function cp_fs(){
        $uid = input('uid/d');
        $stime = input('date_s');
        $etime = input('date_e');
        
        if(!$uid || !$stime || !$etime){
            return ['status'=>1,'msg'=>'参数不能为空'];
        }
        
        $user = db('k_user')->where('uid',$uid)->find();
        if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
        
        $where = ['commissioned'=>0,'js'=>1,'u.uid'=>$uid];
        $where['addtime'] = ['between',[$stime,$etime.' 23:59:59']];
        
        $sum = db('k_user')->alias('u')->where($where)
        ->join('c_bet b', 'u.uid = b.uid')
        ->sum('b.money');
        //->fetchSql(true)->select();
        //dump($sum);return;
        $tz_cp = $sum??0;
        
        $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_cp','<=',$tz_cp)->order('px desc')->find();
        
        if(!$bl){
            return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
        }
        $bl_cp = $bl['cp'];
        $fs_cp = round($tz_cp*$bl_cp/100,2);
        
        Db::startTrans();
        try{
            
            $bets = db('k_user')->alias('u')->where($where)
            ->join('c_bet b', 'u.uid = b.uid')
            ->field('u.uid,u.gid,b.*')
            //->fetchSql(true)->select();
            ->select();
            //dump($bets);return;
            foreach($bets as $bet){
                $commission = round($bet['money']*$bl_cp/100,2);
                $update_data = ['commissioned'=>1,'commission'=>$commission];
                db('c_bet')->where('id',$bet['id'])->update($update_data);
            }
            
            db('k_user')->where('uid',$uid)->setInc('money',$fs_cp);
            
            $liyou = $stime .'~'. $etime .' 彩票投注返水';
            $info = $stime .'~'. $etime .' 彩票投注返水 '.$fs_cp.'RMB 已经存入您的账户，请注意查收！';
            
            $insert_data = ['uid'=>$uid,'m_value'=>$fs_cp,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
            db('k_money')->insert($insert_data);
            
            $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
            db('k_user_msg')->insert($msg);
            
            Db::commit();
            return ['status'=>0,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
    }
    
    public function mg(){
        //username,amount category WAGER投注,PAYOUT派彩
        //$rs_mg  = mg_record.sum(amount) where category='WAGER'
        $where = ['commissioned'=>0,'category'=>'WAGER',];
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            $where['transaction_time'] = ['<=',$end_time];
        }else{
            $where['transaction_time'] = ['between',[$start_time,$end_time.' 23:59:59']];
        }
        
        $subquery1 = db('mg_record')->where($where)
        ->group('username')->field('username,SUM(amount) AS tz')
        ->fetchSql(true)->select();
        
        $list = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.username = t1.username')
        //->field('u.uid,u.gid ugid,u.username,tz')
        //->fetchSql(true)->select();
        ->paginate();
        //dump($list);return;
        
        $data = $list->all();
        
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['gid']){
                $tz = $row['tz'];
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['gid'])->where('tz_mg','<=',$tz)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['mg'];
                    $data[$key]['je'] = round($tz*$bl['mg']/100,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        
        return $this->fetch();
    }
    
    public function mg_fs(){
        $uid = input('uid/d');
        $stime = input('date_s');
        $etime = input('date_e');
        
        if(!$uid || !$stime || !$etime){
            return ['status'=>1,'msg'=>'参数不能为空'];
        }
        
        $user = db('k_user')->where('uid',$uid)->find();
        if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
        
        $where = ['commissioned'=>0,'category'=>'WAGER','u.uid'=>$uid];
        $where['transaction_time'] = ['between',[$stime,$etime.' 23:59:59']];
        
        $sum = db('k_user')->alias('u')->where($where)
        ->join('mg_record b', 'u.username = b.username')
        ->sum('amount');
        //->fetchSql(true)->select();
        //dump($sum);return;
        $tz_mg = $sum??0;
        
        $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_mg','<=',$tz_mg)->order('px desc')->find();
        
        if(!$bl){
            return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
        }
        $bl_mg = $bl['mg'];
        $fs_mg = round($tz_mg*$bl_mg/100,2);
        
        Db::startTrans();
        try{
            
            $bets = db('k_user')->alias('u')->where($where)
            ->join('mg_record b', 'u.username = b.username')
            ->field('u.uid,u.gid,b.*')
            //->fetchSql(true)->select();
            ->select();
            //dump($bets);return;
            foreach($bets as $bet){
                $commission = round($bet['amount']*$bl_mg/100,2);
                $update_data = ['commissioned'=>1,'commission'=>$commission];
                db('mg_record')->where('id',$bet['id'])->update($update_data);
            }
            
            db('k_user')->where('uid',$uid)->setInc('money',$fs_mg);
            
            $liyou = $stime .'~'. $etime .' MG平台投注返水';
            $info = $stime .'~'. $etime .' MG平台投注返水 '.$fs_mg.'RMB 已经存入您的账户，请注意查收！';
            
            $insert_data = ['uid'=>$uid,'m_value'=>$fs_mg,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
            db('k_money')->insert($insert_data);
            
            $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
            db('k_user_msg')->insert($msg);
            
            Db::commit();
            return ['status'=>0,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
    }
    
    public function bb(){
        //bbin_gameresult.sum(Commissionable) where username
        //$rs_mg  = mg_record.sum(amount) where category='WAGER'
        $where = ['commissioned'=>0,];
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            $where['WagersDate'] = ['<=',$end_time];
        }else{
            $where['WagersDate'] = ['between',[$start_time,$end_time.' 23:59:59']];
        }
        
        $subquery1 = db('bbin_gameresult')->where($where)
        ->group('username')->field('username,SUM(Commissionable) AS tz')
        ->fetchSql(true)->select();
        
        $list = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.username = t1.username')
        //->field('u.uid,u.gid ugid,u.username,tz')
        //->fetchSql(true)->select();
        ->paginate();
        //dump($list);return;
        
        $data = $list->all();
        
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['gid']){
                $tz = $row['tz'];
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['gid'])->where('tz_bb','<=',$tz)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['bb'];
                    $data[$key]['je'] = round($tz*$bl['bb']/100,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        
        return $this->fetch();
    }
    
    public function bb_fs(){
        $uid = input('uid/d');
        $stime = input('date_s');
        $etime = input('date_e');
        
        if(!$uid || !$stime || !$etime){
            return ['status'=>1,'msg'=>'参数不能为空'];
        }
        
        $user = db('k_user')->where('uid',$uid)->find();
        if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
        
        $where = ['commissioned'=>0,'u.uid'=>$uid];
        $where['WagersDate'] = ['between',[$stime,$etime.' 23:59:59']];
        
        $sum = db('k_user')->alias('u')->where($where)
        ->join('bbin_gameresult b', 'u.username = b.username')
        ->sum('Commissionable');
        //->fetchSql(true)->select();
        //dump($sum);return;
        $tz_bb = $sum??0;
        
        $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_bb','<=',$tz_bb)->order('px desc')->find();
        
        if(!$bl){
            return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
        }
        $bl_bb = $bl['bb'];
        $fs_bb = round($tz_bb*$bl_bb/100,2);
        
        Db::startTrans();
        try{
            
            $bets = db('k_user')->alias('u')->where($where)
            ->join('bbin_gameresult b', 'u.username = b.username')
            ->field('u.uid,u.gid,b.*')
            //->fetchSql(true)->select();
            ->select();
            //dump($bets);return;
            foreach($bets as $bet){
                $commission = round($bet['Commissionable']*$bl_bb/100,2);
                $update_data = ['commissioned'=>1,'commission'=>$commission];
                db('bbin_gameresult')->where('id',$bet['id'])->update($update_data);
            }
            
            db('k_user')->where('uid',$uid)->setInc('money',$fs_bb);
            
            $liyou = $stime .'~'. $etime .' BB平台投注返水';
            $info = $stime .'~'. $etime .' BB平台投注返水 '.$fs_bb.'RMB 已经存入您的账户，请注意查收！';
            
            $insert_data = ['uid'=>$uid,'m_value'=>$fs_bb,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
            db('k_money')->insert($insert_data);
            
            $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
            db('k_user_msg')->insert($msg);
            
            Db::commit();
            return ['status'=>0,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
    }
    
    public function og(){
        //og_live_history.sum(ValidAmount)  where UserName=  AddTime
        //sunbet_history_bets.sum(riskamt) where username= timestamp
        //$rs_mg  = mg_record.sum(amount) where category='WAGER'
        $where = ['commissioned'=>0,];
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            $where['AddTime'] = ['<=',$end_time];
        }else{
            $where['AddTime'] = ['between',[$start_time,$end_time.' 23:59:59']];
        }
        
        $subquery1 = db('og_live_history')->where($where)
        ->group('UserName')->field('UserName AS username,SUM(ValidAmount) AS tz')
        ->fetchSql(true)->select();
        
        $list = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.username = t1.username')
        //->field('u.uid,u.gid ugid,u.username,tz')
        //->fetchSql(true)->select();
        ->paginate();
        //dump($list);return;
        
        $data = $list->all();
        
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['gid']){
                $tz = $row['tz'];
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['gid'])->where('tz_og','<=',$tz)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['og'];
                    $data[$key]['je'] = round($tz*$bl['og']/100,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        
        return $this->fetch();
    }

    public function og_fs(){
        $uid = input('uid/d');
        $stime = input('date_s');
        $etime = input('date_e');
        
        if(!$uid || !$stime || !$etime){
            return ['status'=>1,'msg'=>'参数不能为空'];
        }
        
        $user = db('k_user')->where('uid',$uid)->find();
        if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
        
        $where = ['commissioned'=>0,'u.uid'=>$uid];
        $where['AddTime'] = ['between',[$stime,$etime.' 23:59:59']];
        
        $sum = db('k_user')->alias('u')->where($where)
        ->join('og_live_history b', 'u.username = b.UserName')
        ->sum('ValidAmount');
        //->fetchSql(true)->select();
        //dump($sum);return;
        $tz_og = $sum??0;
        
        $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_og','<=',$tz_og)->order('px desc')->find();
        
        if(!$bl){
            return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
        }
        $bl_og = $bl['og'];
        $fs_og = round($tz_og*$bl_og/100,2);
        
        Db::startTrans();
        try{
            
            $bets = db('k_user')->alias('u')->where($where)
            ->join('og_live_history b', 'u.username = b.UserName')
            ->field('u.uid,u.gid,b.*')
            //->fetchSql(true)->select();
            ->select();
            //dump($bets);return;
            foreach($bets as $bet){
                $commission = round($bet['ValidAmount']*$bl_og/100,2);
                $update_data = ['commissioned'=>1,'commission'=>$commission];
                db('og_live_history')->where('id',$bet['id'])->update($update_data);
            }
            
            db('k_user')->where('uid',$uid)->setInc('money',$fs_og);
            
            $liyou = $stime .'~'. $etime .' OG平台投注返水';
            $info = $stime .'~'. $etime .' OG平台投注返水 '.$fs_og.'RMB 已经存入您的账户，请注意查收！';
            
            $insert_data = ['uid'=>$uid,'m_value'=>$fs_og,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
            db('k_money')->insert($insert_data);
            
            $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
            db('k_user_msg')->insert($msg);
            
            Db::commit();
            return ['status'=>0,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
    }

    public function sb(){
        $where = ['commissioned'=>0,];
        $nowdate = date('Y-m-d');
        $start_time = input('date_s',$nowdate);
        $end_time = input('date_e',$nowdate);
        if(strtotime($start_time) > strtotime($end_time)){
            $where['timestamp'] = ['<=',$end_time];
        }else{
            $where['timestamp'] = ['between',[$start_time,$end_time.' 23:59:59']];
        }
        
        $subquery1 = db('sunbet_history_bets')->where($where)
        ->group('username')->field('username,SUM(riskamt) AS tz')
        ->fetchSql(true)->select();
        
        $list = db('k_user')->alias('u')
        ->join('('.$subquery1.')'.' AS t1', 'u.username = t1.username')
        //->field('u.uid,u.gid ugid,u.username,tz')
        //->fetchSql(true)->select();
        ->paginate();
        //dump($list);return;
        
        $data = $list->all();
        
        //"select * from k_user_fanshui_bili where gid = $gid order by px asc";
        //反水比例 根据gid和px(理解为梯度),每个梯度可以设置不同投注额要求
        foreach($data as $key => $row){
            if($row['gid']){
                $tz = $row['tz'];
                //最高梯度限制的比例
                $bl = db('k_user_fanshui_bili_bak2')->where('gid',$row['gid'])->where('tz_sb','<=',$tz)->order('px desc')->find();
                if($bl){
                    $data[$key]['bl'] = $bl['sb'];
                    $data[$key]['je'] = round($tz*$bl['sb']/100,2);
                }
            }
            $data[$key]['bl'] = $data[$key]['bl']??0;
            $data[$key]['je'] = $data[$key]['je']??0;
        }
        //dump($data);     return;
        
        $this->assign('data',$data);
        
        $page = $list->appends(['date_s'=>input('date_s'),'date_e'=>input('date_e')])->render();
        $this->assign('page',$page);
        
        return $this->fetch();
    }
    
    //sunbet_history_bets.sum(riskamt) where username= timestamp
    public function sb_fs(){
        $uid = input('uid/d');
        $stime = input('date_s');
        $etime = input('date_e');
        
        if(!$uid || !$stime || !$etime){
            return ['status'=>1,'msg'=>'参数不能为空'];
        }
        
        $user = db('k_user')->where('uid',$uid)->find();
        if(!$user)return ['status'=>1,'msg'=>'用户不存在'];
        
        $where = ['commissioned'=>0,'u.uid'=>$uid];
        $where['timestamp'] = ['between',[$stime,$etime.' 23:59:59']];
        
        $sum = db('k_user')->alias('u')->where($where)
        ->join('sunbet_history_bets b', 'u.username = b.username')
        ->sum('riskamt');
        //->fetchSql(true)->select();
        //dump($sum);return;
        $tz_og = $sum??0;
        
        $bl = db('k_user_fanshui_bili_bak2')->where('gid',$user['gid'])->where('tz_sb','<=',$tz_sb)->order('px desc')->find();
        
        if(!$bl){
            return ['status'=>1,'msg'=>'用户投注额不足，没有反水！'];
        }
        $bl_sb = $bl['sb'];
        $fs_sb = round($tz_sb*$bl_sb/100,2);
        
        Db::startTrans();
        try{
            
            $bets = db('k_user')->alias('u')->where($where)
            ->join('sunbet_history_bets b', 'u.username = b.username')
            ->field('u.uid,u.gid,b.*')
            //->fetchSql(true)->select();
            ->select();
            //dump($bets);return;
            foreach($bets as $bet){
                $commission = round($bet['riskamt']*$bl_sb/100,2);
                $update_data = ['commissioned'=>1,'commission'=>$commission];
                db('sunbet_history_bets')->where('id',$bet['id'])->update($update_data);
            }
            
            db('k_user')->where('uid',$uid)->setInc('money',$fs_sb);
            
            $liyou = $stime .'~'. $etime .' SB平台投注返水';
            $info = $stime .'~'. $etime .' SB平台投注返水 '.$fs_sb.'RMB 已经存入您的账户，请注意查收！';
            
            $insert_data = ['uid'=>$uid,'m_value'=>$fs_sb,'status'=>1,'m_order'=>'','about'=>$liyou,'type'=>600];
            db('k_money')->insert($insert_data);
            
            $msg = ['uid'=>$uid,'msg_from'=>"结算中心",'msg_title'=>$liyou,'msg_info'=>$info,];
            db('k_user_msg')->insert($msg);
            
            Db::commit();
            return ['status'=>0,'msg'=>'操作成功'];
        }catch (\Exception $e) {
            Db::rollback();
            return ['status'=>1,'msg'=>'操作失败'];
        }
    }
    
	public function fanshui_bl(){
	    $data = db('k_user_fanshui_bili_bak2 b')->join('k_group g','b.gid=g.id')
	    ->order('px asc')->field('b.*,g.name')->select();
	    
	    $this->assign('data',$data);
	    
		return $this->fetch();
	}
	
	public function fanshui_bl_del(){
	    $id = input('id/d');
	    $ret = db('k_user_fanshui_bili_bak2')->where('id',$id)->delete();
	    if(!$ret){
	        return ['status'=>1,'msg'=>'删除失败',];
	    }
	    return ['status'=>0,'msg'=>'',];	    
	}
	
	public function fanshui_bl_edit(){
	    if($this->request->isGet()){
	        $groups = db('k_group')->select();
	        $this->assign('groups',$groups);
	        
	        $id = input('id/d');	        
	        if($id>0){//编辑
                $bl = db('k_user_fanshui_bili_bak2')->where('id',$id)->find();                
	        }else{
	            $bl = ['id'=>'','gid'=>'','px'=>'','tz'=>'',
	                'ag'=>'','ty'=>'','cp'=>'','mg'=>'','bb'=>'','og'=>'','sb'=>'',
	                'tz_ag'=>'','tz_ty'=>'','tz_cp'=>'','tz_mg'=>'','tz_bb'=>'','tz_og'=>'','tz_sb'=>'',	                
	            ];
	        }
	        $this->assign('bl',$bl);
	        return $this->fetch();
	    }else{	        
	        $data            = $this->request->post();
	        unset($data['submit']);
	        
	        if(intval($data['id'])>0){
	            $ret = db('k_user_fanshui_bili_bak2')->update($data);	            
	        }else{
	            unset($data['id']);
	            $ret = db('k_user_fanshui_bili_bak2')->insert($data);
	        }
	        if($ret === false){
	            return Alert('编辑失败!',url('fanshui_bl_edit').'?id='.$data['id']);
	        }
	        return Alert('编辑成功!',url('fanshui_bl'));
	  
	    }
	}
}