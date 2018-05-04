<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<style type="text/css">
	.lotteryView_bs .bsBox dl dd .input input {
    width: 80%;
    display: block;
    border-color: #FFA07A !important;
    box-sizing: content-box;
    padding: 3px 0;
     margin-left: 0 !important; 
    font-size: 12px;
    margin: 0 auto !important;
}
</style>
<div class="dGameStatus hklhc lotteryView_bs" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="bsBox" >
		
		<dl>
			<dt>
		<span>特别号半波</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">红大</span><span class="num" style="margin-left:30px;" data-id="RteSPHCRD"><?=$this->getLHCRte('RteSPHCRD',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCRD" name="SPHC" acno="红大" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝大</span><span class="num" style="margin-left:30px;" data-id="RteSPHCBD"><?=$this->getLHCRte('RteSPHCBD',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCBD" name="SPHC" acno="蓝大" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿大</span><span class="num" style="margin-left:30px;" data-id="RteSPHCGD"><?=$this->getLHCRte('RteSPHCGD',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCGD" name="SPHC" acno="绿大" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">红小</span><span class="num" style="margin-left:30px;" data-id="RteSPHCRS"><?=$this->getLHCRte('RteSPHCRS',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCRS" name="SPHC" acno="红小" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝小</span><span class="num" style="margin-left:30px;" data-id="RteSPHCBS"><?=$this->getLHCRte('RteSPHCBS',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCBS" name="SPHC" acno="蓝小" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿小</span><span class="num" style="margin-left:30px;" data-id="RteSPHCGS"><?=$this->getLHCRte('RteSPHCGS',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCGS" name="SPHC" acno="绿小" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">红单</span><span class="num" style="margin-left:30px;" data-id="RteSPHCRO"><?=$this->getLHCRte('RteSPHCRO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCRO" name="SPHC" acno="红单" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝单</span><span class="num" style="margin-left:30px;" data-id="RteSPHCBO"><?=$this->getLHCRte('RteSPHCBO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCBO" name="SPHC" acno="蓝单" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿单</span><span class="num" style="margin-left:30px;" data-id="RteSPHCGO"><?=$this->getLHCRte('RteSPHCGO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCGO" name="SPHC" acno="绿单" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">红双</span><span class="num" style="margin-left:30px;" data-id="RteSPHCRE"><?=$this->getLHCRte('RteSPHCRE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCRE" name="SPHC" acno="红双" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝双</span><span class="num" style="margin-left:30px;" data-id="RteSPHCBE"><?=$this->getLHCRte('RteSPHCBE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCBE" name="SPHC" acno="蓝双" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿双</span><span class="num" style="margin-left:30px;" data-id="RteSPHCGE"><?=$this->getLHCRte('RteSPHCGE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPHCGE" name="SPHC" acno="绿双" type="text"></span>
		</dd>
		</dl>
		
			<dl>
		<dt>
		<span>特别号半半波</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span id="RteSPBSOED" class="sGameStatusItem">红大单</span><span class="num" style="margin-left:30px;" data-id="RteSPRDO"><?=$this->getLHCRte('RteSPRDO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPRDO" name="SPHHC" acno="红大单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOES" class="sGameStatusItem">蓝大单</span><span class="num" style="margin-left:30px;" data-id="RteSPBDO"><?=$this->getLHCRte('RteSPBDO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPBDO" name="SPHHC" acno="蓝大单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">绿大单</span><span class="num" style="margin-left:30px;" data-id="RteSPGDO"><?=$this->getLHCRte('RteSPGDO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPGDO" name="SPHHC" acno="绿大单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">红大双</span><span class="num" style="margin-left:30px;" data-id="RteSPRDE"><?=$this->getLHCRte('RteSPRDE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPRDE" name="SPHHC" acno="红大双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOED" class="sGameStatusItem">蓝大双</span><span class="num" style="margin-left:30px;" data-id="RteSPBDE"><?=$this->getLHCRte('RteSPBDE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPBDE" name="SPHHC" acno="蓝大双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOES" class="sGameStatusItem">绿大双</span><span class="num" style="margin-left:30px;" data-id="RteSPGDE"><?=$this->getLHCRte('RteSPGDE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPGDE" name="SPHHC" acno="绿大双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">红小单</span><span class="num" style="margin-left:30px;" data-id="RteSPRSO"><?=$this->getLHCRte('RteSPRSO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPRSO" name="SPHHC" acno="红小单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">蓝小单</span><span class="num" style="margin-left:30px;" data-id="RteSPBSO"><?=$this->getLHCRte('RteSPBSO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPBSO" name="SPHHC" acno="蓝小单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOED" class="sGameStatusItem">绿小单</span><span class="num" style="margin-left:30px;" data-id="RteSPGSO"><?=$this->getLHCRte('RteSPGSO',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPGSO" name="SPHHC" acno="绿小单" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPBSOES" class="sGameStatusItem">红小双</span><span class="num" style="margin-left:30px;" data-id="RteSPRSE"><?=$this->getLHCRte('RteSPRSE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPRSE" name="SPHHC" acno="红小双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">蓝小双</span><span class="num" style="margin-left:30px;" data-id="RteSPBSE"><?=$this->getLHCRte('RteSPBSE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPRSE" name="SPHHC" acno="蓝小双" type="text"></span>
		</dd>
		<dd>
		<span id="RteSPH2DO" class="sGameStatusItem">绿小双</span><span class="num" style="margin-left:30px;" data-id="RteSPGSE"><?=$this->getLHCRte('RteSPGSE',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPRSE" name="SPHHC" acno="绿小双" type="text"></span>
		</dd>
			</dl>
		
		
			<dl>
		<dt>
		<span>特别号色波</span><span style="width:76px;">赔率</span><span style="width:28px;">金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">红波</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPRR',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPRR" name="SPCLR" acno="红波" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蓝波</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPBB',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPBB" name="SPCLR" acno="蓝波" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">绿波</span><span class="num" style="margin-left:30px;"><?=$this->getLHCRte('RteSPGG',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input maxlength="5" id="RteSPGG" name="SPCLR" acno="绿波" type="text"></span>
		</dd>
			</dl>	

    
		</div>
                 
         </div>
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