<?php
namespace app\common\validate;
use think\Validate;
class Pay extends Validate
{
    protected $rule = [
        'name'         => 'require',
        'type'         => 'require',
        'pid'          => 'require',
        'pkey'         => 'require',
        'set_id'       => 'require',
        'code'         => 'require',
        'way_id'       => 'require', 
        'third_id'     => 'require', 
        'min'          => 'require|number',
        'max'          => 'require|number', 
    ];
    protected $message = [
        'name.require'              => '请输入名称',
        'type.require'              => '请输入类型',
        'pid.require'               => '请输入商户ID',
        'pkey.require'              => '请输入商户秘钥',
        'set_id.require'            => '请选择支付类别',
        'code.require'              => '请输入渠道代码',
        'way_id.require'            => '请选择支付方式',
        'third_id.require'          => '请选择第三方',
        'min.require'               => '请输入最低充值金额',
        'min.number'                => '请输入数字',
        'max.require'               => '请输入最高充值金额',
        'max.number'                => '请输入数字',
    ];
    protected $scene = [
        'set'       =>    ['name','type'],
        'way'       =>    ['name','set_id','code'],
        'third'     =>    ['name','type','pid','pkey'],
        'channel'   =>    ['set_id','way_id','third_id','code','min','max'],
    ];
}