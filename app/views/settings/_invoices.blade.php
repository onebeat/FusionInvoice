<div class="tab-info">

	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_invoice_template') }}: </label>
		<div class="controls">
			{{ Form::select('setting_invoiceTemplate', $invoiceTemplates, Config::get('fi.invoiceTemplate')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_email_template') }}: </label>
		<div class="controls">
			{{ Form::select('setting_invoiceEmailTemplate', $emailTemplates, Config::get('fi.invoiceEmailTemplate')) }}
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label">{{ trans('fi.email_template_paid') }}: </label>
		<div class="controls">
			{{ Form::select('setting_invoiceEmailTemplatePaid', $emailTemplates, Config::get('fi.invoiceEmailTemplatePaid')) }}
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label">{{ trans('fi.email_template_overdue') }}: </label>
		<div class="controls">
			{{ Form::select('setting_invoiceEmailTemplateOverdue', $emailTemplates, Config::get('fi.invoiceEmailTemplateOverdue')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.invoices_due_after') }}: </label>
		<div class="controls">
			{{ Form::text('setting_invoicesDueAfter', Config::get('fi.invoicesDueAfter'), array('class' => 'input-small')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_invoice_group') }}: </label>
		<div class="controls">
			{{ Form::select('setting_invoiceGroup', $invoiceGroups, Config::get('fi.invoiceGroup')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.default_terms') }}: </label>
		<div class="controls">
			{{ Form::textarea('setting_invoiceTerms', Config::get('fi.invoiceTerms'), array('style' => 'width: 400px; height: 150px;')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.invoice_logo') }}: </label>
		<div class="controls">
			{{ Form::file('invoice_logo') }}
		</div>
	</div>	

	<div class="control-group">
		<label class="control-label">{{ trans('fi.automatic_email_on_recur') }}: </label>
		<div class="controls">
			{{ Form::select('setting_automaticEmailOnRecur', array('0' => trans('fi.no'), '1' => trans('fi.yes')), Config::get('fi.automaticEmailOnRecur')) }}
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label">{{ trans('fi.mark_invoices_sent_pdf') }}: </label>
		<div class="controls">
			{{ Form::select('setting_markInvoicesSentPdf', array('0' => trans('fi.no'), '1' => trans('fi.yes')), Config::get('fi.markInvoicesSentPdf')) }}
		</div>
	</div>

</div>