<?php
namespace app\v2\controller;
use app\v2\Base;
use think\Db;
use think\Session;
use think\Cache;
class Show extends Base
{
	public function index($type='ft_danshi')
	{
		return $this->fetch($type);
	}
	

	
}