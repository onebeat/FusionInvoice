@extends('layouts.master')

@section('content')

<div class="headerbar">
	<h1>{{ trans('fi.invoice_groups') }}</h1>

	<div class="pull-right">
		<a class="btn btn-primary" href="{{ route('invoiceGroups.create') }}"><i class="icon-plus icon-white"></i> {{ trans('fi.new') }}</a>
	</div>
	
	<div class="pull-right">
		{{ Pager::create($invoiceGroups) }}
	</div>

</div>

<div class="table-content">

	@include('layouts._alerts')

	<table class="table table-striped">

		<thead>
			<tr>
				<th>{{ trans('fi.name') }}</th>
				<th>{{ trans('fi.prefix') }}</th>
				<th>{{ trans('fi.next_id') }}</th>
				<th>{{ trans('fi.left_pad') }}</th>
				<th>{{ trans('fi.year_prefix') }}</th>
				<th>{{ trans('fi.month_prefix') }}</th>
				<th>{{ trans('fi.options') }}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($invoiceGroups as $invoiceGroup)
			<tr>
				<td>{{ $invoiceGroup->name }}</td>
				<td>{{ $invoiceGroup->prefix }}</td>
				<td>{{ $invoiceGroup->next_id }}</td>
				<td>{{ $invoiceGroup->left_pad }}</td>
				<td>{{ ($invoiceGroup->prefix_year) ? trans('fi.yes') : trans('fi.no') }}</td>
				<td>{{ ($invoiceGroup->prefix_month) ? trans('fi.yes') : trans('fi.no') }}</td>
				<td>
					<div class="options btn-group">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('invoiceGroups.edit', [$invoiceGroup->id]) }}">
									<i class="icon-pencil"></i> {{ trans('fi.edit') }}
								</a>
							</li>
							<li>
								<a href="{{ route('invoiceGroups.delete', [$invoiceGroup->id]) }}" onclick="return confirm('{{ trans('fi.delete_record_warning') }}');">
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

</div>

@stop