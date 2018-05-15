<?php

namespace bong\service\broadcast\Driver;

use JPush\Client as JPushClient;

use bong\foundation\Str;
use bong\service\broadcast\BroadcastException;

class JpushBroadcaster extends Broadcaster
{
    protected $pusher;

    public function __construct($config)
    {
        $log_file = $config['log_file'] ?? RUNTIME_PATH . '/log/jpush.log';
        $this->pusher = new JPushClient($config['key'], $config['secret'], $log_file);
    }

    public function broadcast(array $channels, $event, array $payload = [])
    {
        $PushPayload = $this->pusher->push();

        $PushPayload->setPlatform('all');

        $audience_keys = ['tag','tag_and','tag_not','alias','registration_id','segment_id','abtest',];

        if(empty($channels)){
            $PushPayload->addAllAudience();
        }
        foreach($channels as $key => $value){
            if(in_array($key,$audience_keys)){
                $method = 'add'.Str::studly($key);
                $PushPayload->{$method}($value);
            }
        }

        $PushPayload->message(json_encode($payload),['title'=>$event,]);

        $PushPayload->options(array(
            // sendno: 表示推送序号，纯粹用来作为 API 调用标识，
            // API 返回时被原样返回，以方便 API 调用方匹配请求与返回
            // 这里设置为 100 仅作为示例

            // 'sendno' => 100,

            // time_to_live: 表示离线消息保留时长(秒)，
            // 推送当前用户不在线时，为该用户保留多长时间的离线消息，以便其上线时再次推送。
            // 默认 86400 （1 天），最长 10 天。设置为 0 表示不保留离线消息，只有推送当前在线的用户可以收到
            // 这里设置为 1 仅作为示例

            // 'time_to_live' => 1,

            // apns_production: 表示APNs是否生产环境，
            // True 表示推送生产环境，False 表示要推送开发环境；如果不指定则默认为推送生产环境

            'apns_production' => false,

            // big_push_duration: 表示定速推送时长(分钟)，又名缓慢推送，把原本尽可能快的推送速度，降低下来，
            // 给定的 n 分钟内，均匀地向这次推送的目标用户推送。最大值为1400.未设置则不是定速推送
            // 这里设置为 1 仅作为示例

            // 'big_push_duration' => 1
        ));

        try {
            $response = $PushPayload->send();

            if ( is_array($response) && $response['http_code'] == 200 ) {
                return;
            }            
            
            throw new BroadcastException('response code='.$response['http_code']);

        /*    
        } catch (\JPush\Exceptions\APIConnectionException $e) {
        } catch (\JPush\Exceptions\APIRequestException $e) {        
        }
        */
        } catch(\Exception $e){
            throw new BroadcastException($e->getMessage());
        }
    }

    public function auth($request){}

    public function validAuthenticationResponse($request, $result){}

}
