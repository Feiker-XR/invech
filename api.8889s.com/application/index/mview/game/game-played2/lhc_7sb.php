<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<style type="text/css">
	.lotteryView_sxtw .sxtwBox dl dd.active{
		background-color: #F13131;
		border-color: #F13031;
	}
	.lotteryView_sxtw .sxtwBox dl dd.active span{
		color: #fff;
	}
</style>
<div class="dGameStatus hklhc lotteryView_sxtw" action="tzlhcSelect" length="1">
      <div class="Contentbox" id="Contentbox_0">
        <div class="sxtwBox" >
		<dl style="width:725px;">
			<dt>
		<span>种类</span><span style="margin-left:122px;margin-right:123px;">赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">红波</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id="Rte7SBhb"><?=$this->getLHCRte('Rte7SBhb',$this->played)?></span>
		<span class="input"><input maxlength="5" id="Rte7SBhb" name="LTTBP" acno="红波" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿波</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id=id="Rte7SBlvb"><?=$this->getLHCRte('Rte7SBlvb',$this->played)?></span>
		<span class="input"><input maxlength="5" id="Rte7SBlvb" name="LTTBP" acno="绿波" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝波</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id=id="Rte7SBlanb"><?=$this->getLHCRte('Rte7SBlanb',$this->played)?></span>
		<span class="input"><input maxlength="5" id="Rte7SBlanb" name="LTTBP" acno="蓝波" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">和局</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id=id="Rte7SBhj"><?=$this->getLHCRte('Rte7SBhj',$this->played)?></span>
		<span class="input"><input maxlength="5" id="Rte7SBhj" name="LTTBP" acno="和局" type="text"></span>
		</dd>
		</dl>
			  </div>  
			  </div>
            </div>
		
				<div class="addOrderBox _lhc" >
                <div class="addOrderLeft addOrderLeftsxtw">
                                   
                   <input type="button" class="addBtn" onclick="bringRte();" value="添加投注">
                    <div class="chooseMsg">
                        <p>总金额共 <span id="sTotalCredit">0</span> 元</p>
                    </div>
                </div>
           
            </div>
            
<script>
	$(".Contentbox dd").click(function(){
		var that= $(this);
		if(that.is('.active')){
			that.removeClass("active");
			that.find('input[type="text"]').val("");
		}else{
			that.addClass("active");
			that.find('input[type="text"]').val(1);
		}
		that.find("input").trigger("change");
	})
	$("dd input[type='text']").click(function(e){
		e.stopPropagation();
	})
	$("dd input[type='text']").blur(function(){
			clearCheck($(this));
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
    	 	lis.removeClass("active"); 
    	 }else{   
    	 	lis.addClass("active");
    	 }
    }
</script>