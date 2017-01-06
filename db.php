<?php
	namespace MinimalStats;
	
	use \mysqli as mysqli; 
	/**
	* DB
	* Database abstractions
	*/
	class ￼DB￼ {
		
		protected $db = null;
		
		public function connect() {
			$db = @new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
				
			if ($db->connect_errno) {
				throw ErrorException($db->connect_error, $db->connect_errno);
			}
			$db->set_charset("utf8");
			$this->db = $db;
		}
		
	}
