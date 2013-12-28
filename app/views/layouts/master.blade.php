<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">

		<!-- Use the .htaccess and remove these lines to avoid edge case issues -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>FusionInvoice</title>
		<meta name="description" content="">
		<meta name="author" content="William G. Rivera">

		<meta name="viewport" content="width=device-width,initial-scale=1">

		<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

		<script src="{{ asset('assets/js/libs/modernizr-2.0.6.js') }}"></script>
		<script src="{{ asset('assets/js/libs/jquery-1.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/jquery-ui-1.10.3.min.js') }}"></script>
		<script src="{{ asset('assets/js/libs/bootstrap.min.js') }}"></script>

        <script type="text/javascript">

            $(function()
            {
                $('.nav-tabs').tab();
                $('.tip').tooltip();
				
                $('.datepicker').datepicker({autoclose: true, format: '{{ Config::get('fi.datepickerFormat') }}' });

                $('.create-quote').click(function() {
                	$('#modal-placeholder').load("{{ route('quotes.ajax.modalCreate') }}");
                });

                $('.create-invoice').click(function() {
                	$('#modal-placeholder').load("{{ route('invoices.ajax.modalCreate') }}");
                });

                $('.enter-payment').click(function() {
                	$('#modal-placeholder').load("{{ route('payments.ajax.modalEnterPayment') }}", {
                		invoice_id: $(this).data('invoice-id'),
                		balance: $(this).data('invoice-balance'),
                		redirectTo: '{{ URL::current() }}'
                	});
                });

                $('.quote-to-invoice').click(function() {
                	$('#modal-placeholder').load("{{ route('quotes.ajax.modalQuoteToInvoice') }}", {
                		quote_id: $(this).data('quote-id'),
                		client_id: $(this).data('client-id')
                	});
                });

            });

        </script>

        @section('jscript')

        @show

	</head>

	<body>

		<nav class="navbar navbar-inverse">

			<div class="navbar-inner">

				<div class="container">

					<ul class="nav">

						<li>{{ link_to_route('dashboard.index', trans('fi.dashboard')) }}</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('fi.clients') }}<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>{{ link_to_route('clients.create', trans('fi.add_client')) }}</li>
								<li>{{ link_to_route('clients.index', trans('fi.view_clients')) }}</li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('fi.quotes') }}<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:void(0)" class="create-quote">{{ trans('fi.create_quote') }}</a></li>
								<li><a href="{{ route('quotes.index', array('all')) }}">{{ trans('fi.view_quotes') }}</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('fi.invoices') }}<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:void(0)" class="create-invoice">{{ trans('fi.create_invoice') }}</a></li>
								<li><a href="{{ route('invoices.index', array('all')) }}">{{ trans('fi.view_invoices') }}</a></li>
                                <li><a href="#">{{ trans('fi.view_recurring_invoices') }}</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('fi.payments') }}<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('payments.index') }}">{{ trans('fi.view_payments') }}</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('fi.reports') }}<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ route('reports.itemSales') }}">{{ trans('fi.item_sales') }}</a></li>
								<li><a href="{{ route('reports.paymentsCollected') }}">{{ trans('fi.payments_collected') }}</a></li>
								<li><a href="{{ route('reports.revenueByClient') }}">{{ trans('fi.revenue_by_client') }}</a></li>
								<li><a href="{{ route('reports.taxSummary') }}">{{ trans('fi.tax_summary') }}</a></li>
							</ul>
						</li>

					</ul>

					@if (isset($filter_display) and $filter_display == true) }}
					@include('filter.jquery_filter')
					<form class="navbar-search pull-left">
						<input type="text" class="search-query" id="filter" placeholder="{{ $filter_placeholder }}">
					</form>
					@endif

					<ul class="nav pull-right settings">
                        <li><a href="#">{{ trans('fi.welcome') . ' ' . Auth::user()->name; }}</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="http://docs.fusioninvoice.com/1.3/" target="_blank" class="tip icon" data-original-title="Documentation" data-placement="bottom"><i class="icon-question-sign"></i></a></li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="tip icon dropdown-toggle" data-toggle="dropdown" data-original-title="{{ trans('fi.settings') }}" data-placement="bottom"><i class="icon-cog"></i></a>
							<ul class="dropdown-menu">
                                <li><a href="{{ route('customFields.index') }}">{{ trans('fi.custom_fields') }}</a></li>
								<li>{{ link_to_route('emailTemplates.index', trans('fi.email_templates')) }}</li>
                                <li><a href="#">{{ trans('fi.import_data') }}</a></li>
								<li>{{ link_to_route('invoiceGroups.index', trans('fi.invoice_groups')) }}</li>
                                <li><a href="{{ route('itemLookups.index') }}">{{ trans('fi.item_lookups') }}</a></li>
								<li>{{ link_to_route('paymentMethods.index', trans('fi.payment_methods')) }}</li>
								<li>{{ link_to_route('taxRates.index', trans('fi.tax_rates')) }}</li>
								<li><a href="{{ route('users.index') }}">{{ trans('fi.user_accounts') }}</a></li>
                                <li class="divider"></li>
                                <li>{{ link_to_route('settings.index', trans('fi.system_settings')) }}</li>
							</ul>
						</li>
						<li class="divider-vertical"></li>
						<li><a href="{{ route('session.logout') }}" class="tip icon logout" data-original-title="{{ trans('fi.logout') }}" data-placement="bottom"><i class="icon-off"></i></a></li>
					</ul>

				</div>

			</div>

		</nav>

		<div class="sidebar">

			<ul>
				<li><a href="{{ route('dashboard.index') }}"><img alt="" src="{{ asset('assets/img/icons/dashboard24x24.png') }}" title="{{ trans('fi.dashboard') }}" /></a></li>
				<li><a href="{{ route('clients.index') }}"><img alt="" src="{{ asset('assets/img/icons/clients24x24.png') }}" title="{{ trans('fi.clients') }}" /></a></li>
				<li><a href="#"><img alt="" src="{{ asset('assets/img/icons/quotes24x24.png') }}" title="{{ trans('fi.quotes') }}" /></a></li>
				<li><a href="#"><img alt="" src="{{ asset('assets/img/icons/invoices24x24.png') }}" title="{{ trans('fi.invoices') }}" /></a></li>
				<li><a href="#"><img alt="" src="{{ asset('assets/img/icons/payments24x24.png') }}" title="{{ trans('fi.payments') }}" /></a></li>
			</ul>

		</div>

		<div class="main-area">

			<div id="modal-placeholder"></div>
			
			@yield('content')

		</div>

		<script defer src="{{ asset('assets/js/plugins.js') }}"></script>
		<script defer src="{{ asset('assets/js/script.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>

		<!--[if lt IE 7 ]>
			<script src="{{ asset('assets/js/dd_belatedpng.js') }}"></script>
			<script type="text/javascript"> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
		<![endif]-->

		<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
			 chromium.org/developers/how-tos/chrome-frame-getting-started -->
		<!--[if lt IE 7 ]>
		  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		  <script type="text/javascript">window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->

	</body>
</html>