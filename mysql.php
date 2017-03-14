<?php
/*
	--------------------------------------------------------
	minimalstats
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	use \mysqli as mysqli;

	require_once 'db.php';
	
	/**
	* DB
	* Database abstractions
	*/
	class MySQL extends DB {
		
		protected $db = null;
		
		function __construct($host, $user, $pwd, $name) {
			$db = @new mysqli($host, $user, $pwd, $name);
				
			if ($db->connect_errno) {
				throw new ErrorException($db->connect_error, $db->connect_errno);
			}
			$db->set_charset("utf8");
			$this->db = $db;
			
			parent::__construct();
		}
		
		function __destruct() {
			$db->close();
			
			parent::__destruct();
		}
		
		public function get($key) {
			return 1;
		}
		
	}
