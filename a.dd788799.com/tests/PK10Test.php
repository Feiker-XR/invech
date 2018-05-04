<?php
namespace tests;
class PK10Test extends TestCase
{

    public function testGfwf()
    {
    		require_once('./swoole/parse-calc-count.php');
			require_once('./swoole/kqwf_algo.php');
														
													/*  pk10  */
			//猜冠军
			$kjnum = "05,10,03,06,02,04,09,08,07,01";
			$ret = kjq1("05",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = kjq1("02 05",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = kjq1("02 05 08",$kjnum);
			$this->assertEquals($ret, 1);

			//失败案例
			$ret = kjq1("03",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = kjq1("04 10",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = kjq1("02 09 04 03",$kjnum);
			$this->assertEquals($ret, 0);
			

			//猜冠亚军直选复式
			$kjnum = "07,08,02,09,04,10,03,01,05,06";
			 $ret = pk10_zxQ2f("07,08",$kjnum);

			$this->assertEquals($ret, 1);
			 $ret = pk10_zxQ2f("07,05 08",$kjnum);
			$this->assertEquals($ret,1);
			$ret = pk10_zxQ2f("07 08,08",$kjnum);
			$this->assertEquals($ret,1);
			//失败案例
			$ret = pk10_zxQ2f("08,07",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_zxQ2f("06,07 08",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_zxQ2f("08 07,07",$kjnum);
			$this->assertEquals($ret, 0);
			

			//猜冠亚军直选单式
			//测试成功用例：(1) 投注号码 07 08 ; (2) 投注号码 07 08;   (3)  投注号码 07 08; 开奖号码 07,08,02,09,04,10,03,01,05,06
			//测试失败用例：(1) 投注号码 08 07 ; (2) 投注号码 06 07;(3) 投注号码07 09;开奖号码 07,08,02,09,04,10,03,01,05,06
			$kjnum = "07,08,02,09,04,10,03,01,05,06";
			$ret = pk10_zxQ2d("07 08",$kjnum);

			$this->assertEquals($ret, 1);
			$ret = pk10_zxQ2d("07 08",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_zxQ2d("07 08",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = pk10_zxQ2d("08 07",$kjnum);
			$this->assertEquals($ret,0);
			$ret = pk10_zxQ2d("06 07",$kjnum);
			$this->assertEquals($ret,0);
			$ret = pk10_zxQ2d("07 09",$kjnum);
			$this->assertEquals($ret,0);
			

			//猜前三名直选复式
			//测试成功用例：(1) 投注号码 09,08,03; (2) 投注号码 02 04,06,03 04 05;   (3)  投注号码 01 03 04,04,05; 开奖号码 09,08,03,10,06,04,05,02,01,07
			//测试失败用例：(1) 投注号码 08,09,03 ; (2) 投注号码09 04,04,03 10 05;   (3) 投注号码09 04,08,10 04 05;开奖号码 07,08,02,09,04,10,03,01,05,06
			$kjnum = "09,08,03,10,06,04,05,02,01,07";
			$ret = pk10_zxQ3f("09,08,03",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_zxQ3f("09 04,08,03 04 05",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_zxQ3f("01 09 08,08,03",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = pk10_zxQ3f("08,09,03",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_zxQ3f("09 04,04,03 10 05",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_zxQ3f("09 04,08,10 04 05",$kjnum);
			$this->assertEquals($ret, 0);
			

			//猜前三名直选单式
			//测试成功用例：(1) 投注号码 09 08 03; (2) 投注号码 09 08 03;   (3)  投注号码 09 08 03; 开奖号码 09,08,03,10,06,04,05,02,01,07
			//测试失败用例：(1) 投注号码 08 09 03 ; (2) 投注号码 04 03 10 ;(3) 投注号码09 04 05;开奖号码 07,08,02,09,04,10,03,01,05,06
			$kjnum = "09,08,03,10,06,04,05,02,01,07";
			$ret = pk10_zxQ3d("09 08 03",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_zxQ3d("09 08 03",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_zxQ3d("09 08 03",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = pk10_zxQ3d("08 09 03",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_zxQ3d("04 03 10",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_zxQ3d("09 04 05",$kjnum);
			$this->assertEquals($ret, 0);
			

			//定位胆选
			//测试成功用例：(1) 投注号码 02,-,-,-,-,-,05,-,-,07; (2) 投注号码 02 04,07,03,-,-,-,-,-,-,-(3) 投注号码04,-,-,-,06,-,-,-,-,-; 开奖号码 09,08,03,10,06,04,05,02,01,07
			//测试失败用例：(1) 投注号码 08 09 03 ; (2) 投注号码 04 03 10 ;(3) 投注号码09 04 05;开奖号码 07,08,02,09,04,10,03,01,05,06
			$kjnum = "09,08,03,10,06,04,05,02,01,07";
			$ret = dwd10x("02,-,-,-,-,-,05,-,-,07",$kjnum);
			$this->assertEquals($ret, 2);
			$ret = dwd10x("02 04,07,03,-,-,-,-,-,-,-",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = dwd10x("04,-,-,-,06,-,-,-,-,-",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = dwd10x("02,-,-,-,-,-,08,-,-,09",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = dwd10x("02,-,-,-,-,-,10,-,-,03",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = dwd10x("02 04,-,-,-,-,-,01,-,-,10",$kjnum);
			$this->assertEquals($ret, 0);
			

			//双面
			//测试成功用例：(1) 投注号码 冠军-大; (2) 投注号码 亚军-小 (3) 投注号码 第五名-龙 开奖号码 09,02,03,10,06,04,05,08,01,07
			//测试失败用例：(1) 投注号码 冠军-小 ; (2) 投注号码 亚军-大 ;(3) 投注号码 第五名-虎;开奖号码 09,02,03,10,06,04,05,08,01,07
			$kjnum = "09,02,03,10,06,04,05,08,01,07";
			$ret = pk10_sm("冠军-大",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_sm("亚军-小",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_sm("第五名-龙",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = pk10_sm("冠军-小",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_sm("亚军-大",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_sm("第五名-虎",$kjnum);
			$this->assertEquals($ret, 0);
			

			//数字
			//测试成功用例：(1) 投注号码 冠军-4; (2) 投注号码 第四名-8  (3) 投注号码 第八名-7 开奖号码 09,02,03,10,06,04,05,08,01,07
			//测试失败用例：(1) 投注号码 冠军-5; (2)投注号码  第四名-9 ;(3) 投注号码 第八名-10;开奖号码 09,02,03,10,06,04,05,08,01,07
			$kjnum = "04,02,03,08,06,09,05,07,01,10";
			$ret = pk10_sz("冠军-4",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_sz("第四名-8",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_sz("第八名-7",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = pk10_sz("冠军-5",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_sz("第四名-9 ",$kjnum);
			$this->assertEquals($ret, 0);
			$ret = pk10_sz("第八名-10",$kjnum);
			$this->assertEquals($ret, 0);
			

			//冠亚和
			//测试成功用例：(1) 投注号码 冠亚军和-3,4,18,19; (2) 投注号码 冠亚军和-和小  (3) 投注号码 冠亚军和-和双 开奖号码 001,03,02,08,06,09,05,07,04,10
			//测试失败用例：(1) 投注号码 冠军-5; (2)投注号码  第四名-9 ;(3) 投注号码 第八名-10;开奖号码 01,03,02,08,06,09,05,07,04,10
			$kjnum = "01,03,02,08,06,09,05,07,04,10";
			$ret = pk10_gyh("冠亚军和-3,4,18,19",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_gyh("冠亚军和-和小",$kjnum);
			$this->assertEquals($ret, 1);
			$ret = pk10_gyh("冠亚军和-和双",$kjnum);
			$this->assertEquals($ret, 1);
			//失败案例
			$ret = pk10_gyh("冠亚军和-9,10,12,13",$kjnum);
			$this->assertEquals($ret,0);
			$ret = pk10_gyh("冠亚军和-和大 ",$kjnum);
			$this->assertEquals($ret,0);
			$ret = pk10_gyh("冠亚军和-和单",$kjnum);
			$this->assertEquals($ret,0);
			
	}
}
 
?>