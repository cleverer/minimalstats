<?php
	namespace MinimalStats;
	
	require_once 'minimalstats.php';
	
	/**
	* View
	*/
	class View extends MS {
		
		private function title() {
			echo 'View';
		}
		
	}
	
	$view = new View();
?>
