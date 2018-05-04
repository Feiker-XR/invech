<?php

class mod {

	protected $db;
	protected $node;
	protected $is_post;
	
	public function __construct() {
		$this->db = core::lib('db');
		$this->node = $_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT'] == 80 ? '' : ':'.$_SERVER['SERVER_PORT']).'/nitalk';
		$this->is_post = strtolower($_SERVER['REQUEST_METHOD']) === 'post' ? true : false;
	}
	
	protected function get_user_stat($uid) {
		$sdata = $this->db->query("SELECT `active` FROM `nitalk_session` WHERE `uid`=$uid LIMIT 1", 2);
		return $sdata && $sdata['active'] > time() - 30 ? 'online' : 'offline';
	}
	
	protected function output($result) {
		$this->empty_array_to_null($result);
		echo json_encode($result);
	}
	
	private function empty_array_to_null(&$data) {
		foreach ($data as $k => &$v) {
			if (is_array($v)) {
				if (empty($v)) {
					$v = null;
				} else {
					$this->empty_array_to_null($v);
				}
			}
		}
	}

}