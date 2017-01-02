<?php
	namespace MinimalStats;

	require_once 'config/config.php';
		
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		private $db = null;
		private $outputPage;
		
		function __construct($installer = null, $outputPage = true) {
			
			$this->outputPage = $outputPage;
			
			ob_start();
			
			if (!empty(Config::DB_HOST) && !empty(Config::DB_USER) && !empty(Config::DB_PASSWORD) && !empty(Config::DB_NAME)) {
				$db = @new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
				
				if ($db->connect_errno) {
				    die('Connect Error: ' . $db->connect_errno);
				}
				$db->set_charset("utf8");
				$this->db = $db;
			} else if ($installer !== true) {
				$this->outputPage = false;
				die();
			}
		}
		
		function __destruct() {
			
			if (null !== $this->db) {
				$this->db->close();
			}
			
			$output = ob_get_contents();
			ob_end_clean();
			
			if ($this->outputPage) {
				include 'templates/basicpage.php';
			} else {
				echo $output;
			}
		}
		
	}
