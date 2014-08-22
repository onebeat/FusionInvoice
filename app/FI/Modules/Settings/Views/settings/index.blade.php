@extends('layouts.master')

@section('content')

<script type="text/javascript">
$().ready(function() {
    $('#btn-submit').click(function() {
        $('#form-settings').submit();
    });
});  
</script>

<div class="headerbar">
    <h1>{{ trans('fi.settings') }}</h1>
    @include('layouts._header_buttons')
</div>



<form method="post" class="form-horizontal" id="form-settings" enctype="multipart/form-data">

	<div class="tabbable tabs-below">

		<div class="tab-content">

			<div id="settings-general" class="tab-pane active">
                
                @include('layouts._alerts')
                
                @include('settings._general')
			</div>

			<div id="settings-invoices" class="tab-pane">
				@include('settings._invoices')
			</div>
			
			<div id="settings-quotes" class="tab-pane">
				@include('settings._quotes')
			</div>
            
			<div id="settings-taxes" class="tab-pane">
				@include('settings._taxes')
			</div>

			<div id="settings-email" class="tab-pane">
				@include('settings._email')
			</div>
            
			<div id="settings-merchant" class="tab-pane">
				@include('settings._merchant')
			</div>

		</div>

		<ul class="nav-tabs">
			<li class="active"><a data-toggle="tab" href="#settings-general">{{ trans('fi.general') }}</a></li>
			<li><a data-toggle="tab" href="#settings-invoices">{{ trans('fi.invoices') }}</a></li>
			<li><a data-toggle="tab" href="#settings-quotes">{{ trans('fi.quotes') }}</a></li>
            <li><a data-toggle="tab" href="#settings-taxes">{{ trans('fi.taxes') }}</a></li>
			<li><a data-toggle="tab" href="#settings-email">{{ trans('fi.email') }}</a></li>
            <li><a data-toggle="tab" href="#settings-merchant">{{ trans('fi.merchant_account') }}</a></li>
		</ul>

	</div>
	
</form>

@stop