<?php 
	//配置文件加载次序 extra/xxx 优先于 common.php
	//container定义在common中
	//如果channels.php放在extra目录下,container则未定义;

    //用户资金记录广播
    container('broadcast')->channel('user.money.{id}', function ($uid, $id) {
        return (int) $uid === (int) dehashid($id);
    });

    //用户投注记录广播
    container('broadcast')->channel('user.bet.{id}', function ($uid, $id) {
        return (int) $uid === (int) dehashid($id);
    });

    //用户红利广播
    container('broadcast')->channel('user.bonus.{id}', function ($uid, $id) {
        return (int) $uid === (int) dehashid($id);
    });

    //订单广播 可能存在问题, 支付完成是第三方通知过来的,没有user凭证
    container('broadcast')->channel('user.order.{id}', function ($uid, $id) {
        return (int) $uid === (int) dehashid($id);
    });

