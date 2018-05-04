<?php
namespace app\agent\controller;
use app\agent\Login;
use think\Cache;
use app\common\model\DailyReport;
class Report extends Login{

	public function  bet(){
		$param = $this->request;
		$report = new DailyReport();
		$list = $report::getList($param);
		
		$this->assign('param',$param);
		$this->assign('list',$list);
		$this->view->page_header = '日投注列表';
      	return $this->fetch();
		
	}

}
 