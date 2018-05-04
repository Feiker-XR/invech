<?php
namespace app\v1\model;
use think\Model;

/**
 *  玩法模型
 * @author mack
 */
class Played extends Model {
	protected $table = 'gfwf_played';

	public function playedgroup()
	{
		return $this->belongsTo('PlayedGroup','groupId')->where('enable',1);
	}
    
}
