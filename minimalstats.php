<?php
	namespace MinimalStats;

	require_once 'config/config.php';
		
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		protected $db = null;
		private $outputPage;
		
		static function echoOrReturn($string, $echo = false) {
			if ($echo) {
				echo $string;
			} else {
				return $string;
			}
		}
		
		function __construct($installer = null, $outputPage = true) {
						
			$this->outputPage = $outputPage;
			
			ob_start();
			
			if (!empty(Config::DB_HOST) && !empty(Config::DB_USER) && !empty(Config::DB_PASSWORD) && !empty(Config::DB_NAME)) {
				$db = @new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
				
				if ($db->connect_errno) {
					if (true !== $installer) {
						error_log('Connect Error: ' . $db->connect_errno."\n".$db->connect_error);
						$this->outputPage = false;
						die();
					}
				}
				$db->set_charset("utf8");
				$this->db = $db;
			} else if (true !== $installer) {
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
