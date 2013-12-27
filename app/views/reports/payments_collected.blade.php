@extends('layouts.master')

@section('jscript')
<script type="text/javascript">
	$(function() {
		$('#btn-submit').click(function() {
			$('#report-results').load("{{ route('reports.paymentsCollected.ajax.run') }}", { 
				from_date: $('#from_date').val(), 
				to_date: $('#to_date').val()
			});
		});
	});
</script>
@stop

@section('content')

<div class="headerbar">
	<h1>{{ trans('fi.payments_collected') }}</h1>
	<div class="pull-right">
		<div class="options btn-group pull-left">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" style="margin-right: 5px;"><i class="icon-download"></i> {{ trans('fi.export_to') }}</a>
			<ul class="dropdown-menu">
				<li><a href="javascript:void(0)" id="btn-export-csv">{{ trans('fi.csv') }}</a></li>
			</ul>
		</div>
		<button class="btn btn-primary" id="btn-submit">{{ trans('fi.run_report') }}</button>
	</div>
</div>

<div class="content">

	<div class="form-horizontal">

		<div class="control-group">
			<label class="control-label">{{ trans('fi.from_date') }}: </label>
			<div class="controls input-append date datepicker">
				{{ Form::text('from_date', null, array('id' => 'from_date', 'readonly' => 'readonly')) }}
				<span class="add-on"><i class="icon-th"></i></span>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">{{ trans('fi.to_date') }}: </label>
			<div class="controls input-append date datepicker">
				{{ Form::text('to_date', null, array('id' => 'to_date', 'readonly' => 'readonly')) }}
				<span class="add-on"><i class="icon-th"></i></span>
			</div>
		</div>

	</div>

	<div id="report-results">

	</div>

</div>

@stop