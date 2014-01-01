<script type="text/javascript">
	$(function() {
		$('#btn-copy-quote').click(function() {
			$('#modal-placeholder').load("{{ route('quotes.ajax.modalCopyQuote') }}", { quote_id: {{ $quote->id }} });
		});
	});
</script>