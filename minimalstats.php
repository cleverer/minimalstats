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
			
			if (isset(Config::DB_HOST) && isset(Config::DB_USER) && isset(Config::DB_PASSWORD) &&  isset(Config::DB_NAME)) {
				$db = new DB;
				
				try {
					$db->connect();
				}
				catch (Exception $e) {
					if (true !== $installer) {
						error_log('Connect Error: ' . $e->message."\n".$e->code);
						$this->outputPage = false;
						die();
					}
				}
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
