<?php
namespace tests;
class KLSFTest extends TestCase{

	public function testKqwf(){
		require_once('./swoole/parse-calc-count.php');
		require_once('./swoole/kqwf_algo.php');
		//双面
		$ret = klsf_sm("总和、龙虎-总大","01,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("总和、龙虎-总龙","15,12,14,18,11,08,17,01");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("总和、龙虎-总双","01,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("总和、龙虎-总尾大","01,12,14,18,11,08,17,15");
	
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("第一球-大","16,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("第二球-尾大","01,16,14,18,11,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("第四球-合单","01,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("第三球-合双","01,12,13,18,11,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("第五球-小","01,12,14,18,09,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("第六球-单","01,12,14,18,11,07,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("第七球-双","01,12,14,18,11,08,16,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sm("第八球-尾小","01,12,14,18,11,08,17,13");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = klsf_sm("总和、龙虎-总大","07,12,14,01,11,08,02,15");
		
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("总和、龙虎-总龙","01,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("总和、龙虎-总双","02,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("总和、龙虎-总尾大","06,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("第一球-大","01,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("第二球-尾大","01,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("第四球-合单","01,12,14,13,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("第三球-合双","01,12,09,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("第五球-小","01,12,14,18,19,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("第六球-单","01,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("第七球-双","01,12,14,18,11,08,13,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sm("第八球-尾小","01,12,14,18,11,08,17,19");
		$this->assertEquals($ret, 0);
		

		//数字
		$ret = klsf_sz("第一球-2","02,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_sz("第四球-18","15,12,14,18,11,08,17,01");
		$this->assertEquals($ret, 1);
		$ret = klsf_sz("第八球-12","15,13,14,18,11,08,17,12");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = klsf_sz("第一球-2","07,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sz("第四球-18","01,12,14,19,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_sz("第八球-12","02,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);

		//龙虎
		$ret = klsf_lh("龙1vs虎2-龙","12,02,14,18,11,08,17,15");
		$this->assertEquals($ret, 1);
		$ret = klsf_lh("龙1vs虎3-虎","14,12,15,18,11,08,17,01");
		$this->assertEquals($ret, 1);
		$ret = klsf_lh("龙2vs虎5-龙","15,18,14,13,11,08,17,12");
		$this->assertEquals($ret, 1);
		$ret = klsf_lh("龙4vs虎7-虎","15,13,14,09,11,08,17,12");
		$this->assertEquals($ret, 1);
		//失败案例
		$ret = klsf_lh("龙1vs虎2-龙","02,12,14,18,11,08,17,15");
		$this->assertEquals($ret, 0);
		$ret = klsf_lh("龙1vs虎3-虎","15,12,14,18,11,08,17,01");
		$this->assertEquals($ret, 0);
		$ret = klsf_lh("龙2vs虎5-龙","15,13,14,18,16,08,17,12");
		$this->assertEquals($ret, 0);
		$ret = klsf_lh("龙4vs虎7-虎","15,13,14,18,11,08,17,12");
		$this->assertEquals($ret, 0);
	}

}
?>