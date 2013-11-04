<script type="text/javascript">
	$(function()
	{
		$('#add-quote-tax').modal('show');

		$('#btn-submit-quote-tax').click(function()
		{
			$.post("{{ route('quotes.ajax.saveQuoteTax') }}", { 
				quote_id: {{ $quote_id }},
				tax_rate_id: $('#tax_rate_id').val(),
				include_item_tax: $('#include_item_tax').val()
			},
			function(data) {
				window.location = "{{ route('quotes.show', array($quote_id)) }}";
			});
		});
	});
</script>

<div id="add-quote-tax" class="modal hide">
	<form class="form-horizontal">
		<div class="modal-header">
			<a data-dismiss="modal" class="close">×</a>
			<h3>{{ trans('fi.add_quote_tax') }}</h3>
		</div>
		<div class="modal-body">

			<div class="control-group">
				<label class="control-label">{{ trans('fi.tax_rate') }}: </label>
				<div class="controls">
					{{ Form::select('tax_rate_id', $taxRates, null, array('id' => 'tax_rate_id')) }}
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">{{ trans('fi.tax_rate_placement') }}</label>
				<div class="controls">
					<select name="include_item_tax" id="include_item_tax">
						<option value="0">{{ trans('fi.apply_before_item_tax') }}</option>
						<option value="1">{{ trans('fi.apply_after_item_tax') }}</option>
					</select>
				</div>
			</div>
			
		</div>

		<div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="icon-white icon-remove"></i> {{ trans('fi.cancel') }}</button>
			<button class="btn btn-primary" id="btn-submit-quote-tax" type="button"><i class="icon-white icon-ok"></i> {{ trans('fi.submit') }}</button>
		</div>

	</form>

</div>