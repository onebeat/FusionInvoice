@extends('layouts.master')

@section('jscript')
<script type="text/javascript">
	$(function() {
		$('#btn-submit').click(function() {
			$('#report-results').load("{{ route('reports.revenueByClient.ajax.run') }}", { 
				year: $('#year').val()
			});
		});
	});
</script>
@stop

@section('content')

<div class="headerbar">
	<h1>{{ trans('fi.revenue_by_client') }}</h1>
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
			<label class="control-label">{{ trans('fi.year') }}: </label>
			<div class="controls">
				{{ Form::select('year', $years, null, array('id' => 'year')) }}
			</div>
		</div>

	</div>

	<div id="report-results">

	</div>

</div>

@stop