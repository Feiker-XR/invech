<?php

class lib_user {
	
	public $pagesize;
	private $db;
	
	public function __construct() {
		$this->db = core::lib('db');
	}

	public function bet_list($uid, $show_time = true) {
		// 获取投注记录
		$keys =  array('期号', '投注内容', '投注金额', '开奖内容', '收益');
		if ($show_time) array_push($keys, '投注时间');
		$total = $this->db->query("SELECT COUNT(1) AS `num` FROM `game_bet` WHERE `uid`=$uid", 2);
		$total = intval($total['num']);
		$vals = array();
		if ($total > 0) {
			$page = array_key_exists('page', $_GET) ? intval($_GET['page']) : 1;
			$skip = ($page - 1) * $this->pagesize;
			$limit = $this->pagesize;
			$rows = $this->db->query("SELECT b.*,d.val FROM `game_bet` b LEFT JOIN `game_data` d ON d.id=b.id WHERE b.uid=$uid ORDER BY b.bet_time DESC LIMIT $skip,$limit", 3);
			if ($rows) {
				$ts = array('A' => '黑桃', 'B' => '红心', 'C' => '草花', 'D' => '方块', 'E' => '王');
				$ds = array(
					'A2' => '黑桃2', 'A3' => '黑桃3', 'A4' => '黑桃4', 'A5' => '黑桃5', 'A6' => '黑桃6', 'A7' => '黑桃7', 'A8' => '黑桃8', 'A9' => '黑桃9', 'A10' => '黑桃10', 'AJ' => '黑桃J', 'AQ' => '黑桃Q', 'AK' => '黑桃K', 'AA' => '黑桃A',
					'B2' => '红心2', 'B3' => '红心3', 'B4' => '红心4', 'B5' => '红心5', 'B6' => '红心6', 'B7' => '红心7', 'B8' => '红心8', 'B9' => '红心9', 'B10' => '红心10', 'BJ' => '红心J', 'BQ' => '红心Q', 'BK' => '红心K', 'BA' => '红心A',
					'C2' => '草花2', 'C3' => '草花3', 'C4' => '草花4', 'C5' => '草花5', 'C6' => '草花6', 'C7' => '草花7', 'C8' => '草花8', 'C9' => '草花9', 'C10' => '草花10', 'CJ' => '草花J', 'CQ' => '草花Q', 'CK' => '草花K', 'CA' => '草花A',
					'D2' => '方块2', 'D3' => '方块3', 'D4' => '方块4', 'D5' => '方块5', 'D6' => '方块6', 'D7' => '方块7', 'D8' => '方块8', 'D9' => '方块9', 'D10' => '方块10', 'DJ' => '方块J', 'DQ' => '方块Q', 'DK' => '方块K', 'DA' => '方块A',
					'E1' => '小王', 'E2' => '大王', 
				);
				foreach ($rows as $row) {
					$v = array();
					$round = intval(ceil($row['id'] / 90));
					$times = intval($row['id'] % 90);
					$type = $ts[$row['bet_type']];
					$amount = intval($row['bet_amount']);
					$gd = empty($row['val']) ? '<span class="gray">未开奖</span>' : $ds[$row['val']];
					if ($row['profit'] > 0) {
						$profit = '<span class="red">'.$row['profit'].'</span>';
					} else if ($row['profit'] < 0) {
						$profit = '<span class="green">'.$row['profit'].'</span>';
					} else {
						$profit = '<span class="gray">'.$row['profit'].'</span>';
					}
					array_push($v, '第'.$round.'轮'.$times.'局', $type, $amount, $gd, $profit);
					if ($show_time) array_push($v, date('Y-m-d H:i:s', $row['bet_time']));
					array_push($vals, $v);
				}
			}
		}
		return array(
			'total' => $total,
			'table' => array('keys' => $keys, 'vals' => $vals),
		);
	}
	
	public function cash_list($uid, $show_bank = true) {
		// 获取投注记录
		$keys = array('编号', '金额', '状态', '申请时间', '处理时间', '备注');
		if ($show_bank) array_push($keys, '收款信息');
		$total = $this->db->query("SELECT COUNT(1) AS `num` FROM `user_cash` WHERE `uid`=$uid", 2);
		$total = intval($total['num']);
		$vals = array();
		if ($total > 0) {
			$page = array_key_exists('page', $_GET) ? intval($_GET['page']) : 1;
			$skip = ($page - 1) * $this->pagesize;
			$limit = $this->pagesize;
			$rows = $this->db->query("SELECT * FROM `user_cash` WHERE `uid`=$uid ORDER BY `time_start` DESC LIMIT $skip,$limit", 3);
			if ($rows) {
				$ss = array('等待处理', '提现成功', '提现失败');
				foreach ($rows as $row) {
					$v = array();
					$cid = intval($row['cid']);
					$amount = intval($row['amount']);
					$status = $ss[$row['status']];
					$time_start = date('Y-m-d H:i:s', $row['time_start']);
					$time_end = $row['time_end'] ? date('Y-m-d H:i:s', $row['time_end']) : '未处理';
					array_push($v, $cid, $amount, $status, $time_start, $time_end, $row['remark']);
					if ($show_bank) array_push($v, $row['bank_account'].'('.$row['bank_name'].')');
					array_push($vals, $v);
				}
			}
		}
		
		return array(
			'total' => $total,
			'table' => array('keys' => $keys, 'vals' => $vals),
		);
	}
	
	public function recharge_list($uid) {
		// 获取投注记录
		$keys = array('订单号', '金额', '状态', '充值时间', '备注');
		$total = $this->db->query("SELECT COUNT(1) AS `num` FROM `user_recharge` WHERE `uid`=$uid", 2);
		$total = intval($total['num']);
		$vals = array();
		if ($total > 0) {
			$page = array_key_exists('page', $_GET) ? intval($_GET['page']) : 1;
			$skip = ($page - 1) * $this->pagesize;
			$limit = $this->pagesize;
			$rows = $this->db->query("SELECT * FROM `user_recharge` WHERE `uid`=$uid ORDER BY `rid` DESC LIMIT $skip,$limit", 3);
			if ($rows) {
				$ss = array('充值中', '充值成功', '充值失败');
				foreach ($rows as $row) {
					$v = array();
					$rid = intval($row['rid']);
					$amount = intval($row['amount']);
					$status = $ss[$row['status']];
					$time = date('Y-m-d H:i:s', $row['time']);
					array_push($v, $rid, $amount, $status, $time, $row['remark']);
					array_push($vals, $v);
				}
			}
		}
		return array(
			'total' => $total,
			'table' => array('keys' => $keys, 'vals' => $vals),
		);
	}

}