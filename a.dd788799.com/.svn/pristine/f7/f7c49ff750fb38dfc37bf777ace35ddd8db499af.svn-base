<?php

namespace app\listeners;

use Toplan\PhpSms\Sms as PhpSms;
use bong\service\Sms;

use bong\service\queue\Contracts\ShouldQueue;

class SmsListener //implements ShouldQueue
{

    public $queue = 'sms';

    public function onAction($event){
        
        $sms = $event->obj;

        if(! $sms instanceof Sms){
            throw new \Exception("sms事件数据有误!");        
        }

        $res = $sms->sms_send_asyn();

        if (!$res['success']) {
            //throw new \Exception($res['message']);
            Log::write('SmsListener:'.$res['message']);
        }

        return $res['success'];
    }
}


