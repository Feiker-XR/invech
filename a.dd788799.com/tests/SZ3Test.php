<?php
namespace tests;
class SX3Test extends TestCase{
													/*数字3 */
	public function testGfwf(){
			require_once('./swoole/parse-calc-count.php');
			require_once('./swoole/kqwf_algo.php');
			
																
			//3星直选复式

			$kjnum = "6,7,9";
			$ret = fc3dFs("6,7,9",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = fc3dFs("26,37,9",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = fc3dFs("236,7,9",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dFs("7,6,9",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = fc3dFs("26,39,7",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = fc3dFs("235,8,9",$kjnum);
			$this->assertEquals($ret, 0);
				

			//3星直选单式

			$kjnum = "1,2,9";
			$ret = fc3dDs("1,2,9",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = fc3dDs("1,2,9",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = fc3dDs("1,2,9",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dDs("1,3,9",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = fc3dDs("2,9,1",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = fc3dDs("3,5,9",$kjnum);
			$this->assertEquals($ret, 0);
				

			//3星直选和值

			$ret = fc3d_zxhz("26",'6,11,9');
			$this->assertEquals($ret, 1);
			$ret = fc3d_zxhz("5","0,2,3");
			$this->assertEquals($ret, 1);
			$ret = fc3d_zxhz("17","1,7,9");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3d_zxhz("26","6,7,9");
			$this->assertEquals($ret, 0);
			$ret = fc3d_zxhz("5","1,2,9");
			$this->assertEquals($ret,0);
			$ret = fc3d_zxhz("17","1,2,9");
			$this->assertEquals($ret, 0);
				

			//3星组三复式

			$ret = fc3dZ3("78",'7,7,8');
			$this->assertEquals($ret, 1);
			$ret = fc3dZ3("56","6,5,6");
			$this->assertEquals($ret, 1);
			$ret = fc3dZ3("246","6,4,6");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dZ3("26","6,7,9");
			$this->assertEquals($ret, 0);
			$ret = fc3dZ3("56","1,2,9");
			$this->assertEquals($ret,0);
			$ret = fc3dZ3("17","1,2,9");
			$this->assertEquals($ret,0);
				

			//3星组六复式

			$ret = fc3dZ6("1345",'1,4,5');
			$this->assertEquals($ret, 1);
			$ret = fc3dZ6("246","2,4,6");
			$this->assertEquals($ret, 1);
			$ret = fc3dZ6("089","0,8,9");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dZ6("267","6,7,9");
			$this->assertEquals($ret,0);
			$ret = fc3dZ6("569","1,2,9");
			$this->assertEquals($ret, 0);
			$ret = fc3dZ6("170","1,2,9");
			$this->assertEquals($ret, 0);
				

			//3星混合组选

			$ret = fc3dZ36("5,9,4",'5,9,4');
			$this->assertArraySubset($ret,[0,1]);
			$this->assertArraySubset([0,1],$ret);
			$ret = fc3dZ36("2,9,9","9,9,2");
			$this->assertArraySubset($ret,[1,0]);
			$this->assertArraySubset([1,0],$ret);
			$ret = fc3dZ36("6,8,9","6,8,9");
			$this->assertArraySubset($ret,[0,1]);
			$this->assertArraySubset([0,1],$ret);
			//失败案例
			$ret = fc3dZ36("2,6,7","8,7,9");
			$this->assertArraySubset($ret,[0,0]);
			$this->assertArraySubset([0,0],$ret);
			$ret = fc3dZ36("5,6,9","1,2,9");
			$this->assertArraySubset($ret,[0,0]);
			$this->assertArraySubset([0,0],$ret);
			$ret = fc3dZ36("1,7,0","1,2,9");
			$this->assertArraySubset($ret,[0,0]);
			$this->assertArraySubset([0,0],$ret);
				

			//3星组选和值

			$ret = fc3d_zuhz("18",'5,9,4');

			$this->assertArraySubset($ret,[0,1]);
			$this->assertArraySubset([0,1],$ret);
			$ret = fc3d_zuhz("20","9,8,3");
			$this->assertArraySubset($ret,[0,1]);
			$this->assertArraySubset([0,1],$ret);
			$ret = fc3d_zuhz("23","6,8,9");
			$this->assertArraySubset($ret,[0,1]);
			$this->assertArraySubset([0,1],$ret);
			//失败案例
			$ret = fc3d_zuhz("18","8,7,9");
			$this->assertArraySubset($ret,[0,0]);
			$this->assertArraySubset([0,0],$ret);
			$ret = fc3d_zuhz("20","1,2,9");
			$this->assertArraySubset($ret,[0,0]);
			$this->assertArraySubset([0,0],$ret);
			$ret = fc3d_zuhz("23","1,2,9");
			$this->assertArraySubset($ret,[0,0]);
			$this->assertArraySubset([0,0],$ret);
				

			//2星后2组选单式

			$ret = fc3dZH2d("0,5",'9,5,0');
			$this->assertEquals($ret, 1);
			$ret = fc3dZH2d("0,6","9,0,6");
			$this->assertEquals($ret, 1);
			$ret = fc3dZH2d("5,9","6,5,9");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dZH2d("1,8","8,7,9");
			$this->assertEquals($ret, 0);
			$ret = fc3dZH2d("2,0","1,2,9");
			$this->assertEquals($ret, 0);
			$ret = fc3dZH2d("2,3","1,2,9");
			$this->assertEquals($ret, 0);
				

			//2星后2组选复式

			$ret = fc3dZH2f("348",'9,4,8');
			$this->assertEquals($ret, 1);
			$ret = fc3dZH2f("136","9,3,6");
			$this->assertEquals($ret, 1);
			$ret = fc3dZH2f("07","8,0,7");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dZH2f("18","8,7,9");
			$this->assertEquals($ret, 0);
			$ret = fc3dZH2f("20","1,2,9");
			$this->assertEquals($ret, 0);
			$ret = fc3dZH2f("23","1,2,9");
			$this->assertEquals($ret, 0);
				

			//2星前2组选单式

			$ret = fc3dZQ2d("0,5",'0,5,9');
			$this->assertEquals($ret, 1);
			$ret = fc3dZQ2d("0,6","6,0,8 ");
			$this->assertEquals($ret, 1);
			$ret = fc3dZQ2d("5,9","9,5,6");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dZQ2d("1,8","8,7,9");
			$this->assertEquals($ret,0);
			$ret = fc3dZQ2d("2,0","1,2,9");
			$this->assertEquals($ret, 0);
			$ret = fc3dZQ2d("2,3","1,2,9");
			$this->assertEquals($ret, 0);
				

			//2星前2组选复式

			$ret = fc3dZQ2f("348",'8,4,9');
			$this->assertEquals($ret, 1);
			$ret = fc3dZQ2f("136","1,3,6");
			$this->assertEquals($ret, 1);
			$ret = fc3dZQ2f("07","7,0,8");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dZQ2f("18","8,7,9");
			$this->assertEquals($ret,0);
			$ret = fc3dZQ2f("20","1,2,9");
			$this->assertEquals($ret,0);
			$ret = fc3dZQ2f("23","1,2,9");
			$this->assertEquals($ret,0);
				

			//2星后2直选单式

			$ret = fc3dH2d("2,5",'8,2,5');
			$this->assertEquals($ret, 1);
			$ret = fc3dH2d("1,2|3,5","3,1,2");
			$this->assertEquals($ret, 1);
			$ret = fc3dH2d("3,5|6,9|8,9","7,6,9");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dH2d("2,5","8,5,2");
			$this->assertEquals($ret, 0);
			$ret = fc3dH2d("1,2|3,5","1,2,9");
			$this->assertEquals($ret,0);
			$ret = fc3dH2d("3,5|6,9|8,9","5,9,3");
			$this->assertEquals($ret, 0);
				

			//2星后2直选复式

			$ret = fc3dH2f("3,5",'8,3,5');
			$this->assertEquals($ret, 1);
			$ret = fc3dH2f("35,7","1,5,7");
			$this->assertEquals($ret, 1);
			$ret = fc3dH2f("3,45","7,3,4");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dH2f("2,5","8,5,2");
			$this->assertEquals($ret, 0);
			$ret = fc3dH2f("35,7","1,3,5");
			$this->assertEquals($ret, 0);
			$ret = fc3dH2f("3,45","9,5,3");
			$this->assertEquals($ret, 0);
				

			//2星前2直选单式

			$ret = fc3dQ2d("2,5",'2,5,8');
			$this->assertEquals($ret, 1);
			$ret = fc3dQ2d("1,5|4,5|8,5","8,5,2");
			$this->assertEquals($ret, 1);
			$ret = fc3dQ2d("3,5|6,9|8,9","3,5,9");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dQ2d("2,5","8,5,2");
			$this->assertEquals($ret, 0);
			$ret = fc3dQ2d("1,2|3,5","1,3,9");
			$this->assertEquals($ret, 0);
			$ret = fc3dQ2d("3,5|6,9|8,9","5,9,3");
			$this->assertEquals($ret, 0);
				

			//2星前2直选复式

			$ret = fc3dQ2f("3,5",'3,5,8');
			$this->assertEquals($ret, 1);
			$ret = fc3dQ2f("35,7","5,7,2");
			$this->assertEquals($ret, 1);
			$ret = fc3dQ2f("3,45","3,5,4");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dQ2f("2,5","8,5,2");
			$this->assertEquals($ret, 0);
			$ret = fc3dQ2f("35,7","1,3,5");
			$this->assertEquals($ret, 0);
			$ret = fc3dQ2f("3,45","9,5,3");
			$this->assertEquals($ret, 0);
				

			//三星定位胆

			$ret = fc3d3xdw("-,3,-",'1,3,8');
			$this->assertEquals($ret, 1);
			$ret = fc3d3xdw("6,-,-","6,7,2");
			$this->assertEquals($ret, 1);
			$ret = fc3d3xdw("-,4,5","2,4,6");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3d3xdw("-,3,-","8,5,2");
			$this->assertEquals($ret, 0);
			$ret = fc3d3xdw("6,-,-","1,3,5");
			$this->assertEquals($ret, 0);
			$ret = fc3d3xdw("-,4,5","4,5,3");
			$this->assertEquals($ret, 0);
			

			//不定位不定胆

			$ret = fc3dbdd("5",'1,3,5');
			$this->assertEquals($ret, 1);
			$ret = fc3dbdd("4 6","6,7,2");
			$this->assertEquals($ret, 1);
			$ret = fc3dbdd("7","2,7,6");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dbdd("5","8,1,2");
			$this->assertEquals($ret, 0);
			$ret = fc3dbdd("4 6","1,3,5");
			$this->assertEquals($ret, 0);
			$ret = fc3dbdd("7","4,5,3");
			$this->assertEquals($ret, 0);
			

			//不定位二码不定位

			$ret = bdwQ32("2 3",'1,3,2');
			$this->assertEquals($ret, 1);
			$ret = bdwQ32("2 4 5 6","6,5,2");
			$this->assertEquals($ret,3);
			$ret = bdwQ32("2 3 4","2,7,4");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = bdwQ32("5 8","8,1,2");
			$this->assertEquals($ret, 0);
			$ret = bdwQ32("2 4 5 6","1,3,5");
			$this->assertEquals($ret,0);
			$ret = bdwQ32("7 0","4,5,3");
			$this->assertEquals($ret, 0);
			

			//后二大小单双

			$ret = fc3dH2dxds("大,单",'1,9,3');
			$this->assertEquals($ret, 1);
			$ret = fc3dH2dxds("大单,双","6,9,2");
			$this->assertEquals($ret, 2);
			$ret = fc3dH2dxds("大,单双","2,7,4");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dH2dxds("大,单","8,1,2");
			$this->assertEquals($ret, 0);
			$ret = fc3dH2dxds("大单,双","1,2,5");
			$this->assertEquals($ret, 0);
			$ret = fc3dH2dxds("大单,双","4,5,3");
			$this->assertEquals($ret, 0);
			

			//任选大小单双

			$ret = fc3dR2dxds("小,单,-",'1,7,3');
			$this->assertEquals($ret, 1);
			$ret = fc3dR2dxds("-,双,小","6,8,2");
			$this->assertEquals($ret, 1);
			$ret = fc3dR2dxds("大,-,双","9,7,4");
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = fc3dR2dxds("小,单,-","8,3,2");
			$this->assertEquals($ret,0);
			$ret = fc3dR2dxds("-,双,小","1,2,7");
			$this->assertEquals($ret, 0);
			$ret = fc3dR2dxds("大,-,双","4,5,3");
			$this->assertEquals($ret, 0);
			
	}


	public function testKqwf(){
		require_once('./swoole/parse-calc-count.php');
		require_once('./swoole/kqwf_algo.php');
		//定位

		$ret = fc3d_dw("十定位-0",'1,0,3');
		$this->assertEquals($ret, 1);
		$ret = fc3d_dw("百十定位-0,45","0,5,4");

		$this->assertEquals($ret, 1);
		$ret = fc3d_dw("百十个定位-2,46,4","2,6,4");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = fc3d_dw("十定位-0","8,3,2");
		$this->assertEquals($ret, 0);
		$ret = fc3d_dw("百十定位-0,45","1,4,5");
		$this->assertEquals($ret, 0);
		$ret = fc3d_dw("百十个定位-2,46,4","4,6,2");
		$this->assertEquals($ret, 0);
			

		//组合
		$ret = fc3d_zx("一字组合-7",'7,0,3');
		$this->assertEquals($ret, 1);
		$ret = fc3d_zx("二字组合-3,4","3,5,4");
		$this->assertEquals($ret, 1);
		$ret = fc3d_zx("三字组合-2,3,5","5,2,3");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = fc3d_zx("一字组合-7","8,3,2");
		$this->assertEquals($ret,0);
		$ret = fc3d_zx("二字组合-3,4","1,4,5");
		$this->assertEquals($ret, 0);
		$ret = fc3d_zx("三字组合-2,3,5","1,2,3");
		$this->assertEquals($ret,0);
		

		//和数
		$ret = fc3d_hs("百十和数-大",'7,9,3');
		$this->assertEquals($ret, 1);
		$ret = fc3d_hs("十个和数-11","3,5,6");
		$this->assertEquals($ret, 1);
		$ret = fc3d_hs("百十个和数-21~27","9,8,6");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = fc3d_hs("百十和数-大","1,3,2");
		$this->assertEquals($ret, 0);
		$ret = fc3d_hs("十个和数-11","1,4,5");
		$this->assertEquals($ret, 0);
		$ret = fc3d_hs("百十个和数-21~27","1,2,3");
		$this->assertEquals($ret,0);
		
		//和数尾数
		$ret = fc3d_hs("百十和数尾数-1",'7,4,6');
		$this->assertEquals($ret, 1);
		$ret = fc3d_hs("十个和数尾数-质","3,5,6");
		$this->assertEquals($ret, 1);
		$ret = fc3d_hs("百十个和数尾数-合","9,8,1");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = fc3d_hs("百十和数尾数-1","1,3,2");
		$this->assertEquals($ret, 0);
		$ret = fc3d_hs("十个和数尾数-质","1,4,5");
		$this->assertEquals($ret,0);
		$ret = fc3d_hs("百十个和数尾数-合","0,2,3");
		$this->assertEquals($ret, 0);
		

		//组选3
		$ret = fc3d_z3("组选三-1,2,4,7,8,9",'7,7,2');
		$this->assertEquals($ret, 1);
		$ret = fc3d_z3("组选三-0,1,4,5,7,8,9","1,0,0");
		$this->assertEquals($ret, 1);
		$ret = fc3d_z3("组选三-1,2,3,7,8","1,8,1");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = fc3d_z3("组选三-1,2,4,7,8,9","1,3,2");
		$this->assertEquals($ret, 0);
		$ret = fc3d_z3("组选三-0,1,4,5,7,8,9","1,1,1");
		$this->assertEquals($ret, 0);
		$ret = fc3d_z3("组选三-1,2,3,7,8","0,2,3");
		$this->assertEquals($ret,0);
		

		//组选6
		$ret = fc3d_z6("组选六-0,2,6,8",'2,8,6');
		$this->assertEquals($ret, 1);
		$ret = fc3d_z6("组选六-1,3,4,5,7,8,9","3,1,4");
		$this->assertEquals($ret, 1);
		$ret = fc3d_z6("组选六-1,3,5,7,8,9","1,8,9");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = fc3d_z6("组选六-0,2,6,8","1,3,2");
		$this->assertEquals($ret,0);
		$ret = fc3d_z6("组选六-1,3,4,5,7,8,9","1,1,1");
		$this->assertEquals($ret,0);
		$ret = fc3d_z6("组选六-1,3,5,7,8,9","0,2,3");
		$this->assertEquals($ret,0);
		
		
		//跨度
		$ret = fc3d_kd("跨度-1",'7,8,7');
		$this->assertEquals($ret, 1);
		$ret = fc3d_kd("跨度-7","2,9,3");
		$this->assertEquals($ret, 1);
		$ret = fc3d_kd("跨度-0","1,1,1");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = fc3d_kd("跨度-1","1,3,2");
		$this->assertEquals($ret,0);
		$ret = fc3d_kd("跨度-7","1,7,1");
		$this->assertEquals($ret, 0);
		$ret = fc3d_kd("跨度-0","0,2,2");
		$this->assertEquals($ret, 0);
		
	}

}

?>