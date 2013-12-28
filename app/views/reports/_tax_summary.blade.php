<table class="table table-striped">

	<thead>
		<tr>
			<th style="width: 50%;">{{ trans('fi.tax_rate') }}</th>
			<th style="width: 25%; text-align: right;">{{ trans('fi.taxable_amount') }}</th>
			<th style="width: 25%; text-align: right;">{{ trans('fi.taxes') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($results as $taxRate => $result)
		<tr>
			<td>{{ $taxRate }}</td>
			<td style="text-align: right;">{{ $result['taxable_amount'] }}</td>
			<td style="text-align: right;">{{ $result['taxes'] }}</td>
		</tr>
		@endforeach
	</tbody>

</table>