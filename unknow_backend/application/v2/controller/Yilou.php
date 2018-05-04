<?php
namespace app\v2\controller;
use app\v2\Base;
use think\Db;
class Yilou extends Base {
    private $conf = [
        'cqssc' => 5,
        'xyft' => 10,
        'bjpks' => 10,
        'xjssc' => 5,
        'gd11x5' => 5,
        'js11x5' => 5,
        'jsk3'  => 3,
    ];
    private $table = [
        'cqssc' => 'c_auto_2',
        'six'   => 'c_auto_0',
        'xyft' => 'c_auto_9',
        'bjpks' => 'c_auto_3',
        'xjssc' => 'c_auto_7',
        'gdklsf' => 'c_auto_1',
        'cqklsf'    => 'c_auto_4',
        'gxklsf'    => 'c_auto_5',
        //'js11x5' => 5,
        'jsk3'  => 'c_auto_6',
    ];
    private $num = [
        'cqssc' => 0,
        'bjpks' => 1,
        'six'   => 1,
        'xyft' => 1,
        'xjssc' => 0,
        'gd11x5' => 0,
        //'js11x5' => 5,
        'jsk3'  => 1,
    ];
    
    public function index($type ='cqssc'){
        $lastyilou = Db::query("select * from c_yilou_2 where type = '$type' order by id desc limit 1")[0];
        if(!$lastyilou){
            return '没有结果!';
        }
        $sql ="select * from {$this->table[$type]} where qishu > '{$lastyilou['issue']}' order by id asc limit 1";
        //echo $sql; exit;
        $query = Db::query($sql);
        $query = $query[0] ?? '';
        if($query){
            if($type == 'jsk3'){
                $ball[] = $query['ball_1'];
                $ball[] = $query['ball_2'];
                $ball[] = $query['ball_3'];
                $array_count = count(array_count_values($ball));
                $sum = array_sum($ball);
                $yilou = explode(',',$lastyilou['bodyArr']);
                foreach ($yilou as $k => $v){
                    echo $k,'<br/>';
                    if($k <6){
                        if(in_array($k+1,$ball)){
                            $yilou[$k] = $k+1;
                        }else{
                            if($yilou[$k] >= 0){
                                $yilou[$k] = -1;
                            }else{
                                $yilou[$k] -= 1;
                            }
                        }
                    }
                    if(6<= $k && $k <= 8){
                        switch($array_count){
                            case 2: //对子 第6位
                                $yilou[6] = 4;
                                $yilou[7] = $yilou[7] > 0 ? -1 : $yilou[7] -1;
                                $yilou[8] = $yilou[8] > 0 ? -1 : $yilou[8] -1;
                                break;
                            case 1:
                                $yilou[6] = $yilou[6] > 0 ? -1 : $yilou[6] -1;
                                $yilou[7] =5;
                                $yilou[8] = $yilou[8] > 0 ? -1 : $yilou[8] -1;
                                break;
                            case 3:
                                $yilou[6] = $yilou[6] > 0 ? -1 : $yilou[6] -1;
                                $yilou[7] = $yilou[7] > 0 ? -1 : $yilou[7] -1;
                                $yilou[8] = 6;
                        }
                    }
                    if($k >= 9){
                        if($k == $sum + 6){
                            $yilou[$k] = $sum;
                        }else{
                            if($yilou[$k] >= 0){
                                $yilou[$k] = -1;
                            }else{
                                $yilou[$k] -= 1;
                            }
                        }
                    }
                }
            }else{
                for($i = 0 ; $i < $this->conf[$type];$i++){
                    $kjData[] = intval($query['ball_'.($i+1)]) + intval($i) * 10 - $this->num[$type];
                }
                //= [$query['ball_1'],$query['ball_2'] + 10,$query['ball_3']+20,$query['ball_4']+30 ,$query['ball_5']+40];
                $yilou = explode(',',$lastyilou['bodyArr']);
                foreach ($yilou as $k => $v){
                    if(!in_array($k,$kjData)){
                        if($yilou[$k] >= 0){
                            $yilou[$k] = -1;
                        }else{
                            $yilou[$k] -= 1;
                        }
                    }else{
                        if(($k + $this->num[$type]) % 10 == 0 ){
                            $yilou[$k] = $this->num[$type]? 10 : 0;
                        }else{
                            $yilou[$k] =  ($k + $this->num[$type]) % 10;
                         }
                    }
                }
            }
            $yilouStr = implode(',', $yilou);
            $sql = "insert into c_yilou_2 (issue,bodyArr,`type`) values ({$query['qishu']},'$yilouStr','$type')";
            Db::query($sql);
        }
    }
    
    public function yilou($type = 'cqssc'){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); 
        $sql = "select a.*,b.* from {$this->table[$type]} as a,c_yilou_2 as b where b.type = '$type' and a.qishu = b.issue and a.qishu in(select distinct(qishu) from {$this->table[$type]})  order by qishu desc limit 100 ";
        $codes = Db::query ($sql);
        $appearCountArr = [];
        $averageMissingArr = []; //平均遗漏数
        $currentMissingArr = []; //当前遗漏数据
        $maxAppearArr = [];  //最大连出数
        $maxMissingArr = []; //最大遗漏数
        $tmp = []; //存储临时统计最大连出数
        $bodylist = [];
        foreach ($codes as $k => $v){
            
            $bodylist[$k]['openTime'] = $v['datetime'];
            $bodylist[$k]['issue'] = $v['issue'];
            if($type == 'jsk3'){
                $bodylist[$k]['openNum'][] = $v['ball_1'];
                $bodylist[$k]['openNum'][] = $v['ball_2'];
                $bodylist[$k]['openNum'][] = $v['ball_3'];
            }else{
                foreach($v as $k1 => $v1){
                    if(strstr($k1,'ball_')){
                        $bodylist[$k]['openNum'][] = $v1;
                    }
                }
            }
            
     
            $bodyinfo = explode(',',$v['bodyArr']);
            foreach ($bodyinfo as $i=> $j){
                $bodylist[$k]['bodyArr'][$i] = intval($j);
            }
            //$bodylist[$k]['bodyArr'] = $bodyinfo;
            $nextinfo = explode(',', $codes[$k+1]['bodyArr'] ?? '');
            foreach($bodyinfo as $key => $value){
                $appearCountArr[$key] = ($appearCountArr[$key] ?? 0);
                $averageMissingArr[$key] = ($averageMissingArr[$key] ?? 0);
                $maxMissingArr[$key] = ($maxMissingArr[$key] ?? 0);
                $currentMissingArr[$key] = ($currentMissingArr[$key] ?? 0);
                $maxAppearArr[$key] = ($maxAppearArr[$key] ?? 1);
                $tmp[$key] = $tmp[$key] ?? 1;
                
                if( $value >= 0){
                    $appearCountArr[$key] += 1; //出现次数
                    $averageMissingArr[$key] = '';
                    if(($nextinfo[$key] ?? false) && $nextinfo[$key] == $value){
                        $tmp[$key] += 1; //当前的等于后面的
                        $tmp[$key] > $maxAppearArr[$key] ? $maxAppearArr[$key] = $tmp[$key] : '';
                    }else{
                        $tmp[$key] = 1;
                    }
                }else{
                    $maxMissingArr[$key] < $value ? '' : $maxMissingArr[$key] = $value ;
                }
            }
        }
        $currentMissingArr = explode(',',$codes[0]['bodyArr']);
        foreach ($currentMissingArr as $k => $v){
            $currentMissingArr[$k] = intval($v);
        }
        foreach ($appearCountArr as $k => $v){
            $averageMissingArr[$k] = $v == 0 ? 100 : intval((100 - $v) / $v);
        }
        if($type == 'jsk3'){
            for($i = 0 ;$i<6;$i++){
                array_unshift($appearCountArr,$appearCountArr[0]);
                array_unshift($averageMissingArr,$averageMissingArr[0]);
                array_unshift($maxMissingArr,$maxMissingArr[0]);
                array_unshift($maxAppearArr,$maxAppearArr[0]);
            }
        }
        echo json_encode([
            'bodyList' => $bodylist,
            'appearCountArr' => $appearCountArr,
            'averageMissingArr' => $averageMissingArr,
            'maxMissingArr' => $maxMissingArr,
            'maxAppearArr' => $maxAppearArr,
            'currentMissingArr' => $currentMissingArr
        ]);exit;
    }
    
    public function draw(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); 
        $opentime = [];
        /*
        foreach($this->table as $k => $v){
            if($k == 'six')
                continue;
            $opentime[$k] = str_replace('auto', 'opentime', $v);
            $sql = "select count(*) as qishu from  {$opentime[$k]}";
            $qishu[$k] = Db::table($opentime[$k])->count('*');
        }
        $auto = new \app\logic\auto();
        $cqssc = $auto->cqssc();
        $bjpks = $auto->pk10();
        $jsk3 = $auto->jsk3();
        $xjssc = $auto->xjssc();
        $cqklsf = $auto->csf();
        $gsf = $auto->gsf();
        $gxsf = $auto->gxsf();
        $xyft= $auto->xyft();
        $data['cqssc'];*/
        $response = [];
        $gameinfo = [
            'cqssc' =>  [
                'name'  =>'重庆时时彩',
                'qishu' =>  120,
                'pinlv'   => '5/10分钟',
            ],
            'six'   =>  [
                'name'  => '香港六合彩',
                'qishu' =>  1,
                'pinlv' =>'2/3天',
            ],
            'xyft'  =>  [
                'name'  =>'幸运飞艇',
                'qishu' =>  180,
                'pinlv' =>  '5分钟',
            ],
            'bjpks' =>  [
                'name'  =>  '北京pk10',
                'qishu' =>  '179',
                'pinlv' =>  '5分钟',
            ],
            'xjssc' =>  [
                'name'  =>  '新疆时时彩',
                'qishu' =>  '96',
                'pinlv' =>  '10分钟',
            ],
            'gdklsf' =>  [
                'name'  =>  '广东快乐十分',
                'qishu' =>  '84',
                'pinlv' =>  '10分钟',
            ],
            'cqklsf' =>  [
                'name'  =>  '重庆快乐十分',
                'qishu' =>  '97',
                'pinlv' =>  '10分钟',
            ],
            'gxklsf' =>  [
                'name'  =>  '广西快乐十分',
                'qishu' =>  '50',
                'pinlv' =>  '10分钟',
            ],
            'jsk3'  =>  [
                'name'  =>  '江苏骰宝(快3)',
                'qishu' =>  '82',
                'pinlv' =>  '10',
            ]
        ];
        foreach ($this->table as $k=>$v){
            $data = Db::table($v)->where('ok','eq',1)->order('id','desc')->limit(1)->find();
            $gameinfo[$k]['issue'] = $data['qishu'];
            if($k == 'jsk3'){
                $gameinfo[$k]['openNum'][] = $data['ball_1'];
                $gameinfo[$k]['openNum'][] = $data['ball_2'];
                $gameinfo[$k]['openNum'][] = $data['ball_3'];
            }else{
                foreach($data as $key => $val){
                    if(strstr($key,'ball_')){
                        $gameinfo[$k]['openNum'][] = $val; 
                    }
                } 
            }
        }
        echo json_encode($gameinfo);
        exit();
        
    }
    
}