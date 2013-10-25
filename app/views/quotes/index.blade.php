@extends('layouts.master')

@section('content')

<div class="headerbar">

	<h1>{{ trans('fi.quotes') }}</h1>
	
	<div class="pull-right">
		<a class="create-quote btn btn-primary" href="#"><i class="icon-plus icon-white"></i> {{ trans('fi.new') }}</a>
	</div>

	<div class="pull-right">
		{{ Pager::create($quotes) }}
	</div>
    
	<div class="pull-right">
		<ul class="nav nav-pills index-options">
		@foreach ($statuses as $liStatus)
			<li <?php if ($status == $liStatus['class']) { ?>class="active"<?php } ?>><a href="{{ $liStatus['href'] }}">{{ $liStatus['label'] }}</a></li>
		@endforeach
		</ul>
	</div>

</div>

<div class="table-content">

	<div id="filter_results">
		@include('quotes._table', array('quotes' => $quotes))
	</div>

</div>

@stop