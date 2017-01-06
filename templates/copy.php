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
