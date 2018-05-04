<?php
namespace app\logic;
use think\Db;
use think\Config;
use app\logic\gqdisplay;
class lq_match{
    
    static function getmatch_name($sqlwhere){
        $arr	=	array();
        $sql	=	"select match_name from lq_match ".$sqlwhere." group by match_name";
        $rs = Db::connect(Config::get('sportdb'))->query($sql);
        foreach($rs as $v){
            $arr[] = $v['match_name'];
        }
        return $arr;
    }
    
    static function getmatch_info($match_id,$point_column="Match_Name",$ball_sort=""){
        global $mysqlis;
        if($ball_sort != "篮球滚球"){
            $sql	=	"select match_name,match_master,match_time,match_date,Match_CoverDate,match_guest,Match_NowScore,match_showtype,match_type,match_rgg,match_dxgg,$point_column from lq_match where match_id=$match_id limit 1";
            $rs = Db::connect(Config::get('sportdb'))->query($sql)[0];
            return $rs;
        }else{
            include_once( CACHE_PATH."lqgq.php");
            $lqgq = cache('lqgq');
            for($i=0;$i<count($lqgq);$i++){
                if($match_id == $lqgq[$i]['Match_ID']) break;
            }
            $rs						=	array();
            $rs['match_name']		=	$lqgq[$i]['Match_Name'];
            $rs['match_master']		=	$lqgq[$i]['Match_Master'];
            $rs['match_time']		=	$lqgq[$i]['Match_Time'];
            $rs['match_guest']		=	$lqgq[$i]['Match_Guest'];
            $rs['Match_NowScore']	=	isset($lqgq[$i]['Match_NowScore']) ?  $lqgq[$i]['Match_NowScore'] : '';
            $rs['match_showtype']	=	$lqgq[$i]['Match_ShowType'];
            $rs['match_type']		=	$lqgq[$i]['Match_Type'];
            $rs['match_rgg']		=	$lqgq[$i]['Match_RGG'];
            $rs['match_dxgg']		=	$lqgq[$i]['Match_DxGG'];
            $rs[$point_column]		=	round($lqgq[$i][$point_column],2);
            	
            $sql	=	"select Match_CoverDate from lq_match where match_id=$match_id limit 1"; //取开赛时间
            $row = Db::connect(Config::get('sportdb')) -> query($sql);
            if($row){
                $row = $row[0];
                $rs['Match_CoverDate']	=	$row['Match_CoverDate'] ;
            }else{
                $gqdisplay = new gqdisplay('lq');
                $gqdisplay->add($lqgq[$i]);
                exit('查询比赛信息错误,请重新获取比赛信息!');
            }
            try{
                if(!$rs['Match_CoverDate']){
                    $rs['Match_CoverDate'] = $lqgq[$i]['Match_CoverDate'];
                }
            }catch(exception $e){
                echo $e->getMessage();
            }
            return $rs;
        }
    }
}