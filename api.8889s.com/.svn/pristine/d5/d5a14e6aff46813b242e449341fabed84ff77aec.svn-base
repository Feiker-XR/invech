<?php
namespace app\admin\controller;
use app\admin\Login;
use app\logic\bet;
use think\Db;
use think\Paginator;
class Sports extends Login{

    
    public function zuqiu(){
        $param = $this->request->param();       
        $db = Db::connect(config('sportdb'));
        $page_date = date('m-d');
        $page_date2 = date('Y-d-d');
        $conf = [];
        if(isset($param['date'])){
            $page_date = $param['date'];
            $page_date2 = date('Y-').$param['date'];
            $conf['date'] = $page_date;
        }
        $js = input('js',0);if($js)$js = 1;
       
        $field = array(
            "ID",
            "Match_ID",
            " Match_Date",
            " Match_Time",
            " Match_Master",
            " Match_Guest",
            "Match_Name",
            "MB_Inball",
            "TG_Inball",
            "MB_Inball_HR",
            "TG_Inball_HR",
            "match_sbjs",
        );
        $where = [
            'match_js' => ['eq','match_js'],
        ];
        /*
        $list = $db->table('bet_match')->where(function($query){
            $query->where('match_js',0);
        })->where(
            function($query) use($page_date,$page_date2){
                $query->whereOr('match_date','eq',$page_date)->whereOr('match_date','eq',$page_date);
            })
            ->field($field)->order(' Match_CoverDate,Match_Name,Match_Master,iPage,iSn desc')->paginate(15);
        */
        $list = $db->table('bet_match')->where('match_js',$js)
        ->where('match_date',['=',$page_date],['=',$page_date2],'or')
        ->field($field)->order(' Match_CoverDate,Match_Name,Match_Master,iPage,iSn desc')
        ->paginate(15);
        foreach ($param as $key => $value) {
            $list->appends($key,$value);
        }
        
        $arr_bet	=	array();
        $match_info = array();
        foreach ($list as $k => $rows){
            $match_info[$k]['Match_ID'] = $rows['Match_ID'];
            $match_info[$k]['Match_Time'] = $rows['Match_Time'];
            $match_info[$k]['MB_Inball'] = $rows['MB_Inball'];
            $match_info[$k]['TG_Inball'] = $rows['TG_Inball'];
            $match_info[$k]['MB_Inball_HR'] = $rows['MB_Inball_HR'];
            $match_info[$k]['TG_Inball_HR'] = $rows['TG_Inball_HR'];
            $match_info[$k]['match_sbjs'] = $rows['match_sbjs'];
            
            if($rows["match_sbjs"]>0) $bgcolor="#FF9999";
            else $bgcolor="#ffffff";
            $match_info[$k]['bgcolor'] = $bgcolor;
            $match_info[$k]["Match_Name"]		=	trim($rows["Match_Name"]);
            $match_info[$k]["Match_Master"]	=	trim($rows["Match_Master"]);
            $match_info[$k]["Match_Guest"]	=	trim($rows["Match_Guest"]);
            $ftid	=	$rows["Match_ID"];
            $bool	=	true;
            foreach($arr_bet as $v=>$arr){
                if(in_array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),$arr)){
                    $ftid	=	$arr['Match_ID'];
                    $bool	=	false;
                    break;
                }
            }
            if($bool){
                array_unshift($arr_bet,array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),'Match_ID'=>$rows['Match_ID']));
            }
            $match_info[$k]['ftid'] = $ftid;
            $arr     =	explode('[上半',$rows["Match_Master"]);
            $match_info[$k]['couarr']  =	count($arr);
        }
        $this->assign('match_info',$match_info);
        $this->assign('list',$list);
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('js',$js);
        return $this->fetch();
    }

    public function lanqiu(){
        $param = $this->request->param();
        $db = Db::connect(config('sportdb'));
        $page_date = date('m-d');
        $page_date2 = date('Y-m-d');
        $conf = [];
        if(isset($param['date'])){
            $page_date = $param['date'];
            $page_date2 = date('Y-').$param['date'];
            $conf['date'] = $page_date;
        }
        $js = input('js',0);if($js)$js = 1;
        
        $list = $db->table('lq_match')->where('match_js',0)
        ->where('match_date',['=',$page_date],['=',$page_date2],'or')
        ->field('Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_MasterID,Match_GuestID,Match_Name,MB_Inball_1st,TG_Inball_1st,MB_Inball_2st,TG_Inball_2st,MB_Inball_3st,TG_Inball_3st,MB_Inball_4st,TG_Inball_4st,MB_Inball_HR,	TG_Inball_HR,MB_Inball_ER,TG_Inball_ER,MB_Inball,TG_Inball,MB_Inball_Add,TG_Inball_Add ,MB_Inball_OK,TG_Inball_OK,match_js')
        ->order('Match_CoverDate,Match_Name,Match_Master,iPage,iSn desc')
        ->paginate(15);
        foreach ($param as $key => $value) {
            $list->appends($key,$value);
        }
        
        $arr_bet    =   array();
        $list2 = collection([]);
        foreach ($list as $rows){

            $ftid   =   $rows["Match_ID"];
            $bool   =   true;
            
            foreach($arr_bet as $v=>$arr){
                if(in_array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),$arr)){
                    $ftid   =   $arr['Match_ID'];
                    $bool   =   false;
                    break;
                }
            }
            if($bool){
                array_unshift($arr_bet,array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),'Match_ID'=>$rows['Match_ID']));
            }
            
            $rows['ftid'] = $ftid;
            $list2[] = $rows;
        }

        $this->assign('list',$list);
        $this->assign('list2',$list2);
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('js',$js);
        return $this->fetch();        
    }

    public function tennis(){

        $param = $this->request->param();
        $db = Db::connect(config('sportdb'));
        $page_date = date('m-d');
        $page_date2 = date('Y-m-d');
        $conf = [];
        if(isset($param['date'])){
            $page_date = $param['date'];
            $page_date2 = date('Y-').$param['date'];
            $conf['date'] = $page_date;
        }
        $js = input('js',0);if($js)$js = 1;
  
        $list = $db->table('tennis_match')->where('match_js',0)
        ->where('match_date',['=',$page_date],['=',$page_date2],'or')
        ->field('ID,Match_ID,Match_Time,Match_Master,Match_Guest,Match_Name,MB_Inball,TG_Inball')
        ->order('Match_CoverDate,Match_Name,Match_Master desc')
        ->paginate(15);
        foreach ($param as $key => $value) {
            $list->appends($key,$value);
        }
        
        $arr_bet    =   array();
        $list2 = collection([]);
        foreach ($list as $rows){

            $ftid   =   $rows["Match_ID"];
            $bool   =   true;
            
            if(in_array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),$arr_bet)){
                    $ftid	=	$arr_bet['Match_ID'];
                    $bool	=	false;
            }
            if($bool){
                    $arr_bet	=	array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),'Match_ID'=>$rows['Match_ID']);
            }
            
            $rows['ftid'] = $ftid;
            $list2[] = $rows;
        }

        $this->assign('list',$list);
        $this->assign('list2',$list2);
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('js',$js);
        return $this->fetch();  
    }    

    public function volleyball(){

        $param = $this->request->param();
        $db = Db::connect(config('sportdb'));
        $page_date = date('m-d');
        $page_date2 = date('Y-m-d');
        $conf = [];
        if(isset($param['date'])){
            $page_date = $param['date'];
            $page_date2 = date('Y-').$param['date'];
            $conf['date'] = $page_date;
        }
        $js = input('js',0);if($js)$js = 1;

        $list = $db->table('volleyball_match')->where('match_js',0)
        ->where('match_date',['=',$page_date],['=',$page_date2],'or')
        ->field('ID,Match_ID,Match_Time,Match_Master,Match_Guest,Match_Name,MB_Inball,TG_Inball')
        ->order('Match_CoverDate,Match_Name,Match_Master desc')
        ->paginate(15);
        foreach ($param as $key => $value) {
            $list->appends($key,$value);
        }
        
        $arr_bet    =   array();
        $list2 = collection([]);
        foreach ($list as $rows){

            $ftid   =   $rows["Match_ID"];
            $bool   =   true;
            
            if(in_array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),$arr_bet)){
                    $ftid	=	$arr_bet['Match_ID'];
                    $bool	=	false;
            }
            if($bool){
                    $arr_bet	=	array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),'Match_ID'=>$rows['Match_ID']);
            }
            
            $rows['ftid'] = $ftid;
            $list2[] = $rows;
        }

        $this->assign('list',$list);
        $this->assign('list2',$list2);
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('js',$js);
        return $this->fetch();  
    }    

    public function baseball(){
	
        $param = $this->request->param();
        $db = Db::connect(config('sportdb'));
        $page_date = date('m-d');
        $page_date2 = date('Y-m-d');
        $conf = [];
        if(isset($param['date'])){
            $page_date = $param['date'];
            $page_date2 = date('Y-').$param['date'];
            $conf['date'] = $page_date;
        }
        $js = input('js',0);if($js)$js = 1;

        $list = $db->table('baseball_match')->where('match_js',0)
        ->where('match_date',['=',$page_date],['=',$page_date2],'or')
        ->field('ID,Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_Name,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR')
        ->order('Match_CoverDate,Match_Name,Match_Master desc')
        ->paginate(15);
        foreach ($param as $key => $value) {
            $list->appends($key,$value);
        }
        
        $arr_bet    =   array();
        $list2 = collection([]);
        foreach ($list as $rows){

            $ftid   =   $rows["Match_ID"];
            $bool   =   true;
            
            if(in_array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),$arr_bet)){
                    $ftid	=	$arr_bet['Match_ID'];
                    $bool	=	false;
            }
            if($bool){
                    $arr_bet	=	array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),'Match_ID'=>$rows['Match_ID']);
            }
            
            $rows['ftid'] = $ftid;
            $list2[] = $rows;
        }

        $this->assign('list',$list);
        $this->assign('list2',$list2);
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        $this->assign('js',$js);
        return $this->fetch();     
      
    }  

    public function guanjun(){

        $param = $this->request->param();
        $db = Db::connect(config('sportdb'));
        $page_date = date('m-d');
        $page_date2 = date('Y-m-d');
        $conf = [];
        if(isset($param['date'])){
            $page_date = $param['date'];
            $page_date2 = date('Y-').$param['date'];
            $conf['date'] = $page_date;
        }

        $query = $db->table('t_guanjun');
        if( isset($param['type']) && $param['type'] < 3){
            $query->where('match_type',$param['type']);
        }
        if( isset($param['x_title']) && true ){
            $query->where('x_title',$param['x_title']);
        }        
      
        if( isset($param['date']) && true ){
            $query->where('match_coverdate',['like','%'.$page_date.'%'],['like','%'.$page_date2.'%'],'or');
        }         

        $list = $query->order(['match_coverdate'=>'desc','x_id'=>'desc'])->paginate(15);
        $list2 = collection([]);
        foreach($list as $row){
            $row['num'] = $db->table('t_guanjun_team')->where('xid',$row['x_id'])->count();
            $list2[] = $row;
        }

        $this->assign('match_info',$list2);
        $this->assign('list',$list);
        $this->assign('page_date',$page_date);
        $this->assign('page_date2',$page_date2);
        return $this->fetch();        
    }  
    
    //结算半场/全场,重结算半场/全场,设为无效 都接受赛事ID数组为参数
    //这些都可以添加type参数 来区别 足球,篮球,之类
    //type参数存储在隐藏域然后提交给do_处理函数
    
    /**
    *结算上半场之注单列表
    */
    public function jiesuan_sb_list(){

        //$mid_array =   input("mid");
        //$mid_array = $this->request->param('mid');
        $param = $this->request->param();
        $mid_array = $param['mid'];       
        $mid        =   implode(",",$mid_array);

        //$db = Db::connect(config('sportdb'));
        
        //单式
        $point_columns = ['match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl'];
     
        $list = Db::table('k_bet')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')
        ->where('b.lose_ok',1)  
        ->where('b.status',0)  
        ->where('b.match_id','IN',$mid_array)
        ->where('b.point_column',['IN',$point_columns],['like','match_hr_bd%'],'OR')
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();
 
        $list_cg = Db::table('k_bet_cg')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')       
        ->where('b.status',0)  
        ->where('b.match_id','IN',$mid_array)
        ->where(function($query){
            $query->where('b.ball_sort','like','%上半场%')
                  ->whereOr('b.bet_info','like','%上半场%');
        })->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();

        $save = "1";
        $color = "";

        $all_bet_money = 0;
        $all_win = 0;

        $list2 = collection([]);
        foreach ($list as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $column=$rows["point_column"];
            $t = make_point(strtolower($column),"","",$rows["MB_Inball"],$rows["TG_Inball"],$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);

            $rows['t'] = $t;
            $rows['win'] = $this->get_win($t,$rows);
            $list2[] = $rows;

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        $list2_cg = collection([]);
        foreach ($list_cg as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $column=$rows["point_column"];
            $t = make_point(strtolower($column),"","",$rows["MB_Inball"],$rows["TG_Inball"],$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);

            $rows['t'] = $t;
            $rows['win'] = $this->get_win($t,$rows);
            $list2_cg[] = $rows;

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        $this->assign('mid',$mid);
        //$this->assign('list',$list);
        //$this->assign('list_cg',$list_cg);
        $this->assign('list2',$list2);
        $this->assign('list2_cg',$list2_cg);
        $this->assign('all_bet_money',$all_bet_money);
        $this->assign('all_win',$all_win);

        return $this->fetch();
    }    

    public function do_jiesuan_sb(){
        $param = $this->request->param();
        //$php    =   $_GET['php'] ? $_GET['php'] : 'ZuQiu';
        $table  =   input('type','bet_match');
      
        //php参数指定的回跳地址可以由type参数(表名)来确定

        $mid = $param['match_id'];       

        //单式
        if(isset($_POST["bid"])&&count($_POST["bid"])>0){
            foreach ($_POST['bid'] as $i=>$bid){  
                $status=intval($_POST['status'][$i]);
                $mb_inball=$_POST['mb_inball'][$i];
                $tg_inball=$_POST['tg_inball'][$i];
                $bool   =   bet::set($bid,$status,$mb_inball,$tg_inball);
                if(!$bool) {
                    return $this->error('注单'.$bid.'单式操作失败！');
                }
            }
        }
        //串关
        if(isset($_POST["bid_cg"])&&count($_POST["bid_cg"])>0){
            foreach ($_POST['bid_cg'] as $i=>$bid){
                $status=intval($_POST['status_cg'][$i]);
                $mb_inball=$_POST['mb_inball_cg'][$i];
                $tg_inball=$_POST['tg_inball_cg'][$i];
                $bool   =   bet::set_cg($bid,$status,$mb_inball,$tg_inball);
                if(!$bool) {
                    return $this->error('注单'.$bid.'串关操作失败！');
                }
            }
        }

        $db = Db::connect(config('sportdb'));
        /*
        $update_data['match_js'] = 1;
        if($table=='bet_match'){
            $update_data['match_sbjs'] = 1;
        }       
        */
        $update_data['match_sbjs'] = 1;
        $sql = $db->table($table)->where('match_id','in',$mid)->update($update_data);

        sys_log(session('adminid'),"批量审核了".$this->ball_name($table)."上半场赛事".$mid."注单");
        
        //return $this->success('半场结算成功!',$this->back_page($table));
        return Alert('半场结算成功!',$this->back_page($table));
    }

    /**
    *重新结算上半场之注单列表
    */
    public function re_jiesuan_sb_list(){

        //$mid_array =   input("mid");
        //$mid_array = $this->request->param('mid');
        $param = $this->request->param();
        $mid_array = $param['mid'];       
        $mid        =   implode(",",$mid_array);

        //$db = Db::connect(config('sportdb'));
        
        //单式
        $point_columns = ['match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl'];

        //待重结算的半场注单,状态必须 不等于 0, 0表示未结算;
        $list = Db::table('k_bet')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')
        ->where('b.lose_ok',1)  
        ->where('b.status','<>',0)  
        ->where('b.match_id','IN',$mid_array)
        ->where('b.point_column',['IN',$point_columns],['like','match_hr_bd%'],'OR')
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();
        
        //可重结算的串关 注单,status必须<>0
        $list_cg = Db::table('k_bet_cg')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')       
        ->join('k_bet_cg_group g','b.gid = g.gid','LEFT') 
        ->where('b.status','<>',0)  
        ->where('b.match_id','IN',$mid_array)
        ->where(function($query){
            $query->where('b.ball_sort','like','%上半场%')
                  ->whereOr('b.bet_info','like','%上半场%');
        })->order(['b.bid'=>'desc',])
        ->field('b.*,u.username,g.win')->select();

        $save = "1";
        $color = "";

        $all_bet_money = 0;
        $all_win = 0;

 
        foreach ($list as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        foreach ($list_cg as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        $this->assign('mid',$mid);
        $this->assign('list',$list);
        $this->assign('list_cg',$list_cg);
        $this->assign('all_bet_money',$all_bet_money);
        $this->assign('all_win',$all_win);

        return $this->fetch();
    }

    /*
    *重新结算上半场
     */
    public function do_re_jiesuan_sb(){
        $param = $this->request->param();
        //$php    =   $_GET['php'] ? $_GET['php'] : 'ZuQiu';
        $table  =   input('type','bet_match');
      
        //php参数指定的回跳地址可以由type参数(表名)来确定

        $mid = $param['match_id'];       

        //单式结算开始
        if(isset($_POST["bid"])&&count($_POST['bid'])>0){
            foreach($_POST['bid'] as $i=>$bid){
                bet::qx_bet($bid,$_POST['status'][$i]);
            }
        }

        //串关结算开始
        if(isset($_POST["bid_cg"])&&count($_POST['bid_cg'])>0){
            foreach($_POST['bid_cg'] as $i=>$bid){
                bet::qx_cgbet($bid);
            }
        }        

        $db = Db::connect(config('sportdb'));
        $update_data['match_sbjs'] = 0;
        $sql = $db->table($table)->where('match_id','in',$mid)->update($update_data);

        sys_log(session('adminid'),"重新结算了足球上半场赛事".$mid."注单");

        return Alert('本次重新结算上半场完成!',$this->back_page($table));
    }

    /**结算全场之注单列表
    */
    public function jiesuan_list(){

        $param = $this->request->param();
        $mid_array = $param['mid'];       
        $mid        =   implode(",",$mid_array);
        //$table = 'bet_match';
        $table  =   input('type','bet_match');

        //赛事半场比分
        $db = Db::connect(config('sportdb'));
        $r = $db->table($table)->where('Match_ID','in',$mid)
        ->field('Match_ID,MB_Inball_HR,TG_Inball_HR')->select();
        $m     		=	array();
        foreach($r as $rows){
                $m[$rows["Match_ID"]]["MB_Inball_HR"] = $rows["MB_Inball_HR"];
                $m[$rows["Match_ID"]]["TG_Inball_HR"] = $rows["TG_Inball_HR"];
        }

        //单式 半场与全场区别在point_column字段
        $point_columns = ['match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl'];
                
        $list = Db::table('k_bet')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')
        ->where('b.lose_ok',1)  
        ->where('b.status',0)  
        ->where('b.match_id','IN',$mid_array)
        //->where('b.point_column',['IN',$point_columns],['like','match_hr_bd%'],'OR')
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();
 
        //串关 半场与全场区别在ball_sort和bet_info
        $list_cg = Db::table('k_bet_cg')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')       
        ->where('b.status',0)  
        ->where('b.match_id','IN',$mid_array)
        /*
        ->where(function($query){
            $query->where('b.ball_sort','like','%上半场%')
                  ->whereOr('b.bet_info','like','%上半场%');
        })
        */
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();

        $save = "1";
        $color = "";

        $all_bet_money = 0;
        $all_win = 0;

        $list2 = collection([]);
        foreach ($list as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $MB_Inball = $TG_Inball = $MB_Inball_HR = $TG_Inball_HR = "";
            $arr_sb= array("match_bmdy","match_bgdy","match_bhdy","match_bho","match_bao","match_bdpl","match_bxpl");
            if(in_array($rows["point_column"],$arr_sb) || strpos($rows["point_column"],"match_hr_bd")){
                    $MB_Inball_HR = $rows["MB_Inball"];
                    $TG_Inball_HR = $rows["TG_Inball"];
            }else{
                    $MB_Inball    = $rows["MB_Inball"];
                    $TG_Inball    = $rows["TG_Inball"];
                    $MB_Inball_HR = $m[$rows["match_id"]]["MB_Inball_HR"];
                    $TG_Inball_HR = $m[$rows["match_id"]]["TG_Inball_HR"];
            }

            $column=$rows["point_column"];
            //$t = make_point(strtolower($column),"","",$rows["MB_Inball"],$rows["TG_Inball"],$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);

            $t = make_point($column,$MB_Inball,$TG_Inball,$MB_Inball_HR,$TG_Inball_HR,$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);
                          
            $rows['t'] = $t;
            $rows['win'] = $this->get_win($t,$rows);
            $list2[] = $rows;

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        $list2_cg = collection([]);
        foreach ($list_cg as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $MB_Inball = $TG_Inball = $MB_Inball_HR = $TG_Inball_HR = "";
            if(strpos($rows["ball_sort"],"上半场") || strpos($rows["bet_info"],"上半场")){
                    $MB_Inball_HR = $rows["MB_Inball"];
                    $TG_Inball_HR = $rows["TG_Inball"];
            }else{
                    $MB_Inball    = $rows["MB_Inball"];
                    $TG_Inball    = $rows["TG_Inball"];
                    $MB_Inball_HR = $m[$rows["match_id"]]["MB_Inball_HR"];
                    $TG_Inball_HR = $m[$rows["match_id"]]["TG_Inball_HR"];
            }
            
            $column=$rows["point_column"];
            //k_bet.match_type=2表示滚球
            //k_bet_cg表中是没有match_type字段,串关是没有滚球的概念;
            //$t = make_point($column,$MB_Inball,$TG_Inball,$MB_Inball_HR,$TG_Inball_HR,$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);
            $t = make_point($column,$MB_Inball,$TG_Inball,$MB_Inball_HR,$TG_Inball_HR,1,$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);

            $rows['t'] = $t;
            $rows['win'] = $this->get_win($t,$rows);
            $list2_cg[] = $rows;

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        $this->assign('mid',$mid);
        //$this->assign('list',$list);
        //$this->assign('list_cg',$list_cg);
        $this->assign('list2',$list2);
        $this->assign('list2_cg',$list2_cg);
        $this->assign('all_bet_money',$all_bet_money);
        $this->assign('all_win',$all_win);
    
        //结算全场 和 结算半场的模板一样;
        return $this->fetch();    
    }

    /**结算全场
    * 结算半场在结算后 设置赛事的match_sbjs=1;
    * 结算全场在结算后 设置赛事的match_js=1,如果是足球,还需设置match_sbjs=1;
    */
    public function do_jiesuan(){
        $param = $this->request->param();
        //$php    =   $_GET['php'] ? $_GET['php'] : 'ZuQiu';
        $table  =   input('type','bet_match');
      
        //php参数指定的回跳地址可以由type参数(表名)来确定

        $mid = $param['match_id'];       

        //单式
        if(isset($_POST["bid"])&&count($_POST["bid"])>0){
            foreach ($_POST['bid'] as $i=>$bid){  
                $status=intval($_POST['status'][$i]);
                $mb_inball=$_POST['mb_inball'][$i];
                $tg_inball=$_POST['tg_inball'][$i];
                $bool   =   bet::set($bid,$status,$mb_inball,$tg_inball);
                if(!$bool) {
                    return $this->error('注单'.$bid.'单式操作失败！');
                }
            }
        }
        //串关
        if(isset($_POST["bid_cg"])&&count($_POST["bid_cg"])>0){
            foreach ($_POST['bid_cg'] as $i=>$bid){
                $status=intval($_POST['status_cg'][$i]);
                $mb_inball=$_POST['mb_inball_cg'][$i];
                $tg_inball=$_POST['tg_inball_cg'][$i];
                $bool   =   bet::set_cg($bid,$status,$mb_inball,$tg_inball);
                if(!$bool) {
                    return $this->error('注单'.$bid.'串关操作失败！');
                }
            }
        }

        $db = Db::connect(config('sportdb'));
        $update_data['match_js'] = 1;
        if($table=='bet_match'){
            $update_data['match_sbjs'] = 1;
        }       
  
        $sql = $db->table($table)->where('match_id','in',$mid)->update($update_data);

        sys_log(session('adminid'),"批量审核了".$this->ball_name($table)."赛事".$mid."注单");
        
        //return $this->success('本次结算完成!',$this->back_page($table));
        return Alert('本次结算完成!',$this->back_page($table));
    }

    /**设为无效之注单列表,注单列表和结算全场的注单列表相同
     *提交的status=3,mb_inball=-1,tg_inball=-1
     *处理流程和结算全场(do_jiesuan)一样,bet类根据status进行处理;
    */
    public function nullity_list(){

        $param = $this->request->param();
        $mid_array = $param['mid'];       
        $mid        =   implode(",",$mid_array);
        //$table = 'bet_match';
        $table  =   input('type','bet_match');

        //单式 半场与全场区别在point_column字段
        $point_columns = ['match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl'];
                
        $list = Db::table('k_bet')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')
        ->where('b.lose_ok',1)  
        ->where('b.status',0)  
        ->where('b.match_id','IN',$mid_array)
        //->where('b.point_column',['IN',$point_columns],['like','match_hr_bd%'],'OR')
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();
 
        //串关 半场与全场区别在ball_sort和bet_info
        $list_cg = Db::table('k_bet_cg')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')       
        ->where('b.status',0)  
        ->where('b.match_id','IN',$mid_array)
        /*
        ->where(function($query){
            $query->where('b.ball_sort','like','%上半场%')
                  ->whereOr('b.bet_info','like','%上半场%');
        })
        */
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();

        $save = "1";
        $color = "";

        $all_bet_money = 0;
        $all_win = 0;

        $list2 = collection([]);
        foreach ($list as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $list2[] = $rows;

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        $list2_cg = collection([]);
        foreach ($list_cg as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $list2_cg[] = $rows;

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        $this->assign('mid',$mid);
        $this->assign('list2',$list2);
        $this->assign('list2_cg',$list2_cg);
        $this->assign('all_bet_money',$all_bet_money);
        $this->assign('all_win',$all_win);
    
        //设为无效 和 结算全场 模板有区别;
        return $this->fetch();    
    }
    
    /*
    *已结算 之 查看未结算注单 = 未结算 之 查看全场注单
    *已结算 之 重新结算
    */
    public function re_jiesuan_list(){

        //$mid_array =   input("mid");
        //$mid_array = $this->request->param('mid');
        $param = $this->request->param();
        $mid_array = $param['mid'];       
        $mid        =   implode(",",$mid_array);

        //$db = Db::connect(config('sportdb'));
        
        //单式
        $point_columns = ['match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl'];

        //待重结算的全场注单,状态必须 不等于 0,6,7
        $list = Db::table('k_bet')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')
        ->where('b.lose_ok',1)  
        ->where('b.status','not in',[0,6,7])  
        ->where('b.match_id','IN',$mid_array)
        //->where('b.point_column',['IN',$point_columns],['like','match_hr_bd%'],'OR')
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();
        
        //可重结算的 全场串关 注单,status必须<>0
        $list_cg = Db::table('k_bet_cg')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')       
        ->join('k_bet_cg_group g','b.gid = g.gid','LEFT') 
        ->where('b.status','<>',0)  
        ->where('b.match_id','IN',$mid_array)
        /*
        ->where(function($query){
            $query->where('b.ball_sort','like','%上半场%')
                  ->whereOr('b.bet_info','like','%上半场%');
        })
        */
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username,g.win,g.www')->select();

        $save = "1";
        $color = "";

        $all_bet_money = 0;
        $all_win = 0;

 
        foreach ($list as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        foreach ($list_cg as $rows) {
            if($rows["MB_Inball"]=="" || $rows["TG_Inball"]==""){ //有一场未结算
                $save = "0";
                $color = "style=\"color:#FF0000;\"";
            }

            $all_bet_money += $rows["bet_money"];
            $all_win += $rows['win'];
        }

        $this->assign('mid',$mid);
        $this->assign('list',$list);
        $this->assign('list_cg',$list_cg);
        $this->assign('all_bet_money',$all_bet_money);
        $this->assign('all_win',$all_win);

        return $this->fetch();        
    }
    
    /*
    *已结算 之 重新结算全场
     */
    public function do_re_jiesuan(){
        $param = $this->request->param();
        //$php    =   $_GET['php'] ? $_GET['php'] : 'ZuQiu';
        $table  =   input('type','bet_match');
      
        //php参数指定的回跳地址可以由type参数(表名)来确定

        $mid = $param['match_id'];       

        //单式结算开始
        if(isset($_POST["bid"])&&count($_POST['bid'])>0){
            foreach($_POST['bid'] as $i=>$bid){
                bet::qx_bet($bid,$_POST['status'][$i]);
            }
        }

        //串关结算开始
        if(isset($_POST["bid_cg"])&&count($_POST['bid_cg'])>0){
            foreach($_POST['bid_cg'] as $i=>$bid){
                bet::qx_cgbet($bid);
            }
        }        

        $db = Db::connect(config('sportdb'));        
        $update_data['match_js'] = 0;
        if($table=='bet_match'){
            $update_data['match_sbjs'] = 0;
        }        
        $sql = $db->table($table)->where('match_id','in',$mid)->update($update_data);

        sys_log(session('adminid'),"重新结算了".$this->ball_name($table)."全场赛事".$mid."注单");

        return Alert('本次重新结算结算完成!',$this->back_page($table));
    }

    public function zuqiu_score(){
        $param = $this->request->param();
        $mid_array = $param['mid'];       
        $mid       =   $param["mid"][0];
        
        $table  =   input('type','bet_match');
        $db = Db::connect(config('sportdb'));
        $m = $db->table($table)->where('Match_ID',$mid)
        ->field('Match_Date,Match_Time,match_name,Match_Master,Match_Guest, MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR')->find();

        $this->assign('mid',$mid);
        $this->assign('m',$m);
        
        return $this->fetch();                           
    }
    
    public function do_zuqiu_score(){
        
        $param = $this->request->param();    
        $mid       =   $param["mid"];            
        //$table  =   input('type','bet_match');
        
        $sportdb = Db::connect(config('sportdb'));
        
        if($mid){
                $MB_Inball_HR	=	$param["MB_Inball_HR"];
                $TG_Inball_HR	=	$param["TG_Inball_HR"];
                $MB_Inball		=	$param["MB_Inball"];
                $TG_Inball		=	$param["TG_Inball"];
                
                if($MB_Inball_HR=="" || $TG_Inball_HR==""){ //判断是否保存上半场
                        Alert("请输入正确的上半场比分！");
                }
                
                $match_name     =	$param["hf_match_name"];
                $Match_Master   =	$param["hf_Match_Master"];
                $Match_Guest    =	$param["hf_Match_Guest"];
                $Match_Date     =	$param["hf_Match_Date"];
        
                $sql			=	"select Match_ID from bet_match where match_name='$match_name' and Match_Master='$Match_Master' and Match_Guest='$Match_Guest' and Match_Date like ('%".$Match_Date."%')";
                $result = $sportdb->query($sql);
 
                $mid			=	"";
                foreach($result as $rows){
                        $mid .= $rows["Match_ID"].",";
                }
                $mid   			=	rtrim($mid,",");
                $value			=	"";
                if($MB_Inball!="" && $TG_Inball!=""){ //保存全场
                        $sql		=	"update bet_match set mb_inball='$MB_Inball',tg_inball='$TG_Inball',mb_inball_hr='$MB_Inball_HR',tg_inball_hr='$TG_Inball_HR' where match_id in($mid)";
                        $sportdb->execute($sql);
                        
                        //保存所有全场单式注单比分
                        $sql		=	"select bid,point_column from k_bet where lose_ok=1 and status=0 and match_id in($mid) order by bid desc ";        
                        $result             =       Db::query($sql);
                        $bid   		=	"";
                        $bid_sb		=	"";
                        $arr_sb		=	array("match_bmdy","match_bgdy","match_bhdy","match_bho","match_bao","match_bdpl","match_bxpl");
                        foreach($result as $rows){
                            if(in_array(strtolower($rows["point_column"]),$arr_sb) || strpos(strtolower($rows["point_column"]),"match_hr_bd")){ //上半场
                                        $bid_sb	.=	$rows["bid"].",";
                                }else{ //全场
                                        $bid	.=	$rows["bid"].",";
                                }
                        }
                        if($bid != ""){ //全场
                                $bid	=	rtrim($bid,",");
                                $sql	=	"update k_bet set MB_Inball='$MB_Inball',TG_Inball='$TG_Inball' where bid in($bid)";
                                Db::execute($sql);
                        }
                        if($bid_sb != ""){ //上半场
                                $bid_sb	=	rtrim($bid_sb,",");
                                $sql    =	"update k_bet set MB_Inball='$MB_Inball_HR',TG_Inball='$TG_Inball_HR' where bid in($bid_sb)";
                                Db::execute($sql);
                        }
                        
                        //保存所上半场有串关注单比分
                        $sql		=	"select bid,ball_sort,bet_info from k_bet_cg where status=0 and match_id in($mid) order by bid desc";
                        $result_cg          =       Db::query($sql);//串关
                        $bid		=	"";
                        $bid_sb		=	rtrim($bid,",");
                        
                        foreach($result_cg as $rows){
                            if(strpos($rows["ball_sort"],"上半场") || strpos($rows["bet_info"],"上半场")){
                                        $bid_sb .=	$rows["bid"].",";
                                }else{
                                        $bid 	.=	$rows["bid"].",";
                                }
                        }
                        if($bid_sb != ""){
                                $bid_sb =	rtrim($bid_sb,",");
                                $sql    =	"update k_bet_cg set mb_inball='$MB_Inball_HR',tg_inball='$TG_Inball_HR' where bid in($bid_sb)";
                                Db::execute($sql);
                        }
                        if($bid != ""){
                                $bid	=	rtrim($bid,",");
                                $sql	=	"update k_bet_cg set mb_inball='$MB_Inball',tg_inball='$TG_Inball' where bid in($bid)";
                                Db::execute($sql);
                        }
                        
                        $value		=	"保存全场";
                 }else{ //保存上半场 
                        $sql		=	"update bet_match set mb_inball_hr='$MB_Inball_HR',tg_inball_hr='$TG_Inball_HR' where match_id in($mid)";
                        $sportdb->execute($sql);
                        
                        //保存所有上半场单式注单比分
                        $bid		=	"";
                        $sql		=	"select bid from k_bet where lose_ok=1 and (point_column in ('match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl') or point_column like 'match_hr_bd%') and status=0 and match_id in($mid) order by bid desc"; //单式
                        $result		=	Db::query($sql);                            
                        foreach($result as $rows){
                                $bid .= $rows["bid"].",";
                        }
                        $bid		=	rtrim($bid,",");
                        if($bid != ""){
                                $sql	=	"update k_bet set MB_Inball='$MB_Inball_HR',TG_Inball='$TG_Inball_HR' where bid in($bid)";
                                Db::execute($sql);
                        }
                        
                        //保存所上半场有串关注单比分
                        $sql		=	"select bid from k_bet_cg where status=0 and match_id in($mid) and (ball_sort like('%上半场%') or bet_info like('%上半场%')) order by bid desc";
                        $result_cg	        =	Db::query($sql); //串关
                        $bid		=	"";                            
                        foreach($result_cg as $rows){
                                $bid .=	$rows["bid"].",";
                        }
                        if($bid != ""){
                                $bid	=	rtrim($bid,",");
                                $sql	=	"update k_bet_cg set mb_inball='$MB_Inball_HR',tg_inball='$TG_Inball_HR' where bid in($bid)";
                                Db::execute($sql);
                        }
          
                        $value	=	"保存上半场";
                 }
                 
                 Alert($value."成功！",url('sports/zuqiu'));
        }
    }
    
    
    public function lanqiu_score(){
        $param = $this->request->param();
        $mid_array = $param['mid'];       
        $mid       =   $param["mid"][0];
        
        $table  =   input('type','lq_match');
        $db = Db::connect(config('sportdb'));
        $rows = $db->table($table)->where('Match_ID',$mid)
        ->field('Match_Master,Match_Guest,Match_Name,MB_Inball_OK,TG_Inball_OK,Match_Date')->find();

        $this->assign('mid',$mid);
        $this->assign('rows',$rows);
        
        return $this->fetch();                           
    }
    
    
    public function do_lanqiu_score(){
        
        $param = $this->request->param();    
        $mid       =   $param["mid"];            
        //$table  =   input('type','bet_match');
        
        $sportdb = Db::connect(config('sportdb'));
        	
	$MB				=	$param['MB_Inball_OK'];
	$TG				=	$param['TG_Inball_OK'];
	 
	$sql			=	"select Match_Master,match_name,Match_Guest from lq_match where Match_ID=$mid limit 1";
	$result                 = $sportdb->query($sql);
	$rows			=   $result[0];
	
	$match_name		=	$rows["match_name"];
	$Match_Master	        =	$rows["Match_Master"];
	$Match_Guest	        =	$rows["Match_Guest"];
	$Match_Date		=	$param["date"];
	
	$sql			=	"select Match_ID from lq_match where match_name='$match_name' and Match_Master='$Match_Master' and Match_Guest='$Match_Guest' and Match_Date='".$Match_Date."'";
	$result                 =       $sportdb->query($sql);
	$mid			=	"";	
        foreach($result as $rows){
		$mid .= $rows["Match_ID"].",";
	}
	$mid			=	rtrim($mid,",");
	$value			=	"";
	if($MB!="" && $TG!=""){ //保存
		
		$mb_inball	=	'MB_Inball'; //默认全场
		$tg_inball	=	'TG_Inball'; //默认全场
		$preg1		=	"/第[1-4]節/";
		if(strpos($Match_Master,'上半') && strpos($Match_Guest,'上半')){
			$mb_inball		=	'MB_Inball_HR'; //上半场
			$tg_inball		=	'TG_Inball_HR'; //上半场
		}elseif(preg_match($preg1,$Match_Master,$num) && preg_match($preg1,$Match_Guest,$num)){
			if(strpos($num[0],'1')){
				$mb_inball	=	'MB_Inball_1st'; //第1节
				$tg_inball	=	'TG_Inball_1st'; //第1节
			}elseif(strpos($num[0],'2')){
				$mb_inball	=	'MB_Inball_2st'; //第2节
				$tg_inball	=	'TG_Inball_2st'; //第2节
			}elseif(strpos($num[0],'3')){
				$mb_inball	=	'MB_Inball_3st'; //第3节
				$tg_inball	=	'TG_Inball_3st'; //第3节
			}elseif(strpos($num[0],'4')){
				$mb_inball	=	'MB_Inball_4st'; //第4节
				$tg_inball	=	'TG_Inball_4st'; //第4节
			}
		}elseif(strpos($Match_Master,'下半') && strpos($Match_Guest,'下半')){
			$mb_inball		=	'MB_Inball_ER'; //下半场
			$tg_inball		=	'TG_Inball_ER'; //下半场
		}elseif(strpos($Match_Master,'加時') && strpos($Match_Guest,'加時')){
			$mb_inball		=	'MB_Inball_ADD'; //加时
			$tg_inball		=	'TG_Inball_ADD'; //加时
		}
	
		$sql		=	"update lq_match set $mb_inball='$MB',$tg_inball='$TG',MB_Inball_OK='$MB',TG_Inball_OK='$TG' where match_id in($mid)";
		$sportdb->execute($sql);
		
		//保存所有全场单式注单比分
		$sql		=	"select bid from k_bet where lose_ok=1 and status=0 and match_id in($mid) order by bid desc ";
		$result		=	Db::query($sql); //单式                
		$bid		=	"";
                foreach($result as $rows){
			$bid	.=	$rows["bid"].",";
		}
		if($bid != ""){ //全场
			$bid	=	rtrim($bid,",");
			$sql	=	"update k_bet set MB_Inball='$MB',TG_Inball='$TG' where bid in($bid)";
			Db::execute($sql);
		}
		
		//保存所有全场串关注单比分
		$sql		=	"select bid from k_bet_cg where status=0 and match_id in($mid) order by bid desc";
		$result_cg	=	Db::query($sql); //串关
		$bid		=	"";
                foreach($result_cg as $rows){
			$bid	.=	$rows["bid"].",";
		}
		if($bid != ""){
			$bid	=	rtrim($bid,",");
			$sql	=	"update k_bet_cg set mb_inball='$MB',tg_inball='$TG' where bid in($bid)";
			Db::execute($sql);
		}
	}
	Alert('本次录入完成',url('sports/lanqiu').'?js=1');
    }
            
    
    public function wpb_score(){
        $param = $this->request->param();
        $mid_array = $param['mid'];       
        $mid       =   $param["mid"][0];
        
        $table  =   input('type','tennis_match');
        $db = Db::connect(config('sportdb'));

        $rows = $db->table($table)->where('Match_ID',$mid)
        ->field('Match_Master,Match_Guest,Match_Name,MB_Inball,TG_Inball')->find();

        $this->assign('mid',$mid);
        $this->assign('rows',$rows);
        
        return $this->fetch();                           
    }

    public function do_wpb_score(){
        $param = $this->request->param();    
        $mid       =   $param["mid"];            
        $table  =   input('type','tennis_match');
        
        $sportdb = Db::connect(config('sportdb'));
                
	$mb		=	$param['MB_Inball'];
	$tg		=	$param['TG_Inball'];
	$sql	=	"update $table set MB_Inball='$mb',TG_Inball='$tg' where Match_ID=$mid";
	$sportdb->execute($sql);
	
	//保存所有全场单式注单比分
	$sql		=	"select bid from k_bet where lose_ok=1 and status=0 and match_id=$mid";
	$result		=	Db::query($sql); //单式
	$bid		=	"";
        foreach($result as $rows){
		$bid	.=	$rows["bid"].",";
	}
	if($bid != ""){ //全场
		$bid	=	rtrim($bid,",");
		$sql	=	"update k_bet set MB_Inball='$mb',TG_Inball='$tg' where bid in($bid)";
		Db::execute($sql);
	}

        Alert('本次录入完成',url('sports/tennis').'?js=1');
    }    
    
    
    
    private function get_win($t,$rows){
            switch($t["status"])
            {
                case 1:  $win=($t["ben_add"]+$rows["bet_point"])*$rows["bet_money"];
                break;
                case 2:  $win=0;
                break;
                case 3:  $win=$rows["bet_money"];
                break;
                case 4:  $win=(1+$rows["bet_point"]/2)*$rows["bet_money"]; 
                break;
                case 5:  $win=$rows["bet_money"]/2;
                break;
                case 8:  $win=$rows["bet_money"];
                break;
            } 
            return $win;        
    }

    private function back_page($table){
        static $pages = [];
        $pages['bet_match'] = url('sports/zuqiu');
        $pages['lq_match'] = url('sports/lanqiu');
        $pages['tennis_match'] = url('sports/tennis');
        $pages['volleyball_match'] = url('sports/volleyball');
        $pages['baseball_match'] = url('sports/baseball');
        return $pages[$table];
    }

    private function ball_name($table){
        static $names = [];
        $names['bet_match'] = '足球';
        $names['lq_match'] = '篮球';
        $names['tennis_match'] = '网球';
        $names['volleyball_match'] = '排球';
        $names['baseball_match'] = '棒球';
        return $names[$table];
    }    
}