<?php
namespace app\admin\controller;

trait EchartTrait
{
    private function getXkey($meta){
        $keys = array_keys($meta);
        return $keys[0];
    }

    private function packetLegend($legend,$meta){
        //{ data:['注册数','活跃数','订单总数','支付订单数',]}
        $data = ['data'=>$legend,];        
        return json_encode($data);
    }

    private function packetXAxis($xAxis,$meta){

        //[{type : 'category',boundaryGap : false,data : ["2018-01-25","2018-01-27","2018-02-03",]},],        
        $data = [];
        $data[] = ['type'=>'category',
                    'boundaryGap'=>false,
                    'data'=>$xAxis,
                ];
        return json_encode($data);
    }

    private function packetSeries($series,$meta){
        //{data:["10","20","30",], },

        $data = [];
        foreach ($series as $key => $value) {
            $data[] = ['name'=>$meta[$key],
                        'type'=>'line',
                        'data'=>$value,
                ];          
        }
        return json_encode($data);
    }

    private function getData($list,$meta){
        $legend = [];
        $xAxis = [];
        $series = [];
        
        $xkey = $this->getXkey($meta);

        foreach ($meta as $key => $word) {
            if($key != $xkey){
                $legend[] = $word;
                $series[$key] = [];                
            }
        }
        
        foreach ($list as $row) {
            
            foreach ($meta as $key => $word) {
                if($key == $xkey){
                    $xAxis[] = $row[$key];
                }else{
                    $series[$key][] = $row[$key];
                }               
            }
        }

        return [$legend,$xAxis,$series,];       
    }

    private function makeEcharts($list,$meta){
        list($legend,$xAxis,$series) = $this->getData($list,$meta);
        $legend = $this->packetLegend($legend,$meta);
        $xAxis = $this->packetXAxis($xAxis,$meta);
        $series = $this->packetSeries($series,$meta);
        $this->assign('legend',$legend);
        $this->assign('xAxis',$xAxis);
        $this->assign('series',$series);
    } 
}
