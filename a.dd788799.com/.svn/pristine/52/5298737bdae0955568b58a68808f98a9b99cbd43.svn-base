<?php
namespace app\command;

use app\common\model\Member;
use app\events\BroadLotteryEvent;
use think\console\Command;
use think\console\Input;
use think\console\Output;

//use app\common\model\Played;
use app\common\model\Type;
use app\common\model\Data;
use app\common\model\LotteryData;
use app\events\LotteryEvent;
use think\Db;
use think\Exception;

class ChatServer extends Command
{
    protected function configure()
    {
        $this->setName('chat_server')->setDescription('聊天室服务');
    }

    protected function execute(Input $input, Output $output)
    {
        $server = new \swoole_websocket_server("0.0.0.0", '39002', SWOOLE_BASE);
        $server->set(array(
//            'worker_num' => 8,
//            'max_request' => 1000,
//            'max_conn' => 10000,
//            'dispatch_mode' => 2,
            'debug_mode'=> 1,
            'daemonize' => true,
            'log_file' => '/tmp/swoole.log',
//            'pipe_buffer_size' => 32 * 1024 * 1024,
//            'buffer_output_size' => 32 * 1024 *1024, //必须为数字
//            'socket_buffer_size' => 32 * 1024 *1024, //必须为数字
//            'task_worker_num' => 10,
////            'open_length_check' => true,
//            'package_max_length' => 81920,
//            'package_length_type' => 'n', //see php pack()
//            'package_length_offset' => 0,
//            'package_body_offset' => 2,
        ));

        $server->on('handshake', function (\swoole_http_request $request, \swoole_http_response $response) use($server)
        {
            //自定定握手规则，没有设置则用系统内置的（只支持version:13的）
            if (!isset($request->header['sec-websocket-key']))
            {
                //'Bad protocol implementation: it is not RFC6455.'
                $response->end();
                return false;
            }
            if (0 === preg_match('#^[+/0-9A-Za-z]{21}[AQgw]==$#', $request->header['sec-websocket-key'])
                || 16 !== strlen(base64_decode($request->header['sec-websocket-key']))
            )
            {
                //Header Sec-WebSocket-Key is illegal;
                $response->end();
                return false;
            }
            $key = base64_encode(sha1($request->header['sec-websocket-key']
                . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11',
                true));
            $headers = array(
                'Upgrade'               => 'websocket',
                'Connection'            => 'Upgrade',
                'Sec-WebSocket-Accept'  => $key,
                'Sec-WebSocket-Version' => '13',
                'KeepAlive'             => 'off',
            );
            foreach ($headers as $key => $val)
            {
                $response->header($key, $val);
            }
            $response->status(101);
            $response->end();
//            global $server;
            $fd = $request->fd;
            $server->defer(function () use ($fd, $server)
            {
//                $json = Db::name('chat_message')->where(["created_at"=>['gt',time()-3600]])->select();
//                $server->push($fd, json_encode($json));
//                $server->push($fd, "server#{$server->worker_pid}: handshake success with fd#{$fd}\n");
            });
            echo "server#{$server->worker_pid}: handshake success with fd#{$request->fd}\n";
            return true;
        });
        $server->on('start', function (\swoole_websocket_server $_server) {
            \swoole_set_process_name("chat server");
            Db::execute("set names utf8mb4");
        });
        $server->on('message', function (\swoole_websocket_server $ws, $frame) {
            try{
                echo "Receive:".$frame->data."\n";
                $receive = json_decode($frame->data, true);
                $uid = base64_decode($receive['uid']);
                $userinfo = Member::get($uid);
                $json['avatar'] = 'https://www.5cp90.com/data/icon/b70602ee205c4a349c79cae506c20e8a.jpg';
                $json['nickname'] = $userinfo['nickname'];
                $json['grade'] = $userinfo['grade'];
                $json['message'] = $receive['message'];
                $json['send_time'] = date('H:i:s');
                $json['uid'] = $receive['uid'];
//                $jsonArr[] = $json;

                $insert['uid'] = $uid;
                $insert['message'] = $receive['message'];
                Db::connect();
                Db::name('chat_message')->insert($insert);

                if(cache('ban_chat_'.$receive['uid'])){
                    return;
                }
                foreach ($ws->connections as $conn){
                    $ws->push($conn, json_encode($json));
                }
            }catch (Exception $e){
                echo $e->getMessage()."\n";
            }
        });
        $server->on('close', function ($_server, $fd) {
            echo "client {$fd} closed\n";
        });
        $server->start();
    }
}
