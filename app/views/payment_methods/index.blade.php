@extends('layouts.master')

@section('content')

<div class="headerbar">
	<h1>{{ trans('fi.payment_methods') }}</h1>

	<div class="pull-right">
		<a class="btn btn-primary" href="{{ route('paymentMethods.create') }}"><i class="icon-plus icon-white"></i> {{ trans('fi.new') }}</a>
	</div>
	
	<div class="pull-right">
		{{ Pager::create($paymentMethods) }}
	</div>

</div>

<div class="table-content">

	@include('layouts._alerts')

	<table class="table table-striped">

		<thead>
			<tr>
				<th>{{ trans('fi.payment_method') }}</th>
				<th>{{ trans('fi.options') }}</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($paymentMethods as $paymentMethod)
			<tr>
				<td>{{ $paymentMethod->name }}</td>
				<td>
					<div class="options btn-group">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> {{ trans('fi.options') }}</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('paymentMethods.edit', [$paymentMethod->id]) }}">
									<i class="icon-pencil"></i> {{ trans('fi.edit') }}
								</a>
							</li>
							<li>
								<a href="{{ route('paymentMethods.delete', [$paymentMethod->id]) }}" onclick="return confirm('{{ trans('fi.delete_record_warning') }}');">
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