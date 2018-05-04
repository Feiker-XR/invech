<?php

class mod_gate extends mod {

	public function _init() {
		if (array_key_exists('data', $_POST)) {
			parse_str($_POST['data'], $params);
			if (array_key_exists('method', $params)) {
				call_user_func_array(array($this, $params['method']), array($params));
			}
		}
	}
	
	private function login($params) {
		$Retcode = 1;
		$Retdesc = 'ERROR_LOGIN';
		$Userid = 'newbee-0';
		$Sessid = '';
		if (array_key_exists('username', $params) && array_key_exists('s', $params)) {
			$username = $params['username'];
			$sql = "SELECT `uid`,`password` FROM `gygy_members` WHERE `username`='$username' LIMIT 1";
			$user = $this->db->query($sql, 2);
			if ($user && md5($user['password']) === $params['s']) {
				$Retcode = 0;
				$Retdesc = 'SUCCESS';
				$Userid = 'newbee-'.$user['uid'];
				$Sessid = session_id();
				$now = time();
				$sql = "REPLACE INTO `nitalk_session` (`uid`,`sessid`,`active`) VALUES ({$user['uid']},'{$Sessid}',{$now})";
				$this->db->query($sql, 0);
			}
		}
		$result = array(
			'Retcode' => $Retcode,
			'Retdesc' => $Retdesc,
			'Userid' => $Userid,
			'Sessid' => $Sessid,
			'Promocode' => 'QJ1SQF',
			'Token' => '',
			'Agentlevel' => 1,
			'Filenodes' => array(),
			'HttpsFileNodes' => array(),
			'Gatenodes' => array($this->node),
			'HttpsGateNodes' => array(),
		);
		$this->output($result);
	}
	
	private function getgroups($params, $checkstatus = false) {
		$parent_users = $child_users = array();
		if (array_key_exists('userid', $params) && array_key_exists('sessid', $params) && $params['sessid'] == session_id()) {
			$uid = intval(substr($params['userid'], 7));
			if ($checkstatus) {
				$sdata['sessid'] = $params['sessid'];
			} else {
				$sql = "SELECT * FROM `nitalk_session` WHERE `uid`=$uid LIMIT 1";
				$sdata = $this->db->query($sql, 2);
			}
			if ($sdata && $params['sessid'] == $sdata['sessid']) {
				// 获取上级
				$parent_id = $this->db->query("SELECT `parentId` FROM `gygy_members` WHERE `uid`=$uid LIMIT 1", 2);
				if ($parent_id['parentId']) {
					array_push($parent_users, array(
						'Userid' => 'newbee-'.$parent_id['parentId'],
						'Username' => '上级',
						'Stat' => $this->get_user_stat($parent_id['parentId']),
					));
				}
				// 获取下级
				$sql = "SELECT m.uid,m.username,s.active FROM `gygy_members` m LEFT JOIN `nitalk_session` s ON s.uid=m.uid WHERE m.parentId=$uid AND m.isDelete=0";
				$childs = $this->db->query($sql, 3);
				if ($childs) {
					foreach ($childs as $child) {
						array_push($child_users, array(
							'Userid' => 'newbee-'.$child['uid'],
							'Username' => $child['username'],
							'Stat' => intval($child['active']) > time() - 3 ? 'online' : 'offline',
						));
					}
				}
			}
		}
		$result = array(
			'Groups' => array(
				array(
					'Groupid' => 2,
					'Groupname' => '上级',
					'Grouptype' => 'supergroup',
					'Users' => $parent_users,
				),
				array(
					'Groupid' => 3,
					'Groupname' => '下级',
					'Grouptype' => 'lowergroup',
					'Users' => $child_users,
				),
			),
			'kfstatus' => $this->get_user_stat(KFID),
			'Crowds' => null,
		);
		if ($checkstatus) {
			return $result;
		} else {
			$this->output($result);
		}
	}
	
	private function checkstat($params) {
		$result = array();
		if (array_key_exists('userid', $params) && array_key_exists('sessid', $params) && $params['sessid'] == session_id()) {
			$uid = intval(substr($params['userid'], 7));
			$sql = "SELECT * FROM `nitalk_session` WHERE `uid`=$uid LIMIT 1";
			$sdata = $this->db->query($sql, 2);
			if ($sdata && $params['sessid'] == $sdata['sessid']) {
				$now = time();
				$this->db->query("UPDATE `nitalk_session` SET `active`=$now WHERE `uid`=$uid LIMIT 1", 0);
				// 获取用户是否收到新信息
				$mdata = $this->db->query("SELECT * FROM `nitalk_chat` WHERE `touid`=$uid AND `status`=0", 3);
				if ($mdata) {
					$ms = array();
					$cids = '(';
					foreach ($mdata as $val) {
						$cids .= $val['cid'].',';
						array_push($ms, array(
							'Chattype' => $val['type'] == 1 ? 'cs2u' : 'u2u',
							'Msgtype' => 'txt',
							'Userid' => 'newbee-'.$val['fromuid'],
							'Username' => $val['fromusername'],
							'Msg' => base64_decode($val['msg']),
						));
					}
					$cids = substr($cids, 0, -1).')';
					$this->db->query("UPDATE `nitalk_chat` SET `status`=1 WHERE `cid` IN $cids", 0);
					$result = array(
						'Recvtype' => 'recvmsg',
						'ms' => $ms,
					);
					$result = array_merge($result, $this->getgroups($params, true));
				}
			} else {
				$result = array(
					'Recvtype' => 'recvforceoffline',
					'Reasontype' => '01',
				);
			}
		} else {
			$result = array(
				'Recvtype' => 'recvforceoffline',
				'Reasontype' => '00',
			);
		}
		$this->output($result);
	}
	
	private function sendmsg($params) {
		if (
			array_key_exists('chattype', $params) &&
			array_key_exists('touid', $params) &&
			array_key_exists('userid', $params) &&
			array_key_exists('username', $params) &&
			array_key_exists('sessid', $params) &&
			$params['sessid'] == session_id() &&
			array_key_exists('msg', $params)
		) {
			$type = 0;
			$touid = $params['chattype'] == 'u2u' ? intval(substr($params['touid'], 7)) : KFID;
			$uid = intval(substr($params['userid'], 7));
			if ($uid == KFID) $type = 1;
			$username = strval($params['username']);
			$sessid = strval($params['sessid']);
			$msg = base64_encode($params['msg']);
			$sql = "SELECT * FROM `nitalk_session` WHERE `uid`=$uid LIMIT 1";
			$sdata = $this->db->query($sql, 2);
			if ($sdata && $params['sessid'] == $sdata['sessid']) {
				if ($params['chattype'] == 'lowlevel') {
					if ($uid == KFID) {
						$childs = $this->db->query("SELECT `uid` FROM `gygy_members`", 3);
					} else {
						$childs = $this->db->query("SELECT `uid` FROM `gygy_members` WHERE `parentId`=$uid", 3);
					}
					$sql = "INSERT INTO `nitalk_chat` (`key`,`fromuid`,`fromusername`,`touid`,`type`,`sendtime`,`sendday`,`msg`) VALUES ";
					if ($childs) {
						$now = time();
						$date = date('Ymd');
						$has_data = false;
						foreach ($childs as $child) {
							$touid = $child['uid'];
							if ($touid == KFID) continue;
							$key = array($uid,$touid);
							sort($key);
							$key = implode('-', $key);
							$sql .= "('$key',$uid,'$username',$touid,$type,$now,'$date','$msg'),";
							$has_data = true;
						}
						if ($has_data) {
							$sql = substr($sql, 0, -1);
							$this->db->query($sql, 0);
						}
					}
				} else {
					$key = array($uid,$touid);
					sort($key);
					$key = implode('-', $key);
					$now = time();
					$date = date('Ymd');
					$sql = "INSERT INTO `nitalk_chat` (`key`,`fromuid`,`fromusername`,`touid`,`type`,`sendtime`,`sendday`,`msg`) VALUES ('$key',$uid,'$username',$touid,$type,$now,'$date','$msg')";
					$this->db->query($sql, 1);
				}
			}
		}
	}
	
	private function chatrecsdate($params) {
		$Dates = array();
		if (
			array_key_exists('userid', $params) &&
			array_key_exists('touid', $params) &&
			array_key_exists('sessid', $params)
		) {
			$uid = intval(substr($params['userid'], 7));
			$touid = $params['touid'] == 'cs' ? KFID : intval(substr($params['touid'], 7));
			$sql = "SELECT * FROM `nitalk_session` WHERE `uid`=$uid LIMIT 1";
			$sdata = $this->db->query($sql, 2);
			if ($sdata && $params['sessid'] == $sdata['sessid']) {
				$key = array($uid,$touid);
				sort($key);
				$key = implode('-', $key);
				$rows = $this->db->query("SELECT DISTINCT `sendday` FROM `nitalk_chat` WHERE `key`='$key' ORDER BY `sendday` ASC", 3);
				foreach ($rows as $row) array_push($Dates, $row['sendday']);
			}
		}
		$result = array(
			'Retcode' => 0,
			'Retdesc' => 'SUCCESS',
			'Datenum' => count($Dates),
			'Dates' => $Dates,
		);
		$this->output($result);
	}
	
	private function chatrecs($params) {
		$Recs = array();
		if (
			array_key_exists('userid', $params) &&
			array_key_exists('touid', $params) &&
			array_key_exists('date', $params) &&
			array_key_exists('sessid', $params)
		) {
			$uid = intval(substr($params['userid'], 7));
			$touid = $params['touid'] == 'cs' ? KFID : intval(substr($params['touid'], 7));
			$date = strval($params['date']);
			$sql = "SELECT * FROM `nitalk_session` WHERE `uid`=$uid LIMIT 1";
			$sdata = $this->db->query($sql, 2);
			if ($sdata && $params['sessid'] == $sdata['sessid']) {
				$key = array($uid,$touid);
				sort($key);
				$key = implode('-', $key);
				$rows = $this->db->query("SELECT * FROM `nitalk_chat` WHERE `key`='$key' AND `sendday`='$date' ORDER BY `cid` ASC", 3);
				foreach ($rows as $row) {
					array_push($Recs, array(
						'Msg' => base64_decode($row['msg']),
						'Msgtype' => 'txt',
						'Sendtime' => $row['sendtime'],
						'Username' => $row['fromuid'] == KFID ? '客服' : $row['fromusername'],
						'Userid' => $row['fromuid'],
						'Chattype' => '',
						'Frnickname' => $row['fromuid'] == KFID ? '客服' : $row['fromusername'],
					));
				}
			}
		}
		$result = array(
			'Retcode' => 0,
			'Retdesc' => 'SUCCESS',
			'Recnum' => count($Recs),
			'Recs' => $Recs,
		);
		$this->output($result);
	}

}