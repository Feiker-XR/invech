<input type="hidden" name="playedGroup" value="<?= $this->groupId ?>" />
<input type="hidden" name="playedId" value="<?= $this->played ?>" />
<input type="hidden" name="type" value="<?= $this->type ?>" />
<div class="zhixu115 unique">
    <div class="pp pp11" action="tzAllSelect" length="2" delimiter=" ">
        <div class="title mt0"><div class="wei" style="float:left;">二同号</div></div>
       
        <input type="button" value="11" class="code" />
        <input type="button" value="22" class="code" />
        <input type="button" value="33" class="code" />
        <input type="button" value="44" class="code" />
        <input type="button" value="55" class="code" />
        <input type="button" value="66" class="code" />
    
    </div>
    <div class="pp pp11" action="tzAllSelect" length="2" delimiter=" ">
        <div class="title mt0"><div class="wei" style="float:left;">不同号</div></div>
      
        <input type="button" value="1" class="code" />
        <input type="button" value="2" class="code" />
        <input type="button" value="3" class="code" />
        <input type="button" value="4" class="code" />
        <input type="button" value="5" class="code" />
        <input type="button" value="6" class="code" />
    
    </div>
<?php
$maxPl = $this->getPl($this->type, $this->played);
?>
</div>

<script type="text/javascript">
$(function(){
	gameSetPl(<?= json_encode($maxPl) ?>);
})
</script>

