<?php
namespace app\home\controller;

/**
 *  开采网,其他数据接口
 */
class CountLogicController extends DataController
{
    const DOMAIN =  'api.api68.com' ; //数据源域名

    //其他参数
    const LOTTERY_RECORD_NUM   = 10 ; //开奖记录获取条数
    const IS_CLOSE_CACHE       = 0 ; //是否关闭开奖数据缓存, 1 :关闭 0:开启

    //追号杀号,长龙提醒，相关常量定义
    const CACHE_TIME_LOTTERY_PLAN      = 30 ; //购彩计划缓存生存周期
    const CACHE_TIME_KILL_NUM          = 30 ; //稳赢杀号缓存生存周期
    const CACHE_TIME_DAILY_DRAGON_LIST = 1 ; //长龙提醒

    //走势图表，相关常量定义
    //pk10 缓存生存周期
    const CACHE_TIME_PK10_ROAD_BEAD          = 60 * 10 ; //路珠分析
    const CACHE_TIME_PK10_ROAD_BEAD_FB       = 60 * 10 ; //号码前后路珠
    const CACHE_TIME_PK10_HISTORY_DT         = 60 * 10 ; //龙虎统计
    const CACHE_TIME_PK10_TREND_COUNT        = 60 * 10 ; //号码统计
    const CACHE_TIME_PK10_COUNT_NUMBER       = 60 * 10 ; //号码规律统计
    const CACHE_TIME_PK10_COUNT_LONG_DRAGON  = 60 * 10 ; //长龙统计
    const CACHE_TIME_PK10_COUNT_DOUBLE       = 60 * 10 ; //双面统计
    const CACHE_TIME_PK10_CODE_HEAT_STATE    = 60 * 10 ; //冷热分析
    const CACHE_TIME_PK10_CODE_TREND         = 60 * 10 ; //号码走势
    const CACHE_TIME_PK10_LOCATION_TREND     = 60 * 10 ; //位置走势
    const CACHE_TIME_PK10_GYSUM_TREND        = 60 * 10 ; //冠亚和走势图
    const CACHE_TIME_PK10_HISTORY_FORGYH     = 60 * 10 ; //冠亚和两面历史
    const CACHE_TIME_PK10_HISTORY_FORDSDX    = 60 * 10 ; //大小单双历史历史
    //时时彩 缓存生存周期
    const CACHE_TIME_SSC_ROAD_BEAD          = 60 * 10 ; //路珠分析
    const CACHE_TIME_SSC_TREND_COUNT        = 60 * 10 ; //号码统计
    const CACHE_TIME_SSC_HISTORY_FORNUMBER  = 60 * 10 ;//历史号码统计
    const CACHE_TIME_SSC_CODE_TREND         = 60 * 10 ;//基本走势
    const CACHE_TIME_SSC_CODE_HEAT_STATE    = 60 * 10 ; //冷热分析
    const CACHE_TIME_SSC_HISTORY_FORDSDX    = 60 * 10 ; //大小单双历史
    const CACHE_TIME_SSC_NUM_ROAD_BEAD      = 60 * 10 ; //号码路珠
    const CACHE_TIME_SSC_DAY_LONG_DRAGON    = 60 * 10 ; //每日长龙
    const CACHE_TIME_SSC_COUNT_DOUBLE       = 60 * 10 ; //双面统计
    const CACHE_TIME_SSC_TREND_LOCATION     = 60 * 10 ; //定位走势
    const CACHE_TIME_SSC_TREND_TYPE         = 60 * 10 ; //形态走势
    const CACHE_TIME_SSC_TREND_DT           = 60 * 10 ; //龙虎走势
    //11选5 缓存生存周期
    const CACHE_TIME_SYX5_ROAD_BEAD          = 60 * 10 ; //路珠分析
    const CACHE_TIME_SYX5_TODAY_TREND_COUNT  = 60 * 10 ; //今日号码统计
    const CACHE_TIME_SYX5_HISTORY_FORNUMBER  = 60 * 10 ;//历史号码统计
    const CACHE_TIME_SYX5_NUM_TREND          = 60 * 10 ;//号码分布
    const CACHE_TIME_SYX5_CODE_TREND         = 60 * 10 ;//基本走势
    const CACHE_TIME_SYX5_CODE_HEAT_STATE    = 60 * 10 ; //冷热分析
    const CACHE_TIME_SYX5_HISTORY_FORDSDX    = 60 * 10 ; //大小单双历史
    const CACHE_TIME_SYX5_NUM_ROAD_BEAD      = 60 * 10 ; //号码路珠
    const CACHE_TIME_SYX5_DAY_LONG_DRAGON    = 60 * 10 ; //每日长龙
    const CACHE_TIME_SYX5_COUNT_DOUBLE       = 60 * 10 ; //双面统计
    const CACHE_TIME_SYX5_TREND_LOCATION     = 60 * 10 ; //定位走势
    const CACHE_TIME_SYX5_TREND_TYPE         = 60 * 10 ; //形态走势
    const CACHE_TIME_SYX5_TREND_DT           = 60 * 10 ; //龙虎走势
    const CACHE_TIME_SYX5_TREND_SUM          = 60 * 10 ; //和值走势
    //快乐十分 缓存生存周期
    const CACHE_TIME_KLSF_ROAD_BEAD          = 60 * 10 ; //路珠分析
    const CACHE_TIME_KLSF_TODAY_TREND_COUNT  = 60 * 10 ; //今日号码统计
    const CACHE_TIME_KLSF_HISTORY_FORNUMBER  = 60 * 10 ;//历史号码统计
    const CACHE_TIME_KLSF_NUM_TREND          = 60 * 10 ;//号码分布
    const CACHE_TIME_KLSF_CODE_TREND         = 60 * 10 ;//基本走势
    const CACHE_TIME_KLSF_CODE_HEAT_STATE    = 60 * 10 ; //冷热分析
    const CACHE_TIME_KLSF_HISTORY_FORDSDX    = 60 * 10 ; //大小单双历史
    const CACHE_TIME_KLSF_NUM_ROAD_BEAD      = 60 * 10 ; //号码路珠
    const CACHE_TIME_KLSF_TODAY_NUM_ROAD_BEAD= 60 * 10 ; //今日号码路珠
    const CACHE_TIME_KLSF_DAY_LONG_DRAGON    = 60 * 10 ; //每日长龙
    const CACHE_TIME_KLSF_COUNT_DOUBLE       = 60 * 10 ; //双面统计
    const CACHE_TIME_KLSF_TREND_LOCATION     = 60 * 10 ; //定位走势
    const CACHE_TIME_KLSF_TREND_TYPE         = 60 * 10 ; //形态走势
    const CACHE_TIME_KLSF_TREND_DT           = 60 * 10 ; //龙虎走势
    const CACHE_TIME_KLSF_TREND_DX           = 60 * 10 ; //大小走势
    const CACHE_TIME_KLSF_TREND_DS           = 60 * 10 ; //单双走势
    const CACHE_TIME_KLSF_TREND_SUM          = 60 * 10 ; //和值走势
    //广西快乐十分
    const CACHE_TIME_GXKLSF_ROAD_BEAD        = 60 * 10 ;//路珠分析
    const CACHE_TIME_GXKLSF_HISTORY_FORDSDX  = 60 * 10 ;//大小单双历史
    const CACHE_TIME_GXKLSF_NUM_ROAD_BEAD    = 60 * 10 ;//号码路珠
    const CACHE_TIME_GXKLSF_DAY_LONG_DRAGON  = 60 * 10 ;//每日长龙
    const CACHE_TIME_GXKLSF_COUNT_DOUBLE     = 60 * 10 ;//双面统计
    //快三
    const CACHE_TIME_K3_DAY_LONG_DRAGON      = 60 * 10 ;//每日长龙
    const CACHE_TIME_K3_ROAD_BEAD_SUM        = 60 * 10 ;//总和路珠
    const CACHE_TIME_K3_NUM_ROAD_BEAD        = 60 * 10 ;//号码路珠
    const CACHE_TIME_K3_CODE_TREND           = 60 * 10 ;//基本走势
    const CACHE_TIME_K3_TREND_LOCATION       = 60 * 10 ;//定位走势
    const CACHE_TIME_K3_TREND_SUM            = 60 * 10 ;//和值走势
    const CACHE_TIME_K3_TREND_DX             = 60 * 10 ;//大小走势
    const CACHE_TIME_K3_TREND_JO             = 60 * 10 ;//奇偶走势
    const CACHE_TIME_K3_HISTORY_FORNUMBER    = 60 * 10 ;//历史号码统计



    /**
     * 获取缓存数据
     * @param $url       请求地址
     * @param $key       缓存key
     * @param $issue     缓存生存周期
     * @param $method    请求方式
     * @param $postData  POST请求,携带参数
     * @return array|mixed|string
     * @throws \Exception
     */
    protected  function  getCacheData($url='',$key='',$issue=30,$method='get',$postData=[])
    {
        $data = '' ;
        if ($key && $url) {
            $mem  = $this->create_link() ;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data)){
                if ($method == 'get') {
                    $data = $this->getData($url) ;
                } else {
                    $data =$this->getDataByPost($url,$postData);
                }

                $mem->set($key,$data,0,$issue) ;
            }
        }
        return $data ;
    }

}