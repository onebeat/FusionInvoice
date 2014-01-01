@foreach ($results as $key=>$items)
<h4>{{ $key }}</h4>
<table class="table table-striped">

	<thead>
		<tr>
			<th style="width: 50%;">{{ trans('fi.client') }}</th>
			<th style="width: 10%;">{{ trans('fi.invoice') }}</th>
			<th style="width: 10%;">{{ trans('fi.date') }}</th>
			<th style="width: 10%; text-align: right;">{{ trans('fi.price') }}</th>
			<th style="width: 10%; text-align: right;">{{ trans('fi.quantity') }}</th>
			<th style="width: 10%; text-align: right;">{{ trans('fi.total') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($items['items'] as $item)
		<tr>
			<td>{{ $item['client_name'] }}</td>
			<td>{{ $item['invoice_number'] }}</td>
			<td>{{ $item['date'] }}</td>
			<td style="text-align: right;">{{ $item['price'] }}</td>
			<td style="text-align: right;">{{ $item['quantity'] }}</td>
			<td style="text-align: right;">{{ $item['total'] }}</td>
		</tr>
		@endforeach
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="text-align: right;"><strong>{{ trans('fi.total') }}</strong></td>
			<td style="text-align: right;"><strong>{{ $items['totals']['quantity'] }}</strong></td>
			<td style="text-align: right;"><strong>{{ $items['totals']['total'] }}</strong></td>
		</tr>
	</tbody>

</table>
@endforeach