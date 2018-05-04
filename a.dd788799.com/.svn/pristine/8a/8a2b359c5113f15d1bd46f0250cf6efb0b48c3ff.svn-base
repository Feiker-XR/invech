<?php

namespace bong\service;

use Swift_SmtpTransport as SmtpTransport;
use Swift_SendmailTransport as SendmailTransport;

use think\View;
use think\exception\TemplateNotFoundException;

class Mail
{

    //protected static $storage;

    protected $mailer;
    //protected $from = [];

    public function __construct()
    {
        $transport = self::createTransport();
        $mailer = new \Swift_Mailer($transport);
        /*
        foreach (['from', 'reply_to', 'to'] as $param) {
            $this->setAddress($mailer, $param);
        }
        */

        $this->mailer = $mailer;
    }

    public function createTransport()
    {
        $driver = config('mail.driver')??'smtp';
        if('smtp' == $driver){
            $transport = new SmtpTransport(config('mail.host'), config('mail.port'));
            $transport->setUsername(config('mail.username'));
            $transport->setPassword(config('mail.password'));        
        }elseif('sendmail' == $driver){
            $transport = new SendmailTransport(config('mail.sendmail'));
        }else{
            throw new \Exception('邮件驱动暂不支持!');
        }
        return $transport;
    }

    protected function setAddress($mailer, $param)
    {
        $address = config('mail.'.$param);

        if (is_array($address) && isset($address['address'])) {
            $mailer->{'always'.Str::studly($param)}($address['address'], $address['name']);
        }
    }

    public function send($to,$subject,$template,$vars=[]){
        //$message = $this->mailer->createMessage('消息依赖名');
        $message = new \Swift_Message($subject);
        $message->setTo($to);

        $from = config('mail.from');
        $message->setFrom($from['address'], $from['name']);
                
        $view_config = config('template');
        $view = new View($view_config, config('view_replace_str'));
        $view_path = APP_PATH.'service'.DS.'views'.DS.'email'.DS;
        $view->config('view_path',$view_path);
        
        try{
            $html = $view->fetch('html'.DS.$template,$vars);

            $view->config('view_suffix','md');
            $markdown = $view->fetch('markdown'.DS.$template,$vars);
        }catch(TemplateNotFoundException $e){
            //
        }

        if (isset($html)) {
            $message->setBody($html, 'text/html');
        }

        if (isset($markdown)) {
            $method = isset($html) ? 'addPart' : 'setBody';

            $message->$method($markdown, 'text/plain');
        }
        
        return $this->mailer->send($message);
    }

}
