<?php
	namespace MinimalStats;

	require_once 'config/config.php';
		
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		private $db = null;
		
		function __construct() {
			
			ob_start();
			
			if (!empty(Config::DB_HOST) && !empty(Config::DB_USER) && !empty(Config::DB_PASSWORD) && !empty(Config::DB_NAME)) {
				$db = @new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
				
				if ($db->connect_errno) {
				    die('Connect Error: ' . $db->connect_errno);
				}
				$db->set_charset("utf8");
				$this->db = $db;
			}
			
		}
		
		function __destruct() {
			
			if (null !== $this->db) {
				$this->db->close();
			}
			
			$output = ob_get_contents();
			ob_end_clean();
			
			?>
<!DOCTYPE html>
<html>
	<head>
		<title>MinimalStats<?php if (method_exists($this, 'title')) $this::title(); ?></title>
	</head>
	<body>
		<?php echo $output;?>
	</body>
</html>
			<?php

		}
		
	}
