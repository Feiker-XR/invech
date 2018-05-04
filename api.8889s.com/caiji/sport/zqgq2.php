<?php
//足球滚球采集入缓存
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';
msg_log('第'.__LINE__.'行,现在时区'.date_default_timezone_get().'!','info');
//error_reporting(E_ERROR);
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
$base = dirname(__FILE__);
include 'include.php';
msg_log('第'.__LINE__.'行,现在时区'.date_default_timezone_get().'!','info');
include_once($db_path."mysqlis.php");
msg_log('第'.__LINE__.'行,现在时区'.date_default_timezone_get().'!','info');
//include_once($base."/../../runtime/cache/gp_db.php");

$gq_un = data_cache('zqgq_un',[]);
/*
if($gq_un === false){
    //include_once($base."/../../runtime/cache/zqgq_un.php");
    $gq_un = [];
}
*/

$langx='zh-tw';

$data=theif_data2($webdb["datesite"],$webdb["cookie"],'FT','re',$langx,0);
/*
//url page_no=0表示第一页
总页数:                    parent.t_page=1; 
本页数据条数(不准确):        parent.gamount=2;
*/
$show_pages =   1;
msg_log('第'.__LINE__.'行,现在时区'.date_default_timezone_get().'!','info');
msg_log('采集第' . $show_pages .'页html成功!','info');
msg_log('第'.__LINE__.'行,现在时区'.date_default_timezone_get().'!','info');
if(sizeof(explode("gamount",$data))>1){

    preg_match_all("/(Array\(.+\);)/i",$data,$matches);  
    $cou    =    sizeof($matches[0]);    
    msg_log('第' . $show_pages .'页html有'.$cou.'条赛事数据！','info');
    $zqgq = [];
    $time    = date("Y-m-d H:i:s");
    $xb        = 0;
    for($i=0;$i<$cou;$i++){
        $messages		=	$matches[0][$i];
		$messages		=	str_replace("Array(","",$messages);
		$messages		=	str_replace(");","",$messages);
		$messages		=	str_replace("cha(9)","",$messages);
		$messages		=	str_replace("'","",$messages);
		$datainfo= explode(",",$messages);
        if(strpos($datainfo[1],':') || isset($gq_un[$datainfo[0]])){
        //if(in_array($datainfo[0],$gp_db) || strpos($datainfo[1],':') || isset($gq_un[$datainfo[0]])){
            //有关盘的联赛则不开盘，02:15a 有 : 表示未开赛,未开赛不采集
        }else{
            $datainfo[8]    =    str_replace(' ','',$datainfo[8]);
            $datainfo[11]    =    str_replace(' ','',$datainfo[11]);
            $datainfo[22]    =    str_replace(' ','',$datainfo[22]);
            $datainfo[25]    =    str_replace(' ','',$datainfo[25]);
            $datainfo[11]    =    substr($datainfo[11],1,strlen($datainfo[11])-1);
            $datainfo[25]    =    substr($datainfo[25],1,strlen($datainfo[25])-1);
            
            $dx    =    array();
            $dx    =    get_HK_ior($datainfo[9],$datainfo[10]);
            $datainfo[9]    =    $dx[0];
            $datainfo[10]    =    $dx[1];
            $dx    =    get_HK_ior($datainfo[23],$datainfo[24]);
            $datainfo[23]    =    $dx[0];
            $datainfo[24]    =    $dx[1];
            $dx    =    get_HK_ior($datainfo[13],$datainfo[14]);
            $datainfo[13]    =    $dx[0];
            $datainfo[14]    =    $dx[1];
            $dx    =    get_HK_ior($datainfo[27],$datainfo[28]);
            $datainfo[27]    =    $dx[0];
            $datainfo[28]    =    $dx[1];
            
            if(strpos($datainfo[1],'</font>')) $datainfo[1] = '45.5';
	    
            $match['Match_ID'] = $datainfo[0];
            $match['Match_Master'] = $datainfo[5];
            $match['Match_Guest'] = $datainfo[6];
            $match['Match_Name'] = $datainfo[2];
            $match['Match_Time'] = $datainfo[1];
            $match['Match_Ho'] = sprintf("%.2f",$datainfo[9]);
            $match['Match_DxDpl'] = sprintf("%.2f",$datainfo[14]);
            $match['Match_BHo'] = sprintf("%.2f",$datainfo[23]);
            $match['Match_Bdpl'] = sprintf("%.2f",$datainfo[28]);
            $match['Match_Ao'] = sprintf("%.2f",$datainfo[10]);  
            $match['Match_DxXpl'] = sprintf("%.2f",$datainfo[13]);
            $match['Match_BAo'] = sprintf("%.2f",$datainfo[24]);       
            $match['Match_Bxpl'] = sprintf("%.2f",$datainfo[27]); 
            $match['Match_RGG'] =  $datainfo[8];  
            $match['Match_BRpk'] = $datainfo[22];
            $match['Match_ShowType'] = $datainfo[7];    
            $match['Match_Hr_ShowType'] = $datainfo[21];         
            $match['Match_DxGG'] = $datainfo[11];       
            $match['Match_Bdxpk'] = $datainfo[25];          
            $match['Match_HRedCard'] = $datainfo[29];          
            $match['Match_GRedCard'] = $datainfo[30];        
            $match['Match_NowScore'] = $datainfo[18].':'.$datainfo[19];            
            $match['Match_BzM'] = sprintf("%.2f",$datainfo[33]);            
            $match['Match_BzG'] = sprintf("%.2f",$datainfo[34]);          
            $match['Match_BzH'] = sprintf("%.2f",$datainfo[35]);   
            $match['Match_Bmdy'] = sprintf("%.2f",$datainfo[36]);
            $match['Match_Bgdy'] = sprintf("%.2f",$datainfo[37]);
            $match['Match_Bhdy'] = sprintf("%.2f",$datainfo[38]);
            $match['Match_CoverDate'] = $time;
            $match['Match_Date'] = $datainfo[42];  
            $match['Match_Type'] = '2';
    
            $zqgq[] = $match;
            $xb++;
        }
    }
    //计划任务中5秒一次滚球采集
    $ret = data_cache('zqgq',$zqgq,5);//缓存5秒有效
    
    if($ret){
	   msg_log($xb.'条数据放入缓存成功!','info');
    }else{
	   msg_log($xb.'条数据放入缓存失败!','error');
    }    
}else{
    msg_log('第' . $show_pages .'页html没有赛事数据！','info');
}
