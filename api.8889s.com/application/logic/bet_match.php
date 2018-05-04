<?php
namespace app\logic;
use think\Db;
use app\logic\gqdisplay;
use think\Config;
use think\cache;

class bet_match{
    static function getmatch_name($sqlwhere){

        global $mysqlis;
        $arr	=	array();
        $sql	=	"select match_name from bet_match ".$sqlwhere." group by match_name";    
        $rows = Db::connect(Config::get('sportdb'))->query($sql);
        //$query	=	$mysqlis->query($sql);
        foreach($rows as $rs ){
            $arr[]	=	$rs['match_name'];
        }
        return $arr;
    }

    static function getmatch_info($match_id,$point_column="Match_Name",$ball_sort=""){
        $db = Db::connect(Config::get('sportdb'));
        $point	=	array("match_bho","match_bao","match_bdpl","match_bxpl");
        if($ball_sort != "足球滚球"){
            if(in_array(strtolower($point_column),$point)){ //上半场投注
                $sql	=	"select match_name,match_master,match_guest,match_date,match_time,match_type,Match_CoverDate,Match_NowScore,Match_Hr_ShowType as match_showtype,Match_BRpk as match_rgg,Match_Bdxpk as match_dxgg,Match_HRedCard,Match_GRedCard,$point_column from bet_match where match_id=$match_id limit 1";
            }else{
                $sql	=	"select match_name,match_master,match_guest,match_date,match_time,match_type,Match_CoverDate,Match_NowScore,match_showtype,match_rgg,match_dxgg,Match_HRedCard,Match_GRedCard,$point_column from bet_match where match_id=$match_id limit 1";
            }
            $rs = $db->query($sql)[0];
            return $rs;
        }else{ //足球滚球，取缓存文件来验证即可
            $zqgq = Cache::get('zqgq',[]);
            for($i=0;$i<count($zqgq);$i++){
                if($match_id == $zqgq[$i]['Match_ID']) break;
            }
            $rs							=	array();
            $rs['match_name']			=	$zqgq[$i]['Match_Name'];
            $rs['match_master']			=	$zqgq[$i]['Match_Master'];
            $rs['match_guest']			=	$zqgq[$i]['Match_Guest'];
            $rs['match_date']			=	$zqgq[$i]['Match_Date'];
            $rs['match_time']			=	$zqgq[$i]['Match_Time']=="45.5" ? '中埸' : $zqgq[$i]['Match_Time'];
            $rs['match_type']			=	$zqgq[$i]['Match_Type'];
            $rs['Match_NowScore']		=	$zqgq[$i]['Match_NowScore'];
            $rs['Match_HRedCard']		=	$zqgq[$i]['Match_HRedCard'];
            $rs['Match_GRedCard']		=	$zqgq[$i]['Match_GRedCard'];
            	
            if(in_array(strtolower($point_column),$point)){ //上半场投注
                $rs['match_showtype']	=	$zqgq[$i]['Match_Hr_ShowType'];
                $rs['match_rgg']		=	$zqgq[$i]['Match_BRpk'];
                $rs['match_dxgg']		=	$zqgq[$i]['Match_Bdxpk'];
                $rs[$point_column]		=	$zqgq[$i][$point_column];
            }else{
                $rs['match_showtype']	=	$zqgq[$i]['Match_ShowType'];
                $rs['match_rgg']		=	$zqgq[$i]['Match_RGG'];
                $rs['match_dxgg']		=	$zqgq[$i]['Match_DxGG'];
                $rs[$point_column]		=	$zqgq[$i][$point_column];
            }
            $sql	=	"select Match_CoverDate from bet_match where match_id=$match_id limit 1"; //取开赛时间
            $row = $db->query($sql);
            if($row){
                $row = $row[0];
                $rs['Match_CoverDate']	=	$row['Match_CoverDate'];
            }else{
                $gqdisplay = new gqdisplay('zq');
                $gqdisplay->add($zqgq[$i]);
                exit('查询比赛信息错误,请重新获取比赛信息!');
            }
            if(!$rs['Match_CoverDate']){
                $rs['Match_CoverDate'] = $zqgq[$i]['Match_CoverDate'];
            }
            return $rs;
        }
    }
}