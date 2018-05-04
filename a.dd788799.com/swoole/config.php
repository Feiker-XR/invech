<?php

// +----------------------------------------------------------------------
// | describe => 彩票开奖配置
// +----------------------------------------------------------------------
// | CreateDate => 2017年11月22日
// +----------------------------------------------------------------------
// | Author =>
// +----------------------------------------------------------------------

return [

    //采集配置信息
    'cp' => [
        [
            'title'  => '重庆时时彩',
            'source' => '内部接口',
            'name'   => 'cqssc',
            'enable' => true,
            'timer'  => 'cqssc',
            'type'   => 1,
            'option' => [
                'host'    => "http://data.8889s.com/index/apiplus/type/cqssc",
                'timeout' => 50000,
                'path'    => '/ssccq/',
                'headers' => [
                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                ],
            ]
        ],


        [
            'title'  => '北京PK10',
            'source' => '内部接口',
            'name'   => 'bjpk10',
            'enable' => true,
            'timer'  => 'bjpk10',
            'type'   => 20 ,
            'option' => [
                'host'    => "http://data.8889s.com/index/apiplus/type/bjpk10",
                'timeout' => 50000,
                'path'    => '/ssccq/',
                'headers' => [
                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                ],
            ]
        ],


//暂时没有该功能
       [
           'title'  => '重庆快乐十分',
           'source' => '内部接口',
           'name'   => 'cqklsf',
           'enable' => true,
           'timer'  => 'cqklsf',
           'type'  => '44',
           'option' => [
               'host'    => "http://data.8889s.com/index/apiplus/type/cqklsf",
               'timeout' => 50000,
               'path'    => '/ssccq/',
               'headers' => [
                   "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
               ],
           ]
       ],

        //暂时没有该功能
       [
           'title'  => '广东快乐十分',
           'source' => '内部接口',
           'name'   => 'gdklsf',
           'enable' => true,
           'timer'  => 'gdklsf',
           'type'   => 17,
           'option' => [
               'host'    => "http://data.8889s.com/index/apiplus/type/gdklsf",
               'timeout' => 50000,
               'path'    => '/ssccq/',
               'headers' => [
                   "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
               ],
           ]
       ],

//        [
//            'title'  => '广西快乐十分',
//            'source' => '内部接口',
//            'name'   => 'gxklsf',
//            'enable' => true,
//            'timer'  => 'gxklsf',
//            'option' => [
//                'host'    => "http://data.8889s.com/index/apiplus/type/gxklsf",
//                'timeout' => 50000,
//                'path'    => '/ssccq/',
//                'headers' => [
//                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
//                ],
//            ]
//        ],

//        [
//            'title'  => '江苏快三',
//            'source' => '内部接口',
//            'name'   => 'jsk3',
//            'enable' => true,
//            'timer'  => 'jsk3',
//            'type'   => 25,
//            'option' => [
//                'host'    => "http://data.8889s.com/index/apiplus/type/jsk3",
//                'timeout' => 50000,
//                'path'    => '/ssccq/',
//                'headers' => [
//                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
//                ],
//            ]
//        ],

//        [
//            'title'  => '幸运飞艇',
//            'source' => '内部接口',
//            'name'   => 'mlaft',
//            'enable' => true,
//            'timer'  => 'mlaft',
//            'option' => [
//                'host'    => "http://data.8889s.com/index/apiplus/type/mlaft",
//                'timeout' => 50000,
//                'path'    => '/ssccq/',
//                'headers' => [
//                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
//                ],
//            ]
//        ],

//        [
//            'title'  => '山东11选5',
//            'source' => '内部接口',
//            'name'   => 'sdllx5',
//            'enable' => true,
//            'timer'  => 'sdllx5',
//            'option' => [
//                'host'    => "http://data.8889s.com/index/apiplus/type/sdllx5",
//                'timeout' => 50000,
//                'path'    => '/ssccq/',
//                'headers' => [
//                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
//                ],
//            ]
//        ],


        [
            'title'  => '新疆时时彩',
            'source' => '内部接口',
            'name'   => 'xjssc',
            'enable' => true,
            'timer'  => 'xjssc',
            'type'   => 12,
            'option' => [
                'host'    => "http://data.8889s.com/index/apiplus/type/xjssc",
                'timeout' => 50000,
                'path'    => '/ssccq/',
                'headers' => [
                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                ],
            ]
        ],


        [
            'title'  => '乐购5分彩',
            'source' => '内部接口',
            'name'   => 'lg5fc',
            'enable' => true,
            'timer'  => 'lg5fc',
            'type'   => 14,
            'option' => [
                'host'    => "http://aht.dd788799.com/index.php/lottery/lg5fc",
                'timeout' => 50000,
                'headers' => [
                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                ],
            ]
        ],


        [
            'title'  => '乐购二分彩',
            'source' => '内部接口',
            'name'   => 'lg2fc',
            'enable' => true,
            'timer'  => 'lg2fc',
            'type'   => 34,
            'option' => [
                'host'    => "http://aht.dd788799.com/index.php/lottery/lg2fc",
                'timeout' => 50000,
                'headers' => [
                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                ],
            ]
        ],


        [
            'title'  => '乐购分分彩',
            'source' => '内部接口',
            'name'   => 'lg1fc',
            'enable' => true,
            'timer'  => 'lg1fc',
            'type'   => 41,
            'option' => [
                'host'    => "http://aht.dd788799.com/index.php/lottery/lg1fc",
                'timeout' => 50000,
                'headers' => [
                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                ],
            ]
        ],


        [
            'title'  => '韩国1_5分彩',
            'source' => '内部接口',
            'name'   => 'hg1_5fc',
            'enable' => true,
            'timer'  => 'hg1_5fc',
            'type'   => 35,
            'option' => [
                'host'    => "http://aht.dd788799.com/index.php/lottery/hg1_5fc",
                'timeout' => 50000,
                'headers' => [
                    "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                ],
            ]
        ],
        /*
              [
                  'title'  => '北京快乐8',
                  'source' => '内部接口',
                  'name'   => 'bjkl8',
                  'enable' => true,
                  'timer'  => 'bjkl8',
                  'type'   => 24,
                  'option' => [
                      'host'    => "http://r.apiplus.net/newly.do?token=88e0848e2ef538a4d2d20d7c84d1aa58&code=bjkl8&rows=5&format=json",
                      'timeout' => 50000,
                      'headers' => [
                          "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                      ],
                  ]
              ],

               [
                    'title'  => '福彩3D',
                    'source' => '内部接口',
                    'name'   => 'fc3d',
                    'enable' => true,
                    'timer'  => 'fc3d',
                    'type'   => 9,
                    'option' => [
                        'host'    => "http://r.apiplus.net/newly.do?token=7eaea11fb8cc0f60f4a4455511b12e44&code=fc3d&rows=5&format=json",
                        'timeout' => 50000,
                        'headers' => [
                            "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                        ],
                    ]
                 ],

                 [
                     'title'  => '排列3',
                     'source' => '内部接口',
                     'name'   => 'pl3',
                     'enable' => true,
                     'timer'  => 'pl3',
                     'type'   => 10,
                     'option' => [
                         'host'    => "http://r.apiplus.net/newly.do?token=33fd23a649792f201b7bd2d8f7b9d1a5&code=pl3&rows=5&format=json",
                         'timeout' => 50000,
                         'headers' => [
                             "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                         ],
                     ]
                 ],

                [
                     'title'  => '广东11选5',
                     'source' => '内部接口',
                     'name'   => 'gd11x5',
                     'enable' => true,
                     'timer'  => 'gd11x5',
                     'type'   => 6,
                     'option' => [
                         'host'    => "http://r.apiplus.net/newly.do?token=7342468c17ddb2dff8fdd700bcd4cfb9&code=gd11x5&rows=5&format=json",
                         'timeout' => 50000,
                         'headers' => [
                             "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                         ],
                     ]
                ],

                [
                     'title'  => '江西11选5',
                     'source' => '内部接口',
                     'name'   => 'jx11x5',
                     'enable' => true,
                     'timer'  => 'jx11x5',
                     'type'   => 16,
                     'option' => [
                         'host'    => "http://r.apiplus.net/newly.do?token=e71b76e0a240967ff8fdd700bcd4cfb9&code=jx11x5&rows=5&format=json",
                         'timeout' => 50000,
                         'headers' => [
                             "User-Agent"=> "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)",
                         ],
                     ]
                 ],

          */


    ],


    //数据库配置信息
    'dbinfo' => [
        'host' => '47.52.1.158',
        //'user' => 'alafei',
        //'password' => 'L3WjNSxtSE',
        'user' => 'leon',
        'password' => 'zesFy86PeIomg7rl',        
        'database' => 'alafei',
    ],

    // 出错时等待 15
    'errorSleepTime' =>15,

    // 重启时间间隔，单位：秒
    'restartTime' => [
        0 => 60, //采集互联网进程半小时重启一次
        1 => 60, //采集本机进程1分钟重启一次
    ],

    'submit' => [
        'host' => 'alafeiht.ynfc8.com',
        'path' => '/wjadmin.php/dataSource/kj'
    ],
] ;

