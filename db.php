<?php
	namespace MinimalStats;
	
	use \mysqli as mysqli; 
	/**
	* DB
	* Database abstractions
	*/
	class ￼DB￼ {
		
		protected $db = null;
		
		public function connect($host, $user, $pwd, $name) {
			$db = @new mysqli($host, $user, $pwd, $name);
				
			if ($db->connect_errno) {
				throw ErrorException($db->connect_error, $db->connect_errno);
			}
			$db->set_charset("utf8");
			$this->db = $db;
		}
		
	}
