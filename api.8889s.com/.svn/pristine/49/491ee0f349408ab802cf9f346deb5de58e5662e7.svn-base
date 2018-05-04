<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
class lunpanhuifu extends Login{
	public function clear(){
		$_SESSION['my_login_in'] = 1;
		if (isset($_POST['my_login_in'])) {
			if ($_POST['password'] == 'xiaowang158') {
				$_SESSION['my_login_in'] = 1;
			}
		}
		if (isset($_POST['ajax'])) {
			
			if ($_SESSION['my_login_in'] != 1) {
				echo 'fail';
				exit;
			}
			$qiandao_set = Db::table('qiandao_set')
			->where(array('id'=>2))
			->find();
			$value = $qiandao_set['value'];
			$today = date('Y-m-d');
			if ($today == $value) {
				echo 'again';
				exit;
			} else {
				$data['value'] = $today;
				$qiandao_set = Db::table('qiandao_set')
				->where(array('id'=>2))
				->update($data);
			}
			$qiandao_set = Db::table('k_user')
			->where('1=1')
			->update(array('lunpan'=>0,'lunpan_price'=>''));
			echo 'ok';
			exit;
		}
		$this->assign('my_login_in',$_SESSION['my_login_in']);
		return $this->fetch('clear');
	}
}