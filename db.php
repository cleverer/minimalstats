<?php
/*
	--------------------------------------------------------
	minimalstats
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	use \ErrorException as ErrorException;
	/**
	* DB
	* Database abstractions
	*/
	class DB {
		
		const tableKeys = [
			'metadata' => 'metadata',
			'custom' => 'custom',
		];
		
		function __construct($host, $user, $pwd, $name) {
			// Initialize Storage
			// if an error occurs, throw an ErrorException
		}
		
		function __destruct() {
			// If necessary release storage connections
		}
		
		public function get($key, $query = null) {
			// Get data Specified with key
			// if key is custom, use $query to get Data
			return ;
		}
		
	}
