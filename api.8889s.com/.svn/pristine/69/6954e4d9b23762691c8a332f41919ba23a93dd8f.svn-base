<?php
$z3Pl = $this->getPl($this->type, 22);
$z6Pl = $this->getPl($this->type, 23);
?>
<input type="hidden" name="playedId" value="<?= $this->played ?>" />
<input type="hidden" name="playedGroup" value="<?= $this->groupId ?>" />
<input type="hidden" name="type" value="<?= $this->type ?>" />
<div class="pp" action="tzSscHhzxInput_2" played="任选" length="3" z3min="<?= $z3Pl['bonusPropBase'] ?>" z6min="<?= $z6Pl['bonusPropBase'] ?>" z3max="<?= $z3Pl['bonusProp'] ?>" z6max="<?= $z6Pl['bonusProp'] ?>">
	<div id="wei-shu" length="3" type='3x_rz3_zuhetouzhu' playedIdjsh="<?= $this->played ?>" style="width:100%">
		<label><input type="checkbox" value="16" />万</label>
		<label><input type="checkbox" value="8" />千</label>
		<label><input type="checkbox" value="4" />百</label>
		<label><input type="checkbox" value="2" />十</label>
		<label><input type="checkbox" value="1" />个</label>
      <span  line-height:200%; width:15% onclick="$('#wei-shu :checkbox').attr('checked', true);"></span>
	</div>
	<textarea id="textarea-code"></textarea>
</div>
<script type="text/javascript">
$(function(){
	gameSetPl(<?= json_encode($z3Pl) ?>);
})
</script>