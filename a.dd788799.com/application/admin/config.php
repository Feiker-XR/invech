<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    'menu_list' => [
        
        [
            'name' => '权限管理',
            'group' => 'admin',
            'sub_menu' => [
                [
                    'name'=>'管理员列表',
                    'link'=>'/admin/index',
                ],
                [
                    'name'=>'角色列表',
                    'link'=>'/admin/group',
                ],  
                [
                    'name'=>'权限列表',
                    'link'=>'/admin/rule',
                ],                                
            ],        
        ],

        [
            'name' => '会员管理',
            'group' => 'member',
            'sub_menu' => [
                [
                    'name'=>'会员列表',
                    'link'=>'/member/index',
                ],  
                [
                    'name'=>'会员等级',
                    'link'=>'/member/member_level',
                ],  
                                          
            ],        
        ],

        [
            'name' => '代理管理',
            'group' => 'agent',
            'sub_menu' => [
                [
                    'name'=>'代理列表',
                    'link'=>'/agent/index',
                ],  
                [
                    'name'=>'代理佣金',
                    'link'=>'/agent/money',
                ],  
                                          
            ],        
        ],

        [
            'name' => '彩种管理',
            'group' => 'lottery',
            'sub_menu' => [
                [
                    'name'=>'彩种列表',
                    'link'=>'/lottery/index',
                ],
                [
                    'name'=>'玩法分组',
                    'link'=>'/lottery/playedGroup',
                ],
                [
                    'name'=>'玩法列表',
                    'link'=>'/lottery/played',
                ],
                [
                    'name'=>'赔率分组',
                    'link'=>'/lottery/plgroup',
                ],
                [
                    'name'=>'赔率列表',
                    'link'=>'/lottery/pl',
                ],
                [
                    'name'=>'开奖时间表',
                    'link'=>'/lottery/time/type/1',
                ],
                [
                    'name'=>'开奖结果',
                    'link'=>'/lottery/data',
                ],
            ],        
        ],

        [
            'name' => '支付管理',
            'group' => 'pay',
            'sub_menu' => [
                [
                    'name'=>'支付类别',
                     'link'=>'/pay/set.html', 
                    
                ],
                [
                    'name'=>'支付方式',
                    'link'=>'/pay/way.html',
                ],
                [
                    'name'=>'第三方支付',
                    'link'=>'/pay/third.html',
                ],
                [
                    'name'=>'支付渠道',
                   'link'=>'/pay/channel.html',
                ],                                  
            ],
        
        ],

        [
            'name' => '提案管理',
            'group' => 'apply',
            'sub_menu' => [
                [
                    'name'=>'提案列表',
                    'link'=>'/apply/index',
                ],        
            ],        
        ],

        [
            'name' => '红利管理',
            'group' => 'bonus',
            'sub_menu' => [
                [
                    'name'=>'红利列表',
                    'link'=>'/bonus/index',
                ],
                [
                    'name'=>'红利配置',
                    'link'=>'/bonus/config',
                ],
            ],        
        ],      

        [
            'name' => '资金管理',
            'group' => 'money',
            'sub_menu' => [
                [
                    'name'=>'资金变更',
                    'link'=>'/money/index',
                ],
                [
                    'name'=>'充值记录',
                    'link'=>'/order/index',
                ],
                [
                    'name'=>'提现记录',
                    'link'=>'/withdraw/index',
                ],   
                [
                    'name'=>'投注记录',
                    'link'=>'/bet/index',
                ],      
                [
                    'name'=>'返水记录',
                    'link'=>'/backwater/index',
                ],  
                [
                    'name'=>'分佣记录',
                    'link'=>'/commission/index',
                ],
                [
                    'name'=>'红利记录',
                    'link'=>'/bonus/flow',
                ],                                                         
            ],        
        ],

        [
            'name' => '报表管理',
            'group' => 'report',
            'sub_menu' => [
                [
                    'name'=>'日投注报表',
                    'link'=>'/report/bet',
                ],
                [
                    'name'=>'月收支报表',
                    'link'=>'/report/money',
                ],                
            ],        
        ],

        [
            'name' => '站内信',
            'group' => 'message',
            'sub_menu' => [
                [
                    'name'=>'发件箱',
                    'link'=>'/message/outbox',
                ],
                [
                    'name'=>'收件箱',
                    'link'=>'/message/inbox',
                ],                          
            ],        
        ],    
	
        [
            'name' => '系统管理',
            'group' => 'system',
            'sub_menu' => [
                [
                    'name'=>'基本配置',
                    'link'=>'/system/config',
                ],
                [
                    'name'=>'轮播图',
                    'link'=>'/slide/index',
                ],                
                [
                    'name'=>'网站公告',
                    'link'=>'/system/notice',
                ],  
                [
                    'name'=>'操作日志',
                    'link'=>'/help/action_log',
                ],      
				[
                    'name'=>'帮助中心',
                    'link'=>'/help/index',
                ], 				
            ],        
        ],
		[
            'name' => 'api管理',
            'group' => 'api',
            'sub_menu' => [
                [
                    'name'=>'api列表',
                    'link'=>'/api/index',
                ],
                [
                    'name'=>'api分组',
                    'link'=>'/api/group',
                ],                
            ],        
        ],
        [
            'name' => '备份中心',
            'group' => 'backup',
            'sub_menu' => [     
                [
                    'name'=>'恢复区',
                    'link'=>'/backup/index',
                ],                               
                [
                    'name'=>'充值记录',
                    'link'=>'/backup/recharge',
                ],                
                [
                    'name'=>'资金记录',
                    'link'=>'/backup/money',
                ],                  
                [
                    'name'=>'投注记录',
                    'link'=>'/backup/bet',
                ],   
                [
                    'name'=>'返水记录',
                    'link'=>'/backup/backwater',
                ],   
                [
                    'name'=>'佣金记录',
                    'link'=>'/backup/commission',
                ],   
                [
                    'name'=>'红利记录',
                    'link'=>'/backup/bonus',
                ],                   
                [
                    'name'=>'开奖记录',
                    'link'=>'/backup/data',
                ],
                [
                    'name'=>'提案审核',
                    'link'=>'/backup/apply',
                ],                       
                [
                    'name'=>'行为日志',
                    'link'=>'/backup/action',
                ],         
                /*定时清理就可以了
                [
                    'name'=>'站内信',
                    'link'=>'/backup/message',
                ],
                */      
            ],        
        ],


    
    ],
];
