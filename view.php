<?php
	namespace MinimalStats;
	
	require_once 'minimalstats.php';
	
	/**
	* View
	*/
	class View extends MS {
		
		protected function title() {
			echo 'View';
		}
		
	}
	
	$view = new View();
?>
