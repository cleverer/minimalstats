<?php
/*
	--------------------------------------------------------
	minimalstats
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	use \mysqli as mysqli;
	use \ErrorException as ErrorException;

	require_once 'db.php';
	
	/**
	* DB
	* Database abstractions
	*/
	class MySQL extends Model {
		
		protected $db = null;
		
		protected $host = null;
		protected $user = null;
		protected $pwd = null;
		protected $name = null;
		
		const requiredConfig = [
			'MYSQL_HOST',
			'MYSQL_USER',
			'MYSQL_PASSWORD',
			'MYSQL_DB_NAME',
		];
		
		function __destruct() {
			
			if ($this->db !== null)
				$this->db->close();
				
		}
	
		public function init(Array $config): bool {
						
			$this->host = $config['MYSQL_HOST'];
			$this->user = $config['MYSQL_USER'];
			$this->pwd = $config['MYSQL_PASSWORD'];
			$this->name = $config['MYSQL_DB_NAME'];
			
			$db = @new mysqli($this->host, $this->user, $this->pwd, $this->name);

				
			if ($db->connect_errno) {
				throw new ErrorException($db->connect_error, $db->connect_errno);
			}
			$db->set_charset("utf8");
			$this->db = $db;
			
			return true;

		}
		
		public function getMetadata(Array $keys = null): Array {
			
			$metadata = [
				'modelVersion' => 1,
			];
			
			if ($keys === null) {
				$output = $metadata;
			} else {
				
				foreach ($keys as $key) {
					
					if (!array_key_exists($key, $metadata))
						continue;
					
					$output[$key] = $metadata[$key];
					
				}
				
			}
			
			return $output;
		}
		
	}
