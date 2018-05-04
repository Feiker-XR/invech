<?php
$this_dir = dirname(__FILE__);
require($this_dir.'/config.php');
define('SYSTEM', $this_dir.'/system');
require(SYSTEM.'/core/core.core.php');
core::init();