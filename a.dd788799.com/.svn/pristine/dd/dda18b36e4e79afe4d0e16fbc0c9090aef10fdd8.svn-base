<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
namespace tests;
use app\classes\bet;
use app\classes\betC;

class CNTest extends TestCase
{

    public function testGfwf()
    {
		require_once('./swoole/parse-calc-count.php');

		$perPage = config('command_per_page')??100;
        $page = 1;	        
        do{	
        	//每次取第一页即可
        	$bets = db('bets')->order('id desc')->page($page,$perPage)->select();
        	foreach ($bets as $bet) {
        		echo "开始检查注单".$bet['id']."\r\n";
        		if(1593 == $bet['id']){
        			$a = 1;
        		}
		    	//if($bet['gfwf']){}
		    	$played = db('played')->where('id',$bet['playedId'])->find();
		    	$betC = $played['betCheckFun'];
		    	$betN = $played['betCountFun'];
		    	$rx_mode = $played['rx_mode'];

		    	$actionData = $bet['actionData'];
		    	$actionNum = $bet['actionNum'];
		    	$weishu = $bet['weiShu'];

                if($betN){                  
                    $betCount = bet::$betN($actionData);
                    $this->assertEquals($betCount, $actionNum);             
                }
                if($betC){
                    $betCheck = betC::$betC($actionData,$weishu);
					$this->assertTrue($betCheck);               
                }
        	}
	    	
            $page++;
            $count = count($bets);
        }while($count==$perPage);
    }
}