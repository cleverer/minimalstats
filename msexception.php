<?php
/*
	--------------------------------------------------------
	minimalstats
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	use \Exception as Exception;
	
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
