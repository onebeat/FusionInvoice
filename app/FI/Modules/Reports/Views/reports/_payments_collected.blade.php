<table class="table table-striped">
	<thead>
		<tr>
			<th style="width: 50%;">{{ trans('fi.client') }}</th>
			<th style="width: 10%;">{{ trans('fi.invoice') }}</th>
			<th style="width: 10%;">{{ trans('fi.payment_method') }}</th>
			<th style="width: 10%;">{{ trans('fi.note') }}</th>
			<th style="width: 10%;">{{ trans('fi.date') }}</th>
			<th style="width: 10%; text-align: right;">{{ trans('fi.amount') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($results['payments'] as $payment)
		<tr>
			<td>{{ $payment['client_name'] }}</td>
			<td>{{ $payment['invoice_number'] }}</td>
			<td>{{ $payment['payment_method'] }}</td>
			<td>{{ $payment['note'] }}</td>
			<td>{{ $payment['date'] }}</td>
			<td style="text-align: right;">{{ $payment['amount'] }}</td>
		</tr>
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="text-align: right;"><strong>{{ trans('fi.total') }}</strong></td>
			<td style="text-align: right;"><strong>{{ $results['total'] }}</strong></td>
		</tr>
	</tbody>
</table>