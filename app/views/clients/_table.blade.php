<table class="table table-striped">

	<thead>
		<tr>
			<th>{{ trans('fi.client_name') }}</th>
			<th>{{ trans('fi.email_address') }}</th>
			<th>{{ trans('fi.phone_number') }}</th>
			<th style="text-align: right;">{{ trans('fi.balance') }}</th>
			<th>{{ trans('fi.active') }}</th>
			<th>{{ trans('fi.options') }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($clients as $client)
		<tr>
			<td>{{ link_to_route('clients.show', $client->name, array($client->id)) }}</td>
			<td>{{ $client->email }}</td>
            <td>{{ (($client->phone ? $client->phone : ($client->mobile ? $client->mobile : ''))) }}</td>
            <td style="text-align: right;">@TODO</td>
			<td>{{ ($client->active) ? trans('fi.yes') : trans('fi.no') }}</td>
			<td>
				<div class="options btn-group">
					<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ route('clients.show', array($client->id)) }}">
								<i class="icon-eye-open"></i> {{ trans('fi.view') }}
							</a>
						</li>
						<li>
							<a href="{{ route('clients.edit', array($client->id)) }}">
								<i class="icon-pencil"></i> {{ trans('fi.edit') }}
							</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="client-create-quote" data-client-name="{{ $client->name }}">
								<i class="icon-file"></i> {{ trans('fi.create_quote') }}
							</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="client-create-invoice" data-client-name="{{ $client->name }}">
								<i class="icon-file"></i> {{ trans('fi.create_invoice') }}
							</a>
						</li>
						<li>
							<a href="{{ route('clients.delete', array($client->id)) }}" onclick="return confirm('{{ trans('fi.delete_client_warning') }}');">
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