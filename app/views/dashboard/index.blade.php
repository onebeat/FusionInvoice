@extends('layouts.master')

@section('content')

<div class="headerbar">
	<h1>{{ trans('fi.dashboard') }}</h1>
</div>

@include('layouts/_alerts')

<div class="container-fluid">

	<div class="row-fluid">

		<div class="span6">

			<div class="widget quick-actions">

				<div class="widget-title">
					<h5>{{ trans('fi.quick_actions') }}</h5>
				</div>

				<table class="table no-margin">
					<tbody>
						<tr>
							<td><a href="{{ route('clients.create') }}"><i class="icon-user"></i>{{ trans('fi.add_client') }}</a></td>
							<td><a href="javascript:void(0)" class="create-quote"><i class="icon-file-text"></i>{{ trans('fi.create_quote') }}</a></td>
							<td><a href="javascript:void(0)" class="create-invoice"><i class="icon-money"></i>{{ trans('fi.create_invoice') }}</a></td>
						</tr>
					</tbody>
				</table>

			</div>

			<div class="widget overview">
				<div class="widget-title">
					<h5><i class="icon-file-text"></i>{{ trans('fi.quote_overview') }}</h5>
				</div>

				<table class="table no-margin">
					<thead>
						<tr>
							@if (isset($quote_status_Totals))
							<th><a href="<?php echo site_url($total['href']); ?>"><?php echo $total['label']; ?></a></th>
							@endif
						</tr>
					</thead>
					<tbody>
						<tr>
							@if (isset($quote_status_Totals))
							<td class="<?php echo $total['class']; ?>"><?php echo format_currency($total['sum_total']); ?></td>
							@endif
						</tr>
					</tbody>
				</table>

			</div>

			<div class="widget overview">
				<div class="widget-title">
					<h5><i class="icon-money"></i>{{ trans('fi.invoice_overview') }}</h5>
				</div>

				<table class="table no-margin">
					<thead>
						<tr>
							@if (isset($invoice_status_totals))
							<th><a href="<?php echo site_url($total['href']); ?>"><?php echo $total['label']; ?></a></th>
							@endif
						</tr>
					</thead>
					<tbody>
						<tr>
							@if (isset($invoice_status_totals))
							<td class="<?php echo $total['class']; ?>"><?php echo format_currency($total['sum_total']); ?></td>
							@endif
						</tr>
					</tbody>
				</table>

			</div>

		</div>

		<div class="span6">

			<div class="widget">

				<div class="widget-title">
					<h5><i class="icon-warning-sign"></i>{{ trans('fi.overdue_invoices') }}</h5>
				</div>

				<table class="table table-striped no-margin">
					<thead>
						<tr>
							<th style="width: 15%;">{{ trans('fi.status') }}</th>
							<th style="width: 15%;">{{ trans('fi.due_date') }}</th>
							<th style="width: 10%;">{{ trans('fi.invoice') }}</th>
							<th style="width: 40%;">{{ trans('fi.client') }}</th>
							<th style="text-align: right; width: 15%;">{{ trans('fi.balance') }}</th>
							<th style="text-align: center; width: 5%;">{{ trans('fi.view') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($overdueInvoices as $invoice)
						<tr>
							<td><span class="label {{ $invoiceStatuses[$invoice->invoice_status_id]['status'] }}">{{ $invoiceStatuses[$invoice->invoice_status_id]['label'] }}</span></td>
							<td><span class="font-overdue">{{ $invoice->formatted_due_at }}</span></td>
							<td><a href="{{ route('invoices.show', array($invoice->id)) }}">{{ $invoice->number }}</a></td>
							<td><a href="{{ route('clients.show', array($invoice->client_id)) }}">{{ $invoice->client->name }}</a></td>
							<td style="text-align: right;">{{ $invoice->amount->formatted_balance }}</td>
							<td style="text-align: center;"><a href="{{ route('invoices.preview', array($invoice->id)) }}" title="{{ trans('fi.view') }}" target="_blank"><i class="icon-file"></i></a></td>
						</tr>
						@endforeach
						<tr>
							<td colspan="6" style="text-align: center;"><a href="{{ route('invoices.index', array('overdue')) }}">{{ trans('fi.view_all') }}</td>
						</tr>
					</tbody>
				</table>

			</div>

			<div class="widget">

				<div class="widget-title">
					<h5><i class="icon-time"></i>{{ trans('fi.recent_quotes') }}</h5>
				</div>

				<table class="table table-striped no-margin">
					<thead>
						<tr>
							<th style="width: 15%;">{{ trans('fi.status') }}</th>
							<th style="width: 15%;">{{ trans('fi.date') }}</th>
							<th style="width: 10%;">{{ trans('fi.quote') }}</th>
							<th style="width: 40%;">{{ trans('fi.client') }}</th>
							<th style="text-align: right; width: 15%;">{{ trans('fi.balance') }}</th>
							<th style="text-align: center; width: 5%;">{{ trans('fi.view') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($recentQuotes as $quote)
						<tr>
							<td><span class="label {{ $quoteStatuses[$quote->quote_status_id]['status'] }}">{{ $quoteStatuses[$quote->quote_status_id]['label'] }}</span></td>
							<td>{{ $quote->formatted_created_at }}</td>
							<td><a href="{{ route('quotes.show', array($quote->id)) }}">{{ $quote->number }}</a></td>
							<td><a href="{{ route('clients.show', array($quote->client_id)) }}">{{ $quote->client->name }}</a></td>
							<td style="text-align: right;">{{ $quote->amount->formatted_total }}</td>
							<td style="text-align: center;"><a href="{{ route('quotes.preview', array($quote->id)) }}" title="{{ trans('fi.view') }}" target="_blank"><i class="icon-file"></i></a></td>
						</tr>
						@endforeach
						<tr>
							<td colspan="6" style="text-align: center;"><a href="{{ route('quotes.index', array('all')) }}">{{ trans('fi.view_all') }}</td>
						</tr>
					</tbody>
				</table>

			</div>

			<div class="widget">

				<div class="widget-title">
					<h5><i class="icon-time"></i>{{ trans('fi.recent_invoices') }}</h5>
				</div>

				<table class="table table-striped no-margin">
					<thead>
						<tr>
							<th style="width: 15%;">{{ trans('fi.status') }}</th>
							<th style="width: 15%;">{{ trans('fi.due_date') }}</th>
							<th style="width: 10%;">{{ trans('fi.invoice') }}</th>
							<th style="width: 40%;">{{ trans('fi.client') }}</th>
							<th style="text-align: right; width: 15%;">{{ trans('fi.balance') }}</th>
							<th style="text-align: center; width: 5%;">{{ trans('fi.view') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($recentInvoices as $invoice)
						<tr>
							<td><span class="label {{ $invoiceStatuses[$invoice->invoice_status_id]['status'] }}">{{ $invoiceStatuses[$invoice->invoice_status_id]['label'] }}</span></td>
							<td><span class="@if ($invoice->is_overdue) font-overdue @endif">{{ $invoice->formatted_due_at }}</span></td>
							<td><a href="{{ route('invoices.show', array($invoice->id)) }}">{{ $invoice->number }}</a></td>
							<td><a href="{{ route('clients.show', array($invoice->client_id)) }}">{{ $invoice->client->name }}</a></td>
							<td style="text-align: right;">{{ $invoice->amount->formatted_balance }}</td>
							<td style="text-align: center;"><a href="{{ route('invoices.preview', array($invoice->id)) }}" title="{{ trans('fi.view') }}" target="_blank"><i class="icon-file"></i></a></td>
						</tr>
						@endforeach
						<tr>
							<td colspan="6" style="text-align: center;"><a href="{{ route('invoices.index', array('all')) }}">{{ trans('fi.view_all') }}</td>
						</tr>
					</tbody>
				</table>

			</div>

		</div>

	</div>

</div>

@stop