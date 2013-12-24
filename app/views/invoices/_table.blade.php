<table class="table table-striped">

	<thead>
		<tr>
			<th>{{ trans('fi.status') }}</th>
			<th>{{ trans('fi.invoice') }}</th>
			<th>{{ trans('fi.created') }}</th>
			<th>{{ trans('fi.due_date') }}</th>
			<th>{{ trans('fi.client_name') }}</th>
			<th style="text-align: right;">{{ trans('fi.total') }}</th>
			<th style="text-align: right; padding-right: 25px;">{{ trans('fi.balance') }}</th>
			<th>{{ trans('fi.options') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($invoices as $invoice)
		<tr>
			<td>
                <span class="label {{ $statuses[$invoice->invoice_status_id]['status'] }}">{{ $statuses[$invoice->invoice_status_id]['label'] }}</span>
			</td>
			<td><a href="#" title="{{ trans('fi.edit') }}">{{ $invoice->number }}</a></td>
			<td>{{ $invoice->formatted_created_at }}</td>
			<td><span class="@if ($invoice->is_overdue) font-overdue @endif">{{ $invoice->formatted_due_at }}</span></td>
			<td><a href="{{ route('clients.show', array($invoice->client->id)) }}" title="{{ trans('fi.view_client') }}">{{ $invoice->client->name }}</a></td>
			<td style="text-align: right;">{{ $invoice->amount->formatted_total }}</td>
			<td style="text-align: right; padding-right: 25px;">{{ $invoice->amount->formatted_balance }}</td>
			<td>
				<div class="options btn-group">
					<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ route('invoices.show', array($invoice->id)) }}">
								<i class="icon-pencil"></i> {{ trans('fi.edit') }}
							</a>
						</li>
						<li>
							<a href="{{ route('invoices.preview', array($invoice->id)) }}" target="_blank">
								<i class="icon-file-alt"></i> {{ trans('fi.view_invoice') }}
							</a>
						</li>
						<li>
							<a href="#">
								<i class="icon-envelope"></i> {{ trans('fi.send_email') }}
							</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="enter-payment" data-invoice-id="{{ $invoice->id }}" data-invoice-balance="{{ $invoice->amount->formatted_numeric_balance }}">
							<i class="icon-shopping-cart"></i> {{ trans('fi.enter_payment') }}
						</li>
						<li>
							<a href="{{ route('invoices.delete', array($invoice->id)) }}" onclick="return confirm('{{ trans('fi.delete_invoice_warning') }}');">
								<i class="icon-trash"></i> {{ trans('fi.delete') }}
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>

</table>