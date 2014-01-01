@extends('layouts.master')

@section('content')

<script type="text/javascript">
$(function() {
   $('#name').focus(); 
});
</script>

@if ($editMode == true)
{{ Form::model($itemLookup, array('route' => array('itemLookups.update', $itemLookup->id), 'class' => 'form-horizontal')) }}
@else
{{ Form::open(array('route' => 'itemLookups.store', 'class' => 'form-horizontal')) }}
@endif

<div class="headerbar">
	<h1>{{ trans('fi.tax_rate_form') }}</h1>
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
		<label class="control-label">{{ trans('fi.description') }}: </label>
		<div class="controls">
			{{ Form::text('description', null, array('id' => 'description')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.price') }}: </label>
		<div class="controls">
			{{ Form::text('price', null, array('id' => 'price')) }}
		</div>
	</div>

</div>

{{ Form::close() }}

@stop