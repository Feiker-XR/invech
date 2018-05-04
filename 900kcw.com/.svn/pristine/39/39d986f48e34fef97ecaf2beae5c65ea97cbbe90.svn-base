<?php
namespace app\home\controller;

/**
 *  开采网,开奖号码数据接口 逻辑处理
 */
class LotteryLogicController extends DataController
{

    //自营彩种ID
    const  GAMEID_PK10_900  = 164 ; //900PK拾 ID,用于获取数据
    const  GAMEID_SSC_900   = 163;  //900时时彩 ID,用于获取数据
    const  GAMEID_SSC_JISU  = 120;  //极速时时彩 ID,用于获取数据
    const  GAMEID_JSSC      = 124 ; //极速赛车 ID,用于获取数据

    //其他参数
    const LOTTERY_LAST_SUB     = 9 ; //自己平台数据源--开奖数据最后一条数据下标
    const IS_CLOSE_CACHE       = 0 ; //是否关闭开奖数据缓存, 1 :关闭 0:开启
    const IS_CLOSE_COUNT_CACHE = 0 ; //是否关闭统计缓存, 1 :关闭 0:开启

    //平台数据源,数据下标定义
    const DATA_SUB_TIME   = 'dateline' ;//开奖时间字段
    const DATA_SUB_NUMBER = 'number' ; //开奖号码字段
    const DATA_SUB_PERIOD = 'period' ; //开奖期号字段

    //各彩种每天开奖总期数
    const BJPK10_TOTAL = 179 ; //北京pk10
    const JBPK10_TOTAL = 288 ; //900pk10
    const JSSC_TOTAL   = 1152 ; //极速赛车
    //时时彩
    const CQSSC_TOTAL  = 120 ; //重庆时时彩
    const XJSSC_TOTAL  = 96  ; //新疆时时彩
    const TJSSC_TOTAL  = 84  ; //天津时时彩
    const SSC900_TOTAL = 286 ; //900时时彩
    const JSSSC_TOTAL  = 1152; //极速时时彩
    //快乐十分
    const  GDKL10F_TOTAL = 84 ; //广东快乐十分
    const  XYNC_TOTAL    = 97 ; //幸运农场(重庆快乐十分)
    const  GXKL10F_TOTAL = 50 ; //广西快乐十分
    const  TJKL10F_TOTAL = 84 ; //天津快乐十分
    //11选5
    const SYYDJ_TOTAL  = 87 ; //11运夺金
    const GD11X5_TOTAL = 84 ; //广东11选5
    const SH11X5_TOTAL = 90 ; //上海11选5
    const AH11X5_TOTAL = 81 ; //安徽11选5
    const JX11X5_TOTAL = 84 ; //江西11选5
    const JL11X5_TOTAL = 79 ; //吉林11选5
    const GX11X5_TOTAL = 90 ; //广西11选5
    const HB11X5_TOTAL = 81 ; //湖北11选5
    const LN11X5_TOTAL = 83 ; //辽宁11选5
    const JS11X5_TOTAL = 82 ; //江苏11选5
    const ZJ11X5_TOTAL = 85 ; //浙江11选5
    const NMG11X5_TOTAL= 85 ; //内蒙古11选5
    //快三
    const JSK3_TOTAL  = 82 ; //江苏快三
    const JLK3_TOTAL  = 87 ; //吉林快三
    const HBK3_TOTAL  = 81 ; //河北快三
    const AHK3_TOTAL  = 80 ; //安徽快三
    const NMGK3_TOTAL = 73 ; //内蒙古快三
    const FJK3_TOTAL  = 78 ; //福建快三
    const HUBK3_TOTAL = 78 ; //湖北快三
    const BJK3_TOTAL  = 89 ; //北京快三
    const GXK3_TOTAL  = 78 ; //广西快三
    //快乐8
    const BJKL8_TOTAL = 179 ; //北京快乐8
    const TWBG_TOTAL  = 203 ; //台湾宾果
    //其他
    const FCSSQ_TOTAL = 1 ; //福彩双色球
    const FC3D_TOTAL  = 1 ; //福彩3D
    const FCQLC_TOTAL = 1 ; //福彩七乐彩
    const CJDLT_TOTAL = 1 ; //超级大乐透
    const TCPL3_TOTAL = 1 ; //体彩排列3
    const TCPL5_TOTAL = 1 ; //体彩排列5
    const TCQXC_TOTAL = 1 ; //体彩七星彩



    /**
     * 格式化 900北京pk10
     * @param $data
     */
    protected  function formatBjpk10($lotteryData,$totalLottery=self::BJPK10_TOTAL)
    {
        try{
            $lotteryData   = json_decode($lotteryData,true);
            $lastSub       = count($lotteryData)-1 ;
            $lotteryData   = $lotteryData[$lastSub] ;
            $numbers       = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount        =  $this->calculateSum($numbers[0],$numbers[1]) ; //计算冠亚和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']    = $this->getBjpk10LotteryNum($lotteryData[self::DATA_SUB_PERIOD]); //已开多少期
            $data['result']['data']['drawIssue']    = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']     = $this->getBjpk10NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['firstDT']      = $this->countDragonOrTiger($numbers[0],$numbers[9]); //龙虎
            $data['result']['data']['firstNum']     = $numbers[0]; //第一位号码
            $data['result']['data']['secondDT']     = $this->countDragonOrTiger($numbers[1],$numbers[8]); //龙虎
            $data['result']['data']['secondNum']    = $numbers[1]; //第二位号码
            $data['result']['data']['thirdDT']      = $this->countDragonOrTiger($numbers[2],$numbers[7]); //龙虎
            $data['result']['data']['thirdNum']     = $numbers[2] ; //第三位号码
            $data['result']['data']['fourthDT']     = $this->countDragonOrTiger($numbers[3],$numbers[6]); //龙虎
            $data['result']['data']['fourthNum']    = $numbers[3]; //第四位号码
            $data['result']['data']['fifthDT']      = $this->countDragonOrTiger($numbers[4],$numbers[5]); //龙虎
            $data['result']['data']['fifthNum']     = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigCount']= 0;
            $data['result']['data']['sixthNum']     = $numbers[5]; //第六位号码
            $data['result']['data']['seventhNum']   = $numbers[6]; //第七位号码
            $data['result']['data']['eighthNum']    = $numbers[7]; //第八位号码
            $data['result']['data']['ninthNum']     = $numbers[8];//第九位号码
            $data['result']['data']['tenthNum']     = $numbers[9] ;//第十位号码
            $data['result']['data']['sumFS']        = $amount; //冠亚和
            $data['result']['data']['sumBigSamll']    = $this->countBigOrSmallByGy($amount); //统计冠亚和大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDouble($amount) ; //统计冠亚和单双

            $data['result']['data']['frequency']    = '';
            $data['result']['data']['groupCode']    = 1;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/bjpk@3x.png';
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10001 ;
            $data['result']['data']['lotName']      = '北京PK10';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER]; //开奖号码
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time());
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD]; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]; //开奖时间
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['shelves']      = 0;

            $data['result']['data']['totalCount']   = $totalLottery ;
            $data['result']['message']              = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //得到当前pk10已开多少期
    protected  function getBjpk10LotteryNum($num)
    {
       $already = 179 * ( ceil(abs(((strtotime(date('Y-m-d', time()))-strtotime('2007-11-11'))))) /3600/24 )-3774-19 ; //已经开奖了多少期\
       return $num - $already + 1253 ;
    }
    /**
     *  计算bjpk10下一期开奖时间
     * @param string $lastTime  当前期开奖时间
     * @param $already      当天已开多少期
     */
    protected  function getBjpk10NextTime($lastTime='',$already='')
    {
        $nextTime= '' ;
        $addTime =  60 * 5 ; //每一期间隔5分钟
        if ($lastTime) {
            //如果当天已经开奖完毕,那么下一次开奖时间设置为下一天的第一期开奖时间
             if ($already >= self::BJPK10_TOTAL) {
                 $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:07:00' ;
             } else {
                 $nextTime  = bcadd(strtotime($lastTime),$addTime,0);
                 $nextTime  = date('Y-m-d H:i:s',$nextTime) ;
             }
        }
        return $nextTime;
    }


    /**
     * 格式化 900pk10数据
     * @param $data
     */
    protected  function formatJbpk10($lotteryData,$totalLottery=self::JBPK10_TOTAL)
    {
        try{
            $lotteryData   = json_decode($lotteryData,true);
            $lotteryData   = $lotteryData[self::GAMEID_PK10_900] ;
            $numbers       = explode(',',$lotteryData['current']['data']) ;
            $amount        =  $this->calculateSum($numbers[0],$numbers[1]) ; //计算冠亚和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']    = $this->formatLotteryNumber($lotteryData['current']['number']); //已开多少期
            $data['result']['data']['drawIssue']    = $lotteryData['next']['number']; //下一期 期号
            $data['result']['data']['drawTime']     = $lotteryData['next']['time']; //下一期开奖时间

            $data['result']['data']['firstDT']      = $this->countDragonOrTiger($numbers[0],$numbers[9]); //龙虎
            $data['result']['data']['firstNum']     = $numbers[0]; //第一位号码
            $data['result']['data']['secondDT']     = $this->countDragonOrTiger($numbers[1],$numbers[8]); //龙虎
            $data['result']['data']['secondNum']    = $numbers[1]; //第二位号码
            $data['result']['data']['thirdDT']      = $this->countDragonOrTiger($numbers[2],$numbers[7]); //龙虎
            $data['result']['data']['thirdNum']     = $numbers[2] ; //第三位号码
            $data['result']['data']['fourthDT']     = $this->countDragonOrTiger($numbers[3],$numbers[6]); //龙虎
            $data['result']['data']['fourthNum']    = $numbers[3]; //第四位号码
            $data['result']['data']['fifthDT']      = $this->countDragonOrTiger($numbers[4],$numbers[5]); //龙虎
            $data['result']['data']['fifthNum']     = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigCount']= 0;
            $data['result']['data']['sixthNum']     = $numbers[5]; //第六位号码
            $data['result']['data']['seventhNum']   = $numbers[6]; //第七位号码
            $data['result']['data']['eighthNum']    = $numbers[7]; //第八位号码
            $data['result']['data']['ninthNum']     = $numbers[8];//第九位号码
            $data['result']['data']['tenthNum']     = $numbers[9] ;//第十位号码
            $data['result']['data']['sumFS']        = $amount; //冠亚和
            $data['result']['data']['sumBigSamll']    = $this->countBigOrSmallByGy($amount); //统计冠亚和大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDouble($amount) ; //统计冠亚和单双

            $data['result']['data']['frequency']    = '';
            $data['result']['data']['groupCode']    = 1;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/bjpk@3x.png';
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 11001 ;
            $data['result']['data']['lotName']      = '900PK拾';
            $data['result']['data']['preDrawCode']  = $lotteryData['current']['data']; //开奖号码
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time());
            $data['result']['data']['preDrawIssue'] = $lotteryData['current']['number']; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData['current']['time']; //开奖时间
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['shelves']      = 0;

            $data['result']['data']['totalCount']   = $totalLottery ;
            $data['result']['message']              = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     * 格式化极速赛车数据
     * @param $data
     */
    protected  function formatJssc($lotteryData,$totalLottery=self::JSSC_TOTAL)
    {
        try{
            $lotteryData   = json_decode($lotteryData,true);
            $lotteryData   = $lotteryData[self::GAMEID_JSSC] ;
            $numbers       = explode(',',$lotteryData['current']['data']) ;
            $amount        = $this->calculateSum($numbers[0],$numbers[1]) ; //计算冠亚和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']    = $this->formatLotteryNumber($lotteryData['current']['number'],6,4); //已开多少期
            $data['result']['data']['drawIssue']    = $lotteryData['next']['number']; //下一期 期号
            $data['result']['data']['drawTime']     = $lotteryData['next']['time']; //下一期开奖时间

            $data['result']['data']['firstDT']      = $this->countDragonOrTiger($numbers[0],$numbers[9]); //龙虎
            $data['result']['data']['firstNum']     = $numbers[0]; //第一位号码
            $data['result']['data']['secondDT']     = $this->countDragonOrTiger($numbers[1],$numbers[8]); //龙虎
            $data['result']['data']['secondNum']    = $numbers[1]; //第二位号码
            $data['result']['data']['thirdDT']      = $this->countDragonOrTiger($numbers[2],$numbers[7]); //龙虎
            $data['result']['data']['thirdNum']     = $numbers[2] ; //第三位号码
            $data['result']['data']['fourthDT']     = $this->countDragonOrTiger($numbers[3],$numbers[6]); //龙虎
            $data['result']['data']['fourthNum']    = $numbers[3]; //第四位号码
            $data['result']['data']['fifthDT']      = $this->countDragonOrTiger($numbers[4],$numbers[5]); //龙虎
            $data['result']['data']['fifthNum']     = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigCount']= 0;
            $data['result']['data']['sixthNum']     = $numbers[5] ; //第六位号码
            $data['result']['data']['seventhNum']   = $numbers[6] ; //第七位号码
            $data['result']['data']['eighthNum']    = $numbers[7] ; //第八位号码
            $data['result']['data']['ninthNum']     = $numbers[8] ; //第九位号码
            $data['result']['data']['tenthNum']     = $numbers[9] ; //第十位号码
            $data['result']['data']['sumFS']        = $amount;  //冠亚和
            $data['result']['data']['sumBigSamll']    = $this->countBigOrSmallByGy($amount); //统计冠亚和大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDouble($amount) ; //统计冠亚和单双

            $data['result']['data']['frequency']    = '';
            $data['result']['data']['groupCode']    = 1;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/bjpk@3x.png';
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10037 ;
            $data['result']['data']['lotName']      = '极速赛车';
            $data['result']['data']['preDrawCode']  = $lotteryData['current']['data']; //开奖号码
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time());
            $data['result']['data']['preDrawIssue'] = $lotteryData['current']['number']; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData['current']['time']; //开奖时间
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['shelves']      = 0;

            $data['result']['data']['totalCount']   = $totalLottery ;
            $data['result']['message']              = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     *  格式化重庆时时彩数据
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatCqssc($lotteryData,$totalLottery=self::CQSSC_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计时时彩总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getCqsscNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBySscDan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBySscDan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBySscDan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBySscDan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBySscDan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBySscDan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '';
            $data['result']['data']['groupCode']    = 2 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/cqssc@3x.png';
            $data['result']['data']['id']           = 375402 ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10002 ;
            $data['result']['data']['lotName']      = '重庆时时彩';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBySsc($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySsc($amount) ;

            $data['result']['data']['totalCount']        = $totalLottery ;
            $data['result']['message']                   = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //得到重庆时时彩下一期的开奖时间
    //10:00-22:00（72期）10分钟一期，22:00-02:00（48期）5分钟一期 总共120期
    protected  function getCqsscNextTime($lastTime,$already='')
    {
        $nextTime = '' ;
        if ($lastTime) {
            if($already >= self::CQSSC_TOTAL) {
                $nextTime =   $nextTime = date('Y-m-d',time()).' 10:00:00' ;
            } else {
                $time =  strtotime($lastTime) ;
                $nowHour = date('H',time()) ;//得到当前是几点
                if ($nowHour>=10 && $nowHour<22) {
                    $addTime = 60 * 10 ;
                } else {
                    $addTime = 60 * 5 ;
                }
                $time     = bcadd($time,$addTime,0) ; //上一期开奖时间 加上开奖间隔,得到下一期的开奖时间
                $nextTime =  date('Y-m-d H:i:s',$time) ;
            }
        }
        return $nextTime ;
    }


    /**
     *  格式化天津时时彩数据
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatTjssc($lotteryData,$totalLottery=self::TJSSC_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计时时彩总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getTjsscNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBySscDan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBySscDan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBySscDan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBySscDan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBySscDan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBySscDan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 2 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/xjssc@3x.png';
            $data['result']['data']['id']           = 193386;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10003 ;
            $data['result']['data']['lotName']      = '天津时时彩';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBySsc($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySsc($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算天津时时彩下一期开奖时间
    protected function getTjsscNextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::TJSSC_TOTAL) {
               $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:10:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化新疆时时彩数据
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatXjssc($lotteryData,$totalLottery=self::XJSSC_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计时时彩总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getXjsscNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBySscDan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBySscDan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBySscDan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBySscDan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBySscDan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBySscDan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 2 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/xjssc@3x.png';
            $data['result']['data']['id']           = 174583;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10004 ;
            $data['result']['data']['lotName']      = '新疆时时彩';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBySsc($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySsc($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算新疆时时彩下一期开奖时间
    protected function getXjsscNextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::XJSSC_TOTAL) {
               $nextTime = date('Y-m-d',strtotime("+1 days")).' 10:10:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }



    /**
     * 格式化900时时彩数据
     * @param $data
     */
    protected  function formatSsc900($lotteryData,$totalLottery=self::SSC900_TOTAL)
    {
        try {
            $lotteryData   = json_decode($lotteryData,true);
            $lotteryData   = $lotteryData[self::GAMEID_SSC_900] ;
            $numbers       = explode(',',$lotteryData['current']['data']) ;
            $amount        =  $this->calculateAmountBySsc($numbers); //统计时时彩总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData['current']['number'],9,3); //已开多少期
            $data['result']['data']['drawIssue']     = $lotteryData['next']['number']; //下一期 期号
            $data['result']['data']['drawTime']      = $lotteryData['next']['time']; //下一期开奖时间

            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBySscDan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBySscDan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBySscDan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBySscDan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBySscDan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBySscDan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 2 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/cqssc@3x.png';
            $data['result']['data']['id']           = 374255;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 11002 ;
            $data['result']['data']['lotName']      = '900时时彩';
            $data['result']['data']['preDrawCode']  = $lotteryData['current']['data'] ; //开奖号码
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['preDrawIssue'] = $lotteryData['current']['number'] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData['current']['time'] ; //开奖时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBySsc($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySsc($amount) ;

            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     * 格式化极速时时彩数据
     *
     * @param $data
     */
    protected  function formatJsssc($lotteryData='',$total_lottery=self::JSSSC_TOTAL)
    {
        try {
            $lotteryData   = json_decode($lotteryData,true);
            $lotteryData   = $lotteryData[self::GAMEID_SSC_JISU] ;
            $numbers       = explode(',',$lotteryData['current']['data']) ;
            $amount        =  $this->calculateAmountBySsc($numbers); //统计时时彩总和

            $data   = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger'] = 1 ;
            $data['result']['data']['drawCount']   = $this->formatLotteryNumber($lotteryData['current']['number'],6,4); //已开多少期
            $data['result']['data']['drawIssue']   = $lotteryData['next']['number']; //下一期 期号
            $data['result']['data']['drawTime']    = $lotteryData['next']['time']; //下一期开奖时间

            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBySscDan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBySscDan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBySscDan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBySscDan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBySscDan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBySscDan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBySscDan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 2 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/cqssc@3x.png';
            $data['result']['data']['id']           = 374255;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10036 ;
            $data['result']['data']['lotName']      = '极速时时彩';
            $data['result']['data']['preDrawCode']  = $lotteryData['current']['data']   ; //开奖号码
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time())      ;
            $data['result']['data']['preDrawIssue'] = $lotteryData['current']['number'] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData['current']['time']   ; //开奖时间
            $data['result']['data']['sdrawCount']   = '' ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['shelves']      = 0 ;
            $data['result']['data']['status']       = 0 ;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']  =    $this->countBigOrSmallBySsc($amount) ;
            $data['result']['data']['sumSingleDouble'] = $this->countSingleOrDoubleBySsc($amount) ;

            $data['result']['data']['totalCount'] = $total_lottery ;
            $data['result']['message']            = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     *  格式化广东快乐十分数据,
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatGdkl10f($lotteryData,$totalLottery=self::GDKL10F_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData) -1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理

            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']   = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期

            $data['result']['data']['drawIssue']   = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']    = $this->getGdkl10fNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //龙虎
            $data['result']['data']['firstDragonTiger']  = $this->countDragonOrTiger($numbers[0],$numbers[7]) ; //第一位
            $data['result']['data']['secondDragonTiger'] = $this->countDragonOrTiger($numbers[1],$numbers[6]) ; //第二位
            $data['result']['data']['thirdDragonTiger']  = $this->countDragonOrTiger($numbers[2],$numbers[5]) ; //第三位
            $data['result']['data']['fourthDragonTiger'] = $this->countDragonOrTiger($numbers[3],$numbers[4]) ; //第四位
            //计算尾大小
            $data['result']['data']['lastBigSmall']      = $this->countLastBigOrSmall($amount) ;
            //其他数据
            $data['result']['data']['frequency']   = '' ;
            $data['result']['data']['groupCode']   = 3 ;
            $data['result']['data']['iconUrl']     = 'http://webapp.1680180.com/images/icon/3x/gdkl@3x.png' ;
            $data['result']['data']['index']       = 100 ;
            $data['result']['data']['lotCode']     = 10005 ;
            $data['result']['data']['lotName']     = '广东快乐十分' ;
            $data['result']['data']['preDrawCode'] = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开奖期号
            $data['result']['data']['preDrawTime'] = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['serverTime']  = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['shelves']     = 0 ;
            //总和数据
            $data['result']['data']['sumNum']          = $amount ;
            $data['result']['data']['sumBigSmall']     = $this->countBigOrSmallByGdKlsf($amount)    ; //大小
            $data['result']['data']['sumSingleDouble'] = $this->countSingleOrDoubleByGdKlsf($amount); //单双
            $data['result']['data']['totalCount']      = $totalLottery ; //一天总的开奖期数
            $data['result']['message']                 = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //获取广东快乐10分 下一期开奖时间
    protected  function  getGdkl10fNextTime($lastTime='',$already='')
    {
        $nextTime = '';
        if($lastTime) {
            if ($already >= self::GDKL10F_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:12:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lastTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化天津快乐十分数据,
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatTjkl10f($lotteryData,$totalLottery=self::TJKL10F_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData) -1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']   = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']   = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']    = $this->getTjkl10fNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //龙虎
            $data['result']['data']['firstDragonTiger']  = $this->countDragonOrTiger($numbers[0],$numbers[7]) ; //第一位
            $data['result']['data']['secondDragonTiger'] = $this->countDragonOrTiger($numbers[1],$numbers[6]) ; //第二位
            $data['result']['data']['thirdDragonTiger']  = $this->countDragonOrTiger($numbers[2],$numbers[5]) ; //第三位
            $data['result']['data']['fourthDragonTiger'] = $this->countDragonOrTiger($numbers[3],$numbers[4]) ; //第四位
            //计算尾大小
            $data['result']['data']['lastBigSmall']      = $this->countLastBigOrSmall($amount) ;
            //其他数据
            $data['result']['data']['frequency']   = '' ;
            $data['result']['data']['groupCode']   = 3 ;
            $data['result']['data']['iconUrl']     = 'http://webapp.1680180.com/images/icon/3x/gdkl@3x.png' ;
            $data['result']['data']['index']       = 100 ;
            $data['result']['data']['lotCode']     = 10034 ;
            $data['result']['data']['lotName']     = '天津快乐十分' ;
            $data['result']['data']['preDrawCode'] = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开奖期号
            $data['result']['data']['preDrawTime'] = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['serverTime']  = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['shelves']     = 0 ;
            //总和数据
            $data['result']['data']['sumNum']          = $amount ;
            $data['result']['data']['sumBigSmall']     = $this->countBigOrSmallByGdKlsf($amount)    ; //大小
            $data['result']['data']['sumSingleDouble'] = $this->countSingleOrDoubleByGdKlsf($amount); //单双
            $data['result']['data']['totalCount']      = $totalLottery ; //一天总的开奖期数
            $data['result']['message']                 = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算天津快乐10分 下一期开奖时间
    protected  function  getTjkl10fNextTime($lastTime='',$already='')
    {
        $nextTime = '';
        if($lastTime) {
            if ($already >= self::TJKL10F_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:06:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lastTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化幸运农场(重庆快乐十分)数据,
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatXync($lotteryData,$totalLottery=self::XYNC_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData) -1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']   = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']   = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']    = $this->getXyncNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //龙虎
            $data['result']['data']['firstDragonTiger']  = $this->countDragonOrTiger($numbers[0],$numbers[7]) ; //第一位
            $data['result']['data']['secondDragonTiger'] = $this->countDragonOrTiger($numbers[1],$numbers[6]) ; //第二位
            $data['result']['data']['thirdDragonTiger']  = $this->countDragonOrTiger($numbers[2],$numbers[5]) ; //第三位
            $data['result']['data']['fourthDragonTiger'] = $this->countDragonOrTiger($numbers[3],$numbers[4]) ; //第四位
            //计算尾大小
            $data['result']['data']['lastBigSmall']      = $this->countLastBigOrSmall($amount) ;
            //其他数据
            $data['result']['data']['frequency']   = '' ;
            $data['result']['data']['groupCode']   = 4 ;
            $data['result']['data']['iconUrl']     = 'http://webapp.1680180.com/images/icon/3x/gdkl@3x.png' ;
            $data['result']['data']['index']       = 100 ;
            $data['result']['data']['lotCode']     = 10009 ;
            $data['result']['data']['lotName']     = '重庆幸运农场' ;
            $data['result']['data']['preDrawCode'] = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue']= $lotteryData[self::DATA_SUB_PERIOD] ; //开奖期号
            $data['result']['data']['preDrawTime'] = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['serverTime']  = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['shelves']     = 0 ;
            //总和数据
            $data['result']['data']['sumNum']          = $amount ;
            $data['result']['data']['sumBigSmall']     = $this->countBigOrSmallByGdKlsf($amount)    ; //大小
            $data['result']['data']['sumSingleDouble'] = $this->countSingleOrDoubleByGdKlsf($amount); //单双
            $data['result']['data']['totalCount']      = $totalLottery ; //一天总的开奖期数
            $data['result']['message']                 = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算幸运农场 下一期开奖时间
    protected  function  getXyncNextTime($lastTime='',$already='')
    {
        $nextTime = '';
        if($lastTime) {
            if ($already >= self::XYNC_TOTAL) {
                $nextTime = date('Y-m-d',time()).' 10:03:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lastTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化广西快乐十分数据,
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatGxkl10f($lotteryData,$totalLottery=self::GXKL10F_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true) ;
            $lastSub     = count($lotteryData) -1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_PERIOD]) ;
            $amount      =  $this->calculateAmountBySsc($numbers) ; //统计总和
            $data        = [] ;

            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']   = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],7,2); //已开多少期
            $data['result']['data']['drawIssue']   = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']    = $this->getGxkl10fNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //龙虎
            $data['result']['data']['firstDragonTiger'] = $this->countDragonOrTiger($numbers[0],$numbers[7]) ; //第一位
            //尾大小
            $data['result']['data']['lastBigSmall']     = $this->countLastBigOrSmall($amount) ;
            //其他
            $data['result']['data']['frequency']   = '' ;
            $data['result']['data']['groupCode']   = 8 ;
            $data['result']['data']['iconUrl']     = '' ;
            $data['result']['data']['index']       = 100 ;
            $data['result']['data']['lotCode']     = 10038 ;
            $data['result']['data']['lotName']     = '广西快乐十分' ;
            $data['result']['data']['preDrawCode'] = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开奖期号
            $data['result']['data']['preDrawTime'] = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['serverTime']  = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['shelves']     = 0 ;
            //总和
            $data['result']['data']['sumNum']          = $amount ;
            $data['result']['data']['sumBigSmall']     = $this->countBigOrSmallByGxKlsf($amount)    ; //大小
            $data['result']['data']['sumSingleDouble'] = $this->countSingleOrDoubleByGdKlsf($amount); //单双
            $data['result']['data']['totalCount']      = $totalLottery ; //一天总的开奖期数
            $data['result']['message']                 = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算广西快乐十分 下一期开奖时间
    protected  function  getGxkl10fNextTime($lastTime='',$already='')
    {
        $nextTime = '';
        if($lastTime) {
            if ($already >= self::XYNC_TOTAL) {
                $nextTime = date('Y-m-d',time()).' 09:11:50' ;
            } else {
                $addTime = 60 * 15 ; //每10分钟开一期
                $time = strtotime($lastTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }


    /**
     *  格式化11运夺金
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatSyydj($lotteryData,$totalLottery=self::SYYDJ_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计时时彩总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getSyydjNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/xjssc@3x.png';
            $data['result']['data']['id']           = 238344;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10008 ;
            $data['result']['data']['lotName']      = '十一运夺金';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算11运夺金下一期开奖时间
    protected function getSyydjNextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::SYYDJ_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:35:30' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化上海11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatSh11x5($lotteryData,$totalLottery=self::SH11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getSh11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 92152;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10018 ;
            $data['result']['data']['lotName']      = '上海11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算上海11选5下一期开奖时间
    protected function getSh11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::SH11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:00:30' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化广东11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatGd11x5($lotteryData,$totalLottery=self::GD11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getGd11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/gdshiyi@3x.png';
            $data['result']['data']['id']           = 236629;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10006 ;
            $data['result']['data']['lotName']      = '广东11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算广东11选5下一期开奖时间
    protected function getGd11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::GD11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:10:30' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化安徽11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatAh11x5($lotteryData,$totalLottery=self::AH11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getAh11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/gdshiyi@3x.png';
            $data['result']['data']['id']           = 114117;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10017 ;
            $data['result']['data']['lotName']      = '安徽11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算安徽11选5下一期开奖时间
    protected function getAh11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::AH11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:42:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化江西11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatJx11x5($lotteryData,$totalLottery=self::JX11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getJx11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 223149;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10015 ;
            $data['result']['data']['lotName']      = '江西11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算江西11选5下一期开奖时间
    protected function getJx11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::JX11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:10:30' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化吉林11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatJl11x5($lotteryData,$totalLottery=self::JL11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getJl11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 56492;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10023 ;
            $data['result']['data']['lotName']      = '吉林11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算吉林11选5下一期开奖时间
    protected function getJl11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::JL11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:31:20' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化广西11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatGx11x5($lotteryData,$totalLottery=self::GX11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getGx11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 64291;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10022 ;
            $data['result']['data']['lotName']      = '广西11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算广西11选5下一期开奖时间
    protected function getGx11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::GX11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:02:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化湖北11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatHb11x5($lotteryData,$totalLottery=self::HB11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getHb11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 117132;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10020 ;
            $data['result']['data']['lotName']      = '湖北11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算湖北11选5下一期开奖时间
    protected function getHb11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::HB11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:36:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化辽宁11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatLn11x5($lotteryData,$totalLottery=self::LN11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getLn11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 112759;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10019 ;
            $data['result']['data']['lotName']      = '辽宁11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算辽宁11选5下一期开奖时间
    protected function getLn11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::LN11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:49:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化江苏11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatJs11x5($lotteryData,$totalLottery=self::JS11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getJs11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 83487;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10016 ;
            $data['result']['data']['lotName']      = '江苏11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算江苏11选5下一期开奖时间
    protected function getJs11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::JS11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:37:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化浙江11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatZj11x5($lotteryData,$totalLottery=self::ZJ11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getZj11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 58779;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10025 ;
            $data['result']['data']['lotName']      = '浙江11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算浙江11选5下一期开奖时间
    protected function getZj11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::ZJ11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:31:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }


    /**
     *  格式化内蒙古11选5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatNmg11x5($lotteryData,$totalLottery=self::NMG11X5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计11选5总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;

            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['dragonTiger']   = $this->countDragonOrTiger($numbers[0],$numbers[4]) ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getNmg11x5NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间

            $data['result']['data']['enable'] = '';
            //第一位
            $data['result']['data']['firstNum']          = $numbers[0]; //第一位号码
            $data['result']['data']['firstBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[0]);
            $data['result']['data']['firstSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[0]);
            //第二位
            $data['result']['data']['secondNum']          = $numbers[1]; //第二位号码
            $data['result']['data']['secondBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[1]);
            $data['result']['data']['secondSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[1]);
            //第三位
            $data['result']['data']['thirdNum']          = $numbers[2]; //第三位号码
            $data['result']['data']['thirdBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[2]);
            $data['result']['data']['thirdSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[2]);
            //第四位
            $data['result']['data']['fourthNum']         = $numbers[3]; //第四位号码
            $data['result']['data']['fourthBigSmall']    = $this->countBigOrSmallBy11x5Dan($numbers[3]);
            $data['result']['data']['fourthSingleDouble']= $this->countSingleOrDoubleBy11x5Dan($numbers[3]);
            //第五位
            $data['result']['data']['fifthNum']          = $numbers[4]; //第五位号码
            $data['result']['data']['fifthBigSmall']     = $this->countBigOrSmallBy11x5Dan($numbers[4]);
            $data['result']['data']['fifthSingleDouble'] = $this->countSingleOrDoubleBy11x5Dan($numbers[4]);

            $data['result']['data']['behindThree']  = $this->countThreeNumberType($numbers[0],$numbers[1],$numbers[2]) ; //前三
            $data['result']['data']['betweenThree'] = $this->countThreeNumberType($numbers[1],$numbers[2],$numbers[3]) ; //中三
            $data['result']['data']['lastThree']    = $this->countThreeNumberType($numbers[2],$numbers[3],$numbers[4]) ; //后三

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 6 ;
            $data['result']['data']['iconUrl']      = '';
            $data['result']['data']['id']           = 55776;
            $data['result']['data']['index']        = 100;
            $data['result']['data']['lotCode']      = 10024 ;
            $data['result']['data']['lotName']      = '内蒙古11选5';
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ; //开间期号
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME] ; //开奖时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()); //当前时间
            $data['result']['data']['sdrawCount']   = '';
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['status']       = 0;
            $data['result']['data']['sumNum']       = $amount;
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallBy11x5($amount) ;
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBy11x5($amount) ;
            $data['result']['data']['totalCount']     = $totalLottery ;
            $data['result']['message']                = '操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算内蒙古11选5下一期开奖时间
    protected function getNmg11x5NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::ZJ11X5_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:07:00' ;
            } else {
                $addTime = 60 * 10 ; //每10分钟开一期
                $time = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }


    /**
     *  格式化江苏快三
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatJsk3($lotteryData,$totalLottery=self::JSK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getJsk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = 'http://webapp.1680180.com/images/icon/3x/jsks@3x.png' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10007 ;
            $data['result']['data']['lotName']      = '江苏快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算江苏快三下一期开奖时间
    protected function getJsk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::JSK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:40:00' ;
            } else {
                $addTime  = 60 * 10 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化吉林快三
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatJlk3($lotteryData,$totalLottery=self::JLK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getJlk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10027 ;
            $data['result']['data']['lotName']      = '吉林快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算吉林快三下一期开奖时间
    protected function getJlk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::JLK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:29:00' ;
            } else {
                $addTime  = 60 * 9 ; //每9分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化河北快三
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatHbk3($lotteryData,$totalLottery=self::HBK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0;
            $data['message']   = '操作成功';
            $data['result']['businessCode'] = 0;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getHbk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10028 ;
            $data['result']['data']['lotName']      = '河北快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算河北快三下一期开奖时间
    protected function getHbk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::HBK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:40:00' ;
            } else {
                $addTime  = 60 * 10 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化安徽快三
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatAhk3($lotteryData,$totalLottery=self::AHK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getAhk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10030 ;
            $data['result']['data']['lotName']      = '安徽快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算安徽快三下一期开奖时间
    protected function getAhk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::AHK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 08:51:00' ;
            } else {
                $addTime  = 60 * 10 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化内蒙古快三
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatNmgk3($lotteryData,$totalLottery=self::NMGK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getNmgk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10029 ;
            $data['result']['data']['lotName']      = '内蒙古快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算内蒙古快三下一期开奖时间
    protected function getNmgk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::NMGK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:45:55' ;
            } else {
                $addTime  = 60 * 10 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化福建快三
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatFjk3($lotteryData,$totalLottery=self::FJK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期

            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getFjk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10031 ;
            $data['result']['data']['lotName']      = '福建快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算福建快三下一期开奖时间
    protected function getFjk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::FJK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:13:00' ;
            } else {
                $addTime  = 60 * 10 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化湖北快三
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatHubk3($lotteryData,$totalLottery=self::HUBK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getHubk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10032 ;
            $data['result']['data']['lotName']      = '湖北快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算湖北快三下一期开奖时间
    protected function getHubk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::HUBK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:10:00' ;
            } else {
                $addTime  = 60 * 10 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化北京快三
     *  @param array $lotteryData   需要格式化的数据
     *  @param int  $totalLottery   一天总的开奖期数
     *  @return string
     *  @throws \Exception
     */
    protected  function formatBjk3($lotteryData,$totalLottery=self::BJK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->getBjk3LotteryNum($lotteryData[self::DATA_SUB_PERIOD]); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getBjk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10033 ;
            $data['result']['data']['lotName']      = '北京快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount,$numbers)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //得到当前北京快三已开多少期
    protected  function getBjk3LotteryNum($num)
    {
        $period = ($num % 89) + 14 ;
        return $period ;
//        dd(  89 * ( ceil(abs(((strtotime(date('Y-m-d', time()))-strtotime('2007-11-11'))))) /3600/24 ) ) ;
//        $already = 89 * ( ceil(abs(((strtotime(date('Y-m-d', time()))-strtotime('2007-11-11'))))) /3600/24 )-3774-19 ; //已经开奖了多少期\
//        return $num - $already + 1253 ;
    }
    //计算北京快三下一期开奖时间
    protected function getBjk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::HUBK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:10:00' ;
            } else {
                $addTime  = 60 * 10 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化广西快三
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatGxk3($lotteryData,$totalLottery=self::GXK3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      =  $this->calculateAmountBySsc($numbers); //统计快三总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->formatLotteryNumber($lotteryData[self::DATA_SUB_PERIOD],8,3); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getBjk3NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //海鲜
            $data['result']['data']['firstSeafood']  = intval($numbers[0]) ; //统计海鲜
            $data['result']['data']['secondSeafood'] = intval($numbers[1]) ; //统计海鲜
            $data['result']['data']['thirdSeafood']  = intval($numbers[2]) ; //统计海鲜
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['groupCode']    = 5 ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10033 ;
            $data['result']['data']['lotName']      = '广西快3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER] ;
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            //总和相关
            $data['result']['data']['shelves']        = '';
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByK3($amount)  ; //大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByK3($amount); //单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算广西快三下一期开奖时间
    protected function getGxk3NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::GXK3_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:38:00' ;
            } else {
                $addTime  = 60 * 10 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }


    /**
     *  格式化北京快乐8
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatBjkl8($lotteryData,$totalLottery=self::BJKL8_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = $this->formatNumByKl8($lotteryData[self::DATA_SUB_NUMBER]);
            $amount      =  $this->calculateAmountByKl8($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->getBjkl8Num($lotteryData[self::DATA_SUB_PERIOD]); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getBjkl8NextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['sdrawCount']   = '' ;
            $data['result']['data']['groupCode']    = 7  ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10014 ;
            $data['result']['data']['lotName']      = '北京快乐8' ;
            $data['result']['data']['preDrawCode']  = implode(',',$numbers) ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]   ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time())  ; //当前时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time())        ; //今天时间
            $data['result']['data']['shelves']        = 1 ;
            $data['result']['data']['status']         = 0 ;
            //总和相关
            $data['result']['data']['singleDoubleCount'] = $this->countSingleByKl8($numbers); //单双
            $data['result']['data']['frontBehindCount']  = $this->countFrontOrBehindByKl8($numbers); //前后统计

            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBsSd']        = $this->countGroupByKl8($amount); // 总和组合
            $data['result']['data']['sumWuXing']      = $this->countFiveElementsByKl8($amount); //五行
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByKl8($amount)  ; //总和大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByKl8($amount); //总和单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //获取北京快乐8已开多少期
    protected function getBjkl8Num($period)
    {
       $count = 179*(strtotime(date('Y-m-d', time()))-strtotime('2004-09-19'))/3600/24-3857 ;
       $count = $period -$count + 703;
       return $count;
    }
    //计算北京快乐8下一期开奖时间
    protected function getBjkl8NextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::BJKL8_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 09:05:00' ;
            } else {
                $addTime  = 60 * 5 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }

    /**
     *  格式化台湾宾果
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatTwbg($lotteryData,$totalLottery=self::TWBG_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = $this->formatNumByKl8($lotteryData[self::DATA_SUB_NUMBER]);
            $amount      =  $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['drawCount']     = $this->getTwbgNum($lotteryData[self::DATA_SUB_PERIOD]); //已开多少期
            $data['result']['data']['drawIssue']     = $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]); //下一期 期号
            $data['result']['data']['drawTime']      = $this->getTwbgNextTime($lotteryData[self::DATA_SUB_TIME],$data['result']['data']['drawCount']); //下一期开奖时间
            //其他信息
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['sdrawCount']   = '' ;
            $data['result']['data']['groupCode']    = 7  ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10047 ;
            $data['result']['data']['lotName']      = '台湾宾果' ;
            $data['result']['data']['preDrawCode']  = implode(',',$numbers)   ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD];
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]  ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['preDrawDate']  = date('Y-m-d',time()) ; //今天时间
            $data['result']['data']['shelves']        = 1;
            $data['result']['data']['status']         = 0;
            //总和相关
            $data['result']['data']['singleDoubleCount'] = $this->countSingleByKl8($numbers); //单双
            $data['result']['data']['frontBehindCount']  = $this->countFrontOrBehindByKl8($numbers); //前后统计

            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumBsSd']        = $this->countGroupByKl8($amount); // 总和组合
            $data['result']['data']['sumWuXing']      = $this->countFiveElementsByKl8($amount); //五行
            $data['result']['data']['sumBigSmall']    = $this->countBigOrSmallByKl8($amount)  ; //总和大小
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleByKl8($amount); //总和单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //得到台湾宾果开了多少期
    protected  function getTwbgNum($period)
    {
       return ($period % 203) +82 ;
    }
    //计算台湾宾果下一期开奖时间
    protected function getTwbgNextTime($lasTime='',$already='')
    {
        $nextTime = '';
        if($lasTime) {
            if ($already >= self::TWBG_TOTAL) {
                $nextTime = date('Y-m-d',strtotime("+1 days")).' 07:05:00' ;
            } else {
                $addTime  = 60 * 5 ; //每10分钟开一期
                $time     = strtotime($lasTime) ;
                $nextTime = date('Y-m-d H:i:s',bcadd($time,$addTime,0)) ;
            }
        }
        return $nextTime ;
    }


    /**
     *  格式化福彩双色球
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatFcssq($lotteryData,$totalLottery=self::FCSSQ_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = $this->formatNumByKl8($lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['sjh']         = '';
            $data['result']['data']['drawIssue']   = intval( $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]) ); //下一期 期号
            $data['result']['data']['drawTime']    = $this->getFcssqNextTime($lotteryData[self::DATA_SUB_TIME]); //下一期开奖时间

            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['groupCode']    = 39  ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10039 ;
            $data['result']['data']['lotName']      = '福彩双色球' ;
            $data['result']['data']['preDrawCode']  = implode(',',$numbers)   ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]  ;
            $data['result']['data']['serverTime']     = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySscDan($amount); //总和单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算福彩双色球下一期开奖时间
    //每周二/周四/周六 21:30分开奖
    protected function getFcssqNextTime($lasTime='')
    {
        $nextTime = '';
        if($lasTime) {
            $lasTime =  strtotime("$lasTime") ;
            $weekDays = date('N', $lasTime) ; //上一期是星期几
            if ($weekDays==6) {
                //周六距离周二是三天时间
                $time = $lasTime + (60 * 60 * 24 *3) ;
            } else {
                $time = $lasTime + (60 * 60 * 24 *2);
            }
            $time += 600 ; //加10分钟统一 21点30开奖
            $nextTime = date('Y-m-d H:i:s',$time) ;
        }
        return $nextTime ;
    }


    /**
     *  格式化福彩3D
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatFc3d($lotteryData,$totalLottery=self::FC3D_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理

            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            $data['result']['data'] = [] ;
            //下一期数据
            $data['result']['data']['drawIssue']   = intval( $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]) ); //下一期 期号
            $data['result']['data']['drawTime']    = $this->getFc3dNextTime($lotteryData[self::DATA_SUB_TIME]); //下一期开奖时间
            //其他数据
            $data['result']['data']['sjh']         =  ''; //试机号
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['groupCode']    = 41  ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10041 ;
            $data['result']['data']['lotName']      = '福彩3D' ;
            $data['result']['data']['preDrawCode']  = implode(',',$numbers)   ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]  ;
            $data['result']['data']['serverTime']     = date('Y-m-d H:i:s',time()) ; //当前时间
            //总和
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySscDan($amount); //总和单双
            $data['result']['data']['totalCount']     = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算福彩3D下一期开奖时间
    //每日 21:15分开奖
    protected function getFc3dNextTime($lasTime='')
    {
        $nextTime = '';
        if($lasTime) {
            $lasTime =  strtotime("$lasTime") + (3600 *24) ;
            $nextTime = date('Y-m-d H:i:s',$lasTime) ;
        }
        return $nextTime ;
    }


    /**
     *  格式化福彩七乐彩
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatFc7lc($lotteryData,$totalLottery=self::FCQLC_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = $this->formatNumByKl8($lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['sjh']          = '';
            $data['result']['data']['drawTime']     = $this->getFcqlcNextTime($lotteryData[self::DATA_SUB_TIME]); //下一期开奖时间
            $data['result']['data']['drawIssue']    = intval( $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]) ); //下一期 期号
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['groupCode']    = 42  ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10042 ;
            $data['result']['data']['lotName']      = '福彩七乐彩' ;
            $data['result']['data']['preDrawCode']  = implode(',',$numbers)   ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]  ;
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySscDan($amount); //总和单双
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['totalCount']   = $totalLottery; //每天开奖总期数
            $data['result']['message'] ='操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算福彩七乐彩下一期开奖时间
    //每周一/周三/周五 21:30分开奖
    protected function getFcqlcNextTime($lasTime='')
    {
        $nextTime = '';
        if($lasTime) {
            $lasTime =  strtotime("$lasTime") ;
            $weekDays = date('N', $lasTime) ; //上一期是星期几
            if ($weekDays == 5) {
                //周五距离周一是三天
                $time =  $lasTime + (60 * 60 * 24 *3) ;
            } else {
                $time =  $lasTime + (60 * 60 * 24 *2) ;
            }
            $time += 600; //加10分钟，统一到 21点30开奖
            $nextTime = date('Y-m-d H:i:s',$time) ;
        }
        return $nextTime ;
    }


    /**
     *  格式化超级大乐透
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatCjdlt($lotteryData,$totalLottery=self::CJDLT_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = $this->formatNumByCjdlt($lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['sjh']          = '';
            $data['result']['data']['drawTime']     = $this->getCjdltNextTime($lotteryData[self::DATA_SUB_TIME]); //下一期开奖时间
            $data['result']['data']['drawIssue']    = intval( $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]) ); //下一期 期号
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['groupCode']    = 40  ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10040 ;
            $data['result']['data']['lotName']      = '超级大乐透' ;
            $data['result']['data']['preDrawCode']  = implode(',',$numbers)   ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]  ;
            $data['result']['data']['totalCount']   = $totalLottery; //每天开奖总期数
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySscDan($amount); //总和单双
            $data['result']['data']['serverTime']     = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['message'] ='操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算超级大乐透下一期开奖时间
    //每周一/周三/周六 21:30分开奖
    protected function getCjdltNextTime($lasTime='')
    {
        $nextTime = '';
        if($lasTime) {
            $lasTime =  strtotime("$lasTime") ;
            $weekDays = date('N', $lasTime) ; //上一期是星期几
            if ($weekDays == 3) {
                //周三距离周六是三天
                $time =  $lasTime + (60 * 60 * 24 *3) ;
            } else {
                $time =  $lasTime + (60 * 60 * 24 *2) ;
            }

            $nextTime = date('Y-m-d H:i:s',$time) ;
        }
        return $nextTime ;
    }


    /**
     *  格式化体彩排列3
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatTcpl3($lotteryData,$totalLottery=self::TCPL3_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['sjh']          = '';
            $data['result']['data']['drawTime']     = $this->getTcpl3NextTime($lotteryData[self::DATA_SUB_TIME]); //下一期开奖时间
            $data['result']['data']['drawIssue']    = intval( $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]) ); //下一期 期号
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['groupCode']    = 43  ;
            $data['result']['data']['lotCode']      = 10043 ;
            $data['result']['data']['lotName']      = '体彩排列3' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER]  ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]  ;
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()) ; //当前时间
            //总和相关
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySscDan($amount); //总和单双
            $data['result']['data']['totalCount']   = $totalLottery; //每天开奖总期数

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算体彩排列三下一期开奖时间
    //每天20:30分开奖
    protected function getTcpl3NextTime($lasTime='')
    {
        $nextTime = '';
        if($lasTime) {
            $lasTime =  strtotime("$lasTime") + (3600 * 24);
            $nextTime = date('Y-m-d H:i:s',$lasTime) ;
        }
        return $nextTime ;
    }

    /**
     *  格式化体彩排列5
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatTcpl5($lotteryData,$totalLottery=self::TCPL5_TOTAL)
    {
        try {
            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['sjh']          = '';
            $data['result']['data']['drawTime']     = $this->getTcpl5NextTime($lotteryData[self::DATA_SUB_TIME]); //下一期开奖时间
            $data['result']['data']['drawIssue']    = intval( $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]) ); //下一期 期号
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['groupCode']    = 44  ;
            $data['result']['data']['lotCode']      = 10044 ;
            $data['result']['data']['lotName']      = '体彩排列五' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER]  ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]  ;
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySscDan($amount); //总和单双
            $data['result']['data']['totalCount']   = $totalLottery; //每天开奖总期数
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['data']['index']        = 100 ;
            $data['result']['message'] ='操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算体彩排列五下一期开奖时间
    //每天20:30分开奖
    protected function getTcpl5NextTime($lasTime='')
    {
        $nextTime = '';
        if($lasTime) {
            $lasTime =  strtotime("$lasTime") + (3600 * 24);
            $nextTime = date('Y-m-d H:i:s',$lasTime) ;
        }
        return $nextTime ;
    }


    /**
     *  格式化体彩七星彩
     * @param array $lotteryData   需要格式化的数据
     * @param int  $totalLottery   一天总的开奖期数
     * @return string
     * @throws \Exception
     */
    protected  function formatTcqxc($lotteryData,$totalLottery=self::TCQXC_TOTAL)
    {
        try {

            $lotteryData = json_decode($lotteryData,true);
            $lastSub     = count($lotteryData)-1 ;
            $lotteryData = $lotteryData[$lastSub] ; //取最新一条数据处理
            $numbers     = explode(',',$lotteryData[self::DATA_SUB_NUMBER]) ;
            $amount      = $this->calculateAmountBySsc($numbers); //统计总和

            $data = [] ;
            $data['errorCode'] = 0 ;
            $data['message']   = '操作成功' ;
            $data['result']['businessCode'] = 0 ;
            //开奖数据
            $data['result']['data'] = [] ;
            $data['result']['data']['sjh']          = '';
            $data['result']['data']['drawTime']     = $this->getTcqxcNextTime($lotteryData[self::DATA_SUB_TIME]); //下一期开奖时间
            $data['result']['data']['drawIssue']    = intval( $this->getNextPeriod($lotteryData[self::DATA_SUB_PERIOD]) ); //下一期 期号
            $data['result']['data']['frequency']    = '' ;
            $data['result']['data']['iconUrl']      = '' ;
            $data['result']['data']['shelves']      = 0;
            $data['result']['data']['groupCode']    = 45  ;
            $data['result']['data']['index']        = 100 ;
            $data['result']['data']['lotCode']      = 10045 ;
            $data['result']['data']['lotName']      = '体彩七星彩' ;
            $data['result']['data']['preDrawCode']  = $lotteryData[self::DATA_SUB_NUMBER]  ; //开奖号码
            $data['result']['data']['preDrawIssue'] = $lotteryData[self::DATA_SUB_PERIOD] ;
            $data['result']['data']['preDrawTime']  = $lotteryData[self::DATA_SUB_TIME]  ;
            $data['result']['data']['sumNum']         = $amount  ; //总和
            $data['result']['data']['sumSingleDouble']= $this->countSingleOrDoubleBySscDan($amount); //总和单双
            $data['result']['data']['totalCount']   = $totalLottery; //每天开奖总期数
            $data['result']['data']['serverTime']   = date('Y-m-d H:i:s',time()) ; //当前时间
            $data['result']['message'] ='操作成功';

            unset($lotteryData) ;
            return json_encode($data) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }
    //计算体彩七星彩下一期开奖时间
    //每周二/周五/周日 20:30分开奖
    protected function getTcqxcNextTime($lasTime='')
    {
        $nextTime = '';
        if($lasTime) {
            $lasTime =  strtotime("$lasTime") ;
            $weekDays = date('N', $lasTime) ; //上一期是星期几
            if ( $weekDays==2) {
                //周三距离周六是三天
                $time =  $lasTime + (60 * 60 * 24 *3) ;
            } else {
                $time =  $lasTime + (60 * 60 * 24 *2) ;
            }
            $nextTime = date('Y-m-d H:i:s',$time) ;
        }
        return $nextTime ;
    }




    //计算出下一期,期号
    protected  function getNextPeriod($period)
    {
        return bcadd($period,1,0);
    }

    /**
     * 格式化时间戳
     * @param $data
     */
    public function formatTime(&$data)
    {
        $tmp = json_decode($data,true) ;
        $tmp['result']['data']['serverTime'] = date('Y-m-d H:i:s',time()) ;
        $data = json_encode($tmp) ;
        unset($tmp) ;
    }


    /**
     *
     *  格式化移动端首页数据
     * @param string $data
     */
    protected  function formatLottery_list($data='')
    {
       $data = json_decode($data,true) ;
       unset($data['result']['data'][11]);
       unset($data['result']['data'][12]);
       $data = json_encode($data) ;
       return $data ;
    }

    /**
     *  判断是否到了下一期的开奖时间
     * @param $data
     */
    protected  function isNewLottery($data=[])
    {
        $status = false ;
         $data = json_decode($data,true) ;
        if ( isset($data['result']['data']['drawTime']) && !empty($data['result']['data']['drawTime']) ) {
            $time = time(); //当前时间
            $next_time = strtotime($data['result']['data']['drawTime']) ; //下一期开奖时间
            if ($time >= $next_time) {
                $status = true ;
            }
        }
        return $status ;
    }

    /**
     *  获取指定种类数据
     *  category       0:热门彩 1 :高频彩  2:全国彩 3:境外彩
     *   isContainsHot   0: 只返回该彩种类型数据    1:在彩种类型数据的基础上,还会加上热门彩种数据
     * @throws \Exception
     */
    protected  function getCategoryData()
    {
        try {
            $data          = [] ;
            $category      = isset($_REQUEST['category'])      ? $_REQUEST['category']      : 1 ;
            $isContainsHot = isset($_REQUEST['isContainsHot']) ? $_REQUEST['isContainsHot'] : 0 ;
            $res['errorCode'] = 0 ;
            $res['message']   = '操作成功' ;
            $res['result']['businessCode'] = 0 ;
            $res['result']['message'] = '操作成功' ;
            $res['result']['data']    = [] ;

            //获取对应类型的彩种数据
            switch ($category) {

                case 1 :
                    $data = $this->getFrequencyData(); break ;
                case 2 :
                    $data = $this->getOfficialData(); break ;
                case 3 :
                    $data = $this->getAbroadData(); break ;
                case 4 :
                    $frequency = $this->getFrequencyData();
                    $official  = $this->getOfficialData();
                    $abroad    = $this->getAbroadData();
                    $data      = array_merge($frequency,$official) ;
                    $data      = array_merge($data,$abroad) ;
                    break ;
                default:
                    $data = [] ;
            }

            if ($isContainsHot) {
                $hot = $this->getHotData();
                $data  = array_merge($hot,$data);
            }
            $res['result']['data'] =  $data ;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
        return json_encode($res) ;
    }
    //获取热门彩数据
    protected function getHotData()
    {
        $list = $this->getHotList() ;
        $res = [] ;
        $tmp = [] ;
        foreach ($list as $val) {
            $tmp = $this->$val['api'](self::RESPONSE_MODEL_RETURN) ;
            $res[] = $this->formatCustomData($tmp) ;
        }
        return $res ;
    }
    //获取高频彩数据
    protected  function getFrequencyData()
    {
        $list = $this->getFrequencylist() ;
        $res  = [] ;
        $tmp  = [] ;
        foreach ($list as $val) {
            $tmp = $this->$val['api'](self::RESPONSE_MODEL_RETURN) ;
            $res[] = $this->formatCustomData($tmp) ;
        }

        return $res ;
    }
    //获取全国彩数据
    protected  function getOfficialData()
    {
        $list = $this->getOfficialList() ;
        $res = [] ;
        $tmp = [] ;
        foreach ($list as $val) {
            $tmp = $this->$val['api'](self::RESPONSE_MODEL_RETURN) ;
            $res[] = $this->formatCustomData($tmp) ;
        }
        return $res ;
    }
    //获取境外彩数据
    protected  function getAbroadData()
    {
        $list = $this->getAbroadList() ;
        $res = [] ;
        $tmp = [] ;
        foreach ($list as $val) {
            $tmp = $this->$val['api'](self::RESPONSE_MODEL_RETURN) ;
            $res[] = $this->formatCustomData($tmp) ;
        }
        return $res ;
    }

    /**
     * 反对对应code的彩种数据
     * @param string $code
     */
    protected  function getLotteryDataByCode($code='')
    {
        $res= '';
        if ($code) {
            $list = $this->getLotteryList();
            if ( isset($list[$code]) ) {
                $res = $this->$list[$code]['api'](self::RESPONSE_MODEL_RETURN) ;
            }
        }
        return $res ;
    }


    /**
     *  处理移动端首页,需要返回自定义数据
     * @param $codes
     */
     protected  function disposeCustomData($codes)
     {
        try {
            $codeArr = explode(',',$codes) ;
            $list    = $this->getLotteryList() ;
            $tmp     = [] ;
            $res['errorCode'] = 0 ;
            $res['message']   = '操作成功' ;
            $res['result']['businessCode'] = 0 ;
            $res['result']['message'] = '操作成功' ;
            $res['result']['data']    = [] ;

            //获取到用户要请求的彩种资料
            foreach ($codeArr as $val) {
                if (isset($list[$val])) {
                    $tmp =  $this->$list[$val]['api'](self::RESPONSE_MODEL_RETURN) ;
                    $res['result']['data'][] = $this->formatCustomData($tmp) ; //只取出必要字段
                }
            }

        } catch (\Exception $e) {
            $res['errorCode'] = 1 ;
            $res['message'] = '网络延迟,请重试...' ;
        }
         return  json_encode($res) ;
     }
     //取出开奖数据中的必要字段
     private function formatCustomData($data)
     {
         $res = [] ;
        try {
            $data =json_decode($data,true) ;
            $res = $data['result']['data'] ;
        } catch (\Exception $e){
        }
        return $res ;
     }




    /**
     *  获取自营彩种数据
     * @param $lotteryNum
     * @param $url
     */
    protected  function getSelfData($lottery_num,$url,$typeId)
    {
        try {
            $data = [];
            if (!empty($lottery_num)) {
                //循环请求判断开奖期号,确保返回的是最新的开奖数据
                do{
                    $data        = $this->getData($url) ;
                    $tmp         = json_decode($data,true) ;
                    $current_num = $tmp[$typeId]['current']['number'] ; //数据接口当前的最新数据期号
                    usleep(1000000) ;
//                    sleep(1)  ;
                }while($current_num < $lottery_num) ;
            } else {
                $data = $this->getData($url) ;
            }
            return $data ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     *  获取平台数据源数据
     * @param $lotteryNum
     * @param $url
     */
    protected  function getPlatformData($lottery_num,$url)
    {
        try {
            $data = [];
            if (!empty($lottery_num)) {
                //循环请求判断开奖期号,确保返回的是最新的开奖数据
                do{
                    $data        = $this->getData($url) ;
                    $tmp         = json_decode($data,true) ;
                    $current_num = $tmp[self::LOTTERY_LAST_SUB][self::DATA_SUB_PERIOD] ; //数据接口当前的最新数据期号
                    usleep(1000000) ;
                }while($current_num < $lottery_num) ;
            } else {
                $data = $this->getData($url) ;
            }
            return $data ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     *  获取第三方数据源数据
     * @param $lotteryNum
     * @param $url
     */
    protected  function getThridData($lottery_num,$url)
    {
        try {
            $data = [];
            if (!empty($lottery_num)) {
                //循环请求判断开奖期号,确保返回的是最新的开奖数据
                do{
                    $data        = $this->getData($url) ;
                    $tmp         = json_decode($data,true) ;
                    $current_num = isset($tmp['result']['data']['preDrawIssue']) ? $tmp['result']['data']['preDrawIssue'] : '' ; //数据接口当前的最新数据期号
                    if (empty($current_num)) { break;}

                    usleep(1000000) ;
                }while($current_num < $lottery_num) ;
            } else {
                $data = $this->getData($url) ;
            }
            return $data ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


}