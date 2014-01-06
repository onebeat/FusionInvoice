<!doctype html>
<html dir="ltr" lang="en" class="no-js">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width" />

    <title>{{ trans('fi.invoice') }} #{{ $invoice->number }}</title>

    <link rel="stylesheet" href="{{ asset('assets/invoices/default/reset.css') }}" media="screen" />
    <link rel="stylesheet" href="{{ asset('assets/invoices/default/style.css') }}" media="screen" />

    <!-- give life to HTML5 objects in IE -->
    <!--[if lte IE 8]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <!-- js HTML class -->
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
</head>
<body>
    <!-- begin markup -->

    <div id="invoice" class="new">


        <div class="this-is">
            <strong>{{ trans('fi.invoice') }}</strong>
        </div><!-- invoice headline -->

        <header id="header">
            <div class="invoice-intro">
                <h1>{{ $invoice->user->company }}</h1>
            </div>

            <dl class="invoice-meta">
                <dt class="invoice-number">{{ trans('fi.invoice') }} #</dt>
                <dd>{{ $invoice->number }}</dd>
                <dt class="invoice-date">{{ trans('fi.invoice_date') }}</dt>
                <dd>{{ $invoice->formatted_created_at }}</dd>
                <dt class="invoice-due">{{ trans('fi.due_date') }}</dt>
                <dd>{{ $invoice->formatted_due_at }}</dd>
            </dl>
        </header>
        <!-- e: invoice header -->

        <section id="parties">

            <div class="invoice-to">
                <h2>{{ trans('fi.invoice_to') }}:</h2>
                <div class="vcard">
                    {{ $invoice->client->name }}
                    {{ $invoice->client->email }}

                    <div class="adr">
                        <div class="street-address">{{ $invoice->client->address_1 }}</div>
                        <span class="locality">{{ $invoice->client->city }}, {{ $invoice->client->state }} {{ $invoice->client->zip }}</span>
                        <span class="country-name">{{ $invoice->client->country }}</span>
                    </div>

                    <div class="tel">{{ $invoice->client->phone }}</div>
                </div><!-- e: vcard -->
            </div><!-- e invoice-to -->

            <div class="invoice-from">
                <h2>{{ trans('fi.invoice_from') }}:</h2>
                <div class="vcard">
                    {{ $invoice->user->name }}

                    <div class="adr">
                        <div class="street-address">{{ $invoice->user->address_1 }}</div>
                        <span class="locality">{{ $invoice->user->city }}, {{ $invoice->user->state }} {{ $invoice->user->zip }}</span>
                        <span class="country-name">{{ $invoice->user->country }}</span>
                    </div>

                    <div class="tel">{{ $invoice->user->phone }}</div>
                    {{ $invoice->user->email }}
                </div><!-- e: vcard -->
            </div><!-- e invoice-from -->


            <div class="invoice-status">
                <h3>{{ trans('fi.status') }}</h3>
                <strong><em>{{ trans('fi.' . $invoice->status_text) }}</em></strong>
            </div><!-- e: invoice-status -->

        </section><!-- e: invoice partis -->

        <section class="invoice-financials">

            <div class="invoice-items">
                <table>
                    <thead>
                        <tr>
                            <th>{{ trans('fi.item') }}</th>
                            <th>{{ trans('fi.description') }}</th>
                            <th>{{ trans('fi.quantity') }}</th>
                            <th>{{ trans('fi.price') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->formatted_quantity }}</td>
                            <td>{{ $item->formatted_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div><!-- e: invoice items -->

            <div class="invoice-totals">
                <table>
                    <caption>{{ trans('fi.totals') }}:</caption>
                    <tbody>
                        <tr>
                            <th>{{ trans('fi.subtotal') }}:</th>
                            <td></td>
                            <td>{{ $invoice->amount->formatted_item_subtotal }}</td>
                        </tr>

                        @foreach ($invoice->items as $item)
                        @if ($item->amount->tax_total <> 0)
                        <tr>
                            <th>{{ trans('fi.tax') }}:</th>
                            <td>{{ $item->tax_rate->formatted_percent }} ({{ $item->tax_rate->name }})</td>
                            <td>{{ $item->amount->formatted_tax_total }}</td>
                        </tr>
                        @endif
                        @endforeach

                        @foreach ($invoice->tax_rates as $invoiceTax)
                        <tr>
                            <th>{{ trans('fi.tax') }}:</th>
                            <td>{{ $invoiceTax->tax_rate->formatted_percent }} ({{ $invoiceTax->tax_rate->name }})</td>
                            <td>{{ $invoiceTax->formatted_tax_total }}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <th>{{ trans('fi.total') }}:</th>
                            <td></td>
                            <td>{{ $invoice->amount->formatted_total }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('fi.paid') }}</th>
                            <td></td>
                            <td>{{ $invoice->amount->formatted_paid }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('fi.balance') }}:</th>
                            <td></td>
                            <td>{{ $invoice->amount->formatted_balance }}</td>
                        </tr>
                    </tbody>
                </table>

            </div><!-- e: invoice totals -->

            <div class="invoice-notes">
                <h6>{{ trans('fi.terms_and_conditions') }}:</h6>
                <p>{{ $invoice->formatted_terms }}</p>
            </div><!-- e: invoice-notes -->

        </section><!-- e: invoice financials -->

        <footer id="footer">
            <p>
                {{ $invoice->footer }}
            </p>
        </footer>

    </div><!-- e: invoice -->

</body>
</html>