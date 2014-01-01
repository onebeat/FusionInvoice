<script type="text/javascript">

	$(function() {

		$('#mail-invoice').modal('show');
		
		$('#btn-mail-invoice-confirm').click(function() {

			$.post("{{ route('invoices.ajax.mailInvoice') }}", {
				invoice_id: {{ $invoiceId }},
				to: $('#to').val(),
				cc: $('#cc').val(),
				subject: $('#subject').val()
			}, function(data) {
				var response = JSON.parse(data);

				if (response.success == '1') {
					window.location = "{{ $redirectTo }}";
				}
				else {
					alert(response.message);
				}
			});
		});
	});
	
</script>

<div id="mail-invoice" class="modal hide">
	<form class="form-horizontal">
		<div class="modal-header">
			<a data-dismiss="modal" class="close">x</a>
			<h3>{{ trans('fi.email_invoice') }}</h3>
		</div>
		<div class="modal-body">

			<div class="control-group">
				<label class="control-label">{{ trans('fi.to') }}: </label>
				<div class="controls">
					{{ Form::text('to', $to, array('id' => 'to')) }}
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">{{ trans('fi.cc') }}: </label>
				<div class="controls">
					{{ Form::text('cc', $cc, array('id' => 'cc')) }}
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">{{ trans('fi.subject') }}: </label>
				<div class="controls">
					{{ Form::text('subject', $subject, array('id' => 'subject')) }}
				</div>
			</div>
			
		</div>

		<div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="icon-white icon-remove"></i> {{ trans('fi.cancel') }}</button>
			<button class="btn btn-primary" id="btn-mail-invoice-confirm" type="button"><i class="icon-white icon-ok"></i> {{ trans('fi.send') }}</button>
		</div>

	</form>

</div>