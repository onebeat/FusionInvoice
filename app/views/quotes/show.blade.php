@extends('layouts.master')

@section('content')

<script type="text/javascript">

    $(function() {

        $('#btn-add-item-from-lookup').click(function() {
            $('#modal-placeholder').load("{{ route('quotes.ajax.modalAddLookupItem') }}");
        });

        $('#btn-add-quote-tax').click(function() {
            $('#modal-placeholder').load("{{ route('quotes.ajax.modalAddQuoteTax') }}", { quote_id: {{ $quote->id }} });
        });

        $('#btn-add-item').click(function() {
            $('#new-item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
        });

        <?php if (!count($quote->items)) { ?>
            $('#new-item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
        <?php } ?>

        $('#btn-save-quote').click(function() {
            var items = [];
			var item_order = 1;
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
            $.post("{{ route('quotes.update', array($quote->id)) }}", {
                number: $('#number').val(),
                created_at: $('#created_at').val(),
                expires_at: $('#expires_at').val(),
                quote_status_id: $('#quote_status_id').val(),
                items: JSON.stringify(items)
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

        $("#item_table tbody").sortable({
            helper: fixHelper
        });

    });

</script>

<div class="headerbar">
	<h1>{{ trans('fi.quote') }} #{{ $quote->number }}</h1>

	<div class="pull-right">

		<div class="options btn-group pull-left">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" style="margin-right: 5px;"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
			<ul class="dropdown-menu">
				<li><a href="javascript:void(0)" id="btn-add-quote-tax"><i class="icon-plus-sign"></i> {{ trans('fi.add_quote_tax') }}</a></li>
				<li><a href="{{ route('quotes.preview', array($quote->id)) }}" id="btn-view-quote" target="_blank"><i class="icon-file-alt"></i> {{ trans('fi.view_quote') }}</a></li>
				<li><a href="javascript:void(0)"><i class="icon-envelope"></i> {{ trans('fi.send_email') }}</a></li>
                <li><a href="javascript:void(0)" id="btn_quote_to_invoice" data-quote-id="{{ $quote->id }}"><i class="icon-upload"></i> {{ trans('fi.quote_to_invoice') }}</a></li>
				<li><a href="javascript:void(0)" id="btn_copy_quote" data-quote-id="{{ $quote->id }}"><i class="icon-repeat"></i> {{ trans('fi.copy_quote') }}</a></li>
				<li><a href="#delete-quote" data-toggle="modal"><i class="icon-remove"></i> {{ trans('fi.delete') }}</a></li>
			</ul>
		</div>
		
		<a href="javascript:void(0)" class="btn" id="btn-add-item" style="margin-right: 5px;"><i class="icon-plus-sign"></i> {{ trans('fi.add_item') }}</a>
        <a href="javascript:void(0)" class="btn" id="btn-add-item-from-lookup" style="margin-right: 5px;"><i class="icon-plus-sign"></i> {{ trans('fi.add_item_from_lookup') }}</a>
		
		<a href="javascript:void(0)" class="btn btn-primary" id="btn-save-quote"><i class="icon-ok icon-white"></i> {{ trans('fi.save') }}</a>
	</div>

</div>

<div class="content">
    
    @include('layouts._alerts')

    {{ Form::open(array('route' => array('quotes.update', $quote->id), 'class' => 'form-horizontal', 'id' => 'form-quote')) }}

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
            
		</div>
		
	{{ Form::close() }}

</div>

@stop