<?php
namespace app\index\controller;

use think\Db;
use app\index\Base;

class result extends Base
{

    /**
     * 棒球
     * @return mixed
     */
    public function baseball()
    {
        date_default_timezone_set('Etc/GMT+4');
        $date = date('Y-m-d', time());
        if (isset($_GET['ymd']))
            $date = $_GET['ymd'];
        //$sql = "select Match_Date,Match_Time,match_name,match_master,match_guest,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR from baseball_match where MB_Inball is not null and  match_Date='" . date('m-d', strtotime($date)) . "' and match_js=1"; //
        $db = Db::connect(config('sportdb'));
        $rows = $db->table('baseball_match')->where('MB_Inball', 'not null')
            ->where('match_Date', '=', date('m-d', strtotime($date)))
            ->where('match_js', '=', '1')
            ->field([
                'Match_Date',
                'Match_Time',
                'match_name',
                'match_master',
                'match_guest',
                'MB_Inball',
                'TG_Inball',
                'MB_Inball_HR',
                'TG_Inball_HR',
            ])->find();
        $this->assign('temp_match_name','');
        $this->assign('rows',$rows);
        $this->assign('date',$date);
        return $this->fetch('baseball');
    }

    public function basketball()
    {
        date_default_timezone_set('Etc/GMT+4');
        $date = date('Y-m-d', time());
        if (isset($_GET['ymd']))
            $date = $_GET['ymd'];
        $db = Db::connect(config('sportdb'));
        $rows = $db->table('lq_match')->where('MB_Inball_OK', 'not null')
        ->where('match_Date', '=', date('m-d', strtotime($date)))
        ->where('match_js', '=', '1')->order('match_coverdate,match_id asc')
        ->field([
            'Match_Date',
            'Match_Time',
            'match_name',
            'match_master',
            'match_guest',
            'MB_Inball_1st',
            'TG_Inball_1st',
            'MB_Inball_2st',
            'TG_Inball_2st',
            'MB_Inball_3st',
            'TG_Inball_3st',
            'MB_Inball_4st',
            'TG_Inball_4st',
            'MB_Inball_HR',
            'TG_Inball_HR',
            'MB_Inball_ER',
            'TG_Inball_ER',
            'MB_Inball',
            'TG_Inball',
            'MB_Inball_Add',
            'TG_Inball_Add',
        ])->select();
        $this->assign('temp_match_name','');
        $this->assign('rows',$rows);
        $this->assign('date',$date);
        return $this->fetch('basketball');
    }

    public function champion()
    {
        date_default_timezone_set('Etc/GMT+4');
        $date = date('Y-m-d', time());
        if (isset($_GET['ymd']))
            $date = $_GET['ymd'];
        $this->assign('date',$date);
        return $this->fetch('champion');
        
    }
    
    public function champion_data(){
        date_default_timezone_set('Etc/GMT+4');
        $callback=isset($_GET['callback']) ? $_GET['callback'] : '';
        $bk			=	500;
        $p_page		=	"";
        $sqlwhere	=	"";
        $dstart		=	date("Y-m-d")." 00:00:00";
        $dend		=	date("Y-m-d")." 23:59:59";
        $db = Db::connect(config('sportdb'));
        $leaguename = isset($_GET['leaguename']) ? $_GET['leaguename'] : '';
        if($leaguename != ''){
            $dstart	=	$leaguename." 00:00:00";
            $dend	=	$leaguename." 23:59:59";
            $json["timename"]	=	$leaguename;
            
            if($leaguename < date("Y-m-d")){
                $json["tday"][0]=	date("Y-m-d",strtotime($leaguename)-86400);
                $json["tday"][1]=	date("Y-m-d",strtotime($leaguename)+86400);
            }else{
                $json["leaguename"] = date("Y-m-d",time()-86400);
                $json["tday"][0]=	"no";
            }
        }
        $rs = $db->table('t_guanjun')->where('match_type','=',1)->where('x_result','<>','')
        -> where('match_coverdate','>=',$dstart)->where('match_coverdate','<=',$dend)
        ->group('match_name')->field(['x_id','x_title'])->select();
        $count_num = count($rs);
        $i = 1;
        while($i <= $count_num){
            $p_page ++ ;
            $i += $bk;
        }
        if($count_num == 0){
            $json["fy"]["p_page"] = 0;
        }else{
            $json["fy"]["p_page"] = $p_page;
            foreach($rs as $t){
                $x	.=	$t["x_title"]."$".urlencode($t["x_title"])."|";
            }
            $json['dh'] = $x;
            $sql		=	"SELECT tg.*,GROUP_CONCAT(tt.tid order by tid) as tid,GROUP_CONCAT(tt.team_name order by tid) as team_name,GROUP_CONCAT(tt.point order by tid) as point,GROUP_CONCAT(tt.match_id order by tid) as mid FROM t_guanjun tg,t_guanjun_team tt";
            $sqlwhere	=	" where tg.match_type=1 and tg.x_id=tt.xid and tg.x_result <>'' ";
            $sqlorder	=	" group by tg.match_name order by tg.match_coverdate,tg.match_name,tg.x_id";
            if($leaguename <> ""){
                $dstart	=	$leaguename." 00:00:00";
                $dend	=	$leaguename." 23:59:59";
            }
            $sqlwhere	.=	" and (tg.match_coverdate >='".@$dstart."' and tg.match_coverdate <='".@$dend."')";
            $sql		 =	$sql.$sqlwhere.$sqlorder;
            //获取记录总数
            $pre_count 	=	$bk;
            $CurrPage = isset($_GET['CurrPage']) ? $_GET['CurrPage'] : 0; 
            intval($CurrPage)>0 ? $this_page=$CurrPage : $this_page=0;
            intval($CurrPage)>0 ? $json["fy"]["page"] = $CurrPage : $json["fy"]["page"] = 0;
            $sql		.=	" limit ".$this_page*$pre_count.",".$pre_count."";
            $rs 		 =	$db->query($sql);
            $i			 =	0;
            foreach ($rs as $rows){
                $json["db"][$i]["Match_ID"]				=	$rows["match_id"];     ///////////  0
                $json["db"][$i]["x_title"]				=	$rows["x_title"];     ///////////   1
                $json["db"][$i]["x_id"]					=	$rows["x_id"];
                $json["db"][$i]["Match_Name"]			=	$rows["match_name"];     ///////////     3
                $json["db"][$i]["Match_Date"]			=	$rows["match_date"]."<br>".$rows["match_time"];
                $json["db"][$i]["x_result"]				=	$rows["x_result"];
                $json["db"][$i]["team_name"]			=	$rows["team_name"];     ///////////     5
                $json["db"][$i]["tid"]					=	$rows["tid"];
                $i++;
            }
        }
        echo $callback."(".json_encode($json).");";
    }

    public function football()
    {
        date_default_timezone_set('Etc/GMT+4');
        $date = date('Y-m-d', time());
        if (isset($_GET['ymd']))
            $date = $_GET['ymd'];
        $db = Db::connect(config('sportdb'));
        $rows = $db->table('bet_match')->where('ISNULL(`MB_Inball`) = 0 or ISNULL(`MB_Inball_HR`) = 0 ')
        ->where('match_sbjs = 1 or match_js = 1')
        ->where('match_Date', '=', date('m-d', strtotime($date)))
        ->order('Match_CoverDate,iPage,iSn,Match_ID,match_name,Match_Master')
        ->field([
            'Match_MatchTime',
            'Match_Type',
            'match_name',
            'match_master',
            'match_guest',
            'MB_Inball',
            'TG_Inball',
            'MB_Inball_HR',
            'TG_Inball_HR',
        ])->select();
        $this->assign('temp_match_name','');
        $this->assign('rows',$rows);
        $this->assign('date',$date);
        return $this->fetch('football');
    }

    public function tennis()
    {
        date_default_timezone_set('Etc/GMT+4');
        $date = date('Y-m-d', time());
        if (isset($_GET['ymd']))
            $date = $_GET['ymd'];
        $db = Db::connect(config('sportdb'));
        $rows = $db->table('bet_match')->where('ISNULL(`MB_Inball`) = 0 or ISNULL(`MB_Inball_HR`) = 0 ')
        ->where('match_sbjs = 1 or match_js = 1')
        ->where('match_Date', '=', date('m-d', strtotime($date)))
        ->order('Match_CoverDate,iPage,iSn,Match_ID,match_name,Match_Master')
        ->field([
            'Match_Date',
            'Match_Time',
            'match_name',
            'match_master',
            'match_guest',
            'MB_Inball',
            'TG_Inball',
        ])->select();
        $this->assign('temp_match_name','');
        $this->assign('rows',$rows);
        $this->assign('date',$date);
        return $this->fetch('tennis');
        
    }
    
    

    public function volleyball()
    {
        date_default_timezone_set('Etc/GMT+4');
        $date = date('Y-m-d', time());
        if (isset($_GET['ymd']))
            $date = $_GET['ymd'];
        $db = Db::connect(config('sportdb'));
        $rows = $db->table('bet_match')->where('ISNULL(`MB_Inball`) = 0 or ISNULL(`MB_Inball_HR`) = 0 ')
        ->where('match_sbjs = 1 or match_js = 1')
        ->where('match_Date', '=', date('m-d', strtotime($date)))
        ->order('Match_CoverDate,iPage,iSn,Match_ID,match_name,Match_Master')
        ->field([
            'Match_Date',
            'Match_Time',
            'match_name',
            'match_master',
            'match_guest',
            'MB_Inball',
            'TG_Inball',
        ])->select();
        $this->assign('temp_match_name','');
        $this->assign('rows',$rows);
        $this->assign('date',$date);
        return $this->fetch('volleyball');
    }
}
