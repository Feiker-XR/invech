<?php
namespace app\logic;

class jinrong
{

    static function getmatch_name($sqlwhere)
    {
        $arr = array();
        $sql = "select x_title as match_name from t_guanjun " . $sqlwhere . " group by x_title";
        $rs = Db::connect(Config::get('sportdb'))->query($sql);
        foreach ($rs as $v) {
            $arr[] = $v['match_name'];
        }
        return $arr;
    }

    static function getmatch_info($tid)
    {
        $sql	=	"select tt.team_name,tg.Match_CoverDate,tg.match_date,tg.x_title,tt.point,tg.match_name from t_guanjun_team tt,t_guanjun tg where tt.xid=tg.x_id and tt.tid=$tid limit 1";
        $rs = DB::connect(Config::get('sportdb'))->query($sql);
        return $rs[0];
    }
}
