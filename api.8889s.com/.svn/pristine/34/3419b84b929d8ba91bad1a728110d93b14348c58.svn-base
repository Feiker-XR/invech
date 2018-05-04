<input type="hidden" name="playedGroup" value="<?= $this->groupId ?>" />
<input type="hidden" name="playedId" value="<?= $this->played ?>" />
<input type="hidden" name="type" value="<?= $this->type ?>" />
<?php
foreach (array(
    '百',
    '十',
    '个'
) as $var) {
?>
<div class="pp" action="tzDXDS" length="2" random="sscRandom" style="width:100%;">\
	<div class="relative">
		<div class="title mt0" ><div class="wei" style="float:left;"><?= $var ?>位</div></div>
		<input type="button" value="大" class="code" />
		<input type="button" value="小" class="code" />
		<input type="button" value="单" class="code" />
		<input type="button" value="双" class="code" />
	</div>
	

</div>
<?php
}
$maxPl = $this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?= json_encode($maxPl) ?>);
})
</script>
