<?php
return [
	'events'	=>	\bong\service\EventDispatcher::class,
	'broadcast'	=>	\bong\service\broadcast\BroadcastManager::class,
	'queue'		=>	\bong\service\queue\QueueManager::class,
	'hasher'	=>	\bong\service\BcryptHasher::class,
	'encrypter'	=>	\bong\service\Encrypter::class,
	'auth'		=>	\bong\service\auth\AuthManager::class,
	'policy'	=>	\bong\service\auth\access\Policy::class,
	'sms'		=>	\bong\service\SmsService::class,
	'logger'		=>	\bong\service\Logger::class,
];


