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
            'name' => '会员管理',
            'group' => 'member',
            'sub_menu' => [
                [
                    'name'=>'会员列表',
                    'link'=>'/member/index',
                ],
                [
                    'name'=>'当月有效会员',
                    'link'=>'/member/avail',
                ],                
            ],
        
        ],
        /*
        [
            'name' => '佣金管理',
            'group' => 'commission',
            'sub_menu' => [
                [
                    'name'=>'佣金总计',
                    'link'=>'/commission/stat',
                ],
                [
                    'name'=>'会员佣金',
                    'link'=>'/commission/list',
                ],
            ],
        
        ],
        */
    ],
];
