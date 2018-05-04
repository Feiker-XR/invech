<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("auto_class.php");
$qi 		= $_REQUEST['qi'];

if (empty($qi)) {
	echo 'qishu is empty!';
	exit;
}

//获取开奖号码
$sql		= "select * from c_auto_0 where qishu=".$qi." order by id desc limit 1";
$query		= $mysqli->query($sql);
$rs			= $query->fetch_array();
$hm 		= array();
$hm[]		= $rs['ball_1'];
$hm[]		= $rs['ball_2'];
$hm[]		= $rs['ball_3'];
$hm[]		= $rs['ball_4'];
$hm[]		= $rs['ball_5'];
$hm[]		= $rs['ball_6'];
$hm[]		= $rs['ball_7'];


// 重新结算
// 如果我点了这边的（重新结算），那么就会从这期的用户 扣掉WIN（就是已经金额）的钱，然后JS变成0，然后WIN变成购买金额*赔率（等于可赢金额），然后在执行一次 "点击结算" 的效果
if ($_GET['action'] == 'again') {
	$sql = "select * from c_bet where type='香港六合彩' and js=1 and qishu=".$qi." order by addtime asc";
	$query = $mysqli->query($sql);
	while($rows = $query->fetch_array()){
		$tmp_odds = $rows['odds'];
		$tmp_money = $rows['money'];
		$tmp_win = $rows['win'];
		$tmp_uid = $rows['uid'];
		
		$temp_will_win = $tmp_odds*$tmp_money;
		$tmp_id = $rows['id'];
		$sql2 = "update c_bet set js=0, win='$temp_will_win' where id='$tmp_id'";
		$mysqli->query($sql2);
		
		$sql2 = "update k_user set money=money-$tmp_win where uid='$tmp_uid'";
		$mysqli->query($sql2);
	}
	
	
	
	
//$msql="update c_auto_0 set ok=0 where qishu=".$qi."";
//$mysqli->query($msql) or die ("期数修改失败!!!");
//echo '重置了， 但还没有结算';
//exit;
}









//根据期数读取未结算的注单
$sql		= "select * from c_bet where type='香港六合彩' and js=0 and qishu=".$qi." order by addtime asc";
$query		= $mysqli->query($sql);
$sum		= $mysqli->affected_rows;
while($rows = $query->fetch_array()){
	echo $rows['qishu'].'<br>';
	//开始结算特码
	if($rows['mingxi_1']=='特码' || $rows['mingxi_1']=='特肖'){
		$dx		= Six_DaXiao($rs['ball_7']);
		$ds		= Six_DanShuang($rs['ball_7']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_7']);
		$hsds	= Six_HeShuDanShuang($rs['ball_7']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_7']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_7']);
		$bs		= Six_Bose($rs['ball_7']);
		$sx		= Get_ShengXiao($rs['ball_7']);	
		if($rs['ball_7']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				$msql="update c_bet set js=1,win=0 where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
					//注单中奖，给会员账户增加奖金
					$msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
					$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else if($rows['mingxi_2']==$rs['ball_7']|| $rows['mingxi_2'] == $sx){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
				
			
			}else{
				//注单未中奖，修改注单内容
				$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				
			}
		}else if($rows['mingxi_2']==$rs['ball_7'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算正一
	if($rows['mingxi_1']=='正一'){
		$dx		= Six_DaXiao($rs['ball_1']);
		$ds		= Six_DanShuang($rs['ball_1']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_1']);
		$hsds	= Six_HeShuDanShuang($rs['ball_1']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_1']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_1']);
		$bs		= Six_Bose($rs['ball_1']);
		$sx		= Get_ShengXiao($rs['ball_1']);	
		if($rs['ball_1']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				$msql="update c_bet set js=1,win='$rows[money]' where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else if($rows['mingxi_2']==$rs['ball_1']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else{
				//注单未中奖，修改注单内容
				$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				
			}
		}else if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']."  and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算正二
	if($rows['mingxi_1']=='正二'){
		$dx		= Six_DaXiao($rs['ball_2']);
		$ds		= Six_DanShuang($rs['ball_2']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_2']);
		$hsds	= Six_HeShuDanShuang($rs['ball_2']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_2']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_2']);
		$bs		= Six_Bose($rs['ball_2']);
		$sx		= Get_ShengXiao($rs['ball_2']);	
		if($rs['ball_2']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				$msql="update c_bet set js=1,win='$rows[money]' where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else if($rows['mingxi_2']==$rs['ball_2']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				    	
				}
			}else{
				//注单未中奖，修改注单内容
				$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				
			}
		}else if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算正三
	if($rows['mingxi_1']=='正三'){
		$dx		= Six_DaXiao($rs['ball_3']);
		$ds		= Six_DanShuang($rs['ball_3']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_3']);
		$hsds	= Six_HeShuDanShuang($rs['ball_3']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_3']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_3']);
		$bs		= Six_Bose($rs['ball_3']);
		$sx		= Get_ShengXiao($rs['ball_3']);	
		if($rs['ball_3']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				$msql="update c_bet set js=1,win='$rows[money]' where id='".$rows['id']."'  and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else if($rows['mingxi_2']==$rs['ball_3']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else{
				//注单未中奖，修改注单内容
				$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				
			}
		}else if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算正四
	if($rows['mingxi_1']=='正四'){
		$dx		= Six_DaXiao($rs['ball_4']);
		$ds		= Six_DanShuang($rs['ball_4']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_4']);
		$hsds	= Six_HeShuDanShuang($rs['ball_4']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_4']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_4']);
		$bs		= Six_Bose($rs['ball_4']);
		$sx		= Get_ShengXiao($rs['ball_4']);	
		if($rs['ball_4']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				$msql="update c_bet set js=1,win='$rows[money]' where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else if($rows['mingxi_2']==$rs['ball_4']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else{
				//注单未中奖，修改注单内容
				$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				
			}
		}else if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算正五
	if($rows['mingxi_1']=='正五'){
		$dx		= Six_DaXiao($rs['ball_5']);
		$ds		= Six_DanShuang($rs['ball_5']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_5']);
		$hsds	= Six_HeShuDanShuang($rs['ball_5']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_5']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_5']);
		$bs		= Six_Bose($rs['ball_5']);
		$sx		= Get_ShengXiao($rs['ball_5']);	
		if($rs['ball_5']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				$msql="update c_bet set js=1,win='$rows[money]' where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else if($rows['mingxi_2']==$rs['ball_5']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else{
				//注单未中奖，修改注单内容
				$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				
			}
		}else if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'  and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算正六
	if($rows['mingxi_1']=='正六'){
		$dx		= Six_DaXiao($rs['ball_6']);
		$ds		= Six_DanShuang($rs['ball_6']);
		$hsdx	= Six_HeShuDaXiao($rs['ball_6']);
		$hsds	= Six_HeShuDanShuang($rs['ball_6']);
		$wsdx	= Six_WeiShuDaXiao($rs['ball_6']);
		$wsds	= Six_WeiShuDanShuang($rs['ball_6']);
		$bs		= Six_Bose($rs['ball_6']);
		$sx		= Get_ShengXiao($rs['ball_6']);	
		if($rs['ball_6']==49){
			if($rows['mingxi_2']=='大' || $rows['mingxi_2']=='小' || $rows['mingxi_2']=='单' || $rows['mingxi_2']=='双' || $rows['mingxi_2']=='尾大' || $rows['mingxi_2']=='尾小' || $rows['mingxi_2']=='尾单' || $rows['mingxi_2']=='尾双' || $rows['mingxi_2']=='合大' || $rows['mingxi_2']=='合小' || $rows['mingxi_2']=='合单' || $rows['mingxi_2']=='合双'){
				$msql="update c_bet set js=1,win='$rows[money]' where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
				
			}else if($rows['mingxi_2']==$rs['ball_6']){
				//如果投注内容等于第一球开奖号码，则视为中奖
				$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else{
				//注单未中奖，修改注单内容
				$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				
			}
		}else if($rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$hsdx || $rows['mingxi_2']==$hsds || $rows['mingxi_2']==$wsdx || $rows['mingxi_2']==$wsds || $rows['mingxi_2']==$bs || $rows['mingxi_2']==$sx){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'  and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']."  and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算正码
	if($rows['mingxi_1']=='正码'){
		$sx1		= Get_ShengXiao($rs['ball_1']);	
		$sx2		= Get_ShengXiao($rs['ball_2']);	
		$sx3		= Get_ShengXiao($rs['ball_3']);	
		$sx4		= Get_ShengXiao($rs['ball_4']);	
		$sx5		= Get_ShengXiao($rs['ball_5']);	
		$sx6		= Get_ShengXiao($rs['ball_6']);	
		if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$sx1 || $rows['mingxi_2']==$sx2 || $rows['mingxi_2']==$sx3 || $rows['mingxi_2']==$sx4 || $rows['mingxi_2']==$sx5 || $rows['mingxi_2']==$sx6){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算正码过关
	if($rows['mingxi_1']=='正码过关'){
		$mignxi_2_arr=explode("<hr />",$rows['mingxi_2']);
		$arr_num=count($mignxi_2_arr)-1;
		$win=0;
		for($i=0;$i<$arr_num;$i++){
			$mingxi2_arr=explode("|",$mignxi_2_arr[$i]);
			if(!Six_ZhengMaGuoGuang($rs['ball_'.Six_ZhengMaToNum($mingxi2_arr[0])],$mingxi2_arr[1])){$win=0;break;}
			else{$win=1;}
		}
		if($win){
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算总和
	if($rows['mingxi_1']=='总和'){
		$zhdx = Six_ZongHeDaXiao($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
		$zhds = Six_ZongHeDanShuang($rs['ball_1']+$rs['ball_2']+$rs['ball_3']+$rs['ball_4']+$rs['ball_5']+$rs['ball_6']+$rs['ball_7']);
		if($rows['mingxi_2']==$zhdx || $rows['mingxi_2']==$zhds){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算一肖
	if($rows['mingxi_1']=='一肖'){
		if($rows['mingxi_2']==Get_ShengXiao($rs['ball_1']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_2']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_3']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_4']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_5']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_6']) || $rows['mingxi_2']==Get_ShengXiao($rs['ball_7'])){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算尾数
	if($rows['mingxi_1']=='尾数'){
		if($rows['mingxi_2']==Six_WeiShu($rs['ball_1']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_2']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_3']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_4']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_5']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_6']) || $rows['mingxi_2']==Six_WeiShu($rs['ball_7'])){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算全中
	if($rows['mingxi_1']=='四全中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=4){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='三全中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=3){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='三中二'){
		$zall=105;
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win==2){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}elseif($win>2){			
			$msql="update c_bet set js=1,win=".($rows['money']*$zall)." where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".($rows['money']*$zall)." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='二全中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
		}
		if($win>=2){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='二中特'){
		$zall=50;
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=$win2=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;}
			if(intval($val)==intval($rs['ball_2'])){$win++;}
			if(intval($val)==intval($rs['ball_3'])){$win++;}
			if(intval($val)==intval($rs['ball_4'])){$win++;}
			if(intval($val)==intval($rs['ball_5'])){$win++;}
			if(intval($val)==intval($rs['ball_6'])){$win++;}
			if(intval($val)==intval($rs['ball_7'])){$win2++;}
		}
		if($win>=2){
			$msql="update c_bet set js=1,win=".($rows['money']*$zall)." where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".($rows['money']*$zall)." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
								
		}elseif($win2>=1){			
			$msql="update c_bet set js=1 where id='".$rows['id']."'  and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='特串'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$win2=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_7'])){
				$win++;
			}else{
				if(intval($val)==intval($rs['ball_1'])){$win2++;}
				if(intval($val)==intval($rs['ball_2'])){$win2++;}
				if(intval($val)==intval($rs['ball_3'])){$win2++;}
				if(intval($val)==intval($rs['ball_4'])){$win2++;}
				if(intval($val)==intval($rs['ball_5'])){$win2++;}
				if(intval($val)==intval($rs['ball_6'])){$win2++;}
			}
		}
		if($win>=1 && $win2>=1){			
			$msql="update c_bet set js=1 where id='".$rows['id']."  and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='合肖'){
		if($rs['ball_7']==49){
			$msql="update c_bet set js=1,win='$rows[money]' where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			$sx		= Get_ShengXiao($rs['ball_7']);	
			if(strpos($rows['mingxi_2'],$sx)!==false){
				$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
				$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				    //注单中奖，给会员账户增加奖金
				    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
				}
			}else{
				//注单未中奖，修改注单内容
				$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}
	}
	//开始结算生肖连
	if($rows['mingxi_1']=='二肖连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=2){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='三肖连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		//echo "<p>======</p>";
		if($win>=3){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='四肖连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=4){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='五肖连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Get_ShengXiao($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Get_ShengXiao($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=5){			
			$msql="update c_bet set js=1 where id='".$rows['id']."'  and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
				$affect = $mysqli->affected_rows;
				if($affect){
				}
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0 ";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算尾数连
	if($rows['mingxi_1']=='二尾连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=2){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']."  and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='三尾连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=3){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='四尾连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=4){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='五尾连中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		$dis_sx='';
		foreach($mingxi2_arr as $val){
			if($val==Six_WeiShu($rs['ball_1']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_2']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_3']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_4']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_5']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_6']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
			if($val==Six_WeiShu($rs['ball_7']) && strpos($dis_sx, $val)===false){$win++;$dis_sx.=$val.',';continue;}
		}
		if($win>=5){			
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
			
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	if($rows['mingxi_1']=='五不中' || $rows['mingxi_1']=='六不中' || $rows['mingxi_1']=='七不中' || $rows['mingxi_1']=='八不中' || $rows['mingxi_1']=='九不中' || $rows['mingxi_1']=='十不中' || $rows['mingxi_1']=='十一不中' || $rows['mingxi_1']=='十二不中'){
		$mingxi2_arr=explode(",",$rows['mingxi_2']);
		$win=0;
		foreach($mingxi2_arr as $val){
			if(intval($val)==intval($rs['ball_1'])){$win++;break;}
			if(intval($val)==intval($rs['ball_2'])){$win++;break;}
			if(intval($val)==intval($rs['ball_3'])){$win++;break;}
			if(intval($val)==intval($rs['ball_4'])){$win++;break;}
			if(intval($val)==intval($rs['ball_5'])){$win++;break;}
			if(intval($val)==intval($rs['ball_6'])){$win++;break;}
			if(intval($val)==intval($rs['ball_7'])){$win++;break;}
		}
		if($win>0){
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js=0";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);			
			
		}else{
			$msql="update c_bet set js=1 where id='".$rows['id']."' and js=0";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			$affect = $mysqli->affected_rows;
			if($affect){
			    //注单中奖，给会员账户增加奖金
			    $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}
	}
}
$msql="update c_auto_0 set ok=1 where qishu=".$qi."";
$mysqli->query($msql) or die ("期数修改失败!!!");
?>

<style type="text/css">
body,td,th {
	font-size: 12px;
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?=$qi?>期 结算完毕！</td>
  </tr>
</table>
