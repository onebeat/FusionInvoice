@extends('layouts.master')

@section('content')

<script type="text/javascript">
$(function() {
   $('#name').focus(); 
});
</script>

@if ($edit_mode == true)
{{ Form::model($paymentMethod, array('route' => array('paymentMethods.update', $paymentMethod->id), 'class' => 'form-horizontal')) }}
@else
{{ Form::open(array('route' => 'paymentMethods.store', 'class' => 'form-horizontal')) }}
@endif

<div class="headerbar">
	<h1>{{ trans('fi.payment_method_form') }}</h1>
	@include('layouts._header_buttons')
</div>

<div class="content">

	@include('layouts._alerts')

	<div class="control-group">
		<label class="control-label">{{ trans('fi.payment_method') }}: </label>
		<div class="controls">
			{{ Form::text('name', null, ['id' => 'name']) }}
		</div>
	</div>

</div>
	
{{ Form::close() }}

@stop