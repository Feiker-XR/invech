<?php
namespace tests;
class XY28Test extends TestCase{

	public function testKqwf(){
		require_once('./swoole/parse-calc-count.php');
		require_once('./swoole/kqwf_algo.php');
		//双面
		$ret = xy28_dw("特码-0","0,0,0");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("特码-9","1,5,3");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("特码-18","3,6,9");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("特码-27","9,9,9");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-大","6,4,4");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-小","4,3,1");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-豹子","2,2,2");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-绿波","5,8,9");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-蓝波","6,8,9");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-红波","4,8,9");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-大单","5,6,6");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-小双","2,3,7");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-极大","8,8,6");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("双面-极小","1,0,2");
		$this->assertEquals($ret, 1);
		$ret = xy28_dw("三压一-15,17,18","6,6,6");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = xy28_dw("特码-0","0,0,2");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("特码-9","1,6,3");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("特码-18","4,6,9");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("特码-27","9,3,9");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-大","3,4,4");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-小","4,3,9");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-豹子","6,2,2");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-绿波","5,6,9");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-蓝波","1,8,9");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-红波","5,8,9");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-大单","5,6,7");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-小双","2,2,7");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("双面-极大","8,4,6");
		$this->assertEquals($ret,0);
		$ret = xy28_dw("双面-极小","1,0,7");
		$this->assertEquals($ret, 0);
		$ret = xy28_dw("三压一-15,17,18","6,6,9");
		$this->assertEquals($ret, 0);
		

		
	}

}
?>