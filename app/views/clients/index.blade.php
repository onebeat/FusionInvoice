@extends('layouts.master')

@section('content')

<div class="headerbar">

	<h1>{{ trans('fi.clients') }}</h1>

	<div class="pull-right">
		<a class="btn btn-primary" href="{{ route('clients.create') }}"><i class="icon-plus icon-white"></i> {{ trans('fi.new') }}</a>
	</div>

	<div class="pull-right">
		{{ Pager::create($clients) }}
	</div>

	<div class="pull-right">
		<ul class="nav nav-pills index-options">
			<li <?php if ($status == 'active') { ?>class="active"<?php } ?>><a href="{{ url('clients/status/active') }}">{{ trans('fi.active') }}</a></li>
			<li <?php if ($status == 'inactive') { ?>class="active"<?php } ?>><a href="{{ url('clients/status/inactive') }}">{{ trans('fi.inactive') }}</a></li>
			<li <?php if ($status == 'all') { ?>class="active"<?php } ?>><a href="{{ url('clients/status/all') }}">{{ trans('fi.all') }}</a></li>
		</ul>
	</div>

</div>

<div class="table-content">

	@include('layouts/_alerts')

	<div id="filter_results">
		@include('clients._table')
	</div>

</div>

@stop