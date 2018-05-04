<?php
namespace app\logic;
use think\Db;
use think\Config;
class baseball_match{
    static function getmatch_name($sqlwhere){
    
        global $mysqlis;
        $arr	=	array();
        $sql	=	"select match_name from baseball_match ".$sqlwhere." group by match_name";
        $rs = Db::connect(Config::get('sportdb'))->query($sql);
        foreach($rs as $v){
            $arr[] = $v['match_name'];
        }
        return $arr;
    }
    
    static function getmatch_info($match_id,$point_column="match_name"){
    
        global $mysqlis;
        $sql	=	"select match_name,match_master,match_time,match_date,match_showtype,Match_CoverDate,match_guest,match_type,match_rgg,match_dxgg,$point_column from baseball_match where match_id=$match_id limit 1";
        $row = Db::connect(Config::get('sportdb')) -> query($sql)[0];
        return $row;
    }
    
}