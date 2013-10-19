<div class="tab-info">

	<div class="control-group">
		<label class="control-label">{{ trans('fi.language') }}: </label>
		<div class="controls">
			{{ Form::select('setting_language', $languages, Config::get('fi.language'), ['class' => 'input-small']) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.date_format') }}: </label>
		<div class="controls">
			{{ Form::select('setting_dateFormat', $dateFormats, Config::get('fi.dateFormat')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.currency_symbol') }}: </label>
		<div class="controls" style="text: bottom;">
			{{ Form::text('setting_currencySymbol', Config::get('fi.currencySymbol'), ['class' => 'input-small']) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.currency_symbol_placement') }}: </label>
		<div class="controls">
			{{ Form::select('setting_currencySymbolPlacement', $currencySymbolPlacements, Config::get('fi.currencySymbolPlacement')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.thousands_separator') }}: </label>
		<div class="controls" style="text: bottom;">
			{{ Form::text('setting_thousandsSeparator', Config::get('fi.thousandsSeparator'), ['class' => 'input-small']) }}
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label">{{ trans('fi.decimal_point') }}: </label>
		<div class="controls" style="text: bottom;">
			{{ Form::text('setting_decimalPoint', Config::get('fi.decimalPoint'), ['class' => 'input-small']) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.tax_rate_decimal_places') }}: </label>
		<div class="controls">
			{{ Form::select('setting_taxRateDecimalPlaces', $taxRateDecimalPlaces, Config::get('fi.taxRateDecimalPlaces'), ['class' => 'input-small']) }}
		</div>
	</div>
	
</div>