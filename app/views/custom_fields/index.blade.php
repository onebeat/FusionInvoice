@extends('layouts.master')

@section('content')

<div class="headerbar">
	<h1>{{ trans('fi.custom_fields') }}</h1>

	<div class="pull-right">
		<a class="btn btn-primary" href="{{ route('customFields.create') }}"><i class="icon-plus icon-white"></i> {{ trans('fi.new') }}</a>
	</div>
	
	<div class="pull-right">
		{{ Pager::create($customFields) }}
	</div>

</div>

<div class="table-content">

	@include('layouts/_alerts')

	<table class="table table-striped">

		<thead>
			<tr>
				<th>{{ trans('fi.table_name') }}</th>
				<th>{{ trans('fi.column_name') }}</th>
				<th>{{ trans('fi.field_label') }}</th>
				<th>{{ trans('fi.field_type') }}</th>
				<th>{{ trans('fi.options') }}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($customFields as $customField)
			<tr>
				<td>{{ $customField->table_name }}</td>
				<td>{{ $customField->column_name }}</td>
				<td>{{ $customField->field_label }}</td>
				<td>{{ $customField->field_type }}</td>
				<td>
					<div class="options btn-group">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('customFields.edit', array($customField->id)) }}">
									<i class="icon-pencil"></i> {{ trans('fi.edit') }}
								</a>
							</li>
							<li>
								<a href="{{ route('customFields.delete', array($customField->id)) }}" onclick="return confirm('{{ trans('fi.delete_record_warning') }}');">
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