<div class="tab-info">

	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_quote_template') }}: </label>
		<div class="controls">
			{{ Form::select('setting_quoteTemplate', $quoteTemplates, Config::get('fi.quoteTemplate')) }}
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_email_template') }}: </label>
		<div class="controls">
			{{ Form::select('setting_quoteEmailTemplate', $emailTemplates, Config::get('fi.quoteEmailTemplate')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.quotes_expire_after') }}: </label>
		<div class="controls">
			{{ Form::text('setting_quotesExpireAfter', Config::get('fi.quotesExpireAfter'), array('class' => 'input-small')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_quote_group') }}: </label>
		<div class="controls">
			{{ Form::select('setting_quoteGroup', $invoiceGroups, Config::get('fi.quoteGroup')) }}
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label">{{ trans('fi.mark_quotes_sent_pdf') }}: </label>
		<div class="controls">
			{{ Form::select('setting_markQuotesSentPdf', array('0' => trans('fi.no'), '1' => trans('fi.yes')), Config::get('fi.markQuotesSentPdf')) }}
		</div>
	</div>

</div>