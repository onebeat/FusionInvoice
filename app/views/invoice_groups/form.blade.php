@extends('layouts.master')

@section('content')

<script type="text/javascript">
$(function() {
   $('#name').focus(); 
});
</script>

@if ($editMode == true)
{{ Form::model($invoiceGroup, array('route' => array('invoiceGroups.update', $invoiceGroup->id), 'class' => 'form-horizontal')) }}
@else
{{ Form::open(array('route' => 'invoiceGroups.store', 'class' => 'form-horizontal')) }}
@endif

<div class="headerbar">
	<h1>{{ trans('fi.invoice_group_form') }}</h1>
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
		<label class="control-label">{{ trans('fi.next_id') }}: </label>
		<div class="controls">
			{{ Form::text('next_id', isset($invoiceGroup->next_id) ? $invoiceGroup->next_id : 0, array('id' => 'next_id')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.left_pad') }}: </label>
		<div class="controls">
			{{ Form::text('left_pad', isset($invoiceGroup->left_pad) ? $invoiceGroup->left_pad : 0, array('id' => 'left_pad')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.prefix') }}: </label>
		<div class="controls">
			{{ Form::text('prefix', null, array('id' => 'prefix')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.year_prefix') }}: </label>
		<div class="controls">
			{{ Form::select('prefix_year', array('0' => trans('fi.no'), '1' => trans('fi.yes'))) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.month_prefix') }}: </label>
		<div class="controls">
			{{ Form::select('prefix_month', array('0' => trans('fi.no'), '1' => trans('fi.yes'))) }}
		</div>
	</div>

</div>

@stop