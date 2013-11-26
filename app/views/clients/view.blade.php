@extends('layouts.master')

@section('content')

<script type="text/javascript">
	$(function() {

		$('#save_client_note').click(function()
		{
			$.post("{{ route('clients.ajax.saveNote') }}",
			{
				client_id: $('#client_id').val(),
				client_note: $('#client_note').val()
			}, function(data) {
				var response = JSON.parse(data);
				if (response.success == '1')
				{
					// The validation was successful
					$('.control-group').removeClass('error');
					$('#client_note').val('');

					$('#notes_list').load("{{ route('clients.ajax.loadNotes') }}",
					{
						client_id: {{ $client->id }}
					});
				}
				else
				{
					// The validation was not successful
					$('.control-group').removeClass('error');
					for (var key in response.validation_errors) {
						$('#' + key).parent().parent().addClass('error');
					}
				}
			});
		});

	});
</script>

<div class="headerbar">

	<h1>{{ $client->name }}</h1>

	<div class="pull-right">
		<a href="#" class="btn client-create-quote" data-client-name="{{ $client->name }}"><i class="icon-plus-sign"></i> {{ trans('fi.create_quote') }}</a>
		<a href="#" class="btn client-create-invoice" data-client-name="{{ $client->name }}"><i class="icon-plus"></i> {{ trans('fi.create_invoice') }}</a>
		<a href="{{ route('clients.edit', array($client->id)) }}" class="btn"><i class="icon-pencil"></i> {{ trans('fi.edit') }}</a>
		<a class="btn btn-danger" href="{{ route('clients.delete', array($client->id)) }}" onclick="return confirm('{{ trans('fi.delete_client_warning') }}');"><i class="icon-remove"></i> {{ trans('fi.delete') }}</a>
	</div>

</div>

<div class="tabbable tabs-below">

	<div class="tab-content">
		
		<div id="clientDetails" class="tab-pane tab-info active">
            
			<div class="profile">

				<div class="primaryInfo row">

					<div class="pull-left">
						<h2>{{ $client->name }}</h2>
						<br>
						<span>
							{{ ($client->address_1) ? $client->address_1 . '<br>' : '' }}
							{{ ($client->address_2) ? $client->address_2 . '<br>' : '' }}
							{{ ($client->city) ? $client->city : '' }}
							{{ ($client->state) ? $client->state : '' }}
							{{ ($client->zip) ? $client->zip : '' }}
							{{ ($client->country) ? '<br>' . $client->country : '' }}
						</span>
					</div>

					<div class="pull-right" style="text-align: right;">
						<span><strong>{{ trans('fi.total_billed') }}:</strong> {{ $client->formatted_total }}</span><br>
						<span><strong>{{ trans('fi.total_paid') }}:</strong> {{ $client->formatted_paid }}</span><br>
						<span><strong>{{ trans('fi.total_balance') }}:</strong> {{ $client->formatted_balance }}</span>
					</div>

				</div>

				<dl>
					<dt><span>{{ trans('fi.contact_information') }}</span></dt>
					@if ($client->email)
					<dd><span>{{ trans('fi.email') }}:</span> {{ $client->email }}</dd>
					@endif
					@if ($client->phone)
					<dd><span>{{ trans('fi.phone') }}:</span> {{ $client->phone }}</dd>
					@endif
					@if ($client->mobile)
					<dd><span>{{ trans('fi.mobile') }}:</span> {{ $client->mobile }}</dd>
					@endif
					@if ($client->fax)
					<dd><span>{{ trans('fi.fax') }}:</span> {{ $client->fax }}</dd>
					@endif
					@if ($client->web)
					<dd><span>{{ trans('fi.web') }}:</span> {{ $client->web }}</dd>
					@endif
				</dl>

			</div>

			<div class="notes">

				<div id="notes_list">
					@TODO - DISPLAY NOTES
				</div>
                
				<form>
					<input type="hidden" name="client_id" id="client_id" value="{{ $client->id }}">
					<fieldset>

						<legend>{{ trans('fi.notes') }}</legend>
						<div class="control-group">
							<div class="controls">
								<textarea id="client_note"></textarea>
							</div>
						</div>

						<input type="button" id="save_client_note" class="btn btn-primary" value="{{ trans('fi.add_notes') }}">
					</fieldset>
				</form>

			</div>
		</div>

		<div id="clientQuotes" class="tab-pane">
			@TODO - INCLUDE QUOTE TABLE
		</div>

		<div id="clientInvoices" class="tab-pane">
			@TODO - INCLUDE INVOICE TABLE
		</div>

	</div>

	<ul class="nav-tabs">
		<li class="active"><a data-toggle="tab" href="#clientDetails">{{ trans('fi.details') }}</a></li>
		<li><a data-toggle="tab" href="#clientQuotes">{{ trans('fi.quotes') }}</a></li>
		<li><a data-toggle="tab" href="#clientInvoices">{{ trans('fi.invoices') }}</a></li>
	</ul>


</div>

@stop