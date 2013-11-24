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

  <title>{{ trans('fi.invoice') }} #{{ $invoice->number }}</title>

</head>

<body>

    <div id="page">

        <div class="status draft">
            <p>Paid</p>
        </div>
        
        <p class="recipient-address">
            <strong>{{ $invoice->client->name }}</strong><br />
            {{ $invoice->client->address_1 }}<br />
            {{ $invoice->client->city }}<br />
            {{ $invoice->client->state }}<br />
            {{ $invoice->client->zip }}</p>

            <h1>{{ trans('fi.invoice') }} #{{ $invoice->number }}</h1>
            <p class="terms"><strong>{{ $invoice->formatted_created_at }}</strong><br/>
                {{ trans('fi.due_date') }} {{ $invoice->formatted_due_at }}</p>

                <img src="images/company-logo.png" alt="yourlogo" class="company-logo" />
                <p class="company-address">
                    {{ $invoice->user->company }}<br/>
                    {{ $invoice->user->address_1 }}<br/>
                    {{ $invoice->user->city }}<br/>
                    {{ $invoice->user->state }}<br/>
                    {{ $invoice->user->zip }}<br/>
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
                        @foreach ($invoice->items as $item)
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
                    <div class="total-amount"><p>{{ $invoice->amount->formatted_total }}</p></div>
                </div>

                <div style="clear: both;"></div>

            </div>
            <div class="page-shadow"></div>

        </body>
        </html>