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

class SIXTest extends TestCase
{
    public function testKqwf(){
		require_once('./swoole/parse-calc-count.php');
		require_once('./swoole/kqwf_algo.php');
		
		$ret = six_dw('正一-1','1,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-49','49,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-大','48,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-大','49,2,3,4,5,6,7');
		$this->assertEquals($ret, -1);				
		$ret = six_dw('正一-单','1,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-单','49,2,3,4,5,6,7');
		$this->assertEquals($ret, -1);		
		$ret = six_dw('正一-合大','34,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-合大','49,2,3,4,5,6,7');
		$this->assertEquals($ret, -1);
		$ret = six_dw('正一-合单','32,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-合单','49,2,3,4,5,6,7');
		$this->assertEquals($ret, -1);		
		$ret = six_dw('正一-尾大','36,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-尾大','49,2,3,4,5,6,7');
		$this->assertEquals($ret, -1);		
		$ret = six_dw('正一-尾单','39,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-尾单','49,2,3,4,5,6,7');
		$this->assertEquals($ret, -1);		
		$ret = six_dw('正一-红波','29,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
		$ret = six_dw('正一-绿波','49,2,3,4,5,6,7');
		$this->assertEquals($ret, 1);
    }

}