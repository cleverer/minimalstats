<?php
	namespace MinimalStats;
	/**
	* DB
	* Database abstractions
	*/
	class ￼DB￼ {
		
		protected $db = null;
		
		public function connect() {
			$db = @new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
				
			if ($db->connect_errno) {
				throw // 'Connect Error: ' . $db->connect_errno."\n".$db->connect_error
			}
			$db->set_charset("utf8");
			$this->db = $db;
		}
		
	}
