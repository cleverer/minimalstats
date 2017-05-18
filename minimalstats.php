<?php
/*
	--------------------------------------------------------
	minimalstats v0.1
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	use \Exception as Exception;

	require_once 'mysql.php';
	require_once 'msexception.php';
		
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		protected $model = null;
		protected $config = false;
		
		protected $rootPath;
		
		protected $outputPage;
		
		protected $requiredConfig = [
		];
		
		const modelVersion = 1;
		
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
		
		protected function loadConfig() {
			
			// try loading config
			$config = parse_ini_file('config/config.ini');
			
			if (false === $config) {
				throw new MSException('Error loading config file.', 1);
			}
			
			if (array_key_exists('MODEL_TYPE', $config)) {
				$modelType = $config['MODEL_TYPE'];
			} else {
				$modelType = null;
			}
			switch ($modelType) {
				case 'MYSQL':
				default:
					$this->model = new MySQL();
					$this->requiredConfig = array_unique(array_merge($this->requiredConfig, MySQL::requiredConfig));
					break;
			}
			
			// Check for required config parameters
			$missingConfig = array();
			foreach ($this->requiredConfig as $setting) {
				if (!array_key_exists($setting, $config)) {
					$missingConfig[] = $setting;
				}
			}
			
			if (0 < count($missingConfig)) {
				throw new MSException(null, 2, null, $missingConfig);
			}
			
			return $config;
		}
		
		protected function initModel() {

			// Setup Model
			
			$success = false;
			
			try {
				$success = $this->model->init($this->config);
			}
			catch (Exception $e) {
				throw new MSException(null, 3, $e);
			}
			
			return $success;

		}
		
		protected function checkModelVersion() {
			$modelVersion = $this->model->getMetadata(['modelVersion'])['modelVersion'];
			if ($modelVersion !== self::modelVersion) {
				throw new MSException(null, 4);
			}
			return $modelVersion;
		}
		
		// Object Lifecycle
		
		function __construct($outputPage = true) {
						
			$this->outputPage = $outputPage;
			$this->rootPath = __DIR__;
			
			ob_start();
			
			try {
				$this->config = $this->loadConfig();	
				$this->initModel();
				$this->checkModelVersion();
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
									
			if ($this->outputPage) {
				include 'templates/basicpage.php';
			} else {
				echo $output;
			}
		}
	}
