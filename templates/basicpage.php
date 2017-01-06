<?php
	namespace MinimalStats;
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>MinimalStats<?php if(isset($this->config['SITE_NAME'])) { echo ": ".$this->config['SITE_NAME']; } if (method_exists($this, 'title')) { echo " – "; $this::title(); }?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
	</head>
	<body style="padding-top:5rem;">
		<nav class="navbar navbar-fixed-top navbar-light bg-faded" style="padding-left: 0; padding-right: 0;">
			<div class="container">
				<a class="navbar-brand" href="/"><?php if(isset($this->config['SITE_NAME'])) { echo $this->config['SITE_NAME']; } else { echo 'MinimalStats'; }?></a>
				<button class="navbar-toggler hidden-md-up float-xs-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>
				<div class="collapse navbar-toggleable-sm nav navbar-nav" id="navbarResponsive" style="clear: right;">
					<a class="nav-item nav-link" href="view.php">View</a>
				</div>
			</div>
		</nav>
		<div class="container">
			<h1><?php if (method_exists($this, 'title')) { echo 'MinimalStats <small class="text-muted">'; $this->title(); echo '</small>'; } else { echo 'MinimalStats'; }?></h1>
			<?php echo $output;?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
		<?php if (method_exists($this, 'additionalScripts')) { $this::additionalScripts(true); }?>
	</body>
</html>
