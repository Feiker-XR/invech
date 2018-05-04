<?php
namespace app\home\controller;

/**
 *  开采网,其他及统计相关数据接口
 */
class CountController extends CountLogicController
{

    /**
     *  pk10--路珠分析
     */
    public function pk10_road_bead()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $url  = 'https://'.self::DOMAIN.'/pks/queryComprehensiveRoadBead.do?date='.$date.'&lotCode='.$code;
            $key  = 'pk10_road_bead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  时时彩--路珠分析
     */
    public function ssc_road_bead()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryComprehensiveRoadBead.do?date='.$date.'&lotCode='.$code;
            $key  = 'ssc_road_bead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /*
     *  11选5--路珠分析
     */
    public function syx5_road_bead()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryComprehensiveRoadBead.do?date='.$date.'&lotCode='.$code;
            $key  = 'syx5_road_bead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SYX5_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快乐十分--路珠分析
     */
    public function klsf_road_bead()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryComprehensiveRoadBead.do?date='.$date.'&lotCode='.$code;
            $key  = 'klsf_road_bead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }
    /**
     *  广西快乐十分--路珠分析
     */
    public function gxklsf_road_bead()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/gxklsf/queryComprehensiveRoadBead.do?date='.$date.'&lotCode='.$code;
            $key  = 'gxklsf_road_bead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_GXKLSF_ROAD_BEAD) ;

            $this->responseData($data); //返回数据
        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  时时彩--号码路珠
     */
    public function ssc_num_roadbead()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryNumberRoadBead.do?date='.$date.'&lotCode='.$code ;
            $key  = 'ssc_number_roadbead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_NUM_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快乐十分--号码路珠
     */
    public function klsf_num_roadbead()
    {
        try {
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryDrawCodeRoadBead.do?date='.$date.'&lotCode='.$code ;
            $key  = 'klsf_num_roadbead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_NUM_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  广西快乐十分--号码路珠
     */
    public function gxklsf_num_roadbead()
    {
        try {
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/gxklsf/queryDrawCodeRoadBead.do?date='.$date.'&lotCode='.$code ;
            $key  = 'gxklsf_num_roadbead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_GXKLSF_NUM_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快三--号码路珠
     */
    public function k3_num_roadbead()
    {
        try {
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $issue = (isset($_REQUEST['issue'])  && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/getNumberRoadOfBead.do?date='.$date.'&issue='.$issue.'&lotCode='.$code ;
            $key  = 'k3_num_roadbead_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_NUM_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  快乐十分--今日号码路珠
     */
    public function klsf_today_num_roadbead()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryToDayNumberLawOfStatistics.do?lotCode='.$code ;
            $key  = 'klsf_today_num_roadbead_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_TODAY_NUM_ROAD_BEAD) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--号码前后路珠
     */
    public function pk10_road_bead_fb()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $url  = 'https://'.self::DOMAIN.'/pks/queryFbRoadBead.do?date='.$date.'&lotCode='.$code;
            $key  = 'pk10_road_bead_fb_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_ROAD_BEAD_FB) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  快三--总和路珠
     */
    public function k3_road_bead_sum()
    {
        try {
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/getRoadOfBeadTotal.do?date='.$date.'&lotCode='.$code;
            $key  = 'k3_road_bead_sum_'.$date.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_ROAD_BEAD_SUM) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--龙虎统计
     */
    public function pk10_history_dt()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $url  = 'https://'.self::DOMAIN.'/pks/queryHistoryDataForDt.do?lotCode='.$code ;
            $key  = 'pk10_history_dt_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_HISTORY_DT) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--号码规律统计
     */
    public function pk10_count_number()
    {
        try {
            $lotCode = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $code    = (isset($_REQUEST['code']) && !empty($_REQUEST['code'])) ? $_REQUEST['code'] : '' ;
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryNumberLawOfStatistics.do?date='.$date ;
            if ($periods) {
                $url.= '&periods='.$periods ;
            }
            if ($code) {
                $url.= '&code='.$code ;
            }
            $url.= '&lotCode='.$lotCode ;

            $key  = 'pk10_number_count_'.$date.$periods.$code.$lotCode ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_COUNT_NUMBER) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  PK拾--号码统计
     */
    public function pk10_trend_count()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $date = (isset($_REQUEST['date']) && !empty($_REQUEST['date'])) ? $_REQUEST['date'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryToDayNumberLawOfStatistics.do?date='.$date.'&lotCode='.$code ;
            $key  = 'pk10_trend_count'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_TREND_COUNT) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }

    /**
     *  时时彩--号码统计
     */
    public function ssc_trend_count()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryCQShiCaiTrendCount.do?lotCode='.$code ;

            $key  = 'ssc_trend_count_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_TREND_COUNT) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  11选5--今日号码统计
     */
    public function syx5_today_trend_count()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10006 ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryNumberCount.do?lotCode='.$code ;
            $key  = 'syx5_today_trend_count_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SYX5_TODAY_TREND_COUNT) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  时时彩--历史号码统计
     */
    public function ssc_history_fornumber()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryHistoryDataForNumber.do?lotCode='.$code ;
            $key  = 'ssc_history_fornumber_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_HISTORY_FORNUMBER) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快乐十分--历史号码统计
     */
    public function klsf_history_fornumber()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryHistoryDataForDrawCode.do?lotCode='.$code ;
            $key  = 'klsf_history_fornumber_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_HISTORY_FORNUMBER) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快三--历史号码统计
     */
    public function k3_history_fornumber()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/getJSFastThreeNumberList.do?lotCode='.$code ;
            $key  = 'k3_history_fornumber_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_HISTORY_FORNUMBER) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--长龙统计
     */
    public function pk10_count_long_dragon()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $days = (isset($_REQUEST['days']) && !empty($_REQUEST['days'])) ? $_REQUEST['days'] : '' ;
            $type = (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) ? $_REQUEST['type'] : '' ;
            $rank = (isset($_REQUEST['rank']) && !empty($_REQUEST['rank'])) ? $_REQUEST['rank'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryPksDailyDragon.do?days='.$days.'&type='.$type.'&rank='.$rank.'&lotCode='.$code ;
            $key  = 'pk10_count_long_dragon_'.$days.$type.$rank.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_COUNT_LONG_DRAGON) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  时时彩--每日长龙
     */
    public function ssc_days_long_dragon()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $days = (isset($_REQUEST['days']) && !empty($_REQUEST['days'])) ? $_REQUEST['days'] : '' ;
            $type = (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) ? $_REQUEST['type'] : '' ;
            $rank = (isset($_REQUEST['rank']) && !empty($_REQUEST['rank'])) ? $_REQUEST['rank'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryShiCaiDailyDragon.do?days='.$days.'&type='.$type.'&rank='.$rank.'&lotCode='.$code ;
            $key  = 'ssc_days_long_dragon_'.$days.$type.$rank.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_DAY_LONG_DRAGON) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  11选5--每日长龙
     */
    public function syx5_days_long_dragon()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $days = (isset($_REQUEST['days'])    && !empty($_REQUEST['days']))    ? $_REQUEST['days'] : '' ;
            $type = (isset($_REQUEST['type'])    && !empty($_REQUEST['type']))    ? $_REQUEST['type'] : '' ;
            $rank = (isset($_REQUEST['rank'])    && !empty($_REQUEST['rank']))    ? $_REQUEST['rank'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryElevenFiveLongDragon.do?days='.$days.'&type='.$type.'&rank='.$rank.'&lotCode='.$code ;
            $key  = 'syx5_days_long_dragon_'.$days.$type.$rank.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_DAY_LONG_DRAGON) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快乐十分--每日长龙
     */
    public function klsf_days_long_dragon()
    {
        try {
            $type = (isset($_REQUEST['type'])    && !empty($_REQUEST['type']))    ? $_REQUEST['type'] : '' ;
            $rank = (isset($_REQUEST['rank'])    && !empty($_REQUEST['rank']))    ? $_REQUEST['rank'] : '' ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryKlsfDailyDragon.do?type='.$type.'&rank='.$rank.'&lotCode='.$code ;
            $key  = 'klsf_days_long_dragon_'.$type.$rank.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_DAY_LONG_DRAGON) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  广西快乐十分--每日长龙
     */
    public function gxklsf_days_long_dragon()
    {
        try {
            $type = (isset($_REQUEST['type'])    && !empty($_REQUEST['type']))    ? $_REQUEST['type'] : '' ;
            $rank = (isset($_REQUEST['rank'])    && !empty($_REQUEST['rank']))    ? $_REQUEST['rank'] : '' ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/gxklsf/queryKlsfDailyDragon.do?type='.$type.'&rank='.$rank.'&lotCode='.$code ;
            $key  = 'gxklsf_days_long_dragon_'.$type.$rank.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_GXKLSF_DAY_LONG_DRAGON) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快三--每日长龙
     */
    public function k3_days_long_dragon()
    {
        try {
            $type = (isset($_REQUEST['type'])    && !empty($_REQUEST['type']))    ? $_REQUEST['type']    : '' ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/queryDailyDragon.do?type='.$type.'&lotCode='.$code ;
            $key  = 'k3_days_long_dragon_'.$type.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_DAY_LONG_DRAGON) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--双面统计
     */
    public function pk10_count_double()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryNewestDataForDsdx.do?lotCode='.$code ;
            $key  = 'pk10_count_double_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_COUNT_DOUBLE) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  时时彩--双面统计
     */
    public function ssc_count_double()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryNewestDataForDsdx.do?lotCode='.$code ;
            $key  = 'ssc_count_double_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_COUNT_DOUBLE) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快乐十分--双面统计
     */
    public function klsf_count_double()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryNewestDataForDsdx.do?lotCode='.$code ;
            $key  = 'klsf_count_double_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_COUNT_DOUBLE) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  广西快乐十分--双面统计
     */
    public function gxklsf_count_double()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/gxklsf/queryNewestDataForDsdx.do?lotCode='.$code ;
            $key  = 'gxklsf_count_double_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_GXKLSF_COUNT_DOUBLE) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--冷热分析
     */
    public function pk10_code_heat_state()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryDrawCodeHeatState.do?lotCode='.$code ;
            $key  = 'pk10_code_heat_state_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_CODE_HEAT_STATE) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  时时彩--冷热分析
     */
    public function ssc_code_heat_state()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryDrawCodeHeatState.do?lotCode='.$code ;
            $key  = 'ssc_code_heat_state_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_CODE_HEAT_STATE) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  11选5--冷热分析
     */
    public function syx5_code_heat_state()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryDrawCodeHeatState.do?lotCode='.$code ;
            $key  = 'syx5_code_heat_state_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SYX5_CODE_HEAT_STATE) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  时时彩--基本走势
     */
    public function ssc_trend_byissue()
    {
        try {
            $issue = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryCQShiCaiTrendByIssue.do?issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'ssc_code_trend_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_CODE_TREND) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  11选5--基本走势
     */
    public function syx5_trend_byissue()
    {
        try {
            $issue = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryElevnFiveTrendByIssue.do?issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'syx5_trend_byissue_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SYX5_CODE_TREND) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快三--基本走势
     */
    public function k3_trend_byissue()
    {
        try {
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $issue   = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/queryBasicTrend.do?date='.$date.'&issue='.$issue.'&periods'.$periods.'&lotCode='.$code ;
            $key  = 'k3_trend_byissue_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_CODE_TREND) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  时时彩--定位走势
     */
    public function ssc_trend_location()
    {
        try {
            $issue = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $num   = (isset($_REQUEST['num'])    && !empty($_REQUEST['num']))      ? $_REQUEST['num']     : 1 ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryCQShiCaiTrendByLocation.do?num='.$num.'issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'ssc_trend_location_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_TREND_LOCATION) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  11选5--定位走势
     */
    public function syx5_trend_location()
    {
        try {
            $num   = (isset($_REQUEST['num'])    && !empty($_REQUEST['num']))      ? $_REQUEST['num']     : 1 ;
            $issue = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : '' ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryElevnFiveLocalTrend.do?num='.$num.'&issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'syx5_trend_location_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SYX5_TREND_LOCATION) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快三--定位走势
     */
    public function k3_trend_location()
    {
        try {
            $periods= (isset($_REQUEST['periods'])&& !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $issue = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : '' ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/queryOrientationTrend.do?date='.$date.'&issue='.$issue.'&periods'.$periods.'&lotCode='.$code ;
            $key  = 'k3_trend_location_'.$date.$issue.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_TREND_LOCATION) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  时时彩--形态走势
     */
    public function ssc_trend_type()
    {
        try {
            $issue = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $type  = (isset($_REQUEST['type'])    && !empty($_REQUEST['type']))     ? $_REQUEST['type']   : 1 ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryCQShiCaiTrendByType.do?type='.$type.'issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'ssc_trend_type_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_TREND_TYPE) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  时时彩--龙虎走势
     */
    public function ssc_trend_dt()
    {
        try {
            $issue = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryCQShiCaiTrendByDT.do?issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'ssc_trend_dt_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_TREND_DT) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  11选5--龙虎走势
     */
    public function syx5_trend_dt()
    {
        try {
            $issue = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryElevnFiveDTTrend.do?issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'syx5_trend_dt_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SYX5_TREND_DT) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  快乐十分--大小走势
     */
    public function klsf_trend_dx()
    {
        try {
            $periods = (isset($_REQUEST['periods'])   && !empty($_REQUEST['periods']))   ? $_REQUEST['periods']   : '' ;
            $date  = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryKslfDxTrend.do?periods='.$periods.'&date='.$date.'&lotCode='.$code ;
            $key  = 'klsf_trend_dx_'.$date.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_TREND_DX) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快三--大小走势
     */
    public function k3_trend_dx()
    {
        try {
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $issue   = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods']   : '' ;
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/queryBigAndSmallTrend.do?date='.$date.'&issue='.$issue.'&periods='.$periods.'&lotCode='.$code ;
            $key  = 'k3_trend_dx_'.$date.$issue.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_TREND_DX) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  快三--奇偶走势
     */
    public function k3_trend_jo()
    {
        try {
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $issue   = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue']   : '' ;
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods']   : '' ;
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/queryOddAndEvenTrend.do?date='.$date.'&issue='.$issue.'&periods='.$periods.'&lotCode='.$code ;
            $key  = 'k3_trend_jo_'.$date.$issue.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_TREND_JO) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  快乐十分--单双走势
     */
    public function klsf_trend_ds()
    {
        try {
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryKslfDsTrend.do?periods='.$periods.'&date='.$date.'&lotCode='.$code ;
            $key  = 'klsf_trend_ds_'.$date.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_TREND_DS) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  11选5--号码分布
     */
    public function syx5_num_trend()
    {
        try {
            $issue   = (isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])) ? $_REQUEST['issue'] : '' ;
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : '' ;
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryElevnFiveNumberTrend.do?issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'syx5_num_trend_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SYX5_NUM_TREND) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快乐十分--号码分布
     */
    public function klsf_num_trend()
    {
        try {
            $periods   = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : '' ;
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryDrawCodeTrend.do?periods='.$periods.'&date='.$date.'&lotCode='.$code ;
            $key  = 'klsf_num_trend_'.$date.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_NUM_TREND) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--号码走势
     */
    public function pk10_code_trend()
    {
        try {
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryDrawCodeTrend.do?date='.$date.'&periods='.$periods.'&lotCode='.$code ;
            $key  = 'pk10_code_trend_'.$date.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_CODE_TREND) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--位置走势
     */
    public function pk10_location_trend()
    {
        try {
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $url  = 'https://'.self::DOMAIN.'/pks/queryLocationTrend.do?date='.$date.'&periods='.$periods.'&lotCode='.$code ;

            $key  = 'pk10_location_trend_'.$date.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_LOCATION_TREND) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--冠亚和走势图
     */
    public function pk10_gysum_trend()
    {
        try {
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryGysumTrend.do?date='.$date.'&periods='.$periods.'&lotCode='.$code ;
            $key  = 'pk10_gysum_trend_'.$date.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_GYSUM_TREND) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  11选5--和值走势
     */
    public function syx5_trend_sum()
    {
        try {
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;
            $issue   = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue'] : '' ;
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryElevnFiveSumTrend.do?issue='.$issue.'&date='.$date.'&lotCode='.$code ;
            $key  = 'syx5_sum_trend_'.$date.$issue.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SYX5_TREND_SUM) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快三--和值走势
     */
    public function k3_trend_sum()
    {
        try {
            $date    = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;
            $issue   = (isset($_REQUEST['issue'])   && !empty($_REQUEST['issue']))   ? $_REQUEST['issue'] : '' ;
            $periods = (isset($_REQUEST['periods']) && !empty($_REQUEST['periods'])) ? $_REQUEST['periods'] : '' ;
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/lotteryJSFastThree/querySumTrend.do?date='.$date.'&issue='.$issue.'&periods'.$periods.'&lotCode='.$code ;
            $key  = 'k3_trend_sum_'.$date.$issue.$periods.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_K3_TREND_SUM) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--冠亚和两面历史
     */
    public function pk10_history_forgyh()
    {
        try {
            $code    = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryHistoryDataForGyh.do?lotCode='.$code ;
            $key  = 'pk10_history_forgyh_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_HISTORY_FORGYH) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pk10--大小单双历史
     */
    public function pk10_history_fordsdx()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/pks/queryHistoryDataForDsdx.do?lotCode='.$code ;
            $key  = 'pk10_history_fordsdx_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_PK10_HISTORY_FORDSDX) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  时时彩--大小单双历史
     */
    public function ssc_history_fordsdx()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;

            $url  = 'https://'.self::DOMAIN.'/CQShiCai/queryHistoryDataForDsdx.do?lotCode='.$code ;
            $key  = 'ssc_history_fordsdx_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_HISTORY_FORDSDX) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  11选5--大小单双历史
     */
    public function syx5_history_fordsdx()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10018 ;

            $url  = 'https://'.self::DOMAIN.'/ElevenFive/queryHistoryDataForDsdx.do?lotCode='.$code ;
            $key  = 'syx5_history_fordsdx_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_SSC_HISTORY_FORDSDX) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快乐十分--大小单双历史
     */
    public function klsf_history_fordsdx()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/klsf/queryHistoryDataForDsdx.do?lotCode='.$code ;
            $key  = 'klsf_history_fordsdx_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KLSF_HISTORY_FORDSDX) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  广西快乐十分--大小单双历史
     */
    public function gxklsf_history_fordsdx()
    {
        try {
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : '' ;

            $url  = 'https://'.self::DOMAIN.'/gxklsf/queryHistoryDataForDsdx.do?lotCode='.$code ;
            $key  = 'gxklsf_history_fordsdx_'.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_GXKLSF_HISTORY_FORDSDX) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  购彩计划
     *
     */
    public function lotteryPlan()
    {
        try{
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $rows = (isset($_REQUEST['rows'])    && !empty($_REQUEST['rows']))    ? $_REQUEST['rows']    : self::LOTTERY_RECORD_NUM ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/LotteryPlan/getPksPlanList.do?lotCode='.$code.'&rows='.$rows.'&date='.$date ;
            $key  = 'lottery_plan_'.$date.$rows.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_LOTTERY_PLAN) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }

    /**
     *  稳赢杀号
     *
     */
    public function killNum()
    {
        try{
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $rows = (isset($_REQUEST['rows'])    && !empty($_REQUEST['rows']))    ? $_REQUEST['rows']    : self::LOTTERY_RECORD_NUM ;
            $date = (isset($_REQUEST['date'])    && !empty($_REQUEST['date']))    ? $_REQUEST['date']    : date('Y-m-d') ;

            $url  = 'https://'.self::DOMAIN.'/KillNum/getPksKillNumList.do?lotCode='.$code.'&rows='.$rows.'&date='.$date ;
            $key   = 'kill_num_'.$date.$rows.$code ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_KILL_NUM) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  长龙提醒
     */
    public  function dailyDragonList()
    {
        try {
            $params['hot']    = (isset($_REQUEST['hot']) && !empty($_REQUEST['hot'])) ? $_REQUEST['hot'] : 1 ;
            $params['isOpen'] = (isset($_REQUEST['isOpen']) && !empty($_REQUEST['isOpen'])) ? $_REQUEST['isOpen'] : 1 ;
            $params['count']  = (isset($_REQUEST['count']) && !empty($_REQUEST['count'])) ? $_REQUEST['count'] : 2 ;
            $url  = 'https://'.self::DOMAIN.'/dailyDragon/queryDailyDragonList.do?' ;

            $key   = 'dailyDragonList' ; //key前缀
            $data = $this->getCacheData($url,$key,self::CACHE_TIME_DAILY_DRAGON_LIST,'post',$params) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     * 析构函数 关闭memcache链接
     */
    public  function __destruct()
    {
        memcache_close($this->link) ;
    }

}