<?php
/*
	--------------------------------------------------------
	minimalstats
	created by Nicolas Da Mutten, www.nicolas.damutten.ch
	--------------------------------------------------------
*/
	namespace MinimalStats;
	
	use \Exception as Exception;

	require_once 'minimalstats.php';
	
	/**
	* Installer
	*/
	class Installer extends MS {
		
		function __construct($outputPage = true) {
			
			$this->outputPage = $outputPage;
			$this->rootPath = __DIR__;
			
			ob_start();
			
		}
		
		protected function title() {
			echo 'Install';
		}
		
		protected function additionalScripts($echo = false) {
			$scripts = self::getIncludeContents($this->rootPath.'/templates/copy.php');
			return self::echoOrReturn($scripts, $echo);
		}
		
		private function createDB() {
			
		}
		
		function checkConfig() {
			
			$hasError = false;
			
			// Check and load config file
			try {
				$this->config = self::loadConfig();
			}
			catch (MSException $e) {
				$hasError = true;
				switch ($e->getCode()) {
						case 1:
							$message = '<strong>Couldn\'t read your config file.</strong>'; // TODO: Localization
							break;
						case 2:
							$message = '<strong>Please edit your config file.</strong><br>At least the following required setting-parameters are missing: '.implode(', ', $e->getData()); // TODO: Localization
							break;
						default:
							$message = 'An unspecifed error occured. Error code: '.$e->getCode(); // TODO: Localization
							break;
				}
				echo '<div class="alert alert-warning">'.$message.'</div>';
				return;
			}
			
			// Check and establish DB connection
			try {
				$this->db = $this->initDB();
			}
			catch (MSException $e) {
				$hasError = true;
				switch ($e->getCode()) {
						case 3:
							$message = '<strong>Database Error.</strong><br>Please check your db-config. The following error occurred:<br>'.$e->getPrevious()->getMessage(); // TODO: Localization
							break;
						default:
							$message = 'An unspecifed error occured. Error code: '.$e->getCode();
							break;
				}
				echo '<div class="alert alert-warning">'.$message.'</div>';
				return;
			}
							
			// Check DB Version
			try {
				$this->checkDBVersion();
			}
			catch (MSException $e) { // Todo: Implement Logic to update/create Tables
				$hasError = true;
				switch ($e->getCode()) {
						case 4:
							$message = '<strong>Database Error.</strong> Database is not the newest version.'; // TODO: Localization
							break;
						default:
							$message = 'An unspecifed error occured. Error code: '.$e->getCode();
							break;
				}
				echo '<div class="alert alert-warning">'.$message.'</div>';
				return;
			}

			$working = array(
				'Your config file looks fine.',
				'Database Works.'
			);
			
			echo '<div class="alert alert-success"><strong>'.implode("<br>\n", $working).'</strong></div>'; // TODO: Localization
		}
	}
	
	$installer = new Installer();
	$installer->checkConfig();
?>

<h2>Install to site</h2>
<p>To use the counter, include this snippet somewhere on your site:</p> <!-- // TODO: Localization -->
<div class="card">
	<button type="button" class="btn btn-outline-primary btn-sm copySnippetButton" data-clipboard-target="code#snippet" title="Copy to clipboard" style="position: absolute; top: 0.5rem; right: 0.5rem;">Copy</button> <!-- // TODO: Localization -->
<pre class="card-block" style="margin-bottom:0;"><code id="snippet">&lt;script type="text/javascript"&gt;
	document.write('&lt;a href="/minimalstats/view.php"&gt;&lt;img src="/minimalstats/counter.php?ref=' + escape(document.referrer) + '" width="90" height="20"&gt;&lt;/a&gt;')
&lt;/script&gt;
&lt;noscript&gt;&lt;a href="/minimalstats/view.php"&gt;&lt;img src="/minimalstats/counter.php" width="90" height="20" /&gt;&lt;/a&gt;&lt;/noscript&gt;</code></pre>
</div>
