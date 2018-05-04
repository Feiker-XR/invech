<?php
namespace bong\service;

class SmsService
{
    public function token()
    {
    	return KeyToken::token();
    }

    public function check_token($token){
    	return KeyToken::check($token);
    }

    public function sms_send()
    {
    	$sms = new Sms();
		return $sms->sms_send();		
    }

    public function sms_check($code)
    {
    	$sms = new Sms();
		return $sms->sms_check($code);		
    }    
}