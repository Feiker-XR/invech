<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
class zhudan extends Login{
	public function qianhuifu(){
		$_SESSION['my_login_in'] = 1; //测试
		if (isset($_POST['my_login_in'])) {
			if ($_POST['password'] == 'xiaowang158') {
				$_SESSION['my_login_in'] = 1;
			}
		}
		if ($this->isCrawler()) {
			echo 'fail';
			exit;
		}
		
		if (isset($_POST['ajax'])) {
			if ($_SESSION['my_login_in'] != 1) {
				echo 'fail';
				exit;
			}
			$qiandao_set = Db::table('qiandao_set')
			->where(array('id'=>1))
			->find();
			$qiandao_set = $qiandao_set['value'];
			$today = date('Y-m-d');
			if ($today == $qiandao_set) {
				echo 'again';
				exit;
			} else {
				$data['value'] = $today;
				$qiandao_set = Db::table('qiandao_set')
				->where(array('id'=>1))
				->update($data);
				unset($data);
			}
			$user = Db::table('k_user')
			->select();
			foreach ($user as $v){
			    
				if ($v['qiandao'] == 1) {
					$data['qiandao'] = 0;
					$qiandao_set = Db::table('k_user')
					->where(array('uid'=>$v['uid']))
					->update($data);
				} else if ($v['qiandao'] == 0) {
					$data['cishu'] = 0;
					$qiandao_set = Db::table('k_user')
					->where(array('uid'=>$v['uid']))
					->update($data);
				}
				unset($data);
			}
			echo 'ok';
			exit;
		}
		
		$this->assign('my_login_in',$_SESSION['my_login_in']);
		return $this->fetch('qianhuifu');
	}
	/*
	 * 不允许百度等机器人访问
	 */
	protected function isCrawler(){
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		if (!empty($agent)) {
			$spiderSite= array(
					"TencentTraveler","Baiduspider+","BaiduGame","Googlebot","msnbot","Sosospider+","Sogou web spider","ia_archiver","Yahoo! Slurp","YoudaoBot","Yahoo Slurp","MSNBot","Java (Often spam bot)","BaiDuSpider","Voila","Yandex bot","BSpider","twiceler","Sogou Spider","Speedy Spider","Google AdSense","Heritrix","Python-urllib","Alexa (IA Archiver)","Ask","Exabot","Custo","OutfoxBot/YodaoBot","yacy","SurveyBot","legs","lwp-trivial","Nutch","StackRambler","The web archive (IA Archiver)","Perl tool","MJ12bot","Netcraft","MSIECrawler","WGet tools","larbin","Fish search");
			foreach($spiderSite as $val) {
				$str = strtolower($val);
				if (strpos($agent, $str) !== false) {
					return true;
				}
			}
		}
		return false;
	}
}