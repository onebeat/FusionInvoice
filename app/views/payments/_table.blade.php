<table class="table table-striped">

	<thead>
		<tr>
			<th>{{ trans('fi.payment_date') }}</th>
            <th>{{ trans('fi.invoice_date') }}</th>
			<th>{{ trans('fi.invoice') }}</th>
            <th>{{ trans('fi.client') }}</th>
			<th>{{ trans('fi.amount') }}</th>
			<th>{{ trans('fi.payment_method') }}</th>
			<th>{{ trans('fi.note') }}</th>
			<th>{{ trans('fi.options') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($payments as $payment)
		<tr>
			<td>{{ $payment->formatted_paid_at }}</td>
            <td>{{ $payment->invoice->formatted_created_at }}</td>
			<td>{{ $payment->invoice->number }}</td>
            <td>{{ $payment->invoice->client->name }}</td>
			<td>{{ $payment->formatted_amount }}</td>
			<td>{{ $payment->paymentMethod->name }}</td>
			<td>{{ $payment->note }}</td>
			<td>
				<div class="options btn-group">
					<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ route('payments.edit', array($payment->id, $payment->invoice_id)) }}">
								<i class="icon-pencil"></i> {{ trans('fi.edit') }}
							</a>
						</li>
						<li>
							<a href="{{ route('payments.delete', array($payment->id, $payment->invoice_id)) }}" onclick="return confirm('{{ trans('fi.delete_record_warning') }}');">
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