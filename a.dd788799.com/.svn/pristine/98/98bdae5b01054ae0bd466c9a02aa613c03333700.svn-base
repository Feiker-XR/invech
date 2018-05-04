<?php

namespace bong\service;

use Toplan\PhpSms\Sms as PhpSms;
use bong\foundation\Util;
use app\events\SmsEvent;

class Sms
{
    const STATE_KEY = '_state';

    const CAN_RESEND_UNTIL_KEY = '_can_resend_until';

    const VERIFY_SMS = 'verify_sms';

    const VOICE_VERIFY = 'voice_verify';

    const VERIFY_SMS_TEMPLATE_KEY = 'verifySmsTemplateId';

    const VOICE_VERIFY_TEMPLATE_KEY = 'voiceVerifyTemplateId';

    const closurePattern = '/(SuperClosure\\\SerializableClosure)+/';

    protected static $storage;

    protected $token = null;

    protected $state = [];

    protected $input = [];

    public function __construct()
    {
        //$header = request()->header();        
        //$token = $header['access-token']??input('access_token')??null;
        $access_token_name = config('sms.access_token')??'sms_access_token';
        $token = request()->header($access_token_name)??input($access_token_name)??null;
        if(!$token){
            throw new \Exception('sms token not exist!');
        }
        //$input = $request->param();
        $input = input();
        
        $this->token = $token;
        $this->input = array_merge([$access_token_name=>$token,], $input);
        $this->reset();
    }

    protected function reset()
    {
        $this->state = [
            'sent'     => false,
            'to'       => null,
            'code'     => null,
            'deadline' => 0,
            'attempts' => 0,
        ];
    }

    public function validateSendable()
    {
        $rules = self::getRules();
        $messages = self::getMessages();

        $validator = \think\Validate::make($rules, $messages);

        if (!$validator->check($this->input)) {
            return self::generateResult(false, 'request_invalid', $validator->getError());
        }

        $time = $this->getCanResendTime();
        if ($time <= time()) {
            return self::generateResult(true, 'can_send');
        }

        return self::generateResult(false, 'request_invalid', [self::getInterval()]);
    }

    public function getCanResendTime()
    {
        $key = $this->generateKey(self::CAN_RESEND_UNTIL_KEY);

        return (int) self::storage()->get($key, 0);
    }

    protected function generateKey()
    {
        $split = '.';
        $prefix = config('sms.storage.prefix')??'think_sms';
        $args = func_get_args();
        array_unshift($args, $this->token);
        $args = array_filter($args, function ($value) {
            return $value && is_string($value);
        });
        if (!(empty($args))) {
            $prefix .= $split . implode($split, $args);
        }

        return $prefix;
    }

    protected static function storage()
    {
        if (self::$storage) {
            return self::$storage;
        }
        $className = self::getStorageClassName();
        if (!class_exists($className)) {
            throw new \Exception("Generate storage failed, the class [$className] does not exists.");
        }
        $store = new $className();

        return self::$storage = $store;
    }

    protected static function getStorageClassName()
    {
        return config('sms.storage.driver')??'bong\service\CacheStorage';
    }

    /**
     * 请求验证码短信
     *
     * @return array
     */
    public function requestVerifySms()
    {
        $minutes = self::getCodeValidMinutes();
        $code = $this->verifyCode();
        $for = $this->input(self::getMobileField());

        $content = $this->generateSmsContent($code, $minutes);
        $templates = $this->generateTemplates(self::VERIFY_SMS);
        $tplData = $this->generateTemplateData($code, $minutes, self::VERIFY_SMS);

        $result = PhpSms::make($templates)->to($for)->data($tplData)->content($content)->send();
        if ($result === null || $result === true || (isset($result['success']) && $result['success'])) {
            $this->state['sent'] = true;
            $this->state['to'] = $for;
            $this->state['code'] = $code;
            $this->state['deadline'] = time() + ($minutes * 60);
            $this->storeState();
            $this->setCanResendAfter(self::getInterval());

            return self::generateResult(true, 'sms_sent_success');
        }

        return self::generateResult(false, 'sms_sent_failure');
    }

    protected static function getCodeValidMinutes()
    {
        return (int) (config('sms.verifyCode.validMinutes')??config('sms.code.validMinutes')??5);
    }

    protected function verifyCode()
    {
        $repeatIfValid = config('sms.verifyCode.repeatIfValid')??config('sms.code.repeatIfValid')??false;
        if ($repeatIfValid) {
            $state = $this->retrieveState();
            if (!(empty($state)) && $state['deadline'] >= time() + 60) {
                return $state['code'];
            }
        }

        return self::generateCode();
    }

    protected static function generateCode($length = null, $characters = null)
    {
        $length = (int) ($length ?? config('sms.verifyCode.length') ??
            config('sms.code.length') ?? 5);
        $characters = (string) ($characters ?: '0123456789');
        $charLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; ++$i) {
            $randomString .= $characters[mt_rand(0, $charLength - 1)];
        }

        return $randomString;
    }

    public function input($key = null, $default = null)
    {
        if ($key !== null) {
            return isset($this->input[$key]) ? $this->input[$key] : $default;
        }

        return $this->input;
    }

    public function state($key = null, $default = null)
    {
        if ($key !== null) {
            return isset($this->state[$key]) ? $this->state[$key] : $default;
        }

        return $this->state;
    }

    protected function storeState()
    {
        $this->updateState($this->state);
        $this->reset();
    }

    public function updateState($name, $value = null)
    {
        $state = $this->retrieveState();
        if (is_array($name)) {
            $state = array_merge($state, $name);
        } elseif (is_string($name)) {
            $state[$name] = $value;
        }
        $key = $this->generateKey(self::STATE_KEY);
        self::storage()->set($key, $state);
    }

    public function retrieveState($name = null)
    {
        $key = $this->generateKey(self::STATE_KEY);
        $state = self::storage()->get($key, []);
        if ($name !== null) {
            return isset($state[$name]) ? $state[$name] : null;
        }

        return $state;
    }

    public function forgetState()
    {
        $key = $this->generateKey(self::STATE_KEY);
        self::storage()->forget($key);
    }

    public function setCanResendAfter($interval)
    {
        $key = $this->generateKey(self::CAN_RESEND_UNTIL_KEY);
        $time = time() + intval($interval);
        self::storage()->set($key, $time);
    }

    protected function generateSmsContent($code, $minutes)
    {
        $content = config('sms.verifySmsContent') ?: config('sms.content');
        if (is_string($content)) {
            $content = Util::unserializeClosure($content);
        }
        if (is_callable($content)) {
            $content = call_user_func_array($content, [$code, $minutes, $this->input()]);
        }

        return is_string($content) ? $content : '';
    }

    protected function generateTemplates($type)
    {
        $templates = config('sms.templates');
        if (is_string($templates)) {
            $templates = Util::unserializeClosure($templates);
        }
        if (is_callable($templates)) {
            $templates = call_user_func_array($templates, [$this->input(), $type]);
        }
        if (!is_array($templates) || empty($templates)) {
            $key = $type === self::VERIFY_SMS ? self::VERIFY_SMS_TEMPLATE_KEY : self::VOICE_VERIFY_TEMPLATE_KEY;

            return self::getTemplatesByKey($key);
        }
        foreach ($templates as $key => $id) {
            if (is_string($id) && preg_match(self::closurePattern, $id)) {
                $id = Util::unserializeClosure($id);
            }
            if (is_callable($id)) {
                $id = call_user_func_array($id, [$this->input(), $type]);
            }
            if (is_array($id)) {
                $id = $type === self::VERIFY_SMS ? $id[0] : $id[1];
            }
            $templates[$key] = $id;
        }

        return $templates;
    }

    protected function generateTemplateData($code, $minutes, $type)
    {
        $tplData = config('sms.templateData') ?: config('sms.data');
        if (is_string($tplData)) {
            $tplData = Util::unserializeClosure($tplData);
        }
        if (is_callable($tplData)) {
            $tplData = call_user_func_array($tplData, [$code, $minutes, $this->input(), $type]);
        }
        if (!is_array($tplData) || empty($tplData)) {
            return [
                'code'    => $code,
                'minutes' => $minutes,
            ];
        }
        foreach ($tplData as $key => $value) {
            if (is_string($value) && preg_match(self::closurePattern, $value)) {
                $value = Util::unserializeClosure($value);
            }
            if (is_callable($value)) {
                $tplData[$key] = call_user_func_array($value, [$code, $minutes, $this->input(), $type]);
            }
        }

        return array_filter($tplData, function ($value) {
            return $value !== null;
        });
    }

    protected static function getMessages()
    {
        $messages = config('sms.field_messages')??[];
        $access_token_name = config('sms.access_token')??'sms_access_token';
        return array_merge([$access_token_name.'.require'=>'访问标志不存在',], $messages);
    }

    protected static function getRules()
    {
        $rules = config('sms.field_rules')??[];
        $access_token_name = config('sms.access_token')??'sms_access_token';
        return array_merge([$access_token_name=>'require',], $rules);
    }

    protected static function getFields()
    {        
        return config('sms.fields')??['mobile'];
    }

    protected static function getMobileField()
    {
        return 'mobile';
    }

    protected static function getTemplatesByKey($key)
    {
        $templates = [];
        $scheme = PhpSms::scheme();
        $config = PhpSms::config();
        foreach (array_keys($scheme) as $name) {
            if (isset($config[$name][$key])) {
                $templates[$name] = $config[$name][$key];
            }
        }

        return $templates;
    }

    protected static function getNotifyMessage($name)
    {
        $messages = config('sms.notifies')??[];
        if (array_key_exists($name, $messages)) {
            return $messages["$name"];
        }

        return $name;
    }

    protected static function getInterval()
    {
        return (int) (config('sms.interval')??60);
    }

    public static function generateResult($pass, $type, $message = '', $data = [])
    {
        $result = [];
        $result['success'] = (bool) $pass;
        $result['type'] = $type;
        if (is_array($message)) {
            $data = $message;
            $message = '';
        }
        $message = $message ?: self::getNotifyMessage($type);
        $result['message'] = Util::vsprintf($message, $data);

        return $result;
    }

    public static function closure(\Closure $closure)
    {
        return Util::serializeClosure($closure);
    }

    public function sms_send_asyn()
    {
        $for = $this->input(self::getMobileField());        
        $code = $this->retrieveState('code');
        $minutes = self::getCodeValidMinutes();

        $content = $this->generateSmsContent($code, $minutes);
        $templates = $this->generateTemplates(self::VERIFY_SMS);
        $tplData = $this->generateTemplateData($code, $minutes, self::VERIFY_SMS);

        $result = PhpSms::make($templates)->to($for)->data($tplData)->content($content)->send();
        if ($result === null || $result === true || (isset($result['success']) && $result['success'])) {            
            $this->state = $this->retrieveState();
            $this->state['sent'] = true;
            $this->storeState();
            return self::generateResult(true, 'sms_sent_success');
        }

        return self::generateResult(false, 'sms_sent_failure');
    }

    public function sms_send(){
        $res = $this->validateSendable();
        if (!$res['success']) {
            throw new \Exception($res['message']);
        }

        $minutes = self::getCodeValidMinutes();
        $code = $this->verifyCode();
        $for = $this->input(self::getMobileField());

        $this->state['sent'] = false;
        $this->state['to'] = $for;
        $this->state['code'] = $code;
        $this->state['deadline'] = time() + ($minutes * 60);
        $this->storeState();
        $this->setCanResendAfter(self::getInterval());

        event(new SmsEvent($this));

        return true;
    }

    public function sms_check($code=null){

        $ret = false;

        if($code){

            $state = $this->retrieveState();
            $ret = $state && $state['deadline'] > time() && $code === $state['code'];

            /*
            $state_code = $this->retrieveState('code');

            $ret = $code === $state_code;
            */
            if($ret){               
                $this->forgetState();     
            }           
        }

        return $ret;        
    }
}
