<?php
namespace app\behavior;

use Toplan\PhpSms\Sms as PhpSms;

class PhpSmsLog 
{

	public function run(&$dispatch)
	{		
        PhpSms::beforeSend(function ($task) {
  
            $data = $task->data ?: [];
            $to = is_array($data['to']) ? json_encode($data['to']) : $data['to'];
            $id = db('think_sms')->insertGetId([
                'to'         => $to ?: '',
                'temp_id'    => json_encode($data['templates']),
                'data'       => json_encode($data['data']),
                'content'    => $data['content'] ?: '',
                'voice_code' => $data['code'] ?: '',
                'created_at' => date('Y-m-d H:i:s', time()),
            ]);
            $data['_sms_id'] = $id;
            $task->data($data);
        });

        PhpSms::afterSend(function ($task, $result) {
 
            $microTime = $result['time']['finished_at'];
            $finishedAt = explode(' ', $microTime)[1];
            $data = $task->data;
            if (!isset($data['_sms_id'])) {
                return true;
            }

            db()->startTrans();
            $dbData = [];
            $dbData['updated_at'] = date('Y-m-d H:i:s', $finishedAt);
            $dbData['result_info'] = json_encode($result['logs']);
            if ($result['success']) {
                $dbData['sent_time'] = $finishedAt;
            } else {
                db('think_sms')->where('id', $data['_sms_id'])->setInc('fail_times');
                $dbData['last_fail_time'] = $finishedAt;
            }
            db('think_sms')->where('id', $data['_sms_id'])->update($dbData);
            db()->commit();
        });
	}

}
