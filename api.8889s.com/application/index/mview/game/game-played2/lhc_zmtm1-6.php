<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<style type="text/css">
	.lotteryView_lhc .lhcBox dl dd span{
		color: #000;
		font-size: 15px;
	}
	.lotteryView_lhc .lhcBox dl dd span.titles{
		line-height: 52px;
	}
	.lotteryView_lhc .lhcBox dl dd span.num{
		position: relative;
		top: -9px;
		left: 42px;
		color:red;
		width: 40px;
	}
	.lotteryView_lhc .lhcBox dl dd span.input{
		position: relative;
		top: 19px;
		left: -10px;
	}
	.lotteryView_lhc .lhcBox dl dd span input{
		width: 50px;
	}
	.lotteryView_lhc .lhcBox dl dd{
		height: 50px;
	}
	.lotteryView_lhc .lhcBox dl {
		width:150px;
	}
</style>
<div class="dGameStatus hklhc lotteryView_lhc" action="tzlhcSelect" length="1">
      <div class="Contentbox" id="Contentbox_0">
        <div class="lhcBox" >
		<dl class="zm16 clearfix">
			<dt>
				正码一
			</dt>
			<?php $data = $this->getLHCInfo($this->played,1);
				foreach ($data as $val) { ?>
			<dd>
				<span class="titles large"><?=$val['rName']?></span><span class="num" data-id="<?=$val['Rte']?>"><?=$val['Rte']?></span>
				<span class="input"><input maxlength="5" id="<?=$val['flag']?>" name="LOTTO" acno="01" type="text"></span>
			</dd>

			<?php	}
			?>
			
		</dl>
		<dl class="zm16 clearfix">
			<dt>
				正码二
			</dt>
			<?php $data = $this->getLHCInfo($this->played,2);
				foreach ($data as $val) { ?>
			<dd>
				<span class="titles large"><?=$val['rName']?></span><span class="num" data-id="<?=$val['Rte']?>"><?=$val['Rte']?></span>
				<span class="input"><input maxlength="5" id="<?=$val['flag']?>" name="LOTTO" acno="01" type="text"></span>
			</dd>

			<?php	}
			?>
			
		</dl>
		<dl class="zm16 clearfix">
			<dt>
				正码三
			</dt>
			<?php $data = $this->getLHCInfo($this->played,3);
				foreach ($data as $val) { ?>
			<dd>
				<span class="titles large"><?=$val['rName']?></span><span class="num" data-id="<?=$val['Rte']?>"><?=$val['Rte']?></span>
				<span class="input"><input maxlength="5" id="<?=$val['flag']?>" name="LOTTO" acno="01" type="text"></span>
			</dd>

			<?php	}
			?>
			
		</dl>
		<dl class="zm16 clearfix">
			<dt>
				正码四
			</dt>
			<?php $data = $this->getLHCInfo($this->played,4);
				foreach ($data as $val) { ?>
			<dd>
				<span class="titles large"><?=$val['rName']?></span><span class="num" data-id="<?=$val['Rte']?>"><?=$val['Rte']?></span>
				<span class="input"><input maxlength="5" id="<?=$val['flag']?>" name="LOTTO" acno="01" type="text"></span>
			</dd>

			<?php	}
			?>
			
		</dl>
		<dl class="zm16 clearfix">
			<dt>
				正码五
			</dt>
			<?php $data = $this->getLHCInfo($this->played,5);
				foreach ($data as $val) { ?>
			<dd>
				<span class="titles large"><?=$val['rName']?></span><span class="num" data-id="<?=$val['Rte']?>"><?=$val['Rte']?></span>
				<span class="input"><input maxlength="5" id="<?=$val['flag']?>" name="LOTTO" acno="01" type="text"></span>
			</dd>

			<?php	}
			?>
			
		</dl>
		<dl class="zm16 clearfix">
			<dt>
				正码六
			</dt>
			<?php $data = $this->getLHCInfo($this->played,6);
				foreach ($data as $val) { ?>
			<dd>
				<span class="titles large"><?=$val['rName']?></span><span class="num" data-id="<?=$val['Rte']?>"><?=$val['Rte']?></span>
				<span class="input"><input maxlength="5" id="<?=$val['flag']?>" name="LOTTO" acno="01" type="text"></span>
			</dd>

			<?php	}
			?>
			
		</dl>
		
              </div>    </div>    </div>
            </div>
		
				<div class="addOrderBox _lhc" >
                <div class="addOrderLeft addOrderLeft625">
                                   
                   <input type="button" class="addBtn" onclick="bringRte();" value="添加投注">
                    <div class="chooseMsg">
                        <p>总金额共 <span id="sTotalCredit">0</span> 元</p>
                    </div>
                </div>
           
            </div>
            
<script>
$("#submenu").find("#sTotalCredit").remove();
		$("dd span").click(function(){
			var that = $(this);
			var parent = that.parent();
			if(!that.is(".input") &&　!that.is(".num")){
				if(that.is(".active")){
					 that.removeClass("active").css("background-color","#fff !important");
					 that.get(0).style.cssText='background-color:#fff !important;color:#ca1a1a !important';
					 parent.find('input[type="text"]').val("");
				}else{
					 that.addClass("active");
					 that.get(0).style.cssText='background-color:#ec2829 !important;color:white !important';
					 parent.find('input[type="text"]').val(1);
				}
			}
			parent.find("input").trigger("change");
		});
		
		$("dd input[type='text']").blur(function(){
			clearCheck($(this));
		})
		$("dd input[type='text']").click(function(e){
			e.stopPropagation();
		})
		 function clearCheck(that){
    	var val = that.val();
    	var lis = that.parents("dd");
    	 if(isNaN(val) && typeof val != 'number' ){
    	 	 that.val("");
    	 };
    	 if(that.val() <= 0){
    	 		that.val("");
    	 };
    	 if(that.val() == ''){
    	 	lis.find("span").eq(0).removeClass("active");
    	 	lis.find("span").eq(0).get(0).style.cssText='background-color:#fff !important;color:#ca1a1a !important';
    	 }else{
    	 	  if(!lis.find("span").eq(0).is(".active")){
    	 	  	 lis.find("span").eq(0).addClass("active");
    	 	  	 lis.find("span").eq(0).get(0).style.cssText='background-color:#ec2829 !important;color:white !important';
    	 	  }
    	 }
    }
	
</script>