<?php
	namespace MinimalStats;

	require_once 'config/config.php';
		
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		private $db = null;
		
		__construct() {
			
			ob_start();
			
			if (!empty(Config::DB_HOST) && !empty(Config::DB_USER) && !empty(Config::DB_PASSWORD) && !empty(Config::DB_NAME)) {
				$db = @new mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
				
				if ($db->connect_errno) {
				    die('Connect Error: ' . $db->connect_errno);
				}
				$db->set_charset("utf8");
				$this->db = $db;
			}
			
		}
		
		__destruct() {
			
			if (null !== $this->db) {
				$this->db->close();
			}
			
			?>
<!DOCTYPE html>
<html>
	<head>
		<title>MinimalStats<?php if function_exists(self::title) self::title(); ?></title>
	</head>
	<body>
		<?php
			ob_end_flush();
		?>
	</body>
</html>
			<?php

		}
		
	}
