@extends('layouts.master')

@section('content')

<script type="text/javascript">

    $(function() {

        $('#btn-add-item-from-lookup').click(function() {
            $('#modal-placeholder').load("{{ route('itemLookups.ajax.modalAddLookupItem') }}");
        });

        $('#btn-add-invoice-tax').click(function() {
            $('#modal-placeholder').load("{{ route('invoices.ajax.modalAddInvoiceTax') }}", { invoice_id: {{ $invoice->id }} });
        });

        $('#btn-add-item').click(function() {
            $('#new-item').clone().appendTo('#item-table').removeAttr('id').addClass('item').show();
        });

        <?php if (!count($invoice->items)) { ?>
            $('#new-item').clone().appendTo('#item-table').removeAttr('id').addClass('item').show();
        <?php } ?>

        $('#btn-save-invoice').click(function() {
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
            $.post("{{ route('invoices.update', array($invoice->id)) }}", {
                number: $('#number').val(),
                created_at: $('#created_at').val(),
                due_at: $('#due_at').val(),
                invoice_status_id: $('#invoice_status_id').val(),
                items: JSON.stringify(items),
                terms: $('#terms').val(),
                footer: $('#footer').val()
            },
            function(data) {
                var response = JSON.parse(data);
                if (response.success == '1') {
                    window.location = "{{ route('invoices.show', array($invoice->id)) }}"
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

<div class="headerbar">
	<h1>{{ trans('fi.invoice') }} #{{ $invoice->number }}</h1>

	<div class="pull-right">

		<div class="options btn-group pull-left">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" style="margin-right: 5px;"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
			<ul class="dropdown-menu">
				<li><a href="javascript:void(0)" id="btn-add-invoice-tax"><i class="icon-plus-sign"></i> {{ trans('fi.add_invoice_tax') }}</a></li>
				<li><a href="{{ route('invoices.preview', array($invoice->id)) }}" id="btn-view-invoice" target="_blank"><i class="icon-file-alt"></i> {{ trans('fi.view_invoice') }}</a></li>
				<li><a href="javascript:void(0)"><i class="icon-envelope"></i> {{ trans('fi.send_email') }}</a></li>
                <li><a href="javascript:void(0)" class="enter-payment" data-invoice-id="{{ $invoice->id }}" data-invoice-balance="{{ $invoice->amount->formatted_numeric_balance }}"><i class="icon-shopping-cart"></i> {{ trans('fi.enter_payment') }}</a></li>
				<li><a href="javascript:void(0)" id="btn_copy_invoice" data-invoice-id="{{ $invoice->id }}"><i class="icon-repeat"></i> {{ trans('fi.copy_invoice') }}</a></li>
				<li><a href="{{ route('invoices.delete', array($invoice->id)) }}" onclick="return confirm('{{ trans('fi.delete_invoice_warning') }}');"><i class="icon-remove"></i> {{ trans('fi.delete') }}</a></li>
			</ul>
		</div>
		
		<a href="javascript:void(0)" class="btn" id="btn-add-item" style="margin-right: 5px;"><i class="icon-plus-sign"></i> {{ trans('fi.add_item') }}</a>
        <a href="javascript:void(0)" class="btn" id="btn-add-item-from-lookup" style="margin-right: 5px;"><i class="icon-plus-sign"></i> {{ trans('fi.add_item_from_lookup') }}</a>
		
		<a href="javascript:void(0)" class="btn btn-primary" id="btn-save-invoice"><i class="icon-ok icon-white"></i> {{ trans('fi.save') }}</a>
	</div>

</div>

<div class="content">
    
    @include('layouts._alerts')

    {{ Form::open(array('route' => array('invoices.update', $invoice->id), 'class' => 'form-horizontal', 'id' => 'form-invoice')) }}

		<div class="invoice">

			<div class="cf">

				<div class="pull-left">

                    <h2><a href="{{ route('clients.show', array($invoice->client->id)) }}">{{ $invoice->client->name }}</a></h2><br>
					<span>
                        {{ $invoice->client->address_1}}<br>
                        {{ $invoice->client->address_2}}<br>
                        {{ $invoice->client->city}}<br>
                        {{ $invoice->client->state}}<br>
                        {{ $invoice->client->zip}}<br>
                        {{ $invoice->client->country}}
					</span>
					<br><br>
					<span><strong>{{ trans('fi.phone') }}:</strong> {{ $invoice->client->phone }}</span><br>
					<span><strong>{{ trans('fi.email') }}:</strong> {{ $invoice->client->email }}</span>

				</div>

				<table style="width: auto" class="pull-right table table-striped table-bordered">
                    
                    <tbody>
                        <tr>
                            <td>
                                <div class="control-group invoice-properties">
                                    <label class="control-label">{{ trans('fi.invoice') }} #</label>
                                    <div class="controls">
                                        {{ Form::text('number', $invoice->number, array('id' => 'number', 'class' => 'input-small', 'style' => 'margin: 0px;')) }}
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label">{{ trans('fi.date') }}</label>
                                    <div class="controls">
                                        {{ Form::text('created_at', $invoice->formatted_created_at, array('id' => 'created_at', 'class' => 'input-small', 'style' => 'margin: 0px;')) }}
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label">{{ trans('fi.due_date') }}</label>
                                    <div class="controls">
                                        {{ Form::text('due_at', $invoice->formatted_due_at, array('id' => 'due_at', 'class' => 'input-small', 'style' => 'margin: 0px;')) }}
                                    </div>
                                </div>
                                <div class="control-group invoice-properties">
                                    <label class="control-label">{{ trans('fi.status') }}</label>
                                    <div class="controls">
                                        {{ Form::select('invoice_status_id', $statuses, $invoice->invoice_status_id, array('id' => 'invoice_status_id')) }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>

				</table>

			</div>

            @include('invoices._show_item_table')

            <div class="row-fluid">

                <div class="span6">
                    <p><strong>{{ trans('fi.terms') }}</strong></p>
                    {{ Form::textarea('terms', $invoice->terms, array('id' => 'terms', 'style' => 'width: 100%;')) }}
                </div>

                <div class="span6">
                    <p><strong>{{ trans('fi.footer') }}</strong></p>
                    {{ Form::textarea('footer', $invoice->footer, array('id' => 'footer', 'style' => 'width: 100%;')) }}
                </div>

            </div>
            
		</div>
		
	{{ Form::close() }}

</div>

@stop