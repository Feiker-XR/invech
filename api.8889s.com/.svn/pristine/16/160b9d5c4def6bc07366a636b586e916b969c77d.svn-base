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
		<span>种类</span><span style="margin-left:122px;margin-right:122px;">赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">2肖</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id="RteZX2x"><?=$this->getLHCRte('RteZX2x',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteZX2x" name="LTTBP" acno="2肖" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">3肖</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id="RteZX3x"><?=$this->getLHCRte('RteZX3x',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteZX3x" name="LTTBP" acno="3肖" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">4肖</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id="RteZX4x"><?=$this->getLHCRte('RteZX4x',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteZX4x" name="LTTBP" acno="4肖" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">5肖</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id="RteZX5x"><?=$this->getLHCRte('RteZX5x',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteZX5x" name="LTTBP" acno="5肖" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">6肖</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id="RteZX6x"><?=$this->getLHCRte('RteZX6x',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteZX6x" name="LTTBP" acno="6肖" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">7肖</span>
		<span style="margin-left:127px;margin-right: 122px;" class="num" data-id="RteZX7x"><?=$this->getLHCRte('RteZX7x',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteZX7x" name="LTTBP" acno="7肖" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">总肖单</span>
		<span style="margin-left:101px;margin-right: 122px;" class="num" data-id="RteZXd"><?=$this->getLHCRte('RteZXd',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteZXd" name="LTTBP" acno="总肖单" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">总肖双</span>
		<span style="margin-left:101px;margin-right: 122px;" class="num" data-id="RteZXs"><?=$this->getLHCRte('RteZXs',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteZXs" name="LTTBP" acno="总肖双" type="text"></span>
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