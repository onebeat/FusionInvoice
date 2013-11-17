@extends('layouts.master')

@section('content')

<script type="text/javascript">
	$(function() {
		$('#name').focus(); 
	});
</script>

@if ($edit_mode == true)
{{ Form::model($user, array('route' => array('users.update', $user->id), 'class' => 'form-horizontal')) }}
@else
{{ Form::open(array('route' => 'users.store', 'class' => 'form-horizontal')) }}
@endif

<div class="headerbar">
	<h1>{{ trans('fi.user_form') }}</h1>
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
		<label class="control-label">{{ trans('fi.email') }}: </label>
		<div class="controls">
			{{ Form::text('email', null, array('id' => 'email')) }}
		</div>
	</div>

	@if (!$edit_mode)
	<div class="control-group">
		<label class="control-label">{{ trans('fi.password') }}: </label>
		<div class="controls">
			{{ Form::password('password', array('id' => 'password')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.password_confirmation') }}: </label>
		<div class="controls">
			{{ Form::password('password_confirmation', array('id' => 'password_confirmation')) }}
		</div>
	</div>
	@endif

	<div class="control-group">
		<label class="control-label">{{ trans('fi.company') }}: </label>
		<div class="controls">
			{{ Form::text('company', null, array('id' => 'company')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.address') }}: </label>
		<div class="controls">
			{{ Form::text('address_1', null, array('id' => 'address_1')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.address_2') }}: </label>
		<div class="controls">
			{{ Form::text('address_2', null, array('id' => 'address_2')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.city') }}: </label>
		<div class="controls">
			{{ Form::text('city', null, array('id' => 'city')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.state') }}: </label>
		<div class="controls">
			{{ Form::text('state', null, array('id' => 'state')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.zip_code') }}: </label>
		<div class="controls">
			{{ Form::text('zip', null, array('id' => 'zip')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.country') }}: </label>
		<div class="controls">
			{{ Form::text('country', null, array('id' => 'country')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.phone') }}: </label>
		<div class="controls">
			{{ Form::text('phone', null, array('id' => 'phone')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.fax') }}: </label>
		<div class="controls">
			{{ Form::text('fax', null, array('id' => 'fax')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.mobile') }}: </label>
		<div class="controls">
			{{ Form::text('mobile', null, array('id' => 'mobile')) }}
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">{{ trans('fi.web') }}: </label>
		<div class="controls">
			{{ Form::text('web', null, array('id' => 'web')) }}
		</div>
	</div>

</div>

{{ Form::close() }}

@stop