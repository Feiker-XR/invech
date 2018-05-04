<?php
namespace app\home\controller;

/**
 *  开采网,历史记录数据接口--逻辑处理
 */
class HistoryLogicController extends DataController
{
    const  GAMEID_PK10_900  = 164 ; //900PK拾 ID,用于获取数据
    const  GAMEID_SSC_900   = 163;  //900时时彩 ID,用于获取数据
    const  GAMEID_SSC_JISU  = 120;  //极速时时彩 ID,用于获取数据
    const  GAMEID_JSSC      = 124 ; //极速赛车 ID,用于获取数据

    const IS_CLOSE_CACHE     =  0 ; //是否关闭缓存处理, 1:关闭 0:开启
    const HISTORY_RECORD_NUM = 70 ; //历史记录获取条数


    /**
     *  填充历史记录数据 --900PK拾
     * @param $data
     */
    public   function  formatPk10_900($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data']     = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                $data = isset($data[self::GAMEID_PK10_900]['data']) ? $data[self::GAMEID_PK10_900]['data'] : [] ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['data']) ;
                        $total  = $this->countAmountByPk10($number) ; //计算冠亚和值
                        //1表示虎,0表示龙 | 1表示小,0表示大 | 1表示单,0表示双
                        $res['result']['data'][$key]['sumFS']           = $total ; //冠亚和值
                        $res['result']['data'][$key]['sumBigSamll']     = $this->countBigOrSmallByPk10($total) ; //表示大小
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countDS($total) ; //表示单双
                        $res['result']['data'][$key]['firstDT']         = $this->countDragonOrTiger($number[0],$number[9]) ; //龙虎冠军
                        $res['result']['data'][$key]['secondDT']        = $this->countDragonOrTiger($number[1],$number[8]) ; //龙虎亚军
                        $res['result']['data'][$key]['thirdDT']         = $this->countDragonOrTiger($number[2],$number[7]) ; //龙虎季军
                        $res['result']['data'][$key]['fourthDT']        = $this->countDragonOrTiger($number[3],$number[6]) ; //龙虎第四位
                        $res['result']['data'][$key]['fifthDT']         = $this->countDragonOrTiger($number[4],$number[5]) ; //龙虎第五位
                        $res['result']['data'][$key]['groupCode']       = 1 ;
                        $res['result']['data'][$key]['preDrawCode']     = $lottery['data'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']    = $lottery['number'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']     = $lottery['time'] ; //开奖时间
                    }
                }
            }

            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     *  填充历史记录数据 --极速赛车
     * @param $data
     */
    public   function  formatJssc($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                $data = isset($data[self::GAMEID_JSSC]['data']) ? $data[self::GAMEID_JSSC]['data'] : [] ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['data']) ;
                        $total  = $this->countAmountByPk10($number) ; //计算冠亚和值
                        //1表示虎,0表示龙 | 1表示小,0表示大 | 1表示单,0表示双
                        $res['result']['data'][$key]['sumFS']           = $total ; //冠亚和值
                        $res['result']['data'][$key]['sumBigSamll']     = $this->countBigOrSmallByPk10($total) ; //表示大小
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countDS($total) ; //表示单双
                        $res['result']['data'][$key]['firstDT']         = $this->countDragonOrTiger($number[0],$number[9]) ; //龙虎冠军
                        $res['result']['data'][$key]['secondDT']        = $this->countDragonOrTiger($number[1],$number[8]) ; //龙虎亚军
                        $res['result']['data'][$key]['thirdDT']         = $this->countDragonOrTiger($number[2],$number[7]) ; //龙虎季军
                        $res['result']['data'][$key]['fourthDT']        = $this->countDragonOrTiger($number[3],$number[6]) ; //龙虎第四位
                        $res['result']['data'][$key]['fifthDT']         = $this->countDragonOrTiger($number[4],$number[5]) ; //龙虎第五位
                        $res['result']['data'][$key]['groupCode']       = 1 ;
                        $res['result']['data'][$key]['preDrawCode']     = $lottery['data'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']    = $lottery['number'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']     = $lottery['time'] ; //开奖时间
                    }
                }
            }

            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    /**
     *  填充历史记录数据 --900时时彩
     * @param $data
     */
    public   function  formatSsc900($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                $data = isset($data[self::GAMEID_SSC_900]['data']) ? $data[self::GAMEID_SSC_900]['data'] : [] ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['data']) ;
                        $total  = $this->countAmountBySsc($number) ; //计算和值

                        //1表示双 0表示单 || 0表示大,1表示小 0表示龙 1表示虎
                        $res['result']['data'][$key]['firstBigSmall']      = $this->countBigOrSmallBySsc($number[0]) ; //第一个号码大小
                        $res['result']['data'][$key]['firstSingleDouble']  = $this->countDS($number[0]) ; //第一个号码单双
                        $res['result']['data'][$key]['secondBigSmall']     = $this->countBigOrSmallBySsc($number[1]) ; //第二个号码大小
                        $res['result']['data'][$key]['secondSingleDouble'] = $this->countDS($number[1]) ; //第二个号码单双
                        $res['result']['data'][$key]['thirdBigSmall']      = $this->countBigOrSmallBySsc($number[2]) ; //第三个号码大小
                        $res['result']['data'][$key]['thirdSingleDouble']  = $this->countDS($number[2]); //第三个号码单双
                        $res['result']['data'][$key]['fourthBigSmall']     = $this->countBigOrSmallBySsc($number[3]) ; //第四个号码大小
                        $res['result']['data'][$key]['fourthSingleDouble'] = $this->countDS($number[3]) ; //第四个号码单双
                        $res['result']['data'][$key]['fifthBigSmall']      = $this->countBigOrSmallBySsc($number[4]) ; //第五个号码大小
                        $res['result']['data'][$key]['fifthSingleDouble']  = $this->countDS($number[4]) ; //第五个号码单双
                        $res['result']['data'][$key]['dragonTiger']        = $this->countDragonOrTiger($number[0],$number[4]); //冠军龙虎

                        $res['result']['data'][$key]['behindThree']        = $this->countThreeNumberType($number[0],$number[1],$number[2]) ; // 前三
                        $res['result']['data'][$key]['betweenThree']       = $this->countThreeNumberType($number[1],$number[2],$number[3]) ; // 中三
                        $res['result']['data'][$key]['lastThree']         = $this->countThreeNumberType($number[2],$number[3],$number[4]) ; // 后三

                        $res['result']['data'][$key]['groupCode']          = 2 ; //
                        $res['result']['data'][$key]['preDrawCode']        = $lottery['data'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']       = $lottery['number'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']        = $lottery['time'] ; //开奖时间
                        $res['result']['data'][$key]['sumNum']             = $total ; //总和值
                        $res['result']['data'][$key]['sumBigSmall']        = $this->countBigOrSmallBySsc($total) ; //和值大小
                        $res['result']['data'][$key]['sumSingleDouble']    = $this->countDS($total) ; //和值单双
                    }
                }
            }

            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     *  填充历史记录数据 --极速时时彩
     * @param $data
     */
    public   function  formatJsssc($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message'] = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                $data = isset($data[self::GAMEID_SSC_JISU]['data']) ? $data[self::GAMEID_SSC_JISU]['data'] : [] ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['data']) ;
                        $total  = $this->countAmountBySsc($number) ; //计算和值
                        //各个号码大小单双
                        $res['result']['data'][$key]['firstBigSmall']      = $this->countBigOrSmallBySsc($number[0]) ; //第一个号码大小
                        $res['result']['data'][$key]['firstSingleDouble']  = $this->countDS($number[0]) ; //第一个号码单双
                        $res['result']['data'][$key]['secondBigSmall']     = $this->countBigOrSmallBySsc($number[1]) ; //第二个号码大小
                        $res['result']['data'][$key]['secondSingleDouble'] = $this->countDS($number[1]) ; //第二个号码单双
                        $res['result']['data'][$key]['thirdBigSmall']      = $this->countBigOrSmallBySsc($number[2]) ; //第三个号码大小
                        $res['result']['data'][$key]['thirdSingleDouble']  = $this->countDS($number[2]); //第三个号码单双
                        $res['result']['data'][$key]['fourthBigSmall']     = $this->countBigOrSmallBySsc($number[3]) ; //第四个号码大小
                        $res['result']['data'][$key]['fourthSingleDouble'] = $this->countDS($number[3]) ; //第四个号码单双
                        $res['result']['data'][$key]['fifthBigSmall']      = $this->countBigOrSmallBySsc($number[4]) ; //第五个号码大小
                        $res['result']['data'][$key]['fifthSingleDouble']  = $this->countDS($number[4]) ; //第五个号码单双
                        //冠军龙虎
                        $res['result']['data'][$key]['dragonTiger']        = $this->countDragonOrTiger($number[0],$number[4]);

                        $res['result']['data'][$key]['behindThree']        = $this->countThreeNumberType($number[0],$number[1],$number[2]) ; // 前三
                        $res['result']['data'][$key]['betweenThree']       = $this->countThreeNumberType($number[1],$number[2],$number[3]) ; // 中三
                        $res['result']['data'][$key]['lastThree']         = $this->countThreeNumberType($number[2],$number[3],$number[4]) ; // 后三
                        //开奖号码
                        $res['result']['data'][$key]['groupCode']          = 2 ; //
                        $res['result']['data'][$key]['preDrawCode']        = $lottery['data'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']       = $lottery['number'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']        = $lottery['time'] ; //开奖时间
                        //总和值
                        $res['result']['data'][$key]['sumNum']             = $total ;
                        $res['result']['data'][$key]['sumBigSmall']        = $this->countBigOrSmallBySsc($total) ; //和值大小
                        $res['result']['data'][$key]['sumSingleDouble']    = $this->countDS($total) ; //和值单双
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    /**
     *  填充历史记录数据 --时时彩
     * @param $data
     */
    public   function  formatSsc($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->countAmountBySsc($number) ; //计算和值
                        //各个号码单双大小
                        $res['result']['data'][$key]['firstBigSmall']      = $this->countBigOrSmallBySsc($number[0]) ; //第一个号码大小
                        $res['result']['data'][$key]['firstSingleDouble']  = $this->countDS($number[0]) ; //第一个号码单双
                        $res['result']['data'][$key]['secondBigSmall']     = $this->countBigOrSmallBySsc($number[1]) ; //第二个号码大小
                        $res['result']['data'][$key]['secondSingleDouble'] = $this->countDS($number[1]) ; //第二个号码单双
                        $res['result']['data'][$key]['thirdBigSmall']      = $this->countBigOrSmallBySsc($number[2]) ; //第三个号码大小
                        $res['result']['data'][$key]['thirdSingleDouble']  = $this->countDS($number[2]); //第三个号码单双
                        $res['result']['data'][$key]['fourthBigSmall']     = $this->countBigOrSmallBySsc($number[3]) ; //第四个号码大小
                        $res['result']['data'][$key]['fourthSingleDouble'] = $this->countDS($number[3]) ; //第四个号码单双
                        $res['result']['data'][$key]['fifthBigSmall']      = $this->countBigOrSmallBySsc($number[4]) ; //第五个号码大小
                        $res['result']['data'][$key]['fifthSingleDouble']  = $this->countDS($number[4]) ; //第五个号码单双
                        //冠军龙虎
                        $res['result']['data'][$key]['dragonTiger']        = $this->countDragonOrTiger($number[0],$number[4]);

                        $res['result']['data'][$key]['behindThree']        = $this->countThreeNumberType($number[0],$number[1],$number[2]) ; // 前三
                        $res['result']['data'][$key]['betweenThree']       = $this->countThreeNumberType($number[1],$number[2],$number[3]) ; // 中三
                        $res['result']['data'][$key]['lastThree']         = $this->countThreeNumberType($number[2],$number[3],$number[4]) ; // 后三
                        //开奖数据
                        $res['result']['data'][$key]['groupCode']          = 2 ; //
                        $res['result']['data'][$key]['preDrawCode']        = $lottery['number'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']       = $lottery['period'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']        = $lottery['dateline'] ; //开奖时间
                        //总和
                        $res['result']['data'][$key]['sumNum']             = $total ;
                        $res['result']['data'][$key]['sumBigSmall']        = $this->countBigOrSmallBySsc($total) ; //和值大小
                        $res['result']['data'][$key]['sumSingleDouble']    = $this->countDS($total) ; //和值单双
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     *  填充历史记录数据 -- PK10
     * @param $data
     */
    public   function  formatPk10($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->countAmountByPk10($number) ; //计算冠亚和值
                        $res['result']['data'][$key]['sumFS']           = $total ; //冠亚和值
                        $res['result']['data'][$key]['sumBigSamll']     = $this->countBigOrSmallByPk10($total) ; //表示大小
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countDS($total) ; //表示单双
                        $res['result']['data'][$key]['firstDT']         = $this->countDragonOrTiger($number[0],$number[9]) ; //龙虎冠军
                        $res['result']['data'][$key]['secondDT']        = $this->countDragonOrTiger($number[1],$number[8]) ; //龙虎亚军
                        $res['result']['data'][$key]['thirdDT']         = $this->countDragonOrTiger($number[2],$number[7]) ; //龙虎季军
                        $res['result']['data'][$key]['fourthDT']        = $this->countDragonOrTiger($number[3],$number[6]) ; //龙虎第四位
                        $res['result']['data'][$key]['fifthDT']         = $this->countDragonOrTiger($number[4],$number[5]) ; //龙虎第五位
                        $res['result']['data'][$key]['groupCode']       = 1 ;
                        $res['result']['data'][$key]['preDrawCode']     = $lottery['number'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']    = $lottery['period'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']     = $lottery['dateline'] ; //开奖时间
                    }
                }
            }

            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     *  填充历史记录数据 -- 广东快乐10分
     * @param $data
     */
    public   function  formatGdkl10f($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message']  = '操作成功';
            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->countAmountBySsc($number) ; //计算总和
                        //开奖
                        $res['result']['data'][$key]['groupCode']       = 3 ;
                        $res['result']['data'][$key]['preDrawCode']     = $lottery['number'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']    = $lottery['period'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']     = $lottery['dateline'] ; //开奖时间
                        //龙虎
                        $res['result']['data'][$key]['firstDragonTiger']  = $this->countDragonOrTiger($number[0],$number[7]) ; //第一位
                        $res['result']['data'][$key]['secondDragonTiger'] = $this->countDragonOrTiger($number[1],$number[6]) ; //第二位
                        $res['result']['data'][$key]['thirdDragonTiger']  = $this->countDragonOrTiger($number[2],$number[5]) ; //第三位
                        $res['result']['data'][$key]['fourthDragonTiger'] = $this->countDragonOrTiger($number[3],$number[4]) ; //第四位
                        //尾大小
                        $res['result']['data'][$key]['lastBigSmall']    = $this->countLastBigOrSmall($total) ;
                        //总和
                        $res['result']['data'][$key]['sumNum']          = $total ; //开奖时间
                        $res['result']['data'][$key]['sumBigSmall']     = $this->countBigOrSmallByGdKlsf($total) ; //总和大小
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleByGdKlsf($total) ; //总和单双
                    }
                }
            }

            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     *  填充历史记录数据 -- 广西快乐10分
     * @param $data
     */
    public   function  formatGxkl10f($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message']  = '操作成功';
            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->countAmountBySsc($number) ; //计算总和
                        //开奖
                        $res['result']['data'][$key]['groupCode']       = 8 ;
                        $res['result']['data'][$key]['preDrawCode']     = $lottery['number'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']    = $lottery['period'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']     = $lottery['dateline'] ; //开奖时间
                        //龙虎
                        $res['result']['data'][$key]['firstDragonTiger']= $this->countDragonOrTiger($number[0],$number[4]) ; //第一位
                        //尾大小
                        $res['result']['data'][$key]['lastBigSmall']    = $this->countLastBigOrSmall($total) ;
                        //总和
                        $res['result']['data'][$key]['sumNum']          = $total ; //开奖时间
                        $res['result']['data'][$key]['sumBigSmall']     = $this->countBigOrSmallByGxKlsf($total) ; //总和大小
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleByGdKlsf($total) ; //总和单双
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    /**
     *  填充历史记录数据 --11选5
     * @param $data
     */
    public   function  format11x5($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->countAmountBySsc($number) ; //计算和值
                        //冠军龙虎
                        $res['result']['data'][$key]['dragonTiger']  = $this->countDragonOrTiger($number[0],$number[4]);
                        $res['result']['data'][$key]['behindThree']  = $this->countThreeNumberType($number[0],$number[1],$number[2]) ; // 前三
                        $res['result']['data'][$key]['betweenThree'] = $this->countThreeNumberType($number[1],$number[2],$number[3]) ; // 中三
                        $res['result']['data'][$key]['lastThree']    = $this->countThreeNumberType($number[2],$number[3],$number[4]) ; // 后三
                        //开奖数据
                        $res['result']['data'][$key]['groupCode']    = 6 ;
                        $res['result']['data'][$key]['preDrawCode']  = $lottery['number'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue'] = $lottery['period'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']  = $lottery['dateline'] ; //开奖时间
                        //总和
                        $res['result']['data'][$key]['sumNum']          = $total ;
                        $res['result']['data'][$key]['sumBigSmall']     = $this->countBigOrSmallBy11x5($total) ; //和值大小
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleBy11x5($total) ; //和值单双

                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    /**
     *  填充历史记录数据 --快三
     * @param $data
     */
    public   function  formatK3($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data'] = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->countAmountBySsc($number) ; //计算和值
                        //海鲜
                        $res['result']['data'][$key]['firstSeafood']  = intval($number[0]) ; //统计海鲜
                        $res['result']['data'][$key]['secondSeafood'] = intval($number[1]) ; //统计海鲜
                        $res['result']['data'][$key]['thirdSeafood']  = intval($number[2]) ; //统计海鲜;
                        //开奖数据
                        $res['result']['data'][$key]['groupCode']     = 5 ;
                        $res['result']['data'][$key]['preDrawCode']   = $lottery['number'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue']  = $lottery['period'] ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']   = $lottery['dateline'] ; //开奖时间
                        //总和
                        $res['result']['data'][$key]['sumNum']          = $total ;
                        $res['result']['data'][$key]['sumBigSmall']     = $this->countBigOrSmallByK3($total,$number) ; //和值大小
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleByK3($total) ; //和值单双
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     *  填充历史记录数据 --快乐8
     * @param $data
     */
    public function  formatKl8($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data']     = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = $this->formatNumByKl8($lottery['number']) ;
                        $total  = $this->calculateAmountByKl8($number) ; //计算和值
                        //开奖数据
                        $res['result']['data'][$key]['groupCode']    = 7 ;
                        $res['result']['data'][$key]['preDrawCode']  = implode(',',$number)   ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue'] = $lottery['period']   ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']  = $lottery['dateline'] ; //开奖时间
                        //总和
                        $res['result']['data'][$key]['singleDoubleCount'] = $this->countSingleByKl8($number); //单双
                        $res['result']['data'][$key]['frontBehindCount']  = $this->countFrontOrBehindByKl8($number); //前后统计
                        $res['result']['data'][$key]['sumNum']            = $total ;
                        $res['result']['data'][$key]['sumBsSd']           = $this->countGroupByKl8($total); // 总和组合
                        $res['result']['data'][$key]['sumWuXing']         = $this->countFiveElementsByKl8($total); //五行
                        $res['result']['data'][$key]['sumBigSmall']       = $this->countBigOrSmallByKl8($total) ; //和值大小
                        $res['result']['data'][$key]['sumSingleDouble']   = $this->countSingleOrDoubleByKl8($total) ; //和值单双
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     *  填充历史记录数据 --福彩双色球
     * @param $data
     */
    public function  formatFcssq($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data']     = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = $this->formatNumByKl8($lottery['number']) ;
                        $total  = $this->calculateAmountBySsc($number) ; //计算和值
                        //开奖数据
                        $res['result']['data'][$key]['drawIssue']  = '' ;
                        $res['result']['data'][$key]['drawTime']   = '' ;
                        $res['result']['data'][$key]['frequency']  = '' ;
                        $res['result']['data'][$key]['iconUrl']    = '' ;
                        $res['result']['data'][$key]['lotName']    = '' ;
                        $res['result']['data'][$key]['serverTime'] = '' ;
                        $res['result']['data'][$key]['shelves']    = 0  ;
                        $res['result']['data'][$key]['sjh']        = '' ;
                        $res['result']['data'][$key]['index']      = 100 ;
                        $res['result']['data'][$key]['totalCount'] = 0 ;

                        $res['result']['data'][$key]['lotCode']      = 0 ;
                        $res['result']['data'][$key]['groupCode']    = 39 ;
                        $res['result']['data'][$key]['preDrawCode']  = implode(',',$number)   ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue'] = $lottery['period']   ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']  = $lottery['dateline'] ; //开奖时间
                        //总和
                        $res['result']['data'][$key]['sumNum']          = $total ;
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleBySscDan($total) ; //和值单双
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     *  填充历史记录数据 --超级大乐透
     * @param $data
     */
    public function  formatCjdlt($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data']     = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = $this->formatNumByCjdlt($lottery['number']) ;
                        $total  = $this->calculateAmountBySsc($number) ; //计算和值
                        //开奖数据
                        $res['result']['data'][$key]['drawIssue']  = '' ;
                        $res['result']['data'][$key]['drawTime']   = '' ;
                        $res['result']['data'][$key]['frequency']  = '' ;
                        $res['result']['data'][$key]['iconUrl']    = '' ;
                        $res['result']['data'][$key]['lotName']    = '' ;
                        $res['result']['data'][$key]['serverTime'] = '' ;
                        $res['result']['data'][$key]['sjh']        = '' ;
                        $res['result']['data'][$key]['index']      = 100 ;
                        $res['result']['data'][$key]['shelves']    = 0  ;

                        $res['result']['data'][$key]['lotCode']      = 10040 ;
                        $res['result']['data'][$key]['groupCode']    = 40 ;
                        $res['result']['data'][$key]['preDrawCode']  = implode(',',$number)   ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue'] = $lottery['period']   ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']  = $lottery['dateline'] ; //开奖时间
                        //总和
                        $res['result']['data'][$key]['sumNum']          = $total ;
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleBySscDan($total) ; //和值单双
                        $res['result']['data'][$key]['totalCount'] = 0 ;
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     *  填充历史记录数据 --体彩排列3
     * @param $data
     */
    public function  formatTcpl3($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data']     = [] ;
            $res['result']['message']  = '操作成功';

            if ( !empty($data) ) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->calculateAmountBySsc($number) ; //计算和值
                        //佰拾
                        $res['result']['data'][$key]['sumHundredTen']   = $this->countSumByTcpl3($number[0],$number[1]) ; //和
                        $res['result']['data'][$key]['htSingleDouble']  = $this->countSingleOrDoubleByTcpl3($res['result']['data'][$key]['sumHundredTen']) ; //单双
                        $res['result']['data'][$key]['httailBigSmall']  = $this->countLastBigOrSmall($res['result']['data'][$key]['sumHundredTen']) ; //尾大小
                        //佰个
                        $res['result']['data'][$key]['sumHundredOne']   = $this->countSumByTcpl3($number[0],$number[2]) ; //和
                        $res['result']['data'][$key]['hoSingleDouble']  = $this->countSingleOrDoubleByTcpl3($res['result']['data'][$key]['sumHundredOne']) ; //单双
                        $res['result']['data'][$key]['hotailBigSmall']  = $this->countLastBigOrSmall($res['result']['data'][$key]['sumHundredOne']) ; //尾大小
                        //拾个
                        $res['result']['data'][$key]['sumTenOne']       = $this->countSumByTcpl3($number[1],$number[2]) ; //和
                        $res['result']['data'][$key]['toSingleDouble']  = $this->countSingleOrDoubleByTcpl3($res['result']['data'][$key]['sumTenOne']) ; //单双
                        $res['result']['data'][$key]['totailBigSmall']  = $this->countLastBigOrSmall($res['result']['data'][$key]['sumTenOne']) ; //尾大小
                        //其他数据
                        $res['result']['data'][$key]['drawIssue']  = '' ;
                        $res['result']['data'][$key]['drawTime']   = '' ;
                        $res['result']['data'][$key]['frequency']  = '' ;
                        $res['result']['data'][$key]['iconUrl']    = '' ;
                        $res['result']['data'][$key]['lotName']    = '' ;
                        $res['result']['data'][$key]['serverTime'] = '' ;
                        $res['result']['data'][$key]['shelves']    = 0  ;
                        $res['result']['data'][$key]['index']      = 100 ;
                        $res['result']['data'][$key]['lotCode']    = 0 ;
                        $res['result']['data'][$key]['groupCode']  = 41 ;
                        //开奖数据
                        $res['result']['data'][$key]['preDrawCode']  = $lottery['number']   ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue'] = $lottery['period']   ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']  = $lottery['dateline'] ; //开奖时间
                        //总和相关
                        $res['result']['data'][$key]['sumNum']          = $total ;
                        $res['result']['data'][$key]['sumBigSmall']     = $this->countBigOrSmallByTcpl3($total) ;
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleBySscDan($total) ; //和值单双
                        $res['result']['data'][$key]['totalCount']      = 0  ;
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     *  填充历史记录数据 --体彩排列5
     * @param $data
     */
    public function  formatTcpl5($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data']     = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->calculateAmountBySsc($number) ; //计算和值
                        //开奖数据
                        $res['result']['data'][$key]['drawIssue']  = '' ;
                        $res['result']['data'][$key]['drawTime']   = '' ;
                        $res['result']['data'][$key]['frequency']  = '' ;
                        $res['result']['data'][$key]['iconUrl']    = '' ;
                        $res['result']['data'][$key]['lotName']    = '' ;
                        $res['result']['data'][$key]['serverTime'] = '' ;
                        $res['result']['data'][$key]['shelves']    = 0  ;
                        $res['result']['data'][$key]['sjh']        = '' ;
                        $res['result']['data'][$key]['index']      = 100 ;
                        $res['result']['data'][$key]['totalCount'] = 0 ;

                        $res['result']['data'][$key]['lotCode']      = 0 ;
                        $res['result']['data'][$key]['groupCode']    = 44 ;
                        $res['result']['data'][$key]['preDrawCode']  = $lottery['number'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue'] = $lottery['period']   ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']  = $lottery['dateline'] ; //开奖时间
                        //总和
                        $res['result']['data'][$key]['sumNum']          = $total ;
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleBySscDan($total) ; //和值单双
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }


    /**
     *  填充历史记录数据 --福彩3D
     * @param $data
     */
    public function  formatFc3d($data)
    {
        try {
            $res = [] ;
            $res['errorCode'] = 0;
            $res['message']   = '操作成功';
            $res['result']['businessCode'] = 0;
            $res['result']['data']     = [] ;
            $res['result']['message']  = '操作成功';

            if (!empty($data)) {
                $data = json_decode($data,true) ;
                if ( !empty($data) ) {
                    foreach ($data as $key=>$lottery) {
                        $number = explode(',',$lottery['number']) ;
                        $total  = $this->calculateAmountBySsc($number) ; //计算和值

                        $res['result']['data'][$key]['hoSingleDouble']  = '' ; //单双
                        $res['result']['data'][$key]['hotailBigSmall']  = '' ; //尾大小
                        $res['result']['data'][$key]['htSingleDouble']  = '' ;
                        $res['result']['data'][$key]['httailBigSmall']  = '' ;
                        $res['result']['data'][$key]['toSingleDouble']  = '' ;
                        $res['result']['data'][$key]['totailBigSmall']  = '' ;
                        $res['result']['data'][$key]['sjh']  = '' ;
                        //其他数据
                        $res['result']['data'][$key]['drawIssue']  = '' ;
                        $res['result']['data'][$key]['drawTime']   = '' ;
                        $res['result']['data'][$key]['frequency']  = '' ;
                        $res['result']['data'][$key]['iconUrl']    = '' ;
                        $res['result']['data'][$key]['lotName']    = '' ;
                        $res['result']['data'][$key]['serverTime'] = '' ;
                        $res['result']['data'][$key]['shelves']    = 0  ;
                        $res['result']['data'][$key]['index']      = 100 ;
                        $res['result']['data'][$key]['lotCode']    = 0 ;
                        $res['result']['data'][$key]['groupCode']  = 41 ;
                        //开奖数据
                        $res['result']['data'][$key]['preDrawCode']  = $lottery['number'] ; //开奖号码
                        $res['result']['data'][$key]['preDrawIssue'] = $lottery['period']   ; //开奖期号
                        $res['result']['data'][$key]['preDrawTime']  = $lottery['dateline'] ; //开奖时间
                        //总和相关
                        $res['result']['data'][$key]['sumNum']          = $total ;
                        $res['result']['data'][$key]['sumSingleDouble'] = $this->countSingleOrDoubleBySscDan($total) ; //和值单双
                        $res['result']['data'][$key]['sumHundredOne']   = '' ;
                        $res['result']['data'][$key]['sumHundredTen']   = '' ;
                        $res['result']['data'][$key]['sumBigSmall']     = '' ;
                        $res['result']['data'][$key]['sumTenOne']       = '' ;
                        $res['result']['data'][$key]['totalCount']      = 0  ;
                    }
                }
            }
            return json_encode($res) ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }



    /**
     *  计算和值 --pk10
     * @param $number
     */
    protected  function countAmountByPk10($number)
    {
      return bcadd(intval($number[0]),intval($number[1]),0);
    }

    /**
     *  计算和值 -- 时时彩
     * @param $num
     */
    protected function countAmountBySsc($num)
    {
        return array_sum($num) ;
    }

    /**
     *  统计单双 --PK10
     *  1表示双 0表示单
     * @param $number
     */
    protected  function countDS ($total)
    {
         return  ($total % 2 == 0) ? 1 : 0 ;
    }

    /**
     * 统计大小 --PK10
     *  0表示大 , 1表示小
     * @param $number
     */
    protected  function countBigOrSmallByPk10($total)
    {
        return ($total>11) ? 0 : 1 ;
    }

    /**
     * 统计大小 -- 时时彩
     *  0表示大 , 1表示小
     * @param $number
     */
    protected  function countBigOrSmallBySsc($total)
    {
        return ($total>=23) ? 0 : 1 ;
    }


}