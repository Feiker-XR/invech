<?php
//采集篮球滚球信息入缓存,每5秒采集一次
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

//error_reporting(E_ERROR);
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
$base = dirname(__FILE__);
include_once $base.'/include.php';
include_once $db_path.'mysqlis.php';
//include_once($base."/../../runtime/cache/gp_db.php");
//include_once $base.'/../../runtime/cache/lqgq_un.php';
$gq_un = data_cache('lqgq_un',[]);

$langx='zh-cn';

$data=theif_data2($webdb["datesite"],$webdb["cookie"],'BK','re',$langx,0);
$show_pages =   1;
msg_log('采集第' . $show_pages .'页html成功!','info');

if(sizeof(explode("gamount",$data))>1){
 
    preg_match_all("/(Array\(.+\);)/i",$data,$matches);
    $cou=sizeof($matches[0]);
    msg_log('第' . $show_pages .'页html有'.$cou.'条赛事数据！','info');
    $lqgq = [];   
    $time    = date("Y-m-d H:i:s");
    $xb        = 0;
    for($i=0;$i<$cou;$i++){
        $messages		=	$matches[0][$i];
		$messages		=	str_replace("Array(","",$messages);
		$messages		=	str_replace(");","",$messages);
		$messages		=	str_replace("cha(9)","",$messages);
		$messages		=	str_replace("'","",$messages);
		$datainfo= explode(",",$messages);
		
        if(isset($gq_un[$datainfo[0]])){
        //if(in_array($datainfo[0],$gp_db)|| isset($gq_un[$datainfo[0]])){
        //有关盘的联赛则不开盘
        }else{
            $datainfo[5]    =    preg_replace("/<[^>]*>/","",$datainfo[5]);
            $datainfo[6]    =    preg_replace("/<[^>]*>/","",$datainfo[6]);
            $datainfo[8]    =    str_replace(' ','',$datainfo[8]);
            $datainfo[11]    =    str_replace(' ','',$datainfo[11]);
            $datainfo[11]    =    substr($datainfo[11],1,strlen($datainfo[11])-1);
            $datainfo[32]    =    substr($datainfo[32],0,5);
            
            if($datainfo[9]==0.01 || $datainfo[10]==0.01 || $datainfo[8] == '2.5'){ //皇冠测试水位0.01，不显示 2.5测试盘口也不显示
                $datainfo[8]    =    '';
                $datainfo[9]    =    0;
                $datainfo[10]    =    0;
            }
            if($datainfo[13]==0.01 || $datainfo[14]==0.01){ //皇冠测试水位，不显示
                $datainfo[11]    =    '';
                $datainfo[13]    =    0;
                $datainfo[14]    =    0;
            }

            $match['Match_ID'] = $datainfo[0];
            $match['Match_Master'] = $datainfo[5];
            $match['Match_Guest'] = $datainfo[6];
            $match['Match_Name'] = $datainfo[2];
            $match['Match_Time'] = $datainfo[1];
            $match['Match_Ho'] = sprintf("%.2f",$datainfo[9]);
            $match['Match_DxDpl'] = sprintf("%.2f",$datainfo[14]);
            $match['Match_DsDpl'] = $datainfo[18];
            $match['Match_Ao'] = sprintf("%.2f",$datainfo[10]);  
            $match['Match_DxXpl'] = sprintf("%.2f",$datainfo[13]);
            $match['Match_DsXpl'] = $datainfo[19];    
            $match['Match_RGG'] = $datainfo[8];
            $match['Match_ShowType'] = $datainfo[7];
            $match['Match_DxGG'] = $datainfo[11];
            $match['Match_CoverDate'] = $time;      
            $match['Match_Date'] = $datainfo[32];        
            $match['Match_Type'] = 2;  

            $lqgq[] = $match;
            $xb++;
        }
    }
    //计划任务中5秒一次滚球采集
    $ret = data_cache('lqgq',$lqgq,5);//缓存5秒有效
    if($ret){
       msg_log($xb.'条数据放入缓存成功!','info');
    }else{
       msg_log($xb.'条数据放入缓存失败!','error');
    }
}else{
    msg_log('第' . $show_pages .'页html没有赛事数据！','info');
}