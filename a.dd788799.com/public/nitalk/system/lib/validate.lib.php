<?php

class lib_validate {

	public function account($value) {
		return preg_match('/^[a-zA-Z0-9_]{5,15}$/', $value) ? true : false;
	}
	
	public function nickname($value) {
		return preg_match ("/^[-\x{4e00}-\x{9fa5}a-zA-Z0-9_\.]{2,16}$/u", $value);
	}
	
	public function qq($value) {
		return preg_match('/^[1-9]\d{4,12}$/', $value);
	}
	
	public function mobile($value) {
		return preg_match('/^(13|15|18)\d{9}$/', $value);
	}
	
	public function number($value) {
		return preg_match('/^[1-9]{1}[0-9]{0,}$/', $value) ? true : false;
	}

}