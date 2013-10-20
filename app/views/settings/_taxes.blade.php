<div class="tab-info">

	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_invoice_tax_rate') }}: </label>
		<div class="controls">
			{{ Form::select('setting_invoiceTaxRate', $taxRates, Config::get('fi.invoiceTaxRate')) }}
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_invoice_tax_rate_placement') }}: </label>
		<div class="controls">
			{{ Form::select('setting_includeItemTax', ['0' => trans('fi.no'), '1' => trans('fi.yes')], Config::get('fi.includeItemTax')) }}
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_item_tax_rate') }}: </label>
		<div class="controls">
			{{ Form::select('setting_itemTaxRate', $taxRates, Config::get('fi.itemTaxRate')) }}
		</div>
	</div>

</div>