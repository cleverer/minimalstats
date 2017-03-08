<?php
/*
	--------------------------------------------------------
	minimalstats
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	use \mysqli as mysqli;
	use \ErrorException as ErrorException;
	/**
	* DB
	* Database abstractions
	*/
	class DB {
		
		protected $db = null;
		
		public function connect($host, $user, $pwd, $name) {
			$db = @new mysqli($host, $user, $pwd, $name);
				
			if ($db->connect_errno) {
				throw new ErrorException($db->connect_error, $db->connect_errno);
			}
			$db->set_charset("utf8");
			$this->db = $db;
		}
		
		public function close() {
			
		}
		
	}
