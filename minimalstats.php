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
	require_once 'msexception.php';
		
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		protected $db = null;
		protected $config = false;
		
		protected $rootPath;
		
		protected $outputPage;
		
		const requiredConfig = array(
			'DB_HOST',
			'DB_USER',
			'DB_PASSWORD',
			'DB_NAME'
		);
		
		const dbVersion = 1;
		
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
		
		protected static function loadConfig() {
			
			// try loading config
			$config = parse_ini_file('config/config.ini');
			
			if (false === $config) {
				throw new MSException('Error loading config file.', 1);
			}
			
			// Check for required config parameters
			$missingConfig = array();
			foreach (self::requiredConfig as $setting) {
				if (!array_key_exists($setting, $config)) {
					$missingConfig[] = $setting;
				}
			}
			
			if (0 < count($missingConfig)) {
				throw new MSException(null, 2, null, $missingConfig);
			}
			
			return $config;
		}
		
		protected function initDB() {

			// Setup DB
			$db = new DB();

			try {
				$db->connect($this->config['DB_HOST'], $this->config['DB_USER'], $this->config['DB_PASSWORD'], $this->config['DB_NAME']);
			}
			catch (Exception $e) {
				throw new MSException(null, 3, $e);
			}
			
			return $db;

		}
		
		protected function checkDBVersion() {
			$dbVersion = $this->db->get(DB::tableKeys['metadata']);
			if ($dbVersion !== self::dbVersion) {
				throw new MSException(null, 4);
			}
			return $dbVersion;
		}
		
		// Object Lifecycle
		
		function __construct($outputPage = true) {
						
			$this->outputPage = $outputPage;
			$this->rootPath = __DIR__;
			
			ob_start();
			
			try {
				$this->config = self::loadConfig();	
				$this->db = $this->initDB();
				$this->checkDBVersion();
			}
			catch (MSException $e) {
				if (true !== $installer) {
					$this->outputPage = false;
					die();
				}
			}						
		}
		
		function __destruct() {
			
			$output = ob_get_clean();

			if (null !== $this->db) {
				$this->db->close();
			}
									
			if ($this->outputPage) {
				include 'templates/basicpage.php';
			} else {
				echo $output;
			}
		}
	}
