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
		
		protected $constructError = null;
		
		function __construct() {
			
			try {
				parent::__construct(true);
			}
			catch (Exception $e) {
				$this->constructError = $e;
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
			if (null === $this->constructError) {
				
				$working = array(
					'Your config file looks fine.',
					'Database Works.'
				);
				
				echo '<div class="alert alert-success"><strong>'.implode("<br>\n", $working).'</strong></div>'; // TODO: Localization
			} else {
				if (is_a($this->constructError, get_class(new MSException()))) {
					switch ($this->constructError->getCode()) {
						case 1:
							$message = '<strong>Couldn\'t read your config file.</strong>'; // TODO: Localization
							break;
						case 2:
							$message = '<strong>Please edit your config file.</strong><br>At least the following required setting-parameters are missing: '.implode(', ', $this->constructError->getData()); // TODO: Localization
							break;
						case 3:
							$message = '<strong>Database Error.</strong><br>Please check your db-config. The following error occurred:<br>'.$this->constructError->getPrevious()->getMessage(); // TODO: Localization
							break;
						default:
							$message = 'An unspecifed error occured. Error code: '.$this->constructError->getCode();
							break;
					}
					
					echo '<div class="alert alert-warning">'.$message.'</div>';
					
				} else {
					throw $this->constructError;
				}
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
