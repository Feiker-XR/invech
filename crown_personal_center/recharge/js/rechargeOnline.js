$(function(){
	
	$(".pay-type-choose").click(function(){
		$(this).toggleClass('Togger')
	})
	
	$(".pay-line-choose a").click(function(){
		$(this).addClass('add-color').siblings().removeClass('add-color');
	})
	
	$(".pay-bank-choose a").click(function(){
		$(this).addClass('add-border').siblings().removeClass('add-border');
	})
	
	var payBank=$(".pay-bank-choose a").size();
		$(".pay-bank-choose a").each(function(index,item){
			if(index<4){
				$(".pay-bank-choose a").eq(index).show();
			}else{
				$(".pay-bank-choose a").eq(index).hide();
			}
		})
	$(".add-bank").click(function(){
		$(".pay-bank-choose a").each(function(index,item){
			if(index<4){
				$(".pay-bank-choose a").eq(index).show();
			}else{
				$(".pay-bank-choose a").eq(index).show();
			}
		})
		$(this).hide()
	})
	
})
