<table class="table table-striped">
	<thead>
		<tr>
			<th>{{ trans('fi.client') }}</th>
			@foreach ($months as $month)
			<th>{{ $month }}</th>
			@endforeach
			<th>{{ trans('fi.total') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($results as $client=>$amounts)
		<tr>
			<td>{{ $client }}</td>
			@foreach (array_keys($months) as $monthKey)
			<td>{{ $amounts['months'][$monthKey] }}</td>
			@endforeach
			<td>{{ $amounts['total'] }}</td>
			@endforeach
		</tr>
	</tbody>
</table>