<?php
namespace app\common\model;
use think\Model;

class Bank extends Base{

    //用户银行,公司入款银行,
    //用户银行只支持一个取款银行;
    //银行信息 可以 分多个字段存储 在members表;
    //这里使用bank字段(json)存储一个银行对象(可扩展为多个银行对象数组)
    //取消银行列表gygy_bank_list,使用数组取代

    /*
    protected $table = 'gygy_bank_list';
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $autoWriteTimestamp = 'datetime';
    */

    CONST BANK_CODE_ICBC = 'ICBC';
    CONST BANK_CODE_ABC = 'ABC';
    CONST BANK_CODE_CCB = 'CCB';
    CONST BANK_CODE_BOCO = 'BOCO';
    CONST BANK_CODE_CIB = 'CIB';
    CONST BANK_CODE_SDB = 'SDB';
    CONST BANK_CODE_CMBC = 'CMBC';
    CONST BANK_CODE_CITIC = 'CITIC';
    CONST BANK_CODE_CEB = 'CEB';
    CONST BANK_CODE_BCCB = 'BCCB';
    CONST BANK_CODE_CMB = 'CMB';
    CONST BANK_CODE_PSBC = 'PSBC';
    CONST BANK_CODE_GDB = 'GDB';
    CONST BANK_CODE_SPDB = 'SPDB';
    CONST BANK_CODE_BOC = 'BOC';
    CONST BANK_CODE_HXB = 'HXB';
    CONST BANK_CODE_PAB = 'PAB';

    CONST BANK_ARRAY = [
        self::BANK_CODE_ICBC => '工商银行',
        self::BANK_CODE_ABC => '农业银行',
        self::BANK_CODE_CCB => '建设银行',
        self::BANK_CODE_BOCO => '交通银行',
        self::BANK_CODE_CIB => '兴业银行',
        self::BANK_CODE_SDB => '深圳发展银行',
        self::BANK_CODE_CMBC => '民生银行',
        self::BANK_CODE_CITIC => '中信银行',
        self::BANK_CODE_CEB => '光大银行',
        self::BANK_CODE_BCCB => '北京银行',
        self::BANK_CODE_CMB => '招商银行',
        self::BANK_CODE_PSBC => '邮政储蓄银行',
        self::BANK_CODE_GDB => '广发银行',
        self::BANK_CODE_SPDB => '浦发银行',
        self::BANK_CODE_BOC => '中国银行',
        self::BANK_CODE_HXB => '华夏银行',
        self::BANK_CODE_PAB => '平安银行',
    ];

}
