<?php
	namespace MinimalStats;

	require_once 'config/config.php';
		
	/**
	* MS
	* Parent class which provides standard functions
	*/
	
	class MS {
	
		private $db = null;
		
		function __construct($installer = false) {
			
			ob_start();
			
			if (!empty(Config::DB_HOST) && !empty(Config::DB_USER) && !empty(Config::DB_PASSWORD) && !empty(Config::DB_NAME)) {
				$db = @new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
				
				if ($db->connect_errno) {
				    die('Connect Error: ' . $db->connect_errno);
				}
				$db->set_charset("utf8");
				$this->db = $db;
			} else if (!$installer) {
				die();
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
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>MinimalStats<?php if(!empty(Config::SITE_NAME)) { echo ": ".Config::SITE_NAME; } if (method_exists($this, 'title')) { echo " – "; $this::title(); }?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
	</head>
	<body style="padding-top:5rem;">
		<nav class="navbar navbar-fixed-top navbar-light bg-faded" style="padding-left: 0; padding-right: 0;">
			<div class="container">
				<a class="navbar-brand" href="/"><?php if(!empty(Config::SITE_NAME)) { echo Config::SITE_NAME; } else { echo 'MinimalStats'; }?></a>
				<button class="navbar-toggler hidden-md-up float-xs-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>
				<div class="collapse navbar-toggleable-sm nav navbar-nav" id="navbarResponsive" style="clear: right;">
					<a class="nav-item nav-link" href="view.php">View</a>
				</div>
			</div>
		</nav>
		<div class="container">
			<h1><?php if (method_exists($this, 'title')) { $this::title(); echo ' <small class="text-muted">MinimalStats</small>'; } else { echo 'MinimalStats'; }?></h1>
			<?php echo $output;?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
	</body>
</html>
			<?php

		}
		
	}
