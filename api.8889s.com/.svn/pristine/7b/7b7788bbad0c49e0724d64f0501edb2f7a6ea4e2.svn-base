<?php

class lib_db {

	private $db;
	private $trans_ing = false;
	
	public function __construct() {
		$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT;
		for ($i=0;$i<3;$i++) { //如果连接Mysql失败则重试3次
			try{
				$this->db = new PDO($dsn, DB_USER, DB_PASS, array(
					PDO::ATTR_PERSISTENT => false,
					PDO::ATTR_CASE => PDO::CASE_NATURAL,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_AUTOCOMMIT => true,
					PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				));
				break;
			} catch (Exception $e) {
				if ($i >= 2) core::error('连接数据库失败，请重试');
			}
		}
	}
	
	public function insert($table, $data) {
		$fields = '';
		$values = '';
		foreach ($data as $k => $v) {
			$fields .= '`'.$k.'`,';
			$values .= "'$v',";
		}
		$sql = 'INSERT INTO `'.$table.'` ('.substr($fields, 0, -1).') VALUES ('.substr($values, 0, -1).')';
		return $this->query($sql, 1);
	}
	
	public function query($sql, $return) {
		try {
			switch ($return) {
				case 0:
					$result = $this->db->exec($sql);
				break;
				
				case 1:
					$this->db->exec($sql);
					$result = $this->db->lastInsertId();
				break;
				
				case 2:
				case 3:
					$query = $this->db->query($sql);
					$action = $return === 2 ? 'fetch' : 'fetchAll';
					$result = call_user_func_array(array($query, $action), array(PDO::FETCH_ASSOC));
					$query->closeCursor();
				break;
				
				default: throw new Exception('_UNKNOW_RETURN_: '.$return);
			}
			return $result;
		} catch (Exception $e) {
			$data = array(
				'TYPE' => 'MYSQL',
				'SQL'  => $sql,
			);
			core::logger($data);
			if ($this->trans_ing) {
				throw new Exception('执行数据库操作失败，请重试');
			} else {
				core::error('执行数据库操作失败，请重试');
			}
		}
	}
	
	public function transaction($command) {
		try {
			switch ($command) {
				case 'begin':
					$this->db->beginTransaction();
					$this->trans_ing = true;
				break;
				
				case 'commit':
					$this->db->commit();
					$this->trans_ing = false;
				break;
				
				case 'rollBack':
					$this->db->rollBack();
				break;
				
				default:
			}
		} catch (Exception $e) {
			$data = array(
				'TYPE' => 'MYSQL',
				'SQL'  => $sql,
			);
			core::logger($data);
			if ($this->trans_ing) {
				throw new Exception('执行数据库操作失败，请重试');
			} else {
				core::error('执行数据库操作失败，请重试');
			}
		}
	}
	
	public function __destruct() {
		$this->db = null;
	}

}