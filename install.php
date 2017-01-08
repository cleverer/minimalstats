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
		
		protected $dbError = null;
		
		function __construct() {
			
			try {
				parent::__construct(true);
			}
			catch (Exception $e) {
				$this->dbError = $e;
			}
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
			if (false === $this->config) {
				echo '<div class="alert alert-danger">Something\'s wrong with your config file.</div>'; // TODO: Localization
			}
			
			if (!isset($this->config['DB_HOST']) || !isset($this->config['DB_USER']) || !isset($this->config['DB_PASSWORD']) || !isset($this->config['DB_NAME'])) {
				echo '<div class="alert alert-danger">Please Configure the db!</div>'; // TODO: Localization
			} else if (null !== $this->dbError) {
				echo '<div class="alert alert-warning"><strong>Database Error.</strong><br>Please check your db-config. The following error occurred:<br>'.$this->dbError->getMessage().'</div>'; // TODO: Localization
			} else {
				echo '<div class="alert alert-success"><strong>Database Works.</strong></div>'; // TODO: Localization
			}
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
