<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>{{ $invoice->user->company }}</h2>

	<div>
		<p>This is a reminder to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is overdue. Click the link below to view the invoice:</p>

		<p>{{ route('public.invoice.show', array($invoice->url_key)) }}
	</div>
</body>
</html>