<script type="text/javascript">

	$(function() {

		$('.datepicker').datepicker({autoclose: true, format: '{{ Config::get('fi.datepickerFormat') }}' });
		
		$('#create-quote').modal('show');
        
        $('#create-quote').on('shown', function() {
            $("#client_name").focus();
        });

		$('.client-lookup').keypress(function()	{
			var self = $(this);

			$.post("{{ route('clients.ajax.nameLookup') }}", {

				query: self.val()

			}, function(data) {
				
				self.typeahead().data('typeahead').source = eval('(' + data + ')');

			});
		});
        
		$('#quote_create_confirm').click(function() {

			$.post("{{ route('quotes.store') }}", { 
				client_name: $('#client_name').val(), 
				created_at: $('#created_at').val(),
				invoice_group_id: $('#invoice_group_id').val()
			},
			function(data) {
				var response = JSON.parse(data);
				if (response.success == '1') {
					window.location = "{{ url('quotes') }}/" + response.id;
				}
				else {
					$('.control-group').removeClass('error');
					for (var key in response.validation_errors) {
						$('#' + key).parent().parent().addClass('error');
					}
				}
			});
		});
	});
	
</script>

<div id="create-quote" class="modal hide">
	<form class="form-horizontal">
		<div class="modal-header">
			<a data-dismiss="modal" class="close">x</a>
			<h3>{{ trans('fi.create_quote') }}</h3>
		</div>
		<div class="modal-body">

			<div class="control-group">
				<label class="control-label">{{ trans('fi.client') }}: </label>
				<div class="controls">
					{{ Form::text('client_name', null, array('id' => 'client_name', 'class' => 'client-lookup', 'style' => 'margin: 0 auto;', 'autocomplete' => 'off')) }}
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">{{ trans('fi.quote_date') }}: </label>
				<div class="controls input-append date datepicker">
					{{ Form::text('created_at', date(Config::get('fi.dateFormat')), array('id' => 'created_at', 'readonly' => 'readonly')) }}
					<span class="add-on"><i class="icon-th"></i></span>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">{{ trans('fi.invoice_group') }}: </label>
				<div class="controls">
				{{ Form::select('invoice_group_id', $invoiceGroups, Config::get('fi.quoteGroup'), array('id' => 'invoice_group_id')) }}
				</div>
			</div>

		</div>

		<div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="icon-white icon-remove"></i> {{ trans('fi.cancel') }}</button>
			<button class="btn btn-primary" id="quote_create_confirm" type="button"><i class="icon-white icon-ok"></i> {{ trans('fi.submit') }}</button>
		</div>

	</form>

</div>