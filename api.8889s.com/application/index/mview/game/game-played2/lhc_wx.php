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
		<dl style="width:860px;">
			<dt>
		<span>种类</span><span style="margin-left:150px;">号码</span><span style="margin-left:411px;margin-right:50px;">赔率</span><span>金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">金</span><span style="margin-left: 122px;" class="blue">03</span><span class="blue">04</span><span class="green">17</span><span class="red">18</span><span class="blue">25</span><span class="blue">26</span><span class="green">33</span><span class="red">34</span><span class="blue">47</span><span class="blue">48</span><span style="margin-left:160px;margin-right: 55px;" class="num" data-id="RteWXJ"><?=$this->getLHCRte('RteWXJ',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteWXJ" name="LTTBP" acno="金" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">木</span><span style="margin-left: 122px;" class="red">07</span><span class="red">08</span><span class="blue">15</span><span class="green">16</span><span class="red">29</span><span class="red">30</span><span class="blue">37</span><span class="green">38</span><span class="red">45</span><span class="red">46</span><span style="margin-left:160px;margin-right: 55px;" class="num" data-id="RteWXM"><?=$this->getLHCRte('RteWXM',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteWXM" name="LTTBP" acno="木" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">水</span><span style="margin-left: 122px;" class="green">05</span><span class="green">06</span><span class="red">13</span><span class="blue">14</span><span class="green">21</span><span class="green">22</span><span class="red">35</span><span class="blue">36</span><span class="green">43</span><span class="green">44</span><span style="margin-left:160px;margin-right: 55px;" class="num" data-id="RteWXS"><?=$this->getLHCRte('RteWXS',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteWXS" name="LTTBP" acno="水" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">火</span><span style="margin-left: 122px;" class="red">01</span><span class="red">02</span><span class="blue">09</span><span class="blue">10</span><span class="red">23</span><span class="red">24</span><span class="blue">31</span><span class="green">32</span><span class="green">39</span><span class="red">40</span><span style="margin-left:160px;margin-right: 55px;" class="num" data-id="RteWXH"><?=$this->getLHCRte('RteWXH',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteWXH" name="LTTBP" acno="火" type="text"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">土</span><span style="margin-left: 122px;" class="green">11</span><span class="red">12</span><span class="red">19</span><span class="blue">20</span><span class="green">27</span><span class="green">28</span><span class="blue">41</span><span class="blue">42</span><span class="green">49</span><span style="margin-left:193px;margin-right: 55px;" class="num" data-id="RteWXT"><?=$this->getLHCRte('RteWXT',$this->played)?></span>
		<span class="input"><input maxlength="5" id="RteWXT" name="LTTBP" acno="土" type="text"></span>
		</dd>
		</dl>
			  </div>  
			  </div>
            </div>
		
				<div class="addOrderBox _lhc _lhc" >
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