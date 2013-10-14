@extends('layouts.master')

@section('content')

<script type="text/javascript">
$(function() {
   $('#client_name').focus(); 
});
</script>

@if ($edit_mode == true)
{{ Form::model($client, array('route' => array('clients.update', $client->id), 'class' => 'form-horizontal')) }}
@else
{{ Form::open(array('route' => 'clients.store', 'class' => 'form-horizontal')) }}
@endif

<div class="headerbar">
	<h1>{{ trans('fi.client_form') }}</h1>
	@include('layouts._header_buttons')
</div>

<div class="content">

	@include('layouts._alerts')

    <fieldset>
        <legend>{{ trans('fi.personal_information') }}</legend>

        <div class="control-group">
            <label class="control-label">{{ trans('fi.active_client') }}: </label>
            <div class="controls">
                {{ Form::hidden('active', 0) }}
            	{{ Form::checkbox('active', 1, true) }}
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">* {{ trans('fi.client_name') }}: </label>
            <div class="controls">
            	{{ Form::text('name') }}
            </div>
        </div>

    </fieldset>
    
    <div class="row-fluid">
        
        <div class="span6">
            <fieldset>
                <legend>{{ trans('fi.address') }}</legend>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.street_address') }}: </label>
                    <div class="controls">
                        {{ Form::text('address_1') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.street_address_2') }}: </label>
                    <div class="controls">
                        {{ Form::text('address_2') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.city') }}: </label>
                    <div class="controls">
                        {{ Form::text('city') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.state') }}: </label>
                    <div class="controls">
                        {{ Form::text('state') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.zip_code') }}: </label>
                    <div class="controls">
                        {{ Form::text('zip') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.country') }}: </label>
                    <div class="controls">
                        {{ Form::text('country') }}
                    </div>
                </div>
            </fieldset>
        </div>
        
        <div class="span6">
            <fieldset>

                <legend>{{ trans('fi.contact_information') }}</legend>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.phone_number') }}: </label>
                    <div class="controls">
                        {{ Form::text('phone') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.fax_number') }}: </label>
                    <div class="controls">
                        {{ Form::text('fax') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.mobile_number') }}: </label>
                    <div class="controls">
                        {{ Form::text('mobile') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.email_address') }}: </label>
                    <div class="controls">
                        {{ Form::text('email') }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.web_address') }}: </label>
                    <div class="controls">
                        {{ Form::text('web') }}
                    </div>
                </div>

            </fieldset>                
        </div>
        
    </div>

</div>

{{ Form::close() }}

@stop