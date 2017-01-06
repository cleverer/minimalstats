<?php
/*
	--------------------------------------------------------
	minimalstats
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
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
