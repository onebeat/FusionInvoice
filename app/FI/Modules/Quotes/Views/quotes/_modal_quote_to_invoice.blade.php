<script type="text/javascript">
	$(function()
	{
		$('.datepicker').datepicker({autoclose: true, format: '{{ Config::get('fi.datepickerFormat') }}' });
		
		// Display the create quote modal
		$('#quote-to-invoice').modal('show');
		
		// Creates the invoice
		$('#btn-quote-to-invoice-confirm').click(function()
		{
			$.post("{{ route('quotes.ajax.quoteToInvoice') }}", { 
				quote_id: {{ $quote_id }},
				client_id: {{ $client_id }},
				created_at: $('#created_at').val(),
				invoice_group_id: $('#invoice_group_id').val(),
				user_id: {{ $user_id }}
			},
			function(data) {
				var response = JSON.parse(data);
				if (response.success == '1')
				{
					window.location = response.redirectTo;
				}
				else
				{
					// The validation was not successful
					// $('.control-group').removeClass('error');
					// for (var key in response.validation_errors) {
					// 	$('#' + key).parent().parent().addClass('error');
					// }
					alert(response.message);
				}
			});
		});
	});
	
</script>

<div id="quote-to-invoice" class="modal hide">
	<form class="form-horizontal">
		<div class="modal-header">
			<a data-dismiss="modal" class="close">x</a>
			<h3>{{ trans('fi.quote_to_invoice') }}</h3>
		</div>
		<div class="modal-body">

			<div class="control-group">
				<label class="control-label">{{ trans('fi.invoice_date') }}: </label>
				<div class="controls input-append date datepicker">
					{{ Form::text('created_at', $created_at, array('id' => 'created_at', 'readonly' => 'readonly')) }}
					<span class="add-on"><i class="icon-th"></i></span>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">{{ trans('fi.invoice_group') }}: </label>
				<div class="controls">
					{{ Form::select('invoice_group_id', $invoiceGroups, Config::get('fi.invoiceGroup'), array('id' => 'invoice_group_id')) }}
				</div>
			</div>

		</div>

		<div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="icon-white icon-remove"></i> {{ trans('fi.cancel') }}</button>
			<button class="btn btn-primary" id="btn-quote-to-invoice-confirm" type="button"><i class="icon-white icon-ok"></i> {{ trans('fi.submit') }}</button>
		</div>

	</form>

</div>