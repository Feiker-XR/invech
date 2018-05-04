<?php
//
//                                  _oo8oo_
//                                 o8888888o
//                                 88" . "88
//                                 (| -_- |)
//                                 0\  =  /0
//                               ___/'==='\___
//                             .' \\|     |// '.
//                            / \\|||  :  |||// \
//                           / _||||| -:- |||||_ \
//                          |   | \\\  -  /// |   |
//                          | \_|  ''\---/''  |_/ |
//                          \  .-\__  '-'  __/-.  /
//                        ___'. .'  /--.--\  '. .'___
//                     ."" '<  '.___\_<|>_/___.'  >' "".
//                    | | :  `- \`.:`\ _ /`:.`/ -`  : | |
//                    \  \ `-.   \_ __\ /__ _/   .-` /  /
//                =====`-.____`.___ \_____/ ___.`____.-`=====
//                                  `=---=`
//
//
//               ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//
//                          佛祖保佑         永不宕机/永无bug
// +----------------------------------------------------------------------
// | FileName: Getlivedata.php
// +----------------------------------------------------------------------
// | CreateDate: 2018年4月8日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Getlivedata extends Command
{

    protected function configure()
    {
        $this->setName('getlivedata')
            ->setDescription('获取真人注单')
            ->addArgument('gametype')
            ->addArgument('begin')
            ->addArgument('end');
    }

    protected function execute(Input $input, Output $output)
    {
        // 停机重启的情况
        // 体育的注单
        // 彩票的注单修改时间不一样
        $args = $input->getArguments();
        $gametype = $args['gametype'];
        switch ($gametype) {
            case 'bbdz':
                $this->getBbindz($args);
                break;
            case 'bbzr':
                $this->getBbinZr($args);
                break;
            case 'agdz':
                $this->getAg($args);
                break;
            case 'agzr':
                $this->getAgzr($args);
                break;
            case 'ag_import':
                $this->ag_import();
                break;
            case 'bbin_import':
                $this->bbin_import();
                break;
            case 'mgdz':
                $this->getMg($args);
                break;
            case 'ptdz':
                $this->getPt($args);
                break;
            case 'ogzr':
                $this->getOg($args);
                break;
        }
    }

    protected function getAg($args)
    {
        $step = 120;
        $bbin = Db('ag_gameresult', 'mongo');
        $gamecode = [
            'YPLA','YFD','YBEN','YHR','YGS','YFR','YDZ','YBIR','YFP','YMFD','YMFR','YMBN','YGFS','YJFS','YMBI','YMBA','YMBZ','YMAC','SB50','DTA8','DTAB','DTAF','DTAG','DTAQ','DTAT','SB49','SB45','DTAR','DTB1','DTAM','DTAZ','SC03','SX02','DTA0','TA1L','TA1O','XG10','XG11','XG12','XG13','XG16','TA0L','TA0M','TA0N','TA0O','TA0P','TA0Q','TA0S','TA0T','TA0U','TA0V','TA0W','TA0X','TA0Y','TA01','TA02','TA05','TA07','TA0C','SB38','TA0Z','TA12','TA17','TA18','TA1C','TA1F','TG02','SB37','SB36','SB35','SB34','SB32','FRU2','SB33','PKBB','PKBD','SB31','XG09','XG01','XG02','XG03','XG04','XG05','XG06','XG07','XG08','SB30','AV01','SB20','SB22','SB23','SB19','SB21','SB24','SB25','SB26','SB27','SB28','SB29','TGLW','SB13','SB14','SB15','SB16','SB17','SB18','SB07','SB08','SB09','SB10','SB11','SB12','SB01','SB02','SB03','SB04','SB05','SB06','SLM3','SLM1','SLM2','PKBJ','FRU'
        ];
        if(isset($args['begin'])){
            $begin = $args['begin'];
        }else{
            $last_time = Db('live_data')->field('betTime')->where('platform','eq','ag')->where('gamecode','in',$gamecode)->order('betTime','desc')->find();
            $begin = $last_time['betTime'];
        }
        $end = $args['end'] ?? date('Y-m-d H:i:s',strtotime($begin) + $step);
        $s = time() - $step;
        if(strtotime($end) > $s){
            $end = date('Y-m-d H:i:s',$s);
        }
        
        
        do{
            $where['betTime'] = ['between',[$begin,$end]];
            $where['suffix'] = 'hga';
            $where['gameType'] = [
                'in',
                $gamecode
            ];
            $data = $bbin->where($where)->order('betTime',1)->select();
            $insertData = [];
            $tmp = [];
            foreach ($data as $k => $v) {
                $str2 = substr($v['username'], 0, 2);
                if ($str2 == 'jp') {
                    $tmp['username'] = substr($v['username'], 2);
                } else {
                    $tmp['username'] = $v['username'];
                }
                $tmp['order_id'] = $v['billNo'];
                $tmp['platform'] = 'ag';
                $tmp['gamecode'] = $v['gameType'];
                $tmp['betAmount'] = $v['betAmount'];
                if(!isset($v['validBetAmount'])){
                    if($v['Result'] == 'W' || $v['Result'] == 'L' ){
                        $tmp['validBetAmount'] = $v['validBetAmount'];
                        $tmp['isFs'] = 1;
                        $tmp['fsRate'] = 0;
                        $tmp['fsMoney'] = 0;
                    }
                }else{
                    $tmp['validBetAmount'] = $v['validBetAmount'];
                }
                //$tmp['validBetAmount'] = isset($v['Commissionable']) ? $v['Commissionable']: 0;
                $tmp['betTime'] = $v['betTime'];
                $tmp['payOff'] = $v['netAmount'];
                $res = Db('live_data')->where('order_id','eq',$v['billNo'])->where('platform','eq','ag')->find();
                if($res){
                    Db('live_data')->where('order_id','eq',$v['billNo'])->where('platform','eq','ag')->update($tmp);
                }else{
                    Db('live_data')->insert($tmp);
                }
                $tmp = [];
                
            }
            $begin = $end;
            $end = date('Y-m-d H:i:s',strtotime($end) + $step);
            $s = time() - $step;
            if(strtotime($end) > $s){
                $end = date('Y-m-d H:i:s',$s);
                $begin = date('Y-m-d H:i:s',$s-$step-10);
            }
            echo 'begin:'.$begin,PHP_EOL,'end:'.$end,PHP_EOL;
            sleep(1);
        }while(1);
    }

    protected function ag_import(){
        $mysql = db('ag_gameresult');
        $mongo = db('ag_gameresult', 'mongo');
        $data = [1];
        $page = 0;
        $page_size = 10000;
        $last_id = 0;
        while($data){
            $data = $mysql->where("id>{$last_id}")->order('id')->limit($page_size);
            $page++;
            $bulk = new \MongoDB\Driver\BulkWrite;
            foreach ($data as $row){
                $last_id = $row['id'];
                unset($row['id']);
                foreach ($row as &$value){
                    if(is_numeric($value)) $value+=0;
                }
//                $mongo->where('billNo', $row['billNo'])->update($row, ['upsert' => true]);
                $bulk->update(['billNo'=>$row['billNo']], $row, ['upsert' => true]);
//                echo "处理{$row['id']}完成\n";
            }
            $mongo->execute("data.ag_gameresult", $bulk);
            echo "处理第{$page}页完成！\n";
//            break;
        }
    }
    
    protected function getAgzr($args){
        $step = 120;
        $bbin = Db('ag_gameresult', 'mongo');
        $gamecode = ['BAC','CBAC','LINK','DT','SHB','ROU','FT','LBAC','ULPK','SBAC','NN','BJ','ZJH'];
        if(isset($args['begin'])){
            $begin = $args['begin'];
        }else{
            $last_time = Db('live_data')->field('betTime')->where('platform','eq','ag')->where('gamecode','in',$gamecode)->order('betTime','desc')->find();
            $begin = $last_time['betTime'];
        }
        $end = $args['end'] ?? date('Y-m-d H:i:s',strtotime($begin) + $step);
        $s = time() - $step;
        if(strtotime($end) > $s){
            $end = date('Y-m-d H:i:s',$s);
        }
        
        
        do{
            $where['betTime'] = ['between',[$begin,$end]];
            $where['suffix'] = 'hga';
            $where['gameType'] = [
                'in',
                $gamecode
            ];
            $data = $bbin->where($where)->order('betTime',1)->select();
            $insertData = [];
            $tmp = [];
            foreach ($data as $k => $v) {
                $str2 = substr($v['username'], 0, 2);
                if ($str2 == 'jp') {
                    $tmp['username'] = substr($v['username'], 2);
                } else {
                    $tmp['username'] = $v['username'];
                }
                $tmp['order_id'] = $v['billNo'];
                $tmp['platform'] = 'ag';
                $tmp['gamecode'] = $v['gameType'];
                $tmp['betAmount'] = $v['betAmount'];
                if(!isset($v['validBetAmount'])){
                    if($v['Result'] == 'W' || $v['Result'] == 'L' ){
                        $tmp['validBetAmount'] = $v['validBetAmount'];
                        $tmp['isFs'] = 1;
                        $tmp['fsRate'] = 0;
                        $tmp['fsMoney'] = 0;
                    }
                }else{
                    $tmp['validBetAmount'] = $v['validBetAmount'];
                }
                //$tmp['validBetAmount'] = isset($v['Commissionable']) ? $v['Commissionable']: 0;
                $tmp['betTime'] = $v['betTime'];
                $tmp['payOff'] = $v['netAmount'];
                $res = Db('live_data')->where('order_id','eq',$v['billNo'])->where('platform','eq','ag')->find();
                if($res){
                    Db('live_data')->where('order_id','eq',$v['billNo'])->where('platform','eq','ag')->update($tmp);
                }else{
                    Db('live_data')->insert($tmp);
                }
                $tmp = [];
                
            }
            $begin = $end;
            $end = date('Y-m-d H:i:s',strtotime($end) + $step);
            $s = time() - $step;
            if(strtotime($end) > $s){
                $end = date('Y-m-d H:i:s',$s);
                $begin = date('Y-m-d H:i:s',$s-$step-10);
            }
            echo 'begin:'.$begin,PHP_EOL,'end:'.$end,PHP_EOL;
            sleep(1);
        }while(1);
    }

    protected function getBbindz($args)
    {
        $gamecode = [
            5005, 5006, 5007, 5008, 5009, 5010, 5012, 5013
            , 5014, 5015, 5016, 5017, 5029, 5030, 5034
            , 5035, 5039, 5040, 5041, 5042
            , 5043, 5044, 5048, 5049, 5054, 5057, 5058
            , 5060, 5061, 5062, 5063, 5064, 5065, 5066
            , 5067, 5068, 5069, 5070, 5073, 5076, 5077
            , 5078, 5079, 5080, 5083, 5084, 5088, 5089
            , 5090, 5091, 5092, 5093, 5094, 5095, 5105
            , 5106, 5107, 5108, 5109, 5115, 5116, 5117
            , 5118, 5131, 5201, 5202, 5203, 5204, 5402
            , 5404, 5406, 5407, 5601, 5701, 5703, 5704
            , 5705, 5706, 5707, 5801, 5802, 5803, 5804
            , 5805, 5806, 5808, 5809, 5810, 5811, 5821
            , 5823, 5824, 5825, 5826, 5827, 5828, 5831
            , 5832, 5833, 5835, 5836, 5837, 5901, 5902
            , 5903, 5904, 5905, 5907, 5888,'FT','BK','FB','IH','BS','IN','F1','SP','CB'
        ];
        $step = 120;
        $bbin = Db('bbin_gameresult', 'mongo');
        if(isset($args['begin'])){
            $begin = $args['begin'];
        }else{
            $last_time = Db('live_data')->field('betTime')->where('platform','eq','bbin')->where('gamecode','in',$gamecode)->order('betTime','desc')->find();
            $begin = $last_time['betTime'];
        }
        $end = $args['end'] ?? date('Y-m-d H:i:s',strtotime($begin) + $step);
        $s = time() - $step;
        if(strtotime($end) > $s){
            $end = date('Y-m-d H:i:s',$s);
        }
        
        
        do{
            $where['WagersDate'] = ['between',[$begin,$end]];
            $where['suffix'] = 'hga';
            $where['GameType'] = [
                'in',
                $gamecode
            ];
            $data = $bbin->where($where)->order('WagersDate',1)->select();
            echo count($data);
            $insertData = [];
            $tmp = [];
            foreach ($data as $k => $v) {
                /*
                $str2 = substr($v['UserName'], 0, 2);
                if ($str2 == 'jp') {
                    $tmp['username'] = substr($v['UserName'], 2);
                } else {
                    $tmp['username'] = $v['UserName'];
                }
                */
                $tmp['username'] = $v['username'];
                $tmp['order_id'] = $v['WagersID'];
                $tmp['platform'] = 'bbin';
                $tmp['gamecode'] = $v['GameType'];
                $tmp['betAmount'] = $v['BetAmount'];
                if(!isset($v['Commissionable'])){
                    if($v['Result'] == 'W' || $v['Result'] == 'L' ){
                        $tmp['validBetAmount'] = $v['BetAmount'];
                        $tmp['isFs'] = 1;
                        $tmp['fsRate'] = 0;
                        $tmp['fsMoney'] = 0;
                    }
                }else{
                    $tmp['validBetAmount'] = $v['Commissionable'];
                }
                //$tmp['validBetAmount'] = isset($v['Commissionable']) ? $v['Commissionable']: 0;
                $tmp['betTime'] = $v['WagersDate'];
                $tmp['payOff'] = $v['Payoff'];
                $res = Db('live_data')->where('order_id','eq',$v['WagersID'])->where('platform','eq','bbin')->find();
                if($res){
                    Db('live_data')->where('order_id','eq',$v['WagersID'])->where('platform','eq','bbin')->update($tmp);
                }else{
                    var_dump($tmp);
                    Db('live_data')->insert($tmp);
                }
                $tmp = [];
                
            }
            $begin = $end;
            $end = date('Y-m-d H:i:s',strtotime($end) + $step);
            $s = time() - $step;
            if(strtotime($end) > $s){
                $end = date('Y-m-d H:i:s',$s);
                $begin = date('Y-m-d H:i:s',$s-$step-10);
            }
            echo 'begin:'.$begin,PHP_EOL,'end:'.$end,PHP_EOL;
            sleep(1);
        }while(1);
    }
    
    protected function getBbinZr($args){
        $gamecode = [3001,3002,3003,3005,3006, 3007, 3008, 3010, 3011, 3012, 3014, 3015, 3016];
        $step = 120;
        $bbin = Db('bbin_gameresult', 'mongo');
        if(isset($args['begin'])){
            $begin = $args['begin'];
        }else{
            $last_time = Db('live_data')->field('betTime')->where('platform','eq','bbin')->where('gamecode','in',$gamecode)->order('betTime','desc')->find();
            $begin = $last_time['betTime'];
        }
        $end = $args['end'] ?? date('Y-m-d H:i:s',strtotime($begin) + $step);
        $s = time() - $step;
        if(strtotime($end) > $s){
            $end = date('Y-m-d H:i:s',$s);
        }
        
        
        do{
            $where['WagersDate'] = ['between',[$begin,$end]];
            $where['suffix'] = 'hga';
            $where['GameType'] = [
                'in',
                $gamecode
            ];
            $data = $bbin->where($where)->order('WagersDate',1)->select();
            echo count($data);
            $insertData = [];
            $tmp = [];
            foreach ($data as $k => $v) {
                /*
                $str2 = substr($v['UserName'], 0, 2);
                if ($str2 == 'jp') {
                    $tmp['username'] = substr($v['UserName'], 2);
                } else {
                    $tmp['username'] = $v['UserName'];
                }
                */
                $tmp['username'] = $v['username'];
                $tmp['order_id'] = $v['WagersID'];
                $tmp['platform'] = 'bbin';
                $tmp['gamecode'] = $v['GameType'];
                $tmp['betAmount'] = $v['BetAmount'];
                if(!isset($v['Commissionable'])){
                    if($v['Result'] == 'W' || $v['Result'] == 'L' ){
                        $tmp['validBetAmount'] = $v['BetAmount'];
                        $tmp['isFs'] = 1;
                        $tmp['fsRate'] = 0;
                        $tmp['fsMoney'] = 0;
                    }
                }else{
                    $tmp['validBetAmount'] = $v['Commissionable'];
                }
                //$tmp['validBetAmount'] = isset($v['Commissionable']) ? $v['Commissionable']: 0;
                $tmp['betTime'] = $v['WagersDate'];
                $tmp['payOff'] = $v['Payoff'];
                $res = Db('live_data')->where('order_id','eq',$v['WagersID'])->where('platform','eq','bbin')->find();
                if($res){
                    Db('live_data')->where('order_id','eq',$v['WagersID'])->where('platform','eq','bbin')->update($tmp);
                }else{
                    var_dump($tmp);
                    Db('live_data')->insert($tmp);
                }
                $tmp = [];
                
            }
            $begin = $end;
            $end = date('Y-m-d H:i:s',strtotime($end) + $step);
            $s = time() - $step;
            if(strtotime($end) > $s){
                $end = date('Y-m-d H:i:s',$s);
                $begin = date('Y-m-d H:i:s',$s-$step-10);
            }
            echo 'begin:'.$begin,PHP_EOL,'end:'.$end,PHP_EOL;
            sleep(1);
        }while(1);
    }

    protected function bbin_import(){
        $mysql = db('bbin_gameresult');
        $mongo = db('bbin_gameresult', 'mongo');
        $data = [1];
        $page = 0;
        $page_size = 10000;
        $last_id = 0;
        while($data){
            $data = $mysql->where("id>{$last_id}")->order('id')->limit($page_size);
            $page++;
            $bulk = new \MongoDB\Driver\BulkWrite;
            foreach ($data as $row){
                $last_id = $row['id'];
                unset($row['id']);
                foreach ($row as &$value){
                    if(is_numeric($value)) $value+=0;
                }
//                $mongo->where('WagersID', $row['WagersID'])->update($row, ['upsert' => true]);
                $bulk->update(['WagersID'=>$row['WagersID']], $row, ['upsert' => true]);
//                echo "处理{$row['id']}完成\n";
            }
            $mongo->execute("data.bbin_gameresult", $bulk);
            echo "处理第{$page}页完成！\n";
//            break;
        }
    }

    protected function getMg($args)
    {
        date_default_timezone_set('PRC');
        $step = 120;
        $bbin = Db('mg_gameresult', 'mongo');
        if(isset($args['begin'])){
            $begin = $args['begin'];
        }else{
            $last_time = Db('live_data')->field('betTime')->where('platform','eq','mg')->order('betTime','desc')->find();
            $begin = $last_time['betTime'];
        }
        $end = $args['end'] ?? date('Y-m-d H:i:s',strtotime($begin) + $step);
        $s = time() - $step;
        if(strtotime($end) > $s){
            $end = date('Y-m-d H:i:s',$s);
        }
        
        
        do{
            $where['created'] = ['between',[$begin,$end]];
            $where['suffix'] = 'hga';
            /*$where['GameType'] = [
                'in',
                $gamecode
            ];*/
            $data = $bbin->where($where)->order('created',1)->select();
            echo count($data);
            $insertData = [];
            $tmp = [];
            foreach ($data as $k => $v) {
                $tmp['username'] = $v['username'];
                $tmp['order_id'] = $v['mgid'];
                $tmp['platform'] = 'mg';
                $tmp['gamecode'] = $v['item_id'];
                if($v['category'] == 'WAGER'){
                    $tmp['betAmount'] = $v['amount'];
                    
                    $tmp['payOff'] = 0;
                }else{
                    $tmp['betAmount'] = 0;
                    $tmp['payOff'] = $v['amount'];
                }
                $tmp['validBetAmount'] = $tmp['betAmount'];
                //$tmp['validBetAmount'] = isset($v['Commissionable']) ? $v['Commissionable']: 0;
                $tmp['betTime'] = date('Y-m-d H:i:s',strtotime($v['created']));
                $res = Db('live_data')->where('order_id','eq',$v['mgid'])->where('platform','eq','mg')->find();
                if($res){
                    Db('live_data')->where('order_id','eq',$v['mgid'])->where('platform','eq','mg')->update($tmp);
                }else{
                    Db('live_data')->insert($tmp);
                }
                $tmp = [];
                
            }
            $begin = $end;
            $end = date('Y-m-d H:i:s',strtotime($end) + $step);
            $s = time() - $step;
            if(strtotime($end) > $s){
                $end = date('Y-m-d H:i:s',$s);
                $begin = date('Y-m-d H:i:s',$s-$step-10);
            }
            echo 'begin:'.$begin,PHP_EOL,'end:'.$end,PHP_EOL;
            sleep(1);
        }while(1);
    }

    protected function getOg($args)
    {
        date_default_timezone_set('PRC');
        $step = 120;
        $bbin = Db('og_gameresult', 'mongo');
        if(isset($args['begin'])){
            $begin = $args['begin'];
        }else{
            $last_time = Db('live_data')->field('betTime')->where('platform','eq','og')->order('betTime','desc')->find();
            $begin = $last_time['betTime'];
        }
        $end = $args['end'] ?? date('Y-m-d H:i:s',strtotime($begin) + $step);
        $begin = date('Y/m/d H:i:s',strtotime($begin));
        $end = date('Y/m/d  H:i:s',strtotime($end));
        $s = time() - $step;
        if(strtotime($end) > $s){
            $end = date('Y/m/d H:i:s',$s);
        }
        
        
        do{
            $where['AddTime'] = ['between',[$begin,$end]];
            $where['suffix'] = 'hga';
            /*$where['GameType'] = [
             'in',
             $gamecode
             ];*/
            $data = $bbin->where($where)->order('AddTime',1)->select();
            echo count($data);
            $insertData = [];
            $tmp = [];
            foreach ($data as $k => $v) {
                $tmp['username'] = $v['UserName'];
                $tmp['order_id'] = $v['OrderNumber'];
                $tmp['platform'] = 'og';
                $tmp['gamecode'] = $v['GameNameID'];
                $tmp['betAmount'] = $v['BettingAmount'];
                $tmp['payOff'] = $v['WinLoseAmount'];
                $tmp['validBetAmount'] = $tmp['ValidAmount'];
                //$tmp['validBetAmount'] = isset($v['Commissionable']) ? $v['Commissionable']: 0;
                $tmp['betTime'] = $v['AddTime'];
                $res = Db('live_data')->where('order_id','eq',$v['OrderNumber'])->where('platform','eq','og')->find();
                if($res){
                    Db('live_data')->where('order_id','eq',$v['OrderNumber'])->where('platform','eq','og')->update($tmp);
                }else{
                    Db('live_data')->insert($tmp);
                }
                $tmp = [];
                
            }
            $begin = $end;
            $end = date('Y/m/ H:i:s',strtotime($end) + $step);
            $s = time() - $step;
            if(strtotime($end) > $s){
                $end = date('Y/m/d H:i:s',$s);
                $begin = date('Y/m/d H:i:s',$s-$step-10);
            }
            echo 'begin:'.$begin,PHP_EOL,'end:'.$end,PHP_EOL;
            sleep(1);
        }while(1);
    }

    protected function getPt($args)
    {
        $step = 120;
        $bbin = Db('pt_gameresult', 'mongo');
        if(isset($args['begin'])){
            $begin = $args['begin'];
        }else{
            $last_time = Db('live_data')->field('betTime')->where('platform','eq','pt')->order('betTime','desc')->find();
            $begin = $last_time['betTime'];
        }
        $end = $args['end'] ?? date('Y-m-d H:i:s',strtotime($begin) + $step);
        $s = time() - $step;
        if(strtotime($end) > $s){
            $end = date('Y-m-d H:i:s',$s);
        }
        
        
        do{
            $where['GAMEDATE'] = ['between',[$begin,$end]];
            $where['suffix'] = 'HGA';
            /*$where['GameType'] = [
             'in',
             $gamecode
             ];*/
            $data = $bbin->where($where)->order('created',1)->select();
            echo count($data);
            $insertData = [];
            $tmp = [];
            foreach ($data as $k => $v) {
                $tmp['username'] = strtolower($v['username']);
                $tmp['order_id'] = $v['GAMECODE'];
                $tmp['platform'] = 'pt';
                $tmp['gamecode'] = $v['code'];
                $tmp['betAmount'] = $v['BET'];
                $tmp['payOff'] = $v['WIN'];
                $tmp['validBetAmount'] = $tmp['betAmount'];
                //$tmp['validBetAmount'] = isset($v['Commissionable']) ? $v['Commissionable']: 0;
                $tmp['betTime'] = $v['GAMEDATE'];
                $res = Db('live_data')->where('order_id','eq',$v['GAMECODE'])->where('platform','eq','pt')->find();
                if($res){
                    Db('live_data')->where('order_id','eq',$v['GAMECODE'])->where('platform','eq','pt')->update($tmp);
                }else{
                    Db('live_data')->insert($tmp);
                }
                $tmp = [];
                
            }
            $begin = $end;
            $end = date('Y-m-d H:i:s',strtotime($end) + $step);
            $s = time() - $step;
            if(strtotime($end) > $s){
                $end = date('Y-m-d H:i:s',$s);
                $begin = date('Y-m-d H:i:s',$s-$step-10);
            }
            echo 'begin:'.$begin,PHP_EOL,'end:'.$end,PHP_EOL;
            sleep(1);
        }while(1);
    }
}