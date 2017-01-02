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
		
		function checkConfig() {
			if (0 != $this->db->connect_errno) {
				echo '<div class="alert alert-warning"><strong>Database Error.</strong><br>Please check your db-config. The following error occurred:<br>'.$this->db->connect_error.'</div>'; // TODO: Localization
			} else {
				echo '<div class="alert alert-success"><strong>Database Works.</strong></div>'; // TODO: Localization
			}
		}
		
	}
	
	$installer = new Installer();
	$installer->checkConfig();
?>
