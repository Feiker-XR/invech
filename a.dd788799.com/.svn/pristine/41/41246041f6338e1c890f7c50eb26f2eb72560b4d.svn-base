<?php

namespace app\admin\Controller;
use app\admin\Base;


/**
 * 后台首页控制器
 * @author root
 */
class Index extends Base{

    static protected $allow = array( 'verify');
    const UID = 1;

    /**
     * 后台首页
     * @author mack
     */
    public function index()
    {
       if (static::UID) {
           return $this->fetch();
        } else {
            $this->redirect('Adminlogin/login');
        }
    }


}
