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
		
	class MSException extends Exception {
		protected $data;
		
		public function __construct($message = null, $code = 0, Exception $previous = null, $data = null) {
			
			$this->data = $data;
			
			parent::__construct($message, $code, $previous);
			
		}
		
		public function getData() {
			return $this->data;
		}
	}
	
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		protected $db = null;
		protected $config = false;
		
		protected $rootPath;
		
		private $outputPage;
		
		const requiredConfig = array(
			'DB_HOST',
			'DB_USER',
			'DB_PASSWORD',
			'DB_NAME'
		);
		
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
		
		function __construct($installer = false, $outputPage = true) {
						
			$this->outputPage = $outputPage;
			$this->rootPath = __DIR__;
			
			ob_start();
			
			// try loading config
			$this->config = parse_ini_file('config/config.ini');
			
			if (false === $this->config) {
				if (true !== $installer) {
					$this->outputPage = false;
					die();
				} else {
					throw new MSException('Error loading config file.', 1);
				}
			}
			
			// Check for required config parameters
			$missingConfig = array();
			foreach (self::requiredConfig as $setting) {
				if (!array_key_exists($setting, $this->config)) {
					$missingConfig[] = $setting;
				}
			}
			
			if (0 < count($missingConfig)) {
				if (true !== $installer) {
					$this->outputPage = false;
					die();
				} else {
					throw new MSException(null, 2, null, $missingConfig);
				}
			}
			
			// Setup DB
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
					throw new MSException(null, 3, $e);
				}
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
