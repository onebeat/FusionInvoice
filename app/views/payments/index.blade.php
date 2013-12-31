@extends('layouts.master')

@section('jscript')
<script type="text/javascript">

	$(function() {

		$('.mail-payment-receipt').click(function() {
			$('#modal-placeholder').load("{{ route('payments.ajax.modalMailPayment') }}", { 
				payment_id: $(this).data('payment-id'),
				redirect_to: $(this).data('redirect-to')
			});
		});

	});

</script>
@stop

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