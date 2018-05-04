<?php
class cpzj {
    /**
     * 重庆时时彩中奖判断
     * @param array $rs 开奖号码
     * @param array $rows 投注号码
     * @return boolean true 为中奖 false 为未中奖 
     * 
     */
    public static function cqssc($rs,$rows){
        $hm = array();
        $hm[] = $rs['ball_1'];
        $hm[] = $rs['ball_2'];
        $hm[] = $rs['ball_3'];
        $hm[] = $rs['ball_4'];
        $hm[] = $rs['ball_5'];
        // 开始结算第一球
        if ($rows['mingxi_1'] == '第一球') {
            $ds = Ssc_Ds($rs['ball_1']);
            $dx = Ssc_Dx($rs['ball_1']);
            if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第二球
        if ($rows['mingxi_1'] == '第二球') {
            $ds = Ssc_Ds($rs['ball_2']);
            $dx = Ssc_Dx($rs['ball_2']);
            if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第三球
        if ($rows['mingxi_1'] == '第三球') {
            $ds = Ssc_Ds($rs['ball_3']);
            $dx = Ssc_Dx($rs['ball_3']);
            if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第四球
        if ($rows['mingxi_1'] == '第四球') {
            $ds = Ssc_Ds($rs['ball_4']);
            $dx = Ssc_Dx($rs['ball_4']);
            if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第五球
        if ($rows['mingxi_1'] == '第五球') {
            $ds = Ssc_Ds($rs['ball_5']);
            $dx = Ssc_Dx($rs['ball_5']);
            if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和大小
        if ($rows['mingxi_2'] == '总和大' || $rows['mingxi_2'] == '总和小') {
            $zonghe = Ssc_Auto($hm, 2);
            if ($rows['mingxi_2'] == $zonghe) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和单双
        if ($rows['mingxi_2'] == '总和单' || $rows['mingxi_2'] == '总和双') {
            $zonghe = Ssc_Auto($hm, 3);
            if ($rows['mingxi_2'] == $zonghe) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算龙虎和
        if ($rows['mingxi_2'] == '龙' || $rows['mingxi_2'] == '虎' || $rows['mingxi_2'] == '和') {
            $longhu = Ssc_Auto($hm, 4);
            if ($rows['mingxi_2'] == $longhu) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算前三
        if ($rows['mingxi_1'] == '前三') {
            $qiansan = Ssc_Auto($hm, 5);
            $dx = ($hm[0] + $hm[1] + $hm[2] > 13) ? '大' : '小';
            $ds = (($hm[0] + $hm[1] + $hm[2]) % 2 == 0) ? '双' : '单';
            if ($rows['mingxi_2'] == $qiansan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算中三
        if ($rows['mingxi_1'] == '中三') {
            $zhongsan = Ssc_Auto($hm, 6);
            $dx = ($hm[1] + $hm[2] + $hm[3] > 13) ? '大' : '小';
            $ds = (($hm[1] + $hm[2] + $hm[3]) % 2 == 0) ? '双' : '单';
            
            if ($rows['mingxi_2'] == $zhongsan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算后三
        if ($rows['mingxi_1'] == '后三') {
            $housan = Ssc_Auto($hm, 7);
            $dx = ($hm[2] + $hm[3] + $hm[4] > 13) ? '大' : '小';
            $ds = (($hm[2] + $hm[3] + $hm[4]) % 2 == 0) ? '双' : '单';
            
            if ($rows['mingxi_2'] == $housan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    /**
     * 
     * @param array $rs 开奖号码
     * @param array $rows 投注号码
     * @return boolean true 为中奖 false 为未中奖 
     */
    public static function cqklsf($rs,$rows){
        $hm = array();
        $hm[] = $rs['ball_1'];
        $hm[] = $rs['ball_2'];
        $hm[] = $rs['ball_3'];
        $hm[] = $rs['ball_4'];
        $hm[] = $rs['ball_5'];
        //开始结算第一球
        if($rows['mingxi_1']=='第一球'){
            $ds		= G10_Ds($rs['ball_1']);
            $dx		= G10_Dx($rs['ball_1']);
            $wsdx	= G10_WsDx($rs['ball_1']);
            $hsds	= G10_HsDs($rs['ball_1']);
            $fw		= G10_Fw($rs['ball_1']);
            $zfb	= G10_Zfb($rs['ball_1']);
            if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$fw || $rows['mingxi_2']==$zfb){
                return true;
            }else{
                return false;
            }
        }
        //开始结算第二球
        if($rows['mingxi_1']=='第二球'){
            $ds		= G10_Ds($rs['ball_2']);
            $dx		= G10_Dx($rs['ball_2']);
            $wsdx	= G10_WsDx($rs['ball_2']);
            $hsds	= G10_HsDs($rs['ball_2']);
            $fw		= G10_Fw($rs['ball_2']);
            $zfb	= G10_Zfb($rs['ball_2']);
            if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$fw || $rows['mingxi_2']==$zfb){
                return true;
            }else{
                return false;
            }
        }
        //开始结算第三球
        if($rows['mingxi_1']=='第三球'){
            $ds		= G10_Ds($rs['ball_3']);
            $dx		= G10_Dx($rs['ball_3']);
            $wsdx	= G10_WsDx($rs['ball_3']);
            $hsds	= G10_HsDs($rs['ball_3']);
            $fw		= G10_Fw($rs['ball_3']);
            $zfb	= G10_Zfb($rs['ball_3']);
            if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$fw || $rows['mingxi_2']==$zfb){
                return true;
            }else{
                return false;
            }
        }
        //开始结算第四球
        if($rows['mingxi_1']=='第四球'){
            $ds		= G10_Ds($rs['ball_4']);
            $dx		= G10_Dx($rs['ball_4']);
            $wsdx	= G10_WsDx($rs['ball_4']);
            $hsds	= G10_HsDs($rs['ball_4']);
            $fw		= G10_Fw($rs['ball_4']);
            $zfb	= G10_Zfb($rs['ball_4']);
            if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$fw || $rows['mingxi_2']==$zfb){
                return true;
            }else{
                return false;
            }
        }
        //开始结算第五球
        if($rows['mingxi_1']=='第五球'){
            $ds		= G10_Ds($rs['ball_5']);
            $dx		= G10_Dx($rs['ball_5']);
            $wsdx	= G10_WsDx($rs['ball_5']);
            $hsds	= G10_HsDs($rs['ball_5']);
            $fw		= G10_Fw($rs['ball_5']);
            $zfb	= G10_Zfb($rs['ball_5']);
            if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$fw || $rows['mingxi_2']==$zfb){
                return true;
            }else{
                return false;
            }
        }
        //开始结算第六球
        if($rows['mingxi_1']=='第六球'){
            $ds		= G10_Ds($rs['ball_6']);
            $dx		= G10_Dx($rs['ball_6']);
            $wsdx	= G10_WsDx($rs['ball_6']);
            $hsds	= G10_HsDs($rs['ball_6']);
            $fw		= G10_Fw($rs['ball_6']);
            $zfb	= G10_Zfb($rs['ball_6']);
            if($rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$fw || $rows['mingxi_2']==$zfb){
                return true;
            }else{
                return false;
            }
        }
        //开始结算第七球
        if($rows['mingxi_1']=='第七球'){
            $ds		= G10_Ds($rs['ball_7']);
            $dx		= G10_Dx($rs['ball_7']);
            $wsdx	= G10_WsDx($rs['ball_7']);
            $hsds	= G10_HsDs($rs['ball_7']);
            $fw		= G10_Fw($rs['ball_7']);
            $zfb	= G10_Zfb($rs['ball_7']);
            if($rows['mingxi_2']==$rs['ball_7'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$fw || $rows['mingxi_2']==$zfb){
                return true;
            }else{
                return false;
            }
        }
        //开始结算第八球
        if($rows['mingxi_1']=='第八球'){
            $ds		= G10_Ds($rs['ball_8']);
            $dx		= G10_Dx($rs['ball_8']);
            $wsdx	= G10_WsDx($rs['ball_8']);
            $hsds	= G10_HsDs($rs['ball_8']);
            $fw		= G10_Fw($rs['ball_8']);
            $zfb	= G10_Zfb($rs['ball_8']);
            if($rows['mingxi_2']==$rs['ball_8'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$fw || $rows['mingxi_2']==$zfb){
                return true;
            }else{
                return false;
            }
        }
        //开始结算总和大小
        if($rows['mingxi_2']=='总和大' || $rows['mingxi_2']=='总和小'){
            $zhdx = G10_Auto($hm,2);
            if($zhdx=='和'){
                return 2;
            } else if($rows['mingxi_2']==$zhdx){
                return true;
            }else{
                return false;
            }
        }
        //开始结算总和单双
        if($rows['mingxi_2']=='总和单' || $rows['mingxi_2']=='总和双'){
            $zhds = G10_Auto($hm,3);
            if($rows['mingxi_2']==$zhds){
                return true;
            }else{
                return false;
            }
        }
        //开始结算总和尾数大小
        if($rows['mingxi_2']=='总和尾大' || $rows['mingxi_2']=='总和尾小'){
            $zhwsdx = G10_Auto($hm,4);
            if($rows['mingxi_2']==$zhwsdx){
                return true;
            }else{
                return false;
            }
        }
        //开始结算龙虎
        if($rows['mingxi_2']=='龙' || $rows['mingxi_2']=='虎'){
            $lh = G10_Auto($hm,5);
            if($rows['mingxi_2']==$lh){
                return true;
            }else{
                return false;
            }
        }
    }

    public static function gdklsf($rs,$rows){
        $hm = array();
        $hm[] = $rs['ball_1'];
        $hm[] = $rs['ball_2'];
        $hm[] = $rs['ball_3'];
        $hm[] = $rs['ball_4'];
        $hm[] = $rs['ball_5'];
        $hm[] = $rs['ball_6'];
        $hm[] = $rs['ball_7'];
        $hm[] = $rs['ball_8'];
        // 开始结算第一球
        if ($rows['mingxi_1'] == '第一球') {
            $ds = G10_Ds($rs['ball_1']);
            $dx = G10_Dx($rs['ball_1']);
            $wsdx = G10_WsDx($rs['ball_1']);
            $hsds = G10_HsDs($rs['ball_1']);
            $fw = G10_Fw($rs['ball_1']);
            $zfb = G10_Zfb($rs['ball_1']);
            if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $wsdx || $rows['mingxi_2'] == $hsds || $rows['mingxi_2'] == $fw || $rows['mingxi_2'] == $zfb) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第二球
        if ($rows['mingxi_1'] == '第二球') {
            $ds = G10_Ds($rs['ball_2']);
            $dx = G10_Dx($rs['ball_2']);
            $wsdx = G10_WsDx($rs['ball_2']);
            $hsds = G10_HsDs($rs['ball_2']);
            $fw = G10_Fw($rs['ball_2']);
            $zfb = G10_Zfb($rs['ball_2']);
            if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $wsdx || $rows['mingxi_2'] == $hsds || $rows['mingxi_2'] == $fw || $rows['mingxi_2'] == $zfb) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第三球
        if ($rows['mingxi_1'] == '第三球') {
            $ds = G10_Ds($rs['ball_3']);
            $dx = G10_Dx($rs['ball_3']);
            $wsdx = G10_WsDx($rs['ball_3']);
            $hsds = G10_HsDs($rs['ball_3']);
            $fw = G10_Fw($rs['ball_3']);
            $zfb = G10_Zfb($rs['ball_3']);
            if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $wsdx || $rows['mingxi_2'] == $hsds || $rows['mingxi_2'] == $fw || $rows['mingxi_2'] == $zfb) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第四球
        if ($rows['mingxi_1'] == '第四球') {
            $ds = G10_Ds($rs['ball_4']);
            $dx = G10_Dx($rs['ball_4']);
            $wsdx = G10_WsDx($rs['ball_4']);
            $hsds = G10_HsDs($rs['ball_4']);
            $fw = G10_Fw($rs['ball_4']);
            $zfb = G10_Zfb($rs['ball_4']);
            if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $wsdx || $rows['mingxi_2'] == $hsds || $rows['mingxi_2'] == $fw || $rows['mingxi_2'] == $zfb) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第五球
        if ($rows['mingxi_1'] == '第五球') {
            $ds = G10_Ds($rs['ball_5']);
            $dx = G10_Dx($rs['ball_5']);
            $wsdx = G10_WsDx($rs['ball_5']);
            $hsds = G10_HsDs($rs['ball_5']);
            $fw = G10_Fw($rs['ball_5']);
            $zfb = G10_Zfb($rs['ball_5']);
            if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $wsdx || $rows['mingxi_2'] == $hsds || $rows['mingxi_2'] == $fw || $rows['mingxi_2'] == $zfb) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第六球
        if ($rows['mingxi_1'] == '第六球') {
            $ds = G10_Ds($rs['ball_6']);
            $dx = G10_Dx($rs['ball_6']);
            $wsdx = G10_WsDx($rs['ball_6']);
            $hsds = G10_HsDs($rs['ball_6']);
            $fw = G10_Fw($rs['ball_6']);
            $zfb = G10_Zfb($rs['ball_6']);
            if ($rows['mingxi_2'] == $rs['ball_6'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $wsdx || $rows['mingxi_2'] == $hsds || $rows['mingxi_2'] == $fw || $rows['mingxi_2'] == $zfb) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第七球
        if ($rows['mingxi_1'] == '第七球') {
            $ds = G10_Ds($rs['ball_7']);
            $dx = G10_Dx($rs['ball_7']);
            $wsdx = G10_WsDx($rs['ball_7']);
            $hsds = G10_HsDs($rs['ball_7']);
            $fw = G10_Fw($rs['ball_7']);
            $zfb = G10_Zfb($rs['ball_7']);
            if ($rows['mingxi_2'] == $rs['ball_7'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $wsdx || $rows['mingxi_2'] == $hsds || $rows['mingxi_2'] == $fw || $rows['mingxi_2'] == $zfb) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第八球
        if ($rows['mingxi_1'] == '第八球') {
            $ds = G10_Ds($rs['ball_8']);
            $dx = G10_Dx($rs['ball_8']);
            $wsdx = G10_WsDx($rs['ball_8']);
            $hsds = G10_HsDs($rs['ball_8']);
            $fw = G10_Fw($rs['ball_8']);
            $zfb = G10_Zfb($rs['ball_8']);
            if ($rows['mingxi_2'] == $rs['ball_8'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $wsdx || $rows['mingxi_2'] == $hsds || $rows['mingxi_2'] == $fw || $rows['mingxi_2'] == $zfb) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和大小
        if ($rows['mingxi_2'] == '总和大' || $rows['mingxi_2'] == '总和小') {
            $zhdx = G10_Auto($hm, 2);
            if ($zhdx == '和') {
                return true;
            }
            if ($rows['mingxi_2'] == $zhdx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和单双
        if ($rows['mingxi_2'] == '总和单' || $rows['mingxi_2'] == '总和双') {
            $zhds = G10_Auto($hm, 3);
            if ($rows['mingxi_2'] == $zhds) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和尾数大小
        if ($rows['mingxi_2'] == '总和尾大' || $rows['mingxi_2'] == '总和尾小') {
            $zhwsdx = G10_Auto($hm, 4);
            if ($rows['mingxi_2'] == $zhwsdx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算龙虎
        if ($rows['mingxi_2'] == '龙' || $rows['mingxi_2'] == '虎') {
            $lh = G10_Auto($hm, 5);
            if ($rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function gxklsf($rs,$rows){
        $hm = array();
        $hm[] = $rs['ball_1'];
        $hm[] = $rs['ball_2'];
        $hm[] = $rs['ball_3'];
        $hm[] = $rs['ball_4'];
        $hm[] = $rs['ball_5'];
        $hm[] = $rs['ball_6'];
        $hm[] = $rs['ball_7'];
        $hm[] = $rs['ball_8'];
        // 开始结算第一球
        if ($rows['mingxi_1'] == '第一球') {
            $ds = Gxsf_Ds($rs['ball_1']);
            $dx = Gxsf_Dx($rs['ball_1']);
            if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第二球
        if ($rows['mingxi_1'] == '第二球') {
            $ds = Gxsf_Ds($rs['ball_2']);
            $dx = Gxsf_Dx($rs['ball_2']);
            if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第三球
        if ($rows['mingxi_1'] == '第三球') {
            $ds = Gxsf_Ds($rs['ball_3']);
            $dx = Gxsf_Dx($rs['ball_3']);
            if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第四球
        if ($rows['mingxi_1'] == '第四球') {
            $ds = Gxsf_Ds($rs['ball_4']);
            $dx = Gxsf_Dx($rs['ball_4']);
            if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第五球
        if ($rows['mingxi_1'] == '第五球') {
            $ds = Gxsf_Ds($rs['ball_5']);
            $dx = Gxsf_Dx($rs['ball_5']);
            if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和大小
        if ($rows['mingxi_2'] == '总和大' || $rows['mingxi_2'] == '总和小') {
            $zonghe = Gxsf_Auto($hm, 2);
            if ($rows['mingxi_2'] == $zonghe) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和单双
        if ($rows['mingxi_2'] == '总和单' || $rows['mingxi_2'] == '总和双') {
            $zonghe = Gxsf_Auto($hm, 3);
            if ($rows['mingxi_2'] == $zonghe) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算龙虎和
        if ($rows['mingxi_2'] == '龙' || $rows['mingxi_2'] == '虎' || $rows['mingxi_2'] == '和') {
            $longhu = Gxsf_Auto($hm, 4);
            if ($rows['mingxi_2'] == $longhu) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算前三
        if ($rows['mingxi_1'] == '前三') {
            $qiansan = Gxsf_Auto($hm, 5);
            if ($rows['mingxi_2'] == $qiansan) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算中三
        if ($rows['mingxi_1'] == '中三') {
            $zhongsan = Gxsf_Auto($hm, 6);
            if ($rows['mingxi_2'] == $zhongsan) {
                
                return true;
            } else {
                
                return false;
            }
        }
        // 开始结算后三
        if ($rows['mingxi_1'] == '后三') {
            $housan = Gxsf_Auto($hm, 7);
            if ($rows['mingxi_2'] == $housan) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function jsk3($rs,$rows){
        $hm = array();
        $hm[] = $rs['ball_1'];
        $hm[] = $rs['ball_2'];
        $hm[] = $rs['ball_3'];
        $dianshu = $hm[0] + $hm[1] + $hm[2];
        // 开始结算点数
        if ($rows['mingxi_1'] == '点数') {
            if ($rows['mingxi_2'] == $dianshu) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算双面
        if ($rows['mingxi_1'] == '双面') {
            $ds = $dx = '';
            if ($dianshu >= 4 && $dianshu <= 10) {
                $dx = '点数小';
            }
            if ($dianshu >= 11 && $dianshu <= 17) {
                $dx = '点数大';
            }
            // 点数单双
            if ($dianshu % 2 == 0) {
                $ds = '点数双';
            } else {
                $ds = '点数单';
            }
            if ($rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算三军
        if ($rows['mingxi_1'] == '三军') {
            if (in_array(intval($rows['mingxi_2']), $hm)) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算围骰
        if ($rows['mingxi_1'] == '围骰') {
            $ws = "0" . $hm[0] . "0" . $m[1] . "0" . $m[2];
            if ($rows['mingxi_2'] == $ws) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算长牌
        if ($rows['mingxi_1'] == '长牌') {
            $tmphm = $hm;
            sort($tmphm);
            $cp1 = "0" . $tmphm[0] . "0" . $tmphm[1];
            $cp2 = "0" . $tmphm[1] . "0" . $tmphm[2];
            $cp3 = "0" . $tmphm[0] . "0" . $tmphm[2];
            if ($rows['mingxi_2'] == $cp1 || $rows['mingxi_2'] == $cp2 || $rows['mingxi_2'] == $cp3) {
                return true;
            } else {
                return false;
            }
        }
        
        // 开始结算短牌
        if ($rows['mingxi_1'] == '短牌') {
            $tmphm = $hm;
            sort($tmphm);
            $cp1 = "0" . $tmphm[0] . "0" . $tmphm[1];
            $cp2 = "0" . $tmphm[1] . "0" . $tmphm[2];
            $cp3 = "0" . $tmphm[0] . "0" . $tmphm[2];
            if ($rows['mingxi_2'] == $cp1 || $rows['mingxi_2'] == $cp2 || $rows['mingxi_2'] == $cp3) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function pk10($rs,$rows){
        $hm = array();
        $hm[] = $rs['ball_1'];
        $hm[] = $rs['ball_2'];
        $hm[] = $rs['ball_3'];
        $hm[] = $rs['ball_4'];
        $hm[] = $rs['ball_5'];
        $hm[] = $rs['ball_6'];
        $hm[] = $rs['ball_7'];
        $hm[] = $rs['ball_8'];
        $hm[] = $rs['ball_9'];
        $hm[] = $rs['ball_10'];
        // 开始结算第一球
        if ($rows['mingxi_1'] == '冠军') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_1']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_1']);
            $lh = Pk10_Auto($hm, 4, 0);
            if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第二球
        if ($rows['mingxi_1'] == '亚军') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_2']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_2']);
            $lh = Pk10_Auto($hm, 5, 0);
            if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第三球
        if ($rows['mingxi_1'] == '第三名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_3']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_3']);
            $lh = Pk10_Auto($hm, 6, 0);
            if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第四球
        if ($rows['mingxi_1'] == '第四名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_4']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_4']);
            $lh = Pk10_Auto($hm, 7, 0);
            if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第五球
        if ($rows['mingxi_1'] == '第五名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_5']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_5']);
            $lh = Pk10_Auto($hm, 8, 0);
            if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第六球
        if ($rows['mingxi_1'] == '第六名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_6']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_6']);
            if ($rows['mingxi_2'] == $rs['ball_6'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第七球
        if ($rows['mingxi_1'] == '第七名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_7']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_7']);
            if ($rows['mingxi_2'] == $rs['ball_7'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第八球
        if ($rows['mingxi_1'] == '第八名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_8']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_8']);
            if ($rows['mingxi_2'] == $rs['ball_8'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第九球
        if ($rows['mingxi_1'] == '第九名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_9']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_9']);
            if ($rows['mingxi_2'] == $rs['ball_9'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第十球
        if ($rows['mingxi_1'] == '第十名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_10']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_10']);
            if ($rows['mingxi_2'] == $rs['ball_10'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算冠亚军和
        if ($rows['mingxi_1'] == '冠亚军和') {
            $zh = Pk10_Auto($hm, 1, 0);
            $dx = Pk10_Auto($hm, 2, 0);
            $ds = Pk10_Auto($hm, 3, 0);
            if ($rows['mingxi_2'] == $zh || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    public static function xjssc($rs,$rows){
        $hm = array();
        $hm[] = $rs['ball_1'];
        $hm[] = $rs['ball_2'];
        $hm[] = $rs['ball_3'];
        $hm[] = $rs['ball_4'];
        $hm[] = $rs['ball_5'];
        // 开始结算第一球
        if ($rows['mingxi_1'] == '第一球') {
            $ds = Ssc_Ds($rs['ball_1']);
            $dx = Ssc_Dx($rs['ball_1']);
            if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第二球
        if ($rows['mingxi_1'] == '第二球') {
            $ds = Ssc_Ds($rs['ball_2']);
            $dx = Ssc_Dx($rs['ball_2']);
            if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第三球
        if ($rows['mingxi_1'] == '第三球') {
            $ds = Ssc_Ds($rs['ball_3']);
            $dx = Ssc_Dx($rs['ball_3']);
            if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第四球
        if ($rows['mingxi_1'] == '第四球') {
            $ds = Ssc_Ds($rs['ball_4']);
            $dx = Ssc_Dx($rs['ball_4']);
            if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第五球
        if ($rows['mingxi_1'] == '第五球') {
            $ds = Ssc_Ds($rs['ball_5']);
            $dx = Ssc_Dx($rs['ball_5']);
            if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和大小
        if ($rows['mingxi_2'] == '总和大' || $rows['mingxi_2'] == '总和小') {
            $zonghe = Ssc_Auto($hm, 2);
            if ($rows['mingxi_2'] == $zonghe) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算总和单双
        if ($rows['mingxi_2'] == '总和单' || $rows['mingxi_2'] == '总和双') {
            $zonghe = Ssc_Auto($hm, 3);
            if ($rows['mingxi_2'] == $zonghe) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算龙虎和
        if ($rows['mingxi_2'] == '龙' || $rows['mingxi_2'] == '虎' || $rows['mingxi_2'] == '和') {
            $longhu = Ssc_Auto($hm, 4);
            if ($rows['mingxi_2'] == $longhu) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算前三
        if ($rows['mingxi_1'] == '前三') {
            $qiansan = Ssc_Auto($hm, 5);
            $dx = ($hm[0] + $hm[1] + $hm[2] > 13) ? '大' : '小';
            $ds = (($hm[0] + $hm[1] + $hm[2]) % 2 == 0) ? '双' : '单';
            if ($rows['mingxi_2'] == $qiansan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算中三
        if ($rows['mingxi_1'] == '中三') {
            $zhongsan = Ssc_Auto($hm, 6);
            $dx = ($hm[1] + $hm[2] + $hm[3] > 13) ? '大' : '小';
            $ds = (($hm[1] + $hm[2] + $hm[3]) % 2 == 0) ? '双' : '单';
            if ($rows['mingxi_2'] == $zhongsan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算后三
        if ($rows['mingxi_1'] == '后三') {
            $housan = Ssc_Auto($hm, 7);
            $dx = ($hm[2] + $hm[3] + $hm[4] > 13) ? '大' : '小';
            $ds = (($hm[2] + $hm[3] + $hm[4]) % 2 == 0) ? '双' : '单';
            if ($rows['mingxi_2'] == $housan || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $ds) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function xyft($rs,$rows){
        $hm = array();
        $hm[] = $rs['ball_1'];
        $hm[] = $rs['ball_2'];
        $hm[] = $rs['ball_3'];
        $hm[] = $rs['ball_4'];
        $hm[] = $rs['ball_5'];
        $hm[] = $rs['ball_6'];
        $hm[] = $rs['ball_7'];
        $hm[] = $rs['ball_8'];
        $hm[] = $rs['ball_9'];
        $hm[] = $rs['ball_10'];
        // 开始结算第一球
        if ($rows['mingxi_1'] == '冠军') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_1']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_1']);
            $lh = Pk10_Auto($hm, 4, 0);
            if ($rows['mingxi_2'] == $rs['ball_1'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第二球
        if ($rows['mingxi_1'] == '亚军') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_2']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_2']);
            $lh = Pk10_Auto($hm, 5, 0);
            if ($rows['mingxi_2'] == $rs['ball_2'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第三球
        if ($rows['mingxi_1'] == '第三名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_3']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_3']);
            $lh = Pk10_Auto($hm, 6, 0);
            if ($rows['mingxi_2'] == $rs['ball_3'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第四球
        if ($rows['mingxi_1'] == '第四名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_4']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_4']);
            $lh = Pk10_Auto($hm, 7, 0);
            if ($rows['mingxi_2'] == $rs['ball_4'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第五球
        if ($rows['mingxi_1'] == '第五名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_5']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_5']);
            $lh = Pk10_Auto($hm, 8, 0);
            if ($rows['mingxi_2'] == $rs['ball_5'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx || $rows['mingxi_2'] == $lh) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第六球
        if ($rows['mingxi_1'] == '第六名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_6']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_6']);
            if ($rows['mingxi_2'] == $rs['ball_6'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第七球
        if ($rows['mingxi_1'] == '第七名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_7']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_7']);
            if ($rows['mingxi_2'] == $rs['ball_7'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第八球
        if ($rows['mingxi_1'] == '第八名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_8']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_8']);
            if ($rows['mingxi_2'] == $rs['ball_8'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第九球
        if ($rows['mingxi_1'] == '第九名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_9']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_9']);
            if ($rows['mingxi_2'] == $rs['ball_9'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算第十球
        if ($rows['mingxi_1'] == '第十名') {
            $ds = Pk10_Auto($hm, 10, $rs['ball_10']);
            $dx = Pk10_Auto($hm, 9, $rs['ball_10']);
            if ($rows['mingxi_2'] == $rs['ball_10'] || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
        // 开始结算冠亚军和
        if ($rows['mingxi_1'] == '冠亚军和') {
            $zh = Pk10_Auto($hm, 1, 0);
            $dx = Pk10_Auto($hm, 2, 0);
            $ds = Pk10_Auto($hm, 3, 0);
            if ($rows['mingxi_2'] == $zh || $rows['mingxi_2'] == $ds || $rows['mingxi_2'] == $dx) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * 检验注单是否合法
     * @param array $rows 注单信息
     * @return boolean
     */
    public static function checkLotterySalt($rows){
        $money = $rows['money'];
        $q_qian = $rows['q_qian'];
        $signStr = $rows['did'].$rows['uid'].$rows['username'].$rows['addtime'];
        $signStr .= $rows['type'].$rows['qishu'].$rows['mingxi_1'].$rows['mingxi_2'];
        $signStr .= $rows['odds'].sprintf('%0.2f%0.2f',$money,$q_qian);
        $saltcode = md5($signStr);
        if($saltcode == $rows['saltCode']){
            return true;
        }else{
            return false;
        }
    }
}

