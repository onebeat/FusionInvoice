<script type="text/javascript">
	$(function() {
		$('#btn-copy-invoice').click(function() {
			$('#modal-placeholder').load("{{ route('invoices.ajax.modalCopyInvoice') }}", { invoice_id: {{ $invoice->id }} });
		});
	});
</script>