<?php 
namespace app\api\controller;

use think\exception\HttpException;

use app\api\Base;

use app\common\model\LotteryData;

class Lottery extends Base {
    
    public function _empty($name)
    {        
        throw new HttpException(404, '404 Not Found');
    }
    
    public function lg5fc()
    {
        $data = LotteryData::getDataForApi('lg5fc');
        return json($data);
    }

    public function lg2fc()
    {
        $data = LotteryData::getDataForApi('lg2fc');
        return json($data);
    }

    public function lg1fc()
    {
        $data = LotteryData::getDataForApi('lg1fc');
        return json($data); 
    }

}

