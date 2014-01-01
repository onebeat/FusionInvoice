@extends('layouts.master')

@section('content')

{{ Form::model($payment, array('route' => array('payments.update', $payment->id, $payment->invoice_id), 'class' => 'form-horizontal')) }}

{{ Form::hidden('invoice_id') }}

<div class="headerbar">
	<h1>{{ trans('fi.payment_form') }} - {{ trans('fi.invoice') . ' #' . $invoice->number . ' - ' . trans('fi.balance') . ': ' . $invoice->amount->formatted_balance }}</h1>
	@include('layouts._header_buttons')
</div>

<div class="content">

	@include('layouts._alerts')

	<div class="control-group">
		<label class="control-label">{{ trans('fi.date') }}: </label>
		<div class="controls input-append date datepicker">
			{{ Form::text('paid_at', $payment->formatted_paid_at) }}
			<span class="add-on"><i class="icon-th"></i></span>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.amount') }}: </label>
		<div class="controls">
			{{ Form::text('amount', $payment->formatted_numeric_amount) }}
		</div>
	</div>

	<div class="control-group">

		<label class="control-label">{{ trans('fi.payment_method') }}: </label>
		<div class="controls">
			{{ Form::select('payment_method_id', $paymentMethods) }}
		</div>
	</div>

	<div class="control-group">

		<label class="control-label">{{ trans('fi.note') }}: </label>
		<div class="controls">
			{{ Form::textarea('note', null, array('rows' => 5)) }}
		</div>

	</div>

    <div class="row-fluid">
        <div class="span12">
 			@include('custom_fields._custom_fields');
        </div>
    </div>

</div>

{{ Form::close() }}

@stop