<?php

namespace bong\service\broadcast;
//use app\admin\Base;
use think\Controller as Base;

//demo 一般是前台网站 做 广播订阅
class BroadcastController extends Base
{
    //broadcasting/auth?channel_name=private-user.order.1&socket_id=6277.373732
    public function auth()
    {
        $user = $this->request->user();
        if(!$user){
            return false;
        }
        $this->request->uid = $user->id;

        return container('broadcast')->auth($this->request);
        //返回数组,要求请求是ajax方式
    }
}
