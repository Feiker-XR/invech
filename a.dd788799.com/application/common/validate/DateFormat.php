<?php
namespace app\common\validate;
use think\Validate;
class DateFormat extends Validate
{
    protected $rule = [
        'startTime'      => 'xxx',
        'endTime'      => 'xxx',
     ];

    protected $message = [
        'startTime.dateFormat'  => '日期格式错误',
        'endTime.dateFormat'  => '日期格式错误',
     ];

    protected $scene = [
        //日报表查询,日期要求是月
       'daily'  =>    ['startTime'=>'dateFormat:Y-m','endTime'=>'dateFormat:Y-m',],
       //月报表查询,日期要求是年,
       'month'  =>    ['startTime'=>'dateFormat:Y','endTime'=>'dateFormat:Y',],
     ];
}