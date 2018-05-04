<input type="hidden" name="playedGroup" value="<?= $this->groupId ?>" />
<input type="hidden" name="playedId" value="<?= $this->played ?>" />
<input type="hidden" name="type" value="<?= $this->type ?>" />
<div class="pp pp11" action="tz11x5Select" length="1" >
	<div class="title"><div class="wei" style="float:left;">号码</div></div>
	
	<input type="button" value="三同号" class="code reset2 large" />
	
</div>
<?php

$maxPl = $this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?= json_encode($maxPl) ?>);
})
</script>