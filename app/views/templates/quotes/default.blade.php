<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('assets/invoices/invoice.css') }} " type="text/css" charset="utf-8" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
    <script type="text/javascript" src="{{ asset('assets/invoices/js/jquery.tablesorter.js') }}"></script> 
    <script type="text/javascript">
      $(document).ready(function() 
      { 
          $("#table").tablesorter({ 
              widgets: ['zebra'] 
          }); 
      } 
      ); 
  </script>

  <title>{{ trans('fi.quote') }} #{{ $quote->number }}</title>

</head>

<body>

    <div id="page">

        <div class="status draft">
            <p>Paid</p>
        </div>
        
        <p class="recipient-address">
            <strong>{{ $quote->client->name }}</strong><br />
            {{ $quote->client->address_1 }}<br />
            {{ $quote->client->city }}<br />
            {{ $quote->client->state }}<br />
            {{ $quote->client->zip }}</p>

            <h1>{{ trans('fi.quote') }} #{{ $quote->number }}</h1>
            <p class="terms"><strong>{{ $quote->formatted_created_at }}</strong><br/>
                {{ trans('fi.expires') }} {{ $quote->formatted_expires_at }}</p>

                <img src="images/company-logo.png" alt="yourlogo" class="company-logo" />
                <p class="company-address">
                    {{ $quote->user->company }}<br/>
                    {{ $quote->user->address_1 }}<br/>
                    {{ $quote->user->city }}<br/>
                    {{ $quote->user->state }}<br/>
                    {{ $quote->user->zip }}<br/>
                </p>

                <table id="table" class="tablesorter" cellspacing="0"> 
                    <thead> 
                        <tr> 
                            <th>{{ trans('fi.quantity') }}</th> 
                            <th>{{ trans('fi.name') }}</th>
                            <th>{{ trans('fi.description') }}</th>
                            <th>{{ trans('fi.price') }}</th> 
                            <th>{{ trans('fi.subtotal') }}</th> 
                        </tr> 
                    </thead> 
                    <tbody>
                        @foreach ($quote->items as $item)
                        <tr>
                            <td>{{ $item->formatted_quantity }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->formatted_price }}</td>
                            <td>{{ $item->amount->formatted_subtotal }}</td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table>

                <div class="total-due">
                    <div class="total-heading"><p>{{ trans('fi.total') }}</p></div>
                    <div class="total-amount"><p>{{ $quote->amount->formatted_total }}</p></div>
                </div>

                <div style="clear: both;"></div>

            </div>
            <div class="page-shadow"></div>

        </body>
        </html>