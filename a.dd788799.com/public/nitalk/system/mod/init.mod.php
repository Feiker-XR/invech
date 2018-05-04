<?php

class mod_init extends mod {


	public function _init() {
		$result = array(
			'Retcode' => 0,
			'Retdesc' => 'SUCCESS',
			'Gatenode' => $this->node,
		);
		$this->output($result);
	}

}