<?php

if(!class_exists('randomus_namus')){
	class randomus_namus {
		const __select = "select `value` from `%s` where `key`='%s'";
		const __update = "insert into `%s` (`key`, `value`) values ('%s', '%s') on duplicate key update `value`='%s'";

		protected $_table = 'kvs';
		protected $_dbo = null;

		public function __construct(){
			$this->_dbo = DatabaseManager::Load('main');
		}

		public function get_handie($key){
			$r = $this->_dbo->query(sprintf(self::__select, $this->_table, $this->_dbo->escape($key)));
			return ($r)? $r->fetch_array(): null;
		}

		public function give_handie($key, $value = ''){
			$k = $this->_dbo->escape($key); $v = $this->_dbo->escape($value);
			$this->_dbo->query(sprintf(self::__update, $this->_table, $k, $v, $v));
		}
	}
}
