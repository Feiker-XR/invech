<?php
namespace app\index\controller;

use app\index\Login;

class notice extends Login
{

    public final function index()
    {
        $list = db('content')->where(array('enable' => 1))->order('id desc')->select();
        foreach ($list as $l)
            $list2[$l['id']] = $l;
        if (input('id'))
            $info = $list2[input('id')];
        else
            $info = $list[0];
        $this->assign('info', $info);
        $this->assign('data', $list);
        return $this->fetch();
    }
    
    public final function info(){
        $content = db('content')->where(array('enable'=>1, 'id'=>input('id')))->find();
        $content['content'] = nl2br($content['content']);
        $this->assign('info',$content);
        echo $this->fetch('info');
        exit;
    }
}
