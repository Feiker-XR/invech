<?php
function cal(){
    
    //开始结算特码
    if($rows['mingxi_1']=='特码' || $rows['mingxi_1']=='特肖'){
        $dx		= jsauto::Six_DaXiao($rs['ball_7']);
        $ds		= jsauto::Six_DanShuang($rs['ball_7']);
        $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_7']);
        $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_7']);
        $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_7']);
        $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_7']);
        $bs		= jsauto::Six_Bose($rs['ball_7']);
        $sx		= jsauto::Get_ShengXiao($rs['ball_7']);
        if($rs['ball_7']==49){
            if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                return true;
                
            }else if($rows['mingxi_2']==$rs['ball_7']|| $rows['mingxi_2'] == $sx){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }else if($rows['mingxi_2']==$rs['ball_7'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    
    //开始结算正一
    if($rows['mingxi_1']=='正一'){
        $dx		= jsauto::Six_DaXiao($rs['ball_1']);
        $ds		= jsauto::Six_DanShuang($rs['ball_1']);
        $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_1']);
        $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_1']);
        $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_1']);
        $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_1']);
        $bs		= jsauto::Six_Bose($rs['ball_1']);
        $sx		= jsauto::Get_ShengXiao($rs['ball_1']);
        if($rs['ball_1']==49){
            if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                return true;
            }else if($rows['mingxi_2']==$rs['ball_1']){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
                
            }
        }else if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    
    //开始结算正二
    if($rows['mingxi_1']=='正二'){
        $dx		= jsauto::Six_DaXiao($rs['ball_2']);
        $ds		= jsauto::Six_DanShuang($rs['ball_2']);
        $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_2']);
        $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_2']);
        $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_2']);
        $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_2']);
        $bs		= jsauto::Six_Bose($rs['ball_2']);
        $sx		= jsauto::Get_ShengXiao($rs['ball_2']);
        if($rs['ball_2']==49){
            if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                return true;
            }else if($rows['mingxi_2']==$rs['ball_2']){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
                
            }
        }else if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    
    //开始结算正三
    if($rows['mingxi_1']=='正三'){
        $dx		= jsauto::Six_DaXiao($rs['ball_3']);
        $ds		= jsauto::Six_DanShuang($rs['ball_3']);
        $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_3']);
        $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_3']);
        $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_3']);
        $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_3']);
        $bs		= jsauto::Six_Bose($rs['ball_3']);
        $sx		= jsauto::Get_ShengXiao($rs['ball_3']);
        if($rs['ball_3']==49){
            if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                return true;
            }else if($rows['mingxi_2']==$rs['ball_3']){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
                
            }
        }else if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    //开始结算正四
    if($rows['mingxi_1']=='正四'){
        $dx		= jsauto::Six_DaXiao($rs['ball_4']);
        $ds		= jsauto::Six_DanShuang($rs['ball_4']);
        $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_4']);
        $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_4']);
        $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_4']);
        $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_4']);
        $bs		= jsauto::Six_Bose($rs['ball_4']);
        $sx		= jsauto::Get_ShengXiao($rs['ball_4']);
        if($rs['ball_4']==49){
            if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                return true;
            }else if($rows['mingxi_2']==$rs['ball_4']){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
                Db::query($msql);
                
            }
        }else if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    //开始结算正五
    if($rows['mingxi_1']=='正五'){
        $dx		= jsauto::Six_DaXiao($rs['ball_5']);
        $ds		= jsauto::Six_DanShuang($rs['ball_5']);
        $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_5']);
        $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_5']);
        $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_5']);
        $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_5']);
        $bs		= jsauto::Six_Bose($rs['ball_5']);
        $sx		= jsauto::Get_ShengXiao($rs['ball_5']);
        if($rs['ball_5']==49){
            if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                return true;
            }else if($rows['mingxi_2']==$rs['ball_5']){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
                Db::query($msql);
                
            }
        }else if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    //开始结算正六
    if($rows['mingxi_1']=='正六'){
        $dx		= jsauto::Six_DaXiao($rs['ball_6']);
        $ds		= jsauto::Six_DanShuang($rs['ball_6']);
        $hsdx	= jsauto::Six_HeShuDaXiao($rs['ball_6']);
        $hsds	= jsauto::Six_HeShuDanShuang($rs['ball_6']);
        $wsdx	= jsauto::Six_WeiShuDaXiao($rs['ball_6']);
        $wsds	= jsauto::Six_WeiShuDanShuang($rs['ball_6']);
        $bs		= jsauto::Six_Bose($rs['ball_6']);
        $sx		= jsauto::Get_ShengXiao($rs['ball_6']);
        if($rs['ball_6']==49){
            if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
                return true;
                
            }else if($rows['mingxi_2']==$rs['ball_6']){
                //如果投注内容等于第一球开奖号码，则视为中奖
                return true;
            }else{
                //注单未中奖，修改注单内容
                $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
                Db::query($msql);
                
            }
        }else if($rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']."  and js = 0";
            Db::query($msql);
        }
    }
    //开始结算正码
    if($rows['mingxi_1']=='正码'){
        $sx1		= jsauto::Get_ShengXiao($rs['ball_1']);
        $sx2		= jsauto::Get_ShengXiao($rs['ball_2']);
        $sx3		= jsauto::Get_ShengXiao($rs['ball_3']);
        $sx4		= jsauto::Get_ShengXiao($rs['ball_4']);
        $sx5		= jsauto::Get_ShengXiao($rs['ball_5']);
        $sx6		= jsauto::Get_ShengXiao($rs['ball_6']);
        if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$sx1 || $rows['mingxi_2']==$sx2 || $rows['mingxi_2']==$sx3 || $rows['mingxi_2']==$sx4 || $rows['mingxi_2']==$sx5 || $rows['mingxi_2']==$sx6){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    //开始结算正码过关
    if($rows['mingxi_1']=='正码过关'){
        $mignxi_2_arr=explode("<hr />",$rows['mingxi_2']);
        $arr_num=count($mignxi_2_arr)-1;
        $win=0;
        for($i=0;$i<$arr_num;$i++){
            $mingxi2_arr=explode("|",$mignxi_2_arr[$i]);
            if(!jsauto::Six_ZhengMaGuoGuang($rs['ball_'.jsauto::Six_ZhengMaToNum($mingxi2_arr[0])],$mingxi2_arr[1])){$win=0;break;}
            else{$win=1;}
        }
        if($win){
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    //开始结算总和
    if($rows['mingxi_1']=='总和'){
        $zhdx = jsauto::Six_ZongHeDaXiao($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
        $zhds = jsauto::Six_ZongHeDanShuang($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
        if($rows['mingxi_2']==$zhdx || $rows['mingxi_2']==$zhds){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    //开始结算一肖
    if($rows['mingxi_1']=='一肖'){
        if($rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_1']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_2']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_3']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_4']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_5']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_6']) || $rows['mingxi_2']==jsauto::Get_ShengXiao($rs['ball_7'])){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    //开始结算尾数
    if($rows['mingxi_1']=='尾数'){
        if($rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_1']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_2']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_3']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_4']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_5']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_6']) || $rows['mingxi_2']==jsauto::Six_WeiShu($rs['ball_7'])){
            //如果投注内容等于第一球开奖号码，则视为中奖
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    //开始结算全中
    if($rows['mingxi_1']=='四全中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        foreach($mingxi2_arr as $val){
            if(intval($val)==intval($rs['ball_1'])){$win++;}
            if(intval($val)==intval($rs['ball_2'])){$win++;}
            if(intval($val)==intval($rs['ball_3'])){$win++;}
            if(intval($val)==intval($rs['ball_4'])){$win++;}
            if(intval($val)==intval($rs['ball_5'])){$win++;}
            if(intval($val)==intval($rs['ball_6'])){$win++;}
        }
        if($win>=4){
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    if($rows['mingxi_1']=='三全中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        foreach($mingxi2_arr as $val){
            if(intval($val)==intval($rs['ball_1'])){$win++;}
            if(intval($val)==intval($rs['ball_2'])){$win++;}
            if(intval($val)==intval($rs['ball_3'])){$win++;}
            if(intval($val)==intval($rs['ball_4'])){$win++;}
            if(intval($val)==intval($rs['ball_5'])){$win++;}
            if(intval($val)==intval($rs['ball_6'])){$win++;}
        }
        if($win>=3){
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            Db::query($msql);
        }
    }
    if($rows['mingxi_1']=='三中二'){
        $zall=105;
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        foreach($mingxi2_arr as $val){
            if(intval($val)==intval($rs['ball_1'])){$win++;}
            if(intval($val)==intval($rs['ball_2'])){$win++;}
            if(intval($val)==intval($rs['ball_3'])){$win++;}
            if(intval($val)==intval($rs['ball_4'])){$win++;}
            if(intval($val)==intval($rs['ball_5'])){$win++;}
            if(intval($val)==intval($rs['ball_6'])){$win++;}
        }
        if($win==2){
            return true;
            
        }elseif($win>2){
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='二全中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        foreach($mingxi2_arr as $val){
            if(intval($val)==intval($rs['ball_1'])){$win++;}
            if(intval($val)==intval($rs['ball_2'])){$win++;}
            if(intval($val)==intval($rs['ball_3'])){$win++;}
            if(intval($val)==intval($rs['ball_4'])){$win++;}
            if(intval($val)==intval($rs['ball_5'])){$win++;}
            if(intval($val)==intval($rs['ball_6'])){$win++;}
        }
        if($win>=2){
            return true;
            
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='二中特'){
        $zall=50;
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=$win2=0;
        foreach($mingxi2_arr as $val){
            if(intval($val)==intval($rs['ball_1'])){$win++;}
            if(intval($val)==intval($rs['ball_2'])){$win++;}
            if(intval($val)==intval($rs['ball_3'])){$win++;}
            if(intval($val)==intval($rs['ball_4'])){$win++;}
            if(intval($val)==intval($rs['ball_5'])){$win++;}
            if(intval($val)==intval($rs['ball_6'])){$win++;}
            if(intval($val)==intval($rs['ball_7'])){$win2++;}
        }
        if($win>=2){
            return true;
            
        }elseif($win2>=1){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='特串'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $win2=0;
        foreach($mingxi2_arr as $val){
            if(intval($val)==intval($rs['ball_7'])){
                $win++;
            }else{
                if(intval($val)==intval($rs['ball_1'])){$win2++;}
                if(intval($val)==intval($rs['ball_2'])){$win2++;}
                if(intval($val)==intval($rs['ball_3'])){$win2++;}
                if(intval($val)==intval($rs['ball_4'])){$win2++;}
                if(intval($val)==intval($rs['ball_5'])){$win2++;}
                if(intval($val)==intval($rs['ball_6'])){$win2++;}
            }
        }
        if($win>=1 && $win2>=1){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='合肖'){
        if($rs['ball_7']==49){
            return true;
        }else{
            $sx		= Get_ShengXiao($rs['ball_7']);
            if(strpos($rows['mingxi_2'],$sx)!==false){
                return true;
            }else{
                //注单未中奖，修改注单内容
                return false;
            }
        }
    }
    //开始结算生肖连
    if($rows['mingxi_1']=='二肖连中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $dis_sx='';
        foreach($mingxi2_arr as $val){
            if($val==jsauto::Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
        }
        if($win>=2){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='三肖连中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $dis_sx='';
        foreach($mingxi2_arr as $val){
            if($val==jsauto::Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
        }
        //echo "<p>======</p>";
        if($win>=3){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='四肖连中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $dis_sx='';
        foreach($mingxi2_arr as $val){
            if($val==jsauto::Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
        }
        if($win>=4){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='五肖连中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $dis_sx='';
        foreach($mingxi2_arr as $val){
            if($val==jsauto::Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
        }
        if($win>=5){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    //开始结算尾数连
    if($rows['mingxi_1']=='二尾连中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $dis_sx='';
        foreach($mingxi2_arr as $val){
            if($val==jsauto::Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
        }
        if($win>=2){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='三尾连中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $dis_sx='';
        foreach($mingxi2_arr as $val){
            if($val==jsauto::Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
        }
        if($win>=3){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='四尾连中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $dis_sx='';
        foreach($mingxi2_arr as $val){
            if($val==jsauto::Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
        }
        if($win>=4){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='五尾连中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        $dis_sx='';
        foreach($mingxi2_arr as $val){
            if($val==jsauto::Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
            if($val==jsauto::Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
        }
        if($win>=5){
            return true;
        }else{
            //注单未中奖，修改注单内容
            return false;
        }
    }
    if($rows['mingxi_1']=='五不中' || $rows['mingxi_1']=='六不中' || $rows['mingxi_1']=='七不中' || $rows['mingxi_1']=='八不中' || $rows['mingxi_1']=='九不中' || $rows['mingxi_1']=='十不中' || $rows['mingxi_1']=='十一不中' || $rows['mingxi_1']=='十二不中'){
        $mingxi2_arr=explode(",",$rows['mingxi_2']);
        $win=0;
        foreach($mingxi2_arr as $val){
            if(intval($val)==intval($rs['ball_1'])){$win++;break;}
            if(intval($val)==intval($rs['ball_2'])){$win++;break;}
            if(intval($val)==intval($rs['ball_3'])){$win++;break;}
            if(intval($val)==intval($rs['ball_4'])){$win++;break;}
            if(intval($val)==intval($rs['ball_5'])){$win++;break;}
            if(intval($val)==intval($rs['ball_6'])){$win++;break;}
            if(intval($val)==intval($rs['ball_7'])){$win++;break;}
        }
        if($win>0){
            //注单未中奖，修改注单内容
            return false;
            
        }else{
            return true;
        }
    }
}