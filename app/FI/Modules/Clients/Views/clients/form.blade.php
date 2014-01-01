@extends('layouts.master')

@section('content')

<script type="text/javascript">
    $(function() {
     $('#name').focus(); 
 });
</script>

@if ($editMode == true)
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
            	{{ Form::text('name', null, array('id' => 'name')) }}
            </div>
        </div>

    </fieldset>
    
    <div class="row-fluid">

        <div class="span6">
            <fieldset>
                <legend>{{ trans('fi.address') }}</legend>

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
            </fieldset>
        </div>
        
        <div class="span6">
            <fieldset>

                <legend>{{ trans('fi.contact_information') }}</legend>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.phone_number') }}: </label>
                    <div class="controls">
                        {{ Form::text('phone', null, array('id' => 'phone')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.fax_number') }}: </label>
                    <div class="controls">
                        {{ Form::text('fax', null, array('id' => 'fax')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.mobile_number') }}: </label>
                    <div class="controls">
                        {{ Form::text('mobile', null, array('id' => 'mobile')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.email_address') }}: </label>
                    <div class="controls">
                        {{ Form::text('email', null, array('id' => 'email')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">{{ trans('fi.web_address') }}: </label>
                    <div class="controls">
                        {{ Form::text('web', null, array('id' => 'web')) }}
                    </div>
                </div>

            </fieldset>                
        </div>
        
    </div>

    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend>{{ trans('fi.custom_fields') }}</legend>
                @include('custom_fields._custom_fields');
            </fieldset>
        </div>
    </div>

</div>

{{ Form::close() }}

@stop