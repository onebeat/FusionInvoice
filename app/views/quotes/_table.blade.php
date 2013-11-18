<table class="table table-striped">

	<thead>
		<tr>
			<th>{{ trans('fi.status') }}</th>
			<th>{{ trans('fi.quote') }}</th>
			<th>{{ trans('fi.created') }}</th>
			<th>{{ trans('fi.expires') }}</th>
			<th>{{ trans('fi.client_name') }}</th>
			<th style="text-align: right; padding-right: 25px;">{{ trans('fi.amount') }}</th>
			<th>{{ trans('fi.options') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($quotes as $quote)
		<tr>
			<td>
                <span class="label {{ $statuses[$quote->quote_status_id]['status'] }}">{{ $statuses[$quote->quote_status_id]['label'] }}</span>
			</td>
			<td><a href="#" title="{{ trans('fi.edit') }}">{{ $quote->number }}</a></td>
			<td>{{ $quote->formatted_created_at }}</td>
			<td>{{ $quote->formatted_expires_at }}</td>
			<td><a href="{{ route('clients.show', array($quote->client->id)) }}" title="{{ trans('fi.view_client') }}">{{ $quote->client->name }}</a></td>
			<td style="text-align: right; padding-right: 25px;">{{ $quote->amount->formatted_total }}</td>
			<td>
				<div class="options btn-group">
					<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ route('quotes.show', array($quote->id)) }}">
								<i class="icon-pencil"></i> {{ trans('fi.edit') }}
							</a>
						</li>
						<li>
							<a href="{{ route('quotes.preview', array($quote->id)) }}" target="_blank">
								<i class="icon-file-alt"></i> {{ trans('fi.view_quote') }}
							</a>
						</li>
						<li>
							<a href="#">
								<i class="icon-envelope"></i> {{ trans('fi.send_email') }}
							</a>
						</li>
						<li>
							<a href="{{ route('quotes.delete', array($quote->id)) }}" onclick="return confirm('{{ trans('fi.delete_quote_warning') }}');">
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