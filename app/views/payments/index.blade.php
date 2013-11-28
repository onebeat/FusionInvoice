@extends('layouts.master')

@section('content')

<div class="headerbar">
	<h1>{{ trans('fi.payments') }}</h1>

	<div class="pull-right">
		{{ Pager::create($payments) }}
	</div>

</div>

<div class="table-content">

	@include('layouts/_alerts')

	<div id="filter_results">
		@include('payments._table', array('payments' => $payments))
	</div>

</div>

@stop