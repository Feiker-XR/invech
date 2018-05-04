<?php
namespace tests;
class K3Test extends TestCase{
													/*块3 */
	public function testKqwf(){
		require_once('./swoole/parse-calc-count.php');
		require_once('./swoole/kqwf_algo.php');
		//和值
		$ret = k3_hz("和值-3","1,1,1");
		$this->assertEquals($ret, 1);
		$ret = k3_hz("和值-小","3,1,2");
		$this->assertEquals($ret, 1);
		$ret = k3_hz("和值-双","9,1,2");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_hz("和值-3","2,3,1");
		$this->assertEquals($ret,0);
		$ret = k3_hz("和值-小","5,4,6");
		$this->assertEquals($ret, 0);
		$ret = k3_hz("和值-双","2,3,2");
		$this->assertEquals($ret, 0);
			

		//通选
		$ret = k3_tx("通选-豹子","1,1,1");
		$this->assertEquals($ret, 1);
		$ret = k3_tx("通选-对子","3,3,2");
		$this->assertEquals($ret, 1);
		$ret = k3_tx("通选-三不同","9,1,2");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_tx("通选-豹子","1,3,1");
		$this->assertEquals($ret, 0);
		$ret = k3_tx("通选-对子","5,4,6");
		$this->assertEquals($ret, 0);
		$ret = k3_tx("通选-三不同","1,3,2");
		$this->assertEquals($ret, 0);
		

		//三同号单选
		$ret = k3_3dx("三同号单选-111","1,1,1");
		$this->assertEquals($ret, 1);
		$ret = k3_3dx("三同号单选-555","5,5,5");
		$this->assertEquals($ret, 1);
		$ret = k3_3dx("三同号单选-666","6,6,6");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_3dx("三同号单选-111","1,3,1");
		$this->assertEquals($ret, 0);
		$ret = k3_3dx("三同号单选-555","4,4,4");
		$this->assertEquals($ret, 0);
		$ret = k3_3dx("三同号单选-666","1,3,2");
		$this->assertEquals($ret, 0);
		

		//三不同
		$ret = k3_3bt("三不同-1,3,4,5","1,5,4");
		$this->assertEquals($ret, 1);
		$ret = k3_3bt("三不同-1,3,6","6,3,1");
		$this->assertEquals($ret, 1);
		$ret = k3_3bt("三不同-2,4,6","4,6,2");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_3bt("三不同-1,3,4,5","1,3,1");
		$this->assertEquals($ret, 0);
		$ret = k3_3bt("三不同-1,3,6","5,4,6");
		$this->assertEquals($ret, 0);
		$ret = k3_3bt("三不同-2,4,6","1,3,2");
		$this->assertEquals($ret, 0);
		

		//二同号复选
		$ret = k3_2fx("二同号复选-11*","1,1,4");
		$this->assertEquals($ret, 1);
		$ret = k3_2fx("二同号复选-55*","6,5,5");
		$this->assertEquals($ret, 1);
		$ret = k3_2fx("二同号复选-66*","6,4,6");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_2fx("二同号复选-11*","1,3,6");
		$this->assertEquals($ret, 0);
		$ret = k3_2fx("二同号复选-55*","5,4,6");
		$this->assertEquals($ret, 0);
		$ret = k3_2fx("二同号复选-66*","1,3,2");
		$this->assertEquals($ret, 0);
		

		//二同号单选
		$ret = k3_2dx("二同号单选-22,3","2,2,3");
		$this->assertEquals($ret, 1);
		$ret = k3_2dx("二同号单选-55,3 4","4,5,5");
		$this->assertEquals($ret, 1);
		$ret = k3_2dx("二同号单选-22,1 3","2,3,2");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_2dx("二同号单选-22,3","2,3,3");
		$this->assertEquals($ret, 0);
		$ret = k3_2dx("二同号单选-55,3 4","5,4,6");
		$this->assertEquals($ret, 0);
		$ret = k3_2dx("二同号单选-22,1 3","1,3,2");
		$this->assertEquals($ret, 0);
		

		//二不同号单选
		$ret = k3_2bt("二不同号-1,3,4","1,4,2");
		$this->assertEquals($ret, 1);
		$ret = k3_2bt("二不同号-2,5","2,5,5");
		$this->assertEquals($ret, 1);
		$ret = k3_2bt("二不同号-3,6","2,3,6");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_2bt("二不同号-1,3,4","2,3,3");
		$this->assertEquals($ret,0);
		$ret = k3_2bt("二不同号-2,5","5,4,6");
		$this->assertEquals($ret, 0);
		$ret = k3_2bt("二不同号-3,6","1,3,2");
		$this->assertEquals($ret, 0);
		

		//猜必出
		$ret = k3_bc("猜必出-1","1,4,2");
		$this->assertEquals($ret, 1);
		$ret = k3_bc("猜必出-5","2,5,5");
		$this->assertEquals($ret, 1);
		$ret = k3_bc("猜必出-6","2,3,6");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_bc("猜必出-1","2,3,3");
		$this->assertEquals($ret, 0);
		$ret = k3_bc("猜必出-5","3,4,6");
		$this->assertEquals($ret, 0);
		$ret = k3_bc("猜必出-6","1,3,2");
		$this->assertEquals($ret, 0);
		

			//猜必不出
		$ret = k3_bbc("猜必不出-2","1,4,5");
		$this->assertEquals($ret, 1);
		$ret = k3_bbc("猜必不出-4","2,5,5");
		$this->assertEquals($ret, 1);
		$ret = k3_bbc("猜必不出-6","2,3,1");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = k3_bbc("猜必不出-2","2,3,3");
		$this->assertEquals($ret, 0);
		$ret = k3_bbc("猜必不出-4","5,4,6");
		$this->assertEquals($ret, 0);
		$ret = k3_bbc("猜必不出-6","1,6,2");
		$this->assertEquals($ret, 0);
		
	}

}