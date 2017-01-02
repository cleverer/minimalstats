<?php
	namespace MinimalStats;
	
	require_once 'minimalstats.php';
	
	/**
	* Installer
	*/
	class Installer extends MS {
		
		function __construct() {
			
			parent::__construct(true);
			
			if (empty(Config::DB_HOST) || empty(Config::DB_USER) || empty(Config::DB_PASSWORD) || empty(Config::DB_NAME)) {
				echo '<div class="alert alert-danger">Please Configure the db!</div>';
			}
		}
		
		private function createDB() {
			
		}
		
		function handlePOST() {
			
		}
		
	}
	
	$installer = new Installer();
?>
