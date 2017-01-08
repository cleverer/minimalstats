<?php
/*
	--------------------------------------------------------
	minimalstats v0.1
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	use \Exception as Exception;

	require_once 'db.php';
		
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		protected $db = null;
		protected $config = false;
		
		protected $rootPath;
		
		private $outputPage;
		
		// Helper functions
		
		static function echoOrReturn($string, $echo = false) {
			if ($echo) {
				echo $string;
			} else {
				return $string;
			}
		}
		
		static function getIncludeContents($filename) {
			if (is_file($filename)) {
				ob_start();
				include $filename;
				$contents = ob_get_contents();
				ob_end_clean();
				return $contents;
			}
			return '';
		}
		
		// Object Lifecycle
		
		function __construct($installer = null, $outputPage = true) {
						
			$this->outputPage = $outputPage;
			$this->rootPath = __DIR__;
			
			ob_start();
			
			$this->config = parse_ini_file('config/config.ini');
			
			if (false === $this->config && true !== $installer) {
				$this->outputPage = false;
				die();
			}
			
			if (isset($this->config['DB_HOST']) && isset($this->config['DB_USER']) && isset($this->config['DB_PASSWORD']) &&  isset($this->config['DB_NAME'])) {
				$db = new DB();
				
				try {
					$db->connect($this->config['DB_HOST'], $this->config['DB_USER'], $this->config['DB_PASSWORD'], $this->config['DB_NAME']);
				}
				catch (Exception $e) {
					if (true !== $installer) {
						error_log('Connect Error: ' . $e->getMessage()."\n".$e->getCode());
						$this->outputPage = false;
						die();
					} else {
						throw $e;
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
