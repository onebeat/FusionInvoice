@extends('layouts.master')

@section('jscript')

<script type="text/javascript">

    $(function() {

        $('#btn-add-item-from-lookup').click(function() {
            $('#modal-placeholder').load("{{ route('itemLookups.ajax.modalAddLookupItem') }}");
        });

        $('#btn-add-quote-tax').click(function() {
            $('#modal-placeholder').load("{{ route('quotes.ajax.modalAddQuoteTax') }}", { quote_id: {{ $quote->id }} });
        });

        $('#btn-add-item').click(function() {
            $('#new-item').clone().appendTo('#item-table').removeAttr('id').addClass('item').show();
        });

        <?php if (!count($quote->items)) { ?>
            $('#new-item').clone().appendTo('#item-table').removeAttr('id').addClass('item').show();
        <?php } ?>

        $('#btn-save-quote').click(function() {
            var items = [];
            var item_order = 1;
            var custom_fields = {};
            $('table tr.item').each(function() {
                var row = {};
                $(this).find('input,select,textarea').each(function() {
                    if ($(this).is(':checkbox')) {
                        if ($(this).is(':checked')) {
                            row[$(this).attr('name')] = 1;
                        }
                        else {
                            row[$(this).attr('name')] = 0;
                        }
                    } 
                    else {
                        row[$(this).attr('name')] = $(this).val();
                    }
                });
                row['item_order'] = item_order;
                item_order++;
                items.push(row);
            });

            $('.custom-form-field').each(function() {
                custom_fields[$(this).data('field-name')] = $(this).val();
            });

            $.post("{{ route('quotes.update', array($quote->id)) }}", {
                number: $('#number').val(),
                created_at: $('#created_at').val(),
                expires_at: $('#expires_at').val(),
                quote_status_id: $('#quote_status_id').val(),
                items: JSON.stringify(items),
                footer: $('#footer').val(),
                custom: JSON.stringify(custom_fields)
            },
            function(data) {
                var response = JSON.parse(data);
                if (response.success == '1') {
                    window.location = "{{ route('quotes.show', array($quote->id)) }}"
                }
                else {
                    alert(response.message);
                }
            });
        });

        $('#btn_generate_pdf').click(function() {
            window.location = '@TODO - link to generate pdf';
        });
        
        var fixHelper = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };

        $("#item-table tbody").sortable({
            helper: fixHelper
        });

    });

</script>

@include('quotes._copy_quote')

@stop

@section('content')

<div class="headerbar">
	<h1>{{ trans('fi.quote') }} #{{ $quote->number }}</h1>

	<div class="pull-right">

		<div class="options btn-group pull-left">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" style="margin-right: 5px;"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
			<ul class="dropdown-menu">
				<li><a href="javascript:void(0)" id="btn-add-quote-tax"><i class="icon-plus-sign"></i> {{ trans('fi.add_quote_tax') }}</a></li>
				<li><a href="{{ route('quotes.preview', array($quote->id)) }}" id="btn-view-quote" target="_blank"><i class="icon-file-alt"></i> {{ trans('fi.view_quote') }}</a></li>
				<li><a href="javascript:void(0)" class="mail-quote" data-quote-id="{{ $quote->id }}" data-redirect-to="{{ Request::url() }}"><i class="icon-envelope"></i> {{ trans('fi.send_email') }}</a></li>
                <li><a href="javascript:void(0)" class="quote-to-invoice" data-quote-id="{{ $quote->id }}" data-client-id="{{ $quote->client_id }}"><i class="icon-upload"></i> {{ trans('fi.quote_to_invoice') }}</a></li>
				<li><a href="javascript:void(0)" id="btn-copy-quote" data-quote-id="{{ $quote->id }}"><i class="icon-repeat"></i> {{ trans('fi.copy_quote') }}</a></li>
				<li><a href="{{ route('quotes.delete', array($quote->id)) }}" onclick="return confirm('{{ trans('fi.delete_quote_warning') }}');"><i class="icon-remove"></i> {{ trans('fi.delete') }}</a></li>
			</ul>
		</div>
		
		<a href="javascript:void(0)" class="btn" id="btn-add-item" style="margin-right: 5px;"><i class="icon-plus-sign"></i> {{ trans('fi.add_item') }}</a>
        <a href="javascript:void(0)" class="btn" id="btn-add-item-from-lookup" style="margin-right: 5px;"><i class="icon-plus-sign"></i> {{ trans('fi.add_item_from_lookup') }}</a>
		
		<a href="javascript:void(0)" class="btn btn-primary" id="btn-save-quote"><i class="icon-ok icon-white"></i> {{ trans('fi.save') }}</a>
	</div>

</div>

<div class="content">
    
    @include('layouts._alerts')

    {{ Form::model($quote, array('route' => array('quotes.update', $quote->id), 'class' => 'form-horizontal')) }}

		<div class="quote">

			<div class="cf">

				<div class="pull-left">

                    <h2><a href="{{ route('clients.show', array($quote->client->id)) }}">{{ $quote->client->name }}</a></h2><br>
					<span>
                        {{ $quote->client->address_1}}<br>
                        {{ $quote->client->address_2}}<br>
                        {{ $quote->client->city}}<br>
                        {{ $quote->client->state}}<br>
                        {{ $quote->client->zip}}<br>
                        {{ $quote->client->country}}
					</span>
					<br><br>
					<span><strong>{{ trans('fi.phone') }}:</strong> {{ $quote->client->phone }}</span><br>
					<span><strong>{{ trans('fi.email') }}:</strong> {{ $quote->client->email }}</span>

				</div>

				<table style="width: auto" class="pull-right table table-striped table-bordered">
                    
                    <tbody>
                        <tr>
                            <td>
                                <div class="control-group invoice-properties">
                                    <label class="control-label">{{ trans('fi.quote') }} #</label>
                                    <div class="controls">
                                        {{ Form::text('number', $quote->number, array('id' => 'number', 'class' => 'input-small', 'style' => 'margin: 0px;')) }}
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label">{{ trans('fi.date') }}</label>
                                    <div class="controls">
                                        {{ Form::text('created_at', $quote->formatted_created_at, array('id' => 'created_at', 'class' => 'input-small', 'style' => 'margin: 0px;')) }}
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label">{{ trans('fi.expires') }}</label>
                                    <div class="controls">
                                        {{ Form::text('expires_at', $quote->formatted_expires_at, array('id' => 'expires_at', 'class' => 'input-small', 'style' => 'margin: 0px;')) }}
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label">{{ trans('fi.status') }}</label>
                                    <div class="controls">
                                        {{ Form::select('quote_status_id', $statuses, $quote->quote_status_id, array('id' => 'quote_status_id')) }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>

				</table>

			</div>

            @include('quotes._show_item_table')

            <div class="row-fluid">

                <div class="span12">
                    <p><strong>{{ trans('fi.footer') }}</strong></p>
                    {{ Form::textarea('footer', $quote->footer, array('id' => 'footer', 'style' => 'width: 100%;')) }}
                </div>

            </div>

            <div class="row-fluid">
                <div class="span12">
                    <fieldset>
                        <legend>{{ trans('fi.custom_fields') }}</legend>
                        @include('custom_fields._custom_fields')
                    </fieldset>
                </div>
            </div>
            
		</div>
		
	{{ Form::close() }}

</div>

@stop