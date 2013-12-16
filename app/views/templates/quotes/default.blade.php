<!doctype html>
<html dir="ltr" lang="en" class="no-js">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width" />

    <title>{{ trans('fi.quote') }} #{{ $quote->number }}</title>

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
            <strong>{{ trans('fi.quote') }}</strong>
        </div><!-- invoice headline -->

        <header id="header">
            <div class="invoice-intro">
                <h1>{{ $quote->user->company }}</h1>
            </div>

            <dl class="invoice-meta">
                <dt class="invoice-number">{{ trans('fi.quote') }} #</dt>
                <dd>{{ $quote->number }}</dd>
                <dt class="invoice-date">{{ trans('fi.quote_date') }}</dt>
                <dd>{{ $quote->formatted_created_at }}</dd>
                <dt class="invoice-due">{{ trans('fi.expires') }}</dt>
                <dd>{{ $quote->formatted_expires_at }}</dd>
            </dl>
        </header>
        <!-- e: invoice header -->

        <section id="parties">

            <div class="invoice-to">
                <h2>{{ trans('fi.to') }}:</h2>
                <div class="vcard">
                    {{ $quote->client->name }}
                    {{ $quote->client->email }}

                    <div class="adr">
                        <div class="street-address">{{ $quote->client->address_1 }}</div>
                        <span class="locality">{{ $quote->client->city }}, {{ $quote->client->state }} {{ $quote->client->zip }}</span>
                        <span class="country-name">{{ $quote->client->country }}</span>
                    </div>

                    <div class="tel">{{ $quote->client->phone }}</div>
                </div><!-- e: vcard -->
            </div><!-- e invoice-to -->

            <div class="invoice-from">
                <h2>{{ trans('fi.from') }}:</h2>
                <div class="vcard">
                    {{ $quote->user->name }}

                    <div class="adr">
                        <div class="street-address">{{ $quote->user->address_1 }}</div>
                        <span class="locality">{{ $quote->user->city }}, {{ $quote->user->state }} {{ $quote->user->zip }}</span>
                        <span class="country-name">{{ $quote->user->country }}</span>
                    </div>

                    <div class="tel">{{ $quote->user->phone }}</div>
                    {{ $quote->user->email }}
                </div><!-- e: vcard -->
            </div><!-- e invoice-from -->

            <div class="invoice-status">
                <h3>{{ trans('fi.status') }}</h3>
                <strong><em>{{ trans('fi.' . $quote->status_text) }}</em></strong>
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
                        @foreach ($quote->items as $item)
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
                            <td>{{ $quote->amount->formatted_item_subtotal }}</td>
                        </tr>

                        @foreach ($quote->items as $item)
                        @if ($item->amount->tax_total <> 0)
                        <tr>
                            <th>{{ trans('fi.tax') }}:</th>
                            <td>{{ $item->tax_rate->formatted_percent }} ({{ $item->tax_rate->name }})</td>
                            <td>{{ $item->amount->formatted_tax_total }}</td>
                        </tr>
                        @endif
                        @endforeach

                        @foreach ($quote->tax_rates as $quoteTax)
                        <tr>
                            <th>{{ trans('fi.tax') }}:</th>
                            <td>{{ $quoteTax->tax_rate->formatted_percent }} ({{ $quoteTax->tax_rate->name }})</td>
                            <td>{{ $quoteTax->formatted_tax_total }}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <th>{{ trans('fi.total') }}:</th>
                            <td></td>
                            <td>{{ $quote->amount->formatted_total }}</td>
                        </tr>
                    </tbody>
                </table>

            </div><!-- e: invoice totals -->

        </section><!-- e: invoice financials -->

        <footer id="footer">
            <p>
                {{ $quote->footer }}
            </p>
        </footer>

    </div><!-- e: invoice -->

</body>
</html>