@extends('layouts.master')

@section('content')

<div class="headerbar">

	<h1>{{ trans('fi.invoices') }}</h1>
	
	<div class="pull-right">
		<a class="create-invoice btn btn-primary" href="#"><i class="icon-plus icon-white"></i> {{ trans('fi.new') }}</a>
	</div>

	<div class="pull-right">
		{{ Pager::create($invoices) }}
	</div>
    
	<div class="pull-right">
		<ul class="nav nav-pills index-options">
		@foreach ($statuses as $liStatus)
			<li <?php if ($status == $liStatus['status']) { ?>class="active"<?php } ?>><a href="{{ route('invoices.index', array($liStatus['status'])) }}">{{ $liStatus['label'] }}</a></li>
		@endforeach
		<li @if ($status == 'overdue') class="active" @endif><a href="{{ route('invoices.index', array('overdue')) }}">Overdue</a></li>
		</ul>
	</div>

</div>

<div class="table-content">

	<div id="filter_results">
		@include('invoices._table', array('invoices' => $invoices))
	</div>

</div>

@stop