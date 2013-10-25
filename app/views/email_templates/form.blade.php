@extends('layouts.master')

@section('content')

<script type="text/javascript">
$(function() {
   $('#name').focus(); 
});
</script>

@if ($edit_mode == true)
{{ Form::model($emailTemplate, array('route' => array('emailTemplates.update', $emailTemplate->id), 'class' => 'form-horizontal')) }}
@else
{{ Form::open(array('route' => 'emailTemplates.store', 'class' => 'form-horizontal')) }}
@endif

<div class="headerbar">
	<h1>{{ trans('fi.email_template_form') }}</h1>
	@include('layouts._header_buttons')
</div>

<div class="content">

	@include('layouts._alerts')

	<div class="control-group">
		<label class="control-label">{{ trans('fi.name') }}: </label>
		<div class="controls">
			{{ Form::text('name', null, array('id' => 'name')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.subject') }}: </label>
		<div class="controls">
			{{ Form::text('subject', null, array('id' => 'subject')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.body') }}: </label>
		<div class="controls">
			{{ Form::textarea('body', null, array('id' => 'email_template_body', 'style' => 'height: 200px;', 'class' => 'span8')) }}
		</div>
	</div>

	<div class="row show-grid">
	    <h4 class="span8 offset2">{{ trans('fi.email_template_tags') }}</h4><br><br>
	</div>
	<div class="row show-grid">

	    <div class="span2 offset2">
	        <strong>{{ trans('fi.client') }}</strong><br>
	        <a href="#" class="text-tag" data-tag="{client_name}">{{ trans('fi.client_name') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{client_address_1}">{{ trans('fi.client') }} {{ trans('fi.address') }} 1</a><br>
	        <a href="#" class="text-tag" data-tag="{client_address_2}">{{ trans('fi.client') }} {{ trans('fi.address') }} 2</a><br>
	        <a href="#" class="text-tag" data-tag="{client_city}">{{ trans('fi.client') }} {{ trans('fi.city') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{client_state}">{{ trans('fi.client') }} {{ trans('fi.state') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{client_zip}">{{ trans('fi.client') }} {{ trans('fi.zip_code') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{client_country}">{{ trans('fi.client') }} {{ trans('fi.country') }}</a><br>
	    </div>

	    <div class="span2">
	        <strong>{{ trans('fi.user') }}</strong><br>
	        <a href="#" class="text-tag" data-tag="{user_name}">{{ trans('fi.user') }} {{ trans('fi.name') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_company}">{{ trans('fi.user') }} {{ trans('fi.company') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_address_1}">{{ trans('fi.user') }} {{ trans('fi.address') }} 1</a><br>
	        <a href="#" class="text-tag" data-tag="{user_address_2}">{{ trans('fi.user') }} {{ trans('fi.address') }} 2</a><br>
	        <a href="#" class="text-tag" data-tag="{user_city}">{{ trans('fi.user') }} {{ trans('fi.city') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_state}">{{ trans('fi.user') }} {{ trans('fi.state') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_zip}">{{ trans('fi.user') }} {{ trans('fi.zip_code') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_country}">{{ trans('fi.user') }} {{ trans('fi.country') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_phone}">{{ trans('fi.user') }} {{ trans('fi.phone') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_fax}">{{ trans('fi.user') }} {{ trans('fi.fax') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_mobile}">{{ trans('fi.user') }} {{ trans('fi.mobile') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_email}">{{ trans('fi.user') }} {{ trans('fi.email') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{user_web}">{{ trans('fi.user') }} {{ trans('fi.web_address') }}</a><br>
	    </div>

	    <div class="span2">
	        <strong>{{ trans('fi.invoices') }}</strong><br>
	        <a href="#" class="text-tag" data-tag="{invoice_guest_url}">{{ trans('fi.invoice') }} {{ trans('fi.guest_url') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{invoice_number}">{{ trans('fi.invoice') }} {{ trans('fi.id') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{invoice_date_due}">{{ trans('fi.invoice') }} {{ trans('fi.due_date') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{invoice_date_created}">{{ trans('fi.invoice') }} {{ trans('fi.created') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{invoice_terms}">{{ trans('fi.invoice_terms') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{invoice_total}">{{ trans('fi.invoice') }} {{ trans('fi.total') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{invoice_paid}">{{ trans('fi.invoice') }} {{ trans('fi.total_paid') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{invoice_balance}">{{ trans('fi.invoice') }} {{ trans('fi.balance') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{invoice_status}">{{ trans('fi.invoice') }} {{ trans('fi.status') }}</a><br>
	    </div>

	    <div class="span2">
	        <strong>{{ trans('fi.quotes') }}</strong><br>
	        <a href="#" class="text-tag" data-tag="{quote_total}">{{ trans('fi.quote') }} {{ trans('fi.total') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{quote_date_created}">{{ trans('fi.quote_date') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{quote_date_expires}">{{ trans('fi.quote') }} {{ trans('fi.expires') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{quote_number}">{{ trans('fi.quote') }} {{ trans('fi.id') }}</a><br>
	        <a href="#" class="text-tag" data-tag="{quote_guest_url}">{{ trans('fi.quote') }} {{ trans('fi.guest_url') }}</a><br>
	    </div>
	</div>

</div>

{{ Form::close() }}

@stop