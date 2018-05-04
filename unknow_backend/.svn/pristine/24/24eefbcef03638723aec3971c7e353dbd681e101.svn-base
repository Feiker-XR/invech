<?php

//北京赛车PK拾开奖函数
function Bjsc_Auto($num , $type){
	$zh = $num[0]+$num[1];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>11){
			return '冠亚大';
		}else{
			return '冠亚小';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '冠亚双';
		}else{
			return '冠亚单';
		}
	}
	if($type==4){
		if($num[0]>$num[9]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==5){
		if($num[1]>$num[8]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==6){
		if($num[2]>$num[7]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==7){
		if($num[3]>$num[6]){
			return '龙';
		}else{
			return '虎';
		}
	}
	if($type==8){
		if($num[4]>$num[5]){
			return '龙';
		}else{
			return '虎';
		}
	}
}

//北京赛车PK拾单双
function Bjsc_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}

//北京赛车PK拾大小
function Bjsc_Dx($ball){
	if($ball>=6){
		return '大';
	}else{
		return '小';
	}
}
?>