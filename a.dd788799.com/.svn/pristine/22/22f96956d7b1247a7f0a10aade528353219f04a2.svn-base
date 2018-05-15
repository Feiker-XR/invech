<?php
namespace app\common\model;
use think\Model;
/**
 *   开奖数据表模型
 * @author mack
 */
class  News  extends Model
{
    protected $table = 'gygy_news';
    public static function  news_list(){
    	$query  = self::order('created_at desc');
        $query->where('status',0);
        $query->where('overdue_at','>',date('Y-m-d H:i:s'));
        return $query->paginate();
    }
}
