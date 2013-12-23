@extends('layouts.master')

@section('content')

<script type="text/javascript">
$(function() {
   $('#name').focus(); 
});
</script>

@if ($editMode == true)
{{ Form::model($customField, array('route' => array('customFields.update', $customField->id), 'class' => 'form-horizontal')) }}
@else
{{ Form::open(array('route' => 'customFields.store', 'class' => 'form-horizontal')) }}
@endif

<div class="headerbar">
	<h1>{{ trans('fi.custom_field_form') }}</h1>
	@include('layouts._header_buttons')
</div>

<div class="content">

	@include('layouts._alerts')

	<div class="control-group">
		<label class="control-label">{{ trans('fi.table_name') }}: </label>
		<div class="controls">
			@if ($editMode == true)
			{{ Form::text('table_name', $tableNames[$customField->table_name], array('readonly' => 'readonly')) }}
			@else
			{{ Form::select('table_name', $tableNames) }}
			@endif
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.field_label') }}: </label>
		<div class="controls">
			{{ Form::text('field_label') }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.field_type') }}: </label>
		<div class="controls">
			{{ Form::select('field_type', $fieldTypes) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.field_meta') }}: </label>
		<div class="controls">
			{{ Form::text('field_meta') }}
			<span class="help-block">{{ trans('fi.field_meta_description') }}</span>
		</div>
	</div>

</div>

{{ Form::close() }}

@stop