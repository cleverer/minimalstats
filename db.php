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
	abstract class Model {
		
		const requiredConfig = [
		];
		
		abstract function init(Array $config): bool;
		abstract function getMetadata(): Array;
				
	}
