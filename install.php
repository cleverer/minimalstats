<?php
	namespace MinimalStats;
	
	require_once 'minimalstats.php';
	
	/**
	* Installer
	*/
	class Installer extends MS {
		
		function __construct() {
			
			parent::__construct(true);
			
			if (empty(Config::DB_HOST) || empty(Config::DB_USER) || empty(Config::DB_PASSWORD) || empty(Config::DB_NAME)) {
				echo '<div class="alert alert-danger">Please Configure the db!</div>';
			}
		}
		
		protected function title() {
			echo 'Install';
		}
		
		protected function additionalScripts($echo = false) {
			$scripts = <<<'EOS'
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js"></script>
<script charset="utf-8">
	var clipboard = new Clipboard('.copySnippetButton');
	
	$('.copySnippetButton').tooltip({'placement': 'left'});
	
	clipboard.on('success', function(e) {
		e.clearSelection();
		$(e.trigger).tooltip('dispose');
		$(e.trigger).attr('data-original-title', "Copied!"); // TODO: Localization
		$(e.trigger).tooltip({'placement': 'left'});
		$(e.trigger).tooltip('show');
		$(e.trigger).attr('data-original-title', "Copy to clipboard"); // TODO: Localization
	});
	
	clipboard.on('error', function(e) {
		$(e.trigger).tooltip('dispose');
		$(e.trigger).attr('data-original-title', "Press Control+C/Command+C to Copy."); // TODO: Localization
		$(e.trigger).tooltip('show');
		$(e.trigger).attr('data-original-title', "Copy to clipboard"); // TODO: Localization
	});
</script>
EOS;
			self::echoOrReturn($scripts, $echo);
		}
		
		private function createDB() {
			
		}
		
		function handlePOST() {
			
		}
		
		function checkConfig() {
			if (0 != $this->db->connect_errno) {
				echo '<div class="alert alert-warning"><strong>Database Error.</strong><br>Please check your db-config. The following error occurred:<br>'.$this->db->connect_error.'</div>'; // TODO: Localization
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
<div class="card"><button type="button" class="btn btn-outline-primary btn-sm copySnippetButton" data-clipboard-target="code#snippet" title="Copy to clipboard" style="position: absolute; top: 0.5rem; right: 0.5rem;">Copy</button> <!-- // TODO: Localization -->
<pre class="card-block" style="margin-bottom:0;"><code id="snippet">&lt;script type="text/javascript"&gt;
	document.write('&lt;a href="/minimalstats/view.php"&gt;&lt;img src="/minimalstats/counter.php?ref=' + escape(document.referrer) + '" width="90" height="20"&gt;&lt;/a&gt;')
&lt;/script&gt;
&lt;noscript&gt;&lt;a href="/minimalstats/view.php"&gt;&lt;img src="/minimalstats/counter.php" width="90" height="20" /&gt;&lt;/a&gt;&lt;/noscript&gt;</code></pre></div>
