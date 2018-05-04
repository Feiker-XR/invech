<?php
namespace app\classes;
use think\Db;
use app\classes\Lunar;
/*
功能：时时彩官方玩法随机一注函数
username : sky
data : 2018.1.29
 */
class random {
	static private	$ssczx_count =[1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 63, 69, 73, 75, 75, 73, 69, 63, 55, 45, 36, 28, 21, 15, 10, 6, 3, 1];
    static private  $ssc3xkd_comut =  [10, 54, 96, 126, 144, 150, 144, 126, 96, 54];
    static private  $ssc3xzxhz_comut = [1,2,2,4,5,6,8,10,11,13,14,14,15,15,14,14,13,11,10,8,6,5,4,2,2,1];
    static private  $ssc2zx_count = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
    static private  $ssc2xkd_comut = [10, 18, 16, 14, 12, 10, 8, 6, 4, 2];
    static private  $ssc2zux_count = [1,1,2,2,3,3,4,4,5,4,4,3,3,2,2,1,1];

	static private  $count = 1;
	static private  $yiyweishu = 0;
	static private  $n;
	static private  $suiji = 1;
    static private  $pl = '0';
	 /*获取位数函数 
       $len:几位数
	 */
     public static function getWeishu($len){
    	 $weishu  =[16,8,4,2,1];
          $str = 0;
          for($i=0;$i<$len;$i++){
                $key =  array_rand($weishu,1);
                $str +=  $weishu[$key];
                unset($weishu[$key]);
            }
            
        return $str;
	 }

	 /*获取任选大小单双随机数
	   $len:几位数
       $zwlen 占位长度
	*/
    public static function getRandomrxdxds($len,$zwlen){
        $ran = [];
        $i = 1;
        while($i <= intval($zwlen)) {
          $ran[] =  $i;
          $i++;
        } 
        $ranlist =[];
		$dxds =['大', '小', '单', '双'];
		for($j=0;$j<$len;$j++){
			$key =  array_rand($ran,1);
			$ranlist[]=  $ran[$key];
            unset($ran[$key]);
		}
		$str = '';
    	for($i=1;$i<=intval($zwlen);$i++){
    		if(in_array($i,$ranlist)){
    			$rans = rand(0,3);
    			$number = $dxds[$rans];
    			if($i == intval($zwlen)){
    				$str .= $number;
    			}else{
    				$str .= $number.',';
    			}
    		}else{
    			if($i == intval($zwlen)){
    				$str .= "-";
    			}else{
    				$str .= "-,";
    			}
    			
    		}
    	}
        return $str;
    }

 	 /*获取大小单双随机数
 	  $len:几位数
	*/
    public static function getRandomdxds($len){
       $str ='';
        $dxds = ['大', '小', '单', '双'];
       for($i=1;$i<=$len;$i++ ){
       		 $wr = rand(0,3);
       		if($i==$len){
       			 $str .= $dxds[$wr];
       		}else {
       			 $str .=  $dxds[$wr].',';
       		}
       }

        return $str;
    }

    /*获取特殊号码随机数
 	*/
   public static function getRandomtshm()
    {
        $w = ['豹子', '顺子', '对子'];
        $wr = rand(0,2);
       	$str = $w[$wr];
        return $str;
    }
    /*获取总和大小单双随机数
 	*/
     public static function getRandomzhdxds()
    {
        $w = ['总和大', '总和小','总和单','总和双'];
        $wr = rand(0, 3);
    	$str = $w[$wr];
        return $str;
    }
   	
   	 /**获取龙虎和随机数*/
    public static function getRandomlhh()
    {

		$dxds = ['龙', '虎','和'];
		$str = $dxds[mt_rand(0, 1)];
		return $str;
    }
    /*--占位函数*/

    public static function getRandomzw($number,$start,$end){
            $ran = rand($start,$end);
            $str = '';
            for($i=1;$i<=$end;$i++){
                if($i == $ran){
                    if($i == $end){
                        $str .= $number;
                    }else{
                        $str .= $number.',';
                    }
                }else{
                    if($i == $end){
                        $str .= "-";
                    }else{
                        $str .= "-,";
                    }
                    
                }
            }
            return  $str;
    }

    /* 空格分割函数
     public static function getRandomkgstr($number){
            $len = mb_strlen($number);
            $strlist = [];
            for($i=0;$i<$len;$i++){
                 $strlist[] = $number[$i];
            }
            $str = implode(" ", $strlist);
            return $str;

     }
    */

     /*获取一般玩法随机选号          位数 选号个数 起止 是否可以相同 */
    public  static function getRandom($row, $start, $end, $diff,$feige='')
    {
        $number = "";
        $array =[];
        $countnum = 0;
      	if ($diff == 1) {
          	 for ($i = 0; $i < $row; $i++) {
                    $number .= rand($start, $end);
                    if ($i != $row - 1) {
                        $number .= ",";
                    }
            }
        } else {
        	while ($countnum < $row) {
	            $array[] = mt_rand($start, $end);
				$array = array_flip(array_flip( $array));
				$countnum = count( $array);
       		 }
        	 $number = implode($feige, $array);
            
        }
		return $number;

    }

    /*
    pk10
     */
    public static function getRandomPk10($row, $start, $end, $diff,$feige=','){
        $number = "";
        $array =[];
        $countnum = 0;
        if ($diff == 1) {
             for ($i = 0; $i < $row; $i++) {
                    $randnum =  rand($start, $end);
                    if(strlen( $randnum)==1){
                        $number .= '0'.$randnum;
                    }else{
                        $number .= $randnum;
                    }
                    
                    if ($i != $row - 1) {
                        $number .= ",";
                    }
            }
        } else {
            while ($countnum < $row) {
                 $randnum = mt_rand($start, $end);
                if(strlen( $randnum)==1){
                        $array[]= '0'.$randnum;
                }else{
                     $array[] = $randnum;
                }
                 $array = array_flip(array_flip( $array));
                $countnum = count( $array);
             }
             $number = implode($feige, $array);
            
        }
        return $number;
    }
    
         /**获取任选复式单式随机数*/
    public static function getRandomrxfds($row){
            $ran = array(1,2,3,4,5);//用来站位
            $ranlist =array();
            $dxds = array(0,1,2,3,4,5,6,7,8,9);
            for($j=0;$j<$row;$j++){
                $key =  array_rand($ran,1);
                $ranlist[]=  $ran[$key];
                unset($ran[$key]);
            }

            $str = '';
            for($i=1;$i<=5;$i++){
                if(in_array($i,$ranlist)){
                    $ran = rand(0,9);
                    $number = $dxds[$ran];
                    if($i == 5){
                        $str .= $number;
                    }else{
                        $str .= $number.',';
                    }
                }else{
                    if($i == 5){
                        $str .= "-";
                    }else{
                        $str .= "-,";
                    }
                    
                }
            }
        return $str;
    }

    //返回结果函数
    public static function jieguo(){

    	return ['actionData'=>self::$n,'actionNum'=>self::$count,'pl'=>self::$pl,'yiyweishu'=>self::$yiyweishu,'suiji'=>self::$suiji];
    }

    //直选单式
 	public static function  zx($selectNum,$weishu=0){
 		
         self::$n = self::getRandom($selectNum, 0, 9, 1);
        return self::jieguo();
 	}
  
   //组选120
 	public static function  zx120($selectNum,$weishu=0,$playid){
     	self::$n = self::getRandom( $selectNum, 0, 9,0);
        self::$yiyweishu = $weishu?self::getWeishu($weishu) : 0;
        return self::jieguo();
 	}

    //组选60
     public static function  zx60($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum, 0, 9,0);
        self::$n =substr_replace(self::$n,",",1,0);
        self::$yiyweishu = $weishu?self::getWeishu($weishu) : 0;
        return self::jieguo();
    }

     //组选30
     public static function  zx30($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum, 0, 9,0);
        self::$n =substr_replace(self::$n,",",2,0);
        return self::jieguo();
    }

    //特殊龙虎和
     public static function  zlhh($selectNum,$weishu=0,$playid){
        self::$n = self::getRandomlhh();
         return self::jieguo();
    }
     //总和大小单双
    public static function  zhdxds($selectNum,$weishu=0,$playid){
        self::$n = self::getRandomzhdxds();
        return self::jieguo();
    }

    //组三复式
    public static function  z3fs($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum, 0, 9,0);
        self::$yiyweishu = $weishu?self::getWeishu($weishu) : 0;
        self::$count = 2;
        return self::jieguo();
    }

    //直选和值0-27
    public static function  zxhz27($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum, 0,27,0);
        self::$count =self::$ssczx_count[intval(self::$n)];
        self::$yiyweishu = $weishu?self::getWeishu($weishu) : 0;
        return self::jieguo();
    }
    //组选和值1-26
    public static function  zxhz26($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum,1,26,0);
        self::$count =self::$ssc3xzxhz_comut[intval(self::$n)];
        self::$yiyweishu = $weishu?self::getWeishu($weishu) : 0;
        return self::jieguo();
    }

     //直选跨度0-9
    public static function  zxkd($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum, 0,9,0);
        self::$count =self::$ssc3xkd_comut[intval(self::$n)];
        return self::jieguo();
    }

       //直选3星特殊号
    public static function  z3xts($selectNum,$weishu=0,$playid){
        self::$n = self::getRandomtshm();
        return self::jieguo();
    }

    //直选和值0-18
    public static function  zxhz18($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum, 0,18,0);
        self::$count =self::$ssc2zx_count[intval(self::$n)];
        self::$yiyweishu = $weishu?self::getWeishu($weishu) : 0;
        return self::jieguo();
    }
      //2星直选跨度0-9
    public static function  z2xzxkd($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum, 0,9,0);
        self::$count =self::$ssc2xkd_comut[intval(self::$n)];
        return self::jieguo();
    }

     //2星组选和值1-17
    public static function  zxhz17($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum,1,17,0);
        self::$count =self::$ssc2zux_count[intval(self::$n)-1];
        self::$yiyweishu = $weishu?self::getWeishu($weishu) : 0;
        return self::jieguo();
    }
    // 2星组选包胆
   public static function  zxbd($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum,0,9,0);
        self::$count =9;
        return self::jieguo();
    }

    //定胆位
    public static function ddw($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum,0,9,0);
        self::$n = self::getRandomzw(self::$n,1,5);
       
        return self::jieguo();
    }
    //3星定胆位
    public static function ddw3x($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum,0,9,0);
        self::$n = self::getRandomzw(self::$n,1,3);
       
        return self::jieguo();
    }
     //不定胆位 
    public static function bddw($selectNum,$weishu=0,$playid){
        self::$n = self::getRandom( $selectNum,0,9,0,' ');
       
        return self::jieguo();
    }

    //大小单双不任选
    public static function dxds(  $selectNum,$weishu=0,$playid){
        self::$n = self::getRandomdxds($selectNum);
        return self::jieguo();
    }
     //5星大小单双任选
     public static function rxdxds(  $selectNum,$weishu=0,$playid){
        self::$n = self::getRandomrxdxds($selectNum,5);
        return self::jieguo();
    }
     //3星大小单双任选
     public static function rxdxds3x(  $selectNum,$weishu=0,$playid){
        self::$n = self::getRandomrxdxds($selectNum,3);
        return self::jieguo();
    }

    //任选复式单式
     public static function rxfsds(  $selectNum,$weishu=0,$playid){
        self::$n = self::getRandomrxfds($selectNum);
        self::$yiyweishu = $weishu?self::getWeishu($weishu) : 0;
        return self::jieguo();
    }

    //pk10
    public static function pk10zx( $selectNum,$weishu=0,$playid){
        self::$n = self::getRandomPk10($selectNum,1,10,0);
        return self::jieguo();

    }
    //  pk10定胆位
    public static function pk10dd($selectNum,$weishu=0,$playid){
        self::$n = self::getRandomPk10($selectNum,1,10,0);
         self::$n = self::getRandomzw(self::$n,1,10);
        return self::jieguo();
    }

    //11选5
    public static function zx11x5($selectNum,$weishu=0,$playid) {
         self::$n = self::getRandomPk10($selectNum,1,11,0,' ');
        return self::jieguo();
    }

     //11选5直选
    public static function zx11x5zx($selectNum,$weishu=0,$playid) {
         self::$n = self::getRandomPk10($selectNum,1,11,0);
        return self::jieguo();
    }

    //北京快8
    public static function zxbjk8($selectNum,$weishu=0,$playid) {
         self::$n = self::getRandomPk10($selectNum,1,80,0,' ');
        return self::jieguo();
    }

    //快钱玩法 
    //重庆时时彩
     public static function kqgroup($playid){
        $group = Db("played_pl_group")->where('playedId' ,'=',$playid)->order('id asc')->select();
        $list = [];
         if(!$group->isEmpty()){
            $group =  $group->toArray();
             $list = $group[array_rand($group,1)];
        }
       return $list;
    }

    public static function kqsmszyz($selectNum,$weishu=0,$playid){
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        $playedlist = $played[array_rand($played,1)];
        self::$n = $list['name'].'-'. $playedlist['value'];
        self::$pl =  $playedlist['pl'];
        return self::jieguo();
     }

     public static function kqeszdw($selectNum,$weishu=0,$playid){
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        $playedlist = $played[array_rand($played,1)];
        self::$n =$list['name'].'-'.self::getRandomzw($playedlist['value'],1,5);
        self::$pl =  $playedlist['pl'];
        return self::jieguo();
     }

     public static function kqezzh($selectNum,$weishu=0,$playid){
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        $playedlist = $played[array_rand($played,1)];
        self::$n = $list['name'].'-'. self::getRandom($playedlist['value'], 0, 9, 1);
        self::$pl =  $playedlist['pl'];
        return self::jieguo();

     }

     public static function kqzx($selectNum,$weishu=0,$playid){
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        $playedlist = $played[array_rand($played,1)];
        self::$n =$list['name'].'-'.self::getRandom($playedlist['value'], 0, 9, 0,',');
        self::$pl =  $playedlist['pl'];
        return self::jieguo();

     }

     public static function kqsz3zh($selectNum,$weishu=0,$playid){
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        $playedlist = $played[array_rand($played,1)];
        if($list['mode'] == '1'){
            self::$n = $list['name'].'-'.self::getRandom($playedlist['value'], 0, 9, 1);
        }else{
            self::$n = $list['name'].'-'. $playedlist['value'];
        }
            self::$pl =  $playedlist['pl'];
     }

     public static function kqk3sbt($selectNum,$weishu=0,$playid){
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        $playedlist = $played[array_rand($played,1)];
        self::$n =$list['name'].'-'.self::getRandom($playedlist['value'], 0, 6, 0,',');
        self::$pl =  $playedlist['pl'];
        return self::jieguo();
     }
     //六合彩特殊随机
    public  static function getRandomluhc($row){
            $number = "";
            $list =['鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪'];
            $array = [];
            $countnum = 0;
           while ($countnum < $row) {
                $array[] =  $list[array_rand($list,1)];
                $array = array_flip(array_flip( $array));
                $countnum = count( $array);
            }
            $number = implode(',', $array);
            return $number;

     }

     public static function kqlhxw($selectNum,$weishu=0,$playid){
        date_default_timezone_set("PRC");
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        
        if($list['mode'] == '1'){
            $sxdict = ['鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪'];
            $today = date("Y-m-d",time());
            $lunar = new Lunar();
            $year = date("Y",$lunar->S2L($today));
            $x = $sxdict[(($year-4)%12)]; 
            switch ($x) {
                case '猪':
                    $sx = array('猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠');
                    break;
                case '狗':
                    $sx = array('狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪');
                    break;
                case '鸡':
                    $sx = array('鸡','猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗');
                    break;
                case '猴':
                    $sx = array('猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡');
                    break;
                case '羊':
                    $sx = array('羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴');
                    break;
                case '马':
                    $sx = array('马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊');
                    break;
                case '蛇':
                    $sx = array('蛇','龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马');
                    break;
                case '龙':
                    $sx = array('龙','兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇');
                    break;
                case '兔':
                    $sx = array('兔','虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙');
                    break;
                case '虎':
                    $sx = array('虎','牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔');
                    break;
                case '牛':
                    $sx = array('牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎');
                    break;
                case '鼠':
                    $sx = array('鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛');
                    break;
                default:
                    $sx = array('鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎','牛');
            }
            $sxlist = [];
            foreach($sx as $k=>$v){
                $sxlist[$k]['value'] = $v;
                $sxlist[$k]['pl'] =  $played[$k]['pl'];
            }
            $playedlist = $sxlist[array_rand($sxlist,1)];
            self::$n = $list['name'].'-'. $playedlist['value'];
            self::$pl =  $playedlist['pl'];
        }else{
            $playedlist = $played[array_rand($played,1)];
            self::$n = $list['name'].'-'. $playedlist['value'];
            self::$pl =  $playedlist['pl'];
        }
          return self::jieguo();  
     }

    public static function kqlhhx($selectNum,$weishu=0,$playid){
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        $playedlist = $played[array_rand($played,1)];
        self::$n =$list['name'].'-'.self::getRandomluhc($playedlist['value']);
        self::$pl =  $playedlist['pl'];
        return self::jieguo();
     }

    public static function kqlhqbz($selectNum,$weishu=0,$playid){
        $list = [];
        $list = self::kqgroup($playid);
        $played = Db("played_pl")->where('playedId' ,'=',$list['playedId'])->where('pl_group_id','=', $list['id'])->select();
        $played=  $played->toArray();
        $playedlist = $played[array_rand($played,1)];
        self::$n =$list['name'].'-'.self::getRandom($playedlist['value'],1, 49, 0,',');
        self::$pl =  $playedlist['pl'];
        return self::jieguo();

     }
}