<?php
return [
	'module_init'=> [
		'app\\v1\\behavior\\SaveRequest',
		'app\\v1\\behavior\\SecurityCheck',		
		'app\\v1\\behavior\\ThrottleRequests',		
	],
	//'app_end'=> [
	'response_send'=> [	
		'app\\v1\\behavior\\SetSessionId',
		'app\\v1\\behavior\\SaveResponse',
	],

];
