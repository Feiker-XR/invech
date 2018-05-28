<?php
namespace app\common\model;

use app\common\traits\model\Extra as ExtraTrait;

class CompanySet extends Base{

    use ExtraTrait;

    //protected static $extra = 'params';
    //extra 是 银行字段组 或 qrcode字段;
    protected $table = 'gygy_company_set';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';
    protected static $extra = 'extra';
    CONST TYPE_BANK = 1;
    CONST TYPE_ALIPAY = 2;
    CONST TYPE_WECHAT = 3;
    CONST TYPE_ARRAY = [self::TYPE_BANK,self::TYPE_ALIPAY,self::TYPE_WECHAT,];
    public static function getList($request){
        $params =   $request->param();
        $query = self::order('id desc');
        return $query->paginate();
    } 
    CONST NAME_ARRAY = [
        self::TYPE_BANK => '银行转账',
        self::TYPE_ALIPAY => '支付宝转账',
        self::TYPE_WECHAT => '微信转账',
    ];
}
